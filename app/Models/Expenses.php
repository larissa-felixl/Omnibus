<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $fillable = [
        'id',
        'driver_id',
        'vehicle_plate',
        'value',
        'proof_of_payment',
    ];
}
