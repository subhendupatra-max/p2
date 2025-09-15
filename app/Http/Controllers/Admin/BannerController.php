<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use App\Traits\CommonFunction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Facades\Activity;

class BannerController extends BaseController
{
    use CommonFunction;
    use UploadAble;
    public function index(Request $request)
    {
        if(auth()->user()->can('specific-unit')){
            $details = Banner::where('unit_id',auth()->user()->unit_id)->orderBy('possition', 'asc')->get();
        }else{
            $details = Banner::orderBy('possition', 'asc')->get();
        }

        return view('admin.banner.index', compact('details'));
    }
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $id = $request->id ?? null;

            $rules = [
                // 'title_en' => 'nullable|string|max:255',
                // 'title_hi' => 'nullable|string|max:255',
                // 'description_en' => 'nullable|string|min:10|max:2000',
                // 'description_hi' => 'nullable|string|min:10|max:2000',
                'publish_date' => 'required|date',
                'expire_date' => 'nullable|date',
                'unit_id' => 'required|exists:units,id',
                'menu_id' => 'required|exists:menus,id',
                'otp' => 'required|digits:6',
                'captcha'  => 'required'
            ];

            if ($id) {
                // On update, file is optional
                $message = "Banner Updated Successfully";
                $rules['file'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120';
            } else {
                // On create, file is required
                $message = "Banner Created Successfully";
                $rules['file'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120';
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
                    // "title_en" => $request->title_en,
                    // "title_hi" => $request->title_hi,
                    // "description_en" => $request->description_en,
                    // "description_hi" => $request->description_hi,
                    "publish_date" => $request->publish_date,
                    "expire_date" => $request->expire_date,
                    "unit_id" => $request->unit_id,
                    "menu_id" => $request->menu_id,
                ];

                if ($id == null) {
                    $postData["possition"] = (Banner::max('possition') + 1);
                }



                if ($request->hasFile('file')) {
                    $image = $request->file('file');
                    $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                    $isFileUploaded = $this->uploadOne($image, config('constants.SITE_BANNER_UPLOAD_PATH'), $fileName, 'public');
                    if ($isFileUploaded) {
                        $postData['file'] = $fileName;
                    }
                }

                $details = Banner::updateOrCreate(['id' => $id], $postData);
                 if ($id == null) {
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log('Banner Created, ID: ' . $details->id);
                    // Log Activity
                }else{
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log('Banner Updated, ID: ' . $id);
                    // Log Activity
                }

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                $status = false;
                $code = 500;
                $response = ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()];
                $message = config('constants.CATCH_ERROR_MSG');
                return $this->responseJson($status, $code, $message, $response);
            }
            $data = ['status' => true, 'message' => $message, 'data' => $details ?? null, 'url' => route('admin.banner.list')];
            return response($data);
        }

        $details = [];
        if (!empty($request->uuid)) {
            $uuid = uuidtoid($request->uuid, 'banners');
            $details = Banner::find($uuid);
        }
        if(auth()->user()->unit_id != null){
            $units = \App\Models\Unit::where('id',auth()->user()->unit_id)->where('is_active', 1)->get();
        }else{
            $units = \App\Models\Unit::where('is_active', 1)->get();
        }
        return view('admin.banner.add', compact('details','units'));
    }

    public function order(Request $request)
    {
        if ($request->post()) {
            DB::beginTransaction();
            try {

                foreach ($request->order as $key => $value) {
                    Banner::where('id', $value)->update(['possition' => $key + 1]);
                }

                // Log Activity
                activity()
                    ->causedBy(Auth::user())
                    ->withProperties(['ip_address' => request()->ip()])
                    ->log('Banner Order Updated');
                // Log Activity

                DB::Commit();
            } catch (\Throwable $th) {
                DB::rollback();
                $status = false;
                $code = 500;
                $response = $th->getMessage();
                $message = config('constants.CATCH_ERROR_MSG');
                return $this->responseJson($status, $code, $message, $response);
            }
            $data = ['status' => true, 'message' => '', 'data' => $details ?? null, 'url' => route('admin.banner.list')];
            return response($data);
        }
    }
}
