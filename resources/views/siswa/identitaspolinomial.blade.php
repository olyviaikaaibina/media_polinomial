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
            left: 20px;
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
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #7d7d7d, #9a9a9a);
            color: #fff;
            font-size: 20px;
            font-weight: 800;
            padding: 12px 30px;
            border-radius: 999px;
            margin-bottom: 16px;
            letter-spacing: .4px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, .12);
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

        /* =========================
                                                                                                                                                                               LATIHAN DRAG & DROP
                                                                                                                                                                            ========================= */
        .latihan-drag-wrap {
            margin-top: 38px;
        }

        .latihan-drag-header {
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

        .latihan-drag-card {
            border: 2px solid #2997d3;
            background: #fff;
            padding: 20px 16px 24px;
            border-radius: 16px;
        }

        .latihan-drag-intro {
            margin: 0 0 20px 0;
            font-size: 16px;
            line-height: 1.7;
            color: #333;
        }

        .latihan-drag-section {
            margin-top: 18px;
            padding: 18px 16px;
            border-radius: 16px;
            background: #f8fcff;
            border: 1px solid #d7ecf8;
        }

        .latihan-drag-title {
            font-size: 18px;
            font-weight: 800;
            color: #0f4e72;
            margin-bottom: 16px;
        }

        .drag-area-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
            margin-bottom: 16px;
        }

        .drag-dropzone {
            border: 2px dashed #b8cad6;
            border-radius: 16px;
            background: #f9f9f9;
            min-height: 145px;
            padding: 14px;
            transition: .2s ease;
        }

        .drag-dropzone.over,
        .pair-target.over {
            background: #eef8ff;
            border-color: #2997d3;
        }

        .drag-dropzone-title {
            font-size: 15px;
            font-weight: 800;
            color: #295b77;
            margin-bottom: 10px;
        }

        .drag-dropzone-body {
            min-height: 80px;
        }

        .drag-bank {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            padding: 14px;
            background: #fffaf5;
            border: 1px dashed #e4c8b0;
            border-radius: 14px;
        }

        .drag-bank.vertical {
            flex-direction: column;
        }

        .drag-item {
            background: #fff;
            border: 1.5px solid #d9d9d9;
            border-radius: 14px;
            padding: 12px 14px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, .04);
            cursor: grab;
            transition: .18s ease;
            user-select: none;
        }

        .drag-item:hover {
            transform: translateY(-2px);
        }

        .drag-item.dragging {
            opacity: .45;
        }

        .drag-number {
            width: 28px;
            height: 28px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #eaf6ea;
            color: #1b7a2a;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .drag-math {
            font-size: 18px;
            line-height: 1.5;
        }

        .pair-grid {
            display: grid;
            grid-template-columns: 1.15fr .85fr;
            gap: 16px;
        }

        .pair-heading {
            font-size: 15px;
            font-weight: 800;
            color: #2f8b3a;
            margin-bottom: 12px;
        }

        .pair-target {
            background: #fff;
            border: 2px dashed #cfcfcf;
            border-radius: 16px;
            padding: 14px;
            min-height: 100px;
            margin-bottom: 12px;
            transition: .2s ease;
        }

        .pair-soal {
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .pair-slot-text {
            font-size: 14px;
            color: #777;
        }

        .drag-action-row {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .drag-btn {
            border: none;
            border-radius: 10px;
            padding: 10px 16px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: .15s ease;
            background: #e9ecef;
            color: #222;
        }

        .drag-btn:hover {
            transform: translateY(-1px);
        }

        .drag-btn-primary {
            background: #2997d3;
            color: #fff;
        }

        .drag-feedback,
        .drag-summary {
            display: none;
            margin-top: 14px;
            padding: 12px 14px;
            border-radius: 12px;
            font-size: 15px;
            line-height: 1.7;
        }

        .drag-feedback.show,
        .drag-summary.show {
            display: block;
        }

        .drag-feedback.ok,
        .drag-summary.ok {
            background: #e3f6e7;
            border: 1px solid #5ea86a;
            color: #1f5f2a;
        }

        .drag-feedback.no,
        .drag-summary.no {
            background: #fde8e8;
            border: 1px solid #d16c6c;
            color: #8a2525;
        }

        @media (max-width: 768px) {

            .drag-area-row,
            .pair-grid {
                grid-template-columns: 1fr;
            }

            .drag-math,
            .pair-soal {
                font-size: 16px;
            }

            .latihan-drag-header {
                font-size: 17px;
                padding: 9px 26px;
            }
        }

        .latihan-drag-wrap {
            margin-top: 38px;
        }

        .latihan-drag-header {
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

        .latihan-drag-card {
            border: 2px solid #2997d3;
            background: #fff;
            padding: 20px 16px 24px;
            border-radius: 16px;
        }

        .latihan-drag-intro {
            margin: 0 0 20px 0;
            font-size: 16px;
            line-height: 1.7;
            color: #333;
        }

        .latihan-drag-section {
            margin-top: 18px;
            padding: 18px 16px;
            border-radius: 16px;
            background: #f8fcff;
            border: 1px solid #d7ecf8;
        }

        .latihan-drag-title {
            font-size: 18px;
            font-weight: 800;
            color: #0f4e72;
            margin-bottom: 16px;
        }

        .drag-area-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
            margin-bottom: 16px;
        }

        .drag-dropzone {
            border: 2px dashed #b8cad6;
            border-radius: 16px;
            background: #f9f9f9;
            min-height: 145px;
            padding: 14px;
            transition: .2s ease;
        }

        .drag-dropzone.over {
            background: #eef8ff;
            border-color: #2997d3;
        }

        .drag-dropzone-title {
            font-size: 15px;
            font-weight: 800;
            color: #295b77;
            margin-bottom: 10px;
        }

        .drag-dropzone-body {
            min-height: 80px;
        }

        .drag-bank {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            padding: 14px;
            background: #fffaf5;
            border: 1px dashed #e4c8b0;
            border-radius: 14px;
        }

        .drag-item {
            background: #fff;
            border: 1.5px solid #d9d9d9;
            border-radius: 14px;
            padding: 12px 14px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, .04);
            cursor: grab;
            transition: .18s ease;
            user-select: none;
            width: calc(50% - 6px);
        }

        .drag-item:hover {
            transform: translateY(-2px);
        }

        .drag-item.dragging {
            opacity: .45;
        }

        .drag-number {
            width: 28px;
            height: 28px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #eaf6ea;
            color: #1b7a2a;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .drag-math {
            font-size: 18px;
            line-height: 1.5;
        }

        .drag-action-row {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 18px;
        }

        .drag-btn {
            border: none;
            border-radius: 10px;
            padding: 10px 16px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: .15s ease;
            background: #e9ecef;
            color: #222;
        }

        .drag-btn:hover {
            transform: translateY(-1px);
        }

        .drag-btn-primary {
            background: #2997d3;
            color: #fff;
        }

        .drag-feedback,
        .drag-summary {
            display: none;
            margin-top: 14px;
            padding: 12px 14px;
            border-radius: 12px;
            font-size: 15px;
            line-height: 1.7;
        }

        .drag-feedback.show,
        .drag-summary.show {
            display: block;
        }

        .drag-feedback.ok,
        .drag-summary.ok {
            background: #e3f6e7;
            border: 1px solid #5ea86a;
            color: #1f5f2a;
        }

        .drag-feedback.no,
        .drag-summary.no {
            background: #fde8e8;
            border: 1px solid #d16c6c;
            color: #8a2525;
        }

        @media (max-width: 768px) {
            .drag-area-row {
                grid-template-columns: 1fr;
            }

            .drag-item {
                width: 100%;
            }

            .drag-math {
                font-size: 16px;
            }

            .latihan-drag-header {
                font-size: 17px;
                padding: 9px 26px;
            }
        }

        /* =========================
                                                                                                                                                    SIFAT INTERAKTIF MODERN
                                                                                                                                                    ========================= */
        .sifat-interaktif {
            margin: 30px 0;
            padding: 26px 22px 24px;
            border-radius: 28px;
            background:
                radial-gradient(circle at top right, rgba(255, 214, 165, .35), transparent 28%),
                linear-gradient(180deg, #fffdf8 0%, #fff 100%);
            border: 2px solid #4aa12f;
            box-shadow: 0 14px 30px rgba(0, 0, 0, .05);
            position: relative;
            overflow: hidden;
        }

        .sifat-header-modern {
            margin-bottom: 18px;
        }

        .sifat-badge-modern {
            display: inline-block;
            background: linear-gradient(135deg, #efb39f, #ffd5b8);
            border: 2px solid #e0702b;
            color: #2d2d2d;
            font-weight: 800;
            font-size: 14px;
            padding: 8px 18px;
            border-radius: 999px;
            margin-bottom: 12px;
            letter-spacing: .5px;
        }

        .sifat-title-modern {
            margin: 0 0 6px 0;
            font-size: 28px;
            color: #226b2d;
            font-weight: 900;
        }

        .sifat-subtitle-modern {
            margin: 0;
            font-size: 16px;
            color: #555;
            line-height: 1.7;
        }

        .sifat-top-controls {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            align-items: center;
            margin: 18px 0 20px;
        }

        .sifat-tabs {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .sifat-tab {
            border: none;
            border-radius: 999px;
            padding: 10px 16px;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            background: #f1f5ef;
            color: #35533a;
            transition: .2s ease;
        }

        .sifat-tab:hover {
            transform: translateY(-1px);
        }

        .sifat-tab.active {
            background: linear-gradient(135deg, #2f8b3a, #55a94f);
            color: #fff;
            box-shadow: 0 6px 16px rgba(47, 139, 58, .2);
        }

        .sifat-random-btn {
            border: none;
            border-radius: 999px;
            padding: 10px 18px;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            background: linear-gradient(135deg, #f8c37d, #e79a48);
            color: #3b2a12;
            transition: .2s ease;
        }

        .sifat-random-btn:hover {
            transform: translateY(-1px) scale(1.01);
        }

        .sifat-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 20px;
        }

        .sifat-card-item {
            text-align: left;
            border: 1.5px solid #e5e5e5;
            border-radius: 20px;
            padding: 16px 16px 15px;
            background: #fff;
            cursor: pointer;
            transition: .22s ease;
            position: relative;
            overflow: hidden;
        }

        .sifat-card-item::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(74, 161, 47, .08), rgba(224, 112, 43, .06));
            opacity: 0;
            transition: .22s ease;
        }

        .sifat-card-item:hover::before,
        .sifat-card-item.active::before {
            opacity: 1;
        }

        .sifat-card-item:hover {
            transform: translateY(-3px);
            border-color: #b8d6b0;
            box-shadow: 0 10px 22px rgba(0, 0, 0, .06);
        }

        .sifat-card-item.active {
            border-color: #4aa12f;
            box-shadow: 0 10px 22px rgba(74, 161, 47, .12);
        }

        .sifat-no,
        .sifat-mini,
        .sifat-formula {
            position: relative;
            z-index: 1;
            display: block;
        }

        .sifat-no {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #eaf6ea;
            color: #1b7a2a;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            margin-bottom: 10px;
        }

        .sifat-mini {
            font-size: 15px;
            font-weight: 800;
            color: #2d2d2d;
            margin-bottom: 8px;
        }

        .sifat-formula {
            font-size: 18px;
            color: #1d1d1d;
            line-height: 1.5;
        }

        .sifat-card-item.hidden {
            display: none;
        }

        .sifat-detail-panel {
            border-radius: 24px;
            padding: 20px 18px;
            background: linear-gradient(180deg, #f7fff4 0%, #fff 100%);
            border: 1.5px solid #cde4c7;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, .8);
        }

        .sifat-detail-top {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
            margin-bottom: 10px;
        }

        .sifat-detail-kategori {
            display: inline-block;
            background: #2f8b3a;
            color: #fff;
            font-size: 12px;
            font-weight: 800;
            padding: 6px 12px;
            border-radius: 999px;
            letter-spacing: .5px;
        }

        .sifat-detail-label {
            font-size: 13px;
            color: #666;
            font-weight: 700;
        }

        .sifat-detail-title {
            font-size: 24px;
            margin: 0 0 10px 0;
            color: #21592b;
            font-weight: 900;
        }

        .sifat-detail-rumus {
            font-size: 28px;
            text-align: center;
            padding: 14px 12px;
            border-radius: 18px;
            background: #fff;
            border: 1px dashed #c9d9c2;
            margin-bottom: 16px;
        }

        .sifat-detail-info-wrap {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .sifat-detail-box {
            background: #fff;
            border-radius: 18px;
            padding: 16px;
            border: 1px solid #ececec;
        }

        .sifat-detail-box.contoh {
            border-left: 4px solid #e0702b;
        }

        .sifat-detail-box-title {
            font-size: 15px;
            font-weight: 900;
            margin-bottom: 8px;
            color: #2d2d2d;
        }

        .sifat-detail-box-text {
            font-size: 15px;
            line-height: 1.7;
            color: #4c4c4c;
        }

        .sifat-mini-quiz {
            margin-top: 18px;
            border-radius: 22px;
            padding: 18px 16px;
            background: linear-gradient(135deg, #fff8f2, #fff);
            border: 1px solid #edd8c4;
        }

        .sifat-mini-quiz-title {
            font-size: 18px;
            font-weight: 900;
            color: #8a4f1d;
            margin-bottom: 8px;
        }

        .sifat-mini-quiz-question {
            font-size: 16px;
            margin-bottom: 14px;
            color: #333;
        }

        .sifat-mini-quiz-options {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .mini-quiz-btn {
            border: 1.5px solid #d8d8d8;
            background: #fff;
            border-radius: 14px;
            padding: 11px 14px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 700;
            transition: .18s ease;
        }

        .mini-quiz-btn:hover {
            transform: translateY(-1px);
        }

        .mini-quiz-btn.benar {
            background: #dff5e3;
            border-color: #2f9e44;
            color: #155724;
        }

        .mini-quiz-btn.salah {
            background: #fde2e2;
            border-color: #d6336c;
            color: #842029;
        }

        .sifat-mini-quiz-feedback {
            display: none;
            margin-top: 12px;
            padding: 12px 14px;
            border-radius: 12px;
            font-size: 14px;
            line-height: 1.7;
        }

        .sifat-mini-quiz-feedback.show {
            display: block;
        }

        .sifat-mini-quiz-feedback.benar {
            background: #e3f6e7;
            border: 1px solid #5ea86a;
            color: #1f5f2a;
        }

        .sifat-mini-quiz-feedback.salah {
            background: #fde8e8;
            border: 1px solid #d16c6c;
            color: #8a2525;
        }

        @media (max-width: 768px) {

            .sifat-grid,
            .sifat-detail-info-wrap {
                grid-template-columns: 1fr;
            }

            .sifat-title-modern {
                font-size: 23px;
            }

            .sifat-detail-title {
                font-size: 20px;
            }

            .sifat-detail-rumus {
                font-size: 22px;
            }

            .sifat-formula {
                font-size: 16px;
            }
        }

        /* =========================
                                                                                               SIFAT INTERAKTIF - FINAL
                                                                                               ========================= */

        .sifat-wrapper {
            position: relative;
            margin: 46px 0 30px;
        }

        .sifat-badge-modern {
            position: absolute;
            top: -18px;
            left: 24px;
            z-index: 10;
            display: inline-block;
            background: linear-gradient(135deg, #efb39f, #ffd5b8);
            border: 2px solid #e0702b;
            color: #2d2d2d;
            font-weight: 800;
            font-size: 14px;
            padding: 8px 18px;
            border-radius: 999px;
            letter-spacing: .5px;
            box-shadow: 0 8px 16px rgba(224, 112, 43, .15);
        }

        .sifat-interaktif {
            margin: 0;
            padding: 42px 22px 24px;
            border-radius: 28px;
            background:
                radial-gradient(circle at top right, rgba(255, 214, 165, .25), transparent 26%),
                linear-gradient(180deg, #fffdf8 0%, #fff 100%);
            border: 2px solid #4aa12f;
            box-shadow: 0 14px 30px rgba(0, 0, 0, .05);
            position: relative;
            overflow: hidden;
        }

        /* HEADER */
        .sifat-header-modern {
            margin-bottom: 18px;
        }

        .sifat-title-modern {
            margin: 0 0 6px 0;
            font-size: 28px;
            color: #226b2d;
            font-weight: 900;
            line-height: 1.2;
        }

        .sifat-subtitle-modern {
            margin: 0;
            font-size: 16px;
            color: #555;
            line-height: 1.7;
        }

        /* FILTER */
        .sifat-top-controls {
            display: flex;
            justify-content: flex-start;
            gap: 12px;
            flex-wrap: wrap;
            align-items: center;
            margin: 18px 0 20px;
        }

        .sifat-tabs {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .sifat-tab {
            border: none;
            border-radius: 999px;
            padding: 10px 16px;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            background: #f1f5ef;
            color: #35533a;
            transition: .2s ease;
        }

        .sifat-tab:hover {
            transform: translateY(-1px);
        }

        .sifat-tab.active {
            background: linear-gradient(135deg, #2f8b3a, #55a94f);
            color: #fff;
            box-shadow: 0 6px 16px rgba(47, 139, 58, .2);
        }

        /* GRID */
        .sifat-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 20px;
        }

        .sifat-card-item {
            text-align: left;
            border: 1.5px solid #e5e5e5;
            border-radius: 20px;
            padding: 16px 16px 15px;
            background: #fff;
            cursor: pointer;
            transition: .22s ease;
            position: relative;
            overflow: hidden;
        }

        .sifat-card-item::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(74, 161, 47, .08), rgba(224, 112, 43, .06));
            opacity: 0;
            transition: .22s ease;
        }

        .sifat-card-item:hover::before,
        .sifat-card-item.active::before {
            opacity: 1;
        }

        .sifat-card-item:hover {
            transform: translateY(-3px);
            border-color: #b8d6b0;
            box-shadow: 0 10px 22px rgba(0, 0, 0, .06);
        }

        .sifat-card-item.active {
            border-color: #4aa12f;
            box-shadow: 0 10px 22px rgba(74, 161, 47, .12);
        }

        .sifat-no,
        .sifat-mini,
        .sifat-formula {
            position: relative;
            z-index: 1;
            display: block;
        }

        .sifat-no {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #eaf6ea;
            color: #1b7a2a;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            margin-bottom: 10px;
        }

        .sifat-mini {
            font-size: 15px;
            font-weight: 800;
            color: #2d2d2d;
            margin-bottom: 8px;
        }

        .sifat-formula {
            font-size: 18px;
            color: #1d1d1d;
            line-height: 1.5;
        }

        .sifat-card-item.hidden {
            display: none;
        }

        /* DETAIL PANEL */
        .sifat-detail-panel {
            border-radius: 24px;
            padding: 20px 18px;
            background: linear-gradient(180deg, #f7fff4 0%, #fff 100%);
            border: 1.5px solid #cde4c7;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, .8);
        }

        .sifat-detail-top {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
            margin-bottom: 10px;
        }

        .sifat-detail-kategori {
            display: inline-block;
            background: #2f8b3a;
            color: #fff;
            font-size: 12px;
            font-weight: 800;
            padding: 6px 12px;
            border-radius: 999px;
            letter-spacing: .5px;
        }

        .sifat-detail-label {
            font-size: 13px;
            color: #666;
            font-weight: 700;
        }

        .sifat-detail-title {
            font-size: 24px;
            margin: 0 0 10px 0;
            color: #21592b;
            font-weight: 900;
        }

        .sifat-detail-rumus {
            font-size: 28px;
            text-align: center;
            padding: 14px 12px;
            border-radius: 18px;
            background: #fff;
            border: 1px dashed #c9d9c2;
            margin-bottom: 16px;
        }

        .sifat-detail-info-wrap {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .sifat-detail-box {
            background: #fff;
            border-radius: 18px;
            padding: 16px;
            border: 1px solid #ececec;
        }

        .sifat-detail-box.contoh {
            border-left: 4px solid #e0702b;
        }

        .sifat-detail-box-title {
            font-size: 15px;
            font-weight: 900;
            margin-bottom: 8px;
            color: #2d2d2d;
        }

        .sifat-detail-box-text {
            font-size: 15px;
            line-height: 1.7;
            color: #4c4c4c;
        }

        /* MINI QUIZ */
        .sifat-mini-quiz {
            margin-top: 18px;
            border-radius: 22px;
            padding: 18px 16px;
            background: linear-gradient(135deg, #fff8f2, #fff);
            border: 1px solid #edd8c4;
        }

        .sifat-mini-quiz-title {
            font-size: 18px;
            font-weight: 900;
            color: #8a4f1d;
            margin-bottom: 8px;
        }

        .sifat-mini-quiz-question {
            font-size: 16px;
            margin-bottom: 14px;
            color: #333;
        }

        .sifat-mini-quiz-options {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .mini-quiz-btn {
            border: 1.5px solid #d8d8d8;
            background: #fff;
            border-radius: 14px;
            padding: 11px 14px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 700;
            transition: .18s ease;
        }

        .mini-quiz-btn:hover {
            transform: translateY(-1px);
        }

        .mini-quiz-btn.benar {
            background: #dff5e3;
            border-color: #2f9e44;
            color: #155724;
        }

        .mini-quiz-btn.salah {
            background: #fde2e2;
            border-color: #d6336c;
            color: #842029;
        }

        .sifat-mini-quiz-feedback {
            display: none;
            margin-top: 12px;
            padding: 12px 14px;
            border-radius: 12px;
            font-size: 14px;
            line-height: 1.7;
        }

        .sifat-mini-quiz-feedback.show {
            display: block;
        }

        .sifat-mini-quiz-feedback.benar {
            background: #e3f6e7;
            border: 1px solid #5ea86a;
            color: #1f5f2a;
        }

        .sifat-mini-quiz-feedback.salah {
            background: #fde8e8;
            border: 1px solid #d16c6c;
            color: #8a2525;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sifat-wrapper {
                margin-top: 42px;
            }

            .sifat-badge-modern {
                left: 16px;
                top: -16px;
                font-size: 13px;
                padding: 7px 15px;
            }

            .sifat-interaktif {
                padding: 38px 16px 20px;
            }

            .sifat-grid,
            .sifat-detail-info-wrap {
                grid-template-columns: 1fr;
            }

            .sifat-title-modern {
                font-size: 23px;
            }

            .sifat-detail-title {
                font-size: 20px;
            }

            .sifat-detail-rumus {
                font-size: 22px;
            }

            .sifat-formula {
                font-size: 16px;
            }
        }
    </style>

    <style>
        .mari-mencoba-wrapper {
            margin-top: 36px;
        }

        .mari-header {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #7d7d7d, #9a9a9a);
            color: #fff;
            font-size: 20px;
            font-weight: 800;
            padding: 12px 30px;
            border-radius: 999px;
            margin-bottom: 16px;
            letter-spacing: .4px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, .12);
        }

        .mari-header::before {
            font-size: 18px;
        }

        .mari-card {
            position: relative;
            border: 2px solid #2997d3;
            border-radius: 24px;
            background: linear-gradient(180deg, #ffffff 0%, #f7fcff 100%);
            padding: 22px 18px 24px;
            box-shadow: 0 10px 24px rgba(41, 151, 211, .08);
            overflow: hidden;
        }

        .mari-card::after {
            content: "";
            position: absolute;
            top: -40px;
            right: -40px;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: rgba(41, 151, 211, .08);
        }

        .mari-instruksi {
            position: relative;
            z-index: 1;
            margin: 0 0 20px 0;
            font-size: 16px;
            line-height: 1.7;
            color: #2d2d2d;
            background: #fffef8;
            border: 1px solid #f0e2b7;
            border-radius: 14px;
            padding: 14px 16px;
        }

        .quiz-list {
            display: grid;
            gap: 16px;
            position: relative;
            z-index: 1;
        }

        .quiz-item {
            background: #fff;
            border: 1.5px solid #d9eaf5;
            border-radius: 18px;
            padding: 16px 16px 14px;
            transition: .22s ease;
            box-shadow: 0 6px 14px rgba(0, 0, 0, .03);
        }

        .quiz-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, .05);
        }

        .quiz-item.benar {
            border-color: #3fa95c;
            background: linear-gradient(180deg, #f3fff5 0%, #ebfff0 100%);
        }

        .quiz-item.salah {
            border-color: #e36b6b;
            background: linear-gradient(180deg, #fff7f7 0%, #fff0f0 100%);
        }

        .quiz-head {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .quiz-number {
            width: 36px;
            height: 36px;
            min-width: 36px;
            border-radius: 50%;
            background: #e8f6ff;
            color: #136d9b;
            font-weight: 900;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            box-shadow: inset 0 0 0 1px rgba(41, 151, 211, .18);
        }

        .quiz-item.benar .quiz-number {
            background: #dff5e3;
            color: #1e7c38;
        }

        .quiz-item.salah .quiz-number {
            background: #fde2e2;
            color: #b02a37;
        }

        .soal {
            font-size: 18px;
            line-height: 1.6;
            color: #222;
            margin-top: 3px;
            flex: 1;
        }

        .quiz-options {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            margin-top: 14px;
            margin-left: 48px;
        }

        .quiz-option-label {
            position: relative;
            cursor: pointer;
        }

        .quiz-option-label input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .quiz-option-chip {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 76px;
            padding: 10px 16px;
            border-radius: 999px;
            border: 1.5px solid #cfdce5;
            background: #fff;
            font-size: 15px;
            font-weight: 800;
            color: #344054;
            transition: .18s ease;
        }

        .quiz-option-label:hover .quiz-option-chip {
            transform: translateY(-1px);
            border-color: #7db8d9;
            background: #f7fcff;
        }

        .quiz-option-label input:checked+.quiz-option-chip {
            border-color: #2997d3;
            background: #eaf7ff;
            color: #136d9b;
            box-shadow: 0 0 0 3px rgba(41, 151, 211, .10);
        }

        .penjelasan {
            display: none;
            margin-top: 14px;
            margin-left: 48px;
            padding: 12px 14px;
            border-radius: 12px;
            font-size: 14px;
            line-height: 1.7;
        }

        .quiz-item.benar .penjelasan,
        .quiz-item.salah .penjelasan {
            display: block;
        }

        .quiz-item.benar .penjelasan {
            background: #ffffff;
            border-left: 4px solid #3fa95c;
            color: #1f5f2a;
        }

        .quiz-item.salah .penjelasan {
            background: #ffffff;
            border-left: 4px solid #e36b6b;
            color: #8a2525;
        }

        .quiz-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 20px;
            position: relative;
            z-index: 1;
        }

        .quiz-btn {
            border: none;
            border-radius: 12px;
            padding: 11px 18px;
            font-size: 15px;
            font-weight: 800;
            cursor: pointer;
            transition: .18s ease;
        }

        .quiz-btn:hover {
            transform: translateY(-1px);
        }

        #cek-jawaban {
            background: linear-gradient(135deg, #2997d3, #1f86bd);
            color: #fff;
            box-shadow: 0 8px 16px rgba(41, 151, 211, .18);
        }

        #ulangi {
            background: #eef2f5;
            color: #27323f;
        }

        .hasil-skor {
            display: none;
            margin-top: 18px;
            padding: 14px 16px;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 700;
            line-height: 1.7;
            position: relative;
            z-index: 1;
        }

        .hasil-skor.show {
            display: block;
        }

        .hasil-skor.bagus {
            background: #ecfff0;
            border: 1px solid #8bd0a0;
            color: #1d5e2d;
        }

        .hasil-skor.perlu-lagi {
            background: #fff8eb;
            border: 1px solid #f2cf87;
            color: #855d12;
        }

        @media (max-width: 640px) {
            .mari-header {
                font-size: 17px;
                padding: 10px 22px;
            }

            .mari-card {
                padding: 18px 14px 20px;
            }

            .mari-instruksi,
            .soal,
            .quiz-option-chip,
            .penjelasan,
            .hasil-skor {
                font-size: 14px;
            }

            .quiz-options,
            .penjelasan {
                margin-left: 0;
            }

            .quiz-head {
                gap: 10px;
            }

            .quiz-number {
                width: 32px;
                height: 32px;
                min-width: 32px;
                font-size: 14px;
            }
        }

        .step-panel.locked {
            opacity: .65;
        }

        .step-option-group {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 14px;
        }

        .step-option-btn {
            border: 1px solid #cfc2b4;
            background: #fff;
            color: #5b4b39;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .step-option-btn:hover {
            transform: translateY(-1px);
            background: #fcf7ef;
        }

        .step-option-btn.selected {
            background: #e8f5e9;
            border-color: #4a9c4f;
            color: #2f6e34;
        }

        .step-option-btn.correct {
            background: #dff5e3;
            border-color: #2f9e44;
            color: #155724;
        }

        .step-option-btn.wrong {
            background: #fde8e8;
            border-color: #d16c6c;
            color: #8a2525;
        }

        .step-action-inline {
            margin-top: 14px;
        }

        .step-answer-box.show {
            display: block;
        }

        @media (max-width: 640px) {
            .step-option-group {
                flex-direction: column;
            }

            .step-option-btn {
                width: 100%;
                text-align: left;
            }
        }

        .materi-lanjutan-hidden {
            display: none;
        }

        .materi-lanjutan-hidden.show {
            display: block;
            animation: fadeIn 0.4s ease;
        }

        /* optional biar lebih halus */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* =====================================================
                                                       RESPONSIVE FINAL: HP, TABLET, LAPTOP
                                                       Letakkan PALING BAWAH setelah semua CSS lama
                                                    ===================================================== */

        /* Supaya padding dan lebar elemen tidak bikin overflow */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html,
        body {
            max-width: 100%;
            overflow-x: hidden;
        }

        /* Gambar, tabel, iframe, rumus panjang agar tidak keluar layar */
        img,
        video,
        iframe {
            max-width: 100%;
            height: auto;
        }

        .formula-center,
        .langkah-rumus,
        .contoh-rumus,
        .identitas-rumus,
        .sifat-detail-rumus,
        .drag-math,
        .pair-soal {
            max-width: 100%;
            overflow-x: auto;
            overflow-y: hidden;
            white-space: normal;
            word-break: break-word;
        }

        /* Wrapper utama */
        .materi-wrap {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
        }

        /* =====================================================
                                                       LAPTOP / DESKTOP
                                                       1025px ke atas
                                                    ===================================================== */
        @media (min-width: 1025px) {
            .materi-wrap {
                padding: 24px 24px 48px;
            }

            .top-title {
                flex-direction: row;
                align-items: baseline;
            }

            .top-title .label {
                font-size: 28px;
            }

            .top-title .judul {
                font-size: 32px;
            }

            .section-title {
                font-size: 28px;
            }

            .sifat-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .sifat-detail-info-wrap {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .drag-area-row {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .pair-grid {
                grid-template-columns: 1.15fr .85fr;
            }

            .drag-item {
                width: calc(50% - 6px);
            }
        }

        /* =====================================================
                                                       TABLET
                                                       641px - 1024px
                                                    ===================================================== */
        @media (min-width: 641px) and (max-width: 1024px) {
            .materi-wrap {
                max-width: 92%;
                padding: 22px 18px 44px;
            }

            .top-title {
                gap: 10px;
                flex-wrap: wrap;
            }

            .top-title .label {
                font-size: 25px;
            }

            .top-title .judul {
                font-size: 28px;
            }

            .tujuan-card,
            .eksplorasi-card,
            .contoh-card,
            .mari-card,
            .latihan-modern-card,
            .latihan-drag-card,
            .sifat-interaktif {
                padding-left: 18px;
                padding-right: 18px;
            }

            .section-title {
                font-size: 25px;
            }

            .materi-paragraf p,
            .tujuan-card li,
            .sifat-text,
            .contoh-card p,
            .lanjutan-paragraf p,
            .mari-instruksi,
            .latihan-drag-intro {
                font-size: 16px;
            }

            .sifat-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .sifat-detail-info-wrap {
                grid-template-columns: 1fr;
            }

            .sifat-title-modern {
                font-size: 25px;
            }

            .sifat-detail-title {
                font-size: 22px;
            }

            .sifat-detail-rumus {
                font-size: 24px;
            }

            .drag-area-row,
            .pair-grid {
                grid-template-columns: 1fr;
            }

            .drag-bank {
                gap: 10px;
            }

            .drag-item {
                width: calc(50% - 5px);
            }

            .quiz-options {
                margin-left: 48px;
            }

            .step-input {
                min-width: 260px;
            }

            .eksplorasi-opsi {
                min-width: calc(50% - 8px);
            }
        }

        /* =====================================================
                                                       HP / MOBILE
                                                       640px ke bawah
                                                    ===================================================== */
        @media (max-width: 640px) {
            .materi-wrap {
                max-width: 100%;
                padding: 16px 12px 36px;
                line-height: 1.6;
            }

            .top-title {
                flex-direction: row;
                align-items: flex-start;
                gap: 8px;
                margin-bottom: 14px;
            }

            .top-title .label {
                font-size: 21px;
                line-height: 1.2;
            }

            .top-title .judul {
                font-size: 23px;
                line-height: 1.25;
            }

            .tujuan-card {
                padding: 14px 14px;
                margin-bottom: 22px;
            }

            .tujuan-header .title {
                font-size: 18px;
            }

            .tujuan-card ol {
                padding-left: 18px;
            }

            .tujuan-card li {
                font-size: 15px;
                text-align: left;
            }

            .section-title {
                font-size: 21px;
                line-height: 1.3;
            }

            .eksplorasi-card {
                border-radius: 20px;
                padding: 20px 14px 18px;
            }

            .eksplorasi-title {
                font-size: 18px;
            }

            .materi-paragraf p,
            .lanjutan-paragraf p,
            .definisi-text,
            .sifat-text,
            .contoh-card p,
            .langkah-kecil,
            .langkah-note,
            .asal-langkah,
            .mari-instruksi,
            .latihan-modern-intro,
            .latihan-drag-intro {
                font-size: 14px;
                text-align: left;
            }

            .formula-center,
            .identitas-rumus,
            .contoh-rumus,
            .langkah-rumus {
                font-size: 18px;
                line-height: 1.6;
            }

            .definisi-block {
                padding: 32px 12px 16px;
                margin-top: 22px;
            }

            .definisi-pill,
            .contoh-badge,
            .sifat-badge,
            .latihan-modern-badge,
            .sifat-badge-modern {
                left: 12px;
                min-width: auto;
                font-size: 13px;
                padding: 7px 14px;
            }

            .sifat-card,
            .contoh-card,
            .latihan-modern-card,
            .latihan-drag-card,
            .mari-card {
                border-radius: 18px;
                padding-left: 12px;
                padding-right: 12px;
            }

            .sifat-wrapper {
                margin-top: 38px;
            }

            .sifat-interaktif {
                border-radius: 22px;
                padding: 36px 12px 18px;
            }

            .sifat-title-modern {
                font-size: 21px;
            }

            .sifat-subtitle-modern {
                font-size: 14px;
            }

            .sifat-top-controls,
            .sifat-tabs,
            .sifat-mini-quiz-options,
            .quiz-actions,
            .contoh-actions,
            .drag-action-row,
            .step-input-row,
            .step-option-group {
                flex-direction: column;
                align-items: stretch;
            }

            .sifat-tab,
            .mini-quiz-btn,
            .quiz-btn,
            .btn-contoh,
            .drag-btn,
            .step-btn,
            .step-option-btn {
                width: 100%;
                text-align: center;
            }

            .sifat-grid,
            .sifat-detail-info-wrap,
            .drag-area-row,
            .pair-grid {
                grid-template-columns: 1fr;
            }

            .sifat-card-item {
                border-radius: 16px;
                padding: 14px;
            }

            .sifat-no {
                width: 30px;
                height: 30px;
                font-size: 13px;
            }

            .sifat-mini {
                font-size: 14px;
            }

            .sifat-formula,
            .drag-math,
            .pair-soal {
                font-size: 15px;
            }

            .sifat-detail-panel {
                border-radius: 18px;
                padding: 16px 12px;
            }

            .sifat-detail-title {
                font-size: 19px;
            }

            .sifat-detail-rumus {
                font-size: 20px;
                padding: 12px 8px;
            }

            .sifat-detail-box,
            .sifat-mini-quiz,
            .step-panel,
            .latihan-drag-section,
            .eksplorasi-quiz-item {
                padding: 14px 12px;
                border-radius: 14px;
            }

            .mari-header,
            .latihan-drag-header {
                font-size: 16px;
                padding: 9px 20px;
            }

            .quiz-head {
                align-items: flex-start;
            }

            .quiz-number {
                width: 30px;
                height: 30px;
                min-width: 30px;
                font-size: 13px;
            }

            .soal {
                font-size: 14px;
                line-height: 1.55;
            }

            .quiz-options,
            .penjelasan {
                margin-left: 0;
            }

            .quiz-options {
                gap: 10px;
            }

            .quiz-option-label {
                flex: 1;
            }

            .quiz-option-chip {
                width: 100%;
                min-width: auto;
                font-size: 14px;
                padding: 9px 12px;
            }

            .eksplorasi-opsi-row {
                flex-direction: column;
            }

            .eksplorasi-opsi {
                width: 100%;
                min-width: 100%;
                font-size: 14px;
            }

            .step-input {
                width: 100%;
                min-width: 100%;
                font-size: 14px;
            }

            .drag-bank {
                flex-direction: column;
                padding: 12px;
            }

            .drag-item {
                width: 100%;
                padding: 11px 12px;
            }

            .drag-dropzone {
                min-height: 120px;
                padding: 12px;
            }

            .latihan-drag-title {
                font-size: 16px;
            }

            .hasil-skor,
            .drag-feedback,
            .drag-summary,
            .step-feedback,
            .step-answer-box,
            .sifat-detail-box-text,
            .sifat-mini-quiz-question,
            .sifat-mini-quiz-feedback,
            .eksplorasi-feedback,
            .eksplorasi-penjelasan {
                font-size: 13.5px;
            }
        }

        /* =====================================================
                                                       HP KECIL
                                                       420px ke bawah
                                                    ===================================================== */
        @media (max-width: 420px) {
            .materi-wrap {
                padding-left: 10px;
                padding-right: 10px;
            }

            .top-title .judul {
                font-size: 21px;
            }

            .top-title .label {
                font-size: 20px;
            }

            .section-title {
                font-size: 20px;
            }

            .formula-center,
            .identitas-rumus,
            .contoh-rumus,
            .langkah-rumus,
            .sifat-detail-rumus {
                font-size: 17px;
            }

            .mari-header,
            .latihan-drag-header {
                width: 100%;
                justify-content: center;
                text-align: center;
            }

            .definisi-pill,
            .contoh-badge,
            .sifat-badge-modern,
            .latihan-modern-badge {
                font-size: 12px;
                padding: 6px 12px;
            }

            .quiz-option-chip {
                padding: 9px 10px;
            }
        }

        .materi-wrap li,
        .materi-wrap .materi-paragraf p,
        .materi-wrap .lanjutan-paragraf p,
        .materi-wrap .definisi-text,
        .materi-wrap .sifat-text,
        .materi-wrap .contoh-card p,
        .materi-wrap .langkah-kecil,
        .materi-wrap .langkah-note,
        .materi-wrap .asal-langkah,
        .materi-wrap .mari-instruksi,
        .materi-wrap .latihan-drag-intro,
        .materi-wrap .sifat-subtitle-modern,
        .materi-wrap .sifat-detail-box-text,
        .materi-wrap .sifat-mini-quiz-question,
        .materi-wrap .eksplorasi-quiz-question,
        .materi-wrap .eksplorasi-feedback,
        .materi-wrap .eksplorasi-penjelasan,
        .materi-wrap .drag-feedback,
        .materi-wrap .drag-summary {
            text-align: justify !important;
            text-justify: inter-word;
        }

        /* Rumus dan judul jangan ikut justify */
        .materi-wrap .formula-center,
        .materi-wrap .identitas-rumus,
        .materi-wrap .contoh-rumus,
        .materi-wrap .langkah-rumus,
        .materi-wrap .sifat-detail-rumus,
        .materi-wrap .latihan-modern-soal,
        .materi-wrap .drag-math,
        .materi-wrap .pair-soal {
            text-align: center !important;
        }

        /* Petunjuk tap untuk tablet dan HP */
        .tap-helper {
            display: none;
            margin: 10px 0 14px;
            padding: 10px 12px;
            border-radius: 12px;
            background: #fff8eb;
            border: 1px solid #f2cf87;
            color: #855d12;
            font-size: 14px;
            line-height: 1.6;
            text-align: justify;
        }

        /* Saat kartu dipilih dengan tap */
        .drag-item.selected {
            border-color: #2997d3 !important;
            background: #eaf7ff !important;
            box-shadow: 0 0 0 3px rgba(41, 151, 211, .14) !important;
            transform: translateY(-2px) scale(1.01);
        }

        /* Saat kotak jawaban ditekan */
        .drag-dropzone.selected-target {
            border-color: #2997d3 !important;
            background: #eef8ff !important;
        }

        /* Laptop tetap drag and drop */
        @media (min-width: 1025px) {
            .drag-item {
                cursor: grab !important;
            }

            .drag-item:active {
                cursor: grabbing !important;
            }
        }

        /* Tablet dan HP: mode tap */
        @media (max-width: 1024px) {
            .tap-helper {
                display: block;
            }

            .drag-bank {
                display: grid !important;
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
                gap: 10px !important;
            }

            .drag-item {
                width: 100% !important;
                cursor: pointer !important;
                touch-action: manipulation;
            }

            .drag-dropzone {
                cursor: pointer !important;
                min-height: 130px;
            }

            .drag-dropzone-title::after {
                content: " — tekan di sini";
                font-weight: 600;
                color: #2997d3;
            }
        }

        /* HP kecil: jawaban satu kolom */
        @media (max-width: 640px) {
            .drag-bank {
                grid-template-columns: 1fr !important;
            }

            .tap-helper {
                font-size: 13.5px;
            }

            .drag-dropzone-title::after {
                display: block;
                margin-top: 4px;
                font-size: 12.5px;
            }
        }

        /* =====================================================
                   FIX CONTOH PERTAMA RESPONSIF
                   Target: #contoh-identitas
                ===================================================== */

        #contoh-identitas {
            width: 100%;
            max-width: 100%;
            margin: 32px 0 28px;
            padding: 34px 22px 24px;
            overflow: visible;
        }

        #contoh-identitas .contoh-badge {
            top: -24px;
            left: 28px;
            min-width: 180px;
            text-align: center;
            z-index: 5;
        }

        #contoh-identitas .contoh-soal {
            font-size: clamp(15px, 1.6vw, 17px);
            line-height: 1.8;
            text-align: justify;
        }

        #contoh-identitas .contoh-rumus {
            font-size: clamp(22px, 3vw, 34px);
            line-height: 1.5;
            margin: 14px 0 24px;
            overflow-x: auto;
            overflow-y: hidden;
            white-space: nowrap;
            padding-bottom: 6px;
        }

        #contoh-identitas .langkah-box {
            width: 100%;
            max-width: 100%;
            min-height: auto;
            padding: 18px;
            border-radius: 16px;
            overflow: visible;
        }

        #contoh-identitas .langkah-item {
            width: 100%;
        }

        #contoh-identitas .langkah-kecil {
            font-size: clamp(15px, 1.7vw, 17px);
            line-height: 1.7;
            text-align: justify;
        }

        #contoh-identitas .langkah-rumus {
            font-size: clamp(22px, 3vw, 32px);
            line-height: 1.5;
            overflow-x: auto;
            overflow-y: hidden;
            white-space: nowrap;
            padding-bottom: 6px;
        }

        #contoh-identitas .langkah-note,
        #contoh-identitas .asal-langkah {
            font-size: clamp(14px, 1.5vw, 15.5px);
            line-height: 1.8;
            text-align: justify;
            overflow-wrap: anywhere;
        }

        #contoh-identitas .contoh-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 16px;
        }

        #contoh-identitas .btn-contoh {
            white-space: nowrap;
        }

        #contoh-identitas .langkah-indikator {
            font-size: 14px;
            margin-top: 12px;
        }

        /* Tablet */
        @media (min-width: 641px) and (max-width: 1024px) {
            #contoh-identitas {
                padding: 32px 18px 22px;
                border-radius: 20px;
            }

            #contoh-identitas .contoh-badge {
                left: 22px;
                min-width: 160px;
                font-size: 14px;
                padding: 7px 22px;
            }

            #contoh-identitas .contoh-rumus,
            #contoh-identitas .langkah-rumus {
                font-size: 28px;
            }

            #contoh-identitas .langkah-box {
                padding: 16px;
            }
        }

        /* HP */
        @media (max-width: 640px) {
            #contoh-identitas {
                margin-top: 34px;
                padding: 30px 12px 18px;
                border-radius: 18px;
            }

            #contoh-identitas .contoh-badge {
                left: 14px;
                top: -20px;
                min-width: 130px;
                font-size: 13px;
                padding: 7px 16px;
            }

            #contoh-identitas .contoh-soal {
                font-size: 14px;
                line-height: 1.75;
                text-align: justify;
            }

            #contoh-identitas .contoh-rumus {
                font-size: 22px;
                margin: 12px 0 18px;
            }

            #contoh-identitas .langkah-box {
                padding: 14px 12px;
                border-radius: 14px;
            }

            #contoh-identitas .langkah-kecil {
                font-size: 14px;
                line-height: 1.7;
            }

            #contoh-identitas .langkah-rumus {
                font-size: 22px;
            }

            #contoh-identitas .langkah-note,
            #contoh-identitas .asal-langkah {
                font-size: 13.5px;
                line-height: 1.75;
                padding: 10px;
            }

            #contoh-identitas .contoh-actions {
                flex-direction: column;
                align-items: stretch;
            }

            #contoh-identitas .btn-contoh {
                width: 100%;
                text-align: center;
                padding: 10px 14px;
                font-size: 14px;
            }

            #contoh-identitas .langkah-indikator {
                text-align: center;
                font-size: 13px;
            }
        }

        /* HP kecil */
        @media (max-width: 420px) {

            #contoh-identitas .contoh-rumus,
            #contoh-identitas .langkah-rumus {
                font-size: 19px;
            }

            #contoh-identitas .contoh-badge {
                font-size: 12px;
                padding: 6px 14px;
            }
        }

        /* Pisahkan contoh dan latihan agar tidak tampak satu card */
        #contoh-faktorisasi {
            margin-bottom: 34px !important;
        }

        #latihan-drag-identitas-lima {
            margin-top: 42px !important;
        }

        #latihan-drag-identitas-lima .latihan-drag-card {
            border-radius: 22px;
            box-shadow: 0 8px 20px rgba(41, 151, 211, 0.08);
        }

        /* Card contoh utama */
        #contoh-identitas {
            width: 100%;
            max-width: 100%;
            margin: 34px auto 30px !important;
            padding: 36px 22px 24px !important;
            border-radius: 22px;
            overflow: visible !important;
        }

        /* Badge CONTOH */
        #contoh-identitas .contoh-badge {
            top: -22px;
            left: 28px;
            z-index: 5;
        }

        /* Teks soal */
        #contoh-identitas .contoh-soal {
            font-size: 16px;
            line-height: 1.8;
            text-align: justify;
            overflow-wrap: anywhere;
        }

        /* Rumus besar di atas */
        #contoh-identitas .contoh-rumus {
            width: 100%;
            max-width: 100%;
            font-size: clamp(22px, 3vw, 34px);
            line-height: 1.5;
            text-align: center;
            overflow-x: auto;
            overflow-y: hidden;
            white-space: nowrap;
            padding: 6px 0 10px;
            margin: 12px 0 22px;
        }

        /* Kotak langkah */
        #contoh-identitas .langkah-box {
            width: 100%;
            max-width: 100%;
            min-height: auto !important;
            padding: 18px !important;
            border-radius: 18px;
            overflow: visible !important;
        }

        /* Isi langkah */
        #contoh-identitas .langkah-item,
        #contoh-identitas .langkah-faktor {
            width: 100%;
            max-width: 100%;
        }

        /* Judul langkah */
        #contoh-identitas .langkah-kecil {
            font-size: 16px;
            line-height: 1.75;
            text-align: justify;
            overflow-wrap: anywhere;
        }

        /* Rumus di dalam langkah */
        #contoh-identitas .langkah-rumus {
            width: 100%;
            max-width: 100%;
            font-size: clamp(20px, 2.7vw, 30px);
            line-height: 1.5;
            text-align: center;
            overflow-x: auto;
            overflow-y: hidden;
            white-space: nowrap;
            padding: 6px 0 10px;
        }

        /* Kotak catatan */
        #contoh-identitas .langkah-note,
        #contoh-identitas .asal-langkah {
            width: 100%;
            max-width: 100%;
            font-size: 15px;
            line-height: 1.8;
            text-align: justify;
            overflow-wrap: anywhere;
            word-break: normal;
        }

        /* Rumus KaTeX supaya tidak memaksa card melebar */
        #contoh-identitas .katex-display {
            max-width: 100%;
            overflow-x: auto;
            overflow-y: hidden;
            padding-bottom: 6px;
        }

        #contoh-identitas .katex {
            white-space: normal;
        }

        /* Tombol bawah */
        #contoh-identitas .contoh-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 18px;
            padding-bottom: 8px;
        }

        #contoh-identitas .btn-contoh {
            white-space: nowrap;
            min-height: 42px;
        }

        /* Indikator langkah */
        #contoh-identitas .langkah-indikator {
            margin-top: 10px;
            font-size: 14px;
        }


        /* =====================================================
        TABLET
        ===================================================== */
        @media (min-width: 641px) and (max-width: 1024px) {
            #contoh-identitas {
                padding: 34px 18px 22px !important;
                border-radius: 20px;
            }

            #contoh-identitas .contoh-badge {
                left: 22px;
                top: -20px;
                min-width: 150px;
                font-size: 14px;
                padding: 7px 22px;
            }

            #contoh-identitas .contoh-soal {
                font-size: 15.5px;
            }

            #contoh-identitas .contoh-rumus {
                font-size: 28px;
            }

            #contoh-identitas .langkah-box {
                padding: 16px !important;
            }

            #contoh-identitas .langkah-rumus {
                font-size: 25px;
            }

            #contoh-identitas .langkah-note,
            #contoh-identitas .asal-langkah {
                font-size: 14.5px;
            }

            #contoh-identitas .contoh-actions {
                justify-content: flex-start;
            }

            #contoh-identitas .btn-contoh {
                flex: 1 1 180px;
                text-align: center;
            }
        }


        /* =====================================================
        HP
        ===================================================== */
        @media (max-width: 640px) {
            #contoh-identitas {
                margin-top: 34px !important;
                padding: 32px 12px 18px !important;
                border-radius: 18px;
                border-width: 2px;
            }

            #contoh-identitas .contoh-badge {
                top: -19px;
                left: 14px;
                min-width: 120px;
                font-size: 13px;
                padding: 7px 16px;
            }

            #contoh-identitas .contoh-soal {
                font-size: 14px;
                line-height: 1.75;
                text-align: justify;
            }

            #contoh-identitas .contoh-rumus {
                font-size: 21px;
                line-height: 1.5;
                margin: 10px 0 16px;
                padding-bottom: 8px;
            }

            #contoh-identitas .langkah-box {
                padding: 14px 10px !important;
                border-radius: 14px;
            }

            #contoh-identitas .langkah-kecil {
                font-size: 14px;
                line-height: 1.7;
            }

            #contoh-identitas .langkah-rumus {
                font-size: 20px;
                line-height: 1.5;
                padding-bottom: 8px;
            }

            #contoh-identitas .langkah-note,
            #contoh-identitas .asal-langkah {
                font-size: 13.5px;
                line-height: 1.75;
                padding: 10px;
                border-radius: 10px;
            }

            #contoh-identitas .contoh-actions {
                flex-direction: column;
                align-items: stretch;
                gap: 9px;
            }

            #contoh-identitas .btn-contoh {
                width: 100%;
                text-align: center !important;
                font-size: 14px;
                padding: 10px 12px;
            }

            #contoh-identitas .langkah-indikator {
                text-align: center;
                font-size: 13px;
            }
        }


        /* =====================================================
        HP KECIL
        ===================================================== */
        @media (max-width: 420px) {
            #contoh-identitas {
                padding-left: 10px !important;
                padding-right: 10px !important;
            }

            #contoh-identitas .contoh-rumus,
            #contoh-identitas .langkah-rumus {
                font-size: 18px;
            }

            #contoh-identitas .contoh-badge {
                font-size: 12px;
                padding: 6px 14px;
            }

            #contoh-identitas .langkah-note,
            #contoh-identitas .asal-langkah {
                font-size: 13px;
            }
        }


        /* =====================================================
        FIX SUPAYA AREA MATERI TIDAK MEMOTONG TOMBOL DI BAWAH
        ===================================================== */

        .materi-wrap,
        #materi-lanjutan,
        .contoh-card,
        .langkah-box {
            overflow: visible !important;
        }

        /* Kalau ada container dari layout yang tinggi tetap dan memotong isi */
        .content,
        .content-wrapper,
        .materi-content,
        .main-content,
        .halaman-materi,
        .materi-container {
            overflow-y: auto !important;
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
                        Perhatikan bentuk perkalian berikut.
                    </p>
                </div>

                <div class="formula-center">
                    $(x + 2)(x - 2)$
                </div>

                <div class="materi-paragraf">
                    <p>
                        Hitung hasilnya, lalu bandingkan dengan bentuk berikut:
                    </p>
                </div>

                <div class="formula-center">
                    $(x + 3)(x - 3)$
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

                        <div class="eksplorasi-penjelasan" style="display:none;">
                            Bentuk ini mengikuti pola:
                            $$(a+b)(a-b)=a^2-b^2$$
                            $$ (x+2)(x-2)=x^2-4 $$
                        </div>
                    </div>

                    <!-- SOAL 2 -->
                    <div class="eksplorasi-quiz-item" data-correct="A">
                        <p class="eksplorasi-quiz-question">
                            2. Hasil dari $(x + 3)(x - 3)$ adalah …
                        </p>

                        <div class="eksplorasi-opsi-row">
                            <button type="button" class="eksplorasi-opsi" data-value="A">
                                A. $x^2 - 9$
                            </button>
                            <button type="button" class="eksplorasi-opsi" data-value="B">
                                B. $x^2 + 9$
                            </button>
                            <button type="button" class="eksplorasi-opsi" data-value="C">
                                C. $x^2 - 3x$
                            </button>
                        </div>

                        <div class="eksplorasi-feedback"></div>

                        <div class="eksplorasi-penjelasan" style="display:none;">
                            $$ (x+3)(x-3)=x^2-9 $$
                        </div>
                    </div>

                    <!-- SOAL 3 (PENTING 🔥 POLA) -->
                    <div class="eksplorasi-quiz-item" data-correct="B">
                        <p class="eksplorasi-quiz-question">
                            3. Dari kedua hasil tersebut, bentuk umum yang benar adalah …
                        </p>

                        <div class="eksplorasi-opsi-row">
                            <button type="button" class="eksplorasi-opsi" data-value="A">
                                A. $(x + a)(x - a) = x^2 + a^2$
                            </button>
                            <button type="button" class="eksplorasi-opsi" data-value="B">
                                B. $(x + a)(x - a) = x^2 - a^2$
                            </button>
                            <button type="button" class="eksplorasi-opsi" data-value="C">
                                C. $(x + a)^2 = x^2 - a^2$
                            </button>
                        </div>

                        <div class="eksplorasi-feedback"></div>

                        <div class="eksplorasi-penjelasan" style="display:none;">
                            Dari:
                            $$ (x+2)(x-2)=x^2-4 $$
                            $$ (x+3)(x-3)=x^2-9 $$

                            Terlihat pola:
                            $$ (x+a)(x-a)=x^2-a^2 $$

                            Ini disebut <b>identitas selisih dua kuadrat</b>.
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div id="materi-lanjutan" class="materi-lanjutan-hidden">
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

            <div class="sifat-wrapper">

                <!-- BADGE LUAR -->
                <div class="sifat-badge-modern">SIFAT</div>

                <div class="sifat-interaktif" id="sifat-interaktif">

                    <!-- HEADER -->
                    <div class="sifat-header-modern">
                        <h3 class="sifat-title-modern">Jelajahi Identitas Polinomial</h3>
                        <p class="sifat-subtitle-modern">
                            Tekan kartu rumus untuk melihat nama identitas, bentuk lengkap, penjelasan, dan contoh
                            penggunaannya.
                        </p>
                    </div>

                    <!-- FILTER -->
                    <div class="sifat-top-controls">
                        <div class="sifat-tabs">
                            <button type="button" class="sifat-tab active" data-filter="semua">Semua</button>
                            <button type="button" class="sifat-tab" data-filter="kuadrat">Kuadrat</button>
                            <button type="button" class="sifat-tab" data-filter="kubik">Kubik</button>
                        </div>
                    </div>

                    <!-- GRID -->
                    <div class="sifat-grid" id="sifat-grid">

                        <button type="button" class="sifat-card-item active" data-kategori="kuadrat"
                            data-title="Selisih Dua Kuadrat" data-rumus="a^2 - b^2 = (a+b)(a-b)"
                            data-penjelasan="Dipakai saat bentuk polinomial terdiri dari dua kuadrat yang dikurangkan."
                            data-contoh="x^2 - 16 = (x+4)(x-4)">
                            <span class="sifat-no">1</span>
                            <span class="sifat-mini">Selisih Dua Kuadrat</span>
                            <span class="sifat-formula">$a^2 - b^2 = (a+b)(a-b)$</span>
                        </button>

                        <button type="button" class="sifat-card-item" data-kategori="kuadrat"
                            data-title="Kuadrat Penjumlahan Dua Suku" data-rumus="(a+b)^2 = a^2 + 2ab + b^2"
                            data-penjelasan="Dipakai saat ada bentuk kuadrat dari dua suku yang dijumlahkan."
                            data-contoh="(x+3)^2 = x^2 + 6x + 9">
                            <span class="sifat-no">2</span>
                            <span class="sifat-mini">Kuadrat Jumlah</span>
                            <span class="sifat-formula">$(a+b)^2 = a^2 + 2ab + b^2$</span>
                        </button>

                        <button type="button" class="sifat-card-item" data-kategori="kuadrat"
                            data-title="Kuadrat Selisih Dua Suku" data-rumus="(a-b)^2 = a^2 - 2ab + b^2"
                            data-penjelasan="Dipakai saat ada bentuk kuadrat dari dua suku yang dikurangkan."
                            data-contoh="(x-5)^2 = x^2 - 10x + 25">
                            <span class="sifat-no">3</span>
                            <span class="sifat-mini">Kuadrat Selisih</span>
                            <span class="sifat-formula">$(a-b)^2 = a^2 - 2ab + b^2$</span>
                        </button>

                        <button type="button" class="sifat-card-item" data-kategori="kubik" data-title="Jumlah Dua Kubik"
                            data-rumus="a^3 + b^3 = (a+b)(a^2-ab+b^2)"
                            data-penjelasan="Dipakai untuk memfaktorkan bentuk jumlah dua kubik."
                            data-contoh="x^3 + 8 = (x+2)(x^2 - 2x + 4)">
                            <span class="sifat-no">4</span>
                            <span class="sifat-mini">Jumlah Dua Kubik</span>
                            <span class="sifat-formula">$a^3 + b^3 = (a+b)(a^2-ab+b^2)$</span>
                        </button>

                        <button type="button" class="sifat-card-item" data-kategori="kubik" data-title="Selisih Dua Kubik"
                            data-rumus="a^3 - b^3 = (a-b)(a^2+ab+b^2)"
                            data-penjelasan="Dipakai untuk memfaktorkan bentuk selisih dua kubik."
                            data-contoh="x^3 - 27 = (x-3)(x^2 + 3x + 9)">
                            <span class="sifat-no">5</span>
                            <span class="sifat-mini">Selisih Dua Kubik</span>
                            <span class="sifat-formula">$a^3 - b^3 = (a-b)(a^2+ab+b^2)$</span>
                        </button>

                        <button type="button" class="sifat-card-item" data-kategori="kubik"
                            data-title="Kubik Penjumlahan Dua Suku" data-rumus="(a+b)^3 = a^3 + 3a^2b + 3ab^2 + b^3"
                            data-penjelasan="Dipakai saat bentuk kubik berasal dari penjumlahan dua suku."
                            data-contoh="(x+2)^3 = x^3 + 6x^2 + 12x + 8">
                            <span class="sifat-no">6</span>
                            <span class="sifat-mini">Kubik Jumlah</span>
                            <span class="sifat-formula">$(a+b)^3 = a^3 + 3a^2b + 3ab^2 + b^3$</span>
                        </button>

                        <button type="button" class="sifat-card-item" data-kategori="kubik"
                            data-title="Kubik Selisih Dua Suku" data-rumus="(a-b)^3 = a^3 - 3a^2b + 3ab^2 - b^3"
                            data-penjelasan="Dipakai saat bentuk kubik berasal dari selisih dua suku."
                            data-contoh="(x-1)^3 = x^3 - 3x^2 + 3x - 1">
                            <span class="sifat-no">7</span>
                            <span class="sifat-mini">Kubik Selisih</span>
                            <span class="sifat-formula">$(a-b)^3 = a^3 - 3a^2b + 3ab^2 - b^3$</span>
                        </button>

                    </div>

                    <!-- DETAIL -->
                    <div class="sifat-detail-panel" id="sifat-detail-panel">
                        <div class="sifat-detail-top">
                            <span class="sifat-detail-kategori" id="detail-kategori">KUADRAT</span>
                            <span class="sifat-detail-label">Identitas Terpilih</span>
                        </div>

                        <h4 class="sifat-detail-title" id="detail-title">Selisih Dua Kuadrat</h4>

                        <div class="sifat-detail-rumus" id="detail-rumus">
                            $$a^2 - b^2 = (a+b)(a-b)$$
                        </div>

                        <div class="sifat-detail-info-wrap">
                            <div class="sifat-detail-box">
                                <div class="sifat-detail-box-title">Kapan dipakai?</div>
                                <div class="sifat-detail-box-text" id="detail-penjelasan">
                                    Dipakai saat bentuk polinomial terdiri dari dua kuadrat yang dikurangkan.
                                </div>
                            </div>

                            <div class="sifat-detail-box contoh">
                                <div class="sifat-detail-box-title">Contoh</div>
                                <div class="sifat-detail-box-text" id="detail-contoh">
                                    $$x^2 - 16 = (x+4)(x-4)$$
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MINI QUIZ -->
                    <div class="sifat-mini-quiz">
                        <div class="sifat-mini-quiz-title">Tebak rumus yang cocok</div>

                        <p class="sifat-mini-quiz-question">
                            Bentuk <strong>$x^3 - 8$</strong> paling cocok menggunakan identitas...
                        </p>

                        <div class="sifat-mini-quiz-options">
                            <button type="button" class="mini-quiz-btn" data-answer="salah">Selisih dua kuadrat</button>
                            <button type="button" class="mini-quiz-btn" data-answer="benar">Selisih dua kubik</button>
                            <button type="button" class="mini-quiz-btn" data-answer="salah">Kuadrat penjumlahan dua
                                suku</button>
                        </div>

                        <div class="sifat-mini-quiz-feedback" id="mini-quiz-feedback"></div>
                    </div>

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
                        Jawab semua soal terlebih dahulu, lalu tekan <b>Cek Jawaban</b>.
                    </p>

                    <form id="quiz-form">
                        <div class="quiz-list">
                            <div class="quiz-item" data-correct="B"
                                data-explain="Benar. Gunakan rumus kuadrat jumlah: $(a+b)^2 = a^2 + 2ab + b^2$. Jadi persamaan ini merupakan identitas."
                                data-wrong="Jawabanmu belum tepat. Coba ingat kembali rumus kuadrat jumlah dua suku.">
                                <div class="quiz-head">
                                    <div class="quiz-number">1</div>
                                    <div class="soal">$(a+b)^2 = a^2 + 2ab + b^2$</div>
                                </div>

                                <div class="quiz-options">
                                    <label class="quiz-option-label">
                                        <input type="radio" name="q1" value="B">
                                        <span class="quiz-option-chip">B</span>
                                    </label>

                                    <label class="quiz-option-label">
                                        <input type="radio" name="q1" value="S">
                                        <span class="quiz-option-chip">S</span>
                                    </label>
                                </div>

                                <div class="penjelasan"></div>
                            </div>

                            <div class="quiz-item" data-correct="B"
                                data-explain="Benar. Ini menggunakan bentuk selisih dua kuadrat: $(a-b)(a+b)=a^2-b^2$. Dengan $a=2x$ dan $b=3$, diperoleh $(2x-3)(2x+3)=4x^2-9$."
                                data-wrong="Masih belum tepat. Perhatikan pola $(a-b)(a+b)$ yang menghasilkan selisih dua kuadrat.">
                                <div class="quiz-head">
                                    <div class="quiz-number">2</div>
                                    <div class="soal">$(2x-3)(2x+3) = 4x^2 - 9$</div>
                                </div>

                                <div class="quiz-options">
                                    <label class="quiz-option-label">
                                        <input type="radio" name="q2" value="B">
                                        <span class="quiz-option-chip">B</span>
                                    </label>

                                    <label class="quiz-option-label">
                                        <input type="radio" name="q2" value="S">
                                        <span class="quiz-option-chip">S</span>
                                    </label>
                                </div>

                                <div class="penjelasan"></div>
                            </div>

                            <div class="quiz-item" data-correct="B"
                                data-explain="Benar. Gunakan rumus kuadrat jumlah dengan $a=3y$ dan $b=1$. Hasilnya $(3y+1)^2 = 9y^2 + 6y + 1$."
                                data-wrong="Jawabanmu belum tepat. Coba kembangkan $(3y+1)^2$ dengan rumus kuadrat jumlah.">
                                <div class="quiz-head">
                                    <div class="quiz-number">3</div>
                                    <div class="soal">$(3y+1)^2 = 9y^2 + 6y + 1$</div>
                                </div>

                                <div class="quiz-options">
                                    <label class="quiz-option-label">
                                        <input type="radio" name="q3" value="B">
                                        <span class="quiz-option-chip">B</span>
                                    </label>

                                    <label class="quiz-option-label">
                                        <input type="radio" name="q3" value="S">
                                        <span class="quiz-option-chip">S</span>
                                    </label>
                                </div>

                                <div class="penjelasan"></div>
                            </div>

                            <div class="quiz-item" data-correct="S"
                                data-explain="Benar. Pernyataan ini memang salah. Karena $(x-4)^2 = x^2 - 8x + 16$, bukan $x^2 - 4$."
                                data-wrong="Coba lagi. Kembangkan dahulu $(x-4)^2$ dengan rumus $(a-b)^2 = a^2 - 2ab + b^2$.">
                                <div class="quiz-head">
                                    <div class="quiz-number">4</div>
                                    <div class="soal">$(x-4)^2 = x^2 - 4$</div>
                                </div>

                                <div class="quiz-options">
                                    <label class="quiz-option-label">
                                        <input type="radio" name="q4" value="B">
                                        <span class="quiz-option-chip">B</span>
                                    </label>

                                    <label class="quiz-option-label">
                                        <input type="radio" name="q4" value="S">
                                        <span class="quiz-option-chip">S</span>
                                    </label>
                                </div>

                                <div class="penjelasan"></div>
                            </div>

                            <div class="quiz-item" data-correct="B"
                                data-explain="Benar. Ini adalah identitas jumlah dua kubik: $a^3 + b^3 = (a+b)(a^2-ab+b^2)$."
                                data-wrong="Belum tepat. Coba ingat kembali rumus jumlah dua kubik.">
                                <div class="quiz-head">
                                    <div class="quiz-number">5</div>
                                    <div class="soal">$a^3 + b^3 = (a+b)(a^2-ab+b^2)$</div>
                                </div>

                                <div class="quiz-options">
                                    <label class="quiz-option-label">
                                        <input type="radio" name="q5" value="B">
                                        <span class="quiz-option-chip">B</span>
                                    </label>

                                    <label class="quiz-option-label">
                                        <input type="radio" name="q5" value="S">
                                        <span class="quiz-option-chip">S</span>
                                    </label>
                                </div>

                                <div class="penjelasan"></div>
                            </div>
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
                            Bentuk ini langsung diambil dari soal. Langkah awalnya adalah mengenali dulu bentuk
                            polinomialnya.
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


            {{-- LATIHAN DIPISAH DARI CONTOH --}}
            <div class="latihan-drag-wrap" id="latihan-drag-identitas-lima">
                <div class="latihan-drag-header">LATIHAN</div>

                <div class="latihan-drag-card">
                    <p class="latihan-drag-intro">
                        Seret setiap kartu ke kotak <b>IDENTITAS</b> atau <b>BUKAN IDENTITAS</b>.
                        Setelah semua kartu disusun, tekan <b>Cek Jawaban</b> untuk melihat hasil dan penjelasannya.
                    </p>

                    <div class="tap-helper">
                        <b>Untuk tablet dan HP:</b> tekan salah satu kartu jawaban terlebih dahulu,
                        lalu tekan kotak <b>IDENTITAS</b> atau <b>BUKAN IDENTITAS</b> untuk menaruh jawabannya.
                    </div>

                    <div class="latihan-drag-section">
                        <div class="latihan-drag-title">A. Apakah ini identitas polinomial?</div>

                        <div class="drag-area-row">
                            <div class="drag-dropzone" data-role="identitas-zone">
                                <div class="drag-dropzone-title">IDENTITAS</div>
                                <div class="drag-dropzone-body" id="zone-identitas-lima"></div>
                            </div>

                            <div class="drag-dropzone" data-role="bukan-zone">
                                <div class="drag-dropzone-title">BUKAN IDENTITAS</div>
                                <div class="drag-dropzone-body" id="zone-bukan-lima"></div>
                            </div>
                        </div>

                        <div class="drag-bank" id="bank-identitas-lima">
                            <div class="drag-item" draggable="true" data-answer="identitas" data-id="q1">
                                <div class="drag-number">1</div>
                                <div class="drag-math">$(a+b)^3 = a^3 + 3a^2b + 3ab^2 + b^3$</div>
                            </div>

                            <div class="drag-item" draggable="true" data-answer="bukan" data-id="q2">
                                <div class="drag-number">2</div>
                                <div class="drag-math">$(2y+5)(2y-5) = 4y^2 - 10y - 25$</div>
                            </div>

                            <div class="drag-item" draggable="true" data-answer="identitas" data-id="q3">
                                <div class="drag-number">3</div>
                                <div class="drag-math">$(x+a)(x-a) = x^2 - a^2$</div>
                            </div>

                            <div class="drag-item" draggable="true" data-answer="bukan" data-id="q4">
                                <div class="drag-number">4</div>
                                <div class="drag-math">$(x-4)^2 = x^2 - 4$</div>
                            </div>

                            <div class="drag-item" draggable="true" data-answer="identitas" data-id="q5">
                                <div class="drag-number">5</div>
                                <div class="drag-math">$a^3 + b^3 = (a+b)(a^2-ab+b^2)$</div>
                            </div>
                        </div>

                        <div class="drag-action-row">
                            <button type="button" class="drag-btn drag-btn-primary" id="cek-identitas-lima">
                                Cek Jawaban
                            </button>

                            <button type="button" class="drag-btn" id="reset-identitas-lima">
                                Ulangi
                            </button>
                        </div>

                        <div class="drag-summary" id="summary-identitas-lima"></div>

                        <div class="drag-feedback" id="feedback-identitas-lima"></div>
                    </div>
                </div>
            </div>
            <script>
                window.completeMateriUrl = "{{ route('materi.complete', $materi->id) }}";

                /* =====================================================
                   GLOBAL RENDER MATH
                ===================================================== */
                function renderMathSafe(target = document.body) {
                    if (typeof renderMathInElement === 'function') {
                        renderMathInElement(target, {
                            delimiters: [
                                { left: '$$', right: '$$', display: true },
                                { left: '$', right: '$', display: false },
                                { left: '\\(', right: '\\)', display: false },
                                { left: '\\[', right: '\\]', display: true }
                            ],
                            throwOnError: false
                        });
                    }
                }

                /* =====================================================
                   PROGRESS MATERI + BUKA KUIS
                ===================================================== */
                function bukaQuizButton() {
                    const quizBtn = document.getElementById("quizBabBtn");
                    if (!quizBtn) return;

                    const url = quizBtn.dataset.quizUrl;
                    if (!url) return;

                    const link = document.createElement("a");
                    link.href = url;
                    link.id = "quizBabBtn";
                    link.className = "btn-nav next-btn";
                    link.textContent = "Kuis →";

                    quizBtn.replaceWith(link);
                }

                async function saveProgressMateri() {
                    const csrfToken = document
                        .querySelector('meta[name="csrf-token"]')
                        ?.getAttribute("content");

                    if (!window.completeMateriUrl || !csrfToken) {
                        console.warn("completeMateriUrl atau CSRF token tidak ditemukan.");
                        return false;
                    }

                    try {
                        const response = await fetch(window.completeMateriUrl, {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": csrfToken,
                                "X-Requested-With": "XMLHttpRequest",
                                "Accept": "application/json",
                            },
                            body: JSON.stringify({}),
                        });

                        return response.ok;
                    } catch (error) {
                        console.error(error);
                        return false;
                    }
                }

                let progressSudahDisimpan = false;

                async function simpanProgressDanBukaKuis() {
                    if (progressSudahDisimpan) {
                        bukaQuizButton();
                        return true;
                    }

                    progressSudahDisimpan = true;

                    const berhasilSimpan = await saveProgressMateri();

                    if (berhasilSimpan) {
                        bukaQuizButton();
                        return true;
                    }

                    progressSudahDisimpan = false;
                    console.warn("Progress gagal disimpan. Silakan coba lagi.");
                    return false;
                }

                /* =====================================================
                   EKSPLORASI: PILIHAN GANDA + BUKA MATERI LANJUTAN
                ===================================================== */
                (function () {
                    const quizItems = document.querySelectorAll('.eksplorasi-quiz-item');
                    const materiLanjutan = document.getElementById('materi-lanjutan');

                    if (!quizItems.length) return;

                    function cekSemuaEksplorasiTerjawab() {
                        const semuaTerjawab = Array.from(quizItems).every((item) => {
                            return item.dataset.answered === 'true';
                        });

                        if (semuaTerjawab && materiLanjutan) {
                            materiLanjutan.classList.add('show');
                            renderMathSafe(materiLanjutan);
                        }
                    }

                    if (materiLanjutan) {
                        materiLanjutan.classList.remove('show');
                    }

                    quizItems.forEach((item) => {
                        const correctAnswer = item.dataset.correct;
                        const options = item.querySelectorAll('.eksplorasi-opsi');
                        const feedback = item.querySelector('.eksplorasi-feedback');
                        const explanation = item.querySelector('.eksplorasi-penjelasan');

                        item.dataset.answered = 'false';

                        options.forEach((option) => {
                            option.addEventListener('click', function () {
                                const selected = this.dataset.value;

                                options.forEach((btn) => {
                                    btn.classList.remove('benar', 'salah');
                                });

                                if (explanation) {
                                    explanation.classList.remove('show');
                                }

                                if (feedback) {
                                    feedback.className = 'eksplorasi-feedback show';
                                }

                                if (selected === correctAnswer) {
                                    this.classList.add('benar');

                                    if (feedback) {
                                        feedback.classList.add('benar');
                                        feedback.innerHTML = '✔ Jawabanmu benar.';
                                    }

                                    if (explanation) {
                                        explanation.classList.add('show');
                                    }
                                } else {
                                    this.classList.add('salah');

                                    if (feedback) {
                                        feedback.classList.add('salah');
                                        feedback.innerHTML = '✘ Jawabanmu belum tepat. Coba perhatikan kembali pola bentuk aljabarnya.';
                                    }
                                }

                                item.dataset.answered = 'true';

                                cekSemuaEksplorasiTerjawab();
                                renderMathSafe(item);
                            });
                        });
                    });
                })();

                /* =====================================================
                   CONTOH IDENTITAS: LANGKAH 1 - 6
                ===================================================== */
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

                        if (indikator) {
                            indikator.textContent = `Langkah ${index + 1} dari ${langkah.length}`;
                        }

                        if (btnPrev) {
                            btnPrev.disabled = index === 0;
                            btnPrev.style.opacity = index === 0 ? '.5' : '1';
                        }

                        if (btnNext) {
                            btnNext.disabled = index === langkah.length - 1;
                            btnNext.style.opacity = index === langkah.length - 1 ? '.5' : '1';
                        }

                        renderMathSafe(document.getElementById('contoh-identitas') || document.body);
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

                /* =====================================================
                   CONTOH FAKTORISASI: LANGKAH 1 - 6
                ===================================================== */
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

                        if (indikatorFaktor) {
                            indikatorFaktor.textContent = `Langkah ${indexFaktor + 1} dari ${langkahFaktor.length}`;
                        }

                        if (btnPrevFaktor) {
                            btnPrevFaktor.disabled = indexFaktor === 0;
                            btnPrevFaktor.style.opacity = indexFaktor === 0 ? '.5' : '1';
                        }

                        if (btnNextFaktor) {
                            btnNextFaktor.disabled = indexFaktor === langkahFaktor.length - 1;
                            btnNextFaktor.style.opacity = indexFaktor === langkahFaktor.length - 1 ? '.5' : '1';
                        }

                        renderMathSafe(document.getElementById('contoh-faktorisasi') || document.body);
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

                /* =====================================================
                   SIFAT INTERAKTIF
                ===================================================== */
                (function () {
                    const root = document.getElementById('sifat-interaktif');
                    if (!root) return;

                    const tabs = root.querySelectorAll('.sifat-tab');
                    const cards = root.querySelectorAll('.sifat-card-item');
                    const btnRandom = document.getElementById('btn-rumus-acak');

                    const detailKategori = document.getElementById('detail-kategori');
                    const detailTitle = document.getElementById('detail-title');
                    const detailRumus = document.getElementById('detail-rumus');
                    const detailPenjelasan = document.getElementById('detail-penjelasan');
                    const detailContoh = document.getElementById('detail-contoh');

                    function setActiveCard(card) {
                        if (!card) return;

                        cards.forEach(item => item.classList.remove('active'));
                        card.classList.add('active');

                        const kategori = card.dataset.kategori || '';
                        const title = card.dataset.title || '';
                        const rumus = card.dataset.rumus || '';
                        const penjelasan = card.dataset.penjelasan || '';
                        const contoh = card.dataset.contoh || '';

                        if (detailKategori) detailKategori.textContent = kategori.toUpperCase();
                        if (detailTitle) detailTitle.textContent = title;
                        if (detailRumus) detailRumus.innerHTML = `\\(${rumus}\\)`;
                        if (detailPenjelasan) detailPenjelasan.textContent = penjelasan;
                        if (detailContoh) detailContoh.innerHTML = `\\(${contoh}\\)`;

                        renderMathSafe(root);
                    }

                    cards.forEach(card => {
                        card.addEventListener('click', function () {
                            setActiveCard(this);
                        });
                    });

                    tabs.forEach(tab => {
                        tab.addEventListener('click', function () {
                            tabs.forEach(t => t.classList.remove('active'));
                            this.classList.add('active');

                            const filter = this.dataset.filter;
                            let firstVisible = null;

                            cards.forEach(card => {
                                const kategori = card.dataset.kategori;

                                if (filter === 'semua' || kategori === filter) {
                                    card.classList.remove('hidden');
                                    if (!firstVisible) firstVisible = card;
                                } else {
                                    card.classList.add('hidden');
                                    card.classList.remove('active');
                                }
                            });

                            if (firstVisible) {
                                setActiveCard(firstVisible);
                            }
                        });
                    });

                    btnRandom?.addEventListener('click', function () {
                        const visibleCards = Array.from(cards).filter(card => !card.classList.contains('hidden'));
                        if (!visibleCards.length) return;

                        const randomIndex = Math.floor(Math.random() * visibleCards.length);
                        setActiveCard(visibleCards[randomIndex]);
                    });

                    const miniQuizBtns = root.querySelectorAll('.mini-quiz-btn');
                    const miniQuizFeedback = document.getElementById('mini-quiz-feedback');

                    miniQuizBtns.forEach(btn => {
                        btn.addEventListener('click', function () {
                            miniQuizBtns.forEach(item => item.classList.remove('benar', 'salah'));

                            if (!miniQuizFeedback) return;

                            if (this.dataset.answer === 'benar') {
                                this.classList.add('benar');
                                miniQuizFeedback.className = 'sifat-mini-quiz-feedback show benar';
                                miniQuizFeedback.innerHTML = `
                                                        ✔ Tepat! Bentuk \\(x^3 - 8\\) adalah selisih dua kubik karena
                                                        \\(8 = 2^3\\), sehingga cocok dengan identitas:
                                                        \\[
                                                            a^3 - b^3 = (a-b)(a^2+ab+b^2)
                                                        \\]
                                                    `;
                            } else {
                                this.classList.add('salah');
                                miniQuizFeedback.className = 'sifat-mini-quiz-feedback show salah';
                                miniQuizFeedback.innerHTML = `
                                                        ✘ Belum tepat. Karena \\(x^3 - 8 = x^3 - 2^3\\),
                                                        bentuk ini termasuk <b>selisih dua kubik</b>, bukan kuadrat.
                                                    `;
                            }

                            renderMathSafe(root);
                        });
                    });

                    const firstActive = root.querySelector('.sifat-card-item.active') || root.querySelector('.sifat-card-item');
                    if (firstActive) setActiveCard(firstActive);

                    renderMathSafe(root);
                })();

                /* =====================================================
                   MARI MENCOBA: BENAR / SALAH
                ===================================================== */
                (function () {
                    const form = document.getElementById('quiz-form');
                    const btnCek = document.getElementById('cek-jawaban');
                    const btnUlang = document.getElementById('ulangi');
                    const hasilSkor = document.getElementById('hasil-skor');
                    const quizItems = Array.from(document.querySelectorAll('#quiz-form .quiz-item'));

                    if (!form || !btnCek || !btnUlang || !quizItems.length) return;

                    btnCek.addEventListener('click', function () {
                        let skor = 0;
                        let semuaTerjawab = true;

                        quizItems.forEach((item, index) => {
                            const correct = item.dataset.correct;
                            const explain = item.dataset.explain;
                            const wrongMsg = item.dataset.wrong;
                            const checked = item.querySelector(`input[name="q${index + 1}"]:checked`);
                            const penjelasan = item.querySelector('.penjelasan');

                            item.classList.remove('benar', 'salah');

                            if (penjelasan) {
                                penjelasan.innerHTML = '';
                            }

                            if (!checked) {
                                semuaTerjawab = false;
                                return;
                            }

                            if (checked.value === correct) {
                                skor++;
                                item.classList.add('benar');

                                if (penjelasan) {
                                    penjelasan.innerHTML = `✔ <b>Benar.</b> ${explain}`;
                                }
                            } else {
                                item.classList.add('salah');

                                if (penjelasan) {
                                    penjelasan.innerHTML = `✘ <b>Belum tepat.</b> ${wrongMsg}`;
                                }
                            }
                        });

                        if (!hasilSkor) return;

                        if (!semuaTerjawab) {
                            hasilSkor.className = 'hasil-skor show perlu-lagi';
                            hasilSkor.innerHTML = 'Semua soal harus dijawab terlebih dahulu sebelum mengecek jawaban.';
                            renderMathSafe(form);
                            return;
                        }

                        if (skor === quizItems.length) {
                            hasilSkor.className = 'hasil-skor show bagus';
                            hasilSkor.innerHTML = `🎉 Skor kamu <b>${skor}/${quizItems.length}</b>. Hebat, semua jawaban benar!`;
                        } else {
                            hasilSkor.className = 'hasil-skor show perlu-lagi';
                            hasilSkor.innerHTML = `Skor kamu <b>${skor}/${quizItems.length}</b>. Perhatikan bagian yang masih salah lalu coba lagi.`;
                        }

                        renderMathSafe(form);
                    });

                    btnUlang.addEventListener('click', function () {
                        form.reset();

                        quizItems.forEach((item) => {
                            item.classList.remove('benar', 'salah');

                            const penjelasan = item.querySelector('.penjelasan');
                            if (penjelasan) penjelasan.innerHTML = '';
                        });

                        if (hasilSkor) {
                            hasilSkor.className = 'hasil-skor';
                            hasilSkor.innerHTML = '';
                        }

                        renderMathSafe(form);
                    });

                    renderMathSafe(form);
                })();

                /* =====================================================
                   LATIHAN DRAG DROP + TAP TABLET/HP
                ===================================================== */
                (function () {
                    const root = document.getElementById('latihan-drag-identitas-lima');
                    if (!root) return;

                    const bank = document.getElementById('bank-identitas-lima');
                    const zoneIdentitas = document.getElementById('zone-identitas-lima');
                    const zoneBukan = document.getElementById('zone-bukan-lima');

                    const dropzones = root.querySelectorAll('.drag-dropzone');
                    const btnCek = document.getElementById('cek-identitas-lima');
                    const btnReset = document.getElementById('reset-identitas-lima');
                    const summary = document.getElementById('summary-identitas-lima');
                    const feedback = document.getElementById('feedback-identitas-lima');

                    let activeDrag = null;
                    let selectedCard = null;

                    function rerenderMath() {
                        renderMathSafe(root);
                    }

                    function clearSelected() {
                        root.querySelectorAll('.drag-item').forEach(item => {
                            item.classList.remove('selected');
                        });

                        root.querySelectorAll('.drag-dropzone').forEach(zone => {
                            zone.classList.remove('selected-target');
                        });

                        selectedCard = null;
                    }

                    function setSummary(type, html) {
                        if (!summary) return;
                        summary.className = 'drag-summary show ' + type;
                        summary.innerHTML = html;
                    }

                    function setFeedback(type, html) {
                        if (!feedback) return;
                        feedback.className = 'drag-feedback show ' + type;
                        feedback.innerHTML = html;
                    }

                    function moveCardToZone(card, zone) {
                        if (!card || !zone) return;

                        const body = zone.querySelector('.drag-dropzone-body');
                        if (!body) return;

                        body.appendChild(card);
                        clearSelected();
                        rerenderMath();
                    }

                    function initDragAndTapItems() {
                        const items = root.querySelectorAll('.drag-item');

                        items.forEach((item) => {
                            item.setAttribute('draggable', 'true');

                            item.addEventListener('dragstart', function () {
                                activeDrag = this;
                                this.classList.add('dragging');
                            });

                            item.addEventListener('dragend', function () {
                                this.classList.remove('dragging');
                                activeDrag = null;
                            });

                            item.addEventListener('click', function (e) {
                                e.stopPropagation();

                                root.querySelectorAll('.drag-item').forEach(card => {
                                    card.classList.remove('selected');
                                });

                                this.classList.add('selected');
                                selectedCard = this;
                            });
                        });
                    }

                    dropzones.forEach((zone) => {
                        zone.addEventListener('dragover', function (e) {
                            e.preventDefault();
                            this.classList.add('over');
                        });

                        zone.addEventListener('dragleave', function () {
                            this.classList.remove('over');
                        });

                        zone.addEventListener('drop', function (e) {
                            e.preventDefault();
                            this.classList.remove('over');

                            if (!activeDrag) return;
                            moveCardToZone(activeDrag, this);
                        });

                        zone.addEventListener('click', function () {
                            root.querySelectorAll('.drag-dropzone').forEach(item => {
                                item.classList.remove('selected-target');
                            });

                            this.classList.add('selected-target');

                            if (!selectedCard) {
                                setSummary(
                                    'no',
                                    'Pilih kartu jawaban terlebih dahulu, lalu tekan kotak IDENTITAS atau BUKAN IDENTITAS.'
                                );
                                return;
                            }

                            moveCardToZone(selectedCard, this);
                        });
                    });

                    btnCek?.addEventListener('click', async function () {
                        const semuaKartu = root.querySelectorAll('.drag-item');
                        const diIdentitas = zoneIdentitas.querySelectorAll('.drag-item');
                        const diBukan = zoneBukan.querySelectorAll('.drag-item');

                        if (semuaKartu.length !== 5) return;

                        const totalTersusun = diIdentitas.length + diBukan.length;

                        if (totalTersusun < 5) {
                            setSummary(
                                'no',
                                'Semua kartu harus dipindahkan dulu ke kotak jawaban sebelum dicek.'
                            );

                            setFeedback(
                                'no',
                                'Masih ada kartu yang belum disusun. Susun semua kartu ke kotak <b>IDENTITAS</b> atau <b>BUKAN IDENTITAS</b>.'
                            );

                            return;
                        }

                        let skor = 0;

                        diIdentitas.forEach((card) => {
                            if (card.dataset.answer === 'identitas') skor++;
                        });

                        diBukan.forEach((card) => {
                            if (card.dataset.answer === 'bukan') skor++;
                        });

                        if (skor === 5) {
                            setSummary(
                                'ok',
                                '🎉 Skor kamu <b>5/5</b>. Semua jawaban benar. Progress sedang disimpan...'
                            );

                            const berhasil = await simpanProgressDanBukaKuis();

                            if (berhasil) {
                                setSummary(
                                    'ok',
                                    '🎉 Skor kamu <b>5/5</b>. Semua jawaban benar. Progress tersimpan dan Kuis sudah terbuka.'
                                );
                            } else {
                                setSummary(
                                    'no',
                                    'Jawaban sudah benar, tetapi progress gagal disimpan. Silakan klik Cek Jawaban lagi.'
                                );
                            }
                        } else {
                            progressSudahDisimpan = false;

                            setSummary(
                                'no',
                                `Skor kamu <b>${skor}/5</b>. Masih ada jawaban yang perlu diperbaiki.`
                            );
                        }

                        setFeedback(
                            skor === 5 ? 'ok' : 'no',
                            `
                                                <div style="font-weight:700; margin-bottom:10px;">Penjelasan setiap soal:</div>

                                                <div style="margin-bottom:12px; text-align:justify;">
                                                    <b>1. $(a+b)^3 = a^3 + 3a^2b + 3ab^2 + b^3$ → IDENTITAS</b><br>
                                                    Ini adalah rumus baku <b>kubik penjumlahan dua suku</b>. Jika bentuk $(a+b)^3$
                                                    dikembangkan, hasilnya selalu:
                                                    $$ (a+b)^3 = a^3 + 3a^2b + 3ab^2 + b^3 $$
                                                    Karena berlaku untuk semua nilai $a$ dan $b$, maka ini adalah
                                                    <b>identitas polinomial</b>.
                                                </div>

                                                <div style="margin-bottom:12px; text-align:justify;">
                                                    <b>2. $(2y+5)(2y-5) = 4y^2 - 10y - 25$ → BUKAN IDENTITAS</b><br>
                                                    Bentuk ruas kiri mengikuti pola <b>selisih dua kuadrat</b>:
                                                    $$ (a+b)(a-b)=a^2-b^2 $$
                                                    dengan $a=2y$ dan $b=5$, sehingga:
                                                    $$ (2y+5)(2y-5)=4y^2-25 $$
                                                    Jadi ruas kanan yang benar seharusnya <b>$4y^2-25$</b>, bukan
                                                    <b>$4y^2-10y-25$</b>. Maka pernyataan ini <b>bukan identitas</b>.
                                                </div>

                                                <div style="margin-bottom:12px; text-align:justify;">
                                                    <b>3. $(x+a)(x-a) = x^2 - a^2$ → IDENTITAS</b><br>
                                                    Ini merupakan rumus <b>selisih dua kuadrat</b>:
                                                    $$ (x+a)(x-a)=x^2-a^2 $$
                                                    Bentuk tersebut selalu benar untuk semua nilai $x$ dan $a$.
                                                </div>

                                                <div style="margin-bottom:12px; text-align:justify;">
                                                    <b>4. $(x-4)^2 = x^2 - 4$ → BUKAN IDENTITAS</b><br>
                                                    Gunakan rumus <b>kuadrat selisih dua suku</b>:
                                                    $$ (a-b)^2 = a^2 - 2ab + b^2 $$
                                                    dengan $a=x$ dan $b=4$, maka:
                                                    $$ (x-4)^2 = x^2 - 8x + 16 $$
                                                    Jadi hasilnya bukan <b>$x^2-4$</b>.
                                                </div>

                                                <div style="margin-bottom:4px; text-align:justify;">
                                                    <b>5. $a^3 + b^3 = (a+b)(a^2-ab+b^2)$ → IDENTITAS</b><br>
                                                    Ini adalah rumus baku <b>jumlah dua kubik</b>:
                                                    $$ a^3 + b^3 = (a+b)(a^2-ab+b^2) $$
                                                    Bentuk ini selalu benar untuk semua nilai $a$ dan $b$, jadi termasuk
                                                    <b>identitas polinomial</b>.
                                                </div>
                                                `
                        );

                        rerenderMath();
                    });

                    btnReset?.addEventListener('click', function () {
                        progressSudahDisimpan = false;
                        clearSelected();

                        const cardsInZones = root.querySelectorAll(
                            '#zone-identitas-lima .drag-item, #zone-bukan-lima .drag-item'
                        );

                        cardsInZones.forEach((card) => {
                            bank.appendChild(card);
                        });

                        if (summary) {
                            summary.className = 'drag-summary';
                            summary.innerHTML = '';
                        }

                        if (feedback) {
                            feedback.className = 'drag-feedback';
                            feedback.innerHTML = '';
                        }

                        rerenderMath();
                    });

                    initDragAndTapItems();
                    rerenderMath();
                })();

                /* =====================================================
                   INIT AKHIR
                ===================================================== */
                window.addEventListener('load', function () {
                    setTimeout(() => {
                        renderMathSafe(document.body);
                    }, 300);
                });
            </script>
        </div>
    </div>
@endsection

@section('nav')
    @php
        $isNextUnlocked = $nextMateri ? in_array($nextMateri->slug, $unlockedSlugs ?? []) : false;
        $isCurrentMateriCompleted = $materialProgress?->is_completed ?? false;
    @endphp

    {{-- PREVIOUS --}}
    @if ($previousMateri)
        <a href="{{ route('materi.show', $previousMateri->slug) }}" class="btn-nav prev-btn">
            ← Previous
        </a>
    @else
        <a href="{{ route('pendahuluan') }}" class="btn-nav prev-btn">
            ← Previous
        </a>
    @endif

    {{-- NEXT / KUIS --}}
    @if ($nextMateri && $isNextUnlocked)
        <a id="nextMateriBtn" href="{{ route('materi.show', $nextMateri->slug) }}" class="btn-nav next-btn">
            Next →
        </a>
    @elseif ($nextMateri && !$isNextUnlocked)
        <span id="nextMateriBtn" class="btn-nav next-btn disabled" data-next-url="{{ route('materi.show', $nextMateri->slug) }}"
            style="opacity:.65; cursor:not-allowed;">
            🔒 Next
        </span>
    @elseif ($quizBab && $isCurrentMateriCompleted)
        <a id="quizBabBtn" href="{{ route('quiz.show', $quizBab->id) }}" class="btn-nav next-btn">
            Kuis →
        </a>
    @elseif ($quizBab && !$isCurrentMateriCompleted)
        <span id="quizBabBtn" class="btn-nav next-btn disabled" data-quiz-url="{{ route('quiz.show', $quizBab->id) }}"
            style="opacity:.65; cursor:not-allowed;">
            🔒 Kuis
        </span>
    @else
        <span class="btn-nav next-btn disabled">
            Next →
        </span>
    @endif
@endsection