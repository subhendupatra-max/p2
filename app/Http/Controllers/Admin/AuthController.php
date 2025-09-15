<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\BaseController;
use App\Models\UserPasswordList;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Facades\Activity;
use Illuminate\Support\Facades\Hash;


class AuthController extends BaseController
{
    protected function authenticated(Request $request, $user)
    {
        // Get current session ID
        $currentSessionId = Session::getId();

        // Delete all other sessions for this user
        DB::table('sessions')
            ->where('user_id', $user->id)
            ->where('id', '!=', $currentSessionId)
            ->delete();
    }
    public function login(Request $request)
    {
        if ($request->post()) {
            $request->validate([
                'email' => 'required|email:rfc,dns|exists:users,email',
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'regex:/[a-z]/',      // at least one lowercase letter
                    'regex:/[A-Z]/',      // at least one uppercase letter
                    'regex:/[0-9]/',      // at least one digit
                    'regex:/[@$!%*#?&]/', // at least one special character
                ],
                // 'captcha'  => 'required' // <-- captcha validation
                // ], [
                //     'captcha.captcha' => 'Invalid captcha code.' // custom error
                ]);


            $user_status = User::where('email', $request->email)->where('is_active', 1)->first();

            if (!$user_status || !\Hash::check($request->password, $user_status->password)) {
                $data = [
                    'status' => false,
                    'message' => 'Incorrect Details or Account is Inactive. Please try again',
                    'data' => null,
                    'url' => route('admin.login')
                ];
                return response($data);
            } else {
                $otp = rand(100000, 999999);
                $user_status->update(['verification_code' => $otp, 'varification_otp_time' => now(), 'no_of_attempted' => 3]);

                // Dispatch the email sending job
                // dispatch(new \App\Jobs\SendOtpEmailForLogin($request->email, $otp));

                $data = [
                    'status' => true,
                    'message' => 'Otp has been sent to your registered Email & mobile no',
                    'data' => null,
                    'url' => route('admin.otp-verification', ['email' => base64_encode($request->email)])
                ];
            }

            return response($data);
        }
        return view('auth.login');
    }


    // public function otp_login(Request $request)
    // {
    //     if ($request->post()) {
    //         $request->validate([
    //             'mobile_no' => 'required|regex:/^\d{10}$/|exists:users,mobile_number',
    //             'g-recaptcha-response' => 'required|captcha',
    //         ]);

    //         $user_exists = User::where('mobile_number', $request->mobile_no)->first();

    //         if($user_exists->is_active == 0){
    //             $data = ['status' => false, 'message' => 'You are deactived/blocked, Contact to Admin', 'data' => null, 'url' => route('admin.otp-login')];
    //         }else{
    //             if($user_exists){
    //                 $user_exists->update(['verification_code' => rand(1000, 9999), 'varification_otp_time' => now()]);
    //                 $data = ['status' => true, 'message' => 'Otp has been sent', 'data' => null, 'url' => route('admin.otp-verification', ['mobile_no' => $request->mobile_no])];
    //             }else{
    //                 $data = ['status' => false, 'message' => 'Enter a valid mobile number', 'data' => null, 'url' => route('admin.otp-login')];
    //             }
    //         }

    //         return response($data);
    //     }
    //     return view('auth.login-using-otp');
    // }

    public function otp_verification(Request $request)
    {
        if ($request->post()) {

            $request->validate([
                'otp' => 'required|digits:6',
                'email' => 'required',
                // 'captcha'  => 'required' // <-- captcha validation
                // ], [
                //     'captcha.captcha' => 'Invalid captcha code.' // custom error
                ]);
            $email = base64_decode($request->email);
            $user = User::where('email', $email)
                ->first();
            if (!$user) {
                $data = ['status' => false, 'message' => 'You email not valid', 'data' => null];
                return response($data);
            }

            $check_time = \Carbon\Carbon::parse($user->varification_otp_time)->addMinute(30);
            if ($user && $user->varification_otp_time && $check_time->isPast()) {
                $data = ['status' => false, 'message' => 'OTP has expired. Please request a new OTP', 'data' => null];
                return response($data);
            }

            if ($user && $user->no_of_attempted <= 0) {
                $data = ['status' => false, 'message' => 'You’ve exceeded the allowed attempts. The OTP is expired. Please request a new one to continue.', 'data' => null, 'url' => route('admin.login')];
                return response($data);
            }

            if ($user && $user->verification_code == $request->otp) {
                Auth::login($user);
                $this->authenticated($request, auth()->user());


                $data = ['status' => true, 'message' => 'You have successfully logged in', 'data' => null, 'url' => route('admin.dashboard')];
                return response($data);
            } else {
                $user->update(['no_of_attempted' => ($user->no_of_attempted - 1)]);
                $data = ['status' => false, 'message' => 'You OTP not valid', 'data' => null];
                return response($data);
            }
        }
        return view('auth.otp-verification');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }

    public function forgotPasswordPage(Request $request)
    {
        return view('auth.forget-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'forgot_email' => 'required|email|exists:users,email',
            // 'captcha'  => 'required' // <-- captcha validation
            // ], [
            //     'captcha.captcha' => 'Invalid captcha code.' // custom error
            ]);

        $user = User::where('email', $request->forgot_email)->first();
        if ($user->is_active == 0) {
            $data = ['status' => false, 'message' => 'You are deactived/blocked, Contact to Admin', 'data' => null];
        } else {
            if (!$user) {
                $data = ['status' => true, 'message' => 'User Not Found', 'data' => null];
            } else {
                $token = Str::random(60);
                $user->update(['remember_token' => $token]);
                $resetLink = route('admin.reset.password', $token);

                Mail::send('mail.reset-password', ['link' => $resetLink], function ($message) use ($request) {
                    $message->to($request->forgot_email);
                    $message->subject('Reset Password Link');
                });
                $data = ['status' => true, 'message' => 'Check your email for resetting your password', 'data' => null];
            }
        }

        return response($data);
    }

 public function resetPassword(Request $request)
{

    $user = User::where('remember_token', $request->token)
                ->where('is_active', 1)
                ->first();


    // Handle expired or invalid token before anything else
    if (!$user) {
        return response([
            'status' => false,
            'message' => 'Reset Password Link Expired or Invalid',
            'data' => null,
            'url' => route('admin.forgot.password.page'),
        ]);
    }

    // Handle POST request (form submission)
    if ($request->isMethod('post')) {

        $request->validate([
            'new_password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
            ],
            'password_confirmation' => 'required|same:new_password|min:8',
            // 'captcha'  => 'required' // <-- captcha validation
            //     ], [
            //         'captcha.captcha' => 'Invalid captcha code.' // custom error
                ]);

        DB::beginTransaction();

        try {

            $emaill = $user->email;
            $id = $user->id;

            $userPasswordcheck = User::newPasswordCheckUniqueFromLast3(Hash::make($request->new_password));

            if ($userPasswordcheck) {
                return response([
                    'status' => false,
                    'message' => 'Password already used. Please try another password',
                    'data' => null,
                ]);
            }


            UserPasswordList::create([
                'user_id' => $id,
                'password' => Hash::make($request->new_password),
            ]);

            $user->update([
                'remember_token' => null,
                'password' => Hash::make($request->new_password),
            ]);

            //---------- Log Maintance Activity Start ----------//
            activity()
            ->causedBy(Auth::user()->id)
            ->withProperties(['ip_address' => request()->ip()])
            ->log('Forgot Password, Id :' . $id.', Email :'.$emaill);
            //---------- Log Maintance Activity Start ----------//

            DB::commit();

            return response([
                'status' => true,
                'message' => 'Password Reset Successfully. Please Login.',
                'data' => null,
                'url' => route('admin.login'),
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response([
                'status' => false,
                'message' => 'Something went wrong. Please try again later.',
                'data' => null,
            ]);
        }
    }

    // GET request: Show password change form
    $token = $request->token;
    return view('auth.password-change', compact('token'));
}


    public function readNotification(Request $request)
    {
        alert('ok');
        Notification::find($request->notificationId)->update(['is_read' => 1]);
    }
}
