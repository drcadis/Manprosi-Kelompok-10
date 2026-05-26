<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\lookController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// CRUD Verifikasi Pemilik (Klaim)
Route::prefix('verifikasi')->group(function () {
    Route::get('/', [\App\Http\Controllers\VerificationController::class, 'index']);
    Route::post('/klaim', [\App\Http\Controllers\VerificationController::class, 'store']);
    Route::put('/update/{id}', [\App\Http\Controllers\VerificationController::class, 'update']);
    Route::delete('/delete/{id}', [\App\Http\Controllers\VerificationController::class, 'destroy']);
});
