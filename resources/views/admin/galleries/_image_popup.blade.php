<form action="{{ route('admin.gallery_images.update', ['id' => $image->id]) }}" method="post">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Метаданные изображения</h6>
            </div>
            <div class="modal-body">
                @csrf
                @method('put')

                @input(['name' => 'name', 'label' => 'Название', 'entity' => $image])
                @input(['name' => 'alt', 'label' => 'alt', 'entity' => $image])
                @input(['name' => 'title', 'label' => 'title', 'entity' => $image])

                @checkbox(['name' => 'is_published', 'label' => 'Опубликовано?', 'entity' => $image])
            </div>
            <div class="modal-footer">
                @submit_btn()
            </div>
        </div>
    </div>
</form>