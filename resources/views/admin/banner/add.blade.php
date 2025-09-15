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
                                <a href="{{ route('admin.banner.list') }}" class="text-muted text-hover-primary">Banner</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <h3 class="page-heading">
                                    Banner {{ !empty($details) ? 'Edit' : 'Add' }}</h3>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="container">
                                    <form id="bannerForm" action="{{ route('admin.banner.add') }}" method="POST"
                                        class="formSubmit fileUpload" enctype="multipart/form-data">
                                        <input type="hidden" name="id" name="id"
                                            value="{{ $details->id ?? null }}">
                                        <div class="col-md-8 m-auto text-center mb-5">
                                            <label>
                                                <span class="label_title">Banner Image</span>
                                                <span class="asterisk_sign">*</span>
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
                                            {{--  <div class="col-md-6 pt-4">
                                                <div class="form-group">
                                                    <label for="title_en" class="label-style">Title(en)</label>
                                                    <input type="text" class="form-control fromAlias"
                                                        placeholder="Enter Title" name="title_en" id="title_en"
                                                        value="{{ $details->title_en ?? null }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 pt-4">
                                                <div class="form-group">
                                                    <label for="title_hi" class="label-style">Title(hi)</label>

                                                    <input type="text" class="form-control fromAlias"
                                                        placeholder="Enter Title" name="title_hi" id="title_hi"
                                                        value="{{ $details->title_hi ?? null }}">
                                                </div>
                                            </div>  --}}
                                            <div class="col-md-4 pt-4">
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

                                            <div class="col-md-4 pt-4">
                                                <div class="form-group">
                                                    <label for="menu_id" class="label-style">Menu</label>
                                                    <span class="text-danger">*</span>
                                                    <select name="menu_id" class="form-control fromAlias select222"
                                                        id="menu_id">
                                                        <option value="">--- select one ----</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 pt-4">
                                                <div class="form-group">
                                                    <label for="publish_date" class="label-style">Publish Date</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="date" class="form-control fromAlias"
                                                        name="publish_date" id="publish_date"
                                                        value="{{ $details->publish_date ?? null }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4 pt-4">
                                                <div class="form-group">
                                                    <label for="expire_date" class="label-style">Expire Date</label>

                                                    <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="If the banner have not expire date then leave blank"></i>

                                                    <input type="date" class="form-control fromAlias"
                                                        name="expire_date" id="expire_date"
                                                        value="{{ $details->expire_date ?? null }}">
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
