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
                                <a href="{{ route('admin.aipr.list') }}" class="text-muted text-hover-primary">AIPR</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <h3 class="page-heading">
                                    AIPR {{ !empty($details) ? 'Edit' : 'Add' }}</h3>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="container">
                                    <form id="AIPRForm" action="{{ route('admin.aipr.upload') }}" method="POST"
                                        class="formSubmit fileUpload" enctype="multipart/form-data">
                                        <input type="hidden" name="id" name="id"
                                            value="{{ $details->id ?? null }}">

                                        <div class="row align-items-end">
                                            <div class="col-md-3 pt-4">
                                                <div class="form-group">
                                                    <label for="type" class="label-style">Type</label>
                                                    <span class="text-danger">*</span>
                                                    <select name="type" class="form-control fromAlias select222"
                                                        id="type" required>
                                                        <option value="1">Present Officer</option>
                                                        <option value="2">Retired Officer</option>
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
                                                            <option value="{{ $unit->id }}">
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
                                                    <label for="file" class="label-style">AIPR List</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="file" class="form-control fromAlias"
                                                        placeholder="Enter Title" name="file" id="file"
                                                        accept=".csv, .xlsx, .xls">
                                                </div>
                                            </div>

                                            @include('.admin.otp_verification_and_catcha_form')
                                            <div class="col-md-6">
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
                $('#unit_id').on('change', function() {
                    const unitId = $(this).val();
                    loadMenus(unitId);
                });
                const baseUrl = '{{ env('APP_URL') }}'
                const presetUnit = '';
                const presetMenu = '';

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
                    }
                }
            });
        </script>
    @endpush
@endsection
