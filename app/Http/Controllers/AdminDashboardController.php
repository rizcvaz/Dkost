<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanSewa;
use App\Models\Tagihan;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah penghuni yang disetujui
        $jumlahPenghuni = PengajuanSewa::where('status', 'approved')->count();

        // Hitung total pemasukan
        $totalPemasukan = Tagihan::where('status', 'lunas')->sum('jumlah');

        // Ambil data pemasukan per bulan
        $pemasukanBulanan = Tagihan::selectRaw('MONTH(periode) as bulan, SUM(jumlah) as total')
            ->where('status', 'lunas')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $bulan = [];
        $pendapatan = [];
        foreach ($pemasukanBulanan as $data) {
            $bulan[] = date('F', mktime(0, 0, 0, $data->bulan, 10)); // Format nama bulan
            $pendapatan[] = $data->total;
        }

        return view('dashboard.admin', compact('jumlahPenghuni', 'totalPemasukan', 'bulan', 'pendapatan'));
    }
}
