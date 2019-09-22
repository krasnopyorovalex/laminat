@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.menus.index') }}">Навигация</a></li>
    <li><a href="{{ route('admin.menu_items.index', $menu) }}">Список пунктов меню</a></li>
    <li class="active">Форма добавления пункта меню</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления пункта меню</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.menu_items.store') }}" method="post">
                @csrf
                <input type="hidden" name="menu_id" value="{{ $menu }}">

                <div class="form-group">
                    <label for="parent_id">Выберите родительский пункт меню</label>
                    <select class="form-control border-blue border-xs select-search" id="parent_id" name="parent_id" data-width="100%">
                        <option value="">Не выбрано</option>
                        @foreach($menuItems as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @foreach($item->menuItems as $itemChild)
                                <option value="{{ $itemChild->id }}">
                                    ** {{ $itemChild->name }}
                                </option>
                                @foreach($itemChild->menuItems as $itemSubChild)
                                    <option value="{{ $itemSubChild->id }}" >
                                        **** {{ $itemSubChild->name }}
                                    </option>
                                @endforeach
                            @endforeach
                        @endforeach
                    </select>
                </div>

                @input(['name' => 'name', 'label' => 'Название'])
                @selectLink(['name' => 'link', 'label' => 'Ссылка'])

                @submit_btn()
            </form>

        </div>
    </div>

@endsection