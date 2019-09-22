<nav itemscope="" itemtype="http://schema.org/SiteNavigationElement">
    <ul>
        @foreach($menu->get('menu_footer') as $item)
            <li><a itemprop="url" href="{{ $item->link }}">{{ $item->name }}</a></li>
        @endforeach
    </ul>
</nav>