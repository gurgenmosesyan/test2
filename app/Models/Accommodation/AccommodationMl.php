<?php

namespace App\Models\Accommodation;

use App\Core\Model;

class AccommodationMl extends Model
{
    protected $table = 'accommodations_ml';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'lng_id',
        'title',
        'text',
        'bed_type'
    ];
}