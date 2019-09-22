@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Категории каталога</li>
@endsection

@section('content')

    <a href="{{ route('admin.catalogs.create') }}" type="button" class="btn bg-primary">
        Добавить
        <i class="icon-stack-plus position-right"></i>
    </a>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="border-solid">
                <th>#</th>
                <th>Название</th>
                <th>Alias</th>
                <th>Обновлена</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @include('admin.catalogs._tr', ['catalogs' => $catalogs, 'prefix' => '', 'child' => false])
            </tbody>
        </table>
    </div>

@endsection