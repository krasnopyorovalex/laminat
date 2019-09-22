<?php

namespace Domain\CatalogProduct\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class UpdateCatalogProductRequest
 * @package Domain\CatalogProduct\Requests
 */
class UpdateCatalogProductRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|max:512',
            'price' => 'integer|max:16777215',
            'label' => 'string|max:16|nullable',
            'title' => 'required|max:512',
            'description' => 'max:512|nullable',
            'text' => 'string|nullable',
            'pos' => 'integer|min:0|max:255',
            'alias' => [
                'required',
                'max:255',
                Rule::unique('catalog_products')->ignore($this->id)
            ]
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
            'name.required' => 'Поле «Название» обязательно для заполнения',
            'title.required' => 'Поле «Title» обязательно для заполнения',
            'text.required' => 'Поле «Текст» обязательно для заполнения',
            'alias.required' => 'Поле «Alias» обязательно для заполнения',
            'alias.unique' => 'Значение поля «Alias» уже присутствует в базе данных',
        ];
    }
}
