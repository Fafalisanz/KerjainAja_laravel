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
            'detail'            => 'required',
            'metode_pembayaran' => 'required',
        ]);

        DB::table('pesanan')->insert([
            'user_id'           => Auth::id(),
            'nama_pekerja'      => $request->nama_pekerja,
            'durasi'            => $request->durasi,
            'detail'            => $request->detail,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status'            => 'Menunggu',
            'dibuat_pada'       => now(),
        ]);

        return redirect()->route('home')->with('success', 'Pesanan berhasil dibuat!');
    }
}