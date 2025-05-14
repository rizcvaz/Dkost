@extends('layouts.master')

@section('content')
<h1 style="text-align: center; color: #fff;">Silahkan Pilih Kamar</h1>

<div class="container">
    <div class="products-container">
        @foreach ($kamar as $k)
        <div class="product"
            data-id="{{ $k->id }}"
             data-nomor="{{ $k->nomor_kamar }}"
             data-status="{{ $k->status }}"
             data-harga="{{ number_format($k->harga, 0, ',', '.') }}"
             data-ukuran="{{ $k->ukuran_kamar }}"
             data-lantai="{{ $k->lantai }}"
             data-fasilitas="{{ $k->fasilitas }}">
            <img src="{{ asset('images/kamar.png') }}" alt="Kamar {{ $k->nomor_kamar }}">
            <h3>Kamar {{ $k->nomor_kamar }}</h3>
            <div class="status" style="margin-bottom: 0.5rem;">
                Status:
                <span style="color: {{ $k->status == 'Tersedia' ? '#00ff99' : '#ff4d4d' }}">
                    {{ $k->status }}
                </span>
            </div>
            <div class="price">Rp {{ number_format($k->harga, 0, ',', '.') }}</div>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal Pop-up -->
<div class="modal" id="modalKamar">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <img id="modal-img" src="{{ asset('images/kamar.png') }}" alt="Foto Kamar">
        <h3 id="modal-title">Kamar</h3>

        <div class="modal-grid">
            <div class="info-item"><strong>Status:</strong><br><span id="modal-status"></span></div>
            <div class="info-item"><strong>Harga:</strong><br>Rp <span id="modal-harga"></span></div>
            <div class="info-item"><strong>Ukuran:</strong><br><span id="modal-ukuran"></span></div>
            <div class="info-item"><strong>Lantai:</strong><br><span id="modal-lantai"></span></div>
            <div class="fasilitas-item"><strong>Fasilitas:</strong><br><span id="modal-fasilitas"></span></div>
        </div>
        <button id="btn-pesan" class="btn-pesan">Pesan Sekarang</button>
        </div>


<style>
.modal {
    display: none;
    position: fixed;
    z-index: 999;
    padding-top: 60px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
}
.modal-content {
    margin: auto;
    padding: 16px;
    background: #fff;
    color: #000000;
    width: 65%;
    max-width: 280px;
    border-radius: 10px;
    text-align: center;
    position: relative;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}
.modal-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* 2 kolom */
    gap: 8px;
    margin-bottom: 10px;
}
.info-item {
    background: #f5f5f5;
    padding: 6px 10px;
    border-radius: 4px;
    font-size: 13px;
    text-align: left;
}
.fasilitas-item {
    grid-column: span 2; /* fasilitas akan ambil 2 kolom */
    background: #f5f5f5;
    padding: 6px 10px;
    border-radius: 4px;
    font-size: 13px;
    text-align: left;
}
.close {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 24px;
    cursor: pointer;
}
.modal-content img {
    width: 100%;
    height: auto;
    border-radius: 10px;
}
.close {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 24px;
    cursor: pointer;
    color: #000000;
}

.btn-pesan {
    margin-top: 5px;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
.btn-pesan:disabled {
    background-color: #ccc;
    cursor: not-allowed;
}


</style>

<script>
    let selectedKamarId = null;
    document.querySelectorAll('.product').forEach((card) => {
        card.addEventListener('click', () => {
            selectedKamarId = card.dataset.id;
            document.getElementById('modal-title').textContent = `Kamar ${card.dataset.nomor}`;
            document.getElementById('modal-status').textContent = card.dataset.status;
            document.getElementById('modal-harga').textContent = card.dataset.harga;
            document.getElementById('modal-ukuran').textContent = card.dataset.ukuran;
            document.getElementById('modal-lantai').textContent = card.dataset.lantai;
            document.getElementById('modal-fasilitas').textContent = card.dataset.fasilitas;
            document.getElementById('modalKamar').style.display = 'block';

            const status = card.dataset.status;
document.getElementById('modal-status').textContent = status;

// Atur tombol berdasarkan status
const btnPesan = document.getElementById('btn-pesan');
if (status.toLowerCase() === 'tersedia') {
    btnPesan.disabled = false;
    btnPesan.textContent = 'Pesan Sekarang';
} else {
    btnPesan.disabled = true;
    btnPesan.textContent = 'Kamar Tidak Tersedia';
}

        });
    });

    

    function closeModal() {
        document.getElementById('modalKamar').style.display = 'none';
    }
</script>

<script>
    const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};

document.getElementById('btn-pesan').addEventListener('click', function () {
    if (!isLoggedIn) {
        openPopup('login');
    } else {
        if (selectedKamarId) {
            window.location.href = `/pesan-kamar/${selectedKamarId}`;
        } else {
            alert('Terjadi kesalahan: kamar belum dipilih.');
        }
    }
});

</script>

@endsection
