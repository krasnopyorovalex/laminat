@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.guestbooks.index') }}">Отзывы</a></li>
    <li class="active">Форма редактирования отзыва</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования отзыва</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.guestbooks.update', ['id' => $guestbook->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="main">
                            <div class="row">
                                <div class="col-md-9">
                                    @input(['name' => 'name', 'label' => 'Название', 'entity' => $guestbook])
                                </div>
                                <div class="col-md-3">
                                    @dateInput(['name' => 'published_at', 'label' => 'Дата публикации', 'entity' => $guestbook])
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    @textarea(['name' => 'text', 'label' => 'Текст', 'entity' => $guestbook])
                                    @checkbox(['name' => 'is_published', 'label' => 'Опубликовано?', 'entity' => $guestbook])
                                    @submit_btn()
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    @if ($guestbook->image)
        @include('layouts.partials._image_attributes_popup', ['image' => $guestbook->image])
    @endif

@push('scripts')
<script src="{{ asset('dashboard/assets/js/plugins/ui/moment/moment.min.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/plugins/pickers/daterangepicker.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/pages/picker_date.js') }}" defer></script>
<script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
@endpush
@endsection
