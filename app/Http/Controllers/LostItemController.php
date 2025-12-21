<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Items;
use App\Models\Kategori;

class LostItemController extends Controller
{
    // MENAMPILKAN DATA KHUSUS "KEHILANGAN BARANG"
    public function index()
    {
    // Filter hanya mengambil data yang tipe_laporan-nya 'Kehilangan Barang'
    // UBAH NAMA VARIABEL DARI $items MENJADI $getAll
    $getAll = Items::with('kategori')
        ->where('tipe_laporan', 'Kehilangan Barang') 
        ->latest()
        ->paginate(12);

    // Kirim dengan nama 'getAll' agar cocok dengan view semuaBarang.blade.php
    return view('semuaBarang', compact('getAll'));
    }   

    // MENAMPILKAN FORM LAPOR KHUSUS "KEHILANGAN"
    public function create()
    {
        $kategori = Kategori::all();
        // Arahkan ke view khusus yang akan kita buat di Langkah 3
        return view('lost.create', compact('kategori')); 
    }

    // MENYIMPAN DATA (CREATE)
    public function store(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'nama'          => 'required|string|max:255',
            'no_telp'       => 'required|string|max:255',
            'nama_barang'   => 'required|string|max:255',
            'lokasi'        => 'required|string|max:255',
            'id_kategori'   => 'required|exists:kategori,id', // Pastikan nama tabel kategori benar
            'tanggal'       => 'required|date',
            'deskripsi'     => 'required|string',
            'foto_barang'   => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Upload Foto
        $pathFoto = null;
        if ($request->hasFile('foto_barang')) {
            $pathFoto = $request->file('foto_barang')->store('barang_hilang', 'public');
        }

        // SIMPAN KE DATABASE
        // Perhatikan: tipe_laporan kita paksa jadi 'Kehilangan Barang'
        Items::create([
            'nama'          => $request->nama,
            'no_telp'       => $request->no_telp,
            'nama_barang'   => $request->nama_barang,
            'foto_barang'   => $pathFoto,
            'lokasi'        => $request->lokasi,
            'tanggal'       => $request->tanggal,
            'id_kategori'   => $request->id_kategori,
            'deskripsi'     => $request->deskripsi,
            'tipe_laporan'  => 'Kehilangan Barang', // <--- HARDCODE DI SINI
            'status_barang' => 'Belum Ditemukan',
        ]);

        // Redirect ke halaman index khusus kehilangan
        return redirect()->route('lost.index')->with('success', 'Laporan kehilangan berhasil dibuat!');
    }

    // ==========================================
    // 3. EDIT (Menampilkan Form Edit)
    // ==========================================
    public function edit($id)
    {
        // Cari data berdasarkan ID, jika tidak ada error 404
        $item = Items::findOrFail($id);
        $kategori = Kategori::all();

        // Arahkan ke view edit (pastikan file editLaporan.blade.php ada)
        return view('editLaporan', compact('item', 'kategori'));
    }

    // ==========================================
    // 4. UPDATE (Menyimpan Perubahan)
    // ==========================================
    public function update(Request $request, $id)
    {
        // 1. Cari Barang
        $item = Items::findOrFail($id);

        // 2. Validasi (Kita buat nullable/optional dulu biar tidak mental)
        $validator = Validator::make($request->all(), [
            'nama'          => 'required|string', // Nama Pelapor
            'nama_barang'   => 'required|string',
            'lokasi'        => 'required|string',
            'status_barang' => 'required|string',
            'foto_barang'   => 'nullable|image|max:5048',
            // Field tambahan dari form (sesuaikan dengan nama di input form)
            'no_telp'       => 'nullable|string',
            'email'         => 'nullable|email',
            'fakultas'      => 'nullable|string',
            'program_studi' => 'nullable|string',
            'status_verifikasi' => 'nullable|string',
        ]);

        // Jika validasi gagal, kembalikan dengan error agar ketahuan
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validasi Gagal! Periksa inputan Anda.');
        }

        // 3. Cek Upload Foto Baru
        if ($request->hasFile('foto_barang')) {
            // Hapus foto lama
            if ($item->foto_barang && \Storage::exists('public/' . $item->foto_barang)) {
                \Storage::delete('public/' . $item->foto_barang);
            }
            // Simpan foto baru
            $pathFoto = $request->file('foto_barang')->store('barang_hilang', 'public');
            $item->foto_barang = $pathFoto;
        }

        // 4. Update Data
        // Pastikan nama kolom di kiri ('nama') sesuai dengan database Anda
        // Pastikan nama request di kanan ($request->nama) sesuai dengan name="" di input form
        $item->update([
            'nama'          => $request->nama,
            'nama_barang'   => $request->nama_barang,
            'lokasi'        => $request->lokasi,
            'status_barang' => $request->status_barang, // Belum Ditemukan / Ditemukan
            'deskripsi'     => $request->deskripsi,
            'no_telp'       => $request->no_telp,
            // Jika kolom di database belum ada, hapus baris di bawah ini:
            // 'email'         => $request->email,
            // 'fakultas'      => $request->fakultas,
            // 'program_studi' => $request->program_studi,
            // 'status_verifikasi' => $request->status_verifikasi, 
        ]);

        return redirect()->route('admin.index')->with('success', 'Data berhasil diperbarui!');
    }

    // ==========================================
    // 5. DELETE (Menghapus Data)
    // ==========================================
    public function destroy($id)
    {
        $item = Items::findOrFail($id);

        // Hapus foto dari folder public (agar bersih)
        if ($item->foto_barang) {
            \Storage::disk('public')->delete($item->foto_barang);
        }

        // Hapus data dari database
        $item->delete();

        return redirect()->back()->with('success', 'Laporan berhasil dihapus!');
    }
}   