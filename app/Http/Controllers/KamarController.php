<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    // Tampilkan halaman utama data kamar
    public function index()
    {
        
        $kamars = Kamar::all();
        return view('kamar.index', compact('kamars'));
    }

    // Simpan data kamar baru
    public function store(Request $request)
    {
        $request->validate([
            'nomor_kamar' => 'required',
            'fasilitas' => 'required',
            'lantai' => 'required|integer',
            'ukuran_kamar' => 'required',
            'harga' => 'required|integer',
            'status' => 'required|in:Kosong,Penuh',
        ]);

        Kamar::create($request->all());
        return redirect()->back()->with('success', 'Data kamar berhasil ditambahkan.');
    }

    // Update data kamar
    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_kamar' => 'required',
            'fasilitas' => 'required',
            'lantai' => 'required|integer',
            'ukuran_kamar' => 'required',
            'harga' => 'required|integer',
            'status' => 'required|in:Kosong,Penuh',
        ]);

        $kamar = Kamar::find($id);
        $kamar->update($request->all());
        return redirect()->back()->with('success', 'Data kamar berhasil diperbarui.');
    }

    // Hapus data kamar
    public function destroy($id)
    {
        Kamar::find($id)->delete();
        return redirect()->back()->with('success', 'Data kamar berhasil dihapus.');
    }
}
