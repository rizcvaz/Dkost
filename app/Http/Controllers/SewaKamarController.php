<?php

namespace App\Http\Controllers;

use App\Models\Kamar;

class SewaKamarController extends Controller
{
    public function index()
    {
        // Ambil data kamar dengan paginasi (6 kamar per halaman)
        $kamars = Kamar::paginate(6);
        // Kirim data ke view
        return view('sewa-kamar.index', compact('kamars'));
    }
}
