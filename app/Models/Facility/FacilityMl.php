<?php

namespace App\Models\Facility;

use App\Core\Model;

class FacilityMl extends Model
{
    protected $table = 'facilities_ml';

    public $timestamps = false;

    protected $fillable = [
        'lng_id',
        'title'
    ];

    public function scopeCurrent($query)
    {
        return $query->where('lng_id', cLng('id'));
    }
}