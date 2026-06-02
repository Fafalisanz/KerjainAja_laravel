<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DetailController extends Controller
{
    public function index($id)
    {
        $data = DB::table('mitra')->where('id', $id)->first();

        if (!$data) {
            abort(404, 'Pekerja tidak ditemukan.');
        }

        $teks_layanan = !empty($data->layanan) ? $data->layanan : 'Konsultasi Gratis, Pengerjaan Standar';
        $array_layanan = explode(',', $teks_layanan);

        return view('detail', compact('data', 'array_layanan', 'id'));
    }
}