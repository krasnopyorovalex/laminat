@extends('layouts.app')

@section('title', $product->title)
@section('description', $product->description)
@push('og')
    <meta property="og:title" content="{{ $product->title }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:image" content="{{ asset($product->image ? $product->image->path : 'img/logo.png') }}">
    <meta property="og:description" content="{{ $product->description }}">
    <meta property="og:site_name" content="Море ламината">
    <meta property="og:locale" content="ru_RU">
@endpush

@section('content')
    @includeWhen($product->slider, 'layouts.sections.slider', ['slider' => $product->slider])
    <section class="title__section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>{{ $product->name }}</h1>
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
                        @isset($product->catalog->parent)
                            <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                                <a href="{{ route('page.show', ['alias' => $product->catalog->parent->alias]) }}">{{ $product->catalog->parent->name }}</a>
                                <meta itemprop="position" content="2">
                            </li>
                        @endisset
                        @isset($product->catalog)
                            <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                                <a href="{{ route('page.show', ['alias' => $product->catalog->alias]) }}">{{ $product->catalog->name }}</a>
                                <meta itemprop="position" content="{{ isset($product->catalog->parent) ? 3 : 2 }}">
                            </li>
                        @endisset
                        <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                            {{ $product->name }}
                            <meta itemprop="position" content="{{ isset($product->catalog->parent) ? 4 : 3 }}">
                        </li>
                    </ul>
                    <div class="seo__text">
                        {!! $product->text !!}
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
