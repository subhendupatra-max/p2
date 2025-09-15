<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserPost;
use App\Models\Menu;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use App\Traits\CommonFunction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;

class UserPostController extends BaseController
{
    use CommonFunction;
    use UploadAble;
    public function index(Request $request)
    {
        $details = UserPost::latest()->get();
        return view('admin.user_post.index', compact('details'));
    }
    public function add(Request $request)
    {
        if ($request->post()) {
            $id = $request->id ?? NULL;
            $rules = [
                'title_en' => 'required|string|min:3|max:255|regex:/^[A-Za-z0-9\s\-\_\,\.\!\?]+$/u',
                'title_hi' => 'required|string|min:3|max:255',
                'menu_id' => 'required',
                'otp' => 'required', 'digits:6',
                'token' => 'required',
                'action' => 'required|string'
            ];

            if ($id) {
                $message = "UserPost Updated Successfully";
            } else {
                $message = "UserPost Created Successfully";
            }

            $validated = $request->validate($rules);
            if (!$this->verifyRecaptcha($request, 'login')) {
                return response()->json([
                    'status' => false,
                    'message' => 'reCAPTCHA verification failed. Please refresh and try again.',
                    'data' => null
                ]);
            }
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
                    "menu_id" => $request->menu_id,
                ];

                $details = UserPost::updateOrCreate(['id' => $id], $postData);
                  if ($id == null) {
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log('UserPost Created, ID: ' . $details->id);
                    // Log Activity
                }else{
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log('UserPost Updated, ID: ' . $id);
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
            $data = ['status' => true, 'message' => $message, 'data' => $details ?? null, 'url' => route('admin.user-post.list')];
            return response($data);
        }
        $details = array();
        if (!empty($request->uuid)) {
            $uuid = uuidtoid($request->uuid, 'user_posts');
            $details = UserPost::find($uuid);
        }
        $menus  = Menu::where('is_active',1)->get();
        return view('admin.user_post.add', compact('details','menus'));
    }

}
