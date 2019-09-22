@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.galleries.index') }}">Фотогалерея</a></li>
    <li class="active">Форма добавления галереи</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления галереи</div>
            <div class="panel-body">

                @include('layouts.partials.errors')

                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="main">
                            <form action="{{ route('admin.galleries.store') }}" method="post">
                                @csrf

                                @input(['name' => 'name', 'label' => 'Название'])
                                {{--@checkbox(['name' => 'publish', 'label' => 'Опубликовано?', 'isChecked' => true])--}}

                                @submit_btn()
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection