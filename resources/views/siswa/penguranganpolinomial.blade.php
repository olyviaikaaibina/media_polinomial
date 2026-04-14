@extends('layout.halamanmateri')

@section('content')
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
            --green-2: #2f8f46;
            --blue: #5b9bd5;
            --blue-soft: #f5f9ff;
            --text: #222;
            --muted: #555;
            --shadow: 0 10px 28px rgba(0, 0, 0, .05);
            --border: rgba(0, 0, 0, .06);
            --warning-bg: #f7e7df;
            --warning-border: #ebc8b8;
            --warning-text: #7a4b2f;
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

        .quiz-input,
        .interaktif-input,
        .latihan-input {
            width: 100%;
            max-width: 560px;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, .14);
            outline: none;
            font-family: "Times New Roman", Times, serif;
            font-size: 16px;
            background: #fff;
        }

        .quiz-actions,
        .interaktif-actions,
        .global-actions,
        .latihan-actions,
        .latihan-global-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        .quiz-check,
        .quiz-reset,
        .quiz-checkall,
        .tip-btn,
        .tip-remember-btn,
        .interaktif-check,
        .interaktif-reset,
        .interaktif-checkall,
        .latihan-check,
        .latihan-reset,
        .latihan-checkall {
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
        .quiz-checkall:hover,
        .tip-btn:hover,
        .tip-remember-btn:hover,
        .interaktif-check:hover,
        .interaktif-reset:hover,
        .interaktif-checkall:hover,
        .latihan-check:hover,
        .latihan-reset:hover,
        .latihan-checkall:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(0, 0, 0, .06);
            transition: .12s ease;
        }

        .quiz-feedback,
        .interaktif-feedback,
        .latihan-feedback {
            font-weight: 900;
            padding: 8px 12px;
            border-radius: 12px;
            display: inline-block;
        }

        .quiz-feedback.ok,
        .interaktif-feedback.ok,
        .latihan-feedback.ok {
            color: #0f5f22;
            background: rgba(27, 122, 42, .10);
            border: 1px solid rgba(27, 122, 42, .18);
        }

        .quiz-feedback.no,
        .interaktif-feedback.no,
        .latihan-feedback.no {
            color: #8c2b00;
            background: rgba(224, 112, 43, .10);
            border: 1px solid rgba(224, 112, 43, .18);
        }

        .quiz-summary,
        .interaktif-summary,
        .latihan-summary {
            margin-left: 10px;
            font-weight: 900;
            color: #1e3a8a;
        }

        .final-message {
            margin-top: 14px;
            padding: 12px 14px;
            border-radius: 12px;
            display: none;
            font-weight: 700;
        }

        .final-message.ok {
            display: block;
            background: var(--warning-bg);
            border: 1px solid var(--warning-border);
            color: var(--warning-text);
        }

        .tip-board {
            margin: 20px 0 24px;
            border-radius: 22px;
            padding: 20px 22px 18px;
            border: 1px solid rgba(27, 122, 42, .10);
            background: linear-gradient(135deg, #d8f4df 0%, #dfe9fb 100%);
            box-shadow: 0 10px 24px rgba(76, 110, 79, .08);
        }

        .tip-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 12px;
        }

        .tip-label {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 18px;
            border-radius: 999px;
            background: #f4f1e8;
            border: 1px solid rgba(0, 0, 0, .08);
            font-weight: 900;
            font-size: 16px;
            color: #1f1f1f;
            box-shadow: 0 4px 10px rgba(0, 0, 0, .04);
        }

        .tip-btn,
        .tip-remember-btn {
            background: #f8f6f0;
            color: #344b8e;
        }

        .tip-main-title {
            font-size: 20px;
            font-weight: 900;
            color: #184b26;
            margin-bottom: 14px;
        }

        .tip-main-quote-box {
            background: rgba(255, 255, 255, .88);
            border: 1px solid rgba(0, 0, 0, .08);
            border-radius: 18px;
            padding: 18px 20px;
            text-align: center;
            margin-bottom: 14px;
        }

        .tip-main-quote {
            font-size: 20px;
            font-weight: 900;
            color: #314f9a;
            margin-bottom: 6px;
        }

        .tip-main-sub {
            font-size: 16px;
            font-weight: 700;
            color: #222;
        }

        .tip-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 14px;
        }

        .tip-example-card {
            background: rgba(255, 255, 255, .9);
            border: 1px solid rgba(0, 0, 0, .08);
            border-radius: 16px;
            padding: 14px;
        }

        .tip-example-title {
            font-size: 16px;
            font-weight: 900;
            color: #1f1f1f;
            margin-bottom: 8px;
        }

        .tip-formula-box {
            min-height: 84px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            border: 1px dashed rgba(0, 0, 0, .12);
            border-radius: 14px;
            padding: 12px;
            overflow-x: auto;
        }

        .tip-footer {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .tip-footer-text {
            color: #555;
            font-size: 16px;
            font-weight: 700;
        }

        .tip-flash {
            animation: tipFlash .6s ease;
        }

        @keyframes tipFlash {
            0% { transform: scale(1); }
            50% { transform: scale(1.01); box-shadow: 0 14px 26px rgba(76, 110, 79, .14); }
            100% { transform: scale(1); }
        }

        .definisi-card {
            position: relative;
            margin: 26px 0 18px;
            padding: 26px 20px 18px;
            border-radius: 14px;
            background: #f4c7b5;
            border: 2px solid rgba(0, 0, 0, .08);
            box-shadow: 0 6px 18px rgba(0, 0, 0, .05);
        }

        .definisi-label {
            position: absolute;
            top: -18px;
            left: 18px;
            background: #8fc17e;
            color: #000;
            font-weight: 900;
            padding: 8px 26px;
            border-radius: 999px;
            border: 2px solid #4fa24b;
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

        .langkah-card {
            border-radius: 18px;
            padding: 24px 22px 18px;
            background: #ffffff;
            margin-bottom: 18px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(0, 0, 0, .06);
        }

        .langkah-title {
            font-size: 20px;
            font-weight: 900;
            color: #2f8f46;
            margin-bottom: 12px;
        }

        .langkah-list {
            margin: 0 0 0 18px;
            color: #444;
            font-size: 16px;
            line-height: 1.95;
        }

        .langkah-list li {
            margin: 6px 0;
        }

        .contoh-wrap {
            border-radius: 18px;
            padding: 24px 22px 18px;
            background: linear-gradient(180deg, #fbfcf8, #ffffff);
            margin-bottom: 18px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(0, 0, 0, .08);
            border-left: 6px solid #aab99a;
        }

        .contoh-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 18px;
            border-radius: 999px;
            background: #e7e9e1;
            border: 1px solid rgba(0, 0, 0, .10);
            font-weight: 900;
            color: #1f1f1f;
            box-shadow: 0 4px 10px rgba(0, 0, 0, .04);
            margin-bottom: 14px;
        }

        .contoh-desc {
            font-size: 16px;
            color: #555;
            margin-bottom: 12px;
        }

        .step-box {
            background: #fff;
            border: 1px solid rgba(0, 0, 0, .08);
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 14px;
        }

        .step-title {
            font-weight: 900;
            color: #111;
            margin-bottom: 8px;
            font-size: 17px;
        }

        .step-question {
            margin: 10px 0 6px;
            font-size: 16px;
            font-weight: 900;
            color: #1f4f29;
        }

        .step-help {
            margin: 6px 0 0;
            font-size: 15px;
            color: #6b7280;
            font-style: italic;
        }

        .step-explain {
            color: #4b5563;
            margin: 8px 0 0;
            font-size: 15px;
            line-height: 1.85;
        }

        .interaktif-wrap {
            margin-top: 8px;
            background: rgba(91, 155, 213, .06);
            border: 1px solid rgba(91, 155, 213, .18);
            border-radius: 14px;
            padding: 14px;
        }

        .interaktif-title {
            font-weight: 900;
            color: #1e3a8a;
            margin-bottom: 8px;
        }

        .latihan-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
            margin-top: 14px;
        }

        .latihan-card {
            background: #fff;
            border: 1px solid rgba(0, 0, 0, .08);
            border-radius: 18px;
            padding: 18px 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .04);
        }

        .latihan-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 42px;
            height: 42px;
            padding: 0 14px;
            border-radius: 999px;
            background: #eef4e5;
            border: 1px solid rgba(0, 0, 0, .08);
            font-weight: 900;
            color: #2f8f46;
            margin-bottom: 10px;
            font-size: 18px;
        }

        .latihan-title {
            font-weight: 900;
            color: #111;
            font-size: 18px;
            margin-bottom: 8px;
        }

        .latihan-step-box {
            background: #f9fbf7;
            border: 1px solid rgba(0, 0, 0, .06);
            border-radius: 14px;
            padding: 14px;
            margin-top: 12px;
        }

        .latihan-step-title {
            font-weight: 900;
            color: #1f4f29;
            margin-bottom: 6px;
        }

        .latihan-step-help {
            margin: 6px 0 10px;
            font-size: 14px;
            color: #6b7280;
            font-style: italic;
            line-height: 1.7;
        }

        @media (max-width: 768px) {
            .tip-grid,
            .latihan-grid {
                grid-template-columns: 1fr;
            }

            .tip-main-quote {
                font-size: 17px;
            }

            .tip-main-title,
            .langkah-title {
                font-size: 18px;
            }
        }

        @media (max-width: 640px) {
            .top-title .judul {
                font-size: 24px;
            }

            .top-title .label {
                font-size: 22px;
            }

            .card,
            .langkah-card,
            .contoh-wrap {
                padding: 16px;
            }

            .lead-text {
                font-size: 16px;
            }
        }
    </style>

    <div class="materi-wrap">
        <div class="top-title">
            <div class="label">2.</div>
            <div class="judul">Pengurangan Polinomial</div>
        </div>

        <p class="lead-text">
            Pengurangan polinomial pada dasarnya mirip dengan penjumlahan, hanya saja kita
            mengurangkan polinomial kedua dari polinomial pertama.
        </p>

        {{-- EKSPLORASI --}}
        <div class="card card-eksplorasi">
            <div class="title-box blue">🧭 Eksplorasi</div>

            <p>
                Banjarmasin dikenal sebagai <b>Kota Seribu Sungai</b>. Kehidupan masyarakatnya sangat dekat dengan sungai
                seperti Sungai Martapura, Sungai Barito, dan Pasar Terapung.
            </p>

            <p>
                Untuk menjaga kebersihan sungai, pemerintah kota melaksanakan program
                <b>pembersihan sungai</b> yang melibatkan <b>dua tim kerja</b>.
            </p>

            <p>
                <b>Misalkan:</b><br>
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
            <div class="rumus-box">$$T(x)-U(x)$$</div>

            <div class="question" id="eksplorasi-quiz">
                <div class="qtitle">Pertanyaan (Interaktif)</div>

                <ol class="quiz-list">
                    <li class="quiz-item" data-answer="13">
                        <div class="quiz-q">1. Jika $x=1$ (hari kerja ke-1), berapa nilai $T(1)$?</div>
                        <input class="quiz-input" type="text" placeholder="Isi jawaban" />
                        <div class="quiz-actions">
                            <button type="button" class="quiz-check">Cek</button>
                            <button type="button" class="quiz-reset">Reset</button>
                            <span class="quiz-feedback"></span>
                        </div>
                    </li>

                    <li class="quiz-item" data-answer="-3">
                        <div class="quiz-q">2. Jika $x=1$ (hari kerja ke-1), berapa nilai $U(1)$?</div>
                        <input class="quiz-input" type="text" placeholder="Isi jawaban" />
                        <div class="quiz-actions">
                            <button type="button" class="quiz-check">Cek</button>
                            <button type="button" class="quiz-reset">Reset</button>
                            <span class="quiz-feedback"></span>
                        </div>
                    </li>

                    <li class="quiz-item" data-answer="2x^3-3x^2+6x+11">
                        <div class="quiz-q">
                            3. Tentukan bentuk pengurangan polinomial berikut:
                            <div style="margin-top:8px;">$$(5x^3-2x^2+4x+6)-(3x^3+x^2-2x-5)$$</div>
                        </div>
                        <input class="quiz-input" type="text" placeholder="Isi jawaban" />
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

                <div id="quiz-final-message" class="final-message">
                    ✅ Semua jawaban benar. Materi berikutnya sudah terbuka.
                </div>
            </div>
        </div>

        {{-- TRIK CEPAT --}}
        <div class="tip-board" id="tipBoard">
            <div class="tip-head">
                <div class="tip-label">🧭 TRIK CEPAT</div>
                <button type="button" class="tip-btn" id="tipFlashBtn">🧠 Ingat pola tanda</button>
            </div>

            <div class="tip-main-title">
                Cara paling cepat saat ada “minus di depan kurung”
            </div>

            <div class="tip-main-quote-box">
                <div class="tip-main-quote">
                    “MINUS DI DEPAN KURUNG → BALIK SEMUA TANDA”
                </div>
                <div class="tip-main-sub">
                    (+ jadi −, dan − jadi +)
                </div>
            </div>

            <div class="tip-grid">
                <div class="tip-example-card">
                    <div class="tip-example-title">✅ Sebelum</div>
                    <div class="tip-formula-box">
                        $$A(x) - (B(x) - C(x))$$
                    </div>
                </div>

                <div class="tip-example-card">
                    <div class="tip-example-title">✅ Setelah kurung dibuka</div>
                    <div class="tip-formula-box">
                        $$A(x) - B(x) + C(x)$$
                    </div>
                </div>
            </div>

            <div class="tip-footer">
                <button type="button" class="tip-remember-btn">🔔 Tekan untuk ingat</button>
                <div class="tip-footer-text">
                    <b>Tip:</b> balik semua tanda di dalam kurung, lalu gabungkan suku sejenis.
                </div>
            </div>
        </div>

        {{-- DEFINISI --}}
        <div class="definisi-card">
            <div class="definisi-label">DEFINISI</div>
            <p>Pengurangan polinomial adalah operasi antara dua polinomial dengan cara:</p>
            <ol>
                <li>Mengubah tanda setiap suku pada polinomial kedua.</li>
                <li>Menjumlahkan suku-suku sejenis dari kedua polinomial tersebut.</li>
            </ol>
        </div>

        {{-- LANGKAH-LANGKAH --}}
        <div class="langkah-card">
            <div class="langkah-title">Langkah-Langkah Pengurangan Polinomial</div>
            <ol class="langkah-list">
                <li>Tuliskan polinomial dalam bentuk yang terurut.</li>
                <li>Beri tanda kurung pada polinomial yang dikurangkan.</li>
                <li>Hilangkan kurung dengan mengubah tanda setiap suku di dalam kurung tersebut.</li>
                <li>Gabungkan suku-suku sejenis dengan menjumlahkan koefisiennya.</li>
                <li>Tulis hasil dalam bentuk polinomial yang sudah disederhanakan.</li>
            </ol>
        </div>

        {{-- CONTOH --}}
        <div class="contoh-wrap">
            <div class="contoh-pill">CONTOH</div>

            <p class="contoh-desc">
                Kerjakan contoh ini tahap demi tahap. Jawab pertanyaannya satu per satu. Jawaban tidak ditampilkan agar
                kamu bisa berpikir sendiri.
            </p>

            <div class="rumus-box">
                $$(5x^3-2x^2+4x+6)-(3x^3+x^2-2x-5)$$
            </div>

            <div class="step-box">
                <div class="step-title">Langkah 1: Perhatikan bentuk pengurangannya</div>
                <p class="step-explain">
                    Pada soal ini, polinomial kedua berada setelah tanda minus. Karena ada tanda
                    <b>minus di depan kurung</b>, semua tanda di dalam kurung kedua harus berubah saat kurung dibuka.
                </p>

                <div class="step-question">
                    Pertanyaan: setelah kurung kedua dibuka, bagaimana bentuk lengkap soalnya?
                </div>
                <p class="step-help">
                    Petunjuk: tanda $+$ di dalam kurung menjadi $-$, dan tanda $-$ di dalam kurung menjadi $+$.
                </p>

                <div class="interaktif-wrap" data-answer="5x^3-2x^2+4x+6-3x^3-x^2+2x+5">
                    <div class="interaktif-title">Tulis bentuk setelah kurung dibuka</div>
                    <input type="text" class="interaktif-input" placeholder="Contoh penulisan: 5x^3-2x^2+..." />
                    <div class="interaktif-actions">
                        <button type="button" class="interaktif-check">Cek</button>
                        <button type="button" class="interaktif-reset">Reset</button>
                        <span class="interaktif-feedback"></span>
                    </div>
                </div>
            </div>

            <div class="step-box">
                <div class="step-title">Langkah 2: Cari suku-suku yang sejenis</div>
                <p class="step-explain">
                    Setelah kurung dibuka, suku-suku yang memiliki variabel dan pangkat yang sama harus dikelompokkan.
                    Jadi, suku $x^3$ digabung dengan $x^3$, suku $x^2$ digabung dengan $x^2$, suku $x$ digabung
                    dengan $x$, dan bilangan tetap digabung dengan bilangan tetap.
                </p>

                <div class="step-question">
                    Pertanyaan: bagaimana bentuk soal jika semua suku sejenis sudah dikelompokkan?
                </div>
                <p class="step-help">
                    Petunjuk: gunakan tanda kurung untuk menunjukkan kelompok suku sejenis.
                </p>

                <div class="interaktif-wrap" data-answer="(5x^3-3x^3)+(-2x^2-x^2)+(4x+2x)+(6+5)">
                    <div class="interaktif-title">Tulis bentuk yang sudah dikelompokkan</div>
                    <input type="text" class="interaktif-input" placeholder="Contoh: ( ... ) + ( ... ) + ..." />
                    <div class="interaktif-actions">
                        <button type="button" class="interaktif-check">Cek</button>
                        <button type="button" class="interaktif-reset">Reset</button>
                        <span class="interaktif-feedback"></span>
                    </div>
                </div>
            </div>

            <div class="step-box">
                <div class="step-title">Langkah 3: Hitung setiap kelompok</div>
                <p class="step-explain">
                    Sekarang hitung hasil setiap kelompok:
                    <br>• kelompok suku $x^3$
                    <br>• kelompok suku $x^2$
                    <br>• kelompok suku $x$
                    <br>• kelompok konstanta
                </p>

                <div class="step-question">
                    Pertanyaan: setelah setiap kelompok dihitung, apa hasil akhir pengurangan polinomial tersebut?
                </div>
                <p class="step-help">
                    Petunjuk: tulis hasil akhir dalam bentuk polinomial yang sudah sederhana dan terurut.
                </p>

                <div class="interaktif-wrap" data-answer="2x^3-3x^2+6x+11">
                    <div class="interaktif-title">Tulis hasil akhir</div>
                    <input type="text" class="interaktif-input" placeholder="Tulis hasil polinomial akhirnya" />
                    <div class="interaktif-actions">
                        <button type="button" class="interaktif-check">Cek</button>
                        <button type="button" class="interaktif-reset">Reset</button>
                        <span class="interaktif-feedback"></span>
                    </div>
                </div>
            </div>

            <div class="global-actions">
                <button type="button" id="interaktif-check-all" class="interaktif-checkall">Cek Semua</button>
                <span id="interaktif-summary" class="interaktif-summary"></span>
            </div>

            <div id="interaktif-final-message" class="final-message">
                ✅ Bagus! Kamu sudah menyelesaikan contoh ini langkah demi langkah.
            </div>
        </div>

        {{-- LATIHAN --}}
        <div class="contoh-wrap">
            <div class="contoh-pill">LATIHAN</div>

            <p class="contoh-desc">
                Kerjakan latihan berikut langkah demi langkah. Isi jawaban pada setiap tahap, lalu cek hasilnya.
            </p>

            <div class="latihan-grid" id="latihan-grid">
                {{-- LATIHAN A --}}
                <div class="latihan-card">
                    <div class="latihan-badge">A</div>
                    <div class="latihan-title">Tentukan hasil dari:</div>
                    <div class="rumus-box">
                        $$(9x^2 - 4x + 7) - (2x^2 + 3x - 5)$$
                    </div>

                    <div class="latihan-step-box latihan-step-item" data-answer="9x^2-4x+7-2x^2-3x+5">
                        <div class="latihan-step-title">Langkah 1: Buka kurung</div>
                        <div class="latihan-step-help">
                            Ubah semua tanda pada polinomial kedua karena ada minus di depan kurung.
                        </div>
                        <input type="text" class="latihan-input" placeholder="Contoh: 9x^2-4x+7-2x^2-3x+5">
                        <div class="latihan-actions">
                            <button type="button" class="latihan-check">Cek</button>
                            <button type="button" class="latihan-reset">Reset</button>
                            <span class="latihan-feedback"></span>
                        </div>
                    </div>

                    <div class="latihan-step-box latihan-step-item" data-answer="(9x^2-2x^2)+(-4x-3x)+(7+5)">
                        <div class="latihan-step-title">Langkah 2: Kelompokkan suku sejenis</div>
                        <div class="latihan-step-help">
                            Gabungkan suku $x^2$ dengan $x^2$, suku $x$ dengan $x$, dan konstanta dengan konstanta.
                        </div>
                        <input type="text" class="latihan-input" placeholder="Contoh: (9x^2-2x^2)+(-4x-3x)+(7+5)">
                        <div class="latihan-actions">
                            <button type="button" class="latihan-check">Cek</button>
                            <button type="button" class="latihan-reset">Reset</button>
                            <span class="latihan-feedback"></span>
                        </div>
                    </div>

                    <div class="latihan-step-box latihan-step-item" data-answer="7x^2-7x+12">
                        <div class="latihan-step-title">Langkah 3: Tulis hasil akhir</div>
                        <div class="latihan-step-help">
                            Hitung tiap kelompok, lalu tulis hasil polinomial akhirnya.
                        </div>
                        <input type="text" class="latihan-input" placeholder="Contoh: 7x^2-7x+12">
                        <div class="latihan-actions">
                            <button type="button" class="latihan-check">Cek</button>
                            <button type="button" class="latihan-reset">Reset</button>
                            <span class="latihan-feedback"></span>
                        </div>
                    </div>
                </div>

                {{-- LATIHAN B --}}
                <div class="latihan-card">
                    <div class="latihan-badge">B</div>
                    <div class="latihan-title">Tentukan hasil dari:</div>
                    <div class="rumus-box">
                        $$(5y^3 + y - 8) - (2y^3 - 4y + 1)$$
                    </div>

                    <div class="latihan-step-box latihan-step-item" data-answer="5y^3+y-8-2y^3+4y-1">
                        <div class="latihan-step-title">Langkah 1: Buka kurung</div>
                        <div class="latihan-step-help">
                            Balik semua tanda di dalam kurung kedua.
                        </div>
                        <input type="text" class="latihan-input" placeholder="Contoh: 5y^3+y-8-2y^3+4y-1">
                        <div class="latihan-actions">
                            <button type="button" class="latihan-check">Cek</button>
                            <button type="button" class="latihan-reset">Reset</button>
                            <span class="latihan-feedback"></span>
                        </div>
                    </div>

                    <div class="latihan-step-box latihan-step-item" data-answer="(5y^3-2y^3)+(y+4y)+(-8-1)">
                        <div class="latihan-step-title">Langkah 2: Kelompokkan suku sejenis</div>
                        <div class="latihan-step-help">
                            Kelompokkan suku $y^3$, suku $y$, dan konstanta.
                        </div>
                        <input type="text" class="latihan-input" placeholder="Contoh: (5y^3-2y^3)+(y+4y)+(-8-1)">
                        <div class="latihan-actions">
                            <button type="button" class="latihan-check">Cek</button>
                            <button type="button" class="latihan-reset">Reset</button>
                            <span class="latihan-feedback"></span>
                        </div>
                    </div>

                    <div class="latihan-step-box latihan-step-item" data-answer="3y^3+5y-9">
                        <div class="latihan-step-title">Langkah 3: Tulis hasil akhir</div>
                        <div class="latihan-step-help">
                            Hitung semua kelompok, lalu tulis hasil akhirnya.
                        </div>
                        <input type="text" class="latihan-input" placeholder="Contoh: 3y^3+5y-9">
                        <div class="latihan-actions">
                            <button type="button" class="latihan-check">Cek</button>
                            <button type="button" class="latihan-reset">Reset</button>
                            <span class="latihan-feedback"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="latihan-global-actions">
                <button type="button" id="latihan-check-all" class="latihan-checkall">Cek Semua</button>
                <span id="latihan-summary" class="latihan-summary"></span>
            </div>

            <div id="latihan-final-message" class="final-message">
                ✅ Bagus! Semua langkah pada latihan A dan B sudah benar.
            </div>
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

            const normalizePoly = (raw) => {
                let s = normalize(raw);
                if (!s) return "";

                s = s
                    .replace(/\*\*/g, "^")
                    .replace(/([a-z])\((\-?\d+)\)/g, "$1^$2");

                s = s.replace(/([a-z])(\d+)/g, (match, varName, power, offset, full) => {
                    const prev = full[offset - 1] || "";
                    if (prev === "^") return match;
                    return `${varName}^${power}`;
                });

                s = s
                    .replace(/\+\-/g, "-")
                    .replace(/(^|[+\-])1x/g, "$1x")
                    .replace(/(^|[+\-])-1x/g, "$1-x")
                    .replace(/\^1(?!\d)/g, "");

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

            const quiz = document.getElementById("eksplorasi-quiz");
            if (quiz) {
                const items = Array.from(quiz.querySelectorAll(".quiz-item"));
                const summary = document.getElementById("quiz-summary");
                const finalMsg = document.getElementById("quiz-final-message");

                const checkItem = (item) => {
                    const input = item.querySelector(".quiz-input");
                    const fb = item.querySelector(".quiz-feedback");
                    const user = normalizePoly(input ? input.value : "");
                    const ans = normalizePoly(item.getAttribute("data-answer") || "");
                    const ok = !!user && user === ans;
                    setFb(fb, ok);
                    return ok;
                };

                const updateScore = () => {
                    const correct = items.filter(it =>
                        it.querySelector(".quiz-feedback")?.classList.contains("ok")
                    ).length;

                    const total = items.length;

                    if (summary) {
                        summary.textContent = `Skor ${correct}/${total}`;
                    }

                    if (finalMsg) {
                        if (correct === total) finalMsg.classList.add("ok");
                        else finalMsg.classList.remove("ok");
                    }
                };

                items.forEach(item => {
                    const input = item.querySelector(".quiz-input");
                    const btnCheck = item.querySelector(".quiz-check");
                    const btnReset = item.querySelector(".quiz-reset");
                    const fb = item.querySelector(".quiz-feedback");

                    btnCheck?.addEventListener("click", () => {
                        checkItem(item);
                        updateScore();
                    });

                    btnReset?.addEventListener("click", () => {
                        if (input) input.value = "";
                        clearFb(fb);
                        updateScore();
                    });

                    input?.addEventListener("keydown", (e) => {
                        if (e.key === "Enter") {
                            e.preventDefault();
                            checkItem(item);
                            updateScore();
                        }
                    });

                    input?.addEventListener("input", () => {
                        clearFb(fb);
                        updateScore();
                    });
                });

                document.getElementById("quiz-check-all")?.addEventListener("click", () => {
                    items.forEach(checkItem);
                    updateScore();
                });

                updateScore();
            }

            const tipBoard = document.getElementById("tipBoard");
            const tipFlashBtn = document.getElementById("tipFlashBtn");
            const tipRememberBtn = document.querySelector(".tip-remember-btn");

            function flashTip() {
                if (!tipBoard) return;
                tipBoard.classList.remove("tip-flash");
                void tipBoard.offsetWidth;
                tipBoard.classList.add("tip-flash");
            }

            tipFlashBtn?.addEventListener("click", flashTip);
            tipRememberBtn?.addEventListener("click", flashTip);

            const interaktifItems = Array.from(document.querySelectorAll(".interaktif-wrap"));
            const interaktifSummary = document.getElementById("interaktif-summary");
            const interaktifFinal = document.getElementById("interaktif-final-message");
            const interaktifCheckAll = document.getElementById("interaktif-check-all");

            function checkInteraktifItem(item) {
                const input = item.querySelector(".interaktif-input");
                const fb = item.querySelector(".interaktif-feedback");
                const ans = normalizePoly(item.getAttribute("data-answer") || "");
                const user = normalizePoly(input ? input.value : "");
                const ok = !!user && user === ans;
                setFb(fb, ok);
                return ok;
            }

            function updateInteraktifScore() {
                const correct = interaktifItems.filter(item =>
                    item.querySelector(".interaktif-feedback")?.classList.contains("ok")
                ).length;

                const total = interaktifItems.length;

                if (interaktifSummary) {
                    interaktifSummary.textContent = `Skor ${correct}/${total}`;
                }

                if (interaktifFinal) {
                    if (correct === total) interaktifFinal.classList.add("ok");
                    else interaktifFinal.classList.remove("ok");
                }
            }

            interaktifItems.forEach(item => {
                const input = item.querySelector(".interaktif-input");
                const btnCheck = item.querySelector(".interaktif-check");
                const btnReset = item.querySelector(".interaktif-reset");
                const fb = item.querySelector(".interaktif-feedback");

                btnCheck?.addEventListener("click", () => {
                    checkInteraktifItem(item);
                    updateInteraktifScore();
                });

                btnReset?.addEventListener("click", () => {
                    if (input) input.value = "";
                    clearFb(fb);
                    updateInteraktifScore();
                });

                input?.addEventListener("keydown", (e) => {
                    if (e.key === "Enter") {
                        e.preventDefault();
                        checkInteraktifItem(item);
                        updateInteraktifScore();
                    }
                });

                input?.addEventListener("input", () => {
                    clearFb(fb);
                    updateInteraktifScore();
                });
            });

            interaktifCheckAll?.addEventListener("click", () => {
                interaktifItems.forEach(checkInteraktifItem);
                updateInteraktifScore();
            });

            updateInteraktifScore();

            const latihanItems = Array.from(document.querySelectorAll(".latihan-step-item"));
            const latihanSummary = document.getElementById("latihan-summary");
            const latihanFinal = document.getElementById("latihan-final-message");
            const latihanCheckAll = document.getElementById("latihan-check-all");

            function checkLatihanItem(item) {
                const input = item.querySelector(".latihan-input");
                const fb = item.querySelector(".latihan-feedback");
                const ans = normalizePoly(item.getAttribute("data-answer") || "");
                const user = normalizePoly(input ? input.value : "");
                const ok = !!user && user === ans;
                setFb(fb, ok);
                return ok;
            }

            function updateLatihanScore() {
                const correct = latihanItems.filter(item =>
                    item.querySelector(".latihan-feedback")?.classList.contains("ok")
                ).length;

                const total = latihanItems.length;

                if (latihanSummary) {
                    latihanSummary.textContent = `Skor ${correct}/${total}`;
                }

                if (latihanFinal) {
                    if (correct === total) latihanFinal.classList.add("ok");
                    else latihanFinal.classList.remove("ok");
                }
            }

            latihanItems.forEach(item => {
                const input = item.querySelector(".latihan-input");
                const btnCheck = item.querySelector(".latihan-check");
                const btnReset = item.querySelector(".latihan-reset");
                const fb = item.querySelector(".latihan-feedback");

                btnCheck?.addEventListener("click", () => {
                    checkLatihanItem(item);
                    updateLatihanScore();
                });

                btnReset?.addEventListener("click", () => {
                    if (input) input.value = "";
                    clearFb(fb);
                    updateLatihanScore();
                });

                input?.addEventListener("keydown", (e) => {
                    if (e.key === "Enter") {
                        e.preventDefault();
                        checkLatihanItem(item);
                        updateLatihanScore();
                    }
                });

                input?.addEventListener("input", () => {
                    clearFb(fb);
                    updateLatihanScore();
                });
            });

            latihanCheckAll?.addEventListener("click", () => {
                latihanItems.forEach(checkLatihanItem);
                updateLatihanScore();
            });

            updateLatihanScore();
        })();
    </script>
@endsection

@section('nav')
    <a href="{{ route('penjumlahanpolinomial') }}" class="btn-nav prev-btn">
        ← Previous
    </a>

    <a href="{{ route('perkalianpolinomial') }}" class="btn-nav next-btn">
        Next →
    </a>
@endsection