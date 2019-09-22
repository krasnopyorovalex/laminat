<div class="box_catalog-list">
    @if(count($catalog))
    <ul>
        @foreach($catalog as $cat)
        <li>
            <a href="{{ $cat->url }}">{{ $cat->name }}</a>
            @if(count($cat->catalogs))
            <span><i class="icon icon_arrow"></i></span>
            <ul>
                @foreach($cat->catalogs as $subCat)
                <li><a href="{{ $subCat->url }}">{{ $subCat->name }}</a></li>
                @endforeach
            </ul>
            @endif
        </li>
        @endforeach
    </ul>
    @endif
</div>
