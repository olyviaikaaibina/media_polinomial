@extends('layout.navbar')

@section('title', 'tentang')

@section('content')

<style>
    .about-wrapper {
        background-color: #FDFDE8 !important;  /* SAMAKAN DENGAN HALAMAN LAIN */
        min-height: calc(100vh - 160px);
        padding: 32px 40px 60px;
        box-sizing: border-box;
    }

    .about-section {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 28px;
    }

    /* KARTU UTAMA (putih, rounded) */
    .info-card {
        background-color: #ffffff;
        border-radius: 16px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
        border: 1px solid #e7d9c8;
        overflow: hidden;
    }

    /* BAR JUDUL KOTAK */
    .info-card-header {
        background: linear-gradient(90deg, #b7774f, #c98a5e);
        padding: 10px 18px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #fff;
    }

    .info-icon {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
    }

    .info-card-title {
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .info-card-body {
        padding: 24px 28px 26px;
        font-size: 14px;
        color: #5e554a;
    }

    .info-card-body p {
        margin-bottom: 14px;
        line-height: 1.7;
    }

    /* Judul utama dalam Informasi Media */
    .media-main-title {
        font-family: "Playfair Display", serif;
        font-size: 18px;
        font-weight: 700;
        text-align: center;
        text-transform: uppercase;
        margin: 18px 0 22px;
        color: #3f3a33;
    }

    .media-main-title span {
        display: block;
        font-size: 16px;
    }

    /* Tabel informasi */
    .info-grid {
        display: grid;
        grid-template-columns: auto 1fr;
        column-gap: 18px;
        row-gap: 6px;
        margin-top: 4px;
    }

    .info-label {
        font-weight: 600;
        color: #4c4439;
        white-space: nowrap;
    }

    .info-value {
        color: #5e554a;
    }

    /* Daftar pustaka */
    .ref-list {
        margin-top: 6px;
        padding-left: 18px;
    }

    .ref-list li {
        margin-bottom: 6px;
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        .about-wrapper {
            padding: 24px 16px 40px;
        }

        .info-card-body {
            padding: 18px 16px 20px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .info-label {
            margin-top: 6px;
        }
    }
</style>

<div class="about-wrapper">
    <div class="about-section">

        {{-- KARTU 1 --}}
        <div class="info-card">
            <div class="info-card-header">
                <div class="info-card-title">Informasi Media</div>
            </div>

            <div class="info-card-body">
                <p>
                    Media pembelajaran ini dibuat untuk memenuhi persyaratan dalam menyelesaikan program Strata-1 Pendidikan Komputer dengan judul:
                </p>

                <div class="media-main-title">
                    <span>PENGEMBANGAN MEDIA PEMBELAJARAN INTERAKTIF BERBASIS WEB MATERI POLINOMIAL DENGAN METODE TUTORIAL UNTUK SISWA KELAS XI</span>
                </div>

                <div class="info-grid">
                    <div class="info-label">Nama Pengembang</div>
                    <div class="info-value">Olyvia Ika Albina</div>

                    <div class="info-label">Email</div>
                    <div class="info-value">olyviaikaaibina@gmail.com</div>

                    <div class="info-label">Dosen Pembimbing 1</div>
                    <div class="info-value">Dr. R. Ati Sukmawati, M.Kom.</div>

                    <div class="info-label">Dosen Pembimbing 2</div>
                    <div class="info-value">Delsika Pramata Sari, M.Pd.</div>

                    <div class="info-label">Jurusan</div>
                    <div class="info-value">S-1 Pendidikan Komputer</div>

                    <div class="info-label">Fakultas</div>
                    <div class="info-value">Fakultas Keguruan dan Ilmu Pendidikan</div>

                    <div class="info-label">Instansi</div>
                    <div class="info-value">Universitas Lambung Mangkurat</div>

                    <div class="info-label">Tahun</div>
                    <div class="info-value">2026</div>
                </div>
            </div>
        </div>

        {{-- KARTU 2 --}}
        <div class="info-card">
            <div class="info-card-header">
                <div class="info-card-title">Daftar Pustaka dan Atribusi</div>
            </div>

            <div class="info-card-body">
                <p>
                    Referensi dan sumber rujukan yang digunakan dalam penyusunan materi Polimathica:
                </p>

                <ul class="ref-list">
                    <li>Purcell, E.J., Varberg, R., & Rigdon, S. (2007). <i>Calculus</i>. Pearson.</li>
                    <li>Stewart, J. (2015). <i>Essential Calculus</i>. Cengage Learning.</li>
                </ul>
            </div>
        </div>

    </div>
</div>

@endsection
