<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oders extends Model
{
    use HasFactory;
    protected $table = 'oders';
    protected $fillable = [
        'user_id',
        'oder_address_id',
        'shipping_price',
        'payment_status',
        'status',
        'total_order',
        'shipping_price',
        'total_order_not_shipping'
    ];
}
