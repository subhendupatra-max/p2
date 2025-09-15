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
                                    <a href="{{ localized_route('page.show', ['home']) }}">
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
                <div class="ap-about-sec">
                    <div class="container">
                        <div class="ap-about-wrapper">
                            <div class="our-organization-form">
                                @php
                                    $route = $main_menu->slug;
                                    $href = localized_route('page.show', [$route]);
                                    if ($main_menu->children->count() > 0) {
                                        $route = $menu->slug;
                                        $href = localized_route('page.subpage.show', [$main_menu->slug, $route]);
                                    }
                                @endphp
                                <form method="get" action="{{ $href }}">
                                    @csrf
                                    <div class="our-organization-form">
                                        <div class="form-item">
                                            <input type="text" placeholder="{{ __('messages.search') }}"
                                                id="search" name="search" value="{{ request()->query('search') }}">
                                            <button class="search-btn" type="submit">
                                                <img src="{{ asset('frontend') }}/assets/images/header-search.png"
                                                    alt="...">
                                            </button>
                                        </div>
                                        <div class="our-organization-form-div">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-12 col-12">
                                                    <div class="form-item-1">
                                                        <img src="{{ asset('frontend') }}/assets/images/bar.png"
                                                            alt="...">
                                                        <select name="sort_by" id="sort_by"
                                                            onchange="this.form.submit()">
                                                            <option value="">---- {{ __('messages.sort_by') }}
                                                                ----</option>
                                                            <option value="1"
                                                                {{ request()->query('sort_by') == '1' ? 'selected' : '' }}>
                                                                {{ __('messages.title_sort_by_asc') }}</option>
                                                            <option value="2"
                                                                {{ request()->query('sort_by') == '2' ? 'selected' : '' }}>
                                                                {{ __('messages.title_sort_by_desc') }}</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-12 col-12">
                                                    <div class="form-item-1">
                                                        <img src="{{ asset('frontend') }}/assets/images/folder.png"
                                                            alt="...">
                                                        <select name="per_page" id="per_page"
                                                            onchange="this.form.submit()">
                                                            <option value="10"
                                                                {{ request()->query('per_page') == '10' ? 'selected' : '' }}>
                                                                {{ __('messages.10_per_page') }}</option>
                                                            <option value="25"
                                                                {{ request()->query('per_page') == '25' ? 'selected' : '' }}>
                                                                {{ __('messages.25_per_page') }}</option>
                                                            <option value="50"
                                                                {{ request()->query('per_page') == '50' ? 'selected' : '' }}>
                                                                {{ __('messages.50_per_page') }}</option>
                                                            <option value="100"
                                                                {{ request()->query('per_page') == '100' ? 'selected' : '' }}>
                                                                {{ __('messages.100_per_page') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="our-organization-row">
                                <div class="row">

                                    @forelse($data['our_organization'] as $our_organ)
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="our-organization-row-item">
                                                <h4>
                                                    {{ localized_field($our_organ, 'title') }}
                                                </h4>
                                                <div>
                                                    {!! Str::limit(localized_field($our_organ, 'description'), 200) !!}
                                                </div>
                                                <div class="text-right">
                                                    <a href="{{ $our_organ?->href() ?? '#' }}" class="link">
                                                        <img src="{{ asset('frontend') }}/assets/images/key-offering-icon.png"
                                                            alt="...">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p>{{ __('messages.no_data_found') }}</p>
                                    @endforelse
                                </div>
                                {!! $data['our_organization']->withQueryString()->links('pagination::bootstrap-5') !!}
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
