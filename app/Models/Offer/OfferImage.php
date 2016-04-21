<?php

namespace App\Models\Offer;

use App\Core\Model;

class OfferImage extends Model
{
    const IMAGES_PATH = 'images/offer';

    protected $table = 'offer_images';

    public $timestamps = false;

    protected $fillable = [
        'show_status'
    ];

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