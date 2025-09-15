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
                <div class="breadcrumb-sec" style="background-image: url('{{ asset('frontend/assets/images/breadcrumb.gif') }}');">
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
                            @if($menu != '' && $parent_menu == '')

                                <li class="breadcrumb-links-li">
                                    <a href="{{ localized_route('page.show', [$menu->slug]) }}">
                                        {{ localized_field($menu, 'title') }}
                                    </a>
                                </li>
                            @elseif($menu != '' && $parent_menu != '')

                                <li class="breadcrumb-links-li">
                                    <a href="{{ localized_route('page.subpage.show', [$parent_menu->slug,$menu->slug]) }}">
                                       {{ localized_field($parent_menu, 'title') }} | {{ localized_field($menu, 'title') }}
                                    </a>
                                </li>
                            @endif

                            </ul>
                            <h1>
                                {{ localized_field($cms, 'title') }}
                            </h1>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /main-sub-banner-sec -->

            <!-- about sec -->
            <section>
                <div class="about-sec">
                    <div class="container">
                        <div class="about-sec-wrapper">
                            <div class="about-sec-wrapper-text">
                                {!! localized_field($cms, 'description') !!}
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

