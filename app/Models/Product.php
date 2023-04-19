<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'category_id',
        'user_id',
        'price',
        'description',
        'discountpercentage',
        'rating',
        'stock',
        'sold',
        'band',
        'thumbnail',
        'slug'
    ];

    public function size()
    {
        return $this->hasMany(Size::class , 'product_id');
    }
    public function color()
    {
        return $this->hasMany(Color::class , 'product_id');
    }
}
