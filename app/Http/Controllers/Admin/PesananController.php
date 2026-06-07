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
}