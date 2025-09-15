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
                            <h3 class="page-heading">Activity Logs</h3>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <div class="card">
                        <div class="card-body pt-0">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable" id="kt_customers_table">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="text-center">Sl No</th>
                                        <th class="text-center">Description</th>
                                         <th class="text-center">Ip Address</th>
                                        <th class="text-center">Created By</th>
                                        <th class="text-center">Created At</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @forelse ($activity_logs as $activity_log)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $activity_log->description ?? 'N/A' }}</td>
                                            <td class="text-center">
                                                {{ json_decode($activity_log->properties, true)['ip_address'] ?? 'N/A' }}
                                            </td>
                                            <td class="text-center">{{ $activity_log?->user?->name ?? 'N/A' }}</td>
                                            <td class="text-center">{{ date('d/m/Y h:i A',strtotime($activity_log->created_at)) ?? 'N/A' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center"><img style="width: 450px;" src="{{ asset('assets/media/images/nodatafound.png') }}" ></td>
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
