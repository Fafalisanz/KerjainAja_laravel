<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index()
    {
        // Mengambil data pesanan dengan pagination dan diurutkan dari yang terbaru
        $pesanans = DB::table('pesanan')
            ->orderBy('tanggal_pesan', 'desc')
            ->paginate(10);

        return view('admin.pesanan', compact('pesanans'));
    }

    public function selesai(string $id)
    {
        // Mengubah status pesanan menjadi Selesai berdasarkan ID
        DB::table('pesanan')
            ->where('id', $id)
            ->update(['status' => 'Selesai']);

        return back()->with('success', 'Pesanan ditandai selesai.');
    }

    public function batal(string $id)
    {
        // Mengubah status pesanan menjadi Dibatalkan berdasarkan ID
        DB::table('pesanan')
            ->where('id', $id)
            ->update(['status' => 'Dibatalkan']);

        return back()->with('success', 'Pesanan dibatalkan.');
    }
}