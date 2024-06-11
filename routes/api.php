<?php

use App\Http\Controllers\ShiftController;
use App\Http\Middleware\AuthApiKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public Route
Route::get('/shifts', [ShiftController::class, 'index']);

// Protected Routes
Route::middleware([AuthApiKey::class])->group(function (){
    Route::post('/shifts/create', [ShiftController::class, 'store']);
});