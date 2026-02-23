<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drivers extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'license_number',
        'phone_number',
        'email',
        'password',
    ];
}
