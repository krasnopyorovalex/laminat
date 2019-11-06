@extends('layouts.app')

@section('title', $catalog->title)
@section('description', $catalog->description)
@push('og')
    <meta property="og:title" content="{{ $catalog->title }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($catalog->image ? $catalog->image->path : 'img/logo.png') }}">
    <meta property="og:description" content="{{ $catalog->description }}">
    <meta property="og:site_name" content="Море ламината">
    <meta property="og:locale" content="ru_RU">
@endpush

@section('content')
    @includeWhen($catalog->slider, 'layouts.sections.slider', ['slider' => $catalog->slider])
    <section class="title__section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>{{ $catalog->name }}</h1>
                </div>
            </div>
        </div>
    </section>

    <main class="catalog">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="breadcrumbs" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                        <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                            <a href="{{ route('page.show') }}">Главная</a>
                            <meta itemprop="position" content="1">
                        </li>
                        @if($catalog->parent->parent)
                            <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                                <a href="{{ route('page.show', ['alias' => $catalog->parent->parent->alias]) }}">{{ $catalog->parent->parent->name }}</a>
                                <meta itemprop="position" content="2">
                            </li>
                        @endif
                        <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                            <a href="{{ route('page.show', ['alias' => $catalog->parent->alias]) }}">{{ $catalog->parent->name }}</a>
                            <meta itemprop="position" content="{{ $catalog->parent->parent ? 3 : 2 }}">
                        </li>
                        <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                            {{ $catalog->name }}
                            <meta itemprop="position" content="{{ $catalog->parent->parent ? 4 : 3 }}">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    @include('layouts.sections.filter_panel')
                </div>
                <div class="col-9">
                    @include('layouts.sections.sorting')
                    <div class="catalog__items">
                        @foreach($products as $product)
                        <div class="catalog__items-item">
                            @if($product->image)
                            <figure>
                                <a href="{{ $product->url }}">
                                    <img src="{{ $product->image->path }}" alt="{{ $product->image->alt }}" title="{{ $product->image->title }}">
                                </a>
                            </figure>
                            @endif
                            <div class="catalog__items-info">
                                <div class="name">
                                    <a href="{{ $product->url }}">{{ $product->name }}</a>
                                </div>
                                <div class="prices">
                                    <div class="price__new">
                                        Цена: {{ $product->price }} ₽
                                    </div>
                                </div>
                                <a href="{{ $product->url }}" class="btn__go">
                                    Подробнее
                                    {{ svg('arrow') }}
                                </a>
                            </div>
                                @if($product->label)
                                    <div class="label__product {{ $product->label }}">{{ $product->getLabelName($product->label) }}</div>
                                @endif
                        </div>
                        @endforeach

                    </div>
                    <div class="pagination">
                        {{ $products->appends([
                            'filters' => request('filters'),
                            'priceFrom' => request('priceFrom'),
                            'priceTo' => request('priceTo'),
                            'name' => request('name'),
                            'price' => request('price')
                        ])
                        ->onEachSide(3)
                        ->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
