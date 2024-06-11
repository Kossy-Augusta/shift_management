<?php

use App\Http\Controllers\ShiftController;
use App\Http\Middleware\AuthApiKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware([AuthApiKey::class])->group(function (){
    Route::post('/shifts/create', [ShiftController::class, 'store']);
});