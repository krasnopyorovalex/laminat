@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.catalogs.index') }}">Категории каталога</a></li>
    <li class="active">Форма редактирования категории</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования категории</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.catalogs.update', ['id' => $catalog->id]) }}" method="post" enctype="multipart/form-data">
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
                                    {!! build_root_child_select($catalogs, old('parent_id', $catalog->parent_id)) !!}
                                </select>
                            </div>

                            @input(['name' => 'name', 'label' => 'Название', 'entity' => $catalog])
                            @input(['name' => 'title', 'label' => 'Title', 'entity' => $catalog])
                            @input(['name' => 'description', 'label' => 'Description', 'entity' => $catalog])

                            @input(['name' => 'alias', 'label' => 'Alias', 'entity' => $catalog])
                            @textarea(['name' => 'text', 'label' => 'Текст', 'entity' => $catalog])

                            @submit_btn()
                        </div>

                        <div class="tab-pane" id="image">
                            @if ($catalog->image)
                                <div class="panel panel-flat border-blue border-xs" id="image__box">
                                    <div class="panel-body">
                                        <img src="{{ asset($catalog->image->path) }}" alt="" class="upload__image">

                                        <div class="btn-group btn__actions">
                                            <button data-toggle="modal" data-target="#modal_info" type="button" class="btn btn-primary btn-labeled btn-sm"><b><i class="icon-pencil4"></i></b> Атрибуты</button>

                                            <button type="button" data-href="{{ route('admin.images.destroy', ['id' => $catalog->image->id]) }}" class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">Удалить <b><i class="icon-trash"></i></b></button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @imageInput(['name' => 'image', 'type' => 'file', 'entity' => $catalog, 'label' => 'Выберите изображение на компьютере'])
                            @submit_btn()
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </div>
    @if ($catalog->image)
        @include('layouts.partials._image_attributes_popup', ['image' => $catalog->image])
    @endif

@push('scripts')
<script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
@endpush
@endsection
