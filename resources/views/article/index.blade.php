@extends('layouts.app')

@section('title', $article->title)
@section('description', $article->description)
@push('og')
    <meta property="og:title" content="{{ $article->title }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($article->image ? $article->image->path : 'img/logo.png') }}">
    <meta property="og:description" content="{{ $article->description }}">
    <meta property="og:site_name" content="Море ламината">
    <meta property="og:locale" content="ru_RU">
@endpush

@section('content')
    <section class="title__section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>{{ $article->name }}</h1>
                </div>
            </div>
        </div>
    </section>

    <main class="seo page">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="breadcrumbs" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                        <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                            <a href="{{ route('page.show') }}">Главная</a>
                            <meta itemprop="position" content="1">
                        </li>
                        <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                            <a href="{{ route('page.show', ['alias' => 'blog']) }}">Блог</a>
                            <meta itemprop="position" content="2">
                        </li>
                        <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                            {{ $article->name }}
                            <meta itemprop="position" content="3">
                        </li>
                    </ul>
                    <div class="seo__text">
                        <time itemprop="datePublished" datetime="{{ $article->published_at->format('c') }}"></time>
                        @if ($article->image)
                            <figure>
                                <img src="{{ $article->image->path }}" alt="{{ $article->image->alt }}" title="{{ $article->image->title }}" class="responsive" />
                            </figure>
                        @endif
                        {!! $article->text !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-only-6 center">
                        @if ($prev)
                            <a href="{{ route('article.show', $prev->alias) }}" class="prev__item">
                                {{ $prev->name }} <span data-text="Следующая статья"></span>
                            </a>
                        @endif
                    </div>
                    <div class="col-only-6 center">
                        @if ($next)
                            <a href="{{ route('article.show', $next->alias) }}" class="next__item">
                                {{ $next->name }} <span data-text="Предыдущая статья"></span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
