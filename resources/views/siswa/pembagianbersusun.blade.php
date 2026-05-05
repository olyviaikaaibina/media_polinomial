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

        .step-card.answered-correct {
            border-left-color: var(--correct);
            background: rgba(47, 143, 70, .05);
        }

        .step-card.answered-wrong {
            border-left-color: var(--wrong);
            background: rgba(216, 74, 58, .05);
        }

        .tujuan-card,
        .content-card,
        .info-card,
        .contoh-card,
        .step-card,
        .final-result,
        .langkah-putih-card,
        .latihan-card {
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
            transition: .2s ease;
        }

        .step-answer-input:focus {
            border-color: #79c661;
            box-shadow: 0 0 0 3px rgba(121, 198, 97, .12);
        }

        .step-answer-input.correct-answer {
            border-color: rgba(47, 143, 70, .65);
            background: rgba(47, 143, 70, .06);
            box-shadow: 0 0 0 3px rgba(47, 143, 70, .10);
        }

        .step-answer-input.wrong-answer {
            border-color: rgba(216, 74, 58, .6);
            background: rgba(216, 74, 58, .06);
            box-shadow: 0 0 0 3px rgba(216, 74, 58, .10);
        }

        .step-helper {
            font-size: 13.5px;
            color: #7b6f66;
            margin-top: 8px;
            line-height: 1.7;
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

        #finalSimple {
            display: none;
        }

        #finalSimple.show {
            display: block;
        }

        .materi-terkunci {
            display: none;
        }

        .materi-terkunci.show {
            display: block;
            animation: fadeMateri .35s ease;
        }

        @keyframes fadeMateri {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .ilustrasi-card-simple {
            background: #fffdfb;
            border-left: 6px solid #f0a055;
        }

        .ilustrasi-top-simple {
            display: grid;
            grid-template-columns: 1.1fr .9fr;
            gap: 16px;
            margin-bottom: 16px;
        }

        .ilustrasi-box-simple,
        .ilustrasi-rumus-simple,
        .ilustrasi-step-simple,
        .ilustrasi-summary-simple {
            background: #fff;
            border: 1px solid #e8ddd2;
            border-radius: 16px;
            padding: 16px;
        }

        .ilustrasi-box-simple {
            background: #fff8f1;
        }

        .ilustrasi-box-simple p,
        .ilustrasi-rumus-simple p,
        .ilustrasi-step-simple p,
        .ilustrasi-summary-simple p {
            margin: 0;
            line-height: 1.8;
            color: #4d433b;
        }

        .ilustrasi-tag-row {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 12px;
        }

        .ilustrasi-tag {
            background: #eef8ef;
            color: #1f6830;
            border: 1px solid #d2e7d7;
            border-radius: 999px;
            padding: 6px 12px;
            font-size: 13px;
            font-weight: 700;
        }

        .ilustrasi-progress-wrap {
            background: #fff;
            border: 1px solid #ebdfd4;
            border-radius: 16px;
            padding: 14px;
            margin: 10px 0 16px;
        }

        .ilustrasi-progress-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .ilustrasi-progress-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--primary-green);
        }

        .ilustrasi-progress-text {
            font-size: 13.5px;
            color: #7b6f66;
            font-weight: 700;
        }

        .ilustrasi-progress-bar {
            width: 100%;
            height: 12px;
            background: #f4ebe2;
            border-radius: 999px;
            overflow: hidden;
            border: 1px solid #ead8c8;
        }

        .ilustrasi-progress-fill {
            width: 0%;
            height: 100%;
            background: linear-gradient(90deg, #79c661 0%, #f2b15f 100%);
            border-radius: 999px;
            transition: width .35s ease;
        }

        .ilustrasi-step-simple {
            display: none;
            border-left: 5px solid #79c661;
            margin-bottom: 12px;
        }

        .ilustrasi-step-simple.show {
            display: block;
        }

        .ilustrasi-step-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 8px;
        }

        .ilustrasi-step-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #eef8ef;
            border: 1px solid #d3e7d7;
            color: #1f6830;
            border-radius: 999px;
            padding: 5px 12px;
            font-size: 13px;
            font-weight: 700;
        }

        .ilustrasi-step-title {
            font-size: 17px;
            font-weight: 700;
            color: var(--primary-green);
            margin: 0;
        }

        .ilustrasi-note-simple {
            margin-top: 10px;
            background: #fff8f1;
            border: 1px dashed #efc8a9;
            border-radius: 12px;
            padding: 10px 12px;
            font-size: 14px;
            color: #7a5b42;
            line-height: 1.7;
        }

        .result-box.ilustrasi-hasil-simple {
            display: none;
            background: #f7fcf7;
            border: 1px solid #cfe4d2;
            border-radius: 18px;
            padding: 18px;
        }

        .result-box.ilustrasi-hasil-simple.show {
            display: block;
        }

        .ilustrasi-summary-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-top: 12px;
        }

        .ilustrasi-summary-simple .label {
            font-size: 13px;
            font-weight: 700;
            color: #6f7a70;
            margin-bottom: 6px;
            display: block;
        }

        .latihan-match-board {
            background: #edf1f1;
            border: 1px solid #d7dddd;
            border-radius: 18px;
            padding: 16px;
            margin-top: 12px;
            overflow: hidden;
        }

        .latihan-dnd-soal {
            font-size: 15px;
            line-height: 1.7;
            margin-bottom: 8px;
            color: #404040;
            word-break: break-word;
        }

        .latihan-note {
            font-size: 14px;
            line-height: 1.7;
            color: #6b6b6b;
            margin-bottom: 14px;
        }

        .latihan-match-top {
            margin-bottom: 18px;
        }

        .panel-title,
        .langkah-bank-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--primary-green);
            margin-bottom: 10px;
        }

        .langkah-target-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 12px;
            width: 100%;
        }

        .langkah-target-slot {
            min-width: 0;
            min-height: 60px;
            background: #fcfcfc;
            border: 2px dashed #d8d2cb;
            border-radius: 14px;
            padding: 10px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            transition: .2s ease;
            overflow: hidden;
        }

        .langkah-target-slot.drag-over {
            border-color: #7ba7b8;
            background: #eef6f9;
        }

        .langkah-target-slot.correct {
            background: rgba(47, 143, 70, .12);
            border-color: rgba(47, 143, 70, .5);
        }

        .langkah-target-slot.wrong {
            background: rgba(216, 74, 58, .10);
            border-color: rgba(216, 74, 58, .35);
        }

        .langkah-target-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .langkah-target-title {
            font-size: 14px;
            font-weight: 700;
            color: #655a51;
        }

        .langkah-target-body {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .drop-hint {
            font-size: 11px;
            color: #8a7d71;
            text-align: center;
            line-height: 1.4;
        }

        .isi-bank-wrap {
            margin-top: 12px;
        }

        .isi-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 10px;
            width: 100%;
        }

        .isi-card {
            min-width: 0;
            background: #ffffff;
            border: 1px solid #d8d3cc;
            border-radius: 12px;
            padding: 8px;
            cursor: grab;
            transition: .2s ease;
            user-select: none;
            box-shadow: 0 2px 7px rgba(0, 0, 0, 0.03);
            overflow: hidden;
        }

        .isi-card:hover {
            background: #fcfaf8;
            transform: translateY(-1px);
        }

        .isi-card.dragging {
            opacity: .5;
        }

        .isi-card.locked-correct {
            cursor: default;
            background: rgba(47, 143, 70, .12);
            border-color: rgba(47, 143, 70, .35);
        }

        .isi-card-content {
            width: 100%;
            max-height: 72px;
            overflow: auto;
            text-align: center;
            font-size: 12px;
            line-height: 1.5;
            color: #404040;
            padding: 2px;
            white-space: normal;
            word-break: break-word;
        }

        .isi-card-content::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        .isi-card-content::-webkit-scrollbar-thumb {
            background: #d3cbc2;
            border-radius: 999px;
        }

        .isi-card-content .katex-display {
            margin: 0;
            overflow-x: auto;
            overflow-y: hidden;
        }

        .isi-card-content .katex {
            font-size: 0.95em !important;
        }

        .langkah-target-body .isi-card {
            width: 100%;
            margin-top: 2px;
        }

        .status-kecil {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            padding: 4px 8px;
            font-size: 11px;
            font-weight: 700;
            line-height: 1;
            max-width: 100%;
        }

        .status-kecil.netral {
            background: #f1ece6;
            color: #7a6656;
            border: 1px solid #dfd2c6;
        }

        .status-kecil.benar {
            background: rgba(47, 143, 70, 0.12);
            color: #1f6830;
            border: 1px solid rgba(47, 143, 70, 0.3);
        }

        .status-kecil.salah {
            background: rgba(216, 74, 58, 0.1);
            color: #9a362c;
            border: 1px solid rgba(216, 74, 58, 0.25);
        }

        .progress-dnd {
            margin-top: 14px;
            background: #f7f2ec;
            border: 1px solid #eadccf;
            border-radius: 14px;
            padding: 10px 12px;
            font-size: 14px;
            color: #5d5248;
        }

        @media (max-width: 1200px) {

            .langkah-target-grid,
            .isi-grid {
                grid-template-columns: repeat(5, minmax(0, 1fr));
            }
        }

        @media (max-width: 992px) {
            .hasil-akhir-grid {
                grid-template-columns: 1fr;
            }

            .ilustrasi-top-simple,
            .ilustrasi-summary-grid,
            .langkah-target-grid,
            .isi-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .materi-wrap {
                padding: 12px 8px 28px;
            }

            .bab-title {
                font-size: 24px;
            }

            .tujuan-card,
            .content-card,
            .info-card,
            .contoh-card,
            .step-card,
            .final-result,
            .langkah-putih-card,
            .latihan-card {
                padding: 16px;
                border-radius: 16px;
            }

            .section-label {
                font-size: 14px;
                padding: 7px 14px;
            }

            .mini-title {
                font-size: 18px;
            }

            .hasil-akhir-grid,
            .ilustrasi-top-simple,
            .ilustrasi-summary-grid,
            .langkah-target-grid,
            .isi-grid {
                grid-template-columns: 1fr;
            }

            .btn-materi {
                width: 100%;
                justify-content: center;
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
                Perhatikan bentuk aljabar berikut:
            </p>

            <div class="rumus-box">
                $$x^2 + 5x + 6$$
            </div>

            <p>
                Bentuk tersebut akan dibagi dengan:
                <span class="rumus-inline">\(x + 1\)</span>
            </p>

            <p>
                Amati hubungan antara bentuk yang dibagi, pembagi, hasil bagi, dan kemungkinan adanya sisa.
            </p>

            <div class="eks-soal-wrap">
                <div class="mini-title" style="font-size:18px; margin-top: 18px;">
                    <span class="mini-icon">❓</span>
                    <span>Pertanyaan</span>
                </div>

                <div class="eks-soal" data-answer="3" data-answered="false"
                    style="background: rgba(255,255,255,.65); border:1px solid #e9ddd1; border-radius:14px; padding:16px; margin-bottom:16px;">
                    <div class="eks-pertanyaan" style="margin-bottom:12px;">
                        1. Operasi yang paling tepat untuk menentukan hasil dari pembagian dua bentuk aljabar tersebut
                        adalah ....
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

                <div class="eks-soal" data-answer="1" data-answered="false"
                    style="background: rgba(255,255,255,.65); border:1px solid #e9ddd1; border-radius:14px; padding:16px; margin-bottom:16px;">
                    <div class="eks-pertanyaan" style="margin-bottom:12px;">
                        2. Jika suatu bentuk aljabar dibagi dengan bentuk lainnya, maka hasil yang diperoleh disebut ....
                    </div>

                    <div class="opsi-grid">
                        <button type="button" class="opsi-btn" data-choice="1">
                            <span class="opsi-number">1</span>
                            <span class="opsi-text">Hasil bagi</span>
                        </button>
                        <button type="button" class="opsi-btn" data-choice="2">
                            <span class="opsi-number">2</span>
                            <span class="opsi-text">Jumlah</span>
                        </button>
                        <button type="button" class="opsi-btn" data-choice="3">
                            <span class="opsi-number">3</span>
                            <span class="opsi-text">Hasil kali</span>
                        </button>
                    </div>

                    <div class="jawaban-status"></div>
                </div>

                <div class="eks-soal" data-answer="1" data-answered="false"
                    style="background: rgba(255,255,255,.65); border:1px solid #e9ddd1; border-radius:14px; padding:16px;">
                    <div class="eks-pertanyaan" style="margin-bottom:12px;">
                        3. Hitung pembagian berikut: 7 ÷ 3. Berapa sisa yang diperoleh?
                    </div>

                    <div class="opsi-grid">
                        <button type="button" class="opsi-btn" data-choice="1">
                            <span class="opsi-number">1</span>
                            <span class="opsi-text">1</span>
                        </button>
                        <button type="button" class="opsi-btn" data-choice="2">
                            <span class="opsi-number">2</span>
                            <span class="opsi-text">2</span>
                        </button>
                        <button type="button" class="opsi-btn" data-choice="3">
                            <span class="opsi-number">3</span>
                            <span class="opsi-text">3</span>
                        </button>
                    </div>

                    <div class="jawaban-status"></div>
                </div>
            </div>
        </div>

        <div id="materiLanjutanWrap" class="materi-terkunci">
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

                        <p>Pada bentuk ini:</p>

                        <ul>
                            <li>\(Q(x)\) disebut <b>pembagi</b>,</li>
                            <li>\(H(x)\) disebut <b>hasil bagi</b>,</li>
                            <li>\(S(x)\) disebut <b>sisa</b>.</li>
                        </ul>
            </div>

            
            <div class="info-card ilustrasi-card-simple">
                <div class="mini-title">
                    <span class="mini-icon">🧩</span>
                    <span>Langkah Demi Langkah Pembagian Polinomial</span>
                </div>

                <div class="ilustrasi-top-simple">
                    <div class="ilustrasi-box-simple">
                        <p>
                            Pembagian polinomial dilakukan dengan pola yang sama berulang, yaitu
                            <b>bagi</b>, <b>kali</b>, lalu <b>kurang</b>.
                            Ulangi sampai derajat sisa lebih kecil dari pembagi.
                        </p>

                        <div class="ilustrasi-tag-row">
                            <span class="ilustrasi-tag">Bagi</span>
                            <span class="ilustrasi-tag">Kali</span>
                            <span class="ilustrasi-tag">Kurang</span>
                        </div>
                    </div>

                    <div class="ilustrasi-rumus-simple">
                        <p style="font-weight:700; color:#1f6830; margin-bottom:8px;">Contoh ilustrasi:</p>
                        <div class="rumus-box" style="margin:0;">
                            $$\frac{2x^3+9x^2+4x+7}{x+2}$$
                        </div>
                    </div>
                </div>

                <div class="ilustrasi-progress-wrap">
                    <div class="ilustrasi-progress-head">
                        <div class="ilustrasi-progress-title">Progress Ilustrasi</div>
                        <div class="ilustrasi-progress-text" id="progressTextIlustrasi">0 dari 9 langkah dibuka</div>
                    </div>
                    <div class="ilustrasi-progress-bar">
                        <div class="ilustrasi-progress-fill" id="progressFillIlustrasi"></div>
                    </div>
                </div>

                <p style="margin-bottom:10px;">
                    Klik tombol di bawah untuk membuka langkah pembagian satu per satu.
                </p>

                <div class="ilustrasi-actions">
                    <button type="button" class="btn-materi btn-primary" id="btnShowIlustrasi">Buka Ilustrasi</button>
                    <button type="button" class="btn-materi btn-secondary" id="btnNextLangkah">Buka Langkah 1</button>
                    <button type="button" class="btn-materi btn-muted" id="btnResetLangkah">Ulangi</button>
                </div>

                <div class="ilustrasi-content" id="ilustrasiContent">
                    <div class="ilustrasi-step-simple" id="langkahBox1">
                        <div class="ilustrasi-step-head">
                            <span class="ilustrasi-step-badge">Langkah 1</span>
                            <h4 class="ilustrasi-step-title">Bagi suku tertinggi</h4>
                        </div>
                        <p>Ambil suku tertinggi pada pembilang, lalu bagi dengan suku tertinggi pada penyebut.</p>
                        <div class="rumus-box">$$\frac{2x^3}{x}=2x^2$$</div>
                        <div class="ilustrasi-note-simple">Suku pertama hasil bagi adalah <b>\(2x^2\)</b>.</div>
                    </div>

                    <div class="ilustrasi-step-simple" id="langkahBox2">
                        <div class="ilustrasi-step-head">
                            <span class="ilustrasi-step-badge">Langkah 2</span>
                            <h4 class="ilustrasi-step-title">Kalikan dengan pembagi</h4>
                        </div>
                        <p>Kalikan suku hasil bagi yang baru diperoleh dengan seluruh pembagi.</p>
                        <div class="rumus-box">$$2x^2(x+2)=2x^3+4x^2$$</div>
                        <div class="ilustrasi-note-simple">Hasil ini dipakai untuk pengurangan berikutnya.</div>
                    </div>

                    <div class="ilustrasi-step-simple" id="langkahBox3">
                        <div class="ilustrasi-step-head">
                            <span class="ilustrasi-step-badge">Langkah 3</span>
                            <h4 class="ilustrasi-step-title">Kurangkan</h4>
                        </div>
                        <p>Kurangkan hasil perkalian tadi dari polinomial semula.</p>
                        <div class="rumus-box">$$(2x^3+9x^2+4x+7)-(2x^3+4x^2)=5x^2+4x+7$$</div>
                        <div class="ilustrasi-note-simple">Sisa baru adalah <b>\(5x^2+4x+7\)</b>.</div>
                    </div>

                    <div class="ilustrasi-step-simple" id="langkahBox4">
                        <div class="ilustrasi-step-head">
                            <span class="ilustrasi-step-badge">Langkah 4</span>
                            <h4 class="ilustrasi-step-title">Bagi lagi</h4>
                        </div>
                        <p>Ambil suku tertinggi pada sisa baru, lalu bagi lagi dengan \(x\).</p>
                        <div class="rumus-box">$$\frac{5x^2}{x}=5x$$</div>
                        <div class="ilustrasi-note-simple">Suku berikutnya pada hasil bagi adalah <b>\(5x\)</b>.</div>
                    </div>

                    <div class="ilustrasi-step-simple" id="langkahBox5">
                        <div class="ilustrasi-step-head">
                            <span class="ilustrasi-step-badge">Langkah 5</span>
                            <h4 class="ilustrasi-step-title">Kalikan lagi</h4>
                        </div>
                        <p>Kalikan suku baru hasil bagi dengan pembagi \((x+2)\).</p>
                        <div class="rumus-box">$$5x(x+2)=5x^2+10x$$</div>
                        <div class="ilustrasi-note-simple">Hasil ini siap dikurangkan dari sisa sebelumnya.</div>
                    </div>

                    <div class="ilustrasi-step-simple" id="langkahBox6">
                        <div class="ilustrasi-step-head">
                            <span class="ilustrasi-step-badge">Langkah 6</span>
                            <h4 class="ilustrasi-step-title">Kurangkan lagi</h4>
                        </div>
                        <p>Kurangkan hasil perkalian tadi dari sisa sebelumnya.</p>
                        <div class="rumus-box">$$(5x^2+4x+7)-(5x^2+10x)=-6x+7$$</div>
                        <div class="ilustrasi-note-simple">Sekarang sisanya menjadi <b>\(-6x+7\)</b>.</div>
                    </div>

                    <div class="ilustrasi-step-simple" id="langkahBox7">
                        <div class="ilustrasi-step-head">
                            <span class="ilustrasi-step-badge">Langkah 7</span>
                            <h4 class="ilustrasi-step-title">Bagi terakhir</h4>
                        </div>
                        <p>Ambil suku tertinggi dari sisa, lalu bagi lagi dengan \(x\).</p>
                        <div class="rumus-box">$$\frac{-6x}{x}=-6$$</div>
                        <div class="ilustrasi-note-simple">Suku terakhir hasil bagi adalah <b>\(-6\)</b>.</div>
                    </div>

                    <div class="ilustrasi-step-simple" id="langkahBox8">
                        <div class="ilustrasi-step-head">
                            <span class="ilustrasi-step-badge">Langkah 8</span>
                            <h4 class="ilustrasi-step-title">Kalikan suku terakhir</h4>
                        </div>
                        <p>Kalikan \(-6\) dengan pembagi \((x+2)\).</p>
                        <div class="rumus-box">$$-6(x+2)=-6x-12$$</div>
                        <div class="ilustrasi-note-simple">Lalu lakukan satu pengurangan lagi untuk mencari sisa akhir.
                        </div>
                    </div>

                    <div class="ilustrasi-step-simple" id="langkahBox9">
                        <div class="ilustrasi-step-head">
                            <span class="ilustrasi-step-badge">Langkah 9</span>
                            <h4 class="ilustrasi-step-title">Sisa akhir</h4>
                        </div>
                        <p>Kurangkan bentuk terakhir untuk memperoleh sisa akhir pembagian.</p>
                        <div class="rumus-box">$$(-6x+7)-(-6x-12)=19$$</div>
                        <div class="ilustrasi-note-simple">Karena derajat sisa sudah lebih kecil dari pembagi, proses
                            selesai.</div>
                    </div>

                    <div class="result-box ilustrasi-hasil-simple" id="hasilBox">
                        <p style="font-weight:700; color:#1f6830; margin-bottom:10px;">Hasil akhir ilustrasi</p>

                        <div class="rumus-box" style="margin-top:0;">
                            $$2x^3+9x^2+4x+7=(x+2)(2x^2+5x-6)+19$$
                        </div>

                        <div class="ilustrasi-summary-grid">
                            <div class="ilustrasi-summary-simple">
                                <span class="label">Hasil bagi</span>
                                <div class="rumus-box" style="margin:0;">$$2x^2+5x-6$$</div>
                            </div>
                            <div class="ilustrasi-summary-simple">
                                <span class="label">Sisa</span>
                                <div class="rumus-box" style="margin:0;">$$19$$</div>
                            </div>
                            <div class="ilustrasi-summary-simple">
                                <span class="label">Pola</span>
                                <p>bagi → kali → kurang, lalu ulangi sampai selesai.</p>
                            </div>
                        </div>
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

            <div class="section-label">Mari Mencoba</div>
            <div class="contoh-card">
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
                </div>

                <div class="step-interaktif-wrap" id="stepInteraktifWrap">
                    <div class="step-card" id="stepCard1">
                        <div class="step-label">Langkah 1</div>
                        <div class="step-question">
                            Bagi suku tertinggi pembilang dengan suku tertinggi penyebut.
                            <div class="rumus-box">$$\frac{2x^3}{x}=$$</div>
                            Tuliskan suku pertama hasil bagi.
                        </div>

                        <input type="text" class="step-answer-input" id="answer1" data-step="1" placeholder=" ">
                        <div class="step-helper">Bagi koefisien, lalu kurangi pangkat variabel.</div>

                        <div class="step-btn-row">
                            <button type="button" class="btn-materi btn-secondary btn-check-step" data-step="1">Cek
                                Jawaban</button>
                        </div>

                        <div class="step-feedback" id="feedback1"></div>
                    </div>

                    <div class="step-card" id="stepCard2">
                        <div class="step-label">Langkah 2</div>
                        <div class="step-question">
                            Kalikan suku hasil bagi pertama dengan penyebut.
                            <div class="rumus-box">$$2x^2(x+1)=$$</div>
                            Tuliskan hasil perkaliannya.
                        </div>

                        <input type="text" class="step-answer-input" id="answer2" data-step="2"
                            placeholder="">
                        <div class="step-helper">Gunakan sifat distributif.</div>

                        <div class="step-btn-row">
                            <button type="button" class="btn-materi btn-secondary btn-check-step" data-step="2">Cek
                                Jawaban</button>
                        </div>

                        <div class="step-feedback" id="feedback2"></div>
                    </div>

                    <div class="step-card" id="stepCard3">
                        <div class="step-label">Langkah 3</div>
                        <div class="step-question">
                            Kurangkan hasil perkalian dari pembilang semula.
                            <div class="rumus-box">$$(2x^3+3x^2-2x+1)-(2x^3+2x^2)=$$</div>
                            Tuliskan sisa barunya.
                        </div>

                        <input type="text" class="step-answer-input" id="answer3" data-step="3"
                            placeholder="">
                        <div class="step-helper">Kurangkan suku-suku yang sejenis.</div>

                        <div class="step-btn-row">
                            <button type="button" class="btn-materi btn-secondary btn-check-step" data-step="3">Cek
                                Jawaban</button>
                        </div>

                        <div class="step-feedback" id="feedback3"></div>
                    </div>

                    <div class="step-card" id="stepCard4">
                        <div class="step-label">Langkah 4</div>
                        <div class="step-question">
                            Bagi suku tertinggi yang baru dengan \(x\).
                            <div class="rumus-box">$$\frac{x^2}{x}=$$</div>
                            Tuliskan suku kedua hasil bagi.
                        </div>

                        <input type="text" class="step-answer-input" id="answer4" data-step="4" placeholder="">
                        <div class="step-helper">Suku ini ditambahkan ke hasil bagi sebelumnya.</div>

                        <div class="step-btn-row">
                            <button type="button" class="btn-materi btn-secondary btn-check-step" data-step="4">Cek
                                Jawaban</button>
                        </div>

                        <div class="step-feedback" id="feedback4"></div>
                    </div>

                    <div class="step-card" id="stepCard5">
                        <div class="step-label">Langkah 5</div>
                        <div class="step-question">
                            Kalikan \(x\) dengan \((x+1)\), lalu kurangkan.
                            <div class="rumus-box">$$x(x+1)=x^2+x$$</div>
                            <div class="rumus-box">$$(x^2-2x+1)-(x^2+x)=$$</div>
                            Tuliskan sisa baru yang diperoleh.
                        </div>

                        <input type="text" class="step-answer-input" id="answer5" data-step="5" placeholder="">
                        <div class="step-helper">Perhatikan tanda negatif pada saat pengurangan.</div>

                        <div class="step-btn-row">
                            <button type="button" class="btn-materi btn-secondary btn-check-step" data-step="5">Cek
                                Jawaban</button>
                        </div>

                        <div class="step-feedback" id="feedback5"></div>
                    </div>

                    <div class="step-card" id="stepCard6">
                        <div class="step-label">Langkah 6</div>
                        <div class="step-question">
                            Selesaikan pembagian sampai akhir.
                            <div class="rumus-box">$$\frac{-3x}{x}=$$</div>
                            Tuliskan hasil bagi akhir \(h(x)\) dan sisa \(s\).
                        </div>

                        <input type="text" class="step-answer-input" id="answer6" data-step="6"
                            placeholder="">
                        <div class="step-helper">Tulis dua informasi sekaligus: hasil bagi dan sisa.</div>

                        <div class="step-btn-row">
                            <button type="button" class="btn-materi btn-secondary btn-check-step" data-step="6">Cek
                                Jawaban</button>
                        </div>

                        <div class="step-feedback" id="feedback6"></div>
                    </div>

                    <div class="final-result" id="finalSimple">
                        <p style="font-weight:700; color:#1f6830; margin-bottom:12px;">
                            Hasil akhir pembagian:
                        </p>

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
                    <span>Cocokkan Isi Perhitungan ke Langkah yang Benar</span>
                </div>

                <p>
                    Bagian atas berisi <b>Langkah 1–10</b>. Bagian bawah berisi
                    <b>isi perhitungan</b> yang diacak. Geser isi perhitungan ke langkah yang sesuai.
                </p>

                <div class="latihan-match-board">
                    <div class="latihan-dnd-soal">
                        Soal:
                        \[
                        (6x^5 - 4x^4 + 3x^3 - 12x^2 + 7x - 9)\div(2x - 3)
                        \]
                    </div>

                    <div class="latihan-note">
                        Geser <b>isi perhitungan</b> yang diacak ke kotak <b>Langkah 1–10</b> yang sesuai.
                    </div>

                    <div class="latihan-match-top">
                        <div class="panel-title">Langkah 1–10</div>
                        <div class="langkah-target-grid" id="langkahTargetGrid">
                            <div class="langkah-target-slot" data-answer="1">
                                <div class="langkah-target-head">
                                    <div class="langkah-target-title">Langkah 1</div>

                                </div>
                                <div class="langkah-target-body"></div>
                            </div>

                            <div class="langkah-target-slot" data-answer="2">
                                <div class="langkah-target-head">
                                    <div class="langkah-target-title">Langkah 2</div>

                                </div>
                                <div class="langkah-target-body"></div>
                            </div>

                            <div class="langkah-target-slot" data-answer="3">
                                <div class="langkah-target-head">
                                    <div class="langkah-target-title">Langkah 3</div>

                                </div>
                                <div class="langkah-target-body"></div>

                            </div>

                            <div class="langkah-target-slot" data-answer="4">
                                <div class="langkah-target-head">
                                    <div class="langkah-target-title">Langkah 4</div>

                                </div>
                                <div class="langkah-target-body"></div>

                            </div>

                            <div class="langkah-target-slot" data-answer="5">
                                <div class="langkah-target-head">
                                    <div class="langkah-target-title">Langkah 5</div>

                                </div>
                                <div class="langkah-target-body"></div>

                            </div>

                            <div class="langkah-target-slot" data-answer="6">
                                <div class="langkah-target-head">
                                    <div class="langkah-target-title">Langkah 6</div>

                                </div>
                                <div class="langkah-target-body"></div>

                            </div>

                            <div class="langkah-target-slot" data-answer="7">
                                <div class="langkah-target-head">
                                    <div class="langkah-target-title">Langkah 7</div>

                                </div>
                                <div class="langkah-target-body"></div>

                            </div>

                            <div class="langkah-target-slot" data-answer="8">
                                <div class="langkah-target-head">
                                    <div class="langkah-target-title">Langkah 8</div>

                                </div>
                                <div class="langkah-target-body"></div>

                            </div>

                            <div class="langkah-target-slot" data-answer="9">
                                <div class="langkah-target-head">
                                    <div class="langkah-target-title">Langkah 9</div>

                                </div>
                                <div class="langkah-target-body"></div>

                            </div>

                            <div class="langkah-target-slot" data-answer="10">
                                <div class="langkah-target-head">
                                    <div class="langkah-target-title">Langkah 10</div>

                                </div>
                                <div class="langkah-target-body"></div>

                            </div>
                        </div>
                    </div>

                    <div class="isi-bank-wrap">
                        <div class="langkah-bank-title">Isi Perhitungan (Diacak)</div>
                        <div class="isi-grid" id="isiItems">
                            <div class="isi-card" draggable="true" data-step="1">
                                <div class="isi-card-content">\[
                                    \frac{6x^5}{2x}=3x^4
                                    \]</div>
                            </div>

                            <div class="isi-card" draggable="true" data-step="2">
                                <div class="isi-card-content">\[
                                    (2x-3)(3x^4)=6x^5-9x^4
                                    \]</div>
                            </div>

                            <div class="isi-card" draggable="true" data-step="3">
                                <div class="isi-card-content">\[
                                    -4x^4-(-9x^4)=5x^4
                                    \]</div>
                            </div>

                            <div class="isi-card" draggable="true" data-step="4">
                                <div class="isi-card-content">\[
                                    \frac{5x^4}{2x}=\frac{5}{2}x^3
                                    \]</div>
                            </div>

                            <div class="isi-card" draggable="true" data-step="5">
                                <div class="isi-card-content">\[
                                    (2x-3)\left(\frac{5}{2}x^3\right)=5x^4-\frac{15}{2}x^3
                                    \]</div>
                            </div>

                            <div class="isi-card" draggable="true" data-step="6">
                                <div class="isi-card-content">\[
                                    3x^3-\left(-\frac{15}{2}x^3\right)=\frac{21}{2}x^3
                                    \]</div>
                            </div>

                            <div class="isi-card" draggable="true" data-step="7">
                                <div class="isi-card-content">\[
                                    \frac{\frac{21}{2}x^3}{2x}=\frac{21}{4}x^2
                                    \]</div>
                            </div>

                            <div class="isi-card" draggable="true" data-step="8">
                                <div class="isi-card-content">\[
                                    (2x-3)\left(\frac{21}{4}x^2\right)=\frac{21}{2}x^3-\frac{63}{4}x^2
                                    \]</div>
                            </div>

                            <div class="isi-card" draggable="true" data-step="9">
                                <div class="isi-card-content">\[
                                    -12x^2-\left(-\frac{63}{4}x^2\right)=\frac{15}{4}x^2
                                    \]</div>
                            </div>

                            <div class="isi-card" draggable="true" data-step="10">
                                <div class="isi-card-content">\[
                                    \frac{\frac{15}{4}x^2}{2x}=\frac{15}{8}x
                                    \]</div>
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
                   Kunci materi setelah eksplorasi
                ========================== */
                const soalItems = document.querySelectorAll('.eks-soal');
                const materiLanjutanWrap = document.getElementById('materiLanjutanWrap');

                function updateEksplorasiProgress() {
                    let answeredCount = 0;

                    soalItems.forEach((soal) => {
                        if (soal.getAttribute('data-answered') === 'true') {
                            answeredCount++;
                        }
                    });

                    const total = soalItems.length;

                    if (answeredCount === total) {
                        if (materiLanjutanWrap) {
                            materiLanjutanWrap.classList.add('show');
                            renderMath(materiLanjutanWrap);
                        }
                    } else {
                        if (materiLanjutanWrap) {
                            materiLanjutanWrap.classList.remove('show');
                        }
                    }
                }

                /* =========================
                   Eksplorasi pilihan ganda
                ========================== */
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
                                if (status) {
                                    status.textContent = 'Benar ✅';
                                    status.className = 'jawaban-status correct';
                                }
                            } else {
                                btn.classList.add('wrong');
                                if (status) {
                                    status.textContent = 'Jawaban masih kurang tepat.';
                                    status.className = 'jawaban-status wrong';
                                }
                            }

                            soal.setAttribute('data-answered', 'true');
                            updateEksplorasiProgress();
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
                ].filter(Boolean);

                const hasilBox = document.getElementById('hasilBox');
                const progressFillIlustrasi = document.getElementById('progressFillIlustrasi');
                const progressTextIlustrasi = document.getElementById('progressTextIlustrasi');
                let currentLangkah = 0;

                function updateProgressIlustrasi() {
                    const totalLangkah = langkahBoxes.length;
                    const persen = totalLangkah > 0 ? (currentLangkah / totalLangkah) * 100 : 0;

                    if (progressFillIlustrasi) {
                        progressFillIlustrasi.style.width = persen + '%';
                    }

                    if (progressTextIlustrasi) {
                        progressTextIlustrasi.textContent = currentLangkah + ' dari ' + totalLangkah + ' langkah dibuka';
                    }
                }

                function resetLangkah() {
                    currentLangkah = 0;

                    langkahBoxes.forEach(box => {
                        box.classList.remove('show');
                    });

                    if (hasilBox) {
                        hasilBox.classList.remove('show');
                    }

                    if (btnNextLangkah) {
                        btnNextLangkah.disabled = false;
                        btnNextLangkah.textContent = 'Buka Langkah 1';
                    }

                    updateProgressIlustrasi();
                }

                if (btnShowIlustrasi) {
                    btnShowIlustrasi.addEventListener('click', function () {
                        if (ilustrasiContent) {
                            ilustrasiContent.classList.add('show');
                            updateProgressIlustrasi();
                            renderMath(ilustrasiContent);
                        }
                    });
                }

                if (btnNextLangkah) {
                    btnNextLangkah.addEventListener('click', function () {
                        if (ilustrasiContent) {
                            ilustrasiContent.classList.add('show');
                        }

                        if (currentLangkah < langkahBoxes.length) {
                            langkahBoxes[currentLangkah].classList.add('show');
                            currentLangkah++;
                            updateProgressIlustrasi();

                            if (currentLangkah < langkahBoxes.length) {
                                btnNextLangkah.textContent = 'Buka Langkah ' + (currentLangkah + 1);
                            } else {
                                btnNextLangkah.textContent = 'Tampilkan Hasil Akhir';
                            }
                        } else {
                            if (hasilBox) {
                                hasilBox.classList.add('show');
                            }
                            btnNextLangkah.textContent = 'Semua Langkah Sudah Dibuka';
                            btnNextLangkah.disabled = true;
                            updateProgressIlustrasi();
                        }

                        if (ilustrasiContent) {
                            renderMath(ilustrasiContent);
                        }
                    });
                }

                if (btnResetLangkah) {
                    btnResetLangkah.addEventListener('click', function () {
                        resetLangkah();
                        if (ilustrasiContent) {
                            ilustrasiContent.classList.add('show');
                            renderMath(ilustrasiContent);
                        }
                    });
                }

                /* =========================
                   Contoh interaktif / Mari Mencoba
                ========================== */
                const btnMulaiContoh = document.getElementById('btnMulaiContoh');
                const stepWrap = document.getElementById('stepInteraktifWrap');
                const finalBox = document.getElementById('finalSimple');

                const allStepCards = [
                    document.getElementById('stepCard1'),
                    document.getElementById('stepCard2'),
                    document.getElementById('stepCard3'),
                    document.getElementById('stepCard4'),
                    document.getElementById('stepCard5'),
                    document.getElementById('stepCard6')
                ].filter(Boolean);

                const jawabanBenar = {
                    1: ['2x^2', '2x2'],
                    2: ['2x^3+2x^2', '2x3+2x2'],
                    3: ['x^2-2x+1', 'x2-2x+1'],
                    4: ['x'],
                    5: ['-3x+1', '-3x1'],
                    6: [
                        'h(x)=2x^2+x-3,s=4',
                        'hx=2x^2+x-3,s=4',
                        'h(x)=2x2+x-3,s=4',
                        'hx=2x2+x-3,s=4',
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
                                    Kita membagi suku berpangkat tertinggi pada pembilang dengan suku berpangkat tertinggi pada penyebut.
                                </p>
                                <div class="rumus-box">$$\\frac{2x^3}{x}=2x^2$$</div>
                                <p style="margin-bottom:0;">
                                    Jadi suku pertama hasil bagi adalah \\(2x^2\\). Lanjut ke langkah berikutnya.
                                </p>
                            </div>
                        `,
                        salah: `
                            <b>Jawaban masih salah ❌</b>
                            <div class="step-solution">
                                <p style="margin-top:0;">
                                    Ambil suku tertinggi pada pembilang, yaitu \\(2x^3\\), lalu bagi dengan suku tertinggi pada penyebut, yaitu \\(x\\).
                                </p>
                                <div class="rumus-box">$$\\frac{2x^3}{x}=2x^2$$</div>
                                <p style="margin-bottom:0;">
                                    Jadi jawaban yang benar adalah <b>\\(2x^2\\)</b>. Sekarang lanjut ke langkah berikutnya.
                                </p>
                            </div>
                        `
                    },
                    2: {
                        benar: `
                            <b>Benar ✅</b>
                            <div class="step-solution">
                                <p style="margin-top:0;">
                                    Suku hasil bagi pertama harus dikalikan ke seluruh penyebut.
                                </p>
                                <div class="rumus-box">$$2x^2(x+1)=2x^3+2x^2$$</div>
                                <p style="margin-bottom:0;">
                                    Hasil perkaliannya tepat. Lanjut ke langkah berikutnya.
                                </p>
                            </div>
                        `,
                        salah: `
                            <b>Jawaban masih salah ❌</b>
                            <div class="step-solution">
                                <p style="margin-top:0;">
                                    Kalikan \\(2x^2\\) ke setiap suku dalam \\((x+1)\\).
                                </p>
                                <div class="rumus-box">$$2x^2(x+1)=2x^3+2x^2$$</div>
                                <p style="margin-bottom:0;">
                                    Jadi jawaban yang benar adalah <b>\\(2x^3+2x^2\\)</b>. Sekarang lanjut ke langkah berikutnya.
                                </p>
                            </div>
                        `
                    },
                    3: {
                        benar: `
                            <b>Benar ✅</b>
                            <div class="step-solution">
                                <p style="margin-top:0;">
                                    Sekarang kurangkan hasil perkalian dari pembilang semula.
                                </p>
                                <div class="rumus-box">$$(2x^3+3x^2-2x+1)-(2x^3+2x^2)=x^2-2x+1$$</div>
                                <p style="margin-bottom:0;">
                                    Sisa baru sudah tepat. Lanjut ke langkah berikutnya.
                                </p>
                            </div>
                        `,
                        salah: `
                            <b>Jawaban masih salah ❌</b>
                            <div class="step-solution">
                                <p style="margin-top:0;">
                                    Kurangkan suku-suku sejenis dengan teliti, terutama tanda negatif.
                                </p>
                                <div class="rumus-box">$$(2x^3+3x^2-2x+1)-(2x^3+2x^2)=x^2-2x+1$$</div>
                                <p style="margin-bottom:0;">
                                    Jadi jawaban yang benar adalah <b>\\(x^2-2x+1\\)</b>. Sekarang lanjut ke langkah berikutnya.
                                </p>
                            </div>
                        `
                    },
                    4: {
                        benar: `
                            <b>Benar ✅</b>
                            <div class="step-solution">
                                <p style="margin-top:0;">
                                    Ulangi pola yang sama menggunakan sisa baru.
                                </p>
                                <div class="rumus-box">$$\\frac{x^2}{x}=x$$</div>
                                <p style="margin-bottom:0;">
                                    Jadi suku kedua hasil bagi adalah \\(x\\). Lanjut ke langkah berikutnya.
                                </p>
                            </div>
                        `,
                        salah: `
                            <b>Jawaban masih salah ❌</b>
                            <div class="step-solution">
                                <p style="margin-top:0;">
                                    Ambil suku tertinggi dari sisa baru, yaitu \\(x^2\\), lalu bagi dengan \\(x\\).
                                </p>
                                <div class="rumus-box">$$\\frac{x^2}{x}=x$$</div>
                                <p style="margin-bottom:0;">
                                    Jadi jawaban yang benar adalah <b>\\(x\\)</b>. Sekarang lanjut ke langkah berikutnya.
                                </p>
                            </div>
                        `
                    },
                    5: {
                        benar: `
                            <b>Benar ✅</b>
                            <div class="step-solution">
                                <p style="margin-top:0;">
                                    Kalikan \\(x\\) dengan \\((x+1)\\), lalu kurangkan dari sisa sebelumnya.
                                </p>
                                <div class="rumus-box">$$x(x+1)=x^2+x$$</div>
                                <div class="rumus-box">$$(x^2-2x+1)-(x^2+x)=-3x+1$$</div>
                                <p style="margin-bottom:0;">
                                    Sisa baru yang diperoleh sudah tepat. Lanjut ke langkah terakhir.
                                </p>
                            </div>
                        `,
                        salah: `
                            <b>Jawaban masih salah ❌</b>
                            <div class="step-solution">
                                <p style="margin-top:0;">
                                    Kerjakan dua tahap: kalikan dulu, lalu kurangkan.
                                </p>
                                <div class="rumus-box">$$x(x+1)=x^2+x$$</div>
                                <div class="rumus-box">$$(x^2-2x+1)-(x^2+x)=-3x+1$$</div>
                                <p style="margin-bottom:0;">
                                    Jadi jawaban yang benar adalah <b>\\(-3x+1\\)</b>. Sekarang lanjut ke langkah terakhir.
                                </p>
                            </div>
                        `
                    },
                    6: {
                        benar: `
                            <b>Benar ✅</b>
                            <div class="step-solution">
                                <p style="margin-top:0;">
                                    Putaran terakhir dilakukan dengan pola yang sama: bagi, kali, lalu kurang.
                                </p>
                                <div class="rumus-box">$$\\frac{-3x}{x}=-3$$</div>
                                <div class="rumus-box">$$-3(x+1)=-3x-3$$</div>
                                <div class="rumus-box">$$(-3x+1)-(-3x-3)=4$$</div>
                                <div class="rumus-box">$$h(x)=2x^2+x-3$$</div>
                                <div class="rumus-box">$$s=4$$</div>
                                <p style="margin-bottom:0;">
                                    Hasil akhir sudah tepat.
                                </p>
                            </div>
                        `,
                        salah: `
                            <b>Jawaban masih salah ❌</b>
                            <div class="step-solution">
                                <p style="margin-top:0;">
                                    Langkah terakhir tetap memakai pola yang sama sampai didapat hasil bagi dan sisa.
                                </p>
                                <div class="rumus-box">$$\\frac{-3x}{x}=-3$$</div>
                                <div class="rumus-box">$$-3(x+1)=-3x-3$$</div>
                                <div class="rumus-box">$$(-3x+1)-(-3x-3)=4$$</div>
                                <div class="rumus-box">$$h(x)=2x^2+x-3$$</div>
                                <div class="rumus-box">$$s=4$$</div>
                                <p style="margin-bottom:0;">
                                    Jadi jawaban akhirnya adalah <b>\\(h(x)=2x^2+x-3\\)</b> dan <b>\\(s=4\\)</b>.
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

                function showStepsUntil(stepNumber) {
                    if (stepWrap) {
                        stepWrap.classList.add('show');
                    }

                    allStepCards.forEach((card, index) => {
                        const nomor = index + 1;
                        card.classList.remove('active');

                        if (nomor <= stepNumber) {
                            card.classList.add('active');
                        }
                    });

                    if (stepWrap) {
                        renderMath(stepWrap);
                    }
                }

                function resetContohInteraktif() {
                    allStepCards.forEach((card, index) => {
                        const step = index + 1;
                        const input = document.getElementById('answer' + step);
                        const feedback = document.getElementById('feedback' + step);

                        card.classList.remove('active', 'done', 'answered-correct', 'answered-wrong');

                        if (input) {
                            input.value = '';
                            input.disabled = false;
                            input.dataset.locked = 'false';
                            input.classList.remove('correct-answer', 'wrong-answer');
                        }

                        if (feedback) {
                            feedback.className = 'step-feedback';
                            feedback.innerHTML = '';
                        }
                    });

                    if (finalBox) {
                        finalBox.classList.remove('show');
                    }
                }

                function goToNextStep(step) {
                    const nextStep = step + 1;

                    if (nextStep <= allStepCards.length) {
                        setTimeout(() => {
                            showStepsUntil(nextStep);
                        }, 900);
                    } else {
                        setTimeout(() => {
                            if (finalBox) {
                                finalBox.classList.add('show');
                            }
                            if (stepWrap) {
                                renderMath(stepWrap);
                            }
                        }, 900);
                    }
                }

                function applyStepResult(step, isBenar) {
                    const currentCard = document.getElementById('stepCard' + step);
                    const input = document.getElementById('answer' + step);
                    const feedback = document.getElementById('feedback' + step);

                    if (!input || !feedback || !currentCard || input.dataset.locked === 'true') return;

                    input.dataset.locked = 'true';
                    input.disabled = true;
                    currentCard.classList.add('done');
                    currentCard.classList.remove('answered-correct', 'answered-wrong');

                    if (isBenar) {
                        input.classList.remove('wrong-answer');
                        input.classList.add('correct-answer');
                        currentCard.classList.add('answered-correct');
                        feedback.className = 'step-feedback correct';
                        feedback.innerHTML = feedbackText[step].benar;
                    } else {
                        input.classList.remove('correct-answer');
                        input.classList.add('wrong-answer');
                        currentCard.classList.add('answered-wrong');
                        feedback.className = 'step-feedback wrong';
                        feedback.innerHTML = feedbackText[step].salah;
                    }

                    if (stepWrap) {
                        renderMath(stepWrap);
                    }
                    goToNextStep(step);
                }

                if (btnMulaiContoh) {
                    btnMulaiContoh.addEventListener('click', function () {
                        resetContohInteraktif();
                        showStepsUntil(1);
                    });
                }

                document.querySelectorAll('.btn-check-step').forEach((button) => {
                    button.addEventListener('click', function () {
                        const step = parseInt(button.getAttribute('data-step'), 10);
                        const input = document.getElementById('answer' + step);

                        if (!input || input.dataset.locked === 'true') return;

                        const value = input.value.trim();

                        if (!value) {
                            input.focus();
                            return;
                        }

                        const benar = isCorrect(step, value);
                        applyStepResult(step, benar);
                    });
                });

                resetLangkah();
                resetContohInteraktif();

                /* =========================
                   Drag and Drop Latihan
                ========================== */
                const isiItemsContainer = document.getElementById('isiItems');
                const langkahTargetSlots = document.querySelectorAll('.langkah-target-slot');
                const resetDndBtn = document.getElementById('resetDndBtn');
                const dndFinalResult = document.getElementById('dndFinalResult');
                const dndProgressText = document.getElementById('dndProgressText');

                let draggedCard = null;

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

                    langkahTargetSlots.forEach((slot) => {
                        const placedCard = slot.querySelector('.isi-card');
                        const answer = slot.getAttribute('data-answer');

                        if (placedCard && placedCard.getAttribute('data-step') === answer) {
                            correctCount++;
                        }
                    });

                    if (dndProgressText) {
                        dndProgressText.textContent = 'Kemajuan: ' + correctCount + ' dari 10 langkah sudah benar.';
                    }

                    if (dndFinalResult) {
                        if (correctCount === 10) {
                            dndFinalResult.classList.add('show');
                        } else {
                            dndFinalResult.classList.remove('show');
                        }
                    }
                }

                function shuffleIsiCards(container) {
                    if (!container) return;

                    const cards = Array.from(container.querySelectorAll('.isi-card'));

                    for (let i = cards.length - 1; i > 0; i--) {
                        const j = Math.floor(Math.random() * (i + 1));
                        [cards[i], cards[j]] = [cards[j], cards[i]];
                    }

                    cards.forEach(card => container.appendChild(card));
                }

                function resetDndExercise() {
                    if (dndFinalResult) {
                        dndFinalResult.classList.remove('show');
                    }

                    langkahTargetSlots.forEach((slot) => {
                        clearSlotState(slot);
                        updateSlotBadge(slot, 'netral', 'Belum diisi');

                        const hint = slot.querySelector('.drop-hint');
                        if (hint) hint.style.display = 'block';

                        const body = slot.querySelector('.langkah-target-body');
                        const placedCard = body ? body.querySelector('.isi-card') : null;

                        if (placedCard && isiItemsContainer) {
                            placedCard.classList.remove('locked-correct');
                            isiItemsContainer.appendChild(placedCard);
                        }
                    });

                    shuffleIsiCards(isiItemsContainer);
                    updateDndProgress();
                    renderMath(document.body);
                }

                document.querySelectorAll('.isi-card').forEach((card) => {
                    card.addEventListener('dragstart', function () {
                        if (card.classList.contains('locked-correct')) return;
                        draggedCard = card;
                        card.classList.add('dragging');
                    });

                    card.addEventListener('dragend', function () {
                        card.classList.remove('dragging');
                    });
                });

                langkahTargetSlots.forEach((slot) => {
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

                        const answer = slot.getAttribute('data-answer');
                        const draggedStep = draggedCard.getAttribute('data-step');
                        const hint = slot.querySelector('.drop-hint');
                        const body = slot.querySelector('.langkah-target-body');
                        const existingCard = body ? body.querySelector('.isi-card') : null;

                        if (!body) return;

                        if (existingCard && existingCard !== draggedCard) {
                            if (existingCard.classList.contains('locked-correct')) {
                                draggedCard = null;
                                return;
                            }
                            if (isiItemsContainer) {
                                isiItemsContainer.appendChild(existingCard);
                            }
                        }

                        body.appendChild(draggedCard);

                        if (draggedStep === answer) {
                            clearSlotState(slot);
                            slot.classList.add('correct');
                            updateSlotBadge(slot, 'benar', 'Benar');

                            if (hint) hint.style.display = 'none';
                            draggedCard.classList.add('locked-correct');
                        } else {
                            clearSlotState(slot);
                            slot.classList.add('wrong');
                            updateSlotBadge(slot, 'salah', 'Salah');

                            if (hint) hint.style.display = 'none';

                            const wrongCard = draggedCard;

                            setTimeout(() => {
                                if (!wrongCard.classList.contains('locked-correct') && isiItemsContainer) {
                                    isiItemsContainer.appendChild(wrongCard);
                                }

                                clearSlotState(slot);
                                updateSlotBadge(slot, 'netral', 'Belum diisi');

                                if (hint) hint.style.display = 'block';

                                updateDndProgress();
                            }, 700);
                        }

                        draggedCard = null;
                        updateDndProgress();
                        renderMath(document.body);
                    });
                });

                if (resetDndBtn) {
                    resetDndBtn.addEventListener('click', function () {
                        resetDndExercise();
                    });
                }

                resetDndExercise();
                updateEksplorasiProgress();
                renderMath(document.body);
            });
        </script>
    </div>
@endsection

@section('nav')
    <a href="{{ route('kuisb') }}" class="btn-nav prev-btn">
        ← Previous
    </a>

    <a href="{{ route('metodehorner') }}" class="btn-nav next-btn">
        Next →
    </a>
@endsection