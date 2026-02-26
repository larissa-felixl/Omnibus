<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpendingLimit extends Model
{
    protected $fillable = [
        'user_id',
        'limit_amount',
    ];

    protected $appends = ['is_exceeded', 'month', 'year'];

    /**
     * Relacionamento com User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Calcula se o limite foi excedido no mês de criação
     */
    public function getIsExceededAttribute(): bool
    {
        $month = $this->created_at->format('m');
        $year = $this->created_at->format('Y');
        
        // Soma todas as despesas do usuário no mesmo mês
        $totalExpenses = Expenses::whereHas('driver', function ($query) {
                $query->where('user_id', $this->user_id);
            })
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->sum('value');
        
        return $totalExpenses > $this->limit_amount;
    }

    /**
     * Accessor para retornar o mês
     */
    public function getMonthAttribute(): string
    {
        return $this->created_at->format('m');
    }

    /**
     * Accessor para retornar o ano
     */
    public function getYearAttribute(): string
    {
        return $this->created_at->format('Y');
    }
}
