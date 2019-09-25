@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.filters.index') }}">Фильтры</a></li>
    <li class="active">Форма добавления категории фильтра</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления категории фильтра</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.filters.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-9">@input(['name' => 'name', 'label' => 'Название'])</div>
                    <div class="col-md-3">@input(['name' => 'pos', 'label' => 'Позиция'])</div>
                </div>

                @submit_btn()
            </form>

        </div>
    </div>
@endsection
