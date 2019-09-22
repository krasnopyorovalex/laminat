@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Навигация</li>
@endsection

@section('content')

    <a href="{{ route('admin.menus.create') }}" type="button" class="btn bg-primary">
        Добавить
        <i class="icon-stack-plus position-right"></i>
    </a>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="border-solid">
                <th>#</th>
                <th>Название</th>
                <th>Системное имя</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($menus as $menu)
                <tr>
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>{{ $menu->name }}</td>
                    <td><span class="label label-primary">{{ $menu->sys_name }}</span></td>
                    <td>
                        <div>
                            <a href="{{ route('admin.menus.edit', $menu) }}"><i class="icon-pencil7"></i></a>
                            <a href="{{ route('admin.menu_items.index', ['parent' => $menu->id]) }}" data-original-title="Пункты меню" data-popup="tooltip"><i class="icon-lan2"></i></a>
                            <form method="POST" action="{{ route('admin.menus.destroy', $menu) }}" class="form__delete">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="last__btn">
                                    <i class="icon-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection