<?php

namespace Domain\FilterOption\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateFilterOptionRequest
 * @package Domain\FilterOption\Requests
 */
class CreateFilterOptionRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|max:255',
            'filter_id' => 'required|numeric|exists:filters,id',
            'pos' => 'integer'
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
