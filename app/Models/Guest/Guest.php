<?php

namespace App\Models\Guest;

use App\Core\Model;

class Guest extends Model
{
    const IMAGES_PATH = 'images/guest';

    protected $table = 'guests';

    public function ml()
    {
        return $this->hasMany(GuestMl::class, 'id', 'id');
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