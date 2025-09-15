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
                                    <a href="{{ localized_route('page.show',['home']) }}">
                                        {{ __('messages.home') }}
                                    </a>
                                </li>
                            </ul>
                            <h1>
                                {{ __('messages.search') }}
                            </h1>

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
                                {!! $cms_search_result !!}
                                {!! $document_result !!}
                                @if(empty($cms_search_result) && empty($document_result))
                                    <div style="display: flex; justify-content: center; align-items: center; height: 10vh;">
                                        <div class="no-data-found" style="font-size: 35px;color: #b7b7b7;">
                                            {{ __('messages.no_data_found') }}
                                        </div>
                                    </div>
                                @endif
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

