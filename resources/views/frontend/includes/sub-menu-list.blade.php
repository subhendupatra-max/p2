<ul>
    @forelse ($all_sub_menu as $sub_menu)
            <li>
            <a href="{{ localized_route('page.subpage.show', [$main_menu->slug,$sub_menu->slug]) }}" {{ $sub_menu->slug == $menu->slug ? 'class=active' : '' }}>
                {{ localized_field($sub_menu, 'title') }}
                <img src="{{ asset('frontend')}}/assets/images/about-page-icon.png" alt="...">
            </a>
        </li>
    @empty
    @endforelse

</ul>
