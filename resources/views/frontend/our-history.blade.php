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
                    @if (!empty($menu)) style="background-image: url('{{ $menu?->image_path }}');" @endif>
                    <div class="container">
                        <div class="breadcrumb-wrapper">
                            <ul class="breadcrumb-links-ul">
                                <li class="breadcrumb-links-li">
                                    <a href="{{ localized_route('page.show', ['home']) }}">
                                        {{ __('messages.home') }}
                                    </a>
                                </li>
                                <li class="breadcrumb-links-li">
                                    |
                                </li>
                                <li class="breadcrumb-links-li">
                                    <a href="#">
                                        {!! localized_field($main_menu, 'title') !!}
                                    </a>
                                </li>
                            </ul>
                            <h1>
                                {!! localized_field($menu, 'title') !!}
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
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="ap-about-content">
                                    {!! localized_field($data['the_beginning_growthofindianordnance_factories_main_event_description'], 'description') !!}

                                        <div class="ap-about-content-links">
                                            @forelse ($data['main_event_list'] as $list)
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                                        <div class="ap-about-content-grid-item">
                                                            <h3>
                                                                {{ $loop->iteration }}.
                                                            </h3>
                                                            <p>
                                                                {!! localized_field($list, 'description') !!}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @empty
                                            @endforelse
                                        </div>
                                         {!!  $data['creation_of_description_first'] !!}
                                        <div class="ap-about-content-links">
                                            @forelse ($data['creation_of_list'] as $list)
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                                        <div class="ap-about-content-grid-item">
                                                            <h3>
                                                                {{ $loop->iteration }}.
                                                            </h3>
                                                            <p>
                                                                {!! localized_field($list, 'description') !!}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @empty
                                            @endforelse
                                        </div>
                                         {!!  $data['creation_of_description_second'] !!}
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
