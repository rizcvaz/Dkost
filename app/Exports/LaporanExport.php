<?php

namespace App\Exports;

use App\Models\Tagihan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromCollection, WithHeadings
{
    protected $bulan;
    protected $tahun;

    public function __construct($bulan, $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function collection()
    {
        return Tagihan::with('user')
            ->where('status', 'lunas')
            ->whereMonth('periode', $this->bulan)
            ->whereYear('periode', $this->tahun)
            ->get()
            ->map(function ($item) {
                return [
                    'Nama Penghuni' => $item->user->name,
                    'Email' => $item->user->email,
                    'Periode' => date('F Y', strtotime($item->periode)),
                    'Jumlah' => $item->jumlah,
                    'Status' => $item->status,
                    'Tanggal Pembayaran' => $item->updated_at->format('d-m-Y'),
                ];
            });
    }

    public function headings(): array
    {
        return ['Nama Penghuni', 'Email', 'Periode', 'Jumlah', 'Status', 'Tanggal Pembayaran'];
    }
}
