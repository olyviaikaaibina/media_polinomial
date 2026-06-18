@extends('layout.navbar')

@section('title', 'petunjuk penggunaan')

@section('content')

<style>
    .section-wrapper {
        background-color: #FDFDE8 !important;
        min-height: calc(100vh - 160px);
        padding: 40px 60px 60px;
        box-sizing: border-box;
    }

    .guide-container {
        max-width: 1100px;
        margin: 0 auto;
    }

    .page-title {
        text-align: center;
        font-family: "Times New Roman", serif;
        font-size: 36px;
        font-weight: 700;
        color: #8b6f47;
        margin: 0 0 12px;
        letter-spacing: 0.4px;
    }

    .page-subtitle {
        text-align: center;
        font-size: 15px;
        color: #6f685d;
        margin: 0 0 36px;
        line-height: 1.7;
    }

    .option-list {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .option-item {
        border-radius: 18px;
        overflow: hidden;
        background: #fffaf4;
        border: 1px solid #ead8c2;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
    }

    .option-header {
        width: 100%;
        border: none;
        background: linear-gradient(90deg, #ead8c2, #f2e5d6);
        padding: 20px 58px 20px 22px;
        text-align: left;
        font-size: 17px;
        font-weight: 700;
        color: #6e5437;
        cursor: pointer;
        position: relative;
        transition: background 0.2s ease, transform 0.2s ease;
    }

    .option-header:hover {
        background: linear-gradient(90deg, #e5d0b8, #efdfce);
    }

    .option-header::after {
        content: "";
        position: absolute;
        right: 22px;
        top: 50%;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-left: 7px solid transparent;
        border-right: 7px solid transparent;
        border-top: 10px solid #8b6f47;
        transition: transform 0.25s ease;
    }

    .option-item.active .option-header::after {
        transform: translateY(-50%) rotate(180deg);
    }

    .option-content {
        max-height: 0;
        overflow: hidden;
        opacity: 0;
        padding: 0 22px;
        background: #fffdf8;
        transition: max-height 0.3s ease, opacity 0.25s ease, padding 0.3s ease;
    }

    .option-content.show {
        max-height: 3000px;
        opacity: 1;
        padding: 20px 22px 24px;
    }

    .option-content p {
        margin: 0 0 12px;
        line-height: 1.8;
        color: #5f584f;
        font-size: 14px;
        text-align: justify;
    }

    .option-content p:last-child {
        margin-bottom: 0;
    }

    .guide-image-box {
        width: 100%;
        margin: 4px 0 16px;
        padding: 10px;
        background: #fffaf2;
        border: 1px solid #ead8c2;
        border-radius: 14px;
        box-sizing: border-box;
    }

    .guide-image {
        width: 100%;
        display: block;
        border-radius: 10px;
        border: 1px solid #e7d8c7;
    }

    .image-caption {
        margin-top: 8px;
        text-align: center;
        font-size: 13px;
        color: #8b6f47;
        font-weight: 600;
    }

    .step-list {
        margin: 10px 0 0 0;
        padding: 0;
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .step-list li {
        background: #fcf4ea;
        border: 1px solid #ecdac7;
        border-radius: 12px;
        padding: 12px 14px;
        color: #5f584f;
        line-height: 1.7;
        font-size: 14px;
    }

    .step-number {
        display: inline-block;
        min-width: 26px;
        height: 26px;
        line-height: 26px;
        text-align: center;
        border-radius: 50%;
        background: #c98a5e;
        color: #fff;
        font-weight: 700;
        margin-right: 8px;
        font-size: 13px;
    }

    .point-list {
        margin: 8px 0 0 18px;
        padding: 0;
        color: #5f584f;
    }

    .point-list li {
        margin-bottom: 8px;
        line-height: 1.7;
        font-size: 14px;
        text-align: justify;
    }

    .contact-box {
        background: #fcf4ea;
        border: 1px solid #ecdac7;
        border-radius: 12px;
        padding: 14px 16px;
        margin-top: 10px;
    }

    .contact-list {
        margin: 0;
        padding-left: 18px;
        line-height: 1.8;
        color: #5f584f;
    }

    .contact-list li {
        margin-bottom: 4px;
    }

    .contact-list a {
        color: #8b6f47;
        text-decoration: underline;
        font-weight: 500;
        word-break: break-word;
    }

    .contact-list a:hover {
        color: #6f5332;
    }

    @media (max-width: 768px) {
        .section-wrapper {
            padding: 28px 16px 40px;
        }

        .page-title {
            font-size: 28px;
            line-height: 1.3;
        }

        .page-subtitle {
            font-size: 14px;
            margin-bottom: 28px;
        }

        .option-header {
            font-size: 15px;
            padding: 18px 52px 18px 18px;
        }

        .option-content.show {
            padding: 18px 16px 20px;
        }

        .guide-image-box {
            padding: 8px;
        }

        .image-caption {
            font-size: 12px;
        }
    }
</style>

<div class="section-wrapper">
    <div class="guide-container">

        <h1 class="page-title">Petunjuk Penggunaan Media Pembelajaran</h1>

        <p class="page-subtitle">
            Halaman ini berisi petunjuk singkat untuk membantu pengguna memahami fitur-fitur
            pada media pembelajaran Polimathica.
        </p>

        <div class="option-list">

            {{-- Kotak 1 --}}
            <div class="option-item">
                <button class="option-header" type="button">
                    Pengenalan Polimathica
                </button>

                <div class="option-content">
                    <p>
                        Polimathica adalah media pembelajaran matematika interaktif berbasis web untuk siswa kelas XI SMA pada materi polinomial. Media ini menggunakan model tutorial, sehingga materi disajikan secara bertahap mulai dari penjelasan konsep, contoh soal, latihan, hingga kuis. Dengan media ini, siswa dapat belajar secara lebih terarah, mandiri, dan runtut.
                    </p>
                </div>
            </div>

            {{-- Kotak 2 --}}
            <div class="option-item">
                <button class="option-header" type="button">
                    Halaman Beranda
                </button>

                <div class="option-content">

                    <div class="guide-image-box">
                        <img src="{{ asset('img/p1.png') }}"
                             alt="Tampilan Halaman Beranda Polimathica"
                             class="guide-image">
                        <div class="image-caption">
                            Gambar 1. Tampilan Halaman Beranda Polimathica
                        </div>
                    </div>

                    <ul class="point-list">
                        <li>Halaman beranda adalah tampilan awal saat pengguna membuka website.</li>
                        <li>Pada bagian ini tersedia menu navigasi, tombol <b>Daftar</b>, dan tombol <b>Masuk</b>.</li>
                        <li>Tombol <b>Mulai Belajar</b> digunakan untuk masuk ke pembelajaran.</li>
                        <li>Jika pengguna belum login, maka akan diarahkan terlebih dahulu ke halaman masuk.</li>
                    </ul>
                </div>
            </div>

            {{-- Kotak 3 --}}
            <div class="option-item">
                <button class="option-header" type="button">
                    Cara Mendaftar Akun
                </button>

                <div class="option-content">

                    <div class="guide-image-box">
                        <img src="{{ asset('img/P3.png') }}"
                             alt="Tampilan Halaman Pendaftaran Akun"
                             class="guide-image">
                        <div class="image-caption">
                            Gambar 2. Tampilan Halaman Pendaftaran Akun
                        </div>
                    </div>

                    <p>
                        Ikuti langkah berikut untuk membuat akun:
                    </p>

                    <ol class="step-list">
                        <li>
                            <span class="step-number">1</span>
                            Klik tombol <b>Daftar</b> pada halaman beranda.
                        </li>
                        <li>
                            <span class="step-number">2</span>
                            Isi data yang diminta, yaitu <b>nama</b>, <b>email</b>, <b>NIS</b>,
                            <b>jenis kelamin</b>, <b>kelas</b>, dan <b>password</b>.
                        </li>
                        <li>
                            <span class="step-number">3</span>
                            Pastikan semua data sudah benar, lalu klik tombol <b>Daftar</b>.
                        </li>
                        <li>
                            <span class="step-number">4</span>
                            Setelah akun berhasil dibuat, masuk menggunakan <b>email</b> dan
                            <b>password</b> yang telah didaftarkan.
                        </li>
                    </ol>
                </div>
            </div>

            {{-- Kotak 4 --}}
            <div class="option-item">
                <button class="option-header" type="button">
                    Halaman Materi
                </button>

                <div class="option-content">

                    <div class="guide-image-box">
                        <img src="{{ asset('img/p2.png') }}"
                             alt="Tampilan Halaman Materi Polimathica"
                             class="guide-image">
                        <div class="image-caption">
                            Gambar 3. Tampilan Halaman Materi Polimathica
                        </div>
                    </div>

                    <ul class="point-list">
                        <li>Halaman materi digunakan untuk mengikuti proses pembelajaran.</li>
                        <li>Bagian sidebar menampilkan daftar materi, submateri, dan kuis.</li>
                        <li>Bagian utama berisi penjelasan materi, contoh soal, latihan, dan kuis.</li>
                        <li><b>Progress Belajar</b> digunakan untuk melihat jumlah materi yang telah dikerjakan oleh siswa.</li>
                        <li><b>Logout</b> digunakan untuk keluar dari halaman materi dan mengakhiri sesi belajar.</li>
                        <li>Tombol <b>Previous</b> dan <b>Next</b> digunakan untuk berpindah antarhalaman materi.</li>
                    </ul>
                </div>
            </div>

            {{-- Kotak 5 --}}
            <div class="option-item">
                <button class="option-header" type="button">
                    Hubungi Kami
                </button>

                <div class="option-content">
                    <p>
                        Jika mengalami kendala atau memiliki pertanyaan, silakan hubungi melalui kontak berikut:
                    </p>

                    <div class="contact-box">
                        <ul class="contact-list">
                            <li>
                                Email:
                                <a href="mailto:olyviaikaaibina@gmail.com">
                                    olyviaikaaibina@gmail.com
                                </a>
                            </li>
                            <li>
                                No. HP:
                                <a href="tel:081348475667">
                                    081348475667
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const items = document.querySelectorAll('.option-item');

        items.forEach(function (item) {
            const header = item.querySelector('.option-header');
            const content = item.querySelector('.option-content');

            header.addEventListener('click', function () {
                const isOpen = content.classList.contains('show');

                document.querySelectorAll('.option-content.show').forEach(function (el) {
                    el.classList.remove('show');
                    el.parentElement.classList.remove('active');
                });

                if (!isOpen) {
                    content.classList.add('show');
                    item.classList.add('active');
                }
            });
        });
    });
</script>

@endsection