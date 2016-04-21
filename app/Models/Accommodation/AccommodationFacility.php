<?php

namespace App\Models\Accommodation;

use App\Core\Model;

class AccommodationFacility extends Model
{
    protected $table = 'accommodation_facilities';

    public $timestamps = false;

    protected $fillable = [
        'accommodation_id',
        'lng_id',
        'title',
        'index'
    ];
}