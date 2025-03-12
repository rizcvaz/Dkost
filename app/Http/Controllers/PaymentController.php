<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function pay($id)
    {
        $tagihan = Tagihan::with('user')->findOrFail($id);

        return view('tagihan.pay', compact('tagihan'));
    }

    public function checkout(Request $request)
    {
        $tagihan = Tagihan::with('user')->findOrFail($request->id);

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $tagihan->id . '-' . time(),
                'gross_amount' => $tagihan->jumlah,
            ],
            'customer_details' => [
                'first_name' => $tagihan->user->name,
                'email' => $tagihan->user->email,
                'phone' => $tagihan->user->phone_number ?? '081234567890',
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json(['snapToken' => $snapToken]);
    }
    public function notificationHandler(Request $request)
{
    // Ambil data request
    $serverKey = config('midtrans.server_key');
    $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);

    // Verifikasi signature key
    if ($hashed !== $request->signature_key) {
        return response()->json(['message' => 'Invalid signature key'], 403);
    }

    // Ekstraksi ID Tagihan
    $orderIdParts = explode('-', $request->order_id); // Pecah ID
    $tagihanId = $orderIdParts[1]; // Ambil angka ke-2 dari 'ORDER-6-xxxx'

    // Cek tagihan di database
    $tagihan = Tagihan::find($tagihanId);

    if (!$tagihan) {
        return response()->json(['message' => 'Tagihan tidak ditemukan'], 404);
    }

    // Update status pembayaran
    if ($request->transaction_status == 'capture' && $request->fraud_status == 'accept') {
        $tagihan->status = 'lunas';
    } elseif ($request->transaction_status == 'pending') {
        $tagihan->status = 'menunggu';
    } elseif (in_array($request->transaction_status, ['cancel', 'deny', 'expire'])) {
        $tagihan->status = 'batal';
    }

    $tagihan->save();

    return response()->json(['message' => 'Status pembayaran diperbarui'], 200);
}
}
