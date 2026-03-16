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

    $getAll = Items::with('kategori')
        ->where('tipe_laporan', 'Kehilangan Barang') 
        ->latest()
        ->paginate(12);

    return view('semuaBarang', compact('getAll'));
    }   

    // MENAMPILKAN FORM LAPOR KHUSUS "KEHILANGAN"
    public function create()
    {
        $kategori = Kategori::all();
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
            'id_kategori'   => 'required|exists:kategori,id',
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

        Items::create([
            'nama'          => $request->nama,
            'no_telp'       => $request->no_telp,
            'nama_barang'   => $request->nama_barang,
            'foto_barang'   => $pathFoto,
            'lokasi'        => $request->lokasi,
            'tanggal'       => $request->tanggal,
            'id_kategori'   => $request->id_kategori,
            'deskripsi'     => $request->deskripsi,
            'tipe_laporan'  => 'Kehilangan Barang',
            'status_barang' => 'Belum Ditemukan',
        ]);

        // Redirect ke halaman index khusus kehilangan
        return redirect()->route('lost.index')->with('success', 'Laporan kehilangan berhasil dibuat!');
    }

    // 3. EDIT (Menampilkan Form Edit)
    public function edit($id)
    {
        $item = Items::findOrFail($id);
        $kategori = Kategori::all();

        // Arahkan ke view edit
        return view('editLaporan', compact('item', 'kategori'));
    }

    // 4. UPDATE (Menyimpan Perubahan)
    public function update(Request $request, $id)
    {
        // 1. Cari Barang
        $item = Items::findOrFail($id);

        // 2. Validasi
        $validator = Validator::make($request->all(), [
            'nama'          => 'required|string', // Nama Pelapor
            'nama_barang'   => 'required|string',
            'lokasi'        => 'required|string',
            'status_barang' => 'required|string',
            'foto_barang'   => 'nullable|image|max:5048',
            'no_telp'       => 'nullable|string',
            'email'         => 'nullable|email',
            'fakultas'      => 'nullable|string',
            'program_studi' => 'nullable|string',
            'status_verifikasi' => 'nullable|string',
        ]);

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
        $item->update([
            'nama'          => $request->nama,
            'nama_barang'   => $request->nama_barang,
            'lokasi'        => $request->lokasi,
            'status_barang' => $request->status_barang, // Belum Ditemukan / Ditemukan
            'deskripsi'     => $request->deskripsi,
            'no_telp'       => $request->no_telp,
        ]);

        return redirect()->route('admin.index')->with('success', 'Data berhasil diperbarui!');
    }

    // 5. DELETE (Menghapus Data)
    public function destroy($id)
    {
        $item = Items::findOrFail($id);
        
        // Hapus foto dari folder public
        if ($item->foto_barang) {
            \Storage::disk('public')->delete($item->foto_barang);
        }

        // Hapus data dari database
        $item->delete();

        return redirect()->back()->with('success', 'Laporan berhasil dihapus!');
    }
}   