<?php

namespace App\Http\Controllers\Admin;

use App\Models\Document;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use App\Traits\CommonFunction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Facades\Activity;

class DocumentController extends BaseController
{
    use CommonFunction;
    use UploadAble;
    public function index(Request $request)
    {
        $today = date('Y-m-d');
        if(auth()->user()->can('active-document')) {
            if(auth()->user()->can('specific-unit')){
                $details_active = Document::with('menu','category','unit')->where('unit_id',auth()->user()->unit_id)->where('is_archived',0)->orderBy('position','ASC')->latest()->get();
            }else{
                $details_active = Document::with('menu','category','unit')->where('is_archived',0)->orderBy('position','ASC')->latest()->get();
            }
        }else{
            $details_active = [];
        }

        if(auth()->user()->can('archived-document')) {
            if(auth()->user()->can('specific-unit')){
                $details_archived = Document::with('menu','category','unit')->where('is_archived',1)->where('unit_id',auth()->user()->unit_id)->orderBy('position','ASC')->latest()->get();
            }else{
                $details_archived = Document::with('menu','category','unit')->where('is_archived',1)->orderBy('position','ASC')->latest()->get();
            }
        }else{
            $details_archived = [];
        }

        return view('admin.document.index', compact('details_archived','details_active'));
    }
    public function add(Request $request)
    {
        if ($request->post()) {
            $id = $request->id ?? NULL;
            $rules = [
                'title_en' => 'required|string|min:3|max:255|regex:/^[A-Za-z0-9\s\-\_\,\.\!\?]+$/u',
                'title_hi' => 'required|string|min:3|max:255',
                'menu_id' => 'required',
                'unit_id' => 'required',
                'category_id' => 'nullable',
                'public_date' => 'required',
                'expiry_date' => 'nullable',
                'file_language' => 'nullable',
                'otp' => 'required|digits:6',
                'captcha'  => 'required'

            ];

            $messages = [
                'title_en.required' => 'Title (English) is required',
                'title_hi.required' => 'Title (Hindi) is required',
                'menu_id.required' => 'Menu is required',
                'unit_id.required' => 'Unit is required',
                'public_date.required' => 'Public Date is required',
                'otp.required' => 'OTP is required',
                'captcha.required' => 'Captcha is required',
            ];

            if ($id) {
                // On update, file is optional
                $message = "Document Updated Successfully";
                $rules['file'] = 'nullable|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf,csv,xls,xlsx|max:5120';
            } else {
                // On create, file is required
                $message = "Document Created Successfully";
                $rules['file'] = 'required|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf,csv,xls,xlsx|max:5120';
            }

            $validated = $request->validate($rules,$messages);

            DB::beginTransaction();
            try {
                $otp = $request->otp;
                $response =$this->verifyOTP($otp);
                if(!$response['status']){
                    return $response;
                }
                $postData = [
                    "title_en" => $request->title_en,
                    "title_hi" => $request->title_hi,
                    "menu_id" => $request->menu_id,
                    "unit_id" => $request->unit_id,
                    "category_id" => $request->category_id,
                    "public_date" => $request->public_date,
                    "expiry_date" => $request->expiry_date,
                    "file_language" => $request->file_language,
                ];
                 if (!empty($request->file)) {
                    $image = $request->file('file');
                    $fileSize = $image->getSize();

                    $fileSize = $fileSize / 1024;
                    $fileSize = number_format((float)$fileSize, 2, '.', '');
                    if($fileSize > 1024){
                        $fileSize = $fileSize / 1024 .'MB';
                    }else{
                        $fileSize = $fileSize .'KB';
                    }

                    $fileType = $image->getMimeType();
                    $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                    $isFileUploaded = $this->uploadOne($image, config('constants.SITE_DOCUMENT_UPLOAD_PATH'), $fileName, 'public');
                    if ($isFileUploaded) {
                        $postData['file'] = $fileName;
                        $postData['file_size'] = $fileSize;
                        $postData['file_type'] = $fileType;
                    }
                }
                $details = Document::updateOrCreate(['id' => $id], $postData);
                if ($id == null) {
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log('Document Created, ID: ' . $details->id);
                    // Log Activity
                }else{
                    // Log Activity
                    activity()
                        ->causedBy(Auth::user())
                        ->withProperties(['ip_address' => request()->ip()])
                        ->log('Document Updated, ID: ' . $id);
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
            $data = ['status' => true, 'message' => $message, 'data' => $details ?? null, 'url' => route('admin.document.list')];
            return response($data);
        }
        $details = array();
        if (!empty($request->uuid)) {
            $uuid = uuidtoid($request->uuid, 'documents');
            $details = Document::find($uuid);
        }
         if(auth()->user()->unit_id != null){
            $units = Unit::where('id',auth()->user()->unit_id)->where('is_active',1)->get();
         }else{
              $units = Unit::where('is_active',1)->get();
         }
         $catagories = Category::where('is_active',1)->get();
        return view('admin.document.add', compact('details','units','catagories'));
    }
    public function order(Request $request)
    {
        if ($request->post()) {
            DB::beginTransaction();
            try {

                foreach ($request->order as $key => $value) {
                    Document::where('id', $value)->update(['position' => $key + 1]);
                }

                // Log Activity
                activity()
                    ->causedBy(Auth::user())
                    ->withProperties(['ip_address' => request()->ip()])
                    ->log('Document Order Updated');
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
            $data = ['status' => true, 'message' => '', 'data' => $details ?? null, 'url' => route('admin.document.list')];
            return response($data);
        }
    }
}
