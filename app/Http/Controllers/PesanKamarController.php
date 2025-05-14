<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penghuni;
use App\Models\Kamar;

class PesanKamarController extends Controller
{
    public function form($id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('landing.pesan-kamar', compact('kamar'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|unique:penghunis,nik',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
        ]);

        $kamar = Kamar::findOrFail($id);

        // Buat penghuni baru
        Penghuni::create([
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'kamar_id' => $kamar->id,
        ]);

        // Ubah status kamar menjadi 'Terisi'
        $kamar->status = 'Terisi';
        $kamar->save();

        return redirect()->route('home')->with('success', 'Pemesanan berhasil!');
    }
}
