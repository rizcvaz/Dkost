const sideLinks = document.querySelectorAll('.sidebar .side-menu li a:not(.logout)');

sideLinks.forEach(item => {
    const li = item.parentElement;
    item.addEventListener('click', () => {
        sideLinks.forEach(i => {
            i.parentElement.classList.remove('active');
        })
        li.classList.add('active');
    })
});

const menuBar = document.querySelector('.content nav .bx.bx-menu');
const sideBar = document.querySelector('.sidebar');

menuBar.addEventListener('click', () => {
    sideBar.classList.toggle('close');
});

const searchBtn = document.querySelector('.content nav form .form-input button');
const searchBtnIcon = document.querySelector('.content nav form .form-input button .bx');
const searchForm = document.querySelector('.content nav form');

searchBtn.addEventListener('click', function (e) {
    if (window.innerWidth < 576) {
        e.preventDefault;
        searchForm.classList.toggle('show');
        if (searchForm.classList.contains('show')) {
            searchBtnIcon.classList.replace('bx-search', 'bx-x');
        } else {
            searchBtnIcon.classList.replace('bx-x', 'bx-search');
        }
    }
});

window.addEventListener('resize', () => {
    if (window.innerWidth < 768) {
        sideBar.classList.add('close');
    } else {
        sideBar.classList.remove('close');
    }
    if (window.innerWidth > 576) {
        searchBtnIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }
});
//  logout confirm popup

document.getElementById('logoutBtn').addEventListener('click', function(e) {
    e.preventDefault(); // Menghentikan tindakan default

    // Menampilkan konfirmasi SweetAlert2
    Swal.fire({
        title: 'Apakah Anda yakin ingin logout?',
        text: "Anda akan keluar dari akun Anda.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Logout',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Jika pengguna mengonfirmasi, lakukan logout
            window.location.href = '/'; 
        }
    });
});

// toggle-theme

const toggler = document.getElementById('theme-toggle');

// Cek status toggle saat halaman dimuat
window.addEventListener('DOMContentLoaded', () => {
    // Cek apakah toggle dicentang atau tidak dan atur class body
    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark');
        document.body.classList.remove('light');
        toggler.checked = true;  // Set toggle ke posisi centang
    } else {
        document.body.classList.add('light');
        document.body.classList.remove('dark');
        toggler.checked = false;  // Set toggle ke posisi tidak centang
    }
});

// Saat toggle berubah, ubah tema
toggler.addEventListener('change', function () {
    if (this.checked) {
        document.body.classList.add('dark');
        document.body.classList.remove('light');
        localStorage.setItem('theme', 'dark');  // Simpan preferensi tema
    } else {
        document.body.classList.add('light');
        document.body.classList.remove('dark');
        localStorage.setItem('theme', 'light');  // Simpan preferensi tema
    }
});

// delete confirmation

document.querySelectorAll('.form-delete').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Mencegah submit otomatis

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data kamar yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit(); // Kalau yakin, form disubmit
            }
        });
    });
});

// dropdown profile
const profileButton = document.getElementById('profileButton');
const profileDropdown = document.getElementById('profileDropdown');

profileButton.addEventListener('click', function(e) {
    e.preventDefault();
    profileDropdown.classList.toggle('show');
});

// Tutup dropdown saat klik di luar
window.addEventListener('click', function(e) {
    if (!profileButton.contains(e.target) && !profileDropdown.contains(e.target)) {
        profileDropdown.classList.remove('show');
    }
});
