<div class="portfolio__list-item {{ $portfolio->category }}">
    <div class="bg__item {{ $portfolio->color }}"></div>
    <div class="image__preview">
        <figure>
            <a href="{{ $portfolio->url }}">
                <img src="{{ $portfolio->image->path }}" alt="{{ $portfolio->image->alt }}" title="{{ $portfolio->image->title }}">
            </a>
        </figure>
    </div>
    <div class="body">
        <div class="bg__box">
            <div class="name">
                <a href="{{ $portfolio->url }}">{{ $portfolio->name }}</a>
            </div>
            <div class="desc">
                {!! $portfolio->preview !!}
            </div>
            @if ($portfolio->tags)
                <div class="tags">
                    @foreach ($portfolio->tags as $tag)
                        <span>{{ $tag }}</span>
                    @endforeach
                </div>
            @endif
            <div class="link__more">
                <div class="link__more-text">
                    <a href="{{ $portfolio->url }}">ПОДРОБНЕЕ</a>
                </div>
                <a href="{{ $portfolio->url }}" class="link__more-icon">
                    <svg class="icon link">
                        <use xlink:href="./img/symbols.svg#link"></use>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>