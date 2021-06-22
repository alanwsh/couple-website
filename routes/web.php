<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TriEController;

Route::get('/',[HomeController::class,'index']);
Route::post('/login-auth',[HomeController::class,'login']);
Route::get('/dashboard',[HomeController::class,'dashboard']);
Route::get('/main',[HomeController::class,'main']);
Route::get('/api',[ApiController::class,'index']);
Route::post('/imgupload',[HomeController::class,'upload_media']);
Route::get('/product',[HomeController::class,'load_product']);
Route::post('/delete_product',[HomeController::class,'delete_product']);
Route::post('/todo/delete/{id}',[TodoController::class,'todo_delete']);
Route::post('/todo/complete/{id}/{date}',[TodoController::class,'todo_complete']);
Route::post('/todo/category/{name}/{desc}/{icon}',[TodoController::class,'add_category']);
Route::post('/todo/addtodo/{name}/{desc}/{category}/{deadline}',[TodoController::class,'add_todo']);
Route::post('/todo/edittodo/{id}/{name}/{desc}/{category}/{deadline}',[TodoController::class,'edit_todo']);
Route::get('/trie',[TriEController::class,'index']);
Route::post('/trie/generate',[TriEController::class,'generate']);
