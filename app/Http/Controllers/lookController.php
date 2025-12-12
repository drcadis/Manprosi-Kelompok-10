<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class lookController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::where('tipe', 'kehilangan');

        // Filter berdasarkan lokasi
        if ($request->has('lokasi') && $request->lokasi != '') {
            $query->where('lokasi', 'like', '%' . $request->lokasi . '%');
        }

        // Filter berdasarkan kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', 'like', '%' . $request->kategori . '%');
        }

        // Sorting berdasarkan tanggal terbaru
        $barangHilang = $query->orderBy('tanggal', 'desc')->paginate(12);

        // Ambil daftar lokasi unik untuk dropdown filter
        $daftarLokasi = Item::where('tipe', 'kehilangan')
            ->distinct()
            ->pluck('lokasi');

        // Ambil daftar kategori unik untuk dropdown filter
        $daftarKategori = Item::where('tipe', 'kehilangan')
            ->whereNotNull('kategori')
            ->distinct()
            ->pluck('kategori');

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'data' => $barangHilang,
                'lokasi' => $daftarLokasi,
                'kategori' => $daftarKategori
            ]);
        }

        return view('lihat-hilang', [
            'barangHilang' => $barangHilang,
            'daftarLokasi' => $daftarLokasi,
            'daftarKategori' => $daftarKategori,
            'filter' => $request->all()
        ]);
    }

    public function show($id)
    {
        $barang = Item::findOrFail($id);

        if (request()->wantsJson() || request()->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'data' => $barang
            ]);
        }

        return view('detail-barang-hilang', ['barang' => $barang]);
    }
}