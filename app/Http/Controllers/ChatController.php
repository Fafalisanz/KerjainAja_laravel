<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index(string $id)
    {
        $data = DB::table('mitra')->where('id', $id)->first();

        if (!$data) {
            abort(404, 'Mitra tidak ditemukan.');
        }

        $nama_mitra = $data->nama_lengkap;

        return view('chat', compact('data', 'nama_mitra', 'id'));
    }
}