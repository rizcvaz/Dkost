@extends('layouts.admin')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komplain</title>
    
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
        <h2 class="fw-bold">Daftar Komplain</h2>
    </div>

    <!-- Tabel Data Kamar -->
    <div class="table-responsive">
         <!-- Tombol Tambah -->
    <div class="d-flex justify-content my-2">
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nama Penghuni</th>
            <th>Kategori</th>
            <th>Deskripsi</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($komplains as $komplain)
            <tr>
                <td>{{ $komplain->user->name }}</td>
                <td>{{ ucfirst($komplain->kategori) }}</td>
                <td>{{ $komplain->deskripsi }}</td>
                <td>{{ ucfirst($komplain->status) }}</td>
                <td>
                    <a href="#" class="btn btn-success btn-sm">Proses</a>
                    <a href="#" class="btn btn-danger btn-sm">Selesai</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
