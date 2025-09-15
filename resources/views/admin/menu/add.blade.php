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
                                <a href="{{ route('admin.menu.list') }}" class="text-muted text-hover-primary">Menu</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <h3 class="page-heading">
                                    Menu {{ !empty($details) ? 'Edit' : 'Add' }}</h3>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="container">
                                    <form id="menuForm" action="{{ route('admin.menu.add') }}" method="POST"
                                        class="formSubmit fileUpload" enctype="multipart/form-data">
                                        <input type="hidden" name="id" name="id"
                                            value="{{ $details->id ?? null }}">
                                        <div class="col-md-8 m-auto text-center mb-5">
                                            <label>
                                                <span class="label_title">Menu Banner(Page header banner)</span>

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
                                                    <label for="title_en" class="label-style">Title(en)</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="text" class="form-control fromAlias"
                                                        placeholder="Enter Title" name="title_en" id="title_en"
                                                        value="{{ $details->title_en ?? null }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 pt-4">
                                                <div class="form-group">
                                                    <label for="title_hi" class="label-style">Title(hi)</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="text" class="form-control fromAlias"
                                                        placeholder="Enter Title" name="title_hi" id="title_hi"
                                                        value="{{ $details->title_hi ?? null }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="extend_to" class="label-style">Extend To</label>
                                                    <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-placement="top" title="If this is not muster page then take extend to otherwise load a blank page "></i>
                                                    <select class="form-control select222" name="extend_to" id="extend_to">
                                                        <option value="">--- Select One ---</option>
                                                        @forelse($extend_tos as $extend_to)
                                                            <option value="{{ $extend_to->id }}"
                                                                @if (!empty($details) && $extend_to->id == $details->extend_to) {{ 'selected' }} @endif>
                                                                {{ $extend_to->title }}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="unit_id" class="label-style">Unit</label><span
                                                        class="text-danger">*</span>
                                                    <select class="form-control select222" name="unit_id" id="unit_id">
                                                        <option value="">--- Select Unit ---</option>
                                                        @forelse($units as $unit)
                                                            <option value="{{ $unit->id }}"
                                                                @if (!empty($details) && $unit->id == $details->unit_id) {{ 'selected' }} @endif>
                                                                {{ $unit->title_en }}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                              <div class="col-md-6 pt-4">
                                                <div class="form-group">
                                                    <label for="parent_id" class="label-style">Parent Menu</label>
                                                    <select name="parent_id" class="form-control fromAlias select222"
                                                        id="parent_id">
                                                        <option value="">--- select one ----</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="menu_type" class="label-style">Menu Type</label> <span
                                                        class="text-danger">*</span><i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-placement="top" title="where you want to show this menu"></i>
                                                    <select class="form-control select222" name="menu_type[]" id="menu_type" multiple>
                                                        <option value="0"
                                                            {{ in_array(0, explode(',',$details->menu_type ?? '')) ? 'selected' : '' }}>
                                                            Header</option>
                                                        <option value="1"
                                                            {{ in_array(1, explode(',',$details->menu_type ?? '')) ? 'selected' : '' }}>
                                                            Footer</option>
                                                    </select>
                                                </div>
                                            </div>

                                            @include('.admin.otp_verification_and_catcha_form')
                                            <div class="col-md-12 mt-5">
                                                <div class="alert alert-info" role="alert">
                                                    <strong>Note:</strong> When you create a new menu and extend to main unit menu then his section also created.
                                                </div>
                                            </div>
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
                    $('#parent_id').html('<option value="">Loading...</option>');

                    if (unitId) {
                        $.ajax({
                            url: baseUrl + 'admin/content/get-menus-for-parent-by-unit/' + unitId,
                            type: 'GET',
                            success: function(res) {
                                let options = '<option value="">--- Select Menu ---</option>';
                                $.each(res, function(key, menu) {
                                    let selected = (selectedMenuId && menu.id == selectedMenuId) ?
                                        'selected' : '';
                                    options +=
                                        `<option value="${menu.id}" ${selected}>${menu.menu_path}</option>`;
                                });
                                $('#parent_id').html(options);
                            },
                            error: function() {
                                $('#parent_id').html('<option value="">Error loading</option>');
                            }
                        });
                    } else {
                        $('#parent_id').html('<option value="">--- Select Menu ---</option>');
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
