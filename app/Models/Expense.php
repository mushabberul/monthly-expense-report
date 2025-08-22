<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Expense extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'amount' => 'decimal:2',
        'date' => 'date'
    ];

    public function scopeAuth()
    {
        return $this->where('user_id', Auth::id());
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
