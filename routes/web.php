<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerificationController;

Route::get('/', function () {
    return view('welcome');
});

// Route utama (Pastikan method POST)
Route::post('/verification/claim', [VerificationController::class, 'store'])->name('verification.claim');

// Route update (Pastikan method PUT)
Route::put('/verification/approve/{id}', [VerificationController::class, 'update'])->name('verification.approve');