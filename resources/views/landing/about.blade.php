{{-- filepath: c:\laragon\www\D-kost\Dkost\resources\views\landing\about.blade.php --}}
@extends('layouts.master')

@section('title', 'Tentang Kami')

@section('content')
<div class="about-container mt-5">
    <h1 class="about-title text-center">Tentang Kami</h1>
    <p class="about-description text-center mt-3">
        Selamat datang di <strong>D-Kost</strong>, platform sistem informasi kos-kosan yang memudahkan Anda dalam mencari dan mengelola informasi kos-kosan terbaik.
    </p>
    <div class="about-row row mt-5">
        <div class="about-col col-md-6">
            <h3 class="about-subtitle">Visi Kami</h3>
            <p class="about-text">
                Menjadi platform terpercaya dalam menyediakan informasi kos-kosan yang lengkap, akurat, dan mudah diakses oleh semua orang.
            </p>
        </div>
        <div class="about-col col-md-6">
            <h3 class="about-subtitle">Misi Kami</h3>
            <ul class="about-list">
                <li class="about-list-item">Menyediakan informasi kos-kosan yang terverifikasi dan terpercaya.</li>
                <li class="about-list-item">Mempermudah pencarian kos-kosan sesuai kebutuhan pengguna.</li>
                <li class="about-list-item">Mendukung pemilik kos dalam mempromosikan properti mereka secara efektif.</li>
            </ul>
        </div>
    </div>
    <div class="about-contact text-center mt-5">
        <h3 class="about-contact-title">Hubungi Kami</h3>
        <p class="about-contact-text">
            Jika Anda memiliki pertanyaan atau membutuhkan bantuan, jangan ragu untuk menghubungi kami melalui email di <a href="mailto:support@dkost.com" class="about-contact-link">support@dkost.com</a>.
        </p>
    </div>
</div>
@endsection