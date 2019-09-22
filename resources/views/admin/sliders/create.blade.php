@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.sliders.index') }}">Слайдер</a></li>
    <li class="active">Форма добавления слайдера</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления слайдера</div>
            <div class="panel-body">

                @include('layouts.partials.errors')

                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="main">
                            <form action="{{ route('admin.sliders.store') }}" method="post">
                                @csrf

                                @input(['name' => 'name', 'label' => 'Название'])

                                @submit_btn()
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection