<?php

namespace App\Http\Requests\Forms;

use App\Http\Requests\Request;
use App\Rules\CatalogProductRule;

/**
 * Class OrderCheckRequest
 * @package App\Http\Requests\Forms
 */
class OrderCheckRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3',
            'phone' => 'required|string|min:5',
            'product' => ['required', 'string', new CatalogProductRule],
        ];
    }
}
