@extends('layout.navbarguru')

@section('title', 'Manajemen Kuis')

@section('content')

<style>
  /*
  |--------------------------------------------------------------------------
  | Reset
  |--------------------------------------------------------------------------
  */
  .content-area,
  .main-content,
  .page-content,
  .content-wrapper,
  .dashboard-wrapper {
    background: transparent !important;
    box-shadow: none !important;
    border: none !important;
  }

  * {
    box-sizing: border-box;
  }

  body {
    overflow-x: hidden;
  }

  /*
  |--------------------------------------------------------------------------
  | Burger Icon
  |--------------------------------------------------------------------------
  */
  .kuis-mobile-header {
    display: none;
    width: 100%;
    margin-bottom: 18px;
  }

  .kuis-burger-btn {
    width: 68px;
    height: 68px;
    border: 3px solid #8fa283;
    border-radius: 20px;
    background: #ffffff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: #4b453d;
    box-shadow: none;
    transition: 0.2s ease;
    font-size: 0;
  }

  .kuis-burger-btn:hover {
    background: #f7faf4;
    transform: translateY(-1px);
  }

  .kuis-burger-btn:active {
    transform: scale(0.97);
  }

  .kuis-burger-icon {
    width: 30px;
    height: 24px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .kuis-burger-icon span {
    display: block;
    width: 100%;
    height: 4px;
    border-radius: 999px;
    background: #4b453d;
  }

  .kuis-sidebar-overlay {
    position: fixed;
    inset: 0;
    display: none;
    background: rgba(47, 43, 37, 0.45);
    z-index: 1020;
  }

  .kuis-sidebar-overlay.show {
    display: block;
  }

  /*
  |--------------------------------------------------------------------------
  | Sidebar bawaan layout jadi drawer hijau saat mobile
  |--------------------------------------------------------------------------
  */
  @media (max-width: 991.98px) {
    body.kuis-sidebar-open {
      overflow: hidden;
    }

    body.kuis-sidebar-open .kuis-sidebar-overlay {
      display: block;
    }

    body :is(
      .sidebar,
      .sidebar-guru,
      .guru-sidebar,
      .navbarguru-sidebar,
      .navbar-guru-sidebar,
      .layout-sidebar,
      .side-menu,
      .side-navbar
    ) {
      position: fixed !important;
      top: 0 !important;
      left: 0 !important;
      width: 260px !important;
      max-width: 84vw !important;
      height: 100vh !important;
      min-height: 100vh !important;
      overflow-y: auto !important;
      background: #94A889 !important;
      background-color: #94A889 !important;
      z-index: 1025 !important;
      transform: translateX(-110%) !important;
      transition: transform 0.25s ease !important;
      box-shadow: 18px 0 40px rgba(47, 43, 37, 0.22) !important;
      border-right: none !important;
    }

    body.kuis-sidebar-open :is(
      .sidebar,
      .sidebar-guru,
      .guru-sidebar,
      .navbarguru-sidebar,
      .navbar-guru-sidebar,
      .layout-sidebar,
      .side-menu,
      .side-navbar
    ) {
      transform: translateX(0) !important;
    }

    body.kuis-sidebar-open :is(
      .sidebar,
      .sidebar-guru,
      .guru-sidebar,
      .navbarguru-sidebar,
      .navbar-guru-sidebar,
      .layout-sidebar,
      .side-menu,
      .side-navbar
    ) > * {
      background-color: transparent !important;
    }

    body.kuis-sidebar-open :is(
      .sidebar,
      .sidebar-guru,
      .guru-sidebar,
      .navbarguru-sidebar,
      .navbar-guru-sidebar,
      .layout-sidebar,
      .side-menu,
      .side-navbar
    ) :is(
      .brand,
      .logo,
      .sidebar-brand,
      .sidebar-header,
      .menu,
      .nav,
      .navbar-nav,
      .sidebar-menu,
      .menu-wrapper,
      .nav-wrapper,
      .collapse,
      .offcanvas-body
    ) {
      background: transparent !important;
      background-color: transparent !important;
    }
  }

  /*
  |--------------------------------------------------------------------------
  | Page
  |--------------------------------------------------------------------------
  */
  .kuis-page {
    min-height: 100vh;
    padding: 28px 36px 55px;
    background: transparent !important;
    color: #2f2b25;
    overflow-x: hidden;
  }

  .kuis-content {
    width: 100%;
    max-width: 1240px;
    margin: 0 auto;
  }

  /*
  |--------------------------------------------------------------------------
  | Header
  |--------------------------------------------------------------------------
  */
  .kuis-header-card {
    margin-bottom: 24px;
    padding: 28px 30px;
    border-radius: 26px;
    background: #ffffff;
    border: 1px solid rgba(139, 115, 88, 0.18);
    box-shadow: 0 14px 30px rgba(83, 68, 47, 0.08);
  }

  .kuis-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 22px;
    flex-wrap: wrap;
  }

  .kuis-header-left {
    flex: 1;
    min-width: 260px;
  }

  .kuis-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 12px;
    padding: 8px 14px;
    border-radius: 999px;
    color: #536948;
    background: #edf4e8;
    font-size: 12px;
    font-weight: 900;
    letter-spacing: 0.7px;
    text-transform: uppercase;
  }

  .kuis-title {
    margin: 0;
    color: #2f2b25;
    font-size: clamp(28px, 4vw, 42px);
    line-height: 1.1;
    font-weight: 950;
    letter-spacing: -1.2px;
  }

  .kuis-subtitle {
    margin: 10px 0 0;
    color: #675f52;
    font-size: 15px;
    line-height: 1.6;
    font-weight: 600;
  }

  /*
  |--------------------------------------------------------------------------
  | Card Table
  |--------------------------------------------------------------------------
  */
  .modern-card {
    border: 0;
    border-radius: 24px;
    background: #ffffff;
    box-shadow: 0 16px 35px rgba(83, 68, 47, 0.08);
    overflow: hidden;
  }

  .section-header-modern {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 18px;
    padding: 24px 26px 16px;
    background: linear-gradient(135deg, #ffffff, #fbfbf4);
  }

  .section-header-left {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    min-width: 0;
  }

  .section-icon-box {
    width: 54px;
    height: 54px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #edf4e8, #fff1d5);
    color: #536948;
    font-size: 24px;
    flex-shrink: 0;
    box-shadow: 0 8px 20px rgba(83, 105, 72, 0.12);
  }

  .section-title-modern {
    margin: 0;
    color: #2f2b25;
    font-size: 22px;
    font-weight: 950;
    letter-spacing: -0.4px;
  }

  .section-subtitle-modern {
    margin: 5px 0 0;
    color: #70685d;
    font-size: 14px;
    line-height: 1.5;
    font-weight: 600;
  }

  .section-badge-soft {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 10px 16px;
    border-radius: 999px;
    background: #edf4e8;
    color: #536948;
    font-size: 13px;
    font-weight: 850;
    white-space: nowrap;
    min-height: 42px;
  }

  .table-wrapper-clean {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    padding-bottom: 4px;
  }

  .kuis-table {
    width: 100%;
    min-width: 980px;
    margin-bottom: 0;
  }

  .kuis-table thead th {
    padding: 16px 14px;
    color: #5f574e;
    background: #EAD9C7;
    font-size: 13px;
    font-weight: 900;
    border: 0;
    white-space: nowrap;
    vertical-align: middle;
  }

  .kuis-table tbody td {
    padding: 16px 14px;
    color: #34312c;
    font-size: 14px;
    font-weight: 650;
    vertical-align: middle;
    border-bottom: 1px solid rgba(83, 105, 72, 0.10);
  }

  .kuis-table tbody tr:hover {
    background: #fbfbf7;
  }

  .quiz-title-text {
    color: #2f2b25;
    font-weight: 900;
  }

  .quiz-bab-text {
    color: #536948;
    font-weight: 850;
  }

  .quiz-desc-text {
    color: #5f574e;
    font-weight: 600;
    line-height: 1.45;
    min-width: 220px;
  }

  .aksi-wrap {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    flex-wrap: nowrap;
  }

  .btn-action {
    border-radius: 999px;
    padding: 6px 13px;
    font-size: 12px;
    font-weight: 800;
    white-space: nowrap;
  }

  .empty-state-box {
    padding: 48px 0;
    text-align: center;
  }

  .empty-icon-box {
    width: 82px;
    height: 82px;
    margin: 0 auto 14px;
    border-radius: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #edf4e8;
    color: #536948;
    font-size: 34px;
  }

  /*
  |--------------------------------------------------------------------------
  | Modal
  |--------------------------------------------------------------------------
  */
  .modal-content {
    border: 0;
    border-radius: 22px;
    overflow: hidden;
    box-shadow: 0 20px 45px rgba(47, 43, 37, 0.22);
  }

  .modal-header {
    background: #EAD9C7;
    border-bottom: 1px solid rgba(139, 115, 88, 0.18);
  }

  .modal-title {
    color: #2f2b25;
    font-weight: 900;
  }

  .modal-footer {
    border-top: 1px solid rgba(139, 115, 88, 0.18);
  }

  /*
  |--------------------------------------------------------------------------
  | Responsive Laptop Kecil
  |--------------------------------------------------------------------------
  */
  @media (max-width: 1199px) {
    .kuis-page {
      padding: 26px 28px 50px;
    }

    .kuis-content {
      max-width: 100%;
    }

    .kuis-header-card,
    .modern-card {
      border-radius: 22px;
    }
  }

  /*
  |--------------------------------------------------------------------------
  | Responsive Tablet
  |--------------------------------------------------------------------------
  */
  @media (max-width: 992px) {
    .kuis-mobile-header {
      display: flex;
      align-items: center;
      justify-content: flex-start;
    }

    .kuis-page {
      padding: 22px 22px 48px;
    }

    .kuis-header-card {
      padding: 26px;
    }

    .section-header-modern {
      flex-direction: column;
      align-items: stretch;
      padding: 22px;
    }

    .section-badge-soft {
      width: fit-content;
    }
  }

  /*
  |--------------------------------------------------------------------------
  | Responsive HP Besar
  |--------------------------------------------------------------------------
  */
  @media (max-width: 768px) {
    .kuis-page {
      padding: 18px 16px 44px;
    }

    .kuis-mobile-header {
      margin-bottom: 16px;
    }

    .kuis-burger-btn {
      width: 66px;
      height: 66px;
      border-radius: 20px;
    }

    .kuis-header-card {
      padding: 22px;
      border-radius: 20px;
    }

    .kuis-title {
      font-size: 32px;
    }

    .kuis-subtitle {
      font-size: 14px;
    }

    .modern-card {
      border-radius: 20px;
    }

    .section-header-modern {
      padding: 20px;
    }

    .section-title-modern {
      font-size: 19px;
    }

    .section-subtitle-modern {
      font-size: 13.5px;
    }

    .section-badge-soft {
      width: 100%;
    }

    .modern-card .card-body {
      padding-left: 18px !important;
      padding-right: 18px !important;
    }

    .kuis-table {
      min-width: 940px;
    }
  }

  /*
  |--------------------------------------------------------------------------
  | Responsive HP Kecil
  |--------------------------------------------------------------------------
  */
  @media (max-width: 576px) {
    .kuis-page {
      padding: 14px 12px 38px;
    }

    .kuis-burger-btn {
      width: 66px;
      height: 66px;
      border-radius: 20px;
      border-width: 3px;
    }

    .kuis-header-card {
      padding: 18px;
      border-radius: 18px;
    }

    .kuis-label {
      font-size: 10.5px;
      padding: 7px 11px;
    }

    .kuis-title {
      font-size: 27px;
      line-height: 1.15;
    }

    .kuis-subtitle {
      font-size: 13.5px;
    }

    .modern-card {
      border-radius: 18px;
    }

    .section-header-modern {
      padding: 18px;
    }

    .section-header-left {
      flex-direction: column;
    }

    .section-icon-box {
      width: 46px;
      height: 46px;
      border-radius: 16px;
      font-size: 21px;
    }

    .section-title-modern {
      font-size: 18px;
    }

    .section-subtitle-modern {
      font-size: 13px;
    }

    .modern-card .card-body {
      padding-left: 14px !important;
      padding-right: 14px !important;
    }

    .kuis-table {
      min-width: 900px;
    }

    .kuis-table thead th,
    .kuis-table tbody td {
      font-size: 12.5px;
      padding-left: 10px;
      padding-right: 10px;
    }

    .btn-action {
      padding: 5px 10px;
      font-size: 12px;
    }

    .modal-dialog {
      margin: 12px;
    }

    .empty-state-box {
      padding: 36px 10px;
    }

    .empty-icon-box {
      width: 64px;
      height: 64px;
      border-radius: 22px;
      font-size: 28px;
    }
  }

  /*
  |--------------------------------------------------------------------------
  | Responsive HP Sangat Kecil
  |--------------------------------------------------------------------------
  */
  @media (max-width: 380px) {
    .kuis-page {
      padding: 12px 10px 34px;
    }

    .kuis-burger-btn {
      width: 62px;
      height: 62px;
      border-radius: 19px;
    }

    .kuis-burger-icon {
      width: 28px;
      height: 22px;
    }

    .kuis-burger-icon span {
      height: 4px;
    }

    .kuis-header-card {
      padding: 16px;
    }

    .kuis-title {
      font-size: 24px;
    }

    .section-header-modern {
      padding: 16px;
    }

    .modern-card .card-body {
      padding-left: 12px !important;
      padding-right: 12px !important;
    }

    .kuis-table {
      min-width: 860px;
    }
  }
</style>

<div class="kuis-sidebar-overlay" id="kuisSidebarOverlay"></div>

<div class="kuis-page">
  <div class="kuis-content">

    {{-- BURGER ICON MOBILE --}}
    <div class="kuis-mobile-header">
      <button type="button" class="kuis-burger-btn" id="kuisBurgerBtn" aria-label="Buka Sidebar">
        <span class="kuis-burger-icon">
          <span></span>
          <span></span>
          <span></span>
        </span>
      </button>
    </div>

    {{-- HEADER --}}
    <div class="kuis-header-card">
      <div class="kuis-header">
        <div class="kuis-header-left">
          <div class="kuis-label">
            <i class="bi bi-ui-checks-grid"></i>
            Manajemen Kuis
          </div>

          <h2 class="kuis-title">Manajemen Kuis</h2>

          <p class="kuis-subtitle">
            Daftar seluruh kuis yang tersedia.
          </p>
        </div>
      </div>
    </div>

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    {{-- TABLE CARD --}}
    <div class="card modern-card mb-4">
      <div class="section-header-modern">
        <div class="section-header-left">
          <div class="section-icon-box">
            <i class="bi bi-journal-check"></i>
          </div>

          <div>
            <h5 class="section-title-modern">Daftar Kuis</h5>
            <p class="section-subtitle-modern">
              Kelola judul, bab, deskripsi, jumlah soal, waktu, dan KKM setiap kuis.
            </p>
          </div>
        </div>

        <span class="section-badge-soft">
          <i class="bi bi-clipboard-data"></i>
          Total Kuis: {{ isset($quizzes) ? count($quizzes) : 0 }}
        </span>
      </div>

      <div class="card-body p-0">
        <div class="table-wrapper-clean">
          <table class="table table-hover align-middle kuis-table">

            <thead>
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

                  <td>
                    <span class="quiz-title-text">{{ $quiz->title }}</span>
                  </td>

                  <td>
                    <span class="quiz-bab-text">
                      {{ $quiz->bab->judul ?? 'Bab tidak ditemukan' }}
                    </span>
                  </td>

                  <td>
                    <div class="quiz-desc-text">
                      {{ $quiz->description }}
                    </div>
                  </td>

                  <td class="text-center">{{ $quiz->total_questions }}</td>

                  <td class="text-center">{{ $quiz->duration_minutes }} menit</td>

                  <td class="text-center">{{ $quiz->kkm }}</td>

                  <td class="text-center">
                    <div class="aksi-wrap">
                      <a href="{{ route('kuis.soal', $quiz->id) }}" class="btn btn-sm btn-info btn-action">
                        Soal
                      </a>

                      <button
                        type="button"
                        class="btn btn-sm btn-warning btn-action"
                        data-bs-toggle="modal"
                        data-bs-target="#editQuizModal{{ $quiz->id }}">
                        Edit
                      </button>
                    </div>
                  </td>
                </tr>

                {{-- Modal Edit --}}
                <div class="modal fade" id="editQuizModal{{ $quiz->id }}" tabindex="-1"
                  aria-labelledby="editQuizLabel{{ $quiz->id }}" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">

                      <div class="modal-header">
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
                              <input type="number" name="total_questions" class="form-control"
                                value="{{ $quiz->total_questions }}" min="0" required>
                            </div>

                            <div class="col-md-4">
                              <label class="form-label fw-semibold">Waktu (menit)</label>
                              <input type="number" name="duration_minutes" class="form-control"
                                value="{{ $quiz->duration_minutes }}" min="1" required>
                            </div>

                            <div class="col-md-4">
                              <label class="form-label fw-semibold">KKM</label>
                              <input type="number" step="0.01" name="kkm" class="form-control"
                                value="{{ $quiz->kkm }}" min="0" max="100" required>
                            </div>

                          </div>
                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                            Batal
                          </button>

                          <button type="submit" class="btn btn-warning rounded-pill px-4">
                            Simpan Perubahan
                          </button>
                        </div>
                      </form>

                    </div>
                  </div>
                </div>

              @empty
                <tr>
                  <td colspan="8" class="text-center py-5">
                    <div class="empty-state-box">
                      <div class="empty-icon-box">
                        <i class="bi bi-journal-x"></i>
                      </div>

                      <h5 class="mb-1 fw-bold">Belum ada data kuis</h5>

                      <small class="text-muted">
                        Silakan tambahkan kuis terlebih dahulu.
                      </small>
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
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    /*
    |--------------------------------------------------------------------------
    | Burger Icon Untuk Buka Sidebar
    |--------------------------------------------------------------------------
    */
    const burgerBtn = document.getElementById('kuisBurgerBtn');
    const sidebarOverlay = document.getElementById('kuisSidebarOverlay');

    function openKuisSidebar() {
      document.body.classList.add('kuis-sidebar-open');

      /*
      | Membuka sidebar bawaan layout.navbarguru
      */
      document.body.classList.add('sidebar-open');

      if (sidebarOverlay) {
        sidebarOverlay.classList.add('show');
      }
    }

    function closeKuisSidebar() {
      document.body.classList.remove('kuis-sidebar-open');
      document.body.classList.remove('sidebar-open');

      if (sidebarOverlay) {
        sidebarOverlay.classList.remove('show');
      }
    }

    if (burgerBtn) {
      burgerBtn.addEventListener('click', function () {
        openKuisSidebar();
      });
    }

    if (sidebarOverlay) {
      sidebarOverlay.addEventListener('click', function () {
        closeKuisSidebar();
      });
    }

    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape') {
        closeKuisSidebar();
      }
    });

    window.addEventListener('resize', function () {
      if (window.innerWidth > 991.98) {
        closeKuisSidebar();
      }
    });
  });
</script>

@endsection