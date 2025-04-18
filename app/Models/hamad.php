<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hamad extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'father_name',
        'email',
        'address',
        'city',
        'password',
        'age',
    ];
}

