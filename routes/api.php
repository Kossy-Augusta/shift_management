<?php

use App\Http\Middleware\AuthApiKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware([AuthApiKey::class])->group(function (){

});