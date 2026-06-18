@extends('layout.navbar')

@section('title', 'tentang')

@section('content')

<style>
    .about-wrapper {
        background-color: #FDFDE8 !important;
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

    /* KARTU UTAMA */
    .info-card {
        background-color: #ffffff;
        border-radius: 16px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
        border: 1px solid #e7d9c8;
        overflow: hidden;
        transition: transform 0.35s ease, box-shadow 0.35s ease, border-color 0.35s ease;
        cursor: pointer;
    }

    .info-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 16px 30px rgba(0, 0, 0, 0.12);
        border-color: #d5b08e;
    }

    /* BAR JUDUL KOTAK */
    .info-card-header {
        background: linear-gradient(90deg, #b7774f, #c98a5e);
        padding: 10px 18px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #fff;
        transition: background 0.35s ease, padding 0.35s ease;
    }

    .info-card:hover .info-card-header {
        background: linear-gradient(90deg, #a86741, #bf7d50);
        padding-left: 24px;
    }

    .info-card-title {
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: letter-spacing 0.3s ease;
    }

    .info-card:hover .info-card-title {
        letter-spacing: 0.8px;
    }

    .info-card-body {
        padding: 24px 28px 26px;
        font-size: 14px;
        color: #5e554a;
        transition: transform 0.3s ease;
    }

    .info-card:hover .info-card-body {
        transform: translateY(-2px);
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
        transition: transform 0.3s ease, color 0.3s ease;
        line-height: 1.5;
    }

    .info-card:hover .media-main-title {
        transform: scale(1.01);
        color: #2f2a24;
    }

    .media-main-title span {
        display: block;
        font-size: 16px;
    }

    /* Tabel informasi dengan tanda : rata */
    .info-grid {
        display: grid;
        grid-template-columns: 170px 12px 1fr;
        column-gap: 8px;
        row-gap: 8px;
        margin-top: 4px;
        align-items: start;
    }

    .info-label {
        font-weight: 600;
        color: #4c4439;
        white-space: nowrap;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .info-colon {
        color: #4c4439;
        font-weight: 600;
        text-align: center;
    }

    .info-value {
        color: #5e554a;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .info-card:hover .info-label,
    .info-card:hover .info-value,
    .info-card:hover .info-colon {
        transform: translateX(3px);
    }

    .info-card:hover .info-label {
        color: #3d372f;
    }

    .info-card:hover .info-value {
        color: #51493f;
    }

    /* Daftar pustaka */
    .ref-list {
        margin-top: 6px;
        padding-left: 18px;
    }

    .ref-list li {
        margin-bottom: 10px;
        line-height: 1.6;
        transition: transform 0.25s ease, color 0.25s ease;
    }

    .info-card:hover .ref-list li {
        transform: translateX(4px);
        color: #4a4339;
    }

    @media (max-width: 768px) {
        .about-wrapper {
            padding: 24px 16px 40px;
        }

        .info-card-body {
            padding: 18px 16px 20px;
        }

        .info-grid {
            grid-template-columns: 120px 10px 1fr;
            column-gap: 6px;
        }

        .info-label,
        .info-value,
        .info-colon {
            font-size: 13px;
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
                    <span>PENGEMBANGAN MEDIA PEMBELAJARAN INTERAKTIF BERBASIS WEBSITE PADA MATERI POLINOMIAL KELAS XI SMA DENGAN MODEL TUTORIAL</span>
                </div>

                <div class="info-grid">
                    <div class="info-label">Nama Pengembang</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">Olyvia Ika Albina</div>

                    <div class="info-label">Email</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">olyviaikaaibina@gmail.com</div>

                    <div class="info-label">No. HP</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">081348475667</div>

                    <div class="info-label">Dosen Pembimbing 1</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">Dr. R. Ati Sukmawati, M.Kom.</div>

                    <div class="info-label">Dosen Pembimbing 2</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">Delsika Pramata Sari, M.Pd.</div>

                    <div class="info-label">Jurusan</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">S-1 Pendidikan Komputer</div>

                    <div class="info-label">Fakultas</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">Fakultas Keguruan dan Ilmu Pendidikan</div>

                    <div class="info-label">Instansi</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">Universitas Lambung Mangkurat</div>

                    <div class="info-label">Tahun</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">2026</div>
                </div>
            </div>
        </div>

        {{-- KARTU 2 --}}
        <div class="info-card">
            <div class="info-card-header">
                <div class="info-card-title">Daftar Pustaka</div>
            </div>

            <div class="info-card-body">
                <p>
                    Referensi yang digunakan dalam penyusunan materi Polinomial pada media pembelajaran ini:
                </p>

                <ul class="ref-list">
                    <li>
                        Kristanto, Y. D., Taqiyuddin, M., Masta, A. A., & Yulfiana, E. (2024).
                        <i>Matematika Tingkat Lanjut untuk SMA/MA Kelas XI (Edisi Revisi)</i>.
                        Jakarta: Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi.
                    </li>

                    <li>
                        Masta, A. A., Kristanto, Y. D., Yulfiana, E., & Taqiyuddin, M. (2021).
                        <i>Matematika Tingkat Lanjut untuk SMA Kelas XI</i>.
                        Jakarta: Pusat Perbukuan, Badan Standar, Kurikulum, dan Asesmen Pendidikan.
                    </li>

                    <li>
                        Sutrima, & Usodo, B. (2009).
                        <i>Wahana Matematika 2 untuk SMA/MA Kelas XI Program Ilmu Pengetahuan Alam</i>.
                        Jakarta: Pusat Perbukuan, Departemen Pendidikan Nasional.
                    </li>

                    <li>
                        Djumanta, W., & Sudrajat, R. (2008).
                        <i>Mahir Mengembangkan Kemampuan Matematika 2 untuk Kelas XI Sekolah Menengah Atas/Madrasah Aliyah Program Ilmu Pengetahuan Alam</i>.
                        Jakarta: Pusat Perbukuan, Departemen Pendidikan Nasional.
                    </li>

                    <li>
                        Soedyarto, N., & Maryanto. (2008).
                        <i>Matematika 2 untuk SMA atau MA Kelas XI Program IPA</i>.
                        Jakarta: Pusat Perbukuan, Departemen Pendidikan Nasional.
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>

@endsection