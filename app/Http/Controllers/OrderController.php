<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(string $id)
    {
        $data = DB::table('mitra')->where('id', $id)->first();

        if (!$data) {
            abort(404, 'Mitra tidak ditemukan.');
        }

        $nama_mitra = $data->nama_lengkap;

        return view('order', compact('data', 'nama_mitra', 'id'));
    }

    public function proses(Request $request)
{
    $request->validate([
        'nama_pekerja'      => 'required',
        'durasi'            => 'required',
        'detail'            => 'nullable',
        'metode_pembayaran' => 'required',
    ]);

$id = DB::table('pesanan')->insertGetId([
    'nama_pekerja'       => $request->nama_pekerja,
    'durasi'             => $request->durasi,
    'detail_pekerjaan'   => $request->detail,
    'metode_pembayaran'  => $request->metode_pembayaran,
    'total_tagihan'      => 100000,
    'status'             => 'Menunggu Pembayaran',
    'tanggal_pesan'      => now(), // ← sesuai kolom di DB
]);

return redirect()->route('tagihan', $id);
}
}