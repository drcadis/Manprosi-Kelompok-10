<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function laporan()
    {
        return view('admin', [
            'mode' => 'laporan',
            'items' => Items::latest()->get()
        ]);
    }

    public function feedback()
    {
        return view('admin', [
            'mode' => 'feedback',
            'items' => DB::table('testimonials')->latest()->get()
        ]);
    }
}
