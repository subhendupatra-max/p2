<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use App\Traits\CommonFunction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use App\Models\Unit;
use App\Models\Hod;
USE Auth;

class HodController extends BaseController
{
    use CommonFunction;
    use UploadAble;
    public function index(Request $request)
    {
        if(auth()->user()->can('specific-unit')){
            $details = Hod::with('unit')->where('unit_id',auth()->user()->unit_id)->latest()->get();
        }else{
            $details = Hod::with('unit')->latest()->get();
        }

        return view('admin.hod.index', compact('details'));
    }
    public function add(Request $request)
    {
        if ($request->post()) {
            $id = $request->id ?? NULL;
            $rules = [
                'hod_name_en' => 'required',
                'designation_en' => 'required',
                'hod_name_hi' => 'required',
                'designation_hi' => 'required',
                'from_date' => 'required',
                'unit_id' => 'required',
                'from_date' => 'required',
                'otp' => 'required', 'digits:6',
                'captcha'  => 'required'

            ];

            $messages = [
                'from_date.required' => 'From Date is required.',
                'unit_id.required' => 'Unit is required.',
                'otp.required' => 'OTP is required',
                'otp.digits' => 'OTP must be 6 digits',
                'captcha.required' => 'Captcha is required',

            ];

            if ($id) {
                // On update, file is optional
                $message = "HOD Updated Successfully";
                $rules['file'] = 'nullable|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf,csv,xls,xlsx|max:5120';
            } else {
                // On create, file is required
                $message = "HOD Created Successfully";
                $rules['file'] = 'required|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf,csv,xls,xlsx|max:5120';
            }

            $validated = $request->validate($rules, $messages);

            DB::beginTransaction();
            try {
                $otp = $request->otp;
                $response =$this->verifyOTP($otp);
                if(!$response['status']){
                    return $response;
                }
                $postData = [
                    'hod_name_en' => $request->hod_name_en,
                    'designation_en' => $request->designation_en,
                    'hod_name_hi' => $request->hod_name_hi,
                    'designation_hi' => $request->designation_hi,
                    'from_date' => $request->from_date,
                    'to_date' => $request->to_date,
                    'unit_id' => $request->unit_id,
                    'from_date' => $request->from_date,
                    'to_date' => $request->to_date,
                ];
                 if (!empty($request->file)) {
                    $image = $request->file('file');
                    $fileSize = $image->getSize();

                    $fileSize = $fileSize / 1024;
                    $fileSize = number_format((float)$fileSize, 2, '.', '');
                    if($fileSize > 1024){
                        $fileSize = $fileSize / 1024 .'MB';
                    }else{
                        $fileSize = $fileSize .'KB';
                    }

                    $fileType = $image->getMimeType();
                    $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                    $isFileUploaded = $this->uploadOne($image, config('constants.SITE_HOD_UPLOAD_PATH'), $fileName, 'public');
                    if ($isFileUploaded) {
                        $postData['file'] = $fileName;
                    }
                }
                if ($id != null) {
                    $postData['updated_by'] = Auth::user()->id;
                } else {
                    $postData['created_by'] = Auth::user()->id;
                }
                $details = Hod::updateOrCreate(['id' => $id], $postData);
                if ($id == null) {
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log('Hod Created, ID: ' . $details->id);
                    // Log Activity
                }else{
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log('Hod Updated, ID: ' . $id);
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
            $data = ['status' => true, 'message' => $message, 'data' => $details ?? null, 'url' => route('admin.hod.list')];
            return response($data);
        }
        $details = array();

        if (!empty($request->uuid)) {
            $uuid = uuidtoid($request->uuid, 'hods');
            $details = Hod::find($uuid);
        }
         if(auth()->user()->unit_id != null){
            $units = Unit::where('id',auth()->user()->unit_id)->where('is_active',1)->get();
         }else{
              $units = Unit::where('is_active',1)->get();
         }
        return view('admin.hod.add', compact('details','units'));
    }
}
