@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.menus.index') }}">Навигация</a></li>
    <li class="active">Форма добавления меню</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления меню</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.menus.store') }}" method="post">
                @csrf

                @input(['name' => 'name', 'label' => 'Название'])
                @input(['name' => 'sys_name', 'label' => 'Системное имя'])

                @submit_btn()
            </form>

        </div>
    </div>

@endsection