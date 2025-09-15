<?php

namespace App\Http\Controllers\Admin;

use App\Models\AiprMaster;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use App\Traits\CommonFunction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Facades\Activity;

class AiprMasterController extends BaseController
{
    use CommonFunction;
    use UploadAble;
    public function index(Request $request)
    {
        if(auth()->user()->can('specific-unit')){
            $details_active = AiprMaster::where('unit_id',auth()->user()->unit_id)->where('is_active',1)->latest()->get();
        }else{
            $details_active = AiprMaster::where('is_active',1)->latest()->get();
        }
        return view('admin.aipr_master.index', compact('details_active'));
    }
    public function add(Request $request)
    {
        if ($request->post()) {
            $id = $request->id ?? NULL;
            $rules = [
                'name' => 'required',
                'pno' => 'required',
                'grade' => 'required',
                'year' => 'required',
                'unit_id' => 'required|exists:units,id',
                'menu_id' => 'required|exists:menus,id',
                'otp' => 'required|digits:6',
                'captcha'  => 'required'
            ];

            $messages = [
                'name.required' => 'Name is required',
                'pno.required' => 'Pno is required',
                'grade.required' => 'Grade is required',
                'otp.required' => 'OTP is required',
                'otp.digits' => 'OTP must be 6 digits',
                'captcha.required' => 'Captcha is required',

            ];

            if ($id) {
                // On update, file is optional
                $message = "AIPR Updated Successfully";
                $rules['file'] = 'nullable|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf,csv,xls,xlsx|max:5120';
            } else {
                // On create, file is required
                $message = "AIPR Created Successfully";
                $rules['file'] = 'required|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf,csv,xls,xlsx|max:5120';
            }

            $validated = $request->validate($rules,$messages);

            DB::beginTransaction();
            try {
                $otp = $request->otp;
                $response =$this->verifyOTP($otp);
                if(!$response['status']){
                    return $response;
                }
                $postData = [
                    "name" => $request->name,
                    "pno" => $request->pno,
                    "year" => $request->year,
                    "grade" => $request->grade,
                    'unit_id' => $request->unit_id,
                    'menu_id' => $request->menu_id
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
                    $isFileUploaded = $this->uploadOne($image, config('constants.SITE_AIPR_UPLOAD_PATH'), $fileName, 'public');
                    if ($isFileUploaded) {
                        $postData['file'] = $fileName;
                        $postData['file_size'] = $fileSize;
                        $postData['file_type'] = $fileType;
                    }
                }
                $details = AiprMaster::updateOrCreate(['id' => $id], $postData);
                if ($id == null) {
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log('AiprMaster Created, ID: ' . $details->id);
                    // Log Activity
                }else{
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log('AiprMaster Updated, ID: ' . $id);
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
            $data = ['status' => true, 'message' => $message, 'data' => $details ?? null, 'url' => route('admin.aipr-master.list')];
            return response($data);
        }
        $details = array();
        if (!empty($request->uuid)) {
            $uuid = uuidtoid($request->uuid, 'aipr_masters');
            $details = AiprMaster::find($uuid);
        }
         if(auth()->user()->unit_id != null){
            $units = Unit::where('id',auth()->user()->unit_id)->where('is_active',1)->get();
         }else{
            $units = Unit::where('is_active',1)->get();
         }
        return view('admin.aipr_master.add', compact('details','units'));
    }
}

