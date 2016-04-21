<?php

namespace App\Models\Facility;

use App\Core\Model;

class FacilityText extends Model
{
    protected $table = 'facility_text';

    public $timestamps = false;

    protected $fillable = [
        'lng_id',
        'text'
    ];

    public function scopeCurrent($query)
    {
        return $query->where('lng_id', cLng('id'));
    }
}