<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function addUnit(Request $request){
       $validatedData = $request->validate([
            'unit_name' => 'required|string|max:120',
            'tenant_name' => 'required|string|max:160',
            'tenant_phone' => ['required','string','max:11'],
            'water_rate' => 'required|numeric',
            'electric_rate' => 'required|numeric',
            'monthly_rent' => 'required|numeric',
            'status' => 'required|in:active,inactive',
        ]);

       $units =  Unit::create($validatedData);

        return response()->json([
            'message' => 'Unit added successfulyl!',
            'data' => $units,
        ]);

    }
}
