@extends('layout.app')
@section('content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                            Unit List</h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">Unit</li>
                        </ul>

                    </div>
                    @can('add-unit')
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                            <button type="button" class="btn btn-dark goTo"
                                data-action="{{ route('admin.unit.add') }}">Add
                                Unit</button>
                        </div>
                    </div>
                    @endcan
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <div class="card">
                        <div class="card-body pt-0">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable" id="kt_customers_table">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th>Sl No</th>
                                        <th>Unit (en)</th>
                                        <th>Unit Short Name</th>
                                        <th>Unit (hi)</th>
                                        <th>State</th>
                                        <th>Short Code</th>
                                        <th>Factory Code</th>
                                        <th>Status</th>
                                        <th class="text-end min-w-70px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @forelse ($details as $detail)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $detail?->title_en ?? 'N/A' }}</td>
                                            <td>{{ $detail?->slug ?? 'N/A' }}</td>
                                            <td>{{ $detail?->title_hi ?? 'N/A' }}</td>
                                            <td>{{ $detail?->state->name ?? 'N/A' }}</td>
                                            <td>{{ $detail?->short_code ?? 'N/A' }}</td>
                                            <td>{{ $detail?->factory_code ?? 'N/A' }}</td>
                                            <td>
                                            @can('unit-status-change')
                                            @if( $detail?->slug != 'main' )
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" data-uuid="{{ $detail->uuid }}"
                                                        data-table="units" class="form-check-input isVerified"
                                                        id="status_{{ $detail->id }}"
                                                        value="{{ $detail->is_active ?? 0 }}"
                                                        {{ $detail->is_active == 1 ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="status_{{ $detail->id }}">{{ $detail->is_active == 1 ? 'Active' : 'In-Active' }}</label>
                                                </div>
                                            @endif
                                            @endcan
                                            </td>
                                            <td class="text-end">
                                                @if( $detail?->slug != 'main' )
                                                <a href="javascript:void(0)"
                                                    class="btn btn-sm btn-light btn-active-light-primary"
                                                    data-kt-menu-trigger="click"
                                                    data-kt-menu-placement="bottom-end">Actions</a>
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true">
                                                    @can('edit-unit')
                                                    <div class="menu-item px-3">
                                                        <a class="menu-link px-3"
                                                            href="{{ route('admin.unit.add', $detail->uuid) }}">Edit</a>
                                                    </div>
                                                    @endcan
                                                    @can('delete-unit')
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:void(0)" data-table="units"
                                                            data-uuid="{{ $detail->uuid }}"
                                                            class="menu-link px-3 custom-data-table deleteData"
                                                            data-kt-customer-table-filter="delete_row">Delete</a>
                                                    </div>
                                                    @endcan
                                                </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
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
        <script></script>
    @endpush
@endsection
