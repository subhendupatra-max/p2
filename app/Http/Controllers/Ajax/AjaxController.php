<?php

namespace App\Http\Controllers\Ajax;

use App\Models\Product;
use App\Models\ProductImage;
use bg;
use App\Jobs\SendOtpEmail;
use App\Models\Cms;
use App\Models\Role;
use App\Models\Media;
use App\Models\News;
use App\Models\User;
use App\Models\Banner;
use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Designation;
use App\Models\Feature;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Advertise;
use App\Models\Document;
use App\Models\Section;
use App\Models\Hod;
use App\Models\Aipr;
use App\Models\ImportantLink;
use App\Models\Request as ModelsRequest;
use App\Models\Team;
use App\Models\AiprMaster;
use App\Models\Unit;
use App\Models\UserPost;
use Illuminate\Support\Facades\Auth;

class AjaxController extends BaseController
{
    public function deleteData(Request $request)
    {
        // dd(1);
        if ($request->ajax()) {
            $table = $request->find;
            switch ($table) {
                case 'roles':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Role::find($id);
                    $data->delete();
                    $message = 'Role Deleted';
                    break;
                case 'users':
                    $id = uuidtoid($request->uuid, $table);
                    $data = User::find($id);
                    $data->delete();
                    $message = 'User Deleted';
                    break;
                case 'banners':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Banner::find($id);
                    $data->delete();
                    $message = 'Banner Deleted';
                    break;
                case 'cms':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Cms::find($id);
                    $data->delete();
                    $message = 'Content Deleted';
                    break;
                 case 'testimonials':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Testimonial::find($id);
                    $data->delete();
                    $message = 'Testimonial Deleted';
                    break;
                case 'user_posts':
                    $id = uuidtoid($request->uuid, $table);
                    $data = UserPost::find($id);
                    $data->delete();
                    $message = 'UserPost Deleted';
                    break;
                case 'teams':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Team::find($id);
                    $data->delete();
                    $message = 'Team Deleted';
                    break;
                case 'sections':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Section::find($id);
                    $data->delete();
                    $message = 'Section Deleted';
                    break;
                case 'documents':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Document::find($id);
                    $data->delete();
                    $message = 'Document Deleted';
                    break;
                case 'important_links':
                    $id = uuidtoid($request->uuid, $table);
                    $data = ImportantLink::find($id);
                    $data->delete();
                    $message = 'Important Link Deleted';
                    break;
                case 'advertises':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Advertise::find($id);
                    $data->delete();
                    $message = 'Advertise Deleted';
                    break;
                case 'menus':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Menu::find($id);
                    // Delete associated sections
                    $data->section()->delete();
                    $data->delete();
                    $message = 'Menu Deleted';
                    break;
                case 'designations':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Designation::find($id);
                    $data->delete();
                    $message = 'Designation Deleted';
                    break;
                case 'units':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Unit::find($id);
                    $data->setting()->delete(); // Delete the associated setting
                    $data->menus()->delete(); // Delete the associated menus
                    $data->delete();
                    $message = 'Unit Deleted';
                    break;
                case 'hods':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Hod::find($id);
                    $data->delete();
                    $message = 'Hod Deleted';
                    break;
                case 'aiprs':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Aipr::find($id);
                    $data->delete();
                    $message = 'Aipr Deleted';
                    break;
                case 'media':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Media::find($id);
                    $data->delete();
                    $message = 'Media Deleted';
                    break;
                case 'aipr_masters':
                    $id = uuidtoid($request->uuid, $table);
                    $data = AiprMaster::find($id);
                    $data->delete();
                    $message = 'AiprMaster Deleted';
                    break;


            }
            if ($data) {
                         // Log Activity
                activity()
                    ->causedBy(Auth::user())
                    ->withProperties(['ip_address' => request()->ip()])
                    ->log($message.', ID: ' . $id);
                // Log Activity
                return $this->responseJson(true, 200, $message);
            } else {
                return $this->responseJson(false, 200, 'Something Went Wrong');
            }
        } else {
            abort(403);
        }
    }
    public function statusChange(Request $request)
    {
        // dd(1);
        if ($request->ajax()) {
            $table = $request->find;
            $message = 'Status changed successfully';
            switch ($table) {
                case 'users':
                    $id = uuidtoid($request->uuid, $table);
                    $data = User::find($id);
                    $data->update(['is_active' => $request->status]);
                    $message = 'User status changed';
                    break;
                case 'banners':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Banner::find($id);
                    $data->update(['is_active' => $request->status]);
                    $message = 'Banner status changed';
                    break;
                case 'cms':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Cms::find($id);
                    $data->update(['is_active' => $request->status]);
                    break;
                case 'testimonials':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Testimonial::find($id);
                    $data->update(['is_active' => $request->status]);
                    $message = 'Testimonial status changed';
                    break;
                case 'user_posts':
                    $id = uuidtoid($request->uuid, $table);
                    $data = UserPost::find($id);
                    $data->update(['is_active' => $request->status]);
                    $message = 'UserPost status changed';
                    break;
                case 'teams':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Team::find($id);
                    $data->update(['is_active' => $request->status]);
                    $message = 'Team status changed';
                    break;
                case 'sections':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Section::find($id);
                    $data->update(['is_active' => $request->status]);
                    $message = 'Section status changed';
                    break;
                case 'documents':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Document::find($id);
                    $data->update(['is_active' => $request->status]);
                    $message = 'Document status changed';
                    break;
                case 'important_links':
                    $id = uuidtoid($request->uuid, $table);
                    $data = ImportantLink::find($id);
                    $data->update(['is_active' => $request->status]);
                    $message = 'Important Link status changed';
                    break;
                case 'advertises':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Advertise::find($id);
                    $data->update(['is_active' => $request->status]);
                    $message = 'Advertise status changed';
                    break;
                case 'menus':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Menu::find($id);
                    $data->update(['is_active' => $request->status]);

                    $message = 'Menu status changed';
                    break;
                case 'units':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Unit::find($id);
                    $data->update(['is_active' => $request->status]);
                    $message = 'Unit status changed';
                    break;
                case 'designations':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Designation::find($id);
                    $data->update(['is_active' => $request->status]);
                    $message = 'Designation status changed';
                    break;
                  case 'hods':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Hod::find($id);
                    $data->update(['is_active' => $request->status]);
                    $message = 'Hod status changed';
                    break;
                case 'aiprs':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Aipr::find($id);
                    $data->update(['is_active' => $request->status]);
                    $message = 'Aipr status changed';
                    break;
                case 'media':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Media::find($id);
                    $data->update(['is_active' => $request->status]);
                    $message = 'Media status changed';
                    break;
                case 'aipr_masters':
                    $id = uuidtoid($request->uuid, $table);
                    $data = AiprMaster::find($id);
                    $data->update(['is_active' => $request->status]);
                    $message = 'AiprMaster status changed';
                    break;

                // Log Activity
                activity()
                    ->causedBy(Auth::user())
                    ->withProperties(['ip_address' => request()->ip()])
                    ->log($message.', ID: ' . $id);
                // Log Activity
            }
            if ($data) {
                return $this->responseJson(true, 200, $message);
            } else {
                return $this->responseJson(false, 200, 'Something Went Wrong');
            }
        } else {
            abort(403);
        }
    }

    public function approvChange(Request $request)
    {
        if ($request->ajax()) {
             $table = 'aipr_masters';
            $id = uuidtoid($request->uuid, $table);
            $data = AiprMaster::find($id);
            $data->update([ $request->field => $request->value]);
            $message = 'Successful';

            if ($data) {
                return $this->responseJson(true, 200, $message);
            } else {
                return $this->responseJson(false, 200, 'Something Went Wrong');
            }
        } else {
            abort(403);
        }
    }

    public function otpSend(){
        $otp = rand(100000,999999);
        User::where('id',auth()->user()->id)->update(['form_validation_otp'=>$otp,'form_validation_otp_time'=> now(),'form_validation_no_of_attempted'=>3]);
        $email = auth()->user()->email;
        // SendOtpEmail::dispatch($otp, $email);
        $data = ['status' => true, 'message' => 'OTP Send successfully', 'data' => null,'otp'=>$otp];
        return response($data);
    }

    public function convertActiveData(Request $request)
    {
        if ($request->ajax()) {
            $table = $request->find;

            switch ($table) {
                case 'documents':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Document::find($id);
                    $isArch = $data->is_archived == 0 ? 1 : 0;
                    $data->update(['is_archived' => $isArch]);
                    $message = 'Document Active';
                    break;
                case 'cms':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Cms::find($id);
                    $isArch = $data->is_archived == 0 ? 1 : 0;
                    $data->update(['is_archived' => $isArch]);
                    $message = 'Cms Active';
                    break;
            }
            if ($data) {
                         // Log Activity
                activity()
                    ->causedBy(Auth::user())
                    ->withProperties(['ip_address' => request()->ip()])
                    ->log($message.', ID: ' . $id);
                // Log Activity
                return $this->responseJson(true, 200, $message);
            } else {
                return $this->responseJson(false, 200, 'Something Went Wrong');
            }
        } else {
            abort(403);
        }
    }
    public function contentStatusChange(Request $request){
        $contant = Cms::find($request->id);
        $field = $request->field;
        $contant->update([$field => $request->value]);
        $contant->save();
        return $this->responseJson(true, 200, 'Status Change Successfully');
    }
}
