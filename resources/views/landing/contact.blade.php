@extends('layouts.master')

@section('content')
<section class="contact py-5" id="contact">
  <div class="container text-center">
    <h2 class="mb-3">Contact Us</h2>
    <p>Silakan hubungi kami melalui informasi di bawah ini:</p>

    <div class="contact-info mt-4">
      <p><i class='bx bxs-map me-2'></i><strong>Alamat:</strong> Jl. Contoh No.123, Kota Contoh</p>
      <p><i class='bx bxs-phone me-2'></i><strong>Telepon:</strong> 0812-3456-7890</p>
      <p><i class='bx bxs-envelope me-2'></i><strong>Email:</strong> info@contoh.com</p>

      <div class="sosmed mt-4">
        <a href="#" class="text-dark me-3 fs-4"><i class='bx bxl-whatsapp'></i></a>
        <a href="#" class="text-dark me-3 fs-4"><i class='bx bxl-instagram'></i></a>
        <a href="#" class="text-dark fs-4"><i class='bx bxs-envelope'></i></a>
      </div>
    </div>
  </div>
</section>
@endsection