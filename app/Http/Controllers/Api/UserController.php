<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\Auth\ProductCollection;
use App\Models\Offer;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Store;
use App\Models\User;
use App\Models\UserBusiness;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use App\Traits\CommonFunction;
use App\Traits\NotificationTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Api\User\ProfileCollection;

class UserController extends BaseController
{
    use CommonFunction;
    use UploadAble;
    use NotificationTrait;

    public function logout(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $token = $user->token();
            $tokenRevoke = $token->revoke();
            if ($tokenRevoke) {
                $status = true;
                $code = 200;
                $response = [];
                $message = 'You have been successfully logged out!';
            } else {
                $status = false;
                $code = 500;
                $response = [];
                $message = 'Something went wrong';
            }
        } else {
            $status = false;
            $code = 401;
            $response = [];
            $message = 'User not authenticated';
        }
        return $this->responseJson($status, $code, $message, $response);
    }
    public function getProfile(Request $request)
    {
        try {
            $user = Auth::user();
            if ($user) {
                $status = true;
                $code = 200;
                $response = new ProfileCollection($user);
                $message = "Profile data found";
            } else {
                $status = false;
                $code = 404;
                $response = [];
                $message = "User not found";
            }
            return $this->responseJson($status, $code, $message, $response);
        } catch (\Throwable $th) {
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()]);
        }
    }
    public function userList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_type' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->responseJson(false, 422, $validator->errors()->first(), []);
        }
        // dd($userFound->toArray());
        $query = User::where(['user_type' => $request->user_type, 'is_approve' => 1, 'is_blocked' => 0]);

        if ($request->has('name')) {
            $query = $query->where(function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->name . '%');
            });
        }
        if ($request->is_verified != '') {
            $query = $query->where('is_verified', (int) $request->is_verified);
        }
        if (!empty($request->state)) {
            $query = $query->where('state', $request->state);
        }
        if (!empty($request->city)) {
            $query = $query->where('city', $request->city);
        }

        $userDetails = $query->get();

        if (is_null($userDetails->toArray())) {
            $status = false;
            $code = 200;
            $response = [];
            $message = 'No Data Found';
            return $this->responseJson($status, $code, $message, $response);
        }

        if ($userDetails) {
            $status = true;
            $code = 200;
            $response = ProfileCollection::collection($userDetails);
            $message = "User Found";
        } else {
            $status = false;
            $code = 422;
            $response = [];
            $message = 'Something went wrong.';
        }
        return $this->responseJson($status, $code, $message, $response);
    }
    public function profileDetails(Request $request)
    {
        try {
            $userDetails = Auth::user();
            if ($userDetails) {
                $status = true;
                $code = 200;
                $response = new ProfileCollection($userDetails);
                $message = "Data Found";
            } else {
                $status = true;
                $code = 200;
                $response = [];
                $message = "No Data Found";
            }
            return $this->responseJson($status, $code, $message, $response);
        } catch (\Throwable $th) {
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()]);
        }
    }
    public function updateProfile(Request $request)
    {
        $id = Auth::user()->id;
        $rules = [
            "email" => 'sometimes|email|unique:users,email,' . $id,
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->responseJson(false, 422, $validator->errors()->first(), []);
        }
        DB::beginTransaction();
        try {
            $data_to_update = array();

            if (!empty($request->name)) {
                $data_to_update['name'] = $request->name;
            }
            if (!empty($request->email)) {
                $data_to_update['email'] = $request->email;
            }
            if (!empty($request->lat)) {
                $data_to_update['lat'] = $request->lat;
            }
            if (!empty($request->lng)) {
                $data_to_update['lng'] = $request->lng;
            }

            if (!empty($request->profile_image)) {
                $image = $request->profile_image;
                $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                $isFileUploaded = $this->uploadOne($image, config('constants.SITE_PROFILE_IMAGE_UPLOAD_PATH'), $fileName, 'public');
                if ($isFileUploaded) {
                    $data_to_update['profile_image'] = $fileName;
                }
            }

            $userUpdated = User::where('id', $id)->update($data_to_update);

            if ($userUpdated) {
                DB::commit();
                $userDetails = User::where('id', $id)->first();
                $status = true;
                $code = 200;
                $response = new ProfileCollection($userDetails);
                $message = "Profile updated successfully";
            } else {
                $status = true;
                $code = 200;
                $response = [];
                $message = "No Data Found";
            }
            return $this->responseJson($status, $code, $message, $response);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()]);
        }
    }
    public function business(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            "business_id" => 'nullable|exists:user_businesses,uuid',
            "category_id" => 'required|exists:categories,uuid',
            "name" => 'required|string|max:255',
            "logo" => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "abn" => 'nullable|string|max:255',
            "country_id" => 'required|integer',
            "state_id" => 'required|integer',
            "city_id" => 'required|integer',
            "full_address" => 'required|string',
            "type" => 'required|in:1,2',
        ]);
        if ($validator->fails()) {
            return $this->responseJson(false, 422, $validator->errors()->first(), []);
        }

        DB::beginTransaction();
        try {
            $data = [
                'user_id' => $user->id,
                'category_id' => uuidtoid($request->category_id, 'categories'),
                'name' => $request->name,
                'abn' => $request->abn,
                'country_id' => $request->country_id,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
                'full_address' => $request->full_address,
                'type' => $request->type,
            ];

            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $fileName = uniqid() . '.' . $logo->getClientOriginalExtension();
                $isFileUploaded = $this->uploadOne($logo, config('constants.BUSINESS_LOGO_UPLOAD_PATH'), $fileName, 'public');
                if ($isFileUploaded) {
                    $data['logo'] = $fileName;
                }
            }

            $business = UserBusiness::updateOrCreate(['uuid' => $request->business_id], $data);

            if ($business) {
                DB::commit();
                $status = true;
                $code = 200;
                $response = new ProfileCollection(auth()->user());
                $message = "Profile updated successfully";
            }
            return $this->responseJson($status, $code, $message, $response);

        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()]);
        }
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            "store_id" => 'nullable|exists:stores,uuid',
            "name" => 'required|string|max:255',
            "logo" => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "country_id" => 'required|integer',
            "state_id" => 'required|integer',
            "city_id" => 'required|integer',
            "full_address" => 'required|string',
            "is_primary" => 'nullable|in:0,1',
        ]);
        if ($validator->fails()) {
            return $this->responseJson(false, 422, $validator->errors()->first(), []);
        }

        DB::beginTransaction();
        try {
            $data = [
                'user_id' => $user->id,
                'name' => $request->name,
                'country_id' => $request->country_id,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
                'full_address' => $request->full_address,
                'is_primary' => $request->is_primary ?? 0,
            ];

            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $fileName = uniqid() . '.' . $logo->getClientOriginalExtension();
                $isFileUploaded = $this->uploadOne($logo, config('constants.STORE_LOGO_UPLOAD_PATH'), $fileName, 'public');
                if ($isFileUploaded) {
                    $data['logo'] = $fileName;
                }
            }

            if ($request->is_primary == 1) {
                Store::where('user_id', $user->id)->update(['is_primary' => 0]);
            }

            $store = Store::updateOrCreate(['uuid' => $request->store_id], $data);

            if ($request->store_id) {
                $message = "Store updated successfully";
            } else {
                $message = "Store created successfully";
            }

            if ($store) {
                DB::commit();
                $status = true;
                $code = 200;
                $response = new ProfileCollection(Auth::user());
            }

            return $this->responseJson($status, $code, $message, $response);

        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()]);
        }
    }
    public function product(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => 'nullable|exists:products,uuid',
            "user_business_id" => 'required|exists:user_businesses,uuid',
            "store_id" => 'nullable|exists:stores,uuid',
            "name" => 'required|string|max:255',
            "code" => 'required|string|max:255',
            "description" => 'nullable|string',
            "price" => 'required|numeric',
            "mrp" => 'nullable|numeric',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($validator->fails()) {
            return $this->responseJson(false, 422, $validator->errors()->first(), []);
        }

        DB::beginTransaction();
        try {
            $data = [
                'user_business_id' => !empty($request->user_business_id) ? uuidtoid($request->user_business_id, 'user_businesses') : null,
                'store_id' => !empty($request->store_id) ? uuidtoid($request->store_id, 'stores') : null,
                'name' => $request->name,
                'code' => $request->code,
                'description' => $request->description,
                'price' => $request->price,
                'mrp' => $request->mrp ?? $request->price,
            ];

            $product = Product::updateOrCreate(['uuid' => $request->id], $data);

            if (!empty($request->remove_image)) {
                $remove_image = json_decode($request->remove_image);
                ProductImage::whereIn('id', $remove_image)->delete();
            }

            if ($product && $request->image) {
                foreach ($request->image as $key => $val) {
                    $image = $val;
                    $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                    $isFileUploaded = $this->uploadOne($image, config('constants.SITE_PRODUCT_UPLOAD_PATH'), $fileName, 'public');
                    if ($isFileUploaded) {
                        ProductImage::create([
                            'product_id' => $product->id ?? $request->id,
                            'image' => $fileName,
                            'is_active' => 1
                        ]);
                    }
                }
            }

            if ($product) {
                DB::commit();
                $status = true;
                $code = 200;
                $response = $product;
                $message = $request->id ? "Product updated successfully" : "Product created successfully";
            } else {
                $status = false;
                $code = 500;
                $response = [];
                $message = "Failed to create product";
            }

            return $this->responseJson($status, $code, $message, $response);

        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), [
                'Message' => $th->getMessage(),
                'File Path' => $th->getFile(),
                'Line Number' => $th->getLine()
            ]);
        }
    }
    public function getProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "business_id" => 'required|exists:user_businesses,uuid',
        ]);
        if ($validator->fails()) {
            return $this->responseJson(false, 422, $validator->errors()->first(), []);
        }

        $product = Product::where('user_business_id', uuidtoid($request->business_id, 'user_businesses'))->get();

        if ($product) {
            $status = true;
            $code = 200;
            $response = ProductCollection::collection($product);
            $message = "Product found";
        } else {
            $status = false;
            $code = 404;
            $response = [];
            $message = "Product not found";
        }
        return $this->responseJson($status, $code, $message, $response);
    }
    public function offer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => 'nullable|exists:products,uuid',
            "user_business_id" => 'required|exists:user_businesses,uuid',
            "store_id" => 'nullable|exists:stores,uuid',
            "name" => 'required|string|max:255',
            "offer_details" => 'nullable|string',
            "terms_and_conditions" => 'nullable|string',
            "offer_type" => 'required|in:1,2', // 1:Percentage, 2:Flat
            "offer_value" => 'required|numeric',
            "start_date" => 'required|date',
            "end_date" => 'required|date|after_or_equal:start_date',
            "start_time" => 'required|date_format:H:i:s',
            "end_time" => 'required|date_format:H:i:s',
            "deal_type" => 'required|in:1,2', // 1:Flash, 2:Limited Time
        ]);
        if ($validator->fails()) {
            return $this->responseJson(false, 422, $validator->errors()->first(), []);
        }

        DB::beginTransaction();
        try {
            $data = [
                'user_business_id' => !empty($request->user_business_id) ? uuidtoid($request->user_business_id, 'user_businesses') : null,
                'store_id' => !empty($request->store_id) ? uuidtoid($request->store_id, 'stores') : null,
                'name' => $request->name,
                'offer_details' => $request->offer_details,
                'terms_and_conditions' => $request->terms_and_conditions,
                'offer_type' => $request->offer_type,
                'offer_value' => $request->offer_value,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'deal_type' => $request->deal_type,
            ];

            $offer = Offer::updateOrCreate(['uuid' => $request->id], $data);

            if ($offer) {
                DB::commit();
                $status = true;
                $code = 200;
                $response = $offer;
                $message = $request->id ? "Offer updated successfully" : "Offer created successfully";
            } else {
                $status = false;
                $code = 500;
                $response = [];
                $message = "Failed to create offer";
            }

            return $this->responseJson($status, $code, $message, $response);

        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseJson(false, 500, config('constants.CATCH_ERROR_MSG'), [
                'Message' => $th->getMessage(),
                'File Path' => $th->getFile(),
                'Line Number' => $th->getLine()
            ]);
        }
    }
}
