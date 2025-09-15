<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use App\Traits\CommonFunction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends BaseController
{
    use CommonFunction;
    use UploadAble;
    public function index(Request $request)
    {
        $details = Testimonial::orderBy('possition','asc')->get();
        return view('admin.testimonial.index', compact('details'));
    }
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $id = $request->id ?? null;

            $rules = [
                'title_en' => 'required|string|min:3|max:255|regex:/^[A-Za-z0-9\s\-\_\,\.\!\?]+$/u',
                'title_hi' => 'required|string|min:3|max:255',
                'description_en' => 'nullable|string|min:10|max:2000',
                'description_hi' => 'nullable|string|min:10|max:2000',
                // 'otp' => 'required', 'digits:6',
                // 'token' => 'required',
                // 'action' => 'required|string',
            ];

            if ($id) {
                // On update, file is optional
                $message = "Testimonial Updated Successfully";
                $rules['file'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120';
            } else {
                // On create, file is required
                $message = "Testimonial Created Successfully";
                $rules['file'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120';
            }

        $validated = $request->validate($rules);

        // if (!$this->verifyRecaptcha($request, 'login')) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'reCAPTCHA verification failed. Please refresh and try again.',
        //         'data' => null
        //     ]);
        // }

            DB::beginTransaction();
            try {

                // $otp = $request->otp;
                // $response =$this->verifyOTP($otp);

                // if(!$response['status']){
                //     return $response;
                // }

                $postData = [
                    "title_en" => $request->title_en,
                    "title_hi" => $request->title_hi,
                    "description_en" => $request->description_en,
                    "description_hi" => $request->description_hi,
                ];

                if($id == null){
                    $postData["possition"] = (Testimonial::max('possition') + 1);
                }

                if ($request->hasFile('file')) {
                    $image = $request->file('file');
                    $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                    $isFileUploaded = $this->uploadOne($image, config('constants.SITE_TESTIMONIAL_UPLOAD_PATH'), $fileName, 'public');
                    if ($isFileUploaded) {
                        $postData['file'] = $fileName;
                    }
                }

                $details = Testimonial::updateOrCreate(['id' => $id], $postData);
                  if ($id == null) {
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log('Testimonial Created, ID: ' . $details->id);
                    // Log Activity
                }else{
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log('Testimonial Updated, ID: ' . $id);
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
            $data = ['status' => true, 'message' => $message, 'data' => $details ?? null, 'url' => route('admin.testimonial.list')];
            return response($data);
        }

        $details = [];
        if (!empty($request->uuid)) {
            $uuid = uuidtoid($request->uuid, 'testimonials');
            $details = Testimonial::find($uuid);
        }
        return view('admin.testimonial.add', compact('details'));
    }

    public function order(Request $request)
    {
        if ($request->post()) {
            DB::beginTransaction();
            try {

                foreach($request->order as $key => $value) {
                     Testimonial::where('id', $value)->update(['possition' => $key+1]);
                }

                // Log Activity
                activity()
                    ->causedBy(Auth::user())
                    ->withProperties(['ip_address' => request()->ip()])
                    ->log('Testimonial Order Updated');
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
            $data = ['status' => true, 'message' => '', 'data' => $details ?? null, 'url' => route('admin.testimonial.list')];
            return response($data);
        }
    }
}
