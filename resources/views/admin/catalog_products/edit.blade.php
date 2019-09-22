@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.catalogs.index') }}">Категории каталога</a></li>
    <li><a href="{{ route('admin.catalog_products.index', $catalogProduct->catalog) }}">Список товаров</a></li>
    <li class="active">Форма редактирования товара</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования товара</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.catalog_products.update', ['id' => $catalogProduct->id]) }}" method="post" enctype="multipart/form-data">
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
                                    <label for="label">Метка:</label>
                                    <select class="form-control border-blue border-xs select-search" id="slider_id" name="label" data-width="100%">
                                        @foreach ($catalogProduct->getLabels() as $key => $value)
                                            <option value="{{ $key }}" {{ $catalogProduct->isSelectedLabel($key) ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @input(['name' => 'name', 'label' => 'Название', 'entity' => $catalogProduct])
                                @input(['name' => 'title', 'label' => 'Title', 'entity' => $catalogProduct])
                                @input(['name' => 'description', 'label' => 'Description', 'entity' => $catalogProduct])

                                @input(['name' => 'price', 'label' => 'Цена', 'entity' => $catalogProduct])

                                @input(['name' => 'alias', 'label' => 'Alias', 'entity' => $catalogProduct])

                                @textarea(['name' => 'text', 'label' => 'Текст', 'entity' => $catalogProduct])

                                @submit_btn()
                        </div>
                        <div class="tab-pane" id="image">
                            @if ($catalogProduct->image)
                                <div class="panel panel-flat border-blue border-xs" id="image__box">
                                    <div class="panel-body">
                                        <img src="{{ asset($catalogProduct->image->path) }}" alt="" class="upload__image">

                                        <div class="btn-group btn__actions">
                                            <button data-toggle="modal" data-target="#modal_info" type="button" class="btn btn-primary btn-labeled btn-sm"><b><i class="icon-pencil4"></i></b> Атрибуты</button>

                                            <button type="button" data-href="{{ route('admin.images.destroy', ['id' => $catalogProduct->image->id]) }}" class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">Удалить <b><i class="icon-trash"></i></b></button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @imageInput(['name' => 'image', 'type' => 'file', 'entity' => $catalogProduct, 'label' => 'Выберите изображение на компьютере'])
                            @submit_btn()
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if ($catalogProduct->image)
        @include('layouts.partials._image_attributes_popup', ['image' => $catalogProduct->image])
    @endif

    @push('scripts')
        <script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
    @endpush
@endsection
