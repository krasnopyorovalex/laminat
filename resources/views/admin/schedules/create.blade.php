@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.schedules.index') }}">Расписание</a></li>
    <li class="active">Форма добавления тура в расписание</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления тура в расписание</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.schedules.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                @input(['name' => 'price', 'label' => 'Цена'])
                @input(['name' => 'date_string', 'label' => 'Дата'])
                @dateInput(['name' => 'date', 'label' => 'Дата для хронологии'])

                @textarea(['name' => 'body', 'label' => 'Описание тура'])

                @submit_btn()
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
