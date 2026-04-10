@extends('layout.halamanmateri')

@section('content')
<div class="container-fluid px-0">

    @if (session('success') && Auth::check())
        <div class="alert alert-success">
            Login Berhasil, Selamat Belajar {{ Auth::user()->nama }}
        </div>
    @endif

    <!-- Judul -->
    <h2 class="mb-4" style="font-family:'Playfair Display', serif; color:#2f5d3a; font-weight:800;">
        Peta Konsep
    </h2>

    <!-- Gambar -->
    <div class="text-center mb-4">
        <img src="{{ asset('img/8.png') }}" alt="Peta Konsep Polinomial" class="img-fluid"
             style="border-radius:14px; border:1px solid rgba(0,0,0,0.08);">
    </div>

    <!-- Tombol -->
    <div class="d-flex justify-content-center gap-3 mb-3">
        <a href="{{ asset('img/8.png') }}" download class="btn"
           style="background:#8F9F76; color:white; border-radius:999px; padding:10px 22px; font-weight:600;">
            Unduh Gambar
        </a>

        <a href="{{ asset('img/8.png') }}" target="_blank" class="btn"
           style="background:#AAB99A; color:white; border-radius:999px; padding:10px 22px; font-weight:600;">
            Buka Penuh
        </a>
    </div>

</div>
@endsection

@section('nav')
<div></div>

<a href="{{ route('pendahuluan') }}" class="btn-nav">
    Next →
</a>
@endsection