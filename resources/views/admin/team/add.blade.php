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
                                <a href="{{ route('admin.team.list') }}" class="text-muted text-hover-primary">Team</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <h3 class="page-heading">
                                    Team/Director {{ !empty($details) ? 'Edit' : 'Add' }}</h3>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="container">
                                    <form id="teamForm" action="{{ route('admin.team.add') }}" method="POST"
                                        class="formSubmit fileUpload" enctype="multipart/form-data">
                                        <input type="hidden" name="id" name="id"
                                            value="{{ $details->id ?? null }}">
                                        <div class="col-md-8 m-auto text-center mb-5">
                                            <label>
                                                <span class="label_title">Team Image</span>

                                            </label>
                                            <div class="fv-row">
                                                @if (!empty($details->file))
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
                                                    <label for="name" class="label-style">Name</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="text" class="form-control fromAlias"
                                                        placeholder="Enter Name" name="name" id="name"
                                                        value="{{ $details->name ?? null }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 pt-4">
                                                <div class="form-group">
                                                    <label for="email" class="label-style">Email</label>

                                                    <input type="text" class="form-control fromAlias"
                                                        placeholder="Enter email" name="email" id="email"
                                                        value="{{ $details->email ?? null }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 pt-4">
                                                <div class="form-group">
                                                    <label for="mobile_no" class="label-style">Mobile Number</label>

                                                    <input type="text" class="form-control fromAlias"
                                                        placeholder="Enter mobile no" name="mobile_no" id="mobile_no"
                                                        value="{{ $details->mobile_no ?? null }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 pt-4">
                                                <div class="form-group">
                                                    <label for="location" class="label-style">Location</label>

                                                    <input type="text" class="form-control fromAlias"
                                                        placeholder="Enter Location" name="location" id="location"
                                                        value="{{ $details->location ?? null }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 pt-4">
                                                <div class="form-group">
                                                    <label for="designation_id" class="label-style">Designation</label>
                                                    <span class="text-danger">*</span>
                                                    <select name="designation_id" id="designation_id"
                                                        class="form-control select222">
                                                        <option value="">---- Select One ----</option>
                                                        @forelse ($designations as $designation)
                                                            <option value="{{ $designation->id }}"
                                                                @if (!empty($details)) {{ $designation->id == $details->designation_id ? 'selected' : '' }} @endif>
                                                                {{ $designation->title }}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 pt-4">
                                                <div class="form-group">
                                                    <label for="designation_others" class="label-style">Designation
                                                        Others</label>

                                                    <input type="text" class="form-control fromAlias"
                                                        placeholder="Enter Designation others" name="designation_others"
                                                        id="designation_others"
                                                        value="{{ $details->designation_others ?? null }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 pt-4">
                                                <div class="form-group">
                                                    <label for="designation" class="label-style">Show</label>
                                                    <span class="text-danger">*</span>
                                                    <select name="show" id="show" class="form-control select222">
                                                        <option value="0"
                                                            @if (!empty($details)) {{ $details->show == '0' ? 'selected' : '' }} @endif>
                                                            Show in header
                                                        </option>
                                                        <option value="1"
                                                            @if (!empty($details)) {{ $details->show == '1' ? 'selected' : '' }} @endif>
                                                            Show in listing
                                                        </option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 pt-4">
                                                <div class="form-group">
                                                    <label for="unit_id" class="label-style">Unit</label>
                                                    <span class="text-danger">*</span>
                                                    <select name="unit_id" class="form-control fromAlias select222"
                                                        id="unit_id">
                                                        <option value="">--- select one ----</option>
                                                        @forelse ($units as $unit)
                                                            <option value="{{ $unit->id }}"
                                                                @if ($details) {{ $unit->id == $details->unit_id ? 'selected' : '' }} @endif>
                                                                {{ $unit->title_en }}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 pt-4">
                                                <div class="form-group">
                                                    <label for="menu_id" class="label-style">Menu</label>
                                                    <span class="text-danger">*</span>
                                                    <select name="menu_id" class="form-control fromAlias select222"
                                                        id="menu_id">
                                                        <option value="">--- select one ----</option>
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
        <script>
            $(document).ready(function() {
                  const baseUrl = '{{ env('APP_URL') }}'
                function loadMenus(unitId, selectedMenuId = null) {
                    $('#menu_id').html('<option value="">Loading...</option>');

                    if (unitId) {
                        $.ajax({
                             url: baseUrl + 'admin/content/get-menus-by-unit/' + unitId,
                            type: 'GET',
                            success: function(res) {
                                let options = '<option value="">--- Select Menu ---</option>';
                                $.each(res, function(key, menu) {
                                    let selected = (selectedMenuId && menu.id == selectedMenuId) ?
                                        'selected' : '';
                                    options +=
                                        `<option value="${menu.id}" ${selected}>${menu.title_en}</option>`;
                                });
                                $('#menu_id').html(options);
                            },
                            error: function() {
                                $('#menu_id').html('<option value="">Error loading</option>');
                            }
                        });
                    } else {
                        $('#menu_id').html('<option value="">--- Select Menu ---</option>');
                    }
                }

                $('#unit_id').on('change', function() {
                    let unitId = $(this).val();
                    loadMenus(unitId);
                });

                // 🔄 When editing, trigger menu load + preselect
                @if (!empty($details))
                    let presetUnit = '{{ $details->unit_id }}';
                    let presetMenu = '{{ $details->menu_id }}';
                    loadMenus(presetUnit, presetMenu);
                @endif
            });
        </script>
    @endpush
@endsection
