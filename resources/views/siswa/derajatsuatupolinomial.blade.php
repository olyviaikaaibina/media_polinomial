@extends('layout.halamanmateri')

@section('content')
    <!-- KaTeX -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/contrib/auto-render.min.js" onload="renderMathInElement(document.body, {
                                delimiters: [
                                    {left: '$$', right: '$$', display: true},
                                    {left: '$', right: '$', display: false}
                                ]
                            });"></script>
    <style>
        :root {
            --green: #1b7a2a;
            --green-soft: #f2fbf4;

            --accent: #2b6cb0;
            --accent-soft: #f3f7ff;

            --text: #222;
            --muted: #555;

            --shadow: 0 10px 28px rgba(0, 0, 0, .05);
            --outer-line: #EEDFCC;
        }

        .materi-wrap {
            max-width: 980px;
            margin: 0 auto;
            font-family: "Times New Roman", Times, serif;
            color: var(--text);
            line-height: 1.8;
            padding: 20px 14px 40px;
        }

        .top-title {
            display: flex;
            align-items: baseline;
            gap: 12px;
            margin-bottom: 14px;
        }

        .top-title .label {
            font-size: 26px;
            font-weight: 800;
            color: #000;
        }

        .top-title .judul {
            font-size: 30px;
            font-weight: 900;
            color: var(--green);
        }

        .lead-text {
            font-size: 18px;
            text-align: justify;
            margin-bottom: 22px;
            color: var(--muted);
        }

        .lead-text strong {
            color: #000;
        }

        .card {
            border-radius: 16px;
            padding: 20px 22px;
            background: #fff;
            margin-bottom: 18px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(0, 0, 0, .06);
        }

        .card-explore {
            background: linear-gradient(180deg, var(--accent-soft), #fff);
            border-left: 6px solid var(--outer-line);
        }

        .card-example {
            background: #fff;
            border-left: 6px solid var(--outer-line);
        }

        .card-try {
            background: linear-gradient(180deg, var(--green-soft), #fff);
            border-left: 6px solid var(--outer-line);
        }

        .title-box {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 900;
            font-size: 18px;
            color: var(--green);
            margin-bottom: 12px;
        }

        .card p {
            margin: 10px 0;
            text-align: justify;
            color: var(--muted);
        }

        .card ul {
            margin: 10px 0 10px 22px;
            color: var(--muted);
        }

        .card li {
            margin: 6px 0;
        }

        .highlight {
            font-weight: 800;
            color: #000;
        }

        .rumus {
            margin: 14px auto;
            text-align: center;
            font-size: 18px;
            font-weight: 800;
            padding: 14px 16px;
            border-radius: 14px;
            background: #f7f9fc;
            border: 1px solid rgba(0, 0, 0, .08);
            width: fit-content;
            max-width: 100%;
        }

        /* ===== QUIZ ===== */
        .quiz3 {
            margin-top: 14px;
            padding-top: 10px;
            border-top: 1px dashed rgba(0, 0, 0, .12);
        }

        .qitem {
            background: rgba(255, 255, 255, .75);
            border: 1px solid rgba(0, 0, 0, .06);
            border-radius: 14px;
            padding: 14px;
            margin: 12px 0;
        }

        .qtitle {
            font-weight: 900;
            color: #1f1f1f;
            margin-bottom: 6px;
        }

        .qhint {
            font-size: 14px;
            color: var(--muted);
            margin-bottom: 10px;
        }

        .rumus-eks {
            text-align: center;
            font-size: 22px;
            font-weight: 900;
            margin: 10px 0 8px;
            user-select: none;
        }

        .term {
            cursor: pointer;
            padding: 6px 10px;
            border-radius: 10px;
            transition: .15s ease;
            display: inline-block;
            border: 1px solid transparent;
        }

        .term:hover {
            background: rgba(43, 108, 176, .10);
            border-color: rgba(43, 108, 176, .14);
        }

        .term.correct {
            background: rgba(27, 122, 42, .10);
            border: 1px solid rgba(27, 122, 42, .18);
            color: #0f5f22;
        }

        .term.wrong {
            background: rgba(220, 53, 69, .08);
            border: 1px solid rgba(220, 53, 69, .16);
            color: #7a2b2b;
        }

        .feedback {
            margin-top: 10px;
            font-weight: 900;
        }

        .feedback.ok {
            color: #0f5f22;
        }

        .feedback.no {
            color: #7a2b2b;
        }

        .summary {
            margin-top: 10px;
            font-weight: 900;
            color: var(--green);
        }

        /* ===== BAGIAN LANJUTAN (LOCK) ===== */
        .locked {
            display: none;
            opacity: 0;
            transform: translateY(10px);
            transition: opacity .25s ease, transform .25s ease;
        }

        .locked.show {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        /* ===== CONTOH ===== */
        .contoh-sub {
            color: var(--muted);
            font-size: 14px;
            margin: 0 0 12px;
        }

        .contoh-panel {
            border: 2px solid var(--outer-line);
            border-radius: 16px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 8px 22px rgba(0, 0, 0, .04);
        }

        .contoh-toolbar {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            padding: 14px;
            background: linear-gradient(180deg, #fafcff, #fff);
            border-bottom: 1px solid rgba(0, 0, 0, .06);
            align-items: center;
            justify-content: space-between;
        }

        .pill-row {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .pill-num {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 999px;
            cursor: pointer;
            font-weight: 900;
            border: 1px solid rgba(0, 0, 0, .12);
            background: #fff;
            transition: .15s ease;
            user-select: none;
        }

        .pill-num:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, .08);
        }

        .pill-num.active {
            background: rgba(43, 108, 176, .10);
            border-color: rgba(43, 108, 176, .30);
            color: #1e3a8a;
        }

        .contoh-reset {
            padding: 8px 12px;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, .14);
            background: #fff;
            cursor: pointer;
            font-weight: 900;
        }

        .contoh-body {
            padding: 14px;
        }

        .contoh-row {
            display: grid;
            grid-template-columns: 160px 1fr;
            gap: 12px;
            align-items: start;
            padding: 12px;
            border: 2px solid var(--outer-line);
            border-radius: 14px;
            margin-bottom: 10px;
            background: #fff;
        }

        .mono-box {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 58px;
            border-radius: 12px;
            border: 1px dashed rgba(0, 0, 0, .18);
            background: #fbfdff;
            font-weight: 900;
            font-size: 18px;
        }

        .explain {
            display: none;
            border-left: 4px solid var(--outer-line);
            padding-left: 10px;
            color: var(--muted);
            text-align: justify;
        }

        .explain.show {
            display: block;
        }

        /* ===== DEFINISI ===== */
        .definisi-card {
            position: relative;
            margin: 0 0 18px;
            padding: 22px 20px 18px;
            border-radius: 14px;
            background: #F4C7B5;
            border: 2px solid var(--outer-line);
            box-shadow: 0 6px 18px rgba(0, 0, 0, .05);
        }

        .definisi-label {
            position: absolute;
            top: -18px;
            left: 18px;
            background: #8FC17E;
            color: #000;
            font-weight: 900;
            padding: 8px 26px;
            border-radius: 999px;
            border: 2px solid #4FA24B;
            font-size: 15px;
            letter-spacing: .5px;
        }

        .definisi-card p {
            margin: 6px 0 0;
            text-align: justify;
            font-size: 16px;
            line-height: 1.7;
            color: var(--muted);
        }

        /* ===== p5 HOST ===== */
        .p5-host {
            position: relative;
            width: 100%;
            height: 760px;
            margin-top: 12px;
            border-radius: 18px;
            overflow: hidden;
            box-sizing: border-box;
            border: 2px solid var(--outer-line);
            background: #fff;
        }

        .p5-host canvas {
            display: block !important;
            width: 100% !important;
            height: 100% !important;
        }

        #p5-interaktif-1b .p5-ui {
            position: absolute;
            top: 12px;
            left: 12px;
            right: 12px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
            z-index: 5;
            padding: 10px 12px;
            border-radius: 14px;
            background: rgba(255, 255, 255, .92);
            border: 1px solid rgba(0, 0, 0, .10);
            box-shadow: 0 8px 18px rgba(0, 0, 0, .06);
        }

        #p5-interaktif-1b .p5-ui select,
        #p5-interaktif-1b .p5-ui input,
        #p5-interaktif-1b .p5-ui button {
            font-family: "Times New Roman", Times, serif;
            font-size: 16px;
            padding: 8px 10px;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, .18);
            outline: none;
            margin: 0;
            position: static;
        }

        #p5-interaktif-1b canvas {
            position: absolute;
            inset: 0;
            z-index: 1;
        }

        /* ===== PARAGRAF DI BAWAH MARI MENCOBA ===== */
        .after-try {
            margin-top: 16px;
            padding: 18px 20px;
            border-radius: 16px;
            background: #fff;
            border-left: 6px solid var(--outer-line);
            box-shadow: var(--shadow);
            border: 1px solid rgba(0, 0, 0, .06);
        }

        .after-try p {
            margin: 0;
            color: var(--muted);
            text-align: justify;
        }

        /* ====== KOTAK TOGGLE PENYELESAIAN ====== */
        .sol-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 12px;
        }

        .sol-box {
            border: 2px solid var(--outer-line);
            border-radius: 14px;
            padding: 12px 14px;
            background: #fff;
            box-shadow: 0 8px 18px rgba(0, 0, 0, .04);
            cursor: pointer;
            user-select: none;
            font-weight: 900;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 52px;
            transition: .15s ease;
        }

        .sol-box:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(0, 0, 0, .07);
        }

        .sol-box.active {
            background: rgba(43, 108, 176, .10);
            border-color: rgba(43, 108, 176, .30);
            color: #1e3a8a;
        }

        .sol-content {
            display: none;
            margin-top: 12px;
            padding: 14px;
            border-radius: 14px;
            border: 2px solid var(--outer-line);
            background: #fff;
        }

        .sol-content.show {
            display: block;
        }

        .sol-title {
            font-weight: 900;
            color: var(--green);
            margin: 0 0 10px;
        }

        /* ====== INTERAKTIF CONTOH SOAL ====== */
        .sol-quiz {
            margin-top: 12px;
            display: grid;
            gap: 12px;
        }

        .sol-quiz-item {
            border: 2px solid var(--outer-line);
            border-radius: 14px;
            padding: 12px 14px;
            background: #fff;
            box-shadow: 0 8px 18px rgba(0, 0, 0, .04);
        }

        .sol-quiz-head {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
            justify-content: space-between;
        }

        .sol-quiz-title {
            font-weight: 900;
            color: #1f1f1f;
        }

        .sol-quiz-form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
            justify-content: flex-end;
        }

        .sol-input {
            width: 120px;
            padding: 10px 12px;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, .18);
            outline: none;
            font-family: "Times New Roman", Times, serif;
            font-size: 16px;
        }

        .sol-btn {
            padding: 10px 14px;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            font-weight: 900;
            font-family: "Times New Roman", Times, serif;
            box-shadow: 0 4px 10px rgba(0, 0, 0, .10);
        }

        .sol-btn.check {
            background: rgba(43, 108, 176, .12);
            color: #1e3a8a;
            border: 1px solid rgba(43, 108, 176, .25);
        }

        .sol-btn.show {
            background: rgba(27, 122, 42, .12);
            color: #0f5f22;
            border: 1px solid rgba(27, 122, 42, .22);
        }

        .sol-btn.show:disabled {
            opacity: .55;
            cursor: not-allowed;
        }

        .sol-feedback {
            margin-top: 10px;
            font-weight: 900;
        }

        .sol-feedback.ok {
            color: #0f5f22;
        }

        .sol-feedback.no {
            color: #7a2b2b;
        }

        .sol-quiz-math {
            margin-top: 10px;
            text-align: center;
            font-size: 20px;
            font-weight: 900;
            user-select: none;
        }

        /* ===== LATIHAN: TANPA CARD TAMBAHAN DI DALAM CARD ===== */
        .latihan-card-fit {
            padding-bottom: 18px;
        }

        #latihanBoard {
            width: 100%;
            max-width: 100%;
            margin: 0;
        }

        .lat-section {
            width: 100%;
            box-sizing: border-box;
            padding: 14px 16px;
            border-radius: 14px;
            margin-bottom: 12px;
            border: 1px solid rgba(0, 0, 0, .08);
        }

        .yellow {
            background: #f4e7ad;
        }

        .blue {
            background: #dce9fb;
        }

        .pink {
            background: #f3d2db;
        }

        .green {
            background: #dceccd;
        }

        .lat-title {
            font-weight: 900;
            margin-bottom: 10px;
            color: #1e3a8a;
            font-size: 16px;
        }

        .lat-line {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            margin: 10px 0;
        }

        .lat-line>span {
            flex: 1;
            min-width: 0;
        }

        .lat-input,
        .lat-select,
        #winnerTerm {
            width: 120px;
            min-width: 120px;
            padding: 8px 10px;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, .18);
            background: #fff;
            font-family: "Times New Roman", Times, serif;
            font-size: 15px;
            box-sizing: border-box;
        }

        .lat-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 12px;
        }

        .lat-btn {
            padding: 9px 14px;
            background: #4f81c7;
            color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 900;
            font-family: "Times New Roman", Times, serif;
            box-shadow: 0 4px 10px rgba(0, 0, 0, .10);
        }

        .lat-btn:hover {
            transform: translateY(-1px);
        }

        .lat-feedback {
            font-weight: 900;
            font-size: 14px;
            margin-top: 8px;
        }

        .lat-final {
            margin-top: 12px;
            padding: 12px 14px;
            border-radius: 12px;
            background: #fff;
            border: 2px dashed var(--outer-line);
            font-weight: 900;
            color: var(--green);
            text-align: center;
        }

        .ok {
            color: #0f5f22;
        }

        .no {
            color: #7a2b2b;
        }

        @media (max-width: 640px) {
            .top-title .judul {
                font-size: 24px;
            }

            .top-title .label {
                font-size: 22px;
            }

            .card {
                padding: 16px;
            }

            .lead-text {
                font-size: 16px;
            }

            .rumus {
                font-size: 16px;
            }

            .rumus-eks {
                font-size: 18px;
            }

            .contoh-row {
                grid-template-columns: 1fr;
            }

            .mono-box {
                font-size: 16px;
            }

            .p5-host {
                height: 720px;
            }

            .sol-grid {
                grid-template-columns: 1fr;
            }

            .lat-line {
                flex-direction: column;
                align-items: stretch;
            }

            .lat-input,
            .lat-select,
            #winnerTerm {
                width: 100%;
                min-width: 100%;
            }

            .lat-actions {
                justify-content: stretch;
            }

            .lat-btn {
                width: 100%;
            }
        }
    </style>

    <div class="materi-wrap">

        <div class="top-title">
            <div class="label">2.</div>
            <div class="judul">Derajat Suatu Polinomial</div>
        </div>

        <p class="lead-text">
            Setiap polinomial memiliki karakteristik yang membedakannya, salah satunya adalah
            <strong>derajat</strong>. Derajat menunjukkan <strong>pangkat tertinggi</strong>
            dari variabel yang terdapat pada suatu suku banyak.
        </p>

        {{-- CARD 1: Eksplorasi --}}
        <div class="card card-explore" id="cardEksplorasi">
            <div class="title-box">🧭 Eksplorasi</div>

            <p>
                Masyarakat Kalimantan Selatan memiliki kearifan lokal dalam mengelola lahan basah, seperti
                pertanian padi rawa, kebun di lahan pasang surut, serta kolam ikan tradisional (beje).
            </p>

            <p>Misalkan:</p>
            <ul>
                <li><span class="highlight">$x$</span> menyatakan luas lahan padi rawa.</li>
                <li><span class="highlight">$y$</span> menyatakan luas kebun sayur.</li>
                <li><span class="highlight">$z$</span> menyatakan jumlah kolam ikan.</li>
            </ul>

            <p>Pemanfaatan lahan basah tersebut dinyatakan dalam bentuk polinomial:</p>

            <div class="rumus">
                $$P(x,y,z)=2x^2+3xy^3-4z+6$$
            </div>

            <div class="quiz3" id="quiz3">
                <div class="qitem" data-q="1">
                    <div class="qtitle">Soal 1</div>
                    <div class="qhint">Klik suku yang memiliki <b>derajat tertinggi</b>.</div>
                    <div class="rumus-eks">
                        <span class="term" data-correct="0">2x²</span> +
                        <span class="term" data-correct="1">3xy³</span> −
                        <span class="term" data-correct="0">4z</span> +
                        <span class="term" data-correct="0">6</span>
                    </div>
                    <div class="feedback"></div>
                </div>

                <div class="qitem" data-q="2">
                    <div class="qtitle">Soal 2</div>
                    <div class="qhint">Klik suku yang memiliki <b>derajat 1</b>.</div>
                    <div class="rumus-eks">
                        <span class="term" data-correct="0">2x²</span> +
                        <span class="term" data-correct="0">3xy³</span> −
                        <span class="term" data-correct="1">4z</span> +
                        <span class="term" data-correct="0">6</span>
                    </div>
                    <div class="feedback"></div>
                </div>

                <div class="qitem" data-q="3">
                    <div class="qtitle">Soal 3</div>
                    <div class="qhint">Klik suku yang merupakan <b>konstanta</b> (derajat 0).</div>
                    <div class="rumus-eks">
                        <span class="term" data-correct="0">2x²</span> +
                        <span class="term" data-correct="0">3xy³</span> −
                        <span class="term" data-correct="0">4z</span> +
                        <span class="term" data-correct="1">6</span>
                    </div>
                    <div class="feedback"></div>
                </div>

                <div class="summary" id="quizSummary"></div>
            </div>
        </div>

        {{-- BAGIAN LANJUTAN --}}
        <div id="bagianLanjutan" class="locked">

            {{-- CARD 2: Contoh --}}
            <div class="card card-example">
                <div class="title-box">🧪 Contoh</div>
                <div class="contoh-sub">Klik angka 1–4 untuk membuka penjelasan. (Bisa dibuka banyak sekaligus)</div>

                <div class="contoh-panel">
                    <div class="contoh-toolbar">
                        <div class="pill-row">
                            <button type="button" class="pill-num" data-target="ex1">1</button>
                            <button type="button" class="pill-num" data-target="ex2">2</button>
                            <button type="button" class="pill-num" data-target="ex3">3</button>
                            <button type="button" class="pill-num" data-target="ex4">4</button>
                        </div>
                        <button type="button" class="contoh-reset" id="contohReset">Tutup semua</button>
                    </div>

                    <div class="contoh-body">
                        <div class="contoh-row">
                            <div class="mono-box">$$4x^5$$</div>
                            <div class="explain" id="ex1">
                                Derajat monomial ini adalah <b>5</b>, karena variabel $x$ berpangkat <b>5</b>.
                            </div>
                        </div>

                        <div class="contoh-row">
                            <div class="mono-box">$$x^2y^7$$</div>
                            <div class="explain" id="ex2">
                                Derajat monomial ini adalah <b>9</b>, karena jumlah pangkat variabel $x$ dan $y$ adalah $2 +
                                7 = 9$.
                            </div>
                        </div>

                        <div class="contoh-row">
                            <div class="mono-box">$$0.12x$$</div>
                            <div class="explain" id="ex3">
                                Derajat monomial ini adalah <b>1</b>, karena variabel $x$ berpangkat <b>1</b>.
                            </div>
                        </div>

                        <div class="contoh-row" style="margin-bottom:0;">
                            <div class="mono-box">$$2.17x^3yz^3$$</div>
                            <div class="explain" id="ex4">
                                Derajat monomial ini adalah <b>7</b>, karena jumlah pangkat variabel $x$, $y$, dan $z$
                                adalah $3 + 1 + 3 = 7$.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CARD 3: Definisi monomial --}}
            <div class="card definisi-card">
                <div class="definisi-label">DEFINISI</div>
                <p>
                    <strong>Derajat monomial</strong> adalah jumlah pangkat semua variabel pada monomial
                    dengan koefisien tak nol. Koefisien hanya berfungsi sebagai pengali dan tidak
                    memengaruhi derajat dari monomial tersebut.
                </p>
            </div>

            {{-- CARD 4: Mari Mencoba (p5) --}}
            <div class="card card-try">
                <div class="title-box">📝 Mari Mencoba</div>

                <div id="p5-interaktif-1b" class="p5-host">
                    <noscript>Aktifkan JavaScript untuk melihat latihan interaktif.</noscript>
                </div>

                <div class="after-try">
                    <p>
                        Polinomial terdiri dari beberapa suku, dan setiap suku merupakan monomial yang memiliki variabel
                        dengan pangkat tertentu.
                        Untuk mengetahui derajat suatu monomial, kita cukup memperhatikan pangkat variabel-variabel yang
                        menyusunnya.
                        <br><br>
                        Di dalam sebuah polinomial, suku yang memiliki pangkat variabel paling besar disebut sebagai <b>suku
                            utama</b>.
                        Derajat suku inilah yang menentukan derajat polinomial secara keseluruhan.
                    </p>
                </div>
            </div>

            {{-- CARD 5: Contoh Soal (INTERAKTIF + LOCK) --}}
            <div class="card card-example">
                <div class="title-box">📘 Contoh Soal</div>

                <p class="highlight">Tentukan derajat dari polinomial berikut:</p>

                <div class="sol-quiz" id="solQuiz">
                    <div class="sol-quiz-item" data-sol="sol1" data-answer="5">
                        <div class="sol-quiz-head">
                            <div class="sol-quiz-title">Soal 1</div>
                            <div class="sol-quiz-form">
                                <input class="sol-input" type="number" inputmode="numeric" placeholder="Jawaban derajat">
                                <button type="button" class="sol-btn check">Cek</button>
                                <button type="button" class="sol-btn show" disabled>Lihat penyelesaian</button>
                            </div>
                        </div>
                        <div class="sol-quiz-math">$$P(x)=4x^5+3x^2-7$$</div>
                        <div class="sol-feedback"></div>
                    </div>

                    <div class="sol-quiz-item" data-sol="sol2" data-answer="5">
                        <div class="sol-quiz-head">
                            <div class="sol-quiz-title">Soal 2</div>
                            <div class="sol-quiz-form">
                                <input class="sol-input" type="number" inputmode="numeric" placeholder="Jawaban derajat">
                                <button type="button" class="sol-btn check">Cek</button>
                                <button type="button" class="sol-btn show" disabled>Lihat penyelesaian</button>
                            </div>
                        </div>
                        <div class="sol-quiz-math">$$Q(x,y)=2x^3y^2-xy+5y^4$$</div>
                        <div class="sol-feedback"></div>
                    </div>

                    <div class="sol-quiz-item" data-sol="sol3" data-answer="6">
                        <div class="sol-quiz-head">
                            <div class="sol-quiz-title">Soal 3</div>
                            <div class="sol-quiz-form">
                                <input class="sol-input" type="number" inputmode="numeric" placeholder="Jawaban derajat">
                                <button type="button" class="sol-btn check">Cek</button>
                                <button type="button" class="sol-btn show" disabled>Lihat penyelesaian</button>
                            </div>
                        </div>
                        <div class="sol-quiz-math">$$R(a,b,c)=3a^2b^3c+7ab-4$$</div>
                        <div class="sol-feedback"></div>
                    </div>
                </div>

                {{-- ✅ Jangan tampilkan grid penyelesaian sampai semua benar --}}
                <div id="solUnlockAll" style="display:none;">
                    <div class="title-box" style="margin-top:18px;">🧩 Penyelesaian</div>

                    <div class="sol-grid">
                        <div class="sol-box" data-target="sol1">Soal 1</div>
                        <div class="sol-box" data-target="sol2">Soal 2</div>
                        <div class="sol-box" data-target="sol3">Soal 3</div>
                    </div>
                </div>

                <div id="sol1" class="sol-content">
                    <div class="sol-title">Penyelesaian Soal 1</div>
                    <p class="highlight">Derajat setiap suku:</p>
                    <ul>
                        <li>$$4x^5 \rightarrow 5$$</li>
                        <li>$$3x^2 \rightarrow 2$$</li>
                        <li>$$-7 \rightarrow 0$$</li>
                    </ul>
                    <p class="highlight">Derajat tertinggi = 5 → Derajat polinomial = 5</p>
                </div>

                <div id="sol2" class="sol-content">
                    <div class="sol-title">Penyelesaian Soal 2</div>
                    <p class="highlight">Derajat setiap suku:</p>
                    <ul>
                        <li>$$2x^3y^2 \rightarrow 3+2=5$$</li>
                        <li>$$-xy \rightarrow 1+1=2$$</li>
                        <li>$$5y^4 \rightarrow 4$$</li>
                    </ul>
                    <p class="highlight">Derajat tertinggi = 5 → Derajat polinomial = 5</p>
                </div>

                <div id="sol3" class="sol-content">
                    <div class="sol-title">Penyelesaian Soal 3</div>
                    <p class="highlight">Derajat setiap suku:</p>
                    <ul>
                        <li>$$3a^2b^3c \rightarrow 2+3+1=6$$</li>
                        <li>$$7ab \rightarrow 1+1=2$$</li>
                        <li>$$-4 \rightarrow 0$$</li>
                    </ul>
                    <p class="highlight">Derajat tertinggi = 6 → Derajat polinomial = 6</p>
                </div>
            </div>

            {{-- CARD 6: Definisi derajat polinomial --}}
            <div class="card definisi-card">
                <div class="definisi-label">DEFINISI</div>
                <p>
                    Derajat suatu polinomial adalah derajat tertinggi dari suku-suku yang menyusunnya,
                    yaitu pangkat tertinggi dari variabel yang muncul dalam polinomial tersebut.
                </p>
            </div>
            {{-- ✅ CARD 7: Latihan (langsung pas di card) --}}
            <div class="card card-try latihan-card-fit">
                <div class="title-box">🎯 Latihan</div>

                <div id="latihanBoard">

                    <div class="lat-section yellow">
                        <div class="lat-title">1. Tebak Cepat (True or False)</div>

                        <div class="lat-line">
                            <span>a. Bentuk <b>9x<sup>4</sup>y<sup>2</sup></b> memiliki derajat 6.</span>
                            <select class="lat-select" data-answer="true">
                                <option value="">Pilih</option>
                                <option value="true">True</option>
                                <option value="false">False</option>
                            </select>
                        </div>

                        <div class="lat-line">
                            <span>b. Suku <b>−7</b> selalu memiliki derajat 0.</span>
                            <select class="lat-select" data-answer="true">
                                <option value="">Pilih</option>
                                <option value="true">True</option>
                                <option value="false">False</option>
                            </select>
                        </div>

                        <div class="lat-feedback" id="fb-truefalse"></div>
                    </div>

                    <div class="lat-section blue">
                        <div class="lat-title">2. Pilih Pemenangnya! (Suku Paling Kuat)</div>

                        <p style="margin:6px 0;">
                            Perhatikan polinomial:
                            <b>T(x) = 3x<sup>5</sup> − 2x<sup>3</sup> + 10x</b>
                        </p>

                        <p style="margin:6px 0;">Suku dengan pangkat tertinggi memimpin saat x besar.</p>

                        <div class="lat-line">
                            <span><b>Suku paling kuat:</b></span>
                            <select id="winnerTerm">
                                <option value="">Pilih suku</option>
                                <option value="3x5">3x⁵</option>
                                <option value="-2x3">−2x³</option>
                                <option value="10x">10x</option>
                            </select>
                        </div>

                        <div class="lat-line">
                            <span><b>Derajat polinomial:</b></span>
                            <input type="number" id="winnerDegree" class="lat-input" placeholder="isi">
                        </div>

                        <div class="lat-feedback" id="fb-winner"></div>
                    </div>

                    <div class="lat-section pink">
                        <div class="lat-title">3. Isi Kotak Misteri (Menjumlah Pangkat)</div>

                        <p style="margin:6px 0;">
                            Tentukan derajat monomial:
                            <b>4a<sup>3</sup>b<sup>2</sup>c</b>
                        </p>

                        <div class="lat-line">
                            <span></span>
                            <input type="number" id="mysteryDegree" class="lat-input" placeholder="isi">
                        </div>

                        <div class="lat-feedback" id="fb-mystery"></div>
                    </div>

                    <div class="lat-section green">
                        <div class="lat-title">4. Detektif Polinomial (Sebutkan Alasannya!)</div>

                        <p style="margin:6px 0;">
                            <b>G(x,y) = 5x<sup>2</sup>y<sup>3</sup> − xy + 4</b>
                        </p>

                        <div class="lat-line">
                            <span>a. Derajat tertinggi:</span>
                            <input type="number" id="detectHighest" class="lat-input" placeholder="isi">
                        </div>

                        <div class="lat-line">
                            <span>b. Derajat polinomial G(x,y):</span>
                            <input type="number" id="detectPoly" class="lat-input" placeholder="isi">
                        </div>

                        <div class="lat-actions">
                            <button type="button" class="lat-btn" id="btnCheckLatihan">Cek Jawaban</button>
                        </div>

                        <div class="lat-feedback" id="fb-detect"></div>
                    </div>

                    <div class="lat-final" id="latihanFinalScore"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- p5.js + interaktif --}}
    <script src="https://cdn.jsdelivr.net/npm/p5@1.9.2/lib/p5.min.js"></script>

    {{-- interaktif lama --}}
    <script src="{{ asset('js/interaktif1b.js') }}"></script>
    <script>
        (function () {
            // ===== QUIZ unlock bagian lanjutan =====
            const quiz = document.getElementById("quiz3");
            const qitems = Array.from(quiz.querySelectorAll(".qitem"));
            const summary = document.getElementById("quizSummary");
            const bagianLanjutan = document.getElementById("bagianLanjutan");

            const updateSummary = () => {
                const done = qitems.filter(q => q.dataset.done === "1").length;
                if (summary) summary.textContent = `Skor: ${done}/${qitems.length}`;

                if (done === qitems.length && bagianLanjutan) {
                    bagianLanjutan.classList.add("show");
                    requestAnimationFrame(() => {
                        window.dispatchEvent(new Event("resize"));
                        bagianLanjutan.scrollIntoView({ behavior: "smooth", block: "start" });
                    });
                }
            };

            qitems.forEach(qitem => {
                const terms = qitem.querySelectorAll(".term");
                const feedback = qitem.querySelector(".feedback");

                const reset = () => {
                    terms.forEach(t => t.classList.remove("correct", "wrong"));
                    if (feedback) {
                        feedback.classList.remove("ok", "no");
                        feedback.textContent = "";
                    }
                };

                terms.forEach(t => {
                    t.addEventListener("click", () => {
                        reset();

                        const isCorrect = t.dataset.correct === "1";
                        if (isCorrect) {
                            t.classList.add("correct");
                            qitem.dataset.done = "1";
                            if (feedback) { feedback.classList.add("ok"); feedback.textContent = "✅ Benar!"; }
                        } else {
                            t.classList.add("wrong");
                            qitem.dataset.done = "0";
                            if (feedback) { feedback.classList.add("no"); feedback.textContent = "❌ Belum tepat, coba lagi."; }
                        }
                        updateSummary();
                    });
                });
            });

            updateSummary();

            // ===== CONTOH: toggle (bisa banyak terbuka) =====
            const pills = Array.from(document.querySelectorAll(".pill-num"));
            const btnReset = document.getElementById("contohReset");

            pills.forEach(p => {
                p.addEventListener("click", () => {
                    const id = p.dataset.target;
                    const target = document.getElementById(id);
                    if (!target) return;

                    const willOpen = !target.classList.contains("show");
                    target.classList.toggle("show");
                    p.classList.toggle("active", willOpen);

                    requestAnimationFrame(() => window.dispatchEvent(new Event("resize")));
                });
            });

            if (btnReset) {
                btnReset.addEventListener("click", () => {
                    pills.forEach(p => p.classList.remove("active"));
                    document.querySelectorAll(".explain").forEach(ex => ex.classList.remove("show"));
                });
            }

            // ===== TOGGLE PENYELESAIAN (ACCORDION) - LOCK sampai semua benar =====
            const solBoxes = Array.from(document.querySelectorAll(".sol-box"));
            const solContents = Array.from(document.querySelectorAll(".sol-content"));
            const solUnlockAll = document.getElementById("solUnlockAll");
            let allSolved = false;

            const checkAllSolved = () => {
                const solQuiz = document.getElementById("solQuiz");
                if (!solQuiz) return false;
                const items = Array.from(solQuiz.querySelectorAll(".sol-quiz-item"));
                return items.length > 0 && items.every(it => it.dataset.done === "1");
            };

            solBoxes.forEach(box => {
                box.addEventListener("click", () => {
                    if (!allSolved) return;

                    const id = box.dataset.target;
                    const content = document.getElementById(id);
                    if (!content) return;

                    const isOpen = content.classList.contains("show");

                    solContents.forEach(c => c.classList.remove("show"));
                    solBoxes.forEach(b => b.classList.remove("active"));

                    if (!isOpen) {
                        content.classList.add("show");
                        box.classList.add("active");
                    }

                    requestAnimationFrame(() => window.dispatchEvent(new Event("resize")));
                });
            });

            // ===== INTERAKTIF CONTOH SOAL: input jawaban -> buka penyelesaian per soal =====
            const solQuiz = document.getElementById("solQuiz");
            if (solQuiz) {
                const items = Array.from(solQuiz.querySelectorAll(".sol-quiz-item"));

                const openSolution = (id) => {
                    const content = document.getElementById(id);
                    const box = solBoxes.find(b => b.dataset.target === id);
                    if (!content) return;

                    solContents.forEach(c => c.classList.remove("show"));
                    solBoxes.forEach(b => b.classList.remove("active"));

                    content.classList.add("show");

                    if (allSolved && box) box.classList.add("active");

                    requestAnimationFrame(() => window.dispatchEvent(new Event("resize")));
                    content.scrollIntoView({ behavior: "smooth", block: "start" });
                };

                items.forEach(item => {
                    const ans = parseInt(item.dataset.answer, 10);
                    const solId = item.dataset.sol;

                    const input = item.querySelector(".sol-input");
                    const btnCheck = item.querySelector(".sol-btn.check");
                    const btnShow = item.querySelector(".sol-btn.show");
                    const fb = item.querySelector(".sol-feedback");

                    const setFeedback = (ok, text) => {
                        fb.classList.remove("ok", "no");
                        fb.classList.add(ok ? "ok" : "no");
                        fb.textContent = text;
                    };

                    const check = () => {
                        const val = parseInt((input.value || "").trim(), 10);
                        if (Number.isNaN(val)) {
                            item.dataset.done = "0";
                            setFeedback(false, "⚠️ Isi jawaban derajat terlebih dahulu.");
                            btnShow.disabled = true;
                            return;
                        }

                        if (val === ans) {
                            item.dataset.done = "1";
                            setFeedback(true, "✅ Benar! Penyelesaian terbuka.");
                            btnShow.disabled = false;
                            btnShow.focus();
                            openSolution(solId);

                            if (checkAllSolved()) {
                                allSolved = true;
                                if (solUnlockAll) solUnlockAll.style.display = "block";
                                requestAnimationFrame(() => window.dispatchEvent(new Event("resize")));
                            }
                        } else {
                            item.dataset.done = "0";
                            setFeedback(false, "❌ Belum tepat. Coba periksa derajat tiap suku, lalu ambil yang tertinggi.");
                            btnShow.disabled = true;
                        }
                    };

                    btnCheck.addEventListener("click", check);
                    btnShow.addEventListener("click", () => openSolution(solId));

                    input.addEventListener("keydown", (e) => {
                        if (e.key === "Enter") {
                            e.preventDefault();
                            check();
                        }
                    });
                });
            }
        })();

        // ===== LATIHAN HTML CSS JS (tanpa p5) =====
        const btnCheckLatihan = document.getElementById("btnCheckLatihan");

        if (btnCheckLatihan) {
            const tfSelects = Array.from(document.querySelectorAll(".lat-select"));
            const fbTrueFalse = document.getElementById("fb-truefalse");
            const fbWinner = document.getElementById("fb-winner");
            const fbMystery = document.getElementById("fb-mystery");
            const fbDetect = document.getElementById("fb-detect");
            const finalScore = document.getElementById("latihanFinalScore");

            const winnerTerm = document.getElementById("winnerTerm");
            const winnerDegree = document.getElementById("winnerDegree");
            const mysteryDegree = document.getElementById("mysteryDegree");
            const detectHighest = document.getElementById("detectHighest");
            const detectPoly = document.getElementById("detectPoly");

            const setFb = (el, ok, text) => {
                if (!el) return;
                el.classList.remove("ok", "no");
                el.classList.add(ok ? "ok" : "no");
                el.textContent = text;
            };

            btnCheckLatihan.addEventListener("click", () => {
                let score = 0;
                let total = 5;

                // 1. True / False
                let tfCorrect = 0;
                tfSelects.forEach(sel => {
                    if (sel.value && sel.value === sel.dataset.answer) {
                        tfCorrect++;
                    }
                });

                if (tfCorrect === 2) {
                    score += 1;
                    setFb(fbTrueFalse, true, "✅ Benar semua pada bagian True/False.");
                } else {
                    setFb(fbTrueFalse, false, "❌ Masih ada jawaban True/False yang belum tepat.");
                }

                // 2. Suku paling kuat
                const winnerOk =
                    winnerTerm.value === "3x5" &&
                    parseInt(winnerDegree.value || "", 10) === 5;

                if (winnerOk) {
                    score += 1;
                    setFb(fbWinner, true, "✅ Tepat! Suku paling kuat adalah 3x⁵ dan derajat polinomialnya 5.");
                } else {
                    setFb(fbWinner, false, "❌ Coba lagi. Lihat suku dengan pangkat tertinggi.");
                }

                // 3. Kotak misteri
                const mysteryOk = parseInt(mysteryDegree.value || "", 10) === 6;
                if (mysteryOk) {
                    score += 1;
                    setFb(fbMystery, true, "✅ Benar! Derajat 4a³b²c adalah 3 + 2 + 1 = 6.");
                } else {
                    setFb(fbMystery, false, "❌ Belum tepat. Jumlahkan semua pangkat variabel.");
                }

                // 4. Detektif a
                const detectHighestOk = parseInt(detectHighest.value || "", 10) === 5;
                if (detectHighestOk) {
                    score += 1;
                }

                // 5. Detektif b
                const detectPolyOk = parseInt(detectPoly.value || "", 10) === 5;
                if (detectPolyOk) {
                    score += 1;
                }

                if (detectHighestOk && detectPolyOk) {
                    setFb(fbDetect, true, "✅ Benar! Suku tertinggi berasal dari 5x²y³, jadi derajat tertinggi = 5 dan derajat polinomial = 5.");
                } else {
                    setFb(fbDetect, false, "❌ Bagian detektif belum tepat. Periksa derajat tiap suku lalu ambil yang terbesar.");
                }

                if (finalScore) {
                    finalScore.textContent = `Skor Latihan: ${score}/${total}`;

                    if (score === total) {
                        finalScore.innerHTML = `🎉 Skor Latihan: ${score}/${total} — Hebat! Semua jawaban benar.`;
                    }
                }

                requestAnimationFrame(() => window.dispatchEvent(new Event("resize")));
            });
        }
    </script>
@endsection

@section('nav')
    <a href="{{ route('pengertianpolinomial') }}" class="btn-nav prev-btn">
        ← Previous
    </a>

    <a href="{{ route('fungsipolinomialdangrafiknya') }}" class="btn-nav next-btn">
        Next →
    </a>
@endsection