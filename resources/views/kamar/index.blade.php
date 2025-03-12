@extends('layouts.admin')

@section('content')

<!DOCTYPE html>
<html lang="en">
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
        <h2 class="fw-bold">Data Kamar</h2>
    </div>

    <!-- Tabel Data Kamar -->
    <div class="table-responsive">
         <!-- Tombol Tambah -->
    <div class="d-flex justify-content my-2">
        <button class="btn btn-primary" onclick="openModal('modalTambahKamar')">
            <i class="bx bx-plus"></i> Tambah
        </button>
    </div>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nomor Kamar</th>
                    <th>Fasilitas</th>
                    <th>Lantai</th>
                    <th>Ukuran Kamar</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kamars as $kamar)
                <tr>
                    <td>{{ $kamar->nomor_kamar }}</td>
                    <td>{{ $kamar->fasilitas }}</td>
                    <td>{{ $kamar->lantai }}</td>
                    <td>{{ $kamar->ukuran_kamar }}</td>
                    <td>Rp{{ number_format($kamar->harga, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge {{ $kamar->status == 'Kosong' ? 'bg-success' : 'bg-danger' }}">
                            {{ $kamar->status }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="openEditModal(
                            '{{ $kamar->id }}',
                            '{{ $kamar->nomor_kamar }}',
                            '{{ $kamar->fasilitas }}',
                            '{{ $kamar->lantai }}',
                            '{{ $kamar->ukuran_kamar }}',
                            '{{ $kamar->harga }}',
                            '{{ $kamar->status }}'
                        )">
                            <i class="bx bx-edit"></i> Edit
                        </button>
                        <form action="{{ route('kamar.destroy', $kamar->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">
                                <i class="bx bx-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>

<!-- Modal Edit Data -->
<div id="modalEditKamar" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1050; justify-content: center; align-items: center;">
    <div class="modal-content" style="background: white; padding: 20px; border-radius: 5px; width: 500px; position: relative;">
        <button class="close btn-close" style="position: absolute; top: 10px; right: 10px;" onclick="closeModal('modalEditKamar')"></button>
        <h3 class="fw-bold mb-3">Edit Data Kamar</h3>
        <form id="editKamarForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="editId">
            <div class="mb-3">
                <label for="editNomorKamar" class="form-label">Nomor Kamar</label>
                <input type="text" name="nomor_kamar" id="editNomorKamar" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="editFasilitas" class="form-label">Fasilitas</label>
                <input type="text" name="fasilitas" id="editFasilitas" class="form-control">
            </div>
            <div class="mb-3">
                <label for="editLantai" class="form-label">Lantai</label>
                <input type="number" name="lantai" id="editLantai" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="editUkuranKamar" class="form-label">Ukuran Kamar</label>
                <input type="text" name="ukuran_kamar" id="editUkuranKamar" class="form-control">
            </div>
            <div class="mb-3">
                <label for="editHarga" class="form-label">Harga</label>
                <input type="number" name="harga" id="editHarga" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="editStatus" class="form-label">Status</label>
                <select name="status" id="editStatus" class="form-select">
                    <option value="Kosong">Kosong</option>
                    <option value="Penuh">Penuh</option>
                </select>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal('modalEditKamar')">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Fungsi untuk membuka modal Tambah/Edit
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = "flex";
        }
    }

    // Fungsi untuk menutup modal Tambah/Edit
    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = "none";
        }
    }

    // Fungsi untuk membuka modal Edit dengan data spesifik
    function openEditModal(id, nomorKamar, fasilitas, lantai, ukuranKamar, harga, status) {
        const modal = document.getElementById('modalEditKamar');
        const form = document.getElementById('editKamarForm');
        
        // Set nilai input pada modal
        document.getElementById('editId').value = id;
        document.getElementById('editNomorKamar').value = nomorKamar;
        document.getElementById('editFasilitas').value = fasilitas;
        document.getElementById('editLantai').value = lantai;
        document.getElementById('editUkuranKamar').value = ukuranKamar;
        document.getElementById('editHarga').value = harga;
        document.getElementById('editStatus').value = status;

        // Update action form untuk mengarah ke endpoint yang benar
        form.action = `/kamar/${id}`;

        // Tampilkan modal
        modal.style.display = "flex";
    }
</script>


<!-- Modal Tambah Data -->
<div id="modalTambahKamar" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1050; justify-content: center; align-items: center;">
    <div class="modal-content" style="background: white; padding: 20px; border-radius: 5px; width: 500px; position: relative;">
        <button class="close btn-close" style="position: absolute; top: 10px; right: 10px;" onclick="closeModal('modalTambahKamar')"></button>
        <h3 class="fw-bold mb-3">Tambah Data Kamar</h3>
        <form action="{{ route('kamar.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nomor_kamar" class="form-label">Nomor Kamar</label>
                <input type="text" name="nomor_kamar" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="fasilitas" class="form-label">Fasilitas</label>
                <input type="text" name="fasilitas" class="form-control">
            </div>
            <div class="mb-3">
                <label for="lantai" class="form-label">Lantai</label>
                <input type="number" name="lantai" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="ukuran_kamar" class="form-label">Ukuran Kamar</label>
                <input type="text" name="ukuran_kamar" class="form-control">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="Kosong">Kosong</option>
                    <option value="Penuh">Penuh</option>
                </select>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal('modalTambahKamar')">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Fungsi untuk membuka modal
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = "flex";
        }
    }

    // Fungsi untuk menutup modal
    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = "none";
        }
    }
</script>

@endsection
