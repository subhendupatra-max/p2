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
        <div class="main_content" id="image-hide">

            @if (in_array('banner', $UnitWiseSectionPermission) || in_array('announcements', $UnitWiseSectionPermission))
                <section>
                    <div class="banner-sec">

                        @if (in_array('banner', $UnitWiseSectionPermission))
                            @if (!empty($banners) && $banners->count() > 0)
                                <div class="swiper banner-slider">
                                    <div class="swiper-wrapper">
                                        @forelse ($banners as $banner)
                                            <div class="swiper-slide">
                                                <img src="{{ $banner->image_path }}" alt="...">
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            @endif
                        @endif

                        @if (in_array('announcements', $UnitWiseSectionPermission))
                            <div class="banner-sec-links d-flex">
                                <div class="banner-sec-links-announcements">
                                    <p>
                                        {{ __('messages.announcements') }}
                                    </p>
                                    <img src="{{ asset('frontend') }}/assets/images/announcement.svg" alt="...">
                                </div>
                                <div class="banner-sec-links-links w-100">
                                    <marquee id="myMarquee" behavior="scroll" direction="left" scrollamount="5">
                                        <ul>
                                            @forelse ($announcements as $announcement)
                                                <li>
                                                    <a href="{{ $announcement?->href() }}"
                                                        class="text-white">{!! localized_field($announcement, 'title') !!}</a>
                                                </li>
                                                @if (!$loop->last)
                                                    <li>|</li>
                                                @endif
                                            @empty
                                            @endforelse
                                        </ul>
                                    </marquee>
                                    <button id="pauseBtn">
                                        <img src="{{ asset('frontend') }}/assets/images/pose.png" alt="...">
                                    </button>
                                </div>
                            </div>
                        @endif

                    </div>
                </section>
            @endif

            @if (in_array('pm-modi-at-mann-ki-baat', $UnitWiseSectionPermission))
                <!-- sub banner starts -->
                <section>
                    <div class="sub-banner-sec">
                        <img src="{{ $pm_modi_at_mann_ki_baat?->image_path }}" alt="..." class="img-1">
                        <div class="container">
                            <div class="sub-banner-sec-wrapper text-center">
                                <h2 id="main-content" tabindex="-1">
                                    {!! localized_field($pm_modi_at_mann_ki_baat, 'description') !!}
                                </h2>
                                <hr>
                                <p>
                                    {!! localized_field($pm_modi_at_mann_ki_baat, 'title') !!}
                                </p>
                                <p>
                                    @if (!empty($pm_modi_at_mann_ki_baat->date))
                                        {{ date('d.m.Y', strtotime($pm_modi_at_mann_ki_baat?->date)) }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        <img src="{{ asset('frontend') }}/assets/images/sub-banner-2.png" alt="..." class="img-2">
                    </div>
                </section>
                <!-- /sub banner ends -->
            @endif


            @if (in_array('about-ministry', $UnitWiseSectionPermission) || in_array('our-history', $UnitWiseSectionPermission) || in_array('our-unit', $UnitWiseSectionPermission) || in_array('join-us', $UnitWiseSectionPermission) || in_array('hod-section', $UnitWiseSectionPermission))
                <section>
                    <div class="about-sec">
                        <div class="container">
                            <div class="about-sec-wrapper">
                                <div class="about-sec-text">
                                    @if (in_array('about-ministry', $UnitWiseSectionPermission))
                                        <p>
                                            {!! localized_field($about_ministry, 'description') !!}
                                        </p>
                                    @endif
                                    <div class="about-sec-grid">
                                        <div class="row">
                                            @if (in_array('our-history', $UnitWiseSectionPermission))
                                                <div class="col-lg-4 col-md-4 col-4">
                                                    <div class="about-sec-grid-item text-center">
                                                        <img src="{{ asset('frontend') }}/assets/images/about-icon-1.png"
                                                            alt="..."> <br>
                                                        <a href="{{ $our_history?->href() ?? '#' }}">
                                                            {!! localized_field($our_history, 'title') !!}
                                                            <img src="{{ asset('frontend') }}/assets/images/about-arrow.png"
                                                                alt="..." class="arrow">
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('our-unit', $UnitWiseSectionPermission))
                                                <div class="col-lg-4 col-md-4 col-4">
                                                    <div class="about-sec-grid-item text-center">
                                                        <img src="{{ asset('frontend') }}/assets/images/about-icon-2.png"
                                                            alt="..."> <br>

                                                        @if ($unit_id == 1)
                                                            <a href="{{ localized_route('our-unit') }}">
                                                                {{ __('messages.our_unit') }}
                                                                <img src="{{ asset('frontend') }}/assets/images/about-arrow.png"
                                                                    alt="..." class="arrow">
                                                            </a>
                                                        @else
                                                            <a href="{{ $our_unit?->href() }}">
                                                                {!! localized_field($our_unit, 'title') !!}
                                                                <img src="{{ asset('frontend') }}/assets/images/about-arrow.png"
                                                                    alt="..." class="arrow">
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('join-us', $UnitWiseSectionPermission))
                                                <div class="col-lg-4 col-md-4 col-4">
                                                    <div class="about-sec-grid-item text-center">
                                                        <img src="{{ asset('frontend') }}/assets/images/about-icon-3.png"
                                                            alt="..."> <br>
                                                        <a href="{{ $join_us?->href() ?? '#' }}">
                                                            {!! localized_field($join_us, 'title') !!}
                                                            <img src="{{ asset('frontend') }}/assets/images/about-arrow.png"
                                                                alt="..." class="arrow">
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if (in_array('hod-section', $UnitWiseSectionPermission))
                                    @if (!empty($hod_details))
                                        <div class="about-sec-image">
                                            <div class="about-sec-image-img"
                                                style="background-image: url('{{ asset('frontend/assets/images/about-rectangle.png') }}');">
                                                <img src="{{ $hod_details?->image_path }}" alt="...">
                                            </div>
                                            <div class="about-sec-image-content">
                                                <h6>
                                                    {!! $hod_details?->hod_name ?? '' !!}
                                                </h6>
                                                <p>
                                                    {!! $hod_details?->designation ?? '' !!}
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
            @endif


            @if(in_array('schemes', $UnitWiseSectionPermission) || in_array('vacancies', $UnitWiseSectionPermission) || in_array('tenders', $UnitWiseSectionPermission) || in_array('whats-new', $UnitWiseSectionPermission))
                <section>
                    <div class="key-offering-sec">
                        <div class="container">
                            <div class="key-offering-wrapper">
                                <div class="row">
                                    @if (in_array('schemes', $UnitWiseSectionPermission) ||
                                            in_array('vacancies', $UnitWiseSectionPermission) ||
                                            in_array('tenders', $UnitWiseSectionPermission))
                                        <div class="col-lg-7 col-md-12 col-12">
                                            <div class="key-offering-content">
                                                <h3>
                                                    {{ __('messages.key_offerings') }}
                                                </h3>
                                                <div class="key-offering-tab-btns mb-4 tab">

                                                    @if (in_array('schemes', $UnitWiseSectionPermission))
                                                        <button class="tablinks active"
                                                            onclick="openCity(event, 'tab1')">{{ __('messages.schemes') }}</button>
                                                    @endif
                                                    @if (in_array('vacancies', $UnitWiseSectionPermission))
                                                        <button
                                                            class="tablinks {{ !in_array('schemes', $UnitWiseSectionPermission) ? 'active' : '' }}"
                                                            onclick="openCity(event, 'tab2')">{{ __('messages.vacancies') }}</button>
                                                    @endif
                                                    @if (in_array('tenders', $UnitWiseSectionPermission))
                                                        <button
                                                            class="tablinks {{ !in_array('schemes', $UnitWiseSectionPermission) && !in_array('vacancies', $UnitWiseSectionPermission) ? 'active' : '' }}"
                                                            onclick="openCity(event, 'tab3')">{{ __('messages.tenders') }}</button>
                                                    @endif

                                                </div>

                                                @if (in_array('schemes', $UnitWiseSectionPermission))
                                                    <div class="tabcontent" id="tab1" style="display: block;">

                                                        @forelse ($schemes_and_services as $schemes_and_service)
                                                            <div class="key-offering-content-item mb-4">
                                                                <div class="key-offering-content-item-text">
                                                                    <h6>
                                                                        {!! localized_field($schemes_and_service, 'title') !!}
                                                                    </h6>
                                                                    <p>
                                                                        {!! localized_field($schemes_and_service, 'description') !!}
                                                                    </p>
                                                                </div>
                                                                <a href="{{ $schemes_and_service?->href() ?? '#' }}">
                                                                    <button class="key-offering-content-item-btn">
                                                                        <img src="{{ asset('frontend') }}/assets/images/key-offering-icon.png"
                                                                            alt="...">
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        @empty
                                                        @endforelse


                                                    </div>
                                                @endif
                                                @if (in_array('vacancies', $UnitWiseSectionPermission))
                                                    <div class="tabcontent" id="tab2"
                                                        {{ !in_array('schemes', $UnitWiseSectionPermission) ? 'style="display: block;"' : '' }}>
                                                        @forelse ($vacancies as $vacancie)
                                                            <div class="key-offering-content-item mb-4">
                                                                <div class="key-offering-content-item-text">
                                                                    <h6>
                                                                        {!! localized_field($vacancie, 'title') !!}
                                                                    </h6>
                                                                    <p>
                                                                        {!! localized_field($vacancie, 'description') !!}
                                                                    </p>
                                                                </div>
                                                                <a href="{{ $vacancie?->href() ?? '#' }}">
                                                                    <button class="key-offering-content-item-btn">
                                                                        <img src="{{ asset('frontend') }}/assets/images/key-offering-icon.png"
                                                                            alt="...">
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        @empty
                                                        @endforelse
                                                    </div>
                                                @endif
                                                @if (in_array('tenders', $UnitWiseSectionPermission))
                                                    <div class="tabcontent" id="tab3"
                                                        {{ !in_array('vacancies', $UnitWiseSectionPermission) && !in_array('schemes', $UnitWiseSectionPermission) ? 'style="display: block;"' : '' }}>
                                                        @forelse ($tenders as $tender)
                                                            <div class="key-offering-content-item mb-4">
                                                                <div class="key-offering-content-item-text">
                                                                    <h6>
                                                                        {!! localized_field($tender, 'title') !!}
                                                                    </h6>
                                                                    <p>
                                                                        {!! localized_field($tender, 'description') !!}
                                                                    </p>
                                                                </div>
                                                                <a href="{{ $tender?->href() ?? '#' }}">
                                                                    <button class="key-offering-content-item-btn">
                                                                        <img src="{{ asset('frontend') }}/assets/images/key-offering-icon.png"
                                                                            alt="...">
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        @empty
                                                        @endforelse
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    @if (in_array('whats-new', $UnitWiseSectionPermission))
                                        <div class="col-lg-5 col-md-12 col-12">
                                            <div class="key-offering-wnew">
                                                <h3>
                                                    {{ __('messages.whats_new') }}
                                                </h3>
                                                <div class="key-offering-wne-content">

                                                    @forelse ($whats_new as $whatnew)
                                                        <div class="key-offering-wne-content-text">
                                                            <p>
                                                                {{ localized_field($whatnew, 'title') }}
                                                            </p>
                                                            <a href="{{ $whatnew?->href() ?? '#' }}">
                                                                <button class="key-offering-content-item-btn">
                                                                    <img src="{{ asset('frontend') }}/assets/images/key-offering-icon.png"
                                                                        alt="...">
                                                                </button>
                                                            </a>
                                                        </div>
                                                    @empty
                                                    @endforelse

                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif


            @if (in_array('recent-documents', $UnitWiseSectionPermission) || in_array('explore-user-personas', $UnitWiseSectionPermission) || in_array('important-links', $UnitWiseSectionPermission))
                <section>
                    <div class="rdoc-sec">
                        <div class="container">
                            <div class="rdoc-sec-wrapper">
                                <div class="row">
                                    @if (in_array('recent-documents', $UnitWiseSectionPermission))
                                        <div class="col-lg-4 col-md-6 col-12">
                                            <div class="rdoc-sec-recent">
                                                <h3>
                                                    {{ __('messages.recent_documents') }}
                                                </h3>
                                                <div class="rdoc-sec-recent-row row">

                                                    @forelse ($recent_documents as $recent_document)
                                                        <div class="col-6">
                                                            <div class="rdoc-sec-recent-row-item">
                                                                <p>
                                                                    {!! localized_field($recent_document, 'title') !!}
                                                                </p>
                                                                <h6>

                                                                    <img src="{{ asset('frontend') }}/assets/images/pdf.png"
                                                                        alt="...">
                                                                    ({{ $recent_document->file_size }})
                                                                </h6>
                                                                <button>
                                                                    <a href="{{ $recent_document->image_path }}"
                                                                        target="_blank"> <img
                                                                            src="{{ asset('frontend') }}/assets/images/eye.png"
                                                                            alt="...">
                                                                        {{ __('messages.view') }}</a>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @empty
                                                    @endforelse
                                                </div>
                                                {{--  <div class="text-right">
                                                    <a class="view-more-btn"
                                                        href="{{ localized_route('recent-documents') }}">
                                                        {{ __('messages.view_more') }}
                                                    </a>
                                                </div>  --}}
                                            </div>
                                        </div>
                                    @endif
                                    @if (in_array('explore-user-personas', $UnitWiseSectionPermission))
                                        <div class="col-lg-4 col-md-6 col-12">
                                            <div class="rdoc-sec-explore text-center">
                                                <h3>
                                                    <img src="{{ asset('frontend') }}/assets/images/users.png"
                                                        alt="...">
                                                    {{ __('messages.explore_user_personas') }}
                                                </h3>
                                                <div class="rdoc-sec-explore-slider">

                                                    <div class="swiper explore-slider">
                                                        <div class="swiper-wrapper">

                                                            @forelse($explore_user_personas as $explore_user_persona)
                                                                <div class="swiper-slide text-center">
                                                                    <a href="{{ $explore_user_persona?->href() ?? '#' }}">
                                                                        <img src="{{ $explore_user_persona?->image_path }}"
                                                                            alt="...">
                                                                        <p>
                                                                            {!! localized_field($explore_user_persona, 'title') !!}
                                                                        </p>
                                                                    </a>
                                                                </div>

                                                            @empty
                                                            @endforelse

                                                        </div>
                                                        <div class="swiper-button-next"></div>
                                                        <div class="swiper-button-prev"></div>
                                                        <div class="swiper-pagination"></div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if (in_array('important-links', $UnitWiseSectionPermission))
                                        <div class="col-lg-4 col-md-8 col-12 m-md-auto">
                                            <div class="rdoc-sec-important">
                                                <h3>
                                                    <img src="{{ asset('frontend') }}/assets/images/search.png"
                                                        alt="...">
                                                    {{ __('messages.important_links') }}
                                                </h3>
                                                <div class="rdoc-sec-important-wrapper">
                                                    @forelse ($important_links as $important_link)
                                                        <div class="rdoc-sec-important-wrapper-item">
                                                            <p>
                                                                {!! localized_field($important_link, 'title') !!}
                                                            </p>
                                                            <a href="{{ $important_link?->href() ?? '#' }}"
                                                                target="_blank">
                                                                <img src="{{ asset('frontend') }}/assets/images/arrow-right.png"
                                                                    alt="...">
                                                            </a>
                                                        </div>
                                                    @empty
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            @endif

            @if (in_array('social-media', $UnitWiseSectionPermission))
                <section>
                    <div class="social-media-sec">
                        <div class="container">
                            <div class="social-media-wrapper">
                                <h3>
                                    <img src="{{ asset('frontend') }}/assets/images/globe.png" alt="...">
                                    {{ __('messages.in_social_media') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </section>
            @endif

            @if (in_array('advertisement', $UnitWiseSectionPermission))
                <!-- paralus banner starts -->
                <div class="paralus-sec">
                    <div class="container">
                        <div class="paralus-sec-wrapper">
                            @forelse ($advertisements as $advertisement)
                                <a href="{{ $advertisement?->href() ?? '#' }}">
                                    <img src="{{ $advertisement?->image_path }}" alt="...">
                                </a>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            @endif

            @if (in_array('testimonial', $UnitWiseSectionPermission))
                <!-- client slider starts -->
                <section>
                    <div class="client-slider-sec">
                        <div class="container">
                            <div class="client-slider-wrapper">
                                <div class="swiper client-slider">
                                    <div class="swiper-wrapper">
                                        @forelse ($testimonials as $testimonial)
                                            <div class="swiper-slide">
                                                <a href="{{ $testimonial?->href() ?? '#' }}">
                                                    <img src="{{ $testimonial?->image_path }}" alt="...">
                                                </a>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /client slider ends -->
            @endif

        </div>
        <!-- /main content -->

        <!-- footer -->
        @include('frontend.includes.footer')
        <!-- /footer -->

    </div>

    @include('frontend.includes.footer-links')

    <script>
        const marquee = document.getElementById('myMarquee');
        const annbtn = document.getElementById('pauseBtn');
        let isPaused = false;

        annbtn.innerHTML = '<img src="{{ asset('frontend') }}/assets/images/pose.png" alt="Pause">';
        annbtn.addEventListener('click', () => {
            if (isPaused) {
                marquee.start();
                annbtn.innerHTML = '<img src="{{ asset('frontend') }}/assets/images/pose.png" alt="Pause">';
            } else {
                marquee.stop();
                annbtn.innerHTML = '<img src="{{ asset('frontend') }}/assets/images/play-button.png" alt="Play">';
            }
            isPaused = !isPaused;
        });
    </script>



</body>

</html>
