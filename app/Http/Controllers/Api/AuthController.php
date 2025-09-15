<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\User\ProfileCollection;
use App\Models\Cms;
use App\Models\Blog;
use App\Models\User;
use App\Models\Banner;
use App\Models\Feature;
use App\Models\Setting;
use App\Models\Category;
use App\Traits\SmsTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\CommonFunction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Api\Auth\CmsCollection;
use App\Http\Resources\Api\Auth\BlogCollection;
use App\Http\Resources\Api\Auth\BannerCollection;
use App\Http\Resources\Api\Auth\FeatureCollection;
use App\Http\Resources\Api\Auth\SettingCollection;
use App\Http\Resources\Api\Auth\CategoryCollection;

class AuthController extends BaseController
{
    use CommonFunction;
    use SmsTrait;

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string|max:255',
            'phone_code' => 'nullable|numeric',
            'mobile_number' => 'required|numeric|unique:users,mobile_number',
            'password' => 'required|string|min:6|confirmed',
            'device_type' => 'nullable|in:1,2', // 1 for Android, 2 for iOS
        ]);
        if ($validator->fails()) {
            return $this->responseJson(false, 422, $validator->errors()->first(), []);
        }
        DB::beginTransaction();
        try {
            $digits = 4;
            $otp = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);
            $store = [
                'mobile_number' => $request['mobile_number'] ?? null,
                'email' => $request['email'] ?? null,
                'name' => $request['name'] ?? null,
                'is_approve' => 1,
                'is_active' => 1,
                'is_verified' => 0,
                'remember_token' => Str::random(10),
                'verification_code' => $otp,
                'user_type' => $request['user_type'] ?? 3,
                'password' => Hash::make($request['password']),
                'original_password' => $request['password'],
                'fcm_token' => $request['fcm_token'] ?? null,
                'device_type' => $request['device_type'] ?? 1, // 1 for Android, 2 for iOS
            ];
            $userCreated = User::create($store);
            $message = 'Account Created Successfully, Please verify your account';
            if ($userCreated) {
                DB::Commit();
                $status = true;
                $code = 200;
                $response = ['verification_code' => $otp];
            } else {
                DB::rollBack();
                $status = false;
                $code = 500;
                $response = [];
                $message = 'Something went wrong';
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()]);
        }
        return $this->responseJson($status, $code, $message, $response);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return $this->responseJson(false, 422, $validator->errors()->first(), []);
        }

        DB::beginTransaction();
        try {
            if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = auth()->user();
                if (!$user->is_active) {
                    DB::rollBack();
                    $status = false;
                    $code = 403;
                    $response = [];
                    $message = 'Your account is inactive. Please contact support.';
                } elseif ($user->verification_code !== null) {
                    DB::rollBack();
                    $user = User::where('email', $request->email)
                        ->whereNotIn('user_type', [1, 2])
                        ->first();
                    $otp = generateOTP(4);
                    $user->update(['verification_code' => $otp]);
                    DB::commit();
                    // Optionally send OTP via SMS or Email
                    // $this->sendOtp($user->mobile_number, $otp);
                    $status = true;
                    $code = 200;
                    $response = ['verification_code' => $otp];
                    $message = 'Otp sent successfully';
                } else {
                    $token = $user->createToken('Login Successfully')->accessToken;
                    DB::commit();
                    $status = true;
                    $code = 200;
                    $response = ['token' => $token, 'profile' => new ProfileCollection($user)];
                    $message = 'Login Successfully';
                }
            } else {
                DB::rollBack();
                $status = false;
                $code = 401;
                $response = [];
                $message = 'Invalid email or password';
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()]);
        }
        return $this->responseJson($status, $code, $message, $response);
    }

    public function resendOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);
        if ($validator->fails()) {
            return $this->responseJson(false, 422, $validator->errors()->first(), []);
        }
        DB::beginTransaction();
        try {
            $user = User::where('email', $request->email)
                ->whereNotIn('user_type', [1, 2])
                ->first();
            if ($user) {
                $otp = generateOTP(4);
                $user->update(['verification_code' => $otp]);
                DB::commit();
                // Optionally send OTP via SMS or Email
                // $this->sendOtp($user->mobile_number, $otp);
                $status = true;
                $code = 200;
                $response = ['verification_code' => $otp];
                $message = 'Otp sent successfully';
            } else {
                DB::rollBack();
                $status = false;
                $code = 404;
                $response = [];
                $message = 'User not found';
            }
            return $this->responseJson($status, $code, $message, $response);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()]);
        }
    }
    public function otpVerification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'verification_code' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return $this->responseJson(false, 422, $validator->errors()->first(), []);
        }
        DB::beginTransaction();
        try {
            $user = User::where(['email' => $request->email, 'verification_code' => $request->verification_code])->first();
            if ($user) {
                $user->update([
                    'is_verified' => 1,
                    'fcm_token' => $request->fcm_token ?? null,
                    'device_type' => $request->device_type ?? 1, //1 for Android, 2 for iOS
                    'verification_code' => null
                ]);
                DB::Commit();
                $token = $user->createToken('Login Successfully')->accessToken;

                if ($token) {
                    $status = true;
                    $code = 200;
                    $response = ['token' => $token, 'profile' => new ProfileCollection($user)];
                    $message = 'Otp Verify Successfully';
                } else {
                    $status = false;
                    $code = 500;
                    $response = [];
                    $message = 'Something went wrong';
                }
            } else {
                $status = false;
                $code = 422;
                $response = [];
                $message = 'Otp doesn\'t match';
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()]);
        }
        return $this->responseJson($status, $code, $message, $response);
    }
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);
        if ($validator->fails()) {
            return $this->responseJson(false, 422, $validator->errors()->first(), []);
        } else {
            DB::beginTransaction();
            try {
                $userDetails = User::where('email', $request->email)->first();
                if (empty($userDetails->email)) {
                    $status = false;
                    $code = 422;
                    $response = [];
                    $message = 'Invalid Email Number Id !!';
                } else {
                    $otp = generateOTP(4);
                    User::where('id', $userDetails->id)->update([
                        'verification_code' => $otp
                    ]);
                    DB::commit();
                    $status = true;
                    $code = 200;
                    $response = ['otp' => $otp];
                    $message = 'OTP Sent Successfully !!';
                }
            } catch (\Throwable $th) {
                DB::rollBack();
                $status = false;
                $code = 500;
                $response = ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()];
                $message = config('constants.CATCH_ERROR_MSG');
            }
            return $this->responseJson($status, $code, $message, $response);
        }
    }
    public function forgotPasswordOtpVerification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'verification_code' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return $this->responseJson(false, 422, $validator->errors()->first(), []);
        }
        DB::beginTransaction();
        try {
            $user = User::where(['email' => $request->email, 'verification_code' => $request->verification_code])->first();
            if ($user) {
                $user->update([
                    'verification_code' => null
                ]);
                DB::Commit();
                $status = true;
                $code = 200;
                $response = ['profile' => new ProfileCollection($user)];
                $message = 'Otp Verify Successfully, Please change your password';
            } else {
                $status = false;
                $code = 422;
                $response = [];
                $message = 'Otp doesn\'t match';
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()]);
        }
        return $this->responseJson($status, $code, $message, $response);
    }
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|string|confirmed',
        ]);
        if ($validator->fails()) {
            return $this->responseJson(false, 422, $validator->errors()->first(), []);
        }

        DB::beginTransaction();
        try {
            if ($request->email) {
                $userFound = User::where(['email' => $request->email])->first();
            }
            if ($userFound) {
                $passwordUpdate = $userFound->update(['password' => Hash::make($request->password)]);
                if ($passwordUpdate) {
                    DB::Commit();
                    $status = true;
                    $code = 200;
                    $response = [];
                    $message = "Password Change Successfully, Please login again";
                } else {
                    $status = false;
                    $code = 422;
                    $response = [];
                    $message = 'Something went wrong';
                }
            } else {
                $status = false;
                $code = 500;
                $response = [];
                $message = 'User not found';
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()]);
        }
        return $this->responseJson($status, $code, $message, $response);
    }
    public function bannerList()
    {
        try {
            $banner = Banner::where('is_active', 1)->get();
            if (!empty($banner) && count($banner) > 0) {
                $status = true;
                $code = 200;
                $response = BannerCollection::collection($banner);
                $message = "Banner List Fetched";
            } else {
                $status = true;
                $code = 200;
                $response = [];
                $message = "No Data Found";
            }
        } catch (\Throwable $th) {
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()]);
        }
        return $this->responseJson($status, $code, $message, $response);
    }
    public function blogList()
    {
        try {
            $blog = Blog::where('is_active', 1)->get();
            if (!empty($blog) && count($blog) > 0) {
                $status = true;
                $code = 200;
                $response = BlogCollection::collection($blog);
                $message = "Blog List Fetched";
            } else {
                $status = true;
                $code = 200;
                $response = [];
                $message = "No Data Found";
            }
        } catch (\Throwable $th) {
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()]);
        }
        return $this->responseJson($status, $code, $message, $response);
    }
    public function categoryList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'nullable|uuid|exists:categories,uuid',
        ]);
        if ($validator->fails()) {
            return $this->responseJson(false, 422, $validator->errors()->first(), []);
        }
        try {
            $categoryId = $request->category_id ?? null;
            if ($categoryId) {
                $id = uuidtoid($request->category_id, 'categories');
                $category = Category::where(['is_active' => 1, 'parent_id' => $id])->get();
            } else {
                $category = Category::where(['is_active' => 1, 'parent_id' => null])->get();
            }
            if (!empty($category) && count($category) > 0) {
                $status = true;
                $code = 200;
                $response = CategoryCollection::collection($category);
                $message = "Category List Fetched";
            } else {
                $status = true;
                $code = 200;
                $response = [];
                $message = "No Data Found";
            }
        } catch (\Throwable $th) {
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()]);
        }
        return $this->responseJson($status, $code, $message, $response);
    }
    public function setting()
    {
        try {
            $setting = Setting::find(1);
            if (!empty($setting)) {
                $status = true;
                $code = 200;
                $response = new SettingCollection($setting);
                $message = "Setting Fetched";
            } else {
                $status = true;
                $code = 200;
                $response = [];
                $message = "No Data Found";
            }
        } catch (\Throwable $th) {
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()]);
        }
        return $this->responseJson($status, $code, $message, $response);
    }
    public function feature()
    {
        try {
            $feature = Feature::where('is_active', 1)->get();
            if (!empty($feature)) {
                $status = true;
                $code = 200;
                $response = FeatureCollection::collection($feature);
                $message = "Feature Fetched";
            } else {
                $status = true;
                $code = 200;
                $response = [];
                $message = "No Data Found";
            }
        } catch (\Throwable $th) {
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()]);
        }
        return $this->responseJson($status, $code, $message, $response);
    }
    public function cms()
    {
        try {
            $cms = Cms::where('is_active', 1)->get();
            if (!empty($cms)) {
                $status = true;
                $code = 200;
                $response = CmsCollection::collection($cms);
                $message = "Cms Fetched";
            } else {
                $status = true;
                $code = 200;
                $response = [];
                $message = "No Data Found";
            }
        } catch (\Throwable $th) {
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()]);
        }
        return $this->responseJson($status, $code, $message, $response);
    }
    public function currencies()
    {
        try {
            $currency = getCurrency();
            if (!empty($currency)) {
                $status = true;
                $code = 200;
                $response = $currency;
                $message = "Currency Fetched";
            } else {
                $status = true;
                $code = 200;
                $response = [];
                $message = "No Data Found";
            }
        } catch (\Throwable $th) {
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()]);
        }
        return $this->responseJson($status, $code, $message, $response);
    }
    public function countries()
    {
        try {
            $countries = getCountries();
            if (!empty($countries)) {
                $status = true;
                $code = 200;
                $response = $countries;
                $message = "Countries Fetched";
            } else {
                $status = true;
                $code = 200;
                $response = [];
                $message = "No Data Found";
            }
        } catch (\Throwable $th) {
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()]);
        }
        return $this->responseJson($status, $code, $message, $response);
    }
    public function states(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return $this->responseJson(false, 422, $validator->errors()->first(), []);
        }
        try {
            $countryId = $request->country_id ?? null;
            $states = getStates($countryId);
            if (!empty($states)) {
                $status = true;
                $code = 200;
                $response = $states;
                $message = "States Fetched";
            } else {
                $status = true;
                $code = 200;
                $response = [];
                $message = "No Data Found";
            }
        } catch (\Throwable $th) {
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()]);
        }
        return $this->responseJson($status, $code, $message, $response);
    }
    public function cities(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'state_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return $this->responseJson(false, 422, $validator->errors()->first(), []);
        }
        try {
            $stateId = $request->state_id ?? null;
            $cities = getCities($stateId);
            if (!empty($cities)) {
                $status = true;
                $code = 200;
                $response = $cities;
                $message = "Cities Fetched";
            } else {
                $status = true;
                $code = 200;
                $response = [];
                $message = "No Data Found";
            }
        } catch (\Throwable $th) {
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()]);
        }
        return $this->responseJson($status, $code, $message, $response);
    }
}
