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

            --def-bg: #f5c9b9;
            --def-pill: #7fb06a;
            --def-pill-border: #2e7d32;
            --def-formula-bg: #f6f7f9;
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

        .section-title {
            font-size: 30px;
            font-weight: 800;
            color: var(--green);
            margin: 48px 0 18px;
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

        .card li {
            margin: 6px 0;
        }

        .highlight {
            font-weight: 700;
            color: #000;
        }

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

        .pill.koef {
            background: var(--koef-bg);
            color: var(--koef-tx);
        }

        .pill.var {
            background: var(--var-bg);
            color: var(--var-tx);
        }

        .pill.konst {
            background: var(--konst-bg);
            color: var(--konst-tx);
        }

        .grp::before {
            content: "";
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: 38px;
            width: 2px;
            height: 18px;
            background: rgba(0, 0, 0, .40);
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
            border-bottom: 8px solid rgba(0, 0, 0, .40);
        }

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

        .contoh-sub {
            margin: 0 0 14px;
            color: var(--muted);
        }

        .kartu-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .kartu {
            border-radius: 16px;
            border: 1px solid rgba(0, 0, 0, .10);
            background: #fff;
            padding: 14px 14px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, .04);
            cursor: pointer;
            transition: transform .12s ease, box-shadow .12s ease;
            user-select: none;
            outline: none;
        }

        .kartu:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 26px rgba(0, 0, 0, .06);
        }

        .kartu-top {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            margin-bottom: 8px;
        }

        .kartu-tag {
            font-weight: 900;
            font-size: 12px;
            padding: 6px 10px;
            border-radius: 999px;
            border: 1px solid rgba(0, 0, 0, .10);
            background: #fff;
            color: var(--muted);
        }

        .kartu-ekspresi {
            font-size: 22px;
            font-weight: 900;
            color: #000;
            margin-bottom: 6px;
        }

        .kartu-hint {
            color: var(--muted);
            font-size: 14px;
            margin: 0;
        }

        .kartu-penjelasan {
            margin-top: 10px;
            padding: 10px 12px;
            border-radius: 12px;
            border: 1px solid rgba(91, 155, 213, .20);
            background: #f8fbff;
            color: var(--muted);
            display: none;
            animation: fadeIn .15s ease;
        }

        .kartu.open .kartu-penjelasan {
            display: block;
        }

        .kartu.open .kartu-tag {
            color: #0f5f22;
            border-color: rgba(27, 122, 42, .18);
            background: rgba(27, 122, 42, .06);
        }

        .kartu.open {
            border-color: rgba(27, 122, 42, .18);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-2px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .kartu-actions {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 14px;
        }

        .btnx {
            padding: 8px 14px;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, .14);
            background: #fff;
            cursor: pointer;
            font-weight: 800;
        }

        .btnx.primary {
            border-color: rgba(27, 122, 42, .25);
        }

        .btnx.ghost {
            border-color: rgba(91, 155, 213, .25);
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
            box-sizing: border-box;
            background: #fff;
        }

        .quiz-input:focus {
            border-color: rgba(27, 122, 42, .5);
            box-shadow: 0 0 0 3px rgba(27, 122, 42, .10);
        }

        .quiz-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 8px;
            flex-wrap: wrap;
        }

        .quiz-reset {
            padding: 8px 14px;
            border-radius: 10px;
            border: 1px solid rgba(224, 112, 43, .25);
            background: #fff;
            cursor: pointer;
            font-weight: 700;
        }

        .quiz-feedback {
            font-weight: 800;
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
            color: #8a2b00;
            background: rgba(224, 112, 43, .10);
            border: 1px solid rgba(224, 112, 43, .18);
        }

        .quiz-summary {
            margin-left: 0;
            margin-top: 10px;
            font-weight: 800;
            color: var(--green);
            display: block;
        }

        /* Materi lanjutan disembunyikan dulu */
        #materi-lanjutan {
            display: none;
            opacity: 0;
            transform: translateY(8px);
            transition: opacity .35s ease, transform .35s ease;
        }

        #materi-lanjutan.show {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        .contoh-grid2 {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-top: 10px;
        }

        .contoh-card2 {
            border-radius: 16px;
            border: 1px solid rgba(0, 0, 0, .10);
            background: #fff;
            padding: 14px 14px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, .04);
        }

        .contoh-head2 {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 10px;
        }

        .badge2 {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 900;
            font-size: 12px;
            padding: 6px 10px;
            border-radius: 999px;
            border: 1px solid rgba(0, 0, 0, .10);
            white-space: nowrap;
        }

        .badge2.ok {
            color: var(--green);
            background: rgba(27, 122, 42, .08);
            border-color: rgba(27, 122, 42, .18);
        }

        .badge2.no {
            color: var(--red);
            background: rgba(214, 69, 69, .08);
            border-color: rgba(214, 69, 69, .18);
        }

        .badge2.info {
            color: var(--blue);
            background: rgba(45, 108, 223, .08);
            border-color: rgba(45, 108, 223, .18);
        }

        .contoh-ekspresi2 {
            font-size: 22px;
            font-weight: 900;
            color: #000;
            margin: 6px 0 8px;
        }

        .contoh-desc2 {
            margin: 0;
            color: var(--muted);
            text-align: justify;
        }

        .contoh-note2 {
            margin-top: 10px;
            padding: 10px 12px;
            border-radius: 12px;
            background: var(--blue-soft);
            border: 1px solid rgba(45, 108, 223, .18);
            color: var(--muted);
        }

        .definisi-block {
            position: relative;
            border-radius: 26px;
            background: var(--def-bg);
            padding: 36px 26px 30px;
            margin: 34px 0 40px 0;
            box-shadow: 0 10px 28px rgba(0, 0, 0, .05);
            border: 1px solid rgba(0, 0, 0, .06);
        }

        .definisi-pill {
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
            box-shadow: 0 10px 18px rgba(0, 0, 0, .08);
            text-transform: uppercase;
        }

        .definisi-text {
            margin: 0;
            font-size: 17px;
            font-weight: 400;
            line-height: 1.7;
            color: #2b2b2b;
            text-align: justify;
        }

        .quiz-box-new {
            background: transparent;
            padding: 0;
            border: none;
            border-radius: 0;
        }

        .quiz-item-plain {
            padding: 14px 0 18px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        }

        .quiz-item-plain:last-child {
            border-bottom: none;
        }

        .quiz-soal-title {
            font-size: 18px;
            font-weight: 800;
            color: #2b2b2b;
            margin-bottom: 6px;
        }

        .quiz-ekspresi {
            font-size: 30px;
            font-weight: 700;
            color: #000;
            margin: 8px 0 12px;
        }

        .quiz-options-new {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .quiz-options-new label {
            font-size: 15px;
            color: var(--text);
            cursor: pointer;
        }

        .feedback-box {
            margin-top: 8px;
            padding: 8px 10px;
            border-radius: 8px;
            display: none;
            font-weight: 700;
            line-height: 1.6;
        }

        .feedback-box.correct {
            display: block;
            background: #e7f8ec;
            color: #1b7a2a;
            border: 1px solid #b7e0c2;
        }

        .feedback-box.wrong {
            display: block;
            background: #ffecec;
            color: #b30000;
            border: 1px solid #f1c3c3;
        }

        .result-box {
            margin-top: 14px;
            font-weight: bold;
            color: var(--green);
        }

        @media (max-width: 780px) {

            .kartu-grid,
            .contoh-grid2,
            .contoh-grid-interaktif {
                grid-template-columns: 1fr;
            }

            .definisi-text {
                font-size: 16px;
            }
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
                margin-bottom: 32px;
            }

            .tujuan-card {
                padding: 18px 18px;
            }

            .formula-expr {
                font-size: 30px;
            }

            .pill {
                font-size: 12px;
                padding: 7px 12px;
            }

            .grp {
                padding-bottom: 56px;
            }

            .definisi-block {
                padding: 34px 18px 26px;
            }

            .definisi-pill {
                left: 18px;
                padding: 9px 22px;
            }

            .quiz-ekspresi {
                font-size: 24px;
            }

            .quiz-options-new {
                flex-direction: column;
                gap: 8px;
            }
        }

        .contoh-grid-interaktif {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-top: 14px;
        }

        .contoh-card-interaktif {
            border-radius: 16px;
            border: 1px solid rgba(0, 0, 0, .10);
            background: #fff;
            padding: 14px 14px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, .04);
            cursor: pointer;
            transition: transform .12s ease, box-shadow .12s ease, border-color .12s ease;
            user-select: none;
            outline: none;
        }

        .contoh-card-interaktif:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 26px rgba(0, 0, 0, .06);
        }

        .contoh-card-interaktif.open {
            border-color: rgba(27, 122, 42, .20);
            box-shadow: 0 14px 26px rgba(0, 0, 0, .06);
        }

        .contoh-head-interaktif {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 10px;
            flex-wrap: wrap;
        }

        .contoh-ekspresi-interaktif {
            font-size: 22px;
            font-weight: 900;
            color: #000;
            margin: 6px 0 8px;
        }

        .contoh-hint-interaktif {
            margin: 0;
            color: var(--muted);
            font-size: 14px;
        }

        .contoh-penjelasan-interaktif {
            display: none;
            margin-top: 12px;
            padding: 12px;
            border-radius: 12px;
            background: #f8fbff;
            border: 1px solid rgba(45, 108, 223, .18);
            color: var(--muted);
            line-height: 1.6;
        }

        .contoh-card-interaktif.open .contoh-penjelasan-interaktif {
            display: block;
        }

        .contoh-actions {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 14px;
        }
    </style>

    <div class="materi-wrap">

        <div class="top-title">
            <div class="label">A.</div>
            <div class="judul">Polinomial dan Fungsi Polinomial</div>
        </div>

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

        <div class="card card-orange">
            <div class="title-box">🧭 Eksplorasi</div>

            <p>
                Sebelum mempelajari pengertian polinomial, amati terlebih dahulu bentuk aljabar berikut.
            </p>

            <!-- BAGIAN VISUAL TETAP -->
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
                Pada bentuk tersebut, terdapat beberapa bagian yang dipisahkan oleh tanda tambah,
                yaitu <span class="highlight">$2x$</span>, <span class="highlight">$3y$</span>,
                dan <span class="highlight">$5$</span>.
            </p>

            <p>
                Setiap bagian tersebut merupakan satu suku. Bentuk satu suku disebut
                <b>monomial</b>. Jika beberapa monomial digabungkan, maka terbentuk
                <span class="highlight">$2x + 3y + 5$</span>.
            </p>

            <p>
                Amati kembali bentuk tersebut, lalu jawablah pertanyaan eksplorasi berikut.
            </p>

            <!-- PERTANYAAN TETAP -->
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
                            <span class="quiz-feedback"></span>
                        </div>
                    </li>

                    <li class="quiz-item" data-type="oneof" data-answer="5">
                        <div class="quiz-q">
                            Dari monomial tersebut, manakah yang merupakan konstanta?
                        </div>

                        <input class="quiz-input" type="text" placeholder="Jawaban kamu..." />
                        <div class="quiz-actions">
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
                            <span class="quiz-feedback"></span>
                        </div>
                    </li>
                </ol>

                <span id="quiz-summary" class="quiz-summary"></span>
            </div>
        </div>
        <div id="materi-lanjutan">
            <p>
                Sebelum memahami pengertian polinomial secara menyeluruh, ada baiknya kita mempelajari terlebih dahulu
                penyusun utamanya yaitu monomial.
            </p>

            <p>
                Monomial merupakan bentuk aljabar yang terdiri dari satu suku berupa bilangan, variabel yang berpangkat
                bilangan cacah, atau hasil kali antara bilangan dan satu atau lebih variabel berpangkat bilangan cacah.
            </p>

            <div class="contoh-wrap" id="contoh-kartu">
                <div class="contoh-badge">CONTOH</div>
                <p class="contoh-sub">Klik setiap kartu untuk melihat penjelasan (tap di HP juga bisa).</p>

                <div class="kartu-grid">
                    <div class="kartu" tabindex="0">
                        <div class="kartu-top">
                            <div class="kartu-tag">Klik untuk penjelasan</div>
                        </div>
                        <div class="kartu-ekspresi">$6x^2$</div>
                        <p class="kartu-hint">Apakah ini monomial?</p>
                        <div class="kartu-penjelasan">
                            Monomial ✅ karena terdiri dari satu suku dan variabel berpangkat bilangan cacah.
                        </div>
                    </div>

                    <div class="kartu" tabindex="0">
                        <div class="kartu-top">
                            <div class="kartu-tag">Klik untuk penjelasan</div>
                        </div>
                        <div class="kartu-ekspresi">$-6$</div>
                        <p class="kartu-hint">Termasuk monomial?</p>
                        <div class="kartu-penjelasan">
                            Monomial ✅ karena konstanta juga termasuk satu suku (tanpa variabel).
                        </div>
                    </div>

                    <div class="kartu" tabindex="0">
                        <div class="kartu-top">
                            <div class="kartu-tag">Klik untuk penjelasan</div>
                        </div>
                        <div class="kartu-ekspresi">$\frac{1}{6}x^2$</div>
                        <p class="kartu-hint">Koefisien pecahan boleh?</p>
                        <div class="kartu-penjelasan">
                            Monomial ✅ karena koefisien boleh pecahan, yang penting tetap satu suku.
                        </div>
                    </div>

                    <div class="kartu" tabindex="0">
                        <div class="kartu-top">
                            <div class="kartu-tag">Klik untuk penjelasan</div>
                        </div>
                        <div class="kartu-ekspresi">$5x + 2x^2$</div>
                        <p class="kartu-hint">Ini monomial atau bukan?</p>
                        <div class="kartu-penjelasan">
                            Bukan monomial ❌ karena ada tanda “+” yang memisahkan menjadi dua suku.
                        </div>
                    </div>
                </div>

                <p style="margin:10px 0 0; text-align:justify; color: var(--muted);">
                    Jika monomial tidak memiliki variabel, maka disebut konstanta, seperti $-8$ atau $25$. Sedangkan
                    bilangan
                    yang menjadi faktor pengali variabel disebut koefisien. Monomial merupakan bagian dari polinomial. Sama
                    seperti penjumlahan dua bilangan real menghasilkan bilangan real, penjumlahan dua atau lebih monomial
                    akan
                    membentuk polinomial.
                </p>
            </div>

            <div class="definisi-block">
                <div class="definisi-pill">DEFINISI</div>

                <p class="definisi-text">
                    Polinomial adalah bentuk aljabar yang terdiri atas satu monomial atau penjumlahan dari dua atau lebih
                    monomial.
                    Setiap monomial penyusun polinomial disebut <i>suku</i>.
                    Selain itu, polinomial memuat satu variabel yang berpangkat bilangan bulat positif.
                </p>
            </div>

            <div class="card card-green">
                <div class="title-box">🧪 Contoh</div>

                <div class="contoh-note2">
                    Tips cepat: klik tiap contoh untuk melihat alasan kenapa termasuk polinomial atau bukan polinomial.
                </div>

                <div class="contoh-grid-interaktif" id="contoh-interaktif">
                    <div class="contoh-card-interaktif" tabindex="0">
                        <div class="contoh-head-interaktif">
                            <span class="badge2 ok">✅ Polinomial</span>
                            <span class="badge2 info">Pangkat valid</span>
                        </div>
                        <div class="contoh-ekspresi-interaktif">$3x^2 + 2x + 1$</div>
                        <p class="contoh-hint-interaktif">Klik untuk melihat penjelasan.</p>
                        <div class="contoh-penjelasan-interaktif">
                            Bentuk ini termasuk <b>polinomial</b> karena semua sukunya memiliki pangkat variabel
                            berupa bilangan bulat tidak negatif, yaitu 2, 1, dan 0.
                            Tidak ada variabel di penyebut dan tidak ada akar.
                        </div>
                    </div>

                    <div class="contoh-card-interaktif" tabindex="0">
                        <div class="contoh-head-interaktif">
                            <span class="badge2 ok">✅ Polinomial</span>
                            <span class="badge2 info">Monomial dijumlah</span>
                        </div>
                        <div class="contoh-ekspresi-interaktif">$5a^3b - 4a + 7$</div>
                        <p class="contoh-hint-interaktif">Klik untuk melihat penjelasan.</p>
                        <div class="contoh-penjelasan-interaktif">
                            Bentuk ini termasuk <b>polinomial</b> karena tersusun dari beberapa monomial.
                            Pangkat variabel $a$ dan $b$ adalah bilangan cacah, dan tidak ada variabel
                            di penyebut maupun akar.
                        </div>
                    </div>

                    <div class="contoh-card-interaktif" tabindex="0">
                        <div class="contoh-head-interaktif">
                            <span class="badge2 no">❌ Bukan Polinomial</span>
                            <span class="badge2 info">Variabel di penyebut</span>
                        </div>
                        <div class="contoh-ekspresi-interaktif">$\frac{1}{x} + 2$</div>
                        <p class="contoh-hint-interaktif">Klik untuk melihat penjelasan.</p>
                        <div class="contoh-penjelasan-interaktif">
                            Bentuk ini <b>bukan polinomial</b> karena ada variabel $x$ di penyebut.
                            Bentuk $\frac{1}{x}$ setara dengan $x^{-1}$, sedangkan pangkat negatif
                            tidak diperbolehkan dalam polinomial.
                        </div>
                    </div>

                    <div class="contoh-card-interaktif" tabindex="0">
                        <div class="contoh-head-interaktif">
                            <span class="badge2 no">❌ Bukan Polinomial</span>
                            <span class="badge2 info">Pangkat pecahan</span>
                        </div>
                        <div class="contoh-ekspresi-interaktif">$\sqrt{x} + 5$</div>
                        <p class="contoh-hint-interaktif">Klik untuk melihat penjelasan.</p>
                        <div class="contoh-penjelasan-interaktif">
                            Bentuk ini <b>bukan polinomial</b> karena $\sqrt{x}$ dapat ditulis sebagai
                            $x^{\frac{1}{2}}$. Pangkat pecahan tidak memenuhi syarat polinomial.
                        </div>
                    </div>
                </div>


            </div>

            <div class="card card-green">
                <div class="title-box">📝 Latihan</div>

                <div class="quiz-box-new">
                    <div class="contoh-note2" style="margin-bottom: 14px;">
                        <b>Petunjuk pengerjaan:</b> Perhatikan setiap bentuk aljabar dengan saksama, lalu tentukan
                        apakah bentuk tersebut termasuk <b>polinomial</b> atau <b>bukan polinomial</b>.
                        Pilih salah satu jawaban pada setiap soal, kemudian tekan tombol
                        <b>Cek Jawaban</b>
                    </div>

                    <div id="quiz-container"></div>

                    <div style="margin-top: 15px;">
                        <button id="checkBtn" class="btnx primary" type="button">Cek Jawaban</button>
                        <button id="resetBtn" class="btnx ghost" type="button">Reset</button>
                    </div>

                    <div id="resultBox" class="result-box"></div>
                </div>
            </div>
        </div>

        <!-- Save Progress -->
        <script>
            window.completeMateriUrl = "{{ route('materi.complete', $materi->id) }}";
        </script>

        <script>
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
                            Accept: "application/json",
                        },
                        body: JSON.stringify({}),
                    });

                    return response.ok;
                } catch (error) {
                    console.error(error);
                    return false;
                }
            }

            function bukaNextButton() {
                const nextBtn = document.getElementById("nextMateriBtn");
                if (!nextBtn) return;

                const url = nextBtn.dataset.nextUrl;
                if (!url) return;

                const link = document.createElement("a");
                link.href = url;
                link.id = "nextMateriBtn";
                link.className = "btn-nav next-btn";
                link.textContent = "Next →";

                nextBtn.replaceWith(link);
            }
        </script>

        <script>
            (function () {
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
                    for (const x of A) {
                        if (!B.has(x)) return false;
                    }
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
                    updateSummaryAndUnlock();
                };

                const checkItem = (item) => {
                    const type = item.getAttribute("data-type");
                    const valRaw = getInputValue(item);

                    if (!valRaw.trim()) {
                        clearFeedback(item);
                        return false;
                    }

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

                const materiLanjutan = document.getElementById("materi-lanjutan");
                const summary = document.getElementById("quiz-summary");
                let isUnlocked = false;

                const unlockMateri = () => {
                    if (!materiLanjutan || isUnlocked) return;

                    isUnlocked = true;
                    materiLanjutan.style.display = "block";

                    requestAnimationFrame(() => {
                        materiLanjutan.classList.add("show");
                    });

                    setTimeout(() => {
                        materiLanjutan.scrollIntoView({
                            behavior: "smooth",
                            block: "start"
                        });
                    }, 150);
                };

                const updateSummaryAndUnlock = () => {
                    const quiz = document.getElementById("eksplorasi-quiz");
                    if (!quiz) return;

                    const items = Array.from(quiz.querySelectorAll(".quiz-item"));
                    const total = items.length;
                    let filled = 0;
                    let correct = 0;

                    items.forEach(item => {
                        const val = getInputValue(item).trim();
                        if (val !== "") filled++;

                        const fb = item.querySelector(".quiz-feedback");
                        if (fb && fb.classList.contains("ok")) correct++;
                    });

                    if (summary) {
                        if (filled === 0) {
                            summary.textContent = "";
                        } else if (correct === total) {
                            summary.textContent = `Semua jawaban benar ✅ Materi berikutnya sudah dibuka.`;
                        } else {
                            summary.textContent = `Jawaban benar: ${correct}/${total}`;
                        }
                    }

                    if (correct === total) {
                        unlockMateri();
                    }
                };

                const quiz = document.getElementById("eksplorasi-quiz");
                if (quiz) {
                    quiz.querySelectorAll(".quiz-item").forEach(item => {
                        const input = item.querySelector(".quiz-input");
                        const btnReset = item.querySelector(".quiz-reset");

                        if (input) {
                            input.addEventListener("input", () => {
                                checkItem(item);
                                updateSummaryAndUnlock();
                            });

                            input.addEventListener("blur", () => {
                                checkItem(item);
                                updateSummaryAndUnlock();
                            });
                        }

                        if (btnReset) {
                            btnReset.addEventListener("click", () => resetItem(item));
                        }
                    });
                }
            })();
        </script>

        <script>
            window.completeMateriUrl = "{{ route('materi.complete', $materi->id) }}";
        </script>

        <script>
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

            function bukaNextButton() {
                const nextBtn = document.getElementById("nextMateriBtn");
                if (!nextBtn) return;

                const url = nextBtn.dataset.nextUrl;
                if (!url) return;

                const link = document.createElement("a");
                link.href = url;
                link.id = "nextMateriBtn";
                link.className = "btn-nav next-btn";
                link.textContent = "Next →";

                nextBtn.replaceWith(link);
            }

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

            (function () {
                const questions = [
                    {
                        expr: "$4x^3 - 2x + 5$",
                        correct: "polinomial",
                        explanation: "Karena semua pangkat variabel adalah bilangan bulat tidak negatif."
                    },
                    {
                        expr: "$\\frac{1}{y} + 2y$",
                        correct: "bukan",
                        explanation: "Karena ada variabel di penyebut. Bentuk ini setara dengan $y^{-1} + 2y$ sehingga bukan polinomial."
                    },
                    {
                        expr: "$\\sqrt{x} + 7$",
                        correct: "bukan",
                        explanation: "Karena $\\sqrt{x} = x^{1/2}$. Pangkat pecahan tidak memenuhi syarat polinomial."
                    },
                    {
                        expr: "$6a^2b + 3a - 8$",
                        correct: "polinomial",
                        explanation: "Karena semua variabel memiliki pangkat bilangan cacah dan tidak ada variabel di penyebut atau akar."
                    },
                    {
                        expr: "$3x^{-2} + 4$",
                        correct: "bukan",
                        explanation: "Karena ada pangkat negatif pada variabel, sehingga bukan polinomial."
                    }
                ];

                const container = document.getElementById("quiz-container");
                const resultBox = document.getElementById("resultBox");
                const checkBtn = document.getElementById("checkBtn");
                const resetBtn = document.getElementById("resetBtn");

                if (!container || !checkBtn || !resetBtn || !resultBox) return;

                function renderQuiz() {
                    container.innerHTML = "";

                    questions.forEach((q, i) => {
                        const div = document.createElement("div");
                        div.className = "quiz-item-plain";
                        div.innerHTML = `
                        <div class="quiz-soal-title">Soal ${i + 1}</div>
                        <div class="quiz-ekspresi">${q.expr}</div>

                        <div class="quiz-options-new">
                            <label>
                                <input type="radio" name="q${i}" value="polinomial"> Polinomial
                            </label>
                            <label>
                                <input type="radio" name="q${i}" value="bukan"> Bukan Polinomial
                            </label>
                        </div>

                        <div class="feedback-box" id="fb${i}"></div>
                    `;
                        container.appendChild(div);
                    });

                    if (typeof renderMathInElement === "function") {
                        renderMathInElement(container, {
                            delimiters: [
                                { left: '$$', right: '$$', display: true },
                                { left: '$', right: '$', display: false }
                            ]
                        });
                    }
                }

                async function checkAnswers() {
                    let score = 0;

                    questions.forEach((q, i) => {
                        const selected = document.querySelector(`input[name="q${i}"]:checked`);
                        const fb = document.getElementById(`fb${i}`);
                        fb.className = "feedback-box";

                        if (!selected) {
                            fb.classList.add("wrong");
                            fb.innerHTML = "Belum dijawab.";
                            return;
                        }

                        if (selected.value === q.correct) {
                            score++;
                            fb.classList.add("correct");
                            fb.innerHTML = `Benar ✅<br>${q.explanation}`;
                        } else {
                            fb.classList.add("wrong");
                            fb.innerHTML = "Salah ❌";
                        }
                    });

                    if (score === questions.length) {
                        const saved = await saveProgressMateri();

                        if (saved) {
                            resultBox.innerHTML = `
                            Skor: ${score}/${questions.length}<br>
                            Bagus. Semua jawabanmu benar. Silakan lanjut ke materi berikutnya.
                        `;
                            resultBox.style.color = "green";

                            bukaNextButton();
                        } else {
                            resultBox.innerHTML = `
                            Skor: ${score}/${questions.length}<br>
                            Jawaban benar, tapi progres belum tersimpan.
                        `;
                            resultBox.style.color = "orange";
                        }
                    } else {
                        resultBox.innerHTML = `
                        Skor: ${score}/${questions.length}<br>
                        Masih ada jawaban yang belum tepat. Coba lagi ya.
                    `;
                        resultBox.style.color = "red";
                    }

                    if (typeof renderMathInElement === "function") {
                        renderMathInElement(container, {
                            delimiters: [
                                { left: '$$', right: '$$', display: true },
                                { left: '$', right: '$', display: false }
                            ]
                        });

                        renderMathInElement(resultBox, {
                            delimiters: [
                                { left: '$$', right: '$$', display: true },
                                { left: '$', right: '$', display: false }
                            ]
                        });
                    }
                }

                function resetQuiz() {
                    renderQuiz();
                    resultBox.innerHTML = "";
                    resultBox.style.color = "";
                }

                checkBtn.addEventListener("click", checkAnswers);
                resetBtn.addEventListener("click", resetQuiz);

                renderQuiz();
            })();
        </script>

        <script>
            (function () {
                const wrap = document.getElementById('contoh-interaktif');
                if (!wrap) return;

                const cards = Array.from(wrap.querySelectorAll('.contoh-card-interaktif'));
                const btnBuka = document.getElementById('btn-buka-contoh');
                const btnTutup = document.getElementById('btn-tutup-contoh');

                const toggleCard = (card) => {
                    card.classList.toggle('open');
                };

                cards.forEach((card) => {
                    card.addEventListener('click', () => toggleCard(card));
                    card.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter' || e.key === ' ') {
                            e.preventDefault();
                            toggleCard(card);
                        }
                    });
                });

                btnBuka?.addEventListener('click', () => {
                    cards.forEach(card => card.classList.add('open'));
                });

                btnTutup?.addEventListener('click', () => {
                    cards.forEach(card => card.classList.remove('open'));
                });

                if (typeof renderMathInElement === "function") {
                    renderMathInElement(wrap, {
                        delimiters: [
                            { left: '$$', right: '$$', display: true },
                            { left: '$', right: '$', display: false }
                        ]
                    });
                }
            })();
        </script>

        <script>
            (function () {
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
                    const A = new Set(a);
                    const B = new Set(b);

                    if (A.size !== B.size) return false;
                    for (const x of A) {
                        if (!B.has(x)) return false;
                    }
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
                    fb.textContent = ok ? (msgOk || "Benar ✅") : (msgNo || "Salah ❌");
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

                const materiLanjutan = document.getElementById("materi-lanjutan");
                const summary = document.getElementById("quiz-summary");
                let isUnlocked = false;

                const unlockMateri = () => {
                    if (!materiLanjutan || isUnlocked) return;

                    isUnlocked = true;
                    materiLanjutan.style.display = "block";

                    requestAnimationFrame(() => {
                        materiLanjutan.classList.add("show");
                    });
                };

                const lockMateri = () => {
                    if (!materiLanjutan) return;

                    isUnlocked = false;
                    materiLanjutan.classList.remove("show");
                    materiLanjutan.style.display = "none";
                };

                const checkItem = (item) => {
                    const type = item.getAttribute("data-type");
                    const valRaw = getInputValue(item);

                    if (!valRaw.trim()) {
                        clearFeedback(item);
                        return false;
                    }

                    if (type === "set") {
                        const expected = item.getAttribute("data-answer") || "";
                        const expTokens = splitTokens(expected);
                        const userTokens = splitTokens(valRaw);
                        const ok = setEqual(userTokens, expTokens);

                        showFeedback(item, ok, "Benar ✅", "Salah ❌");
                        return true; // tetap dianggap terjawab
                    }

                    if (type === "oneof") {
                        const expected = normalize(item.getAttribute("data-answer") || "");
                        const val = normalize(valRaw);
                        const ok = (val === expected) || val.startsWith(expected);

                        showFeedback(item, ok, "Benar ✅", "Salah ❌");
                        return true; // tetap dianggap terjawab
                    }

                    if (type === "yn") {
                        const expected = normalize(item.getAttribute("data-answer") || "ya");
                        const yn = toYN(valRaw);

                        if (!yn) {
                            showFeedback(item, false, "", "Gunakan ya / tidak ❌");
                            return true; // tetap dianggap terjawab karena input sudah diisi
                        }

                        const ok = (yn === expected);
                        showFeedback(item, ok, "Benar ✅", "Salah ❌");
                        return true; // tetap dianggap terjawab
                    }

                    showFeedback(item, false, "", "Tipe soal belum dikenali.");
                    return true;
                };

                const updateSummaryAndUnlock = () => {
                    const quiz = document.getElementById("eksplorasi-quiz");
                    if (!quiz) return;

                    const items = Array.from(quiz.querySelectorAll(".quiz-item"));
                    const total = items.length;

                    let filled = 0;

                    items.forEach(item => {
                        const val = getInputValue(item).trim();
                        if (val !== "") filled++;
                    });

                    if (summary) {
                        if (filled === 0) {
                            summary.textContent = "";
                        } else if (filled === total) {
                            summary.textContent = "Semua eksplorasi sudah dijawab ✅ Materi berikutnya sudah dibuka.";
                        } else {
                            summary.textContent = `Terjawab: ${filled}/${total}`;
                        }
                    }

                    if (filled === total) {
                        unlockMateri();
                    } else {
                        lockMateri();
                    }
                };

                const resetItem = (item) => {
                    const el = item.querySelector(".quiz-input");
                    if (el) el.value = "";
                    clearFeedback(item);
                    updateSummaryAndUnlock();
                };

                const quiz = document.getElementById("eksplorasi-quiz");
                if (quiz) {
                    quiz.querySelectorAll(".quiz-item").forEach(item => {
                        const input = item.querySelector(".quiz-input");
                        const btnReset = item.querySelector(".quiz-reset");

                        if (input) {
                            input.addEventListener("input", () => {
                                checkItem(item);
                                updateSummaryAndUnlock();
                            });

                            input.addEventListener("blur", () => {
                                checkItem(item);
                                updateSummaryAndUnlock();
                            });
                        }

                        if (btnReset) {
                            btnReset.addEventListener("click", () => resetItem(item));
                        }
                    });
                }
            })();
        </script>
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