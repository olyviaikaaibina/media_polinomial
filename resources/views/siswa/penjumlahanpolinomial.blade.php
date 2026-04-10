@extends('layout.halamanmateri')

@section('content')
    {{-- =========================
    KaTeX
    ========================== --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/contrib/auto-render.min.js" onload="renderMathInElement(document.body, {
                        delimiters: [
                            {left: '$$', right: '$$', display: true},
                            {left: '$', right: '$', display: false}
                        ]
                    });">
                    </script>

    <style>
        :root {
            --green: #1b7a2a;
            --green-soft: #f2fbf4;
            --orange: #e0702b;
            --orange-soft: #fff6f0;
            --text: #222;
            --muted: #555;

            --blue: #5b9bd5;
            --blue-soft: #f5f9ff;

            --def-bg: #f3c8b7;
            --def-pill: #86c06c;
            --def-pill-border: #2f7b3a;
            --def-box-border: rgba(0, 0, 0, .06);
        }

        * {
            box-sizing: border-box;
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

        .card {
            border-radius: 16px;
            padding: 20px 22px;
            background: #fff;
            margin-bottom: 20px;
            box-shadow: 0 10px 28px rgba(0, 0, 0, .05);
            border: 1px solid rgba(0, 0, 0, .05);
        }

        .card-eksplorasi {
            background: linear-gradient(180deg, var(--blue-soft), #fff);
            border-left: 6px solid var(--blue);
        }

        .card-green {
            background: linear-gradient(180deg, var(--green-soft), #fff);
            border-left: 6px solid #2e8b57;
        }

        .tujuan-card {
            background: linear-gradient(135deg, var(--orange-soft) 0%, #ffffff 100%);
            border-left: 8px solid var(--orange);
            padding: 22px 24px;
        }

        .tujuan-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
        }

        .tujuan-header .title {
            font-size: 22px;
            font-weight: 900;
            color: var(--green);
            margin: 0;
        }

        .tujuan-card ol {
            margin: 0;
            padding-left: 22px;
            color: var(--muted);
        }

        .tujuan-card li {
            margin: 6px 0 0;
            text-align: justify;
        }

        .section-title {
            font-size: 30px;
            font-weight: 800;
            color: var(--green);
            margin: 30px 0 12px;
        }

        .title-box {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 800;
            font-size: 18px;
            color: var(--green);
            margin-bottom: 12px;
        }

        p {
            margin: 10px 0;
            text-align: justify;
            color: var(--muted);
            font-size: 16px;
            line-height: 1.85;
        }

        .card ul,
        .card ol {
            margin: 10px 0 10px 22px;
            color: var(--muted);
            font-size: 16px;
        }

        .card li {
            margin: 6px 0;
        }

        .highlight {
            font-weight: 700;
            color: #000;
        }

        .rumus-box {
            margin: 14px 0;
            padding: 14px 16px;
            border-radius: 14px;
            background: rgba(255, 255, 255, .90);
            border: 1px solid rgba(0, 0, 0, .08);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            color: #111;
            overflow-x: auto;
        }

        .penjelasan-plain {
            margin: 18px 0 22px;
        }

        .penjelasan-plain p {
            margin: 0;
            font-size: 16px;
            line-height: 1.9;
            color: var(--muted);
        }

        /* ===== DEFINISI ===== */
        .definisi-box .katex-display {
            margin: 0 !important;
        }

        .definisi-box {
            position: relative;
            background: var(--def-bg);
            border-radius: 18px;
            padding: 40px 26px 22px;
            margin: 50px 0 22px;
            border: 1px solid var(--def-box-border);
            box-shadow: 0 10px 26px rgba(0, 0, 0, .04);
            overflow: visible;
        }

        .definisi-pill {
            position: absolute;
            top: -22px;
            left: 22px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 18px;
            border-radius: 999px;
            background: var(--def-pill);
            border: 3px solid var(--def-pill-border);
            font-weight: 900;
            letter-spacing: .4px;
            color: #0a0a0a;
            font-size: 14px;
            box-shadow: 0 10px 22px rgba(0, 0, 0, .10);
        }

        .definisi-lead {
            margin: 0 0 14px;
            color: #374151;
            font-weight: 900;
            font-size: 22px;
            line-height: 1.35;
        }

        .definisi-rumus {
            margin: 6px auto 18px;
            max-width: 720px;
            background: rgba(255, 255, 255, .85);
            border: 1px solid rgba(0, 0, 0, .08);
            border-radius: 16px;
            padding: 22px 18px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-x: auto;
        }

        .definisi-sub {
            margin: 0 0 8px;
            color: #374151;
            font-weight: 900;
            font-size: 18px;
        }

        .definisi-box ul {
            margin: 0;
            padding-left: 22px;
            color: #374151;
            font-size: 16px;
        }

        .definisi-box li {
            margin: 8px 0;
            line-height: 1.8;
        }

        /* ===== TABLE ===== */
        .table-wrap {
            margin-top: 14px;
            overflow-x: auto;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, .10);
            box-shadow: 0 10px 28px rgba(0, 0, 0, .04);
        }

        table.materi-table {
            width: 100%;
            min-width: 740px;
            border-collapse: collapse;
            background: #fff;
        }

        .materi-table th {
            background: #a7d29c;
            color: #0b3d1d;
            padding: 10px 12px;
            border: 1px solid #8fc086;
            font-weight: 900;
            text-align: center;
        }

        .materi-table td {
            padding: 14px 12px;
            border: 1px solid rgba(0, 0, 0, .10);
            text-align: center;
            vertical-align: middle;
            color: var(--muted);
        }

        /* ===== QUIZ Eksplorasi ===== */
        .question {
            background: #ffffff;
            border: 1px solid rgba(91, 155, 213, .25);
            border-radius: 14px;
            padding: 14px 16px;
            margin-top: 14px;
        }

        .question .qtitle {
            font-weight: 900;
            color: #1e3a8a;
            margin-bottom: 8px;
        }

        .quiz-list {
            margin: 10px 0 0 18px;
        }

        .quiz-item {
            margin: 12px 0 16px;
        }

        .quiz-q {
            margin-bottom: 6px;
            color: var(--text);
        }

        .quiz-input {
            width: 100%;
            max-width: 520px;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, .18);
            outline: none;
            font-family: "Times New Roman", Times, serif;
            font-size: 16px;
            background: #fff;
        }

        .quiz-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 8px;
            flex-wrap: wrap;
        }

        .quiz-check,
        .quiz-reset,
        .quiz-checkall {
            padding: 8px 14px;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, .14);
            background: #fff;
            cursor: pointer;
            font-weight: 800;
        }

        .quiz-feedback {
            font-weight: 900;
            padding: 6px 10px;
            border-radius: 10px;
            display: inline-block;
        }

        .quiz-feedback.ok {
            color: #0f5f22;
            background: rgba(27, 122, 42, .10);
            border: 1px solid rgba(27, 122, 42, .18);
        }

        .quiz-feedback.no {
            color: #8c2b00;
            background: rgba(224, 112, 43, .10);
            border: 1px solid rgba(224, 112, 43, .18);
        }

        .quiz-summary {
            margin-left: 10px;
            font-weight: 900;
            color: #1e3a8a;
        }

        /* ===== CONTOH (interactive) ===== */
        .contoh-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 26px;
            border-radius: 999px;
            background: #f1a98a;
            border: 1px solid rgba(0, 0, 0, .08);
            font-weight: 900;
            letter-spacing: .6px;
            color: #111;
            margin-bottom: 10px;
        }

        .contoh-box {
            border: 2px solid rgba(27, 122, 42, .35);
            border-radius: 14px;
            padding: 14px 14px 16px;
            background: rgba(255, 255, 255, .65);
        }

        .contoh-row-title {
            font-weight: 900;
            color: #111;
            margin: 6px 0 6px;
        }

        .contoh-table th {
            background: #84d36b;
            color: #0b3d1d;
            border-color: rgba(0, 0, 0, .18);
        }

        .hasil-input {
            width: 100%;
            max-width: 220px;
            padding: 8px 10px;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, .18);
            font-family: "Times New Roman", Times, serif;
            font-size: 16px;
            outline: none;
            text-align: center;
            background: #fff;
        }

        .mini-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: center;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        .mini-btn {
            padding: 8px 14px;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, .14);
            background: #fff;
            cursor: pointer;
            font-weight: 800;
        }

        .mini-feedback {
            font-weight: 900;
            padding: 6px 10px;
            border-radius: 10px;
            display: inline-block;
        }

        .mini-feedback.ok {
            color: #0f5f22;
            background: rgba(27, 122, 42, .10);
            border: 1px solid rgba(27, 122, 42, .18);
        }

        .mini-feedback.no {
            color: #8c2b00;
            background: rgba(224, 112, 43, .10);
            border: 1px solid rgba(224, 112, 43, .18);
        }

        /* ✅ hasil katex setelah benar */
        .katex-answer {
            display: none;
            justify-content: center;
            align-items: center;
            min-height: 42px;
            padding: 8px 10px;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, .18);
            background: rgba(255, 255, 255, .85);
        }

        /* Sehingga: hidden dulu */
        .sehingga-box {
            margin-top: 14px;
            border: 2px solid rgba(27, 122, 42, .35);
            border-radius: 14px;
            padding: 14px 16px;
            background: rgba(255, 255, 255, .65);
            display: none;
        }

        /* ===== LATIHAN (p5 embed) ===== */
        .card-latihan {
            background: linear-gradient(180deg, #fff7e6, #fff);
            border-left: 6px solid #f59e0b;
        }

        .latihan-title {
            font-size: 20px;
            font-weight: 900;
            color: #92400e;
            margin: 0 0 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .latihan-desc {
            margin: 0 0 12px;
            color: var(--muted);
        }

        .p5-frame {
            border: 1px solid rgba(0, 0, 0, .12);
            border-radius: 14px;
            background: #fff;
            padding: 12px;
            overflow: hidden;
        }

        #p5-latihan canvas {
            display: block;
            max-width: 100%;
            height: auto;
            margin: 0 auto;
        }

        @media (max-width: 640px) {
            .top-title .judul {
                font-size: 24px;
            }

            .top-title .label {
                font-size: 22px;
            }

            .card {
                padding: 16px 16px;
            }

            .tujuan-card {
                padding: 18px 18px;
            }

            p {
                font-size: 15px;
            }

            .definisi-box {
                padding: 38px 18px 18px;
            }
        }
    </style>

    <div class="materi-wrap">

        <div class="top-title">
            <div class="label">B.</div>
            <div class="judul">Penjumlahan, Pengurangan, dan Perkalian Polinomial</div>
        </div>

        {{-- Tujuan Pembelajaran --}}
        <div class="card tujuan-card">
            <div class="tujuan-header">
                <h3 class="title">Tujuan Pembelajaran</h3>
            </div>
            <ol>
                <li>Melakukan operasi <b>penjumlahan</b>, <b>pengurangan</b>, dan <b>perkalian</b> pada <b>polinomial</b>.
                </li>
            </ol>
        </div>

        {{-- Section --}}
        <div class="section-title">1. Penjumlahan Polinomial</div>

        {{-- Eksplorasi --}}
        <div class="card card-eksplorasi">
            <div class="title-box" style="color:#1e3a8a;">🧭 Eksplorasi</div>

            <p>
                Banjarmasin dikenal sebagai <b>Kota Seribu Sungai</b>. Kehidupan masyarakatnya sangat dekat dengan lahan
                basah,
                seperti Sungai Martapura, Sungai Barito, Pasar Terapung, dan kawasan rawa serta mangrove.
            </p>

            <p>
                Pada suatu program <b>pembersihan sungai</b>, terdapat <b>dua tim kerja</b>. Misalkan
                <span class="highlight">$y$</span> menyatakan <b>jumlah hari kerja</b>.
            </p>

            <p style="margin-bottom:6px;"><b>Tim A</b> membersihkan sampah dengan model:</p>
            <div class="rumus-box">$$T(y)=6y^2-3y+8$$</div>

            <p style="margin-bottom:6px;"><b>Tim B</b> membersihkan sampah dengan model:</p>
            <div class="rumus-box">$$U(y)=4y^2+5y-2$$</div>

            <div class="question" id="eksplorasi-quiz">
                <div class="qtitle">Pertanyaan</div>

                <ol class="quiz-list">
                    <li class="quiz-item" data-type="oneof" data-answer="11">
                        <div class="quiz-q">Jika $y=1$ (hari kerja ke-1), berapa nilai $T(1)$?</div>
                        <input class="quiz-input" type="text" placeholder="Jawaban kamu..." />
                        <div class="quiz-actions">
                            <button type="button" class="quiz-check">Cek</button>
                            <button type="button" class="quiz-reset">Reset</button>
                            <span class="quiz-feedback"></span>
                        </div>
                    </li>

                    <li class="quiz-item" data-type="oneof" data-answer="7">
                        <div class="quiz-q">Jika $y=1$ (hari kerja ke-1), berapa nilai $U(1)$?</div>
                        <input class="quiz-input" type="text" placeholder="Jawaban kamu..." />
                        <div class="quiz-actions">
                            <button type="button" class="quiz-check">Cek</button>
                            <button type="button" class="quiz-reset">Reset</button>
                            <span class="quiz-feedback"></span>
                        </div>
                    </li>

                    <li class="quiz-item" data-type="oneof" data-answer="18">
                        <div class="quiz-q">Pada hari kerja ke-1, berapa total yang dibersihkan dua tim, yaitu $T(1)+U(1)$?
                        </div>
                        <input class="quiz-input" type="text" placeholder="Jawaban kamu..." />
                        <div class="quiz-actions">
                            <button type="button" class="quiz-check">Cek</button>
                            <button type="button" class="quiz-reset">Reset</button>
                            <span class="quiz-feedback"></span>
                        </div>
                    </li>
                </ol>

                <div style="margin-top:10px;">
                    <button type="button" id="quiz-check-all" class="quiz-checkall">Cek Semua</button>
                    <span id="quiz-summary" class="quiz-summary"></span>
                </div>
            </div>
        </div>

        {{-- ✅ KUNCI: SEMUA SETELAH INI BARU MUNCUL JIKA 3/3 BENAR --}}
        <div id="materi-lanjutan" style="display:none;">

            {{-- Penjelasan --}}
            <div class="penjelasan-plain">
                <p>
                    Sama seperti operasi penjumlahan pada bilangan real, penjumlahan pada polinomial dapat dilakukan dengan cara
                    menggabungkan suku-suku yang sejenis, yaitu suku yang memiliki variabel yang sama, dan pangkat variabel yang
                    sama.
                    Suku yang tidak sejenis tidak dapat dijumlahkan, sehingga tetap dituliskan apa adanya.
                </p>
            </div>

            {{-- DEFINISI --}}
            <div class="definisi-box">
                <div class="definisi-pill">DEFINISI</div>
                <div class="definisi-lead">Penjumlahan polinomial memiliki bentuk umum:</div>
                <div class="definisi-rumus">$$P(y)=T(y)+U(y)$$</div>
                <div class="definisi-sub">Dengan ketentuan:</div>
                <ul>
                    <li>$T(y)$ dan $U(y)$ adalah polinomial dalam variabel $y$.</li>
                    <li>Koefisien dari <b>suku-suku sejenis</b> dijumlahkan, sedangkan suku yang tidak sejenis tetap.</li>
                </ul>
            </div>

            {{-- Langkah-langkah --}}
            <div class="card card-green">
                <div class="title-box">📌 Langkah-Langkah Penjumlahan Polinomial</div>
                <ol>
                    <li>Tuliskan kedua polinomial dalam satu baris atau dalam bentuk bersusun.</li>
                    <li>Kelompokkan suku-suku yang sejenis.</li>
                    <li>Jumlahkan koefisien dari suku-suku sejenis.</li>
                    <li>Tulis hasil penjumlahan dalam bentuk polinomial yang telah disederhanakan.</li>
                </ol>
            </div>

            {{-- =========================
            CARD 1: Tabel Suku Sejenis
            ========================= --}}
            <div class="card card-green">
                <div class="title-box">Contoh Suku Sejenis dan Bukan Suku Sejenis</div>

                <div class="table-wrap">
                    <table class="materi-table">
                        <thead>
                            <tr>
                                <th>Suku-suku sejenis</th>
                                <th>Bukan suku-suku sejenis</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>$3x, -7x, -\frac{1}{6}x$</td>
                                <td>$11x, 4x^2, \frac{2}{3}x^4$</td>
                            </tr>
                            <tr>
                                <td>$\frac{1}{2}x^3, 4x^3, -2x^3$</td>
                                <td>$4x^3, -2x^4, -x^5$</td>
                            </tr>
                            <tr>
                                <td>$2x^2y^3, \frac{1}{7}x^2y^3, -5x^2y^3$</td>
                                <td>$\frac{3}{4}x^2y^3, 2x^2y, -7xy^3$</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <p style="margin-top:12px;">
                    Suku-suku sejenis memiliki <b>variabel</b> yang sama dan <b>pangkat</b> variabel yang sama,
                    sehingga koefisiennya dapat dijumlahkan.
                </p>
            </div>


            {{-- =========================
            CARD 2: Contoh Interaktif
            ========================= --}}
            <div class="card card-green">

                <div class="contoh-badge">CONTOH</div>

                <div class="contoh-box" id="contoh-interaktif">
                    <div class="contoh-row-title">Hitunglah hasil dari:</div>
                    <div class="rumus-box" style="margin-top:8px;">
                        $$(3x^3+5x^2-2x+7) + (4x^3-3x^2+x-5)$$
                    </div>

                    <div class="contoh-row-title" style="margin-top:12px;">Penyelesaian: Kelompokkan suku sejenis</div>

                    <div class="table-wrap">
                        <table class="materi-table contoh-table">
                            <thead>
                                <tr>
                                    <th>Suku Sejenis</th>
                                    <th>Operasi</th>
                                    <th>Hasil (Isi)</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Row 1 --}}
                                <tr class="contoh-item" data-answer="7x^3" data-canonical="7x^3" data-latex="7x^3">
                                    <td>$(3x^3 + 4x^3)$</td>
                                    <td>$(3 + 4)x^3$</td>
                                    <td>
                                        <input class="hasil-input" type="text" placeholder="" />
                                        <div class="katex-answer" aria-hidden="true"></div>

                                        <div class="mini-actions">
                                            <button type="button" class="mini-btn contoh-check">Cek</button>
                                            <button type="button" class="mini-btn contoh-reset">Reset</button>
                                            <span class="mini-feedback"></span>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Row 2 --}}
                                <tr class="contoh-item" data-answer="2x^2" data-canonical="2x^2" data-latex="2x^2">
                                    <td>$(5x^2 - 3x^2)$</td>
                                    <td>$(5 - 3)x^2$</td>
                                    <td>
                                        <input class="hasil-input" type="text" placeholder="" />
                                        <div class="katex-answer" aria-hidden="true"></div>

                                        <div class="mini-actions">
                                            <button type="button" class="mini-btn contoh-check">Cek</button>
                                            <button type="button" class="mini-btn contoh-reset">Reset</button>
                                            <span class="mini-feedback"></span>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Row 3 --}}
                                <tr class="contoh-item" data-answer="-x" data-canonical="-x" data-latex="-x">
                                    <td>$(-2x + x)$</td>
                                    <td>$(-2 + 1)x$</td>
                                    <td>
                                        <input class="hasil-input" type="text" placeholder="" />
                                        <div class="katex-answer" aria-hidden="true"></div>

                                        <div class="mini-actions">
                                            <button type="button" class="mini-btn contoh-check">Cek</button>
                                            <button type="button" class="mini-btn contoh-reset">Reset</button>
                                            <span class="mini-feedback"></span>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Row 4 --}}
                                <tr class="contoh-item" data-answer="2" data-canonical="2" data-latex="2">
                                    <td>$(7 - 5)$</td>
                                    <td>$(7 - 5)$</td>
                                    <td>
                                        <input class="hasil-input" type="text" placeholder="" />
                                        <div class="katex-answer" aria-hidden="true"></div>

                                        <div class="mini-actions">
                                            <button type="button" class="mini-btn contoh-check">Cek</button>
                                            <button type="button" class="mini-btn contoh-reset">Reset</button>
                                            <span class="mini-feedback"></span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div style="margin-top:12px;">
                        <div class="contoh-row-title">Tuliskan hasil akhirnya:</div>
                        <div class="mini-actions" style="justify-content:flex-start;">
                            <input id="contoh-final" class="hasil-input" style="max-width:420px; text-align:left;" type="text"
                                placeholder="" />
                            <button type="button" id="contoh-final-check" class="mini-btn">Cek</button>
                            <button type="button" id="contoh-final-reset" class="mini-btn">Reset</button>
                            <span id="contoh-final-fb" class="mini-feedback"></span>
                        </div>

                        <div class="mini-actions" style="justify-content:flex-start; margin-top:8px;">
                            <button type="button" id="contoh-check-all" class="mini-btn">Cek Semua</button>
                            <span id="contoh-summary" style="font-weight:900; color:#1e3a8a;"></span>
                        </div>
                    </div>

                    {{-- Sehingga: tampil jika hasil akhir benar --}}
                    <div class="sehingga-box" id="sehingga-box">
                        <div class="contoh-row-title" style="margin-top:0;">Sehingga:</div>
                        <div class="rumus-box" style="margin-top:10px;">
                            $$\begin{aligned}
                            &\ \ \ 3x^3 + 5x^2 - 2x + 7\\
                            &+\, 4x^3 - 3x^2 + x - 5\\
                            \hline
                            &\ \ \ 7x^3 + 2x^2 - x + 2
                            \end{aligned}$$
                        </div>
                    </div>
                </div>
            </div>

            {{-- ✅ KOTAK LATIHAN (p5 embed interaktif2a.js) --}}
            <div class="card card-latihan">
                <div class="p5-frame">
                    <div id="p5-latihan"></div>
                </div>
            </div>

        </div> {{-- end #materi-lanjutan --}}


        {{-- =========================
        JS QUIZ + KaTeX rerender (punyamu)
        ========================== --}}
        <script>
            (function () {
                const normalize = (s) =>
                    (s || "")
                        .toLowerCase()
                        .trim()
                        .replace(/\s+/g, "")
                        .replace(/×/g, "x")
                        .replace(/–/g, "-")
                        .replace(/−/g, "-");

                const normalizePolyX = (raw) => {
                    let s = normalize(raw);
                    if (!s) return "";
                    s = s.replace(/x3/g, "x^3").replace(/x2/g, "x^2");
                    s = s.replace(/\+\-/g, "-");
                    s = s.replace(/x\^1/g, "x");
                    // rapikan 1x -> x, -1x -> -x
                    s = s.replace(/(^|[+\-])1x/g, "$1x");
                    s = s.replace(/(^|[+\-])\-1x/g, "$1-x"); // defensive
                    return s;
                };

                const setFb = (el, ok, okText = "Benar ✅", noText = "Belum tepat ❌") => {
                    if (!el) return;
                    el.classList.remove("ok", "no");
                    el.classList.add(ok ? "ok" : "no");
                    el.textContent = ok ? okText : noText;
                };

                const clearFb = (el) => {
                    if (!el) return;
                    el.classList.remove("ok", "no");
                    el.textContent = "";
                };

                const renderInlineKatex = (container, latex) => {
                    if (!container) return;
                    if (!window.katex || !window.katex.render) {
                        container.textContent = latex;
                        return;
                    }
                    try {
                        window.katex.render(latex, container, {
                            throwOnError: false,
                            displayMode: false
                        });
                    } catch (e) {
                        container.textContent = latex;
                    }
                };

                const rerenderKatex = () => {
                    try {
                        if (window.renderMathInElement) {
                            window.renderMathInElement(document.body, {
                                delimiters: [
                                    { left: "$$", right: "$$", display: true },
                                    { left: "$", right: "$", display: false },
                                ],
                            });
                        }
                    } catch (e) { }
                };

                // ✅ FIX p5: load p5 + interaktif2a.js hanya setelah unlock (agar ukuran canvas benar)
                let latihanLoaded = false;
                const loadLatihanOnce = () => {
                    if (latihanLoaded) return;
                    latihanLoaded = true;

                    const loadScript = (src, cb) => {
                        const s = document.createElement("script");
                        s.src = src;
                        s.onload = () => cb && cb();
                        document.body.appendChild(s);
                    };

                    // load p5 dulu, lalu interaktif2a.js
                    loadScript("https://cdn.jsdelivr.net/npm/p5@1.9.4/lib/p5.min.js", () => {
                        loadScript("{{ asset('js/interaktif2a.js') }}");
                    });
                };

                // ✅ Unlock materi-lanjutan jika 3/3 eksplorasi benar semua
                const materiLanjutan = document.getElementById("materi-lanjutan");
                const updateUnlock = () => {
                    const quiz = document.getElementById("eksplorasi-quiz");
                    if (!quiz || !materiLanjutan) return;

                    const items = Array.from(quiz.querySelectorAll(".quiz-item"));
                    const correct = items.filter(it =>
                        it.querySelector(".quiz-feedback")?.classList.contains("ok")
                    ).length;

                    const unlocked = (correct === items.length);
                    materiLanjutan.style.display = unlocked ? "block" : "none";

                    if (unlocked) {
                        rerenderKatex();
                        loadLatihanOnce(); // ✅ p5 baru jalan setelah terlihat
                    }
                };

                // ---------- Eksplorasi quiz ----------
                const clearFeedback = (item) => {
                    const fb = item.querySelector(".quiz-feedback");
                    if (!fb) return;
                    fb.classList.remove("ok", "no");
                    fb.textContent = "";
                };

                const showFeedback = (item, ok, msgOk, msgNo) => {
                    const fb = item.querySelector(".quiz-feedback");
                    if (!fb) return;
                    fb.classList.remove("ok", "no");
                    fb.classList.add(ok ? "ok" : "no");
                    fb.textContent = ok ? (msgOk || "Benar ✅") : (msgNo || "Belum tepat ❌");
                };

                const getInputValue = (item) => {
                    const el = item.querySelector(".quiz-input");
                    return el ? el.value : "";
                };

                const resetItem = (item) => {
                    const el = item.querySelector(".quiz-input");
                    if (el) el.value = "";
                    clearFeedback(item);
                };

                const checkItem = (item) => {
                    const type = item.getAttribute("data-type");
                    const valRaw = getInputValue(item);

                    if (type === "oneof") {
                        const expected = normalize(item.getAttribute("data-answer") || "");
                        const val = normalize(valRaw);
                        const ok = (val === expected) || val.startsWith(expected);
                        showFeedback(item, ok, "Benar ✅", "Belum tepat ❌");
                        return ok;
                    }

                    showFeedback(item, false, "", "Tipe soal belum dikenali.");
                    return false;
                };

                const quiz = document.getElementById("eksplorasi-quiz");
                if (quiz) {
                    quiz.querySelectorAll(".quiz-item").forEach(item => {
                        const btnCheck = item.querySelector(".quiz-check");
                        const btnReset = item.querySelector(".quiz-reset");

                        if (btnCheck) btnCheck.addEventListener("click", () => {
                            checkItem(item);

                            const items = Array.from(quiz.querySelectorAll(".quiz-item"));
                            const correct = items.filter(it => it.querySelector(".quiz-feedback")?.classList.contains("ok")).length;

                            const summary = document.getElementById("quiz-summary");
                            if (summary) summary.textContent = `Skor: ${correct}/${items.length}`;

                            updateUnlock();
                            rerenderKatex();
                        });

                        if (btnReset) btnReset.addEventListener("click", () => {
                            resetItem(item);

                            const items = Array.from(quiz.querySelectorAll(".quiz-item"));
                            const correct = items.filter(it => it.querySelector(".quiz-feedback")?.classList.contains("ok")).length;

                            const summary = document.getElementById("quiz-summary");
                            if (summary) summary.textContent = `Skor: ${correct}/${items.length}`;

                            updateUnlock();
                            rerenderKatex();
                        });
                    });

                    const btnAll = document.getElementById("quiz-check-all");
                    if (btnAll) {
                        btnAll.addEventListener("click", () => {
                            const items = Array.from(quiz.querySelectorAll(".quiz-item"));
                            let correct = 0;

                            items.forEach(item => {
                                const ok = checkItem(item);
                                if (ok) correct++;
                            });

                            const summary = document.getElementById("quiz-summary");
                            if (summary) summary.textContent = `Skor: ${correct}/${items.length}`;

                            updateUnlock();
                            rerenderKatex();
                        });
                    }
                }

                // ---------- CONTOH interaktif (punyamu) ----------
                const contoh = document.getElementById("contoh-interaktif");
                if (contoh) {
                    const rows = Array.from(contoh.querySelectorAll(".contoh-item"));
                    const sehinggaBox = document.getElementById("sehingga-box");

                    const showKatexAnswer = (row) => {
                        const input = row.querySelector(".hasil-input");
                        const box = row.querySelector(".katex-answer");
                        const latex = row.getAttribute("data-latex") || row.getAttribute("data-canonical") || "";

                        if (input) {
                            input.value = row.getAttribute("data-canonical") || "";
                            input.disabled = true;
                            input.style.display = "none";
                        }
                        if (box) {
                            box.style.display = "flex";
                            renderInlineKatex(box, latex);
                        }
                    };

                    const resetToInput = (row) => {
                        const input = row.querySelector(".hasil-input");
                        const box = row.querySelector(".katex-answer");
                        const fb = row.querySelector(".mini-feedback");

                        if (input) {
                            input.disabled = false;
                            input.style.display = "block";
                            input.value = "";
                        }
                        if (box) {
                            box.style.display = "none";
                            box.innerHTML = "";
                        }
                        clearFb(fb);
                    };

                    const checkRow = (row) => {
                        const ans = normalizePolyX(row.getAttribute("data-answer") || "");
                        const input = row.querySelector(".hasil-input");
                        const fb = row.querySelector(".mini-feedback");

                        const user = normalizePolyX(input ? input.value : "");
                        const ok = !!user && user === ans;

                        setFb(fb, ok);
                        if (ok) showKatexAnswer(row);

                        return ok;
                    };

                    rows.forEach(row => {
                        const btnC = row.querySelector(".contoh-check");
                        const btnR = row.querySelector(".contoh-reset");

                        if (btnC) btnC.addEventListener("click", () => {
                            checkRow(row);
                            rerenderKatex();
                        });

                        if (btnR) btnR.addEventListener("click", () => {
                            resetToInput(row);
                            rerenderKatex();
                        });
                    });

                    // hasil akhir
                    const finalInput = document.getElementById("contoh-final");
                    const finalFb = document.getElementById("contoh-final-fb");
                    const finalCanonical = "7x^3+2x^2-x+2";
                    const finalAns = normalizePolyX(finalCanonical);

                    const lockSehingga = () => { if (sehinggaBox) sehinggaBox.style.display = "none"; };
                    const unlockSehingga = () => { if (sehinggaBox) sehinggaBox.style.display = "block"; };

                    const checkFinal = () => {
                        const user = normalizePolyX(finalInput ? finalInput.value : "");
                        const ok = !!user && user === finalAns;

                        setFb(finalFb, ok);
                        if (ok && finalInput) finalInput.value = finalCanonical;

                        if (ok) unlockSehingga();
                        else lockSehingga();

                        return ok;
                    };

                    const btnFinalCheck = document.getElementById("contoh-final-check");
                    const btnFinalReset = document.getElementById("contoh-final-reset");

                    if (btnFinalCheck) btnFinalCheck.addEventListener("click", () => {
                        checkFinal();
                        rerenderKatex();
                    });

                    if (btnFinalReset) btnFinalReset.addEventListener("click", () => {
                        if (finalInput) finalInput.value = "";
                        clearFb(finalFb);
                        lockSehingga();
                        rerenderKatex();
                    });

                    // cek semua
                    const btnAll = document.getElementById("contoh-check-all");
                    const summary = document.getElementById("contoh-summary");

                    if (btnAll) {
                        btnAll.addEventListener("click", () => {
                            let correct = 0;

                            rows.forEach(r => { if (checkRow(r)) correct++; });
                            if (checkFinal()) correct++;

                            const total = rows.length + 1;
                            if (summary) summary.textContent = `Skor: ${correct}/${total}`;

                            rerenderKatex();
                        });
                    }

                    lockSehingga();
                }

                // awalnya terkunci
                updateUnlock();
                rerenderKatex();
            })();
        </script>

    </div>
@endsection

@section('nav')
    <a href="{{ route('kuisa') }}" class="btn-nav prev-btn">
        ← Previous
    </a>

    <a href="{{ route('penguranganpolinomial') }}" class="btn-nav next-btn">
        Next →
    </a>
@endsection