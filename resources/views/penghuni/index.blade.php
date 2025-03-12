@extends('layouts.admin')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penghuni</title>
    
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
        <h2 class="fw-bold">Daftar Penghuni</h2>
    </div>

    <!-- Tabel Data Kamar -->
    <div class="table-responsive">
         <!-- Tombol Tambah -->
    <div class="d-flex justify-content my-2">
    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Nama Lengkap</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Email</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penghuni as $huni)
                <tr>
                    <td>{{ $huni->nama_lengkap }}</td>
                    <td>{{ $huni->alamat }}</td>
                    <td>{{ $huni->no_hp }}</td>
                    <td>{{ $huni->email }}</td>
                    <td>{{ $huni->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</body>
@endsection
