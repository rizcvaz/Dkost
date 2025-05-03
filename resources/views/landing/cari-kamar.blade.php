@extends('layouts.master')

@section('content')
<h1 style="text-align: center; color: #fff;">Silahkan Pilih Kamar</h1>

<div class="container">
    <div class="products-container">
        @foreach ($kamar as $k)
        <div class="product" data-name="kamar-{{ $k->id }}">
            <img src="{{ asset('images/kamar.png') }}" alt="Kamar {{ $k->nomor_kamar }}">
            <h3>Kamar {{ $k->nomor_kamar }}</h3>
            <div class="status" style="margin-bottom: 0.5rem;">
                Status: 
                <span style="color: {{ $k->status == 'Tersedia' ? '#00ff99' : '#ff4d4d' }}">
                    {{ $k->status }}
                </span>
            </div>
            <div class="price">Rp {{ number_format($k->harga, 0, ',', '.') }}</div>
        </div>
        @endforeach
    </div>
</div>
@endsection
