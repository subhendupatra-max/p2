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
                <div class="breadcrumb-sec"  @if(!empty($menu)) style="background-image: url('{{ $menu?->image_path }}');" @else style="background-image: url('{{ asset('frontend/assets/images/breadcrumb.gif') }}');" @endif>
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
                                {!! localized_field($media_image, 'title') !!}
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
                        <div class="gallary-sec-row">
                                   <p> {!! localized_field($media_image, 'title') !!}</p>
                                <p>{{ date('d/m/Y', strtotime($media_image?->created_at)) }}</p>
                            <div class="row">

                                @forelse($media_image->images as $mediaImage)
                                    <div class="col-lg-4 col-md-4 col-6">
                                        <div class="item">
                                            <a href="{{ $mediaImage->image_path }}" data-fancybox="gallery" data-caption="{{ localized_field($mediaImage, 'title') }}">
                                                <img src="{{ $mediaImage->image_path }}" alt="..." class="media-image">
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <p>No images found.</p>
                                    </div>
                                @endforelse
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
