<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::apiResource('drivers', App\Http\Controllers\DriversController::class);
    Route::apiResource('expenses', App\Http\Controllers\ExpensesController::class);
    Route::apiResource('spending-limits', App\Http\Controllers\SpendingLimitController::class);
});