<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOder extends Model
{
    use HasFactory;
    protected $table = 'product_oder';
    protected $fillable = [
        'oder_id',
        'product_id'
    ];
}
