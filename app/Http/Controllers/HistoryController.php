<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Tagihan; // Model untuk tagihan
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        // Ambil riwayat pembayaran dengan status lunas berdasarkan user yang login
        $history = Tagihan::where('user_id', Auth::id(),)
                          ->where('status', 'lunas')
                          ->orderBy('periode', 'desc') // Urutkan berdasarkan periode terbaru
                          ->get();

        return view('history.index', compact('history'));
    }
}
