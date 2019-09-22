<?php

namespace Domain\Menu\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateMenuRequest
 * @package Domain\Menu\Requests
 */
class CreateMenuRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'bail|required|max:64',
            'sys_name' => 'required|max:32|unique:menus'
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
            'sys_name.required'  => 'Поле «Системное имя» обязательно для заполнения',
            'sys_name.unique'  => 'Значение поля «Системное имя» уже присутствует в базе данных',
        ];
    }
}