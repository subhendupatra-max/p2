<footer>
    <div class="footer-sec">
        <div class="container">
            <div class="footer-wrapper">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="footer-quick-links">
                            <h5>
                                {{ __('messages.useful_links') }}
                            </h5>
                            <ul>
                                @forelse ($footerMenus as $footer_menu)
                                    @php
                                        $route = $footer_menu->slug;
                                        $href = localized_route('page.show', [$route]);
                                    @endphp
                                    @if ($footer_menu->children->count() > 0)
                                        $href= localized_route('page.subpage.show', [$footer_menu->slug, $footer_menu->children->first()->slug]);
                                    @endif
                                    @if ($footer_menu->parent_id != null)
                                        $href= localized_route('page.subpage.show', [$footer_menu->parent->slug,$footer_menu->slug]);
                                    @endif
                                    <li>
                                        <a href="{{ $href }}">
                                            {{ localized_field($footer_menu, 'title') }}
                                        </a>
                                    </li>
                                @empty
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="footer-subscrib">
                            <h5>
                                {{ __('messages.subscribe_for_updates') }}
                            </h5>
                            <div class="footer-subscrib-content">
                                <div class="footer-subscrib-text">
                                    <div class="footer-subscrib-links">
                                        <a href="{{ $website_setting?->facebook }}">
                                            <img src="{{ asset('frontend') }}/assets/images/fb.png" alt="...">
                                        </a>
                                        <a href="{{ $website_setting?->youtube }}">
                                            <img src="{{ asset('frontend') }}/assets/images/yt.png" alt="...">
                                        </a>
                                        <a href="{{ $website_setting?->instagram }}">
                                            <img src="{{ asset('frontend') }}/assets/images/insta.png" alt="...">
                                        </a>
                                        <a href="{{ $website_setting?->twitter }}">
                                            <img src="{{ asset('frontend') }}/assets/images/tw.png" alt="...">
                                        </a>
                                    </div>
                                    <p>
                                        {{ localized_field($website_setting, 'description') }}
                                        <br><br>
                                        {{ __('messages.last_updated_on') }} : 26-06-2025
                                    </p>
                                </div>
                                <div class="footer-subscrib-imgs">
                                    <img src="{{ $website_setting?->footer_image1_path }}" alt="...">
                                    <img src="{{ $website_setting?->footer_image2_path }}" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

@if (!session()->has('optional_cookies'))
    <div class="cookie-banner">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <p class="mb-0">
                {!! __('messages.cookie_banner_message') !!}.
                <a href="{{ localized_route('cookie.settings') }}">{{ __('messages.cookie_settings') }}</a>
            </p>
            <form method="POST" action="{{ localized_route('cookie.settings.save') }}" class="formSubmit">
                @csrf
                <input type="hidden" name="optional_cookies" id="cookieConsentInput">
                <a href="{{ localized_route('cookie.settings') }}" class="btns"><button type="button" class="btns" >{{ __('messages.customize_cookies') }}</button></a>
                <button type="submit" class="btns" id="cookieConsentDecline" onclick="document.getElementById('cookieConsentInput').value=''">{{ __('messages.decline_optional_cookies') }}</button>
                <button type="submit" class="btns" id="cookieConsentAccept"  onclick="document.getElementById('cookieConsentInput').value='on'">{{ __('messages.accept_all_cookies') }}</button>
            </form>
        </div>
    </div>
@endif
