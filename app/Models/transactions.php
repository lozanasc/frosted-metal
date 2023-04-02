<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transactions extends Model
{
    use HasFactory;
    protected $fillable = [
        'tran_fname',
        'tran_lname',
        'tran_plan',
        'tran_type',
        'tran_amount',
    ];
}
