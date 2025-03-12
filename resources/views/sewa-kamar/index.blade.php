<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sewa Kamar</title>
    
        <!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

        {{-- notif success --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    
    
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          crossorigin="anonymous">
    
    
        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/slider.css') }}">
        <link rel="stylesheet" href="{{ asset('css/popup.css') }}">
        <!-- font awesome cdn link  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <!-- custom css file link  -->
         <link rel="stylesheet" href="css/sewakamar.css">
        <!-- custom js file link  -->
        <script src="js/sewakamar.js" defer></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <div class="sidebar-brand-icon">
                    <img src="assets/icon/Dekost2.png" alt="#logo" style="width:50px;height:50px;">
                </div>
                <a class="navbar-brand" href="index.php">De'Kost</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        {{-- <li class="nav-item">
                            <a class="nav-link active" aria-current="page" <a href="/sewa-kamar">
                                Cari Kamar  <i class="bx bx-search"></a></i></a>
                        </li> --}}
                    </ul>
                    @guest
                    <a href="{{ route('form-login') }}" class="btn btn-primary">Sign In</a>
                @else
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('dashboard.admin') }}" class="btn btn-primary">Dashboard</a>
                    @else
                        <a href="{{ route('dashboard.user') }}" class="btn btn-primary">Dashboard</a>
                    @endif
                @endguest
                
            </div>
        </nav>
<body>
    @if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

    <h1 style="text-align: center;">Silahkan Pilih Kamar</h1>
    <div class="container">
        <div class="products-container">
            @foreach ($kamars as $kamar)
            <div class="product" data-name="kamar-{{ $kamar->id }}">
                <img src="{{ asset('assets/icon/kamar.png') }}" alt="Kamar {{ $kamar->nomor_kamar }}">
                <h3>Kamar {{ $kamar->nomor_kamar }}</h3>
                <div class="price">Rp {{ number_format($kamar->harga, 0, ',', '.') }}</div>
            </div>
            @endforeach
             
        </div>
    
        <div class="products-preview">
            @foreach ($kamars as $kamar)
            <div class="preview" data-target="kamar-{{ $kamar->id }}">
                <i class="fas fa-times"></i>
                <img src="{{ asset('assets/icon/kamar.png') }}" alt="Kamar {{ $kamar->nomor_kamar }}">
                <h3>Kamar {{ $kamar->nomor_kamar }}</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                    <span>(250)</span>
                </div>
                <p>
                    Fasilitas: {{ $kamar->fasilitas }} <br>
                    Lantai: {{ $kamar->lantai }} <br>
                    Ukuran: {{ $kamar->ukuran_kamar }} <br>
                    Harga: Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                </p>
                @if ($kamar->status === 'Kosong')
                @guest
                    <!-- Tombol dengan JavaScript Modal untuk login -->
                    <button class="btn btn-primary btn-sewa" onclick="setRedirectUrl('{{ route('pemesanan.form', ['id' => $kamar->id]) }}')">Sewa Sekarang</button>
                @else
                    <!-- Langsung ke halaman pemesanan jika sudah login -->
                    <a href="{{ route('pemesanan.form', ['id' => $kamar->id]) }}" class="btn btn-primary">Sewa Sekarang</a>
                @endguest
            @else
                <button class="btn btn-secondary" disabled>Penuh</button>
            @endif
            
            </div>
            @endforeach
        </div>
    </div>

    <!-- Modal Popup -->
<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Masuk untuk melanjutkan</h3>
        <p>Silakan masuk untuk melanjutkan proses pemesanan kamar.</p>
        <div class="modal-buttons">
            <a href="{{ route('form-login') }}" class="btn btn-primary">Masuk</a>
            <button class="btn btn-secondary" id="closeModal">Batal</button>
        </div>
    </div>
</div>

</div>
<script>
document.addEventListener("DOMContentLoaded", () => {
    // Ambil semua tombol "Sewa Sekarang" yang membutuhkan login
    const btnSewa = document.querySelectorAll(".btn-sewa");

    // Ambil modal dan tombol untuk menutup modal
    const modal = document.getElementById("loginModal");
    const closeModal = document.getElementById("closeModal");
    const closeSpan = document.querySelector(".modal .close");

    // Event saat tombol "Sewa Sekarang" diklik
    btnSewa.forEach(button => {
        button.addEventListener("click", (e) => {
            e.preventDefault(); // Mencegah pindah halaman langsung
            modal.style.display = "block"; // Tampilkan modal
        });
    });

    // Event untuk menutup modal
    closeModal.onclick = () => {
        modal.style.display = "none";
    };

    closeSpan.onclick = () => {
        modal.style.display = "none";
    };

    // Tutup modal jika klik di luar area modal
    window.onclick = (e) => {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    };
});

// function setRedirectUrl(url) {
//     sessionStorage.setItem('redirectUrl', url);
//     window.location.href = "{{ route('form-login') }}"; // Redirect ke halaman login
// }

</script>

<!-- Pagination Links -->
<div class="pagination">
    {{ $kamars->links('pagination::bootstrap-5') }}
</div>

</body>
</html>