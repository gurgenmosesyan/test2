<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use App\Models\Accommodation\Accommodation;

class AccommodationRequest extends Request
{
    public function rules()
    {
        return [
            'price' => 'required|integer',
            'room_size' => 'required|numeric',
            'extra_bed' => 'in:'.Accommodation::EXTRA_BED_NO.','.Accommodation::EXTRA_BED_YES,
            'extra_bed_price' => 'required_with:extra_bed|integer',
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