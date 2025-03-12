<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSewa;

class PenghuniController extends Controller
{
    public function index()
    {
        // Ambil data penghuni dengan status "disetujui" dari tabel pengajuan_sewa
        $penghuni = PengajuanSewa::select('nama_lengkap', 'alamat', 'no_hp', 'email', 'status')
            ->where('status', 'approved')  // Status yang benar adalah "approved"
            ->get();

        // Kirim data penghuni ke view
        return view('penghuni.index', compact('penghuni'));
    }
}


