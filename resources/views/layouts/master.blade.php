<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'DeKost Landing Page')</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <script defer src="{{ asset('js/script.js') }}"></script>
  <script src="https://unpkg.com/lucide@0.268.0" defer></script>
  <script defer>
    window.addEventListener('DOMContentLoaded', () => {
      lucide.createIcons();
    });
  </script>
</head>
<body>
  <header>
    <nav class="navbar">
      <div class="logo">
        <img src="{{ asset('images/DeKost2.png') }}" alt="Logo" />
      </div>
      <ul class="nav-links">
        <li>
          <a href="{{ route('home') }}">
            <i class="bx bx-home" style="margin-right: 6px;"></i>Home
          </a>
        </li>
        <li>
            <a href="{{ route('cari-kamar') }}">
              <i class="bx bx-search" style="margin-right: 6px;"></i>Cari Kamar
            </a>
          </li>
          <li>
          <a href="{{ route('about') }}">
            <i class="bx bx-info-circle" style="margin-right: 6px;"></i>About
          </a>
        </li>
        <li>
          <a href="{{ route('services') }}">
            <i class='bx bx-cog' style="margin-right: 6px;"></i>Services
          </a>
        </li>
        <li>
          <a href="{{ route('contact') }}">
            <i class='bx bx-envelope' style="margin-right: 6px;"></i>Contact
          </a>
        </li>
       @auth
  <li>
    <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : url('/user/dashboard') }}">
      <i class='bx bx-user-circle' style="margin-right: 6px;"></i>Dashboard
    </a>
  </li>
@endauth


      </ul>
     <div class="nav-right">
  @auth
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit" class="login-btn" style="background-color: #dc3545;">
        <i class='bx bx-log-out-circle' style="margin-right: 6px;"></i>Logout
      </button>
    </form>
  @else
    <button class="login-btn" onclick="openPopup('login')">
      <i class='bx bx-log-in-circle' style="margin-right: 6px;"></i>Login
    </button>
  @endauth
</div>

         
        <div class="hamburger" id="hamburger">
          <span></span><span></span><span></span>
        </div>
      </div>
    </nav>
    <div class="mobile-menu" id="mobileMenu">
        <div class="close-btn" id="closeMenu">&times;</div>
        <ul>
            <a href="{{ route('home') }}">
              <i class="bx bx-home" style="margin-right: 6px;"></i>Home
            </a>
            <a href="{{ route('cari-kamar') }}">
              <i class="bx bx-search" style="margin-right: 6px;"></i>Cari Kamar
            </a>
            <a href="{{ route('about') }}">
              <i class="bx bx-info-circle" style="margin-right: 6px;"></i>About
            </a>
            <a href="{{ route('services') }}">
              <i class='bx bx-cog' style="margin-right: 6px;"></i>Services
            </a>
            <a href="{{ route('contact') }}">
              <i class='bx bx-envelope' style="margin-right: 6px;"></i>Contact
            </a>
            @auth
          <a href="#">
            <i class='bx bx-user-circle' style="margin-right: 6px;"></i>Dashboard
          </a>
            @endauth

        </ul>
        <a class="login-mobile" onclick="openPopup('login')">Login</a> 
      </div>      
  </header>

  <main>
    @yield('content')
  </main>
  @include('auth.popup') <!-- Popup login/register -->

     <script>
  document.addEventListener('DOMContentLoaded', function() {
    // Cek jika status logout ada di session
    if ({{ session('logout') ? 'true' : 'false' }} === true) {
      // Jika logout, refresh untuk menampilkan tombol login
      location.reload();
    }
  });
</script>
</body>
</html>
