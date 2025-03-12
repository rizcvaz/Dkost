<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\PengajuanSewa;

class DataDiriController extends Controller
{
    public function index()
    {
        // Ambil data diri berdasarkan user yang sedang login
        $dataDiri = PengajuanSewa::where('user_id', Auth::id())->first();

        return view('data-diri.index', compact('dataDiri'));
    }

    // Mengupdate Data Diri
    public function update(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|max:16',
            'nama_lengkap' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|max:255',
        ]);

        $dataDiri = PengajuanSewa::where('user_id',  Auth::id())->first();

        if ($dataDiri) {
            $dataDiri->update([
                'nik' => $request->nik,
                'nama_lengkap' => $request->nama_lengkap,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
            ]);

            return redirect()->route('data-diri.index')->with('success', 'Data berhasil diperbarui!');
        }

        return redirect()->route('data-diri.index')->with('error', 'Data tidak ditemukan.');
    }

}
