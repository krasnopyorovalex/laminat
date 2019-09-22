<?php

namespace Domain\Redirect\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateRedirectRequest
 * @package Domain\Redirect\Requests
 */
class CreateRedirectRequest extends Request
{
    public function rules(): array
    {
        return [
            'url_old' => 'required|string|max:255',
            'url_new' => 'required|string|max:255',
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
            'url_old.required' => 'Поле «Старый url» обязательно для заполнения',
            'url_new.required'  => 'Поле «Новый url» обязательно для заполнения'
        ];
    }
}