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

        html,
        body {
            width: 100%;
            max-width: 100%;
            margin: 0;
            overflow-x: hidden;
        }

        img,
        svg,
        video,
        canvas,
        iframe {
            max-width: 100%;
            height: auto;
        }

        input,
        button,
        textarea,
        select {
            max-width: 100%;
            font-family: inherit;
        }

        button {
            touch-action: manipulation;
        }

        .materi-wrap {
            width: min(100%, 1060px);
            max-width: 1060px;
            margin: 0 auto;
            font-family: "Times New Roman", Times, serif;
            color: var(--text);
            line-height: 1.7;
            padding: 20px clamp(10px, 2.5vw, 28px) 40px;
            overflow-x: hidden;
        }

        .top-title {
            display: flex;
            align-items: baseline;
            gap: 12px;
            margin-bottom: 18px;
            min-width: 0;
        }

        .top-title .label {
            font-size: 26px;
            font-weight: 700;
            color: #000;
            flex-shrink: 0;
        }

        .top-title .judul {
            font-size: 30px;
            font-weight: 800;
            color: var(--green);
            overflow-wrap: anywhere;
            line-height: 1.25;
        }

        .card {
            max-width: 100%;
            border-radius: 16px;
            padding: 20px 22px;
            background: #fff;
            margin-bottom: 20px;
            box-shadow: 0 10px 28px rgba(0, 0, 0, .05);
            border: 1px solid rgba(0, 0, 0, .05);
            min-width: 0;
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
            max-width: 100%;
            background: linear-gradient(135deg, var(--orange-soft) 0%, #ffffff 100%);
            border-left: 8px solid var(--orange);
            padding: 22px 24px;
        }

        .tujuan-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
            min-width: 0;
        }

        .tujuan-header .title {
            font-size: 22px;
            font-weight: 900;
            color: var(--green);
            margin: 0;
            line-height: 1.3;
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
            overflow-wrap: anywhere;
            line-height: 1.25;
        }

        .title-box {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 800;
            font-size: 18px;
            color: var(--green);
            margin-bottom: 12px;
            overflow-wrap: anywhere;
            line-height: 1.35;
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
            max-width: 100%;
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
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
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
            max-width: 100%;
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
            max-width: 720px;
            margin: 6px auto 18px;
            background: rgba(255, 255, 255, .85);
            border: 1px solid rgba(0, 0, 0, .08);
            border-radius: 16px;
            padding: 22px 18px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
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
            width: 100%;
            max-width: 100%;
            margin-top: 14px;
            overflow-x: auto;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, .10);
            box-shadow: 0 10px 28px rgba(0, 0, 0, .04);
            -webkit-overflow-scrolling: touch;
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
            max-width: 100%;
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
            min-height: 36px;
            min-width: 0;
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
            max-width: 100%;
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
            min-width: 0;
        }

        .mini-btn {
            min-height: 42px;
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

        .katex-answer {
            max-width: 100%;
            display: none;
            justify-content: center;
            align-items: center;
            min-height: 42px;
            padding: 8px 10px;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, .18);
            background: rgba(255, 255, 255, .85);
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .sehingga-box {
            max-width: 100%;
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
            max-width: 100%;
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

        /* ===== LATIHAN HTML CSS JS ===== */
        .latihan-polinom-wrap {
            background: linear-gradient(180deg, #f7f3df, #f5f0dc);
            border-left: 6px solid #f59e0b;
            padding: 18px 18px 28px;
        }

        .latihan-shell {
            max-width: 780px;
            margin: 0 auto;
            border-left: 5px solid #f59e0b;
            padding-left: 18px;
        }

        .latihan-header-box {
            max-width: 100%;
            background: #f8f6ef;
            border: 1px solid rgba(0, 0, 0, .08);
            border-radius: 16px;
            padding: 18px 20px 14px;
            margin-bottom: 14px;
        }

        .latihan-main-title {
            margin: 0 0 6px;
            font-size: 28px;
            font-weight: 900;
            color: #1e1e1e;
            letter-spacing: .5px;
            overflow-wrap: anywhere;
            line-height: 1.25;
        }

        .latihan-main-subtitle {
            margin: 0;
            color: #555;
            font-size: 15px;
            line-height: 1.6;
        }

        .level-cards {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 14px;
        }

        .level-card {
            min-width: 0;
            border-radius: 18px;
            border: 2px solid #d9d9d9;
            min-height: 106px;
            padding: 14px 14px 14px 18px;
            display: flex;
            align-items: stretch;
            gap: 12px;
            background: #fafafa;
            transition: all .2s ease;
            opacity: .9;
        }

        .level-card.active {
            opacity: 1;
            transform: translateY(-1px);
        }

        .level-card.locked {
            opacity: .7;
        }

        #card-mudah {
            background: #eef8ef;
            border-color: #8fd19a;
        }

        #card-sedang {
            background: #f2f7ff;
            border-color: #b9d3f2;
        }

        #card-susah {
            background: #fff3ec;
            border-color: #efc0a3;
        }

        .level-bar {
            width: 8px;
            border-radius: 999px;
            min-height: 100%;
            flex-shrink: 0;
        }

        .level-bar.green {
            background: #4dbb63;
        }

        .level-bar.blue {
            background: #8cbbe8;
        }

        .level-bar.orange {
            background: #e5a06e;
        }

        .level-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-width: 0;
        }

        .level-title {
            font-size: 18px;
            font-weight: 900;
            color: #2b2b2b;
            margin-bottom: 4px;
            overflow-wrap: anywhere;
        }

        .level-sub {
            font-size: 14px;
            color: #777;
            margin-bottom: 10px;
        }

        .level-status {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            padding: 6px 12px;
            font-size: 13px;
            font-weight: 800;
            width: fit-content;
            min-width: 140px;
        }

        .level-status.done {
            background: #dff1e3;
            color: #1f6c34;
            border: 1px solid #b9dfc2;
        }

        .locked-pill {
            background: #ececec;
            color: #7b7b7b;
            border: 1px solid #dedede;
        }

        .latihan-panel {
            max-width: 100%;
            border-radius: 20px;
            padding: 16px 16px 18px;
            background: #fff;
            border: 2px solid #ddd;
        }

        .latihan-panel.active {
            display: block;
        }

        .panel-green {
            border-color: #8fd19a;
            background: #fbfffb;
        }

        .panel-blue {
            border-color: #b9d3f2;
            background: #fbfdff;
        }

        .panel-orange {
            border-color: #efc0a3;
            background: #fffdfa;
        }

        .panel-title {
            margin: 0 0 2px;
            font-size: 18px;
            font-weight: 900;
            color: #2d2d2d;
            overflow-wrap: anywhere;
        }

        .panel-subtitle {
            margin: 0 0 14px;
            color: #666;
            font-size: 15px;
        }

        .soal-math-box {
            max-width: 560px;
            background: #fff;
            border: 2px solid rgba(0, 0, 0, .10);
            border-radius: 16px;
            min-height: 108px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            padding: 12px;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .jawaban-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 800;
            color: #333;
        }

        .jawaban-input {
            width: 100%;
            max-width: 560px;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, .18);
            background: #fff;
            font-family: "Times New Roman", Times, serif;
            font-size: 17px;
            outline: none;
        }

        .jawaban-input:disabled {
            background: #f4f4f4;
            color: #888;
        }

        .latihan-actions {
            margin-top: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            min-width: 0;
        }

        .latihan-btn {
            min-height: 42px;
            padding: 9px 18px;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, .16);
            background: #fff;
            cursor: pointer;
            font-weight: 800;
            font-family: "Times New Roman", Times, serif;
        }

        .latihan-btn:disabled {
            cursor: not-allowed;
            opacity: .6;
        }

        .latihan-feedback {
            font-weight: 900;
            padding: 8px 12px;
            border-radius: 10px;
            display: inline-block;
        }

        .latihan-feedback.ok {
            color: #145c2a;
            background: rgba(27, 122, 42, .10);
            border: 1px solid rgba(27, 122, 42, .18);
        }

        .latihan-feedback.no {
            color: #8c2b00;
            background: rgba(224, 112, 43, .10);
            border: 1px solid rgba(224, 112, 43, .18);
        }

        .step-box {
            margin-top: 16px;
            border-radius: 14px;
            background: #f8faf8;
            border: 1px solid rgba(0, 0, 0, .08);
            padding: 14px 16px;
        }

        .step-title {
            font-weight: 900;
            color: #1f4d2d;
            margin-bottom: 8px;
        }

        .step-box ol {
            margin: 0 0 0 22px;
            color: #555;
        }

        .step-box li {
            margin: 6px 0;
            line-height: 1.8;
        }

        .step-result {
            margin-top: 10px;
            padding: 10px 12px;
            border-radius: 12px;
            background: #fff;
            border: 1px solid rgba(0, 0, 0, .08);
            font-weight: 800;
            color: #222;
        }

        /* ===== CARD SUKU SEJENIS ===== */
        .jenis-card {
            max-width: 100%;
            position: relative;
            overflow: hidden;
            padding: 24px 24px 22px;
            border-left: 7px solid #2e8b57;
            background:
                radial-gradient(circle at top right, rgba(167, 210, 156, .22), transparent 28%),
                linear-gradient(180deg, #f7fcf8 0%, #ffffff 100%);
        }

        .jenis-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            margin-bottom: 18px;
            min-width: 0;
        }

        .jenis-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #e9f7ec;
            color: #1b7a2a;
            border: 1px solid #b8dfbf;
            border-radius: 999px;
            padding: 7px 14px;
            font-size: 13px;
            font-weight: 900;
            margin-bottom: 10px;
        }

        .jenis-title {
            margin: 0 0 6px;
            font-size: 28px;
            font-weight: 900;
            color: #1f6a38;
            line-height: 1.25;
            overflow-wrap: anywhere;
        }

        .jenis-subtitle {
            margin: 0;
            color: #5a5a5a;
            font-size: 15px;
            line-height: 1.8;
            max-width: 760px;
        }

        .jenis-icon {
            width: 74px;
            height: 74px;
            border-radius: 20px;
            background: linear-gradient(135deg, #c8ebce, #8fd19a);
            color: #14532d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            font-weight: 900;
            box-shadow: 0 12px 24px rgba(46, 139, 87, .18);
        }

        .jenis-info-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 16px;
        }

        .jenis-info-card {
            min-width: 0;
            border-radius: 16px;
            padding: 16px 16px 14px;
            border: 1px solid rgba(0, 0, 0, .08);
            box-shadow: 0 8px 18px rgba(0, 0, 0, .04);
        }

        .jenis-info-card.good {
            background: linear-gradient(180deg, #edf9f0, #ffffff);
            border-left: 5px solid #3fa75a;
        }

        .jenis-info-card.bad {
            background: linear-gradient(180deg, #fff4ee, #ffffff);
            border-left: 5px solid #e58d5c;
        }

        .jenis-info-head {
            font-weight: 900;
            font-size: 17px;
            margin-bottom: 6px;
            color: #1f2937;
        }

        .jenis-info-text {
            color: #5b5b5b;
            line-height: 1.75;
            font-size: 15px;
        }

        .jenis-table-wrap {
            width: 100%;
            max-width: 100%;
            margin-top: 8px;
            border-radius: 18px;
            overflow-x: auto;
            border: 1px solid rgba(46, 139, 87, .14);
            box-shadow: 0 12px 26px rgba(0, 0, 0, .05);
            -webkit-overflow-scrolling: touch;
        }

        .jenis-table {
            min-width: 760px;
        }

        .jenis-table th {
            background: linear-gradient(180deg, #9fd08e, #8fc77b);
            color: #143d21;
            font-size: 18px;
            padding: 15px 14px;
        }

        .jenis-table td {
            padding: 18px 14px;
            font-size: 17px;
            transition: background .2s ease;
        }

        .jenis-table tbody tr:nth-child(even) td {
            background: #fbfdfb;
        }

        .jenis-table tbody tr:hover td {
            background: #f3fbf4;
        }

        .jenis-note {
            margin-top: 16px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            background: #fffbea;
            border: 1px solid #f2df9b;
            border-left: 5px solid #e6b93d;
            border-radius: 16px;
            padding: 14px 16px;
            color: #5c4b16;
            line-height: 1.75;
            font-size: 15px;
        }

        .jenis-note-icon {
            font-size: 20px;
            line-height: 1;
            margin-top: 2px;
        }

        .latihan-polynomial-wrapper {
            max-width: 920px;
            margin: 32px auto;
            padding: 32px;
            border-radius: 26px;
            background: linear-gradient(135deg, #f7fff8, #f4f8ff);
            border: 1px solid #dcebdc;
            box-shadow: 0 18px 45px rgba(82, 103, 78, 0.16);
            font-family: Georgia, serif;
        }

        .latihan-title {
            display: inline-block;
            padding: 10px 16px;
            margin-bottom: 10px;
            border-radius: 999px;
            background: #e9f8ee;
            color: #1e7a3b;
            font-size: 21px;
            font-weight: bold;
        }

        .latihan-desc {
            margin: 8px 0 26px;
            color: #5c6d5e;
            font-size: 15px;
        }

        .soal-card {
            max-width: 100%;
            position: relative;
            margin-bottom: 22px;
            padding: 24px;
            border-radius: 22px;
        }

        .soal-1 {
            background: linear-gradient(135deg, #fff0a8, #fff9df);
        }

        .soal-2 {
            background: linear-gradient(135deg, #dff1ff, #f6fbff);
        }

        .soal-3 {
            background: linear-gradient(135deg, #f0e2ff, #fbf7ff);
        }

        .soal-card h4 {
            margin: 0 0 18px;
            font-size: 20px;
            color: #25352b;
            overflow-wrap: anywhere;
        }

        .soal-susun {
            max-width: 100%;
            width: fit-content;
            margin: 16px auto 20px;
            padding: 16px 28px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.7);
            font-size: 26px;
            line-height: 1.7;
            text-align: right;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .garis-susun {
            border-bottom: 2px solid #222;
            margin-top: 4px;
        }

        .jawaban-area {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            min-width: 0;
        }

        .jawaban-area input {
            width: 260px;
            max-width: 100%;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid #bcc8bd;
            font-size: 15px;
            outline: none;
        }

        .jawaban-area button {
            min-height: 42px;
            padding: 12px 18px;
            border: none;
            border-radius: 12px;
            background: #4d7fcf;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .jawaban-area button:disabled,
        .jawaban-area input:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        #fb-1,
        #fb-2,
        #fb-3 {
            font-weight: bold;
        }

        .penjelasan {
            display: none;
            margin-top: 18px;
            padding: 16px 18px;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.75);
            border-left: 5px solid #2f9b57;
            color: #2e5237;
        }

        .penjelasan p {
            margin: 6px 0;
        }

        .locked .isi-soal {
            opacity: 0.35;
            pointer-events: none;
        }

        .lock-layer {
            position: absolute;
            inset: 0;
            z-index: 5;
            background: rgba(255, 255, 255, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 22px;
        }

        .lock-box {
            background: white;
            padding: 12px 20px;
            border-radius: 14px;
            font-weight: bold;
            color: #52624f;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
        }

        /* ===================== SCROLLBAR RAPI ===================== */
        .rumus-box::-webkit-scrollbar,
        .definisi-rumus::-webkit-scrollbar,
        .table-wrap::-webkit-scrollbar,
        .jenis-table-wrap::-webkit-scrollbar,
        .soal-susun::-webkit-scrollbar {
            height: 6px;
        }

        .rumus-box::-webkit-scrollbar-thumb,
        .definisi-rumus::-webkit-scrollbar-thumb,
        .table-wrap::-webkit-scrollbar-thumb,
        .jenis-table-wrap::-webkit-scrollbar-thumb,
        .soal-susun::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, .22);
            border-radius: 999px;
        }

        /* ===================== LAPTOP / DESKTOP ===================== */
        @media (min-width: 1025px) {
            .materi-wrap {
                padding-top: 24px;
                padding-bottom: 48px;
            }

            .top-title .label {
                font-size: 28px;
            }

            .top-title .judul {
                font-size: 32px;
            }

            .section-title {
                font-size: 31px;
            }

            .card {
                padding: 22px 24px;
            }

            .latihan-polynomial-wrapper {
                padding: 32px;
            }

            .jawaban-area {
                flex-direction: row;
            }
        }

        /* ===================== TABLET ===================== */
        @media (min-width: 769px) and (max-width: 1024px) {
            .materi-wrap {
                max-width: 920px;
                padding: 22px 22px 44px;
            }

            .top-title {
                gap: 10px;
                margin-bottom: 16px;
            }

            .top-title .label {
                font-size: 25px;
            }

            .top-title .judul {
                font-size: 28px;
            }

            .section-title {
                font-size: 27px;
                margin: 28px 0 12px;
            }

            .card,
            .tujuan-card,
            .jenis-card {
                border-radius: 15px;
                padding: 20px;
                margin-bottom: 18px;
            }

            .tujuan-header .title {
                font-size: 21px;
            }

            p,
            .card ul,
            .card ol,
            .definisi-box ul,
            .definisi-box li,
            .jenis-info-text,
            .jenis-note,
            .latihan-main-subtitle,
            .panel-subtitle,
            .latihan-desc {
                font-size: 15.5px;
            }

            .rumus-box {
                padding: 13px 14px;
                font-size: 17px;
            }

            .definisi-box {
                padding: 38px 22px 20px;
                margin-top: 46px;
            }

            .definisi-lead {
                font-size: 21px;
            }

            .definisi-rumus {
                padding: 18px 16px;
            }

            .jenis-title {
                font-size: 25px;
            }

            .jenis-info-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .jenis-icon {
                width: 66px;
                height: 66px;
                font-size: 30px;
            }

            .level-cards {
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 10px;
            }

            .level-card {
                padding: 13px;
                min-height: 112px;
            }

            .level-title {
                font-size: 17px;
            }

            .level-status {
                min-width: 0;
                width: 100%;
                font-size: 12.5px;
                padding: 6px 8px;
            }

            .latihan-shell {
                max-width: 100%;
                padding-left: 14px;
            }

            .latihan-polynomial-wrapper {
                margin: 28px auto;
                padding: 26px;
                border-radius: 24px;
            }

            .soal-card {
                padding: 22px;
            }

            .soal-susun {
                font-size: 24px;
            }

            .jawaban-area {
                flex-wrap: wrap;
            }

            .jawaban-area input {
                flex: 1 1 260px;
            }

            .jawaban-area button {
                flex: 0 0 auto;
            }
        }

        /* ===================== HP BESAR / TABLET KECIL ===================== */
        @media (min-width: 481px) and (max-width: 768px) {
            .materi-wrap {
                padding: 18px 16px 38px;
            }

            .top-title {
                align-items: flex-start;
                gap: 8px;
            }

            .top-title .label {
                font-size: 23px;
                line-height: 1.2;
            }

            .top-title .judul {
                font-size: 24px;
            }

            .section-title {
                font-size: 24px;
                margin: 24px 0 10px;
            }

            .card,
            .tujuan-card,
            .jenis-card {
                padding: 18px;
                border-radius: 15px;
            }

            .title-box {
                font-size: 17px;
            }

            .tujuan-header .title {
                font-size: 20px;
            }

            p,
            .card ul,
            .card ol,
            .definisi-box ul,
            .definisi-box li,
            .jenis-info-text,
            .jenis-note,
            .latihan-main-subtitle,
            .panel-subtitle,
            .latihan-desc {
                font-size: 15px;
                line-height: 1.75;
            }

            .rumus-box,
            .definisi-rumus {
                justify-content: flex-start;
                padding: 12px 13px;
                font-size: 16px;
            }

            .definisi-box {
                padding: 38px 18px 18px;
                margin: 44px 0 18px;
                border-radius: 16px;
            }

            .definisi-pill {
                left: 18px;
                font-size: 13px;
                padding: 6px 16px;
            }

            .definisi-lead {
                font-size: 19px;
            }

            .definisi-sub {
                font-size: 17px;
            }

            .jenis-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .jenis-title {
                font-size: 22px;
            }

            .jenis-info-grid {
                grid-template-columns: 1fr;
            }

            .jenis-icon {
                width: 58px;
                height: 58px;
                font-size: 27px;
            }

            table.materi-table,
            .jenis-table {
                min-width: 680px;
            }

            .materi-table th,
            .materi-table td {
                padding: 12px 10px;
                font-size: 15px;
            }

            .question {
                padding: 13px;
            }

            .quiz-list {
                margin-left: 16px;
            }

            .quiz-input,
            .hasil-input,
            .jawaban-input {
                width: 100%;
                max-width: 100%;
            }

            .contoh-badge {
                padding: 9px 22px;
            }

            .contoh-box {
                padding: 13px;
            }

            .mini-actions {
                justify-content: flex-start;
            }

            .latihan-polinom-wrap {
                padding: 16px 14px 24px;
            }

            .latihan-shell {
                padding-left: 10px;
            }

            .latihan-header-box {
                padding: 16px;
            }

            .latihan-main-title {
                font-size: 23px;
            }

            .level-cards {
                grid-template-columns: 1fr;
            }

            .level-card {
                min-height: auto;
                padding: 13px 14px;
            }

            .latihan-panel {
                padding: 15px;
                border-radius: 18px;
            }

            .soal-math-box {
                min-height: 92px;
            }

            .latihan-polynomial-wrapper {
                margin: 24px auto;
                padding: 20px;
                border-radius: 22px;
            }

            .latihan-title {
                font-size: 18px;
                line-height: 1.35;
            }

            .soal-card {
                padding: 20px;
                border-radius: 20px;
            }

            .soal-card h4 {
                font-size: 18px;
            }

            .soal-susun {
                width: 100%;
                font-size: 21px;
                padding: 14px 16px;
            }

            .jawaban-area {
                flex-direction: column;
                align-items: stretch;
            }

            .jawaban-area input,
            .jawaban-area button,
            .jawaban-area span {
                width: 100%;
            }

            .jawaban-area span {
                text-align: center;
            }
        }

        /* ===================== HP KECIL ===================== */
        @media (max-width: 480px) {
            .materi-wrap {
                padding: 14px 10px 32px;
                line-height: 1.65;
            }

            .top-title {
                align-items: flex-start;
                gap: 7px;
                margin-bottom: 14px;
            }

            .top-title .label {
                font-size: 20px;
                line-height: 1.2;
            }

            .top-title .judul {
                font-size: 20px;
                line-height: 1.25;
            }

            .section-title {
                font-size: 21px;
                margin: 22px 0 10px;
                line-height: 1.25;
            }

            .card,
            .tujuan-card,
            .jenis-card {
                padding: 15px 13px;
                border-radius: 14px;
                margin-bottom: 16px;
                box-shadow: 0 8px 22px rgba(0, 0, 0, .045);
            }

            .card-eksplorasi,
            .card-green,
            .card-latihan,
            .latihan-polinom-wrap {
                border-left-width: 5px;
            }

            .title-box {
                font-size: 16px;
                line-height: 1.35;
                gap: 8px;
            }

            .tujuan-header .title {
                font-size: 18px;
                line-height: 1.3;
            }

            .tujuan-card ol,
            .card ul,
            .card ol {
                padding-left: 18px;
                margin-left: 0;
            }

            p,
            .card ul,
            .card ol,
            .definisi-box ul,
            .definisi-box li,
            .jenis-info-text,
            .jenis-note,
            .latihan-main-subtitle,
            .panel-subtitle,
            .latihan-desc {
                font-size: 14.5px;
                line-height: 1.72;
            }

            p,
            .tujuan-card li {
                text-align: left;
            }

            .rumus-box,
            .definisi-rumus {
                justify-content: flex-start;
                padding: 11px 12px;
                border-radius: 12px;
                font-size: 15px;
            }

            .penjelasan-plain {
                margin: 14px 0 18px;
            }

            .penjelasan-plain p {
                font-size: 14.5px;
                line-height: 1.75;
                text-align: left;
            }

            .definisi-box {
                padding: 34px 14px 16px;
                margin: 40px 0 18px;
                border-radius: 15px;
            }

            .definisi-pill {
                top: -19px;
                left: 14px;
                padding: 5px 14px;
                border-width: 2px;
                font-size: 12px;
            }

            .definisi-lead {
                font-size: 17px;
                line-height: 1.35;
            }

            .definisi-sub {
                font-size: 16px;
            }

            .definisi-box ul {
                padding-left: 18px;
            }

            table.materi-table,
            .jenis-table {
                min-width: 620px;
            }

            .materi-table th,
            .materi-table td {
                padding: 10px 9px;
                font-size: 14px;
            }

            .question {
                padding: 12px;
                border-radius: 13px;
            }

            .question .qtitle {
                font-size: 15px;
            }

            .quiz-list {
                margin-left: 16px;
                padding-left: 0;
            }

            .quiz-item {
                margin: 10px 0 14px;
            }

            .quiz-q {
                line-height: 1.6;
            }

            .quiz-input,
            .hasil-input,
            .jawaban-input,
            .jawaban-area input {
                width: 100%;
                max-width: 100%;
                font-size: 15px;
                padding: 10px 11px;
            }

            .quiz-actions,
            .mini-actions,
            .latihan-actions {
                gap: 8px;
            }

            .quiz-feedback,
            .mini-feedback,
            .latihan-feedback {
                width: 100%;
                text-align: center;
                font-size: 14px;
            }

            .quiz-summary {
                display: block;
                margin-left: 0;
                margin-top: 8px;
                font-size: 14px;
            }

            .contoh-badge {
                padding: 8px 18px;
                font-size: 14px;
            }

            .contoh-box {
                padding: 12px;
                border-radius: 13px;
            }

            .contoh-row-title {
                line-height: 1.5;
            }

            .mini-actions {
                justify-content: stretch;
            }

            .mini-btn {
                width: 100%;
                padding: 10px 14px;
            }

            #contoh-final {
                max-width: 100% !important;
                width: 100%;
            }

            .sehingga-box {
                padding: 12px;
                border-radius: 13px;
            }

            .latihan-polinom-wrap {
                padding: 14px 11px 22px;
            }

            .latihan-shell {
                padding-left: 8px;
                border-left-width: 4px;
            }

            .latihan-header-box {
                padding: 14px;
                border-radius: 14px;
            }

            .latihan-main-title {
                font-size: 20px;
                line-height: 1.25;
            }

            .level-cards {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .level-card {
                min-height: auto;
                padding: 12px;
                border-radius: 15px;
            }

            .level-bar {
                width: 7px;
            }

            .level-title {
                font-size: 16px;
            }

            .level-sub {
                font-size: 13px;
            }

            .level-status {
                min-width: 0;
                width: 100%;
                font-size: 12.5px;
                padding: 6px 8px;
            }

            .latihan-panel {
                padding: 13px;
                border-radius: 16px;
            }

            .panel-title {
                font-size: 17px;
            }

            .soal-math-box {
                min-height: 84px;
                padding: 10px;
                border-radius: 14px;
            }

            .latihan-btn {
                width: 100%;
                padding: 10px 16px;
            }

            .step-box {
                padding: 12px;
            }

            .jenis-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .jenis-title {
                font-size: 20px;
            }

            .jenis-subtitle {
                font-size: 14.5px;
                line-height: 1.65;
            }

            .jenis-info-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .jenis-info-card {
                padding: 13px;
                border-radius: 14px;
            }

            .jenis-info-head {
                font-size: 16px;
            }

            .jenis-icon {
                width: 52px;
                height: 52px;
                font-size: 24px;
                border-radius: 14px;
            }

            .jenis-note {
                padding: 12px;
                border-radius: 14px;
                gap: 9px;
            }

            .latihan-polynomial-wrapper {
                margin: 20px auto;
                padding: 14px;
                border-radius: 18px;
            }

            .latihan-title {
                font-size: 16px;
                line-height: 1.35;
                padding: 8px 12px;
            }

            .latihan-desc {
                margin-bottom: 18px;
            }

            .soal-card {
                padding: 15px;
                border-radius: 18px;
                margin-bottom: 16px;
            }

            .soal-card h4 {
                font-size: 16.5px;
                line-height: 1.35;
                margin-bottom: 14px;
            }

            .soal-susun {
                width: 100%;
                font-size: 18px;
                line-height: 1.55;
                padding: 12px 13px;
                border-radius: 14px;
                margin: 12px auto 16px;
            }

            .jawaban-area {
                flex-direction: column;
                align-items: stretch;
                gap: 8px;
            }

            .jawaban-area input,
            .jawaban-area button,
            .jawaban-area span {
                width: 100%;
            }

            .jawaban-area button {
                padding: 11px 14px;
            }

            .jawaban-area span {
                text-align: center;
                min-height: 22px;
            }

            .penjelasan {
                padding: 13px;
                border-radius: 13px;
                font-size: 14px;
            }

            .lock-box {
                margin: 0 12px;
                text-align: center;
                line-height: 1.45;
            }
        }

        /* ===================== HP SANGAT KECIL ===================== */
        @media (max-width: 360px) {
            .materi-wrap {
                padding-left: 8px;
                padding-right: 8px;
            }

            .top-title .judul {
                font-size: 18.5px;
            }

            .section-title {
                font-size: 19.5px;
            }

            .card,
            .tujuan-card,
            .jenis-card {
                padding: 13px 11px;
            }

            p,
            .card ul,
            .card ol,
            .definisi-box ul,
            .definisi-box li,
            .jenis-info-text,
            .jenis-note,
            .latihan-main-subtitle,
            .panel-subtitle,
            .latihan-desc {
                font-size: 14px;
            }

            .soal-susun {
                font-size: 16.5px;
                padding: 11px;
            }

            .latihan-polynomial-wrapper {
                padding: 12px;
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
                <li>Melakukan operasi penjumlahan, pengurangan, dan perkalian pada polinomial dengan tepat.
                </li>
            </ol>
        </div>

        {{-- Section --}}
        <div class="section-title">1. Penjumlahan Polinomial</div>

        {{-- Eksplorasi --}}
        <div class="card card-eksplorasi">
            <div class="title-box" style="color:#1e3a8a;">🧭 Eksplorasi</div>

            <p>
                Perhatikan dua fungsi berikut.
            </p>

            <p style="margin-bottom:6px;"><b>Fungsi pertama:</b></p>
            <div class="rumus-box">$$T(y)=6y^2-3y+8$$</div>

            <p style="margin-bottom:6px;"><b>Fungsi kedua:</b></p>
            <div class="rumus-box">$$U(y)=4y^2+5y-2$$</div>

            <p>
                Untuk memahami bagaimana fungsi bekerja, coba substitusikan nilai
                <span class="highlight">$y=1$</span> ke dalam kedua fungsi, lalu amati hasilnya.
            </p>

            <div class="question" id="eksplorasi-quiz">
                <div class="qtitle">Amati dan Jawab</div>

                <ol class="quiz-list">
                    <li class="quiz-item" data-type="oneof" data-answer="11">
                        <div class="quiz-q">
                            Jika $y=1$, berapa nilai $T(1)$?
                        </div>
                        <input class="quiz-input" type="text" placeholder="Jawaban kamu..." />
                        <div class="quiz-actions">
                            <span class="quiz-feedback"></span>
                        </div>
                    </li>

                    <li class="quiz-item" data-type="oneof" data-answer="7">
                        <div class="quiz-q">
                            Jika $y=1$, berapa nilai $U(1)$?
                        </div>
                        <input class="quiz-input" type="text" placeholder="Jawaban kamu..." />
                        <div class="quiz-actions">
                            <span class="quiz-feedback"></span>
                        </div>
                    </li>

                    <li class="quiz-item" data-type="oneof" data-answer="18">
                        <div class="quiz-q">
                            Berdasarkan hasil nomor 1 dan 2, berapa nilai $T(1)+U(1)$?
                        </div>
                        <input class="quiz-input" type="text" placeholder="Jawaban kamu..." />
                        <div class="quiz-actions">
                            <span class="quiz-feedback"></span>
                        </div>
                    </li>
                </ol>

                <div style="margin-top:10px;">
                    <span id="quiz-summary" class="quiz-summary"></span>
                </div>
            </div>
        </div>

        {{-- ✅ KUNCI: SEMUA SETELAH INI BARU MUNCUL JIKA 3/3 BENAR --}}
        <div id="materi-lanjutan" style="display:none;">

            {{-- Penjelasan --}}
            <div class="penjelasan-plain">
                <p>
                    Sama seperti operasi penjumlahan pada bilangan real, penjumlahan pada polinomial dapat dilakukan dengan
                    cara menggabungkan suku-suku yang sejenis, yaitu suku yang memiliki variabel yang sama, dan pangkat
                    variabel
                    yang sama. Suku yang tidak sejenis tidak dapat dijumlahkan, sehingga tetap dituliskan apa adanya.
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

            {{-- CARD 1: Tabel Suku Sejenis --}}
            <div class="card card-green jenis-card">
                <div class="jenis-header">
                    <div>
                        <h3 class="jenis-title">Contoh Suku Sejenis dan Bukan Suku Sejenis</h3>
                        <p class="jenis-subtitle">
                            Perhatikan bahwa suku sejenis harus memiliki <b>variabel yang sama</b> dan
                            <b>pangkat yang sama</b>.
                        </p>
                    </div>
                </div>

                <div class="jenis-info-grid">
                    <div class="jenis-info-card good">
                        <div class="jenis-info-head">✅ Suku Sejenis</div>
                        <div class="jenis-info-text">
                            Bisa dijumlahkan atau dikurangkan karena bentuk variabel dan pangkatnya sama.
                        </div>
                    </div>

                    <div class="jenis-info-card bad">
                        <div class="jenis-info-head">❌ Bukan Suku Sejenis</div>
                        <div class="jenis-info-text">
                            Tidak bisa langsung dijumlahkan karena variabel atau pangkatnya berbeda.
                        </div>
                    </div>
                </div>

                <div class="table-wrap jenis-table-wrap">
                    <table class="materi-table jenis-table">
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
            </div>

            {{-- CARD 2: Contoh Interaktif --}}
            <div class="card card-green">

                <div class="contoh-badge">CONTOH</div>

                <div class="contoh-box" id="contoh-interaktif">
                    <div class="contoh-row-title">Hitunglah hasil dari:</div>

                    <div class="rumus-box" style="margin-top:8px;">
                        $$(3x^3+5x^2-2x+7) + (4x^3-3x^2+x-5)$$
                    </div>

                    <div class="contoh-row-title" style="margin-top:12px;">
                        Penyelesaian: Kelompokkan suku sejenis
                    </div>

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

                                <tr class="contoh-item" data-answer="7x^3" data-canonical="7x^3" data-latex="7x^3">
                                    <td>$(3x^3 + 4x^3)$</td>
                                    <td>$(3 + 4)x^3$</td>
                                    <td>
                                        <input class="hasil-input" type="text" />
                                        <div class="katex-answer"></div>
                                        <div class="mini-actions">
                                            <span class="mini-feedback"></span>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="contoh-item" data-answer="2x^2" data-canonical="2x^2" data-latex="2x^2">
                                    <td>$(5x^2 - 3x^2)$</td>
                                    <td>$(5 - 3)x^2$</td>
                                    <td>
                                        <input class="hasil-input" type="text" />
                                        <div class="katex-answer"></div>
                                        <div class="mini-actions">
                                            <span class="mini-feedback"></span>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="contoh-item" data-answer="-x" data-canonical="-x" data-latex="-x">
                                    <td>$(-2x + x)$</td>
                                    <td>$(-2 + 1)x$</td>
                                    <td>
                                        <input class="hasil-input" type="text" />
                                        <div class="katex-answer"></div>
                                        <div class="mini-actions">
                                            <span class="mini-feedback"></span>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="contoh-item" data-answer="2" data-canonical="2" data-latex="2">
                                    <td>$(7 - 5)$</td>
                                    <td>$(7 - 5)$</td>
                                    <td>
                                        <input class="hasil-input" type="text" />
                                        <div class="katex-answer"></div>
                                        <div class="mini-actions">
                                            <span class="mini-feedback"></span>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div style="margin-top:14px;">
                        <div class="contoh-row-title">Tuliskan hasil akhirnya:</div>

                        <div class="mini-actions" style="justify-content:flex-start;">
                            <input id="contoh-final" class="hasil-input" style="max-width:420px; text-align:left;"
                                type="text" />
                            <span id="contoh-final-fb" class="mini-feedback"></span>
                        </div>

                        <div class="mini-actions" style="margin-top:10px;">
                            <button type="button" id="contoh-check-all" class="mini-btn">
                                Cek Semua
                            </button>
                            <span id="contoh-summary" style="font-weight:900; color:#1e3a8a;"></span>
                        </div>
                    </div>

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

            <div class="latihan-polynomial-wrapper">

                <div class="latihan-title">Latihan</div>
                <p class="latihan-desc">
                    Kerjakan berurutan. Soal berikutnya akan terbuka setelah jawaban sebelumnya benar.
                </p>

                <div class="soal-card soal-1" id="soal-1">
                    <div class="isi-soal">
                        <h4>1. Penjumlahan 2 Suku</h4>

                        <div class="soal-susun">
                            <div>6y - 4</div>
                            <div>+ 3y + 10</div>
                            <div class="garis-susun"></div>
                        </div>

                        <div class="jawaban-area">
                            <input type="text" id="jawaban-1" placeholder="Jawaban kamu...">
                            <button onclick="cekJawaban(1, ['9y+6'], 2)">Cek</button>
                            <span id="fb-1"></span>
                        </div>

                        <div class="penjelasan" id="step-1">
                            <b>Pengerjaan:</b>
                            <p>6y + 3y = 9y</p>
                            <p>-4 + 10 = 6</p>
                            <p>Jadi hasilnya adalah <b>9y + 6</b>.</p>
                        </div>
                    </div>
                </div>

                <div class="soal-card soal-2 locked" id="soal-2">

                    <div class="isi-soal">
                        <h4>2. Penjumlahan 3 Suku</h4>

                        <div class="soal-susun">
                            <div>2x² + 3x - 5</div>
                            <div>+ 4x² - x + 1</div>
                            <div class="garis-susun"></div>
                        </div>

                        <div class="jawaban-area">
                            <input type="text" id="jawaban-2" placeholder="Jawaban kamu..." disabled>
                            <button onclick="cekJawaban(2, ['6x^2+2x-4', '6x²+2x-4'], 3)" disabled>Cek</button>
                            <span id="fb-2"></span>
                        </div>

                        <div class="penjelasan" id="step-2">
                            <b>Pengerjaan:</b>
                            <p>2x² + 4x² = 6x²</p>
                            <p>3x + (-x) = 2x</p>
                            <p>-5 + 1 = -4</p>
                            <p>Jadi hasilnya adalah <b>6x² + 2x - 4</b>.</p>
                        </div>
                    </div>
                </div>

                <div class="soal-card soal-3 locked" id="soal-3">

                    <div class="isi-soal">
                        <h4>3. Penjumlahan 4 Suku</h4>

                        <div class="soal-susun">
                            <div>3x³ + 2x² - 5x + 7</div>
                            <div>+ 4x³ - x² + 6x - 2</div>
                            <div class="garis-susun"></div>
                        </div>

                        <div class="jawaban-area">
                            <input type="text" id="jawaban-3" placeholder="Jawaban kamu..." disabled>
                            <button onclick="cekJawaban(3, ['7x^3+x^2+x+5', '7x³+x²+x+5'])" disabled>Cek</button>
                            <span id="fb-3"></span>
                        </div>

                        <div class="penjelasan" id="step-3">
                            <b>Pengerjaan:</b>
                            <p>3x³ + 4x³ = 7x³</p>
                            <p>2x² + (-x²) = x²</p>
                            <p>-5x + 6x = x</p>
                            <p>7 + (-2) = 5</p>
                            <p>Jadi hasilnya adalah <b>7x³ + x² + x + 5</b>.</p>
                        </div>
                    </div>
                </div>

            </div>

        </div> {{-- end #materi-lanjutan --}}

        <script>
            window.completeMateriUrl = "{{ route('materi.complete', $materi->id) }}";
        </script>

        <script>
            (function () {
                /* =========================
                UTILITIES
                ========================== */
                const normalize = (s) =>
                    (s || "")
                        .toLowerCase()
                        .trim()
                        .replace(/\s+/g, "")
                        .replace(/×/g, "x")
                        .replace(/–/g, "-")
                        .replace(/−/g, "-")
                        .replace(/\+\-/g, "-");

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

                        /* ubah x(2), y(3), a(4) menjadi x^2, y^3, a^4 */
                        .replace(/([a-z])\((-?\d+)\)/g, "$1^$2")

                        /* ubah x2, x3, y5, a7 menjadi x^2, x^3, y^5, a^7 */
                        .replace(/([a-z])(\d+)/g, (match, varName, power, offset, full) => {
                            const prev = full[offset - 1] || "";
                            if (prev === "^") return match;
                            return `${varName}^${power}`;
                        })

                        .replace(/\+\-/g, "-")
                        .replace(/^\+/, "")

                        /* 1x jadi x */
                        .replace(/(^|[+\-])1([a-z])/g, "$1$2")

                        /* -1x jadi -x */
                        .replace(/(^|[+\-])-1([a-z])/g, "$1-$2")

                        /* x^1 jadi x */
                        .replace(/\^1(?!\d)/g, "")

                        /* x^02 jadi x^2 */
                        .replace(/\^0+(\d+)/g, "^$1");

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
                                    { left: "$", right: "$", display: false }
                                ]
                            });
                        }
                    } catch (e) { }
                };

                /* =========================
                EKSPLORASI QUIZ
                ========================== */
                const materiLanjutan = document.getElementById("materi-lanjutan");

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

                const getInputValue = (item) => {
                    const el = item.querySelector(".quiz-input");
                    return el ? el.value : "";
                };

                const isFilled = (item) => {
                    return getInputValue(item).trim() !== "";
                };

                const checkItem = (item) => {
                    const type = item.getAttribute("data-type");
                    const valRaw = getInputValue(item);

                    if (!valRaw.trim()) {
                        clearFeedback(item);
                        return null;
                    }

                    if (type === "oneof") {
                        const expected = normalize(item.getAttribute("data-answer") || "");
                        const val = normalize(valRaw);
                        const ok = val === expected;
                        showFeedback(item, ok, "Benar ✅", "Salah ❌");
                        return ok;
                    }

                    showFeedback(item, false, "", "Tipe soal belum dikenali.");
                    return false;
                };

                const updateUnlock = () => {
                    const quiz = document.getElementById("eksplorasi-quiz");
                    if (!quiz || !materiLanjutan) return;

                    const items = Array.from(quiz.querySelectorAll(".quiz-item"));
                    const filledCount = items.filter((it) => isFilled(it)).length;
                    const allFilled = filledCount === items.length;

                    const summary = document.getElementById("quiz-summary");
                    if (summary) summary.textContent = `Terisi: ${filledCount}/${items.length}`;

                    materiLanjutan.style.display = allFilled ? "block" : "none";

                    if (allFilled) {
                        rerenderKatex();
                        initLatihanPolinom();
                    }
                };

                const quiz = document.getElementById("eksplorasi-quiz");
                if (quiz) {
                    const items = Array.from(quiz.querySelectorAll(".quiz-item"));

                    items.forEach((item) => {
                        const input = item.querySelector(".quiz-input");
                        if (!input) return;

                        input.addEventListener("input", () => {
                            checkItem(item);
                            updateUnlock();
                            rerenderKatex();
                        });

                        input.addEventListener("blur", () => {
                            checkItem(item);
                            updateUnlock();
                            rerenderKatex();
                        });
                    });
                }

                /* =========================
                CONTOH INTERAKTIF
                ========================== */
                const contoh = document.getElementById("contoh-interaktif");
                if (contoh) {
                    const rows = Array.from(contoh.querySelectorAll(".contoh-item"));
                    const sehinggaBox = document.getElementById("sehingga-box");

                    const showKatexAnswer = (row) => {
                        const input = row.querySelector(".hasil-input");
                        const box = row.querySelector(".katex-answer");
                        const latex = row.getAttribute("data-latex") || "";

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

                    const checkRow = (row) => {
                        const ans = normalizePoly(row.getAttribute("data-answer") || "");
                        const input = row.querySelector(".hasil-input");
                        const fb = row.querySelector(".mini-feedback");

                        const user = normalizePoly(input ? input.value : "");
                        const ok = !!user && user === ans;

                        setFb(fb, ok);

                        if (ok) showKatexAnswer(row);

                        return ok;
                    };

                    const finalInput = document.getElementById("contoh-final");
                    const finalFb = document.getElementById("contoh-final-fb");
                    const finalAns = normalizePoly("7x^3+2x^2-x+2");

                    const checkFinal = () => {
                        const user = normalizePoly(finalInput ? finalInput.value : "");
                        const ok = !!user && user === finalAns;

                        setFb(finalFb, ok);

                        return ok;
                    };

                    const btnAll = document.getElementById("contoh-check-all");
                    const summary = document.getElementById("contoh-summary");

                    if (btnAll) {
                        btnAll.addEventListener("click", () => {
                            let correct = 0;

                            rows.forEach((r) => {
                                if (checkRow(r)) correct++;
                            });

                            if (checkFinal()) correct++;

                            const total = rows.length + 1;

                            if (summary) summary.textContent = `Skor: ${correct}/${total}`;

                            if (correct === total) {
                                if (sehinggaBox) sehinggaBox.style.display = "block";
                            } else {
                                if (sehinggaBox) sehinggaBox.style.display = "none";
                            }

                            rerenderKatex();
                        });
                    }

                    if (sehinggaBox) sehinggaBox.style.display = "none";
                }

                /* =========================
                LATIHAN SOAL
                ========================== */

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

                let latihanInited = false;

                function bukaSoal(nomor) {
                    const soal = document.getElementById("soal-" + nomor);
                    const input = document.getElementById("jawaban-" + nomor);

                    if (!soal || !input) return;

                    soal.classList.remove("locked");
                    soal.classList.add("active");

                    soal.style.display = "block";
                    soal.style.opacity = "1";
                    soal.style.pointerEvents = "auto";
                    soal.style.filter = "none";

                    input.disabled = false;
                    input.removeAttribute("disabled");
                    input.readOnly = false;
                    input.removeAttribute("readonly");
                    input.style.pointerEvents = "auto";
                    input.style.opacity = "1";

                    const tombol = input.parentElement.querySelector("button");

                    if (tombol) {
                        tombol.disabled = false;
                        tombol.removeAttribute("disabled");
                        tombol.style.pointerEvents = "auto";
                        tombol.style.opacity = "1";
                        tombol.style.cursor = "pointer";
                    }

                    input.focus();
                }

                async function cekJawaban(nomor, daftarJawabanBenar, nomorBerikutnya = null) {
                    const input = document.getElementById("jawaban-" + nomor);
                    const feedback = document.getElementById("fb-" + nomor);
                    const step = document.getElementById("step-" + nomor);

                    if (!input || !feedback) return;

                    const jawabanUser = normalizePoly(input.value);

                    const benar = daftarJawabanBenar.some(function (jawaban) {
                        return normalizePoly(jawaban) === jawabanUser;
                    });

                    if (benar) {
                        feedback.textContent = "Benar ✅";
                        feedback.style.color = "green";
                        feedback.style.fontWeight = "600";

                        if (step) {
                            step.style.display = "block";
                        }

                        input.disabled = true;

                        const tombolSekarang = input.parentElement.querySelector("button");

                        if (tombolSekarang) {
                            tombolSekarang.disabled = true;
                        }

                        if (nomorBerikutnya !== null) {
                            bukaSoal(nomorBerikutnya);
                        } else {
                            feedback.textContent = "Benar ✅ Progress sedang disimpan...";

                            const berhasilSimpan = await saveProgressMateri();

                            if (berhasilSimpan) {
                                bukaNextButton();

                                feedback.textContent = "Benar ✅ Latihan selesai. Progress berhasil disimpan.";
                                feedback.style.color = "green";
                            } else {
                                feedback.textContent = "Benar ✅ Tetapi progress gagal disimpan. Silakan refresh atau coba lagi.";
                                feedback.style.color = "red";
                            }

                            feedback.style.fontWeight = "600";
                        }
                    } else {
                        feedback.textContent = "Salah, coba lagi.";
                        feedback.style.color = "red";
                        feedback.style.fontWeight = "600";

                        if (step) {
                            step.style.display = "none";
                        }
                    }

                    rerenderKatex();
                }

                window.cekJawaban = cekJawaban;
                window.bukaSoal = bukaSoal;

                function initLatihanPolinom() {
                    if (latihanInited) return;

                    const rootExists =
                        document.getElementById("soal-1") ||
                        document.getElementById("jawaban-1") ||
                        document.getElementById("soal-2");

                    if (!rootExists) return;

                    latihanInited = true;

                    const semuaStep = document.querySelectorAll(".penjelasan");

                    semuaStep.forEach(function (step) {
                        step.style.display = "none";
                    });

                    const soal1 = document.getElementById("soal-1");
                    const soal2 = document.getElementById("soal-2");
                    const soal3 = document.getElementById("soal-3");

                    const input1 = document.getElementById("jawaban-1");
                    const input2 = document.getElementById("jawaban-2");
                    const input3 = document.getElementById("jawaban-3");

                    if (soal1) {
                        soal1.classList.remove("locked");
                        soal1.classList.add("active");
                        soal1.style.display = "block";
                        soal1.style.opacity = "1";
                        soal1.style.pointerEvents = "auto";
                        soal1.style.filter = "none";
                    }

                    if (soal2) {
                        soal2.classList.add("locked");
                        soal2.classList.remove("active");
                    }

                    if (soal3) {
                        soal3.classList.add("locked");
                        soal3.classList.remove("active");
                    }

                    if (input1) {
                        input1.disabled = false;
                        input1.removeAttribute("disabled");
                        input1.removeAttribute("readonly");
                    }

                    if (input2) {
                        input2.disabled = true;
                        input2.setAttribute("disabled", "disabled");
                    }

                    if (input3) {
                        input3.disabled = true;
                        input3.setAttribute("disabled", "disabled");
                    }

                    const tombol1 = input1 ? input1.parentElement.querySelector("button") : null;
                    const tombol2 = input2 ? input2.parentElement.querySelector("button") : null;
                    const tombol3 = input3 ? input3.parentElement.querySelector("button") : null;

                    if (tombol1) {
                        tombol1.disabled = false;
                        tombol1.removeAttribute("disabled");
                    }

                    if (tombol2) {
                        tombol2.disabled = true;
                        tombol2.setAttribute("disabled", "disabled");
                    }

                    if (tombol3) {
                        tombol3.disabled = true;
                        tombol3.setAttribute("disabled", "disabled");
                    }
                }

                /* =========================
                INIT
                ========================== */
                initLatihanPolinom();
                updateUnlock();
                rerenderKatex();
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