<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cms;
use App\Models\Menu;
use App\Models\User;
use App\Models\Unit;
use App\Models\Section;
use App\Traits\UploadAble;
use App\Traits\NotificationTrait;
use Illuminate\Http\Request;
use App\Traits\CommonFunction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Facades\Activity;
use Illuminate\Support\Str;

class CmsController extends BaseController
{
    use CommonFunction;
    use UploadAble;
    use NotificationTrait;
    public function index(Request $request)
    {
        $today = date('Y-m-d');
        if (auth()->user()->can('active-content')) {
            if (auth()->user()->can('specific-unit')) {
                $details_active = Cms::where('unit_id', auth()->user()->unit_id)
                    ->where(function ($q) {
                        if (auth()->user()->can('my-content')) {
                            $q->orWhere('contant_reviewer_id', auth()->user()->id)
                                ->orWhere('hindi_approver_id', auth()->user()->id)
                                ->orWhere('hindi_reviewer_id', auth()->user()->id)
                                ->orWhere('contant_approver_id', auth()->user()->id)
                                ->orWhere('hi_contant_writter_id', auth()->user()->id)
                                ->orWhere('en_contant_writter_id', auth()->user()->id);
                        }
                    })
                    ->where('is_archived',  0)
                    ->orderBy('position', 'ASC')
                    ->latest()
                    ->get();
            } else {
                $details_active = Cms::orderBy('position', 'ASC')->where('is_archived',  0)->latest()->get();
            }
        } else {
            $details_active = [];
        }


        if (auth()->user()->can('archived-content')) {
            if (auth()->user()->can('specific-unit')) {
                $details_archive = Cms::where('unit_id', auth()->user()->unit_id)
                    ->where(function ($q) {
                        if (auth()->user()->can('my-content')) {
                            $q->orWhere('contant_reviewer_id', auth()->user()->id)
                                ->orWhere('contant_approver_id', auth()->user()->id)
                                ->orWhere('hindi_approver_id', auth()->user()->id)
                                ->orWhere('hindi_reviewer_id', auth()->user()->id)
                                ->orWhere('hi_contant_writter_id', auth()->user()->id)
                                ->orWhere('en_contant_writter_id', auth()->user()->id);
                        }
                    })
                    ->where('is_archived',  1)
                    ->orderBy('position', 'ASC')
                    ->latest()
                    ->get();
            } else {
                $details_archive = Cms::where('is_archived',  1)->orderBy('position', 'ASC')->latest()->get();
            }
        } else {
            $details_archive = [];
        }
        return view('admin.cms.index', compact('details_active', 'details_archive'));
    }
    public function add(Request $request)
    {
        if ($request->post()) {
            $id = $request->id ?? NULL;
            $rules = [
                'title_en' => $request->need_content_writter == 'no' ? 'required' : 'nullable',
                'title_hi' => $request->need_content_writter == 'no' ? 'required' : 'nullable',
                'description_en' => $request->need_content_writter == 'no' ? 'required' : 'nullable',
                'description_hi' => $request->need_content_writter == 'no' ? 'required' : 'nullable',
                'task' => $request->need_content_writter == 'yes' ? 'required' : 'nullable',
                'link' => 'sometimes',
                'date' => 'sometimes',
                'unit_id' => 'sometimes|required|exists:units,id',
                'menu_id' => 'sometimes|required|exists:menus,id',
                'section_id' => 'nullable|exists:sections,id',
                'view_type' => 'required|in:1,2',
                'redirect_to' => 'nullable|in:0,1,2,3',
                'need_content_writter' => 'required',
                'en_contant_writter_id' => $request->need_content_writter == 'yes' ? 'required|exists:users,id' : 'nullable|exists:users,id',
                'hi_contant_writter_id' => $request->need_content_writter == 'yes' ? 'required|exists:users,id' : 'nullable|exists:users,id',
                'contant_approver_id' => $request->need_content_writter == 'yes' ? 'required|exists:users,id' : 'nullable|exists:users,id',
                'contant_reviewer_id' => $request->need_content_writter == 'yes' ? 'required|exists:users,id' : 'nullable|exists:users,id',
                'hindi_approver_id' => $request->need_content_writter == 'yes' ? 'required|exists:users,id' : 'nullable|exists:users,id',
                'hindi_reviewer_id' => $request->need_content_writter == 'yes' ? 'required|exists:users,id' : 'nullable|exists:users,id',
                'publish_date' => 'required|date',
                'expire_date' => 'nullable|date',
                'otp' => 'required',
                'digits:6',
                'captcha'  => 'required'
            ];

            $messages = [
                'unit_id.required' => 'Unit is required',
                'menu_id.required' => 'Menu is required',
                'view_type.required' => 'View type is required',
                'redirect_to.in' => 'Invalid redirect option',
                'need_content_writter.required' => 'Content writer is required',
                'en_contant_writter_id.required' => 'English content writer is required',
                'hi_contant_writter_id.required' => 'Hindi content writer is required',
                'contant_approver_id.required' => 'Content approver is required',
                'contant_reviewer_id.required' => 'Content reviewer is required',
                'otp.required' => 'OTP is required',
                'captcha.required' => 'Captcha is required'
            ];

            if ($id) {
                // On update, file is optional
                $message = "Content Updated Successfully";
                $rules['file'] = 'nullable|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf,csv,xls,xlsx|max:5120';
            } else {
                // On create, file is required
                $message = "Content Created Successfully";
                $rules['file'] = 'nullable|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf,csv,xls,xlsx|max:5120';
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
                    "title_en" => $request->title_en ?? NULL,
                    "slug" => Str::slug($request->title_en) ?? NULL,
                    "title_hi" => $request->title_hi ?? NULL,
                    "description_en" => $request->description_en ?? NULL,
                    "description_hi" => $request->description_hi ?? NULL,
                    "unit_id" => $request->unit_id ?? NULL,
                    "menu_id" => $request->menu_id ?? NULL,
                    "section_id" => $request->section_id ?? NULL,
                    "link" => $request->link ?? NULL,
                    "date" => $request->date ?? NULL,
                    "view_type" => $request->view_type ?? NULL,
                    "redirect_to" => $request->redirect_to ?? NULL,
                    "need_content_writter" => $request->need_content_writter ?? NULL,
                    "en_contant_writter_id" => $request->en_contant_writter_id ?? NULL,
                    "hi_contant_writter_id" => $request->hi_contant_writter_id ?? NULL,
                    "hindi_reviewer_id" => $request->hindi_reviewer_id ?? NULL,
                    "hindi_approver_id" => $request->hindi_approver_id ?? NULL,
                    "contant_approver_id" => $request->contant_approver_id ?? NULL,
                    "contant_reviewer_id" => $request->contant_reviewer_id ?? NULL,
                    "hindi_approver_id" => $request->hindi_approver_id ?? NULL,
                    "hindi_reviewer_id" => $request->hindi_reviewer_id ?? NULL,
                    "publish_date" => $request->publish_date ?? NULL,
                    "expire_date" => $request->expire_date ?? NULL,
                    "task" => $request->task ?? NULL,
                ];
                if (!empty($request->file)) {
                    $image = $request->file('file');
                    $fileSize = $image->getSize();

                    $fileSize = $fileSize / 1024;
                    $fileSize = number_format((float)$fileSize, 2, '.', '');
                    if ($fileSize > 1024) {
                        $fileSize = $fileSize / 1024 . 'MB';
                    } else {
                        $fileSize = $fileSize . 'KB';
                    }

                    $fileType = $image->getMimeType();
                    $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                    $isFileUploaded = $this->uploadOne($image, config('constants.SITE_CMS_UPLOAD_PATH'), $fileName, 'public');
                    if ($isFileUploaded) {
                        $postData['file'] = $fileName;
                        $postData['file_size'] = $fileSize;
                        $postData['file_type'] = $fileType;
                    }
                }
                if ($request->need_content_writter == 'no') {
                    $postData['approve_status'] = '1';
                    $postData['review_status'] = '1';
                    $postData['hindi_approver_status'] = '1';
                    $postData['hindi_reviewer_status'] = '1';
                    $postData['hindi_contant_creator_status'] = '1';
                    $postData['english_contant_creator_status'] = '1';
                }
                $details = Cms::updateOrCreate(['id' => $id], $postData);

                // if ($request->need_content_writter == 'yes') {
                //         $data = [
                //             'user_id' => $request->en_contant_writter_id,
                //             'title' => $request->title_en,
                //         ];
                //         $this->saveNotification($data);
                //         $data1 = [
                //             'user_id' => $request->hi_contant_writter_id,
                //             'title' => $request->title_en,
                //         ];
                //         $this->saveNotification($data1);

                // }

                // Log Activity
                activity()
                    ->causedBy(Auth::user())
                    ->withProperties(['ip_address' => request()->ip()])
                    ->log('Content Created, ID: ' . $details->id);
                // Log Activity


                DB::Commit();
            } catch (\Throwable $th) {
                DB::rollback();
                $status = false;
                $code = 500;
                $response = ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()];
                $message = config('constants.CATCH_ERROR_MSG');
                return $this->responseJson($status, $code, $message, $response);
            }
            $data = ['status' => true, 'message' => $message, 'data' => $details ?? null, 'url' => route('admin.content.list')];
            return response($data);
        }
        $details = array();
        if (!empty($request->uuid)) {
            $uuid = uuidtoid($request->uuid, 'cms');
            $details = Cms::find($uuid);
        }


        if (auth()->user()->unit_id != null) {
            $units  = Unit::where('id', auth()->user()->unit_id)->where('is_active', 1)->get();
            $en_contant_writters = User::where('unit_id', auth()->user()->unit_id)->whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($q) {
                    $q->whereIn('slug', ['add-edit-all-content-details','add-edit-english-content-details']);
                });
            })->where('is_active', 1)->get();
            $hi_contant_writters = User::where('unit_id', auth()->user()->unit_id)->whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($q) {
                    $q->whereIn('slug', ['add-edit-all-content-details','add-edit-hindi-content-details']);
                });
            })->where('is_active', 1)->get();
            $contant_approvers = User::where('unit_id', auth()->user()->unit_id)->whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($q) {
                    $q->where('slug', 'content-approve-review');
                });
            })->where('is_active', 1)->get();
            $contant_reviewers = User::where('unit_id', auth()->user()->unit_id)->whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($q) {
                    $q->where('slug', 'content-approve-review');
                });
            })->where('is_active', 1)->get();
            $hindi_contant_approvers = User::where('unit_id', auth()->user()->unit_id)->whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($q) {
                    $q->where('slug', 'content-approve-review');
                });
            })->where('is_active', 1)->get();
            $hindi_contant_reviewers = User::where('unit_id', auth()->user()->unit_id)->whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($q) {
                    $q->where('slug', 'content-approve-review');
                });
            })->where('is_active', 1)->get();
        } else {
            $units  = Unit::where('is_active', 1)->get();
            $en_contant_writters = User::whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($q) {
                   $q->whereIn('slug', ['add-edit-all-content-details','add-edit-english-content-details']);
                });
            })->where('is_active', 1)->get();
            $hi_contant_writters = User::whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($q) {
                   $q->whereIn('slug', ['add-edit-all-content-details','add-edit-hindi-content-details']);
                });
            })->where('is_active', 1)->get();
            $contant_approvers = User::whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($q) {
                    $q->where('slug', 'content-approve-review');
                });
            })->where('is_active', 1)->get();
            $contant_reviewers = User::whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($q) {
                    $q->where('slug', 'content-approve-review');
                });
            })->where('is_active', 1)->get();
            $hindi_contant_approvers = User::whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($q) {
                    $q->where('slug', 'content-approve-review');
                });
            })->where('is_active', 1)->get();
            $hindi_contant_reviewers = User::whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($q) {
                    $q->where('slug', 'content-approve-review');
                });
            })->where('is_active', 1)->get();
        }
        if (empty($request->uuid)) {
            return view('admin.cms.add', compact('details', 'units', 'en_contant_writters', 'contant_approvers', 'contant_reviewers', 'hi_contant_writters','hindi_contant_approvers','hindi_contant_reviewers'));
        } else {
            return view('admin.cms.edit', compact('details', 'units', 'en_contant_writters', 'contant_approvers', 'contant_reviewers', 'hi_contant_writters','hindi_contant_approvers','hindi_contant_reviewers'));
        }
    }

    public function edit(Request $request)
    {
        if ($request->post()) {
            $id = $request->id ?? NULL;
            if (auth()->user()->can('add-edit-all-content-details')) {
                $rules = [
                    'title_en' => $request->need_content_writter == 'no' ? 'required' : 'nullable',
                    'title_hi' => $request->need_content_writter == 'no' ? 'required' : 'nullable',
                    'description_en' => $request->need_content_writter == 'no' ? 'required' : 'nullable',
                    'description_hi' => $request->need_content_writter == 'no' ? 'required' : 'nullable',
                    'task' => $request->need_content_writter == 'yes' ? 'required' : 'nullable',
                    'link' => 'sometimes',
                    'date' => 'sometimes',
                    'unit_id' => 'sometimes|required|exists:units,id',
                    'menu_id' => 'sometimes|required|exists:menus,id',
                    'section_id' => 'nullable|exists:sections,id',
                    'view_type' => 'required|in:1,2',
                    'redirect_to' => 'nullable|in:0,1,2,3',
                    'need_content_writter' => 'required',
                    'en_contant_writter_id' => $request->need_content_writter == 'yes' ? 'required|exists:users,id' : 'nullable|exists:users,id',
                    'hi_contant_writter_id' => $request->need_content_writter == 'yes' ? 'required|exists:users,id' : 'nullable|exists:users,id',
                    'contant_approver_id' => $request->need_content_writter == 'yes' ? 'required|exists:users,id' : 'nullable|exists:users,id',
                    'contant_reviewer_id' => $request->need_content_writter == 'yes' ? 'required|exists:users,id' : 'nullable|exists:users,id',
                    'hindi_reviewer_id' => $request->need_content_writter == 'yes' ? 'required|exists:users,id' : 'nullable|exists:users,id',
                    'hindi_approver_id' => $request->need_content_writter == 'yes' ? 'required|exists:users,id' : 'nullable|exists:users,id',
                    'publish_date' => 'required|date',
                    'expire_date' => 'nullable|date',
                    'otp' => 'required',
                    'digits:6',
                    'captcha'  => 'required',
                ];
                if ($id) {
                    $message = "Content Updated Successfully";
                    $rules['file'] = 'sometimes|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf,csv,xls,xlsx|max:5120';
                } else {
                    $message = "Content Created Successfully";
                    $rules['file'] = 'sometimes|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf,csv,xls,xlsx|max:5120';
                }
            }elseif (!auth()->user()->can('add-edit-all-content-details') && auth()->user()->can('add-edit-english-content-details')) {
                $rules = [
                    'title_en' => 'nullable',
                    'description_en' => 'nullable',
                    'otp' => 'required',
                    'digits:6',
                    'captcha'  => 'required'
                ];
                if ($id) {
                    $message = "Content Updated Successfully";
                } else {
                    $message = "Content Created Successfully";
                }
            }
            elseif (!auth()->user()->can('add-edit-all-content-details') && auth()->user()->can('add-edit-hindi-content-details')) {
                $rules = [
                    'title_hi' => 'nullable',
                    'description_hi' => 'nullable',
                    'otp' => 'required',
                    'digits:6',
                    'captcha'  => 'required'
                ];
                if ($id) {
                    $message = "Content Updated Successfully";
                } else {
                    $message = "Content Created Successfully";
                }
            }

            $validated = $request->validate($rules);
            DB::beginTransaction();
            try {

                $otp = $request->otp;
                $response = $this->verifyOTP($otp);
                if (!$response['status']) {
                    return $response;
                }

                if (auth()->user()->can('add-edit-all-content-details')) {
                    $postData = [
                        "title_en" => $request->title_en ?? NULL,
                        "slug" => Str::slug($request->title_en) ?? NULL,
                        "title_hi" => $request->title_hi ?? NULL,
                        "description_en" => $request->description_en ?? NULL,
                        "description_hi" => $request->description_hi ?? NULL,
                        "unit_id" => $request->unit_id ?? NULL,
                        "menu_id" => $request->menu_id ?? NULL,
                        "section_id" => $request->section_id ?? NULL,
                        "link" => $request->link ?? NULL,
                        "date" => $request->date ?? NULL,
                        "view_type" => $request->view_type ?? NULL,
                        "redirect_to" => $request->redirect_to ?? NULL,
                        "need_content_writter" => $request->need_content_writter ?? NULL,
                        "en_contant_writter_id" => $request->en_contant_writter_id ?? NULL,
                        "hi_contant_writter_id" => $request->hi_contant_writter_id ?? NULL,
                        "hindi_reviewer_id" => $request->hindi_reviewer_id ?? NULL,
                        "hindi_approver_id" => $request->hindi_approver_id ?? NULL,
                        "contant_approver_id" => $request->contant_approver_id ?? NULL,
                        "contant_reviewer_id" => $request->contant_reviewer_id ?? NULL,
                        "publish_date" => $request->publish_date ?? NULL,
                        "expire_date" => $request->expire_date ?? NULL,
                        "task" => $request->task ?? NULL,
                    ];
                    if (!empty($request->file)) {
                        $image = $request->file('file');
                        $fileSize = $image->getSize();

                        $fileSize = $fileSize / 1024;
                        $fileSize = number_format((float)$fileSize, 2, '.', '');
                        if ($fileSize > 1024) {
                            $fileSize = $fileSize / 1024 . 'MB';
                        } else {
                            $fileSize = $fileSize . 'KB';
                        }

                        $fileType = $image->getMimeType();
                        $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                        $isFileUploaded = $this->uploadOne($image, config('constants.SITE_CMS_UPLOAD_PATH'), $fileName, 'public');
                        if ($isFileUploaded) {
                            $postData['file'] = $fileName;
                            $postData['file_size'] = $fileSize;
                            $postData['file_type'] = $fileType;
                        }
                    }
                    // if ($request->need_content_writter == 'no') {
                    //     $postData['approve_status'] = '1';
                    //     $postData['review_status'] = '1';
                    //     $postData['hindi_approver_status'] = '1';
                    //     $postData['hindi_reviewer_status'] = '1';
                    //     $postData['hindi_contant_creator_status'] = '1';
                    //     $postData['english_contant_creator_status'] = '1';
                    // }

                    // if ($request->need_content_writter == 'yes') {
                    //     if ($request->en_contant_writter_id != null) {
                    //         $data = [
                    //             'user_id' => $request->en_contant_writter_id,
                    //             'title' => $request->title_en,
                    //         ];
                    //         $this->saveNotification($data);
                    //     }

                    //     if ($request->hi_contant_writter_id != null) {
                    //         $data1 = [
                    //             'user_id' => $request->hi_contant_writter_id,
                    //             'title' => $request->title_en,
                    //         ];
                    //         $this->saveNotification($data1);
                    //     }
                    // }
                } elseif (!auth()->user()->can('add-edit-all-content-details') && auth()->user()->can('add-edit-english-content-details')) {
                    $postData = [
                        "title_en" => $request->title_en ?? NULL,
                        "slug" => Str::slug($request->title_en) ?? NULL,
                        "description_en" => $request->description_en ?? NULL,
                    ];
                } elseif (!auth()->user()->can('add-edit-all-content-details') && auth()->user()->can('add-edit-hindi-content-details')) {
                    $postData = [
                        "title_hi" => $request->title_hi ?? NULL,
                        "description_hi" => $request->description_hi ?? NULL,
                    ];
                }
                $details = Cms::updateOrCreate(['id' => $id], $postData);

                activity()
                    ->causedBy(Auth::user())
                    ->withProperties(['ip_address' => request()->ip()])
                    ->log('Content Updated, ID: ' . $id);


                DB::Commit();
            } catch (\Throwable $th) {
                DB::rollback();
                $status = false;
                $code = 500;
                $response = ['Message' => $th->getMessage(), 'File Path' => $th->getFile(), 'Line Number' => $th->getLine()];
                $message = config('constants.CATCH_ERROR_MSG');
                return $this->responseJson($status, $code, $message, $response);
            }
            $data = ['status' => true, 'message' => $message, 'data' => $details ?? null, 'url' => route('admin.content.list')];
            return response($data);
        }
        $details = array();
        if (!empty($request->uuid)) {
            $uuid = uuidtoid($request->uuid, 'cms');
            $details = Cms::find($uuid);
        }

        if (auth()->user()->unit_id != null) {
            $units  = Unit::where('id', auth()->user()->unit_id)->where('is_active', 1)->get();
            $en_contant_writters = User::where('unit_id', auth()->user()->unit_id)->whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($q) {
                    $q->whereIn('slug', ['add-edit-all-content-details','add-edit-english-content-details']);
                });
            })->where('is_active', 1)->get();
            $hi_contant_writters = User::where('unit_id', auth()->user()->unit_id)->whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($q) {
                    $q->whereIn('slug', ['add-edit-all-content-details','add-edit-hindi-content-details']);
                });
            })->where('is_active', 1)->get();
            $contant_approvers = User::where('unit_id', auth()->user()->unit_id)->whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($q) {
                    $q->where('slug', 'content-approve-review');
                });
            })->where('is_active', 1)->get();
            $contant_reviewers = User::where('unit_id', auth()->user()->unit_id)->whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($q) {
                    $q->where('slug', 'content-approve-review');
                });
            })->where('is_active', 1)->get();
            $hindi_contant_approvers = User::where('unit_id', auth()->user()->unit_id)->whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($q) {
                    $q->where('slug', 'content-approve-review');
                });
            })->where('is_active', 1)->get();
            $hindi_contant_reviewers = User::where('unit_id', auth()->user()->unit_id)->whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($q) {
                    $q->where('slug', 'content-approve-review');
                });
            })->where('is_active', 1)->get();
        } else {
            $units  = Unit::where('is_active', 1)->get();
            $en_contant_writters = User::whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($q) {
                   $q->whereIn('slug', ['add-edit-all-content-details','add-edit-english-content-details']);
                });
            })->where('is_active', 1)->get();
            $hi_contant_writters = User::whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($q) {
                   $q->whereIn('slug', ['add-edit-all-content-details','add-edit-hindi-content-details']);
                });
            })->where('is_active', 1)->get();
            $contant_approvers = User::whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($q) {
                    $q->where('slug', 'content-approve-review');
                });
            })->where('is_active', 1)->get();
            $contant_reviewers = User::whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($q) {
                    $q->where('slug', 'content-approve-review');
                });
            })->where('is_active', 1)->get();
            $hindi_contant_approvers = User::whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($q) {
                    $q->where('slug', 'content-approve-review');
                });
            })->where('is_active', 1)->get();
            $hindi_contant_reviewers = User::whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($q) {
                    $q->where('slug', 'content-approve-review');
                });
            })->where('is_active', 1)->get();
        }
        if (empty($request->uuid)) {
            return view('admin.cms.add', compact('details', 'units', 'en_contant_writters', 'contant_approvers', 'contant_reviewers', 'hi_contant_writters','hindi_contant_approvers','hindi_contant_reviewers'));
        } else {
            return view('admin.cms.edit', compact('details', 'units', 'en_contant_writters', 'contant_approvers', 'contant_reviewers', 'hi_contant_writters','hindi_contant_approvers','hindi_contant_reviewers'));
        }
    }

    public function view($uuid)
    {
        $details = Cms::find(uuidtoid($uuid, 'cms'));
        return view('admin.cms.view', compact('details'));
    }
    public function getSections($menu_id)
    {
        $sections = Section::where('menu_id', $menu_id)->where('is_active', 1)->select('id', 'title')->get();
        return response()->json($sections);
    }
    public function getUnits($unit_id)
    {
        $menus = Menu::where('unit_id', $unit_id)->where('is_active', 1)
            ->whereDoesntHave('children')
            ->select('id', 'title_en')->orderBy('position', 'ASC')
            ->get();
        return response()->json($menus);
    }
    public function getMenus($unit_id)
    {
        $menus = Menu::where('unit_id', $unit_id)->where('is_active', 1)->orderBy('position', 'ASC')->get();
        return response()->json($menus);
    }
    public function order(Request $request)
    {
        if ($request->post()) {
            DB::beginTransaction();
            try {

                foreach ($request->order as $key => $value) {
                    Cms::where('id', $value)->update(['position' => $key + 1]);
                }

                // Log Activity
                activity()
                    ->causedBy(Auth::user())
                    ->withProperties(['ip_address' => request()->ip()])
                    ->log('Cms Order Updated');
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
