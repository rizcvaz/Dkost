<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    // Menampilkan daftar kamar
    public function index()
    {
        $kamars = Kamar::all();  // Ambil semua data kamar
        return view('kamar.index', compact('kamars'));  // Tampilkan di view
    }

    // Menyimpan data kamar baru
    public function store(Request $request)
    {
        $request->validate([
            'nomor_kamar' => 'required|string',
            'fasilitas' => 'nullable|string',
            'lantai' => 'required|integer',
            'ukuran_kamar' => 'nullable|string',
            'harga' => 'required|numeric',
            'status' => 'required|string',
        ]);

        Kamar::create($request->all());  // Menyimpan data kamar

        return redirect()->route('kamar.index')->with('success', 'Data kamar berhasil disimpan');
    }

    // Mengupdate data kamar berdasarkan ID
    public function update(Request $request, $id)
    {
        $kamar = Kamar::findOrFail($id);  // Mencari kamar berdasarkan ID

        $request->validate([
            'nomor_kamar' => 'required|string',
            'fasilitas' => 'nullable|string',
            'lantai' => 'required|integer',
            'ukuran_kamar' => 'nullable|string',
            'harga' => 'required|numeric',
            'status' => 'required|string',
        ]);

        $kamar->update($request->all());  // Mengupdate data kamar

        return redirect()->route('kamar.index')->with('success', 'Data kamar berhasil diperbarui');
    }

    // Menghapus data kamar
    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);
        $kamar->delete();  // Menghapus data kamar

        return redirect()->route('kamar.index')->with('success', 'Data kamar berhasil dihapus');
    }
}
