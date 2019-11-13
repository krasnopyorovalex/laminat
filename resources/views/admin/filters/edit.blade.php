@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.filters.index') }}">Фильтры</a></li>
    <li class="active">Форма редактирования категории фильтра</li>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования категории фильтра</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.filters.update', ['id' => $filter->id]) }}" method="post">
                @csrf
                @method('put')

                <div class="row">
                    <div class="col-md-9">@input(['name' => 'name', 'label' => 'Название', 'entity' => $filter])</div>
                    <div class="col-md-3">@input(['name' => 'pos', 'label' => 'Позиция', 'entity' => $filter])</div>
                </div>

                @submit_btn()
            </form>

        </div>
    </div>
@endsection
