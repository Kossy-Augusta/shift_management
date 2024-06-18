<?php

use Illuminate\Http\Request;
use App\Http\Middleware\AuthApiKey;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\ShiftStaffController;

// Public Route
Route::get('/shiftstaff', [ShiftStaffController::class, 'index'])->name('all_shiftstaff');

// Protected Routes
Route::middleware([AuthApiKey::class])->group(function (){
    Route::post('/shiftstaff/create', [ShiftStaffController::class, 'store'])->name('create');
    Route::put('/shiftstaff/{id}/update', [ShiftStaffController::class, 'update'])->name('update');
    Route::get('/shifts', [ShiftController::class, 'index'])->name('all_shifts');
});