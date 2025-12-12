<?php

use Illuminate\Support\Facades\Route;

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
