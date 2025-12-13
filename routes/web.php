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

// Route::get('/cari', function () {
//     return view('cari');
// });

Route::get('/cari', function () {
    return view('cari');
})->name('cari');

// Route untuk menyimpan laporan (placeholder - perlu dibuat controller dan model)
Route::post('/laporan/store', function () {
    // TODO: Implementasi penyimpanan data ke database
    // Simulasi delay untuk proses penyimpanan
    // sleep(1);
    
    // Jika request AJAX, return JSON
    if (request()->ajax() || request()->wantsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil dikirim!'
        ]);
    }
    
    // Jika bukan AJAX, redirect dengan session message
    return redirect()->route('cari')->with('success', 'Laporan berhasil dikirim!');
})->name('laporan.store');
