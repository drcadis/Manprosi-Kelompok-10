<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Items;
use App\Models\Kategori;

class HomeController extends Controller
{
    public function index()
    {
        $pemilik = Items::where('tipe_laporan', 'Kehilangan Pemilik')->latest()->take(6)->get();
        $barang = Items::where('tipe_laporan', 'Kehilangan Barang')->latest()->take(6)->get();
        $kategori = Kategori::all();
        $testimonials = \App\Models\Testimonial::latest()->get();

        return view('welcome', compact('pemilik', 'barang', 'kategori', 'testimonials'));

    }

}

