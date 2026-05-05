@extends('layout.navbarguru')

@section('title', 'Manajemen Kuis')

@section('content')
<div class="container-fluid py-4">

  <div class="mb-4">
    <h2 class="fw-bold mb-1" style="color:#4f4a3f;">Manajemen Kuis</h2>
    <p class="text-muted mb-0">Daftar seluruh kuis yang tersedia</p>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">

      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">

          <thead style="background-color:#EAD9C7;">
            <tr class="text-center">
              <th style="width:60px;">No</th>
              <th class="text-start">Judul Kuis</th>
              <th class="text-start">Bab</th>
              <th class="text-start">Deskripsi</th>
              <th>Jumlah Soal</th>
              <th>Waktu</th>
              <th>KKM</th>
              <th style="width:180px;">Aksi</th>
            </tr>
          </thead>

          <tbody>
            @forelse ($quizzes as $quiz)
              <tr>
                <td class="text-center">{{ $loop->iteration }}</td>

                <td>{{ $quiz->title }}</td>
                <td>{{ $quiz->bab->judul ?? 'Bab tidak ditemukan' }}</td>
                <td>{{ $quiz->description }}</td>
                <td class="text-center">{{ $quiz->total_questions }}</td>
                <td class="text-center">{{ $quiz->duration_minutes }} menit</td>
                <td class="text-center">{{ $quiz->kkm }}</td>
                <td class="text-center">
                  <a href="{{ route('kuis.soal', $quiz->id) }}" class="btn btn-sm btn-info">
                    Soal
                  </a>
                  

                  <button 
                    type="button" 
                    class="btn btn-sm btn-warning"
                    data-bs-toggle="modal" 
                    data-bs-target="#editQuizModal{{ $quiz->id }}">
                    Edit
                  </button>
                </td>
              </tr>

              <!-- Modal Edit -->
              <div class="modal fade" id="editQuizModal{{ $quiz->id }}" tabindex="-1" aria-labelledby="editQuizLabel{{ $quiz->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content border-0 shadow rounded-4">

                    <div class="modal-header" style="background-color:#EAD9C7;">
                      <h5 class="modal-title fw-bold" id="editQuizLabel{{ $quiz->id }}">
                        Edit Kuis
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('updatekuis', $quiz->id) }}" method="POST">
                      @csrf
                      @method('PUT')

                      <div class="modal-body">
                        <div class="row g-3">

                          <div class="col-md-6">
                            <label class="form-label fw-semibold">Bab</label>
                            <select name="bab_id" class="form-select" required>
                              <option value="">-- Pilih Bab --</option>
                              @foreach ($babs as $bab)
                                <option value="{{ $bab->id }}" {{ $quiz->bab_id == $bab->id ? 'selected' : '' }}>
                                  {{ $bab->judul }}
                                </option>
                              @endforeach
                            </select>
                          </div>

                          <div class="col-md-6">
                            <label class="form-label fw-semibold">Judul Kuis</label>
                            <input type="text" name="title" class="form-control" value="{{ $quiz->title }}" required>
                          </div>

                          <div class="col-12">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="3">{{ $quiz->description }}</textarea>
                          </div>

                          <div class="col-md-4">
                            <label class="form-label fw-semibold">Jumlah Soal</label>
                            <input type="number" name="total_questions" class="form-control" value="{{ $quiz->total_questions }}" min="0" required>
                          </div>

                          <div class="col-md-4">
                            <label class="form-label fw-semibold">Waktu (menit)</label>
                            <input type="number" name="duration_minutes" class="form-control" value="{{ $quiz->duration_minutes }}" min="1" required>
                          </div>

                          <div class="col-md-4">
                            <label class="form-label fw-semibold">KKM</label>
                            <input type="number" step="0.01" name="kkm" class="form-control" value="{{ $quiz->kkm }}" min="0" max="100" required>
                          </div>
                        </div>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning rounded-pill px-4">Simpan Perubahan</button>
                      </div>
                    </form>

                  </div>
                </div>
              </div>

            @empty
              <tr>
                <td colspan="9" class="text-center py-5">
                  <div class="text-muted">
                    <h5 class="mb-1">Belum ada data kuis</h5>
                    <small>Silakan tambahkan kuis terlebih dahulu</small>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>

        </table>
      </div>

    </div>
  </div>

</div>
@endsection