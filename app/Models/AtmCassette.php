<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtmCassette extends Model
{
    use HasFactory;

    protected $fillable = [
        'atm_id',
        'denomination',
        'max_sheets',
        'current_sheets',
    ];
}
