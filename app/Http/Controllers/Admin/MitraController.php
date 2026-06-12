<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MitraController extends Controller
{
    public function index()
    {
        // Mengambil data mitra dengan pagination dan diurutkan dari yang terbaru mendaftar
        $mitras = DB::table('mitra')
            ->orderBy('tanggal_daftar', 'desc')
            ->paginate(10);

        return view('admin.mitra', compact('mitras'));
    }

    public function approve(string $id)
    {
        // Mengubah status akun mitra menjadi approved berdasarkan ID
        DB::table('mitra')
            ->where('id', $id)
            ->update(['status' => 'approved']);

        return back()->with('success', 'Mitra berhasil diapprove!');
    }

    public function reject(string $id)
    {
        // Mengubah status akun mitra menjadi rejected berdasarkan ID
        DB::table('mitra')
            ->where('id', $id)
            ->update(['status' => 'rejected']);

        return back()->with('success', 'Mitra berhasil direject!');
    }
}