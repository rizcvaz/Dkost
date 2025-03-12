@extends('layouts.user')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kamar</title>
    
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
    <div class="heading">
        <h2 class="fw-bold">Riwayat Pembayaran</h2>
    </div>

    <!-- Tabel Data Kamar -->
    <div class="table-responsive">
         <!-- Tombol Tambah -->
<table class="table">
    <thead>
        <tr>
            <th>Periode</th>
            <th>Jumlah</th>
            <th>Status</th>
            <th>Tanggal Bayar</th>
        </tr>
    </thead>
    <tbody>
        @forelse($history as $item)
            <tr>
                <td>{{ \Carbon\Carbon::parse($item->periode)->format('F Y') }}</td>
                <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                <td><span class="badge bg-success">{{ ucfirst($item->status) }}</span></td>
                <td>{{ $item->updated_at->format('d M Y') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada riwayat pembayaran.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
