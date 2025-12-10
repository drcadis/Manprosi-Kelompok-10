<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

Route::get('/lapor-hilang', [ItemController::class, 'create'])->name('lapor.create');
Route::post('/lapor-hilang', [ItemController::class, 'store'])->name('lapor.store');
Route::get('/', function () {
    return view('welcome');
});
