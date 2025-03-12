@extends('layouts.user')

@section('content')

<head>
    <style>
        body {
            padding: 0;
            margin: 0;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .table-responsive {
            margin: 20px auto;
            max-width: 90%;
            border: 1px solid #bdc3c7;
            box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.2), -1px -1px 8px rgba(0, 0, 0, 0.2);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        thead.table-dark {
            background-color: #16a085;
            color: #fff;
        }

        h2 {
            font-weight: 600;
            text-align: center;
            background-color: #0f44d5;
            color: #fff;
            padding: 10px 0;
        }

        tr:hover {
            background-color: #f5f5f5;
            transform: scale(1.01);
            box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.2), -1px -1px 8px rgba(0, 0, 0, 0.2);
        }

        @media only screen and (max-width: 768px) {
            table {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <h2 class="fw-bold">Daftar Tagihan</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Periode</th>
            <th>Jumlah</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tagihan as $key => $t)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ date('F Y', strtotime($t->periode)) }}</td>
                <td>Rp {{ number_format($t->jumlah, 0, ',', '.') }}</td>
                <td>{{ $t->status }}</td>
                <td>
                    @if($t->status == 'belum dibayar')
                    <a href="{{ route('tagihan.pay', $t->id) }}" class="btn btn-primary">Bayar</a>
                    @else
                        <span class="text-success">Lunas</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</body>

<!-- Midtrans Snap JS -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<!-- JavaScript untuk Menampilkan Popup Midtrans -->
<script>
    function payWithMidtrans(snapToken) {
        window.snap.pay(snapToken, {
            onSuccess: function(result) {
                alert("Pembayaran berhasil!");
                location.reload(); // Refresh halaman setelah pembayaran sukses
            },
            onPending: function(result) {
                alert("Menunggu pembayaran!");
                console.log(result);
            },
            onError: function(result) {
                alert("Pembayaran gagal!");
                console.log(result);
            },
            onClose: function() {
                alert("Anda menutup jendela pembayaran.");
            }
        });
    }
</script>

@endsection
