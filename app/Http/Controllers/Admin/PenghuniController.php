<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penghuni;
use App\Models\Kamar;
use Illuminate\Http\Request;

class PenghuniController extends Controller
{
    // Tampilkan semua penghuni
    public function index()
    {
        $penghuni = Penghuni::with('kamar')->get();
        return view('admin.penghuni', compact('penghuni'));
    }

    // Tampilkan form tambah penghuni
    public function create()
    {
        $kamar = Kamar::where('status', 'Tersedia')->get();
        return view('admin.penghuni-create', compact('kamar'));
    }

    // Simpan data penghuni baru
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:penghuni,nik',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'kamar_id' => 'required|exists:kamar,id',
        ]);

        $penghuni = Penghuni::create($request->all());

        // Set kamar jadi "Terisi"
        $penghuni->kamar->update(['status' => 'Terisi']);

        return redirect()->route('penghuni.index')->with('success', 'Penghuni berhasil ditambahkan');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $penghuni = Penghuni::findOrFail($id);
        $kamar = Kamar::all();
        return view('admin.penghuni-edit', compact('penghuni', 'kamar'));
    }

    // Simpan perubahan data penghuni
    public function update(Request $request, $id)
    {
        $penghuni = Penghuni::findOrFail($id);

        $request->validate([
            'nik' => 'required|unique:penghuni,nik,' . $penghuni->id,
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'kamar_id' => 'required|exists:kamar,id',
        ]);

        // Update status kamar sebelumnya menjadi "Tersedia" jika kamar berubah
        if ($penghuni->kamar_id != $request->kamar_id) {
            $penghuni->kamar->update(['status' => 'Tersedia']);
            Kamar::find($request->kamar_id)->update(['status' => 'Terisi']);
        }

        $penghuni->update($request->all());

        return redirect()->route('penghuni.index')->with('success', 'Data penghuni berhasil diperbarui');
    }

    // Hapus data penghuni
    public function destroy($id)
    {
        $penghuni = Penghuni::findOrFail($id);

        // Kembalikan status kamar menjadi "Tersedia"
        if ($penghuni->kamar) {
            $penghuni->kamar->update(['status' => 'Tersedia']);
        }

        $penghuni->delete();

        return redirect()->route('penghuni.index')->with('success', 'Penghuni berhasil dihapus');
    }
}
