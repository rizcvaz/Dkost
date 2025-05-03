<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;

class CariKamarController extends Controller
{
    public function index()
    {
        // Ambil hanya kamar yang tersedia (misalnya status = 'kosong')
        $kamar = Kamar::all();
        return view('landing.cari-kamar', compact('kamar'));
    }
}
