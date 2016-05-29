<?php

namespace App\Models\Homepage;

use App\Core\Model;

class Homepage extends Model
{
    const IMAGES_PATH = 'images/homepage';

    public $timestamps = false;

    protected $fillable = [];

    protected $table = 'homepage';

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