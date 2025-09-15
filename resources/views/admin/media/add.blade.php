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
                                <a href="{{ route('admin.media.list') }}" class="text-muted text-hover-primary">Media</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <h3 class="page-heading">
                                    Media {{ !empty($details) ? 'Edit' : 'Add' }}</h3>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="container">
                                    <form id="mediaForm" action="{{ route('admin.media.add') }}" method="POST"
                                        class="formSubmit fileUpload" enctype="multipart/form-data">
                                        <input type="hidden" name="id" name="id"
                                            value="{{ $details->id ?? null }}">


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

                                            <div class="col-md-12 pt-4">
                                                <div class="form-group">
                                                    <label for="youtube_link" class="label-style">Youtube Link</label>
                                                    <input type="text" class="form-control fromAlias"
                                                        placeholder="Enter here" name="youtube_link" id="youtube_link"
                                                        value="{{ $details->youtube_link ?? null }}">
                                                </div>
                                            </div>

                                            <div class="row pt-4">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="file" class="form-label">Media Image </label>
                                                        <input class="form-control" type="file" id="file"
                                                            name="file[]" multiple>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 card">
                                                    <div id="previewImages">
                                                    <input type="hidden" name="remove_image" id="remove_image">
                                                        @if (!empty($details->images))
                                                            @foreach ($details->images as $item)
                                                                <div id="imgCls_{{ $loop->iteration }}">
                                                                    <img style="width:100px"
                                                                        src="{{ $item->image_path }}" alt="">
                                                                    <a href="javascript:void(0)" class="removeImage"
                                                                        data-id="{{ $item->id }}">
                                                                        <i class="fa fa-trash-o pt-4" aria-hidden="true"
                                                                            onclick="rMdiv('{{ $loop->iteration }}')"></i>
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-5">
                                                <div class="alert alert-info" role="alert">
                                                    <strong>Note:</strong> If you choose image then select image and if you
                                                    choose video then enter youtube link.
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


            let imageId = [];
            $(document).on('click', '.removeImage', function(e) {
                const currentImageId = $(this).attr('data-id');
                if (!imageId.includes(currentImageId)) {
                    imageId.push(currentImageId);
                }
                $('#remove_image').val(JSON.stringify(imageId));
            });

            function rMdiv(flag) {
                $(`#imgCls_${flag}`).remove();
            }

            function previewImages() {
                var preview = document.querySelector('#previewImages');
                if (this.files) {
                    [].forEach.call(this.files, readAndPreview);
                }

                function readAndPreview(file) {
                    if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                        Swal.fire({
                            icon: 'error',
                            title: `${file.name} is not an image`,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                    var reader = new FileReader();
                    reader.addEventListener("load", function() {
                        var image = new Image();
                        image.height = 100;
                        image.title = file.name;
                        image.src = this.result;
                        preview.appendChild(image);
                    });
                    reader.readAsDataURL(file);
                }
            }
            document.querySelector('#file').addEventListener("change", previewImages);
        </script>
    @endpush
@endsection
