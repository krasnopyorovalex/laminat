@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.catalogs.index') }}">Категории каталога</a></li>
    <li><a href="{{ route('admin.catalog_products.index', $catalog) }}">Список товаров</a></li>
    <li class="active">Форма добавления товара</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления товара</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.catalog_products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="catalog_id" value="{{ $catalog }}">

                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                        <li><a href="#filters" data-toggle="tab">Фильтры</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="main">

                            <div class="form-group">
                                <label for="label">Метка:</label>
                                <select class="form-control border-blue border-xs select-search" id="slider_id" name="label" data-width="100%">
                                    @foreach ($labels as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @input(['name' => 'name', 'label' => 'Название'])
                            @input(['name' => 'title', 'label' => 'Title'])
                            @input(['name' => 'description', 'label' => 'Description'])

                            @input(['name' => 'price', 'label' => 'Цена', 'defaultValue' => 0])

                            @input(['name' => 'alias', 'label' => 'Alias'])
                            @imageInput(['name' => 'image', 'type' => 'file', 'label' => 'Выберите изображение на компьютере'])
                            @textarea(['name' => 'text', 'label' => 'Текст'])

                            @submit_btn()
                        </div>
                        <div class="tab-pane" id="filters">
                            @if(count($filters))
                                <div class="row">
                                    @foreach($filters as $filter)
                                        <div class="col-md-3">
                                            @if(count($filter->filterOptions))
                                                <div class="form-group">
                                                    <label for="filter-{{ $filter->id  }}">{{ $filter->name }}:</label>
                                                    <select class="form-control border-blue border-xs select-search" id="filter-{{ $filter->id  }}" name="filters[{{ $filter->id }}]" data-width="100%">
                                                        <option value="">Не выбрано</option>
                                                        @foreach($filter->filterOptions as $filterOption)
                                                            <option value="{{ $filterOption->id }}">{{ $filterOption->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
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
