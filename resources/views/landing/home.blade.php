{{-- resources/views/landing/home.blade.php --}}
@extends('layouts.master')

@section('title', 'DeKost - Home')

@section('content')
<section id="home" class="landing">
  <div class="animated-logo">
    <img src="{{ asset('images/DeKost2.png') }}" alt="Logo" class="logo-animation" />
    <h1 class="tagline">Stay with us, feel like home</h1>
  </div>
</section>
@endsection
