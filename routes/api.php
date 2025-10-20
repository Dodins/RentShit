<?php

use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

Route::get('/hello', function(){
    return response()->json([
        'message' => 'hello'
    ]);
});


//test

Route::post('/add-unit', [UnitController::class,'addUnit']);
