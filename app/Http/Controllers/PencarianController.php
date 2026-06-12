<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PencarianController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil input kata kunci dan filter wilayah dari request query
        $keyword = $request->get('keyword', '');
        $wilayah = $request->get('wilayah', 'semua');

        // Query mencari data mitra berdasarkan keahlian dan lokasi kota
        $mitras = DB::table('mitra')
            ->when($keyword, function ($q) use ($keyword) {
                $q->where('keahlian', 'like', "%$keyword%");
            })
            ->when($wilayah !== 'semua', function ($q) use ($wilayah) {
                $q->where('kota', $wilayah);
            })
            ->paginate(8)
            ->withQueryString(); //← penting! biar keyword ikut di pagination

        return view('pencarian', compact('mitras', 'keyword', 'wilayah'));
    }
}