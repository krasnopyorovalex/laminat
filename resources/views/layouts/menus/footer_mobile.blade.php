<nav itemscope="" itemtype="http://schema.org/SiteNavigationElement">
    <ul>
        @foreach($menu->get('menu_header') as $item)
            <li{!! add_css_class($item) !!}>
                <a itemprop="url" href="{{ $item->link }}">{{ $item->name }}</a>
                @if (count($item->menuItems))
                    <span><i class="icon__arrow"></i></span>
                    <ul>
                        @foreach($item->menuItems as $subItem)
                            <li><a href="{{ $subItem->link }}">{{ $subItem->name }}</a></li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</nav>