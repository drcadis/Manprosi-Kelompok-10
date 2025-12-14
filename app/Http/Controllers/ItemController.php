<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Items;
use App\Models\Kategori;

class ItemController extends Controller
{
    public function index()
    {
        $items = Items::with('kategori')
            ->latest()
            ->get();

        return view('items.index', compact('items'));
    }
    
    public function create()
    {
        $kategori = Kategori::all();
        return view('cari', compact('kategori'));
    }

    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'nama'          => 'required|string|max:255',
            'no_telp'       => 'required|string|max:255',
            'nama_barang'   => 'required|string|max:255',
            'lokasi'        => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id',
            'tanggal'       => 'required|date',
            'deskripsi'     => 'required|string',
            'tipe_laporan' => 'required|in:Kehilangan Barang,Kehilangan Pemilik',
            'foto_barang'   => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
        ]);

        if ($validator->fails()) {
            if (!$request->wantsJson()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Upload foto jika ada
        $pathFoto = null;
        if ($request->hasFile('foto_barang')) {
            $pathFoto = $request->file('foto_barang')
                               ->store('barang_hilang', 'public');
        }

        // Simpan ke database
        $item = Items::create([
            'nama'          => $request->nama,
            'no_telp'       => $request->no_telp,
            'nama_barang'   => $request->nama_barang,
            'foto_barang'   => $pathFoto,
            'lokasi'        => $request->lokasi,
            'tanggal'       => $request->tanggal,
            'id_kategori'   => $request->id_kategori,
            'deskripsi'     => $request->deskripsi,
            'tipe_laporan'  => $request->tipe_laporan,
            'status_barang' => 'Belum Ditemukan', // default eksplisit
        ]);

        // Response JSON (AJAX / API)
        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Data berhasil masuk database!',
                'data'    => $item
            ], 201);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true
            ], 201);}

        return redirect()->back()->with('success', 'Laporan berhasil dikirim!');
    }

    public function show($id)
    {
        // Ambil data item berdasarkan ID
        $item = Items::findOrFail($id);

        // Kirim ke view
        return view('items.show', compact('item'));
    }

}
