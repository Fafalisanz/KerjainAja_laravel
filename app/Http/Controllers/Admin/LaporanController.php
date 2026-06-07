<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $dari   = $request->get('dari', now()->startOfMonth()->format('Y-m-d'));
        $sampai = $request->get('sampai', now()->format('Y-m-d'));
        $status = $request->get('status', 'semua');

        $pesanans = DB::table('pesanan')
                      ->when($dari, fn($q) => $q->whereDate('tanggal_pesan', '>=', $dari))
                      ->when($sampai, fn($q) => $q->whereDate('tanggal_pesan', '<=', $sampai))
                      ->when($status !== 'semua', fn($q) => $q->where('status', $status))
                      ->orderBy('tanggal_pesan', 'desc')
                      ->paginate(10)
                      ->withQueryString();

        $summary = DB::table('pesanan')
                     ->when($dari, fn($q) => $q->whereDate('tanggal_pesan', '>=', $dari))
                     ->when($sampai, fn($q) => $q->whereDate('tanggal_pesan', '<=', $sampai))
                     ->when($status !== 'semua', fn($q) => $q->where('status', $status))
                     ->selectRaw('COUNT(*) as total_pesanan, SUM(total_tagihan) as total_pendapatan')
                     ->first();

        return view('admin.laporan', compact('pesanans', 'summary', 'dari', 'sampai', 'status'));
    }

    public function exportPdf(Request $request)
    {
        $dari   = $request->get('dari', now()->startOfMonth()->format('Y-m-d'));
        $sampai = $request->get('sampai', now()->format('Y-m-d'));
        $status = $request->get('status', 'semua');

        $pesanans = DB::table('pesanan')
                      ->when($dari, fn($q) => $q->whereDate('tanggal_pesan', '>=', $dari))
                      ->when($sampai, fn($q) => $q->whereDate('tanggal_pesan', '<=', $sampai))
                      ->when($status !== 'semua', fn($q) => $q->where('status', $status))
                      ->orderBy('tanggal_pesan', 'desc')
                      ->get();

        $summary = DB::table('pesanan')
                     ->when($dari, fn($q) => $q->whereDate('tanggal_pesan', '>=', $dari))
                     ->when($sampai, fn($q) => $q->whereDate('tanggal_pesan', '<=', $sampai))
                     ->when($status !== 'semua', fn($q) => $q->where('status', $status))
                     ->selectRaw('COUNT(*) as total_pesanan, SUM(total_tagihan) as total_pendapatan')
                     ->first();

        $pdf = Pdf::loadView('admin.laporan_pdf', compact('pesanans', 'summary', 'dari', 'sampai'))
                  ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-pesanan-' . now()->format('Y-m-d') . '.pdf');
    }
}