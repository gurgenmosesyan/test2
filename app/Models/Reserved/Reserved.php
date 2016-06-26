<?php

namespace App\Models\Reserved;

use App\Core\Model;

class Reserved extends Model
{
    protected $fillable = [
        'accommodation_id',
        'room_quantity',
        'date_from',
        'date_to'
    ];

    protected $table = 'reserved';
}