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
                            <h3 class="page-heading">Feedback List</h3>
                        </li>
                    </ul>
                </div>

            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <div class="card">
                        <div class="card-body pt-0">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable hodTable"
                                id="kt_customers_table">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="text-center">Sl No</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Mobile No</th>
                                        <th class="text-center">Feedback</th>
                                        <th class="text-center">Unit</th>
                                        <th class="text-center">Feedback Type</th>
                                        <th class="text-center">Created At</th>
                                        <th class="text-center">Is Replied</th>
                                        <th class="text-center">#</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @forelse ($details as $feedback_data)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $feedback_data->name ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $feedback_data->email ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $feedback_data->mobile ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $feedback_data->feedback ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $feedback_data->unit?->title_en ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $feedback_data->feedback_type ?? 'N/A' }}</td>
                                            <td class="text-center">
                                                {{ date('d/m/Y h:i A', strtotime($feedback_data->created_at)) ?? 'N/A' }}
                                            </td>
                                            <td>
                                                @if ($feedback_data->is_replied == 1)
                                                    <span class="badge badge-success">Yes</span>
                                                @else
                                                    <span class="badge badge-danger">No</span>
                                                @endif
                                            </td>
                                            <td>
                                                @can('reply-feedback')
                                                <a class="btn btn-light btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modalViewFeedback"
                                                    onclick="openModalViewFeedback({{ $feedback_data->id }}, '{{ $feedback_data->email }}')"><i
                                                        class="fa fa-envelope"></i>Reply</a>
                                                @endcan
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
    <!--begin::Modal View Feedback-->
    <div class="modal fade" id="modalViewFeedback" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="fw-bolder">Reply</h2>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-1"></span>
                    </div>
                </div>
                <div class="modal-body scroll-y">
                <form id="reply_feedback_form" action="{{ route('admin.feedback.reply') }}" method="POST"  class="formSubmit fileUpload">
                @csrf
                    <textarea class="form-control" id="reply_feedback" name="reply_feedback" rows="3"></textarea>
                    <input type="hidden" name="feedback_id" id="feedback_id">
                    <input type="hidden" name="email" id="email">
                    <div class="d-flex justify-content-end mt-5">
                        <button type="submit" class="btn btn-primary" id="send_feedback">Send</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal View Feedback-->
    @push('script')
        <script>
            function openModalViewFeedback(feedback_id, email) {
                $('#reply_feedback_form').trigger('reset');
                $('#feedback_id').val(feedback_id);
                $('#email').val(email);
            }
        </script>
    @endpush
@endsection
