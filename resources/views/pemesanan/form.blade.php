<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengajuan Sewa Kamar</title>
    <link rel="stylesheet" href="{{ asset('css/pesan.css') }}">
</head>

<body>
    <div class="container">
        <form action="{{ route('pemesanan.store') }}" method="POST">
            @csrf <!-- Token keamanan -->

            <div class="row">
                <div class="column">
                    <h3 class="title">Masukan Data Diri untuk Sewa Kamar</h3>
                    <input type="hidden" name="kamar_id" value="{{ $kamar->id }}">
                        <p>Kamar yang dipilih: {{ $kamar->nomor_kamar }}</p>       
                    <div class="input-box">
                        <span>Nomor Induk Kependudukan (NIK) :</span>
                        <input type="number" name="nik" placeholder="1111 2222 3333 4444" required>
                    </div>

                    <div class="input-box">
                        <span>Nama Lengkap :</span>
                        <input type="text" name="nama_lengkap" placeholder="Nama sesuai KTP" required>
                    </div>

                    <div class="input-box">
                        <span>Email :</span>
                        <input type="email" name="email" placeholder="example@example.com" required>
                    </div>

                    <div class="input-box">
                        <span>Nomor HP :</span>
                        <input type="text" name="no_hp" placeholder="08xxxxxxxxxx" required>
                    </div>

                    <div class="input-box">
                        <span>Alamat :</span>
                        <input type="text" name="alamat" placeholder="Room - Street - Locality" required>
                    </div>

                    <div class="input-box">
                        <span>Tanggal Mulai Sewa :</span>
                        <input type="date" name="tanggal_mulai" required>
                    </div>

                    <div class="input-box">
                        <span>Tanggal Akhir Sewa (Opsional):</span>
                        <input type="date" name="tanggal_akhir">
                    </div>             

                    <button type="submit" class="btn">Submit</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
