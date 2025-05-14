@extends('layouts.master')


@section('title', 'Services | DeKost')

@section('content')
<section class="services-section">
  <h2 class="section-title">Layanan Kami</h2>
  <div class="services-container">
    <div class="service-card">
      <i class='bx bx-search-alt service-icon'></i>
      <h3>Pencarian & Pemesanan Kamar</h3>
      <p>Cari dan pesan kamar kos secara online sesuai kebutuhan kamu.</p>
    </div>
    <div class="service-card">
      <i class='bx bx-wallet service-icon'></i>
      <h3>Pengajuan & Pembayaran</h3>
      <p>Ajukan dan bayar sewa dengan mudah langsung dari aplikasi.</p>
    </div>
    <div class="service-card">
      <i class='bx bx-message-error service-icon'></i>
      <h3>Komplain Online</h3>
      <p>Sampaikan masalah kos kamu dan pantau penyelesaiannya.</p>
    </div>
    <div class="service-card">
      <i class='bx bx-group service-icon'></i>
      <h3>Manajemen Penghuni</h3>
      <p>Kelola data penghuni kos dengan lebih efisien.</p>
    </div>
    <div class="service-card">
      <i class='bx bx-bar-chart-alt service-icon'></i>
      <h3>Laporan Bulanan</h3>
      <p>Lihat rekap bulanan untuk pemasukan, komplain, dan pengajuan.</p>
    </div>
  </div>
</section>
@endsection
