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

        .page-title {
            text-align: center;
            font-family: "Times New Roman", serif;
            font-size: 38px;
            font-weight: 700;
            color: #8b6f47;
            margin: 0 0 42px;
            letter-spacing: 0.5px;
        }

        .option-list {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .option-item {
            border-radius: 16px;
            overflow: hidden;
        }

        .option-header {
            width: 100%;
            border: none;
            background: #ead8c2;
            padding: 22px 54px 22px 32px;
            text-align: left;
            font-size: 16px;
            cursor: pointer;
            font-weight: 500;
            border-radius: 16px;
            position: relative;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
            transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
        }

        .option-header:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.06);
            background: #e8d2b8;
        }

        .option-header::after {
            content: "";
            position: absolute;
            right: 24px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 7px solid transparent;
            border-right: 7px solid transparent;
            border-top: 9px solid #9a8f7b;
            transition: transform 0.2s ease;
        }

        .option-item.active .option-header::after {
            transform: translateY(-50%) rotate(180deg);
        }

        .option-content {
            max-height: 0;
            overflow: hidden;
            background-color: #f9f1e7;
            padding: 0 32px;
            font-size: 14px;
            color: #6f685d;
            border-radius: 0 0 16px 16px;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.03);
            opacity: 0;
            transition: max-height 0.25s ease, padding 0.25s ease, opacity 0.25s ease;
        }

        .option-content.show {
            max-height: 2500px;
            padding: 16px 32px 20px;
            opacity: 1;
        }

        .option-content p {
            margin: 0 0 12px;
            line-height: 1.7;
            text-align: justify;
        }

        .option-content p:last-child {
            margin-bottom: 0;
        }

        .guide-image-box {
            width: 100%;
            margin: 6px 0 18px;
            padding: 12px;
            background: #fffaf2;
            border: 1px solid #ead8c2;
            border-radius: 14px;
            box-sizing: border-box;
        }

        .guide-image {
            width: 100%;
            display: block;
            border-radius: 12px;
            border: 1px solid #e4d6c5;
        }

        .image-caption {
            margin-top: 8px;
            text-align: center;
            font-size: 13px;
            color: #8b6f47;
            font-weight: 600;
        }

        .contact-list {
            margin: 8px 0 0 22px;
            padding: 0;
            line-height: 1.8;
            color: #6f685d;
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
                margin-bottom: 30px;
            }

            .option-header {
                padding: 18px 52px 18px 20px;
            }

            .option-content,
            .option-content.show {
                padding-left: 20px;
                padding-right: 20px;
            }

            .option-content.show {
                max-height: 3200px;
            }

            .guide-image-box {
                padding: 8px;
            }

            .image-caption {
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                font-size: 24px;
            }
        }
    </style>

    <div class="section-wrapper">

        <h1 class="page-title">Panduan Penggunaan Media Pembelajaran</h1>

        <div class="option-list">

            {{-- Kotak 1 --}}
            <div class="option-item">
                <button class="option-header" type="button">
                    Pengenalan Polimathica
                </button>

                <div class="option-content">
                    <p>
                        Polimathica merupakan media pembelajaran matematika interaktif berbasis web
                        yang ditujukan untuk peserta didik kelas XI SMA. Media ini dirancang untuk
                        membantu peserta didik memahami materi matematika melalui tampilan yang
                        menarik, penjelasan yang runtut, serta aktivitas pembelajaran yang dapat
                        dilakukan secara mandiri.
                    </p>

                    <p>
                        Media pembelajaran ini dikembangkan dengan menggunakan model tutorial, yaitu
                        model pembelajaran yang menyajikan materi secara bertahap mulai dari pengenalan
                        konsep, penjelasan materi, contoh soal, latihan, kuis, hingga evaluasi.
                    </p>

                    <p>
                        Dengan adanya media ini, proses pembelajaran diharapkan menjadi lebih terarah
                        karena peserta didik dapat mengikuti langkah-langkah pembelajaran sesuai urutan
                        yang telah disediakan, sehingga pemahaman terhadap materi matematika dapat
                        terbentuk secara bertahap.
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

                    <p>
                        Halaman beranda merupakan tampilan awal yang muncul ketika pengguna membuka
                        media pembelajaran Polimathica. Pada halaman ini, pengguna dapat melihat
                        identitas media, menu navigasi, tombol masuk dan daftar, serta informasi
                        pengantar mengenai media pembelajaran.
                    </p>

                    <p>
                        Di bagian kanan atas terdapat tombol Daftar dan Masuk. Tombol Daftar digunakan
                        untuk pengguna baru membuat akun, sedangkan tombol Masuk digunakan oleh
                        pengguna yang sudah memiliki akun agar dapat mengakses fitur pembelajaran.
                    </p>

                    <p>
                        Tombol Mulai Belajar digunakan untuk mengarahkan pengguna menuju halaman
                        materi agar dapat memulai proses pembelajaran. Jika pengguna belum masuk ke
                        akun, maka pengguna akan diarahkan terlebih dahulu ke halaman login.
                    </p>
                </div>
            </div>

            {{-- Kotak 3 --}}
            <div class="option-item">
                <button class="option-header" type="button">
                    Cara Mendaftar Akun
                </button>

                <div class="option-content">
                    <p>
                        Untuk mendaftar akun, pengguna perlu mengisi data diri secara lengkap, yaitu
                        nama lengkap, alamat email, NIS, jenis kelamin, kelas, dan password. Setelah
                        semua data terisi dengan benar, pengguna dapat menekan tombol daftar untuk
                        membuat akun baru.
                    </p>

                    <p>
                        Setelah akun berhasil dibuat, pengguna dapat langsung masuk ke halaman login.
                        Pengguna perlu mengisi alamat email dan password yang sudah dibuat sebelumnya,
                        kemudian menekan tombol masuk agar dapat mengakses materi pembelajaran.
                    </p>
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
                            Gambar 2. Tampilan Halaman Materi Polimathica
                        </div>
                    </div>

                    <p>
                        Halaman materi merupakan halaman utama yang digunakan pengguna untuk mengikuti
                        proses pembelajaran. Pada halaman ini terdapat bagian sidebar di sebelah kiri
                        yang berisi daftar materi, submateri, dan kuis yang dapat dipilih sesuai urutan
                        pembelajaran.
                    </p>

                    <p>
                        Bagian utama halaman menampilkan isi materi pembelajaran, seperti tujuan
                        pembelajaran, eksplorasi, penjelasan konsep, contoh soal, latihan, dan kuis.
                        Pengguna dapat membaca materi secara bertahap agar pemahaman terhadap materi
                        matematika lebih terarah.
                    </p>

                    <p>
                        Pada bagian bawah halaman terdapat tombol Previous dan Next yang digunakan
                        untuk berpindah ke materi sebelumnya atau materi berikutnya. Tombol tersebut
                        membantu pengguna mengikuti alur pembelajaran secara runtut.
                    </p>
                </div>
            </div>

            {{-- Kotak 5 --}}
            <div class="option-item">
                <button class="option-header" type="button">
                    Hubungi Kami
                </button>

                <div class="option-content">
                    <p>
                        Jika mengalami kendala atau memiliki pertanyaan lebih lanjut, silakan hubungi
                        kami melalui:
                    </p>

                    <ul class="contact-list">
                        <li>
                            Email:
                            <a href="mailto:olyviaikaaibina@gmail.com">
                                olyviaikaaibina@gmail.com
                            </a>
                        </li>
                    </ul>
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