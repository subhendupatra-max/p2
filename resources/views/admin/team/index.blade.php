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
                            <h3 class="page-heading">Team/Director List</h3>
                        </li>
                    </ul>
                </div>
                @can('add-team')
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                        <button type="button" class="btn btn-dark goTo" data-action="{{ route('admin.team.add') }}">Add
                            Team/Director</button>
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
                                        <th class="text-center">Title</th>
                                        <th class="text-center">Designation</th>
                                        <th class="text-center">Unit</th>
                                        <th class="text-center">Menu</th>
                                        <th class="text-center">Image</th>
                                        <th class="text-center">Active/Inactive</th>
                                        <th class="min-w-70px text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @forelse ($details as $team)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $team->name ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $team->designation->title ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $team->unit->title_en ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $team->menu->menu_path  ?? 'N/A' }}</td>
                                            <td class="text-center"><img src="{{ $team->image_path }}"></td>

                                            <td>
                                            @can('team-status-change')
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" data-uuid="{{ $team->uuid }}"
                                                        data-table="cmteams" class="form-check-input isVerified"
                                                        id="status_{{ $team->id }}"
                                                        value="{{ $team->is_active ?? 0 }}"{{ $team->is_active == 1 ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="status_{{ $team->id }}">{{ $team->is_active == 1 ? 'Active' : 'In-Active' }}</label>
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
                                                    @can('edit-team')
                                                    <div class="menu-item px-3">
                                                        <a class="menu-link px-3"
                                                            href="{{ route('admin.team.add', $team->uuid) }}">Edit</a>
                                                    </div>
                                                    @endcan
                                                    @can('delete-team')
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:void(0)" data-table="teams"
                                                            data-uuid="{{ $team->uuid }}"
                                                            class="menu-link px-3 custom-data-table deleteData"
                                                            data-kt-customer-table-filter="delete_row">Delete</a>
                                                    </div>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center"><img style="width: 450px;"
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
    @push('script')

    @endpush
@endsection
