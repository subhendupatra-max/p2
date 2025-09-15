<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Unit;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use App\Traits\CommonFunction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\Role;
use App\Models\Permission;
use App\Models\UserPasswordList;
use Spatie\Activitylog\Facades\Activity;
use Illuminate\Support\Facades\Auth;
class UserController extends BaseController
{
    use CommonFunction;
    use UploadAble;
    public function userList(Request $request)
    {
        if(auth()->user()->can('specific-unit')){
            $details = User::where('unit_id', auth()->user()->unit_id)->latest()->get();
        }else{
             $details = User::whereNotIn('user_type', [1])->latest()->get();
        }
        return view('admin.user.index', compact('details'));
    }

    public function userAdd(Request $request)
    {
        $user = array();
        if ($request->post()) {
            $id = $request->id ?? NULL;
            $commonRules = [
                'role_id' => 'required|exists:roles,uuid',
                'name' => 'required|string|min:3|max:100|regex:/^[a-zA-Z\s]+$/',
                'email' => 'required|email:rfc,dns|max:255',
                'mobile_number' => 'required|numeric|digits:10',
                'file' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
                'unit_id' => 'nullable|exists:units,id',
                'otp' => 'required', 'digits:6',
                'designation_id' => 'nullable|exists:designations,id',
                // 'captcha'  => 'required'
            ];

            if (!empty($id)) {
                $request->validate(array_merge($commonRules, [
                    'email' => 'required|email:rfc,dns|max:255|unique:users,email,' . $id,
                    'mobile_number' => 'required|numeric|digits:10|unique:users,mobile_number,' . $id,
                ]));
                $message = "User Updated Successfully";
            } else {
                $request->validate(array_merge($commonRules, [
                    'email' => 'required|email:rfc,dns|max:255|unique:users,email',
                    'mobile_number' => 'required|numeric|digits:10|unique:users,mobile_number',
                ]));
                $message = "User Created Successfully";
            }

            DB::beginTransaction();
            try {

                $otp = $request->otp;
                $response =$this->verifyOTP($otp);
                if(!$response['status']){
                    return $response;
                }


                // $password = Str::random(8);
                $password = 'Ddpdoo@2025';
                $roleData = Role::where('uuid', $request->role_id)->first();
                $postData = [
                    "name" => $request->name,
                    'username' => $request->username,
                    "mobile_number" => $request->mobile_number,
                    "email" => $request->email,
                    // "gender" => $request->gender,
                    'user_type' => $roleData->id,
                    'is_approve' => 1,
                    'is_verified' => 1,
                    'designation_id' => $request->designation_id,
                    'unit_id' => $request->unit_id,
                ];

                if(empty($id)){
                    $postData['password'] = bcrypt($password);
                }

                if (!empty($request->file)) {
                    $image = $request->file;
                    $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                    $isFileUploaded = $this->uploadOne($image, config('constants.SITE_PROFILE_IMAGE_UPLOAD_PATH'), $fileName, 'public');
                    if ($isFileUploaded) {
                        $postData['profile_image'] = $fileName;
                    }
                }
                $user = User::updateOrCreate(['id' => $id], $postData);

                if(empty($id)){
                    UserPasswordList::create([
                        'user_id' => $user->id,
                        'password' => bcrypt($password),
                    ]);;
                }

                //role permission add

                $user->roles()->sync($roleData);
                $permissions = Permission::whereHas('roles', function ($q) use ($roleData) {
                    $q->where('slug', $roleData->slug);
                })->get();
                $user->permissions()->sync($permissions);
                //role permission add
                // if (empty($id)) {
                    // Send email only on user creation
                    $mailData = [
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => $password,
                        'link' => route('admin.login')
                    ];
                    // Mail::send('emails.new_user_credentials', $mailData, function ($message) use ($request) {
                    //     $message->to($request->email)
                    //             ->subject('Your Login Credentials');
                    // });
                // }
                if ($id == null) {
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log('User Created, ID: ' . $user->id);
                    // Log Activity
                }else{
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log('User Updated, ID: ' . $id);
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

            $data = ['status' => true, 'message' => $message, 'data' => $user, 'url' => route('admin.user.list')];
            return response($data);
        }

        $details = array();
        if (!empty($request->uuid)) {
            $uuid = uuidtoid($request->uuid, 'users');
            $details = User::find($uuid);
        }
        $designations = \App\Models\Designation::where('is_active','1')->get();
        if(auth()->user()->unit_id != null){
            $roles = Role::whereIn('slug',['hi-content-writter','content-reviewer','content-approver','en-content-writter','hindi-content-approver','hindi-content-reviewer'])->get();
            $units = Unit::where('is_active','1')->where('id',auth()->user()->unit_id)->get();
        }else{
            $roles = Role::whereNot('slug','super-admin')->get();
            $units = Unit::where('is_active','1')->get();
        }

        return view('admin.user.add', compact('details','designations','roles','units'));
    }
}
