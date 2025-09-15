<?php

namespace App\Http\Controllers\Admin;

use App\Models\Designation;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use App\Traits\CommonFunction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DesignationController extends BaseController
{
    use CommonFunction;
    use UploadAble;
    public function index(Request $request)
    {
        $details = Designation::latest()->get();
        return view('admin.designation.index', compact('details'));
    }
    public function add(Request $request)
    {
        if ($request->post()) {
            $id = $request->id ?? NULL;
            $rules = [
                'title_en' => 'required|string|max:255',
                'title_hi' => 'required|string|max:255',
                               'otp' => 'required', 'digits:6',
                    'captcha'  => 'required'
            ];

            if ($id) {
                $message = "Designation Updated Successfully";
            } else {
                $message = "Designation Created Successfully";
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
                    "title_en" => $request->title_en,
                    "title_hi" => $request->title_hi,
                ];

                $details = Designation::updateOrCreate(['id' => $id], $postData);
                  if ($id == null) {
                    // Log Activity
                    activity()
                    ->causedBy(Auth::user())
                    ->withProperties(['ip_address' => request()->ip()])
                    ->log('Designation Created, ID: ' . $details->id);
                    // Log Activity
                }else{
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log('Designation Updated, ID: ' . $id);
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
            $data = ['status' => true, 'message' => $message, 'data' => $details ?? null, 'url' => route('admin.designation.list')];
            return response($data);
        }
        $details = array();
        if (!empty($request->uuid)) {
            $uuid = uuidtoid($request->uuid, 'designations');
            $details = Designation::find($uuid);
        }
        return view('admin.designation.add', compact('details'));
    }

}
