<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // Tambahkan untuk export PDF
use Maatwebsite\Excel\Facades\Excel; // Tambahkan untuk export Excel
use App\Exports\LaporanExport; // Tambahkan export Excel

class LaporanController extends Controller
{
    // Fungsi untuk menampilkan laporan keuangan dengan filter periode
    public function keuangan(Request $request)
    {
        // Filter berdasarkan bulan dan tahun
        $bulan = $request->get('bulan') ?? date('m');
        $tahun = $request->get('tahun') ?? date('Y');
    
        // Query data tagihan yang lunas
        $laporan = Tagihan::with('user')
            ->where('status', 'lunas')
            ->whereMonth('periode', $bulan)
            ->whereYear('periode', $tahun)
            ->get();
    
        $totalPendapatan = $laporan->sum('jumlah');
    
        // Tangani ekspor
        if ($request->get('type') === 'pdf') {
            $pdf = PDF::loadView('laporan.keuangan_pdf', compact('laporan', 'bulan', 'tahun', 'totalPendapatan'));
            return $pdf->download('Laporan_Keuangan_' . $bulan . '_' . $tahun . '.pdf');
        }
    
        if ($request->get('type') === 'excel') {
            return Excel::download(new LaporanExport($bulan, $tahun), 'Laporan_Keuangan_' . $bulan . '_' . $tahun . '.xlsx');
        }
    
        // Tampilkan halaman laporan
        return view('laporan.keuangan', compact('laporan', 'bulan', 'tahun', 'totalPendapatan'));
    }

    // Fungsi untuk export PDF
    public function exportPDF(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        $laporan = Tagihan::with('user')
            ->where('status', 'lunas')
            ->whereMonth('periode', $bulan)
            ->whereYear('periode', $tahun)
            ->orderBy('updated_at', 'desc')
            ->get();

        $totalPendapatan = $laporan->sum('jumlah');

        $pdf = Pdf::loadView('laporan.keuangan_pdf', compact('laporan', 'bulan', 'tahun', 'totalPendapatan'));
        return $pdf->download('laporan-keuangan.pdf');
    }

    // Fungsi untuk export Excel
    public function exportExcel(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        return Excel::download(new LaporanExport($bulan, $tahun), 'laporan-keuangan.xlsx');
    }
}
