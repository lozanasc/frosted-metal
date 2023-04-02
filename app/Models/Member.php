<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'fname',
        'lname',
        'address',
        'sex',
        'DOB',
        'plan',
        'type',
        'image',
        'age',
        'mobilenum',
        'email',
        'password',
    ];
}
