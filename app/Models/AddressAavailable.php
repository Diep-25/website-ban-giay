<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddressAavailable extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'address_available';
    protected $fillable = [
        'full_name',
        'phone_number',
        'specific_address',
        'user_id',
        'provinces_id',
        'districts_id',
        'wards_id',
    ];
    public function province()
    {
        return $this->belongsTo(Provinces::class,'provinces_id');
    }
    public function district()
    {
        return $this->belongsTo(Districts::class,'districts_id');
    }
    public function ward()
    {
        return $this->belongsTo(Wards::class,'wards_id');
    }
}
