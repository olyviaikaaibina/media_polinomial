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
                            });"></script>

    <style>
        :root {
            --green: #1b7a2a;
            --green-soft: #f2fbf4;

            --blue: #5b9bd5;
            --blue-soft: #f5f9ff;

            --orange: #e0702b;
            --orange-soft: #fff6f0;

            --text: #222;
            --muted: #555;

            --shadow: 0 10px 28px rgba(0, 0, 0, .05);
            --border: rgba(0, 0, 0, .06);

            --th-bg: #84d36b;
            --th-text: #0b3d1d;

            --def-bg: #F4C7B5;
            --def-pill: #8FC17E;
            --def-pill-border: #4FA24B;

            --latihan: #AAB99A;
            --latihan-soft: rgba(170, 185, 154, .14);
        }

        * {
            box-sizing: border-box;
        }

        .materi-wrap {
            max-width: 980px;
            margin: 0 auto;
            font-family: "Times New Roman", Times, serif;
            color: var(--text);
            line-height: 1.85;
            padding: 20px 14px 40px;
        }

        .top-title {
            display: flex;
            align-items: baseline;
            gap: 12px;
            margin-bottom: 12px;
        }

        .top-title .label {
            font-size: 26px;
            font-weight: 900;
            color: #000;
        }

        .top-title .judul {
            font-size: 30px;
            font-weight: 900;
            color: var(--green);
        }

        p {
            margin: 10px 0;
            text-align: justify;
            color: var(--muted);
            font-size: 16px;
            line-height: 1.95;
        }

        .lead-text {
            margin: 0 0 18px;
            color: var(--muted);
            font-size: 18px;
        }

        .card {
            border-radius: 16px;
            padding: 20px 22px;
            background: #fff;
            margin-bottom: 18px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }

        .card-eksplorasi {
            background: linear-gradient(180deg, var(--blue-soft), #fff);
            border-left: 7px solid var(--blue);
            border-radius: 14px;
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

        .title-box.blue {
            color: #1e3a8a;
        }

        .highlight {
            font-weight: 900;
            color: #111;
        }

        .rumus-box {
            margin: 14px 0;
            padding: 14px 16px;
            border-radius: 14px;
            background: rgba(255, 255, 255, .92);
            border: 1px solid rgba(0, 0, 0, .08);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            color: #111;
            overflow-x: auto;
        }

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
            margin-bottom: 8px;
            color: var(--text);
            font-weight: 700;
        }

        .quiz-input {
            width: 100%;
            max-width: 520px;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, .14);
            outline: none;
            font-family: "Times New Roman", Times, serif;
            font-size: 16px;
            background: #fff;
        }

        .quiz-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        .quiz-check,
        .quiz-reset,
        .quiz-checkall {
            padding: 10px 18px;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, .14);
            background: #fff;
            cursor: pointer;
            font-weight: 900;
            font-family: "Times New Roman", Times, serif;
        }

        .quiz-check:hover,
        .quiz-reset:hover,
        .quiz-checkall:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(0, 0, 0, .06);
            transition: .12s ease;
        }

        .quiz-feedback {
            font-weight: 900;
            padding: 8px 12px;
            border-radius: 12px;
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

        #after-eksplorasi[aria-hidden="true"] {
            display: none;
        }

        .gate-note {
            margin-top: 12px;
            padding: 12px 14px;
            border-radius: 14px;
            border: 1px solid rgba(224, 112, 43, .25);
            background: rgba(224, 112, 43, .08);
            color: #5a2a00;
            font-weight: 900;
        }

        .locked-overlay {
            margin-top: 16px;
            padding: 14px 16px;
            border-radius: 14px;
            border: 1px dashed rgba(30, 58, 138, .28);
            background: rgba(30, 58, 138, .05);
            color: #1e3a8a;
            font-weight: 900;
        }

        .trik-card {
            position: relative;
            overflow: hidden;
            border-radius: 22px;
            padding: 22px 22px 18px;
            background: linear-gradient(135deg, rgba(34, 197, 94, .18), rgba(59, 130, 246, .10), rgba(255, 255, 255, .72));
            border: 1px solid rgba(0, 0, 0, .10);
            box-shadow: 0 14px 34px rgba(0, 0, 0, .08);
            margin: 18px 0 18px;
            isolation: isolate;
        }

        .trik-card::before {
            content: "";
            position: absolute;
            width: 340px;
            height: 340px;
            left: -150px;
            top: -170px;
            background: radial-gradient(circle at 30% 30%, rgba(34, 197, 94, .55), rgba(34, 197, 94, 0));
            z-index: -1;
        }

        .trik-card::after {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            right: -220px;
            bottom: -260px;
            background: radial-gradient(circle at 60% 60%, rgba(59, 130, 246, .45), rgba(59, 130, 246, 0));
            z-index: -1;
        }

        .trik-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 10px;
            flex-wrap: wrap;
        }

        .trik-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            border-radius: 999px;
            background: rgba(255, 255, 255, .78);
            border: 1px solid rgba(0, 0, 0, .12);
            font-weight: 900;
            letter-spacing: .7px;
            color: #111;
            user-select: none;
        }

        .trik-badge .spark {
            width: 34px;
            height: 34px;
            border-radius: 999px;
            display: grid;
            place-items: center;
            background: rgba(241, 169, 138, .55);
            border: 1px solid rgba(0, 0, 0, .12);
            font-size: 16px;
        }

        .trik-mini {
            font-weight: 900;
            color: rgba(30, 58, 138, .95);
            background: rgba(255, 255, 255, .72);
            border: 1px solid rgba(30, 58, 138, .14);
            padding: 8px 12px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .trik-title {
            margin: 6px 0 12px;
            font-weight: 900;
            font-size: 22px;
            color: #0b3d1d;
            line-height: 1.35;
        }

        .trik-quote {
            margin: 0 0 12px;
            padding: 14px 14px;
            border-radius: 16px;
            background: rgba(255, 255, 255, .82);
            border: 1px solid rgba(0, 0, 0, .10);
            box-shadow: 0 10px 22px rgba(0, 0, 0, .04);
        }

        .trik-quote .big {
            font-weight: 900;
            font-size: 20px;
            color: #1e3a8a;
            text-align: center;
            margin: 0;
        }

        .trik-quote .sub {
            margin: 8px 0 0;
            text-align: center;
            color: #111;
            font-weight: 900;
            font-style: italic;
        }

        .trik-demo {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 12px;
        }

        .demo-box {
            background: rgba(255, 255, 255, .78);
            border: 1px solid rgba(0, 0, 0, .10);
            border-radius: 16px;
            padding: 14px 14px;
            box-shadow: 0 10px 22px rgba(0, 0, 0, .03);
        }

        .demo-label {
            font-weight: 900;
            color: #111;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .demo-eq {
            font-weight: 900;
            font-size: 18px;
            text-align: center;
            padding: 12px 10px;
            border-radius: 14px;
            border: 1px dashed rgba(0, 0, 0, .18);
            background: rgba(250, 252, 255, .9);
            user-select: none;
            overflow-x: auto;
        }

        .trik-actions {
            margin-top: 14px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        .trik-btn {
            padding: 10px 14px;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, .14);
            background: rgba(255, 255, 255, .85);
            cursor: pointer;
            font-weight: 900;
            font-family: "Times New Roman", Times, serif;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .trik-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(0, 0, 0, .06);
            transition: .12s ease;
        }

        .trik-note {
            font-weight: 900;
            color: rgba(0, 0, 0, .65);
        }

        .blink {
            animation: blinkPulse .6s ease;
        }

        @keyframes blinkPulse {
            0% {
                transform: scale(1);
                box-shadow: none;
            }

            50% {
                transform: scale(1.02);
                box-shadow: 0 14px 30px rgba(59, 130, 246, .18);
            }

            100% {
                transform: scale(1);
                box-shadow: none;
            }
        }

        .definisi-card {
            position: relative;
            margin: 26px 0 18px;
            padding: 26px 20px 18px;
            border-radius: 14px;
            background: var(--def-bg);
            border: 2px solid rgba(0, 0, 0, .08);
            box-shadow: 0 6px 18px rgba(0, 0, 0, .05);
        }

        .definisi-label {
            position: absolute;
            top: -18px;
            left: 18px;
            background: var(--def-pill);
            color: #000;
            font-weight: 900;
            padding: 8px 26px;
            border-radius: 999px;
            border: 2px solid var(--def-pill-border);
            font-size: 15px;
            letter-spacing: .5px;
        }

        .definisi-card p {
            margin: 6px 0 0;
            text-align: justify;
            font-size: 16px;
            line-height: 1.7;
            color: #374151;
            font-weight: 700;
        }

        .definisi-card ol {
            margin: 10px 0 0 18px;
            color: #374151;
            font-weight: 700;
        }

        .definisi-card li {
            margin: 8px 0;
        }

        .steps-title {
            font-weight: 900;
            color: var(--green);
            font-size: 20px;
            margin: 0 0 10px;
        }

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

        .table-wrap {
            margin-top: 14px;
            overflow-x: auto;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, .10);
            box-shadow: 0 10px 28px rgba(0, 0, 0, .04);
            background: #fff;
        }

        table.materi-table {
            width: 100%;
            min-width: 740px;
            border-collapse: collapse;
            background: #fff;
        }

        .materi-table th {
            background: var(--th-bg);
            color: var(--th-text);
            padding: 10px 12px;
            border: 1px solid rgba(0, 0, 0, .18);
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

        .hasil-input {
            width: 100%;
            max-width: 220px;
            padding: 10px 12px;
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
            font-weight: 900;
            font-family: "Times New Roman", Times, serif;
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

        .sehingga-box {
            margin-top: 14px;
            border: 2px solid rgba(27, 122, 42, .35);
            border-radius: 14px;
            padding: 14px 16px;
            background: rgba(255, 255, 255, .65);
            display: none;
        }

        .latihan-card {
            border: 1px solid rgba(0, 0, 0, .08);
            background: linear-gradient(180deg, var(--latihan-soft), #fff);
            border-left: 7px solid var(--latihan);
        }

        .latihan-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 900;
            color: #111;
            margin-bottom: 12px;
        }

        .latihan-title .pill {
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(170, 185, 154, .22);
            border: 1px solid rgba(170, 185, 154, .50);
            font-weight: 900;
        }

        #p5-latihan-2b {
            width: 100%;
            min-height: 720px;
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, .10);
            background: #fff;
        }

        .btn-nav.disabled-nav {
            opacity: .45;
            cursor: not-allowed;
            filter: grayscale(.2);
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

            .trik-demo {
                grid-template-columns: 1fr;
            }

            #p5-latihan-2b {
                min-height: 820px;
            }
        }
    </style>

    <div class="materi-wrap">

        {{-- JUDUL --}}
        <div class="top-title">
            <div class="label">2.</div>
            <div class="judul">Pengurangan Polinomial</div>
        </div>

        <p class="lead-text">
            Pengurangan polinomial pada dasarnya mirip dengan penjumlahan, hanya saja kita
            mengurangkan polinomial kedua dari polinomial pertama.
        </p>

        {{-- =========================
        EKSPLORASI
        ========================== --}}
        <div class="card card-eksplorasi">
            <div class="title-box blue">🧭 Eksplorasi</div>

            <p>
                Banjarmasin dikenal sebagai <b>Kota Seribu Sungai</b>. Kehidupan masyarakatnya sangat dekat dengan sungai
                seperti
                Sungai Martapura, Sungai Barito, dan Pasar Terapung.
            </p>

            <p>
                Untuk menjaga kebersihan sungai, pemerintah kota melaksanakan program <b>pembersihan sungai</b> yang
                melibatkan
                <b>dua tim kerja</b>.
            </p>

            <p><b>Misalkan:</b><br>
                • <span class="highlight">$x$</span> menyatakan <span class="highlight">jumlah hari kerja</span>
            </p>

            <p style="margin-bottom:6px;"><b>Tim A</b> membersihkan sampah dengan model:</p>
            <div class="rumus-box">$$T(x)=5x^3-2x^2+4x+6$$</div>

            <p style="margin-bottom:6px;"><b>Tim B</b> membersihkan sampah dengan model:</p>
            <div class="rumus-box">$$U(x)=3x^3+x^2-2x-5$$</div>

            <p>
                Karena sebagian wilayah yang dibersihkan oleh Tim B merupakan wilayah yang sudah dibersihkan oleh Tim A,
                maka kita ingin mengetahui <b>selisih area pembersihan</b> kedua tim.
            </p>

            <p>Hal ini dapat dimodelkan dengan pengurangan polinomial:</p>
            <div class="rumus-box" style="margin-top:8px;">$$T(x)-U(x)$$</div>

            <div class="question" id="eksplorasi-quiz">
                <div class="qtitle">Pertanyaan (Interaktif)</div>

                <ol class="quiz-list">
                    <li class="quiz-item" data-type="oneof" data-answer="13">
                        <div class="quiz-q">Jika $x=1$ (hari kerja ke-1), berapa nilai $T(1)$?</div>
                        <input class="quiz-input" type="text" placeholder="Jawaban kamu..." />
                        <div class="quiz-actions">
                            <button type="button" class="quiz-check">Cek</button>
                            <button type="button" class="quiz-reset">Reset</button>
                            <span class="quiz-feedback"></span>
                        </div>
                    </li>

                    <li class="quiz-item" data-type="oneof" data-answer="-3">
                        <div class="quiz-q">Jika $x=1$ (hari kerja ke-1), berapa nilai $U(1)$?</div>
                        <input class="quiz-input" type="text" placeholder="Jawaban kamu..." />
                        <div class="quiz-actions">
                            <button type="button" class="quiz-check">Cek</button>
                            <button type="button" class="quiz-reset">Reset</button>
                            <span class="quiz-feedback"></span>
                        </div>
                    </li>

                    <li class="quiz-item">
                        <div class="quiz-q">
                            Tentukan bentuk pengurangan polinomial berikut:
                            <div style="margin-top:8px;">
                                $$(5x^3-2x^2+4x+6)-(3x^3+x^2-2x-5)$$
                            </div>
                            <small style="display:block; margin-top:6px; color:#6b7280; font-weight:700;">
                                (Boleh ketik ulang ekspresi atau tulis hasil sederhananya)
                            </small>
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

                <div id="gate-note" class="gate-note">
                    ⚠️ Selesaikan dulu 3 soal eksplorasi sampai benar semua (Skor 3/3).
                    Setelah itu materi berikutnya akan muncul otomatis.
                </div>
            </div>
        </div>

        {{-- LOCKED CONTENT --}}
        <div id="after-eksplorasi" aria-hidden="true">
            <div class="trik-card" id="trikCard">
                <div class="trik-header">
                    <div class="trik-badge">
                        <span class="spark">✨</span>
                        <span>TRIK CEPAT</span>
                    </div>
                    <div class="trik-mini">
                        <span>🧠</span>
                        <span>Ingat pola tanda</span>
                    </div>
                </div>

                <div class="trik-title">Cara paling cepat saat ada “minus di depan kurung”</div>

                <div class="trik-quote">
                    <p class="big">“MINUS DI DEPAN KURUNG → BALIK SEMUA TANDA”</p>
                    <p class="sub">(+ jadi −, dan − jadi +)</p>
                </div>

                <div class="trik-demo">
                    <div class="demo-box">
                        <div class="demo-label">✅ Sebelum</div>
                        <div class="demo-eq">$$A(x)-(B(x)-C(x))$$</div>
                    </div>
                    <div class="demo-box">
                        <div class="demo-label">✅ Setelah kurung dibuka</div>
                        <div class="demo-eq">$$A(x)-B(x)+C(x)$$</div>
                    </div>
                </div>

                <div class="trik-actions">
                    <button type="button" class="trik-btn" id="trikBlinkBtn">🔔 Tekan untuk ingat</button>
                    <span class="trik-note">Tip: balik semua tanda di dalam kurung, lalu gabungkan suku sejenis.</span>
                </div>
            </div>

            <div class="definisi-card">
                <div class="definisi-label">DEFINISI</div>
                <p><b>Pengurangan polinomial</b> adalah operasi antara dua polinomial dengan cara:</p>
                <ol>
                    <li>Mengubah tanda setiap suku pada polinomial kedua (yang dikurangkan).</li>
                    <li>Menjumlahkan suku-suku sejenis dari kedua polinomial tersebut.</li>
                </ol>
            </div>

            <div class="card">
                <div class="steps-title">Langkah-Langkah Pengurangan Polinomial</div>
                <ol style="margin:0 0 0 18px;">
                    <li>Tuliskan polinomial dalam bentuk yang terurut (misalnya dari pangkat tertinggi ke terendah).</li>
                    <li>Beri tanda kurung pada polinomial yang dikurangkan.</li>
                    <li>Hilangkan kurung dengan mengubah tanda setiap suku di dalam kurung tersebut.</li>
                    <li>Gabungkan suku-suku sejenis dengan menjumlahkan koefisiennya.</li>
                    <li>Tulis hasil dalam bentuk polinomial yang sudah disederhanakan.</li>
                </ol>
            </div>

            <div class="card">
                <div class="contoh-badge">CONTOH</div>

                <div class="contoh-box" id="contoh-interaktif">
                    <div class="contoh-row-title">Hitunglah hasil dari:</div>
                    <div class="rumus-box" style="margin-top:8px;">
                        $$(6x^3-4x+2)-(2x^3+5x-7)$$
                    </div>

                    <div class="contoh-row-title" style="margin-top:12px;">
                        Penyelesaian: balik tanda di polinomial kedua, lalu kelompokkan suku sejenis
                    </div>

                    <div class="table-wrap">
                        <table class="materi-table">
                            <thead>
                                <tr>
                                    <th>Suku Sejenis</th>
                                    <th>Operasi</th>
                                    <th>Hasil (Isi)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="contoh-item" data-answer="4x^3" data-canonical="4x^3" data-latex="4x^3">
                                    <td>$(6x^3-2x^3)$</td>
                                    <td>$(6-2)x^3$</td>
                                    <td>
                                        <input class="hasil-input" type="text" />
                                        <div class="katex-answer" aria-hidden="true"></div>
                                        <div class="mini-actions">
                                            <button type="button" class="mini-btn contoh-check">Cek</button>
                                            <button type="button" class="mini-btn contoh-reset">Reset</button>
                                            <span class="mini-feedback"></span>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="contoh-item" data-answer="-9x" data-canonical="-9x" data-latex="-9x">
                                    <td>$(-4x-5x)$</td>
                                    <td>$(-4-5)x$</td>
                                    <td>
                                        <input class="hasil-input" type="text" />
                                        <div class="katex-answer" aria-hidden="true"></div>
                                        <div class="mini-actions">
                                            <button type="button" class="mini-btn contoh-check">Cek</button>
                                            <button type="button" class="mini-btn contoh-reset">Reset</button>
                                            <span class="mini-feedback"></span>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="contoh-item" data-answer="9" data-canonical="9" data-latex="9">
                                    <td>$(2+7)$</td>
                                    <td>$(2+7)$</td>
                                    <td>
                                        <input class="hasil-input" type="text" />
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
                            <input id="contoh-final" class="hasil-input" style="max-width:420px; text-align:left;"
                                type="text" />
                            <button type="button" id="contoh-final-check" class="mini-btn">Cek</button>
                            <button type="button" id="contoh-final-reset" class="mini-btn">Reset</button>
                            <span id="contoh-final-fb" class="mini-feedback"></span>
                        </div>

                        <div class="mini-actions" style="justify-content:flex-start; margin-top:8px;">
                            <button type="button" id="contoh-check-all" class="mini-btn">Cek Semua</button>
                            <span id="contoh-summary" style="font-weight:900; color:#1e3a8a;"></span>
                        </div>
                    </div>

                    <div class="sehingga-box" id="sehingga-box">
                        <div class="contoh-row-title" style="margin-top:0;">Sehingga:</div>
                        <div class="rumus-box" style="margin-top:10px;">
                            $$\begin{aligned}
                            &\ \ \ 6x^3-4x+2\\
                            &-\, (2x^3+5x-7)\\
                            \hline
                            &\ \ \ 4x^3-9x+9
                            \end{aligned}$$
                        </div>
                    </div>
                </div>
            </div>

            <div class="card latihan-card">
                <div class="latihan-title">
                    <span class="pill">LATIHAN</span>
                </div>

                <div id="p5-latihan-2b"></div>

                <p style="margin-top:12px; color:#6b7280; font-weight:700;">
                    Catatan: format jawaban contoh: <b>7x^2-7x+12</b>
                </p>
            </div>
        </div>

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
                    return s;
                };

                const setFb = (el, ok) => {
                    if (!el) return;
                    el.classList.remove("ok", "no");
                    el.classList.add(ok ? "ok" : "no");
                    el.textContent = ok ? "Benar ✅" : "Belum tepat ❌";
                };

                // =========================
                // QUIZ (TANPA LOCK)
                // =========================
                const quiz = document.getElementById("eksplorasi-quiz");

                if (quiz) {
                    const items = Array.from(quiz.querySelectorAll(".quiz-item"));

                    const checkItem = (item) => {
                        const qIndex = items.indexOf(item);
                        const val = normalizePolyX(item.querySelector(".quiz-input").value);

                        if (qIndex === 2) {
                            const simp = normalizePolyX("2x^3-3x^2+6x+11");
                            const ok = val === simp;
                            setFb(item.querySelector(".quiz-feedback"), ok);
                            return ok;
                        }

                        const expected = normalize(item.getAttribute("data-answer") || "");
                        const ok = normalize(val) === expected;
                        setFb(item.querySelector(".quiz-feedback"), ok);
                        return ok;
                    };

                    items.forEach(item => {
                        const btnCheck = item.querySelector(".quiz-check");
                        const input = item.querySelector(".quiz-input");

                        if (btnCheck) {
                            btnCheck.addEventListener("click", () => {
                                checkItem(item);
                            });
                        }

                        if (input) {
                            input.addEventListener("keydown", (e) => {
                                if (e.key === "Enter") {
                                    e.preventDefault();
                                    checkItem(item);
                                }
                            });
                        }
                    });
                }

                // =========================
                // TRIK ANIMASI
                // =========================
                const trikCard = document.getElementById("trikCard");
                const trikBtn = document.getElementById("trikBlinkBtn");

                if (trikCard && trikBtn) {
                    trikBtn.addEventListener("click", () => {
                        trikCard.classList.remove("blink");
                        void trikCard.offsetWidth;
                        trikCard.classList.add("blink");
                    });
                }

            })();
        </script>

        <script src="https://cdn.jsdelivr.net/npm/p5@1.11.1/lib/p5.min.js"></script>
        <script src="{{ asset('js/interaktif2b.js') }}"></script>

    </div>
@endsection


@section('nav')
<div class="nav-wrap" style="margin-top:40px; display:flex; justify-content:space-between;">

    <a href="{{ route('penjumlahanpolinomial') }}" class="btn-nav prev-btn">
        ← Previous
    </a>

    <a href="{{ route('perkalianpolinomial') }}" class="btn-nav next-btn">
        Next →
    </a>

</div>
@endsection
