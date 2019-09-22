<?php

namespace Domain\Catalog\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class UpdateCatalogRequest
 * @package Domain\Catalog\Requests
 */
class UpdateCatalogRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|string|required|max:512',
            'title' => 'required|string|max:512',
            'description' => 'max:512|string|nullable',
            'text' => 'string|nullable',
            'parent_id' => 'numeric|exists:catalogs,id|nullable',
            'image' => 'image',
            'imageAlt' => 'string|max:255',
            'imageTitle' => 'string|max:255',
            'pos' => 'integer|min:0|max:255',
            'alias' => [
                'required',
                'string',
                'max:255',
                Rule::unique('catalogs')->ignore($this->id)
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
