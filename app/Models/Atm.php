<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Atm extends Model
{
    use HasFactory, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $fillable = [
        'terminal_id',
        'location_name',
        'address',
        'latitude',
        'longitude',
        'status',
        'type',
    ];

    public function cassettes(): HasMany
    {
        return $this->hasMany(AtmCassette::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(AtmReport::class);
    }
}
