@extends('layout.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div id="root">
                <div class="container pt-5">
                    <div class="row align-items-stretch">

                        @can('total-user')
                            <div class="c-dashboardInfo col-lg-3 col-md-6">
                                <a href="{{ route('admin.user.list') }}">
                                    <div class="wrap">
                                        <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Total
                                            User
                                        </h4><span
                                            class="hind-font caption-12 c-dashboardInfo__count">{{ $total_user ?? '0' }}</span>
                                    </div>
                                </a>
                            </div>
                        @endcan
                        @can('total-unit')
                            <div class="c-dashboardInfo col-lg-3 col-md-6">
                                <a href="{{ route('admin.unit.list') }}">
                                    <div class="wrap">
                                        <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Total
                                            Unit
                                        </h4><span
                                            class="hind-font caption-12 c-dashboardInfo__count">{{ $total_unit ?? '0' }}</span>
                                    </div>
                                </a>
                            </div>
                        @endcan
                        @can('total-unit-admin')
                            <div class="c-dashboardInfo col-lg-3 col-md-6">
                                <a href="{{ route('admin.user.list') }}">
                                    <div class="wrap">
                                        <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Total
                                            Unit
                                            Admin</h4><span
                                            class="hind-font caption-12 c-dashboardInfo__count">{{ $total_unit_admin ?? '0' }}</span>
                                    </div>
                                </a>
                            </div>
                        @endcan
                        @can('total-approver')
                            <div class="c-dashboardInfo col-lg-3 col-md-6">
                                <a href="{{ route('admin.user.list') }}">
                                    <div class="wrap">
                                        <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Total
                                            Reviewer</h4><span
                                            class="hind-font caption-12 c-dashboardInfo__count">{{ $total_reviewers ?? '0' }}</span>
                                    </div>
                                </a>
                            </div>
                        @endcan
                        @can('total-reviewer')
                            <div class="c-dashboardInfo col-lg-3 col-md-6">
                                <a href="{{ route('admin.user.list') }}">
                                    <div class="wrap">
                                        <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Total
                                            Approver</h4><span
                                            class="hind-font caption-12 c-dashboardInfo__count">{{ $total_approvers ?? '0' }}</span>
                                    </div>
                                </a>
                            </div>
                        @endcan
                    </div>
                    @can('task-list')
                    <div class="row align-items-stretch">
                        <div class="card pt-2">
                            <h4> Task Status</h4>
                            <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable contentTable"
                                            id="kt_customers_table">
                                <thead>
                                    <tr>
                                        <th>Sl no</th>
                                        <th>Task</th>
                                        <th>Status</th>
                                        <th>Last Updated At</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($cmsData as $key => $content)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><a href="{{ route('admin.content.view', $content->uuid) }}">{{ $content->task ?? 'N/A' }}</a></td>
                                            <td>
                                                @if (
                                                    $content->hindi_contant_creator_status == 0 &&
                                                        $content->english_contant_creator_status == 1 &&
                                                        $content->hindi_contant_reviewer_status == 0 &&
                                                        $content->english_contant_reviewer_status == 0 &&
                                                        $content->hindi_contant_approver_status == 0 &&
                                                        $content->english_contant_approver_status == 0)
                                                    <badge class="badge badge-info">English Content Writing Done</badge>
                                                @elseif (
                                                    $content->hindi_contant_creator_status == 1 &&
                                                        $content->english_contant_creator_status == 0 &&
                                                        $content->hindi_contant_reviewer_status == 0 &&
                                                        $content->english_contant_reviewer_status == 0 &&
                                                        $content->hindi_contant_approver_status == 0 &&
                                                        $content->english_contant_approver_status == 0)
                                                    <badge class="badge badge-info">Hindi Content Writing Done</badge>
                                                @elseif (
                                                    $content->hindi_contant_creator_status == 1 &&
                                                        $content->english_contant_creator_status == 1 &&
                                                        $content->hindi_contant_reviewer_status == 0 &&
                                                        $content->english_contant_reviewer_status == 0 &&
                                                        $content->hindi_contant_approver_status == 0 &&
                                                        $content->english_contant_approver_status == 0)
                                                    <badge class="badge badge-info">Hindi & English Content Writing Done
                                                    </badge>
                                                @elseif (
                                                    $content->hindi_contant_creator_status == 1 &&
                                                        $content->english_contant_creator_status == 1 &&
                                                        $content->hindi_contant_reviewer_status == 1 &&
                                                        $content->english_contant_reviewer_status == 1 &&
                                                        $content->hindi_contant_approver_status == 0 &&
                                                        $content->english_contant_approver_status == 1)
                                                    <badge class="badge badge-info">English Content Approved</badge>
                                                @elseif (
                                                    $content->hindi_contant_creator_status == 1 &&
                                                        $content->english_contant_creator_status == 1 &&
                                                        $content->hindi_contant_reviewer_status == 1 &&
                                                        $content->english_contant_reviewer_status == 1 &&
                                                        $content->hindi_contant_approver_status == 1 &&
                                                        $content->english_contant_approver_status == 0)
                                                    <badge class="badge badge-info">Hindi Content Approved</badge>
                                                @elseif (
                                                    $content->hindi_contant_creator_status == 1 &&
                                                        $content->english_contant_creator_status == 1 &&
                                                        $content->hindi_contant_reviewer_status == 1 &&
                                                        $content->english_contant_reviewer_status == 1 &&
                                                        $content->hindi_contant_approver_status == 1 &&
                                                        $content->english_contant_approver_status == 1)
                                                    <badge class="badge badge-success">Hindi & English Content Approved &
                                                        Content Posted</badge>
                                                @elseif (
                                                    $content->hindi_contant_creator_status == 1 &&
                                                        $content->english_contant_creator_status == 1 &&
                                                        $content->hindi_contant_reviewer_status == 0 &&
                                                        $content->english_contant_reviewer_status == 1 &&
                                                        $content->hindi_contant_approver_status == 0 &&
                                                        $content->english_contant_approver_status == 0)
                                                    <badge class="badge badge-info">English Content Reviewed</badge>
                                                @elseif (
                                                    $content->hindi_contant_creator_status == 1 &&
                                                        $content->english_contant_creator_status == 1 &&
                                                        $content->hindi_contant_reviewer_status == 1 &&
                                                        $content->english_contant_reviewer_status == 0 &&
                                                        $content->hindi_contant_approver_status == 0 &&
                                                        $content->english_contant_approver_status == 0)
                                                    <badge class="badge badge-info">Hindi Content Reviewed</badge>
                                                @elseif (
                                                    $content->hindi_contant_creator_status == 1 &&
                                                        $content->english_contant_creator_status == 1 &&
                                                        $content->hindi_contant_reviewer_status == 1 &&
                                                        $content->english_contant_reviewer_status == 1 &&
                                                        $content->hindi_contant_approver_status == 0 &&
                                                        $content->english_contant_approver_status == 0)
                                                    <badge class="badge badge-info">Hindi & English Content Reviewed
                                                    </badge>
                                                @else
                                                    <badge class="badge badge-warning">Pending</badge>
                                                @endif
                                            </td>
                                            <td>{{ date('d/m/Y h:i A', strtotime($content->updated_at)) }}</td>
                                            <td>
                                                <a href="{{ route('admin.content.view', $content->uuid) }}" class="btn btn-success btn-sm"><i class="fa fa-eye text-blue"></i></a>
                                                <a href="{{ route('admin.content.add', $content->uuid) }}" class="btn btn-info btn-sm"><i class="fa fa-edit text-green"></i></a>
                                                </td>
                                        </tr>
                                    @empty
                                    @endforelse


                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
    @endpush
@endsection
