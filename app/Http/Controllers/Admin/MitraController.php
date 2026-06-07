<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MitraController extends Controller
{
    public function index()
    {
        $mitras = DB::table('mitra')->orderBy('tanggal_daftar', 'desc')->paginate(10);
        return view('admin.mitra', compact('mitras'));
    }

    public function approve(string $id)
    {
        DB::table('mitra')->where('id', $id)->update(['status' => 'approved']);
        return back()->with('success', 'Mitra berhasil diapprove!');
    }

    public function reject(string $id)
    {
        DB::table('mitra')->where('id', $id)->update(['status' => 'rejected']);
        return back()->with('success', 'Mitra berhasil direject!');
    }
}