<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MitraController extends Controller
{
    public function index()
    {
        // Menampilkan halaman formulir pendaftaran (gabung mitra)
        return view('gabung_mitra');
    }

    public function proses(Request $request)
    {
        // Validasi input data pendaftaran mitra dan berkas foto
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

        // Upload foto KTP ke dalam folder public/uploads
        $ktp     = $request->file('foto_ktp');
        $namaKtp = time() . '_KTP_' . $ktp->getClientOriginalName();
        $ktp->move(public_path('uploads'), $namaKtp);

        // Upload foto selfie ke dalam folder public/uploads
        $selfie     = $request->file('foto_selfie');
        $namaSelfie = time() . '_Selfie_' . $selfie->getClientOriginalName();
        $selfie->move(public_path('uploads'), $namaSelfie);

        // Simpan data ke tabel users sebagai akun autentikasi dengan role mitra
        $user = User::create([
            'nama'     => $request->nama_lengkap,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'mitra',
        ]);

        // Simpan data profil detail mitra ke tabel mitra menggunakan Query Builder
        DB::table('mitra')->insert([
            'user_id'        => $user->id,
            'nama_lengkap'   => $request->nama_lengkap,
            'no_wa'          => $request->no_wa,
            'kota'           => $request->kota,
            'keahlian'       => $request->keahlian,
            'foto_ktp'       => $namaKtp,
            'foto_selfie'    => $namaSelfie,
            'tanggal_daftar' => now(),
        ]);

        // Otomatis membuat user langsung masuk/login setelah mendaftar
        Auth::login($user);

        return redirect()->route('home')
            ->with('success', 'Pendaftaran mitra berhasil! Silakan login.');
    }
}