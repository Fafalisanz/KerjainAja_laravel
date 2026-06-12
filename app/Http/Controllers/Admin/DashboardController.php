<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil statistik data untuk dashboard card
        $stats = [
            'total_mitra'   => DB::table('mitra')->count(),
            'total_pesanan' => DB::table('pesanan')->count(),
            'total_users'   => DB::table('users')->where('role', 'pencari_jasa')->count(),
            'pending'       => DB::table('pesanan')->where('status', 'Menunggu Pembayaran')->count(),
        ];

        // Mengambil 5 pesanan terbaru
        $pesanan_terbaru = DB::table('pesanan')
            ->orderBy('tanggal_pesan', 'desc')
            ->limit(5)
            ->get();

        // Mengambil 5 mitra yang baru mendaftar
        $mitra_terbaru = DB::table('mitra')
            ->orderBy('tanggal_daftar', 'desc')
            ->limit(5)
            ->get();

        // Data grafik pesanan per hari (7 hari terakhir) - dengan filter
        $grafikRaw = DB::table('pesanan')
            ->selectRaw('DATE(tanggal_pesan) as tanggal, COUNT(*) as total')
            ->where('tanggal_pesan', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get()
            ->keyBy('tanggal');

        // Lengkapi semua 7 hari meski tidak ada pesanan (agar grafik tidak kosong)
        $grafik = collect();
        for ($i = 6; $i >= 0; $i--) {
            $tgl = now()->subDays($i)->format('Y-m-d');
            $grafik->push((object)[
                'tanggal' => now()->subDays($i)->locale('id')->isoFormat('D MMM'),
                'total'   => $grafikRaw->has($tgl) ? $grafikRaw[$tgl]->total : 0,
            ]);
        }

        return view('admin.dashboard', compact('stats', 'pesanan_terbaru', 'mitra_terbaru', 'grafik'));
    }
}