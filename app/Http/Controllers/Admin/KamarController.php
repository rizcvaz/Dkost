<?php

// app/Http/Controllers/Admin/KamarController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kamar;

class KamarController extends Controller
{
    public function index()
    {
        $kamar = Kamar::all();
        return view('admin.kamar', compact('kamar'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nomor_kamar' => 'required',
        'fasilitas' => 'required',
        'lantai' => 'required',
        'ukuran_kamar' => 'required',
        'harga' => 'required|numeric',
        'status' => 'required',
    ]);

    Kamar::create([
        'nomor_kamar' => $request->nomor_kamar,
        'fasilitas' => $request->fasilitas,
        'lantai' => $request->lantai,
        'ukuran_kamar' => $request->ukuran_kamar,
        'harga' => $request->harga,
        'status' => $request->status,
    ]);

    return redirect()->back()->with('success', 'Kamar berhasil ditambahkan.');
}

public function update(Request $request, $id)
{
    $kamar = Kamar::findOrFail($id);

    $request->validate([
        'nomor_kamar' => 'required',
        'fasilitas' => 'required',
        'lantai' => 'required',
        'ukuran_kamar' => 'required',
        'harga' => 'required|numeric',
        'status' => 'required',
    ]);

    $kamar->update([
        'nomor_kamar' => $request->nomor_kamar,
        'fasilitas' => $request->fasilitas,
        'lantai' => $request->lantai,
        'ukuran_kamar' => $request->ukuran_kamar,
        'harga' => $request->harga,
        'status' => $request->status,
    ]);

    return redirect()->back()->with('success', 'Kamar berhasil diupdate.');
}



    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);
        $kamar->delete();

        return redirect()->back()->with('success', 'Kamar berhasil dihapus.');
    }
}
