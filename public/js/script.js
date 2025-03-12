$(document).ready(function(){
    $(".slider").owlCarousel({
        loop: true,
        center: true, // Menjadikan item di tengah lebih menonjol
        margin: 10,
        nav: true,
        dots: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplaySpeed: 2200,
        animateOut: 'fadeOut', // Animasi keluar
        animateIn: 'fadeIn',   // Animasi masuk
        responsive:{
            0:{
                items: 1
            },
            600:{
                items: 3
            },
            1000:{
                items: 3
            }
        }
    });
});

// Fungsi untuk membuka modal
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = "flex";
    }
}

// Fungsi untuk menutup modal
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = "none";
    }
}

// Menutup modal jika klik di luar konten
window.onclick = function(event) {
    const modal = document.getElementById('modalTambahKamar');
    if (event.target === modal) {
        closeModal('modalTambahKamar');
    }
}

