@extends('layout.navbarguru')

@section('title', 'Edit Kuis')

@section('content')
<div class="container-fluid py-4">

  {{-- HEADER --}}
  <div class="mb-4">
    <h2 class="fw-bold mb-1" style="color:#4f4a3f;">Edit Kuis</h2>
    <p class="text-muted mb-0">Perbarui data kuis</p>
  </div>

  {{-- CARD FORM --}}
  <div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">

      <form action="{{ route('kuis.update', $id ?? 1) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-4">

          {{-- Judul --}}
          <div class="col-md-6">
            <label class="form-label fw-semibold">Judul Kuis</label>
            <input type="text" name="judul" class="form-control rounded-3"
              value="Kuis A" required>
          </div>

          {{-- Bab --}}
          <div class="col-md-6">
            <label class="form-label fw-semibold">Bab</label>
            <select name="bab" class="form-select rounded-3">
              <option selected>Polinomial dan Fungsi Polinomial</option>
              <option>Penjumlahan, Pengurangan, dan Perkalian Polinomial</option>
              <option>Pembagian Polinomial</option>
              <option>Faktor dan Pembuat Nol Polinomial</option>
              <option>Identitas Polinomial</option>
            </select>
          </div>

          {{-- Jumlah Soal --}}
          <div class="col-md-4">
            <label class="form-label fw-semibold">Jumlah Soal</label>
            <input type="number" name="jumlah_soal" class="form-control rounded-3"
              value="10" min="1">
          </div>

          {{-- Waktu --}}
          <div class="col-md-4">
            <label class="form-label fw-semibold">Waktu (menit)</label>
            <input type="number" name="waktu" class="form-control rounded-3"
              value="15" min="1">
          </div>

          {{-- KKM --}}
          <div class="col-md-4">
            <label class="form-label fw-semibold">KKM</label>
            <input type="number" name="kkm" class="form-control rounded-3"
              value="75" min="0" max="100">
          </div>
        </div>

        {{-- BUTTON --}}
        <div class="d-flex justify-content-between align-items-center mt-4">

          <a href="{{ route('daftarkuis') }}" class="btn btn-secondary px-4">
            Kembali
          </a>

            <button type="submit" class="btn btn-success px-4">
              Simpan
            </button>
          </div>

        </div>

      </form>

    </div>
  </div>

</div>
@endsection