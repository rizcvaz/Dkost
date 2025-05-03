@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="header">Data Kamar</h1>

    {{-- @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif --}}

    {{-- Tombol Tambah --}}
    <button onclick="openModal('modalTambahKamar')" class="button-add bx bx-plus">
        Tambah Kamar
    </button>
    

    {{-- Tabel Kamar --}}
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th data-label>#</th>
                    <th>Nomor</th>
                    <th>Fasilitas</th>
                    <th>Lantai</th>
                    <th>Ukuran</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kamar as $index => $k)
                <tr>
                    <td data-label="Nomor">{{ $index + 1 }}</td>
                    <td data-label="Nomor Kamar">{{ $k->nomor_kamar }}</td>
                    <td data-label="Fasilitas">{{ $k->fasilitas }}</td>
                    <td data-label="Lantai">{{ $k->lantai }}</td>
                    <td data-label="Ukuran">{{ $k->ukuran_kamar }}</td>
                    <td data-label="Harga">Rp{{ number_format($k->harga, 0, ',', '.') }}</td>
                    <td data-label="Status">
                        <span class="status {{ $k->status == 'Tersedia' ? 'status-tersedia' : 'status-terisi' }}">
                            {{ $k->status }}
                        </span>
                    </td>
                    <td class="space-x-2">
                        {{-- Tombol edit --}}
                        <button type="button"
                            onclick="openEditModal({{ $k->id }}, '{{ $k->nomor_kamar }}', '{{ $k->fasilitas }}', {{ $k->lantai }}, '{{ $k->ukuran_kamar }}', {{ $k->harga }}, '{{ $k->status }}')"
                            class="button-edit bx bx-edit">Edit</button>

                            <form action="{{ route('kamar.destroy', $k->id) }}" method="POST" class="form-delete inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button-delete bx bx-trash">Hapus</button>
                            </form>                            
                    </td>
                </tr>
                @endforeach

                @if($kamar->isEmpty())
                <tr>
                    <td colspan="8" class="text-center py-4 text-gray-500 dark:text-gray-400">Belum ada data kamar.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Kamar -->
<div id="modalTambahKamar" class="modal">
    <div class="modal-content">
        <button class="close-btn" onclick="closeModal('modalTambahKamar')">&times;</button>
        <h4>Tambah Data Kamar</h4>
        <form action="{{ route('kamar.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nomor Kamar</label>
                <input type="text" name="nomor_kamar" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Fasilitas</label>
                <input type="text" name="fasilitas" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Lantai</label>
                <input type="number" name="lantai" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Ukuran Kamar</label>
                <input type="text" name="ukuran_kamar" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="Tersedia">Kosong</option>
                    <option value="Terisi">Penuh</option>
                </select>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal('modalTambahKamar')">Batal</button>
            </div>
        </form>
    </div>
</div>


<!-- Modal Edit Kamar -->
<div id="modalEditKamar" class="modal">
    <div class="modal-content">
        <button class="close-btn" onclick="closeModal('modalEditKamar')">&times;</button>
        <h4 class="fw-bold mb-4">Edit Data Kamar</h4>
        <form id="editKamarForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="editId">
            <div class="mb-3">
                <label class="form-label">Nomor Kamar</label>
                <input type="text" name="nomor_kamar" id="editNomorKamar" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Fasilitas</label>
                <input type="text" name="fasilitas" id="editFasilitas" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Lantai</label>
                <input type="number" name="lantai" id="editLantai" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Ukuran Kamar</label>
                <input type="text" name="ukuran_kamar" id="editUkuranKamar" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" id="editHarga" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" id="editStatus" class="form-select">
                    <option value="Tersedia">Kosong</option>
                    <option value="Terisi">Penuh</option>
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
    // Fungsi buka modal
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) modal.style.display = "flex";
    }

    // Fungsi tutup modal
    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) modal.style.display = "none";
    }

    // Fungsi isi otomatis modal edit
    function openEditModal(id, nomorKamar, fasilitas, lantai, ukuranKamar, harga, status) {
        document.getElementById('editId').value = id;
        document.getElementById('editNomorKamar').value = nomorKamar;
        document.getElementById('editFasilitas').value = fasilitas;
        document.getElementById('editLantai').value = lantai;
        document.getElementById('editUkuranKamar').value = ukuranKamar;
        document.getElementById('editHarga').value = harga;
        document.getElementById('editStatus').value = status;
        document.getElementById('editKamarForm').action = `/admin/kamar/${id}`;
        openModal('modalEditKamar');
    }
</script>


@endsection
