<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingsGoal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'target_amount',
        'current_amount',
        'target_date',
        'description',
        'status'
    ];

    protected $casts = [
        'target_date' => 'date',
        'target_amount' => 'decimal:2',
        'current_amount' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getProgressPercentageAttribute()
    {
        if ($this->target_amount <= 0) return 0;
        return min(100, round(($this->current_amount / $this->target_amount) * 100));
    }

    public function getRemainingAmountAttribute()
    {
        return max(0, $this->target_amount - $this->current_amount);
    }

    public function getDaysRemainingAttribute()
    {
        if (!$this->target_date) return null;
        return now()->diffInDays($this->target_date, false);
    }
}