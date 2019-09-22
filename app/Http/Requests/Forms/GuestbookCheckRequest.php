<?php

namespace App\Http\Requests\Forms;

use App\Http\Requests\Request;

/**
 * Class GuestbookCheckRequest
 * @package App\Http\Requests\Forms
 */
class GuestbookCheckRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3',
            'email' => 'email|nullable',
            'text' => 'required|string'
        ];
    }
}
