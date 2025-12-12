<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Verification;
use App\Models\Item;

class VerificationController extends Controller
{
    // === 1. FUNGSI UNTUK MENGAJUKAN KLAIM (POST) ===
    public function store(Request $request)
    {
        // Validasi Input
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string',
            'identity_card_image' => 'required|image|max:2048', // Foto KTP/KTM
            'proof_description' => 'required|string',
            'proof_image' => 'required|image|max:2048', // Foto Bukti
        ]);

        // Upload Foto KTP
        $identityPath = null;
        if ($request->hasFile('identity_card_image')) {
            $identityPath = $request->file('identity_card_image')->store('identities', 'public');
        }

        // Upload Foto Bukti Barang
        $proofPath = null;
        if ($request->hasFile('proof_image')) {
            $proofPath = $request->file('proof_image')->store('proofs', 'public');
        }

        // Simpan ke Database
        $verification = Verification::create([
            'item_id' => $validated['item_id'],
            'name' => $validated['name'],
            'phone_number' => $validated['phone_number'],
            'address' => $validated['address'],
            'identity_card_image' => $identityPath,
            'proof_description' => $validated['proof_description'],
            'proof_image' => $proofPath,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Klaim berhasil diajukan! Menunggu verifikasi admin.',
            'data' => $verification
        ], 201);
    }

    // === 2. FUNGSI UNTUK APPROVE / REJECT (PUT) ===
    public function update(Request $request, $id)
    {
        // Cari data klaim
        $verification = Verification::find($id);

        if (!$verification) {
            return response()->json(['message' => 'Data verification not found'], 404);
        }

        // Validasi status & alasan penolakan
        $request->validate([
            'status' => 'required|in:approved,rejected,pending',
            'rejection_reason' => 'required_if:status,rejected|string|nullable' 
        ]);

        // Update status
        $verification->status = $request->status;

        // Simpan alasan jika ditolak
        if ($request->status == 'rejected') {
            $verification->rejection_reason = $request->rejection_reason;
        } else {
            $verification->rejection_reason = null;
        }

        $verification->save();

        // status barang jadi 'returned' apabila diubah
        if ($request->status == 'approved') {
            $item = Item::find($verification->item_id);
            if ($item) {
                $item->status = 'returned'; 
                $item->save();
            }
        }

        return response()->json([
            'message' => 'Status updated successfully',
            'data' => $verification
        ]);
    }
}