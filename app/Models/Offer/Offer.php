<?php

namespace App\Models\Offer;

use App\Core\Model;

class Offer extends Model
{
    const IMAGES_PATH = 'images/offer';

    protected $fillable = [
        'sort_order'
    ];

    protected $table = 'offers';

    public function scopeJoinMl($query)
    {
        return $query->join('offers_ml as ml', function($query) {
            $query->on('ml.id', '=', 'offers.id')->where('ml.lng_id', '=', cLng('id'));
        });
    }

    public function ml()
    {
        return $this->hasMany(OfferMl::class, 'id', 'id');
    }

    public function images()
    {
        return $this->hasMany(OfferImage::class, 'offer_id', 'id')->active();
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