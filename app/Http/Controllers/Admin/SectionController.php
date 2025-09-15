<?php

namespace App\Http\Controllers\Admin;

use App\Models\Section;
use App\Models\Unit;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use App\Traits\CommonFunction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SectionController extends BaseController
{
    use CommonFunction;
    use UploadAble;
    public function index(Request $request)
    {
        if(auth()->user()->can('specific-unit')){
            $details = Section::where('unit_id',auth()->user()->unit_id)->latest()->get();
        }else{
            $details = Section::latest()->get();
        }
        return view('admin.section.index', compact('details'));
    }
    public function add(Request $request)
    {
        if ($request->post()) {
            $id = $request->id ?? NULL;
            $rules = [
                'title' => 'required|string|min:3|max:255|regex:/^[A-Za-z0-9\s\-\_\,\.\!\?]+$/u',
                'menu_id' => 'required',
                'unit_id' => 'required|exists:units,id',
                               'otp' => 'required', 'digits:6',
                    'captcha'  => 'required'
            ];

            if ($id) {
                $message = "Section Updated Successfully";
            } else {
                $message = "Section Created Successfully";
            }

            $validated = $request->validate($rules);

            DB::beginTransaction();
            try {
                $otp = $request->otp;
                $response =$this->verifyOTP($otp);
                if(!$response['status']){
                    return $response;
                }
                $postData = [
                    "title" => $request->title,
                    "slug" => Str::slug($request->title),
                    "menu_id" => $request->menu_id,
                    "unit_id" => $request->unit_id,
                ];

                $details = Section::updateOrCreate(['id' => $id], $postData);
                  if ($id == null) {
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log('Section Created, ID: ' . $details->id);
                    // Log Activity
                }else{
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log('Section Updated, ID: ' . $id);
                    // Log Activity
                }
                DB::Commit();
            } catch (\Throwable $th) {
                DB::rollback();
                $status = false;
                $code = 500;
                $response = ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()];
                $message = config('constants.CATCH_ERROR_MSG');
                return $this->responseJson($status, $code, $message, $response);
            }
            $data = ['status' => true, 'message' => $message, 'data' => $details ?? null, 'url' => route('admin.section.list')];
            return response($data);
        }
        $details = array();
        if (!empty($request->uuid)) {
            $uuid = uuidtoid($request->uuid, 'sections');
            $details = Section::find($uuid);
        }
        $units  = Unit::where('is_active',1)->get();

        return view('admin.section.add', compact('details','units'));
    }

}
