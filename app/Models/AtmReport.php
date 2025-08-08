<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AtmReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'atm_id',
        'problem_code',
        'reported_at'
    ];

    public function atm(): BelongsTo
    {
        return $this->belongsTo(Atm::class);
    }
    public function details(): HasMany
    {
        return $this->hasMany(AtmReportDetail::class);
    }
}
