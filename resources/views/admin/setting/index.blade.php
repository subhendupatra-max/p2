@extends('layout.app')
@section('content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                            Website Setting List</h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">Website Setting</li>
                        </ul>

                    </div>
                    {{-- <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                            <button type="button" class="btn btn-dark goTo"
                                data-action="{{ route('admin.setting.add') }}">Add
                                News</button>
                        </div>
                    </div> --}}
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
                                        <th>Unit</th>
                                        <th>Created at</th>
                                        <th>Created by</th>
                                        <th>Updated at</th>
                                        <th>Updated by</th>
                                        <th class="text-end min-w-70px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @forelse ($details as $detail)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $detail?->unit?->title_en ?? 'N/A' }}</td>
                                            <td>{{ $detail->created_at ? date('d/m/Y h:i A', strtotime($detail->created_at)) : 'N/A' }}</td>
                                            <td>{{ $detail->created_by ? $detail->createdBy?->name : 'N/A' }}</td>
                                            <td>{{ $detail->updated_at ? date('d/m/Y h:i A', strtotime($detail->updated_at)) : 'N/A' }}</td>
                                            <td>{{ $detail->updated_by ? $detail->updatedBy?->name : 'N/A' }}</td>
                                            <td class="text-end">
                                                <a href="javascript:void(0)"
                                                    class="btn btn-sm btn-light btn-active-light-primary"
                                                    data-kt-menu-trigger="click"
                                                    data-kt-menu-placement="bottom-end">Actions</a>
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true">
                                                    @can('edit-website-setting')
                                                    <div class="menu-item px-3">
                                                        <a class="menu-link px-3"
                                                            href="{{ route('admin.setting.add', base64_encode($detail->id)) }}">Edit</a>
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

    @push('script')
        <script></script>
    @endpush
@endsection
