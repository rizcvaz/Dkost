<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penghuni;
use App\Models\Kamar;
use Illuminate\Http\Request;

class PenghuniController extends Controller
{
    // Menampilkan daftar semua penghuni
    public function index()
    {
        $penghuni = Penghuni::with('kamar')->get();
        // dd($penghuni);
        return view('admin.penghuni', compact('penghuni'));
    }

    // Menampilkan form tambah penghuni
    public function create()
    {
        $kamar = Kamar::where('status', 'Tersedia')->get();
        return view('admin.penghuni-create', compact('kamar'));
    }

    // Menyimpan data penghuni baru
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:penghunis,nik',
            'nama_lengkap' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'kamar_id' => 'required|exists:kamar,id',
        ]);

        $penghuni = Penghuni::create($request->all());

        // Update status kamar jadi "Terisi"
        $kamar = Kamar::find($request->kamar_id);
        $kamar->update(['status' => 'Terisi']);

        return redirect()->route('penghuni.index')->with('success', 'Penghuni berhasil ditambahkan.');
    }

    // Menampilkan form edit penghuni
    public function edit($id)
    {
        $penghuni = Penghuni::findOrFail($id);
        $kamar = Kamar::all();
        return view('admin.penghuni-edit', compact('penghuni', 'kamar'));
    }

    // Menyimpan perubahan data penghuni
    public function update(Request $request, $id)
    {
        $penghuni = Penghuni::findOrFail($id);

        $request->validate([
            'nik' => 'required|unique:penghunis,nik,' . $penghuni->id,
            'nama_lengkap' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'kamar_id' => 'required|exists:kamar,id',
        ]);

        // Update status kamar lama jadi tersedia jika berubah
        if ($penghuni->kamar_id != $request->kamar_id) {
            Kamar::find($penghuni->kamar_id)->update(['status' => 'Tersedia']);
            Kamar::find($request->kamar_id)->update(['status' => 'Terisi']);
        }

        $penghuni->update($request->all());

        return redirect()->route('penghuni.index')->with('success', 'Data penghuni berhasil diperbarui.');
    }

    // Menghapus penghuni
    public function destroy($id)
    {
        $penghuni = Penghuni::findOrFail($id);

        // Kembalikan status kamar menjadi tersedia
        if ($penghuni->kamar) {
            $penghuni->kamar->update(['status' => 'Tersedia']);
        }

        $penghuni->delete();

        return redirect()->route('penghuni.index')->with('success', 'Penghuni berhasil dihapus.');
    }
}
