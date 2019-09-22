@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.guestbooks.index') }}">Отзывы</a></li>
    <li class="active">Форма добавления отзыва</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления отзывва</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.guestbooks.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                @input(['name' => 'name', 'label' => 'Название'])
                @dateInput(['name' => 'published_at', 'label' => 'Дата публикации'])

                @textarea(['name' => 'text', 'label' => 'Текст'])
                @checkbox(['name' => 'is_published', 'label' => 'Опубликовано?', 'isChecked' => true])

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
