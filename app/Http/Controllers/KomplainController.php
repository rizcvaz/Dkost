<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Komplain;
use Illuminate\Http\Request;

class KomplainController extends Controller
{
    // Tampilkan form komplain untuk user
    public function create()
    {
        return view('komplain.create');
    }

    // Simpan komplain user
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
            'deskripsi' => 'required|string|max:500',
        ]);

        Komplain::create([
            'user_id' => Auth::id(),
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Komplain berhasil dikirim.');
    }

    // Tampilkan daftar komplain di admin
    public function index()
    {
        $komplains = Komplain::with('user')->get();
        return view('komplain.index', compact('komplains'));
    }
}

