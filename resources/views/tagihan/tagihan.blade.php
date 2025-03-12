@extends('layouts.admin')

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
            <div class="d-flex justify-content my-2">
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addTagihanModal"> <i class="bx bx-plus"></i> Buat Tagihan</button>
            </div>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Penyewa</th>
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
                    <td>{{ $t->user->name }}</td>
                    <td>{{ date('F Y', strtotime($t->periode)) }}</td>
                    <td>Rp {{ number_format($t->jumlah, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge {{ $t->status == 'lunas' ? 'bg-success' : 'bg-warning' }}">
                            {{ $t->status }}
                        </span>
                    </td>
                    <td>
                        <!-- Tombol Edit -->
                        <button class="btn btn-sm btn-warning" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editTagihanModal{{ $t->id }}">
                            Edit
                        </button>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('admin.tagihan.destroy', $t->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editTagihanModal{{ $t->id }}" tabindex="-1" aria-labelledby="editTagihanLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('admin.tagihan.update', $t->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Tagihan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="jumlah" class="form-label">Jumlah</label>
                                        <input type="number" name="jumlah" class="form-control" value="{{ $t->jumlah }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" class="form-select" required>
                                            <option value="belum dibayar" {{ $t->status == 'belum dibayar' ? 'selected' : '' }}>Belum Dibayar</option>
                                            <option value="lunas" {{ $t->status == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Tambah Tagihan -->
<div class="modal fade" id="addTagihanModal" tabindex="-1" aria-labelledby="addTagihanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.tagihan.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Tagihan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Penyewa</label>
                        <select name="user_id" class="form-select" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="periode" class="form-label">Periode</label>
                        <input type="date" name="periode" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="belum dibayar">Belum Dibayar</option>
                            <option value="lunas">Lunas</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
