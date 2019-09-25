<?php

namespace Domain\Filter\Requests;

use App\Http\Requests\Request;

/**
 * Class UpdateFilterRequest
 * @package Domain\Filter\Requests
 */
class UpdateFilterRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|string|required|max:255',
            'pos' => 'integer|min:0|max:255'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Поле «Название» обязательно для заполнения'
        ];
    }
}
