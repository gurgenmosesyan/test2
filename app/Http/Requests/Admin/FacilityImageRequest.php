<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class FacilityImageRequest extends Request
{
    public function rules()
    {
        return [
            'images' => 'array',
            'images.*.id' => 'integer',
            'images.*.image' => 'required|core_image'
        ];
    }
}