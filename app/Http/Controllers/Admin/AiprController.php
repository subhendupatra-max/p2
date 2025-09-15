<?php

namespace App\Http\Controllers\Admin;

use App\Models\Aipr;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use App\Traits\CommonFunction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Facades\Activity;
use App\Imports\AiprActiveImport;
use App\Imports\AiprRetiredImport;
use Maatwebsite\Excel\Facades\Excel;

class AiprController extends BaseController
{
    use CommonFunction;
    use UploadAble;
    public function index(Request $request)
    {
        if(auth()->user()->can('specific-unit')){
            $details = Aipr::where('unit_id',auth()->user()->unit_id)->get();
        }else{
            $details = Aipr::get();
        }

        return view('admin.aipr.index', compact('details'));
    }

    public function upload(Request $request)
    {
        if ($request->post()) {
            $validated = $request->validate([
                'file' => 'required',
                'type' => 'required',
                'unit_id' => 'required|exists:units,id',
                'menu_id' => 'required|exists:menus,id',
                'otp' => 'required|digits:6',
                'captcha'  => 'required'
            ], [
                'file.required' => 'File is required',
                'type.required' => 'Type is required',
                'otp.required' => 'OTP is required',
                'menu_id.required' => 'Menu is required',
                'unit_id.required' => 'Unit is required',
                'otp.digits' => 'OTP must be 6 digits',
                'captcha.required' => 'Captcha is required',

            ]);
            $message = "AIPR List Uploaded Successfully";

            DB::beginTransaction();
            try {
                $otp = $request->otp;
                $response = $this->verifyOTP($otp);
                if (!$response['status']) {
                    return $response;
                }
                if($request->type == 1){
                    Aipr::where('menu_id', $request->menu_id)->delete();
                     Excel::import(
                        new AiprActiveImport($request->unit_id, $request->menu_id),
                        $request->file('file')
                    );
                }else{
                    Aipr::where('menu_id', $request->menu_id)->delete();
                      Excel::import(
                        new AiprRetiredImport($request->unit_id, $request->menu_id),
                        $request->file('file')
                    );
                }


                DB::commit();
                $data = ['status' => true, 'message' => $message, 'data' => null, 'url' => route('admin.aipr.list')];
                return response($data);
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', 'An error occurred while uploading the AIPR list.');
            }
        }
        if(auth()->user()->unit_id != null){
            $units = \App\Models\Unit::where('id',auth()->user()->unit_id)->where('is_active', 1)->get();
        }else{
            $units = \App\Models\Unit::where('is_active', 1)->get();
        }

        return view('admin.aipr.upload', compact('units'));
    }

}
