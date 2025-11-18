<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class,'index']);   
Route::get('/login', [AuthController::class,'index']);
Route::post('/login', [AuthController::class,'login']);
Route::get('/register', [AuthController::class,'register']);

Route::prefix('/admin')->group(function(){
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('book', BookController::class);
    Route::apiResource('borrow', BorrowController::class);
});