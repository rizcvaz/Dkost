@extends('layouts.master')

@section('content')
@php
    // Variabel teks untuk paragraf
    $teks1 = "Atur jadwal tidur, Mulailah atur jadwal tidurmu dari sekarang. Kamu harus menargetkan diri untuk tidur lebih awal serta durasi waktunya yaitu sekitar 7-9 jam. Meski pada hari libur pun tetap saja lakukan jadwal tersebut agar dapat membiasakan diri untuk selalu bangun pagi.";
    $teks2 = "Membuat target IPK tiap semester, buat target IPK tiap semester besaran IPK menjadi penentu jumlah SKS yang bisa kamu ambil di semester berikutnya. Semakin besar IPK, semakin banyak pula SKS yang bisa kamu ambil.";
    $teks3 = "Ketahui fasilitas kost yang benar-benar penting, misalnya sudah tersedia kasur, lemari, dan internet, karena beberapa kost murah hanya menawarkan kamar kosongan saja. Fokus pada fasilitas yang kamu butuhkan, bukan yang kamu inginkan.";
    $teks4 = "Menyusun target belajar, karena memiliki target waktu untuk menguasai materi pelajaran tertentu akan membuat anda tertantang. Karena itu, susunlah jadwal dan bagi waktu belajar dengan baik. Bila berhasil mencapai target, berilah diri Anda hadiah kecil misal membeli camilan favorit.";
    $teks5 = "Mencatat setiap pengeluaran penting untuk mengetahui keluar masuknya uang dan membantu menyusun prioritas kebutuhan.";

    // Array data kartu
    $cards = [
        ['image' => 'assets/icon/image.png', 'title' => 'Tips Bangun Pagi Rutin', 'content' => $teks1],
        ['image' => 'assets/images/owl2.jpg', 'title' => 'Tips Cepat Lulus', 'content' => $teks2],
        ['image' => 'assets/images/owl3.jpg', 'title' => 'Tempat Mencari Kost Terbaik', 'content' => $teks3],
        ['image' => 'assets/images/owl4.jpg', 'title' => 'Tips Belajar Efektif', 'content' => $teks4],
        ['image' => 'assets/images/owl5.jpg', 'title' => 'Tips Menghemat ala Anak Kos', 'content' => $teks5]
    ];
@endphp

<!-- Section Slider -->
<section id="slider" class="pt-5">
    <div class="container">
        <!-- <h1 class="text-center"><b>Cari Kos</b></h1> -->
        <div class="slider owl-carousel">
                <div class="slider-card">
                    <div class="d-flex justify-content-center align-items-center mb-4">
                        <img src="assets/images/owl1.jpg" alt="">
                    </div>
                    <h5 class="mb-0 text-center"><b>Tips Bangun Pagi Rutin</b></h5>
                    <?php if (strlen($teks1) > 100) : ?>
                    <p class="text-center p-4"><?= substr($teks1, 0, 97) . " ..." ?></p>
                    <?php else : ?>
                    <p class="text-center p-4"><?= $teks1 ?></p>
                    <?php endif; ?>
                </div>
                <div class="slider-card">
                    <div class="d-flex justify-content-center align-items-center mb-4">
                        <img src="assets/images/owl2.jpg" alt="">
                    </div>
                    <h5 class="mb-0 text-center"><b>Tips Cepat Lulus</b></h5>
                    <?php if (strlen($teks2) > 100) : ?>
                    <p class="text-center p-4"><?= substr($teks2, 0, 97) . " ..." ?></p>
                    <?php else : ?>
                    <p class="text-center p-4"><?= $teks2 ?></p>
                    <?php endif; ?>
                </div>
                <div class="slider-card">
                    <div class="d-flex justify-content-center align-items-center mb-4">
                        <img src="assets/images/owl3.jpg" alt="">
                    </div>
                    <h5 class="mb-0 text-center"><b>Tempat Mencari Kost Terbaik</b></h5>
                    <?php if (strlen($teks3) > 100) : ?>
                    <p class="text-center p-4"><?= substr($teks3, 0, 97) . " ..." ?></p>
                    <?php else : ?>
                    <p class="text-center p-4"><?= $teks3 ?></p>
                    <?php endif; ?>
                </div>
                <div class="slider-card">
                    <div class="d-flex justify-content-center align-items-center mb-4">
                        <img src="assets/images/owl4.jpg" alt="">
                    </div>
                    <h5 class="mb-0 text-center"><b>Tips Belajar Efektif</b></h5>
                    <?php if (strlen($teks4) > 100) : ?>
                    <p class="text-center p-4"><?= substr($teks4, 0, 97) . " ..." ?></p>
                    <?php else : ?>
                    <p class="text-center p-4"><?= $teks4 ?></p>
                    <?php endif; ?>
                </div>
                <div class="slider-card">
                    <div class="d-flex justify-content-center align-items-center mb-4">
                        <img src="assets/images/owl5.jpg" alt="">
                    </div>
                    <h5 class="mb-0 text-center"><b>Tips Menghemat ala Anak Kos</b></h5>
                    <?php if (strlen($teks5) > 100) : ?>
                    <p class="text-center p-4"><?= substr($teks5, 0, 97) . " ..." ?></p>
                    <?php else : ?>
                    <p class="text-center p-4"><?= $teks5 ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $(".owl-carousel").owlCarousel({
            loop: true,
            margin: 20,
            nav: true,
            responsive: {
                0: { items: 1 },
                768: { items: 2 },
                1000: { items: 3 }
            },
            navText: ['<', '>']
        });
    });
</script>
@endsection
