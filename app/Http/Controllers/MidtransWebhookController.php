<?php

// app/Http/Controllers/MidtransWebhookController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Kamar;
use Midtrans\Config;
use Midtrans\Notification;
use Illuminate\Support\Facades\Log;


class MidtransWebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        $notif = new Notification();

        $transaction = $notif->transaction_status;
        $orderId = $notif->order_id;

        $pemesanan = Pemesanan::where('order_id', $orderId)->first();

        if (!$pemesanan) {
            return response()->json(['message' => 'Pemesanan tidak ditemukan'], 404);
        }

        if ($transaction === 'settlement' || $transaction === 'capture') {
            // Pembayaran berhasil
            $pemesanan->status = 'berhasil';
            $pemesanan->save();

            $kamar = $pemesanan->kamar;
            if ($kamar) {
                $kamar->status = 'Terisi';
                $kamar->save();
                Log::info("Kamar ID {$kamar->id} diubah jadi terisi.");
            }
        } elseif ($transaction === 'pending') {
            $pemesanan->status = 'pending';
            $pemesanan->save();
        } elseif (in_array($transaction, ['expire', 'cancel', 'deny'])) {
            $pemesanan->status = 'gagal';
            $pemesanan->save();
            Log::warning("Kamar tidak ditemukan untuk pemesanan ID {$pemesanan->id}");
        }

        return response()->json(['message' => 'Notifikasi diproses']);
    }
}

