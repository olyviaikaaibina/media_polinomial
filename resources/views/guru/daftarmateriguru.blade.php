@extends('layout.navbarguru')

@section('title', 'Daftar Materi')

@section('content')
<style>
   .page-wrap{
    background:#FDFDE8;
    min-height: calc(100vh - 160px);
    padding: 0 24px 60px;
}

    .page-inner{
        max-width: 1200px;
        margin: 0 auto;
    }

   .page-header{
    text-align: center;
    margin: 0 0 20px 0;
}

    .page-title{
        margin: 0;
        font-weight: 700;
        letter-spacing: .2px;
    }

    .materi-grid{
        display:grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap:22px;
    }

    .materi-card{
        background:#d2ddcf;
        border-radius:18px;
        padding:18px 18px 16px;
        box-shadow: 0 10px 24px rgba(0,0,0,.08);
        border:1px solid rgba(0,0,0,.06);
        min-height: 230px;
        display:flex;
        flex-direction:column;
        overflow:hidden;
        cursor: pointer;
        transition: transform .12s ease, box-shadow .12s ease;
    }

    .materi-card:hover{
        transform: translateY(-2px);
        box-shadow: 0 14px 28px rgba(0,0,0,.10);
    }

    .materi-top{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:12px;
        margin-bottom:10px;
    }

    .materi-bab{
        display:inline-flex;
        align-items:center;
        justify-content:center;
        width:38px;
        height:38px;
        border-radius:12px;
        font-weight:800;
        color:#2f2c27;
        background:rgba(255,255,255,.55);
        border:1px solid rgba(0,0,0,.10);
        flex:0 0 auto;
    }

    .materi-chip{
        padding:6px 10px;
        border-radius:999px;
        background:rgba(255,255,255,.55);
        border:1px solid rgba(0,0,0,.08);
        color:#6c757d;
        font-size:.78rem;
        white-space:nowrap;
    }

    .materi-judul{
        font-size:1.05rem;
        font-weight:800;
        color:#2f2c27;
        margin: 6px 0 10px;
        line-height:1.25;
    }

    .materi-list{
        margin:0;
        padding-left:18px;
        color:#4f4b42;
        font-size:.9rem;
    }

    .materi-list li{ margin-bottom:6px; }

    .materi-footer{
        margin-top:auto;
        padding-top:12px;
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:10px;
        border-top:1px dashed rgba(0,0,0,.15);
        color:#6c757d;
        font-size:.82rem;
    }

    .dot{
        width:8px;
        height:8px;
        border-radius:50%;
        background:#adb5bd;
        display:inline-block;
        margin-right:8px;
        vertical-align:middle;
    }

    @media (max-width: 992px){
        .materi-grid{ grid-template-columns: repeat(2, minmax(0,1fr)); }
    }

    @media (max-width: 600px){
        .page-wrap{ padding:16px; }
        .materi-grid{ grid-template-columns: 1fr; }
    }
</style>

<div class="container-fluid p-0">
    <div class="page-wrap">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Daftar Materi</h4>
            </div>

            <div class="materi-grid">

                <div class="materi-card"
                     data-bs-toggle="modal"
                     data-bs-target="#materiModal"
                     data-sub="A"
                     data-judul="Polinomial dan Fungsi Polinomial"
                     data-topik='["Pengertian Polinomial","Derajat Suatu Polinomial","Fungsi Polinomial dan Grafiknya"]'>
                    <div class="materi-top">
                        <div class="materi-bab">A</div>
                        <div class="materi-chip">3 topik</div>
                    </div>
                    <div class="materi-judul">Polinomial dan Fungsi Polinomial</div>
                    <ul class="materi-list">
                        <li>Pengertian Polinomial</li>
                        <li>Derajat Suatu Polinomial</li>
                        <li>Fungsi Polinomial dan Grafiknya</li>
                    </ul>
                    <div class="materi-footer">
                        <span><span class="dot"></span>Materi Dasar</span>
                        <span>Sub-bab A</span>
                    </div>
                </div>

                <div class="materi-card"
                     data-bs-toggle="modal"
                     data-bs-target="#materiModal"
                     data-sub="B"
                     data-judul="Penjumlahan, Pengurangan, dan Perkalian Polinomial"
                     data-topik='["Penjumlahan Polinomial","Pengurangan Polinomial","Perkalian Polinomial"]'>
                    <div class="materi-top">
                        <div class="materi-bab">B</div>
                        <div class="materi-chip">3 topik</div>
                    </div>
                    <div class="materi-judul">Penjumlahan, Pengurangan, dan Perkalian Polinomial</div>
                    <ul class="materi-list">
                        <li>Penjumlahan Polinomial</li>
                        <li>Pengurangan Polinomial</li>
                        <li>Perkalian Polinomial</li>
                    </ul>
                    <div class="materi-footer">
                        <span><span class="dot"></span>Operasi</span>
                        <span>Sub-bab B</span>
                    </div>
                </div>

                <div class="materi-card"
                     data-bs-toggle="modal"
                     data-bs-target="#materiModal"
                     data-sub="C"
                     data-judul="Pembagian Polinomial"
                     data-topik='["Pembagian Bersusun","Metode Horner","Teorema Sisa"]'>
                    <div class="materi-top">
                        <div class="materi-bab">C</div>
                        <div class="materi-chip">3 topik</div>
                    </div>
                    <div class="materi-judul">Pembagian Polinomial</div>
                    <ul class="materi-list">
                        <li>Pembagian Bersusun</li>
                        <li>Metode Horner</li>
                        <li>Teorema Sisa</li>
                    </ul>
                    <div class="materi-footer">
                        <span><span class="dot"></span>Pembagian</span>
                        <span>Sub-bab C</span>
                    </div>
                </div>

                <div class="materi-card"
                     data-bs-toggle="modal"
                     data-bs-target="#materiModal"
                     data-sub="D"
                     data-judul="Faktor dan Pembuat Nol Polinomial"
                     data-topik='["Teorema Faktor","Faktor dan Pembuat Nol Polinomial"]'>
                    <div class="materi-top">
                        <div class="materi-bab">D</div>
                        <div class="materi-chip">2 topik</div>
                    </div>
                    <div class="materi-judul">Faktor dan Pembuat Nol Polinomial</div>
                    <ul class="materi-list">
                        <li>Teorema Faktor</li>
                        <li>Faktor dan Pembuat Nol Polinomial</li>
                    </ul>
                    <div class="materi-footer">
                        <span><span class="dot"></span>Faktor</span>
                        <span>Sub-bab D</span>
                    </div>
                </div>

                <div class="materi-card"
                     data-bs-toggle="modal"
                     data-bs-target="#materiModal"
                     data-sub="E"
                     data-judul="Identitas Polinomial"
                     data-topik='["Identitas Polinomial"]'>
                    <div class="materi-top">
                        <div class="materi-bab">E</div>
                        <div class="materi-chip">1 topik</div>
                    </div>
                    <div class="materi-judul">Identitas Polinomial</div>
                    <ul class="materi-list">
                        <li>Identitas Polinomial</li>
                    </ul>
                    <div class="materi-footer">
                        <span><span class="dot"></span>Identitas</span>
                        <span>Sub-bab E</span>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

{{-- MODAL POPUP --}}
<div class="modal fade" id="materiModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius:18px;">
      <div class="modal-header">
        <h5 class="modal-title" id="materiModalTitle">Detail Materi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body px-4 py-3">
        <div class="mb-2 text-muted small" id="materiModalSub">Sub-bab</div>

        <h5 class="fw-bold mb-3" id="materiModalJudul">Judul</h5>

        <hr>

        <div class="fw-semibold mb-2">Materi:</div>
        <ul id="materiModalList" class="mb-0 ps-3"></ul>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          Tutup
        </button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modalEl = document.getElementById('materiModal');
    if (!modalEl) return;

    modalEl.addEventListener('show.bs.modal', function (event) {
        const trigger = event.relatedTarget;
        if (!trigger) return;

        const sub = trigger.getAttribute('data-sub') || '-';
        const judul = trigger.getAttribute('data-judul') || '-';
        const topikRaw = trigger.getAttribute('data-topik') || '[]';

        let topik = [];
        try { topik = JSON.parse(topikRaw); } catch(e) { topik = []; }

        document.getElementById('materiModalTitle').textContent = 'Detail Materi';
        document.getElementById('materiModalSub').textContent = 'Sub-bab ' + sub;
        document.getElementById('materiModalJudul').textContent = judul;

        const ul = document.getElementById('materiModalList');
        ul.innerHTML = '';
        topik.forEach(t => {
            const li = document.createElement('li');
            li.textContent = t;
            ul.appendChild(li);
        });
    });
});
</script>

{{-- Kalau di layout.navbarguru BELUM ada bootstrap bundle, aktifkan ini: --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}
@endsection
