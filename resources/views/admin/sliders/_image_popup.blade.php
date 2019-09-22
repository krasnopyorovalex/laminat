<form action="{{ route('admin.slider_images.update', ['id' => $image->id]) }}" method="post">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Метаданные изображения</h6>
            </div>
            <div class="modal-body">
                @csrf
                @method('put')

                @selectLink(['name' => 'link', 'entity' => $image, 'label' => 'Ссылка'])

                @input(['name' => 'sub', 'label' => 'Слоган', 'entity' => $image])
                @input(['name' => 'name', 'label' => 'Название', 'entity' => $image])
                @textarea(['name' => 'desc', 'label' => 'Описание', 'entity' => $image])
                @input(['name' => 'alt', 'label' => 'alt', 'entity' => $image])
                @input(['name' => 'title', 'label' => 'title', 'entity' => $image])

                {{--@checkbox(['name' => 'is_published', 'label' => 'Опубликовано?', 'entity' => $image])--}}
            </div>
            <div class="modal-footer">
                @submit_btn()
            </div>
        </div>
    </div>
</form>