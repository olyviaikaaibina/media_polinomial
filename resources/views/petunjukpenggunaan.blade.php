@extends('layout.navbar')

@section('title', 'petunjuk penggunaani')

@section('content')

<style>
    .section-wrapper {
        background-color: #FDFDE8 !important; /* SAMAKAN BG DENGAN HALAMAN LAIN */
        min-height: calc(100vh - 160px);
        padding: 40px 60px 60px;
        box-sizing: border-box;
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
        max-height: 200px;
        padding: 14px 32px 18px;
        opacity: 1;
    }

    .option-content p {
        margin: 0;
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        .section-wrapper {
            padding: 24px 16px 40px;
        }

        .option-header {
            padding: 18px 52px 18px 20px;
        }

        .option-content,
        .option-content.show {
            padding-left: 20px;
            padding-right: 20px;
        }
    }
</style>

<div class="section-wrapper">

    <div class="option-list">

        {{-- Kotak 1 --}}
        <div class="option-item">
            <button class="option-header" type="button">
                Pengenalan Polimathica
            </button>
            <div class="option-content">
                <p>
                    Penjelasan dasar mengenai platform Polimathica, tujuan pembelajaran,
                    serta gambaran fitur-fitur utama yang bisa kamu gunakan sebagai pengguna baru.
                </p>
            </div>
        </div>

        {{-- Kotak 2 --}}
        <div class="option-item">
            <button class="option-header" type="button">
                Cara Menggunakan Materi
            </button>
            <div class="option-content">
                <p>
                    Panduan langkah demi langkah mulai dari memilih materi, membuka modul,
                    mengerjakan latihan soal, hingga melihat hasil dan pembahasan yang tersedia.
                </p>
            </div>
        </div>

        {{-- Kotak 3 --}}
        <div class="option-item">
            <button class="option-header" type="button">
                Tips Belajar Efektif
            </button>
            <div class="option-content">
                <p>
                    Kumpulan tips agar belajar matematika terasa lebih ringan: bagaimana mengatur waktu,
                    membuat rangkuman, dan membangun kebiasaan latihan yang konsisten.
                </p>
            </div>
        </div>

        {{-- Kotak 4 --}}
        <div class="option-item">
            <button class="option-header" type="button">
                FAQ & Bantuan
            </button>
            <div class="option-content">
                <p>
                    Jawaban dari pertanyaan yang sering diajukan serta informasi kontak
                    jika kamu membutuhkan bantuan lebih lanjut saat menggunakan Polimathica.
                </p>
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
