<?php

use App\Http\Controllers\API\CategoryServiceController;
use App\Http\Controllers\API\BookServiceController;
use Illuminate\Support\Facades\Route;

// Route::get('/book', [BookServiceController::class, 'index']);
// Route::get('/book/{id}', [BookServiceController::class, 'show']);
// Route::post('/book', [BookServiceController::class, 'store']);
// Route::put('/book/{id}', [BookServiceController::class, 'update']);
// Route::delete('/book/{id}', [BookServiceController::class, 'destroy']);

// Route::get('/category', [CategoryServiceController::class, 'index']);
// Route::get('/category/{id}', [CategoryServiceController::class, 'show']);
// Route::post('/category', [CategoryServiceController::class, 'store']);
// Route::put('/category/{id}', [CategoryServiceController::class, 'update']);
// Route::delete('/category/{id}', [CategoryServiceController::class, 'destroy']);

Route::apiResource('book', BookServiceController::class);
Route::apiResource('category', CategoryServiceController::class);