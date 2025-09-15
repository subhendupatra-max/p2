@extends('layout.app')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar d-block py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-hover-primary text-muted">
                            <a href="{{ route('admin.role.list') }}">Role List</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-hover-primary text-muted">
                            <h3 class="page-heading">Permission</h3>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <form id="permissionForm" action="{{ route('admin.role.permission', $roleData->uuid) }}" method="POST"
                        class="formSubmitWithoutCatcha fileUpload" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-body pt-0">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="text-center">Sl No</th>
                                            <th class="text-center">Group</th>
                                            <th class="text-center">Permission</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        @forelse ($permissions as $group => $chunk)
                                            @php
                                                $allChecked = collect($chunk)->every(function ($permission) use (
                                                    $roleData,
                                                ) {
                                                    return $roleData->hasPermission($permission->slug);
                                                });
                                            @endphp
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    {{ $group }} <input type="checkbox"
                                                        class="form-check-input form-checkbox check-all"
                                                        data-group="{{ $group }}"
                                                        @if ($allChecked) checked @endif />
                                                </td>
                                                <td>
                                                    @forelse ($chunk as $permission)
                                                        <span class="badge badge-light">
                                                            <input type="checkbox"
                                                                class="form-check-input form-checkbox permission-checkbox"
                                                                name="permission[]" value="{{ $permission->slug }}"
                                                                data-group="{{ $group }}"
                                                                @if ($roleData->hasPermission($permission->slug)) checked @endif />&nbsp;
                                                            {{ $permission->name }}
                                                        </span>
                                                    @empty
                                                    @endforelse
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No Roles Found</td>
                                            </tr>
                                        @endforelse
                                        @error('permission')
                                            <span class="text-danger text-sm">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @include('.admin.otp_verification_and_catcha_form')
                        <div class="button add-btn-div-save-style">
                            <button type="submit" id="submitBtn" class="btn btn-dark">
                                <span class="indicator-label">Update</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.check-all').forEach(function(checkAllBox) {
                    checkAllBox.addEventListener('change', function() {
                        let group = this.dataset.group;
                        let checkboxes = document.querySelectorAll(
                            `.permission-checkbox[data-group="${group}"]`);
                        checkboxes.forEach(function(checkbox) {
                            checkbox.checked = checkAllBox.checked;
                        });
                    });
                });

                document.querySelectorAll('.permission-checkbox').forEach(function(checkbox) {
                    checkbox.addEventListener('change', function() {
                        let group = this.dataset.group;
                        let checkAllBox = document.querySelector(`.check-all[data-group="${group}"]`);
                        let checkboxes = document.querySelectorAll(
                            `.permission-checkbox[data-group="${group}"]`);
                        let allChecked = Array.from(checkboxes).every(function(checkbox) {
                            return checkbox.checked;
                        });
                        checkAllBox.checked = allChecked;
                    });
                });
            });
        </script>
    @endpush
@endsection
