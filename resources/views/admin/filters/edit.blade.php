@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.filters.index') }}">Категории каталога</a></li>
    <li class="active">Форма редактирования категории</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования категории</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.filters.update', ['id' => $filter->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                        <li><a href="#image" data-toggle="tab">Изображение</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="main">

                            <div class="form-group">
                                <label for="parent_id">Выберите родительский категорию</label>
                                <select class="form-control border-blue border-xs select-search" id="parent_id" name="parent_id" data-width="100%">
                                    <option value="">Не выбрано</option>
                                    {!! build_root_child_select($filters, old('parent_id', $filter->parent_id)) !!}
                                </select>
                            </div>

                            @input(['name' => 'name', 'label' => 'Название', 'entity' => $filter])
                            @input(['name' => 'title', 'label' => 'Title', 'entity' => $filter])
                            @input(['name' => 'description', 'label' => 'Description', 'entity' => $filter])

                            @input(['name' => 'alias', 'label' => 'Alias', 'entity' => $filter])
                            @textarea(['name' => 'text', 'label' => 'Текст', 'entity' => $filter])

                            @submit_btn()
                        </div>

                        <div class="tab-pane" id="image">
                            @if ($filter->image)
                                <div class="panel panel-flat border-blue border-xs" id="image__box">
                                    <div class="panel-body">
                                        <img src="{{ asset($filter->image->path) }}" alt="" class="upload__image">

                                        <div class="btn-group btn__actions">
                                            <button data-toggle="modal" data-target="#modal_info" type="button" class="btn btn-primary btn-labeled btn-sm"><b><i class="icon-pencil4"></i></b> Атрибуты</button>

                                            <button type="button" data-href="{{ route('admin.images.destroy', ['id' => $filter->image->id]) }}" class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">Удалить <b><i class="icon-trash"></i></b></button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @imageInput(['name' => 'image', 'type' => 'file', 'entity' => $filter, 'label' => 'Выберите изображение на компьютере'])
                            @submit_btn()
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </div>
    @if ($filter->image)
        @include('layouts.partials._image_attributes_popup', ['image' => $filter->image])
    @endif

@push('scripts')
<script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
@endpush
@endsection
