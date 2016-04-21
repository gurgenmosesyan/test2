<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use App\Models\Slider\Slider;

class SliderRequest extends Request
{
    public function rules()
    {
        $categories = config('slider.categories');

        return [
            'category' => 'required|in:'.implode(',', $categories),
            'image' => 'required|core_image'
        ];
    }
}