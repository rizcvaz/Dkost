<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <title>DeKost</title>
</head>

<body class="dark">

    <!-- Sidebar -->
    <div class="sidebar close">
        <a href="#" class="logo">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>De</span>Kost</div>
        </a>
        <ul class="side-menu">
        <li><a href="#"><i class='bx bx-home'></i> <span>Beranda</span></a></li>
        <li><a href="{{ route('kamar.index') }}"><i class='bx bx-bed'></i> <span>Kamar Kost</span></a></li>
        <li><a href="#"><i class='bx bx-group'></i> <span>Penghuni Kost</span></a></li>
        <li><a href="#"><i class='bx bx-receipt'></i> <span>Tagihan</span></a></li>
        <li><a href="#"><i class='bx bx-line-chart'></i> <span>Laporan</span></a></li>
        <li><a href="#"><i class='bx bx-message-square-dots'></i> <span>Komplain</span></a></li>
        <li><a href="#"><i class='bx bx-bell'></i> <span>Pengajuan</span></a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="{{ route('logout') }}" id="logoutBtn" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <a href="#" class="notif">
                <i class='bx bx-bell'></i>
                <span class="count">12</span>
            </a>
            <div class="profile-container">
                <a href="#" class="profile" id="profileButton">
                    <img src="images/logo.png" alt="Profile">
                </a>
                <div class="profile-dropdown" id="profileDropdown">
                    <div class="profile-info">
                        <img src="images/logo.png" alt="Profile" class="profile-pic">
                        <div class="profile-name">
                            {{ Auth::user()->name }}
                        </div>
                    </div>
                </div>
            </div>
            
        </nav>

        <!-- End of Navbar -->

        <main>
            
            @yield('content')

        </main>

    </div>
    <script src="{{ asset('js/apps.js') }}?v={{ time() }}"></script>
</body>
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session('success') }}',
            showConfirmButton: true,
            timer: 3000 // Durasi pop-up 3 detik
        });
    </script>
@endif

</html>