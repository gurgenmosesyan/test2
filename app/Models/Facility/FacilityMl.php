<?php

namespace App\Models\Facility;

use App\Core\Model;

class FacilityMl extends Model
{
    protected $table = 'facilities_ml';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'lng_id',
        'title',
        'text'
    ];
}