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
                                <a href="{{ route('admin.user.list') }}" class="text-muted text-hover-primary">User</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <h3 class="page-heading">
                                    User {{ !empty($details) ? 'Edit' : 'Add' }}</h3>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="container">
                                    <form id="userForm" action="{{ route('admin.user.add') }}" method="POST"
                                        class="formSubmit fileUpload" enctype="multipart/form-data">
                                        <input type="hidden" name="id" name="id"
                                            value="{{ $details->id ?? null }}">
                                        <div class="col-md-8 m-auto text-center mb-5">
                                            <label>
                                                <span class="label_title">User Image</span>
                                                <span class="asterisk_sign">*</span>
                                            </label>
                                            <div class="fv-row">
                                                @if (!empty($details->profile_image))
                                                    <style>
                                                        .image-input-placeholder {
                                                            background-image: url('{{ $details->image_path }}');
                                                        }

                                                        [data-bs-theme="dark"] .image-input-placeholder {
                                                            background-image: url('{{ $details->image_path }}');
                                                        }
                                                    </style>
                                                @else
                                                    <style>
                                                        .image-input-placeholder {
                                                            background-image: url('/assets/media/svg/files/blank-image.svg');
                                                        }

                                                        [data-bs-theme="dark"] .image-input-placeholder {
                                                            background-image: url('/assets/media/svg/files/blank-image-dark.svg');
                                                        }
                                                    </style>
                                                @endif
                                                <div class="image-input image-input-empty image-input-outline image-input-placeholder"
                                                    data-kt-image-input="true">
                                                    <div class="image-input-wrapper w-125px h-125px"></div>
                                                    <label
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                        title="Add image">
                                                        <div class="img_edit_btn_icon">
                                                            <i class="fa-solid fa-pen"></i>
                                                        </div>
                                                        <input type="file" name="file" accept=".png, .jpg, .jpeg"
                                                            id="file" />
                                                        <input type="hidden" name="avatar_remove" />
                                                    </label>
                                                    <span
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                        title="Cancel image">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </span>
                                                    <span
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                        title="Remove logo">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>
                                                </div>
                                                <div class="form-text" style="font-size: 10px; color: red !important;">
                                                    <p>Allowed file types: png, jpg, jpeg.</p>
                                                    <p>Max Size : 5mb</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row align-items-end">

                                            <div class="col-md-6 pt-4">
                                                <div class="form-group">
                                                    <label for="role_id" class="label-style">Role</label>
                                                    <span class="astrict_sign">*</span>
                                                    <select name="role_id" id="role_id" class="form-control select222">
                                                        <option value="">--- Select Role ---</option>
                                                        @forelse ($roles as $roleItem)
                                                            <option value="{{ $roleItem->uuid }}"
                                                                {{ !empty($details) && $details->roles()->first()->uuid == $roleItem->uuid ? 'selected' : '' }}>
                                                                {{ $roleItem->name }}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 pt-4">
                                                <div class="form-group">
                                                    <label for="unit_id" class="label-style">Unit</label>
                                                    <select name="unit_id" id="unit_id" class="form-control select222">
                                                        <option value="">--- Select Unit ---</option>
                                                        @forelse ($units as $unit)
                                                            <option value="{{ $unit->id }}"
                                                                {{ !empty($details) && $details->unit_id == $unit->id ? 'selected' : '' }}>
                                                                {{ $unit->title_en }}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 pt-4">
                                                <div class="form-group">
                                                    <label for="name" class="label-style">Name</label>
                                                    <span class="astrict_sign">*</span>
                                                    <input type="text" class="form-control fromAlias"
                                                        placeholder="Enter Name" name="name" id="name"
                                                        value="{{ $details->name ?? null }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 pt-4">
                                                <div class="form-group">
                                                    <label for="mobile_number" class="label-style">Mobile Number</label>
                                                    <span class="astrict_sign">*</span>
                                                    <input type="text" class="form-control number-only"
                                                        placeholder="Enter mobile number" maxlength="10"
                                                        name="mobile_number" id="mobile_number"
                                                        value="{{ $details->mobile_number ?? null }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 pt-4">
                                                <div class="form-group">
                                                    <label for="email" class="label-style">Email</label>
                                                    <span class="astrict_sign">*</span>
                                                    <input type="text" class="form-control" placeholder="Enter Email"
                                                        name="email" id="email"
                                                        value="{{ $details->email ?? null }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 pt-4">
                                                <div class="form-group">
                                                    <label for="designation_id" class="label-style">Designation</label>
                                                    <span class="astrict_sign">*</span>
                                                    <select name="designation_id" id="designation_id"
                                                        class="form-control select222">
                                                        <option value="">--- Select Designation ---</option>
                                                        @forelse ($designations as $designation)
                                                            <option value="{{ $designation->id }}"
                                                                {{ !empty($details) && $details->designation_id == $designation->id ? 'selected' : '' }}>
                                                                {{ $designation->title }}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                    </div>
                                            </div>
                                            @include('.admin.otp_verification_and_catcha_form')

                                            <div class="col-md-6">
                                                <div class="button add-btn-div-save-style">
                                                    <button type="submit" id="submitBtn" class="btn btn-dark">
                                                        <span
                                                            class="indicator-label">{{ !empty($details) ? 'Update' : 'Save' }}</span>
                                                        <span class="indicator-progress">Please wait...
                                                            <span
                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('script')
        <script></script>
    @endpush
@endsection
