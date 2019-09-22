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
                    <div class="title">Мы создаем воспоминания</div>
                    <div class="sub__title">О компании</div>
                    <div class="text">
                        <p>Что нужно человеку для счастья? Хорошие люди рядом и возможность путешествовать! Море ламината – это новые места и море новых впечатлений.</p>
                        <p>Мы организовываем однодневные и многодневные походы по Крыму и за его пределами. Наши гиды-профессионалы сделают Ваш тур не только интересным и безопасным, а также запечатлят на фотокамеру все значимые моменты.</p>
                        <p>Основные наши направления:</p>
                        <ul>
                            <li><b>Крым</b> – походы вдоль моря, по горной и степной части полуострова, каяк-туры по Черному морю, спуски дюльфером в известных и живописных местах.</li>
                            <li><b>Кавказ</b> – путешествие на несколько дней небольшой группой. Посещаем исторические и природные достопримечательности. Основные направления: Абхазия, Дагестан, Чечня, Сочи, Домбай, Пятигорск, Терскол.</li>
                        </ul>
                        <p>Для полного комфорта в путешествии, туры организованы небольшими группами с выездом из города Симферополь. Во время пешеходных туров мы показываем красивейшие места и тропы.</p>
                        <p class="center">Насладимся путешествием вместе!</p>
                        <div class="center">
                            <a href="{{ route('page.show', ['alias' => 'catalog']) }}" class="btn">
                                Смотреть все
                                {{ svg('arrow') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="img__bg">
                        <img src="{{ asset('img/info_text-bg.jpg') }}" alt="alt">
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.partials.begin_travel')

    @includeWhen($page->gallery, 'layouts.sections.gallery', ['gallery' => $page->gallery])

    @include('layouts.partials.counts')

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
