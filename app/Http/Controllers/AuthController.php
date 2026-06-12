<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        // Menampilkan halaman formulir login (masuk)
        return view('masuk');
    }

    public function prosesLogin(Request $request)
    {
        // Validasi input data login email dan password
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Proses autentikasi credentials user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            
            // ← Tambahkan redirect sesuai role di sini
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }
            
            return redirect()->route('home');
        }

        // Kembali ke halaman login jika autentikasi gagal
        return back()->with('error', 'Email atau kata sandi salah.');
    }

    public function showDaftar()
    {
        // Menampilkan halaman formulir registrasi (daftar)
        return view('daftar');
    }

    public function prosesDaftar(Request $request)
    {
        // Validasi input data pendaftaran user baru
        $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Menyimpan data user baru ke dalam database
        User::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'pencari_jasa', // ← default
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan masuk.');
    }

    public function logout(Request $request)
    {
        // Proses keluar sistem dan pembersihan data session user
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home');
    }
}