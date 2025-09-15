<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unit;
use App\Models\User;
use App\Models\Setting;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use App\Traits\CommonFunction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Facades\Activity;
use Illuminate\Support\Str;

class UnitController extends BaseController
{
    use CommonFunction;
    use UploadAble;
    public function index()
    {
        $details = Unit::latest()->get();
        return view('admin.unit.index', compact('details'));
    }
    public function add(Request $request)
    {
        if ($request->post()) {
            $id = $request->id ?? NULL;
            $messages = [
                'title_en.required' => 'The english title is required.',
                'short_name.required' => 'The english short name is required.',
                'title_hi.required' => 'The hindi title is required.',
                'state_id.exists' => 'The selected state is invalid.',
                'short_code.string' => 'Short code must be a string.',
                'short_code.max' => 'Short code must be max 10 characters.',
                'factory_code.string' => 'Factory code must be a string.',
                'factory_code.max' => 'Factory code must be max 10 characters.',
                'otp.digits' => 'The otp must be 6 digits.',
                'captcha.captcha' => 'The captcha is invalid.',
            ];

            $rules = [
                'title_en' => 'required',
                'title_hi' => 'required',
                'short_name' => 'required',
                'state_id' => 'nullable|exists:states,id',
                'short_code' => 'nullable|string|max:10',
                'factory_code' => 'nullable|string|max:10',
                'otp' => 'required|digits:6',
                'captcha'  => 'required'
            ];

            if ($id) {
                $message = "Unit Updated Successfully";
            } else {
                $message = "Unit Created Successfully & his setting created, Please update the setting";
            }

            $validated = $request->validate($rules, $messages);

            DB::beginTransaction();
            try {

                $otp = $request->otp;
                $response =$this->verifyOTP($otp);
                if(!$response['status']){
                    return $response;
                }

                $postData = [
                    "title_en" => $request->title_en,
                    "slug" => $request->short_name,
                    "title_hi" => $request->title_hi,
                    "state_id" => $request->state_id,
                    "short_code" => $request->short_code,
                    "factory_code" => $request->factory_code,
                ];

                if ($id != null) {
                    $postData['updated_by'] = Auth::user()->id;
                } else {
                    $postData['created_by'] = Auth::user()->id;
                }
                $details = Unit::updateOrCreate(['id' => $id], $postData);


                $setting = Setting::first();
                if ($setting && $id == null) {
                    $newSetting = $setting->replicate(); // Clone the data
                    $newSetting->unit_id = $details->id; // Assign the new unit ID
                    $newSetting->created_by = Auth::user()->id; // Set created_by
                    $newSetting->updated_by = Auth::user()->id; // Set updated_by
                    $newSetting->save(); // Insert into DB
                }

                if ($id == null) {
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log($request->title_en.' Unit Created');
                    // Log Activity
                }else{
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log($request->title_en.' Unit Updated');
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
            $data = ['status' => true, 'message' => $message, 'data' => $details ?? null, 'url' => route('admin.unit.list')];
            return response($data);
        }
        $details = array();
        if (!empty($request->uuid)) {
            $uuid = uuidtoid($request->uuid, 'units');
            $details = Unit::find($uuid);
        }
        $states = \App\Models\State::all();

        return view('admin.unit.add', compact('details','states'));
    }

}
