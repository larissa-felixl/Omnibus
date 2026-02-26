<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Drivers extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'license_number',
        'phone_number',
        'email',
        'password',
    ];

    /**
     * Relacionamento com User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relacionamento com Expenses
     */
    public function expenses(): HasMany
    {
        return $this->hasMany(Expenses::class, 'driver_id');
    }
}
