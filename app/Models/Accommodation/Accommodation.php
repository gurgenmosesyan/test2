<?php

namespace App\Models\Accommodation;

use App\Core\Model;

class Accommodation extends Model
{
    const IMAGES_PATH = 'images/accommodation';
    const EXTRA_BED_YES = '1';
    const EXTRA_BED_NO = '0';

    protected $fillable = [
        'price',
        'room_size',
        'extra_bed',
        'extra_bed_price',
        'sort_order'
    ];

    protected $table = 'accommodations';

    public function scopeJoinMl($query)
    {
        return $query->join('accommodations_ml as ml', function($query) {
            $query->on('ml.id', '=', 'accommodations.id')->where('ml.lng_id', '=', cLng('id'));
        });
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('accommodations.sort_order', 'asc');
    }

    public function ml()
    {
        return $this->hasMany(AccommodationMl::class, 'id', 'id');
    }

    public function facilities()
    {
        return $this->hasMany(AccommodationFacility::class, 'accommodation_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(AccommodationImage::class, 'accommodation_id', 'id')->active();
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