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
                    <ul class="breadcrumbs">
                        <li>
                            <a href="{{ route('page.show') }}">Главная</a>
                        </li>
                        @isset($product->catalog->parent->parent)
                            <li>
                                <a href="{{ route('page.show', ['alias' => $product->catalog->parent->parent->alias]) }}">{{ $product->catalog->parent->parent->name }}</a>
                            </li>
                        @endisset
                        @isset($product->catalog->parent)
                            <li>
                                <a href="{{ route('page.show', ['alias' => $product->catalog->parent->alias]) }}">{{ $product->catalog->parent->name }}</a>
                            </li>
                        @endisset
                        @isset($product->catalog)
                            <li>
                                <a href="{{ route('page.show', ['alias' => $product->catalog->alias]) }}">{{ $product->catalog->name }}</a>
                            </li>
                        @endisset
                        <li>
                            {{ $product->name }}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-5">
                    @if($product->image)
                    <figure class="product_image">
                        <img src="{{ $product->image->path }}" alt="{{ $product->image->alt }}" title="{{ $product->image->title }}">
                    </figure>
                    @endif
                </div>
                <div class="col-7">
                    <div class="product__text">
                        <div class="row">
                            <div class="col-4 as_center">
                                <div class="product_price"><span>Цена</span>: {{ $product->getPrice() }}</div>
                            </div>
                            <div class="col-8">
                                @if(count($product->filterOptions))
                                    <table class="product_filters">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Характеристики товара</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($product->filterOptions as $filterOption)
                                            <tr>
                                                <td>{{ $filterOption->filter->name }}:</td>
                                                <td>{{ $filterOption->name }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                        {!! $product->text !!}
                        <div class="btn call__popup" data-target="popup__order">
                            Узнать стоимость
                            {{ svg('info') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('layouts.forms.order_popup')
@endsection
