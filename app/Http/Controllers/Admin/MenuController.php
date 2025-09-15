<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Section;
use App\Models\Permission;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use App\Traits\CommonFunction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class MenuController extends BaseController
{
    use CommonFunction;
    use UploadAble;
    public function index(Request $request)
    {
        if(auth()->user()->can('specific-unit')){
            $details = Menu::where('unit_id',auth()->user()->unit_id)->orderBy('position','ASC')->latest()->get();
        }else{
            $details = Menu::orderBy('position','ASC')->latest()->get();
        }
        return view('admin.menu.index', compact('details'));
    }
    public function add(Request $request)
    {
        if ($request->post()) {
            $id = $request->id ?? NULL;
            $rules = [
                'title_en' => 'required|string|max:255|regex:/^[A-Za-z0-9\s\-\_\,\.\!\?]+$/u',
                'title_hi' => 'required|string|max:255',
                'parent_id' => 'nullable|exists:menus,id',
                'unit_id' => 'required|exists:units,id',
                'menu_type' => 'required', // 0 for header, 1 for footer
                'otp' => 'required', 'digits:6',
                'captcha'  => 'required'

            ];
            $messages = [
                'title_en.required' => 'The english title is required.',
                'title_hi.required' => 'The hindi title is required.',
                'parent_id.exists' => 'The selected parent menu is invalid.',
                'unit_id.exists' => 'The selected unit is invalid.',
                'menu_type.required' => 'Menu type must be selected.',
                'otp.required' => 'OTP is required',
                'otp.digits' => 'OTP must be 6 digits',
                'captcha.required' => 'Captcha is required',

            ];

            if ($id) {
                // On update, file is optional
                $message = "Menu Updated Successfully";
                $rules['file'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120';
            } else {
                // On create, file is required
                $message = "Menu Created Successfully";
                $rules['file'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120';
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
                    "slug" => Str::slug($request->title_en),
                    "title_hi" => $request->title_hi,
                    "parent_id" => $request->parent_id,
                    "unit_id" => $request->unit_id,
                    "menu_type" => implode(',', $request->menu_type),
                    "extend_to" => $request->extend_to,
                ];

                // if($request->parent_id == null && $id == null){
                //     Permission::create(['name' => $postData['title_en'], 'slug' => $postData['slug'],'group_by' => 'menu']);
                // }else{
                //     $permission = Permission::where('slug', $postData['slug'])->first();
                //     if ($permission) {
                //         $permission->update(['name' => $postData['title_en']]);
                //     } else {
                //         Permission::create(['name' => $postData['title_en'], 'slug' => $postData['slug'],'group_by' => 'menu']);
                //     }
                // }
                if (!empty($request->file)) {
                    $image = $request->file;
                    $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                    $isFileUploaded = $this->uploadOne($image, config('constants.SITE_MENU_UPLOAD_PATH'), $fileName, 'public');
                    if ($isFileUploaded) {
                        $postData['file'] = $fileName;
                    }
                }
                 if ($id != null) {
                    $postData['updated_by'] = Auth::user()->id;
                } else {
                    $postData['created_by'] = Auth::user()->id;
                }
                $details = Menu::updateOrCreate(['id' => $id], $postData);

                if ($id == null && $request->extend_to != null) {
                    $allSections = DB::table('templete_sections')->where('templete_id',$request->extend_to)->get();
                    if($allSections->count() > 0){
                        foreach ($allSections as $section) {
                            $sectionData = [
                                'title' => $section->tile_slug,
                                'slug' => Str::slug($section->tile_slug),
                                'menu_id' => $details->id,
                                'unit_id' => $details->unit_id,
                            ];
                            Section::create($sectionData);
                        }
                    }
                }


                if ($id == null) {
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log('Menu Created, ID: ' . $details->id);
                    // Log Activity
                }else{
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log('Menu Updated, ID: ' . $id);
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
            $data = ['status' => true, 'message' => $message, 'data' => $details ?? null, 'url' => route('admin.menu.list')];
            return response($data);
        }
        $details = array();
        if (!empty($request->uuid)) {
            $uuid = uuidtoid($request->uuid, 'menus');
            $details = Menu::find($uuid);
        }
        if(auth()->user()->unit_id != null){
            $menus = Menu::where('unit_id',auth()->user()->unit_id)->orderBy('position','ASC')->where('is_active',1)->get();
            $units = \App\Models\Unit::where('id',auth()->user()->unit_id)->where('is_active',1)->get();
        }else{

            $menus = Menu::where('is_active',1)->orderBy('position','ASC')->get();

            $units = \App\Models\Unit::where('is_active',1)->get();
        }
        $extend_tos = DB::table('templetes')->get();
        $main_menus = \App\Models\Menu::where('unit_id',1)->orderBy('position','ASC')->where('is_active',1)->get();
        return view('admin.menu.add', compact('details','menus','units','main_menus','extend_tos'));
    }
     public function order(Request $request)
    {
        if ($request->post()) {
            DB::beginTransaction();
            try {

                foreach ($request->order as $key => $value) {
                    Menu::where('id', $value)->update(['position' => $key + 1]);
                }

                // Log Activity
                activity()
                    ->causedBy(Auth::user())
                    ->withProperties(['ip_address' => request()->ip()])
                    ->log('Menu Order Updated');
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
            $data = ['status' => true, 'message' => '', 'data' => $details ?? null, 'url' => route('admin.content.list')];
            return response($data);
        }
    }
}
