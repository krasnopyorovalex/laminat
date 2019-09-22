@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.redirects.index') }}">Редиректы</a></li>
    <li class="active">Форма редактирования редиректа</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования редиректа</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.redirects.update', ['id' => $redirect->id]) }}" method="post">
                @csrf
                @method('put')

                @input(['name' => 'url_old', 'label' => 'Старый урл', 'entity' => $redirect])
                @input(['name' => 'url_new', 'label' => 'Новый урл', 'entity' => $redirect])

                @submit_btn()
            </form>

        </div>
    </div>

@endsection