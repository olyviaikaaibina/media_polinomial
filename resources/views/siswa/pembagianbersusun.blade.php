@extends('layout.halamanmateri')

@section('content')
    {{-- =========================
    KaTeX
    ========================== --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/contrib/auto-render.min.js"></script>

    <style>
        :root {
            --primary-green: #1f7a34;
            --green-soft: #eef8ef;
            --green-border: #b9dec0;
            --orange: #e27a2f;
            --orange-soft: #fff5ee;
            --text-dark: #404040;
            --text-soft: #6b6b6b;
            --border-soft: #e6ddd3;
            --card-bg: #fffdfb;
            --section-bg: #f7efe9;
            --slot-bg: #fcfcfc;
            --slot-border: #d8d2cb;
            --correct: #2f8f46;
            --correct-soft: rgba(47, 143, 70, .12);
            --wrong: #d84a3a;
            --wrong-soft: rgba(216, 74, 58, .12);
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        .materi-wrap {
            max-width: 1020px;
            margin: 0 auto;
            padding: 14px 10px 32px;
            font-family: "Georgia", "Times New Roman", serif;
            color: var(--text-dark);
        }

        .bab-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary-green);
            margin: 8px 0 20px;
        }

        .bab-title .label {
            color: #1b1b1b;
            margin-right: 6px;
        }

        .tujuan-card,
        .content-card,
        .info-card,
        .contoh-card,
        .step-card,
        .final-result,
        .langkah-putih-card,
        .latihan-card,
        .langkah-stack-card {
            background: var(--white);
            border: 1px solid var(--border-soft);
            border-radius: 18px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, .04);
        }

        .tujuan-card {
            background: #f5ede6;
            border-left: 6px solid var(--orange);
        }

        .tujuan-title,
        .mini-title,
        .sub-title {
            color: var(--primary-green);
            font-weight: 700;
        }

        .tujuan-title {
            font-size: 20px;
            margin-bottom: 12px;
        }

        .tujuan-card ol {
            margin: 0;
            padding-left: 22px;
        }

        .materi-paragraf,
        .tujuan-card li,
        .content-card p,
        .content-card li,
        .info-card p,
        .info-card li,
        .contoh-card p,
        .contoh-card li,
        .step-question,
        .step-feedback,
        .final-result p,
        .bersusun-intro,
        .langkah-putih-card li,
        .latihan-card p,
        .latihan-card li,
        .latihan-note,
        .hasil-chip {
            font-size: 16px;
            line-height: 1.9;
        }

        .materi-paragraf {
            text-align: justify;
            margin: 0 0 20px;
        }

        .content-card {
            background: var(--section-bg);
            border-left: 6px solid var(--orange);
        }

        .latihan-card {
            background: #fffaf6;
            border-left: 6px solid var(--orange);
        }

        .mini-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 20px;
            margin-bottom: 14px;
        }

        .mini-icon {
            font-size: 20px;
        }

        .rumus-box {
            text-align: center;
            margin: 14px 0;
            overflow-x: auto;
            padding: 8px 6px;
        }

        .rumus-inline {
            display: inline-block;
            padding: 2px 4px;
        }

        .jawaban-status,
        .step-feedback {
            display: none;
            margin-top: 12px;
            padding: 12px 14px;
            border-radius: 14px;
            font-size: 14.5px;
            font-weight: 700;
        }

        .jawaban-status.correct,
        .step-feedback.correct {
            display: block;
            color: #1f6830;
            background: rgba(47, 143, 70, .10);
            border: 1px solid rgba(47, 143, 70, .26);
        }

        .jawaban-status.wrong,
        .step-feedback.wrong {
            display: block;
            color: #9a362c;
            background: rgba(216, 74, 58, .09);
            border: 1px solid rgba(216, 74, 58, .24);
        }

        .opsi-grid {
            display: grid;
            gap: 10px;
        }

        .opsi-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1px solid #e4d6ca;
            background: #fffdf9;
            border-radius: 14px;
            padding: 12px 14px;
            cursor: pointer;
            transition: .2s ease;
            text-align: left;
            font-family: inherit;
        }

        .opsi-btn:hover {
            background: #f7ece3;
        }

        .opsi-number {
            min-width: 34px;
            height: 34px;
            border-radius: 10px;
            background: #f0c9aa;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #5b3b26;
            border: 1px solid #ddb28c;
            flex-shrink: 0;
        }

        .opsi-btn.correct {
            border-color: rgba(47, 143, 70, .35);
            background: rgba(47, 143, 70, .10);
        }

        .opsi-btn.wrong {
            border-color: rgba(216, 74, 58, .35);
            background: rgba(216, 74, 58, .08);
        }

        .section-label {
            display: inline-block;
            background: #efb296;
            border: 2px solid #ea6c2c;
            border-radius: 999px;
            padding: 8px 18px;
            font-size: 16px;
            font-weight: 700;
            color: #1d1d1d;
            margin-bottom: 12px;
        }

        .info-card {
            border-left: 6px solid #79c661;
        }

        .info-card ul,
        .contoh-card ul,
        .latihan-card ul {
            margin: 8px 0 0 22px;
            padding-left: 16px;
        }

        .ilustrasi-actions,
        .contoh-actions,
        .step-btn-row,
        .latihan-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 14px;
        }

        .btn-materi {
            border: none;
            border-radius: 12px;
            padding: 10px 16px;
            font-family: inherit;
            font-size: 14.5px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .btn-primary {
            background: var(--primary-green);
            color: #fff;
        }

        .btn-secondary {
            background: var(--orange);
            color: #fff;
        }

        .btn-muted {
            background: #f3ebe4;
            color: #5b4b3f;
            border: 1px solid #dccbbe;
        }

        .btn-materi:hover {
            opacity: .92;
        }

        .ilustrasi-content,
        .step-interaktif-wrap {
            display: none;
            margin-top: 16px;
        }

        .ilustrasi-content.show,
        .step-interaktif-wrap.show {
            display: block;
        }

        .langkah-item {
            background: #fff;
            border: 1px solid #e6ece6;
            border-left: 4px solid #79c661;
            border-radius: 14px;
            padding: 14px 16px;
            margin-bottom: 12px;
            display: none;
        }

        .langkah-item.show {
            display: block;
        }

        .langkah-item-title {
            font-weight: 700;
            color: var(--primary-green);
            margin-bottom: 8px;
        }

        .result-box,
        .final-result {
            display: none;
            background: var(--green-soft);
            border: 1px solid var(--green-border);
            border-radius: 16px;
            padding: 16px;
            margin-top: 14px;
        }

        .result-box.show,
        .final-result.show {
            display: block;
        }

        .step-progress {
            background: #f7f2ec;
            border: 1px solid #eadccf;
            border-radius: 14px;
            padding: 12px 14px;
            margin-bottom: 14px;
            font-size: 15px;
            color: #5d5248;
        }

        .step-card {
            display: none;
            border-left: 6px solid #ea6c2c;
            background: #fffdfb;
        }

        .step-card.active {
            display: block;
        }

        .step-card.done {
            border-left-color: #79c661;
            background: #fcfffc;
        }

        .step-label {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary-green);
            margin-bottom: 8px;
        }

        .step-answer-input {
            width: 100%;
            border: 1px solid #d8cbbf;
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 15px;
            font-family: inherit;
            color: #333;
            background: #fff;
            outline: none;
        }

        .step-answer-input:focus {
            border-color: #79c661;
            box-shadow: 0 0 0 3px rgba(121, 198, 97, .12);
        }

        .step-helper {
            font-size: 13.5px;
            color: #7b6f66;
            margin-top: 8px;
            line-height: 1.7;
        }

        .step-next-btn {
            display: none;
        }

        .step-next-btn.show {
            display: inline-block;
        }

        .step-solution {
            margin-top: 10px;
            padding: 12px 14px;
            border-radius: 12px;
            background: #fff;
            border: 1px dashed rgba(47, 143, 70, .35);
        }

        .bersusun-section {
            margin-top: 30px;
        }

        .bersusun-title {
            font-size: 19px;
            font-weight: 700;
            color: var(--primary-green);
            margin: 0 0 10px;
        }

        .bersusun-title .number {
            color: #111;
            margin-right: 8px;
        }

        .bersusun-intro {
            text-align: justify;
            margin-bottom: 18px;
        }

        .definisi-wrap {
            position: relative;
            margin: 14px 0 18px;
            padding-top: 22px;
        }

        .definisi-tab {
            position: absolute;
            top: 0;
            left: 0;
            min-width: 185px;
            height: 48px;
            background: #9bc883;
            border: 2px solid #3f9a40;
            color: #1d251a;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            font-weight: 700;
            border-radius: 0 999px 999px 0;
            z-index: 2;
        }

        .definisi-box {
            background: #eba992;
            border: 2px solid #ea6c2c;
            border-radius: 0 12px 12px 12px;
            padding: 30px 18px 12px;
            margin-left: 10px;
        }

        .definisi-box p,
        .definisi-box li {
            font-size: 16px;
            line-height: 1.9;
            color: #222;
        }

        .langkah-bersusun-title {
            font-size: 17px;
            font-weight: 700;
            color: var(--primary-green);
            margin: 10px 0 10px;
        }

        .langkah-putih-card {
            background: #fff;
            border: 1px solid #e5dfd3;
            border-left: 6px solid #79c661;
        }

        .langkah-putih-card ol {
            margin: 0;
            padding-left: 22px;
        }

        .contoh-soft-box {
            background: var(--orange-soft);
            border: 1px solid #f0cfbd;
            border-radius: 12px;
            padding: 12px 14px;
            margin-top: 14px;
        }

        /* ====== PENGGANTI TAMPILAN GARIS-GARIS ====== */
        .langkah-stack-wrap {
            display: grid;
            gap: 12px;
            margin-top: 14px;
        }

        .langkah-stack-card {
            margin-bottom: 0;
            background: #fff;
            border-left: 6px solid #79c661;
        }

        .stack-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .stack-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary-green);
        }

        .stack-chip {
            background: #eef6ee;
            color: #1f6830;
            border: 1px solid #c9e3ce;
            border-radius: 999px;
            padding: 6px 12px;
            font-size: 13px;
            font-weight: 700;
        }

        .stack-body {
            display: grid;
            gap: 10px;
        }

        .stack-row {
            background: #faf8f6;
            border: 1px solid #e8ddd2;
            border-radius: 14px;
            padding: 12px 14px;
        }

        .stack-row-label {
            font-size: 13px;
            font-weight: 700;
            color: #7a6656;
            margin-bottom: 4px;
            letter-spacing: .2px;
        }

        .hasil-akhir-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-top: 14px;
        }

        .hasil-chip {
            background: #fff;
            border: 1px solid #dbeadf;
            border-radius: 14px;
            padding: 14px;
            color: #1f6830;
            font-weight: 700;
        }

        /* ====== LATIHAN DRAG AND DROP ====== */
        .latihan-dnd-board {
            background: #edf1f1;
            border: 1px solid #d7dddd;
            border-radius: 18px;
            padding: 18px;
            margin-top: 12px;
        }

        .latihan-dnd-soal {
            background: #dbe9ef;
            border: 1px solid #b3cad5;
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 16px;
            color: #3f4e57;
            margin-bottom: 16px;
            line-height: 1.8;
        }

        .latihan-note {
            background: #fff;
            border: 1px solid #e6ddd2;
            border-radius: 14px;
            padding: 12px 14px;
            margin-bottom: 16px;
            color: #5e544c;
        }

        .latihan-dnd-wrap {
            display: grid;
            grid-template-columns: 1.05fr 1fr;
            gap: 18px;
            align-items: start;
        }

        .bank-panel,
        .slot-panel {
            background: #f9f9f9;
            border: 1px solid #d9d9d9;
            border-radius: 16px;
            padding: 14px;
        }

        .panel-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary-green);
            margin-bottom: 12px;
        }

        .drag-bank,
        .drop-zone-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .drag-card {
            background: #ffffff;
            border: 1px solid #d8d3cc;
            border-radius: 14px;
            padding: 13px 14px;
            cursor: grab;
            line-height: 1.7;
            color: #434343;
            transition: .2s ease;
            user-select: none;
            box-shadow: 0 2px 7px rgba(0, 0, 0, .03);
        }

        .drag-card:hover {
            background: #fcfaf8;
            transform: translateY(-1px);
        }

        .drag-card.dragging {
            opacity: .45;
        }

        .drag-card.locked-correct {
            background: var(--correct-soft);
            border-color: rgba(47, 143, 70, .45);
            color: #1f6830;
            cursor: default;
            box-shadow: none;
        }

        .drop-slot {
            min-height: 70px;
            background: var(--slot-bg);
            border: 2px dashed var(--slot-border);
            border-radius: 14px;
            padding: 10px 12px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 8px;
            transition: .2s ease;
        }

        .drop-slot.drag-over {
            border-color: #7ba7b8;
            background: #eef6f9;
        }

        .drop-slot.correct {
            background: var(--correct-soft);
            border-color: rgba(47, 143, 70, .50);
        }

        .drop-slot.wrong {
            background: var(--wrong-soft);
            border-color: rgba(216, 74, 58, .50);
        }

        .drop-slot .drop-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
        }

        .drop-slot .drop-label {
            color: #655a51;
            font-size: 14px;
            font-weight: 700;
        }

        .drop-slot .drop-hint {
            color: #8a7d71;
            font-size: 13px;
        }

        .drop-slot.filled .drop-hint {
            display: none;
        }

        .drop-slot .drag-card {
            width: 100%;
            margin: 0;
        }

        .status-kecil {
            font-size: 12px;
            font-weight: 700;
            border-radius: 999px;
            padding: 4px 10px;
            display: inline-flex;
            align-items: center;
            width: fit-content;
        }

        .status-kecil.netral {
            background: #f3eee8;
            color: #79695d;
            border: 1px solid #e1d5c8;
        }

        .status-kecil.benar {
            background: rgba(47, 143, 70, .12);
            color: #1f6830;
            border: 1px solid rgba(47, 143, 70, .30);
        }

        .status-kecil.salah {
            background: rgba(216, 74, 58, .10);
            color: #9a362c;
            border: 1px solid rgba(216, 74, 58, .26);
        }

        .progress-dnd {
            margin-top: 16px;
            background: #fff;
            border: 1px solid #dfd7cf;
            border-radius: 14px;
            padding: 12px 14px;
            color: #5a4f46;
            font-size: 14.5px;
        }

        .latihan-actions {
            margin-top: 16px;
        }

        @media (max-width: 900px) {

            .latihan-dnd-wrap,
            .hasil-akhir-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .materi-wrap {
                padding: 8px 2px 22px;
            }

            .bab-title {
                font-size: 23px;
            }

            .tujuan-card,
            .content-card,
            .info-card,
            .contoh-card,
            .step-card,
            .final-result,
            .langkah-putih-card,
            .latihan-card,
            .langkah-stack-card {
                padding: 16px;
            }

            .ilustrasi-actions,
            .contoh-actions,
            .step-btn-row,
            .latihan-actions {
                flex-direction: column;
            }

            .btn-materi {
                width: 100%;
            }

            .materi-paragraf,
            .tujuan-card li,
            .content-card p,
            .content-card li,
            .info-card p,
            .info-card li,
            .contoh-card p,
            .contoh-card li,
            .step-question,
            .step-feedback,
            .final-result p,
            .bersusun-intro,
            .langkah-putih-card li,
            .latihan-card p,
            .latihan-card li,
            .latihan-note,
            .hasil-chip {
                font-size: 15px;
            }

            .definisi-tab {
                min-width: 145px;
                height: 42px;
                font-size: 14px;
            }

            .definisi-box {
                padding: 28px 14px 10px;
                margin-left: 0;
            }

            .latihan-dnd-soal,
            .drag-card {
                font-size: 14px;
            }
        }

        .latihan-dnd-board {
            background: #edf1f1;
            border: 1px solid #d7dddd;
            border-radius: 18px;
            padding: 18px;
            margin-top: 12px;
            max-height: 78vh;
            overflow-y: auto;
            scroll-behavior: smooth;
        }

        .bank-panel,
        .slot-panel {
            background: #f9f9f9;
            border: 1px solid #d9d9d9;
            border-radius: 16px;
            padding: 14px;
            min-height: 200px;
        }

        .slot-panel {
            max-height: 62vh;
            overflow-y: auto;
            scroll-behavior: smooth;
        }

        .drag-bank {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-height: 62vh;
            overflow-y: auto;
            padding-right: 4px;
        }

        .drop-zone-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            min-height: 100%;
        }

        @media (max-width: 900px) {
            .latihan-dnd-board {
                max-height: none;
                overflow: visible;
            }

            .slot-panel,
            .drag-bank {
                max-height: none;
                overflow: visible;
            }
        }
    </style>

    <div class="materi-wrap">
        <div class="bab-title">
            <span class="label">C.</span> Pembagian Polinomial
        </div>

        <div class="tujuan-card">
            <div class="tujuan-title">Tujuan Pembelajaran</div>
            <ol>
                <li>Melakukan pembagian polinomial serta menerapkan teorema sisa dalam perhitungannya.</li>
            </ol>
        </div>

        <p class="materi-paragraf">
            Sama seperti pembagian pada bilangan real, pembagian polinomial dilakukan dengan membagi suku
            berpangkat tertinggi pada pembilang dengan suku berpangkat tertinggi pada penyebut. Hasil pembagian
            tersebut dipakai untuk membentuk langkah kali dan kurang, lalu proses diulang sampai derajat sisa
            lebih kecil daripada derajat penyebut.
        </p>

        <div class="content-card">
            <div class="mini-title">
                <span class="mini-icon">🧭</span>
                <span>Eksplorasi</span>
            </div>

            <p>
                Di daerah Banjarmasin, banyak lahan rawa dimanfaatkan untuk pertanian. Seorang petani ingin membagi
                lahannya menjadi beberapa petak yang ukurannya sama agar lebih mudah dirawat.
            </p>

            <p>Luas lahan dinyatakan oleh:</p>

            <div class="rumus-box">
                $$x^2 + 5x + 6$$
            </div>

            <p>
                Setiap petak direncanakan berukuran
                <span class="rumus-inline">\(x + 1\)</span>
                hektar.
            </p>

            <p>
                Untuk mengetahui banyak petak yang terbentuk dan apakah ada sisa, kita perlu menggunakan konsep
                pembagian polinomial.
            </p>

            <div class="eks-soal-wrap">
                <div class="mini-title" style="font-size:18px; margin-top: 18px;">
                    <span class="mini-icon">❓</span>
                    <span>Pertanyaan</span>
                </div>

                <div class="eks-soal" data-answer="3"
                    style="background: rgba(255,255,255,.65); border:1px solid #e9ddd1; border-radius:14px; padding:16px; margin-bottom:16px;">
                    <div class="eks-pertanyaan" style="margin-bottom:12px;">
                        1. Operasi yang paling tepat untuk menentukan banyak petak dan sisa lahan adalah ....
                    </div>

                    <div class="opsi-grid">
                        <button type="button" class="opsi-btn" data-choice="1">
                            <span class="opsi-number">1</span>
                            <span class="opsi-text">Penjumlahan polinomial</span>
                        </button>
                        <button type="button" class="opsi-btn" data-choice="2">
                            <span class="opsi-number">2</span>
                            <span class="opsi-text">Perkalian polinomial</span>
                        </button>
                        <button type="button" class="opsi-btn" data-choice="3">
                            <span class="opsi-number">3</span>
                            <span class="opsi-text">Pembagian polinomial</span>
                        </button>
                    </div>

                    <div class="jawaban-status"></div>
                </div>

                <div class="eks-soal" data-answer="2"
                    style="background: rgba(255,255,255,.65); border:1px solid #e9ddd1; border-radius:14px; padding:16px; margin-bottom:16px;">
                    <div class="eks-pertanyaan" style="margin-bottom:12px;">
                        2. Hasil bagi dari
                        <div class="rumus-box">$$(x^2 + 5x + 6)\div(x+1)$$</div>
                        adalah ....
                    </div>

                    <div class="opsi-grid">
                        <button type="button" class="opsi-btn" data-choice="1">
                            <span class="opsi-number">1</span>
                            <span class="opsi-text">\(x+3\)</span>
                        </button>
                        <button type="button" class="opsi-btn" data-choice="2">
                            <span class="opsi-number">2</span>
                            <span class="opsi-text">\(x+4\)</span>
                        </button>
                        <button type="button" class="opsi-btn" data-choice="3">
                            <span class="opsi-number">3</span>
                            <span class="opsi-text">\(x+5\)</span>
                        </button>
                    </div>

                    <div class="jawaban-status"></div>
                </div>

                <div class="eks-soal" data-answer="1"
                    style="background: rgba(255,255,255,.65); border:1px solid #e9ddd1; border-radius:14px; padding:16px;">
                    <div class="eks-pertanyaan" style="margin-bottom:12px;">
                        3. Sisa pembagian tersebut adalah ....
                    </div>

                    <div class="opsi-grid">
                        <button type="button" class="opsi-btn" data-choice="1">
                            <span class="opsi-number">1</span>
                            <span class="opsi-text">\(2\)</span>
                        </button>
                        <button type="button" class="opsi-btn" data-choice="2">
                            <span class="opsi-number">2</span>
                            <span class="opsi-text">\(1\)</span>
                        </button>
                        <button type="button" class="opsi-btn" data-choice="3">
                            <span class="opsi-number">3</span>
                            <span class="opsi-text">\(0\)</span>
                        </button>
                    </div>

                    <div class="jawaban-status"></div>
                </div>
            </div>
        </div>

        <div class="section-label">SIFAT</div>
        <div class="info-card">
            <p>
                Jika \(P(x)\) dan \(Q(x)\) adalah polinomial dengan \(Q(x)\neq 0\), maka ada polinomial tunggal
                \(H(x)\) dan \(S(x)\) sehingga:
            </p>

            <div class="rumus-box">
                $$P(x)=Q(x)\cdot H(x)+S(x)$$
            </div>

            <p>
                dengan syarat \(S(x)=0\) atau \(\deg S(x) < \deg Q(x)\). </p>

                    <p>
                        Pada bentuk ini:
                    </p>

                    <ul>
                        <li>\(Q(x)\) disebut <b>pembagi</b>,</li>
                        <li>\(H(x)\) disebut <b>hasil bagi</b>,</li>
                        <li>\(S(x)\) disebut <b>sisa</b>.</li>
                    </ul>
        </div>

        <div class="section-label">ILUSTRASI</div>
        <div class="info-card">
            <p>
                Klik tombol di bawah untuk membuka langkah-langkah pembagian polinomial satu per satu.
            </p>

            <div class="ilustrasi-actions">
                <button type="button" class="btn-materi btn-primary" id="btnShowIlustrasi">Tampilkan Ilustrasi</button>
                <button type="button" class="btn-materi btn-secondary" id="btnNextLangkah">Buka Langkah 1</button>
                <button type="button" class="btn-materi btn-muted" id="btnResetLangkah">Ulangi</button>
            </div>

            <div class="ilustrasi-content" id="ilustrasiContent">
                <div class="info-card" style="margin-bottom: 14px;">
                    <p><b>Ilustrasi pembagian:</b></p>
                    <div class="rumus-box">
                        $$\frac{2x^3+9x^2+4x+7}{x+2}=2x^2+5x-6+\frac{19}{x+2}$$
                    </div>
                    <p style="text-align:center; margin:6px 0;"><b>atau</b></p>
                    <div class="rumus-box">
                        $$2x^3+9x^2+4x+7=(x+2)(2x^2+5x-6)+19$$
                    </div>
                </div>

                <div class="langkah-item" id="langkahBox1">
                    <div class="langkah-item-title">Langkah 1</div>
                    <p>Bagi suku tertinggi pembilang dengan suku tertinggi penyebut.</p>
                    <div class="rumus-box">$$\frac{2x^3}{x}=2x^2$$</div>
                </div>

                <div class="langkah-item" id="langkahBox2">
                    <div class="langkah-item-title">Langkah 2</div>
                    <p>Kalikan \(2x^2\) dengan pembagi \((x+2)\).</p>
                    <div class="rumus-box">$$2x^2(x+2)=2x^3+4x^2$$</div>
                </div>

                <div class="langkah-item" id="langkahBox3">
                    <div class="langkah-item-title">Langkah 3</div>
                    <p>Kurangkan hasil tersebut dari polinomial semula.</p>
                    <div class="rumus-box">$$(2x^3+9x^2+4x+7)-(2x^3+4x^2)=5x^2+4x+7$$</div>
                </div>

                <div class="langkah-item" id="langkahBox4">
                    <div class="langkah-item-title">Langkah 4</div>
                    <p>Bagi suku tertinggi sisa dengan \(x\).</p>
                    <div class="rumus-box">$$\frac{5x^2}{x}=5x$$</div>
                </div>

                <div class="langkah-item" id="langkahBox5">
                    <div class="langkah-item-title">Langkah 5</div>
                    <p>Kalikan \(5x\) dengan \((x+2)\).</p>
                    <div class="rumus-box">$$5x(x+2)=5x^2+10x$$</div>
                </div>

                <div class="langkah-item" id="langkahBox6">
                    <div class="langkah-item-title">Langkah 6</div>
                    <p>Kurangkan lagi.</p>
                    <div class="rumus-box">$$(5x^2+4x+7)-(5x^2+10x)=-6x+7$$</div>
                </div>

                <div class="langkah-item" id="langkahBox7">
                    <div class="langkah-item-title">Langkah 7</div>
                    <p>Bagi suku tertinggi sisa dengan \(x\).</p>
                    <div class="rumus-box">$$\frac{-6x}{x}=-6$$</div>
                </div>

                <div class="langkah-item" id="langkahBox8">
                    <div class="langkah-item-title">Langkah 8</div>
                    <p>Kalikan \(-6\) dengan \((x+2)\).</p>
                    <div class="rumus-box">$$-6(x+2)=-6x-12$$</div>
                </div>

                <div class="langkah-item" id="langkahBox9">
                    <div class="langkah-item-title">Langkah 9</div>
                    <p>Kurangkan lagi untuk memperoleh sisa akhir.</p>
                    <div class="rumus-box">$$(-6x+7)-(-6x-12)=19$$</div>
                </div>

                <div class="result-box" id="hasilBox">
                    <p><b>Hasil akhir:</b></p>
                    <div class="rumus-box">
                        $$2x^3+9x^2+4x+7=(x+2)(2x^2+5x-6)+19$$
                    </div>
                    <p>Hasil bagi: <b>\(2x^2+5x-6\)</b></p>
                    <p>Sisa: <b>\(19\)</b></p>
                </div>
            </div>
        </div>

        <div class="bersusun-section">
            <div class="bersusun-title">
                <span class="number">1.</span> Pembagian Bersusun
            </div>

            <p class="bersusun-intro">
                Metode pembagian bersusun dilakukan dengan pola berulang: <b>bagi</b>, <b>kali</b>, lalu
                <b>kurang</b>. Proses tersebut diulangi hingga derajat sisa lebih kecil daripada derajat penyebut.
            </p>

            <div class="definisi-wrap">
                <div class="definisi-tab">DEFINISI</div>
                <div class="definisi-box">
                    <p>Bentuk umum pembagian polinomial adalah:</p>

                    <div class="rumus-box">
                        $$P(x)=D(x)\cdot Q(x)+R(x)$$
                    </div>

                    <p>dengan:</p>
                    <ul>
                        <li>\(Q(x)\) = hasil bagi</li>
                        <li>\(R(x)\) = sisa pembagian</li>
                        <li>\(\deg R(x) < \deg D(x)\)</li>
                    </ul>
                </div>
            </div>

            <div class="langkah-bersusun-title">Langkah-Langkah Pembagian Bersusun</div>

            <div class="langkah-putih-card">
                <ol>
                    <li>Urutkan polinomial dari pangkat tertinggi ke pangkat terendah.</li>
                    <li>Bagi suku tertinggi pembilang dengan suku tertinggi penyebut.</li>
                    <li>Kalikan hasil bagi sementara dengan seluruh penyebut.</li>
                    <li>Kurangkan dari polinomial yang sedang dikerjakan.</li>
                    <li>Ulangi langkah-langkah tersebut sampai sisa memenuhi syarat.</li>
                </ol>
            </div>
        </div>
        <div class="section-label">CONTOH</div>
        <div class="contoh-card">
            <div class="mini-title">
                <span class="mini-icon">📘</span>
                <span>Contoh Pembagian Bersusun</span>
            </div>

            <p>Kerjakan pembagian polinomial berikut dengan pembagian bersusun:</p>

            <div class="rumus-box">
                $$\frac{2x^3+3x^2-2x+1}{x+1}$$
            </div>

            <ul>
                <li>Tentukan hasil bagi \(h(x)\)</li>
                <li>Tentukan sisa \(s\)</li>
            </ul>

            <div class="contoh-actions">
                <button type="button" class="btn-materi btn-primary" id="btnMulaiContoh">Mulai Penyelesaian</button>
                <button type="button" class="btn-materi btn-muted" id="btnResetContoh">Reset</button>
            </div>

            <div class="step-interaktif-wrap" id="stepInteraktifWrap">
                <div class="step-card" id="stepCard1">
                    <div class="step-label">Langkah 1</div>
                    <div class="step-question">
                        Bagi suku tertinggi pembilang dengan suku tertinggi penyebut.
                        <div class="rumus-box">$$\frac{2x^3}{x}=2x^2$$</div>
                        Tuliskan suku pertama hasil bagi.
                    </div>

                    <div class="contoh-soft-box" style="margin-bottom:12px;">
                        <p style="margin:0;">
                            <b>Cara menjawab:</b> bagi koefisien \(2 : 1\), lalu kurangi pangkat variabel
                            \(x^3 : x = x^2\). Hasil akhirnya berbentuk satu suku.
                        </p>
                    </div>

                    <input type="text" class="step-answer-input" id="answer1" placeholder="Contoh: 2x^2">
                    <div class="step-helper">Bagi koefisien, lalu kurangi pangkat variabel.</div>

                    <div class="step-btn-row">
                        <button type="button" class="btn-materi btn-primary step-submit-btn" data-step="1">Cek
                            Jawaban</button>
                        <button type="button" class="btn-materi btn-secondary step-next-btn" id="nextBtn1">Langkah
                            Berikutnya</button>
                    </div>

                    <div class="step-feedback" id="feedback1"></div>
                </div>

                <div class="step-card" id="stepCard2">
                    <div class="step-label">Langkah 2</div>
                    <div class="step-question">
                        Kalikan suku hasil bagi pertama dengan penyebut.
                        <div class="rumus-box">$$2x^2(x+1)=2x^3+2x^2$$</div>
                        Tuliskan hasil perkaliannya.
                    </div>

                    <div class="contoh-soft-box" style="margin-bottom:12px;">
                        <p style="margin:0;">
                            <b>Cara menjawab:</b> gunakan distributif. Kalikan \(2x^2\) ke setiap suku
                            di dalam \((x+1)\), lalu gabungkan hasilnya.
                        </p>
                    </div>

                    <input type="text" class="step-answer-input" id="answer2" placeholder="Contoh: 2x^3+2x^2">
                    <div class="step-helper">Gunakan sifat distributif.</div>

                    <div class="step-btn-row">
                        <button type="button" class="btn-materi btn-primary step-submit-btn" data-step="2">Cek
                            Jawaban</button>
                        <button type="button" class="btn-materi btn-secondary step-next-btn" id="nextBtn2">Langkah
                            Berikutnya</button>
                    </div>

                    <div class="step-feedback" id="feedback2"></div>
                </div>

                <div class="step-card" id="stepCard3">
                    <div class="step-label">Langkah 3</div>
                    <div class="step-question">
                        Kurangkan hasil perkalian dari pembilang semula.
                        <div class="rumus-box">$$(2x^3+3x^2-2x+1)-(2x^3+2x^2)=x^2-2x+1$$</div>
                        Tuliskan sisa barunya.
                    </div>

                    <div class="contoh-soft-box" style="margin-bottom:12px;">
                        <p style="margin:0;">
                            <b>Cara menjawab:</b> kurangkan suku yang sejenis. Hati-hati pada tanda negatif,
                            karena semua suku pada hasil perkalian ikut berubah tanda saat dikurangkan.
                        </p>
                    </div>

                    <input type="text" class="step-answer-input" id="answer3" placeholder="Contoh: x^2-2x+1">
                    <div class="step-helper">Kurangkan suku-suku yang sejenis.</div>

                    <div class="step-btn-row">
                        <button type="button" class="btn-materi btn-primary step-submit-btn" data-step="3">Cek
                            Jawaban</button>
                        <button type="button" class="btn-materi btn-secondary step-next-btn" id="nextBtn3">Langkah
                            Berikutnya</button>
                    </div>

                    <div class="step-feedback" id="feedback3"></div>
                </div>

                <div class="step-card" id="stepCard4">
                    <div class="step-label">Langkah 4</div>
                    <div class="step-question">
                        Bagi suku tertinggi yang baru dengan \(x\).
                        <div class="rumus-box">$$\frac{x^2}{x}=x$$</div>
                        Tuliskan suku kedua hasil bagi.
                    </div>

                    <div class="contoh-soft-box" style="margin-bottom:12px;">
                        <p style="margin:0;">
                            <b>Cara menjawab:</b> ulangi pola langkah pertama, tetapi sekarang gunakan
                            sisa baru. Ambil suku terdepan dari sisa, lalu bagi dengan suku terdepan penyebut.
                        </p>
                    </div>

                    <input type="text" class="step-answer-input" id="answer4" placeholder="Contoh: x">
                    <div class="step-helper">Suku ini ditambahkan ke hasil bagi sebelumnya.</div>

                    <div class="step-btn-row">
                        <button type="button" class="btn-materi btn-primary step-submit-btn" data-step="4">Cek
                            Jawaban</button>
                        <button type="button" class="btn-materi btn-secondary step-next-btn" id="nextBtn4">Langkah
                            Berikutnya</button>
                    </div>

                    <div class="step-feedback" id="feedback4"></div>
                </div>

                <div class="step-card" id="stepCard5">
                    <div class="step-label">Langkah 5</div>
                    <div class="step-question">
                        Kalikan \(x\) dengan \((x+1)\), lalu kurangkan.
                        <div class="rumus-box">$$x(x+1)=x^2+x$$</div>
                        <div class="rumus-box">$$(x^2-2x+1)-(x^2+x)=-3x+1$$</div>
                        Tuliskan sisa baru yang diperoleh.
                    </div>

                    <div class="contoh-soft-box" style="margin-bottom:12px;">
                        <p style="margin:0;">
                            <b>Cara menjawab:</b> kerjakan dua tahap. Pertama, hasil bagi sementara dikalikan
                            dengan penyebut. Kedua, hasilnya dikurangkan dari sisa sebelumnya.
                        </p>
                    </div>

                    <input type="text" class="step-answer-input" id="answer5" placeholder="Contoh: -3x+1">
                    <div class="step-helper">Perhatikan tanda negatif pada saat pengurangan.</div>

                    <div class="step-btn-row">
                        <button type="button" class="btn-materi btn-primary step-submit-btn" data-step="5">Cek
                            Jawaban</button>
                        <button type="button" class="btn-materi btn-secondary step-next-btn" id="nextBtn5">Langkah
                            Berikutnya</button>
                    </div>

                    <div class="step-feedback" id="feedback5"></div>
                </div>

                <div class="step-card" id="stepCard6">
                    <div class="step-label">Langkah 6</div>
                    <div class="step-question">
                        Selesaikan pembagian sampai akhir.
                        <div class="rumus-box">$$\frac{-3x}{x}=-3$$</div>
                        Tuliskan hasil bagi akhir \(h(x)\) dan sisa \(s\).
                    </div>

                    <div class="contoh-soft-box" style="margin-bottom:12px;">
                        <p style="margin:0;">
                            <b>Cara menjawab:</b> lakukan satu putaran terakhir dengan pola yang sama.
                            Setelah itu, tulis semua suku hasil bagi menjadi satu bentuk, lalu tentukan sisanya.
                        </p>
                    </div>

                    <input type="text" class="step-answer-input" id="answer6" placeholder="Contoh: h(x)=2x^2+x-3, s=4">
                    <div class="step-helper">Tulis dua informasi sekaligus: hasil bagi dan sisa.</div>

                    <div class="step-btn-row">
                        <button type="button" class="btn-materi btn-primary step-submit-btn" data-step="6">Cek
                            Jawaban</button>
                        <button type="button" class="btn-materi btn-muted" id="stepResetBtnAkhir">Ulangi Lagi</button>
                    </div>

                    <div class="step-feedback" id="feedback6"></div>
                </div>

                <div class="final-result" id="stepFinalBox">
                    <p><b>Hasil akhir pembagian:</b></p>

                    <div class="langkah-stack-wrap">
                        <div class="langkah-stack-card">
                            <div class="stack-head">
                                <div class="stack-title">Tahap 1</div>
                                <div class="stack-chip">Bagi</div>
                            </div>
                            <div class="stack-body">
                                <div class="stack-row">
                                    <div class="stack-row-label">Perhitungan</div>
                                    <div class="rumus-box">$$\frac{2x^3}{x}=2x^2$$</div>
                                </div>
                                <div class="stack-row">
                                    <div class="stack-row-label">Suku hasil bagi sementara</div>
                                    <div class="rumus-box">$$2x^2$$</div>
                                </div>
                            </div>
                        </div>

                        <div class="langkah-stack-card">
                            <div class="stack-head">
                                <div class="stack-title">Tahap 2</div>
                                <div class="stack-chip">Kali lalu Kurang</div>
                            </div>
                            <div class="stack-body">
                                <div class="stack-row">
                                    <div class="stack-row-label">Hasil kali</div>
                                    <div class="rumus-box">$$2x^2(x+1)=2x^3+2x^2$$</div>
                                </div>
                                <div class="stack-row">
                                    <div class="stack-row-label">Sisa baru</div>
                                    <div class="rumus-box">$$(2x^3+3x^2-2x+1)-(2x^3+2x^2)=x^2-2x+1$$</div>
                                </div>
                            </div>
                        </div>

                        <div class="langkah-stack-card">
                            <div class="stack-head">
                                <div class="stack-title">Tahap 3</div>
                                <div class="stack-chip">Bagi</div>
                            </div>
                            <div class="stack-body">
                                <div class="stack-row">
                                    <div class="stack-row-label">Perhitungan</div>
                                    <div class="rumus-box">$$\frac{x^2}{x}=x$$</div>
                                </div>
                                <div class="stack-row">
                                    <div class="stack-row-label">Hasil bagi sementara</div>
                                    <div class="rumus-box">$$2x^2+x$$</div>
                                </div>
                            </div>
                        </div>

                        <div class="langkah-stack-card">
                            <div class="stack-head">
                                <div class="stack-title">Tahap 4</div>
                                <div class="stack-chip">Kali lalu Kurang</div>
                            </div>
                            <div class="stack-body">
                                <div class="stack-row">
                                    <div class="stack-row-label">Hasil kali</div>
                                    <div class="rumus-box">$$x(x+1)=x^2+x$$</div>
                                </div>
                                <div class="stack-row">
                                    <div class="stack-row-label">Sisa baru</div>
                                    <div class="rumus-box">$$(x^2-2x+1)-(x^2+x)=-3x+1$$</div>
                                </div>
                            </div>
                        </div>

                        <div class="langkah-stack-card">
                            <div class="stack-head">
                                <div class="stack-title">Tahap 5</div>
                                <div class="stack-chip">Akhir</div>
                            </div>
                            <div class="stack-body">
                                <div class="stack-row">
                                    <div class="stack-row-label">Perhitungan</div>
                                    <div class="rumus-box">$$\frac{-3x}{x}=-3$$</div>
                                </div>
                                <div class="stack-row">
                                    <div class="stack-row-label">Hasil kali dan sisa akhir</div>
                                    <div class="rumus-box">$$-3(x+1)=-3x-3$$</div>
                                    <div class="rumus-box">$$(-3x+1)-(-3x-3)=4$$</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hasil-akhir-grid">
                        <div class="hasil-chip">
                            Hasil bagi:
                            <div class="rumus-box">$$h(x)=2x^2+x-3$$</div>
                        </div>
                        <div class="hasil-chip">
                            Sisa:
                            <div class="rumus-box">$$s=4$$</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-label">LATIHAN</div>
        <div class="latihan-card">
            <div class="mini-title">
                <span class="mini-icon">📝</span>
                <span>Susun Setiap Langkah dengan Benar</span>
            </div>

            <p>
                Geser setiap kartu ke kotak langkah yang sesuai. Jika benar, kartu akan berubah menjadi
                <b>hijau</b> dan tidak bisa dipindah lagi. Jika salah, kartu akan berubah menjadi
                <b>merah</b> lalu kembali sehingga masih bisa dicoba lagi.
            </p>

            <div class="latihan-dnd-board">
                <div class="latihan-dnd-soal">
                    Soal:
                    \[
                    (6x^5 - 4x^4 + 3x^3 - 12x^2 + 7x - 9)\div(2x - 3)
                    \]
                </div>

                <div class="latihan-note">
                    Urutkan langkah berdasarkan pola:
                    <b>bagi → kali → kurang → bagi → kali → kurang</b>, dan seterusnya.
                </div>

                <div class="latihan-dnd-wrap">
                    <div class="bank-panel">
                        <div class="panel-title">Kartu Langkah</div>
                        <div class="drag-bank" id="dragItems">
                            <div class="drag-card" draggable="true" data-order="1">
                                \[
                                \frac{6x^5}{2x}=3x^4
                                \]
                            </div>

                            <div class="drag-card" draggable="true" data-order="2">
                                \[
                                (2x-3)(3x^4)=6x^5-9x^4
                                \]
                            </div>

                            <div class="drag-card" draggable="true" data-order="3">
                                \[
                                -4x^4-(-9x^4)=5x^4
                                \]
                            </div>

                            <div class="drag-card" draggable="true" data-order="4">
                                \[
                                \frac{5x^4}{2x}=\frac{5}{2}x^3
                                \]
                            </div>

                            <div class="drag-card" draggable="true" data-order="5">
                                \[
                                (2x-3)\left(\frac{5}{2}x^3\right)=5x^4-\frac{15}{2}x^3
                                \]
                            </div>

                            <div class="drag-card" draggable="true" data-order="6">
                                \[
                                3x^3-\left(-\frac{15}{2}x^3\right)=\frac{21}{2}x^3
                                \]
                            </div>

                            <div class="drag-card" draggable="true" data-order="7">
                                \[
                                \frac{\frac{21}{2}x^3}{2x}=\frac{21}{4}x^2
                                \]
                            </div>

                            <div class="drag-card" draggable="true" data-order="8">
                                \[
                                (2x-3)\left(\frac{21}{4}x^2\right)=\frac{21}{2}x^3-\frac{63}{4}x^2
                                \]
                            </div>

                            <div class="drag-card" draggable="true" data-order="9">
                                \[
                                -12x^2-\left(-\frac{63}{4}x^2\right)=\frac{15}{4}x^2
                                \]
                            </div>

                            <div class="drag-card" draggable="true" data-order="10">
                                \[
                                \frac{\frac{15}{4}x^2}{2x}=\frac{15}{8}x
                                \]
                            </div>
                        </div>
                    </div>

                    <div class="slot-panel">
                        <div class="panel-title">Susun ke Langkah yang Tepat</div>
                        <div class="drop-zone-list" id="dropZones">
                            <div class="drop-slot" data-step="1">
                                <div class="drop-head">
                                    <span class="drop-label">Langkah 1</span>
                                    <span class="status-kecil netral">Belum diisi</span>
                                </div>
                                <span class="drop-hint">Letakkan kartu untuk tahap awal pembagian.</span>
                            </div>

                            <div class="drop-slot" data-step="2">
                                <div class="drop-head">
                                    <span class="drop-label">Langkah 2</span>
                                    <span class="status-kecil netral">Belum diisi</span>
                                </div>
                                <span class="drop-hint">Biasanya berupa hasil perkalian dengan pembagi.</span>
                            </div>

                            <div class="drop-slot" data-step="3">
                                <div class="drop-head">
                                    <span class="drop-label">Langkah 3</span>
                                    <span class="status-kecil netral">Belum diisi</span>
                                </div>
                                <span class="drop-hint">Lanjutkan dengan pengurangan.</span>
                            </div>

                            <div class="drop-slot" data-step="4">
                                <div class="drop-head">
                                    <span class="drop-label">Langkah 4</span>
                                    <span class="status-kecil netral">Belum diisi</span>
                                </div>
                                <span class="drop-hint">Cari suku hasil bagi berikutnya.</span>
                            </div>

                            <div class="drop-slot" data-step="5">
                                <div class="drop-head">
                                    <span class="drop-label">Langkah 5</span>
                                    <span class="status-kecil netral">Belum diisi</span>
                                </div>
                                <span class="drop-hint">Kalikan suku baru dengan pembagi.</span>
                            </div>

                            <div class="drop-slot" data-step="6">
                                <div class="drop-head">
                                    <span class="drop-label">Langkah 6</span>
                                    <span class="status-kecil netral">Belum diisi</span>
                                </div>
                                <span class="drop-hint">Kurangkan kembali hasilnya.</span>
                            </div>

                            <div class="drop-slot" data-step="7">
                                <div class="drop-head">
                                    <span class="drop-label">Langkah 7</span>
                                    <span class="status-kecil netral">Belum diisi</span>
                                </div>
                                <span class="drop-hint">Cari suku hasil bagi berikutnya lagi.</span>
                            </div>

                            <div class="drop-slot" data-step="8">
                                <div class="drop-head">
                                    <span class="drop-label">Langkah 8</span>
                                    <span class="status-kecil netral">Belum diisi</span>
                                </div>
                                <span class="drop-hint">Tahap perkalian berikutnya.</span>
                            </div>

                            <div class="drop-slot" data-step="9">
                                <div class="drop-head">
                                    <span class="drop-label">Langkah 9</span>
                                    <span class="status-kecil netral">Belum diisi</span>
                                </div>
                                <span class="drop-hint">Kurangi lagi untuk memperoleh bentuk baru.</span>
                            </div>

                            <div class="drop-slot" data-step="10">
                                <div class="drop-head">
                                    <span class="drop-label">Langkah 10</span>
                                    <span class="status-kecil netral">Belum diisi</span>
                                </div>
                                <span class="drop-hint">Tahap pembagian berikutnya.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="progress-dnd" id="dndProgressText">
                    Kemajuan: 0 dari 10 langkah sudah benar.
                </div>

                <div class="latihan-actions">
                    <button type="button" class="btn-materi btn-muted" id="resetDndBtn">Reset Latihan</button>
                </div>

                <div class="final-result" id="dndFinalResult">
                    <p><b>Semua langkah sudah benar ✅</b></p>
                    <div class="rumus-box">
                        $$h(x)=3x^4+\frac{5}{2}x^3+\frac{21}{4}x^2+\frac{15}{8}x+\frac{101}{16}$$
                    </div>
                    <div class="rumus-box">
                        $$s=\frac{159}{16}$$
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function renderMath(scope = document.body) {
                if (window.renderMathInElement) {
                    renderMathInElement(scope, {
                        delimiters: [
                            { left: '$$', right: '$$', display: true },
                            { left: '\\[', right: '\\]', display: true },
                            { left: '\\(', right: '\\)', display: false },
                            { left: '$', right: '$', display: false }
                        ],
                        throwOnError: false
                    });
                }
            }

            renderMath(document.body);

            /* =========================
               Eksplorasi pilihan ganda
            ========================== */
            const soalItems = document.querySelectorAll('.eks-soal');

            soalItems.forEach((soal) => {
                const correctAnswer = soal.getAttribute('data-answer');
                const buttons = soal.querySelectorAll('.opsi-btn');
                const status = soal.querySelector('.jawaban-status');

                buttons.forEach((btn) => {
                    btn.addEventListener('click', function () {
                        const choice = btn.getAttribute('data-choice');

                        buttons.forEach((b) => b.classList.remove('correct', 'wrong'));

                        if (choice === correctAnswer) {
                            btn.classList.add('correct');
                            status.textContent = 'Benar ✅';
                            status.className = 'jawaban-status correct';
                        } else {
                            btn.classList.add('wrong');
                            status.textContent = 'Jawaban masih kurang tepat.';
                            status.className = 'jawaban-status wrong';
                        }

                        renderMath(soal);
                    });
                });
            });

            /* =========================
               Ilustrasi bertahap
            ========================== */
            const btnShowIlustrasi = document.getElementById('btnShowIlustrasi');
            const btnNextLangkah = document.getElementById('btnNextLangkah');
            const btnResetLangkah = document.getElementById('btnResetLangkah');
            const ilustrasiContent = document.getElementById('ilustrasiContent');

            const langkahBoxes = [
                document.getElementById('langkahBox1'),
                document.getElementById('langkahBox2'),
                document.getElementById('langkahBox3'),
                document.getElementById('langkahBox4'),
                document.getElementById('langkahBox5'),
                document.getElementById('langkahBox6'),
                document.getElementById('langkahBox7'),
                document.getElementById('langkahBox8'),
                document.getElementById('langkahBox9')
            ];

            const hasilBox = document.getElementById('hasilBox');
            let currentLangkah = 0;

            function resetLangkah() {
                currentLangkah = 0;
                langkahBoxes.forEach(box => box.classList.remove('show'));
                hasilBox.classList.remove('show');
                btnNextLangkah.disabled = false;
                btnNextLangkah.textContent = 'Buka Langkah 1';
            }

            btnShowIlustrasi.addEventListener('click', function () {
                ilustrasiContent.classList.add('show');
                renderMath(ilustrasiContent);
            });

            btnNextLangkah.addEventListener('click', function () {
                ilustrasiContent.classList.add('show');

                if (currentLangkah < langkahBoxes.length) {
                    langkahBoxes[currentLangkah].classList.add('show');
                    currentLangkah++;

                    if (currentLangkah < langkahBoxes.length) {
                        btnNextLangkah.textContent = 'Buka Langkah ' + (currentLangkah + 1);
                    } else {
                        btnNextLangkah.textContent = 'Tampilkan Hasil Akhir';
                    }
                } else {
                    hasilBox.classList.add('show');
                    btnNextLangkah.textContent = 'Semua Langkah Sudah Dibuka';
                    btnNextLangkah.disabled = true;
                }

                renderMath(ilustrasiContent);
            });

            btnResetLangkah.addEventListener('click', function () {
                resetLangkah();
                ilustrasiContent.classList.add('show');
                renderMath(ilustrasiContent);
            });

            /* =========================
               Contoh interaktif
            ========================== */
            const btnMulaiContoh = document.getElementById('btnMulaiContoh');
            const btnResetContoh = document.getElementById('btnResetContoh');
            const stepWrap = document.getElementById('stepInteraktifWrap');
            const stepProgressText = document.getElementById('stepProgressText');
            const finalBox = document.getElementById('stepFinalBox');

            const allStepCards = [
                document.getElementById('stepCard1'),
                document.getElementById('stepCard2'),
                document.getElementById('stepCard3'),
                document.getElementById('stepCard4'),
                document.getElementById('stepCard5'),
                document.getElementById('stepCard6')
            ];

            let currentInteractiveStep = 1;
            const unlockedSteps = { 1: true, 2: false, 3: false, 4: false, 5: false, 6: false };

            const jawabanBenar = {
                1: ['2x^2', '2x2'],
                2: ['2x^3+2x^2', '2x3+2x2'],
                3: ['x^2-2x+1', 'x2-2x+1'],
                4: ['x'],
                5: ['-3x+1', '-3x1'],
                6: [
                    'h(x)=2x^2+x-3,s=4',
                    'hx=2x^2+x-3,s=4',
                    '2x^2+x-3,4',
                    '2x2+x-3,4'
                ]
            };

            const feedbackText = {
                1: {
                    benar: `
                        <b>Benar ✅</b>
                        <div class="step-solution">
                            <p style="margin-top:0;">
                                Penjelasan:
                                Kita membagi suku berpangkat tertinggi pada pembilang dengan suku berpangkat tertinggi pada penyebut.
                                Koefisien dibagi, lalu pangkat dikurangkan.
                            </p>
                            <div class="rumus-box">$$\\frac{2x^3}{x}=2x^2$$</div>
                            <p style="margin-bottom:0;">
                                Jadi suku pertama hasil bagi adalah \\(2x^2\\).
                            </p>
                        </div>
                    `
                },
                2: {
                    benar: `
                        <b>Benar ✅</b>
                        <div class="step-solution">
                            <p style="margin-top:0;">
                                Penjelasan:
                                Setelah mendapatkan suku hasil bagi, suku itu harus dikalikan ke seluruh penyebut
                                agar bisa dikurangkan pada langkah berikutnya.
                            </p>
                            <div class="rumus-box">$$2x^2(x+1)=2x^3+2x^2$$</div>
                            <p style="margin-bottom:0;">
                                Hasil inilah yang nanti ditempatkan di bawah pembilang untuk proses pengurangan.
                            </p>
                        </div>
                    `
                },
                3: {
                    benar: `
                        <b>Benar ✅</b>
                        <div class="step-solution">
                            <p style="margin-top:0;">
                                Penjelasan:
                                Sekarang kita kurangkan suku-suku sejenis. Saat mengurangkan,
                                perhatikan perubahan tanda pada bentuk yang dikurangkan.
                            </p>
                            <div class="rumus-box">$$(2x^3+3x^2-2x+1)-(2x^3+2x^2)=x^2-2x+1$$</div>
                            <p style="margin-bottom:0;">
                                Hasil ini menjadi sisa baru untuk langkah berikutnya.
                            </p>
                        </div>
                    `
                },
                4: {
                    benar: `
                        <b>Benar ✅</b>
                        <div class="step-solution">
                            <p style="margin-top:0;">
                                Penjelasan:
                                Ulangi pola yang sama. Ambil suku tertinggi dari sisa baru,
                                lalu bagi dengan suku tertinggi penyebut.
                            </p>
                            <div class="rumus-box">$$\\frac{x^2}{x}=x$$</div>
                            <p style="margin-bottom:0;">
                                Jadi suku kedua hasil bagi adalah \\(x\\).
                            </p>
                        </div>
                    `
                },
                5: {
                    benar: `
                        <b>Benar ✅</b>
                        <div class="step-solution">
                            <p style="margin-top:0;">
                                Penjelasan:
                                Suku \\(x\\) dikalikan ke penyebut, lalu hasilnya dikurangkan
                                dari sisa sebelumnya.
                            </p>
                            <div class="rumus-box">$$x(x+1)=x^2+x$$</div>
                            <div class="rumus-box">$$(x^2-2x+1)-(x^2+x)=-3x+1$$</div>
                            <p style="margin-bottom:0;">
                                Bentuk \\(-3x+1\\) adalah sisa baru yang akan diproses lagi.
                            </p>
                        </div>
                    `
                },
                6: {
                    benar: `
                        <b>Benar ✅</b>
                        <div class="step-solution">
                            <p style="margin-top:0;">
                                Penjelasan:
                                Lakukan satu putaran terakhir dengan pola yang sama:
                                bagi, kali, lalu kurang. Setelah itu semua suku hasil bagi digabungkan.
                            </p>
                            <div class="rumus-box">$$\\frac{-3x}{x}=-3$$</div>
                            <div class="rumus-box">$$-3(x+1)=-3x-3$$</div>
                            <div class="rumus-box">$$(-3x+1)-(-3x-3)=4$$</div>
                            <div class="rumus-box">$$h(x)=2x^2+x-3$$</div>
                            <div class="rumus-box">$$s=4$$</div>
                            <p style="margin-bottom:0;">
                                Jadi hasil bagi diperoleh dari semua suku yang sudah muncul,
                                sedangkan sisa adalah hasil pengurangan terakhir.
                            </p>
                        </div>
                    `
                }
            };

            function normalizeInput(str) {
                return (str || '')
                    .toLowerCase()
                    .replace(/\s+/g, '')
                    .replace(/−/g, '-')
                    .replace(/,/g, '.')
                    .replace(/\*/g, '')
                    .replace(/\\,/g, '')
                    .replace(/\{/g, '')
                    .replace(/\}/g, '')
                    .replace(/\\left/g, '')
                    .replace(/\\right/g, '')
                    .replace(/[()]/g, '');
            }

            function isCorrect(step, userValue) {
                const normalized = normalizeInput(userValue);
                return jawabanBenar[step].some(item => normalizeInput(item) === normalized);
            }

            function updateProgress() {
                if (stepProgressText) {
                    stepProgressText.textContent = 'Langkah aktif: ' + currentInteractiveStep + ' dari 6';
                }
            }

            function showOnlyStep(stepNumber) {
                if (!unlockedSteps[stepNumber]) return;

                stepWrap.classList.add('show');

                allStepCards.forEach((card, index) => {
                    const nomor = index + 1;
                    card.classList.remove('active');
                    if (nomor === stepNumber) {
                        card.classList.add('active');
                    }
                });

                currentInteractiveStep = stepNumber;
                updateProgress();
                renderMath(stepWrap);
            }

            function resetContohInteraktif() {
                currentInteractiveStep = 1;

                Object.keys(unlockedSteps).forEach(key => {
                    unlockedSteps[key] = false;
                });
                unlockedSteps[1] = true;

                allStepCards.forEach((card, index) => {
                    const step = index + 1;
                    card.classList.remove('active', 'done');

                    const input = document.getElementById('answer' + step);
                    const feedback = document.getElementById('feedback' + step);
                    const nextBtn = document.getElementById('nextBtn' + step);

                    if (input) {
                        input.value = '';
                        input.disabled = false;
                    }

                    if (feedback) {
                        feedback.className = 'step-feedback';
                        feedback.innerHTML = '';
                    }

                    if (nextBtn) {
                        nextBtn.classList.remove('show');
                        nextBtn.disabled = true;
                    }
                });

                finalBox.classList.remove('show');
                showOnlyStep(1);
            }

            function unlockNextStep(step) {
                const nextStep = step + 1;
                if (unlockedSteps[nextStep] !== undefined) {
                    unlockedSteps[nextStep] = true;
                }
            }

            function setCorrectState(step) {
                const currentCard = document.getElementById('stepCard' + step);
                const input = document.getElementById('answer' + step);
                const nextBtn = document.getElementById('nextBtn' + step);

                currentCard.classList.add('done');

                if (input) input.disabled = true;

                if (nextBtn) {
                    nextBtn.classList.add('show');
                    nextBtn.disabled = false;
                }

                unlockNextStep(step);
            }

            btnMulaiContoh.addEventListener('click', function () {
                showOnlyStep(1);
            });

            btnResetContoh.addEventListener('click', function () {
                resetContohInteraktif();
            });

            const stepResetBtnAkhir = document.getElementById('stepResetBtnAkhir');
            if (stepResetBtnAkhir) {
                stepResetBtnAkhir.addEventListener('click', function () {
                    resetContohInteraktif();
                });
            }

            document.querySelectorAll('.step-submit-btn').forEach((btn) => {
                btn.addEventListener('click', function () {
                    const step = parseInt(btn.getAttribute('data-step'));
                    const input = document.getElementById('answer' + step);
                    const feedback = document.getElementById('feedback' + step);
                    const userValue = input.value;

                    if (!userValue.trim()) {
                        feedback.className = 'step-feedback wrong';
                        feedback.innerHTML = '<b>Jawaban belum diisi.</b>';
                        return;
                    }

                    if (isCorrect(step, userValue)) {
                        feedback.className = 'step-feedback correct';
                        feedback.innerHTML = feedbackText[step].benar;
                        setCorrectState(step);

                        if (step === 6) {
                            finalBox.classList.add('show');
                        }
                    } else {
                        feedback.className = 'step-feedback wrong';
                        feedback.innerHTML = '<b>Jawaban masih salah. Coba periksa lagi pembagian, perkalian, atau pengurangannya.</b>';
                    }

                    renderMath(stepWrap);
                });
            });

            for (let i = 1; i <= 5; i++) {
                const nextBtn = document.getElementById('nextBtn' + i);
                if (nextBtn) {
                    nextBtn.addEventListener('click', function () {
                        if (!unlockedSteps[i + 1]) return;
                        showOnlyStep(i + 1);
                    });
                }
            }

            resetLangkah();
            resetContohInteraktif();

            /* =========================
               Drag and Drop Latihan
            ========================== */
            const dragItemsContainer = document.getElementById('dragItems');
            const dropSlots = document.querySelectorAll('.drop-slot');
            const resetDndBtn = document.getElementById('resetDndBtn');
            const dndFinalResult = document.getElementById('dndFinalResult');
            const dndProgressText = document.getElementById('dndProgressText');
            const latihanBoard = document.querySelector('.latihan-dnd-board');
            const slotPanel = document.querySelector('.slot-panel');

            let draggedCard = null;
            let autoScrollFrame = null;
            let lastPointerY = null;

            function updateSlotBadge(slot, type, text) {
                const badge = slot.querySelector('.status-kecil');
                if (!badge) return;
                badge.className = 'status-kecil ' + type;
                badge.textContent = text;
            }

            function clearSlotState(slot) {
                slot.classList.remove('correct', 'wrong', 'drag-over');
            }

            function updateDndProgress() {
                let correctCount = 0;

                dropSlots.forEach((slot) => {
                    const placedCard = slot.querySelector('.drag-card');
                    const step = slot.getAttribute('data-step');

                    if (placedCard && placedCard.getAttribute('data-order') === step) {
                        correctCount++;
                    }
                });

                dndProgressText.textContent = 'Kemajuan: ' + correctCount + ' dari 10 langkah sudah benar.';

                if (correctCount === 10) {
                    dndFinalResult.classList.add('show');
                } else {
                    dndFinalResult.classList.remove('show');
                }
            }

            function resetSingleSlot(slot) {
                clearSlotState(slot);
                slot.classList.remove('filled');
                updateSlotBadge(slot, 'netral', 'Belum diisi');

                const card = slot.querySelector('.drag-card');
                if (card) {
                    card.classList.remove('locked-correct');
                    card.setAttribute('draggable', 'true');
                    dragItemsContainer.appendChild(card);
                }

                const hint = slot.querySelector('.drop-hint');
                if (hint) hint.style.display = 'inline';
            }

            function shuffleCards(container) {
                const cards = Array.from(container.querySelectorAll('.drag-card'));
                for (let i = cards.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [cards[i], cards[j]] = [cards[j], cards[i]];
                }
                cards.forEach(card => container.appendChild(card));
            }

            function resetDndExercise() {
                dndFinalResult.classList.remove('show');

                dropSlots.forEach((slot) => {
                    resetSingleSlot(slot);
                });

                shuffleCards(dragItemsContainer);
                updateDndProgress();
                renderMath(document.body);

                if (latihanBoard) latihanBoard.scrollTop = 0;
                if (slotPanel) slotPanel.scrollTop = 0;
                if (dragItemsContainer) dragItemsContainer.scrollTop = 0;
            }

            function getScrollableContainers() {
                const containers = [];
                if (slotPanel) containers.push(slotPanel);
                if (latihanBoard) containers.push(latihanBoard);
                if (dragItemsContainer) containers.push(dragItemsContainer);
                return containers;
            }

            function autoScrollContainers(clientY) {
                const edgeThreshold = 85;
                const maxSpeed = 20;

                getScrollableContainers().forEach((container) => {
                    const rect = container.getBoundingClientRect();

                    const canScrollDown = container.scrollTop + container.clientHeight < container.scrollHeight;
                    const canScrollUp = container.scrollTop > 0;

                    let delta = 0;

                    const distanceTop = clientY - rect.top;
                    const distanceBottom = rect.bottom - clientY;

                    if (distanceTop < edgeThreshold && canScrollUp) {
                        delta = -Math.ceil(((edgeThreshold - distanceTop) / edgeThreshold) * maxSpeed);
                    } else if (distanceBottom < edgeThreshold && canScrollDown) {
                        delta = Math.ceil(((edgeThreshold - distanceBottom) / edgeThreshold) * maxSpeed);
                    }

                    if (delta !== 0) {
                        container.scrollTop += delta;
                    }
                });
            }

            function stopAutoScroll() {
                if (autoScrollFrame) {
                    cancelAnimationFrame(autoScrollFrame);
                    autoScrollFrame = null;
                }
            }

            function startAutoScrollTracking() {
                stopAutoScroll();

                function tick() {
                    if (draggedCard && lastPointerY !== null) {
                        autoScrollContainers(lastPointerY);
                        autoScrollFrame = requestAnimationFrame(tick);
                    }
                }

                autoScrollFrame = requestAnimationFrame(tick);
            }

            document.addEventListener('dragover', function (e) {
                lastPointerY = e.clientY;
            });

            document.addEventListener('drop', function () {
                stopAutoScroll();
                lastPointerY = null;
            });

            document.addEventListener('dragend', function () {
                stopAutoScroll();
                lastPointerY = null;
            });

            function attachDragEvents(card) {
                card.addEventListener('dragstart', function () {
                    if (card.classList.contains('locked-correct')) return;
                    draggedCard = card;
                    card.classList.add('dragging');
                    startAutoScrollTracking();
                });

                card.addEventListener('dragend', function () {
                    card.classList.remove('dragging');
                    draggedCard = null;
                    stopAutoScroll();
                    lastPointerY = null;
                });
            }

            document.querySelectorAll('.drag-card').forEach((card) => {
                attachDragEvents(card);
            });

            dropSlots.forEach((slot) => {
                slot.addEventListener('dragover', function (e) {
                    e.preventDefault();
                    slot.classList.add('drag-over');
                });

                slot.addEventListener('dragleave', function () {
                    slot.classList.remove('drag-over');
                });

                slot.addEventListener('drop', function (e) {
                    e.preventDefault();
                    slot.classList.remove('drag-over');

                    if (!draggedCard) return;
                    if (draggedCard.classList.contains('locked-correct')) return;

                    const existingCard = slot.querySelector('.drag-card');
                    const correctStep = slot.getAttribute('data-step');
                    const draggedOrder = draggedCard.getAttribute('data-order');
                    const hint = slot.querySelector('.drop-hint');
                    const currentDraggedCard = draggedCard;

                    if (existingCard && existingCard !== currentDraggedCard) {
                        if (existingCard.classList.contains('locked-correct')) {
                            return;
                        }
                        dragItemsContainer.appendChild(existingCard);
                    }

                    slot.appendChild(currentDraggedCard);
                    slot.classList.add('filled');
                    if (hint) hint.style.display = 'none';
                    renderMath(slot);
                    clearSlotState(slot);

                    if (draggedOrder === correctStep) {
                        slot.classList.add('correct');
                        currentDraggedCard.classList.add('locked-correct');
                        currentDraggedCard.setAttribute('draggable', 'false');
                        updateSlotBadge(slot, 'benar', 'Benar');
                    } else {
                        slot.classList.add('wrong');
                        updateSlotBadge(slot, 'salah', 'Salah');

                        setTimeout(() => {
                            clearSlotState(slot);
                            updateSlotBadge(slot, 'netral', 'Belum diisi');
                            slot.classList.remove('filled');
                            if (hint) hint.style.display = 'inline';

                            if (slot.contains(currentDraggedCard) && !currentDraggedCard.classList.contains('locked-correct')) {
                                dragItemsContainer.appendChild(currentDraggedCard);
                                renderMath(dragItemsContainer);
                            }
                        }, 850);
                    }

                    updateDndProgress();
                });
            });

            dragItemsContainer.addEventListener('dragover', function (e) {
                e.preventDefault();
            });

            dragItemsContainer.addEventListener('drop', function (e) {
                e.preventDefault();

                if (!draggedCard) return;
                if (draggedCard.classList.contains('locked-correct')) return;

                dragItemsContainer.appendChild(draggedCard);
                renderMath(dragItemsContainer);
            });

            resetDndBtn.addEventListener('click', function () {
                resetDndExercise();
            });

            resetDndExercise();
            renderMath(document.body);
        });
    </script>
@endsection

@section('nav')
    <a href="{{ route('kuisb') }}" class="btn-nav prev-btn">
        ← Previous
    </a>

    <a href="{{ route('metodehorner') }}" class="btn-nav next-btn">
        Next →
    </a>
@endsection