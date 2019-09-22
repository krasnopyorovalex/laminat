@extends('layouts.app')

@section('canonical', route('page.show', ['alias' => request('alias')]))
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
    <section class="title__section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>{{ $page->name }}</h1>
                </div>
            </div>
        </div>
    </section>

    <main class="seo page">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include('layouts.partials.breadcrumbs', ['page' => $page])
                    <div class="seo__text">
                        {!! $page->text !!}
                    </div>
                </div>
            </div>
            <div class="row guestbook__list">
                <div class="col-8">
                    @if (count($guestbook))
                    <div class="guestbook__box">
                        @foreach($guestbook as $item)
                            <div class="guestbook__item">
                                <div class="header">
                                    <div class="date">
                                        <i class="icon__calendar"></i>
                                        {{ $item->published_at->formatLocalized('%d %b %Y') }} г.
                                    </div>
                                    <div class="name">
                                        <i class="icon human"></i>
                                        {{ $item->name }}
                                    </div>
                                </div>
                                <div class="body">
                                    {!! $item->text !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="pagination">
                        {{ $guestbook->links() }}
                    </div>
                    @endif
                </div>
                <div class="col-4">
                    @include('layouts.forms.guestbook')
                </div>
            </div>
        </div>
    </main>

    @includeWhen($page->gallery, 'layouts.sections.gallery', ['gallery' => $page->gallery])

@endsection
