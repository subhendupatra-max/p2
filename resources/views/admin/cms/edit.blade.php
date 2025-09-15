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
                                    Content {{ !empty($details) ? 'Edit' : 'Add' }}</h3>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="container">
                                    <form id="contentForm" action="{{ route('admin.content.edit') }}" method="POST"
                                        class="formSubmit fileUpload" enctype="multipart/form-data">
                                        <input type="hidden" name="id" name="id"
                                            value="{{ $details->id ?? null }}">

                                        @if (auth()->user()->can('add-edit-all-content-details'))
                                            <div class="row">
                                                <div class="col-md-12 pt-4">
                                                    <div class="form-group">
                                                        <label for="need_content_writter" class="label-style">Need
                                                            Content Writter/Approver?</label>
                                                        <span class="text-danger">*</span>

                                                        <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="If the content no need to Content Writter/Approver then select no Otherwise yes"></i>

                                                        <select name="need_content_writter" id="need_content_writter"
                                                            class="form-control fromAlias">
                                                            <option value="no"
                                                                {{ !empty($details) && $details->need_content_writter == 'no' ? 'selected' : '' }}>
                                                                No</option>
                                                            <option value="yes"
                                                                {{ !empty($details) && $details->need_content_writter == 'yes' ? 'selected' : '' }}>
                                                                Yes</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row approvalAndWritterSection">
                                                <div class="col-md-2 pt-4">
                                                    <div class="form-group">
                                                        <label for="en_contant_writter_id" class="label-style">Content
                                                            Writter(en)</label>
                                                        <span class="text-danger">*</span>
                                                        <select name="en_contant_writter_id"
                                                            class="form-control fromAlias select222"
                                                            id="en_contant_writter_id">
                                                            <option value="">--- select one ----</option>
                                                            @forelse ($en_contant_writters as $contant_writter)
                                                                <option value="{{ $contant_writter->id }}"
                                                                    @if ($details) {{ $contant_writter->id == $details->en_contant_writter_id ? 'selected' : '' }} @endif>
                                                                    {{ $contant_writter->name }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 pt-4">
                                                    <div class="form-group">
                                                        <label for="hi_contant_writter_id" class="label-style">Content
                                                            Writter(hi)</label>
                                                        <span class="text-danger">*</span>
                                                        <select name="hi_contant_writter_id"
                                                            class="form-control fromAlias select222"
                                                            id="hi_contant_writter_id">
                                                            <option value="">--- select one ----</option>
                                                            @forelse ($hi_contant_writters as $contant_writter)
                                                                <option value="{{ $contant_writter->id }}"
                                                                    @if ($details) {{ $contant_writter->id == $details->hi_contant_writter_id ? 'selected' : '' }} @endif>
                                                                    {{ $contant_writter->name }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 pt-4">
                                                    <div class="form-group">
                                                        <label for="contant_approver_id" class="label-style">Content
                                                            Approver</label>
                                                        <span class="text-danger">*</span>
                                                        <select name="contant_approver_id"
                                                            class="form-control fromAlias select222"
                                                            id="contant_approver_id">
                                                            <option value="">--- select one ----</option>
                                                            @forelse ($contant_approvers as $contant_approver)
                                                                <option value="{{ $contant_approver->id }}"
                                                                    @if ($details) {{ $contant_approver->id == $details->contant_approver_id ? 'selected' : '' }} @endif>
                                                                    {{ $contant_approver->name }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 pt-4">
                                                    <div class="form-group">
                                                        <label for="contant_reviewer_id" class="label-style">Content
                                                            Reviewer</label>
                                                        <span class="text-danger">*</span>
                                                        <select name="contant_reviewer_id"
                                                            class="form-control fromAlias select222"
                                                            id="contant_reviewer_id">
                                                            <option value="">--- select one ----</option>
                                                            @forelse ($contant_reviewers as $contant_reviewer)
                                                                <option value="{{ $contant_reviewer->id }}"
                                                                    @if ($details) {{ $contant_reviewer->id == $details->contant_reviewer_id ? 'selected' : '' }} @endif>
                                                                    {{ $contant_reviewer->name }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 pt-4">
                                                    <div class="form-group">
                                                        <label for="hindi_approver_id" class="label-style">Hindi Content
                                                            Approver</label>
                                                        <span class="text-danger">*</span>
                                                        <select name="hindi_approver_id"
                                                            class="form-control fromAlias select222"
                                                            id="hindi_approver_id">
                                                            <option value="">--- select one ----</option>
                                                            @forelse ($hindi_contant_approvers as $hindi_contant_approver)
                                                                <option value="{{ $hindi_contant_approver->id }}"
                                                                    @if ($details) {{ $hindi_contant_approver->id == $details->hindi_approver_id ? 'selected' : '' }} @endif>
                                                                    {{ $hindi_contant_approver->name }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 pt-4">
                                                    <div class="form-group">
                                                        <label for="hindi_reviewer_id" class="label-style">Hindi Content
                                                            Approver</label>
                                                        <span class="text-danger">*</span>
                                                        <select name="hindi_reviewer_id"
                                                            class="form-control fromAlias select222"
                                                            id="hindi_reviewer_id">
                                                            <option value="">--- select one ----</option>
                                                            @forelse ($hindi_contant_reviewers as $hindi_contant_reviewer)
                                                                <option value="{{ $hindi_contant_reviewer->id }}"
                                                                    @if ($details) {{ $hindi_contant_reviewer->id == $details->hindi_reviewer_id ? 'selected' : '' }} @endif>
                                                                    {{ $hindi_contant_reviewer->name }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row taskSection">
                                                <div class="col-md-3 pt-4">
                                                    <div class="form-group">
                                                        <label for="task" class="label-style">Task</label>
                                                        <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="If the content have not expire date then leave blank"></i>
                                                        <input type="text" class="form-control fromAlias"
                                                            name="task" id="task"
                                                            value="{{ $details->task ?? null }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="row align-items-end">

                                            @if (auth()->user()->can('add-edit-english-content-details') || auth()->user()->can('add-edit-all-content-details'))
                                                <div class="col-md-6 pt-4">
                                                    <div class="form-group">
                                                        <label for="title_en" class="label-style">Title(en)</label>
                                                        <span class="text-danger">*</span>
                                                        <input type="text" class="form-control fromAlias"

                                                            placeholder="Enter Title" name="title_en" id="title_en"
                                                            value="{{ $details->title_en ?? null }}">
                                                    </div>
                                                </div>
                                            @endif
                                            @if (auth()->user()->can('add-edit-hindi-content-details') || auth()->user()->can('add-edit-all-content-details'))
                                                <div class="col-md-6 pt-4">
                                                    <div class="form-group">
                                                        <label for="title_hi" class="label-style">Title(hi)</label>
                                                        <span class="text-danger">*</span>
                                                        <input type="text" class="form-control fromAlias"
                                                            placeholder="Enter Title" name="title_hi" id="title_hi"
                                                            value="{{ $details->title_hi ?? null }}">
                                                    </div>
                                                </div>
                                            @endif
                                            @if (auth()->user()->can('add-edit-all-content-details'))
                                                <div class="col-md-3 pt-4">
                                                    <div class="form-group">
                                                        <label for="view_type" class="label-style">View Type</label>
                                                        <span class="text-danger">*</span>

                                                        <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="If the website content is displayed in a list or grid format, choose the list view. Otherwise, opt for the description view."></i>

                                                        <select name="view_type" id="view_type"
                                                            class="form-control fromAlias">
                                                            <option value="1"
                                                                {{ !empty($details) && $details->view_type == 1 ? 'selected' : '' }}>
                                                                Description View</option>
                                                            <option value="2"
                                                                {{ !empty($details) && $details->view_type == 2 ? 'selected' : '' }}>
                                                                List View</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 pt-4">
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

                                                <div class="col-md-3 pt-4">
                                                    <div class="form-group">
                                                        <label for="menu_id" class="label-style">Menu</label>
                                                        <span class="text-danger">*</span>
                                                        <select name="menu_id" class="form-control fromAlias select222"
                                                            id="menu_id">
                                                            <option value="">--- select one ----</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 pt-4">
                                                    <div class="form-group">
                                                        <label for="section_id" class="label-style">Section</label>
                                                        <select name="section_id" id="section_id"
                                                            class="form-control fromAlias select222">
                                                            <option value="">--- select one ----</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 pt-4">
                                                    <div class="form-group">
                                                        <label for="redirect_to" class="label-style">Redirect To</label>
                                                        <span class="text-danger">*</span>

                                                        <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="If the content redirects to another link  the select link, id redirect to details page then select details page and if the content redirects to a file then select open file "></i>

                                                        <select name="redirect_to" id="redirect_to"
                                                            class="form-control fromAlias">
                                                            <option value="">No Redirect</option>
                                                            <option value="1"
                                                                {{ !empty($details) && $details->redirect_to == 1 ? 'selected' : '' }}>
                                                                Link</option>
                                                            <option value="2"
                                                                {{ !empty($details) && $details->redirect_to == 2 ? 'selected' : '' }}>
                                                                Details Page</option>
                                                            <option value="3"
                                                                {{ !empty($details) && $details->redirect_to == 3 ? 'selected' : '' }}>
                                                                Open File </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pt-4">
                                                    <div class="form-group">
                                                        <label for="link" class="label-style">Link</label>

                                                        <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="If the website content redirects to another website, enter the link here."></i>

                                                        <input type="text" class="form-control fromAlias"
                                                            placeholder="Enter Link" name="link" id="link"
                                                            value="{{ $details->link ?? null }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pt-4">
                                                    <div class="form-group">
                                                        <label for="date" class="label-style">Date</label>

                                                        <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="If in content date is present, please input the date. "></i>

                                                        <input type="date" class="form-control fromAlias"
                                                            name="date" id="date"
                                                            value="{{ $details->date ?? null }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pt-4">
                                                    <div class="form-group">
                                                        <label for="date" class="label-style">Publish Date</label>
                                                        <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="If you don't set any publish date then, when content writer and approver are not needed, the content will be published on the content created date and if both are needed, the content will be published when both are approved"></i>
                                                        <input type="date" class="form-control fromAlias"
                                                            name="publish_date" id="publish_date"
                                                            value="{{ $details->publish_date ?? null }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 pt-4">
                                                    <div class="form-group">
                                                        <label for="date" class="label-style">Expire Date</label>

                                                        <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="If the content have not expire date then leave blank"></i>

                                                        <input type="date" class="form-control fromAlias"
                                                            name="expire_date" id="expire_date"
                                                            value="{{ $details->expire_date ?? null }}">
                                                    </div>
                                                </div>
                                            @endif
                                            @if (auth()->user()->can('add-edit-english-content-details') || auth()->user()->can('add-edit-all-content-details'))
                                                <div class="col-md-12 pt-4">
                                                    <div class="form-group">
                                                        <label for="description_en"
                                                            class="label-style">Description(en)</label>
                                                        <textarea class="form-control" name="description_en"
                                                            id="description_en" cols="30" rows="4">{{ $details->description_en ?? null }}</textarea>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (auth()->user()->can('add-edit-hindi-content-details') || auth()->user()->can('add-edit-all-content-details'))
                                                <div class="col-md-12 pt-4">
                                                    <div class="form-group">
                                                        <label for="description_hi"
                                                            class="label-style">Description(hi)</label>
                                                        <textarea class="form-control" name="description_hi"
                                                            id="description_hi" cols="30" rows="4">{{ $details->description_hi ?? null }}</textarea>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        @if (auth()->user()->can('add-edit-all-content-details'))
                                            <div class="row mt-5">
                                                <div class="col-md-8 m-auto text-center mb-5">
                                                    <div class="fv-row">
                                                        <label>
                                                            <span class="label_title">Content Image</span>

                                                        </label>
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
                                                                data-kt-image-input-action="change"
                                                                data-bs-toggle="tooltip" title="Add image">
                                                                <div class="img_edit_btn_icon">
                                                                    <i class="fa-solid fa-pen"></i>
                                                                </div>
                                                                <input type="file" name="file"
                                                                    accept=".png, .jpg, .jpeg, .pdf, .doc, .docx, .xls, .xlsx, .csv"
                                                                    id="file" />
                                                                <input type="hidden" name="avatar_remove" />
                                                            </label>
                                                            <span
                                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                data-kt-image-input-action="cancel"
                                                                data-bs-toggle="tooltip" title="Cancel image">
                                                                <i class="fa-solid fa-xmark"></i>
                                                            </span>
                                                            <span
                                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                data-kt-image-input-action="remove"
                                                                data-bs-toggle="tooltip" title="Remove logo">
                                                                <i class="bi bi-x fs-2"></i>
                                                            </span>
                                                        </div>
                                                        <div class="form-text"
                                                            style="font-size: 10px; color: red !important;">
                                                            <p>Allowed file types: .png, .jpg, .jpeg, .pdf, .doc, .docx,
                                                                .xls,
                                                                .xlsx, .csv</p>
                                                            <p>Max Size : 5mb</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="row">
                                            @include('.admin.otp_verification_and_catcha_form')
                                            <div class="col-md-12 mt-5">
                                                <div class="alert alert-info" role="alert">
                                                    <strong>Note:</strong> When you select view type = list view then title
                                                    and description must add because title show in web and if details page
                                                    present in details page description show but when view type =
                                                    description view then title not depend only depend description
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
        <script src="{{ asset('assets/js/editor.js') }}"></script>
        <script>
            var description_hieditor;
            initializeEditor('description_hi');

            var description_eneditor;
            initializeEditor('description_en');


            $('#submitBtn').click(function(e) {
                document.getElementById('description_en').value = description_eneditor.getData();
                document.getElementById('description_hi').value = description_hieditor.getData();
            });



            if ('{{ $details->need_content_writter }}' == 'no') {
                $('.approvalAndWritterSection').hide();
                $('.taskSection').hide();
            } else {
                $('.taskSection').show();
                $('.approvalAndWritterSection').show();
            }
            $(document).ready(function() {
                $('#need_content_writter').change(function() {
                    if ($(this).val() == 'no') {
                        $('.approvalAndWritterSection').hide();
                        $('.taskSection').hide();
                    } else {
                        $('.taskSection').show();
                        $('.approvalAndWritterSection').show();
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                const baseUrl = '{{ env('APP_URL') }}'
                const presetUnit = '{{ $details->unit_id ?? '' }}';
                const presetMenu = '{{ $details->menu_id ?? '' }}';
                const presetSection = '{{ $details->section_id ?? '' }}';

                function loadMenus(unitId, selectedMenuId = null, callback = null) {
                    $('#menu_id').html('<option value="">Loading...</option>');
                    $('#section_id').html('<option value="">--- select one ----</option>'); // Reset section

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

                                if (selectedMenuId) {
                                    $('#menu_id').val(selectedMenuId).trigger('change');
                                }

                                if (typeof callback === 'function') callback();
                            },
                            error: function() {
                                $('#menu_id').html('<option value="">Error loading</option>');
                            }
                        });
                    } else {
                        $('#menu_id').html('<option value="">--- Select Menu ---</option>');
                        $('#section_id').html('<option value="">--- select one ----</option>');
                    }
                }

                function loadSections(menuId, selectedSectionId = null) {
                    $('#section_id').html('<option value="">Loading...</option>');

                    if (menuId) {
                        $.ajax({
                            url: baseUrl + 'admin/content/get-sections-by-menu/' + menuId,
                            type: 'GET',
                            success: function(res) {
                                let options = '<option value="">--- Select Section ---</option>';
                                $.each(res, function(key, section) {
                                    let selected = (selectedSectionId && section.id ==
                                        selectedSectionId) ? 'selected' : '';
                                    options +=
                                        `<option value="${section.id}" ${selected}>${section.title}</option>`;
                                });
                                $('#section_id').html(options);

                                if (selectedSectionId) {
                                    $('#section_id').val(selectedSectionId);
                                }
                            },
                            error: function() {
                                $('#section_id').html('<option value="">Error loading</option>');
                            }
                        });
                    } else {
                        $('#section_id').html('<option value="">--- Select Section ---</option>');
                    }
                }

                // On unit change, load menus
                $('#unit_id').on('change', function() {
                    const unitId = $(this).val();
                    loadMenus(unitId);
                });

                // On menu change, load sections
                $('#menu_id').on('change', function() {
                    const menuId = $(this).val();
                    loadSections(menuId);
                });

                // Initial load for edit
                @if (!empty($details))
                    if (presetUnit) {
                        loadMenus(presetUnit, presetMenu, function() {
                            if (presetMenu) {
                                loadSections(presetMenu, presetSection);
                            }
                        });
                    }
                @endif
            });
        </script>
    @endpush
@endsection
