<ul class="breadcrumbs" itemscope="" itemtype="http://schema.org/BreadcrumbList">
    <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
        <a href="{{ route('page.show') }}">Главная</a>
        <meta itemprop="position" content="1">
    </li>
    @if (isset($parent))
        <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
            <a href="{{ route('page.show', ['alias' => $parent->alias]) }}">{{ $parent->name }}</a>
            <meta itemprop="position" content="2">
        </li>
    @endif
    <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
        {{ $page->name }}
        <meta itemprop="position" content="{{ isset($parent) ? 3 : 2 }}">
    </li>
</ul>