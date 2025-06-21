@extends('layouts.app2')

@section('content')
<div class="container">
    <h2 class="header">Kamar Saya</h2>

   @if($pemesanan && $pemesanan->kamar)
    <div class="card">
        <div class="card-body">
            <h5>Nomor Kamar: {{ $pemesanan->kamar->nomor_kamar }}</h5>
            <p>Fasilitas: {{ $pemesanan->kamar->fasilitas }}</p>
            <p>Lantai: {{ $pemesanan->kamar->lantai }}</p>
            <p>Ukuran: {{ $pemesanan->kamar->ukuran_kamar }}</p>
            <p>Harga: Rp{{ number_format($pemesanan->kamar->harga, 0, ',', '.') }}</p>
            <p>Status: <span class="status status-tersedia">Disewa</span></p>
        </div>
    </div>
@else
    <p>Anda belum memiliki kamar.</p>
@endif

</div>
@endsection
