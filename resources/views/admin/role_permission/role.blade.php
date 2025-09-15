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
                            <h3 class="page-heading">Roles List</h3>
                        </li>
                    </ul>
                    <!-- <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Roles List
                    </h1> -->

                </div>
                @can('add-role')
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addRole">Add
                            Role</button>
                    </div>
                </div>
                @endcan
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <div class="card">
                            <div class="card-body pt-0">
                                <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable" id="kt_customers_table">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="text-center">Sl No</th>
                                            <th class="text-center">Role</th>
                                            <th class="text-center">Permission List</th>
                                            <th class="text-center">Give Permission</th>
                                            <th class="min-w-70px text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        @forelse ($roles as $role)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $role->name ?? 'N/A' }}</td>
                                                <td class="text-center">
                                                    @foreach ($role->permissions->take(5) as $permission)
                                                        <span class="badge badge-light">{{ $permission->name }}</span>
                                                    @endforeach
                                                    @if ($role->permissions->count() > 5)
                                                        <span>+{{ $role->permissions->count() - 5 }}
                                                            more</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @can('give-permission')
                                                    <button type="button"
                                                        class="btn btn-light btn-active-light-primary my-1 get-role"
                                                        data-name={{ $role->slug }} data-id={{ $role->uuid }}
                                                        data-action={{ route('admin.role.permission', $role->uuid) }}>Edit
                                                        Permission</button>
                                                    @endcan
                                                </td>


                                                <td class="text-center">
                                                    @if($role->is_editable == 0)
                                                        <span class="badge badge-light-danger">Not Editable or deletable</span>
                                                    @else
                                                    @can('edit-role')
                                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addRole"
                                                        class="editRole" data-id='{{ json_encode($role) }}'
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Role">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    @endcan
                                                    @can('delete-role')
                                                    <a href="javascript:void(0)" data-table="roles" data-uuid="{{ $role->uuid }}" class="menu-link px-3 custom-data-table deleteData"
                                                        data-kt-customer-table-filter="delete_row"><i class="fa-solid fa-trash"></i>
                                                    </a>
                                                    @endcan
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No Roles Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

    </div>
@endsection

@section('pageModal')
    <div class="modal fade" id="addRole" tabindex="-1" aria-labelledby="addRoleLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoleLabel">Role Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addRoleFrm" class="form formSubmitWithoutCatcha" action="{{ route('admin.role.add') }}">
                    <input type="hidden" name="id" id="id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title" class="label-style">Role Name</label>
                                    <span class="astrict_sign">*</span>
                                    <input type="text" class="form-control" placeholder="Enter Role" name="name"
                                        id="name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="addRoleBtn" class="btn btn-dark">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/rolePermission.js') }}"></script>
    <script>
        $(document).on("click", ".editRole", function() {
            const details = JSON.parse($(this).attr('data-id'));
            $('#id').val(details.id);
            $('#name').val(details.name);
        });
    </script>
@endpush
