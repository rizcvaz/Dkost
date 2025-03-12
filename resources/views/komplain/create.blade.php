@extends('layouts.user')

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
        <h2 class="fw-bold">Buat Komplain</h2>
    </div>

    <!-- Tabel Data Kamar -->
    <div class="table-responsive">
<form action="{{ route('komplain.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="kategori" class="form-label">Kategori</label>
        <select name="kategori" id="kategori" class="form-control" required>
            <option value="">Pilih Kategori</option>
            <option value="fasilitas">Fasilitas</option>
            <option value="keamanan">Keamanan</option>
            <option value="kegaduhan">Kegaduhan</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Kirim Komplain</button>
</form>
@endsection
