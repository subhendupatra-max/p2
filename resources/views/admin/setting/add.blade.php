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
                                <h3 class="page-heading">Setting</h3>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="container">
                                    <form id="uomForm" action="{{ route('admin.setting.add') }}" method="POST"
                                        class="formSubmit fileUpload" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $details->id ?? null }}">
                                        <div class="row">
                                            @foreach (['file1' => 'Image 1', 'file2' => 'Image 2', 'file3' => 'Image 3'] as $file => $label)
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label><span class="label_title">{{ $label }}</span></label>
                                                        <div class="fv-row">
                                                            @php
                                                                $imagePath = $details->$file
                                                                    ? asset(
                                                                        $details->{'image_path' . substr($file, -1)},
                                                                    )
                                                                    : '/assets/media/svg/files/blank-image.svg';

                                                            @endphp
                                                            <div class="image-input image-input-empty image-input-outline"
                                                                style="background-image: url('{{ $imagePath }}');"
                                                                data-kt-image-input="true">
                                                                <div class="image-input-wrapper w-125px h-125px"></div>
                                                                <label
                                                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                    data-kt-image-input-action="change"
                                                                    data-bs-toggle="tooltip" title="Add image">
                                                                    <div class="img_edit_btn_icon">
                                                                        <i class="fa-solid fa-pen"></i>
                                                                    </div>
                                                                    <input type="file" name="{{ $file }}"
                                                                        accept=".png, .jpg, .jpeg" />
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
                                                            <div class="form-text" style="font-size: 10px; color: red;">
                                                                <p>Allowed file types: png, jpg, jpeg.</p>
                                                                <p>Max Size: 5mb</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="instagram" class="label-style">Instagram</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter instagram url" name="instagram" id="instagram"
                                                        value="{{ $details->instagram ?? null }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="facebook" class="label-style">Facebook</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter facebook url" name="facebook" id="facebook"
                                                        value="{{ $details->facebook ?? null }}">
                                                </div>
                                            </div>

                                            <div class="row pt-3">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="twitter" class="label-style">Twitter</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter twitter url" name="twitter" id="twitter"
                                                            value="{{ $details->twitter ?? null }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="linkedin" class="label-style">Linkedin</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter linkedin url" name="linkedin"
                                                            id="linkedin" value="{{ $details->linkedin ?? null }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row pt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="youtube" class="label-style">Youtube</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Youtube" name="youtube" id="youtube"
                                                            value="{{ $details->youtube ?? null }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="description_en" class="label-style">
                                                            Description(en)</label>
                                                        <textarea class="form-control" name="description_en" id="description_en" cols="30" rows="4">{{ $details->desctiption_en ?? null }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="description_hi" class="label-style">
                                                            Description(hi)</label>
                                                        <textarea class="form-control" name="description_hi" id="description_hi" cols="30" rows="4">{{ $details->desctiption_hi ?? null }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="location" class="label-style">
                                                            Office Location </label>
                                                        <textarea class="form-control" name="location" id="location" cols="30" rows="4">{{ $details->location ?? null }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row pt-3">
                                                @foreach (['footer_file1' => 'Footer Image 1', 'footer_file2' => 'Footer Image 2'] as $footerFile => $footerLabel)
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label><span
                                                                    class="label_title">{{ $footerLabel }}</span></label>
                                                            <div class="fv-row">
                                                                @php
                                                                    $footerImagePath = $details->$footerFile
                                                                        ? asset(
                                                                            $details->{'footer_image' .
                                                                                substr($footerFile, -1) .
                                                                                '_path'},
                                                                        )
                                                                        : '/assets/media/svg/files/blank-image.svg';
                                                                @endphp
                                                                <div class="image-input image-input-empty image-input-outline"
                                                                    style="background-image: url('{{ $footerImagePath }}');"
                                                                    data-kt-image-input="true">
                                                                    <div class="image-input-wrapper w-125px h-125px"></div>
                                                                    <label
                                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                        data-kt-image-input-action="change"
                                                                        data-bs-toggle="tooltip" title="Add image">
                                                                        <div class="img_edit_btn_icon">
                                                                            <i class="fa-solid fa-pen"></i>
                                                                        </div>
                                                                        <input type="file" name="{{ $footerFile }}"
                                                                            accept=".png, .jpg, .jpeg" />
                                                                        <input type="hidden"
                                                                            name="avatar_remove_footer" />
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
                                                                    style="font-size: 10px; color: red;">
                                                                    <p>Allowed file types: png, jpg, jpeg.</p>
                                                                    <p>Max Size: 5mb</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                             @include('.admin.otp_verification_and_catcha_form')
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
            $(document).ready(function() {
                var description_hieditor;
                initializeEditor('description_hi');
                var description_eneditor;
                initializeEditor('description_en');
                $('#submitBtn').click(function(e) {
                    document.getElementById('description_en').value = description_eneditor.getData();
                    document.getElementById('description_hi').value = description_hieditor.getData();
                });
            });
        </script>
    @endpush
@endsection
