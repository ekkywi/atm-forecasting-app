<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AtmStatus extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'atm_id',
        'sheets_out',
        'problem_code',
        'reported_at',
    ];

    // Relasi bahwa setiap status "milik" satu ATM
    public function atm(): BelongsTo
    {
        return $this->belongsTo(Atm::class);
    }
}
