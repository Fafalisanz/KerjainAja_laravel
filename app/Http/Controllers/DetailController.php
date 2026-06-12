<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DetailController extends Controller
{
    public function index($id)
    {
        // Mengambil data mitra berdasarkan ID pekerja yang dikirim
        $data = DB::table('mitra')->where('id', $id)->first();

        // Validasi jika data pekerja tidak ditemukan di database
        if (!$data) {
            abort(404, 'Pekerja tidak ditemukan.');
        }

        // Menentukan teks layanan default jika kolom layanan kosong
        $teks_layanan = !empty($data->layanan) ? $data->layanan : 'Konsultasi Gratis, Pengerjaan Standar';
        
        // Memecah string layanan menjadi array berdasarkan tanda koma (,)
        $array_layanan = explode(',', $teks_layanan);

        return view('detail', compact('data', 'array_layanan', 'id'));
    }
}