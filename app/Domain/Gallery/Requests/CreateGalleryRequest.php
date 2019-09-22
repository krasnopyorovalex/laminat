<?php

namespace Domain\Gallery\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateGalleryRequest
 * @package Domain\Gallery\Requests
 */
class CreateGalleryRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'bail|required|max:255'
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
            'name.required' => 'Поле «Название» обязательно для заполнения'
        ];
    }
}