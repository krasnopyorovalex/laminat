<?php

namespace Domain\GalleryImage\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class UpdateGalleryImageRequest
 * @package Domain\GalleryImage\Requests
 */
class UpdateGalleryImageRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'string|max:255|nullable',
            'alt' => 'string|max:255|nullable',
            'title' => 'string|max:255|nullable',
            'is_published' => Rule::in([0, 1])
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
            'name.required' => 'Поле «Название» обязательно для заполнения',
        ];
    }
}