<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use App\Traits\CommonFunction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use App\Models\Unit;
use App\Models\Designation;
use Illuminate\Support\Facades\Auth;

class TeamController extends BaseController
{
    use CommonFunction;
    use UploadAble;
    public function index(Request $request)
    {
        if(auth()->user()->can('specific-unit')){
            $details = Team::where('unit_id',auth()->user()->unit_id)->orderBy('position','ASC')->latest()->get();
        }else{
            $details = Team::orderBy('position','ASC')->latest()->get();
        }

        return view('admin.team.index', compact('details'));
    }
    public function add(Request $request)
    {
        if ($request->post()) {
            $id = $request->id ?? NULL;
            $rules = [
                'name' => 'required|string|max:255',
                'email' => 'nullable|email|max:255',
                'mobile_no' => 'nullable|string|max:255',
                'location' => 'nullable|string|max:255',
                'designation_others' => 'nullable|string|max:255',
                'show' => 'required',
                'menu_id' => 'required|exists:menus,id',
                'unit_id' => 'required|exists:units,id',
                'designation_id' => 'required|exists:designations,id',
                               'otp' => 'required', 'digits:6',
                    'captcha'  => 'required'
            ];

            if ($id) {
                // On update, file is optional
                $message = "Team Updated Successfully";
                $rules['file'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120';
            } else {
                // On create, file is required
                $message = "Team Created Successfully";
                $rules['file'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120';
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
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile_no' => $request->mobile_no,
                    'location' => $request->location,
                    'designation_others' => $request->designation_others,
                    'show' => $request->show,
                    'unit_id' => $request->unit_id,
                    'menu_id' => $request->menu_id,
                    'designation_id' => $request->designation_id
                ];
                if (!empty($request->file)) {
                    $image = $request->file;
                    $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                    $isFileUploaded = $this->uploadOne($image, config('constants.SITE_TEAM_UPLOAD_PATH'), $fileName, 'public');
                    if ($isFileUploaded) {
                        $postData['file'] = $fileName;
                    }
                }
                $details = Team::updateOrCreate(['id' => $id], $postData);
                  if ($id == null) {
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log('Team Created, ID: ' . $details->id);
                    // Log Activity
                }else{
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log('Team Updated, ID: ' . $id);
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
            $data = ['status' => true, 'message' => $message, 'data' => $details ?? null, 'url' => route('admin.team.list')];
            return response($data);
        }
        $details = array();
        if (!empty($request->uuid)) {
            $uuid = uuidtoid($request->uuid, 'teams');
            $details = Team::find($uuid);
        }
        if(auth()->user()->unit_id != null){
            $units = Unit::where('id',auth()->user()->unit_id)->where('is_active',1)->get();
        }else{
            $units = Unit::where('is_active',1)->get();
        }
        $designations = Designation::where('is_active',1)->get();

        return view('admin.team.add', compact('details','units','designations'));
    }
    public function order(Request $request)
    {
        if ($request->post()) {
            DB::beginTransaction();
            try {

                foreach ($request->order as $key => $value) {
                    Team::where('id', $value)->update(['position' => $key + 1]);
                }

                // Log Activity
                activity()
                    ->causedBy(Auth::user())
                    ->withProperties(['ip_address' => request()->ip()])
                    ->log('Team Order Updated');
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
            $data = ['status' => true, 'message' => '', 'data' => $details ?? null, 'url' => route('admin.team.list')];
            return response($data);
        }
    }
}
