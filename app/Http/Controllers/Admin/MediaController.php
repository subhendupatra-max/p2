<?php

namespace App\Http\Controllers\Admin;

use App\Models\Media;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use App\Models\MediaImage;
use App\Traits\CommonFunction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use App\Models\Unit;
use App\Models\Designation;
use Illuminate\Support\Facades\Auth;

class MediaController extends BaseController
{
    use CommonFunction;
    use UploadAble;
    public function index(Request $request)
    {
        if(auth()->user()->can('specific-unit')){
            $details = Media::where('unit_id',auth()->user()->unit_id)->latest()->get();
        }else{
            $details = Media::latest()->get();
        }

        return view('admin.media.index', compact('details'));
    }
    public function add(Request $request)
    {
        if ($request->post()) {
            $id = $request->id ?? NULL;
            $rules = [
                'title_en' => 'required|string|max:255',
                'title_hi' => 'required|string|max:255',
                'menu_id' => 'required|exists:menus,id',
                'unit_id' => 'required|exists:units,id',
                'youtube_link' => 'nullable|string',
                'otp' => 'required', 'digits:6',
                'captcha'  => 'required'
            ];

            if ($id) {
                // On update, file is optional
                $message = "Media Updated Successfully";
                $rules['file.*'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg';
            } else {
                // On create, file is required
                $message = "Media Created Successfully";
                $rules['file.*'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg';
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
                    'title_en' => $request->title_en,
                    'title_hi' => $request->title_hi,
                    'unit_id' => $request->unit_id,
                    'menu_id' => $request->menu_id,
                    'youtube_link' => $request->youtube_link
                ];
                $details = Media::updateOrCreate(['id' => $id], $postData);

                if (!empty($request->remove_image)) {
                    $remove_image = json_decode($request->remove_image);
                    MediaImage::whereIn('id', $remove_image)->delete();
                }

                if (!empty($request->file)) {
                    if (!empty($request->remove_image)) {
                        MediaImage::where('media_id', $details->id)->whereIn('id', $request->remove_image)->delete();
                    }
                    foreach ($request->file as $key => $val) {
                        $image = $val;
                        $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                        $isFileUploaded = $this->uploadOne($image, config('constants.SITE_MEDIA_UPLOAD_PATH'), $fileName, 'public');
                        if ($isFileUploaded) {
                            MediaImage::create([
                                'media_id' => $details->id,
                                'file' => $fileName,
                            ]);
                        }
                    }
                }
                  if ($id == null) {
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log('Media Created, ID: ' . $details->id);
                    // Log Activity
                }else{
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log('Media Updated, ID: ' . $id);
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
            $data = ['status' => true, 'message' => $message, 'data' => $details ?? null, 'url' => route('admin.media.list')];
            return response($data);
        }
        $details = array();
        if (!empty($request->uuid)) {
            $uuid = uuidtoid($request->uuid, 'media');
            $details = Media::find($uuid);
        }
        if(auth()->user()->unit_id != null){
            $units = Unit::where('id',auth()->user()->unit_id)->where('is_active',1)->get();
        }else{
            $units = Unit::where('is_active',1)->get();
        }

        return view('admin.media.add', compact('details','units'));
    }
}
