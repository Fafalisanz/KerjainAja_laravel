<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_mitra'   => DB::table('mitra')->count(),
            'total_pesanan' => DB::table('pesanan')->count(),
            'total_users'   => DB::table('users')->where('role', 'pencari_jasa')->count(),
            'pending'       => DB::table('pesanan')->where('status', 'Menunggu Pembayaran')->count(),
        ];

        $pesanan_terbaru = DB::table('pesanan')
                            ->orderBy('tanggal_pesan', 'desc')
                            ->limit(5)
                            ->get();

        $mitra_terbaru = DB::table('mitra')
                            ->orderBy('tanggal_daftar', 'desc')
                            ->limit(5)
                            ->get();

        // Data grafik pesanan per hari (7 hari terakhir)
                $grafik = DB::table('pesanan')
                            ->selectRaw('DATE(tanggal_pesan) as tanggal, COUNT(*) as total')
                            ->groupBy('tanggal')
                            ->orderBy('tanggal')
                            ->get();

        return view('admin.dashboard', compact('stats', 'pesanan_terbaru', 'mitra_terbaru', 'grafik'));
    }
}