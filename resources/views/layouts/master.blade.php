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
      </ul>
      <div class="nav-right">
        <button class="login-btn" onclick="openPopup('login')">
          <i class='bx bx-log-in-circle' style="margin-right: 6px;"></i>Login
        </button>         
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
            <a href="{{ route('about') }}">
              <i class="bx bx-info-circle" style="margin-right: 6px;"></i>About
            </a>
            <a href="{{ route('services') }}">
              <i class='bx bx-cog' style="margin-right: 6px;"></i>Services
            </a>
            <a href="{{ route('contact') }}">
              <i class='bx bx-envelope' style="margin-right: 6px;"></i>Contact
            </a>
        </ul>
        <a class="login-mobile" onclick="openPopup('login')">Login</a> 
      </div>      
  </header>

  <main>
    @yield('content')
  </main>
  @include('auth.popup') <!-- Popup login/register -->
</body>
</html>
