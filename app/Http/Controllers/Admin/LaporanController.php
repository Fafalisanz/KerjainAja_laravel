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
        // Mengambil filter dari request dengan nilai default awal & akhir bulan ini
        $dari   = $request->get('dari', now()->startOfMonth()->format('Y-m-d'));
        $sampai = $request->get('sampai', now()->format('Y-m-d'));
        $status = $request->get('status', 'semua');

        // Query mengambil data pesanan ber-pagination dengan filter pendukung
        $pesanans = DB::table('pesanan')
            ->when($dari, fn($q) => $q->whereDate('tanggal_pesan', '>=', $dari))
            ->when($sampai, fn($q) => $q->whereDate('tanggal_pesan', '<=', $sampai))
            ->when($status !== 'semua', fn($q) => $q->where('status', $status))
            ->orderBy('tanggal_pesan', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Query menghitung ringkasan total pesanan dan total pendapatan sesuai filter
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
        // Mengambil data filter yang sama untuk kebutuhan export PDF
        $dari   = $request->get('dari', now()->startOfMonth()->format('Y-m-d'));
        $sampai = $request->get('sampai', now()->format('Y-m-d'));
        $status = $request->get('status', 'semua');

        // Mengambil semua data pesanan tanpa pagination untuk dicetak ke PDF
        $pesanans = DB::table('pesanan')
            ->when($dari, fn($q) => $q->whereDate('tanggal_pesan', '>=', $dari))
            ->when($sampai, fn($q) => $q->whereDate('tanggal_pesan', '<=', $sampai))
            ->when($status !== 'semua', fn($q) => $q->where('status', $status))
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        // Mengambil ringkasan data yang sama untuk dicetak ke PDF
        $summary = DB::table('pesanan')
            ->when($dari, fn($q) => $q->whereDate('tanggal_pesan', '>=', $dari))
            ->when($sampai, fn($q) => $q->whereDate('tanggal_pesan', '<=', $sampai))
            ->when($status !== 'semua', fn($q) => $q->where('status', $status))
            ->selectRaw('COUNT(*) as total_pesanan, SUM(total_tagihan) as total_pendapatan')
            ->first();

        // Pembuatan file PDF dengan orientasi A4 Landscape
        $pdf = Pdf::loadView('admin.laporan_pdf', compact('pesanans', 'summary', 'dari', 'sampai'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-pesanan-' . now()->format('Y-m-d') . '.pdf');
    }
}