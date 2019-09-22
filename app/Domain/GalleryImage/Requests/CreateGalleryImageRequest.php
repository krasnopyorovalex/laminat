<?php

namespace Domain\GalleryImage\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateGalleryImageRequest
 * @package Domain\GalleryImage\Requests
 */
class CreateGalleryImageRequest extends Request
{
    public function rules()
    {
        return [
            'upload' => 'image',
            'galleryId' => 'integer'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'upload.image' => 'Разрешено загружать только изображения',
            'galleryId.integer' => 'Поле «id галереи» должно быть целым числом'
        ];
    }
}