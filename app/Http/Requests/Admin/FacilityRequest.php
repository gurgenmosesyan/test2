<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class FacilityRequest extends Request
{
    public function rules()
    {
        return [
            'ml' => 'ml',
            'ml.*.title' => 'required|max:255'
        ];
    }
}