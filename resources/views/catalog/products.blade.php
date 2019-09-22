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
                    @include('layouts.partials.breadcrumbs', ['page' => $catalog, 'parent' => $catalog->parent])
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="filter__panel">
                        <form action="#" class="filter__panel-form">
                            <div class="filter__block-price">
                                <div class="label">Цена, ₽:</div>
                                <div id="keypress"></div>
                                <div class="single__block-price">
                                    <div>
                                        <label for="input__price-from">от:</label>
                                        <input type="text" id="input__price-from">
                                    </div>
                                    <div>
                                        <label for="input__price-to">до:</label>
                                        <input type="text" id="input__price-to">
                                    </div>
                                </div>
                            </div>
                            <div class="filter__block is__opened">
                                <div class="label">Цвет:</div>
                                <div class="list">
                                    <div class="list__item">
                                        <input type="checkbox" id="brand_1" name="f[]" value="1">
                                        <label for="brand_1">коричневый (1)</label>
                                    </div>
                                    <div class="list__item">
                                        <input type="checkbox" id="brand_2" name="f[]" value="1">
                                        <label for="brand_2">бежевый (1)</label>
                                    </div>
                                    <div class="list__item">
                                        <input type="checkbox" id="brand_3" name="f[]" value="1">
                                        <label for="brand_3">синий (5)</label>
                                    </div>
                                    <div class="list__item">
                                        <input type="checkbox" id="brand_4" name="f[]" value="1">
                                        <label for="brand_4">красный (10)</label>
                                    </div>
                                    <div class="list__item">
                                        <input type="checkbox" id="brand_5" name="f[]" value="1">
                                        <label for="brand_5">бордовый (2)</label>
                                    </div>
                                    <div class="list__item">
                                        <input type="checkbox" id="brand_6" name="f[]" value="1">
                                        <label for="brand_6">голубой (9)</label>
                                    </div>
                                    <div class="list__item">
                                        <input type="checkbox" id="brand_7" name="f[]" value="1">
                                        <label for="brand_7">желтый (8)</label>
                                    </div>
                                    <div class="list__item">
                                        <input type="checkbox" id="brand_8" name="f[]" value="1">
                                        <label for="brand_8">красный (5)</label>
                                    </div>
                                    <div class="list__item">
                                        <input type="checkbox" id="brand_9" name="f[]" value="1">
                                        <label for="brand_9">зеленый (2)</label>
                                    </div>
                                    <div class="list__item">
                                        <input type="checkbox" id="brand_10" name="f[]" value="1">
                                        <label for="brand_10">малиновый (1)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="filter__block">
                                <div class="label">Материал:</div>
                                <div class="list hidden">
                                    <div class="list__item">
                                        <input type="checkbox" id="m_1" name="m[]" value="1">
                                        <label for="m_1">дерево</label>
                                    </div>
                                    <div class="list__item">
                                        <input type="checkbox" id="m_2" name="m[]" value="1">
                                        <label for="m_2">пластик</label>
                                    </div>
                                    <div class="list__item">
                                        <input type="checkbox" id="m_3" name="m[]" value="1">
                                        <label for="m_3">полиэстирол</label>
                                    </div>
                                    <div class="list__item">
                                        <input type="checkbox" id="m_4" name="m[]" value="1">
                                        <label for="m_4">сталь</label>
                                    </div>
                                </div>
                            </div>
                            <div class="filter__block is__opened">
                                <div class="label">Теги:</div>
                                <div class="tags">
                                    <ul class="not__decorated">
                                        <li><a href="#">обувь</a></li>
                                        <li><a href="#">рюкзак</a></li>
                                        <li><a href="#">поход</a></li>
                                        <li><a href="#">ботинки</a></li>
                                        <li><a href="#">Jack Wolfskin</a></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-9">
                    <div class="sorting">
                        <div class="label">Сортировать:</div>
                        <form action="#">
                            <div class="single__block">
                                <select name="alphabet">
                                    <option value="one">По умолчанию (алфавиту)</option>
                                    <option value="two">От А до Я</option>
                                </select>
                                <i class="select__arrow"></i>
                            </div>

                            <div class="single__block">
                                <select name="in__news">
                                    <option value="one">По новизне</option>
                                    <option value="two">От А до Я</option>
                                </select>
                                <i class="select__arrow"></i>
                            </div>

                            <div class="single__block">
                                <select name="price">
                                    <option value="one">По цене</option>
                                    <option value="two">От А до Я</option>
                                </select>
                                <i class="select__arrow"></i>
                            </div>

                            <div class="single__block">
                                <select name="popular">
                                    <option value="one">По популярности</option>
                                    <option value="two">От А до Я</option>
                                </select>
                                <i class="select__arrow"></i>
                            </div>
                        </form>
                    </div>

                    <div class="catalog__items">
                        @foreach($catalog->products as $product)
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
                                    {{ svg('tap') }}
                                </a>
                            </div>
                            <div class="label__product new">Новинка!</div>
                            <div class="label__product info">1+1</div>
                        </div>
                        @endforeach

                    </div>
                    <div class="pagination">
                        <ul class="not__decorated">
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
