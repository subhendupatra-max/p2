@extends('layout.app')
@section('content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                            Unit {{ !empty($details) ? 'Edit' : 'Add' }}</h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('admin.unit.list') }}"
                                    class="text-muted text-hover-primary">Unit</a>
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
                                <form id="unitForm" action="{{ route('admin.unit.add') }}" method="POST"
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
                                                        <label for="short_name" class="label-style">Short Name(en)</label><span class="asterisk_sign">*</span>
                                                        <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-placement="top" title="This value will show in url when you change unit(i.e : main)"></i>

                                                        <input type="text" class="form-control fromAlias"
                                                            placeholder="Type here" name="short_name"  onkeyup="this.value = this.value.toLowerCase();" id="short_name"
                                                            value="{{ $details->slug ?? null }}">
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

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="state_id" class="label-style">State</label>

                                                        <select name="state_id" id="state_id"
                                                            class="form-control select222">
                                                            <option value="">Select State</option>
                                                            @foreach ($states as $state)
                                                                <option value="{{ $state->id }}"
                                                                    {{ !empty($details) && $details->state_id == $state->id ? 'selected' : '' }}>
                                                                    {{ $state->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="short_code" class="label-style">Short Code</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Short Code" name="short_code"
                                                            id="short_code"
                                                            value="{{ $details->short_code ?? null }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="factory_code" class="label-style">Factory Code</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Factory Code" name="factory_code"
                                                            id="factory_code"
                                                            value="{{ $details->factory_code ?? null }}">
                                                    </div>
                                                </div>
                                            </div>
                                            @include('.admin.otp_verification_and_catcha_form')
                                            <div class="col-md-12 mt-5">
                                                <div class="alert alert-info" role="alert">
                                                    <strong>Note:</strong> When you create a new unit then his website info also created. Goto website info page and update website info.
                                                </div>
                                            </div>
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
    @endpush
@endsection
