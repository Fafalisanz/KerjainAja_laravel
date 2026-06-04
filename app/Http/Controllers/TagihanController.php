<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class TagihanController extends Controller
{
    public function index(string $id)
    {
        $data = DB::table('pesanan')->where('id', $id)->first();

        if (!$data) {
            return redirect()->route('home');
        }

        $metode = $data->metode_pembayaran;

        if ($metode == 'Bank Transfer') {
            $instruksi = 'Transfer ke Bank BCA: <strong style="color:#114D4D;">741-535-1666</strong><br>a/n PT KerjainAja Digital Indonesia';
        } elseif ($metode == 'GoPay') {
            $instruksi = 'Buka aplikasi Gojek, transfer ke No. GoPay:<br><strong style="color:#114D4D;">0895-3650-35256</strong> (KerjainAja)';
        } elseif ($metode == 'OVO/Dana') {
            $instruksi = 'Buka aplikasi OVO/Dana, transfer ke nomor:<br><strong style="color:#114D4D;">0895-3650-35256</strong> (KerjainAja)';
        } else {
            $instruksi = 'Silakan lakukan pembayaran sesuai instruksi admin.';
        }

        return view('tagihan', compact('data', 'instruksi'));
    }
}