<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\lookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showDashboard'])->name('login.form');
Route::get('/register', [AuthController::class, 'showDashboard'])->name('register.form');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/cari', [ItemController::class, 'create'])->name('cari');
Route::post('/cari', [ItemController::class, 'store'])->name('items.store');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/items/{id}', [ItemController::class, 'show'])->name('items.show');

Route::middleware(['auth', 'role:admin'])->group(function () {
    
});



// Route utama (Pastikan method POST)
Route::post('/verification/claim', [VerificationController::class, 'store'])->name('verification.claim');

// Route update (Pastikan method PUT)
Route::put('/verification/approve/{id}', [VerificationController::class, 'update'])->name('verification.approve');
