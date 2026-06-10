@extends('layout.halamanmateri')

@section('content')
    {{-- =========================
    KaTeX
    ========================== --}}
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
            --green-2: #2f8f46;
            --green-3: #5a8f62;
            --green-soft: #f2fbf4;
            --green-soft-2: #edf6ee;

            --olive: #97a97c;
            --olive-dark: #7f9066;
            --olive-soft: #f5f7ef;

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

            --blank-bg: #fffef7;
            --blank-border: rgba(27, 122, 42, .22);
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

        .materi-contoh-card {
            background: linear-gradient(180deg, #fbfff9, #fff);
            border-left: 7px solid var(--green);
        }

        .latihan-card {
            border: 1px solid rgba(0, 0, 0, .08);
            background: linear-gradient(180deg, var(--latihan-soft), #fff);
            border-left: 7px solid var(--latihan);
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
        .step-input,
        .hasil-input,
        .blank-input {
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

        .hasil-input {
            max-width: 220px;
            text-align: center;
            border-radius: 10px;
        }

        .blank-input {
            max-width: 180px;
            text-align: center;
            background: #fff;
        }

        .quiz-actions,
        .step-actions,
        .mini-actions,
        .blank-actions,
        .susun-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        .mini-actions {
            justify-content: center;
        }

        .quiz-check,
        .quiz-reset,
        .quiz-checkall,
        .step-check,
        .step-reset,
        .step-checkall,
        .mini-btn,
        .blank-check,
        .blank-reset,
        .blank-checkall,
        .tip-btn {
            padding: 10px 18px;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, .14);
            background: #fff;
            cursor: pointer;
            font-weight: 900;
            font-family: "Times New Roman", Times, serif;
        }

        .mini-btn {
            padding: 8px 14px;
            border-radius: 10px;
        }

        .quiz-check:hover,
        .quiz-reset:hover,
        .quiz-checkall:hover,
        .step-check:hover,
        .step-reset:hover,
        .step-checkall:hover,
        .mini-btn:hover,
        .blank-check:hover,
        .blank-reset:hover,
        .blank-checkall:hover,
        .tip-btn:hover,
        .game-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(0, 0, 0, .06);
            transition: .12s ease;
        }

        .quiz-feedback,
        .step-feedback,
        .mini-feedback,
        .blank-feedback,
        .susun-feedback {
            font-weight: 900;
            padding: 8px 12px;
            border-radius: 12px;
            display: inline-block;
        }

        .mini-feedback {
            padding: 6px 10px;
            border-radius: 10px;
        }

        .quiz-feedback.ok,
        .step-feedback.ok,
        .mini-feedback.ok,
        .blank-feedback.ok,
        .susun-feedback.ok {
            color: #0f5f22;
            background: rgba(27, 122, 42, .10);
            border: 1px solid rgba(27, 122, 42, .18);
        }

        .quiz-feedback.no,
        .step-feedback.no,
        .mini-feedback.no,
        .blank-feedback.no,
        .susun-feedback.no {
            color: #b91c1c;
            background: rgba(220, 38, 38, 0.10);
            border: 1px solid rgba(220, 38, 38, 0.18);
        }

        .quiz-summary,
        .step-summary,
        .blank-summary {
            margin-left: 10px;
            font-weight: 900;
            color: #1e3a8a;
        }

        .quiz-feedback,
        .step-feedback,
        .mini-feedback,
        .blank-feedback,
        .susun-feedback {
            display: none;
        }

        .quiz-input.is-correct,
        .step-input.is-correct,
        .hasil-input.is-correct,
        .blank-input.is-correct,
        .susun-input.is-correct {
            border: 2px solid #1b7a2a !important;
            background: rgba(27, 122, 42, 0.08) !important;
            box-shadow: 0 0 0 3px rgba(27, 122, 42, 0.08);
        }

        .quiz-input.is-wrong,
        .step-input.is-wrong,
        .hasil-input.is-wrong,
        .blank-input.is-wrong,
        .susun-input.is-wrong {
            border: 2px solid #dc2626 !important;
            background: rgba(220, 38, 38, 0.08) !important;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.08);
        }

        /* materi lanjutan disembunyikan dulu */
        #after-eksplorasi[aria-hidden="true"] {
            display: none;
        }

        #after-eksplorasi[aria-hidden="false"] {
            display: block;
        }

        .tip-board {
            margin: 18px 0 18px;
            border-radius: 20px;
            padding: 18px;
            border: 1px solid rgba(27, 122, 42, .12);
            background: linear-gradient(180deg, #f6fbf6 0%, #eef6ef 100%);
            box-shadow: 0 10px 24px rgba(76, 110, 79, .08);
        }

        .tip-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 14px;
        }

        .tip-label {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            border-radius: 999px;
            background: #ffffff;
            border: 1px solid rgba(27, 122, 42, .10);
            font-weight: 900;
            font-size: 20px;
            color: #2d6b39;
            box-shadow: 0 6px 14px rgba(0, 0, 0, .04);
        }

        .tip-btn {
            padding: 10px 18px;
            border-radius: 12px;
            border: 1px solid rgba(27, 122, 42, .14);
            background: #ffffff;
            color: #2f6d3b;
            cursor: pointer;
            font-weight: 900;
            font-family: "Times New Roman", Times, serif;
        }

        .tip-student-wrap {
            display: grid;
            grid-template-columns: 1fr;
            gap: 14px;
        }

        .tip-main-box {
            background: #ffffff;
            border: 1px solid rgba(27, 122, 42, .10);
            border-radius: 18px;
            padding: 18px;
        }

        .tip-main-title {
            font-size: 18px;
            font-weight: 900;
            color: #1f4f29;
            margin-bottom: 8px;
        }

        .tip-main-quote {
            font-size: 28px;
            line-height: 1.5;
            font-weight: 900;
            color: #2f8f46;
            margin: 4px 0 10px;
        }

        .tip-main-desc {
            font-size: 16px;
            color: #48554b;
            line-height: 1.9;
            margin: 0;
        }

        .tip-step-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
        }

        .tip-step-card {
            background: #ffffff;
            border: 1px solid rgba(27, 122, 42, .10);
            border-radius: 16px;
            padding: 14px 12px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, .03);
            transition: transform 0.18s ease, box-shadow 0.18s ease;
            transform-style: preserve-3d;
            will-change: transform;
            cursor: pointer;
        }

        .tip-step-card:hover {
            box-shadow: 0 14px 24px rgba(0, 0, 0, .10);
        }

        .tip-step-card .tip-step-num,
        .tip-step-card .tip-step-text {
            transition: transform 0.18s ease;
        }

        .tip-step-num {
            width: 34px;
            height: 34px;
            margin: 0 auto 8px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #dfeee2;
            color: #1f5c2c;
            font-weight: 900;
            font-size: 16px;
        }

        .tip-step-text {
            font-size: 15px;
            font-weight: 700;
            color: #374151;
            line-height: 1.7;
        }

        .tip-example-box {
            background: #ffffff;
            border: 1px dashed rgba(27, 122, 42, .20);
            border-radius: 16px;
            padding: 16px;
        }

        .tip-example-title {
            font-size: 17px;
            font-weight: 900;
            color: #1f4f29;
            margin-bottom: 8px;
        }

        .tip-example-desc {
            font-size: 15px;
            color: #4b5563;
            line-height: 1.8;
            margin-bottom: 8px;
        }

        .tip-flash {
            animation: tipFlash .6s ease;
        }

        @keyframes tipFlash {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.01);
                box-shadow: 0 14px 26px rgba(76, 110, 79, .14);
            }

            100% {
                transform: scale(1);
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

        .section-split {
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px dashed rgba(0, 0, 0, .12);
        }

        .submateri-title {
            font-weight: 900;
            color: #0b3d1d;
            margin-bottom: 8px;
            font-size: 18px;
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

        .step-card {
            margin-top: 14px;
            padding: 14px;
            border: 1px solid rgba(27, 122, 42, .20);
            border-radius: 14px;
            background: #fcfffc;
        }

        .step-title {
            font-weight: 900;
            color: #0b3d1d;
            margin-bottom: 8px;
        }

        .table-wrap {
            margin-top: 14px;
            overflow-x: auto;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, .10);
            box-shadow: 0 10px 28px rgba(0, 0, 0, .04);
            background: #fff;
            width: 100%;
        }

        table.materi-table {
            width: 100%;
            min-width: 430px;
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
            white-space: nowrap;
        }

        .materi-table td {
            padding: 12px 10px;
            border: 1px solid rgba(0, 0, 0, .10);
            text-align: center;
            vertical-align: middle;
            color: var(--muted);
            white-space: nowrap;
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

        .sehingga-box,
        .penjelasan-box {
            margin-top: 14px;
            border: 2px solid rgba(27, 122, 42, .35);
            border-radius: 14px;
            padding: 14px 16px;
            background: rgba(255, 255, 255, .65);
            display: none;
        }

        .penjelasan-box {
            border-style: dashed;
            background: #f7fbf7;
            padding: 12px 14px;
        }

        .penjelasan-mini-title {
            font-weight: 900;
            color: #1f4f29;
            margin-bottom: 8px;
            font-size: 16px;
        }

        .penjelasan-mini-list {
            margin: 0;
            padding-left: 18px;
            color: #374151;
        }

        .penjelasan-mini-list li {
            margin: 6px 0;
            line-height: 1.75;
            font-size: 15px;
        }

        .penjelasan-final {
            margin-top: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            background: #ffffff;
            border: 1px solid rgba(27, 122, 42, .10);
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

        .practice-wrap {
            display: grid;
            gap: 14px;
        }

        .practice-wrap.sideways {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            align-items: start;
        }

        .practice-card {
            background: #fff;
            border: 1px solid rgba(0, 0, 0, .08);
            border-radius: 14px;
            padding: 14px;
        }

        .practice-title {
            font-weight: 900;
            color: #111;
            margin-bottom: 8px;
        }

        .blank-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-top: 14px;
        }

        .blank-card {
            background: var(--blank-bg);
            border: 1px solid var(--blank-border);
            border-radius: 16px;
            padding: 14px;
        }

        .blank-title {
            font-weight: 900;
            color: #111;
            margin-bottom: 8px;
        }

        .blank-line {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            margin: 10px 0;
            color: #333;
            font-weight: 700;
        }

        .blank-line .math-part {
            display: inline-flex;
            align-items: center;
            min-height: 40px;
        }

        .blank-answer-box {
            margin-top: 12px;
            padding: 12px;
            border-radius: 12px;
            border: 1px dashed rgba(27, 122, 42, .28);
            background: rgba(255, 255, 255, .7);
            display: none;
        }

        .blank-answer-box .rumus-box {
            margin: 0;
        }

        .metode-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
            margin-top: 16px;
            align-items: start;
        }

        .metode-card {
            min-width: 0;
            background: #fff;
            border: 1px solid rgba(0, 0, 0, .08);
            border-radius: 16px;
            padding: 18px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .04);
            overflow: hidden;
        }

        .metode-card.distribusi {
            border-left: 6px solid var(--blue);
            background: linear-gradient(180deg, var(--blue-soft), #fff);
        }

        .metode-card.bersusun {
            border-left: 6px solid var(--orange);
            background: linear-gradient(180deg, var(--orange-soft), #fff);
        }

        .metode-title {
            font-size: 18px;
            font-weight: 900;
            color: #111;
            margin-bottom: 8px;
        }

        .metode-subtitle {
            font-size: 15px;
            color: #555;
            line-height: 1.8;
            margin-bottom: 12px;
        }

        .rumus-box,
        .penjelasan-final,
        .metode-rumus-box {
            overflow-x: auto;
            overflow-y: hidden;
            max-width: 100%;
        }

        .rumus-box .katex-display,
        .penjelasan-final .katex-display,
        .metode-rumus-box .katex-display {
            margin: 0;
            overflow-x: auto;
            overflow-y: hidden;
            padding-bottom: 2px;
        }

        .metode-rumus-box {
            margin-top: 12px;
            padding: 14px 16px;
            border-radius: 14px;
            background: rgba(255, 255, 255, .92);
            border: 1px solid rgba(0, 0, 0, .08);
        }

        .metode-note {
            margin-top: 14px;
            padding: 12px 14px;
            border-radius: 12px;
            background: rgba(27, 122, 42, .08);
            border: 1px solid rgba(27, 122, 42, .18);
            color: #244b2c;
            font-weight: 700;
            line-height: 1.8;
        }

        .interactive-card-c {
            width: 100% !important;
            max-width: 100% !important;
            margin: 0 !important;
            padding: 16px;
            border-radius: 16px;
            border: 1px solid rgba(27, 122, 42, .20);
            background: linear-gradient(180deg, #fcfffc, #fff);
        }

        .susun-card {
            width: 100%;
            margin-top: 12px;
            border: 1px solid rgba(27, 122, 42, .16);
            border-radius: 16px;
            padding: 16px;
            background: #fff;
        }

        .susun-wrap {
            width: 100%;
            overflow-x: auto;
            padding: 8px 2px;
        }

        .susun-table {
            width: 100%;
            margin: 0 auto;
            border-collapse: collapse;
            font-size: 20px;
            color: #222;
            min-width: 320px;
        }

        .susun-table td {
            padding: 6px 8px;
            text-align: right;
            vertical-align: middle;
        }

        .susun-table .op {
            width: 30px;
            font-weight: 900;
            color: #111;
        }

        .susun-table .line td {
            border-top: 2px solid rgba(0, 0, 0, .35);
            height: 8px;
            padding: 0;
        }

        .susun-input {
            width: 100%;
            max-width: 100%;
            padding: 9px 10px;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, .15);
            font-family: "Times New Roman", Times, serif;
            font-size: 16px;
            text-align: center;
        }

        .susun-result-cell {
            min-width: 190px;
        }

        .btn-nav {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 100px;
            padding: 10px 18px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            font-family: "Times New Roman", Times, serif;
            transition: all 0.2s ease;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
        }

        .prev-btn,
        .next-btn {
            background: #97a97c;
            color: #ffffff;
        }

        .prev-btn:hover,
        .next-btn:hover {
            background: #87986d;
            transform: translateY(-2px);
        }

        .game-latihan-card {
            margin-top: 28px;
            border-radius: 18px;
            background: linear-gradient(180deg, #fbfcf8, #ffffff);
            border: 1px solid rgba(0, 0, 0, .08);
            box-shadow: 0 10px 24px rgba(0, 0, 0, .05);
            padding: 18px;
        }

        .game-latihan-head {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 180px;
            padding: 10px 24px;
            border-radius: 12px;
            background: #7b7b7b;
            color: #fff;
            font-weight: 900;
            font-size: 22px;
            margin-bottom: 14px;
        }

        .game-latihan-box {
            border: 3px solid #2d9bd3;
            border-radius: 14px;
            background: #fff;
            padding: 16px;
        }

        .game-intro {
            margin: 0 0 14px;
            color: #4b5563;
            font-size: 15px;
            line-height: 1.8;
        }

        .game-grid {
            display: grid;
            gap: 14px;
        }

        .game-soal {
            border: 1px solid rgba(27, 122, 42, .14);
            border-radius: 14px;
            background: linear-gradient(180deg, #fcfffc, #ffffff);
            padding: 14px;
        }

        .game-soal-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 10px;
            flex-wrap: wrap;
        }

        .game-label {
            font-weight: 900;
            color: #111;
            font-size: 16px;
        }

        .game-status {
            font-weight: 900;
            font-size: 14px;
            padding: 6px 10px;
            border-radius: 999px;
            background: #f3f4f6;
            color: #4b5563;
        }

        .game-status.ok {
            background: rgba(27, 122, 42, .10);
            color: #0f5f22;
            border: 1px solid rgba(27, 122, 42, .18);
        }

        .game-status.no {
            background: rgba(224, 112, 43, .10);
            color: #8c2b00;
            border: 1px solid rgba(224, 112, 43, .18);
        }

        .game-rumus {
            padding: 12px 14px;
            border-radius: 12px;
            background: #f8fafc;
            border: 1px solid rgba(0, 0, 0, .08);
            margin-bottom: 12px;
            overflow-x: auto;
        }

        .game-rumus .katex-display {
            margin: 0;
        }

        .game-options {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
        }

        .game-option {
            border: 1px solid rgba(0, 0, 0, .10);
            border-radius: 12px;
            background: #ffffff;
            padding: 12px 10px;
            text-align: center;
            font-weight: 900;
            color: #1f2937;
            cursor: pointer;
            transition: .15s ease;
            min-height: 54px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .game-option:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, .06);
            border-color: #2d9bd3;
        }

        .game-option.selected {
            border-color: #2d9bd3;
            background: #eef7fd;
        }

        .game-option.correct {
            border-color: rgba(27, 122, 42, .30);
            background: rgba(27, 122, 42, .10);
            color: #0f5f22;
        }

        .game-option.wrong {
            border-color: rgba(224, 112, 43, .30);
            background: rgba(224, 112, 43, .10);
            color: #8c2b00;
        }

        .game-bottom {
            margin-top: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .game-btn {
            padding: 9px 16px;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, .14);
            background: #fff;
            cursor: pointer;
            font-weight: 900;
            font-family: "Times New Roman", Times, serif;
        }

        .game-score {
            font-weight: 900;
            color: #1e3a8a;
        }

        .game-final-note {
            margin-top: 12px;
            padding: 10px 12px;
            border-radius: 12px;
            background: rgba(27, 122, 42, .08);
            border: 1px solid rgba(27, 122, 42, .18);
            color: #244b2c;
            font-weight: 700;
            display: none;
        }

        .hint-box {
            margin: 10px 0 14px;
            padding: 10px 12px;
            border-radius: 12px;
            background: rgba(27, 122, 42, .06);
            border-left: 4px solid #97a97c;
            color: #374151;
            font-size: 15px;
            line-height: 1.8;
        }

        .hint-title {
            font-weight: 900;
            color: #1f4f29;
            margin-bottom: 6px;
            font-size: 15px;
        }

        .hint-chip-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 8px;
        }

        .hint-chip {
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border-radius: 999px;
            background: #f6fbf6;
            border: 1px solid rgba(27, 122, 42, .16);
            color: #2f5d39;
            font-size: 13px;
            font-weight: 700;
            line-height: 1.4;
        }

        .susun-step-label {
            font-weight: 900;
            color: #1f4f29;
            margin: 10px 0 6px;
            font-size: 15px;
        }

        .hint-toggle {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 6px;
        }

        .hint-btn {
            display: inline-block;
            padding: 3px 8px;
            font-size: 12px;
            border-radius: 6px;
            background: transparent;
            border: 1px solid #97a97c;
            color: #1f4f29;
            cursor: pointer;
        }

        .hint-btn:hover {
            background: #dff0e3;
            transform: translateY(-1px);
        }

        .hint-content {
            display: none;
            margin-left: 10px;
            padding: 6px 10px;
            border-radius: 8px;
            background: rgba(27, 122, 42, .05);
            border-left: 3px solid #97a97c;
            color: #374151;
            font-size: 13px;
            line-height: 1.5;
            vertical-align: middle;
            max-width: none;
            white-space: normal;
        }

        @media (max-width: 920px) {

            .metode-grid,
            .practice-wrap.sideways,
            .blank-grid,
            .tip-step-grid {
                grid-template-columns: 1fr;
            }

            .interactive-card-c {
                max-width: 100%;
            }
        }

        @media (max-width: 760px) {
            .game-options {
                grid-template-columns: 1fr;
            }

            .game-latihan-head {
                min-width: 150px;
                font-size: 20px;
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
                padding: 16px;
            }

            .lead-text {
                font-size: 16px;
            }

            .susun-table {
                min-width: 280px;
                font-size: 18px;
            }

            .susun-input {
                width: 140px;
                font-size: 15px;
            }

            .tip-main-quote {
                font-size: 22px;
            }

            .tip-label {
                font-size: 17px;
            }
        }

        /* ================================
                                                                                                                           RESPONSIVE: LAPTOP, TABLET, HP
                                                                                                                           Tempel di paling bawah <style>
                                                                                                                        ================================ */

        /* Laptop / desktop besar */
        @media (min-width: 1025px) {
            .materi-wrap {
                max-width: 980px;
                padding: 24px 18px 48px;
            }

            .top-title .label {
                font-size: 26px;
            }

            .top-title .judul {
                font-size: 30px;
            }

            .practice-wrap.sideways {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .blank-grid,
            .metode-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .tip-step-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }
        }

        /* Tablet */
        @media (max-width: 1024px) {
            .materi-wrap {
                max-width: 100%;
                padding: 20px 16px 40px;
            }

            .top-title {
                align-items: flex-start;
            }

            .top-title .label {
                font-size: 24px;
            }

            .top-title .judul {
                font-size: 28px;
                line-height: 1.3;
            }

            p,
            .definisi-card p {
                font-size: 16px;
                line-height: 1.8;
            }

            .card,
            .tip-board,
            .game-latihan-card {
                padding: 18px;
            }

            .metode-grid,
            .practice-wrap.sideways,
            .blank-grid {
                grid-template-columns: 1fr;
            }

            .tip-step-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .game-options {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .quiz-input,
            .step-input,
            .hasil-input,
            .blank-input,
            .susun-input {
                max-width: 100%;
            }

            .table-wrap,
            .rumus-box,
            .metode-rumus-box,
            .game-rumus,
            .susun-wrap {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
        }

        /* HP besar */
        @media (max-width: 768px) {
            .materi-wrap {
                padding: 16px 12px 32px;
                line-height: 1.7;
            }

            .top-title {
                gap: 8px;
                margin-bottom: 10px;
            }

            .top-title .label {
                font-size: 22px;
            }

            .top-title .judul {
                font-size: 24px;
            }

            .lead-text {
                font-size: 16px;
                line-height: 1.75;
            }

            p {
                font-size: 15.5px;
                line-height: 1.75;
                text-align: left;
            }

            .card,
            .tip-board,
            .definisi-card,
            .game-latihan-card {
                border-radius: 14px;
                padding: 16px;
                margin-bottom: 16px;
            }

            .title-box,
            .steps-title,
            .submateri-title,
            .metode-title {
                font-size: 17px;
            }

            .contoh-badge {
                width: 100%;
                padding: 9px 14px;
                font-size: 14px;
                text-align: center;
            }

            .rumus-box {
                justify-content: flex-start;
                font-size: 16px;
                padding: 12px;
            }

            .tip-main-quote {
                font-size: 22px;
                line-height: 1.45;
            }

            .tip-step-grid {
                grid-template-columns: 1fr;
            }

            .tip-step-card {
                text-align: left;
                display: flex;
                gap: 12px;
                align-items: center;
            }

            .tip-step-num {
                margin: 0;
                flex: 0 0 34px;
            }

            .quiz-actions,
            .step-actions,
            .mini-actions,
            .blank-actions,
            .susun-actions,
            .game-bottom {
                gap: 8px;
            }

            .quiz-check,
            .quiz-reset,
            .quiz-checkall,
            .step-check,
            .step-reset,
            .step-checkall,
            .mini-btn,
            .blank-check,
            .blank-reset,
            .blank-checkall,
            .tip-btn,
            .game-btn {
                width: 100%;
                padding: 10px 14px;
            }

            .quiz-summary,
            .step-summary,
            .blank-summary,
            .game-score {
                margin-left: 0;
                width: 100%;
                display: block;
            }

            .game-options {
                grid-template-columns: 1fr;
            }

            .game-option {
                min-height: 48px;
                padding: 10px;
            }

            .game-latihan-head {
                width: 100%;
                min-width: 0;
                font-size: 19px;
            }

            table.materi-table {
                min-width: 520px;
            }

            .susun-table {
                min-width: 320px;
                font-size: 18px;
            }

            .susun-input {
                width: 100%;
                min-width: 150px;
            }

            .blank-line {
                align-items: flex-start;
            }

            .blank-line .math-part {
                width: 100%;
            }

            .blank-input {
                width: 100%;
                max-width: 100% !important;
            }
        }

        /* HP kecil */
        @media (max-width: 480px) {
            .materi-wrap {
                padding: 12px 10px 28px;
            }

            .top-title {
                flex-direction: row;
                align-items: flex-start;
            }

            .top-title .label {
                font-size: 20px;
            }

            .top-title .judul {
                font-size: 21px;
                line-height: 1.25;
            }

            .lead-text,
            p,
            .game-intro,
            .metode-subtitle,
            .tip-main-desc,
            .tip-example-desc {
                font-size: 15px;
                line-height: 1.7;
            }

            .card,
            .tip-board,
            .definisi-card,
            .question,
            .contoh-box,
            .practice-card,
            .blank-card,
            .metode-card,
            .susun-card,
            .game-latihan-box,
            .game-soal {
                padding: 12px;
                border-radius: 12px;
            }

            .definisi-label {
                left: 12px;
                padding: 7px 18px;
                font-size: 13px;
            }

            .rumus-box,
            .metode-rumus-box,
            .game-rumus {
                font-size: 15px;
                padding: 10px;
            }

            .quiz-input,
            .step-input,
            .hasil-input,
            .blank-input,
            .susun-input {
                font-size: 15px;
                padding: 10px 12px;
            }

            .tip-label {
                font-size: 16px;
                padding: 8px 12px;
            }

            .tip-main-quote {
                font-size: 19px;
            }

            .latihan-title {
                flex-direction: column;
                align-items: flex-start;
            }

            .latihan-title .pill {
                width: 100%;
                text-align: center;
            }

            .game-soal-top {
                align-items: flex-start;
            }

            .game-status {
                width: 100%;
                text-align: center;
            }

            table.materi-table {
                min-width: 560px;
                font-size: 14px;
            }

            .materi-table th,
            .materi-table td {
                padding: 9px 8px;
            }

            .susun-table {
                min-width: 300px;
                font-size: 16px;
            }

            .susun-result-cell {
                min-width: 170px;
            }

            .btn-nav {
                width: 100%;
                min-width: 0;
            }
        }

        .susun-table-bersusun {
            width: min(760px, 100%);
            margin: 0 auto;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .susun-table-bersusun td {
            padding: 8px 10px;
            text-align: center;
            vertical-align: middle;
        }

        .susun-table-bersusun .col-op {
            width: 55px;
        }

        .susun-table-bersusun .col-x2,
        .susun-table-bersusun .col-x,
        .susun-table-bersusun .col-c {
            width: calc((100% - 55px) / 3);
        }

        .susun-term {
            font-size: 1.7rem;
            font-weight: 600;
        }

        .susun-table-bersusun .op {
            font-size: 1.7rem;
            font-weight: 700;
        }

        .susun-line td,
        .susun-table-bersusun .line td {
            border-top: 3px solid #9a9a9a;
            height: 12px;
            padding: 0;
        }

        .susun-hint-cell {
            text-align: left !important;
            padding-top: 14px !important;
        }

        .susun-result-cell {
            position: relative;
        }

        .susun-input {
            width: 100%;
            min-height: 46px;
            border: 2px solid #dce9dd;
            border-radius: 14px;
            padding: 8px 14px;
            font-size: 1.2rem;
            text-align: center;
            background: #ffffff;
            outline: none;
        }

        .susun-input:focus {
            border-color: #7fa06b;
            box-shadow: 0 0 0 3px rgba(127, 160, 107, 0.18);
        }

        .final-input {
            font-weight: 700;
        }

        /* =========================
                                                                               CARD JAWABAN CONTOH C
                                                                               ========================= */

        .contoh-answer-card {
            width: 100%;
            display: flex;
            align-items: stretch;
            gap: 18px;
            background: #ffffff;
            border: 1px solid #dfe8dc;
            border-radius: 20px;
            padding: 18px;
            margin-top: 16px;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.04);
        }

        .contoh-left-area {
            width: 390px;
            flex-shrink: 0;
        }

        .contoh-right-area {
            flex: 1;
            min-width: 0;
            border-left: 4px solid #93b47e;
            padding-left: 18px;
        }

        .contoh-small-title {
            font-size: 0.98rem;
            font-weight: 700;
            color: #3f4a3f;
            margin-bottom: 12px;
        }

        /* =========================
                                                                               TABEL KECIL
                                                                               ========================= */

        .contoh-table-box {
            width: 100%;
            display: flex;
            justify-content: flex-start;
        }

        .contoh-answer-table {
            width: 360px;
            max-width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            table-layout: fixed;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.06);
        }

        .contoh-answer-table th,
        .contoh-answer-table td {
            text-align: center;
            vertical-align: middle;
        }

        .contoh-answer-table thead th {
            background: #82cc67;
            color: #173517;
            height: 46px;
            font-size: 0.95rem;
            font-weight: 700;
            border-right: 1px solid #6fb65b;
            border-bottom: 1px solid #6fb65b;
        }

        .contoh-answer-table tbody th {
            background: #82cc67;
            color: #173517;
            width: 72px;
            height: 58px;
            font-size: 0.95rem;
            font-weight: 700;
            border-right: 1px solid #6fb65b;
            border-bottom: 1px solid #6fb65b;
        }

        .contoh-answer-table tbody td {
            background: #f5f5f5;
            height: 58px;
            padding: 7px;
            border-right: 1px solid #d7d7d7;
            border-bottom: 1px solid #d7d7d7;
        }

        .contoh-answer-table tr th:last-child,
        .contoh-answer-table tr td:last-child {
            border-right: none;
        }

        .contoh-answer-table tbody tr:last-child th,
        .contoh-answer-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* =========================
                                                                               INPUT DI DALAM TABEL
                                                                               ========================= */

        .table-answer-input {
            width: 76px;
            max-width: 100%;
            height: 32px;
            border: 1.8px solid #dce9dd;
            border-radius: 10px;
            background: #ffffff;
            text-align: center;
            font-size: 0.9rem;
            padding: 4px 7px;
            outline: none;
        }

        .table-answer-input:focus {
            border-color: #7fa06b;
            box-shadow: 0 0 0 3px rgba(127, 160, 107, 0.16);
        }

        /* =========================
                                                                               HINT KATEX
                                                                               ========================= */

        .hint-katex {
            width: 100%;
            margin-bottom: 10px;
        }

        .hint-content {
            line-height: 1.7;
        }

        .hint-content .katex {
            font-size: 1em;
        }

        /* =========================
                                                                               INPUT HASIL DI SAMPING
                                                                               ========================= */

        .contoh-result-row {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 10px;
            margin: 10px 0 16px;
            width: 100%;
        }

        .equal-symbol {
            font-size: 1.35rem;
            font-weight: 700;
            color: #3d3d3d;
            width: 24px;
            flex-shrink: 0;
            text-align: center;
        }

        .result-answer-input {
            flex: 1;
            min-width: 240px;
            height: 38px;
            border: 1.8px solid #dce9dd;
            border-radius: 10px;
            background: #ffffff;
            text-align: left;
            font-size: 0.95rem;
            padding: 6px 12px;
            outline: none;
        }

        .result-answer-input:focus {
            border-color: #7fa06b;
            box-shadow: 0 0 0 3px rgba(127, 160, 107, 0.16);
        }

        /* =========================
                                                                               FEEDBACK DI SAMPING INPUT
                                                                               ========================= */

        .susun-feedback {
            display: inline-block;
            min-width: 76px;
            font-size: 0.82rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .susun-feedback.benar {
            color: #2e9b47;
        }

        .susun-feedback.salah {
            color: #d64545;
        }

        .result-feedback {
            margin-left: 2px;
        }

        /* =========================
                                                                               TOMBOL CEK DI SAMPING / KIRI
                                                                               ========================= */

        .susun-actions-side {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 12px;
            margin-top: 6px;
            flex-wrap: wrap;
        }

        .blank-summary {
            font-size: 0.9rem;
            font-weight: 600;
            color: #4f5f4f;
        }

        /* =========================
                                                                               RESPONSIVE
                                                                               ========================= */

        @media (max-width: 850px) {
            .contoh-answer-card {
                flex-direction: column;
            }

            .contoh-left-area {
                width: 100%;
            }

            .contoh-right-area {
                border-left: none;
                border-top: 4px solid #93b47e;
                padding-left: 0;
                padding-top: 16px;
            }

            .contoh-table-box {
                justify-content: center;
            }

            .contoh-answer-table {
                width: 360px;
            }
        }

        @media (max-width: 520px) {
            .contoh-answer-card {
                padding: 14px;
            }

            .contoh-answer-table {
                width: 100%;
            }

            .contoh-answer-table thead th {
                height: 42px;
                font-size: 0.88rem;
            }

            .contoh-answer-table tbody th,
            .contoh-answer-table tbody td {
                height: 52px;
            }

            .table-answer-input {
                width: 66px;
                height: 30px;
                font-size: 0.82rem;
            }

            .contoh-result-row {
                gap: 7px;
            }

            .result-answer-input {
                min-width: 0;
                font-size: 0.88rem;
            }

            .susun-feedback {
                min-width: auto;
                font-size: 0.78rem;
            }
        }

        /* =========================
                                                                       LATIHAN TERAKHIR BERURUTAN
                                                                       ========================= */

        .game-soal {
            position: relative;
        }

        .game-soal.locked {
            opacity: 0.55;
            filter: grayscale(0.25);
            pointer-events: none;
        }

        .game-soal.locked::after {
            content: "Selesaikan soal sebelumnya terlebih dahulu";
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.75);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 14px;
            color: #4b5563;
            font-weight: 900;
            z-index: 5;
        }

        .game-soal.done {
            border-color: rgba(27, 122, 42, .35);
            background: linear-gradient(180deg, #f3fff5, #ffffff);
        }

        .game-check-one-wrap {
            margin-top: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .game-check-one {
            padding: 9px 16px;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, .14);
            background: #fff;
            cursor: pointer;
            font-weight: 900;
            font-family: "Times New Roman", Times, serif;
        }

        .game-check-one:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(0, 0, 0, .06);
            transition: .12s ease;
        }

        .game-check-one:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        #quiz-summary {
            display: none !important;
        }

        .game-petunjuk-box {
            margin: 0 0 16px;
            padding: 16px 18px;
            border-radius: 18px;
            background: #f3f7ff;
            border: 1.5px solid #c8d8ff;
            color: #4b5563;
            font-size: 17px;
            line-height: 1.9;
        }

        .game-petunjuk-box b {
            color: #4a4a4a;
            font-weight: 900;
        }

        .game-petunjuk-box .jawaban-line {
            margin-top: 6px;
        }

        @media (max-width: 768px) {
            .game-petunjuk-box {
                font-size: 15.5px;
                line-height: 1.75;
                padding: 14px 15px;
                border-radius: 15px;
            }
        }

        p,
        .lead-text,
        .petunjuk-box,
        .game-petunjuk-box,
        .game-petunjuk-box .jawaban-line,
        .hint-content,
        .step-explain,
        .metode-subtitle,
        .tip-main-desc,
        .tip-example-desc {
            text-align: justify !important;
        }
    </style>

    <div class="materi-wrap">

        <div class="top-title">
            <div class="label">3.</div>
            <div class="judul">Perkalian Polinomial</div>
        </div>

        <p class="lead-text">
            Perkalian polinomial adalah proses mengalikan setiap suku pada polinomial pertama
            dengan setiap suku pada polinomial kedua, lalu menyederhanakan hasilnya.
        </p>

        {{-- =========================
        EKSPLORASI
        ========================== --}}
        <div class="card card-eksplorasi">
            <div class="title-box blue">🧭 Eksplorasi</div>

            <p>
                Perhatikan dua bentuk aljabar berikut.
            </p>

            <p style="margin-bottom:6px;"><b>Bentuk pertama:</b></p>
            <div class="rumus-box">$$A(x)=3x$$</div>

            <p style="margin-bottom:6px;"><b>Bentuk kedua:</b></p>
            <div class="rumus-box">$$B(x)=2x^2-5x+4$$</div>

            <p>
                Untuk memahami hubungan kedua bentuk tersebut, coba substitusikan nilai
                <span class="highlight">$x=1$</span> dan amati hasilnya.
            </p>

            <div class="question" id="eksplorasi-quiz">
                <div class="qtitle">Amati dan Temukan Polanya</div>

                <ol class="quiz-list">
                    <li class="quiz-item" data-answer="3">
                        <div class="quiz-q">Jika $x=1$, berapa nilai $A(1)$?</div>
                        <input class="quiz-input" type="text" placeholder="Isi jawaban" />
                        <div class="quiz-actions">
                            <span class="quiz-feedback"></span>
                        </div>
                    </li>

                    <li class="quiz-item" data-answer="1">
                        <div class="quiz-q">Jika $x=1$, berapa nilai $B(1)$?</div>
                        <input class="quiz-input" type="text" placeholder="Isi jawaban" />
                        <div class="quiz-actions">
                            <span class="quiz-feedback"></span>
                        </div>
                    </li>

                    <li class="quiz-item" data-answer="3">
                        <div class="quiz-q">
                            Berdasarkan hasil di atas, berapa nilai $A(1) \times B(1)$?
                        </div>
                        <input class="quiz-input" type="text" placeholder="Isi jawaban" />
                        <div class="quiz-actions">
                            <span class="quiz-feedback"></span>
                        </div>
                    </li>
                </ol>

                <div class="quiz-actions" style="margin-top:12px;">
                    <button type="button" id="quiz-check-all" class="quiz-checkall">
                        Cek Semua
                    </button>
                    <span id="quiz-summary" class="quiz-summary"></span>
                </div>
            </div>
        </div>

        <div id="after-eksplorasi" aria-hidden="true">

            {{-- =========================
            TRIK CEPAT
            ========================== --}}
            <div class="tip-board" id="tipBoard">
                <div class="tip-head">
                    <div class="tip-label">💡 Trik Cepat</div>
                </div>

                <div class="tip-student-wrap">
                    <div class="tip-main-box">
                        <div class="tip-main-title">Yang harus kamu ingat:</div>
                        <div class="tip-main-quote">
                            “Kalikan semua suku, satu per satu, jangan ada yang terlewat.”
                        </div>
                        <p class="tip-main-desc">
                            Saat melihat perkalian polinomial, jangan buru-buru.
                            Kerjakan dengan urut. Ambil satu suku, lalu kalikan ke semua suku yang ada.
                            Setelah itu, baru gabungkan hasilnya.
                        </p>
                    </div>

                    <div class="tip-step-grid">
                        <div class="tip-step-card">
                            <div class="tip-step-num">1</div>
                            <div class="tip-step-text">Lihat dulu suku yang akan dikalikan.</div>
                        </div>
                        <div class="tip-step-card">
                            <div class="tip-step-num">2</div>
                            <div class="tip-step-text">Kalikan angkanya terlebih dahulu.</div>
                        </div>
                        <div class="tip-step-card">
                            <div class="tip-step-num">3</div>
                            <div class="tip-step-text">Kalikan variabelnya, lalu jumlahkan pangkatnya.</div>
                        </div>
                        <div class="tip-step-card">
                            <div class="tip-step-num">4</div>
                            <div class="tip-step-text">Tulis semua hasil, lalu sederhanakan.</div>
                        </div>
                    </div>

                    <div class="tip-example-box">
                        <div class="tip-example-title">Ingat pola ini:</div>
                        <div class="tip-example-desc">
                            Kalau ada satu suku di depan kurung, berarti suku itu harus masuk ke semua suku di dalam
                            kurung.
                        </div>
                        <div class="rumus-box" style="margin-bottom:0;">
                            $$a(b+c+d)=ab+ac+ad$$
                        </div>
                    </div>
                </div>
            </div>

            <div class="definisi-card">
                <div class="definisi-label">DEFINISI</div>
                <p><b>Perkalian polinomial</b> adalah operasi antara bentuk aljabar dengan cara:</p>
                <ol>
                    <li>Mengalikan setiap suku pada bentuk pertama dengan setiap suku pada bentuk kedua.</li>
                    <li>Menggunakan sifat distributif untuk membuka kurung.</li>
                    <li>Menggabungkan suku-suku sejenis jika ada.</li>
                </ol>
            </div>

            <div class="card">
                <div class="steps-title">Langkah-Langkah Perkalian Polinomial</div>
                <ol style="margin:0 0 0 18px;">
                    <li>Perhatikan bentuk polinomial yang akan dikalikan.</li>
                    <li>Kalikan setiap suku pada polinomial pertama ke setiap suku pada polinomial kedua.</li>
                    <li>Tentukan hasil kali koefisien dan pangkat variabelnya.</li>
                    <li>Gabungkan suku-suku sejenis jika ada.</li>
                    <li>Tulis hasil akhir dalam bentuk polinomial yang sudah disederhanakan.</li>
                </ol>
            </div>

            {{-- =========================
            A. MONOMIAL × MONOMIAL
            ========================== --}}
            <div class="card materi-contoh-card">
                <div class="contoh-badge">a. Perkalian Monomial dengan Monomial</div>
                <p>
                    Jika dua monomial dikalikan, maka:
                    <b>koefisien dikalikan</b> dan <b>pangkat variabel dijumlahkan</b>.
                </p>
                <div class="rumus-box">
                    $$(ax^m)(bx^n)=abx^{m+n}$$
                </div>
                <p>
                    Jadi, fokusnya ada dua: hitung angka di depan, lalu gabungkan variabel dengan aturan pangkat.
                </p>

                <div class="section-split">
                    <div class="submateri-title">Contoh</div>

                    <div class="contoh-box" id="contoh-a">
                        <div class="contoh-row-title">Hitunglah hasil dari:</div>
                        <div class="rumus-box">$$(3x^2)(4x^3)$$</div>

                        <p style="font-style: italic; margin: 8px 0 12px; color:#4b5563;">
                            Untuk menulis pangkat, ketik angka setelah variabel, misalnya x2 untuk x² dan x3 untuk x³.
                        </p>

                        <div class="step-card step-item" data-answer="12">
                            <div class="step-title">Langkah 1: Hitung koefisien</div>
                            <div class="step-explain">
                                Perhatikan angka yang ada di depan variabel.
                                Pada bentuk <b>$(3x^2)(4x^3)$</b>, koefisiennya adalah <b>3</b> dan <b>4</b>.
                                Kalikan kedua angka tersebut:
                                <br>
                            </div>
                            <input class="step-input" type="text" placeholder="Jawaban kamu" />
                            <div class="step-actions">
                                <span class="step-feedback"></span>
                            </div>
                        </div>

                        <div class="step-card step-item" data-answer="x^5">
                            <div class="step-title">Langkah 2: Hitung pangkat variabel</div>
                            <div class="step-explain">
                                Sekarang perhatikan variabelnya.
                                Karena sama-sama memiliki variabel <b>x</b>, maka pangkatnya dijumlahkan:
                                <br>
                            </div>
                            <input class="step-input" type="text" placeholder="Jawaban kamu" />
                            <div class="step-actions">
                                <span class="step-feedback"></span>
                            </div>
                        </div>

                        <div class="step-card step-item" data-answer="12x^5">
                            <div class="step-title">Langkah 3: Gabungkan hasil akhir</div>
                            <div class="step-explain">
                                Gabungkan hasil dari langkah 1 dan langkah 2.
                                <br>
                                Koefisien = <b>12</b>
                                <br>
                                Variabel = <b>$x^5$</b>
                                <br>
                            </div>
                            <input class="step-input" type="text" placeholder="Jawaban kamu" />
                            <div class="step-actions">
                                <span class="step-feedback"></span>
                            </div>
                        </div>

                        <div class="step-actions">
                            <button type="button" class="step-checkall" data-target="contoh-a">Cek Semua</button>
                            <span class="step-summary" id="summary-contoh-a"></span>
                        </div>

                        <div class="sehingga-box" id="result-contoh-a">
                            <div class="contoh-row-title" style="margin-top:0;">Sehingga hasilnya:</div>
                            <div class="rumus-box">$$12x^5$$</div>
                        </div>

                        <div class="penjelasan-box" id="penjelasan-a">
                            <div class="penjelasan-mini-title">Penjelasan Contoh</div>
                            <ol class="penjelasan-mini-list">
                                <li>Koefisien: $$3 \times 4 = 12$$</li>
                                <li>Variabel: $$x^2 \cdot x^3 = x^{2+3}=x^5$$</li>
                                <li>Gabungkan keduanya menjadi $$12x^5$$</li>
                            </ol>
                            <div class="penjelasan-final">
                                $$\boxed{(3x^2)(4x^3)=12x^5}$$
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- =========================
            A. LATIHAN
            ========================== --}}
            <div class="card latihan-card">
                <div class="latihan-title">
                    <span class="pill">MARI MENCOBA</span>
                </div>

                <div class="petunjuk-box"
                    style="margin:0 0 14px; padding:10px 12px; border-radius:12px; background:rgba(27,122,42,.06); border-left:4px solid #97a97c; color:#374151; line-height:1.8;">
                    <b>Petunjuk pengerjaan:</b> Isi koefisien, pangkat variabel, lalu hasil akhirnya. Untuk menulis pangkat,
                    ketik angka setelah variabel, misalnya x2 untuk x² dan x3 untuk x³.
                </div>

                <div class="practice-wrap sideways">
                    <div class="practice-card practice-block" id="practice-a1">
                        <div class="practice-title">1. $$(2x^3)(5x^2)$$</div>

                        <div class="step-card step-item" data-answer="10">
                            <div class="step-title">Koefisien</div>
                            <input class="step-input" type="text" placeholder="Jawaban kamu" />
                            <div class="step-actions">
                                <span class="step-feedback"></span>
                            </div>
                        </div>

                        <div class="step-card step-item" data-answer="x^5">
                            <div class="step-title">Pangkat variabel</div>
                            <input class="step-input" type="text" placeholder="Jawaban kamu" />
                            <div class="step-actions">
                                <span class="step-feedback"></span>
                            </div>
                        </div>

                        <div class="step-card step-item" data-answer="10x^5">
                            <div class="step-title">Hasil akhir</div>
                            <input class="step-input" type="text" placeholder="Jawaban kamu" />
                            <div class="step-actions">
                                <span class="step-feedback"></span>
                            </div>
                        </div>

                        <div class="step-actions">
                            <button type="button" class="step-checkall" data-target="practice-a1">Cek Semua</button>
                            <span class="step-summary" id="summary-practice-a1"></span>
                        </div>
                    </div>

                    <div class="practice-card practice-block" id="practice-a2">
                        <div class="practice-title">2. $$(4x^4)(3x)$$</div>

                        <div class="step-card step-item" data-answer="12">
                            <div class="step-title">Koefisien</div>
                            <input class="step-input" type="text" placeholder="Jawaban kamu" />
                            <div class="step-actions">
                                <span class="step-feedback"></span>
                            </div>
                        </div>

                        <div class="step-card step-item" data-answer="x^5">
                            <div class="step-title">Pangkat variabel</div>
                            <input class="step-input" type="text" placeholder="Jawaban kamu" />
                            <div class="step-actions">
                                <span class="step-feedback"></span>
                            </div>
                        </div>

                        <div class="step-card step-item" data-answer="12x^5">
                            <div class="step-title">Hasil akhir</div>
                            <input class="step-input" type="text" placeholder="Jawaban kamu" />
                            <div class="step-actions">
                                <span class="step-feedback"></span>
                            </div>
                        </div>

                        <div class="step-actions">
                            <button type="button" class="step-checkall" data-target="practice-a2">Cek Semua</button>
                            <span class="step-summary" id="summary-practice-a2"></span>
                        </div>
                    </div>

                    <div class="practice-card practice-block" id="practice-a3">
                        <div class="practice-title">3. $$(6x^2)(x^5)$$</div>

                        <div class="step-card step-item" data-answer="6">
                            <div class="step-title">Koefisien</div>
                            <input class="step-input" type="text" placeholder="Jawaban kamu" />
                            <div class="step-actions">
                                <span class="step-feedback"></span>
                            </div>
                        </div>

                        <div class="step-card step-item" data-answer="x^7">
                            <div class="step-title">Pangkat variabel</div>
                            <input class="step-input" type="text" placeholder="Jawaban kamu" />
                            <div class="step-actions">
                                <span class="step-feedback"></span>
                            </div>
                        </div>

                        <div class="step-card step-item" data-answer="6x^7">
                            <div class="step-title">Hasil akhir</div>
                            <input class="step-input" type="text" placeholder="Jawaban kamu" />
                            <div class="step-actions">
                                <span class="step-feedback"></span>
                            </div>
                        </div>

                        <div class="step-actions">
                            <button type="button" class="step-checkall" data-target="practice-a3">Cek Semua</button>
                            <span class="step-summary" id="summary-practice-a3"></span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- =========================
            B. MONOMIAL × POLINOMIAL
            ========================== --}}
            <div class="card materi-contoh-card">
                <div class="contoh-badge">b. Perkalian Monomial dengan Polinomial</div>
                <p>
                    Jika ada satu suku di depan kurung, maka suku itu harus dikalikan ke
                    <b>semua suku</b> yang ada di dalam kurung.
                </p>
                <div class="rumus-box">
                    $$a(b+c+d)=ab+ac+ad$$
                </div>
                <p>
                    Ini disebut sifat distributif. Setelah semua hasil perkalian diperoleh,
                    barulah ditulis menjadi bentuk polinomial.
                </p>

                <div class="section-split">
                    <div class="submateri-title">Contoh</div>

                    <div class="contoh-box" id="contoh-b">
                        <div class="contoh-row-title">Gunakan aturan distributif.</div>
                        <div class="rumus-box">$$3x(2x^2-5x+4)$$</div>

                        <p style="font-style: italic; margin: 8px 0 12px; color:#4b5563;">
                            Untuk menulis pangkat, ketik angka setelah variabel, misalnya x2 untuk x² dan x3 untuk x³.
                        </p>

                        <div class="table-wrap">
                            <table class="materi-table">
                                <thead>
                                    <tr>
                                        <th>Perkalian</th>
                                        <th>Operasi</th>
                                        <th>Hasil (Isi)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="contoh-item-b" data-answer="6x^3" data-canonical="6x^3" data-latex="6x^3">
                                        <td>$3x(2x^2)$</td>
                                        <td>$(3\cdot2)x^{1+2}$</td>
                                        <td>
                                            <input class="hasil-input" type="text" placeholder="Jawaban kamu" />
                                            <div class="katex-answer" aria-hidden="true"></div>
                                            <div class="mini-actions">
                                                <span class="mini-feedback"></span>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="contoh-item-b" data-answer="-15x^2" data-canonical="-15x^2"
                                        data-latex="-15x^2">
                                        <td>$3x(-5x)$</td>
                                        <td>$(3\cdot-5)x^{1+1}$</td>
                                        <td>
                                            <input class="hasil-input" type="text" placeholder="Jawaban kamu" />
                                            <div class="katex-answer" aria-hidden="true"></div>
                                            <div class="mini-actions">
                                                <span class="mini-feedback"></span>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="contoh-item-b" data-answer="12x" data-canonical="12x" data-latex="12x">
                                        <td>$3x(4)$</td>
                                        <td>$(3\cdot4)x$</td>
                                        <td>
                                            <input class="hasil-input" type="text" placeholder="Jawaban kamu" />
                                            <div class="katex-answer" aria-hidden="true"></div>
                                            <div class="mini-actions">
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
                                <input id="contoh-final-b" class="hasil-input" style="max-width:420px; text-align:left;"
                                    type="text" placeholder="Jawaban kamu" />
                                <span id="contoh-final-fb-b" class="mini-feedback"></span>
                            </div>

                            <div class="mini-actions" style="justify-content:flex-start; margin-top:8px;">
                                <button type="button" id="contoh-check-all-b" class="mini-btn">Cek Semua</button>
                                <span id="contoh-summary-b" style="font-weight:900; color:#1e3a8a;"></span>
                            </div>
                        </div>

                        <div class="sehingga-box" id="sehingga-box-b">
                            <div class="contoh-row-title" style="margin-top:0;">Sehingga:</div>
                            <div class="rumus-box">
                                $$\begin{aligned}
                                3x(2x^2-5x+4)
                                &=3x(2x^2)+3x(-5x)+3x(4)\\
                                &=6x^3-15x^2+12x
                                \end{aligned}$$
                            </div>
                        </div>

                        <div class="penjelasan-box" id="penjelasan-b">
                            <div class="penjelasan-mini-title">Penjelasan Contoh</div>
                            <ol class="penjelasan-mini-list">
                                <li>$$3x \cdot 2x^2 = 6x^3$$</li>
                                <li>$$3x \cdot (-5x) = -15x^2$$</li>
                                <li>$$3x \cdot 4 = 12x$$</li>
                            </ol>
                            <div class="penjelasan-final">
                                $$\boxed{3x(2x^2-5x+4)=6x^3-15x^2+12x}$$
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- =========================
            B. LATIHAN
            ========================== --}}
            <div class="card latihan-card">
                <div class="latihan-title">
                    <span class="pill">MARI MENCOBA</span>
                </div>

                <div class="petunjuk-box"
                    style="margin:0 0 14px; padding:10px 12px; border-radius:12px; background:rgba(27,122,42,.06); border-left:4px solid #97a97c; color:#374151; line-height:1.8;">
                    <b>Petunjuk pengerjaan:</b> Distribusikan suku di depan kurung ke setiap suku di dalam kurung, lalu
                    tuliskan hasil akhirnya. Untuk menulis pangkat, ketik angka setelah variabel, misalnya x2 untuk x² dan
                    x3 untuk x³.
                </div>

                <div class="practice-wrap sideways">
                    <div class="practice-card practice-block" id="practice-b1">
                        <div class="practice-title">1. $$4x(3x^2-2x+5)$$</div>

                        <div class="step-card step-item" data-answer="12x^3">
                            <div class="step-title">Hasil perkalian pertama: $4x(3x^2)$</div>
                            <input class="step-input" type="text" placeholder="Jawaban kamu" />
                            <div class="step-actions">
                                <span class="step-feedback"></span>
                            </div>
                        </div>

                        <div class="step-card step-item" data-answer="-8x^2">
                            <div class="step-title">Hasil perkalian kedua: $4x(-2x)$</div>
                            <input class="step-input" type="text" placeholder="Jawaban kamu" />
                            <div class="step-actions">
                                <span class="step-feedback"></span>
                            </div>
                        </div>

                        <div class="step-card step-item" data-answer="20x">
                            <div class="step-title">Hasil perkalian ketiga: $4x(5)$</div>
                            <input class="step-input" type="text" placeholder="Jawaban kamu" />
                            <div class="step-actions">
                                <span class="step-feedback"></span>
                            </div>
                        </div>

                        <div class="step-card step-item" data-answer="12x^3-8x^2+20x">
                            <div class="step-title">Gabungkan semuanya</div>
                            <input class="step-input" type="text" placeholder="Jawaban kamu" />
                            <div class="step-actions">
                                <span class="step-feedback"></span>
                            </div>
                        </div>

                        <div class="step-actions">
                            <button type="button" class="step-checkall" data-target="practice-b1">Cek Semua</button>
                            <span class="step-summary" id="summary-practice-b1"></span>
                        </div>
                    </div>

                    <div class="practice-card practice-block" id="practice-b2">
                        <div class="practice-title">2. $$2x(5x^2+x-3)$$</div>

                        <div class="step-card step-item" data-answer="10x^3">
                            <div class="step-title">Hasil perkalian pertama: $2x(5x^2)$</div>
                            <input class="step-input" type="text" placeholder="Jawaban kamu" />
                            <div class="step-actions">
                                <span class="step-feedback"></span>
                            </div>
                        </div>

                        <div class="step-card step-item" data-answer="2x^2">
                            <div class="step-title">Hasil perkalian kedua: $2x(x)$</div>
                            <input class="step-input" type="text" placeholder="Jawaban kamu" />
                            <div class="step-actions">
                                <span class="step-feedback"></span>
                            </div>
                        </div>

                        <div class="step-card step-item" data-answer="-6x">
                            <div class="step-title">Hasil perkalian ketiga: $2x(-3)$</div>
                            <input class="step-input" type="text" placeholder="Jawaban kamu" />
                            <div class="step-actions">
                                <span class="step-feedback"></span>
                            </div>
                        </div>

                        <div class="step-card step-item" data-answer="10x^3+2x^2-6x">
                            <div class="step-title">Gabungkan semuanya</div>
                            <input class="step-input" type="text" placeholder="Jawaban kamu" />
                            <div class="step-actions">
                                <span class="step-feedback"></span>
                            </div>
                        </div>

                        <div class="step-actions">
                            <button type="button" class="step-checkall" data-target="practice-b2">Cek Semua</button>
                            <span class="step-summary" id="summary-practice-b2"></span>
                        </div>
                    </div>

                    <div class="practice-card practice-block" id="practice-b3">
                        <div class="practice-title">3. $$-3x(4x^2-x+2)$$</div>

                        <div class="step-card step-item" data-answer="-12x^3">
                            <div class="step-title">Hasil perkalian pertama: $-3x(4x^2)$</div>
                            <input class="step-input" type="text" placeholder="Jawaban kamu" />
                            <div class="step-actions">
                                <span class="step-feedback"></span>
                            </div>
                        </div>

                        <div class="step-card step-item" data-answer="3x^2">
                            <div class="step-title">Hasil perkalian kedua: $-3x(-x)$</div>
                            <input class="step-input" type="text" placeholder="Jawaban kamu" />
                            <div class="step-actions">
                                <span class="step-feedback"></span>
                            </div>
                        </div>

                        <div class="step-card step-item" data-answer="-6x">
                            <div class="step-title">Hasil perkalian ketiga: $-3x(2)$</div>
                            <input class="step-input" type="text" placeholder="Jawaban kamu" />
                            <div class="step-actions">
                                <span class="step-feedback"></span>
                            </div>
                        </div>

                        <div class="step-card step-item" data-answer="-12x^3+3x^2-6x">
                            <div class="step-title">Gabungkan semuanya</div>
                            <input class="step-input" type="text" placeholder="Jawaban kamu" />
                            <div class="step-actions">
                                <span class="step-feedback"></span>
                            </div>
                        </div>

                        <div class="step-actions">
                            <button type="button" class="step-checkall" data-target="practice-b3">Cek Semua</button>
                            <span class="step-summary" id="summary-practice-b3"></span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- =========================
            C. POLINOMIAL × POLINOMIAL
            ========================== --}}
            <div class="card materi-contoh-card">
                <div class="contoh-badge">c. Perkalian Polinomial dengan Polinomial</div>

                <p>
                    Perkalian polinomial dengan polinomial dilakukan dengan mengalikan setiap suku
                    pada polinomial pertama dengan setiap suku pada polinomial kedua.
                </p>

                <p>Ada dua cara yang bisa digunakan:</p>

                <div class="rumus-box">
                    $$(a+b)(c+d)=ac+ad+bc+bd$$
                </div>

                <div class="metode-grid">

                    <div class="metode-card distribusi">
                        <div class="metode-title">Metode Distribusi</div>
                        <div class="metode-subtitle">
                            Kalikan setiap suku pada bentuk pertama ke setiap suku pada bentuk kedua.
                        </div>

                        <div class="rumus-box">
                            $$(2x^2-3x+1)(x-4)$$
                        </div>

                        <div class="metode-rumus-box">
                            $$\begin{aligned}
                            (2x^2-3x+1)(x-4)
                            &=2x^2(x-4)-3x(x-4)+1(x-4)\\
                            &=2x^3-8x^2-3x^2+12x+x-4\\
                            &=2x^3-11x^2+13x-4
                            \end{aligned}$$
                        </div>
                    </div>

                    <div class="metode-card bersusun">
                        <div class="metode-title">Metode Bersusun</div>
                        <div class="metode-subtitle">
                            Susun seperti perkalian panjang, lalu gabungkan hasil yang sejenis.
                        </div>

                        <div class="rumus-box">
                            $$(3x+2)(2x^2-x+5)$$
                        </div>

                        <div class="table-wrap">
                            <table class="materi-table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>$2x^2$</th>
                                        <th>$-x$</th>
                                        <th>$5$</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>$3x$</th>
                                        <td>$6x^3$</td>
                                        <td>$-3x^2$</td>
                                        <td>$15x$</td>
                                    </tr>
                                    <tr>
                                        <th>$2$</th>
                                        <td>$4x^2$</td>
                                        <td>$-2x$</td>
                                        <td>$10$</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="metode-rumus-box">
                            $$\begin{aligned}
                            &=6x^3-3x^2+15x+4x^2-2x+10\\
                            &=6x^3+x^2+13x+10
                            \end{aligned}$$
                        </div>
                    </div>
                </div>

                <div class="metode-note">
                    Kedua metode sama-sama benar. Yang penting, semua suku dikalikan dengan tepat lalu hasil sejenis
                    digabungkan.
                </div>

                <div class="section-split">
                    <div class="submateri-title">Contoh</div>

                    <div class="interactive-card-c" id="contoh-c">
                        <div class="contoh-row-title">Selesaikan perkalian berikut:</div>

                        <div class="rumus-box">
                            $$(x+2)(x+3)$$
                        </div>

                        <p style="font-style: italic; margin: 8px 0 12px; color:#4b5563;">
                            Untuk menulis pangkat, ketik angka setelah variabel, misalnya x2 untuk x² dan x3 untuk x³.
                        </p>

                        <div class="contoh-answer-card">

                            {{-- BAGIAN KIRI: TABEL JAWABAN --}}
                            <div class="contoh-left-area">
                                <div class="contoh-small-title">Lengkapi tabel perkalian berikut.</div>

                                <div class="contoh-table-box">
                                    <table class="contoh-answer-table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>$x$</th>
                                                <th>$+2$</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <th>$x$</th>

                                                <td class="susun-item-c" data-answer="x^2">
                                                    <input class="susun-input table-answer-input" type="text"
                                                        placeholder="..." />
                                                    <span class="susun-feedback"></span>
                                                </td>

                                                <td class="susun-item-c" data-answer="2x">
                                                    <input class="susun-input table-answer-input" type="text"
                                                        placeholder="..." />
                                                    <span class="susun-feedback"></span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>$+3$</th>

                                                <td class="susun-item-c" data-answer="3x">
                                                    <input class="susun-input table-answer-input" type="text"
                                                        placeholder="..." />
                                                    <span class="susun-feedback"></span>
                                                </td>

                                                <td class="susun-item-c" data-answer="6">
                                                    <input class="susun-input table-answer-input" type="text"
                                                        placeholder="..." />
                                                    <span class="susun-feedback"></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- BAGIAN KANAN: INPUT HASIL DAN CEK --}}
                            <div class="contoh-right-area">
                                <div class="contoh-small-title">Tuliskan hasil dari tabel.</div>

                                <div class="hint-toggle hint-katex">
                                    <div class="hint-btn">Hint</div>
                                    <div class="hint-content">
                                        Kalikan suku pada baris dengan suku pada kolom.
                                        Dari tabel akan diperoleh \(x^2\), \(2x\), \(3x\), dan \(6\).
                                    </div>
                                </div>

                                <div class="susun-item-c contoh-result-row" data-answer="x^2+2x+3x+6">
                                    <span class="equal-symbol">=</span>
                                    <input class="susun-input result-answer-input" type="text" placeholder="Jawaban kamu" />
                                    <span class="susun-feedback result-feedback"></span>
                                </div>

                                <div class="hint-toggle hint-katex">
                                    <div class="hint-btn">Hint</div>
                                    <div class="hint-content">
                                        Gabungkan suku sejenis, yaitu \(2x\) dan \(3x\).
                                        Karena \(2x+3x=5x\), hasil akhirnya menjadi \(x^2+5x+6\).
                                    </div>
                                </div>

                                <div class="susun-item-c contoh-result-row" data-answer="x^2+5x+6">
                                    <span class="equal-symbol">=</span>
                                    <input class="susun-input result-answer-input" type="text" placeholder="Jawaban kamu" />
                                    <span class="susun-feedback result-feedback"></span>
                                </div>

                                <div class="susun-actions-side">
                                    <button type="button" class="mini-btn" id="contoh-c-checkall">Cek Semua</button>
                                    <span class="blank-summary" id="contoh-c-summary"></span>
                                </div>
                            </div>
                        </div>

                        <div class="penjelasan-box" id="penjelasan-c">
                            <div class="penjelasan-mini-title">Penjelasan Contoh</div>

                            <ol class="penjelasan-mini-list">
                                <li>Kalikan suku pada baris dengan suku pada kolom.</li>
                                <li>Isi setiap kotak kosong pada tabel sesuai hasil perkaliannya.</li>
                                <li>Tuliskan semua hasil perkalian dari tabel.</li>
                                <li>Gabungkan suku yang sejenis, yaitu $2x$ dan $3x$.</li>
                            </ol>

                            <div class="penjelasan-final">
                                $$\boxed{(x+2)(x+3)=x^2+5x+6}$$
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- =========================
            C. LATIHAN
            ========================== --}}
            <div class="card latihan-card">
                <div class="latihan-title">
                    <span class="pill">MARI MENCOBA</span>
                </div>

                <div class="petunjuk-box"
                    style="margin:0 0 14px; padding:10px 12px; border-radius:12px; background:rgba(27,122,42,.06); border-left:4px solid #97a97c; color:#374151; line-height:1.8;">
                    <b>Petunjuk pengerjaan:</b> Isi kotak kosong agar proses distribusi menjadi lengkap, lalu tuliskan
                    bentuk sebelum disederhanakan dan hasil akhirnya. Untuk menulis pangkat, ketik angka setelah variabel,
                    misalnya x2 untuk x² dan x3 untuk x³.
                </div>

                <div class="blank-grid">
                    <div class="blank-card" id="blank-c1">
                        <div class="blank-title">1. $$(2x+1)(x+4)$$</div>

                        <div class="blank-line blank-item" data-answer="2x^2">
                            <span class="math-part">$$2x(x)=$$</span>
                            <input class="blank-input" type="text" placeholder="Jawaban kamu" />
                            <span class="blank-feedback"></span>
                        </div>

                        <div class="blank-line blank-item" data-answer="8x">
                            <span class="math-part">$$2x(4)=$$</span>
                            <input class="blank-input" type="text" placeholder="Jawaban kamu" />
                            <span class="blank-feedback"></span>
                        </div>

                        <div class="blank-line blank-item" data-answer="x">
                            <span class="math-part">$$1(x)=$$</span>
                            <input class="blank-input" type="text" placeholder="Jawaban kamu" />
                            <span class="blank-feedback"></span>
                        </div>

                        <div class="blank-line blank-item" data-answer="4">
                            <span class="math-part">$$1(4)=$$</span>
                            <input class="blank-input" type="text" placeholder="Jawaban kamu" />
                            <span class="blank-feedback"></span>
                        </div>

                        <div class="blank-line blank-item" data-answer="2x^2+8x+x+4">
                            <span class="math-part">Bentuk sebelum disederhanakan =</span>
                            <input class="blank-input" style="max-width:260px;" type="text" placeholder="Jawaban kamu" />
                            <span class="blank-feedback"></span>
                        </div>

                        <div class="blank-line blank-item" data-answer="2x^2+9x+4">
                            <span class="math-part">Hasil akhir =</span>
                            <input class="blank-input" style="max-width:220px;" type="text" placeholder="Jawaban kamu" />
                            <span class="blank-feedback"></span>
                        </div>

                        <div class="blank-actions">
                            <button type="button" class="blank-checkall" data-target="blank-c1">Cek Semua</button>
                            <span class="blank-summary" id="summary-blank-c1"></span>
                        </div>

                        <div class="blank-answer-box" id="answer-blank-c1">
                            <div class="rumus-box">
                                $$\begin{aligned}
                                (2x+1)(x+4)&=2x^2+8x+x+4\\
                                &=2x^2+9x+4
                                \end{aligned}$$
                            </div>
                        </div>
                    </div>

                    <div class="blank-card" id="blank-c2">
                        <div class="blank-title">2. $$(x-2)(x+5)$$</div>

                        <div class="blank-line blank-item" data-answer="x^2">
                            <span class="math-part">$$x(x)=$$</span>
                            <input class="blank-input" type="text" placeholder="Jawaban kamu" />
                            <span class="blank-feedback"></span>
                        </div>

                        <div class="blank-line blank-item" data-answer="5x">
                            <span class="math-part">$$x(5)=$$</span>
                            <input class="blank-input" type="text" placeholder="Jawaban kamu" />
                            <span class="blank-feedback"></span>
                        </div>

                        <div class="blank-line blank-item" data-answer="-2x">
                            <span class="math-part">$$-2(x)=$$</span>
                            <input class="blank-input" type="text" placeholder="Jawaban kamu" />
                            <span class="blank-feedback"></span>
                        </div>

                        <div class="blank-line blank-item" data-answer="-10">
                            <span class="math-part">$$-2(5)=$$</span>
                            <input class="blank-input" type="text" placeholder="Jawaban kamu" />
                            <span class="blank-feedback"></span>
                        </div>

                        <div class="blank-line blank-item" data-answer="x^2+5x-2x-10">
                            <span class="math-part">Bentuk sebelum disederhanakan =</span>
                            <input class="blank-input" style="max-width:260px;" type="text" placeholder="Jawaban kamu" />
                            <span class="blank-feedback"></span>
                        </div>

                        <div class="blank-line blank-item" data-answer="x^2+3x-10">
                            <span class="math-part">Hasil akhir =</span>
                            <input class="blank-input" style="max-width:220px;" type="text" placeholder="Jawaban kamu" />
                            <span class="blank-feedback"></span>
                        </div>

                        <div class="blank-actions">
                            <button type="button" class="blank-checkall" data-target="blank-c2">Cek Semua</button>
                            <span class="blank-summary" id="summary-blank-c2"></span>
                        </div>

                        <div class="blank-answer-box" id="answer-blank-c2">
                            <div class="rumus-box">
                                $$\begin{aligned}
                                (x-2)(x+5)&=x^2+5x-2x-10\\
                                &=x^2+3x-10
                                \end{aligned}$$
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="game-latihan-card" id="game-latihan">
                <div class="game-latihan-head">LATIHAN</div>

                <div class="game-latihan-box">
                    <div class="game-petunjuk-box">
                        <b>Petunjuk pengerjaan:</b>
                        Perhatikan setiap bentuk perkalian polinomial pada soal. Tentukan hasil perkaliannya dengan cara
                        mengalikan setiap suku, memperhatikan tanda positif atau negatif, lalu menyederhanakan suku sejenis.
                        <div class="jawaban-line">
                        </div>
                    </div>

                    <div class="game-grid">

                        <div class="game-soal" data-answer="x^3-x^2-10x-8">
                            <div class="game-soal-top">
                                <div class="game-label">a. Hitung hasil dari</div>
                                <div class="game-status">Belum dijawab</div>
                            </div>

                            <div class="game-rumus">
                                $$(x-4)(x^2+3x+2)$$
                            </div>

                            <div class="game-options">
                                <button type="button" class="game-option"
                                    data-value="x^3+x^2-10x-8">$$x^3+x^2-10x-8$$</button>
                                <button type="button" class="game-option"
                                    data-value="x^3-x^2+10x-8">$$x^3-x^2+10x-8$$</button>
                                <button type="button" class="game-option"
                                    data-value="x^3-x^2-10x-8">$$x^3-x^2-10x-8$$</button>
                            </div>
                        </div>

                        <div class="game-soal" data-answer="10x^3-4x^2+14x">
                            <div class="game-soal-top">
                                <div class="game-label">b. Hitung hasil dari</div>
                                <div class="game-status">Belum dijawab</div>
                            </div>

                            <div class="game-rumus">
                                $$(2x)(5x^2-2x+7)$$
                            </div>

                            <div class="game-options">
                                <button type="button" class="game-option"
                                    data-value="10x^3+4x^2+14x">$$10x^3+4x^2+14x$$</button>
                                <button type="button" class="game-option"
                                    data-value="10x^3-4x^2+14x">$$10x^3-4x^2+14x$$</button>
                                <button type="button" class="game-option"
                                    data-value="10x^3-4x^2+7x">$$10x^3-4x^2+7x$$</button>
                            </div>
                        </div>

                        <div class="game-soal" data-answer="-12y^5">
                            <div class="game-soal-top">
                                <div class="game-label">c. Hitung hasil dari</div>
                                <div class="game-status">Belum dijawab</div>
                            </div>

                            <div class="game-rumus">
                                $$(-3y^2)(4y^3)$$
                            </div>

                            <div class="game-options">
                                <button type="button" class="game-option" data-value="-12y^5">$$-12y^5$$</button>
                                <button type="button" class="game-option" data-value="12y^5">$$12y^5$$</button>
                                <button type="button" class="game-option" data-value="-12y^6">$$-12y^6$$</button>
                            </div>
                        </div>

                    </div>

                    <div class="game-bottom">
                        <button type="button" class="game-btn" id="game-check-score">Lihat Skor</button>
                        <button type="button" class="game-btn" id="game-reset">Reset</button>
                        <span class="game-score" id="game-score"></span>
                    </div>

                    <div class="game-final-note" id="game-final-note">
                        Hebat! Semua soal sudah dikerjakan. Periksa lagi kalau masih ada yang salah, lalu coba
                        sampai benar semua.
                    </div>
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

                const superscriptToNormal = (s) => {
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

                    return (s || "").replace(/[⁰¹²³⁴⁵⁶⁷⁸⁹⁻]+/g, (match) => {
                        return "^" + match.split("").map(ch => map[ch] || "").join("");
                    });
                };

                const normalizePoly = (raw) => {
                    let s = normalize(raw);
                    if (!s) return "";

                    s = superscriptToNormal(s);

                    s = s
                        .replace(/\*\*/g, "^")
                        .replace(/([a-z])\((\-?\d+)\)/g, "$1^$2")
                        .replace(/([a-z])(\d+)/g, (match, varName, power, offset, full) => {
                            const prev = full[offset - 1] || "";
                            if (prev === "^") return match;
                            return `${varName}^${power}`;
                        })
                        .replace(/\+\-/g, "-")
                        .replace(/(^|[+\-])1x/g, "$1x")
                        .replace(/(^|[+\-])-1x/g, "$1-x")
                        .replace(/\^1(?!\d)/g, "")
                        .replace(/\^0+(\d+)/g, "^$1");

                    return s;
                };

                const setInputState = (input, ok) => {
                    if (!input) return;
                    input.classList.remove("is-correct", "is-wrong");
                    input.classList.add(ok ? "is-correct" : "is-wrong");
                };

                const clearInputState = (input) => {
                    if (!input) return;
                    input.classList.remove("is-correct", "is-wrong");
                };

                const setFb = (el, ok, showText = true) => {
                    if (!el) return;

                    el.classList.remove("ok", "no");

                    if (!showText) {
                        el.textContent = "";
                        el.style.display = "none";
                        return;
                    }

                    el.style.display = "inline-block";
                    el.classList.add(ok ? "ok" : "no");
                    el.textContent = ok ? "Benar" : "Salah";
                };

                const clearFb = (el) => {
                    if (!el) return;
                    el.classList.remove("ok", "no");
                    el.textContent = "";
                    el.style.display = "none";
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

                const after = document.getElementById("after-eksplorasi");

                function showAfterEksplorasi() {
                    if (after) after.setAttribute("aria-hidden", "false");
                }

                function hideAfterEksplorasi() {
                    if (after) after.setAttribute("aria-hidden", "true");
                }

                hideAfterEksplorasi();

                // =========================
                // EKSPLORASI AUTO CHECK
                // =========================
                // =========================
                // EKSPLORASI CEK SEMUA
                // Tidak koreksi otomatis.
                // Materi terbuka jika semua jawaban sudah diisi,
                // walaupun ada jawaban yang salah.
                // =========================
                // =========================
                // EKSPLORASI CEK SEMUA
                // Tidak koreksi otomatis.
                // Materi terbuka jika semua jawaban sudah diisi,
                // walaupun ada jawaban yang salah.
                // =========================
                const quiz = document.getElementById("eksplorasi-quiz");

                if (quiz) {
                    const items = Array.from(quiz.querySelectorAll(".quiz-item"));
                    const summary = document.getElementById("quiz-summary");
                    const btnCheckAll = document.getElementById("quiz-check-all");

                    const checkItem = (item) => {
                        const input = item.querySelector(".quiz-input");
                        const fb = item.querySelector(".quiz-feedback");

                        const rawValue = input ? input.value.trim() : "";
                        const user = normalizePoly(rawValue);

                        const answerRaw = item.getAttribute("data-answer") || "";
                        const ans = normalizePoly(answerRaw);

                        if (!rawValue) {
                            if (fb) {
                                fb.style.display = "inline-block";
                                fb.classList.remove("ok", "no");
                                fb.classList.add("no");
                                fb.textContent = "Wajib diisi";
                            }

                            setInputState(input, false);

                            return {
                                filled: false,
                                correct: false
                            };
                        }

                        const ok = user === ans;

                        if (fb) {
                            fb.style.display = "inline-block";
                            fb.classList.remove("ok", "no");
                            fb.classList.add(ok ? "ok" : "no");

                            if (ok) {
                                fb.textContent = "Benar";
                            } else {
                                fb.textContent = `Salah. Jawaban benar: ${answerRaw}`;
                            }
                        }

                        setInputState(input, ok);

                        return {
                            filled: true,
                            correct: ok
                        };
                    };

                    const cekSemuaEksplorasi = () => {
                        const total = items.length;

                        let filled = 0;
                        let correct = 0;

                        items.forEach(item => {
                            const result = checkItem(item);

                            if (result.filled) filled++;
                            if (result.correct) correct++;
                        });

                        // Summary disembunyikan, jadi teksnya dikosongkan saja
                        if (summary) {
                            summary.textContent = "";
                            summary.style.display = "none";
                        }

                        /*
                           Materi terbuka jika semua soal eksplorasi sudah diisi.
                           Tidak harus benar semua.
                        */
                        if (filled === total) {
                            showAfterEksplorasi();
                        } else {
                            hideAfterEksplorasi();
                        }
                    };

                    items.forEach(item => {
                        const input = item.querySelector(".quiz-input");
                        const fb = item.querySelector(".quiz-feedback");

                        if (input) {
                            input.addEventListener("input", () => {
                                clearFb(fb);
                                clearInputState(input);

                                if (summary) {
                                    summary.textContent = "";
                                    summary.style.display = "none";
                                }
                            });

                            input.addEventListener("keydown", (e) => {
                                if (e.key === "Enter") {
                                    e.preventDefault();
                                    cekSemuaEksplorasi();
                                }
                            });
                        }
                    });

                    if (btnCheckAll) {
                        btnCheckAll.addEventListener("click", cekSemuaEksplorasi);
                    }

                    hideAfterEksplorasi();
                }

                // =========================
                // TIP BOARD
                // =========================
                const tipBoard = document.getElementById("tipBoard");
                const tipFlashBtn = document.getElementById("tipFlashBtn");
                if (tipBoard && tipFlashBtn) {
                    tipFlashBtn.addEventListener("click", () => {
                        tipBoard.classList.remove("tip-flash");
                        void tipBoard.offsetWidth;
                        tipBoard.classList.add("tip-flash");
                    });
                }

                // =========================
                // GENERIC STEP BLOCK
                // =========================
                function bindStepBlock(blockId, resultBoxId = null, explanationId = null, showText = true) {
                    const block = document.getElementById(blockId);
                    if (!block) return;

                    const items = Array.from(block.querySelectorAll(".step-item"));
                    const summary = document.getElementById(`summary-${blockId}`);
                    const resultBox = resultBoxId ? document.getElementById(resultBoxId) : null;
                    const explanationBox = explanationId ? document.getElementById(explanationId) : null;

                    const checkItem = (item) => {
                        const input = item.querySelector(".step-input");
                        const fb = item.querySelector(".step-feedback");
                        const raw = input ? input.value.trim() : "";
                        const user = normalizePoly(raw);
                        const ans = normalizePoly(item.getAttribute("data-answer") || "");

                        if (!raw) {
                            clearFb(fb);
                            clearInputState(input);
                            return null;
                        }

                        const ok = user === ans;
                        setFb(fb, ok, showText);
                        setInputState(input, ok);
                        return ok;
                    };

                    const updateScore = () => {
                        let correct = 0;
                        const total = items.length;

                        items.forEach(item => {
                            const result = checkItem(item);
                            if (result === true) correct++;
                        });

                        if (summary) {
                            summary.textContent = `Skor: ${correct}/${total}`;
                        }

                        const done = correct === total;
                        if (resultBox) resultBox.style.display = done ? "block" : "none";
                        if (explanationBox) explanationBox.style.display = done ? "block" : "none";
                    };

                    items.forEach(item => {
                        const input = item.querySelector(".step-input");
                        const fb = item.querySelector(".step-feedback");

                        if (input) {
                            input.addEventListener("input", () => {
                                clearFb(fb);
                                clearInputState(input);
                            });
                        }
                    });

                    const btnAll = block.querySelector(`.step-checkall[data-target="${blockId}"]`);
                    if (btnAll) {
                        btnAll.addEventListener("click", () => {
                            updateScore();
                        });
                    }

                    if (resultBox) resultBox.style.display = "none";
                    if (explanationBox) explanationBox.style.display = "none";
                }

                bindStepBlock("contoh-a", "result-contoh-a", "penjelasan-a", false);
                bindStepBlock("practice-a1", null, null, true);
                bindStepBlock("practice-a2", null, null, true);
                bindStepBlock("practice-a3", null, null, true);
                bindStepBlock("practice-b1", null, null, true);
                bindStepBlock("practice-b2", null, null, true);
                bindStepBlock("practice-b3", null, null, true);

                // =========================
                // CONTOH B
                // =========================
                const contohB = document.getElementById("contoh-b");
                if (contohB) {
                    const rows = Array.from(contohB.querySelectorAll(".contoh-item-b"));
                    const sehinggaBox = document.getElementById("sehingga-box-b");
                    const penjelasanB = document.getElementById("penjelasan-b");

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

                    const restoreRowInput = (row) => {
                        const input = row.querySelector(".hasil-input");
                        const box = row.querySelector(".katex-answer");
                        const fb = row.querySelector(".mini-feedback");

                        if (input) {
                            input.disabled = false;
                            input.style.display = "block";
                        }

                        if (box) {
                            box.style.display = "none";
                            box.innerHTML = "";
                        }

                        clearFb(fb);
                        clearInputState(input);
                    };

                    const checkRow = (row) => {
                        const ans = normalizePoly(row.getAttribute("data-answer") || "");
                        const input = row.querySelector(".hasil-input");
                        const fb = row.querySelector(".mini-feedback");
                        const raw = input ? input.value.trim() : "";
                        const user = normalizePoly(raw);

                        if (!raw) {
                            restoreRowInput(row);
                            return null;
                        }

                        const ok = user === ans;
                        setFb(fb, ok, false);
                        setInputState(input, ok);

                        if (ok) {
                            showKatexAnswer(row);
                        } else {
                            restoreRowInput(row);
                            if (input) {
                                input.value = raw;
                                setInputState(input, false);
                            }
                            setFb(fb, false, false);
                        }

                        return ok;
                    };

                    const finalInput = document.getElementById("contoh-final-b");
                    const finalFb = document.getElementById("contoh-final-fb-b");
                    const finalCanonical = "6x^3-15x^2+12x";
                    const finalAns = normalizePoly(finalCanonical);
                    const summary = document.getElementById("contoh-summary-b");

                    const lockSehingga = () => {
                        if (sehinggaBox) sehinggaBox.style.display = "none";
                        if (penjelasanB) penjelasanB.style.display = "none";
                    };

                    const unlockSehingga = () => {
                        if (sehinggaBox) sehinggaBox.style.display = "block";
                        if (penjelasanB) penjelasanB.style.display = "block";
                    };

                    const checkFinal = () => {
                        const raw = finalInput ? finalInput.value.trim() : "";
                        const user = normalizePoly(raw);

                        if (!raw) {
                            clearFb(finalFb);
                            clearInputState(finalInput);
                            lockSehingga();
                            return null;
                        }

                        const ok = user === finalAns;
                        setFb(finalFb, ok, false);
                        setInputState(finalInput, ok);

                        if (ok && finalInput) {
                            finalInput.value = finalCanonical;
                            unlockSehingga();
                        } else {
                            lockSehingga();
                        }

                        return ok;
                    };

                    rows.forEach(row => {
                        const input = row.querySelector(".hasil-input");
                        if (input) {
                            input.addEventListener("input", () => {
                                const fb = row.querySelector(".mini-feedback");
                                clearFb(fb);
                                clearInputState(input);
                            });
                        }
                    });

                    if (finalInput) {
                        finalInput.addEventListener("input", () => {
                            clearFb(finalFb);
                            clearInputState(finalInput);
                            lockSehingga();
                        });
                    }

                    const btnAll = document.getElementById("contoh-check-all-b");
                    if (btnAll) {
                        btnAll.addEventListener("click", () => {
                            let correct = 0;

                            rows.forEach(row => {
                                const result = checkRow(row);
                                if (result === true) correct++;
                            });

                            const finalResult = checkFinal();
                            if (finalResult === true) correct++;

                            if (summary) summary.textContent = `Skor: ${correct}/${rows.length + 1}`;
                        });
                    }

                    lockSehingga();
                }

                // =========================
                // CONTOH C
                // =========================
                const contohC = document.getElementById("contoh-c");
                if (contohC) {
                    const items = Array.from(contohC.querySelectorAll(".susun-item-c"));
                    const summary = document.getElementById("contoh-c-summary");
                    const explanation = document.getElementById("penjelasan-c");

                    const checkItem = (item) => {
                        const input = item.querySelector(".susun-input");
                        const fb = item.querySelector(".susun-feedback");
                        const raw = input ? input.value.trim() : "";
                        const user = normalizePoly(raw);
                        const ans = normalizePoly(item.getAttribute("data-answer") || "");

                        if (!raw) {
                            clearFb(fb);
                            clearInputState(input);
                            return null;
                        }

                        const ok = user === ans;
                        setFb(fb, ok, false);
                        setInputState(input, ok);
                        return ok;
                    };

                    const updateScore = () => {
                        let correct = 0;
                        const total = items.length;

                        items.forEach(item => {
                            const result = checkItem(item);
                            if (result === true) correct++;
                        });

                        if (summary) {
                            summary.textContent = `Skor: ${correct}/${total}`;
                        }

                        if (explanation) {
                            explanation.style.display = correct === total ? "block" : "none";
                        }
                    };

                    items.forEach(item => {
                        const input = item.querySelector(".susun-input");
                        const fb = item.querySelector(".susun-feedback");

                        if (input) {
                            input.addEventListener("input", () => {
                                clearFb(fb);
                                clearInputState(input);
                            });
                        }
                    });

                    const btnCheckAll = document.getElementById("contoh-c-checkall");
                    if (btnCheckAll) {
                        btnCheckAll.addEventListener("click", updateScore);
                    }

                    if (summary) summary.textContent = "";
                    if (explanation) explanation.style.display = "none";
                }

                // =========================
                // BLANK PRACTICE
                // =========================
                function bindBlankBlock(blockId, answerBoxId = null, showText = true) {
                    const block = document.getElementById(blockId);
                    if (!block) return;

                    const items = Array.from(block.querySelectorAll(".blank-item"));
                    const summary = document.getElementById(`summary-${blockId}`);
                    const answerBox = answerBoxId ? document.getElementById(answerBoxId) : null;

                    const checkItem = (item) => {
                        const input = item.querySelector(".blank-input");
                        const fb = item.querySelector(".blank-feedback");
                        const raw = input ? input.value.trim() : "";
                        const user = normalizePoly(raw);
                        const ans = normalizePoly(item.getAttribute("data-answer") || "");

                        if (!raw) {
                            clearFb(fb);
                            clearInputState(input);
                            return null;
                        }

                        const ok = user === ans;
                        setFb(fb, ok, showText);
                        setInputState(input, ok);
                        return ok;
                    };

                    items.forEach(item => {
                        const input = item.querySelector(".blank-input");
                        const fb = item.querySelector(".blank-feedback");

                        if (input) {
                            input.addEventListener("input", () => {
                                clearFb(fb);
                                clearInputState(input);
                            });
                        }
                    });

                    const btnCheckAll = block.querySelector(`.blank-checkall[data-target="${blockId}"]`);
                    if (btnCheckAll) {
                        btnCheckAll.addEventListener("click", () => {
                            let correct = 0;

                            items.forEach(item => {
                                const result = checkItem(item);
                                if (result === true) correct++;
                            });

                            if (summary) {
                                summary.textContent = `Skor: ${correct}/${items.length}`;
                            }

                            if (answerBox) {
                                answerBox.style.display = correct === items.length ? "block" : "none";
                            }
                        });
                    }

                    if (summary) summary.textContent = "";
                    if (answerBox) answerBox.style.display = "none";
                }

                bindBlankBlock("blank-c1", "answer-blank-c1", true);
                bindBlankBlock("blank-c2", "answer-blank-c2", true);

            })();
        </script>
        <script>
            window.completeMateriUrl = "{{ route('materi.complete', $materi->id) }}";
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const cards = document.querySelectorAll(".tip-step-card");

                cards.forEach((card) => {
                    card.addEventListener("mousemove", function (e) {
                        const rect = card.getBoundingClientRect();
                        const x = e.clientX - rect.left;
                        const y = e.clientY - rect.top;

                        const centerX = rect.width / 2;
                        const centerY = rect.height / 2;

                        const rotateX = -((y - centerY) / centerY) * 6;
                        const rotateY = ((x - centerX) / centerX) * 6;

                        card.style.transform = `perspective(700px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-6px)`;

                        const num = card.querySelector(".tip-step-num");
                        const text = card.querySelector(".tip-step-text");

                        if (num) num.style.transform = `translateZ(18px)`;
                        if (text) text.style.transform = `translateZ(12px)`;
                    });

                    card.addEventListener("mouseleave", function () {
                        card.style.transform = "perspective(700px) rotateX(0deg) rotateY(0deg) translateY(0)";

                        const num = card.querySelector(".tip-step-num");
                        const text = card.querySelector(".tip-step-text");

                        if (num) num.style.transform = "translateZ(0)";
                        if (text) text.style.transform = "translateZ(0)";
                    });
                });
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                function normalizeMath(str) {
                    return str
                        .toLowerCase()
                        .replace(/\s+/g, "")
                        .replace(/−/g, "-")
                        .replace(/²/g, "^2")
                        .replace(/³/g, "^3")
                        .replace(/\*/g, "")
                        .replace(/×/g, "");
                }

                function renderKatexInside(element) {
                    if (typeof renderMathInElement === "function") {
                        renderMathInElement(element, {
                            delimiters: [
                                { left: "$$", right: "$$", display: true },
                                { left: "\\(", right: "\\)", display: false },
                                { left: "$", right: "$", display: false }
                            ],
                            throwOnError: false
                        });
                    }
                }

                renderKatexInside(document.getElementById("contoh-c"));

                const btn = document.getElementById("contoh-c-checkall");
                const summary = document.getElementById("contoh-c-summary");

                if (btn) {
                    btn.addEventListener("click", function () {
                        const items = document.querySelectorAll("#contoh-c .susun-item-c");
                        let benar = 0;

                        items.forEach(function (item) {
                            const input = item.querySelector(".susun-input");
                            const feedback = item.querySelector(".susun-feedback");

                            if (!input || !feedback) return;

                            const jawabanBenar = normalizeMath(item.dataset.answer);
                            const jawabanUser = normalizeMath(input.value);

                            if (jawabanUser === jawabanBenar) {
                                feedback.textContent = "✓ Benar";
                                feedback.classList.remove("salah");
                                feedback.classList.add("benar");
                                benar++;
                            } else {
                                feedback.textContent = "✗ Salah";
                                feedback.classList.remove("benar");
                                feedback.classList.add("salah");
                            }
                        });

                        if (benar === items.length) {
                            summary.textContent = "Semua jawaban benar!";
                        } else {
                            summary.textContent = "Jawaban benar " + benar + " dari " + items.length + ".";
                        }
                    });
                }
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const hints = document.querySelectorAll(".hint-toggle");

                hints.forEach((hint) => {
                    const btn = hint.querySelector(".hint-btn");
                    const content = hint.querySelector(".hint-content");

                    if (!btn || !content) return;

                    btn.addEventListener("click", () => {
                        const isOpen = content.style.display === "block";
                        content.style.display = isOpen ? "none" : "block";
                    });
                });
            });
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

            let progressSudahDisimpan = false;

            async function handleLatihanSelesai() {
                if (progressSudahDisimpan) return;

                progressSudahDisimpan = true;

                const berhasilSimpan = await saveProgressMateri();
                const finalNote = document.getElementById("game-final-note");

                if (berhasilSimpan) {
                    bukaQuizButton();

                    if (finalNote) {
                        finalNote.style.display = "block";
                        finalNote.textContent = "✅ Semua jawaban benar. Progress berhasil disimpan. Kuis sudah terbuka.";
                        finalNote.classList.add("ok");
                        finalNote.classList.remove("no");
                    }
                } else {
                    progressSudahDisimpan = false;

                    if (finalNote) {
                        finalNote.style.display = "block";
                        finalNote.textContent = "✅ Jawaban benar, tetapi progress gagal disimpan. Silakan coba lagi.";
                        finalNote.classList.remove("ok");
                        finalNote.classList.add("no");
                    }
                }
            }

            document.addEventListener("DOMContentLoaded", function () {
                const latihanBox = document.getElementById("game-latihan");
                if (!latihanBox) return;

                const soalList = Array.from(latihanBox.querySelectorAll(".game-soal"));
                const scoreEl = document.getElementById("game-score");
                const finalNote = document.getElementById("game-final-note");
                const btnCheckGlobal = document.getElementById("game-check-score");
                const btnReset = document.getElementById("game-reset");

                let currentIndex = 0;

                const simpleNormalize = (value) => {
                    return (value || "")
                        .toLowerCase()
                        .replace(/\s+/g, "")
                        .replace(/×/g, "x")
                        .replace(/–/g, "-")
                        .replace(/−/g, "-");
                };

                function setStatus(soal, text, type = "") {
                    const status = soal.querySelector(".game-status");
                    if (!status) return;

                    status.textContent = text;
                    status.classList.remove("ok", "no");

                    if (type === "ok") status.classList.add("ok");
                    if (type === "no") status.classList.add("no");
                }

                function lockSoal(index) {
                    const soal = soalList[index];
                    if (!soal) return;

                    soal.classList.add("locked");
                    soal.classList.remove("done");
                    setStatus(soal, "Terkunci");
                }

                function unlockSoal(index) {
                    const soal = soalList[index];
                    if (!soal) return;

                    soal.classList.remove("locked");
                    setStatus(soal, "Belum dijawab");
                }

                function markDone(index) {
                    const soal = soalList[index];
                    if (!soal) return;

                    soal.classList.remove("locked");
                    soal.classList.add("done");
                    setStatus(soal, "Benar", "ok");

                    const options = soal.querySelectorAll(".game-option");
                    options.forEach(option => {
                        option.disabled = true;
                    });

                    const btn = soal.querySelector(".game-check-one");
                    if (btn) {
                        btn.disabled = true;
                        btn.textContent = "Sudah Benar";
                    }
                }

                function hitungBenar() {
                    let benar = 0;

                    soalList.forEach((soal) => {
                        const selected = soal.querySelector(".game-option.selected");
                        const answer = simpleNormalize(soal.dataset.answer || "");

                        if (selected && simpleNormalize(selected.dataset.value || "") === answer) {
                            benar++;
                        }
                    });

                    return benar;
                }

                function resetLatihan() {
                    currentIndex = 0;
                    progressSudahDisimpan = false;

                    soalList.forEach((soal, index) => {
                        const options = soal.querySelectorAll(".game-option");

                        soal.classList.remove("locked", "done");

                        options.forEach(option => {
                            option.disabled = false;
                            option.classList.remove("selected", "correct", "wrong");
                        });

                        const btn = soal.querySelector(".game-check-one");
                        if (btn) {
                            btn.disabled = false;
                            btn.textContent = "Cek Jawaban";
                        }

                        if (index === 0) {
                            unlockSoal(index);
                        } else {
                            lockSoal(index);
                        }
                    });

                    if (scoreEl) {
                        scoreEl.textContent = "Kerjakan soal 1 terlebih dahulu.";
                    }

                    if (finalNote) {
                        finalNote.style.display = "none";
                        finalNote.textContent = "";
                        finalNote.classList.remove("ok", "no");
                    }
                }

                /*
                   Tombol Lihat Skor disembunyikan
                   karena sekarang ceknya satu-satu per soal.
                */
                if (btnCheckGlobal) {
                    btnCheckGlobal.style.display = "none";
                }

                /*
                   Buat tombol Cek Jawaban di setiap soal
                   tanpa perlu ubah HTML latihan.
                */
                soalList.forEach((soal, index) => {
                    const oldWrap = soal.querySelector(".game-check-one-wrap");
                    if (oldWrap) oldWrap.remove();

                    const wrap = document.createElement("div");
                    wrap.className = "game-check-one-wrap";

                    const btn = document.createElement("button");
                    btn.type = "button";
                    btn.className = "game-check-one";
                    btn.textContent = "Cek Jawaban";

                    wrap.appendChild(btn);
                    soal.appendChild(wrap);

                    const options = soal.querySelectorAll(".game-option");

                    options.forEach((opt) => {
                        opt.addEventListener("click", function () {
                            if (soal.classList.contains("locked")) return;
                            if (soal.classList.contains("done")) return;
                            if (index !== currentIndex) return;

                            options.forEach(o => {
                                o.classList.remove("selected", "wrong");
                            });

                            this.classList.add("selected");
                            setStatus(soal, "Sudah dipilih");

                            if (finalNote) {
                                finalNote.style.display = "none";
                                finalNote.textContent = "";
                                finalNote.classList.remove("ok", "no");
                            }
                        });
                    });

                    btn.addEventListener("click", async function () {
                        if (soal.classList.contains("locked")) return;
                        if (soal.classList.contains("done")) return;
                        if (index !== currentIndex) return;

                        const answer = simpleNormalize(soal.dataset.answer || "");
                        const selected = soal.querySelector(".game-option.selected");

                        options.forEach(o => o.classList.remove("correct", "wrong"));

                        if (!selected) {
                            setStatus(soal, "Pilih jawaban dulu", "no");

                            if (scoreEl) {
                                scoreEl.textContent = `Pilih jawaban pada soal ${index + 1} terlebih dahulu.`;
                            }

                            return;
                        }

                        const value = simpleNormalize(selected.dataset.value || "");

                        if (value === answer) {
                            selected.classList.add("correct");
                            markDone(index);

                            const benar = hitungBenar();

                            if (index < soalList.length - 1) {
                                currentIndex++;
                                unlockSoal(currentIndex);

                                if (scoreEl) {
                                    scoreEl.textContent = `Benar. Soal ${currentIndex + 1} sudah terbuka. Skor: ${benar}/${soalList.length}`;
                                }
                            } else {
                                if (scoreEl) {
                                    scoreEl.textContent = `Skor: ${benar}/${soalList.length}`;
                                }

                                await handleLatihanSelesai();
                            }
                        } else {
                            selected.classList.add("wrong");
                            setStatus(soal, "Salah", "no");

                            if (scoreEl) {
                                scoreEl.textContent = `Jawaban soal ${index + 1} masih salah. Coba lagi.`;
                            }

                            if (finalNote) {
                                finalNote.style.display = "block";
                                finalNote.textContent = "Soal berikutnya belum terbuka karena jawaban ini belum benar.";
                                finalNote.classList.remove("ok");
                                finalNote.classList.add("no");
                            }
                        }
                    });
                });

                if (btnReset) {
                    btnReset.addEventListener("click", resetLatihan);
                }

                resetLatihan();
            });
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