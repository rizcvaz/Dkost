@extends('layouts.user')

@section('content')
<div class="container">
    <h1>Bayar Tagihan</h1>
    <p>Tagihan: Rp {{ number_format($tagihan->jumlah, 0, ',', '.') }}</p>

    <button id="pay-button" class="btn btn-primary">Bayar Sekarang</button>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            fetch("{{ route('tagihan.checkout') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id: {{ $tagihan->id }} }) // Mengirimkan data tagihan dengan id yang benar
            })
            .then(response => response.json())
            .then(data => {
                if (data.snapToken) {
                    // Memanggil Midtrans Snap untuk memproses pembayaran
                    window.snap.pay(data.snapToken, {
                        onSuccess: function(result) {
                            alert("Pembayaran berhasil!");
                            location.reload(); // Reload halaman setelah pembayaran berhasil
                        },
                        onPending: function(result) {
                            alert("Pembayaran tertunda!");
                        },
                        onError: function(result) {
                            alert("Pembayaran gagal!");
                        }
                    });
                } else {
                    alert("Terjadi kesalahan, token pembayaran tidak ditemukan.");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Terjadi kesalahan saat menghubungi server.");
            });
        };
    </script>
</div>
@endsection
