<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OderAddress extends Model
{
    use HasFactory;
    protected $table = 'oder_address';
    protected $fillable = [
        'full_name',
        'phone_number',
        'address',
        'note'
    ];
}
