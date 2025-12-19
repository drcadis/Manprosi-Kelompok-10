<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\lookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showDashboard'])->name('login.form');
Route::get('/register', [AuthController::class, 'showDashboard'])->name('register.form');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/cari', [ItemController::class, 'create'])->name('cari');
Route::post('/cari', [ItemController::class, 'store'])->name('items.store');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/detail/{id}', [ItemController::class, 'show'])->name('detail');
Route::get('/semua-barang', [ItemController::class, 'getAll'])->name('semua.barang');

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Resource routes for kategori management (admin)
    Route::resource('kategori', KategoriController::class)->except(['show']);
});




Route::get('/admin', function () {
    return view('admin');
})->name('admin.index');

// Route untuk edit laporan (static untuk sementara)
Route::get('/admin/edit/{id}', function ($id) {
    return view('editLaporan', ['id' => $id]);
})->name('admin.edit');

// Route untuk update laporan (static untuk sementara)
Route::put('/admin/update/{id}', function ($id) {
    // TODO: Implementasi update ke database
    return redirect()->route('admin.index')->with('success', 'Laporan berhasil diupdate!');
})->name('admin.update');

// Route untuk delete laporan (static untuk sementara)
Route::delete('/admin/delete/{id}', function ($id) {
    // TODO: Implementasi delete dari database
    return response()->json(['success' => true, 'message' => 'Laporan berhasil dihapus!']);
})->name('admin.delete');

// Route untuk update status verifikasi (static untuk sementara)
Route::post('/admin/update-status', function () {
    // TODO: Implementasi update status verifikasi ke database
    return response()->json(['success' => true, 'message' => 'Status berhasil diupdate!']);
})->name('admin.update-status');

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


// Route untuk menyimpan testimonial (placeholder - perlu dibuat controller dan model)
Route::post('/testimonial/store', function () {
    // TODO: Implementasi penyimpanan testimonial ke database
    // 
    // PETUNJUK LENGKAP:
    // 1. Buat Model Testimonial dengan migration:
    //    php artisan make:model Testimonial -m
    // 
    // 2. Di migration, tambahkan kolom:
    //    - id (auto increment)
    //    - user_id (foreign key ke users)
    //    - nama (string)
    //    - role (string)
    //    - judul (string)
    //    - deskripsi (text)
    //    - created_at, updated_at
    //
    // 3. Di TestimonialController@store:
    //    public function store(Request $request) {
    //      $request->validate([
    //        'judul' => 'required|string|max:255',
    //        'deskripsi' => 'required|string|max:1000',
    //      ]);
    //      
    //      $user = Auth::user();
    //      
    //      Testimonial::create([
    //        'user_id' => $user->id,
    //        'nama' => $user->name,
    //        'role' => $user->role ?? 'Mahasiswa',
    //        'judul' => $request->judul,
    //        'deskripsi' => $request->deskripsi,
    //      ]);
    //      
    //      return response()->json(['success' => true, 'message' => 'Testimonial berhasil dikirim!']);
    //    }
    
    // Simulasi untuk sementara
    if (request()->ajax() || request()->wantsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Testimonial berhasil dikirim! Terima kasih.'
        ]);
    }
    
    return redirect()->back()->with('success', 'Testimonial berhasil dikirim!');
})->name('testimonial.store');

