<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LostItemController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\AdminController;
// use App\Http\Controllers\FoundItemController; // <-- Controller yg(belum ada)

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
Route::delete('/delete', [AuthController::class, 'delete'])->name('delete')->middleware('auth');
Route::get('/cari', [ItemController::class, 'create'])->name('cari');
Route::post('/cari', [ItemController::class, 'store'])->name('items.store');
Route::get('/', [HomeController::class, 'index'])->name('home');

// PERBAIKAN 1: Nama route diganti jadi 'cari' (bukan cari.index) agar welcome.blade.php gak error
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

Route::get('/forgot', [ForgotController::class, 'showForgot'])->name('password.request');
Route::post('/forgot', [ForgotController::class, 'sendReset'])->name('password.email');

Route::get('/reset/{token}', [ForgotController::class, 'showReset'])->name('password.reset');
Route::post('/reset', [ForgotController::class, 'reset'])->name('password.update');

// ==========================================
// 4. FITUR "MENEMUKAN BARANG" (TEMAN)
// ==========================================
Route::prefix('penemuan')->name('found.')->group(function () {
    Route::post('/store', [LostItemController::class, 'store'])->name('store');
});

// ==========================================
// 5. ADMIN (MENGELOLA DATA)
// ==========================================

// Group Route Admin dengan middleware auth dan role:admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // 1. DASHBOARD ADMIN
    // Mengambil data real dari database agar tabel tidak kosong
    Route::get('/', function () {
        $allItems = \App\Models\Items::latest()->get();
        $testimonials = \Illuminate\Support\Facades\DB::table('testimonials')->latest()->get();
        return view('admin', compact('allItems', 'testimonials'));
    })->name('index'); // URL: /admin
    Route::get('/feedback', function () {
        $allItems = collect(); // ⬅️ KUNCI: agar blade tidak error
        $testimonials = \Illuminate\Support\Facades\DB::table('testimonials')->latest()->get();
        return view('admin', compact('allItems', 'testimonials'));
    })->name('feedback');

    // Route::get('/', [AdminController::class, 'laporan'])->name('laporan');
    // Route::get('/feedback', [AdminController::class, 'feedback'])->name('feedback');

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

    // 6. KATEGORI MANAGEMENT
    Route::resource('kategori', KategoriController::class)->except(['show']);
});

// Route Placeholder Laporan & Testimonial (Biarkan jika masih dipakai)
Route::post('/laporan/store', function () {
    if (request()->ajax() || request()->wantsJson()) {
        return response()->json(['success' => true, 'message' => 'Laporan berhasil dikirim!']);
    }
    return redirect()->route('cari')->with('success', 'Laporan berhasil dikirim!');
})->name('laporan.store');

// TESTIMONIAL CRUD (ADMIN & PUBLIC)
// TESTIMONIAL CRUD - PROTECTED BY AUTH & ROLE
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::put('/testimonial/update/{id}', [App\Http\Controllers\TestimonialController::class, 'update'])->name('testimonial.update');
    Route::delete('/testimonial/delete/{id}', [App\Http\Controllers\TestimonialController::class, 'destroy'])->name('testimonial.destroy');
});

// TESTIMONIAL STORE - PUBLIC (any user can submit)
Route::post('/testimonial/store', [App\Http\Controllers\TestimonialController::class, 'store'])->name('testimonial.store');