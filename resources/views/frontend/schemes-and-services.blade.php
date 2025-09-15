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
                <div class="ap-about-sec schemes-services-sec">
                    <div class="container">
                        <div class="ap-about-wrapper">
                            <div class="our-organization-row">
                                <div class="row">
                                    @forelse ($data['schemes_and_services'] as $value)
                                        <div class="col-lg-6 col-md-6 col-12">
                                        <div class="our-organization-row-item">
                                            <div class="d-flex ">
                                                <div>
                                                    <h4>
                                                        {!! localized_field($value, 'title') !!}
                                                    </h4>
                                                    <p>
                                                        {!! localized_field($value, 'description') !!}
                                                    </p>
                                                </div>
                                                <img src="{{ $value?->image_path }}" alt="...">
                                            </div>
                                            <div class="text-right">
                                                <a href="{{ $value?->href() ?? '#' }}" class="link">
                                                    <img src="{{ asset('frontend') }}/assets/images/key-offering-icon.png" alt="...">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    {{ __('messages.no_data_found') }}
                                    @endforelse
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

