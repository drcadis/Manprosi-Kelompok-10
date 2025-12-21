<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LostItemController;
// use App\Http\Controllers\FoundItemController; // <-- Controller teman (belum ada)

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. AUTHENTICATION
// ==========================================
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showDashboard'])->name('login.form');
Route::get('/register', [AuthController::class, 'showDashboard'])->name('register.form');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================
// 2. HALAMAN UTAMA & UMUM
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');

// PERBAIKAN 1: Nama route diganti jadi 'cari' (bukan cari.index) agar welcome.blade.php tidak error
Route::get('/cari', function () {
    $kategori = \App\Models\Kategori::all();
    return view('cari', compact('kategori'));
})->name('cari'); 

Route::get('/detail/{id}', [ItemController::class, 'show'])->name('detail');
Route::get('/semua-barang', [ItemController::class, 'getAll'])->name('semua.barang');
Route::post('/cari', [ItemController::class, 'store'])->name('items.store'); 

// ==========================================
// 3. FITUR "MENCARI BARANG" (ANDA)
// ==========================================
Route::prefix('kehilangan')->name('lost.')->group(function () {
    Route::get('/', [LostItemController::class, 'index'])->name('index');       
    Route::get('/lapor', [LostItemController::class, 'create'])->name('create'); 
    Route::post('/store', [LostItemController::class, 'store'])->name('store');  
});

// ==========================================
// 4. FITUR "MENEMUKAN BARANG" (TEMAN)
// ==========================================
// PERBAIKAN 2: Kita buat route DUMMY (Palsu) dulu agar tidak error "Route not defined"
// Nanti kalau teman sudah bikin controller, baru ganti baris ini.
Route::post('/penemuan/store', function() {
    return "Fitur Penemuan Barang (Milik Teman) belum aktif.";
})->name('found.store');

// ==========================================
// 5. ADMIN (MENGELOLA DATA)
// ==========================================

// Group Route Admin (Bisa dimasukkan ke middleware auth nantinya)
Route::prefix('admin')->name('admin.')->group(function () {
    
    // 1. DASHBOARD ADMIN
    // Mengambil data real dari database agar tabel tidak kosong
    Route::get('/', function () {
        $allItems = \App\Models\Items::latest()->get(); 
        return view('admin', compact('allItems'));
    })->name('index'); // URL: /admin

    // 2. FORM EDIT
    // Mengarah ke LostItemController function edit
    Route::get('/edit/{id}', [LostItemController::class, 'edit'])->name('edit');

    // 3. PROSES UPDATE
    // Mengarah ke LostItemController function update
    Route::put('/update/{id}', [LostItemController::class, 'update'])->name('update');

    // 4. PROSES DELETE
    // Mengarah ke LostItemController function destroy
    Route::delete('/delete/{id}', [LostItemController::class, 'destroy'])->name('delete');
    
    // 5. Update Status (Opsional/AJAX)
    Route::post('/update-status', function () {
        return response()->json(['success' => true, 'message' => 'Status berhasil diupdate!']);
    })->name('update-status');
});

// Route Placeholder Laporan & Testimonial (Biarkan jika masih dipakai)
Route::post('/laporan/store', function () {
    if (request()->ajax() || request()->wantsJson()) {
        return response()->json(['success' => true, 'message' => 'Laporan berhasil dikirim!']);
    }
    return redirect()->route('cari')->with('success', 'Laporan berhasil dikirim!');
})->name('laporan.store');

Route::post('/testimonial/store', function () {
    if (request()->ajax() || request()->wantsJson()) {
        return response()->json(['success' => true, 'message' => 'Testimonial berhasil dikirim!']);
    }
    return redirect()->back()->with('success', 'Testimonial berhasil dikirim!');
})->name('testimonial.store');