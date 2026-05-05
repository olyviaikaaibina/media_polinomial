@extends('layout.navbarguru')

@section('title', 'Soal Kuis')

@section('content')
  <div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="mb-4">
      <h2 class="fw-bold mb-1" style="color:#4f4a3f;">Soal Kuis</h2>
      <p class="text-muted mb-0">
        {{ $quiz->title }} | {{ $quiz->bab->judul ?? '-' }} | {{ $quiz->questions->count() }} soal
      </p>
    </div>

    {{-- CARD --}}
    <div class="card border-0 shadow-sm rounded-4">
      <div class="card-body p-0">

        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">

            <thead style="background-color:#EAD9C7;">
              <tr class="text-center">
                <th style="width:60px;">No</th>
                <th class="text-start">Pertanyaan</th>
                <th style="width:150px;">Pilihan</th>
                <th style="width:150px;">Jawaban</th>
                <th style="width:160px;">Aksi</th>
              </tr>
            </thead>

            <tbody>
              @forelse ($quiz->questions as $question)
                <tr>
                  <td class="text-center">
                    {{ $question->question_order ?? $loop->iteration }}
                  </td>

                  <td>
                    {{ $question->question_text }}

                    @if (!empty($question->question_image))
                      <div class="mt-2">
                        <img src="{{ asset('img/kuis/' . $question->question_image) }}" class="img-fluid rounded"
                          style="max-width:160px;">
                      </div>
                    @endif
                  </td>

                  <td>
                    @foreach ($question->options as $option)
                      <div>
                        <strong>{{ $option->option_label }}.</strong>
                        {{ $option->option_text }}
                      </div>
                    @endforeach
                  </td>

                  <td class="text-center">
                    @php
                      $correctOption = $question->options->firstWhere('is_correct', 1);
                    @endphp

                    @if ($correctOption)
                      <span class="badge bg-success">
                        {{ $correctOption->option_label }}
                      </span>
                    @else
                      <span class="badge bg-secondary">-</span>
                    @endif
                  </td>

                  <td class="text-center">
                    <div class="d-flex justify-content-center gap-1">

                      <button type="button" class="btn btn-sm btn-warning px-3 btn-edit-soal"
                        data-url="{{ route('kuis.soal.show', $question->id) }}"
                        data-update-url="{{ route('kuis.soal.update', $question->id) }}" data-bs-toggle="modal"
                        data-bs-target="#modalEditSoal">
                        Edit
                      </button>

                      <form action="{{ route('kuis.soal.destroy', $question->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus soal ini?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-sm btn-danger px-3">
                          Hapus
                        </button>
                      </form>

                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center py-5">
                    <div class="text-muted">
                      <h5 class="mb-1">Belum ada soal</h5>
                      <small>Silakan tambahkan soal terlebih dahulu</small>
                    </div>
                  </td>
                </tr>
              @endforelse
            </tbody>

          </table>
        </div>

      </div>
    </div>

    {{-- MODAL TAMBAH SOAL --}}
    <div class="modal fade" id="modalTambahSoal" tabindex="-1">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">

          <form action="{{ route('kuis.soal.store', $quiz->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="modal-header" style="background-color:#EAD9C7;">
              <h5 class="modal-title fw-bold">Tambah Soal</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label fw-semibold">Pertanyaan</label>
                <textarea name="question_text" class="form-control" rows="3" required></textarea>
              </div>

              <div class="mb-3">
                <label class="form-label fw-semibold">Gambar Soal</label>
                <input type="file" name="question_image" class="form-control" accept="image/*">
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label fw-semibold">Opsi A</label>
                  <input type="text" name="option_a" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                  <label class="form-label fw-semibold">Opsi B</label>
                  <input type="text" name="option_b" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                  <label class="form-label fw-semibold">Opsi C</label>
                  <input type="text" name="option_c" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                  <label class="form-label fw-semibold">Opsi D</label>
                  <input type="text" name="option_d" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                  <label class="form-label fw-semibold">Opsi E</label>
                  <input type="text" name="option_e" class="form-control" required>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label fw-semibold">Jawaban Benar</label>
                <select name="correct_option" class="form-select" required>
                  <option value="">-- Pilih Jawaban Benar --</option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                </select>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                Batal
              </button>
              <button type="submit" class="btn btn-success px-4">
                Simpan
              </button>
            </div>

          </form>

        </div>
      </div>
    </div>


    {{-- MODAL EDIT SOAL --}}
    <div class="modal fade" id="modalEditSoal" tabindex="-1">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">

          <form id="formEditSoal" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="modal-header" style="background-color:#EAD9C7;">
              <h5 class="modal-title fw-bold">Edit Soal</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label fw-semibold">Pertanyaan</label>
                <textarea name="question_text" id="edit_question_text" class="form-control" rows="3" required></textarea>
              </div>

              <div class="mb-3">
                <label class="form-label fw-semibold">Gambar Soal</label>
                <input type="file" name="question_image" id="edit_question_image" class="form-control" accept="image/*">
                <div class="mt-2" id="edit_image_preview_wrapper" style="display:none;">
                  <img id="edit_image_preview" class="img-fluid rounded" style="max-width:180px;">

                  <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="remove_image" value="1" id="edit_remove_image">
                    <label class="form-check-label" for="edit_remove_image">
                      Hapus gambar saat ini
                    </label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label fw-semibold">Opsi A</label>
                  <input type="text" name="option_a" id="edit_option_a" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                  <label class="form-label fw-semibold">Opsi B</label>
                  <input type="text" name="option_b" id="edit_option_b" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                  <label class="form-label fw-semibold">Opsi C</label>
                  <input type="text" name="option_c" id="edit_option_c" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                  <label class="form-label fw-semibold">Opsi D</label>
                  <input type="text" name="option_d" id="edit_option_d" class="form-control" required>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Opsi E</label>
                <input type="text" name="option_e" id="edit_option_e" class="form-control" required>
              </div>

              <div class="mb-3">
                <label class="form-label fw-semibold">Jawaban Benar</label>
                <select name="correct_option" id="edit_correct_option" class="form-select" required>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                  <option value="E">E</option>

                </select>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                Batal
              </button>
              <button type="submit" class="btn btn-warning px-4">
                Update
              </button>
            </div>

          </form>

        </div>
      </div>
    </div>


    <script>
      document.querySelectorAll('.btn-edit-soal').forEach(btn => {
        btn.addEventListener('click', async function () {
          const url = this.dataset.url;
          const updateUrl = this.dataset.updateUrl;

          const previewWrapper = document.getElementById('edit_image_preview_wrapper');
          const previewImage = document.getElementById('edit_image_preview');

          const imageInput = document.getElementById('edit_question_image');
          const removeImage = document.getElementById('edit_remove_image');

          imageInput.value = '';
          removeImage.checked = false;

          try {
            const response = await fetch(url, {
              headers: {
                'Accept': 'application/json'
              }
            });

            const data = await response.json();

            document.getElementById('formEditSoal').action = updateUrl;
            document.getElementById('edit_question_text').value = data.question_text ?? '';

            let options = {
              A: '',
              B: '',
              C: '',
              D: '',
              E: ''
            };

            let correct = 'A';

            (data.options || []).forEach(option => {
              options[option.option_label] = option.option_text ?? '';

              if (option.is_correct == 1 || option.is_correct === true) {
                correct = option.option_label;
              }
            });

            document.getElementById('edit_option_a').value = options.A;
            document.getElementById('edit_option_b').value = options.B;
            document.getElementById('edit_option_c').value = options.C;
            document.getElementById('edit_option_d').value = options.D;
            document.getElementById('edit_option_e').value = options.E;
            document.getElementById('edit_correct_option').value = correct;

            if (data.question_image) {
              previewImage.src = `/img/kuis/${data.question_image}`;
              previewWrapper.style.display = 'block';
            } else {
              previewImage.src = '';
              previewWrapper.style.display = 'none';
            }

          } catch (error) {
            console.error(error);
            alert('Data soal gagal dimuat.');
          }
        });
      });
    </script>

    {{-- BUTTON BAWAH --}}
    <div class="d-flex justify-content-between mt-4">

      <a href="{{ route('daftarkuis') }}" class="btn btn-secondary px-4">
        ← Kembali
      </a>

      <button type="button" class="btn btn-success px-4" data-bs-toggle="modal" data-bs-target="#modalTambahSoal">
        + Tambah Soal
      </button>

    </div>

  </div>
@endsection