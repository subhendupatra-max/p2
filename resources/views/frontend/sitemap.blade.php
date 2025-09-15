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
    <div class="main_div">
        @include('frontend.includes.header')
        <div class="main_content">
            <section>
                <div class="breadcrumb-sec"
                    @if (!empty($menu) && !empty($menu->file)) style="background-image: url('{{ $menu?->image_path }}');" @else style="background-image: url('{{ asset('frontend/assets/images/breadcrumb.gif') }}');" @endif>
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
                                        {{ __('messages.sitemap') }}
                                    </a>
                                </li>
                            </ul>
                            <h1>
                                {{ __('messages.sitemap') }}
                            </h1>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /main-sub-banner-sec -->

            <!-- about sec -->
            <section>
                <div class="about-sec">
                    <div class="container">
                        <div class="about-sec-wrapper">
                            <div class="about-sec-wrapper-text">
                                @forelse($sitemap_menus as $menu)
                             @php
                                        $route = $menu->slug;
                                        $href = localized_route('page.show', [$route]);
                                    @endphp
                                <ol class="wtree">
                                    <li>
                                        <span><a
                                                @if ($menu->children->count() <= 0) href="{{ $href }}" @else href="#" @endif>
                                                {{ localized_field($menu, 'title') }}
                                            </a></span>
                                        <ol>

                                            @if ($menu->children->count() > 0)
                                                @foreach ($menu->children as $child)
                                                    <li>
                                                        <span><a
                                                                href="{{ localized_route('page.subpage.show', [$menu->slug, $child->slug]) }}">{{ localized_field($child, 'title') }}</a></span>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ol>
                                    </li>
                                </ol>
                                 @endforeach


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
