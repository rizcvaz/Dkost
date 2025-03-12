<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>De'Kost - Landing Page</title>

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
      rel="stylesheet" 
      crossorigin="anonymous">


    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slider.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <div class="sidebar-brand-icon">
                <img src="assets/icon/Dekost2.png" alt="#logo" style="width:50px;height:50px;">
            </div>
            <a class="navbar-brand" href="/">De'Kost</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" <a href="/sewa-kamar">
                           <i class="bx bx-search"></i> Cari Kamar</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" <a href="/sewa-kamar">
                            <i class="bx bx-phone"></i> Kontak </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" <a href="/about-us">
                            <i class="bx bx-info-circle"></i> Tentang Kami</a>
                    </li> --}}
                </ul>
                @guest
                <a href="{{ route('form-login') }}" class="btn btn-primary"><i class="bx bx-log-in-circle"></i> Sign In</a>
            @else
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('dashboard.admin') }}" class="btn btn-primary">Dashboard</a>
                @else
                    <a href="{{ route('dashboard.user') }}" class="btn btn-primary">Dashboard</a>
                @endif
            @endguest
            
        </div>
    </nav>

    <div class="container mt-5">
        @yield('content')
    </div>

   <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('js/script.js') }}"></script>

    <script>
        $(document).ready(function() {
            console.log("jQuery is loaded");
            if ($.fn.owlCarousel) {
                console.log("Owl Carousel is loaded");
            } else {
                console.log("Owl Carousel is NOT loaded");
            }
        });
    </script>
    


    @yield('scripts')
</body>
</html>
