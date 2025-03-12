<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="stylesheet" href="{{ asset('css/kamar.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/table.css') }}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <title>Dashboard Admin</title>
</head>

<body>

   <!-- Sidebar -->
<div class="sidebar">
    <a href="/" class="logo">
        <i class='bx bx-code-alt'></i>
        <div class="logo-name"><span>De'</span>Kost</div>
    </a>
    <ul class="side-menu">
        <li><a href="{{ route('dashboard.admin') }}"><i class='bx bx-home'></i> <span>Beranda</span></a></li>
        <li><a href="{{ route('kamar.index') }}"><i class='bx bx-bed'></i> <span>Kamar Kost</span></a></li>
        <li><a href="{{ route('penghuni.index') }}"><i class='bx bx-group'></i> <span>Penghuni Kost</span></a></li>
        <li><a href="{{ route('admin.tagihan.index') }}"><i class='bx bx-receipt'></i> <span>Tagihan</span></a></li>
        <li><a href="{{ route('laporan.keuangan') }}"><i class='bx bx-line-chart'></i> <span>Laporan</span></a></li>
        <li><a href="{{ route('komplain.index') }}"><i class='bx bx-message-square-dots'></i> <span>Komplain</span></a></li>
        <li><a href="{{ route('dashboard.pengajuan.index') }}"><i class='bx bx-bell'></i> <span>Pengajuan</span></a></li>
        {{-- <li><a href="#"><i class='bx bx-user'></i> <span>Akun Penghuni</span></a></li> --}}
    </ul>
    <ul class="side-menu">
        <li>
            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                @csrf
            </form>
            
            <!-- Logout Link -->
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn-logout">
                <i class="bx bx-log-out-circle"></i> Logout
            </a>
            
        </li>
    </ul>
</div>

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
            <a href="#" class="profile">
                <img src="assets/images/Roseanne Park.jpg">
            </a>
        </nav>

        <!-- End of Navbar -->
        @yield('content')
{{-- 
        <main>
            <div class="header">
                <div class="left">
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                Analytics
                            </a></li>
                        /
                        <li><a href="#" class="active">Shop</a></li>
                    </ul>
                </div>
                <a href="#" class="report">
                    <i class='bx bx-cloud-download'></i>
                    <span>Download CSV</span>
                </a>
            </div> --}}

            <!-- Insights -->
            {{-- <ul class="insights">
                <li>
                    <i class='bx bx-calendar-check'></i>
                    <span class="info">
                        <h3>
                            1,074
                        </h3>
                        <p>Paid Order</p>
                    </span>
                </li>
                <li><i class='bx bx-show-alt'></i>
                    <span class="info">
                        <h3>
                            3,944
                        </h3>
                        <p>Site Visit</p>
                    </span>
                </li>
                <li><i class='bx bx-line-chart'></i>
                    <span class="info">
                        <h3>
                            14,721
                        </h3>
                        <p>Searches</p>
                    </span>
                </li>
                <li><i class='bx bx-dollar-circle'></i>
                    <span class="info">
                        <h3>
                            $6,742
                        </h3>
                        <p>Total Sales</p>
                    </span>
                </li>
            </ul> --}}
            <!-- End of Insights -->

            {{-- <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Recent Orders</h3>
                        <i class='bx bx-filter'></i>
                        <i class='bx bx-search'></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Order Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img src="images/profile-1.jpg">
                                    <p>John Doe</p>
                                </td>
                                <td>14-08-2023</td>
                                <td><span class="status completed">Completed</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="images/profile-1.jpg">
                                    <p>John Doe</p>
                                </td>
                                <td>14-08-2023</td>
                                <td><span class="status pending">Pending</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="images/profile-1.jpg">
                                    <p>John Doe</p>
                                </td>
                                <td>14-08-2023</td>
                                <td><span class="status process">Processing</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div> --}}

                <!-- Reminders -->
                {{-- <div class="reminders">
                    <div class="header">
                        <i class='bx bx-note'></i>
                        <h3>Remiders</h3>
                        <i class='bx bx-filter'></i>
                        <i class='bx bx-plus'></i>
                    </div>
                    <ul class="task-list">
                        <li class="completed">
                            <div class="task-title">
                                <i class='bx bx-check-circle'></i>
                                <p>Start Our Meeting</p>
                            </div>
                            <i class='bx bx-dots-vertical-rounded'></i>
                        </li>
                        <li class="completed">
                            <div class="task-title">
                                <i class='bx bx-check-circle'></i>
                                <p>Analyse Our Site</p>
                            </div>
                            <i class='bx bx-dots-vertical-rounded'></i>
                        </li>
                        <li class="not-completed">
                            <div class="task-title">
                                <i class='bx bx-x-circle'></i>
                                <p>Play Footbal</p>
                            </div>
                            <i class='bx bx-dots-vertical-rounded'></i>
                        </li>
                    </ul>
                </div> --}}

                <!-- End of Reminders-->

            </div>

        </main>

    </div>

  
    <script src="{{ asset('js/index.js') }}"></script>
</body>

</html>