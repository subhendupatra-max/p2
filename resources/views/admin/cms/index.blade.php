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
                            <h3 class="page-heading">Content List</h3>
                        </li>
                    </ul>
                </div>

                @can('add-content')
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                            <button type="button" class="btn btn-dark goTo" data-action="{{ route('admin.content.add') }}">Add
                                Content</button>
                        </div>
                    </div>
                @endcan
            </div>
            <ul class="nav nav-tabs mb-5" id="contentTabs" role="tablist">
                @can('active-content')
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1"
                            type="button" role="tab" aria-controls="tab1"
                            @if (auth()->user()->can('active-content')) aria-selected="true" @else  aria-selected="false" @endif>
                            Active Content
                        </button>
                    </li>
                @endcan
                @can('archived-content')
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button"
                            role="tab" aria-controls="tab2"
                            @if (auth()->user()->can('active-content')) aria-selected="false" @else  aria-selected="true" @endif>
                            Archive Content
                        </button>
                    </li>
                @endcan
            </ul>
            <div class="tab-content" id="contentTabsContent">
                @can('active-content')
                    <div @if (auth()->user()->can('active-content')) class="tab-pane fade show active" @else  class="tab-pane fade" @endif
                        id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <div id="kt_app_content_container" class="app-container container-xxl">
                                <div class="card">
                                    <div class="card-body pt-0">
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable contentTable"
                                            id="kt_customers_table">
                                            <thead>
                                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                    <th class="text-center">Sl No</th>
                                                    <th class="text-center">Task</th>
                                                    <th class="text-center">Title</th>
                                                    <th class="text-center">Unit</th>
                                                    <th class="text-center">Menu</th>
                                                    <th class="text-center">Section</th>
                                                    <th class="text-center">Redirect To</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Active/Inactive</th>
                                                    <th class="min-w-70px text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fw-semibold text-gray-600">
                                                @forelse ($details_active as $content)
                                                    {{--  <?php dd($content->id, $content->hindi_contant_creator_status, $content->english_contant_creator_status, $content->hindi_reviewer_status, $content->review_status, $content->hindi_approver_status, $content->approve_status); ?>  --}}
                                                    <tr id="{{ $content->id }}">
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td class="text-center">{{ $content->task ?? 'N/A' }}</td>
                                                        <td class="text-center">{{ $content->title_en ?? 'N/A' }}</td>
                                                        <td class="text-center">{{ $content->unit->title_en ?? 'N/A' }}</td>
                                                        <td class="text-center">{{ $content->menu->menu_path ?? 'N/A' }}</td>
                                                        <td class="text-center">{{ $content->section->title ?? 'N/A' }}</td>
                                                        <td class="text-center">
                                                            @if ($content->redirect_to == 3)
                                                                Open File
                                                            @elseif($content->redirect_to == 1)
                                                                Link
                                                            @elseif($content->redirect_to == 2)
                                                                Details Page
                                                            @else
                                                                No Redirect
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (
                                                                $content->hindi_contant_creator_status == 0 &&
                                                                    $content->english_contant_creator_status == 1 &&
                                                                    $content->hindi_reviewer_status == 0 &&
                                                                    $content->review_status == 0 &&
                                                                    $content->hindi_approver_status == 0 &&
                                                                    $content->approve_status == 0)
                                                                <badge class="badge badge-info">English Content Writing Done
                                                                </badge>
                                                            @elseif (
                                                                $content->hindi_contant_creator_status == 1 &&
                                                                    $content->english_contant_creator_status == 0 &&
                                                                    $content->hindi_reviewer_status == 0 &&
                                                                    $content->review_status == 0 &&
                                                                    $content->hindi_approver_status == 0 &&
                                                                    $content->approve_status == 0)
                                                                <badge class="badge badge-info">Hindi Content Writing Done
                                                                </badge>
                                                            @elseif (
                                                                $content->hindi_contant_creator_status == 1 &&
                                                                    $content->english_contant_creator_status == 1 &&
                                                                    $content->hindi_reviewer_status == 0 &&
                                                                    $content->review_status == 0 &&
                                                                    $content->hindi_approver_status == 0 &&
                                                                    $content->approve_status == 0)
                                                                <badge class="badge badge-info">Hindi & English Content Writing
                                                                    Done
                                                                </badge>
                                                            @elseif (
                                                                $content->hindi_contant_creator_status == 1 &&
                                                                    $content->english_contant_creator_status == 1 &&
                                                                    $content->hindi_reviewer_status == 1 &&
                                                                    $content->review_status == 1 &&
                                                                    $content->hindi_approver_status == 0 &&
                                                                    $content->approve_status == 1)
                                                                <badge class="badge badge-info">English Content Approved</badge>
                                                            @elseif (
                                                                $content->hindi_contant_creator_status == 1 &&
                                                                    $content->english_contant_creator_status == 1 &&
                                                                    $content->hindi_reviewer_status == 1 &&
                                                                    $content->review_status == 1 &&
                                                                    $content->hindi_approver_status == 1 &&
                                                                    $content->approve_status == 0)
                                                                <badge class="badge badge-info">Hindi Content Approved</badge>
                                                            @elseif (
                                                                $content->hindi_contant_creator_status == 1 &&
                                                                    $content->english_contant_creator_status == 1 &&
                                                                    $content->hindi_reviewer_status == 1 &&
                                                                    $content->review_status == 1 &&
                                                                    $content->hindi_approver_status == 1 &&
                                                                    $content->approve_status == 1)
                                                                <badge class="badge badge-success">Hindi & English Content
                                                                    Approved &
                                                                    Content Posted</badge>
                                                            @elseif (
                                                                $content->hindi_contant_creator_status == 1 &&
                                                                    $content->english_contant_creator_status == 1 &&
                                                                    $content->hindi_reviewer_status == 0 &&
                                                                    $content->review_status == 1 &&
                                                                    $content->hindi_approver_status == 0 &&
                                                                    $content->approve_status == 0)
                                                                <badge class="badge badge-info">English Content Reviewed</badge>
                                                            @elseif (
                                                                $content->hindi_contant_creator_status == 1 &&
                                                                    $content->english_contant_creator_status == 1 &&
                                                                    $content->hindi_reviewer_status == 1 &&
                                                                    $content->review_status == 0 &&
                                                                    $content->hindi_approver_status == 0 &&
                                                                    $content->approve_status == 0)
                                                                <badge class="badge badge-info">Hindi Content Reviewed</badge>
                                                            @elseif (
                                                                $content->hindi_contant_creator_status == 1 &&
                                                                    $content->english_contant_creator_status == 1 &&
                                                                    $content->hindi_reviewer_status == 1 &&
                                                                    $content->review_status == 1 &&
                                                                    $content->hindi_approver_status == 0 &&
                                                                    $content->approve_status == 0)
                                                                <badge class="badge badge-info">Hindi & English Content Reviewed
                                                                </badge>
                                                            @else
                                                                <badge class="badge badge-warning">Pending</badge>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            @can('content-status-change')
                                                                <div class="form-check form-switch">
                                                                    <input type="checkbox" data-uuid="{{ $content->uuid }}"
                                                                        data-table="cms" class="form-check-input isVerified"
                                                                        id="status2_{{ $content->id }}"
                                                                        value="{{ $content->is_active ?? 0 }}"
                                                                        {{ $content->is_active == 1 ? 'checked' : '' }}>
                                                                    <label class="custom-control-label"
                                                                        for="status2_{{ $content->id }}">{{ $content->is_active == 1 ? 'Active' : 'In-Active' }}</label>
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
                                                                @can('view-content')
                                                                    <div class="menu-item px-3">
                                                                        <a class="menu-link px-3"
                                                                            href="{{ route('admin.content.view', $content->uuid) }}">View</a>
                                                                    </div>
                                                                @endcan
                                                                @can('edit-content')
                                                                    @if ((
                                                                        $content->hindi_contant_creator_status == 1 &&
                                                                            $content->english_contant_creator_status == 1 &&
                                                                            $content->hindi_reviewer_status == 1 &&
                                                                            $content->review_status == 1 &&
                                                                            $content->hindi_approver_status == 1 &&
                                                                            $content->approve_status == 1) && (
                                                                                auth()->user()->can('edit-after-approve-content')
                                                                            ))
                                                                        <div class="menu-item px-3">
                                                                            <a class="menu-link px-3"
                                                                                href="{{ route('admin.content.edit', $content->uuid) }}">Edit</a>
                                                                        </div>
                                                                        @else
                                                                        @endif

                                                                    @else
                                                                        <div class="menu-item px-3">
                                                                            <a class="menu-link px-3"
                                                                                href="{{ route('admin.content.edit', $content->uuid) }}">Edit</a>
                                                                        </div>
                                                                    @endif
                                                                @endcan
                                                                @can('delete-content')
                                                                    <div class="menu-item px-3">
                                                                        <a href="javascript:void(0)" data-table="cms"
                                                                            data-uuid="{{ $content->uuid }}"
                                                                            class="menu-link px-3 custom-data-table deleteData"
                                                                            data-kt-customer-table-filter="delete_row">Delete</a>
                                                                    </div>
                                                                @endcan
                                                                @can('archived-to-active-content')
                                                                    <div class="menu-item px-3">
                                                                        <a href="javascript:void(0)" data-table="cms"
                                                                            data-uuid="{{ $content->uuid }}"
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
                @can('archived-content')
                    <div @if (auth()->user()->can('active-content')) class="tab-pane fade" @else class="tab-pane fade show active" @endif
                        class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <div id="kt_app_content_container" class="app-container container-xxl">
                                <div class="card">
                                    <div class="card-body pt-0">
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable contentTable"
                                            id="kt_customers_table2">
                                            <thead>
                                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                    <th class="text-center">Sl No</th>
                                                    <th class="text-center">Title</th>
                                                    <th class="text-center">Unit</th>
                                                    <th class="text-center">Menu</th>
                                                    <th class="text-center">Section</th>
                                                    <th class="text-center">Redirect To</th>
                                                    <th class="min-w-70px text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fw-semibold text-gray-600">
                                                @forelse ($details_archive as $content)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td class="text-center">{{ $content->title_en ?? 'N/A' }}</td>
                                                        <td class="text-center">{{ $content->unit->title_en ?? 'N/A' }}</td>
                                                        <td class="text-center">{{ $content->menu->menu_path ?? 'N/A' }}</td>
                                                        <td class="text-center">{{ $content->section->title ?? 'N/A' }}</td>
                                                        <td class="text-center">
                                                            @if ($content->redirect_to == 3)
                                                                Open File
                                                            @elseif($content->redirect_to == 1)
                                                                Link
                                                            @elseif($content->redirect_to == 2)
                                                                Details Page
                                                            @else
                                                                No Redirect
                                                            @endif
                                                        </td>

                                                        <td class="text-center">
                                                            <a href="javascript:void(0)"
                                                                class="btn btn-sm btn-dark btn-active-light-primary"
                                                                data-kt-menu-trigger="click"
                                                                data-kt-menu-placement="bottom-end">Actions</a>
                                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                                data-kt-menu="true">

                                                                @can('archived-to-active-content')
                                                                    <div class="menu-item px-3">
                                                                        <a href="javascript:void(0)" data-table="cms"
                                                                            data-uuid="{{ $content->uuid }}"
                                                                            class="menu-link px-3 custom-data-table convertActiveArchivedData"
                                                                            data-kt-customer-table-filter="delete_row">Covert into
                                                                            Active Mode</a>
                                                                    </div>
                                                                @endcan

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center"><img style="width: 450px;"
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
        @push('script')
            <script>
                $(document).ready(function() {
                    $('.contentTable tbody').sortable({
                        update: function(event, ui) {
                            var newOrder = $(this).sortable('toArray');

                            $.ajax({
                                type: "post",
                                url: "{{ route('admin.content.order') }}",
                                data: {
                                    order: newOrder
                                },
                                success: function(response) {
                                    toastr.success('Ordering Updated');
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1500);
                                }
                            });
                        }
                    });
                });
            </script>
        @endpush
    @endsection
