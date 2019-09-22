@extends('layouts.app')

@section('title', $service->title)
@section('description', $service->description)
@push('og')
<meta property="og:title" content="{{ $service->title }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($service->image ? $service->image->path : 'img/logo.png') }}">
    <meta property="og:description" content="{{ $service->description }}">
    <meta property="og:site_name" content="Море ламината">
    <meta property="og:locale" content="ru_RU">
@endpush
@section('content')
    <section class="title__section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>{{ $service->name }}</h1>
                </div>
            </div>
        </div>
    </section>

    <main class="seo page single__tour">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="breadcrumbs" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                        <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                            <a href="{{ route('page.show') }}">Главная</a>
                            <meta itemprop="position" content="1">
                        </li>
                        <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                            <a href="{{ route('page.show', ['alias' => 'turi']) }}">Туры</a>
                            <meta itemprop="position" content="2">
                        </li>
                        <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                            <a href="{{ route('page.show', ['alias' => $service->parent->alias]) }}">{{ $service->parent->name }}</a>
                            <meta itemprop="position" content="3">
                        </li>
                        <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                            {{ $service->name }}
                            <meta itemprop="position" content="4">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-7">
                    <div class="carousel__box">
                        @if ($service->gallery && count($service->gallery->images))
                        <div class="product__carousel owl-theme owl-carousel">
                            @foreach ($service->gallery->images as $image)
                                <img src="{{ $image->getPath() }}" alt="{{ $image->alt }}" title="{{ $image->title }}">
                            @endforeach
                        </div>
                        <div class="product__carousel-thumbs owl-theme owl-carousel">
                            @foreach ($service->gallery->images as $image)
                                <img src="{{ $image->getThumb() }}" alt="{{ $image->alt }}" title="{{ $image->title }}" data-index="{{ $loop->index }}">
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-5">
                    <div class="product__text">
                        {!! $service->short_text !!}
                    </div>
                </div>
            </div>
            @if (count($service->originTabs))
            <div class="row">
                <div class="col-12">
                    <div class="tabs">
                        <ul class="not__decorated">
                            @foreach ($service->originTabs as $tab)
                                <li>{{ $tab->name }}</li>
                            @endforeach
                        </ul>
                        <div>
                            @foreach ($service->originTabs as $tab)
                                <div>
                                    {!! $service->tabs[$tab->id] !!}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="text__block">
                        {!! $service->text !!}
                    </div>
                </div>
            </div>
        </div>
    </main>

    @if (count($service->relativeServices))
    <section class="another__products">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="title">Туры, которые могут Вас заинтересовать</div>

                    <div class="catalog__items owl-carousel owl-theme">
                        @foreach ($service->relativeServices as $subService)
                            <div class="catalog__items-item">
                                @if ($subService->image)
                                <figure>
                                    <a href="{{ $subService->url }}">
                                        <img src="{{ $subService->image->path }}" alt="{{ $subService->image->alt }}" title="{{ $subService->image->title }}">
                                    </a>
                                </figure>
                                @endif
                                <div class="catalog__items-info">
                                    <div class="name">
                                        <a href="{{ $subService->url }}">{{ $subService->name }}</a>
                                    </div>
                                    <div class="buttons">
                                        <div class="btn__go call__popup" data-target="popup__order" data-service="{{ $subService->name }}">Заказать</div>
                                        <a href="{{ $subService->url }}" class="btn__go">Подробнее</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.forms.order_popup')
    @endif

    @include('layouts.partials.begin_travel', ['service' => $service])
@endsection
