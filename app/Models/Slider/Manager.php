<?php

namespace App\Models\Slider;

use App\Core\Image\SaveImage;

class Manager
{
    public function store($data)
    {
        $slider = new Slider($data);
        SaveImage::save($data['image'], $slider);
        $slider->save();
    }

    public function update($id, $data)
    {
        $slider = Slider::findOrFail($id);
        SaveImage::save($data['image'], $slider);
        $slider->update($data);
    }

    public function delete($id)
    {
        Slider::where('id', $id)->delete();
    }
}