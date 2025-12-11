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

        // Filter berdasarkan tanggal
        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // Filter berdasarkan rentang tanggal
        if ($request->has('tanggal_dari') && $request->tanggal_dari != '') {
            $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        }
        if ($request->has('tanggal_sampai') && $request->tanggal_sampai != '') {
            $query->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }

        // Sorting berdasarkan tanggal terbaru
        $barangHilang = $query->orderBy('tanggal', 'desc')->paginate(12);

        // Ambil daftar lokasi unik untuk dropdown filter
        $daftarLokasi = Item::where('tipe', 'kehilangan')
            ->distinct()
            ->pluck('lokasi');

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'data' => $barangHilang,
                'lokasi' => $daftarLokasi
            ]);
        }

        return view('lihat-hilang', [
            'barangHilang' => $barangHilang,
            'daftarLokasi' => $daftarLokasi,
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