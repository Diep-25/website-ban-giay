<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    use HasFactory;
    protected $table = 'provinces';
    protected $fillable = [
        'name',
        'code',
        'division_type',
        'codename',
        'phone_code',
    ];
}
