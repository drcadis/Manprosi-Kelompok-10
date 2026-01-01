<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
        ]);

        $user = Auth::user();

        Testimonial::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'user_id' => $user ? $user->id : null,
            'nama' => $request->nama ?? ($user ? $user->name : 'Anonymous'),
            'role' => $request->role ?? ($user ? ($user->role ?? 'Mahasiswa') : 'Guest'),
        ]);

        return redirect()->back()->with('success', 'Testimonial berhasil dikirim!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
        ]);

        $testimonial = Testimonial::findOrFail($id);

        $testimonial->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'nama' => $request->nama ?? $testimonial->nama,
            'role' => $request->role ?? $testimonial->role,
        ]);

        return redirect()->back()->with('success', 'Testimonial berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->back()->with('success', 'Testimonial berhasil dihapus!');
    }
}
