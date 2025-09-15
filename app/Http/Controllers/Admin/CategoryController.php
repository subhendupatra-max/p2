<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use App\Traits\CommonFunction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use App\Models\Menu;
use App\Models\Unit;
use Spatie\Activitylog\Facades\Activity;
use Illuminate\Support\Facades\Auth;

class CategoryController extends BaseController
{
    use CommonFunction;
    use UploadAble;
    public function index(Request $request)
    {
        $details = Category::latest()->get();
        return view('admin.category.index', compact('details'));
    }
    public function add(Request $request)
    {
        if ($request->post()) {
            $id = $request->id ?? NULL;
            if (!empty($id)) {
                $request->validate([
                    'title_en' => 'required|string',
                    'title_hi' => 'required|string',
                    'otp' => 'required', 'digits:6',
                    'captcha'  => 'required'
                ]);
                $message = "Category Updated Successfully";
            } else {
                $request->validate([
                    'title_en' => 'required|string',
                    'title_hi' => 'required|string',
                    'otp' => 'required', 'digits:6',
                    'captcha'  => 'required'
                ]);
                $message = "Category Created Successfully";
            }

            DB::beginTransaction();
            try {
                $otp = $request->otp;
                $response =$this->verifyOTP($otp);
                if(!$response['status']){
                    return $response;
                }
                $postData = [
                    'title_en' =>  $request->title_en,
                    'title_hi' =>  $request->title_hi,
                ];
                $details = Category::updateOrCreate(['id' => $id], $postData);

                if ($id == null) {
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log('Category Created, ID: ' . $details->id);
                    // Log Activity
                }else{
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log('Category Updated, ID: ' . $id);
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
            $data = ['status' => true, 'message' => $message, 'data' => $details ?? null, 'url' => route('admin.category.list')];
            return response($data);
        }
        $details = array();
        if (!empty($request->uuid)) {
            $uuid = uuidtoid($request->uuid, 'categories');
            $details = Category::find($uuid);
        }
        return view('admin.category.add', compact('details'));
    }
}
