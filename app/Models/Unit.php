<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'unit_name',
        'tenant_name',
        'tenant_phone',
        'water_rate',
        'electric_rate',
        'monthly_rent',
        'status',
    ];
}
