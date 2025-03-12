@extends('layouts.admin')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan</title>
    
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
        <h2 class="fw-bold">Data Kamar</h2>
    </div>
     <!-- Filter Form -->
     <form method="GET" action="{{ route('laporan.keuangan') }}" class="mb-4">
        <div class="row">
            <!-- Filter Bulan -->
            <div class="col-md-3">
                <label for="bulan">Bulan:</label>
                <select name="bulan" id="bulan" class="form-control">
                    @foreach(range(1, 12) as $m)
                        <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}" 
                            {{ $m == $bulan ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Tahun -->
            <div class="col-md-3">
                <label for="tahun">Tahun:</label>
                <select name="tahun" id="tahun" class="form-control">
                    @foreach(range(date('Y') - 5, date('Y')) as $y)
                        <option value="{{ $y }}" {{ $y == $tahun ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tombol Filter -->
            <div class="col-md-3 align-self-end">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <!-- Tabel Data Kamar -->
    <div class="table-responsive">
        <div class="d-flex justify-content my-2">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownExportButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Export File
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownExportButton">
                    <li><a class="dropdown-item" href="{{ route('laporan.keuangan') }}?bulan={{ $bulan }}&tahun={{ $tahun }}&type=pdf">Export PDF</a></li>
                    <li><a class="dropdown-item" href="{{ route('laporan.keuangan') }}?bulan={{ $bulan }}&tahun={{ $tahun }}&type=excel">Export Excel</a></li>
                </ul>
            </div>
        </div>

    <!-- Tabel Laporan -->
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Nama Penghuni</th>
                <th>Email</th>
                <th>Periode</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Tanggal Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporan as $lapor)
                <tr>
                    <td>{{ $lapor->user->name }}</td>
                    <td>{{ $lapor->user->email }}</td>
                    <td>{{ date('F Y', strtotime($lapor->periode)) }}</td>
                    <td>Rp {{ number_format($lapor->jumlah, 2, ',', '.') }}</td>
                    <td><span class="badge bg-success">{{ $lapor->status }}</span></td>
                    <td>{{ $lapor->updated_at->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data untuk periode ini</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
