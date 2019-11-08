<ul class="sitemap">
    @if (count($pages))
        @foreach($pages as $page)
            <li>
                <a href="{{ route('page.show', ['alias' => $page->alias]) }}">{{ $page->name }}</a>
                @if ($page->template === 'page.blog' && count($articles))
                    <ul>
                        @foreach($articles as $blog)
                            <li>
                                <a href="{{ route('article.show', ['alias' => $blog->alias]) }}">{{ $blog->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    @endif
    @if (count($catalog))
        <ul>
            @foreach($catalog as $cat)
                <li>
                    <a href="{{ $cat->url }}">{{ $cat->name }}</a>
                    @if (count($cat->products))
                        <ul>
                            @foreach($cat->products as $product)
                                <li>
                                    <a href="{{ $product->url }}">{{ $product->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</ul>
