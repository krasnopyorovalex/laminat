@extends('layouts.app', ['map' => true])

@section('title', $page->title)
@section('description', $page->description)
@push('og')
<meta property="og:title" content="{{ $page->title }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($page->image ? $page->image->path : 'img/logo.png') }}">
    <meta property="og:description" content="{{ $page->description }}">
    <meta property="og:site_name" content="Море ламината">
    <meta property="og:locale" content="ru_RU">
@endpush

@section('content')

    @includeWhen($page->slider, 'layouts.sections.slider', ['slider' => $page->slider])

    @include('layouts.sections.catalog')

    <section class="info__text">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="title">Море ламината, Симферополь</div>
                    <div class="sub__title">О компании</div>
                    <div class="text">
                        <p>Мы на рынке более 15 лет, поэтому предоставляем большой выбор ламинита, паркета и винила в Симферополе, на проспекте Победы.  Мы работаем с более чем 10 крупными поставщиками, одни из них известные фирмы: QUICK STEP и TARKETT. Многие товары и цвета в наличие, также есть возможность заказа интересующего материала и объема.</p>
                        <p>Подберем эксклюзивный товар именно для вас: ламинат с рисунком, ламинат с надписями, ламинат под паркет и плитку.</p>
                        <p>В нашем магазины вы дополнительно сможете приобрести аксессуары: плинтуса, соединительные пороги.</p>
                        <p>Осуществляем доставку нашего товара по городу Симферополю и Крыму. Подробности уточняйте при оформлении заказа.</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="img__bg">
                        <img src="{{ asset('img/info_text-bg.jpeg') }}" alt="alt">
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.partials.begin_travel')

    @includeWhen($page->gallery, 'layouts.sections.gallery', ['gallery' => $page->gallery])

    <main class="seo">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="title">{{ $page->name }}</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="seo__text">
                        {!! $page->text !!}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
