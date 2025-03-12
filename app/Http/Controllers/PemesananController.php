<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kamar; // Sesuaikan dengan model yang digunakan
// use App\Models\Pemesanan; // Sesuaikan jika model pemesanan ada
use App\Models\PengajuanSewa;
use App\Models\Tagihan;
use Carbon\Carbon;

class PemesananController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth'); // Wajib login
    // }

    // Menampilkan Form Pemesanan
    public function showForm($id)
    {
        // Ambil data kamar berdasarkan ID
        $kamar = Kamar::findOrFail($id);
        // Kirim data ke view
        return view('pemesanan.form', compact('kamar'));
    }

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'kamar_id' => 'required|exists:kamars,id',
            'nik' => 'required|numeric|digits:16|unique:pengajuan_sewa,nik',
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email',
            'no_hp' => 'required|regex:/^08[0-9]{8,11}$/', // Validasi nomor HP Indonesia
            'alamat' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

       // Simpan data ke tabel pengajuan_sewa
    $pengajuan = PengajuanSewa::create([
    'user_id' => Auth::id(), // Ambil ID user yang sedang login
    'kamar_id' => $request->kamar_id, // Tambahkan kamar_id
    'nik' => $request->nik,
    'nama_lengkap' => $request->nama_lengkap,
    'email' => $request->email,
    'no_hp' => $request->no_hp,
    'alamat' => $request->alamat,
    'tanggal_mulai' => $request->tanggal_mulai,
    'tanggal_akhir' => $request->tanggal_akhir,
    'status' => 'pending', // Default status pengajuan
    ]);

 // Redirect ke halaman sukses atau halaman lain
 return redirect()->route('sewa-kamar.index')->with('success', 'Pengajuan sewa berhasil dikirim. Menunggu persetujuan admin.');
}

    // Menampilkan Daftar Pengajuan di Dashboard Admin
public function index()
{
    $pengajuan = PengajuanSewa::where('status', 'pending')->get();
    return view('dashboard.pengajuan.index', compact('pengajuan'));
}

// Menyetujui Pengajuan
public function approve($id)
{
    $pengajuan = PengajuanSewa::findOrFail($id);

    // Update status pengajuan
    $pengajuan->update(['status' => 'approved']);

    // Ambil informasi kamar
    $kamar = $pengajuan->kamar;

    // Perbarui status kamar menjadi 'Penuh'
    $kamar->update(['status' => 'Penuh']);

    // Buat tagihan otomatis
    Tagihan::create([
        'user_id' => $pengajuan->user_id,
        'kamar_id' => $pengajuan->kamar_id,
        'periode' => Carbon::now()->format('Y-m-01'), // Awal bulan ini
        'jumlah' => $kamar->harga, // Harga kamar dari relasi
        'status' => 'belum dibayar',
    ]);

    return redirect()->route('dashboard.pengajuan.index')->with('success', 'Pengajuan berhasil disetujui dan tagihan telah dibuat.');
}

// Menolak Pengajuan
public function reject($id)
{
    $pengajuan = PengajuanSewa::findOrFail($id);
    $pengajuan->update(['status' => 'rejected']);

    return redirect()->route('dashboard.pengajuan.index')->with('success', 'Pengajuan berhasil ditolak.');
}

}  
