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
                            <h3 class="page-heading">Document List</h3>
                        </li>
                    </ul>
                </div>
                @can('add-document')
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                            <button type="button" class="btn btn-dark goTo" data-action="{{ route('admin.document.add') }}">Add
                                Document</button>
                        </div>
                    </div>
                @endcan
            </div>
            <ul class="nav nav-tabs mb-5" id="contentTabs" role="tablist">
                @can('active-document')
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1"
                            type="button" role="tab" aria-controls="tab1"
                            @if (auth()->user()->can('active-document')) aria-selected="true" @else  aria-selected="false" @endif>
                            Active Document
                        </button>
                    </li>
                @endcan
                @can('archived-document')
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button"
                            role="tab" aria-controls="tab2"
                            @if (auth()->user()->can('active-document')) aria-selected="false" @else  aria-selected="true" @endif>
                            Archive Document
                        </button>
                    </li>
                @endcan
            </ul>
            <div class="tab-content" id="contentTabsContent">
                @can('active-document')
                    <div @if (auth()->user()->can('active-document')) class="tab-pane fade show active" @else  class="tab-pane fade" @endif
                        id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <div id="kt_app_content_container" class="app-container container-xxl">
                                <div class="card">
                                    <div class="card-body pt-0">
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable documentTable"
                                            id="kt_customers_table">
                                            <thead>
                                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                    <th class="text-center">Sl No</th>
                                                    <th class="text-center">Title</th>
                                                    <th class="text-center">Menu</th>
                                                    <th class="text-center">Unit</th>
                                                    <th class="text-center">Category</th>
                                                    <th class="text-center">Publish Date</th>
                                                    <th class="text-center">Expiry Date</th>
                                                    <th class="text-center">Document Link</th>
                                                    <th class="text-center">Active/Inactive</th>
                                                    <th class="min-w-70px text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fw-semibold text-gray-600">
                                                @forelse ($details_active as $document)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td class="text-center">{{ $document->title_en ?? 'N/A' }}</td>
                                                        <td class="text-center">{{ $document->menu?->title_en ?? 'N/A' }}</td>
                                                        <td class="text-center">{{ $document->unit?->title_en ?? 'N/A' }}</td>
                                                        <td class="text-center">{{ $document->category?->title_en ?? 'N/A' }}
                                                        </td>
                                                        <td class="text-center">{{ $document->public_date ?? 'N/A' }}</td>
                                                        <td class="text-center">{{ $document->expiry_date ?? 'N/A' }}</td>
                                                        <td class="text-center">
                                                            <a href="{{$document->image_path}}"
                                                                target="_blank">{{$document->image_path}}</a>
                                                        </td>
                                                        <td>
                                                            @can('document-status-change')
                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" data-uuid="{{ $document->uuid }}"
                                                                    data-table="documents" class="form-check-input isVerified"
                                                                    id="status_{{ $document->id }}"
                                                                    value="{{ $document->is_active ?? 0 }}"{{ $document->is_active == 1 ? 'checked' : '' }}>
                                                                <label class="custom-control-label"
                                                                    for="status_{{ $document->id }}">{{ $document->is_active == 1 ? 'Active' : 'In-Active' }}</label>
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
                                                                @can('edit-document')
                                                                    <div class="menu-item px-3">
                                                                        <a class="menu-link px-3"
                                                                            href="{{ route('admin.document.add', $document->uuid) }}">Edit</a>
                                                                    </div>
                                                                @endcan
                                                                @can('delete-document')
                                                                    <div class="menu-item px-3">
                                                                        <a href="javascript:void(0)" data-table="documents"
                                                                            data-uuid="{{ $document->uuid }}"
                                                                            class="menu-link px-3 custom-data-table deleteData"
                                                                            data-kt-customer-table-filter="delete_row">Delete</a>
                                                                    </div>
                                                                @endcan
                                                                @can('archived-to-active-document')
                                                                <div class="menu-item px-3">
                                                                    <a href="javascript:void(0)" data-table="documents"
                                                                    data-uuid="{{ $document->uuid }}"
                                                                    class="menu-link px-3 custom-data-table convertActiveArchivedData"
                                                                    data-kt-customer-table-filter="delete_row">Covert into
                                                                    Archived Mode</a>
                                                                </div>
                                                            @endcan
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="10" class="text-center"><img style="width: 450px;"
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
                @endcan
                @can('archived-document')
                    <div @if (auth()->user()->can('active-document')) class="tab-pane fade" @else class="tab-pane fade show active" @endif
                        class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <div id="kt_app_content_container" class="app-container container-xxl">
                                <div class="card">
                                    <div class="card-body pt-0">
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable documentTable"
                                            id="kt_customers_table">
                                            <thead>
                                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                    <th class="text-center">Sl No</th>
                                                    <th class="text-center">Title</th>
                                                    <th class="text-center">Menu</th>
                                                    <th class="text-center">Unit</th>
                                                    <th class="text-center">Category</th>
                                                    <th class="text-center">Publish Date</th>
                                                    <th class="text-center">Expiry Date</th>
                                                    <th class="text-center">Document Link</th>
                                                    <th class="min-w-70px text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fw-semibold text-gray-600">
                                                @forelse ($details_archived as $document)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td class="text-center">{{ $document->title_en ?? 'N/A' }}</td>
                                                        <td class="text-center">{{ $document->menu?->title_en ?? 'N/A' }}</td>
                                                        <td class="text-center">{{ $document->unit?->title_en ?? 'N/A' }}</td>
                                                        <td class="text-center">{{ $document->category?->title_en ?? 'N/A' }}
                                                        </td>
                                                        <td class="text-center">{{ $document->public_date ?? 'N/A' }}</td>
                                                        <td class="text-center">{{ $document->expiry_date ?? 'N/A' }}</td>
                                                        <td class="text-center">{{ $document->image_path ?? 'N/A' }}</td>

                                                        <td class="text-center">
                                                            @can('archived-to-active-document')
                                                            <a href="javascript:void(0)" data-table="documents"
                                                                data-uuid="{{ $document->uuid }}"
                                                                class="menu-link px-3 custom-data-table convertActiveArchivedData"
                                                                data-kt-customer-table-filter="delete_row">Covert into
                                                                Active Mode</a>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="10" class="text-center"><img style="width: 450px;"
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
                @endcan
            </div>
        </div>
    </div>
    @push('script')
    @endpush
@endsection
