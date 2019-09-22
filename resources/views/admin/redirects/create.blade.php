@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.redirects.index') }}">Редиректы</a></li>
    <li class="active">Форма добавления редиректа</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления редиректа</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.redirects.store') }}" method="post">
                @csrf

                @input(['name' => 'url_old', 'label' => 'Старый url'])
                @input(['name' => 'url_new', 'label' => 'Новый url'])

                @submit_btn()
            </form>

        </div>
    </div>
@endsection