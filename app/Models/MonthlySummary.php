<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlySummary extends Model
{
    protected $fillable = [
        'unit_id',
        'year',
        'month',
        'paid_status',
        'rent_ammount',
        'water_prev_reading',
        'water_present_reading',
        'water_consumption',
        'water_charged',
        'elec_prev_reading',
        'elec_present_reading',
        'elec_consumption',
        'elec_charged',
        'charges_total',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
