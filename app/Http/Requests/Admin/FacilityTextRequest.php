<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class FacilityTextRequest extends Request
{
    public function rules()
    {
        return [
            'ml' => 'ml',
            'ml.*.text' => 'max:65000'
        ];
    }
}