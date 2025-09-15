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
                            <h3 class="page-heading">AIPR finance List</h3>
                        </li>
                    </ul>
                </div>

                @can('add-aipr-master')
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                            <button type="button" class="btn btn-dark goTo"
                                data-action="{{ route('admin.aipr-master.add') }}">Add
                                AIPR finance</button>
                        </div>
                    </div>
                @endcan

            </div>

            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <div class="card">
                        <div class="card-body pt-0">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable aiprTable"
                                id="kt_customers_table">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="text-center">Sl No</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">PNO</th>
                                        <th class="text-center">Grade</th>
                                        <th class="text-center">Menu</th>
                                        <th class="text-center">Unit</th>
                                            <th class="text-center">Year</th>
                                        <th class="text-center">file</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Active/Inactive</th>
                                        <th class="min-w-70px text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @forelse ($details_active as $aipr_master)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $aipr_master->name ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $aipr_master->pno ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $aipr_master->grade ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $aipr_master->menu?->title_en ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $aipr_master->unit?->title_en ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $aipr_master->year ?? 'N/A' }}</td>
                                            <td class="text-center">
                                                <a href="{{ $aipr_master->image_path }}" download><i class="fa fa-download"></i></a>
                                            </td>
                                            <td>
                                                @can('aipr-master-approval')
                                                    <div>
                                                        @if ($aipr_master->is_approved == 0)
                                                            <button data-uuid="{{ $aipr_master->uuid }}"
                                                                data-field="is_approved" data-table="aipr_masters"
                                                                class="btn btn-success btn-sm isApproved" data-mesg="Are you sure you want to approve?"
                                                                data-value="1">Approve</button>
                                                            <button data-uuid="{{ $aipr_master->uuid }}"
                                                                data-field="is_approved" data-table="aipr_masters"
                                                                class="btn btn-danger btn-sm isApproved" data-mesg="Are you sure you want to reject?"
                                                                data-value="2">Reject</button>
                                                        @elseif($aipr_master->is_approved == 1)
                                                            <button data-uuid="{{ $aipr_master->uuid }}"
                                                                data-field="is_approved" data-table="aipr_masters"
                                                                class="btn btn-success btn-sm isApproved" data-mesg="Are you sure you want to change the status Approve to Pending?"
                                                                data-value="0">Approved</button>
                                                        @elseif($aipr_master->is_approved == 2)
                                                            <button
                                                                class="btn btn-danger btn-sm">Rejected</button>
                                                        @endif
                                                    </div>
                                                @endcan
                                            </td>
                                            <td>
                                                @can('aipr-master-status-change')
                                                    <div class="form-check form-switch">
                                                        <input type="checkbox" data-uuid="{{ $aipr_master->uuid }}"
                                                            data-table="aipr_masters" class="form-check-input isVerified"
                                                            id="status_{{ $aipr_master->id }}"
                                                            value="{{ $aipr_master->is_active ?? 0 }}"{{ $aipr_master->is_active == 1 ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="status_{{ $aipr_master->id }}">{{ $aipr_master->is_active == 1 ? 'Active' : 'In-Active' }}</label>
                                                    </div>
                                                @endcan
                                            </td>
                                            <td class="text-center">
                                                <a href="javascript:void(0)"
                                                    class="btn btn-sm btn-dark btn-active-light-primary"
                                                    data-kt-menu-trigger="click"
                                                    data-kt-menu-placement="bottom-end">Actions</a>
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true">
                                                    @can('edit-aipr-master')
                                                        <div class="menu-item px-3">
                                                            <a class="menu-link px-3"
                                                                href="{{ route('admin.aipr-master.add', $aipr_master->uuid) }}">Edit</a>
                                                        </div>
                                                    @endcan
                                                    @can('delete-aipr-master')
                                                        <div class="menu-item px-3">
                                                            <a href="javascript:void(0)" data-table="aipr_masters"
                                                                data-uuid="{{ $aipr_master->uuid }}"
                                                                class="menu-link px-3 custom-data-table deleteData"
                                                                data-kt-customer-table-filter="delete_row">Delete</a>
                                                        </div>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11" class="text-center"><img style="width: 450px;"
                                                    src="{{ asset('assets/media/images/nodatafound.png') }}"></td>
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
    </div>
    @push('script')
    @endpush
@endsection
