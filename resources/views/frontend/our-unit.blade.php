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
                    style="background-image: url('{{ asset('frontend/assets/images/about-banner-bg.png') }}');">
                    <div class="container">
                        <div class="breadcrumb-wrapper">
                            <ul class="breadcrumb-links-ul">
                                <li class="breadcrumb-links-li">
                                    <a href="{{ localized_route('page.show', ['home']) }}">
                                        {{ __('messages.home') }}
                                    </a>
                                </li>
                            </ul>
                            <h1>
                                {{ __('messages.our_unit') }}
                            </h1>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /main-sub-banner-sec -->
            <div class="container mt-5">
                <div class="ap-about-content-links">

                @forelse ($our_units as $our_unit)
                    <a href="{{ localized_route('page.show', ['unit' => $our_unit->slug,'slug' => 'home']) }}">
                        <p><i class="fa-solid fa-code-branch"></i> {!! localized_field($our_unit, 'title') !!}</p>
                    </a>
                @empty

                @endforelse

                </div>
            </div>


        </div>
        <!-- /main content -->

        <!-- footer -->
        @include('frontend.includes.footer')
        <!-- /footer -->

    </div>

    @include('frontend.includes.footer-links')

</body>

</html>
