<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function create()
    {
        return view('lapor-hilang');
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'lokasi'      => 'required',
            'tanggal'     => 'required|date',
            'foto_barang' => 'required|image|mimes:jpeg,png,jpg|max:5048',
        ]);

        if ($validator->fails()) {
            if (!$request->wantsJson()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $pathFoto = null;
        if ($request->hasFile('foto_barang')) {
            $pathFoto = $request->file('foto_barang')->store('barang_hilang', 'public');
        }

        $item = Item::create([
            'nama_barang' => $request->nama_barang,
            'foto_barang' => $pathFoto,
            'lokasi'      => $request->lokasi,
            'tanggal'     => $request->tanggal,
            'tipe'        => 'kehilangan',
        ]);

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil masuk database!',
                'data' => $item
            ], 201);
        }
        
        return redirect()->back()->with('success', 'Laporan berhasil dikirim!');
    }
    
}