<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\lookController;

Route::get('/lapor-hilang', [ItemController::class, 'create'])->name('lapor.create');
Route::post('/lapor-hilang', [ItemController::class, 'store'])->name('lapor.store');
Route::get('/lihat-barang', [lookController::class, 'index'])->name('lihat.barang');
Route::get('/lihat-barang/{id}', [lookController::class, 'show'])->name('lihat.barang.detail');
Route::get('/', function () {
    return view('welcome');
});
