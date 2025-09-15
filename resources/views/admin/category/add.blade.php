@extends('layout.app')
@section('content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                            Category {{ !empty($details) ? 'Edit' : 'Add' }}</h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('admin.category.list') }}"
                                    class="text-muted text-hover-primary">Category</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <div class="card">
                        <div class="card-body pt-6">
                            <div class="container">
                                <form id="categoryForm" action="{{ route('admin.category.add') }}" method="POST"
                                    class="formSubmit fileUpload" enctype="multipart/form-data">
                                    <input type="hidden" name="id" name="id" value="{{ $details->id ?? null }}">
                                    <div class="row pt-2">
                                        <div class="col-md-12">
                                            <div class="row">


                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="title_en" class="label-style">Title(en)</label>
                                                        <span class="asterisk_sign">*</span>
                                                        <input type="text" class="form-control fromAlias"
                                                            placeholder="Enter Name" name="title_en" id="title_en"
                                                            value="{{ $details->title_en ?? null }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="title_hi" class="label-style">Title(hi)</label>
                                                        <span class="asterisk_sign">*</span>
                                                        <input type="text" class="form-control fromAlias"
                                                            placeholder="Enter Name" name="title_hi" id="title_hi"
                                                            value="{{ $details->title_hi ?? null }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @include('.admin.otp_verification_and_catcha_form')

                                    <div class="button add-btn-div-save-style">
                                        <button type="submit" id="submitBtn" class="btn btn-dark">
                                            <span class="indicator-label">{{ !empty($details) ? 'Update' : 'Save' }}</span>
                                            <span class="indicator-progress">Please wait...
                                                <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const colorPicker = document.getElementById('color_picker');
                if (!colorPicker.value) {
                    colorPicker.value = '#' + Math.floor(Math.random() * 16777215).toString(16);
                }
            });
            document.addEventListener('DOMContentLoaded', function() {
                const regenerateColorBtn = document.getElementById('regenerateColorBtn');
                const colorPicker = document.getElementById('color_picker');

                regenerateColorBtn.addEventListener('click', function() {
                    const randomColor = '#' + Math.floor(Math.random() * 16777215).toString(16);
                    colorPicker.value = randomColor;
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                const colorCodeInput = document.getElementById('color_code_input');
                const colorPicker = document.getElementById('color_picker');

                colorCodeInput.addEventListener('input', function() {
                    colorPicker.value = colorCodeInput.value;
                    colorCodeInput.style.backgroundColor = colorCodeInput.value;
                });

                colorPicker.addEventListener('input', function() {
                    colorCodeInput.value = colorPicker.value;
                    colorCodeInput.style.backgroundColor = colorPicker.value;
                });

                const regenerateColorBtn = document.getElementById('regenerateColorBtn');
                regenerateColorBtn.addEventListener('click', function() {
                    const randomColor = '#' + Math.floor(Math.random() * 16777215).toString(16);
                    colorPicker.value = randomColor;
                    colorCodeInput.value = randomColor;
                    colorCodeInput.style.backgroundColor = randomColor;
                });
            });

        </script>
    @endpush
@endsection
