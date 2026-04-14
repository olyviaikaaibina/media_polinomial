@extends('layout.navbar')

@section('title', 'Daftar Materi')

@section('content')

<style>
    .daftar-materi-wrapper {
        background-color: #FDFDE8 !important; /* warna sama dengan login & daftar siswa */
        min-height: calc(100vh - 160px);
        padding: 24px 40px 60px;
        box-sizing: border-box;
    }

    /* GRID KARTU */
    .materi-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 32px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .materi-card {
        background-color: #d2ddcf;
        border-radius: 16px;
        padding: 20px 24px;
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.08);
        min-height: 230px;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
        cursor: pointer;
    }

    .materi-card:hover {
        transform: translateY(-10px) scale(1.03);
        box-shadow: 0 16px 28px rgba(0, 0, 0, 0.15);
        background-color: #c6d6c2;
    }

    .materi-bab {
        background-color: rgba(255, 255, 255, 0.6);
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 1rem;
        font-weight: 700;
        color: #3d3a33;
        text-align: center;
        margin-bottom: 10px;
        transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .materi-card:hover .materi-bab {
        transform: scale(1.08);
        background-color: rgba(255, 255, 255, 0.85);
    }

    .materi-judul {
        font-size: 1.05rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: #3d3a33;
        text-align: center;
        width: 100%;
        transition: color 0.3s ease;
    }

    .materi-card:hover .materi-judul {
        color: #2d2a24;
    }

    .materi-list {
        padding-left: 18px;
        margin: 0;
        font-size: 0.9rem;
        color: #4f4b42;
        width: 100%;
    }

    .materi-list li {
        margin-bottom: 4px;
        transition: transform 0.25s ease, color 0.25s ease;
    }

    .materi-card:hover .materi-list li {
        transform: translateX(4px);
        color: #3f3b34;
    }

    @media (max-width: 992px) {
        .materi-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 600px) {
        .daftar-materi-wrapper {
            padding: 16px;
        }

        .materi-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }
</style>

<div class="daftar-materi-wrapper">

    <div class="materi-grid">

        {{-- A --}}
        <div class="materi-card">
            <div class="materi-bab">A</div>
            <div class="materi-judul">Polinomial dan Fungsi Polinomial</div>
            <ul class="materi-list">
                <li>Pengertian Polinomial</li>
                <li>Derajat Suatu Polinomial</li>
                <li>Fungsi Polinomial dan Grafiknya</li>
            </ul>
        </div>

        {{-- B --}}
        <div class="materi-card">
            <div class="materi-bab">B</div>
            <div class="materi-judul">Penjumlahan, Pengurangan, dan Perkalian Polinomial</div>
            <ul class="materi-list">
                <li>Penjumlahan Polinomial</li>
                <li>Pengurangan Polinomial</li>
                <li>Perkalian Polinomial</li>
            </ul>
        </div>

        {{-- C --}}
        <div class="materi-card">
            <div class="materi-bab">C</div>
            <div class="materi-judul">Pembagian Polinomial</div>
            <ul class="materi-list">
                <li>Pembagian Bersusun</li>
                <li>Metode Horner</li>
                <li>Teorema Sisa</li>
            </ul>
        </div>

        {{-- D --}}
        <div class="materi-card">
            <div class="materi-bab">D</div>
            <div class="materi-judul">Faktor dan Pembuat Nol Polinomial</div>
            <ul class="materi-list">
                <li>Teorema Faktor</li>
                <li>Faktor dan Pembuat Nol Polinomial</li>
            </ul>
        </div>

        {{-- E --}}
        <div class="materi-card">
            <div class="materi-bab">E</div>
            <div class="materi-judul">Identitas Polinomial</div>
            <ul class="materi-list">
                <li>Identitas Polinomial</li>
            </ul>
        </div>

    </div>

</div>

@endsection