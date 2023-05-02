<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    use HasFactory;
    protected $table = 'wards';
    protected $fillable = [
        'name',
        'code',
        'division_type',
        'codename',
        'district_code',
    ];
}
