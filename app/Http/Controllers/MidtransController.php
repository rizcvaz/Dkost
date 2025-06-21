<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;
use App\Models\Pemesanan;
use App\Models\Kamar;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        // Setup midtrans config
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Buat instance Midtrans Notification
        $notification = new Notification();

        // Ambil data transaksi
        $transactionStatus = $notification->transaction_status;
        $orderId = $notification->order_id;
        $fraudStatus = $notification->fraud_status;

        // Cari data pemesanan berdasarkan order_id
        $pemesanan = Pemesanan::where('order_id', $orderId)->first();

        if (!$pemesanan) {
            return response()->json(['message' => 'Order ID tidak ditemukan'], 404);
        }

        // Handle status transaksi
        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                // pembayaran challenge, update status jadi 'pending'
                $pemesanan->status = 'pending';
            } else if ($fraudStatus == 'accept') {
                // pembayaran sukses
                $pemesanan->status = 'paid';

                // Update status kamar jadi 'Terisi'
                $kamar = Kamar::find($pemesanan->kamar_id);
                if ($kamar) {
                    $kamar->status = 'Terisi';
                    $kamar->save();
                }
            }
        } else if ($transactionStatus == 'settlement') {
            // Pembayaran sudah selesai
            $pemesanan->status = 'paid';

            // Update status kamar jadi 'Terisi'
            $kamar = Kamar::find($pemesanan->kamar_id);
            if ($kamar) {
                $kamar->status = 'Terisi';
                $kamar->save();
            }
        } else if ($transactionStatus == 'deny' || $transactionStatus == 'cancel' || $transactionStatus == 'expire') {
            // Pembayaran gagal atau dibatalkan
            $pemesanan->status = 'failed';
        } else if ($transactionStatus == 'pending') {
            $pemesanan->status = 'pending';
        }

        $pemesanan->save();

        return response()->json(['message' => 'OK']);
    }
}
