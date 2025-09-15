<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use App\Traits\CommonFunction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use Auth;

class SettingController extends BaseController
{
    use CommonFunction;
    use UploadAble;

    public function index(){
        if(auth()->user()->can('specific-unit')){
            $details = Setting::where('unit_id',auth()->user()->unit_id)->get();
        }else{
            $details = Setting::latest()->get();
        }
        return view('admin.setting.index', compact('details'));
    }


    public function add(Request $request)
    {
        if ($request->post()) {
            $validated = $request->validate([
                'instagram'      => ['nullable'],
                'facebook'       => ['nullable'],
                'twitter'        => ['nullable'],
                'linkedin'       => ['nullable'],
                'youtube'  => ['nullable'],
                'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'file2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'file3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'footer_file1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'footer_file2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'otp' => 'required', 'digits:6',
                'captcha'  => 'required'
            ],[
                'otp.required' => 'OTP is required',
                'otp.digits' => 'OTP must be 6 digits',
                'captcha.required' => 'Captcha is required',

            ]);
            $message = "Settings Updated Successfully";


            DB::beginTransaction();
            try {
                $id = $request->id;
                $otp = $request->otp;
                $response =$this->verifyOTP($otp);
                if(!$response['status']){
                    return $response;
                }
                $postData = array();

                if (!empty($request->instagram)) {
                    $postData['instagram'] = $request->instagram;
                }
                if (!empty($request->facebook)) {
                    $postData['facebook'] = $request->facebook;
                }
                if (!empty($request->twitter)) {
                    $postData['twitter'] = $request->twitter;
                }
                if (!empty($request->linkedin)) {
                    $postData['linkedin'] = $request->linkedin;
                }
                if (!empty($request->youtube)) {
                    $postData['youtube'] = $request->youtube;
                }
                if (!empty($request->description_en)) {
                    $postData['desctiption_en'] = $request->description_en;
                }
                if (!empty($request->description_hi)) {
                    $postData['desctiption_hi'] = $request->description_hi;
                }

                if (!empty($request->location)) {
                    $postData['location'] = $request->location;
                }

                 if (!empty($request->file1)) {
                    $image = $request->file1;
                    $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                    $isFileUploaded = $this->uploadOne($image, config('constants.SITE_SETTING_UPLOAD_PATH'), $fileName, 'public');
                    if ($isFileUploaded) {
                        $postData['file1'] = $fileName;
                    }
                }
                if (!empty($request->file2)) {
                    $image = $request->file2;
                    $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                    $isFileUploaded = $this->uploadOne($image, config('constants.SITE_SETTING_UPLOAD_PATH'), $fileName, 'public');
                    if ($isFileUploaded) {
                        $postData['file2'] = $fileName;
                    }
                }
                if (!empty($request->file3)) {
                    $image = $request->file3;
                    $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                    $isFileUploaded = $this->uploadOne($image, config('constants.SITE_SETTING_UPLOAD_PATH'), $fileName, 'public');
                    if ($isFileUploaded) {
                        $postData['file3'] = $fileName;
                    }
                }

                if (!empty($request->footer_file1)) {
                    $image = $request->footer_file1;
                    $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                    $isFileUploaded = $this->uploadOne($image, config('constants.SITE_SETTING_UPLOAD_PATH'), $fileName, 'public');
                    if ($isFileUploaded) {
                        $postData['footer_file1'] = $fileName;
                    }
                }
                if (!empty($request->footer_file2)) {
                    $image = $request->footer_file2;
                    $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                    $isFileUploaded = $this->uploadOne($image, config('constants.SITE_SETTING_UPLOAD_PATH'), $fileName, 'public');
                    if ($isFileUploaded) {
                        $postData['footer_file2'] = $fileName;
                    }
                }

                if($id != null){
                    $postData['updated_by'] = Auth::user()->id;
                }else{
                    $postData['created_by'] = Auth::user()->id;
                }


                $details = Setting::updateOrCreate(['id' => $id], $postData);

                // Log Activity
                activity()
                    ->causedBy(Auth::user())
                    ->withProperties(['ip_address' => request()->ip()])
                    ->log('Website Setting Updated');

                DB::Commit();
            } catch (\Throwable $th) {
                DB::rollback();
                $status = false;
                $code = 500;
                $response = ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()];
                $message = config('constants.CATCH_ERROR_MSG');
                return $this->responseJson($status, $code, $message, $response);
            }
            $data = ['status' => true, 'message' => $message, 'data' => $details ?? null, 'url' => route('admin.setting.index')];
            return response($data);
        }

        $details = Setting::find(base64_decode($request->id));
        // $units = \App\Models\Unit::where('is_active', 1)->whereNot('slug','main')->get();
        // dd( $details );
        return view('admin.setting.add', compact('details'));
    }
}
