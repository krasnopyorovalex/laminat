<div class="row">
    @foreach ($catalog as $cat)
        <div class="col-3">
            <div class="travel__item">
                @if ($cat->image)
                <img src="{{ $cat->image->path }}" alt="{{ $cat->image->alt }}" title="{{ $cat->image->title }}">
                @endif
                <div class="travel__item-name">
                    <a href="{{ $cat->url }}" class="show__tour">{{ $cat->name }}</a>
                </div>
                <a href="{{ $cat->url }}" class="btn__more">
                    {{ svg('zoom') }}
                </a>
            </div>
        </div>
    @endforeach
</div>
