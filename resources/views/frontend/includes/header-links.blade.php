    <link rel="stylesheet" type="text/css" href="{{ asset('frontend')}}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend')}}/assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend')}}/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend')}}/assets/css/for-window-responsive.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend')}}/assets/css/for-mobile-responsive.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend')}}/assets/css/jquery.fancybox.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend')}}/assets/css/font-awesome.all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend')}}/assets/js/prefixfree.min.js">
    <link rel="stylesheet" href="{{ asset('assets/css/cdn/toastr.css') }}" />
    <?php
        $captchaText = substr(str_shuffle('abcdefghjkmnpqrstuvwxyz23456789'), 0, 6);
    ?>
    <input type="hidden" value="{{ $captchaText }}" id="captchaText" />
