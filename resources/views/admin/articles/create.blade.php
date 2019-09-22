@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.articles.index') }}">Статьи</a></li>
    <li class="active">Форма добавления статьи</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления статьи</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.articles.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                @input(['name' => 'name', 'label' => 'Название'])
                @input(['name' => 'title', 'label' => 'Title'])
                @input(['name' => 'description', 'label' => 'Description'])
                @input(['name' => 'alias', 'label' => 'Alias'])

                @imageInput(['name' => 'image', 'type' => 'file', 'label' => 'Выберите изображение на компьютере'])

                @textarea(['name' => 'preview', 'label' => 'Превью статьи', 'id' => 'editor-full2'])
                @textarea(['name' => 'text', 'label' => 'Текст'])
                @checkbox(['name' => 'is_published', 'label' => 'Опубликовано?', 'isChecked' => true])

                @submit_btn()
            </form>

        </div>
    </div>
@push('scripts')
<script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
@endpush
@endsection