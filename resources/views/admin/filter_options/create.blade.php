@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.filters.index') }}">Фильтры</a></li>
    <li><a href="{{ route('admin.filter_options.index', $filter) }}">Опции фильтра</a></li>
    <li class="active">Форма добавления опции</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления опции</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.filter_options.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="filter_id" value="{{ $filter->id }}">

                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="main">
                            @input(['name' => 'name', 'label' => 'Название'])
                            @input(['name' => 'pos', 'label' => 'Позиция'])
                            @submit_btn()
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
