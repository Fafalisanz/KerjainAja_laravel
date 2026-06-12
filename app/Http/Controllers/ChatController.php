<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index(string $id)
    {
        // Mengambil data mitra berdasarkan ID yang dikirim
        $data = DB::table('mitra')->where('id', $id)->first();

        // Validasi jika data mitra tidak ditemukan di database
        if (!$data) {
            abort(404, 'Mitra tidak ditemukan.');
        }

        // Mengambil nama lengkap mitra dari hasil query data
        $nama_mitra = $data->nama_lengkap;

        return view('chat', compact('data', 'nama_mitra', 'id'));
    }
}