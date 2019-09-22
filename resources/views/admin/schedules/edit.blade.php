@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.schedules.index') }}">Расписание</a></li>
    <li class="active">Форма редактирования расписания тура</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования расписания тура</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.schedules.update', ['id' => $schedule->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="main">
                            <div class="row">
                                <div class="col-md-12">

                                    @dateInput(['name' => 'date', 'label' => 'Дата для хронологии', 'entity' => $schedule])
                                    @input(['name' => 'date_string', 'label' => 'Дата', 'entity' => $schedule])
                                    @input(['name' => 'price', 'label' => 'Цена', 'entity' => $schedule])

                                    @textarea(['name' => 'body', 'label' => 'Описание тура', 'entity' => $schedule])

                                    @submit_btn()
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </div>

@push('scripts')
<script src="{{ asset('dashboard/assets/js/plugins/ui/moment/moment.min.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/plugins/pickers/daterangepicker.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/pages/picker_date.js') }}" defer></script>
<script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
@endpush
@endsection
