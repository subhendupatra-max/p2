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
                    @if (!empty($menu) && !empty($menu->file)) style="background-image: url('{{ $menu?->image_path }}');" @else style="background-image: url('{{ asset('frontend/assets/images/breadcrumb.gif') }}');" @endif>
                    <div class="container">
                        <div class="breadcrumb-wrapper">
                            <ul class="breadcrumb-links-ul">
                                <li class="breadcrumb-links-li">
                                    <a href="{{ localized_route('page.show',['home']) }}">
                                        {{ __('messages.home') }}
                                    </a>
                                </li>
                                <li class="breadcrumb-links-li">
                                    |
                                </li>
                                <li class="breadcrumb-links-li">
                                    <a href="#">
                                         {{ localized_field($main_menu, 'title') }}
                                    </a>
                                </li>
                            </ul>
                            <h1>
                                {{ localized_field($menu, 'title') }}
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
                <div class="ap-about-sec contact-rti-sec">
                    <div class="container">
                        <div class="ap-about-wrapper">
                            <div class="row">
                                <div class="col-lg-4 col-md-12 col-12">
                                    <div class="ap-about-text">
                                        <ul>
                                            <li>
                                               {!! localized_field($data['right_to_information'], 'title') !!}
                                            </li>
                                            @if(!empty($data['rti_act']))
                                            <li>
                                                <a
                                                @if( $data['rti_act']?->redirect_to == 1)
                                                    href="{{  $data['rti_act']?->link }}" target="_blank"
                                                @elseif($data['rti_act']?->redirect_to == 2)
                                                    href="#"
                                                @elseif($data['rti_act']?->redirect_to == 3)
                                                    href="{{ $data['rti_act']?->image_path }}" target="_blank"
                                                @else
                                                    href="#"
                                                @endif
                                                >
                                                    {{ localized_field($data['rti_act'], 'title') }}
                                                </a>
                                            </li>
                                            @endif
                                            @if(!empty($data['download_rti_act']))
                                            <li>
                                                <a
                                                @if( $data['download_rti_act']?->redirect_to == 1)
                                                    href="{{  $data['download_rti_act']?->link }}" target="_blank"
                                                @elseif($data['download_rti_act']?->redirect_to == 2)
                                                    href="#"
                                                @elseif($data['download_rti_act']?->redirect_to == 3)
                                                    href="{{ $data['download_rti_act']?->image_path }}" target="_blank"
                                                @else
                                                    href="#"
                                                @endif
                                                >
                                                    {{ localized_field($data['download_rti_act'], 'title') }}
                                                </a>
                                            </li>
                                            @endif
                                            @if(!empty($data['for_filing_online_rti_application_or_appeal']))
                                            <li>
                                                <a
                                                @if( $data['for_filing_online_rti_application_or_appeal']?->redirect_to == 1)
                                                    href="{{  $data['for_filing_online_rti_application_or_appeal']?->link }}" target="_blank"
                                                @elseif($data['for_filing_online_rti_application_or_appeal']?->redirect_to == 2)
                                                    href="#"
                                                @elseif($data['for_filing_online_rti_application_or_appeal']?->redirect_to == 3)
                                                    href="{{ $data['for_filing_online_rti_application_or_appeal']?->image_path }}" target="_blank"
                                                @else
                                                    href="#"
                                                @endif
                                                >
                                                    {{ localized_field($data['for_filing_online_rti_application_or_appeal'], 'title') }}
                                                </a>
                                            </li>
                                            @endif

                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-12 col-12">
                                    <div class="ap-about-content">
                                           <p>
                                               {!! localized_field($data['right_to_information'], 'description') !!}
                                           </p>
                                           <div class="ap-about-content-links">
                                           @forelse ($data['right_to_information_list'] as $list)
                                                <a
                                                @if( $list?->redirect_to == 1)
                                                    href="{{  $list?->link }}" target="_blank"
                                                @elseif($list?->redirect_to == 2)
                                                    href="#"
                                                @elseif($list?->redirect_to == 3)
                                                    href="{{ $list?->image_path }}" target="_blank"
                                                @else
                                                    href="#"
                                                @endif
                                                >
                                                    {{ localized_field($list, 'title') }}
                                                </a>
                                           @empty
                                           @endforelse
                                        </div>
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

