<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Laporan Keuangan</h1>
    <p>Periode: {{ date('F', mktime(0, 0, 0, $bulan, 1)) }} {{ $tahun }}</p>

    <table>
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
            @foreach ($laporan as $lapor)
                <tr>
                    <td>{{ $lapor->user->name }}</td>
                    <td>{{ $lapor->user->email }}</td>
                    <td>{{ date('F Y', strtotime($lapor->periode)) }}</td>
                    <td>Rp {{ number_format($lapor->jumlah, 2, ',', '.') }}</td>
                    <td>{{ $lapor->status }}</td>
                    <td>{{ $lapor->updated_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total Pendapatan: Rp {{ number_format($totalPendapatan, 2, ',', '.') }}</h3>
</body>
</html>
