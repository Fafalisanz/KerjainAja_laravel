<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function index()
    {
        $categories = DB::table('mitra')
                        ->select('keahlian')
                        ->distinct()
                        ->limit(6)
                        ->get();

        $mitras = DB::table('mitra')
                    ->orderBy('id', 'desc')
                    ->limit(8)
                    ->get();

        return view('index', compact('categories', 'mitras'));
    }
}