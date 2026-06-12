<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function index()
    {
        // Mengambil maksimal 6 data keahlian unik (tanpa duplikat) untuk kategori
        $categories = DB::table('mitra')
            ->select('keahlian')
            ->distinct()
            ->limit(6)
            ->get();

        // Mengambil 8 data mitra terbaru berdasarkan urutan ID terbesar
        $mitras = DB::table('mitra')
            ->orderBy('id', 'desc')
            ->limit(8)
            ->get();

        return view('index', compact('categories', 'mitras'));
    }
}