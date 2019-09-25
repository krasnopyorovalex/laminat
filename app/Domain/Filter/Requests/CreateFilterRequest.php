<?php

namespace Domain\Filter\Requests;

use App\Http\Requests\Request;

/**
 * Class AddToCartRequest
 * @package Domain\Filter\Requests
 */
class CreateFilterRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|string|max:255',
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
