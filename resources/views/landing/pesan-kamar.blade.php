@extends('layouts.master')

@section('content')
<div class="container">
    <h2 style="color: #fff;">Form Pemesanan Kamar {{ $kamar->nomor_kamar }}</h2>

    <form action="{{ url('/pesan-kamar/' . $kamar->id) }}" method="POST" style="background: #272734; padding: 20px; border-radius: 10px;">
        @csrf

        <div class="form-group">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Pemesanan</button>
    </form>
</div>
@endsection
