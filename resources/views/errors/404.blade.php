@extends('layouts.app')

@section('title', '404 - Страница не найдена')
@section('description', '404 - Страница не найдена')
@section('keywords', '404 - Страница не найдена')

@section('content')

    <section class="not__found">
        <div class="bg__box"></div>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="not__found-box">
                        <img src="{{ asset('img/error-404.svg') }}" alt="страница не найдена">
                    </div>
                    <a href="{{ route('page.show') }}" class="btn">Перейти на главную</a>
                </div>
            </div>
        </div>
    </section>

@endsection