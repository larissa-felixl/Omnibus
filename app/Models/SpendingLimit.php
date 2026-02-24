<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpendingLimit extends Model
{
    protected $fillable = [
        'user_id',
        'month',
        'year',
        'limit_amount',
        'is_exceeded',
    ];
}
