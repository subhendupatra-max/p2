<!DOCTYPE html>
<html>

<head>
    <title>{{ $title ?? '' }}</title>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/frontend-fab.png') }}" />

     @include('frontend.includes.header-links')

</head>

<body>

    <!-- <div id="loader"></div> -->

    <div class="main_div">

        <!-- header -->
         @include('frontend.includes.header')
        <!-- /header -->

        <!-- main content -->
        <div class="main_content">

            <!-- breadcrumb sec -->
            <section>
                         <div class="breadcrumb-sec"
                    @if (!empty($menu) && !empty($menu->file)) style="background-image: url('{{ $menu?->image_path }}');" @else style="background-image: url('{{ asset('frontend/assets/images/breadcrumb.gif') }}');" @endif>
                    <div class="container">
                        <div class="breadcrumb-wrapper">
                            <ul class="breadcrumb-links-ul">
                                <li class="breadcrumb-links-li">
                                    <a href="{{ localized_route('page.show',['home']) }}">
                                        {{ __('messages.home') }}
                                    </a>
                                </li>
                                <li class="breadcrumb-links-li">
                                    |
                                </li>
                                <li class="breadcrumb-links-li">
                                    <a href="#">
                                         {{ localized_field($main_menu, 'title') }}
                                    </a>
                                </li>
                            </ul>
                            <h1>
                                {{ localized_field($menu, 'title') }}
                            </h1>
                             @if (!empty($all_sub_menu) && $all_sub_menu->count() > 0)
                                <div class="sub-nav-sec">
                                    @include('frontend.includes.sub-menu-list')
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
            <!-- /main-sub-banner-sec -->

            <!-- about sec -->
            <section>
                <div class="ap-about-sec">
                    <div class="container">
                         <div class="ap-about-wrapper">

                        @forelse ($data['our_directory_list'] as $key=>$value)
                            <div class="out-team-table">
                                <h4>
                                    {{ $key }}
                                </h4>
                                <div class="out-team-table-table">
                                    <div class="row out-team-table-tr table-heading">
                                        <div class="col-4 p-0">
                                            <p class="out-team-table-th">
                                                {{ __('messages.name_and_designation') }}
                                            </p>
                                        </div>
                                        <div class="col-4 p-0">
                                            <p class="out-team-table-th">
                                                {{ __('messages.contact') }}
                                            </p>
                                        </div>
                                        <div class="col-4 p-0">
                                            <p class="out-team-table-th">
                                                {{ __('messages.address') }}
                                            </p>
                                        </div>
                                    </div>
                                    @forelse ($value as $team)
                                        <div class="row out-team-table-tr">
                                        <div class="col-4 out-team-table-td">
                                            <h6>
                                                {{ $team->name ?? '--' }}
                                            </h6>
                                            <p>
                                                {{ $team->designation_others ?? '--' }}
                                            </p>
                                        </div>
                                        <div class="col-4 out-team-table-td">
                                            <p>
                                                <img src="{{ asset('frontend') }}/assets/images/call.png" alt="...">
                                                {{ $team->mobile_no ?? '--' }}
                                            </p>
                                            <p>
                                                <img src="{{ asset('frontend') }}/assets/images/email.png" alt="...">
                                                {{ $team->email ?? '--' }}
                                            </p>
                                        </div>
                                        <div class="col-4 out-team-table-td">
                                            <p>
                                                <img src="{{ asset('frontend') }}/assets/images/location.png" alt="...">
                                                {{ $team->location ?? '--' }}
                                            </p>
                                        </div>
                                    </div>
                                    @empty

                                    @endforelse

                                </div>
                            </div>
                        @empty
                        @endforelse
                        </div>
                    </div>
                </div>
            </section>
            <!-- /about sec -->

        </div>
        <!-- /main content -->

        <!-- footer -->
         @include('frontend.includes.footer')
        <!-- /footer -->

    </div>

     @include('frontend.includes.footer-links')

</body>

</html>

