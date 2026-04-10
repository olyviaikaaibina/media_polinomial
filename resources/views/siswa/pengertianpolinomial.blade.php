@extends('layout.halamanmateri')

@section('content')
    <!-- KaTeX (taruh di sini kalau belum ada di layout) -->
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
            --green-soft: #f2fbf4;
            --orange: #e0702b;
            --orange-soft: #fff6f0;
            --text: #222;
            --muted: #555;

            --koef-bg: #ffe0cc;
            --koef-tx: #8a2b00;

            --var-bg: #e0f3e6;
            --var-tx: #0f5f22;

            --konst-bg: #e7e7ff;
            --konst-tx: #333;

            --blue: #2d6cdf;
            --blue-soft: #f3f7ff;
            --red: #d64545;
            --red-soft: #fff3f3;

            /* ✅ Warna definisi seperti gambar 2 */
            --def-bg: #f5c9b9;         /* peach */
            --def-pill: #7fb06a;       /* hijau pill */
            --def-pill-border: #2e7d32;
            --def-formula-bg: #f6f7f9; /* kotak rumus */
        }

        /* ===== Layout ===== */
        .materi-wrap {
            max-width: 980px;
            margin: 0 auto;
            font-family: "Times New Roman", Times, serif;
            color: var(--text);
            line-height: 1.7;
            padding: 20px 14px 40px;
        }

        /* ===== Header ===== */
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

        /* ===== Card ===== */
        .card {
            border-radius: 16px;
            padding: 20px 22px;
            background: #fff;

            /* ✅ jarak antar card (lebih lega) */
            margin: 0 0 40px 0;

            box-shadow: 0 10px 28px rgba(0, 0, 0, .05);
            border: 1px solid rgba(0, 0, 0, .05);
        }

        .card-orange {
            background: linear-gradient(180deg, var(--orange-soft), #fff);
            border-left: 6px solid var(--orange);
        }

        .card-green {
            background: linear-gradient(180deg, var(--green-soft), #fff);
            border-left: 6px solid #2e8b57;
        }

        /* ===== Tujuan Pembelajaran ===== */
        .tujuan-card {
            background: linear-gradient(135deg, #fff6f0 0%, #ffffff 100%);
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

        /* ===== Section Title ===== */
        .section-title {
            font-size: 30px;
            font-weight: 800;
            color: var(--green);

            /* ✅ jarak section lebih lega */
            margin: 48px 0 18px;
        }

        /* ===== Title Box ===== */
        .title-box {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 800;
            font-size: 18px;
            color: var(--green);
            margin-bottom: 12px;
        }

        /* ===== Text ===== */
        .card p {
            margin: 10px 0;
            text-align: justify;
            color: var(--muted);
        }

        .card ul,
        .card ol {
            margin: 10px 0 10px 22px;
            color: var(--muted);
        }

        .card li { margin: 6px 0; }

        .highlight { font-weight: 700; color: #000; }

        /* ==================================================
           FORMULA: PANAH DEKAT, SESUAI TARGET (RAPI)
           ================================================== */
        .formula-annot {
            margin: 14px 0 18px;
            border-radius: 18px;
            background: #fff3ea;
            border: 1px solid #f1c4a6;
            padding: 22px 18px 26px;
            text-align: center;
            overflow: hidden;
        }

        .formula-expr {
            font-size: 44px;
            font-weight: 700;
            margin: 6px 0 18px;
            letter-spacing: 1px;
            line-height: 1.25;
        }

        .grp {
            display: inline-block;
            position: relative;
            padding: 0 6px 54px;
            margin: 0 8px;
        }

        .pill {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: 0;
            font-size: 14px;
            font-weight: 900;
            padding: 8px 14px;
            border-radius: 999px;
            border: 1px solid rgba(0, 0, 0, .10);
            white-space: nowrap;
        }

        .pill.koef { background: var(--koef-bg); color: var(--koef-tx); }
        .pill.var { background: var(--var-bg); color: var(--var-tx); }
        .pill.konst { background: var(--konst-bg); color: var(--konst-tx); }

        .grp::before {
            content: "";
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: 38px;
            width: 2px;
            height: 18px;
            background: rgba(0,0,0,.40);
        }

        .grp::after {
            content: "";
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: 56px;
            width: 0;
            height: 0;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-bottom: 8px solid rgba(0,0,0,.40);
        }

        /* ===== Question Box ===== */
        .question {
            background: #f4faf5;
            border: 1px solid rgba(27, 122, 42, .18);
            border-radius: 12px;
            padding: 14px 16px;
            margin-top: 16px;
        }

        .question .qtitle {
            font-weight: 800;
            color: var(--green);
            margin-bottom: 8px;
        }

        .hint {
            font-size: 14px;
            color: var(--muted);
            margin-top: 2px;
            margin-bottom: 8px;
        }

        /* ==============================
           ✅ CONTOH DALAM BENTUK KARTU
           ============================== */
        .contoh-wrap {
            margin-top: 18px;
            padding: 18px;
            border-radius: 16px;
            background: #f8fbff;
            border-left: 6px solid #5b9bd5;
            box-shadow: 0 10px 28px rgba(0, 0, 0, .04);
        }

        .contoh-badge {
            display: inline-block;
            padding: 6px 18px;
            border-radius: 999px;
            background: #ffd9c2;
            font-weight: 800;
            margin-bottom: 12px;
            border: 1px solid rgba(0, 0, 0, .08);
        }

        .contoh-sub { margin: 0 0 14px; color: var(--muted); }

        .kartu-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .kartu {
            border-radius: 16px;
            border: 1px solid rgba(0,0,0,.10);
            background: #fff;
            padding: 14px 14px;
            box-shadow: 0 10px 20px rgba(0,0,0,.04);
            cursor: pointer;
            transition: transform .12s ease, box-shadow .12s ease;
            user-select: none;
            outline: none;
        }

        .kartu:hover { transform: translateY(-2px); box-shadow: 0 14px 26px rgba(0,0,0,.06); }

        .kartu-top {
            display:flex;
            align-items:center;
            justify-content: flex-end;
            gap: 10px;
            margin-bottom: 8px;
        }

        .kartu-tag {
            font-weight: 900;
            font-size: 12px;
            padding: 6px 10px;
            border-radius: 999px;
            border: 1px solid rgba(0,0,0,.10);
            background: #fff;
            color: var(--muted);
        }

        .kartu-ekspresi {
            font-size: 22px;
            font-weight: 900;
            color: #000;
            margin-bottom: 6px;
        }

        .kartu-hint { color: var(--muted); font-size: 14px; margin: 0; }

        .kartu-penjelasan {
            margin-top: 10px;
            padding: 10px 12px;
            border-radius: 12px;
            border: 1px solid rgba(91,155,213,.20);
            background: #f8fbff;
            color: var(--muted);
            display: none;
            animation: fadeIn .15s ease;
        }

        .kartu.open .kartu-penjelasan { display: block; }

        .kartu.open .kartu-tag {
            color: #0f5f22;
            border-color: rgba(27,122,42,.18);
            background: rgba(27,122,42,.06);
        }

        .kartu.open { border-color: rgba(27,122,42,.18); }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-2px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .kartu-actions {
            display:flex;
            gap:10px;
            align-items:center;
            flex-wrap: wrap;
            margin-top: 14px;
        }

        .btnx {
            padding: 8px 14px;
            border-radius: 12px;
            border: 1px solid rgba(0,0,0,.14);
            background: #fff;
            cursor: pointer;
            font-weight: 800;
        }
        .btnx.primary { border-color: rgba(27,122,42,.25); }
        .btnx.ghost { border-color: rgba(91,155,213,.25); }

        /* ====== WADAH P5 ====== */
        .p5-host {
            position: relative;
            width: 100%;
            max-width: 100%;
            height: 760px;
            margin: 12px auto 0;
            overflow: hidden;
            border-radius: 18px;
            box-sizing: border-box;
        }

        /* ==============================
           QUIZ
           ============================== */
        .quiz-list { margin: 10px 0 0 18px; }
        .quiz-item { margin: 12px 0 16px; }
        .quiz-q { margin-bottom: 6px; color: var(--text); }

        .quiz-input{
            width: 100%;
            max-width: 520px;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid rgba(0,0,0,.18);
            outline: none;
            font-family: "Times New Roman", Times, serif;
            font-size: 16px;
            box-sizing: border-box;
            background: #fff;
        }

        .quiz-input:focus{
            border-color: rgba(27,122,42,.5);
            box-shadow: 0 0 0 3px rgba(27,122,42,.10);
        }

        .quiz-actions{
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 8px;
            flex-wrap: wrap;
        }

        .quiz-check, .quiz-reset, .quiz-checkall{
            padding: 8px 14px;
            border-radius: 10px;
            border: 1px solid rgba(0,0,0,.14);
            background: #fff;
            cursor: pointer;
            font-weight: 700;
        }

        .quiz-check{ border-color: rgba(27,122,42,.25); }
        .quiz-reset{ border-color: rgba(224,112,43,.25); }

        .quiz-feedback{
            font-weight: 800;
            padding: 6px 10px;
            border-radius: 10px;
            display: inline-block;
        }

        .quiz-feedback.ok{
            color: #0f5f22;
            background: rgba(27,122,42,.10);
            border: 1px solid rgba(27,122,42,.18);
        }

        .quiz-feedback.no{
            color: #8a2b00;
            background: rgba(224,112,43,.10);
            border: 1px solid rgba(224,112,43,.18);
        }

        .quiz-summary{
            margin-left: 10px;
            font-weight: 800;
            color: var(--green);
        }

        /* ========= KUNCI MATERI (AMAN UNTUK p5) ========= */
        #materi-lanjutan{
            height: 0;
            overflow: hidden;
            opacity: 0;
            pointer-events: none;
            margin: 0;
        }
        #materi-lanjutan.show{
            height: auto;
            overflow: visible;
            opacity: 1;
            pointer-events: auto;
            margin: initial;
        }

        /* ==============================
           ✅ CONTOH POLINOMIAL: BOX GRID (baru)
           ============================== */
        .contoh-grid2{
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-top: 10px;
        }

        .contoh-card2{
            border-radius: 16px;
            border: 1px solid rgba(0,0,0,.10);
            background: #fff;
            padding: 14px 14px;
            box-shadow: 0 10px 20px rgba(0,0,0,.04);
        }

        .contoh-head2{
            display:flex;
            align-items:center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 10px;
        }

        .badge2{
            display:inline-flex;
            align-items:center;
            gap: 8px;
            font-weight: 900;
            font-size: 12px;
            padding: 6px 10px;
            border-radius: 999px;
            border: 1px solid rgba(0,0,0,.10);
            white-space: nowrap;
        }

        .badge2.ok{
            color: var(--green);
            background: rgba(27,122,42,.08);
            border-color: rgba(27,122,42,.18);
        }

        .badge2.no{
            color: var(--red);
            background: rgba(214,69,69,.08);
            border-color: rgba(214,69,69,.18);
        }

        .badge2.info{
            color: var(--blue);
            background: rgba(45,108,223,.08);
            border-color: rgba(45,108,223,.18);
        }

        .contoh-ekspresi2{
            font-size: 22px;
            font-weight: 900;
            color: #000;
            margin: 6px 0 8px;
        }

        .contoh-desc2{ margin: 0; color: var(--muted); text-align: justify; }

        .contoh-note2{
            margin-top: 10px;
            padding: 10px 12px;
            border-radius: 12px;
            background: var(--blue-soft);
            border: 1px solid rgba(45,108,223,.18);
            color: var(--muted);
        }

        /* ==================================================
           ✅ DEFINISI (Persis seperti gambar ke-2)
           ================================================== */
        .definisi-block{
            position: relative;
            border-radius: 26px;
            background: var(--def-bg);
            padding: 36px 26px 30px;
            margin: 34px 0 40px 0; /* ✅ jarak bawah lebih lega */
            box-shadow: 0 10px 28px rgba(0,0,0,.05);
            border: 1px solid rgba(0,0,0,.06);
        }

        .definisi-pill{
            position: absolute;
            top: -18px;
            left: 26px;
            background: var(--def-pill);
            color: #000;
            font-weight: 900;
            letter-spacing: .5px;
            padding: 10px 28px;
            border-radius: 999px;
            border: 2px solid var(--def-pill-border);
            box-shadow: 0 10px 18px rgba(0,0,0,.08);
            text-transform: uppercase;
        }

        /* ✅ teks definisi rapi, tidak bold */
        .definisi-text{
            margin: 0;
            font-size: 17px;
            font-weight: 400;
            line-height: 1.7;
            color: #2b2b2b;
            text-align: justify;
        }

        .definisi-formula{
            margin: 18px auto 0;
            max-width: 680px;
            border-radius: 18px;
            background: var(--def-formula-bg);
            border: 1px solid rgba(0,0,0,.10);
            padding: 18px 18px;
            text-align: center;
            box-shadow: 0 12px 24px rgba(0,0,0,.08);
        }

        .definisi-formula .katex-display{
            margin: 0; /* biar rapat seperti gambar */
        }

        /* Responsive */
        @media (max-width: 780px) {
            .kartu-grid { grid-template-columns: 1fr; }
            .contoh-grid2 { grid-template-columns: 1fr; }
            .definisi-text { font-size: 16px; }
        }

        @media (max-width: 640px) {
            .top-title .judul { font-size: 24px; }
            .top-title .label { font-size: 22px; }
            .card { padding: 16px 16px; margin-bottom: 32px; }
            .p5-host { height: 720px; }
            .tujuan-card { padding: 18px 18px; }

            .formula-expr { font-size: 30px; }
            .pill { font-size: 12px; padding: 7px 12px; }
            .grp { padding-bottom: 56px; }

            .definisi-block{ padding: 34px 18px 26px; }
            .definisi-pill{ left: 18px; padding: 9px 22px; }
        }
    </style>

    <div class="materi-wrap">

        <div class="top-title">
            <div class="label">A.</div>
            <div class="judul">Polinomial dan Fungsi Polinomial</div>
        </div>

        {{-- Tujuan Pembelajaran --}}
        <div class="card tujuan-card">
            <div class="tujuan-header">
                <h3 class="title">Tujuan Pembelajaran</h3>
            </div>
            <ol>
                <li>
                    Menjelaskan pengertian polinomial dan fungsi polinomial, serta mengidentifikasi
                    karakteristiknya.
                </li>
            </ol>
        </div>

        {{-- Section --}}
        <div class="section-title">1. Pengertian Polinomial</div>

        {{-- Eksplorasi --}}
        <div class="card card-orange">
            <div class="title-box">🧭 Eksplorasi</div>

            <p>
                Kalimantan Selatan dikenal sebagai daerah lahan basah yang banyak dimanfaatkan untuk
                pertanian rawa, perikanan, dan perkebunan. Pemanfaatan lahan basah tersebut dapat
                dinyatakan dalam bentuk matematika. Seorang petani di lahan basah Kalimantan Selatan
                mengelola lahannya untuk beberapa keperluan. Ia menggunakan:
            </p>

            <ul>
                <li><span class="highlight">$x$</span> hektar untuk lahan padi rawa,</li>
                <li><span class="highlight">$y$</span> hektar untuk kebun sayur,</li>
                <li>dan sebuah kolam ikan seluas <span class="highlight">$5$</span> hektar.</li>
            </ul>

            <p>Untuk mencatat penggunaan lahannya, petani tersebut menuliskan:</p>

            <ul>
                <li>luas lahan padi rawa: <span class="highlight">$2x$</span>,</li>
                <li>luas kebun sayur: <span class="highlight">$3y$</span>,</li>
                <li>luas kolam ikan: <span class="highlight">$5$</span>.</li>
            </ul>

            <p>
                Perhatikan bentuk-bentuk aljabar tersebut. Setiap bentuk hanya terdiri dari satu suku dan
                tidak mengandung operasi penjumlahan atau pengurangan. Bentuk aljabar seperti ini disebut
                monomial. Monomial yang tidak memiliki variabel seperti $5$,
                disebut konstanta, sedangkan bilangan yang mengalikan variabel
                disebut koefisien.
            </p>

            <p>
                Untuk mengetahui total pemanfaatan lahannya, petani tersebut menjumlahkan semua bentuk aljabar
                tersebut menjadi:
            </p>

            <div class="formula-annot">
                <div class="formula-expr">
                    <span class="grp">
                        <span class="gval">2</span>
                        <span class="pill koef">Koefisien</span>
                    </span>
                    x
                    &nbsp; + &nbsp;
                    3
                    <span class="grp">
                        <span class="gval">y</span>
                        <span class="pill var">Variabel</span>
                    </span>
                    &nbsp; + &nbsp;
                    <span class="grp">
                        <span class="gval">5</span>
                        <span class="pill konst">Konstanta</span>
                    </span>
                </div>
            </div>

            <p>
                Bentuk aljabar ini tersusun dari beberapa monomial yang dijumlahkan. Bentuk seperti inilah yang
                disebut polinomial. Dari konteks pemanfaatan lahan basah,
                dapat disimpulkan bahwa polinomial merupakan bentuk aljabar yang tersusun dari satu atau lebih monomial
                dengan pangkat variabel berupa bilangan cacah.
            </p>

            {{-- Pertanyaan Eksplorasi --}}
            <div class="question" id="eksplorasi-quiz">
                <div class="qtitle">Pertanyaan Eksplorasi</div>

                <ol class="quiz-list">
                    <li class="quiz-item" data-type="set" data-answer="2x,3y,5">
                        <div class="quiz-q">
                            Tuliskan semua monomial yang muncul pada cerita di atas!
                        </div>
                        <div class="hint">Format jawaban: pisahkan dengan tanda koma (,)</div>

                        <input class="quiz-input" type="text" placeholder="Jawaban kamu..." />
                        <div class="quiz-actions">
                            <button type="button" class="quiz-check">Cek</button>
                            <button type="button" class="quiz-reset">Reset</button>
                            <span class="quiz-feedback"></span>
                        </div>
                    </li>

                    <li class="quiz-item" data-type="oneof" data-answer="5">
                        <div class="quiz-q">
                            Dari monomial tersebut, manakah yang merupakan konstanta?
                        </div>

                        <input class="quiz-input" type="text" placeholder="Jawaban kamu..." />
                        <div class="quiz-actions">
                            <button type="button" class="quiz-check">Cek</button>
                            <button type="button" class="quiz-reset">Reset</button>
                            <span class="quiz-feedback"></span>
                        </div>
                    </li>

                    <li class="quiz-item" data-type="yn" data-answer="ya">
                        <div class="quiz-q">
                            Apakah bentuk <span class="highlight">$2x + 3y + 5$</span> merupakan polinomial?
                        </div>
                        <div class="hint">Jawab dengan: ya atau tidak</div>

                        <input class="quiz-input" type="text" placeholder="ya / tidak" />
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

        {{-- Materi lanjutan (terkunci) --}}
        <div id="materi-lanjutan">
            <p>
                Sebelum memahami pengertian polinomial secara menyeluruh, ada baiknya kita mempelajari terlebih dahulu
                penyusun utamanya yaitu monomial.
            </p>

            <p>
                Monomial merupakan bentuk aljabar yang terdiri dari satu suku berupa bilangan, variabel yang berpangkat
                bilangan cacah, atau hasil kali antara bilangan dan satu atau lebih variabel berpangkat bilangan cacah.
            </p>

            {{-- CONTOH KARTU --}}
            <div class="contoh-wrap" id="contoh-kartu">
                <div class="contoh-badge">CONTOH</div>
                <p class="contoh-sub">Klik setiap kartu untuk melihat penjelasan (tap di HP juga bisa).</p>

                <div class="kartu-grid">
                    <div class="kartu" tabindex="0">
                        <div class="kartu-top"><div class="kartu-tag">Klik untuk penjelasan</div></div>
                        <div class="kartu-ekspresi">$6x^2$</div>
                        <p class="kartu-hint">Apakah ini monomial?</p>
                        <div class="kartu-penjelasan">
                            Monomial ✅ karena terdiri dari satu suku dan variabel berpangkat bilangan cacah.
                        </div>
                    </div>

                    <div class="kartu" tabindex="0">
                        <div class="kartu-top"><div class="kartu-tag">Klik untuk penjelasan</div></div>
                        <div class="kartu-ekspresi">$-6$</div>
                        <p class="kartu-hint">Termasuk monomial?</p>
                        <div class="kartu-penjelasan">
                            Monomial ✅ karena konstanta juga termasuk satu suku (tanpa variabel).
                        </div>
                    </div>

                    <div class="kartu" tabindex="0">
                        <div class="kartu-top"><div class="kartu-tag">Klik untuk penjelasan</div></div>
                        <div class="kartu-ekspresi">$\frac{1}{6}x^2$</div>
                        <p class="kartu-hint">Koefisien pecahan boleh?</p>
                        <div class="kartu-penjelasan">
                            Monomial ✅ karena koefisien boleh pecahan, yang penting tetap satu suku.
                        </div>
                    </div>

                    <div class="kartu" tabindex="0">
                        <div class="kartu-top"><div class="kartu-tag">Klik untuk penjelasan</div></div>
                        <div class="kartu-ekspresi">$5x + 2x^2$</div>
                        <p class="kartu-hint">Ini monomial atau bukan?</p>
                        <div class="kartu-penjelasan">
                            Bukan monomial ❌ karena ada tanda “+” yang memisahkan menjadi dua suku.
                        </div>
                    </div>
                </div>

                <div class="kartu-actions">
                    <button type="button" class="btnx primary" id="btn-buka-semua">Buka Semua Penjelasan</button>
                    <button type="button" class="btnx ghost" id="btn-tutup-semua">Tutup Semua</button>
                </div>

                <p style="margin:10px 0 0; text-align:justify; color: var(--muted);">
                    Jika monomial tidak memiliki variabel, maka disebut konstanta, seperti $-8$ atau $25$. Sedangkan bilangan
                    yang menjadi faktor pengali variabel disebut koefisien. Monomial merupakan bagian dari polinomial. Sama
                    seperti penjumlahan dua bilangan real menghasilkan bilangan real, penjumlahan dua atau lebih monomial akan
                    membentuk polinomial.
                </p>
            </div>

            {{-- ✅ DEFINISI (GAMBAR 2) --}}
            <div class="definisi-block">
                <div class="definisi-pill">DEFINISI</div>

                <p class="definisi-text">
                    Polinomial adalah bentuk aljabar yang terdiri atas satu monomial atau penjumlahan dari dua atau lebih monomial.
                    Setiap monomial penyusun polinomial disebut <i>suku</i>.
                    Selain itu, polinomial memuat satu variabel yang berpangkat bilangan bulat positif.
                </p>
            </div>

            {{-- CONTOH --}}
            <div class="card card-green">
                <div class="title-box">🧪 Contoh</div>

                <div class="contoh-note2">
                    Tips cepat: Polinomial punya pangkat variabel 0, 1, 2, 3, ... (tidak negatif) dan tidak ada variabel di penyebut / akar.
                </div>

                <div class="contoh-grid2">
                    <div class="contoh-card2">
                        <div class="contoh-head2">
                            <span class="badge2 ok">✅ Polinomial</span>
                            <span class="badge2 info">Pangkat valid</span>
                        </div>
                        <div class="contoh-ekspresi2">$3x^2 + 2x + 1$</div>
                        <p class="contoh-desc2">
                            Semua suku memiliki pangkat bilangan bulat tidak negatif, jadi ini termasuk polinomial.
                        </p>
                    </div>

                    <div class="contoh-card2">
                        <div class="contoh-head2">
                            <span class="badge2 ok">✅ Polinomial</span>
                            <span class="badge2 info">Monomial dijumlah</span>
                        </div>
                        <div class="contoh-ekspresi2">$5a^3b - 4a + 7$</div>
                        <p class="contoh-desc2">
                            Terdiri dari beberapa monomial (pangkat a dan b bilangan cacah), jadi termasuk polinomial.
                        </p>
                    </div>

                    <div class="contoh-card2">
                        <div class="contoh-head2">
                            <span class="badge2 no">❌ Bukan Polinomial</span>
                            <span class="badge2 info">Variabel di penyebut</span>
                        </div>
                        <div class="contoh-ekspresi2">$\frac{1}{x} + 2$</div>
                        <p class="contoh-desc2">
                            Ada variabel di penyebut ($x$), sehingga bukan polinomial.
                        </p>
                    </div>

                    <div class="contoh-card2">
                        <div class="contoh-head2">
                            <span class="badge2 no">❌ Bukan Polinomial</span>
                            <span class="badge2 info">Pangkat pecahan</span>
                        </div>
                        <div class="contoh-ekspresi2">$\sqrt{x} + 5$</div>
                        <p class="contoh-desc2">
                            $\sqrt{x}$ setara dengan $x^{\frac{1}{2}}$ (pangkat pecahan), sehingga bukan polinomial.
                        </p>
                    </div>
                </div>
            </div>

            {{-- EMBED p5.js --}}
            <div class="card card-green">
                <div class="title-box">📝 Latihan</div>

                <div id="p5-interaktif-1a" class="p5-host">
                    <noscript>Aktifkan JavaScript untuk melihat latihan interaktif.</noscript>
                </div>
            </div>
        </div>

        <!-- Pastikan p5.js sudah ada sebelum interaktif1a.js -->
        <script src="https://cdn.jsdelivr.net/npm/p5@1.9.2/lib/p5.min.js"></script>
        <script src="{{ asset('js/interaktif1a.js') }}"></script>

        {{-- ==========================
            JS QUIZ (cek benar/salah) + UNLOCK
           ========================== --}}
        <script>
            (function() {
                const normalize = (s) =>
                    (s || "")
                    .toLowerCase()
                    .trim()
                    .replace(/\s+/g, "")
                    .replace(/×/g, "x");

                const splitTokens = (s) => {
                    return (s || "")
                        .toLowerCase()
                        .replace(/;/g, ",")
                        .split(",")
                        .flatMap(part => part.trim().split(/\s+/))
                        .map(t => normalize(t))
                        .filter(Boolean);
                };

                const setEqual = (a, b) => {
                    const A = new Set(a), B = new Set(b);
                    if (A.size !== B.size) return false;
                    for (const x of A) if (!B.has(x)) return false;
                    return true;
                };

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

                const toYN = (raw) => {
                    const v = (raw || "").toLowerCase().trim();
                    if (["ya", "y", "benar", "iya"].includes(v)) return "ya";
                    if (["tidak", "t", "tdk", "salah", "gak", "nggak"].includes(v)) return "tidak";
                    return "";
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

                    if (type === "set") {
                        const expected = item.getAttribute("data-answer") || "";
                        const expTokens = splitTokens(expected);
                        const userTokens = splitTokens(valRaw);
                        const ok = setEqual(userTokens, expTokens);
                        showFeedback(item, ok, "Benar ✅", "Belum tepat ❌");
                        return ok;
                    }

                    if (type === "oneof") {
                        const expected = normalize(item.getAttribute("data-answer") || "");
                        const val = normalize(valRaw);
                        const ok = (val === expected) || val.startsWith(expected);
                        showFeedback(item, ok, "Benar ✅", "Belum tepat ❌");
                        return ok;
                    }

                    if (type === "yn") {
                        const expected = normalize(item.getAttribute("data-answer") || "ya");
                        const yn = toYN(valRaw);

                        if (!yn) {
                            showFeedback(item, false, "", "Gunakan ya / tidak ❌");
                            return false;
                        }

                        const ok = (yn === expected);
                        showFeedback(item, ok, "Benar ✅", "Belum tepat ❌");
                        return ok;
                    }

                    showFeedback(item, false, "", "Tipe soal belum dikenali.");
                    return false;
                };

                const unlockMateri = () => {
                    const lanjut = document.getElementById("materi-lanjutan");
                    if (lanjut) lanjut.classList.add("show");

                    requestAnimationFrame(() => {
                        window.dispatchEvent(new Event("resize"));
                    });
                };

                const quiz = document.getElementById("eksplorasi-quiz");
                if (!quiz) return;

                const lanjutInit = document.getElementById("materi-lanjutan");
                if (lanjutInit) lanjutInit.classList.remove("show");

                quiz.querySelectorAll(".quiz-item").forEach(item => {
                    const btnCheck = item.querySelector(".quiz-check");
                    const btnReset = item.querySelector(".quiz-reset");

                    if (btnCheck) btnCheck.addEventListener("click", () => {
                        checkItem(item);

                        const items = Array.from(quiz.querySelectorAll(".quiz-item"));
                        const allOk = items.every(it => it.querySelector(".quiz-feedback")?.classList.contains("ok"));
                        if (allOk) {
                            const summary = document.getElementById("quiz-summary");
                            if (summary) summary.textContent = `Skor: ${items.length}/${items.length}`;
                            unlockMateri();
                        }
                    });

                    if (btnReset) btnReset.addEventListener("click", () => resetItem(item));
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

                        if (correct === items.length) unlockMateri();
                    });
                }
            })();
        </script>

        {{-- ==========================
           ✅ JS KARTU-KARTU CONTOH (klik untuk buka/tutup)
           ========================== --}}
        <script>
            (function(){
                const wrap = document.getElementById('contoh-kartu');
                if(!wrap) return;

                const cards = Array.from(wrap.querySelectorAll('.kartu'));
                const btnOpenAll = document.getElementById('btn-buka-semua');
                const btnCloseAll = document.getElementById('btn-tutup-semua');

                const toggleCard = (card) => card.classList.toggle('open');

                cards.forEach(card => {
                    card.addEventListener('click', () => toggleCard(card));
                    card.addEventListener('keydown', (e) => {
                        if(e.key === 'Enter' || e.key === ' ') {
                            e.preventDefault();
                            toggleCard(card);
                        }
                    });
                });

                btnOpenAll?.addEventListener('click', () => cards.forEach(c => c.classList.add('open')));
                btnCloseAll?.addEventListener('click', () => cards.forEach(c => c.classList.remove('open')));
            })();
        </script>

    </div>
@endsection

@section('nav')
    <a href="{{ route('pendahuluan') }}" class="btn-nav prev-btn">
        ← Previous
    </a>

    <a href="{{ route('derajatsuatupolinomial') }}" class="btn-nav next-btn">
        Next →
    </a>
@endsection