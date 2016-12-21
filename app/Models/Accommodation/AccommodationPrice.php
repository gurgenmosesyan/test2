<?php

namespace App\Models\Accommodation;

use App\Core\Model;

class AccommodationPrice extends Model
{
    protected $table = 'accommodation_prices';

    public $timestamps = false;

    protected $fillable = [
        'accommodation_id',
        'start_date',
        'end_date',
        'price',
    ];
}