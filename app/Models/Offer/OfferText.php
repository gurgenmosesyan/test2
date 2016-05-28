<?php

namespace App\Models\Offer;

use App\Core\Model;

class OfferText extends Model
{
    protected $table = 'offers_text';

    public $timestamps = false;

    protected $fillable = [
        'lng_id',
        'text'
    ];
}