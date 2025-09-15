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
                                <a href="{{ route('admin.aipr-master.list') }}" class="text-muted text-hover-primary">AIPR
                                    Finance</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <h3 class="page-heading">
                                    AIPR Finance {{ !empty($details) ? 'Edit' : 'Add' }}</h3>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="container">
                                    <form id="AiprForm" action="{{ route('admin.aipr-master.add') }}" method="POST"
                                        class="formSubmit fileUpload" enctype="multipart/form-data">
                                        <input type="hidden" name="id" name="id"
                                            value="{{ $details->id ?? null }}">

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
                                                    <label for="grade" class="label-style">Grade</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="text" class="form-control fromAlias"
                                                        placeholder="Enter Grade" name="grade" id="grade"
                                                        value="{{ $details->grade ?? null }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 pt-4">
                                                <div class="form-group">
                                                    <label for="year" class="label-style">Year</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="text" class="form-control fromAlias"
                                                        placeholder="Enter year" name="year" id="year"
                                                        value="{{ $details->year ?? null }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 pt-4">
                                                <div class="form-group">
                                                    <label for="pno" class="label-style">PNO</label>
                                                    <input type="text" class="form-control fromAlias"
                                                        placeholder="Enter PNO" name="pno" id="pno"
                                                        value="{{ $details->pno ?? null }}">
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
                                            <div class="col-md-6 pt-4">
                                                <div class="form-group">
                                                    <label for="menu_id" class="label-style">File</label>
                                                    <span class="text-danger">*</span>( file types:
                                                    jpeg,png,jpg,gif,svg,doc,docx,pdf,csv,xls,xlsx.) Max Size : 5mb
                                                    <div class="form-text"
                                                        style="font-size: 10px; color: red !important;">

                                                    </div>
                                                    <input type="file" class="form-control fromAlias" name="file"
                                                        id="file">
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
