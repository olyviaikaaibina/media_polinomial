@extends('layout.halamanmateri')

@section('content')
    <style>
        .materi-wrapper {
            max-width: 920px;
            margin: 0 auto;
            padding: 12px 0 28px;
            font-family: "Georgia", "Times New Roman", serif;
            color: #4a4038;
        }

        .judul-bagian {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 16px;
            color: #2f7d32;
        }

        .judul-bagian .nomor {
            color: #444;
            margin-right: 6px;
        }

        .paragraf {
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 16px;
        }

        .eksplorasi-box {
            background: #f3ece5;
            border-left: 4px solid #e8892e;
            border-radius: 12px;
            padding: 16px 18px 20px;
            margin-bottom: 22px;
        }

        .eksplorasi-title {
            font-size: 17px;
            font-weight: 700;
            color: #2f7d32;
            margin-bottom: 12px;
        }

        .eksplorasi-text {
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 12px;
        }

        .rumus {
            text-align: center;
            font-size: 26px;
            font-style: italic;
            margin: 12px 0;
        }

        .question-box,
        .hasil-box {
            background: #fff;
            border-radius: 8px;
            padding: 12px 14px;
            margin: 14px 0;
            border: 1px solid #eee6df;
        }

        .question-label {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .question-value {
            text-align: center;
            font-size: 26px;
            font-style: italic;
        }

        .input-line {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 10px 0;
            flex-wrap: wrap;
            font-size: 15px;
        }

        .math-input {
            width: 60px;
            height: 34px;
            border: 2px solid #e4933c;
            border-radius: 6px;
            background: #fff;
            font-size: 15px;
            text-align: center;
            outline: none;
        }

        .math-input.long {
            width: 75px;
        }

        .hasil-box {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 15px;
            font-weight: 700;
        }

        .btn-cek {
            margin-top: 8px;
            padding: 8px 16px;
            background: #2f7d32;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-cek:hover {
            background: #27692a;
        }

        .keterangan-bawah {
            margin-top: 12px;
            font-size: 14px;
            line-height: 1.8;
        }

        .feedback-jawaban {
            margin-top: 12px;
            font-size: 14px;
            font-weight: 700;
        }

        .feedback-benar {
            color: #2f7d32;
        }

        .feedback-salah {
            color: #c62828;
        }

        .penjelasan-box {
            display: none;
            margin-top: 14px;
            background: #fff;
            border-radius: 8px;
            padding: 14px;
            border-left: 4px solid #2f7d32;
            border: 1px solid #eee6df;
        }

        .penjelasan-title {
            font-size: 15px;
            font-weight: 700;
            color: #2f7d32;
            margin-bottom: 10px;
        }

        .penjelasan-steps {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .step-item {
            background: #f8f8f8;
            border-radius: 6px;
            padding: 8px 10px;
            font-size: 14px;
            line-height: 1.7;
            border: 1px solid #ece7e2;
        }

        .step-label {
            font-weight: 700;
            color: #2f7d32;
            margin-right: 4px;
        }

        .input-benar {
            border-color: #2f7d32 !important;
        }

        .input-salah {
            border-color: #c62828 !important;
        }

        .info-box {
            position: relative;
            border-radius: 16px;
            padding: 20px 22px;
            margin-bottom: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        }

        .info-box.green {
            background: #edf5ec;
            border: 1.5px solid #d5ead1;
            border-left: 4px solid #64be63;
        }

        .info-box.blue {
            background: #eef3fb;
            border: 1.5px solid #dbe7f8;
            border-left: 4px solid #6aa2f0;
        }

        .info-box.orange {
            background: #f2cfc2;
            border: 1.5px solid #e2a285;
        }

        .section-heading {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .green .section-heading {
            color: #2f7d32;
        }

        .blue .section-heading {
            color: #2f6db1;
        }

        .heading-icon {
            width: 12px;
            height: 12px;
            border-radius: 2px;
            display: inline-block;
        }

        .green .heading-icon {
            background: #7cd67a;
        }

        .blue .heading-icon {
            background: #7dc3ff;
        }

        .orange-label {
            position: absolute;
            top: -14px;
            left: 18px;
            background: #95cf7f;
            color: #355b27;
            font-size: 14px;
            font-weight: 700;
            padding: 7px 18px;
            border-radius: 14px;
            border: 1px solid #79b867;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
            letter-spacing: 0.3px;
        }

        .info-text {
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 10px;
        }

        .horner-flow {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
            margin-top: 12px;
        }

        .flow-step {
            min-width: 120px;
            text-align: center;
            background: linear-gradient(to bottom, #c8e8b5, #a8d68f);
            border: 1px solid #89bf70;
            color: #4f6536;
            font-size: 14px;
            font-weight: 700;
            padding: 12px 18px;
            border-radius: 14px;
            box-shadow: 0 2px 6px rgba(83, 140, 68, 0.15);
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .flow-step:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(83, 140, 68, 0.22);
        }

        .flow-step.active {
            background: linear-gradient(to bottom, #8fce75, #69b854);
            color: #fff;
            border-color: #5ca84b;
            transform: translateY(-2px) scale(1.03);
        }

        .flow-arrow {
            font-size: 26px;
            color: #5a9b61;
            line-height: 1;
            font-weight: 700;
        }

        .horner-list-box {
            margin-top: 18px;
            background: #ffffff;
            border: 1px solid #dfe8de;
            border-radius: 16px;
            padding: 18px 22px;
        }

        .horner-list-title {
            font-size: 17px;
            font-weight: 700;
            color: #2f7d32;
            margin-bottom: 12px;
        }

        .horner-steps-list {
            margin: 0;
            padding-left: 28px;
        }

        .horner-steps-list li {
            font-size: 15px;
            line-height: 1.9;
            margin-bottom: 8px;
            padding: 6px 10px;
            border-radius: 10px;
            transition: all 0.25s ease;
        }

        .horner-steps-list li.active-step {
            background: #dff2d9;
            color: #2f7d32;
            font-weight: 700;
            box-shadow: inset 0 0 0 1px #b7deb0;
        }

        .teorema-list {
            margin: 8px 0 0 18px;
            padding: 0;
        }

        .teorema-list li {
            margin-bottom: 12px;
            line-height: 1.8;
            font-size: 15px;
        }

        .teorema-list strong {
            color: #3c5f98;
        }

        .definisi-rumus {
            text-align: center;
            font-size: 40px;
            font-style: italic;
            margin: 18px 0 18px;
            color: #5a4339;
        }

        .definisi-list {
            margin: 0 0 10px 18px;
            padding: 0;
        }

        .definisi-list li {
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 6px;
        }

        .contoh-horner-card {
            position: relative;
            margin-top: 18px;
            margin-bottom: 20px;
            padding: 22px 22px 18px;
            background: linear-gradient(180deg, #f4faf1 0%, #eef7ea 100%);
            border: 1.5px solid #b9ddb0;
            border-left: 5px solid #63b95d;
            border-radius: 22px;
            box-shadow: 0 8px 24px rgba(73, 109, 64, 0.08);
        }

        .contoh-badge {
            position: absolute;
            top: -16px;
            left: 22px;
            background: linear-gradient(180deg, #9ad17f 0%, #83c36a 100%);
            color: #355b27;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.4px;
            padding: 10px 20px;
            border-radius: 16px;
            border: 1px solid #75b85d;
            box-shadow: 0 4px 10px rgba(86, 140, 67, 0.18);
        }

        .contoh-header {
            margin-bottom: 14px;
            padding-top: 6px;
        }

        .contoh-subtitle {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 18px;
            font-weight: 700;
            color: #2f7d32;
            margin-bottom: 10px;
        }

        .contoh-subtitle::before {
            content: "";
            width: 14px;
            height: 14px;
            border-radius: 4px;
            background: #7fcf6c;
            flex-shrink: 0;
        }

        .contoh-rumus {
            font-size: 17px;
            line-height: 1.8;
            color: #4f4a43;
            margin-bottom: 4px;
        }

        .langkah-card {
            background: #ffffff;
            border: 1px solid #e2eadf;
            border-radius: 16px;
            padding: 18px 18px 16px;
            margin-top: 14px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.03);
            transition: all 0.2s ease;
        }

        .langkah-card:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.05);
        }

        .langkah-judul {
            font-size: 16px;
            font-weight: 700;
            color: #4a4038;
            margin-bottom: 14px;
        }

        .langkah-deskripsi {
            font-size: 14px;
            line-height: 1.8;
            color: #6a625b;
            margin-bottom: 12px;
        }

        .input-row {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 10px;
            font-size: 15px;
            line-height: 1.8;
        }

        .input-group-inline {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .kecil-input {
            width: 72px;
            height: 42px;
            border: 2px solid #e49a45;
            border-radius: 10px;
            background: #fff;
            font-size: 16px;
            text-align: center;
            outline: none;
            transition: 0.2s ease;
        }

        .kecil-input:focus {
            border-color: #63b95d;
            box-shadow: 0 0 0 3px rgba(99, 185, 93, 0.12);
        }

        .btn-langkah {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 148px;
            height: 44px;
            padding: 0 18px;
            background: linear-gradient(180deg, #2f8a37 0%, #2b7a31 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(47, 125, 50, 0.18);
            transition: 0.2s ease;
        }

        .btn-langkah:hover {
            transform: translateY(-1px);
            background: linear-gradient(180deg, #34963d 0%, #2f7d32 100%);
        }

        .feedback-step {
            margin-top: 8px;
            font-size: 14px;
            font-weight: 700;
        }

        .feedback-step.feedback-benar {
            color: #2f7d32;
        }

        .feedback-step.feedback-salah {
            color: #c62828;
        }

        .penjelasan-step {
            display: none;
            margin-top: 12px;
            background: #f7fcf5;
            border: 1px solid #d8ead2;
            border-left: 4px solid #63b95d;
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 14px;
            line-height: 1.8;
            color: #4f4a43;
        }

        .penjelasan-step strong {
            color: #2f7d32;
        }

        .step-locked {
            opacity: 0.58;
            pointer-events: none;
            filter: grayscale(0.08);
        }

        .step-locked .langkah-judul {
            color: #8b847d;
        }

        .step-active {
            border-color: #cfe7c7;
            box-shadow: 0 0 0 3px rgba(99, 185, 93, 0.08);
        }

        .horner-table-wrap {
            margin: 14px 0 16px;
            overflow-x: auto;
        }

        .horner-table {
            position: relative;
            width: max-content;
            margin: 0 auto;
            padding-left: 42px;
        }

        .horner-k {
            position: absolute;
            top: 14px;
            left: 0;
            width: 24px;
            text-align: center;
            font-size: 18px;
            color: #5a5148;
        }

        .horner-top-row,
        .horner-mid-row,
        .horner-bottom-row {
            display: grid;
            grid-template-columns: repeat(4, 58px);
            column-gap: 14px;
            align-items: center;
            justify-content: start;
            margin-left: 28px;
        }

        .horner-top-row {
            position: relative;
            padding: 8px 0 12px;
            border-bottom: 3px solid #6d6a66;
        }

        .horner-top-row::before {
            content: "";
            position: absolute;
            left: -16px;
            top: -6px;
            width: 3px;
            height: 52px;
            background: #6d6a66;
        }

        .horner-top-row span,
        .horner-bottom-row span {
            width: 58px;
            text-align: center;
            font-size: 18px;
            color: #5a5148;
        }

        .horner-mid-row {
            position: relative;
            margin-top: 10px;
        }

        .horner-bottom-row {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 3px solid #6d6a66;
        }

        .horner-cell-input,
        .horner-empty {
            width: 58px;
            height: 42px;
            box-sizing: border-box;
        }

        .horner-cell-input {
            border: 2px solid #d9d9d9;
            border-radius: 8px;
            text-align: center;
            font-size: 16px;
            background: #fff;
            outline: none;
        }

        .horner-plus {
            position: absolute;
            right: -18px;
            bottom: 2px;
            font-size: 28px;
            color: #7a746d;
        }

        .horner-bold {
            font-weight: 700;
        }

        .latihan-card {
            position: relative;
            margin-top: 26px;
            margin-bottom: 20px;
            padding: 26px 22px 20px;
            background: #f9faf8;
            border: 2px solid #9bd084;
            border-radius: 22px;
            box-shadow: 0 8px 24px rgba(73, 109, 64, 0.06);
        }

        .latihan-badge {
            position: absolute;
            top: -16px;
            left: 22px;
            background: linear-gradient(180deg, #efb08b 0%, #e49a74 100%);
            color: #5f3a24;
            font-size: 13px;
            font-weight: 700;
            padding: 10px 18px;
            border-radius: 16px;
            border: 1px solid #d68a64;
            box-shadow: 0 4px 10px rgba(171, 108, 73, 0.18);
            letter-spacing: 0.4px;
        }

        .latihan-item {
            background: #fff;
            border: 1px solid #e7e4df;
            border-radius: 14px;
            padding: 16px 14px;
            margin-top: 16px;
        }

        .latihan-soal-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #4a4038;
        }

        .latihan-rumus {
            text-align: center;
            font-size: 28px;
            margin: 10px 0 16px;
            color: #5a5148;
        }

        .latihan-box {
            background: #fafafa;
            border: 1px solid #e7e4df;
            border-radius: 12px;
            padding: 14px 12px;
            margin-bottom: 12px;
        }

        .latihan-box-title {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #506348;
        }

        .pilihan-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .pilihan-btn {
            padding: 10px 16px;
            border: 2px solid #e0a163;
            border-radius: 10px;
            background: #fff;
            color: #5a5148;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .pilihan-btn:hover {
            background: #fff6ef;
        }

        .pilihan-btn.selected {
            background: #fff1e4;
            border-color: #d97f28;
        }

        .latihan-feedback {
            margin-top: 12px;
            font-size: 14px;
            font-weight: 700;
        }

        .latihan-feedback.success {
            color: #2f7d32;
        }

        .latihan-feedback.error {
            color: #c62828;
        }

        .latihan-penjelasan {
            display: none;
            margin-top: 14px;
            background: #f7fcf5;
            border: 1px solid #d8ead2;
            border-left: 4px solid #63b95d;
            border-radius: 12px;
            padding: 14px;
            font-size: 14px;
            line-height: 1.8;
        }

        .latihan-hidden {
            display: none;
        }

        .latihan-final-note {
            display: none;
            margin-top: 18px;
            padding: 14px 16px;
            border-radius: 12px;
            background: #eef8ec;
            border: 1px solid #cfe7c7;
            color: #2f7d32;
            font-size: 14px;
            line-height: 1.8;
            font-weight: 700;
        }

        .pilihan-btn.correct {
            background: #e8f7e7;
            border-color: #4caf50;
            color: #2f7d32;
        }

        .pilihan-btn.wrong {
            background: #fdeaea;
            border-color: #d9534f;
            color: #b62f2a;
        }

        /* =========================
                   TABEL HORNER LATIHAN NO 2
                ========================= */
        .latihan-horner-wrap {
            margin: 18px 0 10px;
            overflow-x: auto;
        }

        .latihan-horner {
            position: relative;
            width: max-content;
            margin: 0 auto;
            padding-left: 72px;
        }

        .latihan-horner-k {
            position: absolute;
            top: 18px;
            left: 8px;
            width: 34px;
            text-align: center;
            font-size: 26px;
            font-weight: 700;
            color: #5a5148;
        }

        .latihan-horner-top,
        .latihan-horner-mid,
        .latihan-horner-bottom {
            display: grid;
            grid-template-columns: repeat(4, 74px);
            column-gap: 18px;
            align-items: center;
            justify-content: start;
            margin-left: 82px;
        }

        .latihan-horner-top {
            position: relative;
            padding: 18px 0 18px;
            border-bottom: 4px solid #6d6a66;
        }

        .latihan-horner-top::before {
            content: "";
            position: absolute;
            left: -22px;
            top: -6px;
            width: 4px;
            height: 78px;
            background: #6d6a66;
        }

        .latihan-horner-top span,
        .latihan-horner-bottom span {
            width: 74px;
            text-align: center;
            font-size: 26px;
            color: #5a5148;
        }

        .latihan-horner-mid {
            position: relative;
            margin-top: 14px;
        }

        .latihan-horner-bottom {
            margin-top: 14px;
            padding-top: 14px;
            border-top: 4px solid #6d6a66;
        }

        .latihan-horner-input,
        .latihan-horner-empty {
            width: 74px;
            height: 56px;
            box-sizing: border-box;
        }

        .latihan-horner-input {
            border: 3px solid #d8d8d8;
            border-radius: 14px;
            background: #fff;
            text-align: center;
            font-size: 22px;
            outline: none;
            transition: 0.2s ease;
        }

        .latihan-horner-plus {
            position: absolute;
            right: -30px;
            bottom: 6px;
            font-size: 40px;
            color: #7a746d;
        }

        .latihan-horner-bold {
            font-weight: 700;
        }

        @media (max-width: 768px) {
            .materi-wrapper {
                padding: 8px 4px 24px;
            }

            .definisi-rumus {
                font-size: 30px;
            }

            .flow-arrow {
                display: none;
            }

            .horner-flow {
                gap: 10px;
            }

            .flow-step {
                min-width: 95px;
                padding: 10px 14px;
            }

            .horner-list-box {
                padding: 16px;
            }

            .horner-table {
                width: 440px;
                transform: scale(0.94);
                transform-origin: left top;
            }

            .contoh-horner-card {
                padding: 20px 14px 16px;
                border-radius: 18px;
            }

            .contoh-badge {
                left: 14px;
                top: -14px;
                padding: 8px 16px;
                font-size: 12px;
            }

            .contoh-subtitle {
                font-size: 16px;
            }

            .langkah-card {
                padding: 14px;
            }

            .kecil-input {
                width: 64px;
                height: 38px;
            }

            .btn-langkah {
                min-width: 130px;
                height: 40px;
                font-size: 14px;
            }

            .latihan-card {
                padding: 22px 14px 16px;
            }

            .latihan-rumus {
                font-size: 22px;
            }

            .pilihan-btn {
                font-size: 14px;
                padding: 9px 12px;
            }

            .latihan-horner {
                width: 760px;
                transform: scale(0.78);
                transform-origin: left top;
                margin-bottom: -120px;
            }
        }
    </style>

    <div class="materi-wrapper">
        <div class="judul-bagian">
            <span class="nomor">2.</span>Metode Horner
        </div>

        <div class="paragraf">
            Pada pembagian polinomial, metode bersusun merupakan cara yang umum digunakan.
            Namun untuk pembagian polinomial oleh bentuk <em>(x − k)</em> terdapat cara lain
            yang lebih cepat dan efisien, yaitu Metode Horner.
        </div>

        <div class="eksplorasi-box">
            <div class="eksplorasi-title">🧭 Eksplorasi</div>

            <div class="eksplorasi-text">
                Di daerah Banjarmasin, pedagang di pasar terapung menghitung keuntungan harian mereka.
                Misalkan keuntungan dinyatakan dengan:
            </div>

            <div class="rumus">
                P(x) = 2x³ − 3x² + x + 5
            </div>

            <div class="eksplorasi-text">
                dengan <em>x</em> menyatakan jumlah hari berdagang. Pedagang ingin mengetahui keuntungan saat hari ke-2.
            </div>

            <div class="question-box">
                <div class="question-label">Pertanyaan:</div>
                <div class="question-value">P(2) = ?</div>
            </div>

            <div class="input-line">
                2 × (2³) =
                <input type="text" id="a1" class="math-input">
            </div>

            <div class="input-line">
                3 × (2²) =
                <input type="text" id="a2" class="math-input">
            </div>

            <div class="input-line">
                <input type="text" id="a3" class="math-input">
                -
                <input type="text" id="a4" class="math-input">
                + 2 + 5 =
                <input type="text" id="a5" class="math-input long">
            </div>

            <div class="hasil-box">
                Hasil akhir: P(2) =
                <input type="text" id="hasilAkhir" class="math-input">
            </div>

            <button class="btn-cek" onclick="cekJawaban()">Cek Jawaban</button>

            <div id="feedbackJawaban" class="feedback-jawaban"></div>

            <div id="penjelasanBox" class="penjelasan-box">
                <div class="penjelasan-title">Penjelasan Singkat</div>

                <div class="penjelasan-steps">
                    <div class="step-item">
                        <span class="step-label">Langkah 1:</span>
                        Hitung nilai 2 × (2³) = <strong>16</strong>
                    </div>

                    <div class="step-item">
                        <span class="step-label">Langkah 2:</span>
                        Hitung nilai 3 × (2²) = <strong>12</strong>
                    </div>

                    <div class="step-item">
                        <span class="step-label">Langkah 3:</span>
                        Substitusikan ke bentuk:
                        <strong>16 − 12 + 2 + 5</strong>
                    </div>

                    <div class="step-item">
                        <span class="step-label">Langkah 4:</span>
                        Hasil akhirnya adalah <strong>11</strong>, jadi
                        <strong>P(2) = 11</strong>
                    </div>
                </div>
            </div>

            <div class="keterangan-bawah">
                Dari perhitungan di atas, terlihat bahwa prosesnya cukup panjang.
                Untuk mempermudah perhitungan tersebut, digunakan Metode Horner.
            </div>
        </div>

        <div class="info-box green">
            <div class="section-heading">
                <span class="heading-icon"></span>
                Langkah Dasar Metode Horner
            </div>

            <div class="info-text">
                Klik tombol langkah berikut, lalu lihat penjelasan dan bagian langkah yang disorot di bawah.
            </div>

            <div class="horner-flow">
                <button type="button" class="flow-step active" onclick="showHornerStep(0)">Turunkan</button>
                <div class="flow-arrow">→</div>
                <button type="button" class="flow-step" onclick="showHornerStep(1)">Kalikan</button>
                <div class="flow-arrow">→</div>
                <button type="button" class="flow-step" onclick="showHornerStep(2)">Jumlahkan</button>
            </div>

            <div class="horner-list-box">
                <div class="horner-list-title">Langkah-Langkah Metode Horner</div>

                <ol class="horner-steps-list" id="hornerStepsList">
                    <li data-step="0">Tulis koefisien polinomial dari pangkat tertinggi ke pangkat terendah.</li>
                    <li data-step="0">Tentukan nilai <em>k</em> dari pembagi <em>(x − k)</em>.</li>
                    <li data-step="0">Turunkan koefisien pertama.</li>
                    <li data-step="1">Kalikan dengan <em>k</em>, lalu jumlahkan dengan koefisien berikutnya.</li>
                    <li data-step="2">Ulangi sampai selesai.</li>
                    <li data-step="2">Angka terakhir adalah sisa, angka sebelumnya adalah koefisien hasil bagi.</li>
                </ol>
            </div>
        </div>

        <div class="info-box blue">
            <div class="section-heading">
                <span class="heading-icon"></span>
                Keterkaitan dengan Teorema
            </div>

            <div class="info-text">
                Metode Horner sangat berkaitan dengan dua teorema penting dalam polinomial, yaitu:
            </div>

            <ul class="teorema-list">
                <li>
                    <strong>Teorema Sisa</strong><br>
                    Sisa pembagian <em>P(x)</em> oleh <em>(x − k)</em> adalah <em>P(k)</em>.
                </li>
                <li>
                    <strong>Teorema Faktor</strong><br>
                    Jika <em>P(k) = 0</em>, maka <em>(x − k)</em> merupakan faktor dari <em>P(x)</em>.
                </li>
            </ul>
        </div>

        <div class="info-box orange">
            <div class="orange-label">DEFINISI</div>

            <div class="info-text" style="margin-top: 6px;">
                Metode Horner adalah algoritma yang digunakan untuk membagi polinomial oleh bentuk linear:
            </div>

            <div class="definisi-rumus">(x − k)</div>

            <ul class="definisi-list">
                <li><strong><em>x</em></strong> = variabel dalam polinomial</li>
                <li><strong><em>k</em></strong> = bilangan dari pembagi <em>(x − k)</em></li>
            </ul>

            <div class="info-text" style="margin-bottom: 0;">
                Artinya, polinomial dibagi oleh faktor derajat satu.
            </div>
        </div>
    </div>

    <div class="contoh-horner-card">
        <div class="contoh-badge">CONTOH</div>

        <div class="contoh-header">
            <div class="contoh-subtitle">Gunakan Metode Horner</div>
            <div class="contoh-rumus">(3x³ + 5x² − 2x + 1) ÷ (x − 1)</div>
        </div>

        <div class="langkah-card step-active" id="card-step-1">
            <div class="langkah-judul">1. Tentukan nilai k</div>
            <div class="langkah-deskripsi">
                Pembagi berbentuk <em>(x − k)</em>. Tentukan nilai <em>k</em> dari pembagi tersebut.
            </div>

            <div class="input-group-inline">
                <span>k =</span>
                <input type="text" id="k" class="kecil-input">
                <button class="btn-langkah" onclick="cekStep1()">Cek Langkah 1</button>
            </div>

            <div id="fb1" class="feedback-step"></div>
            <div id="penjelasan1" class="penjelasan-step">
                Karena pembaginya adalah <strong>(x − 1)</strong>, maka nilai <strong>k = 1</strong>.
            </div>
        </div>

        <div class="langkah-card step-locked" id="card-step-2">
            <div class="langkah-judul">2. Tulis koefisien polinomial</div>
            <div class="langkah-deskripsi">
                Ambil koefisien dari <strong>3x³ + 5x² − 2x + 1</strong> secara berurutan dari pangkat tertinggi ke
                terendah.
            </div>

            <div class="input-group-inline">
                <input id="c1" class="kecil-input">
                <input id="c2" class="kecil-input">
                <input id="c3" class="kecil-input">
                <input id="c4" class="kecil-input">
            </div>

            <button class="btn-langkah" onclick="cekStep2()">Cek Langkah 2</button>
            <div id="fb2" class="feedback-step"></div>
            <div id="penjelasan2" class="penjelasan-step">
                Koefisiennya adalah <strong>3, 5, -2, 1</strong>.
            </div>
        </div>

        <div class="langkah-card step-locked" id="card-step-3">
            <div class="langkah-judul">3. Turunkan koefisien pertama</div>
            <div class="langkah-deskripsi">
                Pada metode Horner, koefisien pertama langsung diturunkan ke baris bawah.
            </div>

            <div class="input-group-inline">
                <span>Angka yang diturunkan =</span>
                <input id="t1" class="kecil-input">
                <button class="btn-langkah" onclick="cekStep3()">Cek Langkah 3</button>
            </div>

            <div id="fb3" class="feedback-step"></div>
            <div id="penjelasan3" class="penjelasan-step">
                Koefisien pertama adalah <strong>3</strong>, jadi langsung diturunkan menjadi <strong>3</strong>.
            </div>
        </div>

        <div class="langkah-card step-locked" id="card-step-4">
            <div class="langkah-judul">4. Kalikan dengan k, lalu jumlahkan</div>
            <div class="langkah-deskripsi">
                Gunakan nilai <strong>k = 1</strong> dan hasil turunan pertama.
            </div>

            <div class="input-row">
                <span>3 × 1 =</span>
                <input id="s41" class="kecil-input">
            </div>

            <div class="input-row">
                <span>5 + hasil di atas =</span>
                <input id="s42" class="kecil-input">
            </div>

            <button class="btn-langkah" onclick="cekStep4()">Cek Langkah 4</button>
            <div id="fb4" class="feedback-step"></div>
            <div id="penjelasan4" class="penjelasan-step">
                Hasil perkalian <strong>3 × 1 = 3</strong>, lalu <strong>5 + 3 = 8</strong>.
            </div>
        </div>

        <div class="langkah-card step-locked" id="card-step-5">
            <div class="langkah-judul">5. Ulangi langkah yang sama</div>
            <div class="langkah-deskripsi">
                Teruskan proses kalikan lalu jumlahkan sampai koefisien terakhir.
            </div>

            <div class="input-row">
                <span>8 × 1 =</span>
                <input id="s51" class="kecil-input">
            </div>

            <div class="input-row">
                <span>-2 + hasil di atas =</span>
                <input id="s52" class="kecil-input">
            </div>

            <div class="input-row">
                <span>6 × 1 =</span>
                <input id="s53" class="kecil-input">
            </div>

            <div class="input-row">
                <span>1 + hasil di atas =</span>
                <input id="s54" class="kecil-input">
            </div>

            <button class="btn-langkah" onclick="cekStep5()">Cek Langkah 5</button>
            <div id="fb5" class="feedback-step"></div>
            <div id="penjelasan5" class="penjelasan-step">
                Didapat <strong>8 × 1 = 8</strong>, lalu <strong>-2 + 8 = 6</strong>, kemudian
                <strong>6 × 1 = 6</strong>, dan terakhir <strong>1 + 6 = 7</strong>.
            </div>
        </div>

        <div class="langkah-card step-locked" id="card-step-6">
            <div class="langkah-judul">6. Lengkapi tabel Horner</div>
            <div class="langkah-deskripsi">
                Isikan angka-angka pada tabel Horner berikut berdasarkan hasil langkah sebelumnya.
            </div>

            <div class="horner-table-wrap">
                <div class="horner-table">
                    <div class="horner-k">1</div>

                    <div class="horner-top-row">
                        <span>3</span>
                        <span>5</span>
                        <span>-2</span>
                        <span>1</span>
                    </div>

                    <div class="horner-mid-row">
                        <span class="horner-empty"></span>
                        <input id="t61" class="horner-cell-input">
                        <input id="t62" class="horner-cell-input">
                        <input id="t63" class="horner-cell-input">
                        <span class="horner-plus">+</span>
                    </div>

                    <div class="horner-bottom-row">
                        <span class="horner-bold">3</span>
                        <input id="t64" class="horner-cell-input">
                        <input id="t65" class="horner-cell-input">
                        <input id="t66" class="horner-cell-input">
                    </div>
                </div>
            </div>

            <button class="btn-langkah" onclick="cekStep6()">Cek Langkah 6</button>
            <div id="fb6" class="feedback-step"></div>
            <div id="penjelasan6" class="penjelasan-step">
                Baris tengah diisi hasil perkalian berturut-turut, yaitu <strong>3, 8, 6</strong>.
                <br>
                Baris bawah diisi hasil penjumlahan, yaitu <strong>8, 6, 7</strong>.
            </div>
        </div>

        <div class="langkah-card step-locked" id="card-step-7">
            <div class="langkah-judul">7. Tentukan hasil bagi dan sisa</div>
            <div class="langkah-deskripsi">
                Angka sebelum yang terakhir adalah koefisien hasil bagi, sedangkan angka terakhir adalah sisa.
            </div>

            <div class="input-row">
                <span>Koefisien hasil bagi:</span>
                <input id="h1" class="kecil-input">
                <input id="h2" class="kecil-input">
                <input id="h3" class="kecil-input">
            </div>

            <div class="input-row">
                <span>Sisa =</span>
                <input id="sisa" class="kecil-input">
            </div>

            <div class="input-row">
                <span>Q(x) =</span>
                <input id="qx1" class="kecil-input">
                <span>x² +</span>
                <input id="qx2" class="kecil-input">
                <span>x +</span>
                <input id="qx3" class="kecil-input">
            </div>

            <button class="btn-langkah" onclick="cekStep7()">Cek Langkah 7</button>
            <div id="fb7" class="feedback-step"></div>
            <div id="penjelasan7" class="penjelasan-step">
                Koefisien hasil bagi adalah <strong>3, 8, 6</strong> sehingga
                <strong>Q(x) = 3x² + 8x + 6</strong>, dan sisanya adalah <strong>7</strong>.
            </div>
        </div>
    </div>

    <div class="latihan-card">
        <div class="latihan-badge">LATIHAN</div>

        <div class="latihan-item" id="latihanSoal1">
            <div class="latihan-soal-title">1. Tentukan hasil bagi dan sisa:</div>
            <div class="latihan-rumus">(4x³ + 3x² − 5x + 2) ÷ (x − 2)</div>

            <div class="latihan-box">
                <div class="latihan-box-title">1. Nilai k</div>
                <div class="pilihan-wrap" data-group="s1k">
                    <button type="button" class="pilihan-btn" onclick="selectOption('s1k', this, '-2')">-2</button>
                    <button type="button" class="pilihan-btn" onclick="selectOption('s1k', this, '1')">1</button>
                    <button type="button" class="pilihan-btn" onclick="selectOption('s1k', this, '2')">2</button>
                </div>
            </div>

            <div class="latihan-box">
                <div class="latihan-box-title">2. Koefisien polinomial</div>
                <div class="pilihan-wrap" data-group="s1koef">
                    <button type="button" class="pilihan-btn" onclick="selectOption('s1koef', this, '4,3,5,2')">4, 3, 5,
                        2</button>
                    <button type="button" class="pilihan-btn" onclick="selectOption('s1koef', this, '4,3,-5,2')">4, 3, -5,
                        2</button>
                    <button type="button" class="pilihan-btn" onclick="selectOption('s1koef', this, '4,-3,-5,2')">4, -3,
                        -5,
                        2</button>
                </div>
            </div>

            <div class="latihan-box">
                <div class="latihan-box-title">3. Koefisien pertama yang diturunkan</div>
                <div class="pilihan-wrap" data-group="s1turun">
                    <button type="button" class="pilihan-btn" onclick="selectOption('s1turun', this, '3')">3</button>
                    <button type="button" class="pilihan-btn" onclick="selectOption('s1turun', this, '4')">4</button>
                    <button type="button" class="pilihan-btn" onclick="selectOption('s1turun', this, '2')">2</button>
                </div>
            </div>

            <div class="latihan-box">
                <div class="latihan-box-title">4. Hasil proses Horner</div>
                <div class="pilihan-wrap" data-group="s1proses">
                    <button type="button" class="pilihan-btn" onclick="selectOption('s1proses', this, '4,10,15')">4 → 10
                        →
                        15</button>
                    <button type="button" class="pilihan-btn" onclick="selectOption('s1proses', this, '4,11,17')">4 → 11
                        →
                        17</button>
                    <button type="button" class="pilihan-btn" onclick="selectOption('s1proses', this, '4,8,16')">4 → 8 →
                        16</button>
                </div>
            </div>

            <div class="latihan-box">
                <div class="latihan-box-title">5. Hasil akhir</div>
                <div class="pilihan-wrap" data-group="s1hasil">
                    <button type="button" class="pilihan-btn"
                        onclick="selectOption('s1hasil', this, '4x2+10x+15,sisa32')">Q(x) = 4x² + 10x + 15, sisa =
                        32</button>
                    <button type="button" class="pilihan-btn"
                        onclick="selectOption('s1hasil', this, '4x2+11x+17,sisa36')">Q(x) = 4x² + 11x + 17, sisa =
                        36</button>
                    <button type="button" class="pilihan-btn"
                        onclick="selectOption('s1hasil', this, '4x2+11x+15,sisa30')">Q(x) = 4x² + 11x + 15, sisa =
                        30</button>
                </div>
            </div>

            <button class="btn-langkah" onclick="cekLatihan1()">Cek Jawaban Soal 1</button>
            <div id="latihanFeedback1" class="latihan-feedback"></div>

            <div id="latihanPenjelasan1" class="latihan-penjelasan">
                <strong>Penjelasan Soal 1:</strong><br>
                Pembagi <strong>(x − 2)</strong> memberi nilai <strong>k = 2</strong>.<br>
                Koefisien polinomial adalah <strong>4, 3, -5, 2</strong>.<br>
                Koefisien pertama yang diturunkan adalah <strong>4</strong>.<br>
                Proses Horner: <strong>4 → 11 → 17 → 36</strong>.<br>
                Jadi hasil baginya <strong>Q(x) = 4x² + 11x + 17</strong> dan sisanya <strong>36</strong>.
            </div>
        </div>

        <div class="latihan-item latihan-hidden" id="latihanSoal2">
            <div class="latihan-soal-title">2. Lengkapi tabel Horner berikut untuk menentukan hasil bagi dan sisa:</div>
            <div class="latihan-rumus">(2x³ − x² + 4x − 8) ÷ (x − 2)</div>

            <div class="latihan-box">
                <div class="latihan-box-title">
                    Isi kotak-kotak pada tabel Horner berikut, lalu klik tombol cek jawaban.
                </div>

                <div class="latihan-horner-wrap">
                    <div class="latihan-horner">
                        <div class="latihan-horner-k">2</div>

                        <div class="latihan-horner-top">
                            <span>2</span>
                            <span>-1</span>
                            <span>4</span>
                            <span>-8</span>
                        </div>

                        <div class="latihan-horner-mid">
                            <span class="latihan-horner-empty"></span>
                            <input id="s2m1" class="latihan-horner-input">
                            <input id="s2m2" class="latihan-horner-input">
                            <input id="s2m3" class="latihan-horner-input">
                            <span class="latihan-horner-plus">+</span>
                        </div>

                        <div class="latihan-horner-bottom">
                            <span class="latihan-horner-bold">2</span>
                            <input id="s2b1" class="latihan-horner-input">
                            <input id="s2b2" class="latihan-horner-input">
                            <input id="s2b3" class="latihan-horner-input">
                        </div>
                    </div>
                </div>
            </div>

            <div class="latihan-box">
                <div class="latihan-box-title">Hasil akhir</div>

                <div class="input-row">
                    <span>Q(x) =</span>
                    <input id="s2q1" class="kecil-input">
                    <span>x² +</span>
                    <input id="s2q2" class="kecil-input">
                    <span>x +</span>
                    <input id="s2q3" class="kecil-input">
                </div>

                <div class="input-row">
                    <span>Sisa =</span>
                    <input id="s2sisa" class="kecil-input">
                </div>
            </div>

            <button class="btn-langkah" onclick="cekLatihan2()">Cek Jawaban Soal 2</button>
            <div id="latihanFeedback2" class="latihan-feedback"></div>

            <div id="latihanPenjelasan2" class="latihan-penjelasan">
                <strong>Penjelasan Soal 2:</strong><br>
                Nilai <strong>k = 2</strong> karena pembaginya <strong>(x − 2)</strong>.<br>
                Koefisien polinomial adalah <strong>2, -1, 4, -8</strong>.<br>
                Baris tengah tabel Horner diisi <strong>4, 6, 20</strong>.<br>
                Baris bawah menjadi <strong>2, 3, 10, 12</strong>.<br>
                Jadi hasil bagi <strong>Q(x) = 2x² + 3x + 10</strong> dan sisanya <strong>12</strong>.
            </div>
        </div>

        <div id="latihanFinalNote" class="latihan-final-note">
            Bagus! Kedua soal sudah benar. Sekarang soal nomor 1 dan nomor 2 tetap tampil beserta penjelasannya sehingga
            bisa dipelajari kembali.
        </div>
    </div>

    <script>
        let jawabanBenar = false;

        const latihanJawaban = {
            s1k: '',
            s1koef: '',
            s1turun: '',
            s1proses: '',
            s1hasil: ''
        };

        function setStatusInput(input, isCorrect) {
            input.classList.remove('input-benar', 'input-salah');

            if (input.value.trim() !== '') {
                input.classList.add(isCorrect ? 'input-benar' : 'input-salah');
            }
        }

        function cekJawaban() {
            const a1 = document.getElementById('a1');
            const a2 = document.getElementById('a2');
            const a3 = document.getElementById('a3');
            const a4 = document.getElementById('a4');
            const a5 = document.getElementById('a5');
            const hasilAkhir = document.getElementById('hasilAkhir');
            const feedback = document.getElementById('feedbackJawaban');
            const penjelasanBox = document.getElementById('penjelasanBox');

            const v1 = a1.value.trim();
            const v2 = a2.value.trim();
            const v3 = a3.value.trim();
            const v4 = a4.value.trim();
            const v5 = a5.value.trim();
            const vh = hasilAkhir.value.trim();

            const c1 = v1 === '16';
            const c2 = v2 === '12';
            const c3 = v3 === '16';
            const c4 = v4 === '12';
            const c5 = v5 === '11';
            const ch = vh === '11';

            setStatusInput(a1, c1);
            setStatusInput(a2, c2);
            setStatusInput(a3, c3);
            setStatusInput(a4, c4);
            setStatusInput(a5, c5);
            setStatusInput(hasilAkhir, ch);

            if (c1 && c2 && c3 && c4 && c5 && ch) {
                jawabanBenar = true;
                feedback.textContent = 'Jawaban benar. Kamu bisa lanjut ke materi berikutnya.';
                feedback.className = 'feedback-jawaban feedback-benar';
                penjelasanBox.style.display = 'block';
            } else {
                jawabanBenar = false;
                feedback.textContent = 'Masih ada jawaban yang salah. Periksa kembali perhitunganmu.';
                feedback.className = 'feedback-jawaban feedback-salah';
                penjelasanBox.style.display = 'none';
            }
        }

        const hornerSteps = [{
            title: 'Langkah 1: Turunkan',
            content: 'Tulis dulu koefisien polinomial dari pangkat tertinggi ke terendah, lalu tentukan nilai k dari pembagi (x − k). Setelah siap, koefisien pertama langsung diturunkan ke baris bawah sebagai nilai awal.'
        },
        {
            title: 'Langkah 2: Kalikan',
            content: 'Nilai yang sudah diturunkan kemudian dikalikan dengan k. Hasil perkalian itu ditulis di bawah koefisien berikutnya sebelum dilakukan penjumlahan.'
        },
        {
            title: 'Langkah 3: Jumlahkan',
            content: 'Jumlahkan hasil perkalian dengan koefisien berikutnya. Ulangi proses kalikan dan jumlahkan sampai selesai. Angka terakhir menjadi sisa, sedangkan angka sebelumnya menjadi koefisien hasil bagi.'
        }
        ];

        let currentHornerStep = 0;

        function showHornerStep(index) {
            currentHornerStep = index;

            const buttons = document.querySelectorAll('.flow-step');
            buttons.forEach((btn, i) => {
                btn.classList.toggle('active', i === index);
            });

            const listItems = document.querySelectorAll('#hornerStepsList li');
            listItems.forEach((item) => {
                const stepIndex = parseInt(item.getAttribute('data-step'));
                item.classList.toggle('active-step', stepIndex === index);
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            showHornerStep(0);

            const nextBtn = document.querySelector('.next-btn');

            if (nextBtn) {
                nextBtn.addEventListener('click', function (e) {
                    if (!jawabanBenar) {
                        e.preventDefault();
                        alert('Selesaikan soal eksplorasi dengan benar terlebih dahulu sebelum lanjut.');
                    }
                });
            }
        });

        function bukaStep(stepNumber) {
            const current = document.getElementById(`card-step-${stepNumber}`);
            if (current) {
                current.classList.remove('step-locked');
                current.classList.add('step-active');
            }
        }

        function kunciStepLama(stepNumber) {
            const current = document.getElementById(`card-step-${stepNumber}`);
            if (current) {
                current.classList.remove('step-active');
            }
        }

        function tampilBenar(feedbackId, penjelasanId, pesan) {
            const feedback = document.getElementById(feedbackId);
            const penjelasan = document.getElementById(penjelasanId);

            feedback.textContent = pesan;
            feedback.className = 'feedback-step feedback-benar';
            penjelasan.style.display = 'block';
        }

        function tampilSalah(feedbackId, penjelasanId, pesan) {
            const feedback = document.getElementById(feedbackId);
            const penjelasan = document.getElementById(penjelasanId);

            feedback.textContent = pesan;
            feedback.className = 'feedback-step feedback-salah';
            penjelasan.style.display = 'none';
        }

        function cekStep1() {
            const v = document.getElementById('k').value.trim();
            if (v === '1') {
                tampilBenar('fb1', 'penjelasan1', 'Benar, nilai k sudah tepat.');
                kunciStepLama(1);
                bukaStep(2);
            } else {
                tampilSalah('fb1', 'penjelasan1', 'Masih salah. Perhatikan bentuk (x − k).');
            }
        }

        function cekStep2() {
            const c1 = document.getElementById('c1').value.trim();
            const c2 = document.getElementById('c2').value.trim();
            const c3 = document.getElementById('c3').value.trim();
            const c4 = document.getElementById('c4').value.trim();

            if (c1 === '3' && c2 === '5' && c3 === '-2' && c4 === '1') {
                tampilBenar('fb2', 'penjelasan2', 'Benar, koefisien ditulis dengan urut.');
                kunciStepLama(2);
                bukaStep(3);
            } else {
                tampilSalah('fb2', 'penjelasan2', 'Masih ada koefisien yang belum tepat.');
            }
        }

        function cekStep3() {
            const v = document.getElementById('t1').value.trim();
            if (v === '3') {
                tampilBenar('fb3', 'penjelasan3', 'Benar, koefisien pertama langsung diturunkan.');
                kunciStepLama(3);
                bukaStep(4);
            } else {
                tampilSalah('fb3', 'penjelasan3', 'Masih salah. Coba lihat koefisien pertama.');
            }
        }

        function cekStep4() {
            const a = document.getElementById('s41').value.trim();
            const b = document.getElementById('s42').value.trim();

            if (a === '3' && b === '8') {
                tampilBenar('fb4', 'penjelasan4', 'Benar, hasil perkalian dan penjumlahan sudah tepat.');
                kunciStepLama(4);
                bukaStep(5);
            } else {
                tampilSalah('fb4', 'penjelasan4', 'Periksa lagi hasil kali dan hasil jumlahnya.');
            }
        }

        function cekStep5() {
            const a = document.getElementById('s51').value.trim();
            const b = document.getElementById('s52').value.trim();
            const c = document.getElementById('s53').value.trim();
            const d = document.getElementById('s54').value.trim();

            if (a === '8' && b === '6' && c === '6' && d === '7') {
                tampilBenar('fb5', 'penjelasan5', 'Benar, proses Horner sudah selesai.');
                kunciStepLama(5);
                bukaStep(6);
            } else {
                tampilSalah('fb5', 'penjelasan5', 'Masih ada hasil yang belum tepat. Coba ulangi prosesnya.');
            }
        }

        function cekStep6() {
            const t61 = document.getElementById('t61').value.trim();
            const t62 = document.getElementById('t62').value.trim();
            const t63 = document.getElementById('t63').value.trim();
            const t64 = document.getElementById('t64').value.trim();
            const t65 = document.getElementById('t65').value.trim();
            const t66 = document.getElementById('t66').value.trim();

            if (t61 === '3' && t62 === '8' && t63 === '6' &&
                t64 === '8' && t65 === '6' && t66 === '7') {
                tampilBenar('fb6', 'penjelasan6', 'Benar, tabel Horner sudah lengkap.');
                kunciStepLama(6);
                bukaStep(7);
            } else {
                tampilSalah('fb6', 'penjelasan6', 'Masih ada isian tabel yang belum tepat.');
            }
        }

        function cekStep7() {
            const h1 = document.getElementById('h1').value.trim();
            const h2 = document.getElementById('h2').value.trim();
            const h3 = document.getElementById('h3').value.trim();
            const sisa = document.getElementById('sisa').value.trim();
            const qx1 = document.getElementById('qx1').value.trim();
            const qx2 = document.getElementById('qx2').value.trim();
            const qx3 = document.getElementById('qx3').value.trim();

            if (
                h1 === '3' && h2 === '8' && h3 === '6' &&
                sisa === '7' &&
                qx1 === '3' && qx2 === '8' && qx3 === '6'
            ) {
                tampilBenar('fb7', 'penjelasan7', 'Hebat, hasil bagi dan sisa sudah benar.');
            } else {
                tampilSalah('fb7', 'penjelasan7', 'Coba cek lagi koefisien hasil bagi, bentuk Q(x), dan sisanya.');
            }
        }

        function selectOption(group, btn, value) {
            latihanJawaban[group] = value;

            const wrapper = document.querySelector(`[data-group="${group}"]`);
            if (!wrapper) return;

            wrapper.querySelectorAll('.pilihan-btn').forEach(item => {
                item.classList.remove('selected', 'wrong', 'correct');
            });

            btn.classList.add('selected');
        }

        function resetPilihanState(group) {
            const wrapper = document.querySelector(`[data-group="${group}"]`);
            if (!wrapper) return;

            wrapper.querySelectorAll('.pilihan-btn').forEach(btn => {
                btn.classList.remove('correct', 'wrong', 'selected');
            });

            latihanJawaban[group] = '';
        }

        function resetWarnaSaja(group) {
            const wrapper = document.querySelector(`[data-group="${group}"]`);
            if (!wrapper) return;

            wrapper.querySelectorAll('.pilihan-btn').forEach(btn => {
                btn.classList.remove('correct', 'wrong');
            });
        }

        function tandaiSemuaBenar(group, jawabanBenarValue) {
            const wrapper = document.querySelector(`[data-group="${group}"]`);
            if (!wrapper) return;

            wrapper.querySelectorAll('.pilihan-btn').forEach(btn => {
                btn.classList.remove('correct', 'wrong');
                const onclickText = btn.getAttribute('onclick') || '';
                const isCorrectButton = onclickText.includes(`'${jawabanBenarValue}'`);

                if (isCorrectButton) {
                    btn.classList.add('correct');
                }
            });
        }

        function tandaiYangDipilihSalah(group, jawabanBenarValue) {
            const wrapper = document.querySelector(`[data-group="${group}"]`);
            if (!wrapper) return;

            wrapper.querySelectorAll('.pilihan-btn').forEach(btn => {
                btn.classList.remove('correct', 'wrong');

                const onclickText = btn.getAttribute('onclick') || '';
                const isCorrectButton = onclickText.includes(`'${jawabanBenarValue}'`);
                const isSelected = btn.classList.contains('selected');

                if (isSelected && !isCorrectButton) {
                    btn.classList.add('wrong');
                }
            });
        }

        function cekLatihan1() {
            resetWarnaSaja('s1k');
            resetWarnaSaja('s1koef');
            resetWarnaSaja('s1turun');
            resetWarnaSaja('s1proses');
            resetWarnaSaja('s1hasil');

            const benar =
                latihanJawaban.s1k === '2' &&
                latihanJawaban.s1koef === '4,3,-5,2' &&
                latihanJawaban.s1turun === '4' &&
                latihanJawaban.s1proses === '4,11,17' &&
                latihanJawaban.s1hasil === '4x2+11x+17,sisa36';

            const feedback = document.getElementById('latihanFeedback1');
            const penjelasan = document.getElementById('latihanPenjelasan1');
            const soal2 = document.getElementById('latihanSoal2');

            if (benar) {
                tandaiSemuaBenar('s1k', '2');
                tandaiSemuaBenar('s1koef', '4,3,-5,2');
                tandaiSemuaBenar('s1turun', '4');
                tandaiSemuaBenar('s1proses', '4,11,17');
                tandaiSemuaBenar('s1hasil', '4x2+11x+17,sisa36');

                feedback.innerHTML = 'Benar. Soal nomor 2 sekarang muncul.';
                feedback.className = 'latihan-feedback success';
                penjelasan.style.display = 'block';
                soal2.classList.remove('latihan-hidden');
                soal2.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            } else {
                tandaiYangDipilihSalah('s1k', '2');
                tandaiYangDipilihSalah('s1koef', '4,3,-5,2');
                tandaiYangDipilihSalah('s1turun', '4');
                tandaiYangDipilihSalah('s1proses', '4,11,17');
                tandaiYangDipilihSalah('s1hasil', '4x2+11x+17,sisa36');

                feedback.innerHTML = `
                            Masih ada pilihan yang salah pada soal nomor 1.
                            <br>
                            <button type="button" class="btn-langkah" style="margin-top:10px;" onclick="ulangiLatihan1()">Ulangi</button>
                        `;
                feedback.className = 'latihan-feedback error';
                penjelasan.style.display = 'none';
            }
        }

        function cekLatihan2() {
            const s2m1 = document.getElementById('s2m1');
            const s2m2 = document.getElementById('s2m2');
            const s2m3 = document.getElementById('s2m3');
            const s2b1 = document.getElementById('s2b1');
            const s2b2 = document.getElementById('s2b2');
            const s2b3 = document.getElementById('s2b3');
            const s2q1 = document.getElementById('s2q1');
            const s2q2 = document.getElementById('s2q2');
            const s2q3 = document.getElementById('s2q3');
            const s2sisa = document.getElementById('s2sisa');

            const feedback = document.getElementById('latihanFeedback2');
            const penjelasan = document.getElementById('latihanPenjelasan2');
            const finalNote = document.getElementById('latihanFinalNote');

            const c1 = s2m1.value.trim() === '4';
            const c2 = s2m2.value.trim() === '6';
            const c3 = s2m3.value.trim() === '20';
            const c4 = s2b1.value.trim() === '3';
            const c5 = s2b2.value.trim() === '10';
            const c6 = s2b3.value.trim() === '12';
            const c7 = s2q1.value.trim() === '2';
            const c8 = s2q2.value.trim() === '3';
            const c9 = s2q3.value.trim() === '10';
            const c10 = s2sisa.value.trim() === '12';

            setStatusInput(s2m1, c1);
            setStatusInput(s2m2, c2);
            setStatusInput(s2m3, c3);
            setStatusInput(s2b1, c4);
            setStatusInput(s2b2, c5);
            setStatusInput(s2b3, c6);
            setStatusInput(s2q1, c7);
            setStatusInput(s2q2, c8);
            setStatusInput(s2q3, c9);
            setStatusInput(s2sisa, c10);

            if (c1 && c2 && c3 && c4 && c5 && c6 && c7 && c8 && c9 && c10) {
                feedback.innerHTML = 'Benar. Kedua soal sudah selesai.';
                feedback.className = 'latihan-feedback success';
                penjelasan.style.display = 'block';
                document.getElementById('latihanPenjelasan1').style.display = 'block';
                finalNote.style.display = 'block';
            } else {
                feedback.innerHTML = `
                            Masih ada isian yang salah pada soal nomor 2.
                            <br>
                            <button type="button" class="btn-langkah" style="margin-top:10px;" onclick="ulangiLatihan2()">Ulangi</button>
                        `;
                feedback.className = 'latihan-feedback error';
                penjelasan.style.display = 'none';
            }
        }

        function cekInputKosong(el) {
            if (!el) return;
            el.value = '';
            el.classList.remove('input-benar', 'input-salah');
        }

        function ulangiLatihan1() {
            resetPilihanState('s1k');
            resetPilihanState('s1koef');
            resetPilihanState('s1turun');
            resetPilihanState('s1proses');
            resetPilihanState('s1hasil');

            document.getElementById('latihanFeedback1').innerHTML = '';
            document.getElementById('latihanPenjelasan1').style.display = 'none';
        }

        function ulangiLatihan2() {
            const ids = ['s2m1', 's2m2', 's2m3', 's2b1', 's2b2', 's2b3', 's2q1', 's2q2', 's2q3', 's2sisa'];

            ids.forEach(id => {
                cekInputKosong(document.getElementById(id));
            });

            document.getElementById('latihanFeedback2').innerHTML = '';
            document.getElementById('latihanPenjelasan2').style.display = 'none';
        }
    </script>
@endsection

@section('nav')
    <a href="{{ route('pembagianbersusun') }}" class="btn-nav prev-btn">
        ← Previous
    </a>

    <a href="{{ route('teoremasisa') }}" class="btn-nav next-btn">
        Next →
    </a>
@endsection