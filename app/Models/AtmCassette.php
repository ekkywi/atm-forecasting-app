<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AtmCassette extends Model
{
    use HasFactory;

    protected $fillable = [
        'atm_id',
        'cassette_index',
        'denomination',
        'max_sheets'
    ];

    public function atm(): BelongsTo
    {
        return $this->belongsTo(Atm::class);
    }
}
