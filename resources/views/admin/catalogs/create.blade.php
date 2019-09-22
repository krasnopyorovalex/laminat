@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.catalogs.index') }}">Категории каталога</a></li>
    <li class="active">Форма добавления категории</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления категории</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.catalogs.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="parent_id">Родительская категория</label>
                    <select class="form-control border-blue border-xs select-search" id="parent_id" name="parent_id" data-width="100%">
                        <option value="">Не выбрано</option>
                        {!! build_root_child_select($catalogs) !!}
                    </select>
                </div>

                @input(['name' => 'name', 'label' => 'Название'])
                @input(['name' => 'title', 'label' => 'Title'])
                @input(['name' => 'description', 'label' => 'Description'])
                @input(['name' => 'alias', 'label' => 'Alias'])

                @imageInput(['name' => 'image', 'type' => 'file', 'label' => 'Выберите изображение на компьютере'])

                @textarea(['name' => 'text', 'label' => 'Текст'])

                @submit_btn()
            </form>

        </div>
    </div>
@push('scripts')
<script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
@endpush
@endsection
