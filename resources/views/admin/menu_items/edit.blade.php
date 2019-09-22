@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.menus.index') }}">Навигация</a></li>
    <li><a href="{{ route('admin.menu_items.index', $menuItem->menu_id) }}">Список пунктов меню</a></li>
    <li class="active">Форма редактирования пункта меню</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования пункта меню</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.menu_items.update', $menuItem) }}" method="post">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="parent_id">Выберите родительский пункт меню</label>
                    <select class="form-control border-blue border-xs select-search" id="parent_id" name="parent_id" data-width="100%">
                        <option value="">Не выбрано</option>
                        @foreach($menuItems as $item)
                            <option value="{{ $item->id }}"  @if ( $item->id == old('parent_id', $menuItem->parent_id))selected="selected"@endif>{{ $item->name }}</option>
                            @foreach($item->menuItems as $itemChild)
                                <option value="{{ $itemChild->id }}"  @if ($itemChild->id == old('parent_id', $menuItem->parent_id))selected="selected"@endif>
                                    ** {{ $itemChild->name }}
                                </option>
                                @foreach($itemChild->menuItems as $itemSubChild)
                                    <option value="{{ $itemSubChild->id }}"  @if ($itemSubChild->id == old('parent_id', $menuItem->parent_id))selected="selected"@endif>
                                        **** {{ $itemSubChild->name }}
                                    </option>
                                @endforeach
                            @endforeach
                        @endforeach
                    </select>
                </div>

                @input(['name' => 'name', 'entity' => $menuItem, 'label' => 'Название'])
                @selectLink(['name' => 'link', 'entity' => $menuItem, 'label' => 'Ссылка'])
                @submit_btn()

            </form>

        </div>
    </div>
@push('scripts')
<script src="{{ asset('dashboard/assets/js/plugins/forms/selects/select2.min.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/pages/form_select2.js') }}" defer></script>
@endpush
@endsection