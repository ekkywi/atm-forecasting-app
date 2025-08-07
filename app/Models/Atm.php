<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Atm extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $fillable = [
        'atm_id',
        'location_name',
        'address',
        'latitude',
        'longitude',
        'status',
        'max_capacity_100k',
        'max_capacity_50k',
    ];
}
