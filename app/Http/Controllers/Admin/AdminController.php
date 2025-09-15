<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use App\Models\Unit;
use App\Models\Cms;
use App\Models\ActivityLog;
use App\Models\UserBusiness;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;
use App\Models\UserPasswordList;
use Spatie\Activitylog\Facades\Activity;

class AdminController extends BaseController
{
    use UploadAble;
    public function dashboard()
    {
        if(auth()->user()->can('specific-unit')){
            $total_user = User::where('is_active',1)->where('unit_id',Auth::user()->unit_id)->count();
            $total_unit = Unit::where('is_active',1)->count() - 1;
            $total_approvers = User::where('unit_id',auth()->user()->unit_id)->whereHas('roles', function ($query) { $query->where('slug', 'content-approver'); })->where('is_active',1)->count();
            $total_reviewers = User::where('unit_id',auth()->user()->unit_id)->whereHas('roles', function ($query) { $query->where('slug', 'content-reviewer'); })->where('is_active',1)->count();
            $total_unit_admin = User::where('unit_id',auth()->user()->unit_id)->whereHas('roles', function ($query) { $query->where('slug', 'unit-wise-admin-user'); })->where('is_active',1)->count();
        }
        else{
            $total_user = User::where('is_active',1)->count();
            $total_unit = Unit::where('is_active',1)->count() - 1;
            $total_approvers = User::whereHas('roles', function ($query) { $query->where('slug', 'content-approver'); })->where('is_active',1)->count();
            $total_reviewers = User::whereHas('roles', function ($query) { $query->where('slug', 'content-reviewer'); })->where('is_active',1)->count();
            $total_unit_admin = User::whereHas('roles', function ($query) { $query->where('slug', 'unit-wise-admin-user'); })->where('is_active',1)->count();
        }
        $cmsData = Cms::where('need_content_writter','yes')->orderBy('id','DESC')->where('is_active',1)->get();
        return view('admin.dashboard',compact('total_user','total_unit','total_reviewers','total_unit_admin','total_approvers','cmsData'));
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'admin_name' => 'required|string|min:3|max:100|regex:/^[a-zA-Z\s]+$/',
            'admin_profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);
        if ($request->post()) {
            // dd($request->all());
            $postData = [
                "name" => $request->admin_name,
            ];
            if (!empty($request->admin_profile_image)) {
                $image = $request->admin_profile_image;
                $type = $image->getClientOriginalExtension();
                $fileName = uniqid() . '.' . $type;
                $isFileUploaded = $this->uploadOne($image, config('constants.SITE_PROFILE_IMAGE_UPLOAD_PATH'), $fileName, 'public');
                if ($isFileUploaded) {
                    $postData['profile_image'] = $fileName;
                }
            }
            $data = User::updateOrCreate(['id' => Auth::user()->id], $postData);

            //---------- Log Maintance Activity Start ----------//
            activity()
            ->causedBy(Auth::user()->id)
            ->withProperties(['ip_address' => request()->ip()])
            ->log( Auth::user()->name.' Update his Profile, Id :' . Auth::user()->name);
            //---------- Log Maintance Activity Start ----------//
        }
        $message = "Updated Successfully";
        $data = ['status' => true, 'message' => $message, 'data' => $postData];
        return response($data);
    }

    public function passwordUpdate(Request $request)
    {
        if ($request->post()) {
            $request->validate([
                'old_password' => 'required|min:8',
                'new_password' => [
                    'required',
                    'min:8',
                    'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'
                ],
                'confirm_password' => 'required|min:8|same:new_password',
            ]);
            $old_pass = Auth::user()->password;
            if (empty($request->old_password)) {
                $hash_old_pass = '';
            } else {
                $hash_old_pass = $request->old_password;
            }
            $check = Hash::check($hash_old_pass, $old_pass);


            $userPasswordcheck = User::newPasswordCheckUniqueFromLast3(Hash::make($request->confirm_password));
            if ($userPasswordcheck) {
                return response([
                    'status' => false,
                    'message' => 'Password already used. Please try another password',
                    'data' => null,
                ]);
            }
            UserPasswordList::create([
                'user_id' => Auth::user()->id,
                'password' => Hash::make($request->confirm_password),
            ]);


            if (empty($request->old_password)) {
                $message = "Provide Old Password";
                $data = ['status' => false, 'message' => $message, 'data' => ''];
            } else if ($check !== true) {
                $message = "Provided Old Password is Wrong";
                $data = ['status' => false, 'message' => $message, 'data' => ''];
            } else if (empty($request->new_password)) {
                $message = "Provide New Password";
                $data = ['status' => false, 'message' => $message, 'data' => ''];
            } else if (empty($request->confirm_password)) {
                $message = "Provide Confirm Password";
                $data = ['status' => false, 'message' => $message, 'data' => ''];
            } else if ($request->confirm_password !== $request->new_password) {
                $message = "New Password & Confirm Password Have to be Same";
                $data = ['status' => false, 'message' => $message, 'data' => ''];
            } else {
                $postData = [
                    "password" => Hash::make($request->confirm_password),
                    "original_password"=>$request->confirm_password
                ];
                $data = User::updateOrCreate(['id' => Auth::user()->id], $postData);

                //---------- Log Maintance Activity Start ----------//
                activity()
                ->causedBy(Auth::user()->id)
                ->withProperties(['ip_address' => request()->ip()])
                ->log( Auth::user()->name.' Update his Password, Id :' . Auth::user()->name);
                //---------- Log Maintance Activity Start ----------//

                $message = "Password Updated Successfully";
                $data = ['status' => true, 'message' => $message, 'data' => $postData];
            }
        }
        return response($data);
    }
    public function activity_log(){
        if(auth()->user()->can('super-admin')){
            $activity_logs = ActivityLog::whereNotNull('causer_id')->orderBy('created_at','desc')->get();
        }else{
            $activity_logs = ActivityLog::whereNotNull('causer_id')->where('causer_id',auth()->user()->id)->orderBy('created_at','desc')->get();
        }

        return view('admin.activity_log.index',compact('activity_logs'));
    }
    public function unit_not_assigned(){
        if(auth()->user()->can('all-unit') || (auth()->user()->can('specific-unit') && auth()->user()->unit_id != null)){
             return redirect()->route('admin.dashboard');
        }else{
            return view('admin.unit_not_assigned');
        }
    }
    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
}
