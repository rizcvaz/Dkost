<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Pemesanan;
use App\Models\Penghuni;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function process(Request $request, $id)
{
    $kamar = Kamar::findOrFail($id);

    $orderId = 'ORDER-' . uniqid();

    // Midtrans config
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

    // Simpan data ke tabel pemesanan
    $pemesanan = new Pemesanan();
    $pemesanan->order_id = $orderId;
    $pemesanan->user_id = Auth::id();
    $pemesanan->kamar_id = $kamar->id;
    $pemesanan->nama_lengkap = $request->nama_lengkap;
    $pemesanan->email = $request->email;
    $pemesanan->no_hp = $request->no_hp;
    $pemesanan->status = 'pending';
    $pemesanan->save();

    return view('checkout.pembayaran', compact('snapToken', 'kamar', 'orderId'));
}

  public function callback(Request $request)
{
    Log::info('Callback diterima', ['payload' => $request->getContent()]);
    try {
        $notif = json_decode($request->getContent());
        $orderId = $notif->order_id ?? null;

        if (!$orderId) {
            return response()->json(['message' => 'Order ID not found'], 400);
        }

        $pemesanan = Pemesanan::where('order_id', $orderId)->first();
        if (!$pemesanan) {
            return response()->json(['message' => 'Pemesanan not found'], 404);
        }

        $transactionStatus = $notif->transaction_status ?? null;
        $fraudStatus = $notif->fraud_status ?? null;

        if ($transactionStatus === 'capture' && $fraudStatus === 'accept') {
            $pemesanan->status = 'dibayar';
        } elseif ($transactionStatus === 'settlement') {
            $pemesanan->status = 'dibayar';
        } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
            $pemesanan->status = 'gagal';
        } elseif ($transactionStatus === 'pending') {
            $pemesanan->status = 'pending';
        }

        Log::info("Mengupdate status pemesanan menjadi: {$pemesanan->status}");


        $pemesanan->save();

        // Jika sudah dibayar, maka update status kamar & tambahkan ke tabel penghuni
        if ($pemesanan->status === 'dibayar') {
            $kamar = Kamar::find($pemesanan->kamar_id);
            if ($kamar) {
                $kamar->status = 'Terisi';
                $kamar->save();
            }

            // Cek dan tambahkan ke tabel penghuni
            $sudahPenghuni = Penghuni::where('email', $pemesanan->email)->first();
            if (!$sudahPenghuni) {
                Penghuni::create([
                    'kamar_id' => $pemesanan->kamar_id,
                    'user_id' => $pemesanan->user_id,
                    'nik' => $pemesanan->nik ?? '-', // fallback jika tidak tersedia
                    'nama_lengkap' => $pemesanan->nama_lengkap,
                    'alamat' => $pemesanan->alamat ?? '-',
                    'no_hp' => $pemesanan->no_hp,
                    'email' => $pemesanan->email,
                    'status' => 'Aktif', // tambahkan jika kolom `status` tersedia
                ]);
            }
        }

        Log::info("Status berhasil disimpan untuk order_id: {$pemesanan->order_id}");

        return response()->json(['message' => 'Webhook processed']);
    } catch (\Exception $e) {
        Log::error('Midtrans callback error', ['error' => $e->getMessage()]);
        return response()->json(['message' => 'Webhook failed', 'error' => $e->getMessage()], 500);
    }
}
}

