<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class AccommodationRequest extends Request
{
    public function rules()
    {
        return [
            'price' => 'required|integer',
            'room_size' => 'required|numeric',
            'ml' => 'ml',
            'ml.*.title' => 'required|max:255',
            'ml.*.text' => 'required|max:65000',
            'ml.*.bed_type' => 'required|max:255',
            'images' => 'array',
            'images.*.id' => 'integer',
            'images.*.image' => 'required|core_image',
            'ml.*.facilities' => 'array',
            'ml.*.facilities.*.title' => 'required|max:255'
        ];
    }
}