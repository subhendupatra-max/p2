<head>

@if(!auth()->user()->can('all-unit') || !(auth()->user()->can('specific-unit') && auth()->user()->unit_id == null))
@else
    <meta http-equiv="refresh" content="0; url={{ route('admin.unit-not-assigned') }}">
@endif

@if(auth()->user()->is_active == 0)
    <script>
        window.location.href = "{{ route('logout') }}";
    </script>
@endif

    <base href="" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title class="title">Directorate of Ordnance (Coordination and Services)</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <link rel="shortcut icon" href="{{ asset('assets/media/images/fav.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/cdn/fonts.googleapis.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/cdn/jquery-ui.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/cdn/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-multiselect.css') }}" />
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link  rel="stylesheet" href="{{ asset('assets/css/cdn/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/cdn/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/cdn/jquery.dataTables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/cdn/responsive.dataTables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/cdn/bootstrap-datepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/cdn/toastr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/cdn/ckeditor5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/cdn/ckeditor5-premium-features.css') }}" />
</head>
