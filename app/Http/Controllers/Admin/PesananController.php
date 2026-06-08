<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index()
    {
        $pesanans = DB::table('pesanan')
                      ->orderBy('tanggal_pesan', 'desc')
                      ->paginate(10);

        return view('admin.pesanan', compact('pesanans'));
    }

    public function selesai(string $id)
    {
        DB::table('pesanan')->where('id', $id)->update(['status' => 'Selesai']);
        return back()->with('success', 'Pesanan ditandai selesai.');
    }

    public function batal(string $id)
    {
        DB::table('pesanan')->where('id', $id)->update(['status' => 'Dibatalkan']);
        return back()->with('success', 'Pesanan dibatalkan.');
    }
}