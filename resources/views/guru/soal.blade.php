@extends('layout.navbarguru')

@section('title', 'Soal Kuis')

@section('content')
<div class="container-fluid py-4">

  {{-- HEADER --}}
  <div class="mb-4">
    <h2 class="fw-bold mb-1" style="color:#4f4a3f;">Soal Kuis</h2>
    <p class="text-muted mb-0">Daftar soal dalam kuis</p>
  </div>

  {{-- CARD --}}
  <div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">

      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">

          {{-- HEADER --}}
          <thead style="background-color:#EAD9C7;">
            <tr class="text-center">
              <th style="width:60px;">No</th>
              <th class="text-start">Pertanyaan</th>
              <th style="width:150px;">Tipe</th>
              <th style="width:120px;">Skor</th>
              <th style="width:120px;">Aksi</th>
            </tr>
          </thead>

          {{-- BODY --}}
          <tbody>

            @php $no = 1; @endphp

            <tr>
              <td class="text-center">{{ $no++ }}</td>
              <td>Apa yang dimaksud dengan polinomial?</td>
              <td class="text-center">PG</td>
              <td class="text-center">10</td>
              <td class="text-center">
                <button class="btn btn-sm btn-warning px-3">Edit</button>
              </td>
            </tr>

            <tr>
              <td class="text-center">{{ $no++ }}</td>
              <td>Tentukan derajat dari 3x² + 2x + 1</td>
              <td class="text-center">Essay</td>
              <td class="text-center">15</td>
              <td class="text-center">
                <button class="btn btn-sm btn-warning px-3">Edit</button>
              </td>
            </tr>

            <tr>
              <td class="text-center">{{ $no++ }}</td>
              <td>Hasil dari (x + 2)(x - 3) adalah?</td>
              <td class="text-center">PG</td>
              <td class="text-center">10</td>
              <td class="text-center">
                <button class="btn btn-sm btn-warning px-3">Edit</button>
              </td>
            </tr>

          </tbody>
        </table>
      </div>

    </div>
  </div>

  {{-- BUTTON BAWAH --}}
  <div class="d-flex justify-content-between mt-4">

    <a href="{{ route('daftarkuis') }}" class="btn btn-secondary px-4">
      ← Kembali
    </a>

    <button class="btn btn-success px-4">
      + Tambah Soal
    </button>

  </div>

</div>
@endsection