<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\HomeController;

Route::get('/',[HomeController::class,'index']);
Route::post('/login-auth',[HomeController::class,'login']);
Route::get('/dashboard',[HomeController::class,'dashboard']);
Route::get('/main',[HomeController::class,'main']);
Route::get('/api',[ApiController::class,'index']);
