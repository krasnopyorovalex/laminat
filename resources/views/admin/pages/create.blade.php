@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.pages.index') }}">Страницы</a></li>
    <li class="active">Форма добавления страницы</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления страницы</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.pages.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                @select(['name' => 'slider_id', 'label' => 'Слайдер', 'items' => $sliders])
                @select(['name' => 'gallery_id', 'label' => 'Галерея', 'items' => $galleries])

                <div class="form-group">
                    <label for="template">Шаблон страницы:</label>
                    <select class="form-control border-blue border-xs select-search" id="template" name="template" data-width="100%">
                        @foreach ($templates as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>

                @input(['name' => 'name', 'label' => 'Название'])
                @input(['name' => 'title', 'label' => 'Title'])
                @input(['name' => 'description', 'label' => 'Description'])
                @input(['name' => 'alias', 'label' => 'Alias'])

                @imageInput(['name' => 'image', 'type' => 'file', 'label' => 'Выберите изображение на компьютере'])

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