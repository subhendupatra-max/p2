<!DOCTYPE html>
<html>

<head>
    <title>{{ $title ?? '' }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
                    @if (!empty($menu)) style="background-image: url('{{ $menu?->image_path }}');" @else style="background-image: url('{{ asset('frontend/assets/images/breadcrumb.gif') }}');" @endif>
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

            <!-- gallary sec -->
            <section>
                <div class="gallary-sec">
                    <div class="container">
                        <div class="gallary-sec-row row">
                            <div class="col-md-6 text-center"><img
                                    src="{{ asset('frontend/assets/images/ddpdoo-logo.png') }}" alt="..."
                                    class="feedback-logo-image"></div>
                            <div class="col-md-6">
                                <div class="feedback_div">
                                    <form action="{{ localized_route('feedback.store') }}" method="POST"
                                        class="formSubmitwithcapctha" id="feedback_form">
                                        @csrf
                                        <input type="hidden"
                                            value="{{ base64_encode(route('admin.refresh.captcha')) }}"
                                            id="captcharefreshAction">
                                        <input type="hidden" name="unit_id" value="{{ $unit_id ?? null }}" />
                                        <div class="form-group">
                                            <label for="feedback_type">{{ __('messages.feedback_type') }}</label><span
                                                class="text-danger">*</span>
                                            <select class="form-control" required id="feedback_type"
                                                name="feedback_type" required onchange="showOtherField(this)">
                                                <option value="">{{ __('messages.select_feedback_type') }}
                                                </option>
                                                <option value="Content Issue">{{ __('messages.content_issue') }}
                                                </option>
                                                <option value="Design Issue">{{ __('messages.design_issue') }}</option>
                                                <option value="Server Issue">{{ __('messages.server_issue') }}</option>
                                                <option value="Other Issue">{{ __('messages.other_issue') }}</option>
                                            </select>
                                            <div id="other_field" style="display: none;">
                                                <input type="text" class="form-control" id="other_issue"
                                                    name="other_issue"
                                                    placeholder="{{ __('messages.specify_other_issue') }}" />
                                            </div>
                                        </div>
                                        <script>
                                            function showOtherField(e) {
                                                let selected = e.value;
                                                if (selected == 'Other Issue') {
                                                    document.getElementById('other_field').style.display = 'block';
                                                    document.getElementById('other_issue').required = true;
                                                } else {
                                                    document.getElementById('other_field').style.display = 'none';
                                                    document.getElementById('other_issue').required = false;
                                                }
                                            }
                                        </script>
                                        <div class="form-group">
                                            <label for="name">{{ __('messages.name') }}</label><span
                                                class="text-danger">*</span>
                                            <input type="text" class="form-control" id="name" name="name"
                                                required>
                                            <div class="invalid-feedback" id="name_error"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">{{ __('messages.email') }}</label><span
                                                class="text-danger">*</span>
                                            <input type="email" class="form-control" id="email" name="email"
                                                required>
                                            <div class="invalid-feedback" id="email_error"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile">{{ __('messages.mobile') }}</label><span
                                                class="text-danger">*</span>
                                            <input type="text" class="form-control" id="mobile" name="mobile"
                                                required pattern="[0-9]{10}">
                                            <div class="invalid-feedback" id="mobile_error"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="feedback">{{ __('messages.feedback') }}</label><span
                                                class="text-danger">*</span>
                                            <textarea class="form-control" id="feedback" name="feedback" rows="3" required></textarea>
                                            <div class="invalid-feedback" id="feedback_error"></div>
                                        </div>
                                        <div class="capcha-sec">
                                            <div class="imag" id="captcha-container">
                                                <span id="captchaImg" aria-label="Captcha image">
                                                    <p id="captcha-text" aria-hidden="true"
                                                        style="text-align-last: center;"></p>
                                                </span>
                                            </div>
                                            <button type="button" title="Refresh the CAPTCHA code"
                                                class="btn btn-primary" onclick="refreshCaptcha()">
                                                <img src="{{ asset('frontend/assets/images/refresh.png') }}" />
                                            </button>
                                            <button type="button" title="Speak the CAPTCHA code" id="refresh"
                                                class="btn btn-primary" onclick="playCombinedAudio()">
                                                <img src="{{ asset('frontend/assets/images/speaker.png') }}" />
                                            </button>
                                            <input type="text" class="form-control" name="captcha" id="captcha"
                                                placeholder="Enter Captcha" required>
                                        </div>
                                        <button type="submit"
                                            class="btn btn-primary">{{ __('messages.submit') }}</button>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /gallary sec -->

        </div>
        <!-- /main content -->

        <!-- footer -->
        @include('frontend.includes.footer')
        <!-- /footer -->
    </div>
    @include('frontend.includes.footer-links')
</body>

</html>
