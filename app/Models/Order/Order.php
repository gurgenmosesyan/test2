<?php

namespace App\Models\Order;

use App\Core\Model;

class Order extends Model
{
    const TYPE_CASH = 'cash';
    const TYPE_AMERIA = 'ameria';

    protected $fillable = [
        'type',
        'accommodations',
        'price',
        'date_from',
        'date_to',
        'info',
        'phone',
        'email'
    ];

    protected $table = 'orders';
}