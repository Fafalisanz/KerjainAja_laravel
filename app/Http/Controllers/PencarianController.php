<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PencarianController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword', '');
        $wilayah = $request->get('wilayah', 'semua');

        $mitras = DB::table('mitra')
            ->when($keyword, function($q) use ($keyword) {
                $q->where('keahlian', 'like', "%$keyword%");
            })
            ->when($wilayah !== 'semua', function($q) use ($wilayah) {
                $q->where('kota', $wilayah);
            })
            ->paginate(8)
            ->withQueryString(); //← penting! biar keyword ikut di pagination

        return view('pencarian', compact('mitras', 'keyword', 'wilayah'));
    }
}