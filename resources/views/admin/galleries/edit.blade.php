@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.galleries.index') }}">Фотогалерея</a></li>
    <li class="active">Форма редактирования галереи</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования галереи</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <div class="tabbable">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                    <li><a href="#images" data-toggle="tab">Изображения</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="main">
                        <form action="{{ route('admin.galleries.update', ['id' => $gallery->id]) }}" method="post">
                            @csrf
                            @method('put')

                            @input(['name' => 'name', 'label' => 'Название', 'entity' => $gallery])
                            {{--@checkbox(['name' => 'is_published', 'label' => 'Опубликовано?', 'entity' => $gallery])--}}

                            @submit_btn()
                        </form>
                    </div>

                    <div class="tab-pane" id="images">
                        <form action="#" enctype="multipart/form-data" method="post">
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <input type="hidden" name="galleryId" value="{{ $gallery->id }}">
                                    <input type="hidden" name="uploadUrl" value="{{ route('admin.gallery_images.store', $gallery) }}">
                                    <input type="hidden" name="updatePositionUrl" value="{{ route('admin.gallery_images.update_positions') }}">
                                    <input type="file" class="file-input-ajax" multiple="multiple" name="upload" accept="image/*">
                                </div>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                        @if ($gallery->images)
                        <div id="_images_box">
                            @include('admin.galleries._images_box')
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="edit-image" class="modal fade"></div>
    @push('scripts')
        <script src="{{ asset('dashboard/assets/js/plugins/ui/dragula.min.js') }}" defer></script>
        <script src="{{ asset('dashboard/assets/js/pages/extension_dnd.js') }}" defer></script>
        <script src="{{ asset('dashboard/assets/js/plugins/uploaders/fileinput.min.js') }}" defer></script>
        <script src="{{ asset('dashboard/assets/js/pages/uploader_bootstrap.js') }}" defer></script>
    @endpush
@endsection