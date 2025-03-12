<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tagihan;
use Illuminate\Support\Facades\Auth;

class TagihanController extends Controller
{
    public function index()
    {
        $tagihan = Tagihan::where('user_id', Auth::id())->get();
        return view('tagihan.index', compact('tagihan'));
    }
    // Menampilkan Daftar Tagihan di Dashboard Admin
    public function indexAdmin()
    {
    // Ambil semua tagihan dan data user
    $tagihan = Tagihan::with('user')->get();
    $users = User::all(); // Tambahkan variabel users

    // Kirim data users ke view
    return view('tagihan.tagihan', compact('tagihan', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'periode' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'status' => 'required|in:belum dibayar,lunas',
        ]);
    
        // Cari kamar yang sedang ditempati oleh user
        $user = User::with('kamar')->findOrFail($request->user_id);
        if (!$user->kamar) {
            return redirect()->route('admin.tagihan.index')
                             ->with('error', 'User ini belum memiliki kamar.');
        }
    
        // Buat tagihan dengan data kamar_id
        Tagihan::create([
            'user_id' => $request->user_id,
            'kamar_id' => $user->kamar->id, // Ambil id kamar dari user
            'periode' => $request->periode,
            'jumlah' => $request->jumlah,
            'status' => $request->status,
        ]);
    
        return redirect()->route('admin.tagihan.index')->with('success', 'Tagihan berhasil ditambahkan.');
    }

public function update(Request $request, $id)
{
    $request->validate([
        'jumlah' => 'required|numeric|min:0',
        'status' => 'required|in:belum dibayar,lunas',
    ]);

    $tagihan = Tagihan::findOrFail($id);
    $tagihan->update($request->all());

    return redirect()->route('admin.tagihan.index')->with('success', 'Tagihan berhasil diperbarui.');
}

public function destroy($id)
{
    Tagihan::findOrFail($id)->delete();
    return redirect()->route('admin.tagihan.index')->with('success', 'Tagihan berhasil dihapus.');
}


}
