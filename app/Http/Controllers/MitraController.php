<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class MitraController extends Controller
{
    public function index()
    {
        return view('gabung_mitra');
    }

    public function proses(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_wa'        => 'required|string|max:20',
            'kota'         => 'required|string|max:100',
            'keahlian'     => 'required|string',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|min:6',
            'foto_ktp'     => 'required|image|max:2048',
            'foto_selfie'  => 'required|image|max:2048',
        ]);

        // Upload foto KTP
        $ktp     = $request->file('foto_ktp');
        $namaKtp = time() . '_KTP_' . $ktp->getClientOriginalName();
        $ktp->move(public_path('uploads'), $namaKtp);

        // Upload foto selfie
        $selfie     = $request->file('foto_selfie');
        $namaSelfie = time() . '_Selfie_' . $selfie->getClientOriginalName();
        $selfie->move(public_path('uploads'), $namaSelfie);

        // Simpan ke tabel users dengan role mitra
        User::create([
            'nama'     => $request->nama_lengkap,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'mitra',
        ]);

        // Simpan ke tabel mitra
        DB::table('mitra')->insert([
            'nama_lengkap'   => $request->nama_lengkap,
            'no_wa'          => $request->no_wa,
            'kota'           => $request->kota,
            'keahlian'       => $request->keahlian,
            'foto_ktp'       => $namaKtp,
            'foto_selfie'    => $namaSelfie,
            'tanggal_daftar' => now(),
        ]);

        return redirect()->route('home')
                         ->with('success', 'Pendaftaran mitra berhasil! Silakan login.');
    }
}