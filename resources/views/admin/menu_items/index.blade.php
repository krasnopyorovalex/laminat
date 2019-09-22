@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.menus.index') }}">Навигация</a></li>
    <li class="active">Форма пункта меню</li>
@endsection

@section('content')

    <a href="{{ route('admin.menu_items.create', ['menu' => $menu]) }}" type="button" class="btn bg-primary">
        Добавить
        <i class="icon-stack-plus position-right"></i>
    </a>

    <div class="navigation_box">
        @include('admin.menu_items._list', ['menuItems' => $menuItems])
    </div>
@push('css')
<link type="text/css" href="{{ asset('dashboard/assets/css/jquery-ui.min.css') }}" rel="stylesheet" />
@endpush
@push('scripts')
<script src="{{ asset('dashboard/assets/js/menu/jquery-ui.min.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/menu/jquery.mjs.nestedSortable.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/menu/client_actions_nestedSortable.js') }}" defer></script>
@endpush
@endsection