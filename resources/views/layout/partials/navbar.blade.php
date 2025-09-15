<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
    <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
        data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
        data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end"
        data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
        data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
        data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
        <div class="nav-logo d-flex align-items-center">
            <img src="{{ asset('assets/media/images/logo.png') }}" alt="User Image">
            <h1 class="logo-text">
                Directorate of Ordnance (Coordination and Services)
            </h1>
        </div>
    </div>

    <div class="app-navbar flex-shrink-0">
        {{--  <div class="app-navbar-item ms-1 ms-md-3">
            <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px"
                id="kt_activities_toggle">
                <a href="javascript:void(0)">
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton12"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="svg-icon svg-icon-3">
                                <i class="fa-solid fa-bell"></i>
                            </span>
                            <div class="noti_count">
                                <p>{{ countUnReadNotificationSuperAdmin() ?? 0 }}</p>
                            </div>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton12">
                            <div class="notifi_box">
                                <div class="notiheader d-flex justify-content-between">
                                    <p>Notification</p><em class="goTo"
                                        data-action="{{ route('admin.notification.list') }}">View All -></em>
                                </div>
                                @forelse (listUnReadNotificationSuperAdmin() as $notification)
                                    <div class="goToo singlenoti_con {{ $notification->is_read == 1 ? 'active' : '' }}"
                                        onclick="readNotification({{ $notification->id }})">
                                        <h6>
                                            <span>{{ $notification->title ?? '' }}</span>
                                        </h6>
                                        <p><span class="badge badge-info">{{ $notification->user?->name ?? '' }}</span>
                                            {{ \Carbon\Carbon::parse($notification->created_at)->diffForhumans() }}</p>
                                        </p>
                                    </div>
                                @empty
                                    <div class="singlenoti_con">
                                        <h6>
                                            <span>No Notification Found</span>
                                        </h6>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>  --}}

        <div class="app-navbar-item ms-1 ms-md-3" id="kt_header_user_menu_toggle">
            <div class="cursor-pointer symbol symbol-30px symbol-md-40px"
                data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                data-kt-menu-placement="bottom-end">
                <img src="{{ auth()->user()->image_path }}" alt="User Image" width="60px;">
            </div>
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                data-kt-menu="true">
                <div class="menu-item px-3">
                    <div class="menu-content d-flex align-items-center px-3">
                        <div class="symbol symbol-50px me-5">
                            <img src="{{ auth()->user()->image_path }}" alt="User Image" width="60px;">
                        </div>
                        <div class="d-flex flex-column">
                            <div class="fw-bold d-flex align-items-center fs-5">
                                @if (auth()->user()->name)
                                    {{ auth()->user()->name }}
                                @else
                                    Super Admin
                                @endif
                            </div>
                            @if (auth()->user()->email != null)
                                <a href="javascript:void(0)" title="{{ auth()->user()->email }}"
                                    class="fw-semibold text-muted text-hover-primary fs-7">{{ Str::limit(auth()->user()->email, 20, $end = '...') }}</a>
                            @else
                                <a href="javascript:void(0)"
                                    class="fw-semibold text-muted text-hover-primary fs-7">Email not available</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="separator my-2"></div>
                <div class="menu-item px-5">
                    <a href="javascript:void(0)" class="menu-link px-5" data-bs-toggle="modal"
                        data-bs-target="#admin_update_form">My
                        Profile</a>
                </div>
                <div class="menu-item px-5">
                    <a href="javascript:void(0)" class="menu-link px-5" data-bs-toggle="modal"
                        data-bs-target="#admin_password_form">Change Password</a>
                </div>
                <div class="separator my-2"></div>
                <div class="menu-item px-5">
                    <a action="{{ route('admin.logout') }}" class="menu-link px-5 logOut">Sign Out</a>
                </div>
            </div>
        </div>
        <div class="app-navbar-item d-lg-none ms-2 me-n3" title="Show header menu">
            <div class="btn btn-icon btn-active-color-primary w-30px h-30px w-md-35px h-md-35px"
                id="kt_app_header_menu_toggle">
                <span class="svg-icon svg-icon-2 svg-icon-md-1">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z"
                            fill="currentColor" />
                        <path opacity="0.3"
                            d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z"
                            fill="currentColor" />
                    </svg>
                </span>
            </div>
        </div>
    </div>
</div>
@section('modal')
    <div class="modal fade" id="admin_update_form" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content rounded">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                    transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <form id="admin_update_form_form" class="form formSubmitWithoutCatcha fileUpload"
                        action="{{ route('admin.profile.update') }}" enctype='multipart/form-data'>
                        <div class="mb-13 text-center">
                            <h1 class="mb-3">Edit Information</h1>

                        </div>
                        <!-- <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Name</span>
                            </label>
                            <input type="text" class="form-control form-control-solid" placeholder="Enter Name"
                                name="admin_name" id="admin_name" value="{{ auth()->user()->name ?? null }}" />
                        </div> -->
                        <div class="row">
                            <div class="col-md-12 m-auto text-center">
                                <label>
                                    <span class="label_title">Profile Image</span>
                                    <span class="asterisk_sign">*</span>
                                </label>
                                <div class="fv-row">
                                    <style>
                                        .image-input-placeholder-admin {
                                            background-image: url({{ auth()->user()->image_path }});
                                        }
                                    </style>
                                    <div class="image-input image-input-empty image-input-outline image-input-placeholder-admin"
                                        data-kt-image-input="true">
                                        <div class="image-input-wrapper w-125px h-125px"></div>
                                        <label
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                            title="Add image">
                                            <div class="img_edit_btn_icon">
                                                <i class="fa-solid fa-pen"></i>
                                            </div>
                                            <input type="file" name="admin_profile_image" accept=".png, .jpg, .jpeg"
                                                id="admin_profile_image" />
                                            <input type="hidden" name="avatar_remove" />
                                        </label>
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                            title="Cancel image">
                                            <i class="fa-solid fa-xmark"></i>
                                        </span>
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                            title="Remove logo">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                    </div>
                                    <div class="form-text" style="font-size: 10px; color: #000 !important;">Allowed file
                                        types: png, jpg, jpeg.(Max Size : 5mb)
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 m-auto">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-4">
                                    <span class="required">Name</span>
                                </label>
                                <input type="text" class="form-control form-control-solid mb-4" placeholder="Enter Name"
                                    name="admin_name" id="admin_name" value="{{ auth()->user()->name ?? null }}" />
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Email</span>
                                </label>
                                <input type="text" class="form-control form-control-solid mb-4" placeholder="Enter Email"
                                    name="admin_email" id="admin_email" readonly value="{{ auth()->user()->email ?? null }}" />

                                <label class="d-flex align-items-center pt-4 fs-6 fw-semibold mb-2">
                                    <span class="required">Phone Number</span>
                                </label>
                                <input type="text" class="form-control form-control-solid mb-4"
                                    placeholder="Enter Phone Number" readonly id="admin_mobile_number" name="admin_mobile_number"
                                    value="{{ auth()->user()->mobile_number ?? null }}" />
                            </div>
                        </div>
                        <div class="text-center pt-4">
                            <button type="reset" id="admin_update_form_cancel" class="btn btn-light me-3 mb-4"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="admin_update_form_submit" class="btn btn-dark">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="admin_password_form" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content rounded">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                    transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <form id="admin_password_update_form" class="form formSubmitWithoutCatcha fileupload"
                        action="{{ route('admin.password.update') }}" enctype='multipart/form-data'>
                        <div class="mb-13 text-center">
                            <h1 class="mb-3">Change Password</h1>
                            <div class="text-muted fw-semibold fs-5">Update your password
                            </div>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Old Password</span>
                            </label>
                            <input type="password" class="form-control form-control-solid"
                                placeholder="Enter Old Password" name="old_password" id="old_password" />
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">New Password</span>
                                <span class="text-danger" style="font-size: 11px;">
                                    Password must be at least 8 characters and include at least uppercase letter, number and special character.
                                </span>
                            </label>
                            <input type="password" class="form-control form-control-solid"
                                placeholder="Enter New Password" name="new_password" id="new_password" />
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Confirm Password</span>
                            </label>
                            <input type="password" class="form-control form-control-solid"
                                placeholder="Re Enter your new password" name="confirm_password" id="confirm_password" />
                        </div>
                        <div class="text-center pt-4">
                            <button type="reset" id="admin_password_form_cancel" class="btn btn-light me-3"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="admin_password_form_submit" class="btn btn-dark">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
        <script>
            $(document).ready(function() {
                $('.notifi_box').click(function() {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('admin.read.notification') }}",
                        cache: false,
                    });
                });
            });
        </script>
@endpush
