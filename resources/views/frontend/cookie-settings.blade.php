<!DOCTYPE html>
<html>

<head>
    <title>Cookies</title>
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
                                    <a href="{{ localized_route('page.show', ['home']); }}">
                                        {{ __('messages.home') }}
                                    </a>
                                </li>
                                <li class="breadcrumb-links-li">
                                    |
                                </li>
                                <li class="breadcrumb-links-li">
                                    <a href="#">
                                        {{ __('messages.cookie_settings') }}
                                    </a>
                                </li>
                            </ul>
                            <h1>
                                {{ __('messages.cookie_settings') }}
                            </h1>

                        </div>
                    </div>
                </div>
            </section>
            <!-- /main-sub-banner-sec -->

            <div class="container py-5">
                <p>{{ __('messages.cookie_heading') }}</p> <br><br>
                <h3>{{ __('messages.essential_cookies') }}</h3>
                <div class="row">
                    <div class="col-md-10">
                        <h5>{{ __('messages.session_cookies') }}</h5>
                        <p>{{ __('messages.session_cookies_description') }}</p>
                        <p>{{ __('messages.session_cookies_essential') }}</p>
                    </div>
                    <div class="col-md-2">
                        <label class="toggle">
                            <span class="toggle__label">{{ __('messages.off') }}</span>
                            <input class="toggle__checkbox" type="checkbox" disabled checked>
                            <span class="toggle__switch"></span>
                            <span class="toggle__label">{{ __('messages.on') }}</span>
                        </label>
                    </div>
                    <div class="col-md-10">
                        <h5>{{ __('messages.persistent_cookies') }}</h5><br>
                        <p>{{ __('messages.persistent_cookies_description') }}</p>
                        <p>{{ __('messages.personalization') }}</p>
                    </div>
                    <div class="col-md-2">
                        <label class="toggle">
                            <span class="toggle__label">{{ __('messages.off') }}</span>
                            <input class="toggle__checkbox" type="checkbox" disabled checked>
                            <span class="toggle__switch"></span>
                            <span class="toggle__label">{{ __('messages.on') }}</span>
                        </label>
                    </div>
                </div>
                 <form method="POST" action="{{ localized_route('cookie.settings.save') }}" class="formSubmit">
                    @csrf
                    <h3>{{ __('messages.optional_cookies') }}</h3>
                <div class="row mt-5">

                    <div class="col-md-10">
                        <h5>{{ __('messages.preference_functionality_cookies') }}</h5>
                        <p>{{ __('messages.persistent_cookies_description') }}</p>
                        <p>{{ __('messages.personalization') }}</p>
                    </div>
                    <div class="col-md-2">
                            <label class="toggle">
                            <span class="toggle__label">{{ __('messages.off') }}</span>
                            <input class="toggle__checkbox" type="checkbox" name="optional_cookies" id="optionalCookies" {{ session('optional_cookies') ? 'checked' : '' }}>
                            <span class="toggle__switch"></span>
                            <span class="toggle__label">{{ __('messages.on') }}</span>
                        </label>
                    </div>
                     <button type="submit" class="btn btn-primary mt-5">{{ __('messages.save_preferences') }}</button>
                </div>
                </form>
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
