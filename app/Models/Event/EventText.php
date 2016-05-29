<?php

namespace App\Models\Event;

use App\Core\Model;

class EventText extends Model
{
    protected $table = 'events_text';

    public $timestamps = false;

    protected $fillable = [
        'lng_id',
        'text'
    ];
}