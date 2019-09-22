<?php

namespace Domain\Slider\Requests;

use App\Http\Requests\Request;

/**
 * Class UpdateSliderRequest
 * @package Domain\Page\Requests
 */
class UpdateSliderRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'bail|required|max:512'
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