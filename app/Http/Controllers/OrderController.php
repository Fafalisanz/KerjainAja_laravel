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

    // Halaman pesanan untuk pencari jasa
    public function pesananSaya()
    {
        $pesanan = DB::table('pesanan')
            ->where('user_id', Auth::id())
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        return view('pesanan_saya', compact('pesanan'));
    }

    // Halaman pesanan untuk mitra
    public function pesananMasuk()
    {
        $user = Auth::user();

        // Cari data mitra berdasarkan user_id (mitra baru) atau nama (mitra lama)
        $mitra = DB::table('mitra')->where('user_id', $user->id)->first();

        // Fallback: cari berdasarkan nama kalau user_id belum ada (data lama)
        if (!$mitra) {
            $mitra = DB::table('mitra')->where('nama_lengkap', $user->nama)->first();
        }

        $pesanan = collect();
        if ($mitra) {
            $pesanan = DB::table('pesanan')
                ->where('mitra_id', $mitra->id)
                ->orderBy('tanggal_pesan', 'desc')
                ->get();
        }

        return view('pesanan_mitra', compact('pesanan'));
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
            'user_id'            => Auth::id(),
            'mitra_id'           => $request->mitra_id,
            'nama_pekerja'       => $request->nama_pekerja,
            'durasi'             => $request->durasi,
            'detail_pekerjaan'   => $request->detail,
            'metode_pembayaran'  => $request->metode_pembayaran,
            'total_tagihan'      => 100000,
            'status'             => 'Menunggu Pembayaran',
            'tanggal_pesan'      => now(),
        ]);

        return redirect()->route('tagihan', $id);
    }
}