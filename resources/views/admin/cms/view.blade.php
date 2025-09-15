@extends('layout.app')
@section('content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar d-block py-3 py-lg-6">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('admin.content.list') }}"
                                    class="text-muted text-hover-primary">Content</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <h3 class="page-heading">
                                    Content Details</h3>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <div class="card">
                            <div class="card-body">
                                <div class="row approve_review">
                                    @if (auth()->user()->can('all-status-change') || auth()->user()->id == $details->en_contant_writter_id)
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="status" class="form-label">English Writting</label>
                                                <select class="form-select contantStatusChnage" name="english_writting"
                                                    data-id="{{ $details->id }}"
                                                    data-field="english_contant_creator_status">
                                                    <option value="0"
                                                        {{ $details->english_contant_creator_status == 0 ? 'selected' : '' }}>
                                                        Pending</option>
                                                    <option value="1"
                                                        {{ $details->english_contant_creator_status == 1 ? 'selected' : '' }}>
                                                        Done</option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    @if (auth()->user()->can('all-status-change') || auth()->user()->id == $details->hi_contant_writter_id)
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Hindi Writting</label>
                                                <select class="form-select contantStatusChnage" name="hindi_writting"
                                                    data-id="{{ $details->id }}" data-field="hindi_contant_creator_status">
                                                    <option value="0"
                                                        {{ $details->hindi_contant_creator_status == 0 ? 'selected' : '' }}>
                                                        Pending</option>
                                                    <option value="1"
                                                        {{ $details->hindi_contant_creator_status == 1 ? 'selected' : '' }}>
                                                        Done</option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    @if (auth()->user()->can('all-status-change') || auth()->user()->id == $details->contant_reviewer_id)
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="status" class="form-label">English Review</label>
                                                <select class="form-select contantStatusChnage" name="english_review"
                                                    data-id="{{ $details->id }}" data-field="review_status">
                                                    <option value="0"
                                                        {{ $details->review_status == 0 ? 'selected' : '' }}>Pending
                                                    </option>
                                                    <option value="1"
                                                        {{ $details->review_status == 1 ? 'selected' : '' }}>Done</option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    @if (auth()->user()->can('all-status-change') || auth()->user()->id == $details->hindi_reviewer_id)
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Hindi Review</label>
                                                <select class="form-select contantStatusChnage" name="hindi_review"
                                                    data-id="{{ $details->id }}" data-field="hindi_reviewer_status">
                                                    <option value="0"
                                                        {{ $details->hindi_reviewer_status == 0 ? 'selected' : '' }}>
                                                        Pending</option>
                                                    <option value="1"
                                                        {{ $details->hindi_reviewer_status == 1 ? 'selected' : '' }}>Done
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    @if (auth()->user()->can('all-status-change') || auth()->user()->id == $details->contant_approver_id)
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="status" class="form-label">English Approval</label>
                                                <select class="form-select contantStatusChnage" name="english_approval"
                                                    data-id="{{ $details->id }}" data-field="approve_status">
                                                    <option value="0"
                                                        {{ $details->approve_status == 0 ? 'selected' : '' }}>Pending
                                                    </option>
                                                    <option value="1"
                                                        {{ $details->approve_status == 1 ? 'selected' : '' }}>Done</option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    @if (auth()->user()->can('all-status-change') || auth()->user()->id == $details->hindi_approver_id)
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Hindi Approval</label>
                                                <select class="form-select contantStatusChnage" name="hindi_approval"
                                                    data-id="{{ $details->id }}" data-field="hindi_approver_status">
                                                    <option value="0"
                                                        {{ $details->hindi_approver_status == 0 ? 'selected' : '' }}>
                                                        Pending</option>
                                                    <option value="1"
                                                        {{ $details->hindi_approver_status == 1 ? 'selected' : '' }}>Done
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <p><strong style="color:blue">English Content Create:</strong>
                                            @if ($details->english_contant_creator_status == 1)
                                                <span class="badge bg-success">YES</span>
                                            @else
                                                <span class="badge bg-danger">NO</span>
                                            @endif
                                        </p>
                                        <p><strong style="color:blue">Hindi Content Create:</strong>
                                            @if ($details->hindi_contant_creator_status == 1)
                                                <span class="badge bg-success">YES</span>
                                            @else
                                                <span class="badge bg-danger">NO</span>
                                            @endif
                                        </p>
                                        <p><strong style="color:blue">English Content Review:</strong>
                                            @if ($details->review_status == 1)
                                                <span class="badge bg-success">YES</span>
                                            @else
                                                <span class="badge bg-danger">NO</span>
                                            @endif
                                        </p>
                                        <p><strong style="color:blue">Hindi Content Review:</strong>
                                            @if ($details->hindi_reviewer_status == 1)
                                                <span class="badge bg-success">YES</span>
                                            @else
                                                <span class="badge bg-danger">NO</span>
                                            @endif
                                        </p>
                                        <p><strong style="color:blue">English Content Approve:</strong>
                                            @if ($details->approve_status == 1)
                                                <span class="badge bg-success">YES</span>
                                            @else
                                                <span class="badge bg-danger">NO</span>
                                            @endif
                                        </p>
                                        <p><strong style="color:blue">Hindi Content Approve:</strong>
                                            @if ($details->hindi_approver_status == 1)
                                                <span class="badge bg-success">YES</span>
                                            @else
                                                <span class="badge bg-danger">NO</span>
                                            @endif
                                        </p>

                                    </div>
                                    <div class="col-md-4">
                                        <p><strong style="color:blue">Title (EN):</strong> {{ $details->title_en }}</p>
                                        <p><strong style="color:blue">Title (HI):</strong> {{ $details->title_hi }}</p>
                                        <p><strong style="color:blue">View Type:</strong>
                                            {{ $details->view_type == 1 ? 'Description View' : 'List View' }}</p>
                                        <p><strong style="color:blue">Unit:</strong>
                                            {{ $details->unit->title_en ?? 'N/A' }}
                                        </p>
                                        <p><strong style="color:blue">Menu:</strong>
                                            {{ $details->menu->title_en ?? 'N/A' }}
                                        </p>
                                        <p><strong style="color:blue">Section:</strong>
                                            {{ $details->section->title ?? 'N/A' }}</p>
                                        <p><strong style="color:blue">Link:</strong> <a href="{{ $details->link }}"
                                                target="_blank">{{ $details->link }}</a></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><strong style="color:blue">Content Writer (EN):</strong>
                                            {{ $details->en_contant_writter->name ?? 'N/A' }}</p>
                                        <p><strong style="color:blue">Content Writer (HI):</strong>
                                            {{ $details->hi_contant_writter->name ?? 'N/A' }}</p>
                                        <p><strong style="color:blue">Content Approver:</strong>
                                            {{ $details->contant_approver->name ?? 'N/A' }}</p>
                                        <p><strong style="color:blue">Content Reviewer:</strong>
                                            {{ $details->contant_reviewer->name ?? 'N/A' }}</p>
                                        <p><strong style="color:blue">Date:</strong> {{ $details->date ?? 'N/A' }}</p>
                                        <p><strong style="color:blue">Publish Date:</strong>
                                            {{ $details->publish_date ?? 'N/A' }}</p>
                                        <p><strong style="color:blue">Expire Date:</strong>
                                            {{ $details->expire_date ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <h4 style="color:blue">Description (EN)</h4>
                                    <div>{!! $details->description_en !!}</div>
                                </div>
                                <div class="mt-5">
                                    <h4 style="color:blue">Description (HI)</h4>
                                    <div>{!! $details->description_hi !!}</div>
                                </div>
                                @if ($details->file != null)
                                    <div class="mt-5">
                                        <h4>Content Image</h4>
                                        <img src="{{ $details->image_path ?? '/assets/media/svg/files/blank-image.svg' }}"
                                            alt="Content Image" class="img-fluid">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
