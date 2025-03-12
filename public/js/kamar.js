function openEditModal(nomorKamar, fasilitas, lantai, ukuranKamar, harga, status) {
    document.getElementById('modalEditKamar').style.display = "block";
    document.getElementById('edit_nomor_kamar').value = nomorKamar;
    document.getElementById('edit_fasilitas').value = fasilitas;
    document.getElementById('edit_lantai').value = lantai;
    document.getElementById('edit_ukuran_kamar').value = ukuranKamar;
    document.getElementById('edit_harga').value = harga;
    document.getElementById('edit_status').value = status; // Isi nilai status

    document.getElementById('formEditKamar').action = '/kamar/' + nomorKamar;
}



