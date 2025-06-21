<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemesanan;

class KamarController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil data kamar berdasarkan pemesanan yang disetujui
        $pemesanan = Pemesanan::with('kamar')
            ->where('user_id', $user->id)
            ->where('status', 'dibayar')
            ->first();

        return view('user.kamar', compact('pemesanan'));
    }
}
