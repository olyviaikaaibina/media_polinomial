@extends('layout.halamanmateri')

@section('content')
    <!-- KaTeX -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/contrib/auto-render.min.js"
        onload="renderMathInElement(document.body, {
                                                                                                                                                        delimiters: [
                                                                                                                                                            {left: '$$', right: '$$', display: true},
                                                                                                                                                            {left: '$', right: '$', display: false}
                                                                                                                                                        ]
                                                                                                                                                    });"></script>

    <style>
        :root {
            --green: #1b7a2a;
            --green-soft: #eaf6ea;
            --orange: #e0702b;
            --orange-soft: #fff6f0;
            --text: #222;
            --muted: #444;

            --def-bg: #efb39f;
            --def-pill: #97c58a;
            --def-pill-border: #3f9b37;
        }

        .materi-wrap {
            max-width: 980px;
            margin: 0 auto;
            font-family: "Times New Roman", Times, serif;
            color: var(--text);
            line-height: 1.7;
            padding: 20px 14px 40px;
        }

        .top-title {
            display: flex;
            align-items: baseline;
            gap: 12px;
            margin-bottom: 18px;
        }

        .top-title .label {
            font-size: 26px;
            font-weight: 700;
            color: #000;
        }

        .top-title .judul {
            font-size: 30px;
            font-weight: 800;
            color: var(--green);
        }

        .tujuan-card {
            border: 2px solid var(--orange);
            padding: 18px 20px;
            margin-bottom: 26px;
            background: #fff;
        }

        .tujuan-header .title {
            font-size: 21px;
            font-weight: 900;
            color: var(--green);
            margin: 0 0 10px 0;
        }

        .tujuan-card ol {
            margin: 0;
            padding-left: 22px;
        }

        .tujuan-card li {
            text-align: justify;
            font-size: 17px;
        }

        .section-title {
            font-size: 27px;
            font-weight: 800;
            color: var(--green);
            margin: 20px 0 12px;
        }

        .eksplorasi-card {
            position: relative;
            border-radius: 26px;
            padding: 26px 24px 22px;
            margin-bottom: 22px;
            background: #f3e6de;
            border-left: 6px solid #e0702b;
            box-shadow: 0 8px 18px rgba(0, 0, 0, .05);
        }

        .eksplorasi-title {
            font-size: 20px;
            font-weight: 800;
            color: #2e7d32;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .eksplorasi-title::before {
            content: "🧭";
            font-size: 18px;
        }

        .eksplorasi-content {
            margin-top: 12px;
            min-height: 80px;
        }

        .materi-paragraf {
            margin-top: 8px;
        }

        .materi-paragraf p {
            margin: 0 0 18px 0;
            font-size: 17px;
            color: var(--text);
            text-align: justify;
        }

        .definisi-block {
            position: relative;
            width: 100%;
            max-width: 880px;
            background: var(--def-bg);
            border: 1px solid rgba(0, 0, 0, .18);
            padding: 34px 18px 18px;
            margin: 24px 0 0 0;
        }

        .definisi-pill {
            position: absolute;
            top: -18px;
            left: -12px;
            min-width: 180px;
            text-align: center;
            background: var(--def-pill);
            color: #000;
            font-weight: 900;
            padding: 8px 22px;
            border-radius: 999px;
            border: 2px solid var(--def-pill-border);
            text-transform: uppercase;
            font-size: 16px;
        }

        .definisi-text {
            margin: 0 0 12px 0;
            font-size: 15px;
            line-height: 1.7;
            color: #000;
            text-align: justify;
        }

        .formula-center {
            text-align: center;
            font-size: 22px;
            margin: 10px 0;
            color: #000;
        }

        .bold {
            font-weight: 700;
        }

        .sifat-card {
            position: relative;
            border: 2px solid #4aa12f;
            border-radius: 22px;
            padding: 30px 24px 26px;
            margin: 28px 0;
            background: #fff;
        }

        .sifat-badge {
            position: absolute;
            top: -16px;
            left: 24px;
            background: #e6a381;
            color: #000;
            font-weight: 700;
            font-size: 14px;
            padding: 6px 18px;
            border-radius: 999px;
            border: 2px solid #e0702b;
        }

        .sifat-text {
            font-size: 17px;
            margin-bottom: 14px;
            text-align: justify;
        }

        .identitas-item {
            margin-bottom: 18px;
        }

        .identitas-judul {
            font-size: 16px;
            margin-bottom: 6px;
        }

        .identitas-rumus {
            text-align: center;
            font-size: 22px;
            margin-top: 4px;
        }

        .lanjutan-paragraf {
            margin-top: 16px;
        }

        .lanjutan-paragraf p {
            font-size: 16px;
            text-align: justify;
        }

        .contoh-card {
            position: relative;
            border: 2px solid #4aa12f;
            padding: 28px 16px 20px;
            margin: 28px 0 0;
            background: #fff;
        }

        .contoh-badge {
            position: absolute;
            top: -20px;
            left: 0;
            min-width: 180px;
            text-align: center;
            background: #efb39f;
            color: #000;
            font-weight: 700;
            font-size: 15px;
            padding: 8px 28px;
            border-radius: 999px;
            border: 2px solid #e0702b;
        }

        .contoh-card p {
            font-size: 16px;
            margin: 0 0 14px 0;
            text-align: justify;
        }

        .contoh-soal {
            font-size: 17px;
            margin-bottom: 10px;
        }

        .contoh-rumus {
            text-align: center;
            font-size: 24px;
            margin: 10px 0 16px;
        }

        .penyelesaian-title {
            font-size: 17px;
            font-weight: 700;
            color: #0f4e72;
            text-decoration: underline;
            margin: 8px 0 14px;
        }

        .langkah-box {
            background: #f8fbf8;
            border: 1px solid rgba(74, 161, 47, .22);
            border-radius: 14px;
            padding: 14px 14px;
            margin-top: 8px;
        }

        .langkah-item {
            display: none;
            animation: fadeIn .25s ease;
        }

        .langkah-item.active {
            display: block;
        }

        .langkah-kecil {
            margin: 0 0 8px 0;
            font-size: 16px;
        }

        .langkah-rumus {
            text-align: center;
            font-size: 22px;
            margin: 8px 0 12px;
        }

        .langkah-note {
            background: #fff;
            border-left: 4px solid #e0702b;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 15px;
            margin-top: 8px;
            line-height: 1.7;
        }

        .asal-langkah {
            margin-top: 10px;
            background: #fffdf7;
            border: 1px dashed rgba(224, 112, 43, .55);
            border-radius: 10px;
            padding: 10px 12px;
            font-size: 15px;
            line-height: 1.7;
        }

        .asal-langkah strong {
            color: #9a4d17;
        }

        .contoh-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 14px;
        }

        .btn-contoh {
            border: 1px solid rgba(0, 0, 0, .15);
            background: #fff;
            border-radius: 12px;
            padding: 8px 14px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: .15s ease;
        }

        .btn-contoh:hover {
            transform: translateY(-1px);
        }

        .btn-next {
            border-color: rgba(74, 161, 47, .35);
            background: #f2fbf2;
        }

        .btn-prev {
            border-color: rgba(224, 112, 43, .30);
            background: #fff6f0;
        }

        .btn-reset {
            border-color: rgba(15, 78, 114, .25);
            background: #f4fbff;
        }

        .langkah-indikator {
            margin-top: 10px;
            font-size: 14px;
            color: #666;
        }

        .kesimpulan-box {
            margin-top: 6px;
            padding-top: 4px;
        }

        .kesimpulan-box p {
            margin-bottom: 10px;
        }

        .tebal {
            font-weight: 700;
        }

        /* CARD MARI MENCOBA */
        .mari-mencoba-wrapper {
            margin-top: 36px;
        }

        .mari-header {
            display: inline-block;
            background: #8c8c8c;
            color: #fff;
            font-size: 20px;
            font-weight: 700;
            padding: 10px 38px;
            border-radius: 999px;
            margin-bottom: 14px;
            letter-spacing: .3px;
        }

        .mari-card {
            border: 2px solid #2997d3;
            background: #fff;
            padding: 18px 14px 22px;
        }

        .mari-instruksi {
            margin: 0 0 22px 0;
            font-size: 17px;
            line-height: 1.5;
        }

        .quiz-item {
            margin-bottom: 18px;
            padding: 12px 12px 10px;
            border-radius: 10px;
            transition: .2s ease;
        }

        .quiz-item.benar {
            background: #dff5e3;
            border: 1px solid #2f9e44;
        }

        .quiz-item.salah {
            background: #fde2e2;
            border: 1px solid #d6336c;
        }

        .soal {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .quiz-options {
            display: flex;
            gap: 28px;
            flex-wrap: wrap;
            margin-top: 6px;
        }

        .quiz-options label {
            font-size: 17px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .quiz-options input[type="radio"] {
            transform: scale(1.05);
        }

        .penjelasan {
            display: none;
            margin-top: 10px;
            padding: 10px 12px;
            border-radius: 8px;
            background: rgba(255, 255, 255, .72);
            font-size: 15px;
            line-height: 1.6;
        }

        .quiz-item.benar .penjelasan,
        .quiz-item.salah .penjelasan {
            display: block;
        }

        .quiz-item.benar .penjelasan {
            color: #155724;
        }

        .quiz-item.salah .penjelasan {
            color: #842029;
        }

        .quiz-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 12px;
        }

        .quiz-btn {
            border: none;
            border-radius: 10px;
            padding: 10px 16px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: .15s ease;
        }

        .quiz-btn:hover {
            transform: translateY(-1px);
        }

        #cek-jawaban {
            background: #2997d3;
            color: #fff;
        }

        #ulangi {
            background: #e9ecef;
            color: #222;
        }

        .hasil-skor {
            margin-top: 14px;
            font-size: 16px;
            font-weight: 700;
            color: #0f4e72;
        }

        .langkah-faktor {
            display: none;
            animation: fadeIn .25s ease;
        }

        .langkah-faktor.active {
            display: block;
        }

        .langkah-box-faktor {
            min-height: 260px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(3px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 640px) {
            .top-title .judul {
                font-size: 24px;
            }

            .top-title .label {
                font-size: 22px;
            }

            .section-title {
                font-size: 23px;
            }

            .definisi-block {
                padding: 32px 14px 16px;
            }

            .definisi-pill {
                min-width: 140px;
                font-size: 14px;
                padding: 7px 16px;
            }

            .definisi-text {
                font-size: 14px;
            }

            .formula-center,
            .identitas-rumus,
            .contoh-rumus,
            .langkah-rumus {
                font-size: 20px;
            }

            .sifat-card,
            .contoh-card {
                padding-left: 14px;
                padding-right: 14px;
            }

            .contoh-badge {
                min-width: 145px;
                font-size: 14px;
                padding: 7px 18px;
            }

            .sifat-text,
            .materi-paragraf p,
            .lanjutan-paragraf p,
            .contoh-card p,
            .langkah-kecil,
            .langkah-note,
            .asal-langkah,
            .mari-instruksi,
            .soal,
            .quiz-options label,
            .penjelasan {
                font-size: 15px;
            }

            .mari-header {
                font-size: 17px;
                padding: 9px 26px;
            }

            #contoh-faktorisasi .langkah-box {
                min-height: 260px;
            }

            .langkah-box-faktor {
                min-height: 260px;
            }

            .langkah-faktor {
                display: none;
                animation: fadeIn .25s ease;
            }

            .langkah-faktor.active {
                display: block;
            }
        }

        #mari-mencoba-faktorisasi .langkah-box .langkah-item {
            display: block !important;
            margin-bottom: 18px;
            padding-bottom: 14px;
            border-bottom: 1px dashed rgba(0, 0, 0, .12);
        }

        #mari-mencoba-faktorisasi .langkah-box .langkah-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        #mari-mencoba-faktorisasi .quiz-item {
            padding: 14px 14px 16px;
        }

        #mari-mencoba-faktorisasi .penjelasan {
            margin-top: 12px;
        }

        .latihan-modern-wrap {
            margin-top: 36px;
        }

        .latihan-modern-card {
            position: relative;
            border: 2px solid #4a9c4f;
            border-radius: 22px;
            background: #fff;
            padding: 34px 22px 24px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, .04);
        }

        .latihan-modern-badge {
            position: absolute;
            top: -16px;
            left: 22px;
            background: #efb39f;
            color: #2a2a2a;
            font-weight: 800;
            font-size: 15px;
            padding: 10px 22px;
            border-radius: 999px;
            border: 1.5px solid #d57b4d;
            letter-spacing: .3px;
        }

        .latihan-modern-intro {
            font-size: 16px;
            color: #4a4a4a;
            margin-bottom: 14px;
            line-height: 1.7;
        }

        .latihan-modern-soal {
            text-align: center;
            font-size: 18px;
            font-weight: 700;
            color: #204d2a;
            margin: 10px 0 28px;
        }

        .latihan-modern-subtitle {
            font-size: 16px;
            font-weight: 800;
            color: #2f8b3a;
            text-decoration: underline;
            margin-bottom: 16px;
        }

        .step-panel {
            background: #f7f4ef;
            border: 1px solid #ddd0c3;
            border-radius: 18px;
            padding: 18px 16px;
            margin-bottom: 16px;
        }

        .step-title {
            font-size: 16px;
            font-weight: 800;
            color: #4a9c4f;
            margin-bottom: 12px;
        }

        .step-desc {
            font-size: 15px;
            color: #555;
            margin-bottom: 14px;
            line-height: 1.7;
        }

        .step-input-row {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: center;
        }

        .step-input {
            flex: 1;
            min-width: 220px;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid #cfc2b4;
            font-size: 15px;
            outline: none;
            background: #fff;
        }

        .step-btn {
            border: 1px solid #c9baa8;
            background: #f4ecdf;
            color: #5b4b39;
            border-radius: 12px;
            padding: 12px 18px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .step-btn:hover {
            transform: translateY(-1px);
        }

        .step-feedback {
            display: none;
            margin-top: 14px;
            padding: 12px 14px;
            border-radius: 12px;
            font-size: 14px;
            line-height: 1.7;
        }

        .step-feedback.benar {
            display: block;
            background: #e3f6e7;
            border: 1px solid #5ea86a;
            color: #1f5f2a;
        }

        .step-feedback.salah {
            display: block;
            background: #fde8e8;
            border: 1px solid #d16c6c;
            color: #8a2525;
        }

        .step-answer-box {
            display: none;
            margin-top: 14px;
            padding: 12px 14px;
            border-left: 4px solid #e0702b;
            background: #fffaf5;
            border-radius: 10px;
            font-size: 14px;
            line-height: 1.7;
        }

        .step-answer-box.show {
            display: block;
        }

        .latihan-final-note {
            margin-top: 18px;
            padding: 14px 16px;
            background: #f4fbf4;
            border: 1px solid #b9d9b9;
            border-radius: 14px;
            font-size: 15px;
            line-height: 1.7;
            color: #244b2e;
        }

        @media (max-width: 640px) {
            .latihan-modern-card {
                padding: 32px 14px 18px;
            }

            .latihan-modern-badge {
                font-size: 14px;
                left: 14px;
                padding: 8px 18px;
            }

            .latihan-modern-soal {
                font-size: 16px;
            }

            .step-title,
            .latihan-modern-subtitle,
            .latihan-modern-intro,
            .step-desc,
            .step-feedback,
            .step-answer-box {
                font-size: 14px;
            }
        }

        @media (max-width: 640px) {
            .latihan-modern-card {
                padding: 32px 14px 18px;
            }

            .latihan-modern-badge {
                font-size: 14px;
                left: 14px;
                padding: 8px 18px;
            }

            .latihan-modern-soal {
                font-size: 16px;
            }

            .step-title,
            .latihan-modern-subtitle,
            .latihan-modern-intro,
            .step-desc,
            .step-feedback,
            .step-answer-box {
                font-size: 14px;
            }
        }

        .eksplorasi-soal {
            margin-top: 14px;
        }

        .eksplorasi-quiz-item {
            margin-top: 18px;
            padding: 16px 16px 14px;
            background: #fffaf7;
            border: 1px solid rgba(224, 112, 43, .18);
            border-radius: 14px;
        }

        .eksplorasi-quiz-question {
            font-size: 17px;
            margin: 0 0 12px 0;
            color: #222;
        }

        .eksplorasi-opsi-row {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .eksplorasi-opsi {
            flex: 1;
            min-width: 180px;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1.5px solid #d8c9bb;
            background: #fff;
            font-size: 15px;
            text-align: left;
            cursor: pointer;
            transition: .2s ease;
            line-height: 1.5;
        }

        .eksplorasi-opsi:hover {
            transform: translateY(-1px);
            border-color: #c9a98e;
            background: #fffdfb;
        }

        .eksplorasi-opsi.benar {
            background: #dff5e3;
            border-color: #2f9e44;
            color: #155724;
            font-weight: 700;
        }

        .eksplorasi-opsi.salah {
            background: #fde2e2;
            border-color: #d6336c;
            color: #842029;
            font-weight: 700;
        }

        .eksplorasi-feedback {
            display: none;
            margin-top: 12px;
            padding: 10px 12px;
            border-radius: 10px;
            font-size: 15px;
            line-height: 1.6;
        }

        .eksplorasi-feedback.show {
            display: block;
        }

        .eksplorasi-feedback.benar {
            background: #e3f6e7;
            border: 1px solid #5ea86a;
            color: #1f5f2a;
        }

        .eksplorasi-feedback.salah {
            background: #fde8e8;
            border: 1px solid #d16c6c;
            color: #8a2525;
        }

        .eksplorasi-penjelasan {
            display: none;
            margin-top: 12px;
            padding: 12px 14px;
            border-left: 4px solid #e0702b;
            background: #fffaf5;
            border-radius: 10px;
            font-size: 14px;
            line-height: 1.7;
        }

        .eksplorasi-penjelasan.show {
            display: block;
        }

        @media (max-width: 640px) {
            .eksplorasi-opsi {
                min-width: 100%;
                font-size: 14px;
            }

            .eksplorasi-quiz-question,
            .eksplorasi-feedback,
            .eksplorasi-penjelasan {
                font-size: 14px;
            }
        }
    </style>

    <div class="materi-wrap">

        <div class="top-title">
            <div class="label">E.</div>
            <div class="judul">Identitas Polinomial</div>
        </div>

        {{-- Tujuan Pembelajaran --}}
        <div class="tujuan-card">
            <div class="tujuan-header">
                <h3 class="title">Tujuan Pembelajaran :</h3>
            </div>
            <ol>
                <li>
                    Membuktikan identitas polinomial serta memanfaatkannya untuk menyelesaikan
                    masalah pemfaktoran polinomial.
                </li>
            </ol>
        </div>

        <div class="section-title">1. Identitas Polinomial</div>

        <div class="eksplorasi-card">
            <div class="eksplorasi-title">Eksplorasi</div>
            <div class="eksplorasi-content">

                <div class="materi-paragraf">
                    <p>
                        Kalimantan Selatan dikenal sebagai salah satu daerah penghasil batubara.
                    </p>

                    <p>
                        Misalkan suatu area tambang berbentuk persegi panjang. Panjang area tersebut
                        dinyatakan dengan $(x + 2)$ meter, sedangkan lebarnya $(x - 2)$ meter.
                    </p>

                    <p>
                        Luas area tambang tersebut dapat dituliskan sebagai:
                    </p>
                </div>

                <div class="formula-center">
                    $(x + 2)(x - 2)$
                </div>

                <div class="materi-paragraf">
                    <p>
                        Jika dikembangkan, diperoleh:
                    </p>
                </div>

                <div class="formula-center">
                    $(x + 2)(x - 2) = x^2 - 4$
                </div>

                <div class="materi-paragraf">
                    <p>
                        Perhatikan juga bentuk berikut:
                    </p>
                </div>

                <div class="formula-center">
                    $(x + 3)(x - 3) = x^2 - 9$
                </div>

                <div class="materi-paragraf">
                    <p>
                        Dari kedua bentuk tersebut, terlihat adanya pola.
                        Perhatikan bahwa hasil tersebut tetap berlaku untuk semua nilai $x$.
                        Hal ini menunjukkan bahwa bentuk tersebut merupakan suatu <b>identitas</b>.
                    </p>
                </div>

                <hr style="margin:20px 0;">

                <div class="eksplorasi-soal">
                    <p><b>Pertanyaan:</b></p>

                    <!-- SOAL 1 -->
                    <div class="eksplorasi-quiz-item" data-correct="A">
                        <p class="eksplorasi-quiz-question">
                            1. Hasil dari $(x + 2)(x - 2)$ adalah …
                        </p>

                        <div class="eksplorasi-opsi-row">
                            <button type="button" class="eksplorasi-opsi" data-value="A">
                                A. $x^2 - 4$
                            </button>
                            <button type="button" class="eksplorasi-opsi" data-value="B">
                                B. $x^2 + 4$
                            </button>
                            <button type="button" class="eksplorasi-opsi" data-value="C">
                                C. $x^2 - 2x$
                            </button>
                        </div>

                        <div class="eksplorasi-feedback"></div>
                        <div class="eksplorasi-penjelasan">
                            Benar. Bentuk $(x+2)(x-2)$ mengikuti pola selisih dua kuadrat, yaitu
                            $(a+b)(a-b)=a^2-b^2$. Dengan $a=x$ dan $b=2$, diperoleh:
                            $$ (x+2)(x-2)=x^2-2^2=x^2-4 $$
                        </div>
                    </div>

                    <!-- SOAL 2 -->
                    <div class="eksplorasi-quiz-item" data-correct="B">
                        <p class="eksplorasi-quiz-question">
                            2. Bentuk umum yang benar adalah …
                        </p>

                        <div class="eksplorasi-opsi-row">
                            <button type="button" class="eksplorasi-opsi" data-value="A">
                                A. $(x + a)(x - a) = x^2 + a^2$
                            </button>
                            <button type="button" class="eksplorasi-opsi" data-value="B">
                                B. $(x + a)(x - a) = x^2 - a^2$
                            </button>
                            <button type="button" class="eksplorasi-opsi" data-value="C">
                                C. $(x + a)(x + a) = x^2 - a^2$
                            </button>
                        </div>

                        <div class="eksplorasi-feedback"></div>
                        <div class="eksplorasi-penjelasan">
                            Benar. Dari contoh
                            $$ (x+2)(x-2)=x^2-4 \quad \text{dan} \quad (x+3)(x-3)=x^2-9 $$
                            terlihat pola umum:
                            $$ (x+a)(x-a)=x^2-a^2 $$
                            Pola ini disebut identitas selisih dua kuadrat.
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="materi-paragraf">
            <p>
                Pada bab-bab sebelumnya, kamu telah mempelajari berbagai operasi dan sifat
                polinomial, mulai dari penjumlahan hingga pembagian, serta teorema-teorema
                penting seperti Teorema Sisa dan Teorema Faktor. Pada bagian ini, kita akan
                mempelajari konsep penting lainnya, yaitu identitas polinomial.
            </p>

            <p>
                Identitas polinomial adalah persamaan yang selalu benar untuk setiap nilai variabel
                yang diizinkan. Identitas ini tidak hanya membantu kita dalam penyederhanaan
                bentuk aljabar, tetapi juga menjadi dasar dalam pembuktian, pemfaktoran, serta
                penyelesaian berbagai persoalan polinomial yang lebih kompleks.
            </p>
        </div>

        <div class="definisi-block">
            <div class="definisi-pill">DEFINISI</div>

            <p class="definisi-text">
                Identitas polinomial adalah persamaan antara dua polinomial yang bernilai
                sama untuk setiap nilai variabel yang memungkinkan.
            </p>

            <p class="definisi-text">Artinya, jika</p>

            <div class="formula-center">
                $P(x) = Q(x)$
            </div>

            <p class="definisi-text">
                merupakan identitas, maka untuk semua nilai x:
            </p>

            <div class="formula-center">
                $P(x) - Q(x) = 0.$
            </div>

            <p class="definisi-text">
                Sebaliknya, jika ada <span class="bold">satu saja</span> nilai variabel yang membuat kedua ruas tidak
                sama, maka persamaan tersebut <span class="bold">bukan identitas</span>.
            </p>
        </div>

        <div class="sifat-card">
            <div class="sifat-badge">SIFAT</div>

            <div class="sifat-text">
                Berikut beberapa identitas polinomial mendasar yang sangat sering digunakan:
            </div>

            <div class="identitas-item">
                <div class="identitas-judul">1. Selisih Dua Kuadrat</div>
                <div class="identitas-rumus">
                    $a^2 - b^2 = (a+b)(a-b)$
                </div>
            </div>

            <div class="identitas-item">
                <div class="identitas-judul">2. Kuadrat Penjumlahan Dua Suku</div>
                <div class="identitas-rumus">
                    $(a+b)^2 = a^2 + 2ab + b^2$
                </div>
            </div>

            <div class="identitas-item">
                <div class="identitas-judul">3. Kuadrat Selisih Dua Suku</div>
                <div class="identitas-rumus">
                    $(a-b)^2 = a^2 - 2ab + b^2$
                </div>
            </div>

            <div class="identitas-item">
                <div class="identitas-judul">4. Jumlah Dua Kubik</div>
                <div class="identitas-rumus">
                    $a^3 + b^3 = (a+b)(a^2-ab+b^2)$
                </div>
            </div>

            <div class="identitas-item">
                <div class="identitas-judul">5. Selisih Dua Kubik</div>
                <div class="identitas-rumus">
                    $a^3 - b^3 = (a-b)(a^2+ab+b^2)$
                </div>
            </div>

            <div class="identitas-item">
                <div class="identitas-judul">6. Kubik Penjumlahan Dua Suku</div>
                <div class="identitas-rumus">
                    $(a+b)^3 = a^3 + 3a^2b + 3ab^2 + b^3$
                </div>
            </div>

            <div class="identitas-item">
                <div class="identitas-judul">7. Kubik Selisih Dua Suku</div>
                <div class="identitas-rumus">
                    $(a-b)^3 = a^3 - 3a^2b + 3ab^2 - b^3$
                </div>
            </div>

            <div class="sifat-text">
                Identitas-identitas ini selalu benar, sehingga bisa digunakan kapan saja untuk
                menyederhanakan atau memfaktorkan suatu bentuk polinomial.
            </div>
        </div>

        <div class="lanjutan-paragraf">
            <p>
                Untuk membuktikan bahwa suatu persamaan merupakan identitas, kita perlu menunjukkan
                bahwa bentuk di ruas kiri persamaan tersebut sama dengan bentuk di ruas kanan untuk
                setiap kemungkinan nilai variabelnya. Sebaliknya, jika kita ingin menunjukkan bahwa
                suatu persamaan bukan merupakan identitas, kita cukup memberikan satu contoh nilai
                variabel yang membuat bentuk di ruas kiri tidak sama dengan bentuk di ruas kanan.
            </p>
        </div>

        <div class="contoh-card" id="contoh-identitas">
            <div class="contoh-badge">CONTOH</div>

            <p class="contoh-soal">
                Buktikan bahwa persamaan berikut merupakan identitas polinomial:
            </p>

            <div class="contoh-rumus">
                $(3x - 2)^2 = 9x^2 - 12x + 4$
            </div>

            <div class="langkah-box">
                <div class="langkah-item active">
                    <p class="langkah-kecil">Langkah 1: Mulai dari ruas kiri.</p>
                    <div class="langkah-rumus">
                        $(3x - 2)^2$
                    </div>
                    <div class="langkah-note">
                        Dalam pembuktian identitas, kita biasanya memulai dari salah satu ruas,
                        lalu mengubahnya sampai sama dengan ruas yang lain.
                    </div>
                    <div class="asal-langkah">
                        <strong>Didapat dari mana?</strong><br>
                        Bentuk ini langsung diambil dari ruas kiri pada soal.
                        Kita memilih ruas kiri sebagai titik awal agar dapat dibuktikan bahwa
                        bentuk tersebut bisa diubah menjadi ruas kanan.
                    </div>
                </div>

                <div class="langkah-item">
                    <p class="langkah-kecil">Langkah 2: Gunakan identitas kuadrat selisih dua suku.</p>
                    <div class="langkah-rumus">
                        $(a-b)^2 = a^2 - 2ab + b^2$
                    </div>
                    <div class="langkah-note">
                        Rumus ini dipakai karena bentuk $(3x - 2)^2$ memiliki pola kuadrat selisih.
                    </div>
                    <div class="asal-langkah">
                        <strong>Didapat dari mana?</strong><br>
                        Rumus ini berasal dari perkalian:
                        $$
                        (a-b)^2 = (a-b)(a-b)
                        $$
                        lalu dikalikan:
                        $$
                        (a-b)(a-b)=a^2-ab-ab+b^2=a^2-2ab+b^2
                        $$
                        Jadi ini adalah hasil dari operasi aljabar, bukan sekadar hafalan.
                    </div>
                </div>

                <div class="langkah-item">
                    <p class="langkah-kecil">Langkah 3: Substitusikan ke rumus.</p>
                    <div class="langkah-rumus">
                        $(3x - 2)^2 = (3x)^2 - 2(3x)(2) + (2)^2$
                    </div>
                    <div class="langkah-note">
                        Kita sesuaikan bentuk soal dengan rumus umum.
                    </div>
                    <div class="asal-langkah">
                        <strong>Didapat dari mana?</strong><br>
                        Dari bentuk umum:
                        $$
                        (a-b)^2 = a^2 - 2ab + b^2
                        $$
                        pada soal:
                        $$
                        a = 3x,\quad b = 2
                        $$
                        lalu dimasukkan ke rumus (proses ini disebut substitusi).
                    </div>
                </div>

                <div class="langkah-item">
                    <p class="langkah-kecil">Langkah 4: Hitung masing-masing suku.</p>
                    <div class="langkah-rumus">
                        $(3x)^2 = 9x^2,\quad -2(3x)(2) = -12x,\quad 2^2 = 4$
                    </div>
                    <div class="langkah-note">
                        Setiap bagian dihitung satu per satu agar lebih jelas.
                    </div>
                    <div class="asal-langkah">
                        <strong>Didapat dari mana?</strong><br>
                        Berdasarkan aturan pangkat dan perkalian:
                        <br><br>
                        $$
                        (3x)^2 = 3^2 \cdot x^2 = 9x^2
                        $$
                        karena $(ab)^2 = a^2b^2$
                        <br><br>
                        $$
                        -2(3x)(2) = -2 \cdot 3 \cdot x \cdot 2 = -12x
                        $$
                        <br><br>
                        $$
                        2^2 = 4
                        $$
                    </div>
                </div>

                <div class="langkah-item">
                    <p class="langkah-kecil">Langkah 5: Gabungkan hasil.</p>
                    <div class="langkah-rumus">
                        $(3x - 2)^2 = 9x^2 - 12x + 4$
                    </div>
                    <div class="langkah-note">
                        Hasil perhitungan disusun kembali menjadi bentuk polinomial.
                    </div>
                    <div class="asal-langkah">
                        <strong>Didapat dari mana?</strong><br>
                        Dari hasil sebelumnya:
                        $$
                        (3x)^2 = 9x^2,\quad -12x,\quad 4
                        $$
                        lalu disusun sesuai pola:
                        $$
                        a^2 - 2ab + b^2
                        $$
                        sehingga diperoleh:
                        $$
                        9x^2 - 12x + 4
                        $$
                    </div>
                </div>

                <div class="langkah-item">
                    <p class="langkah-kecil">Langkah 6: Tarik kesimpulan.</p>
                    <div class="kesimpulan-box">
                        <p>Ruas kiri sama dengan ruas kanan.</p>
                        <p>Berlaku untuk semua nilai $x$.</p>
                        <p>Jadi merupakan <span class="tebal">identitas polinomial</span>.</p>
                    </div>
                    <div class="asal-langkah">
                        <strong>Didapat dari mana?</strong><br>
                        Berdasarkan definisi identitas:
                        dua bentuk aljabar dikatakan identitas jika nilainya sama untuk semua variabel.
                        Karena hasilnya:
                        $$
                        9x^2 - 12x + 4
                        $$
                        sama persis dengan ruas kanan, maka ini adalah identitas.
                    </div>
                </div>
            </div>

            <div class="contoh-actions">
                <button type="button" class="btn-contoh btn-prev" id="btn-prev-langkah">← Sebelumnya</button>
                <button type="button" class="btn-contoh btn-next" id="btn-next-langkah">Langkah Berikutnya →</button>
                <button type="button" class="btn-contoh btn-reset" id="btn-reset-langkah">Ulangi</button>
            </div>

            <div class="langkah-indikator" id="indikator-langkah">Langkah 1 dari 6</div>
        </div>

        <div class="mari-mencoba-wrapper" id="mari-mencoba">
            <div class="mari-header">MARI MENCOBA</div>

            <div class="mari-card">
                <p class="mari-instruksi">
                    Berikan penilaian <b>Benar (B)</b> atau <b>Salah (S)</b> pada setiap pernyataan berikut.
                    Jawab semua soal terlebih dahulu sebelum mengecek jawaban.
                </p>

                <form id="quiz-form">
                    <div class="quiz-item" data-correct="B"
                        data-explain="Gunakan rumus kuadrat jumlah, yaitu $(a+b)^2 = a^2 + 2ab + b^2$. Jadi persamaan ini benar dan merupakan identitas.">
                        <div class="soal">1. $(a+b)^2 = a^2 + 2ab + b^2$</div>
                        <div class="quiz-options">
                            <label><input type="radio" name="q1" value="B"> B</label>
                            <label><input type="radio" name="q1" value="S"> S</label>
                        </div>
                        <div class="penjelasan"></div>
                    </div>

                    <div class="quiz-item" data-correct="B"
                        data-explain="Ini menggunakan bentuk selisih dua kuadrat: $(a-b)(a+b)=a^2-b^2$. Dengan $a=2x$ dan $b=3$, diperoleh $4x^2-9$. Jadi ini identitas.">
                        <div class="soal">2. $(2x-3)(2x+3) = 4x^2 - 9$</div>
                        <div class="quiz-options">
                            <label><input type="radio" name="q2" value="B"> B</label>
                            <label><input type="radio" name="q2" value="S"> S</label>
                        </div>
                        <div class="penjelasan"></div>
                    </div>

                    <div class="quiz-item" data-correct="B"
                        data-explain="Gunakan rumus kuadrat jumlah dengan $a=3y$ dan $b=1$. Hasilnya $(3y+1)^2 = 9y^2 + 6y + 1$. Jadi ini identitas.">
                        <div class="soal">3. $(3y+1)^2 = 9y^2 + 6y + 1$</div>
                        <div class="quiz-options">
                            <label><input type="radio" name="q3" value="B"> B</label>
                            <label><input type="radio" name="q3" value="S"> S</label>
                        </div>
                        <div class="penjelasan"></div>
                    </div>

                    <div class="quiz-item" data-correct="S"
                        data-explain="Ruas kiri seharusnya dikembangkan menjadi $(x-4)^2 = x^2 - 8x + 16$, bukan $x^2 - 4$. Jadi persamaan ini salah dan bukan identitas.">
                        <div class="soal">4. $(x-4)^2 = x^2 - 4$</div>
                        <div class="quiz-options">
                            <label><input type="radio" name="q4" value="B"> B</label>
                            <label><input type="radio" name="q4" value="S"> S</label>
                        </div>
                        <div class="penjelasan"></div>
                    </div>

                    <div class="quiz-item" data-correct="B"
                        data-explain="Ini adalah rumus jumlah dua kubik: $a^3+b^3=(a+b)(a^2-ab+b^2)$. Jadi persamaan ini benar dan merupakan identitas.">
                        <div class="soal">5. $a^3 + b^3 = (a+b)(a^2-ab+b^2)$</div>
                        <div class="quiz-options">
                            <label><input type="radio" name="q5" value="B"> B</label>
                            <label><input type="radio" name="q5" value="S"> S</label>
                        </div>
                        <div class="penjelasan"></div>
                    </div>

                    <div class="quiz-actions">
                        <button type="button" class="quiz-btn" id="cek-jawaban">Cek Jawaban</button>
                        <button type="button" class="quiz-btn" id="ulangi">Ulangi</button>
                    </div>

                    <div class="hasil-skor" id="hasil-skor"></div>
                </form>
            </div>
        </div>

        <div class="lanjutan-paragraf">
            <p>
                Salah satu kegunaan utama dari identitas polinomial adalah untuk memfaktorkan
                polinomial dengan lebih cepat dan efisien. Identitas membantu kita mengenali pola
                tertentu pada suatu bentuk aljabar sehingga dapat diubah menjadi hasil perkalian
                dua atau lebih polinomial sederhana. Dengan cara ini, proses pemfaktoran tidak
                hanya menjadi lebih mudah, tetapi juga lebih sistematis karena kita tinggal
                mencocokkan bentuk polinomial dengan identitas yang sesuai.
            </p>
        </div>

        <div class="contoh-card" id="contoh-faktorisasi">
            <div class="contoh-badge">CONTOH</div>

            <p class="contoh-soal">
                Faktorkan polinomial berikut:
            </p>

            <div class="contoh-rumus">
                $x^3 - 27$
            </div>

            <div class="penyelesaian-title">Penyelesaian:</div>

            <div class="langkah-box langkah-box-faktor">
                <div class="langkah-faktor active">
                    <p class="langkah-kecil">Langkah 1: Perhatikan bentuk polinomial.</p>
                    <div class="langkah-rumus">
                        $x^3 - 27$
                    </div>
                    <div class="langkah-note">
                        Bentuk ini terdiri dari dua suku, yaitu $x^3$ dan $27$, dengan tanda pengurangan.
                    </div>
                    <div class="asal-langkah">
                        <strong>Didapat dari mana?</strong><br>
                        Bentuk ini langsung diambil dari soal. Langkah awalnya adalah mengenali dulu bentuk polinomialnya.
                    </div>
                </div>

                <div class="langkah-faktor">
                    <p class="langkah-kecil">Langkah 2: Kenali sebagai selisih dua kubik.</p>
                    <div class="langkah-rumus">
                        $x^3 = (x)^3 \quad \text{dan} \quad 27 = 3^3$
                    </div>
                    <div class="langkah-note">
                        Karena kedua suku berbentuk kubik, maka ini termasuk selisih dua kubik.
                    </div>
                    <div class="asal-langkah">
                        <strong>Didapat dari mana?</strong><br>
                        $x^3$ adalah kubik dari $x$, sedangkan $27 = 3 \times 3 \times 3 = 3^3$.
                        Jadi bentuknya sesuai pola $a^3 - b^3$.
                    </div>
                </div>

                <div class="langkah-faktor">
                    <p class="langkah-kecil">Langkah 3: Gunakan identitas selisih dua kubik.</p>
                    <div class="langkah-rumus">
                        $a^3 - b^3 = (a-b)(a^2 + ab + b^2)$
                    </div>
                    <div class="langkah-note">
                        Rumus ini digunakan karena bentuk soal cocok dengan selisih dua kubik.
                    </div>
                    <div class="asal-langkah">
                        <strong>Didapat dari mana?</strong><br>
                        Ini adalah identitas polinomial yang memang khusus untuk bentuk $a^3 - b^3$.
                    </div>
                </div>

                <div class="langkah-faktor">
                    <p class="langkah-kecil">Langkah 4: Tentukan nilai $a$ dan $b$.</p>
                    <div class="langkah-rumus">
                        $a = x \quad \text{dan} \quad b = 3$
                    </div>
                    <div class="langkah-note">
                        Kita cocokkan $x^3 - 27$ dengan bentuk umum $a^3 - b^3$.
                    </div>
                    <div class="asal-langkah">
                        <strong>Didapat dari mana?</strong><br>
                        Karena $x^3 = (x)^3$, maka $a = x$.
                        Karena $27 = 3^3$, maka $b = 3$.
                    </div>
                </div>

                <div class="langkah-faktor">
                    <p class="langkah-kecil">Langkah 5: Substitusikan ke rumus.</p>
                    <div class="langkah-rumus">
                        $x^3 - 27 = (x-3)(x^2 + 3x + 9)$
                    </div>
                    <div class="langkah-note">
                        Masukkan $a=x$ dan $b=3$ ke dalam identitas selisih dua kubik.
                    </div>
                    <div class="asal-langkah">
                        <strong>Didapat dari mana?</strong><br>
                        Dari:
                        $$
                        a^3 - b^3 = (a-b)(a^2 + ab + b^2)
                        $$
                        ganti $a=x$ dan $b=3$, sehingga diperoleh:
                        $$
                        (x-3)(x^2 + 3x + 9)
                        $$
                    </div>
                </div>

                <div class="langkah-faktor">
                    <p class="langkah-kecil">Langkah 6: Tarik kesimpulan.</p>
                    <div class="kesimpulan-box">
                        <p>Bentuk faktornya adalah:</p>
                        <div class="langkah-rumus">
                            $x^3 - 27 = (x-3)(x^2 + 3x + 9)$
                        </div>
                        <p>Jadi, hasil pemfaktorannya selesai.</p>
                    </div>
                    <div class="asal-langkah">
                        <strong>Didapat dari mana?</strong><br>
                        Hasil ini berasal dari substitusi ke identitas selisih dua kubik.
                    </div>
                </div>
            </div>

            <div class="contoh-actions">
                <button type="button" class="btn-contoh btn-prev" id="btn-prev-faktor">← Sebelumnya</button>
                <button type="button" class="btn-contoh btn-next" id="btn-next-faktor">Langkah Berikutnya →</button>
                <button type="button" class="btn-contoh btn-reset" id="btn-reset-faktor">Ulangi</button>
            </div>

            <div class="langkah-indikator" id="indikator-faktor">Langkah 1 dari 6</div>
        </div>

        <div class="latihan-modern-wrap" id="mari-mencoba-modern">
            <div class="latihan-modern-card">
                <div class="latihan-modern-badge">MARI MENCOBA</div>

                <div class="latihan-modern-soal">
                    Faktorkan polinomial: <br>
                    $x^3 - 27$
                </div>

                <div class="latihan-modern-subtitle">Langkah Interaktif:</div>

                <!-- STEP 1 -->
                <div class="step-panel" id="step1">
                    <div class="step-title">Langkah 1 – Mengenali bentuk polinomial</div>
                    <div class="step-desc">
                        Bentuk $x^3 - 27$ termasuk ke dalam pola apa?
                    </div>

                    <div class="step-input-row">
                        <input type="text" id="input-step1" class="step-input" placeholder="Contoh: selisih dua kubik">
                        <button type="button" class="step-btn" id="btn-step1">Periksa Jawaban</button>
                    </div>

                    <div class="step-feedback" id="feed-step1"></div>
                    <div class="step-answer-box" id="explain-step1">
                        <strong>Penjelasan:</strong><br>
                        Karena $x^3 = (x)^3$ dan $27 = 3^3$, maka bentuk
                        $x^3 - 27$ adalah <strong>selisih dua kubik</strong>.
                    </div>
                </div>

                <!-- STEP 2 -->
                <div class="step-panel" id="step2">
                    <div class="step-title">Langkah 2 – Menentukan nilai $a$ dan $b$</div>
                    <div class="step-desc">
                        Jika $x^3 - 27$ dicocokkan dengan bentuk $a^3 - b^3$, maka nilai $a$ dan $b$ adalah?
                        Tulis dalam format: <b>a=x, b=3</b>
                    </div>

                    <div class="step-input-row">
                        <input type="text" id="input-step2" class="step-input" placeholder="Contoh: a=x, b=3">
                        <button type="button" class="step-btn" id="btn-step2">Periksa Jawaban</button>
                    </div>

                    <div class="step-feedback" id="feed-step2"></div>
                    <div class="step-answer-box" id="explain-step2">
                        <strong>Penjelasan:</strong><br>
                        Karena $x^3 = (x)^3$, maka $a=x$. Karena $27=3^3$, maka $b=3$.
                    </div>
                </div>

                <!-- STEP 3 -->
                <div class="step-panel" id="step3">
                    <div class="step-title">Langkah 3 – Menuliskan identitas yang digunakan</div>
                    <div class="step-desc">
                        Tuliskan rumus identitas untuk selisih dua kubik.
                    </div>

                    <div class="step-input-row">
                        <input type="text" id="input-step3" class="step-input"
                            placeholder="Contoh: a^3-b^3=(a-b)(a^2+ab+b^2)">
                        <button type="button" class="step-btn" id="btn-step3">Periksa Jawaban</button>
                    </div>

                    <div class="step-feedback" id="feed-step3"></div>
                    <div class="step-answer-box" id="explain-step3">
                        <strong>Penjelasan:</strong><br>
                        Identitas selisih dua kubik adalah:
                        $$
                        a^3 - b^3 = (a-b)(a^2+ab+b^2)
                        $$
                    </div>
                </div>

                <!-- STEP 4 -->
                <div class="step-panel" id="step4">
                    <div class="step-title">Langkah 4 – Hasil faktorisasi</div>
                    <div class="step-desc">
                        Sekarang tuliskan hasil faktorisasi dari $x^3 - 27$.
                    </div>

                    <div class="step-input-row">
                        <input type="text" id="input-step4" class="step-input" placeholder="Tulis hasil faktorisasi">
                        <button type="button" class="step-btn" id="btn-step4">Periksa Jawaban</button>
                    </div>

                    <div class="step-feedback" id="feed-step4"></div>
                    <div class="step-answer-box" id="explain-step4">
                        <strong>Penjelasan:</strong><br>
                        Dengan mensubstitusikan $a=x$ dan $b=3$ ke rumus
                        $a^3-b^3=(a-b)(a^2+ab+b^2)$, diperoleh:
                        $$
                        x^3 - 27 = (x-3)(x^2+3x+9)
                        $$
                    </div>
                </div>
            </div>
        </div>
        <script>
            (function () {
                const langkah = Array.from(document.querySelectorAll('#contoh-identitas .langkah-item'));
                const btnPrev = document.getElementById('btn-prev-langkah');
                const btnNext = document.getElementById('btn-next-langkah');
                const btnReset = document.getElementById('btn-reset-langkah');
                const indikator = document.getElementById('indikator-langkah');

                if (!langkah.length) return;

                let index = 0;

                function renderLangkah() {
                    langkah.forEach((item, i) => {
                        item.classList.toggle('active', i === index);
                    });

                    indikator.textContent = `Langkah ${index + 1} dari ${langkah.length}`;

                    btnPrev.disabled = index === 0;
                    btnPrev.style.opacity = index === 0 ? '.5' : '1';

                    btnNext.disabled = index === langkah.length - 1;
                    btnNext.style.opacity = index === langkah.length - 1 ? '.5' : '1';
                }

                btnNext?.addEventListener('click', function () {
                    if (index < langkah.length - 1) {
                        index++;
                        renderLangkah();
                    }
                });

                btnPrev?.addEventListener('click', function () {
                    if (index > 0) {
                        index--;
                        renderLangkah();
                    }
                });

                btnReset?.addEventListener('click', function () {
                    index = 0;
                    renderLangkah();
                });

                renderLangkah();
            })();

            (function () {
                const quizItems = document.querySelectorAll('.eksplorasi-quiz-item');

                quizItems.forEach((item) => {
                    const correctAnswer = item.dataset.correct;
                    const options = item.querySelectorAll('.eksplorasi-opsi');
                    const feedback = item.querySelector('.eksplorasi-feedback');
                    const explanation = item.querySelector('.eksplorasi-penjelasan');

                    options.forEach((option) => {
                        option.addEventListener('click', function () {
                            const selected = this.dataset.value;

                            options.forEach((btn) => {
                                btn.classList.remove('benar', 'salah');
                                btn.disabled = false;
                            });

                            explanation.classList.remove('show');
                            feedback.className = 'eksplorasi-feedback show';

                            if (selected === correctAnswer) {
                                this.classList.add('benar');
                                feedback.classList.add('benar');
                                feedback.innerHTML = '✔ Jawabanmu benar.';
                                explanation.classList.add('show');
                            } else {
                                this.classList.add('salah');
                                feedback.classList.add('salah');
                                feedback.innerHTML = '✘ Jawabanmu belum tepat. Coba perhatikan kembali pola bentuk aljabarnya.';
                            }

                            if (typeof renderMathInElement === 'function') {
                                renderMathInElement(item, {
                                    delimiters: [
                                        { left: '$$', right: '$$', display: true },
                                        { left: '$', right: '$', display: false }
                                    ]
                                });
                            }
                        });
                    });
                });
            })();

            (function () {
                const btnCek = document.getElementById('cek-jawaban-faktorisasi');
                const btnUlang = document.getElementById('ulangi-faktorisasi');
                const input = document.getElementById('jawaban-faktorisasi');
                const penjelasan = document.getElementById('penjelasan-faktorisasi');
                const langkahBox = document.getElementById('langkah-jawaban-faktorisasi');
                const quizItem = document.getElementById('quiz-faktorisasi-item');

                if (!btnCek || !btnUlang || !input || !penjelasan || !langkahBox || !quizItem) return;

                function normalisasiJawaban(teks) {
                    return teks
                        .replace(/\s+/g, '')
                        .replace(/\*/g, '')
                        .toLowerCase();
                }

                btnCek.addEventListener('click', function () {
                    const jawaban = normalisasiJawaban(input.value);
                    const benar1 = normalisasiJawaban('(x+4)(x-4)');
                    const benar2 = normalisasiJawaban('(x-4)(x+4)');

                    quizItem.classList.remove('benar', 'salah');
                    penjelasan.style.display = 'block';
                    langkahBox.style.display = 'block';

                    if (jawaban === benar1 || jawaban === benar2) {
                        quizItem.classList.add('benar');
                        penjelasan.innerHTML = `
                                                                ✔ <b>Benar!</b> Jawabanmu tepat.
                                                                Bentuk $x^2 - 16$ adalah <b>selisih dua kuadrat</b> karena
                                                                $16 = 4^2$, sehingga:
                                                                $$x^2 - 16 = x^2 - 4^2 = (x+4)(x-4).$$
                                                                Jadi faktorisasi yang benar adalah <b>$(x+4)(x-4)$</b>
                                                                atau <b>$(x-4)(x+4)$</b>.
                                                            `;
                    } else {
                        quizItem.classList.add('salah');
                        penjelasan.innerHTML = `
                                                                ✘ <b>Jawabanmu belum tepat.</b>
                                                                Bentuk $x^2 - 16$ harus dikenali sebagai:
                                                                $$x^2 - 16 = x^2 - 4^2$$
                                                                lalu gunakan identitas:
                                                                $$a^2 - b^2 = (a+b)(a-b)$$
                                                                sehingga hasil yang benar adalah:
                                                                $$x^2 - 16 = (x+4)(x-4).$$
                                                            `;
                    }

                    if (typeof renderMathInElement === 'function') {
                        renderMathInElement(document.getElementById('mari-mencoba-faktorisasi'), {
                            delimiters: [
                                { left: '$$', right: '$$', display: true },
                                { left: '$', right: '$', display: false }
                            ]
                        });
                    }
                });

                btnUlang.addEventListener('click', function () {
                    input.value = '';
                    penjelasan.innerHTML = '';
                    penjelasan.style.display = 'none';
                    langkahBox.style.display = 'none';
                    quizItem.classList.remove('benar', 'salah');

                    if (typeof renderMathInElement === 'function') {
                        renderMathInElement(document.getElementById('mari-mencoba-faktorisasi'), {
                            delimiters: [
                                { left: '$$', right: '$$', display: true },
                                { left: '$', right: '$', display: false }
                            ]
                        });
                    }
                });
            })();

            (function () {
                const langkahFaktor = Array.from(document.querySelectorAll('#contoh-faktorisasi .langkah-faktor'));
                const btnPrevFaktor = document.getElementById('btn-prev-faktor');
                const btnNextFaktor = document.getElementById('btn-next-faktor');
                const btnResetFaktor = document.getElementById('btn-reset-faktor');
                const indikatorFaktor = document.getElementById('indikator-faktor');

                if (!langkahFaktor.length) return;

                let indexFaktor = 0;

                function renderLangkahFaktor() {
                    langkahFaktor.forEach((item, i) => {
                        item.classList.toggle('active', i === indexFaktor);
                    });

                    indikatorFaktor.textContent = `Langkah ${indexFaktor + 1} dari ${langkahFaktor.length}`;

                    btnPrevFaktor.disabled = indexFaktor === 0;
                    btnPrevFaktor.style.opacity = indexFaktor === 0 ? '.5' : '1';

                    btnNextFaktor.disabled = indexFaktor === langkahFaktor.length - 1;
                    btnNextFaktor.style.opacity = indexFaktor === langkahFaktor.length - 1 ? '.5' : '1';

                    if (typeof renderMathInElement === 'function') {
                        renderMathInElement(document.getElementById('contoh-faktorisasi'), {
                            delimiters: [
                                { left: '$$', right: '$$', display: true },
                                { left: '$', right: '$', display: false }
                            ]
                        });
                    }
                }

                btnNextFaktor?.addEventListener('click', function () {
                    if (indexFaktor < langkahFaktor.length - 1) {
                        indexFaktor++;
                        renderLangkahFaktor();
                    }
                });

                btnPrevFaktor?.addEventListener('click', function () {
                    if (indexFaktor > 0) {
                        indexFaktor--;
                        renderLangkahFaktor();
                    }
                });

                btnResetFaktor?.addEventListener('click', function () {
                    indexFaktor = 0;
                    renderLangkahFaktor();
                });

                renderLangkahFaktor();
            })();

            (function () {
                const btnCek = document.getElementById('cek-jawaban');
                const btnUlang = document.getElementById('ulangi');
                const btnNext = document.getElementById('next-step');

                const input = document.getElementById('jawaban');
                const penjelasan = document.querySelector('.penjelasan');
                const langkahBox = document.getElementById('langkah-jawaban');
                const langkah = document.querySelectorAll('#langkah-jawaban .langkah-item');

                let index = 0;

                btnCek.addEventListener('click', function () {
                    const jawaban = input.value.replace(/\s/g, '');
                    const benar1 = "(x+4)(x-4)";
                    const benar2 = "(x-4)(x+4)";

                    if (jawaban === benar1 || jawaban === benar2) {
                        penjelasan.innerHTML = "✔ Benar! Ini adalah selisih dua kuadrat.";
                        penjelasan.style.color = "green";
                    } else {
                        penjelasan.innerHTML = "✘ Salah! Coba lagi. Gunakan konsep selisih dua kuadrat.";
                        penjelasan.style.color = "red";
                    }

                    langkahBox.style.display = "block";
                });

                btnNext.addEventListener('click', function () {
                    langkah.forEach((l, i) => {
                        l.classList.remove('active');
                        if (i === index) l.classList.add('active');
                    });

                    if (index < langkah.length - 1) {
                        index++;
                    }
                });

                btnUlang.addEventListener('click', function () {
                    input.value = "";
                    penjelasan.innerHTML = "";
                    langkahBox.style.display = "none";
                    index = 0;
                    langkah.forEach(l => l.classList.remove('active'));
                    langkah[0].classList.add('active');
                });
            })();

            (function () {
                function normalize(text) {
                    return text
                        .toLowerCase()
                        .replace(/\s+/g, '')
                        .replace(/\*/g, '')
                        .replace(/[()]/g, '');
                }

                function aktifkanStep(stepNumber) {
                    const panel = document.getElementById(`step${stepNumber}`);
                    const input = document.getElementById(`input-step${stepNumber}`);
                    const btn = document.getElementById(`btn-step${stepNumber}`);

                    if (panel) panel.classList.remove('locked');
                    if (input) input.disabled = false;
                    if (btn) btn.disabled = false;
                }

                function setFeedback(step, status, message) {
                    const feed = document.getElementById(`feed-step${step}`);
                    const explain = document.getElementById(`explain-step${step}`);

                    feed.className = 'step-feedback ' + status;
                    feed.innerHTML = message;

                    if (status === 'benar') {
                        explain.classList.add('show');
                    } else {
                        explain.classList.remove('show');
                    }

                    if (typeof renderMathInElement === 'function') {
                        renderMathInElement(document.getElementById('mari-mencoba-modern'), {
                            delimiters: [
                                { left: '$$', right: '$$', display: true },
                                { left: '$', right: '$', display: false }
                            ]
                        });
                    }
                }

                // STEP 1
                document.getElementById('btn-step1')?.addEventListener('click', function () {
                    const val = normalize(document.getElementById('input-step1').value);

                    if (
                        val.includes('selisihduakubik') ||
                        val.includes('selisihkubik')
                    ) {
                        setFeedback(1, 'benar', '✔ Benar! Bentuk $x^3 - 27$ adalah selisih dua kubik.');
                        aktifkanStep(2);
                    } else {
                        setFeedback(1, 'salah', '✘ Belum tepat. Coba perhatikan bahwa $27 = 3^3$.');
                    }
                });

                // STEP 2
                document.getElementById('btn-step2')?.addEventListener('click', function () {
                    const val = normalize(document.getElementById('input-step2').value);

                    const benarA = val.includes('a=x') && val.includes('b=3');
                    const benarB = val.includes('b=3') && val.includes('a=x');

                    if (benarA || benarB) {
                        setFeedback(2, 'benar', '✔ Benar! Nilainya adalah $a=x$ dan $b=3$.');
                        aktifkanStep(3);
                    } else {
                        setFeedback(2, 'salah', '✘ Belum tepat. Cocokkan $x^3 - 27$ dengan bentuk $a^3 - b^3$.');
                    }
                });

                // STEP 3
                document.getElementById('btn-step3')?.addEventListener('click', function () {
                    const val = normalize(document.getElementById('input-step3').value);
                    const opsi1 = normalize('(a-b)(a^2+ab+b^2)');
                    const opsi2 = normalize('a^3-b^3=(a-b)(a^2+ab+b^2)');

                    if (val === opsi1 || val === opsi2 || val.includes('a-b') && val.includes('a^2+ab+b^2')) {
                        setFeedback(3, 'benar', '✔ Benar! Itulah identitas selisih dua kubik.');
                        aktifkanStep(4);
                    } else {
                        setFeedback(3, 'salah', '✘ Belum tepat. Ingat rumus: $a^3 - b^3 = (a-b)(a^2+ab+b^2)$.');
                    }
                });

                // STEP 4
                document.getElementById('btn-step4')?.addEventListener('click', function () {
                    const val = normalize(document.getElementById('input-step4').value);
                    const benar1 = normalize('(x-3)(x^2+3x+9)');
                    const benar2 = normalize('(x^2+3x+9)(x-3)');

                    if (val === benar1 || val === benar2) {
                        setFeedback(4, 'benar', '✔ Benar! Hasil faktorisasinya tepat.');
                        document.getElementById('latihan-final-note')?.classList.add('show');
                    } else {
                        setFeedback(4, 'salah', '✘ Jawaban belum tepat. Coba substitusi $a=x$ dan $b=3$ ke rumus.');
                    }
                });
            })();

            (function () {
                function normalize(text) {
                    return text
                        .toLowerCase()
                        .replace(/\s+/g, '')
                        .replace(/\*/g, '')
                        .replace(/[()]/g, '');
                }

                function tampilkan(step, status, pesan) {
                    const feed = document.getElementById(`feed-step${step}`);
                    const explain = document.getElementById(`explain-step${step}`);

                    feed.className = 'step-feedback ' + status;
                    feed.innerHTML = pesan;
                    explain.classList.add('show');

                    if (typeof renderMathInElement === 'function') {
                        renderMathInElement(document.getElementById('mari-mencoba-modern'), {
                            delimiters: [
                                { left: '$$', right: '$$', display: true },
                                { left: '$', right: '$', display: false }
                            ]
                        });
                    }
                }

                document.getElementById('btn-step1')?.addEventListener('click', function () {
                    const val = normalize(document.getElementById('input-step1').value);

                    if (val.includes('selisihduakubik') || val.includes('selisihkubik')) {
                        tampilkan(1, 'benar', '✔ Benar! $x^3 - 27$ adalah bentuk selisih dua kubik.');
                    } else {
                        tampilkan(1, 'salah', '✘ Belum tepat. Petunjuk: $27 = 3^3$, jadi bentuknya adalah selisih dua kubik.');
                    }
                });

                document.getElementById('btn-step2')?.addEventListener('click', function () {
                    const val = normalize(document.getElementById('input-step2').value);
                    const benar = (val.includes('a=x') && val.includes('b=3')) || (val.includes('b=3') && val.includes('a=x'));

                    if (benar) {
                        tampilkan(2, 'benar', '✔ Benar! Nilainya adalah $a=x$ dan $b=3$.');
                    } else {
                        tampilkan(2, 'salah', '✘ Belum tepat. Cocokkan $x^3 - 27$ dengan bentuk $a^3 - b^3$.');
                    }
                });

                document.getElementById('btn-step3')?.addEventListener('click', function () {
                    const val = normalize(document.getElementById('input-step3').value);

                    if (val.includes('a^3-b^3=') && val.includes('a-b') && val.includes('a^2+ab+b^2')) {
                        tampilkan(3, 'benar', '✔ Benar! Itu adalah identitas selisih dua kubik.');
                    } else if (val.includes('a-b') && val.includes('a^2+ab+b^2')) {
                        tampilkan(3, 'benar', '✔ Benar! Bentuk faktor yang kamu tulis sudah sesuai.');
                    } else {
                        tampilkan(3, 'salah', '✘ Belum tepat. Rumusnya adalah $a^3 - b^3 = (a-b)(a^2+ab+b^2)$.');
                    }
                });

                document.getElementById('btn-step4')?.addEventListener('click', function () {
                    const val = normalize(document.getElementById('input-step4').value);
                    const benar1 = normalize('(x-3)(x^2+3x+9)');
                    const benar2 = normalize('(x^2+3x+9)(x-3)');

                    if (val === benar1 || val === benar2) {
                        tampilkan(4, 'benar', '✔ Benar! Hasil faktorisasi sudah tepat.');
                    } else {
                        tampilkan(4, 'salah', '✘ Jawaban belum tepat. Gunakan $a=x$ dan $b=3$ pada rumus selisih dua kubik.');
                    }
                });
            })();
        </script>
@endsection

    @section('nav')
        <a href="{{ route('kuisd') }}" class="btn-nav prev-btn">
            ← Previous
        </a>

        <a href="{{ route('kuise') }}" class="btn-nav next-btn">
            Next →
        </a>
    @endsection