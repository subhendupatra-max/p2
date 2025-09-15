<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserBusiness;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use App\Traits\CommonFunction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;

class BusinessController extends BaseController
{
    use CommonFunction;
    use UploadAble;
    public function index(Request $request)
    {
        $query = UserBusiness::latest()->latest();
        if (($request->type == 1 || $request->type == 2) && $request->type != null) {
            $query->where('is_active', $request->type == 2 ? 0 : 1);
        }
        if ($search = $request->search) {
            $query->where('name', 'like', "%{$search}%")
            ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
            })
            ->orWhereHas('category', function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%');
            })
            ->orWhere('abn', $search)
            ->orWhere('full_address', $search);
        }
        $details = $query->paginate(10);
        return view('admin.business.index', compact('details'));
    }
    public function add(Request $request)
    {
        if ($request->post()) {
            $id = $request->id ?? NULL;
            if (!empty($id)) {
                $request->validate([
                    'title' => 'required|string',
                    'slug' => 'required|string',
                    'description' => 'required|string'
                ]);
                $message = "Business Updated Successfully";
            } else {
                $request->validate([
                    'title' => 'required|string',
                    'slug' => 'required|string',
                    'description' => 'required|string',
                    'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ]);
                $message = "Business Created Successfully";
            }

            DB::beginTransaction();
            try {
                $postData = [
                    "title" => $request->title,
                    "slug" => $request->slug,
                    "description" => $request->description,
                    "meta_data" => $request->meta_data,
                    "meta_title" => $request->meta_title,
                    "meta_description" => $request->meta_description,
                ];
                if (!empty($request->file)) {
                    $image = $request->file;
                    $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                    $isFileUploaded = $this->uploadOne($image, config('constants.SITE_BLOG_UPLOAD_PATH'), $fileName, 'public');
                    if ($isFileUploaded) {
                        $postData['file'] = $fileName;
                    }
                }
                $details = UserBusiness::updateOrCreate(['id' => $id], $postData);
                DB::Commit();
            } catch (\Throwable $th) {
                DB::rollback();
                $status = false;
                $code = 500;
                $response = ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()];
                $message = config('constants.CATCH_ERROR_MSG');
                return $this->responseJson($status, $code, $message, $response);
            }
            $data = ['status' => true, 'message' => $message, 'data' => $details ?? null, 'url' => route('admin.business.list')];
            return response($data);
        }
        $details = array();
        if (!empty($request->uuid)) {
            $uuid = uuidtoid($request->uuid, 'business');
            $details = UserBusiness::find($uuid);
        }
        return view('admin.business.add', compact('details'));
    }
}
