@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.portfolios.index') }}">Портфолио</a></li>
    <li class="active">Форма добавления портфолио</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления статьи</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.portfolios.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="category">Категория:</label>
                    <select class="form-control border-blue border-xs select-search" id="category" name="category" data-width="100%">
                        @foreach ($categories as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="color">Цвет фона:</label>
                    <select class="form-control border-blue border-xs select-search" id="color" name="color" data-width="100%">
                        @foreach ($colors as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>

                @input(['name' => 'name', 'label' => 'Название'])
                @input(['name' => 'title', 'label' => 'Title'])
                @input(['name' => 'description', 'label' => 'Description'])
                @input(['name' => 'alias', 'label' => 'Alias'])
                @input(['name' => 'site_url', 'label' => 'Ссылка на сайт'])

                <div class="form-group">
                    <label for="tags">Введите теги</label>
                    <select class="form-control border-blue border-xs select-multiple-tags" multiple="multiple" id="tags" name="tags[]" data-width="100%">
                    </select>
                </div>

                @imageInput(['name' => 'image', 'type' => 'file', 'label' => 'Выберите изображение на компьютере'])

                @textarea(['name' => 'preview', 'label' => 'Превью портфолио', 'id' => 'editor-full2'])
                @textarea(['name' => 'text', 'label' => 'Текст'])

                @input(['name' => 'pos', 'label' => 'Позиция'])
                @input(['name' => 'form_title', 'label' => 'Название формы'])
                @input(['name' => 'form_sub_title', 'label' => 'Описание под названием формы'])

                @submit_btn()
            </form>

        </div>
    </div>
@push('scripts')
<script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
@endpush
@endsection