<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Verification;
use App\Models\Item; // Pastikan model Item ada

class VerificationController extends Controller
{
    // 1. Fungsi Mengajukan Verifikasi (User mengklaim barang)
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|integer',
            'item_id' => 'required|integer',
            'proof_description' => 'required|string',
        ]);

        // Simpan ke database
        $verification = Verification::create([
            'user_id' => $request->user_id,
            'item_id' => $request->item_id,
            'proof_description' => $request->proof_description,
            'status' => 'pending'
        ]);

        // Return berupa View HTML (sesuai request)
        return view('verification.success_claim', ['data' => $verification]);
    }

    public function update(Request $request, $id)
    {
        // 1. Cari data verifikasi
        $verification = Verification::find($id);

        if (!$verification) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // 2. Validasi input (Admin harus kirim status: 'approved' atau 'rejected')
        // Jika tidak kirim status, default-nya jadi 'approved' (opsional)
        $status = $request->input('status', 'approved'); 

        // Pastikan hanya boleh 'approved' atau 'rejected'
        if (!in_array($status, ['approved', 'rejected'])) {
             return response()->json(['message' => 'Status tidak valid'], 400);
        }

        // 3. Simpan perubahan status verifikasi
        $verification->status = $status;
        $verification->save();

        // 4. Logika Otomatis: Update status Barang (Items)
        // Jika klaim disetujui, barang dianggap sudah kembali (returned)
        if ($status === 'approved') {
            // Asumsi relasi di model Verification adalah 'item'
            // Jika nama relasi di model Anda berbeda, sesuaikan (misal: $verification->barang)
            if ($verification->item) {
                $verification->item->update(['status' => 'returned']);
            }
        }

        // 5. Return JSON agar enak dilihat di Postman
        return response()->json([
            'message' => 'Status berhasil diubah menjadi: ' . $status,
            'data' => $verification
        ], 200);
    }
}