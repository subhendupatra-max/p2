@extends('layout.app')
@section('content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                            AIPR List</h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">AIPR</li>
                        </ul>

                    </div>
                    <div class="d-flex align-items-center gap-2 gap-lg-3">

                        <a href="javascript:void(0)" class="btn btn-dark goTo" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end">Download Sample File <i class="fa-solid fa-circle-info"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Download this sheet then input in this sheet,because here the colume name maintain as need when you upload a new sheet"></i></a>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                            data-kt-menu="true">

                            <div class="menu-item px-3">
                                <a href="{{ asset('assets/media/iofs-officer-list.csv') }}" download
                                    class="menu-link px-3 custom-data-table" data-kt-customer-table-filter="delete_row">IOFS
                                    Officer</a>
                                <a href="{{ asset('assets/media/retired-iofs-officer-list.csv') }}" download
                                    class="menu-link px-3 custom-data-table"
                                    data-kt-customer-table-filter="delete_row">Retired IOFS Officer</a>
                            </div>

                        </div>






                    @can('add-aipr')
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                            <button type="button" class="btn btn-dark goTo"
                                data-action="{{ route('admin.aipr.upload') }}">Upload
                                AIPR List</button>
                        </div>
                    </div>
                    @endcan
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <div class="card">
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable"
                                    id="kt_customers_table">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th>Sl No</th>
                                            <th>Unit</th>
                                            <th>Menu</th>
                                            <th>Pno</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Unit</th>
                                            <th>DPSU</th>
                                            <th>Grade</th>
                                            <th>Designation</th>
                                            <th>DOJ Iofs</th>
                                            <th>DOB</th>
                                            <th>Address</th>
                                            <th>Sex</th>
                                            <th>Sno</th>
                                            <th>Others</th>
                                            <th>Status</th>
                                            <th class="text-end min-w-70px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        @forelse ($details as $detail)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $detail->Getunit->title_en ?? 'N/A' }}</td>
                                                <td>{{ $detail->menu->title_en ?? 'N/A' }}</td>
                                                <td>{{ $detail->pno ?? 'N/A' }}</td>
                                                <td>{{ $detail->name ?? 'N/A' }}</td>
                                                <td>{{ $detail->type ?? 'N/A' }}</td>
                                                <td>{{ $detail->unit ?? 'N/A' }}</td>
                                                <td>{{ $detail->dpsu ?? 'N/A' }}</td>
                                                <td>{{ $detail->grade ?? 'N/A' }}</td>
                                                <td>{{ $detail->designation ?? 'N/A' }}</td>
                                                <td>{{ $detail->doj_iofs ?? 'N/A' }}</td>
                                                <td>{{ $detail->dob ?? 'N/A' }}</td>
                                                <td>{{ $detail->address ?? 'N/A' }}</td>
                                                <td>{{ $detail->sex ?? 'N/A' }}</td>
                                                <td>{{ $detail->sno ?? 'N/A' }}</td>
                                                <td>{{ $detail->others ?? 'N/A' }}</td>
                                                <td>
                                                    @can('aipr-status-change')
                                                    <div class="form-check form-switch">
                                                        <input type="checkbox" data-uuid="{{ $detail->uuid }}"
                                                            data-table="aiprs" class="form-check-input isVerified"
                                                            id="status_{{ $detail->id }}"
                                                            value="{{ $detail->is_active ?? 0 }}"{{ $detail->is_active == 1 ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="status_{{ $detail->id }}">{{ $detail->is_active == 1 ? 'Active' : 'In-Active' }}</label>
                                                    </div>
                                                    @endcan
                                                </td>
                                                <td class="text-end">
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-sm btn-light btn-active-light-primary"
                                                        data-kt-menu-trigger="click"
                                                        data-kt-menu-placement="bottom-end">Actions</a>
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                        data-kt-menu="true">

                                                         @can('delete-aipr')
                                                        <div class="menu-item px-3">
                                                            <a href="javascript:void(0)" data-table="aiprs"
                                                                data-uuid="{{ $detail->uuid }}"
                                                                class="menu-link px-3 custom-data-table deleteData"
                                                                data-kt-customer-table-filter="delete_row">Delete</a>
                                                        </div>
                                                         @endcan
                                                    </div>
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
    </div>

    @push('script')
        <script></script>
    @endpush
@endsection
