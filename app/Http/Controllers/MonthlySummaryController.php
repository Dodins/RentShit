<?php

namespace App\Http\Controllers;

use App\Models\MonthlySummary;
use App\Models\Unit;
use Illuminate\Http\Request;

class MonthlySummaryController extends Controller
{
    public function addMonthlyBill(Unit $unit, Request $request)
    {

        $validatedData = $request->validate([

            // data
            'year' => 'required|string|max:255',
            'month' => 'required|string|max:255',

            // ask if already paid
            'paid_status' => 'required|in:full,none',

            // bill previous/present
            'water_prev_reading' => 'required|numeric|min:0',
            'water_present_reading' => 'required|numeric|gte:water_prev_reading',
            'elec_prev_reading' => 'required|numeric|min:0',
            'elec_present_reading' => 'required|numeric|gte:elec_prev_reading',
        ]);

        $elecprevious = $validatedData['elec_prev_reading'];
        $elecpresent = $validatedData['elec_present_reading'];
        $waterprevious = $validatedData['water_prev_reading'];
        $waterpresent = $validatedData['water_present_reading'];
        $elec_consumption = $elecpresent - $elecprevious;
        $water_consumption = $waterpresent - $waterprevious;
        $rent_ammount = $validatedData['paid_status'] === 'none' ? 0 : $rent_ammount = $unit->monthly_rent;
        $elec_charged = $unit->electric_rate * $elec_consumption;
        $water_charged = $unit->water_rate * $water_consumption;
        $charges_total = $rent_ammount + $elec_charged + $water_charged;

        $data = MonthlySummary::create([
            'unit_id' => $unit->id,
            'year' => $validatedData['year'],
            'month' => $validatedData['month'],
            'paid_status' => $validatedData['paid_status'],
            'rent_ammount' => $rent_ammount,
            'water_prev_reading' => $validatedData['water_prev_reading'],
            'water_present_reading' => $validatedData['water_present_reading'],
            'water_consumption' => $water_consumption,
            'water_charged' => $water_charged,
            'elec_prev_reading' => $validatedData['elec_prev_reading'],
            'elec_present_reading' => $validatedData['elec_present_reading'],
            'elec_consumption' => $elec_consumption,
            'elec_charged' => $elec_charged,
            'charges_total' => $charges_total,

        ]);

        return response()->json([
            'message' => 'Added Successfully!',
            'data' => $data,
        ]);

    }
}
