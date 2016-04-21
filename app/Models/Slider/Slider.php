<?php

namespace App\Models\Slider;

use App\Core\Model;

class Slider extends Model
{
    const IMAGES_PATH = 'images/slider';

    protected $table = 'slider';

    protected $fillable = [
        'category'
    ];

    public function getImage()
    {
        return url('/images/slider/'.$this->image);
    }

    public function getFile($column)
    {
        return $this->$column;
    }

    public function setFile($file, $column)
    {
        $this->attributes[$column] = $file;
    }

    public function getStorePath()
    {
        return self::IMAGES_PATH;
    }
}