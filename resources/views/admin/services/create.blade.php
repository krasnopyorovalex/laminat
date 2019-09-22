@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.services.index') }}">Каталог</a></li>
    <li class="active">Форма добавления каталога</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления каталога</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.services.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="main">
                            <div class="form-group">
                                <label for="parent_id">Родительская услуга</label>
                                <select class="form-control border-blue border-xs select-search" id="parent_id" name="parent_id" data-width="100%">
                                    <option value="">Не выбрано</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @select(['name' => 'gallery_id', 'label' => 'Галерея', 'items' => $galleries])

                            @input(['name' => 'name', 'label' => 'Название'])
                            @input(['name' => 'title', 'label' => 'Title'])
                            @input(['name' => 'description', 'label' => 'Description'])
                            @input(['name' => 'alias', 'label' => 'Alias'])

                            @imageInput(['name' => 'image', 'type' => 'file', 'label' => 'Выберите изображение на компьютере'])

                            @textarea(['name' => 'short_text', 'label' => 'Краткое описание', 'id' => 'editor-full2'])
                            @textarea(['name' => 'text', 'label' => 'Текст'])
                            @checkbox(['name' => 'is_published', 'label' => 'Опубликовано?', 'isChecked' => true])

                            @submit_btn()
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@push('scripts')
<script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
@endpush
@endsection
