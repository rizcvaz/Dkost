@extends('layouts.app') {{-- layout yang kamu gunakan di dashboard --}}

@section('content')
<div class="container">
    <h2 class="header">Data Penghuni Kost</h2>

    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Nomor Kamar</th>
                    <th>Status</th>
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
                        <span class="status {{ $item->status == 'Tersedia' ? 'status-tersedia' : 'status-terisi' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">Tidak ada data penghuni.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
