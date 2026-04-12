@extends('layout.halamanmateri')

@section('content')

    {{-- KaTeX --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/contrib/auto-render.min.js" onload="renderMathInElement(document.body,{
                                                        delimiters:[
                                                            {left:'$$',right:'$$',display:true},
                                                            {left:'$',right:'$',display:false}
                                                        ]
                                                    });"></script>

    <style>
        :root {
            --green: #63b64f;
            --green-dark: #2f8f3a;
            --green-soft: #f7fcf5;
            --green-border: #8bcf7d;
            --peach: #e7b29b;
            --peach-border: #d98a67;
            --text: #444;
            --muted: #666;
            --border: rgba(0, 0, 0, .08);
            --soft: #f7f7f7;
            --white: #fff;
            --blue: #2d9cdb;
            --blue-soft: #f4fbff;
            --blue-border: #8cc8ea;
            --gray-pill: #7d7d7d;
            --success-bg: #eef9ea;
            --success-border: #b9deb0;
            --danger-bg: #fff1f0;
            --danger-border: #f3b8b5;
            --warning-bg: #fff8ec;
            --warning-border: #efd7a3;
        }

        .materi-wrap {
            max-width: 1080px;
            margin: auto;
            padding: 24px 18px 42px;
            font-family: "Poppins", "Segoe UI", sans-serif;
            color: var(--text);
        }

        .top-title {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 18px;
        }

        .top-title .label {
            font-size: 28px;
            font-weight: 800;
            color: #1f1f1f;
        }

        .top-title .judul {
            font-size: 30px;
            font-weight: 800;
            color: var(--green-dark);
            line-height: 1.2;
        }

        .card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 24px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .03);
        }

        .card-eksplorasi {
            background: linear-gradient(180deg, #f4f9ff, #ffffff);
            border-left: 7px solid #79aedd;
        }

        /* =========================
                               EKSPLORASI INTERAKTIF
                            ========================= */
        .eksplorasi-text {
            font-size: 17px;
            line-height: 1.9;
            color: #555;
            margin-top: 10px;
        }

        .eksplorasi-highlight {
            background: #fff8ec;
            border: 1px solid #efd7a3;
            border-radius: 16px;
            padding: 14px 16px;
            margin-top: 16px;
            color: #7a5a1f;
            line-height: 1.8;
        }

        .eksplorasi-question {
            margin-top: 24px;
            padding: 18px;
            background: #ffffff;
            border: 1px solid #dbe8f2;
            border-radius: 18px;
        }

        .eksplorasi-question-title {
            font-size: 18px;
            font-weight: 800;
            color: #355e9a;
            margin-bottom: 14px;
        }

        .opsi-row {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 10px;
        }

        .opsi-btn {
            border: 2px solid #cfdbe8;
            background: #fff;
            color: #444;
            border-radius: 14px;
            padding: 12px 18px;
            min-width: 120px;
            text-align: center;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .opsi-btn:hover {
            transform: translateY(-1px);
            border-color: #79aedd;
            background: #f7fbff;
        }

        .opsi-btn.correct {
            background: #eef9ea;
            border-color: #7fc46d;
            color: #2d6a31;
        }

        .opsi-btn.wrong {
            background: #fff1f0;
            border-color: #e2908d;
            color: #b23b35;
        }

        .eksplorasi-feedback {
            display: none;
            margin-top: 14px;
            border-radius: 14px;
            padding: 12px 14px;
            font-size: 15px;
            font-weight: 600;
            line-height: 1.7;
        }

        .eksplorasi-feedback.show {
            display: block;
        }

        .eksplorasi-feedback.success {
            background: #eef9ea;
            border: 1px solid #b9deb0;
            color: #2d6a31;
        }

        .eksplorasi-feedback.error {
            background: #fff1f0;
            border: 1px solid #f3b8b5;
            color: #b23b35;
        }

        .eksplorasi-penjelasan {
            display: none;
            margin-top: 14px;
            background: #f4fbff;
            border: 1px solid #cfe2f2;
            border-radius: 14px;
            padding: 14px 16px;
            color: #43627d;
            line-height: 1.8;
        }

        .eksplorasi-penjelasan.show {
            display: block;
        }

        .title-box {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 12px;
            color: var(--green-dark);
        }

        .title-box.blue {
            color: #355e9a;
        }

        p {
            margin: 10px 0;
            font-size: 17px;
            line-height: 1.85;
            color: #555;
        }

        .subjudul {
            font-size: 20px;
            font-weight: 800;
            margin: 26px 0 12px;
            text-decoration: underline;
            color: #333;
        }

        .teorema-box {
            background: #9fd688;
            border: 1px solid #6eb152;
            padding: 16px 18px;
            border-radius: 14px;
            text-align: center;
            font-weight: 700;
            font-size: 18px;
            margin: 14px 0 24px;
            color: #243b1f;
        }

        .rumus-box {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            background: #fff;
            border: 1px solid rgba(0, 0, 0, .07);
            border-radius: 16px;
            padding: 16px;
            margin: 16px 0;
        }

        .full-box {
            border: 2px solid #e17b36;
            background: #fff;
            border-radius: 14px;
            padding: 16px 18px;
            margin-top: 14px;
        }

        .custom-definisi {
            position: relative;
            background: #e8ab95;
            border: 2px solid #df7d49;
            border-radius: 20px;
            padding: 32px 22px 22px;
            margin-top: 30px;
        }

        .custom-label {
            position: absolute;
            top: -18px;
            left: 18px;
            background: #9bcc88;
            border: 2px solid #5ea34e;
            color: #233a1d;
            padding: 8px 28px;
            border-radius: 999px;
            font-weight: 800;
            font-size: 15px;
        }

        .contoh-section {
            margin-top: 34px;
        }

        .contoh-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 170px;
            padding: 14px 34px;
            border-radius: 999px;
            background: var(--peach);
            border: 2px solid var(--peach-border);
            color: #5b2d22;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: .5px;
            margin-bottom: 22px;
        }

        .contoh-card {
            background: #fff;
            border: 3px solid var(--green);
            border-radius: 34px;
            padding: 34px 32px 30px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, .03);
        }

        .contoh-title {
            font-size: 26px;
            font-weight: 800;
            color: #4a4a4a;
            margin-bottom: 16px;
        }

        .contoh-persamaan {
            text-align: center;
            margin: 8px 0 22px;
            font-size: 38px;
            color: #4e4e4e;
        }

        .contoh-text {
            font-size: 18px;
            line-height: 1.8;
            color: #565656;
            margin-bottom: 26px;
        }

        .soal-list {
            margin: 0 0 24px 18px;
            padding: 0;
            color: #555;
            line-height: 1.9;
            font-size: 17px;
        }

        .jawaban-item {
            background: #fcfdfb;
            border: 1px solid #dce8d8;
            border-radius: 22px;
            padding: 18px 18px 16px;
            margin-bottom: 16px;
        }

        .jawaban-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .jawaban-label {
            font-size: 19px;
            font-weight: 800;
            color: #333;
        }

        .btn-jawaban {
            border: none;
            background: var(--green-dark);
            color: #fff;
            padding: 11px 18px;
            border-radius: 999px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .btn-jawaban:hover {
            opacity: .92;
            transform: translateY(-1px);
        }

        .jawaban-content {
            display: none;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px dashed #cfe0c8;
        }

        .jawaban-content.show {
            display: block;
        }

        .answer-box {
            background: #eef9ea;
            border: 1px solid #b9deb0;
            border-radius: 16px;
            padding: 14px 16px;
            margin-bottom: 14px;
        }

        .answer-title {
            font-size: 15px;
            font-weight: 800;
            color: var(--green-dark);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .explain-box {
            background: #fff;
            border: 1px solid #e5ebe2;
            border-radius: 16px;
            padding: 14px 16px;
            margin-bottom: 14px;
        }

        .source-box {
            background: #fff8ec;
            border: 1px solid #efd7a3;
            border-radius: 16px;
            padding: 14px 16px;
        }

        .source-box b {
            color: #8b6222;
        }

        .graph-placeholder {
            margin-top: 18px;
            border: 2px dashed #cfdcc8;
            border-radius: 20px;
            min-height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: linear-gradient(180deg, #fcfefb, #f7fbf5);
            color: #8ba184;
            font-weight: 700;
            padding: 20px;
        }

        .note-box {
            margin-top: 18px;
            background: #f3f9ff;
            border: 1px solid #cfe2f2;
            color: #43627d;
            border-radius: 16px;
            padding: 14px 16px;
            font-size: 15px;
            line-height: 1.8;
        }

        .custom-list {
            margin: 8px 0 0 20px;
            line-height: 1.9;
            color: #555;
        }

        .latihan-section {
            margin-top: 40px;
        }

        .latihan-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 220px;
            padding: 14px 34px;
            border-radius: 999px;
            background: var(--gray-pill);
            color: #fff;
            font-size: 22px;
            font-weight: 800;
            letter-spacing: .4px;
            margin-bottom: 22px;
        }

        .latihan-card {
            background: #fff;
            border: 3px solid var(--blue);
            border-radius: 0;
            padding: 34px 28px 30px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, .03);
            margin-bottom: 26px;
        }

        .latihan-card-title {
            font-size: 22px;
            font-weight: 800;
            color: #333;
            margin-bottom: 8px;
        }

        .latihan-persamaan {
            text-align: center;
            margin: 10px 0 24px;
            font-size: 36px;
            color: #333;
        }

        .latihan-item {
            background: #fbfdff;
            border: 1px solid #d9e8f2;
            border-radius: 22px;
            padding: 18px 18px 16px;
            margin-bottom: 16px;
        }

        .latihan-label {
            font-size: 19px;
            font-weight: 800;
            color: #333;
            margin-bottom: 12px;
        }

        .input-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        .input-jawaban {
            flex: 1 1 340px;
            min-width: 260px;
            border: 1.5px solid #d4dde5;
            background: #fff;
            color: #333;
            border-radius: 14px;
            padding: 12px 14px;
            font-size: 15px;
            outline: none;
            transition: .2s ease;
        }

        .input-jawaban:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 4px rgba(45, 156, 219, .12);
        }

        .btn-cek {
            border: none;
            background: var(--blue);
            color: #fff;
            padding: 11px 18px;
            border-radius: 999px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .btn-cek:hover {
            opacity: .92;
            transform: translateY(-1px);
        }

        .feedback-box {
            display: none;
            margin-top: 14px;
            border-radius: 16px;
            padding: 12px 14px;
            font-size: 15px;
            font-weight: 600;
            line-height: 1.7;
        }

        .feedback-box.show {
            display: block;
        }

        .feedback-box.success {
            background: var(--success-bg);
            border: 1px solid var(--success-border);
            color: #2d6a31;
        }

        .feedback-box.error {
            background: var(--danger-bg);
            border: 1px solid var(--danger-border);
            color: #b23b35;
        }

        .penjelasan-wrap {
            display: none;
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px dashed #cfe0c8;
        }

        .penjelasan-wrap.show {
            display: block;
        }

        .langkah-step {
            background: var(--blue-soft);
            border: 1px solid #d7ebf8;
            border-radius: 16px;
            padding: 14px 16px;
            margin-bottom: 12px;
        }

        .langkah-step .step-head {
            font-size: 15px;
            font-weight: 800;
            color: #2d6996;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .status-selesai {
            display: none;
            margin-top: 18px;
            background: #eef9ea;
            border: 1px solid #b9deb0;
            color: #2d6a31;
            border-radius: 16px;
            padding: 14px 16px;
            font-weight: 700;
        }

        .status-selesai.show {
            display: block;
        }

        .small-note {
            font-size: 14px;
            color: #777;
            margin-top: 8px;
        }

        @media (max-width: 768px) {
            .materi-wrap {
                padding: 18px 12px 32px;
            }

            .top-title .label {
                font-size: 22px;
            }

            .top-title .judul {
                font-size: 24px;
            }

            .contoh-badge,
            .latihan-badge {
                min-width: auto;
                font-size: 18px;
                padding: 12px 28px;
            }

            .contoh-card,
            .latihan-card {
                border-radius: 24px;
                padding: 24px 18px;
            }

            .contoh-title,
            .latihan-card-title {
                font-size: 22px;
            }

            .contoh-persamaan,
            .latihan-persamaan {
                font-size: 28px;
            }

            p,
            .contoh-text,
            .soal-list {
                font-size: 16px;
            }

            .jawaban-label,
            .latihan-label {
                font-size: 17px;
            }
        }
    </style>

    <div class="materi-wrap">

        {{-- JUDUL --}}
        <div class="top-title">
            <div class="label">2.</div>
            <div class="judul">Faktor dan Pembuat Nol Polinomial</div>
        </div>

        <p>
            Pada materi sebelumnya, kamu telah mempelajari Teorema Faktor, yaitu prinsip penting yang menghubungkan antara
            pembuat nol suatu fungsi polinomial dengan faktornya. Teorema tersebut menyatakan bahwa: </p>

        <div class="card card-eksplorasi">
            <div class="title-box blue">🧭 Eksplorasi</div>

            <div class="eksplorasi-text">
                Di kota Banjarmasin, banyak terdapat warung makan khas seperti
                <b>warung soto Banjar</b> yang ramai dikunjungi pembeli setiap harinya.
                Jumlah pembeli tidak selalu tetap. Pada waktu tertentu warung bisa ramai,
                tetapi pada waktu lain bisa juga sepi.
            </div>

            <div class="eksplorasi-text">
                Misalkan jumlah pembeli di sebuah warung dimodelkan dengan fungsi:
            </div>

            <div class="rumus-box">
                $$P(x)=x^2-5x+6$$
            </div>

            <div class="eksplorasi-text">
                dengan:
                <br>• $x$ = waktu (jam setelah warung dibuka)
                <br>• $P(x)$ = jumlah pembeli
            </div>

            <div class="eksplorasi-highlight">
                Untuk mengetahui kapan tidak ada pembeli, kita mencari nilai $x$ saat
                <b>$P(x)=0$</b>. Nilai tersebut disebut sebagai pembuat nol.
            </div>

            {{-- SOAL 1 --}}
            <div class="eksplorasi-question">
                <div class="eksplorasi-question-title">
                    1. Nilai $x$ yang membuat $P(x)=0$ adalah ...
                </div>

                <div class="opsi-row">
                    <button type="button" class="opsi-btn"
                        onclick="cekOpsiEksplorasi(this, false, 'fbEks1', 'penjelasanEks1')">
                        $x=1$ dan $x=6$
                    </button>

                    <button type="button" class="opsi-btn"
                        onclick="cekOpsiEksplorasi(this, true, 'fbEks1', 'penjelasanEks1')">
                        $x=2$ dan $x=3$
                    </button>

                    <button type="button" class="opsi-btn"
                        onclick="cekOpsiEksplorasi(this, false, 'fbEks1', 'penjelasanEks1')">
                        $x=-2$ dan $x=-3$
                    </button>
                </div>

                <div id="fbEks1" class="eksplorasi-feedback"></div>

                <div id="penjelasanEks1" class="eksplorasi-penjelasan">
                    <b>Penjelasan:</b><br>
                    Persamaan dibuat nol:
                    $$x^2-5x+6=0$$
                    Faktorkan:
                    $$(x-2)(x-3)=0$$
                    Maka diperoleh:
                    $$x=2 \text{ dan } x=3$$
                </div>
            </div>

            {{-- SOAL 2 --}}
            <div class="eksplorasi-question">
                <div class="eksplorasi-question-title">
                    2. Arti hasil tersebut dalam kehidupan sehari-hari adalah ...
                </div>

                <div class="opsi-row">
                    <button type="button" class="opsi-btn"
                        onclick="cekOpsiEksplorasi(this, true, 'fbEks2', 'penjelasanEks2')">
                        Pada jam ke-2 dan ke-3 tidak ada pembeli
                    </button>

                    <button type="button" class="opsi-btn"
                        onclick="cekOpsiEksplorasi(this, false, 'fbEks2', 'penjelasanEks2')">
                        Pada jam ke-2 dan ke-3 warung paling ramai
                    </button>

                    <button type="button" class="opsi-btn"
                        onclick="cekOpsiEksplorasi(this, false, 'fbEks2', 'penjelasanEks2')">
                        Pada jam ke-2 dan ke-3 warung tutup permanen
                    </button>
                </div>

                <div id="fbEks2" class="eksplorasi-feedback"></div>

                <div id="penjelasanEks2" class="eksplorasi-penjelasan">
                    <b>Penjelasan:</b><br>
                    Jika $P(x)=0$, berarti jumlah pembeli sama dengan nol.
                    Jadi pada saat $x=2$ dan $x=3$, warung sedang <b>sepi</b>
                    atau tidak ada pembeli.
                </div>
            </div>
        </div>
        <div class="teorema-box">
            Jika $P(c)=0$, maka $(x-c)$ adalah faktor dari $P(x)$
        </div>

        <p>ini akan memperluas pemahaman tersebut dengan menghubungkan faktor polinomial dengan grafik fungsi polinomial,
            terutama pada titik potong grafik dengan sumbu-x.</p>

        <div class="subjudul">Pembuat Nol (Akar) Polinomial</div>

        <div class="full-box">
            <p>Pembuat nol memenuhi:</p>
            <div class="rumus-box">
                $$P(x)=0$$
            </div>
            <p>Jika ada faktor $(x-a)$ maka grafik memotong sumbu-$x$ di $x=a$.</p>
        </div>

        {{-- HUBUNGAN --}}
        <div class="subjudul">Hubungan Faktor dengan Grafik</div>

        <div class="full-box">
            <p>Sifat hasil kali nol menyatakan:</p>

            <div class="rumus-box">
                $$A \cdot B = 0 \iff A = 0 \text{ atau } B = 0$$
            </div>

            <p>Karena itu, jika polinomial ditulis sebagai:</p>

            <div class="rumus-box">
                $$P(x) = (x-a)(x-b)(x-c)$$
            </div>

            <p>maka titik potong grafik dengan sumbu-$x$ adalah:</p>

            <div class="rumus-box">
                $$(a,0), (b,0), (c,0)$$
            </div>

            <p>
                Hubungan ini memberikan cara yang cepat untuk menggambar grafik
                polinomial tanpa menghitung terlalu banyak titik.
            </p>
        </div>

        {{-- DEFINISI --}}
        <div class="custom-definisi">
            <div class="custom-label">DEFINISI</div>

            <p><b>Hubungan Faktor–Grafik</b></p>

            <div class="rumus-box">
                $$P(x) = (x-a)(x-b)(x-c)$$
            </div>

            <div class="rumus-box">
                $$(a,0), (b,0), (c,0)$$
            </div>
        </div>

        {{-- CONTOH --}}
        <div class="contoh-section">
            <div class="contoh-badge">CONTOH</div>

            <div class="contoh-card">
                <div class="contoh-title">Perhatikan fungsi polinomial berikut:</div>

                <div class="contoh-persamaan">
                    $$f(x)=x^2-x-2$$
                </div>

                <div class="contoh-text">
                    Tentukan:
                </div>

                <ol class="soal-list" type="a">
                    <li>Pembuat nol</li>
                    <li>Bentuk pemfaktoran</li>
                    <li>Titik potong dengan sumbu-$x$ dan sumbu-$y$</li>
                    <li>Sketsa grafik sederhana</li>
                </ol>

                <div class="jawaban-item">
                    <div class="jawaban-top">
                        <div class="jawaban-label">a. Pembuat nol</div>
                        <button type="button" class="btn-jawaban" onclick="toggleJawaban('jawaban1', this)">
                            Lihat Jawaban
                        </button>
                    </div>

                    <div id="jawaban1" class="jawaban-content">
                        <div class="answer-box">
                            <div class="answer-title">Jawaban</div>
                            <div class="rumus-box">
                                $$x^2-x-2=0$$
                            </div>
                            <div class="rumus-box">
                                $$(x-2)(x+1)=0$$
                            </div>
                            <div class="rumus-box">
                                $$x=2 \quad \text{dan} \quad x=-1$$
                            </div>
                        </div>

                        <div class="explain-box">
                            <div class="answer-title">Penjelasan</div>
                            <p>
                                Untuk mencari pembuat nol, fungsi dibuat sama dengan nol:
                                $$f(x)=0$$
                            </p>
                            <p>
                                Kemudian difaktorkan:
                                $$(x-2)(x+1)=0$$
                            </p>
                            <p>
                                Berdasarkan sifat hasil kali nol, diperoleh:
                                $$x=2 \quad \text{dan} \quad x=-1$$
                            </p>
                        </div>
                    </div>
                </div>

                <div class="jawaban-item">
                    <div class="jawaban-top">
                        <div class="jawaban-label">b. Bentuk pemfaktoran</div>
                        <button type="button" class="btn-jawaban" onclick="toggleJawaban('jawaban2', this)">
                            Lihat Jawaban
                        </button>
                    </div>

                    <div id="jawaban2" class="jawaban-content">
                        <div class="answer-box">
                            <div class="answer-title">Jawaban</div>
                            <div class="rumus-box">
                                $$f(x)=(x-2)(x+1)$$
                            </div>
                        </div>

                        <div class="explain-box">
                            <div class="answer-title">Penjelasan</div>
                            <p>
                                Carilah dua bilangan yang hasil kalinya $-2$ dan jumlahnya $-1$.
                                Bilangan tersebut adalah $-2$ dan $1$.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="jawaban-item">
                    <div class="jawaban-top">
                        <div class="jawaban-label">c. Titik potong dengan sumbu-$x$ dan sumbu-$y$</div>
                        <button type="button" class="btn-jawaban" onclick="toggleJawaban('jawaban3', this)">
                            Lihat Jawaban
                        </button>
                    </div>

                    <div id="jawaban3" class="jawaban-content">
                        <div class="answer-box">
                            <div class="answer-title">Jawaban</div>
                            <div class="rumus-box">
                                $$\text{Titik potong sumbu-}x : (2,0) \text{ dan } (-1,0)$$
                            </div>
                            <div class="rumus-box">
                                $$\text{Titik potong sumbu-}y : (0,-2)$$
                            </div>
                        </div>
                    </div>
                </div>

                <div class="jawaban-item">
                    <div class="jawaban-top">
                        <div class="jawaban-label">d. Sketsa grafik sederhana</div>
                        <button type="button" class="btn-jawaban" onclick="toggleJawaban('jawaban4', this)">
                            Lihat Jawaban
                        </button>
                    </div>

                    <div id="jawaban4" class="jawaban-content">
                        <div class="answer-box">
                            <div class="answer-title">Jawaban</div>
                            <ul class="custom-list">
                                <li>Grafik berbentuk parabola terbuka ke atas</li>
                                <li>Memotong sumbu-$x$ di $(-1,0)$ dan $(2,0)$</li>
                                <li>Memotong sumbu-$y$ di $(0,-2)$</li>
                            </ul>
                            <div class="graph-placeholder">
                                <img src="{{ asset('img/grafik4.2.png') }}" alt="Grafik 4.2"
                                    style="max-width:100%; height:auto; border-radius:12px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="note-box">
                    Klik tombol <b>Lihat Jawaban</b> untuk menampilkan jawaban tiap bagian.
                </div>
            </div>
        </div>

        {{-- MARI MENCOBA --}}
        <div class="latihan-section">
            <div class="latihan-badge">MARI MENCOBA</div>

            <div class="latihan-card">
                <div class="latihan-card-title">Diberikan fungsi polinomial berikut:</div>

                <div class="latihan-persamaan">
                    $$f(x)=x^4-5x^3+2x^2+20x-24$$
                </div>

                {{-- 1 --}}
                <div class="latihan-item">
                    <div class="latihan-label">1. Pembuat nol</div>
                    <div class="input-row">
                        <input id="m1" class="input-jawaban" placeholder="Contoh: 2,3,-2,-1">
                        <button class="btn-cek" onclick="cekMari(1)">Cek Jawaban</button>
                    </div>
                    <div id="fb1" class="feedback-box"></div>

                    <div id="step1" class="penjelasan-wrap">
                        <div class="answer-box">
                            $$x=2,\;3,\;-2,\;-1$$
                        </div>
                        <div class="langkah-step">
                            <div class="step-head">Langkah</div>
                            <p>Uji faktor dari 24 hingga menemukan nilai yang membuat $f(x)=0$.</p>
                        </div>
                    </div>
                </div>

                {{-- 2 --}}
                <div class="latihan-item">
                    <div class="latihan-label">2. Pemfaktoran</div>
                    <div class="input-row">
                        <input id="m2" class="input-jawaban" placeholder="(x-2)(x-3)(x+2)(x+1)">
                        <button class="btn-cek" onclick="cekMari(2)">Cek Jawaban</button>
                    </div>
                    <div id="fb2" class="feedback-box"></div>

                    <div id="step2" class="penjelasan-wrap">
                        <div class="answer-box">
                            $$f(x)=(x-2)(x-3)(x+2)(x+1)$$
                        </div>
                    </div>
                </div>

                {{-- 3 --}}
                <div class="latihan-item">
                    <div class="latihan-label">3. Titik potong sumbu-x</div>
                    <div class="input-row">
                        <input id="m3" class="input-jawaban" placeholder="(2,0),(3,0),(-2,0),(-1,0)">
                        <button class="btn-cek" onclick="cekMari(3)">Cek Jawaban</button>
                    </div>
                    <div id="fb3" class="feedback-box"></div>

                    <div id="step3" class="penjelasan-wrap">
                        <div class="answer-box">
                            $$(2,0),(3,0),(-2,0),(-1,0)$$
                        </div>
                    </div>
                </div>

                {{-- 4 --}}
                <div class="latihan-item">
                    <div class="latihan-label">4. Titik potong sumbu-y</div>
                    <div class="input-row">
                        <input id="m4" class="input-jawaban" placeholder="(0,-24)">
                        <button class="btn-cek" onclick="cekMari(4)">Cek Jawaban</button>
                    </div>
                    <div id="fb4" class="feedback-box"></div>

                    <div id="step4" class="penjelasan-wrap">
                        <div class="answer-box">
                            $$(0,-24)$$
                        </div>
                    </div>
                </div>

                {{-- 5 --}}
                <div class="latihan-item">
                    <div class="latihan-label">5. Grafik</div>

                    <div class="graph-placeholder" style="min-height:420px;">
                        {{-- KOSONG UNTUK GRAFIK --}}
                    </div>
                </div>

                <div class="note-box">
                    Jawaban harus benar dulu agar penjelasan muncul.
                </div>
            </div>
        </div>

        {{-- LATIHAN --}}
        <div class="latihan-section">
            <div class="latihan-badge">LATIHAN</div>

            <div class="latihan-card">

                {{-- SOAL 1 --}}
                <div class="latihan-card-title">1. Faktorkan polinomial berikut secara lengkap:</div>

                <div class="latihan-persamaan">
                    $$P(x)=x^3-4x^2-11x+30$$
                </div>

                <div class="latihan-item">
                    <div class="latihan-label">a. Tentukan salah satu pembuat nol</div>
                    <div class="input-row">
                        <input type="text" id="soal1a" class="input-jawaban" placeholder="Contoh: 2 atau x=2">
                        <button type="button" class="btn-cek" onclick="cekSoal1('a')">Cek Jawaban</button>
                    </div>
                    <div id="feedbackSoal1a" class="feedback-box"></div>
                </div>

                <div class="latihan-item">
                    <div class="latihan-label">b. Tentukan semua pembuat nol</div>
                    <div class="input-row">
                        <input type="text" id="soal1b" class="input-jawaban" placeholder="Contoh: 2, 5, -3">
                        <button type="button" class="btn-cek" onclick="cekSoal1('b')">Cek Jawaban</button>
                    </div>
                    <div id="feedbackSoal1b" class="feedback-box"></div>
                </div>

                <div class="latihan-item">
                    <div class="latihan-label">c. Tentukan bentuk pemfaktoran lengkap</div>
                    <div class="input-row">
                        <input type="text" id="soal1c" class="input-jawaban" placeholder="Contoh: (x-2)(x-5)(x+3)">
                        <button type="button" class="btn-cek" onclick="cekSoal1('c')">Cek Jawaban</button>
                    </div>
                    <div id="feedbackSoal1c" class="feedback-box"></div>
                </div>

                <div id="statusSoal1" class="status-selesai">
                    Semua bagian pada soal 1 sudah selesai.
                </div>

                <div id="penjelasanSoal1" class="penjelasan-wrap">
                    ...
                </div>

                <hr style="margin:40px 0;">

                {{-- SOAL 2 (SEBELUMNYA SOAL 3) --}}
                <div class="latihan-card-title">2. Diberikan fungsi polinomial berikut:</div>

                <div class="latihan-persamaan">
                    $$f(x)=x^4-3x^3-8x^2+12x+16$$
                </div>

                <div class="latihan-item">
                    <div class="latihan-label">a. Pembuat nol</div>
                    <div class="input-row">
                        <input type="text" id="soal3a" class="input-jawaban">
                        <button class="btn-cek" onclick="cekSoal3('a')">Cek Jawaban</button>
                    </div>
                    <div id="feedbackSoal3a" class="feedback-box"></div>
                </div>

                <div class="latihan-item">
                    <div class="latihan-label">b. Pemfaktoran</div>
                    <div class="input-row">
                        <input type="text" id="soal3b" class="input-jawaban">
                        <button class="btn-cek" onclick="cekSoal3('b')">Cek Jawaban</button>
                    </div>
                    <div id="feedbackSoal3b" class="feedback-box"></div>
                </div>

                <div class="latihan-item">
                    <div class="latihan-label">c. Titik potong sumbu-x</div>
                    <div class="input-row">
                        <input type="text" id="soal3c" class="input-jawaban">
                        <button class="btn-cek" onclick="cekSoal3('c')">Cek Jawaban</button>
                    </div>
                    <div id="feedbackSoal3c" class="feedback-box"></div>
                </div>

                <div class="latihan-item">
                    <div class="latihan-label">d. Titik potong sumbu-y</div>
                    <div class="input-row">
                        <input type="text" id="soal3d" class="input-jawaban">
                        <button class="btn-cek" onclick="cekSoal3('d')">Cek Jawaban</button>
                    </div>
                    <div id="feedbackSoal3d" class="feedback-box"></div>
                </div>

                <div class="latihan-item">
                    <div class="latihan-label">e. Grafik</div>
                    <div class="graph-placeholder" style="min-height:420px;"></div>
                </div>

                <div id="statusSoal3" class="status-selesai">
                    Semua bagian pada soal 2 sudah selesai.
                </div>

                <div id="penjelasanSoal3" class="penjelasan-wrap">
                    ...
                </div>

            </div>

            <div class="note-box">
                Penjelasan muncul jika semua bagian benar.
            </div>
        </div>
    </div>

    <script>
        function toggleJawaban(id, btn) {
            const box = document.getElementById(id);
            box.classList.toggle('show');

            if (box.classList.contains('show')) {
                btn.textContent = 'Sembunyikan Jawaban';
            } else {
                btn.textContent = 'Lihat Jawaban';
            }

            renderMathSafe();
        }

        function normalizeText(text) {
            return text
                .toLowerCase()
                .replace(/\s+/g, '')
                .replace(/\$/g, '')
                .replace(/\\/g, '')
                .replace(/\{/g, '')
                .replace(/\}/g, '')
                .replace(/;/g, ',');
        }

        function splitAndClean(text) {
            return normalizeText(text)
                .split(',')
                .map(item => item.trim())
                .filter(item => item !== '');
        }

        function sameSet(arr1, arr2) {
            if (arr1.length !== arr2.length) return false;
            const a = [...arr1].sort();
            const b = [...arr2].sort();
            return JSON.stringify(a) === JSON.stringify(b);
        }

        function showFeedback(id, type, message) {
            const el = document.getElementById(id);
            el.className = 'feedback-box show ' + type;
            el.innerHTML = message;
            renderMathSafe();
        }

        function renderMathSafe() {
            if (typeof renderMathInElement === 'function') {
                renderMathInElement(document.body, {
                    delimiters: [
                        { left: '$$', right: '$$', display: true },
                        { left: '$', right: '$', display: false }
                    ]
                });
            }
        }

        function cekOpsiEksplorasi(btn, isBenar, feedbackId, penjelasanId) {
            const parent = btn.parentElement;
            const semuaOpsi = parent.querySelectorAll('.opsi-btn');
            const feedback = document.getElementById(feedbackId);
            const penjelasan = document.getElementById(penjelasanId);

            semuaOpsi.forEach(item => {
                item.classList.remove('correct', 'wrong');
            });

            if (isBenar) {
                btn.classList.add('correct');
                feedback.className = 'eksplorasi-feedback show success';
                feedback.innerHTML = '✅ Jawaban benar.';
                penjelasan.classList.add('show');
            } else {
                btn.classList.add('wrong');
                feedback.className = 'eksplorasi-feedback show error';
                feedback.innerHTML = '❌ Jawaban belum tepat. Coba pilih lagi.';
                penjelasan.classList.remove('show');
            }

            renderMathSafe();
        }
        const progress = {
            soal1: { a: false, b: false, c: false },
            soal3: { a: false, b: false, c: false, d: false }
        };

        function cekProgressSoal1() {
            const selesai = progress.soal1.a && progress.soal1.b && progress.soal1.c;
            const status = document.getElementById('statusSoal1');
            const penjelasan = document.getElementById('penjelasanSoal1');

            if (selesai) {
                status.classList.add('show');
                penjelasan.classList.add('show');
            } else {
                status.classList.remove('show');
                penjelasan.classList.remove('show');
            }
            renderMathSafe();
        }

        function cekProgressSoal3() {
            const selesai = progress.soal3.a && progress.soal3.b && progress.soal3.c && progress.soal3.d;
            const status = document.getElementById('statusSoal3');
            const penjelasan = document.getElementById('penjelasanSoal3');

            if (selesai) {
                status.classList.add('show');
                penjelasan.classList.add('show');
            } else {
                status.classList.remove('show');
                penjelasan.classList.remove('show');
            }
            renderMathSafe();
        }

        function norm(t) {
            return t.toLowerCase().replace(/\s/g, '');
        }

        function cekMari(no) {
            let val = norm(document.getElementById('m' + no).value);

            let benar = false;

            if (no == 1) {
                benar = ['2,3,-2,-1', '2,3,-1,-2'].includes(val);
            }
            if (no == 2) {
                benar = val.includes('(x-2)') && val.includes('(x-3)') && val.includes('(x+2)') && val.includes('(x+1)');
            }
            if (no == 3) {
                benar = val.includes('(2,0)') && val.includes('(3,0)');
            }
            if (no == 4) {
                benar = val.includes('(0,-24)');
            }

            let fb = document.getElementById('fb' + no);
            let step = document.getElementById('step' + no);

            if (benar) {
                fb.className = 'feedback-box show success';
                fb.innerHTML = '✅ Benar!';
                if (step) step.classList.add('show');
            } else {
                fb.className = 'feedback-box show error';
                fb.innerHTML = '❌ Salah, coba lagi sampai benar';
                if (step) step.classList.remove('show');
            }
        }

        function cekSoal1(bagian) {
            const input = document.getElementById('soal1' + bagian).value.trim();

            if (!input) {
                showFeedback('feedbackSoal1' + bagian, 'error', 'Jawaban belum diisi.');
                progress.soal1[bagian] = false;
                cekProgressSoal1();
                return;
            }

            const normalized = normalizeText(input);

            if (bagian === 'a') {
                const valid = ['2', 'x=2', '5', 'x=5', '-3', 'x=-3'].map(item => normalizeText(item));

                if (valid.includes(normalized)) {
                    showFeedback('feedbackSoal1a', 'success', 'Benar. Salah satu pembuat nol sudah tepat.');
                    progress.soal1.a = true;
                } else {
                    showFeedback('feedbackSoal1a', 'error', 'Belum tepat. Coba uji faktor-faktor dari 30.');
                    progress.soal1.a = false;
                }
            }

            if (bagian === 'b') {
                const user = splitAndClean(input).map(item => item.replace(/^x=/, ''));
                const answer = ['2', '5', '-3'];

                if (sameSet(user, answer)) {
                    showFeedback('feedbackSoal1b', 'success', 'Benar. Semua pembuat nol sudah tepat.');
                    progress.soal1.b = true;
                } else {
                    showFeedback('feedbackSoal1b', 'error', 'Masih belum tepat. Pastikan semua pembuat nol sudah lengkap.');
                    progress.soal1.b = false;
                }
            }

            if (bagian === 'c') {
                const validAnswers = [
                    '(x-2)(x-5)(x+3)',
                    '(x-2)(x+3)(x-5)',
                    '(x-5)(x-2)(x+3)',
                    '(x-5)(x+3)(x-2)',
                    '(x+3)(x-2)(x-5)',
                    '(x+3)(x-5)(x-2)'
                ].map(item => normalizeText(item));

                if (validAnswers.includes(normalized)) {
                    showFeedback('feedbackSoal1c', 'success', 'Benar. Bentuk pemfaktoran lengkap sudah tepat.');
                    progress.soal1.c = true;
                } else {
                    showFeedback('feedbackSoal1c', 'error', 'Belum tepat. Gunakan faktor linear dari semua pembuat nol.');
                    progress.soal1.c = false;
                }
            }

            cekProgressSoal1();
        }

        function cekSoal3(bagian) {
            const input = document.getElementById('soal3' + bagian).value.trim();

            if (!input) {
                showFeedback('feedbackSoal3' + bagian, 'error', 'Jawaban belum diisi.');
                progress.soal3[bagian] = false;
                cekProgressSoal3();
                return;
            }

            const normalized = normalizeText(input);

            if (bagian === 'a') {
                const user = splitAndClean(input).map(item => item.replace(/^x=/, ''));
                const answer = ['4', '2', '-2', '-1'];

                if (sameSet(user, answer)) {
                    showFeedback('feedbackSoal3a', 'success', 'Benar. Semua pembuat nol sudah tepat.');
                    progress.soal3.a = true;
                } else {
                    showFeedback('feedbackSoal3a', 'error', 'Masih belum tepat. Periksa kembali akar-akar fungsinya.');
                    progress.soal3.a = false;
                }
            }

            if (bagian === 'b') {
                const validAnswers = [
                    '(x-4)(x-2)(x+2)(x+1)',
                    '(x-4)(x-2)(x+1)(x+2)',
                    '(x-4)(x+2)(x-2)(x+1)',
                    '(x-4)(x+1)(x-2)(x+2)',
                    '(x-2)(x-4)(x+2)(x+1)',
                    '(x-2)(x-4)(x+1)(x+2)',
                    '(x+2)(x+1)(x-4)(x-2)',
                    '(x+1)(x+2)(x-4)(x-2)'
                ].map(item => normalizeText(item));

                if (validAnswers.includes(normalized)) {
                    showFeedback('feedbackSoal3b', 'success', 'Benar. Bentuk pemfaktoran lengkap sudah tepat.');
                    progress.soal3.b = true;
                } else {
                    showFeedback('feedbackSoal3b', 'error', 'Belum tepat. Gunakan faktor linear dari semua pembuat nol.');
                    progress.soal3.b = false;
                }
            }

            if (bagian === 'c') {
                const user = splitAndClean(input);
                const answer = ['(4,0)', '(2,0)', '(-2,0)', '(-1,0)'];

                if (sameSet(user, answer)) {
                    showFeedback('feedbackSoal3c', 'success', 'Benar. Titik potong dengan sumbu-x sudah tepat.');
                    progress.soal3.c = true;
                } else {
                    showFeedback('feedbackSoal3c', 'error', 'Masih belum tepat. Titik potong sumbu-x berasal dari pembuat nol.');
                    progress.soal3.c = false;
                }
            }

            if (bagian === 'd') {
                const validAnswers = ['(0,16)', '0,16'].map(item => normalizeText(item));

                if (validAnswers.includes(normalized)) {
                    showFeedback('feedbackSoal3d', 'success', 'Benar. Titik potong dengan sumbu-y sudah tepat.');
                    progress.soal3.d = true;
                } else {
                    showFeedback('feedbackSoal3d', 'error', 'Belum tepat. Coba substitusikan $x=0$ ke fungsi.');
                    progress.soal3.d = false;
                }
            }

            cekProgressSoal3();
        }
    </script>
@endsection

@section('nav')
    <a href="{{ route('teoremafaktor') }}" class="btn-nav prev-btn">
        ← Previous
    </a>

    <a href="{{ route('kuisd') }}" class="btn-nav next-btn">
        Next →
    </a>
@endsection