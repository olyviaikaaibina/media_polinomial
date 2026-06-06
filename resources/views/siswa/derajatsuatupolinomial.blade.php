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

        /* ===== EKSPLORASI RESPONSIVE ===== */
        .explore-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
            margin: 12px 0 14px;
        }

        .explore-card {
            border: 1.5px dashed rgba(43, 108, 176, .35);
            border-radius: 14px;
            padding: 12px 14px;
            background: rgba(243, 247, 255, .75);
            min-height: 105px;
            box-sizing: border-box;
        }

        .explore-card.green-card {
            border-color: rgba(27, 122, 42, .35);
            background: rgba(242, 251, 244, .75);
        }

        .explore-card.orange-card {
            border-color: rgba(245, 124, 0, .35);
            background: rgba(255, 248, 240, .9);
        }

        .explore-card.purple-card {
            border-color: rgba(128, 80, 180, .35);
            background: rgba(248, 244, 255, .9);
        }

        .explore-inner {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .explore-badge {
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: rgba(43, 108, 176, .12);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 900;
            color: #1e3a8a;
            flex: 0 0 58px;
            text-align: center;
            box-sizing: border-box;
        }

        .green-card .explore-badge {
            background: rgba(27, 122, 42, .12);
            color: #0f5f22;
        }

        .orange-card .explore-badge {
            background: rgba(245, 124, 0, .12);
            color: #c25a00;
        }

        .purple-card .explore-badge {
            background: rgba(128, 80, 180, .12);
            color: #7a3fb0;
        }

        .explore-text {
            font-size: 15px;
            line-height: 1.55;
            min-width: 0;
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

        /* ===== BAGIAN LANJUTAN ===== */
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

        /* ===== MARI MENCOBA: P5 RESPONSIVE ===== */
        .p5-responsive-wrap {
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }

        /*
                                                        PENTING UNTUK HP:
                                                        pan-y membuat halaman tetap bisa discroll ke atas/bawah.
                                                        Jangan pakai touch-action: none di sini.
                                                    */
        .p5-host {
            width: 100%;
            max-width: 100%;
            min-height: 420px;
            margin-top: 12px;
            border-radius: 18px;
            overflow: hidden;
            box-sizing: border-box;
            border: 2px solid var(--outer-line);
            background: #fff;
            position: relative;

            touch-action: pan-y;
            -ms-touch-action: pan-y;
            user-select: none;
            -webkit-user-select: none;
        }

        .p5-host canvas {
            display: block;
            width: 100% !important;
            height: auto !important;

            touch-action: pan-y;
            -ms-touch-action: pan-y;
            user-select: none;
            -webkit-user-select: none;
        }

        .p5-host button {
            font-family: "Times New Roman", Times, serif;
            font-weight: 900;
            border-radius: 14px;
            border: 1px solid rgba(0, 0, 0, .14);
            background: #fff;
            cursor: pointer;
            box-sizing: border-box;
            transition: .15s ease;
        }

        .p5-host button:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, .07);
        }

        @media (max-width: 900px) {
            .p5-host {
                min-height: 440px;
            }
        }

        @media (max-width: 640px) {
            .p5-host {
                min-height: 560px;
                border-radius: 16px;
            }
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

            .materi-wrap {
                padding: 14px 10px 32px;
                max-width: 100%;
                overflow-x: hidden;
            }

            .top-title {
                gap: 8px;
                align-items: flex-start;
            }

            .explore-grid {
                grid-template-columns: 1fr;
            }

            .explore-card {
                min-height: auto;
                padding: 12px;
            }

            .explore-inner {
                align-items: flex-start;
            }

            .explore-badge {
                width: 52px;
                height: 52px;
                flex-basis: 52px;
                font-size: 17px;
            }

            .explore-text {
                font-size: 14px;
                line-height: 1.5;
            }

            .try-div-box {
                padding: 12px;
            }

            .try-polynomial {
                font-size: 18px;
                padding: 10px;
            }

            .try-options {
                grid-template-columns: 1fr;
            }

            .try-nav {
                flex-direction: column;
            }

            .try-nav button {
                width: 100%;
            }

            .sol-quiz-item {
                padding: 12px;
            }

            .sol-quiz-head {
                display: grid;
                grid-template-columns: 1fr;
                align-items: stretch;
            }

            .sol-quiz-form {
                display: grid;
                grid-template-columns: 1fr;
                justify-content: stretch;
                width: 100%;
            }

            .sol-input,
            .sol-btn {
                width: 100%;
                box-sizing: border-box;
            }

            .sol-quiz-math {
                font-size: 17px;
                overflow-x: auto;
                white-space: nowrap;
                padding-bottom: 4px;
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

        /* ===== LATIHAN BERURUTAN ===== */
        .lat-section.disabled {
            opacity: .55;
            pointer-events: none;
            filter: grayscale(.15);
            position: relative;
        }

        .lat-lock-msg {
            margin-top: 8px;
            font-weight: 900;
            font-size: 14px;
            color: #7a2b2b;
        }

        .lat-check-row {
            display: flex;
            justify-content: flex-end;
            margin-top: 12px;
        }

        .lat-status-done {
            margin-top: 10px;
            font-weight: 900;
            color: #0f5f22;
        }

        #cardEksplorasi #quizSummary {
            display: none !important;
        }

        /* ===== TOMBOL JAWAB IKON PADA CONTOH SOAL ===== */
        .sol-quiz-form .answer-icon {
            width: 42px;
            min-width: 42px;
            height: 42px;
            padding: 0;
            border-radius: 50%;
            background: rgba(27, 122, 42, .12);
            color: #0f5f22;
            border: 1px solid rgba(27, 122, 42, .25);
            font-size: 20px;
            font-weight: 900;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
        }

        .sol-quiz-form .answer-icon:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, .08);
        }

        .sol-quiz-form .answer-icon.answered {
            background: rgba(27, 122, 42, .22);
            border-color: rgba(27, 122, 42, .45);
            color: #0f5f22;
        }

        /* Tombol penyelesaian setelah aktif */
        .sol-btn.show:not(:disabled) {
            background: rgba(27, 122, 42, .14);
            color: #0f5f22;
            border: 1px solid rgba(27, 122, 42, .35);
        }

        .sol-btn.show:disabled {
            opacity: .55;
            cursor: not-allowed;
        }

        /* Biar input dan tombol lebih rapi di laptop */
        .sol-quiz-form {
            align-items: center;
        }

        .sol-input {
            height: 42px;
            box-sizing: border-box;
        }

        .sol-btn.show {
            height: 42px;
            box-sizing: border-box;
        }

        /* ===== RESPONSIVE CONTOH SOAL ===== */
        @media (max-width: 640px) {
            .sol-quiz-form {
                display: grid;
                grid-template-columns: 1fr 42px;
                gap: 10px;
                width: 100%;
            }

            .sol-input {
                width: 100%;
                min-width: 0;
            }

            .sol-quiz-form .answer-icon {
                width: 42px !important;
                min-width: 42px !important;
                height: 42px;
                justify-self: end;
            }

            .sol-btn.show {
                grid-column: 1 / -1;
                width: 100%;
            }
        }

        /* Petunjuk pengerjaan Contoh Soal */
        .contoh-note {
            margin: 10px 0 14px;
            padding: 12px 14px;
            border-radius: 12px;
            background: #f7f9fc;
            border-left: 5px solid var(--outer-line);
            color: var(--muted);
            line-height: 1.7;

            text-align: justify;
            text-justify: inter-word;
        }

        .contoh-note b {
            color: #000;
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
                Perhatikan bentuk polinomial berikut:
            </p>

            <div class="rumus">
                $$P(x,y,z)=3xy^3+2x^2-4z+6$$
            </div>

            <p>
                Polinomial tersebut terdiri dari beberapa suku. Amati pangkat variabel pada setiap suku
                untuk mengetahui derajatnya.
            </p>

            <p style="margin-bottom:10px;">
                Amati setiap suku berikut.
            </p>

            <div class="explore-grid">

                <div class="explore-card">
                    <div class="explore-inner">
                        <div class="explore-badge">$3xy^3$</div>
                        <div class="explore-text">
                            Pangkat $x=1$ dan $y=3$. Derajat diperoleh dari jumlah pangkat variabel.
                        </div>
                    </div>
                </div>

                <div class="explore-card green-card">
                    <div class="explore-inner">
                        <div class="explore-badge">$2x^2$</div>
                        <div class="explore-text">
                            Suku ini hanya memiliki variabel $x$. Pangkat variabelnya adalah
                            <b>$2$</b>.
                        </div>
                    </div>
                </div>

                <div class="explore-card orange-card">
                    <div class="explore-inner">
                        <div class="explore-badge">$-4z$</div>
                        <div class="explore-text">
                            Suku ini memiliki variabel $z$. Karena $z=z^1$, maka pangkatnya
                            <b>$1$</b>.
                        </div>
                    </div>
                </div>

                <div class="explore-card purple-card">
                    <div class="explore-inner">
                        <div class="explore-badge">$6$</div>
                        <div class="explore-text">
                            Suku ini tidak memiliki variabel, sehingga merupakan konstanta.
                        </div>
                    </div>
                </div>

            </div>

            <p>
                Dari pengamatan ini, coba tentukan sendiri suku dengan derajat tertentu
                pada polinomial tersebut melalui pertanyaan berikut.
            </p>

            <div class="quiz3" id="quiz3">
                <div class="qitem" data-q="1" data-done="0">
                    <div class="qtitle">Soal 1</div>
                    <div class="qhint">Klik suku yang memiliki <b>derajat tertinggi</b>.</div>
                    <div class="rumus-eks">
                        <span class="term" data-correct="1">3xy³</span> +
                        <span class="term" data-correct="0">2x²</span> −
                        <span class="term" data-correct="0">4z</span> +
                        <span class="term" data-correct="0">6</span>
                    </div>
                    <div class="feedback"></div>
                </div>

                <div class="qitem" data-q="2" data-done="0">
                    <div class="qtitle">Soal 2</div>
                    <div class="qhint">Klik suku yang memiliki <b>derajat 1</b>.</div>
                    <div class="rumus-eks">
                        <span class="term" data-correct="0">3xy³</span> +
                        <span class="term" data-correct="0">2x²</span> −
                        <span class="term" data-correct="1">4z</span> +
                        <span class="term" data-correct="0">6</span>
                    </div>
                    <div class="feedback"></div>
                </div>

                <div class="qitem" data-q="3" data-done="0">
                    <div class="qtitle">Soal 3</div>
                    <div class="qhint">Klik suku yang memiliki derajat 0.</div>
                    <div class="rumus-eks">
                        <span class="term" data-correct="0">3xy³</span> +
                        <span class="term" data-correct="0">2x²</span> −
                        <span class="term" data-correct="0">4z</span> +
                        <span class="term" data-correct="1">6</span>
                    </div>
                    <div class="feedback"></div>
                </div>

                <div class="summary" id="quizSummary"></div>
            </div>
        </div>

        {{-- BAGIAN LANJUTAN: AWALNYA TERSEMBUNYI --}}
        <div id="bagianLanjutan" class="locked">

            {{-- CARD 2: Contoh --}}
            <div class="card card-example">
                <div class="title-box">🧪 Contoh</div>
                <div class="contoh-sub">Klik angka 1–4 untuk membuka penjelasan.</div>

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
                                Derajat monomial ini adalah <b>9</b>, karena jumlah pangkat variabel $x$ dan $y$
                                adalah $2 + 7 = 9$.
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
                                Derajat monomial ini adalah <b>7</b>, karena jumlah pangkat variabel $x$, $y$,
                                dan $z$ adalah $3 + 1 + 3 = 7$.
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

            {{-- CARD 4: Mari Mencoba (P5 RESPONSIVE) --}}
            <div class="card card-try">
                <div class="title-box">📝 Mari Mencoba</div>

                <div class="p5-responsive-wrap">
                    <div id="p5-interaktif-1b" class="p5-host"></div>
                </div>
            </div>

            <div class="after-try outside-text">
                <p>
                    Polinomial terdiri dari beberapa suku. Setiap suku merupakan monomial yang memiliki variabel
                    dengan pangkat tertentu. Untuk menentukan derajat suatu monomial, kita perlu memperhatikan
                    pangkat dari setiap variabel yang menyusunnya.
                    <br><br>
                    Dalam sebuah polinomial, suku dengan pangkat variabel paling besar disebut sebagai
                    <b>suku utama</b>. Derajat suku utama inilah yang menentukan derajat polinomial secara
                    keseluruhan. Artinya, meskipun polinomial memiliki banyak suku, derajat polinomial tetap
                    ditentukan oleh suku yang memiliki pangkat paling tinggi.
                </p>
            </div>

            {{-- CARD 5: Contoh Soal --}}
            <div class="card card-example">
                <div class="title-box">📘 Contoh Soal</div>

                <div class="contoh-note">
                    <b>Petunjuk pengerjaan:</b>
                    Tentukan derajat dari setiap polinomial dengan memperhatikan pangkat tertinggi pada suku-sukunya.
                    Isi jawaban derajat pada kolom yang tersedia, lalu klik tanda <b>✓</b> untuk menyimpan jawaban.
                    Setelah jawaban disimpan, tombol <b>Lihat penyelesaian</b> akan aktif dan dapat diklik untuk melihat
                    pembahasan.
                </div>

                <div class="sol-quiz" id="solQuiz">

                    {{-- SOAL 1 --}}
                    <div class="sol-quiz-item" data-sol="sol1" data-answer="5" data-done="0">
                        <div class="sol-quiz-head">
                            <div class="sol-quiz-title">Soal 1</div>

                            <div class="sol-quiz-form">
                                <input class="sol-input" type="number" inputmode="numeric" placeholder="Jawaban derajat">

                                <button type="button" class="sol-btn answer-icon" title="Simpan jawaban"
                                    aria-label="Simpan jawaban">
                                    ✓
                                </button>

                                <button type="button" class="sol-btn show" disabled>
                                    Lihat penyelesaian
                                </button>
                            </div>
                        </div>

                        <div class="sol-quiz-math">
                            $$P(x)=4x^5+3x^2-7$$
                        </div>

                        <div class="sol-feedback"></div>
                    </div>

                    {{-- SOAL 2 --}}
                    <div class="sol-quiz-item" data-sol="sol2" data-answer="5" data-done="0">
                        <div class="sol-quiz-head">
                            <div class="sol-quiz-title">Soal 2</div>

                            <div class="sol-quiz-form">
                                <input class="sol-input" type="number" inputmode="numeric" placeholder="Jawaban derajat">

                                <button type="button" class="sol-btn answer-icon" title="Simpan jawaban"
                                    aria-label="Simpan jawaban">
                                    ✓
                                </button>

                                <button type="button" class="sol-btn show" disabled>
                                    Lihat penyelesaian
                                </button>
                            </div>
                        </div>

                        <div class="sol-quiz-math">
                            $$Q(x,y)=2x^3y^2-xy+5y^4$$
                        </div>

                        <div class="sol-feedback"></div>
                    </div>

                    {{-- SOAL 3 --}}
                    <div class="sol-quiz-item" data-sol="sol3" data-answer="6" data-done="0">
                        <div class="sol-quiz-head">
                            <div class="sol-quiz-title">Soal 3</div>

                            <div class="sol-quiz-form">
                                <input class="sol-input" type="number" inputmode="numeric" placeholder="Jawaban derajat">

                                <button type="button" class="sol-btn answer-icon" title="Simpan jawaban"
                                    aria-label="Simpan jawaban">
                                    ✓
                                </button>

                                <button type="button" class="sol-btn show" disabled>
                                    Lihat penyelesaian
                                </button>
                            </div>
                        </div>

                        <div class="sol-quiz-math">
                            $$R(a,b,c)=3a^2b^3c+7ab-4$$
                        </div>

                        <div class="sol-feedback"></div>
                    </div>
                </div>

                {{-- BAGIAN INI MUNCUL SETELAH SEMUA SOAL DIJAWAB --}}
                <div id="solUnlockAll" style="display:none;">
                    <div class="title-box" style="margin-top:18px;">🧩 Penyelesaian</div>

                    <div class="sol-grid">
                        <div class="sol-box" data-target="sol1">Soal 1</div>
                        <div class="sol-box" data-target="sol2">Soal 2</div>
                        <div class="sol-box" data-target="sol3">Soal 3</div>
                    </div>
                </div>

                {{-- PENYELESAIAN SOAL 1 --}}
                <div id="sol1" class="sol-content">
                    <div class="sol-title">Penyelesaian Soal 1</div>

                    <p class="highlight">Derajat setiap suku:</p>

                    <ul>
                        <li>$$4x^5 \rightarrow 5$$</li>
                        <li>$$3x^2 \rightarrow 2$$</li>
                        <li>$$-7 \rightarrow 0$$</li>
                    </ul>

                    <p class="highlight">
                        Derajat tertinggi = 5 → Derajat polinomial = 5
                    </p>
                </div>

                {{-- PENYELESAIAN SOAL 2 --}}
                <div id="sol2" class="sol-content">
                    <div class="sol-title">Penyelesaian Soal 2</div>

                    <p class="highlight">Derajat setiap suku:</p>

                    <ul>
                        <li>$$2x^3y^2 \rightarrow 3 + 2 = 5$$</li>
                        <li>$$-xy \rightarrow 1 + 1 = 2$$</li>
                        <li>$$5y^4 \rightarrow 4$$</li>
                    </ul>

                    <p class="highlight">
                        Derajat tertinggi = 5 → Derajat polinomial = 5
                    </p>
                </div>

                {{-- PENYELESAIAN SOAL 3 --}}
                <div id="sol3" class="sol-content">
                    <div class="sol-title">Penyelesaian Soal 3</div>

                    <p class="highlight">Derajat setiap suku:</p>

                    <ul>
                        <li>$$3a^2b^3c \rightarrow 2 + 3 + 1 = 6$$</li>
                        <li>$$7ab \rightarrow 1 + 1 = 2$$</li>
                        <li>$$-4 \rightarrow 0$$</li>
                    </ul>

                    <p class="highlight">
                        Derajat tertinggi = 6 → Derajat polinomial = 6
                    </p>
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

            {{-- CARD 7: Latihan --}}
            <div class="card card-try latihan-card-fit">
                <div class="title-box">🎯 Latihan</div>

                <div id="latihanBoard">

                    {{-- SOAL 1 --}}
                    <div class="lat-section yellow" id="latihan1" data-step="1" data-unlocked="1" data-done="0">
                        <div class="lat-title">1. Tebak Cepat (True or False)</div>

                        <div class="lat-line">
                            <span>a. Bentuk <b>9x<sup>4</sup>y<sup>2</sup></b> memiliki derajat 6.</span>
                            <select class="lat-select tf1" data-answer="true">
                                <option value="">Pilih</option>
                                <option value="true">True</option>
                                <option value="false">False</option>
                            </select>
                        </div>

                        <div class="lat-line">
                            <span>b. Suku <b>−7</b> selalu memiliki derajat 0.</span>
                            <select class="lat-select tf1" data-answer="true">
                                <option value="">Pilih</option>
                                <option value="true">True</option>
                                <option value="false">False</option>
                            </select>
                        </div>

                        <div class="lat-check-row">
                            <button type="button" class="lat-btn" id="btnCheck1">Cek Jawaban Soal 1</button>
                        </div>

                        <div class="lat-feedback" id="fb-truefalse"></div>
                        <div class="lat-status-done" id="done1"></div>
                    </div>

                    {{-- SOAL 2 --}}
                    <div class="lat-section blue disabled" id="latihan2" data-step="2" data-unlocked="0" data-done="0">
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

                        <div class="lat-check-row">
                            <button type="button" class="lat-btn" id="btnCheck2">Cek Jawaban Soal 2</button>
                        </div>

                        <div class="lat-feedback" id="fb-winner"></div>
                        <div class="lat-status-done" id="done2"></div>
                    </div>

                    {{-- SOAL 3 --}}
                    <div class="lat-section pink disabled" id="latihan3" data-step="3" data-unlocked="0" data-done="0">
                        <div class="lat-title">3. Isi Kotak Misteri (Menjumlah Pangkat)</div>

                        <p style="margin:6px 0;">
                            Tentukan derajat monomial:
                            <b>4a<sup>3</sup>b<sup>2</sup>c</b>
                        </p>

                        <div class="lat-line">
                            <span></span>
                            <input type="number" id="mysteryDegree" class="lat-input" placeholder="isi">
                        </div>

                        <div class="lat-check-row">
                            <button type="button" class="lat-btn" id="btnCheck3">Cek Jawaban Soal 3</button>
                        </div>

                        <div class="lat-feedback" id="fb-mystery"></div>
                        <div class="lat-status-done" id="done3"></div>
                    </div>

                    {{-- SOAL 4 --}}
                    <div class="lat-section green disabled" id="latihan4" data-step="4" data-unlocked="0" data-done="0">
                        <div class="lat-title">4. Detektif Polinomial</div>

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

                        <div class="lat-check-row">
                            <button type="button" class="lat-btn" id="btnCheck4">Cek Jawaban Soal 4</button>
                        </div>

                        <div class="lat-feedback" id="fb-detect"></div>
                        <div class="lat-status-done" id="done4"></div>
                    </div>

                    <div class="lat-final" id="latihanFinalScore">Selesaikan latihan secara berurutan.</div>
                </div>
            </div>
        </div>
    </div>

    {{-- p5.js + interaktif --}}
    <script src="https://cdn.jsdelivr.net/npm/p5@1.9.2/lib/p5.min.js"></script>

    <script>
        window.completeMateriUrl = "{{ route('materi.complete', $materi->id) }}";
    </script>

    {{-- pakai versi agar HP tidak membaca cache JS lama --}}
    <script src="{{ asset('js/interaktif1b.js?v=16') }}"></script>

    <script>
        (function () {
            // ===== QUIZ EKSPLORASI =====
            const quiz = document.getElementById("quiz3");
            const qitems = quiz ? Array.from(quiz.querySelectorAll(".qitem")) : [];
            const summary = document.getElementById("quizSummary");
            const bagianLanjutan = document.getElementById("bagianLanjutan");

            const unlockMateri = () => {
                if (!bagianLanjutan) return;

                bagianLanjutan.classList.add("show");

                requestAnimationFrame(() => {
                    window.dispatchEvent(new Event("resize"));
                });
            };

            const updateSummary = () => {
                const done = qitems.filter(q => q.dataset.done === "1").length;

                if (summary) {
                    if (done < qitems.length) {
                        summary.textContent = `Progress eksplorasi: ${done}/${qitems.length}`;
                    } else {
                        summary.textContent = "Semua soal sudah dijawab.";
                    }
                }

                if (qitems.length > 0 && done === qitems.length) {
                    unlockMateri();
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
                        qitem.dataset.done = "1";

                        if (isCorrect) {
                            t.classList.add("correct");

                            if (feedback) {
                                feedback.classList.add("ok");
                                feedback.textContent = "✅ Benar!";
                            }
                        } else {
                            t.classList.add("wrong");

                            if (feedback) {
                                feedback.classList.add("no");
                                feedback.textContent = "❌ Salah!";
                            }
                        }

                        updateSummary();
                    });
                });
            });

            updateSummary();

            // ===== CONTOH: TOGGLE PENJELASAN =====
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

                    requestAnimationFrame(() => {
                        window.dispatchEvent(new Event("resize"));
                    });
                });
            });

            if (btnReset) {
                btnReset.addEventListener("click", () => {
                    pills.forEach(p => p.classList.remove("active"));
                    document.querySelectorAll(".explain").forEach(ex => ex.classList.remove("show"));

                    requestAnimationFrame(() => {
                        window.dispatchEvent(new Event("resize"));
                    });
                });
            }
            // ===== CONTOH SOAL: JAWAB DULU, BARU PENYELESAIAN TERBUKA =====
            const solBoxes = Array.from(document.querySelectorAll(".sol-box"));
            const solContents = Array.from(document.querySelectorAll(".sol-content"));
            const solUnlockAll = document.getElementById("solUnlockAll");
            const solQuiz = document.getElementById("solQuiz");

            const getSolItemById = id => {
                return solQuiz ? solQuiz.querySelector(`.sol-quiz-item[data-sol="${id}"]`) : null;
            };

            const checkAllAnswered = () => {
                if (!solQuiz) return false;

                const items = Array.from(solQuiz.querySelectorAll(".sol-quiz-item"));
                return items.length > 0 && items.every(it => it.dataset.done === "1");
            };

            const refreshSolutionMenu = () => {
                if (!solUnlockAll) return;

                if (checkAllAnswered()) {
                    solUnlockAll.style.display = "block";
                } else {
                    solUnlockAll.style.display = "none";
                }

                requestAnimationFrame(() => {
                    window.dispatchEvent(new Event("resize"));
                });
            };

            const openSolution = id => {
                const content = document.getElementById(id);

                if (!content) return;

                solContents.forEach(c => c.classList.remove("show"));
                solBoxes.forEach(b => b.classList.remove("active"));

                content.classList.add("show");

                const box = solBoxes.find(b => b.dataset.target === id);
                if (box) box.classList.add("active");

                requestAnimationFrame(() => {
                    window.dispatchEvent(new Event("resize"));
                });

                content.scrollIntoView({
                    behavior: "smooth",
                    block: "start"
                });
            };

            solBoxes.forEach(box => {
                box.addEventListener("click", () => {
                    const id = box.dataset.target;
                    const relatedItem = getSolItemById(id);

                    if (!relatedItem || relatedItem.dataset.done !== "1") return;

                    openSolution(id);
                });
            });

            if (solQuiz) {
                const items = Array.from(solQuiz.querySelectorAll(".sol-quiz-item"));

                items.forEach(item => {
                    const ans = parseInt(item.dataset.answer, 10);
                    const solId = item.dataset.sol;

                    const input = item.querySelector(".sol-input");
                    const btnAnswer = item.querySelector(".sol-btn.answer-icon");
                    const btnShow = item.querySelector(".sol-btn.show");
                    const fb = item.querySelector(".sol-feedback");

                    if (!input || !btnAnswer || !btnShow) return;
                    const setFeedback = (ok, html) => {
                        if (!fb) return;

                        fb.classList.remove("ok", "no");
                        fb.classList.add(ok ? "ok" : "no");
                        fb.innerHTML = html;
                    };

                    const clearFeedback = () => {
                        if (!fb) return;

                        fb.classList.remove("ok", "no");
                        fb.textContent = "";
                    };

                    input.addEventListener("input", () => {
                        item.dataset.done = "0";
                        btnShow.disabled = true;
                        btnAnswer.classList.remove("answered");
                        clearFeedback();

                        const content = document.getElementById(solId);
                        if (content) content.classList.remove("show");

                        solBoxes.forEach(b => b.classList.remove("active"));
                        refreshSolutionMenu();
                    });

                    btnAnswer.addEventListener("click", () => {
                        const raw = (input.value || "").trim();

                        if (raw === "") {
                            item.dataset.done = "0";
                            btnShow.disabled = true;
                            btnAnswer.classList.remove("answered");
                            setFeedback(false, "⚠️ Isi jawaban terlebih dahulu.");
                            refreshSolutionMenu();
                            return;
                        }

                        const val = parseInt(raw, 10);

                        item.dataset.done = "1";
                        btnShow.disabled = false;
                        btnAnswer.classList.add("answered");

                        if (val === ans) {
                            setFeedback(
                                true,
                                `
                    <div>✅ <b>Benar.</b></div>
                    <div>Klik tombol <b>Lihat penyelesaian</b> untuk melihat pembahasan.</div>
                    `
                            );
                        } else {
                            setFeedback(
                                false,
                                `
                    <div>❌ <b>Salah.</b></div>
                    <div>Klik tombol <b>Lihat penyelesaian</b> untuk melihat pembahasan.</div>
                    `
                            );
                        }

                        refreshSolutionMenu();
                    });

                    btnShow.addEventListener("click", () => {
                        if (btnShow.disabled) return;
                        openSolution(solId);
                    });
                });
            }
        })();
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
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({})
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

        // ===== LATIHAN SOAL =====
        (function () {
            const latihan1 = document.getElementById("latihan1");
            const latihan2 = document.getElementById("latihan2");
            const latihan3 = document.getElementById("latihan3");
            const latihan4 = document.getElementById("latihan4");

            const btnCheck1 = document.getElementById("btnCheck1");
            const btnCheck2 = document.getElementById("btnCheck2");
            const btnCheck3 = document.getElementById("btnCheck3");
            const btnCheck4 = document.getElementById("btnCheck4");

            const tfSelects = Array.from(document.querySelectorAll(".tf1"));

            const fbTrueFalse = document.getElementById("fb-truefalse");
            const fbWinner = document.getElementById("fb-winner");
            const fbMystery = document.getElementById("fb-mystery");
            const fbDetect = document.getElementById("fb-detect");
            const finalScore = document.getElementById("latihanFinalScore");

            const done1 = document.getElementById("done1");
            const done2 = document.getElementById("done2");
            const done3 = document.getElementById("done3");
            const done4 = document.getElementById("done4");

            const lock2 = document.getElementById("lock2");
            const lock3 = document.getElementById("lock3");
            const lock4 = document.getElementById("lock4");

            const winnerTerm = document.getElementById("winnerTerm");
            const winnerDegree = document.getElementById("winnerDegree");
            const mysteryDegree = document.getElementById("mysteryDegree");
            const detectHighest = document.getElementById("detectHighest");
            const detectPoly = document.getElementById("detectPoly");

            const setFb = (el, ok, html) => {
                if (!el) return;

                el.classList.remove("ok", "no");
                el.classList.add(ok ? "ok" : "no");
                el.innerHTML = html;
            };

            const clearFb = el => {
                if (!el) return;

                el.classList.remove("ok", "no");
                el.innerHTML = "";
            };

            const setDoneText = (el, text) => {
                if (!el) return;
                el.textContent = text;
            };

            const normalize = s =>
                (s || "")
                    .toLowerCase()
                    .trim()
                    .replace(/\s+/g, "")
                    .replace(/×/g, "x")
                    .replace(/–/g, "-")
                    .replace(/−/g, "-")
                    .replace(/\+\-/g, "-");

            const superscriptToNormal = s => {
                const map = {
                    "⁰": "0",
                    "¹": "1",
                    "²": "2",
                    "³": "3",
                    "⁴": "4",
                    "⁵": "5",
                    "⁶": "6",
                    "⁷": "7",
                    "⁸": "8",
                    "⁹": "9",
                    "⁻": "-"
                };

                return (s || "").replace(/[⁰¹²³⁴⁵⁶⁷⁸⁹⁻]+/g, match => {
                    return "^" + match.split("").map(ch => map[ch] || "").join("");
                });
            };

            const normalizePoly = raw => {
                let s = normalize(raw);

                if (!s) return "";

                s = superscriptToNormal(s);

                s = s
                    .replace(/\*\*/g, "^")
                    .replace(/([a-z])\((-?\d+)\)/g, "$1^$2")
                    .replace(/([a-z])(\d+)/g, (match, varName, power, offset, full) => {
                        const prev = full[offset - 1] || "";
                        if (prev === "^") return match;
                        return `${varName}^${power}`;
                    })
                    .replace(/\+\-/g, "-")
                    .replace(/^\+/, "")
                    .replace(/(^|[+\-])1([a-z])/g, "$1$2")
                    .replace(/(^|[+\-])-1([a-z])/g, "$1-$2")
                    .replace(/\^1(?!\d)/g, "")
                    .replace(/\^0+(\d+)/g, "^$1");

                return s;
            };

            const unlockSection = (section, lockEl) => {
                if (!section) return;

                section.classList.remove("disabled");
                section.dataset.unlocked = "1";

                if (lockEl) {
                    lockEl.style.display = "none";
                }
            };

            const lockSection = (section, lockEl, message) => {
                if (!section) return;

                section.classList.add("disabled");
                section.dataset.unlocked = "0";
                section.dataset.done = "0";

                if (lockEl) {
                    lockEl.style.display = "block";
                    lockEl.textContent = message;
                }
            };

            const updateFinalScore = () => {
                const score =
                    (latihan1?.dataset.done === "1" ? 1 : 0) +
                    (latihan2?.dataset.done === "1" ? 1 : 0) +
                    (latihan3?.dataset.done === "1" ? 1 : 0) +
                    (latihan4?.dataset.done === "1" ? 1 : 0);

                if (!finalScore) return;

                if (score < 4) {
                    finalScore.innerHTML = `Progress latihan: ${score}/4 soal selesai benar.`;
                } else {
                    finalScore.innerHTML = "🎉 Hebat! Semua soal latihan selesai benar (4/4).";
                }
            };

            const resetSoal2 = () => {
                if (winnerTerm) winnerTerm.value = "";
                if (winnerDegree) winnerDegree.value = "";

                clearFb(fbWinner);
                setDoneText(done2, "");
                lockSection(latihan2, lock2, "🔒 Selesaikan Soal 1 dengan benar terlebih dahulu.");
            };

            const resetSoal3 = () => {
                if (mysteryDegree) mysteryDegree.value = "";

                clearFb(fbMystery);
                setDoneText(done3, "");
                lockSection(latihan3, lock3, "🔒 Selesaikan Soal 2 dengan benar terlebih dahulu.");
            };

            const resetSoal4 = () => {
                if (detectHighest) detectHighest.value = "";
                if (detectPoly) detectPoly.value = "";

                clearFb(fbDetect);
                setDoneText(done4, "");
                lockSection(latihan4, lock4, "🔒 Selesaikan Soal 3 dengan benar terlebih dahulu.");
            };

            if (latihan1) {
                latihan1.dataset.unlocked = "1";
            }

            resetSoal2();
            resetSoal3();
            resetSoal4();

            // ===== SOAL 1 =====
            if (btnCheck1) {
                btnCheck1.addEventListener("click", () => {
                    let allAnswered = true;
                    let tfCorrect = 0;

                    tfSelects.forEach(sel => {
                        if (!sel.value) allAnswered = false;

                        if (sel.value && sel.value === sel.dataset.answer) {
                            tfCorrect++;
                        }
                    });

                    if (!allAnswered) {
                        setFb(fbTrueFalse, false, "⚠️ Pilih semua jawaban terlebih dahulu.");
                        return;
                    }

                    if (tfCorrect === 2) {
                        latihan1.dataset.done = "1";
                        setDoneText(done1, "Soal 1 selesai.");

                        setFb(
                            fbTrueFalse,
                            true,
                            `
                                                                    <div>✅ Semua jawaban benar.</div>
                                                                    <div><b>Penjelasan:</b></div>
                                                                    <div>a. <b>Benar</b>, karena derajat <b>9x<sup>4</sup>y<sup>2</sup></b> adalah jumlah pangkat variabel: <b>4 + 2 = 6</b>.</div>
                                                                    <div>b. <b>Benar</b>, karena <b>−7</b> adalah konstanta, sehingga derajatnya <b>0</b>.</div>
                                                                    `
                        );

                        unlockSection(latihan2, lock2);
                    } else {
                        latihan1.dataset.done = "0";
                        setDoneText(done1, "");

                        setFb(
                            fbTrueFalse,
                            false,
                            `
                                                                    <div>❌ Jawaban Soal 1 belum tepat.</div>
                                                                    <div><b>Penjelasan jawaban benar:</b></div>
                                                                    <div>a. Jawaban yang benar adalah <b>True</b>, karena derajat <b>9x<sup>4</sup>y<sup>2</sup></b> = <b>4 + 2 = 6</b>.</div>
                                                                    <div>b. Jawaban yang benar adalah <b>True</b>, karena <b>−7</b> adalah konstanta dan derajat konstanta = <b>0</b>.</div>
                                                                    `
                        );

                        resetSoal2();
                        resetSoal3();
                        resetSoal4();
                    }

                    updateFinalScore();

                    requestAnimationFrame(() => {
                        window.dispatchEvent(new Event("resize"));
                    });
                });
            }

            // ===== SOAL 2 =====
            if (btnCheck2) {
                btnCheck2.addEventListener("click", () => {
                    if (!latihan2 || latihan2.dataset.unlocked !== "1") return;

                    if (!winnerTerm.value || !winnerDegree.value) {
                        setFb(fbWinner, false, "⚠️ Lengkapi semua jawaban terlebih dahulu.");
                        return;
                    }

                    const winnerOk =
                        normalizePoly(winnerTerm.value) === normalizePoly("3x^5") &&
                        parseInt(winnerDegree.value || "", 10) === 5;

                    if (winnerOk) {
                        latihan2.dataset.done = "1";
                        setDoneText(done2, "Soal 2 selesai.");

                        setFb(
                            fbWinner,
                            true,
                            `
                                                                    <div>✅ Jawaban benar.</div>
                                                                    <div><b>Penjelasan:</b> Pada <b>T(x) = 3x<sup>5</sup> − 2x<sup>3</sup> + 10x</b>, suku dengan pangkat tertinggi adalah <b>3x<sup>5</sup></b>. Jadi suku paling kuat adalah <b>3x<sup>5</sup></b> dan derajat polinomialnya <b>5</b>.</div>
                                                                    `
                        );

                        unlockSection(latihan3, lock3);
                    } else {
                        latihan2.dataset.done = "0";
                        setDoneText(done2, "");

                        setFb(
                            fbWinner,
                            false,
                            `
                                                                    <div>❌ Soal 2 belum tepat.</div>
                                                                    <div><b>Penjelasan jawaban benar:</b> Suku paling kuat adalah <b>3x<sup>5</sup></b> karena pangkatnya paling besar. Maka derajat polinomialnya juga <b>5</b>.</div>
                                                                    `
                        );

                        resetSoal3();
                        resetSoal4();
                    }

                    updateFinalScore();

                    requestAnimationFrame(() => {
                        window.dispatchEvent(new Event("resize"));
                    });
                });
            }

            // ===== SOAL 3 =====
            if (btnCheck3) {
                btnCheck3.addEventListener("click", () => {
                    if (!latihan3 || latihan3.dataset.unlocked !== "1") return;

                    if (!mysteryDegree.value) {
                        setFb(fbMystery, false, "⚠️ Isi jawaban terlebih dahulu.");
                        return;
                    }

                    const mysteryOk = parseInt(mysteryDegree.value || "", 10) === 6;

                    if (mysteryOk) {
                        latihan3.dataset.done = "1";
                        setDoneText(done3, "Soal 3 selesai.");

                        setFb(
                            fbMystery,
                            true,
                            `
                                                                    <div>✅ Jawaban benar.</div>
                                                                    <div><b>Penjelasan:</b> Derajat monomial <b>4a<sup>3</sup>b<sup>2</sup>c</b> diperoleh dari jumlah pangkat variabel, yaitu <b>3 + 2 + 1 = 6</b>.</div>
                                                                    `
                        );

                        unlockSection(latihan4, lock4);
                    } else {
                        latihan3.dataset.done = "0";
                        setDoneText(done3, "");

                        setFb(
                            fbMystery,
                            false,
                            `
                                                                    <div>❌ Soal 3 belum tepat.</div>
                                                                    <div><b>Penjelasan jawaban benar:</b> Derajat <b>4a<sup>3</sup>b<sup>2</sup>c</b> adalah <b>3 + 2 + 1 = 6</b>.</div>
                                                                    `
                        );

                        resetSoal4();
                    }

                    updateFinalScore();

                    requestAnimationFrame(() => {
                        window.dispatchEvent(new Event("resize"));
                    });
                });
            }

            // ===== SOAL 4 =====
            if (btnCheck4) {
                btnCheck4.addEventListener("click", async () => {
                    if (!latihan4 || latihan4.dataset.unlocked !== "1") return;

                    if (!detectHighest.value || !detectPoly.value) {
                        setFb(fbDetect, false, "⚠️ Lengkapi semua jawaban terlebih dahulu.");
                        return;
                    }

                    const detectHighestOk = parseInt(detectHighest.value || "", 10) === 5;
                    const detectPolyOk = parseInt(detectPoly.value || "", 10) === 5;

                    if (detectHighestOk && detectPolyOk) {
                        latihan4.dataset.done = "1";
                        setDoneText(done4, "Soal 4 selesai.");

                        setFb(
                            fbDetect,
                            true,
                            `
                                                                    <div>✅ Jawaban benar.</div>
                                                                    <div><b>Penjelasan:</b></div>
                                                                    <div>• <b>5x<sup>2</sup>y<sup>3</sup></b> memiliki derajat <b>2 + 3 = 5</b></div>
                                                                    <div>• <b>−xy</b> memiliki derajat <b>1 + 1 = 2</b></div>
                                                                    <div>• <b>4</b> memiliki derajat <b>0</b></div>
                                                                    <div>Jadi derajat tertinggi adalah <b>5</b> dan derajat polinomial <b>G(x,y)</b> juga <b>5</b>.</div>
                                                                    `
                        );

                        const saved = await saveProgressMateri();

                        if (saved) {
                            bukaNextButton();
                        } else {
                            console.warn("Progress materi gagal disimpan.");
                        }
                    } else {
                        latihan4.dataset.done = "0";
                        setDoneText(done4, "");

                        setFb(
                            fbDetect,
                            false,
                            `
                                                                    <div>❌ Soal 4 belum tepat.</div>
                                                                    <div><b>Penjelasan jawaban benar:</b></div>
                                                                    <div>• Derajat <b>5x<sup>2</sup>y<sup>3</sup></b> = <b>2 + 3 = 5</b></div>
                                                                    <div>• Derajat <b>−xy</b> = <b>2</b></div>
                                                                    <div>• Derajat <b>4</b> = <b>0</b></div>
                                                                    <div>Maka derajat tertinggi = <b>5</b> dan derajat polinomial = <b>5</b>.</div>
                                                                    `
                        );
                    }

                    updateFinalScore();

                    requestAnimationFrame(() => {
                        window.dispatchEvent(new Event("resize"));
                    });
                });
            }

            updateFinalScore();
        })();
    </script>
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