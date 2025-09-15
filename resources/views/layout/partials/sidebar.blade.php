<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu"
                data-kt-menu="true" data-kt-menu-expand="false">

                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start"
                    class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention">
                    <a href="{{ route('admin.dashboard') }}">
                        <span class="menu-link {{ sidebarActive(['admin.dashboard']) }}">
                            <span class="menu-icon">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fa fa-home" aria-hidden="true"></i>
                                    </span>
                                </span>
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </span>
                    </a>
                </div>
                @canany(['user-list', 'add-user', 'edit-user', 'delete-user', 'user-status-change'])
                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start"
                        class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention">
                        <a href="{{ route('admin.user.list') }}">
                            <span class="menu-link {{ sidebarActive(['admin.user.*']) }}">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fa fa-users"></i>
                                    </span>
                                </span>
                                <span class="menu-title">Users</span>
                            </span>
                        </a>
                    </div>
                @endcanany
                @canany(['aipr-list', 'add-aipr', 'edit-aipr', 'delete-aipr', 'aipr-status-change'])
                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start"
                        class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention">
                        <a href="{{ route('admin.aipr.list') }}">
                            <span class="menu-link {{ sidebarActive(['admin.aipr.*']) }}">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fa fa-briefcase"></i>
                                    </span>
                                </span>
                                <span class="menu-title">AIPR</span>
                            </span>
                        </a>
                    </div>
                @endcanany

                @canany(['feedback-list', 'add-feedback', 'edit-feedback', 'delete-feedback', 'feedback-status-change'])
                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start"
                        class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention">
                        <a href="{{ route('admin.feedback.list') }}">
                            <span class="menu-link {{ sidebarActive(['admin.feedback.*']) }}">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                       <i class="fa-solid fa-comments"></i>
                                    </span>
                                </span>
                                <span class="menu-title">Feedback</span>
                            </span>
                        </a>
                    </div>
                @endcanany
                {{--  @canany(['notification-list', 'delete-notification'])
                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start"
                        class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention">
                        <a href="{{ route('admin.notification.list') }}">
                            <span class="menu-link {{ sidebarActive(['admin.notification.*']) }}">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fa-solid fa-bell"></i>
                                    </span>
                                </span>
                                <span class="menu-title">Notification List</span>
                            </span>
                        </a>
                    </div>
                @endcanany  --}}
                @canany(['aipr-master-list', 'add-aipr-master', 'edit-aipr-master', 'delete-aipr-master',
                    'aipr-master-status-change', 'all-content', 'my-content', 'delete-content', 'content-status-change',
                    'designation-list', 'add-designation', 'edit-designation', 'delete-designation',
                    'designation-status-change', 'unit-list', 'add-unit', 'edit-unit', 'delete-unit', 'unit-status-change',
                    'menu-list', 'add-menu', 'edit-menu', 'delete-menu', 'menu-status-change', 'category-list',
                    'add-category', 'edit-category', 'delete-category', 'category-status-change', 'media-list', 'add-media',
                    'edit-media', 'delete-media', 'media-status-change', 'hod-list', 'add-hod', 'edit-hod', 'delete-hod',
                    'hod-status-change', 'section-list', 'section-status-change', 'document-list', 'add-document',
                    'edit-document', 'delete-document', 'document-status-change', 'team-list', 'add-team', 'edit-team',
                    'delete-team', 'team-status-change','banner-list', 'add-banner', 'edit-banner', 'delete-banner', 'banner-status-change'])
                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start"
                        class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention">
                        <div data-kt-menu-trigger="click"
                            class="menu-item menu-accordion {{ sidebarOpen(['admin.unit.*', 'admin.banner.*','admin.content.*', 'admin.menu.*', 'admin.document.*', 'admin.category.*', 'admin.section.*', 'admin.aipr-master.*', 'admin.hod.*', 'admin.team.*', 'admin.media.*', 'admin.designation.*']) }}">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <i class="fa-solid fa-pen-nib"></i>
                                        </span>
                                    </span>
                                </span>
                                <span class="menu-title">Master</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion" style="">
                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion mb-1">
                                    <div class="menu-item">
                                        @canany(['banner-list', 'add-banner', 'edit-banner', 'delete-banner',
                                            'banner-status-change'])
                                            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                                data-kt-menu-placement="right-start"
                                                class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention">
                                                <a href="{{ route('admin.banner.list') }}">
                                                    <span class="menu-link {{ sidebarActive(['admin.banner.*']) }}">
                                                        <span class="menu-icon">
                                                            <span class="svg-icon svg-icon-2">
                                                                <i class="fa-solid fa-images"></i>
                                                            </span>
                                                        </span>
                                                        <span class="menu-title">Manage Banner</span>
                                                    </span>
                                                </a>
                                            </div>
                                        @endcanany
                                        @canany(['aipr-master-list', 'add-aipr-master', 'edit-aipr-master',
                                            'delete-aipr-master', 'aipr-master-status-change'])
                                            <a href="{{ route('admin.aipr-master.list') }}">
                                                <span class="menu-link {{ sidebarActive(['admin.aipr-master.*']) }}">
                                                    <span class="menu-icon">
                                                        <span class="svg-icon svg-icon-2">
                                                            <i class="fa-solid fa-paperclip"></i>
                                                        </span>
                                                    </span>
                                                    <span class="menu-title">Manage AIPR Finance</span>
                                                </span>
                                            </a>
                                        @endcanany
                                        @canany(['all-content', 'my-content', 'delete-content', 'content-status-change'])
                                            <a href="{{ route('admin.content.list') }}">
                                                <span class="menu-link {{ sidebarActive(['admin.content.*']) }}">
                                                    <span class="menu-icon">
                                                        <span class="svg-icon svg-icon-2">
                                                            <i class="fa-solid fa-pen"></i>
                                                        </span>
                                                    </span>
                                                    <span class="menu-title">Manage Content</span>
                                                </span>
                                            </a>
                                        @endcanany
                                        @canany(['designation-list', 'add-designation', 'edit-designation',
                                            'delete-designation', 'designation-status-change'])
                                            <a href="{{ route('admin.designation.list') }}">
                                                <span class="menu-link {{ sidebarActive(['admin.designation.*']) }}">
                                                    <span class="menu-icon">
                                                        <span class="svg-icon svg-icon-2">
                                                            <i class="fa fa-signs-post"></i>
                                                        </span>
                                                    </span>
                                                    <span class="menu-title">Manage Designation</span>
                                                </span>
                                            </a>
                                        @endcanany
                                        @canany(['unit-list', 'add-unit', 'edit-unit', 'delete-unit', 'unit-status-change'])
                                            <a href="{{ route('admin.unit.list') }}">
                                                <span class="menu-link {{ sidebarActive(['admin.unit.*']) }}">
                                                    <span class="menu-icon">
                                                        <span class="svg-icon svg-icon-2">
                                                            <i class="fa fa-warehouse"></i>
                                                        </span>
                                                    </span>
                                                    <span class="menu-title">Manage Unit</span>
                                                </span>
                                            </a>
                                        @endcanany
                                        @canany(['menu-list', 'add-menu', 'edit-menu', 'delete-menu', 'menu-status-change'])
                                            <a href="{{ route('admin.menu.list') }}">
                                                <span class="menu-link {{ sidebarActive(['admin.menu.*']) }}">
                                                    <span class="menu-icon">
                                                        <span class="svg-icon svg-icon-2">
                                                            <i class="fa-solid fa-paperclip"></i>
                                                        </span>
                                                    </span>
                                                    <span class="menu-title">Manage Menu</span>
                                                </span>
                                            </a>
                                        @endcanany
                                        @canany(['category-list', 'add-category', 'edit-category', 'delete-category',
                                            'category-status-change'])
                                            <a href="{{ route('admin.category.list') }}">
                                                <span class="menu-link {{ sidebarActive(['admin.category.*']) }}">
                                                    <span class="menu-icon">
                                                        <span class="svg-icon svg-icon-2">
                                                            <i class="fa-solid fa-bookmark"></i>
                                                        </span>
                                                    </span>
                                                    <span class="menu-title">Manage Category</span>
                                                </span>
                                            </a>
                                        @endcanany
                                        @canany(['media-list', 'add-media', 'edit-media', 'delete-media',
                                            'media-status-change'])
                                            <a href="{{ route('admin.media.list') }}">
                                                <span class="menu-link {{ sidebarActive(['admin.media.*']) }}">
                                                    <span class="menu-icon">
                                                        <span class="svg-icon svg-icon-2">
                                                            <i class="fa fa-photo-film"></i>
                                                        </span>
                                                    </span>
                                                    <span class="menu-title">Manage Media</span>
                                                </span>
                                            </a>
                                        @endcanany
                                        @canany(['hod-list', 'add-hod', 'edit-hod', 'delete-hod', 'hod-status-change'])
                                            <a href="{{ route('admin.hod.list') }}">
                                                <span class="menu-link {{ sidebarActive(['admin.hod.*']) }}">
                                                    <span class="menu-icon">
                                                        <span class="svg-icon svg-icon-2">
                                                            <i class="fa-solid fa-inbox"></i>
                                                        </span>
                                                    </span>
                                                    <span class="menu-title">Manage HOD</span>
                                                </span>
                                            </a>
                                        @endcanany
                                        @canany(['section-list', 'section-status-change'])
                                            <a href="{{ route('admin.section.list') }}">
                                                <span class="menu-link {{ sidebarActive(['admin.section.*']) }}">
                                                    <span class="menu-icon">
                                                        <span class="svg-icon svg-icon-2">
                                                            <i class="fa-solid fa-shield-halved"></i>
                                                        </span>
                                                    </span>
                                                    <span class="menu-title">Manage Section</span>
                                                </span>
                                            </a>
                                        @endcanany
                                        @canany(['document-list', 'add-document', 'edit-document', 'delete-document',
                                            'document-status-change'])
                                            <a href="{{ route('admin.document.list') }}">
                                                <span class="menu-link {{ sidebarActive(['admin.document.*']) }}">
                                                    <span class="menu-icon">
                                                        <span class="svg-icon svg-icon-2">
                                                            <i class="fa-solid fa-file"></i>
                                                        </span>
                                                    </span>
                                                    <span class="menu-title">Manage Document</span>
                                                </span>
                                            </a>
                                        @endcanany
                                        @canany(['team-list', 'add-team', 'edit-team', 'delete-team', 'team-status-change'])
                                            <a href="{{ route('admin.team.list') }}">
                                                <span class="menu-link {{ sidebarActive(['admin.team.*']) }}">
                                                    <span class="menu-icon">
                                                        <span class="svg-icon svg-icon-2">
                                                            <i class="fa fa-people-group"></i>
                                                        </span>
                                                    </span>
                                                    <span class="menu-title">Manage Teams/Directory</span>
                                                </span>
                                            </a>
                                        @endcanany
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcanany

                @canany(['role-list', 'add-role', 'edit-role', 'delete-role', 'give-permission'])
                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start"
                        class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention">
                        <div data-kt-menu-trigger="click"
                            class="menu-item menu-accordion {{ sidebarOpen(['admin.role.*']) }}">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <i class="fa-solid fa-user-lock"></i>
                                        </span>
                                    </span>
                                </span>
                                <span class="menu-title">Role & Permission</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion" style="">
                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion mb-1">
                                    <div class="menu-item">
                                        <a href="{{ route('admin.role.list') }}">
                                            <span class="menu-link {{ sidebarActive(['admin.role.list']) }}">
                                                <span class="menu-icon">
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fa-solid fa-key"></i>
                                                    </span>
                                                </span>
                                                <span class="menu-title">Role List</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcanany
                @canany(['activity-log'])
                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start"
                        class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention">
                        <a href="{{ route('admin.activity-log.index') }}">
                            <span class="menu-link {{ sidebarActive(['admin.activity-log.*']) }}">
                                <span class="menu-icon">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <i class="fa-solid fa-square-person-confined"></i>
                                        </span>
                                    </span>
                                </span>
                                <span class="menu-title">Activity Log</span>
                            </span>
                        </a>
                    </div>
                @endcanany
                @canany(['website-setting-list', 'edit-website-setting'])
                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start"
                        class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention">
                        <a href="{{ route('admin.setting.index') }}">
                            <span class="menu-link {{ sidebarActive(['admin.setting.*']) }}">
                                <span class="menu-icon">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <i class="fa-solid fa-earth-asia"></i>
                                        </span>
                                    </span>
                                </span>
                                <span class="menu-title">Website Setting</span>
                            </span>
                        </a>
                    </div>
                @endcanany
            </div>
        </div>
    </div>
</div>
