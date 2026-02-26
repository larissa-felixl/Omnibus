<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expenses extends Model
{
    protected $fillable = [
        'driver_id',
        'vehicle_plate',
        'value',
        'proof_of_payment',
    ];

    /**
     * Relacionamento com Driver
     */
    public function driver(): BelongsTo
    {
        return $this->belongsTo(Drivers::class, 'driver_id');
    }
}
