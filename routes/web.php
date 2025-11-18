<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class,'index']);
Route::get('/admin', [HomeController::class, 'adminDashboard']);
Route::get('/login', [AuthController::class,'index']);
Route::post('/login', [AuthController::class,'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class,'register']);
Route::post('/register', [AuthController::class,'registerPost']);

Route::prefix('/admin')->group(function(){
    // Use resource routes so create/edit pages are available for web forms
    Route::resource('category', CategoryController::class);
    Route::resource('book', BookController::class);
    Route::resource('borrow', BorrowController::class);
});

// Access denied page
Route::get('/access-denied', function(){
    return view('error.access_denided');
})->name('access.denied');