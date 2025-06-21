<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penghuni;
use App\Models\Kamar;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PesanKamarController extends Controller
{
    public function form($id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('landing.pesan-kamar', compact('kamar'));
    }

   public function store(Request $request, $id)
{
    $request->validate([
        'nik' => 'required|unique:pemesanan,nik',
        'nama_lengkap' => 'required',
        'alamat' => 'required',
        'no_hp' => 'required',
        'email' => 'required|email',
    ]);

    $kamar = Kamar::findOrFail($id);
    $orderId = 'ORDER-' . uniqid();

    // Simpan ke tabel 'pemesanan' dulu
   try {
    $pemesanan = Pemesanan::create([
        'order_id' => $orderId,
        'kamar_id' => $kamar->id,
        'user_id' => Auth::id(),
        'nik' => $request->nik,
        'nama_lengkap' => $request->nama_lengkap,
        'alamat' => $request->alamat,
        'no_hp' => $request->no_hp,
        'email' => $request->email,
        'status' => 'pending',
        'jumlah_tagihan' => $kamar->harga,
    ]);
    Log::info('Pemesanan berhasil disimpan', ['pemesanan' => $pemesanan]);
} catch (\Exception $e) {
    Log::error('Gagal menyimpan pemesanan: ' . $e->getMessage());
    return back()->withErrors('Terjadi kesalahan saat menyimpan data pemesanan.');
}

    

    // Konfigurasi Midtrans
    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = config('midtrans.is_production');
    Config::$isSanitized = true;
    Config::$is3ds = true;

    $params = [
        'transaction_details' => [
            'order_id' => $orderId,
            'gross_amount' => $kamar->harga,
        ],
        'customer_details' => [
            'first_name' => $request->nama_lengkap,
            'email' => $request->email,
            'phone' => $request->no_hp,
        ],
    ];

    $snapToken = Snap::getSnapToken($params);

    return view('checkout.pembayaran', [
        'snapToken' => $snapToken,
        'kamar' => $kamar,
        'pemesanan' => $pemesanan,
    ]);
}
}