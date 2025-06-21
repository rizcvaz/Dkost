@extends('layouts.master')

@section('content')
<div class="container mt-5 text-white">
    <h3>Pembayaran untuk kamar {{ $kamar->nomor_kamar }}</h3>
    <p>Total bayar: Rp{{ number_format($kamar->harga) }}</p>
    <button id="pay-button" class="btn btn-success">Bayar Sekarang</button>
</div>

<script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').addEventListener('click', function () {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function (result) {
                alert("Pembayaran berhasil!");
                window.location.href = "{{ route('cari-kamar') }}";
            },
            onPending: function (result) {
                alert("Menunggu pembayaran...");
            },
            onError: function (result) {
                alert("Pembayaran gagal!");
            }
        });
    });
</script>
@endsection
