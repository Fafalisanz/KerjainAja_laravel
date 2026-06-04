<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('edit_profil', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'foto_baru' => 'nullable|image|max:2048',
        ]);

        $user = Auth::user();
        $data = ['nama' => $request->nama];

        if ($request->hasFile('foto_baru')) {
            $file      = $request->file('foto_baru');
            $namaFoto  = 'profil_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('Images/profile'), $namaFoto);

            // Hapus foto lama kalau bukan default
            $fotoLama = public_path('Images/profile/' . $user->foto);
            if ($user->foto && $user->foto !== 'default_profile.png' && file_exists($fotoLama)) {
                unlink($fotoLama);
            }

            $data['foto'] = $namaFoto;
        }

        DB::table('users')->where('id', $user->id)->update($data);

        return redirect()->route('home')->with('success', 'Profil berhasil diperbarui!');
    }

    public function hapus()
    {
        $user = Auth::user();

        // Hapus foto lama kalau bukan default
        $fotoLama = public_path('Images/profile/' . $user->foto);
        if ($user->foto && $user->foto !== 'default_profile.png' && file_exists($fotoLama)) {
            unlink($fotoLama);
        }

        Auth::logout();
        DB::table('users')->where('id', $user->id)->delete();

        return redirect()->route('home');
    }
}