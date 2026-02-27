<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

// Rotas públicas para motoristas (login)
Route::prefix('drivers')->group(function () {
    Route::post('/login', [App\Http\Controllers\DriverAuthController::class, 'login']);
});

// Rotas protegidas para motoristas (app mobile)
Route::middleware(['auth:sanctum'])->prefix('drivers')->group(function () {
    Route::get('/me', [App\Http\Controllers\DriverAuthController::class, 'me']);
    Route::post('/logout', [App\Http\Controllers\DriverAuthController::class, 'logout']);
    Route::post('/logout-all', [App\Http\Controllers\DriverAuthController::class, 'logoutAll']);
    
    // Rotas de despesas do motorista
    Route::apiResource('expenses', App\Http\Controllers\DriverExpensesController::class);
    Route::get('expenses-monthly-total', [App\Http\Controllers\DriverExpensesController::class, 'monthlyTotal']);
});

// Rotas protegidas para secretaria (web)

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::apiResource('drivers', App\Http\Controllers\DriversController::class);
    Route::apiResource('expenses', App\Http\Controllers\ExpensesController::class);
    Route::apiResource('spending-limits', App\Http\Controllers\SpendingLimitController::class);
});