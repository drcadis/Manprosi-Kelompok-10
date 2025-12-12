<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\lookController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route untuk melihat barang hilang
Route::get('/melihat-barang', [lookController::class, 'index']);
Route::get('/melihat-barang/{id}', [lookController::class, 'show']);