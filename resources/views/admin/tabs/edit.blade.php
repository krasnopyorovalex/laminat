@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.tabs.index') }}">Табы для товаров</a></li>
    <li class="active">Форма редактирования таба</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования таба</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.tabs.update', ['id' => $tab->id]) }}" method="post">
                @csrf
                @method('put')

                @input(['name' => 'name', 'label' => 'Название', 'entity' => $tab])

                @submit_btn()

            </form>

        </div>
    </div>
@endsection