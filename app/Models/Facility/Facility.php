<?php

namespace App\Models\Facility;

use App\Core\Model;

class Facility extends Model
{
    protected $table = 'facilities';

    public function ml()
    {
        return $this->hasMany(FacilityMl::class, 'id', 'id');
    }
}