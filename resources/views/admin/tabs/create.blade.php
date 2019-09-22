@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.tabs.index') }}">Табы для товаров</a></li>
    <li class="active">Форма добавления таба</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления таба</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.tabs.store') }}" method="post">
                @csrf

                @input(['name' => 'name', 'label' => 'Название'])

                @submit_btn()
            </form>

        </div>
    </div>

@endsection