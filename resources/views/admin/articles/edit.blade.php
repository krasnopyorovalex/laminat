@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.articles.index') }}">Статьи</a></li>
    <li class="active">Форма редактирования статьи</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования статьи</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.articles.update', ['id' => $article->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                        <li><a href="#image" data-toggle="tab">Изображение</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="main">
                            <div class="row">
                                <div class="col-md-12">
                                    @input(['name' => 'name', 'label' => 'Название', 'entity' => $article])
                                    @input(['name' => 'title', 'label' => 'Title', 'entity' => $article])
                                    @input(['name' => 'description', 'label' => 'Description', 'entity' => $article])
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    @input(['name' => 'alias', 'label' => 'Alias', 'entity' => $article])
                                </div>
                                <div class="col-md-3">
                                    @dateInput(['name' => 'published_at', 'label' => 'Дата публикации', 'entity' => $article])
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    @textarea(['name' => 'preview', 'label' => 'Превью статьи', 'id' => 'editor-full2', 'entity' => $article])
                                    @textarea(['name' => 'text', 'label' => 'Текст', 'entity' => $article])
                                    @checkbox(['name' => 'is_published', 'label' => 'Опубликовано?', 'entity' => $article])

                                    @submit_btn()
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="image">
                            @if ($article->image)
                                <div class="panel panel-flat border-blue border-xs" id="image__box">
                                    <div class="panel-body">
                                        <img src="{{ asset($article->image->path) }}" alt="" class="upload__image">

                                        <div class="btn-group btn__actions">
                                            <button data-toggle="modal" data-target="#modal_info" type="button" class="btn btn-primary btn-labeled btn-sm"><b><i class="icon-pencil4"></i></b> Атрибуты</button>

                                            <button type="button" data-href="{{ route('admin.images.destroy', ['id' => $article->image->id]) }}" class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">Удалить <b><i class="icon-trash"></i></b></button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @imageInput(['name' => 'image', 'type' => 'file', 'entity' => $article, 'label' => 'Выберите изображение на компьютере'])
                            @submit_btn()
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    @if ($article->image)
        @include('layouts.partials._image_attributes_popup', ['image' => $article->image])
    @endif

@push('scripts')
<script src="{{ asset('dashboard/assets/js/plugins/ui/moment/moment.min.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/plugins/pickers/daterangepicker.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/pages/picker_date.js') }}" defer></script>
<script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
@endpush
@endsection