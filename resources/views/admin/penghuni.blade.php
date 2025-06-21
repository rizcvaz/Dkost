@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="header">Data Penghuni Kost</h2>

    <button onclick="openModal('modalTambahKamar')" class="button-add bx bx-plus">
        Tambah Penghuni
    </button>

    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Nomor Kamar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penghuni as $item)
                <tr>
                    <td>{{ $item->nama_lengkap }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->no_hp }}</td>
                    <td>{{ $item->kamar->nomor_kamar ?? '-' }}</td>
                    <td>
                        <span class="status {{ $item->status == 'Aktif' ? 'status-tersedia' : 'status-terisi' }}">
                            {{ ucfirst($item->status ?? '-') }}
                        </span>
                    </td>
                    <td>
                        <!-- Tombol Edit -->
                        <button class="btn-edit" onclick="openEditModal(
                            '{{ $item->id }}',
                            '{{ $item->nama_lengkap }}',
                            '{{ $item->email }}',
                            '{{ $item->no_hp }}',
                            '{{ $item->status }}'
                        )">
                            <i class='bx bx-edit'></i>
                        </button>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('penghuni.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn-delete" onclick="return confirm('Yakin ingin menghapus penghuni ini?')">
                                <i class='bx bx-trash'></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">Tidak ada data penghuni.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Edit Penghuni -->
<div id="modalEditPenghuni" class="modal">
    <div class="modal-content">
        <button class="close-btn" onclick="closeModal('modalEditPenghuni')">&times;</button>
        <h4>Edit Data Penghuni</h4>
        <form id="editPenghuniForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="editPenghuniId">
            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="editNama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" id="editEmail" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>No HP</label>
                <input type="text" name="no_hp" id="editNoHp" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Status</label>
                <select name="status" id="editStatus" class="form-control">
                    <option value="Aktif">Aktif</option>
                    <option value="Nonaktif">Nonaktif</option>
                </select>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal('modalEditPenghuni')">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, nama, email, nohp, status) {
        document.getElementById('editPenghuniId').value = id;
        document.getElementById('editNama').value = nama;
        document.getElementById('editEmail').value = email;
        document.getElementById('editNoHp').value = nohp;
        document.getElementById('editStatus').value = status;
        document.getElementById('editPenghuniForm').action = '/admin/penghuni/' + id;
        openModal('modalEditPenghuni');
    }
</script>
@endsection
