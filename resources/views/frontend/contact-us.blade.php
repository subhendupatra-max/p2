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
                <div class="ap-about-sec contact-us-sec">
                    <div class="container">
                        <div class="ap-about-wrapper">
                            <div class="row">
                                <div class="col-md-5 col-12">
                                    <div class="contact-details">
                                        <div class="out-team-table-tr">
                                            <div class="out-team-table-td w-100">
                                                 {!! localized_field($contact, 'description') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 col-12">
                                    <div class="contact-map">
                                        <iframe src="{{$website_setting?->location}}" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
                                </div>
                            </div>
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

