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

    <!-- p5.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/p5@1.9.0/lib/p5.min.js"></script>

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

            --ok: #0f5f22;
            --ok-soft: rgba(27, 122, 42, .08);

            --warn: #7a4a00;
            --warn-soft: rgba(217, 119, 6, .10);
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

        .card ul,
        .card ol {
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

        /* ===== DEFINISI (card peach) ===== */
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

        /* ===== TABEL (yang sudah ada) ===== */
        .table-wrap {
            overflow-x: auto;
            margin-top: 10px;
            border-radius: 14px;
            border: 2px solid var(--outer-line);
            background: #fff;
            box-shadow: 0 8px 18px rgba(0, 0, 0, .04);
        }

        table.poli {
            width: 100%;
            border-collapse: collapse;
            min-width: 640px;
            font-size: 16px;
        }

        table.poli thead th {
            background: #8AD06E;
            color: #0d2d0f;
            font-weight: 900;
            padding: 12px 10px;
            border-bottom: 2px solid rgba(0, 0, 0, .08);
            text-align: center;
        }

        table.poli td {
            padding: 12px 10px;
            border-top: 1px solid rgba(0, 0, 0, .08);
            text-align: center;
            color: var(--muted);
        }

        table.poli td:first-child,
        table.poli th:first-child {
            text-align: center;
            font-weight: 900;
            color: #1f1f1f;
        }

        .note {
            margin-top: 12px;
            padding: 14px 16px;
            border-radius: 14px;
            border: 1px solid rgba(0, 0, 0, .08);
            background: #fff;
            color: var(--muted);
        }

        /* ===== EKSPLORASI ===== */
        .mission {
            margin-top: 10px;
            display: grid;
            gap: 10px;
        }

        .mission-row {
            display: grid;
            grid-template-columns: 1.25fr .75fr;
            gap: 12px;
            align-items: stretch;
        }

        .panel {
            border: 1px solid rgba(0, 0, 0, .08);
            border-radius: 16px;
            background: #fff;
            padding: 14px;
        }

        .panel-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            font-weight: 900;
            color: #1f1f1f;
            margin-bottom: 10px;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 900;
            font-size: 13px;
            padding: 6px 10px;
            border-radius: 999px;
            border: 1px solid rgba(0, 0, 0, .12);
            background: #fff;
            color: var(--muted);
            user-select: none;
        }

        .chip.ok {
            border-color: rgba(27, 122, 42, .22);
            background: var(--ok-soft);
            color: var(--ok);
        }

        .chip.warn {
            border-color: rgba(217, 119, 6, .22);
            background: var(--warn-soft);
            color: #7a4a00;
        }

        .range {
            width: 100%;
            accent-color: var(--accent);
        }

        .kpi {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
            margin-top: 8px;
        }

        .kpi .box {
            border: 1px solid rgba(0, 0, 0, .08);
            border-radius: 14px;
            padding: 10px 12px;
            background: rgba(243, 247, 255, .55);
        }

        .kpi .lbl {
            font-weight: 900;
            font-size: 13px;
            color: var(--muted);
            line-height: 1.2;
        }

        .kpi .val {
            font-weight: 900;
            font-size: 18px;
            color: #1f1f1f;
            margin-top: 3px;
        }

        .canvas-wrap {
            border-radius: 16px;
            border: 1px solid rgba(0, 0, 0, .10);
            overflow: hidden;
            background: #fff;
        }

        canvas#expGraph {
            width: 100%;
            height: 260px;
            display: block;
        }

        .exp-explainbox {
            margin-top: 12px;
            border-radius: 14px;
            border: 1px solid rgba(0, 0, 0, .12);
            background: rgba(255, 255, 255, .86);
            padding: 12px 12px;
            color: var(--muted);
        }

        .exp-explainbox .head {
            font-weight: 900;
            color: #111;
            margin-bottom: 6px;
        }

        .exp-explainbox .line {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            padding: 6px 0;
            border-top: 1px dashed rgba(0, 0, 0, .08);
        }

        .exp-explainbox .line:first-of-type {
            border-top: none;
            padding-top: 2px;
        }

        .exp-explainbox .tag {
            flex: 0 0 auto;
            font-weight: 900;
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 999px;
            border: 1px solid rgba(0, 0, 0, .10);
            background: #fff;
            color: var(--muted);
            line-height: 1;
            margin-top: 2px;
        }

        .exp-explainbox .txt {
            flex: 1 1 auto;
            line-height: 1.6;
        }

        .exp-explainbox b {
            color: #111;
        }

        .small-note {
            font-size: 14px;
            color: var(--muted);
            margin-top: 8px;
        }

        @media (max-width:860px) {
            .mission-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width:760px) {
            .kpi {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width:640px) {
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
        }

        /* ===== TAMBAHAN ISI CARD AGAR LEBIH HIDUP ===== */
        .subinfo-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin: 14px 0;
        }

        .subinfo-box {
            border: 1px solid rgba(0, 0, 0, .10);
            border-radius: 14px;
            padding: 12px 14px;
            background: rgba(243, 247, 255, .45);
        }

        .subinfo-box .head {
            font-weight: 900;
            color: #111;
            margin-bottom: 6px;
        }

        .subinfo-box p,
        .subinfo-box li {
            color: var(--muted);
            line-height: 1.6;
            margin: 0;
        }

        .subinfo-box ul {
            margin: 0;
            padding-left: 18px;
        }

        .challenge-box {
            margin-top: 14px;
            border: 1px solid rgba(0, 0, 0, .10);
            border-radius: 14px;
            padding: 14px;
            background: #fff;
        }

        .challenge-title {
            font-weight: 900;
            color: #111;
            margin-bottom: 8px;
        }

        .challenge-row {
            display: grid;
            grid-template-columns: 1.2fr .8fr;
            gap: 10px;
            align-items: center;
            padding: 10px 0;
            border-top: 1px dashed rgba(0, 0, 0, .08);
        }

        .challenge-row:first-of-type {
            border-top: none;
            padding-top: 4px;
        }

        .challenge-label {
            color: #222;
            font-weight: 800;
            line-height: 1.6;
        }

        .mini-badge-row {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 10px 0 0;
        }

        .mini-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 900;
            border: 1px solid rgba(0, 0, 0, .10);
            background: #fff;
            color: #333;
        }

        .mini-badge.good {
            background: rgba(27, 122, 42, .08);
            color: #0f5f22;
            border-color: rgba(27, 122, 42, .18);
        }

        .mini-badge.info {
            background: rgba(43, 108, 176, .08);
            color: #1f4f86;
            border-color: rgba(43, 108, 176, .18);
        }

        .mini-answer {
            width: 100%;
            padding: 10px 12px;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, .18);
            background: #fff;
            font-weight: 700;
            color: #111;
            outline: none;
        }

        .mini-answer:focus {
            border-color: rgba(43, 108, 176, .45);
            box-shadow: 0 0 0 3px rgba(43, 108, 176, .10);
        }

        .action-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 12px;
        }

        .info-feedback {
            margin-top: 12px;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, .10);
            background: #fff;
            color: var(--muted);
            line-height: 1.6;
        }

        .info-feedback.ok {
            border-color: rgba(27, 122, 42, .22);
            background: rgba(27, 122, 42, .08);
            color: #0f5f22;
            font-weight: 900;
        }

        .info-feedback.bad {
            border-color: rgba(217, 119, 6, .22);
            background: rgba(217, 119, 6, .10);
            color: #7a4a00;
            font-weight: 900;
        }

        .reveal-box {
            display: none;
            margin-top: 12px;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, .10);
            background: rgba(243, 247, 255, .45);
            color: var(--muted);
            line-height: 1.7;
        }

        /* =========================
                                                                                   CONTOH INTERAKTIF MODEL BARU
                                                                                   ========================= */
        .ci-card {
            border-radius: 18px;
            padding: 18px;
            background: #f8f6f3;
            border-left: 6px solid #e7d9c7;
            box-shadow: 0 10px 28px rgba(0, 0, 0, .05);
            margin-bottom: 18px;
        }

        .ci-shell {
            border: 2px solid #6eb77a;
            border-radius: 18px;
            background: #fcfcfc;
            padding: 18px 18px 16px;
        }

        .ci-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 18px;
            border-radius: 999px;
            font-weight: 900;
            font-size: 15px;
            color: #111;
            border: 2px solid #d98659;
            background: linear-gradient(180deg, #ffb38f, #f6a982);
            margin-bottom: 12px;
        }

        .ci-head {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 14px;
            margin-bottom: 6px;
        }

        .ci-head .title {
            font-size: 20px;
            font-weight: 900;
            color: #1f2937;
        }

        .ci-head .fx {
            font-size: 18px;
            font-weight: 700;
            color: #374151;
        }

        .ci-sub {
            margin: 0 0 14px;
            color: #6b7280;
            font-size: 15px;
            line-height: 1.6;
        }

        .ci-layout {
            display: grid;
            grid-template-columns: 1.05fr .95fr;
            gap: 16px;
            align-items: start;
        }

        .ci-panel {
            background: #f3f4f6;
            border: 1px solid rgba(0, 0, 0, .08);
            border-radius: 16px;
            padding: 14px;
        }

        .ci-panel-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            font-weight: 900;
            color: #1f2937;
            margin-bottom: 10px;
        }

        .ci-label {
            font-weight: 900;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .ci-chip-row,
        .ci-point-row {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .ci-chip,
        .ci-point-btn {
            border: 1px solid rgba(0, 0, 0, .12);
            background: #fff;
            color: #1f2937;
            border-radius: 999px;
            padding: 8px 14px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s ease;
            font-family: inherit;
        }

        .ci-chip:hover,
        .ci-point-btn:hover {
            transform: translateY(-1px);
        }

        .ci-chip.active,
        .ci-point-btn.active {
            background: #fde7d7;
            border-color: #d98659;
            color: #111;
        }

        .ci-range-wrap {
            margin: 14px 0 12px;
        }

        .ci-range-label {
            font-weight: 900;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .ci-range {
            width: 100%;
            accent-color: #3b82f6;
        }

        .ci-mini-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
            margin: 12px 0 14px;
        }

        .ci-mini-box {
            background: #fff;
            border: 1px solid rgba(0, 0, 0, .08);
            border-radius: 14px;
            padding: 10px 12px;
        }

        .ci-mini-box .mini-lbl {
            font-size: 13px;
            font-weight: 900;
            color: #6b7280;
            margin-bottom: 4px;
        }

        .ci-mini-box .mini-val {
            font-size: 18px;
            font-weight: 900;
            color: #111827;
        }

        .ci-calc-title {
            font-weight: 900;
            color: #1f2937;
            margin: 10px 0 8px;
        }

        .ci-calc-box {
            background: #fff;
            border: 1px solid rgba(0, 0, 0, .08);
            border-radius: 14px;
            padding: 12px 14px;
            color: #374151;
            line-height: 1.8;
            margin-bottom: 10px;
        }

        .ci-graph-card {
            background: #f9fafb;
            border: 1px solid rgba(0, 0, 0, .10);
            border-radius: 16px;
            padding: 12px;
        }

        .ci-graph-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 10px;
            font-weight: 900;
            color: #1f2937;
        }

        .ci-graph-head .left {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .ci-dot-icon {
            width: 12px;
            height: 12px;
            border-radius: 999px;
            background: #f59ac2;
            display: inline-block;
        }

        .ci-active-text {
            font-size: 14px;
            color: #4b5563;
            font-weight: 900;
        }

        .ci-canvas-wrap {
            border: 1px solid rgba(0, 0, 0, .08);
            border-radius: 14px;
            background: #fff;
            overflow: hidden;
            padding: 8px;
        }

        #ciGraphCanvas {
            width: 100%;
            height: 300px;
            display: block;
            border-radius: 12px;
        }

        .ci-footnote {
            margin-top: 8px;
            color: #6b7280;
            font-size: 14px;
            line-height: 1.5;
        }

        @media (max-width: 900px) {
            .ci-layout {
                grid-template-columns: 1fr;
            }

            #ciGraphCanvas {
                height: 260px;
            }
        }

        @media (max-width: 640px) {
            .ci-mini-grid {
                grid-template-columns: 1fr;
            }

            .ci-head .title {
                font-size: 18px;
            }

            .ci-head .fx {
                font-size: 16px;
            }
        }


        @media (max-width: 860px) {

            .subinfo-grid,
            .challenge-row {
                grid-template-columns: 1fr;
            }
        }

        /* ===== MARI MENCOBA DENGAN DIAGRAM ===== */
        .mencoba-layout {
            display: grid;
            grid-template-columns: 360px 1fr;
            gap: 18px;
            align-items: start;
        }

        .mencoba-panel {
            background: #f7f7f7;
            border: 1px solid rgba(0, 0, 0, .08);
            border-radius: 18px;
            padding: 14px;
        }

        .mencoba-title {
            display: flex;
            justify-content: center;
            margin-bottom: 8px;
        }

        .mencoba-title span {
            display: inline-block;
            min-width: 220px;
            text-align: center;
            background: #232323;
            color: #fff;
            padding: 14px 24px;
            border-radius: 18px;
            font-weight: 900;
            font-size: 16px;
            letter-spacing: .4px;
        }

        .mencoba-subtitle {
            text-align: center;
            font-size: 13px;
            color: #7a7a7a;
            margin-bottom: 14px;
        }

        .mencoba-soal {
            background: #fff;
            border: 1px solid rgba(0, 0, 0, .08);
            border-radius: 18px;
            padding: 14px 14px 12px;
            margin-bottom: 12px;
        }

        .mencoba-soal .head {
            font-weight: 900;
            color: #111;
            margin-bottom: 8px;
        }

        .mencoba-soal p {
            margin: 8px 0;
            color: var(--muted);
            line-height: 1.6;
        }

        .mencoba-soal ul {
            margin: 8px 0 0 18px;
            color: var(--muted);
        }

        .mencoba-soal li {
            margin: 6px 0;
        }

        .mencoba-fx {
            color: #1367d1 !important;
            font-size: 22px;
            font-weight: 900;
            margin: 8px 0 10px;
        }

        .mencoba-note {
            font-size: 13px;
            color: #777;
            margin-top: 10px;
        }

        .mencoba-input-card {
            background: #fff;
            border: 1px solid rgba(0, 0, 0, .08);
            border-radius: 18px;
            padding: 14px;
        }

        .mini-tip {
            font-size: 12px;
            color: #777;
            margin: 0 0 10px;
        }

        .mencoba-form-block {
            border: 1px solid rgba(0, 0, 0, .08);
            border-radius: 14px;
            padding: 12px;
            background: #fafafa;
            margin-bottom: 12px;
        }

        .mencoba-form-title {
            font-weight: 900;
            color: #222;
            margin-bottom: 10px;
        }

        .mencoba-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .mencoba-grid-2 label {
            display: block;
            font-size: 13px;
            font-weight: 800;
            color: #555;
            margin-bottom: 6px;
        }

        .mencoba-diagram-wrap {
            background: #f7f7f7;
            border: 1px solid rgba(0, 0, 0, .08);
            border-radius: 18px;
            padding: 14px;
        }

        .mencoba-diagram-head {
            margin-bottom: 10px;
        }

        .mencoba-diagram-head .head {
            font-weight: 900;
            color: #111;
            margin-bottom: 2px;
        }

        .mencoba-diagram-head .sub {
            font-size: 13px;
            color: #777;
        }

        .mencoba-diagram-box {
            padding: 10px;
            min-height: 520px;
        }

        #p5MariMencoba1 {
            width: 100%;
            min-height: 500px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #p5MariMencoba1 canvas {
            max-width: 100%;
            height: auto !important;
            display: block;
            border-radius: 12px;
        }

        @media (max-width: 980px) {
            .mencoba-layout {
                grid-template-columns: 1fr;
            }

            .mencoba-diagram-box,
            #p5MariMencoba1 {
                min-height: 360px;
            }
        }

        /* ===== Materi tambahan (tanpa card) ===== */
        .materi-inline {
            margin: 10px 0 22px;
        }

        .materi-inline .inline-lead {
            font-size: 18px;
            text-align: justify;
            color: var(--muted);
            margin: 10px 0;
        }

        .materi-figure {
            margin: 14px 0 18px;
            display: flex;
            justify-content: center;
        }

        .materi-figure img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        /* =========================================================
                                                                            ✅ TABEL PERILAKU UJUNG (RAPI + GRID GARIS)
                                                                            ========================================================= */
        .endbeh-table-wrap {
            overflow-x: auto;
            margin-top: 14px;
            border-radius: 16px;
            border: 2px solid var(--outer-line);
            background: #fff;
            box-shadow: 0 10px 22px rgba(0, 0, 0, .05);
        }

        table.endbeh {
            width: 100%;
            border-collapse: collapse;
            min-width: 760px;
            font-size: 16px;
            border: 2px solid rgba(0, 0, 0, .14);
        }

        table.endbeh thead th {
            background: #8AD06E;
            color: #0d2d0f;
            font-weight: 900;
            padding: 14px 12px;
            text-align: center;
            vertical-align: middle;
            border: 1px solid rgba(0, 0, 0, .18);
            border-bottom: 2px solid rgba(0, 0, 0, .22);
        }

        table.endbeh tbody td {
            padding: 14px 12px;
            vertical-align: top;
            color: var(--muted);
            border: 1px solid rgba(0, 0, 0, .14);
        }

        table.endbeh tbody tr:nth-child(odd) td {
            background: rgba(243, 247, 255, .28);
        }

        table.endbeh td.col-n {
            width: 130px;
            text-align: center;
            font-weight: 900;
            color: #1f1f1f;
            vertical-align: middle;
            white-space: nowrap;
        }

        table.endbeh thead th:nth-child(1),
        table.endbeh tbody td:nth-child(1) {
            border-right: 2px solid rgba(0, 0, 0, .22);
        }

        table.endbeh thead th:nth-child(2),
        table.endbeh tbody td:nth-child(2) {
            border-right: 2px solid rgba(0, 0, 0, .22);
        }

        .endbeh-cell {
            display: grid;
            gap: 10px;
        }

        .endbeh-bullets {
            margin: 0;
            padding-left: 18px;
        }

        .endbeh-bullets li {
            margin: 6px 0;
            line-height: 1.6;
        }

        .endbeh-tagrow {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
        }

        .endbeh-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 900;
            font-size: 12px;
            padding: 6px 10px;
            border-radius: 999px;
            border: 1px solid rgba(0, 0, 0, .10);
            background: #fff;
            color: #222;
            user-select: none;
            white-space: nowrap;
        }

        .endbeh-pill.green {
            border-color: rgba(27, 122, 42, .22);
            background: rgba(27, 122, 42, .08);
            color: #0f5f22;
        }

        .endbeh-pill.blue {
            border-color: rgba(43, 108, 176, .18);
            background: rgba(43, 108, 176, .08);
            color: #1f4f86;
        }

        .img-toggle {
            border: 1px solid rgba(0, 0, 0, .14);
            border-radius: 14px;
            overflow: hidden;
            background: #fff;
        }

        .img-toggle summary {
            cursor: pointer;
            list-style: none;
            padding: 10px 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            font-weight: 900;
            color: #1f1f1f;
            background: rgba(255, 255, 255, .95);
            border-bottom: 1px solid rgba(0, 0, 0, .10);
        }

        .img-toggle summary::-webkit-details-marker {
            display: none;
        }

        .img-toggle .hint {
            font-weight: 900;
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 999px;
            border: 1px solid rgba(0, 0, 0, .12);
            background: rgba(243, 247, 255, .6);
            color: #1f4f86;
            white-space: nowrap;
        }

        .img-toggle .imgbox {
            padding: 12px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .img-toggle img {
            max-width: 100%;
            height: auto;
            display: block;
            border-radius: 12px;
        }

        .endbeh-note {
            margin-top: 10px;
            padding: 12px 14px;
            border-radius: 14px;
            border: 1px solid rgba(0, 0, 0, .08);
            background: #fff;
            color: var(--muted);
            line-height: 1.7;
        }

        /* =========================================================
                                                                            ✅ CARD CONTOH INTERAKTIF (A/B/C) + PENYELESAIAN
                                                                            ========================================================= */
        .contoh-card {
            border-radius: 16px;
            padding: 20px 22px;
            background: #fff;
            margin-bottom: 18px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(0, 0, 0, .06);
            border-left: 6px solid var(--outer-line);
        }

        .contoh-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 26px;
            border-radius: 999px;
            font-weight: 900;
            letter-spacing: .5px;
            border: 2px solid #e07b57;
            background: linear-gradient(180deg, #ffb59d, #ffa78a);
            color: #111;
            width: fit-content;
            margin-bottom: 12px;
        }

        .contoh-box {
            border: 2px solid #78d26b;
            border-radius: 12px;
            padding: 16px 16px 14px;
            background: #fff;
        }

        .contoh-instruksi {
            margin: 0 0 12px;
            color: var(--muted);
            font-size: 17px;
            line-height: 1.7;
            text-align: justify;
        }

        .contoh-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 14px;
            margin-top: 10px;
        }

        .grafik-row {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            align-items: start;
        }

        .grafik-card {
            border: 1px solid rgba(0, 0, 0, .12);
            border-radius: 14px;
            padding: 10px;
            background: #fff;
            text-align: center;
        }

        .grafik-card img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 10px;
        }

        .grafik-label {
            margin-top: 8px;
            font-weight: 900;
            color: #111;
            letter-spacing: .6px;
        }

        .match-area {
            border: 1px dashed rgba(0, 0, 0, .18);
            border-radius: 14px;
            padding: 12px;
            background: rgba(243, 247, 255, .45);
        }

        .match-row {
            display: grid;
            grid-template-columns: 1.3fr .7fr;
            gap: 10px;
            align-items: center;
            padding: 10px 0;
            border-top: 1px solid rgba(0, 0, 0, .08);
        }

        .match-row:first-child {
            border-top: none;
            padding-top: 4px;
        }

        .fx {
            font-size: 18px;
            color: #111;
            font-weight: 800;
        }

        .pick {
            width: 100%;
            padding: 10px 12px;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, .18);
            background: #fff;
            font-weight: 800;
            color: #111;
            outline: none;
        }

        .pick:focus {
            border-color: rgba(43, 108, 176, .5);
            box-shadow: 0 0 0 3px rgba(43, 108, 176, .12);
        }

        .btn-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 12px;
        }

        .btn-cek,
        .btn-reset {
            border: none;
            cursor: pointer;
            padding: 10px 14px;
            border-radius: 12px;
            font-weight: 900;
        }

        .btn-cek {
            background: rgba(43, 108, 176, .12);
            color: #1f4f86;
            border: 1px solid rgba(43, 108, 176, .25);
        }

        .btn-reset {
            background: rgba(0, 0, 0, .06);
            color: #222;
            border: 1px solid rgba(0, 0, 0, .10);
        }

        .feedback {
            margin-top: 10px;
            padding: 10px 12px;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, .10);
            background: #fff;
            color: var(--muted);
            line-height: 1.6;
        }

        .feedback.ok {
            border-color: rgba(27, 122, 42, .22);
            background: rgba(27, 122, 42, .08);
            color: #0f5f22;
            font-weight: 900;
        }

        .feedback.bad {
            border-color: rgba(217, 119, 6, .22);
            background: rgba(217, 119, 6, .10);
            color: #7a4a00;
            font-weight: 900;
        }

        #penyelesaianContoh {
            display: none;
            margin-top: 14px;
        }

        .solve-table-wrap {
            overflow-x: auto;
            margin-top: 10px;
            border-radius: 14px;
            border: 2px solid var(--outer-line);
            background: #fff;
            box-shadow: 0 8px 18px rgba(0, 0, 0, .04);
        }

        table.solve {
            width: 100%;
            border-collapse: collapse;
            min-width: 720px;
            font-size: 16px;
            border: 2px solid rgba(0, 0, 0, .14);
        }

        table.solve th {
            background: #8AD06E;
            color: #0d2d0f;
            font-weight: 900;
            padding: 12px 10px;
            text-align: center;
            border: 1px solid rgba(0, 0, 0, .18);
        }

        table.solve td {
            padding: 12px 10px;
            border: 1px solid rgba(0, 0, 0, .14);
            text-align: center;
            color: var(--muted);
        }

        table.solve td:first-child {
            font-weight: 900;
            color: #111;
        }

        @media (max-width: 900px) {
            .grafik-row {
                grid-template-columns: 1fr;
            }

            .match-row {
                grid-template-columns: 1fr;
            }
        }
        .latihan-title-row {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 14px;
        }

        .latihan-badge {
            background: #6d6e73;
            color: #fff;
            font-weight: 900;
            padding: 10px 30px;
            border-radius: 8px;
            font-size: 15px;
            letter-spacing: .3px;
        }

        .latihan-section {
            margin-top: 10px;
            padding-top: 4px;
        }

        .latihan-section h3 {
            font-size: 18px;
            font-weight: 900;
            margin: 0 0 8px;
            color: #111;
        }

        .latihan-section+.latihan-section {
            border-top: 2px solid #d85a5a;
            padding-top: 14px;
            margin-top: 16px;
        }

        .latihan-rumus {
            margin: 6px 0 8px;
            font-size: 17px;
            color: #111;
        }

        .latihan-sub {
            margin: 4px 0 10px;
            color: #333;
            font-size: 15px;
        }

        .latihan-grid {
            display: grid;
            grid-template-columns: 1.35fr 0.9fr;
            gap: 8px 14px;
            align-items: center;
        }

        .soal-label {
            font-size: 15px;
            color: #111;
        }

        .latihan-input {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #555;
            border-radius: 4px;
            background: #f8f8f8;
            font-family: inherit;
            font-size: 14px;
        }

        .latihan-input.kecil {
            max-width: 90px;
            text-align: center;
        }

        .grafik-box {
            border: 1px solid #cfcfcf;
            border-radius: 8px;
            background: #f6f6f6;
            padding: 10px;
            margin: 10px 0 14px;
        }

        .grafik-caption {
            font-size: 14px;
            margin-bottom: 8px;
            color: #222;
        }

        .grafik-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            align-items: start;
        }

        .grafik-item {
            text-align: center;
        }

        .grafik-item img {
            width: 100%;
            max-width: 150px;
            height: auto;
            display: block;
            margin: 0 auto 6px;
        }

        .grafik-huruf {
            font-weight: 900;
            color: #111;
        }

        .match-table {
            display: grid;
            grid-template-columns: 1.3fr .7fr 1fr .6fr;
            gap: 8px 10px;
            align-items: center;
        }

        .match-header {
            font-weight: 900;
            font-size: 14px;
            color: #111;
            padding-top: 4px;
            padding-bottom: 4px;
        }

        .latihan-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .latihan-actions.bawah {
            margin-top: 16px;
        }

        .latihan-btn {
            border: 1px solid #333;
            background: #fff;
            color: #111;
            border-radius: 6px;
            padding: 9px 14px;
            font-family: inherit;
            font-size: 12px;
            font-weight: 900;
            cursor: pointer;
        }

        .latihan-btn:hover {
            background: #f2f2f2;
        }

        .latihan-btn.reset {
            background: #fafafa;
        }

        .hasil-latihan {
            margin-top: 12px;
            padding: 10px 12px;
            border-radius: 8px;
            background: #fff;
            border: 1px solid #cfcfcf;
            color: #333;
            font-size: 14px;
            line-height: 1.6;
        }

        .hasil-latihan.ok {
            background: rgba(27, 122, 42, .08);
            border-color: rgba(27, 122, 42, .22);
            color: #0f5f22;
            font-weight: 700;
        }

        .hasil-latihan.bad {
            background: rgba(217, 119, 6, .10);
            border-color: rgba(217, 119, 6, .22);
            color: #7a4a00;
            font-weight: 700;
        }

        @media (max-width: 860px) {

            .latihan-grid,
            .match-table {
                grid-template-columns: 1fr;
            }

            .grafik-row {
                grid-template-columns: 1fr;
            }

            .latihan-input.kecil {
                max-width: 100%;
                text-align: left;
            }
        }
    </style>

    <div class="materi-wrap">
        <div class="top-title">
            <div class="label">3.</div>
            <div class="judul">Fungsi Polinomial dan Grafiknya</div>
        </div>

        <p class="lead-text">
            Polinomial tidak hanya sekadar bentuk aljabar yang terdiri atas beberapa suku.
            Polinomial juga dapat digunakan untuk membentuk suatu fungsi yang disebut
            <strong>fungsi polinomial</strong>. Ketika sebuah polinomial diberi variabel bebas,
            misalnya variabel <strong>$x$</strong>, maka setiap nilai $x$ yang dimasukkan ke dalam polinomial
            tersebut akan menghasilkan suatu nilai fungsi.
        </p>

        {{-- =========================
        EKSPLORASI
        ========================= --}}
        <div class="card card-explore">
            <div class="title-box">🧭 Eksplorasi</div>

            <p>
                Bayangkan kamu adalah <b>pengamat lahan basah</b> di Kalimantan Selatan. Setiap perubahan waktu $x$
                memengaruhi luas genangan $f(x)$. Kamu diminta mengamati perubahan nilai fungsi dan posisi titiknya
                pada grafik.
            </p>

            <p class="note">
                Model yang digunakan:
                <b>$$f(x)=x^2-2x-3$$</b>
                <br>
                Tugasmu: <b>geser slider</b>, amati informasi yang muncul, lalu <b>jawab pertanyaan</b> berdasarkan hasil
                pengamatanmu.
            </p>

            <div class="mission">
                <div class="mission-row">
                    <div class="panel">
                        <div class="panel-title">
                            <span>🕹️ Kontrol Waktu</span>
                            <span class="chip" id="expInsightChip">Insight: siap diamati</span>
                        </div>

                        <input class="range" id="expX" type="range" min="-6" max="6" step="1" value="0">

                        <div class="small-note">
                            Geser slider untuk mengubah nilai $x$. Perhatikan perubahan nilai fungsi, arah perubahan,
                            dan letak titik pada grafik.
                        </div>

                        <div class="kpi">
                            <div class="box">
                                <div class="lbl">Nilai x</div>
                                <div class="val" id="kpiX">0</div>
                            </div>
                            <div class="box">
                                <div class="lbl">Nilai f(x)</div>
                                <div class="val" id="kpiFx">-3</div>
                            </div>
                            <div class="box">
                                <div class="lbl">Arah Perubahan</div>
                                <div class="val" id="kpiTrend">Turun</div>
                            </div>
                        </div>

                        {{-- Soal untuk siswa --}}
                        <div class="exp-explainbox" id="expAnswerBox">
                            <div class="head">✍️ Jawaban Siswa</div>

                            <div class="line">
                                <span class="tag">1</span>
                                <div class="txt">
                                    Tentukan nilai <b>$f(x)$</b> untuk nilai $x$ saat ini.
                                    <br>
                                    <input type="number" id="studentFx" class="pick"
                                        style="max-width:180px; margin-top:8px;">
                                </div>
                            </div>

                            <div class="line">
                                <span class="tag">2</span>
                                <div class="txt">
                                    Titik $(x,f(x))$ berada di ...
                                    <br>
                                    <select id="studentPos" class="pick" style="max-width:240px; margin-top:8px;">
                                        <option value="">Pilih jawaban…</option>
                                        <option value="atas">Di atas sumbu-x</option>
                                        <option value="bawah">Di bawah sumbu-x</option>
                                        <option value="sumbu">Tepat pada sumbu-x</option>
                                    </select>
                                </div>
                            </div>

                            <div class="line">
                                <span class="tag">3</span>
                                <div class="txt">
                                    Pada nilai $x$ saat ini, nilai fungsi sedang ...
                                    <br>
                                    <select id="studentTrend" class="pick" style="max-width:240px; margin-top:8px;">
                                        <option value="">Pilih jawaban…</option>
                                        <option value="Naik">Naik</option>
                                        <option value="Turun">Turun</option>
                                        <option value="Tetap">Tetap</option>
                                    </select>
                                </div>
                            </div>

                            <div class="btn-row">
                                <button type="button" class="btn-cek" id="btnCheckExplore">✅ Cek Jawaban</button>
                                <button type="button" class="btn-reset" id="btnResetExplore">↺ Reset</button>
                                <button type="button" class="btn-reset" id="btnShowExplain">💡 Lihat Pembahasan</button>
                            </div>

                            <div class="feedback" id="feedbackExplore">
                                Amati grafiknya, lalu isi jawabanmu.
                            </div>
                        </div>

                        {{-- Pembahasan disembunyikan dulu agar jawaban tidak langsung terlihat --}}
                        <div class="exp-explainbox" id="expExplain" style="display:none;">
                            <div class="head">💡 Pembahasan</div>

                            <div class="line">
                                <span class="tag">1) Hitung</span>
                                <div class="txt" id="txtSub">
                                    Masukkan $x=0$ ke fungsi: $f(0)=0^2-2(0)-3=-3$.
                                </div>
                            </div>

                            <div class="line">
                                <span class="tag">2) Titik</span>
                                <div class="txt" id="txtPoint">
                                    Titiknya adalah $(0,-3)$ pada bidang koordinat.
                                </div>
                            </div>

                            <div class="line">
                                <span class="tag">3) Posisi</span>
                                <div class="txt" id="txtPos">
                                    Karena $f(0)$ negatif, titik berada <b>di bawah</b> sumbu-x.
                                </div>
                            </div>

                            <div class="line">
                                <span class="tag">4) Ide</span>
                                <div class="txt" id="txtIdea">
                                    Jika $f(x)=0$, maka titik tepat berada pada sumbu-x dan menjadi titik potong sumbu-x.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-title">
                            <span>📈 Grafik Fungsi</span>
                            <span class="chip warn" id="expCoordChip">Titik: (0, -3)</span>
                        </div>

                        <div class="canvas-wrap">
                            <canvas id="expGraph"></canvas>
                        </div>

                        <div class="small-note">
                            Kurva menunjukkan bentuk parabola. Titik berwarna menandai pasangan $(x, f(x))$ saat ini.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- =========================
        Materi lain (tetap)
        ========================= --}}
        <div class="card card-example">
            <p>
                Polinomial bukan hanya sekadar bentuk aljabar yang terdiri atas beberapa suku.
                Polinomial juga dapat digunakan untuk membentuk suatu fungsi yang disebut fungsi polinomial.
                Ketika sebuah polinomial diberi variabel bebas, misalnya variabel x, maka setiap nilai x yang dimasukkan ke
                dalam polinomial
                tersebut akan menghasilkan suatu nilai fungsi.
                Dengan demikian, fungsi polinomial dapat dipahami sebagai polinomial yang dijalankan atau dioperasikan
                sebagai fungsi.
            </p>
        </div>

        <div class="card definisi-card">
            <div class="definisi-label">DEFINISI</div>
            <p class="highlight" style="margin-top:6px;">Fungsi polinomial dalam variabel $x$ memiliki bentuk umum:</p>

            <div class="rumus" style="background:#f7f9fc;">
                $$P(x)=a_nx^n+a_{n-1}x^{n-1}+\cdots+a_1x+a_0$$
            </div>

            <p class="highlight" style="margin-top:10px;">Dengan ketentuan:</p>
            <ul>
                <li>$a_n,\ldots,a_0$ adalah bilangan real</li>
                <li>$a_n \ne 0$</li>
                <li>$n$ adalah bilangan cacah $(0,1,2,3,\ldots)$</li>
                <li><b>Derajat fungsi</b> adalah pangkat tertinggi</li>
                <li><b>Suku utama</b> adalah suku dengan pangkat tertinggi</li>
                <li><b>Koefisien utama</b> adalah koefisien pada suku utama</li>
            </ul>
        </div>

        {{-- =========================
        ✅ MATERI TAMBAHAN (DITAMBAHKAN DI BAWAH DEFINISI)
        ========================= --}}
        <div class="card card-example">
            <p>
                Sebelum mempelajari lebih jauh tentang sifat-sifat fungsi polinomial, perhatikan
                beberapa contoh fungsi polinomial berikut. Setiap fungsi dianalisis berdasarkan
                bentuknya, derajatnya, jumlah sukunya, serta suku utamanya. Tabel ini akan membantu
                Anda memahami bagaimana struktur sebuah fungsi polinomial dibentuk.
            </p>

            <div class="table-wrap">
                <table class="poli" aria-label="Tabel contoh fungsi polinomial">
                    <thead>
                        <tr>
                            <th>fungsi</th>
                            <th>Derajat</th>
                            <th>Jumlah Suku</th>
                            <th>Suku Utama</th>
                            <th>Koefisien Utama</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>$9x^2$</td>
                            <td>2</td>
                            <td>1 suku</td>
                            <td>$9x^2$</td>
                            <td>9</td>
                        </tr>
                        <tr>
                            <td>$5x^4-3x^2+8$</td>
                            <td>4</td>
                            <td>3 suku</td>
                            <td>$5x^4$</td>
                            <td>5</td>
                        </tr>
                        <tr>
                            <td>$7x^3+x^2-4x+2-6$</td>
                            <td>3</td>
                            <td>5 suku</td>
                            <td>$7x^3$</td>
                            <td>7</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p>
                Untuk memahami bentuk suatu fungsi polinomial, salah satu cara yang paling
                sederhana adalah dengan menggambar grafiknya. Grafik ini menunjukkan
                bagaimana nilai fungsi berubah terhadap nilai variabel $x$. Proses menggambarnya
                dapat dilakukan secara manual menggunakan langkah-langkah berikut.
            </p>
        </div>

        {{-- =========================
        CONTOH INTERAKTIF MODEL BARU
        ========================= --}}
        <div class="ci-card">
            <div class="ci-shell">
                <div class="ci-pill">CONTOH INTERAKTIF</div>

                <div class="ci-head">
                    <div class="title">Gambarlah grafik fungsi</div>
                    <div class="fx">f(x) = x² − 2x − 3</div>
                </div>

                <p class="ci-sub">
                    Klik chip titik atau geser slider untuk melihat koordinatnya dan posisinya pada grafik.
                </p>

                <div class="ci-layout">
                    {{-- KIRI --}}
                    <div class="ci-panel">
                        <div class="ci-label">✦ Pilih Bagian yang Dilihat</div>
                        <div class="ci-chip-row">
                            <button type="button" class="ci-chip active" data-ci-mode="nilai">Nilai</button>
                            <button type="button" class="ci-chip" data-ci-mode="potongx">Potong x</button>
                            <button type="button" class="ci-chip" data-ci-mode="potongy">Potong y</button>
                            <button type="button" class="ci-chip" data-ci-mode="vertex">Vertex</button>
                        </div>

                        <div class="ci-range-wrap">
                            <div class="ci-range-label">Geser untuk memilih x</div>
                            <input id="ciRangeX" class="ci-range" type="range" min="-2" max="4" step="1" value="0">
                        </div>

                        <div class="ci-mini-grid">
                            <div class="ci-mini-box">
                                <div class="mini-lbl">x</div>
                                <div class="mini-val" id="ciValX">0</div>
                            </div>
                            <div class="ci-mini-box">
                                <div class="mini-lbl">F(X)</div>
                                <div class="mini-val" id="ciValFx">-3</div>
                            </div>
                        </div>

                        <div class="ci-calc-title">Perhitungan cepat:</div>
                        <div class="ci-calc-box">
                            <div id="ciCalcMain">f(x) = x² − 2x − 3</div>
                            <div id="ciCalcSub">f(0) = 0² − 2(0) − 3 = -3</div>
                        </div>

                        <div class="ci-calc-title">Klik salah satu titik:</div>
                        <div class="ci-point-row">
                            <button type="button" class="ci-point-btn" data-x="-2">(-2, 5)</button>
                            <button type="button" class="ci-point-btn" data-x="-1">(-1, 0)</button>
                            <button type="button" class="ci-point-btn active" data-x="0">(0, -3)</button>
                            <button type="button" class="ci-point-btn" data-x="1">(1, -4)</button>
                            <button type="button" class="ci-point-btn" data-x="2">(2, -3)</button>
                            <button type="button" class="ci-point-btn" data-x="3">(3, 0)</button>
                            <button type="button" class="ci-point-btn" data-x="4">(4, 5)</button>
                        </div>
                    </div>

                    {{-- KANAN --}}
                    <div class="ci-graph-card">
                        <div class="ci-graph-head">
                            <div class="left">
                                <span class="ci-dot-icon"></span>
                                <span>Grafik (klik titik/label)</span>
                            </div>
                            <div class="ci-active-text" id="ciActivePointText">Titik aktif: (0, -3)</div>
                        </div>

                        <div class="ci-canvas-wrap">
                            <canvas id="ciGraphCanvas"></canvas>
                        </div>

                        <div class="ci-footnote">
                            Klik titik pada grafik atau tombol titik di sebelah kiri untuk memilih titik yang diamati.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- =========================
        MATERI TAMBAHAN (tanpa card)
        ========================= --}}
        <div class="materi-inline">
            <p class="inline-lead">
                Yuk lihat bagaimana bentuk grafik berubah dari fungsi derajat 0 hingga derajat 5!
                Mulai dari garis datar, garis miring, lengkungan parabola, hingga gelombang-gelombang unik yang muncul pada
                derajat lebih tinggi.
                Semua grafik ditampilkan berdampingan agar kamu bisa dengan mudah membandingkan bentuknya.
            </p>

            <div class="materi-figure">
                <img src="{{ asset('img/10.png') }}" alt="Perbandingan grafik fungsi polinomial derajat 0 sampai 5">
            </div>

            <p class="inline-lead">
                Salah satu ciri penting dari grafik fungsi polinomial adalah perilaku ujungnya, yaitu kecenderungan grafik
                ketika nilai <b>x</b> bergerak menuju tak hingga atau menuju negatif tak hingga. Perilaku ujung ini
                sepenuhnya
                ditentukan oleh suku utama dari polinom, karena suku tersebut memiliki pengaruh paling besar dibandingkan
                suku-suku lainnya saat bernilai sangat besar.
            </p>

            <div class="endbeh-table-wrap">
                <table class="endbeh" aria-label="Tabel perilaku ujung fungsi polinomial">
                    <thead>
                        <tr>
                            <th style="width:130px;">N<br>(Derajat)</th>
                            <th>Koefisien Utama (a<sub>n</sub> &gt; 0)</th>
                            <th>Koefisien Utama (a<sub>n</sub> &lt; 0)</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="col-n">Genap</td>

                            <td>
                                <div class="endbeh-cell">
                                    <div class="endbeh-tagrow">
                                        <span class="endbeh-pill green">n genap</span>
                                        <span class="endbeh-pill blue">a<sub>n</sub> &gt; 0</span>
                                    </div>

                                    <ul class="endbeh-bullets">
                                        <li>Grafik menuju <b>atas</b> di ujung kiri dan ujung kanan.</li>
                                        <li><b>Perilaku ujung:</b> (x→−∞, y→+∞) dan (x→+∞, y→+∞)</li>
                                    </ul>

                                    <details class="img-toggle">
                                        <summary>
                                            <span>📌 Lihat ilustrasi grafik</span>
                                            <span class="hint">Klik untuk buka</span>
                                        </summary>
                                        <div class="imgbox">
                                            <img src="{{ asset('img/11.png') }}"
                                                alt="Ilustrasi perilaku ujung: an > 0 dan n genap">
                                        </div>
                                    </details>
                                </div>
                            </td>

                            <td>
                                <div class="endbeh-cell">
                                    <div class="endbeh-tagrow">
                                        <span class="endbeh-pill green">n genap</span>
                                        <span class="endbeh-pill blue">a<sub>n</sub> &lt; 0</span>
                                    </div>

                                    <ul class="endbeh-bullets">
                                        <li>Grafik menuju <b>bawah</b> di ujung kiri dan ujung kanan.</li>
                                        <li><b>Perilaku ujung:</b> (x→−∞, y→−∞) dan (x→+∞, y→−∞)</li>
                                    </ul>

                                    <details class="img-toggle">
                                        <summary>
                                            <span>📌 Lihat ilustrasi grafik</span>
                                            <span class="hint">Klik untuk buka</span>
                                        </summary>
                                        <div class="imgbox">
                                            <img src="{{ asset('img/12.png') }}"
                                                alt="Ilustrasi perilaku ujung: an < 0 dan n genap">
                                        </div>
                                    </details>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="col-n">Ganjil</td>

                            <td>
                                <div class="endbeh-cell">
                                    <div class="endbeh-tagrow">
                                        <span class="endbeh-pill green">n ganjil</span>
                                        <span class="endbeh-pill blue">a<sub>n</sub> &gt; 0</span>
                                    </div>

                                    <ul class="endbeh-bullets">
                                        <li>Grafik menuju <b>bawah</b> di ujung kiri dan <b>atas</b> di ujung kanan.</li>
                                        <li><b>Perilaku ujung:</b> (x→−∞, y→−∞) dan (x→+∞, y→+∞)</li>
                                    </ul>

                                    <details class="img-toggle">
                                        <summary>
                                            <span>📌 Lihat ilustrasi grafik</span>
                                            <span class="hint">Klik untuk buka</span>
                                        </summary>
                                        <div class="imgbox">
                                            <img src="{{ asset('img/13.png') }}"
                                                alt="Ilustrasi perilaku ujung: an > 0 dan n ganjil">
                                        </div>
                                    </details>
                                </div>
                            </td>

                            <td>
                                <div class="endbeh-cell">
                                    <div class="endbeh-tagrow">
                                        <span class="endbeh-pill green">n ganjil</span>
                                        <span class="endbeh-pill blue">a<sub>n</sub> &lt; 0</span>
                                    </div>

                                    <ul class="endbeh-bullets">
                                        <li>Grafik menuju <b>atas</b> di ujung kiri dan <b>bawah</b> di ujung kanan.</li>
                                        <li><b>Perilaku ujung:</b> (x→−∞, y→+∞) dan (x→+∞, y→−∞)</li>
                                    </ul>

                                    <details class="img-toggle">
                                        <summary>
                                            <span>📌 Lihat ilustrasi grafik</span>
                                            <span class="hint">Klik untuk buka</span>
                                        </summary>
                                        <div class="imgbox">
                                            <img src="{{ asset('img/14.png') }}"
                                                alt="Ilustrasi perilaku ujung: an < 0 dan n ganjil">
                                        </div>
                                    </details>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="endbeh-note">
                <b>Ingat:</b> Perilaku ujung ditentukan oleh <b>suku utama</b> (pangkat tertinggi) dan <b>koefisien
                    utamanya</b>.
                Jadi, cukup lihat <b>n</b> (ganjil/genap) dan tanda <b>a<sub>n</sub></b> (positif/negatif) untuk menebak
                arah ujung grafik.
            </div>

            <p class="inline-lead">
                Dengan kata lain, meskipun sebuah polinom memiliki banyak suku, bentuk grafik pada bagian ujung kiri dan
                kanan sebenarnya mengikuti pola yang berasal dari pangkat tertinggi dan koefisien utamanya. Sifat inilah
                yang
                memungkinkan kita memperkirakan arah grafik tanpa harus menggambar seluruh kurva secara detail.
            </p>

            {{-- =========================
            ✅ PINDAH: CARD CONTOH DI BAWAH KALIMAT "Dengan kata lain..."
            ========================= --}}
            <div class="contoh-card" id="contohInteraktifCard">
                <div class="contoh-pill">CONTOH</div>

                <div class="contoh-box">
                    <p class="contoh-instruksi">
                        Dengan mengidentifikasi <b>perilaku ujungnya</b>, pasangkan setiap fungsi polinomial berikut
                        dengan salah satu grafik <b>A–C</b> yang telah diberikan.
                    </p>

                    <div class="contoh-grid">
                        <div class="grafik-row">
                            <div class="grafik-card">
                                <img src="{{ asset('img/A.png') }}" alt="Grafik A">
                                <div class="grafik-label">A</div>
                            </div>
                            <div class="grafik-card">
                                <img src="{{ asset('img/B.png') }}" alt="Grafik B">
                                <div class="grafik-label">B</div>
                            </div>
                            <div class="grafik-card">
                                <img src="{{ asset('img/C.png') }}" alt="Grafik C">
                                <div class="grafik-label">C</div>
                            </div>
                        </div>

                        <div class="match-area">
                            <div class="match-row">
                                <div class="fx">1) $g(x)=x^4-4x^2+3$</div>
                                <div>
                                    <select class="pick" id="pick1">
                                        <option value="">Pilih grafik…</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                    </select>
                                </div>
                            </div>

                            <div class="match-row">
                                <div class="fx">2) $h(x)=-x^6+4x^3-x$</div>
                                <div>
                                    <select class="pick" id="pick2">
                                        <option value="">Pilih grafik…</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                    </select>
                                </div>
                            </div>

                            <div class="match-row">
                                <div class="fx">3) $f(x)=2x^3-5x^2+x+1$</div>
                                <div>
                                    <select class="pick" id="pick3">
                                        <option value="">Pilih grafik…</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                    </select>
                                </div>
                            </div>

                            <div class="btn-row">
                                <button type="button" class="btn-cek" id="btnCekContoh">✅ Cek Jawaban</button>
                                <button type="button" class="btn-reset" id="btnResetContoh">↺ Reset</button>
                            </div>

                            <div class="feedback" id="feedbackContoh">
                                Pilih jawaban untuk nomor 1–3, lalu klik <b>Cek Jawaban</b>.
                            </div>

                            <div id="penyelesaianContoh">
                                <p style="margin: 14px 0 8px; font-weight:900; color:#111;">Penyelesaian:</p>
                                <p style="margin:0 0 10px; color:var(--muted); text-align:justify;">
                                    Untuk memasangkan fungsi polinomial dengan grafiknya, identifikasi <b>suku utama</b>,
                                    <b>derajat</b>,
                                    <b>tanda koefisien utama</b>, lalu tentukan <b>perilaku ujung</b>.
                                </p>

                                <div class="solve-table-wrap">
                                    <table class="solve" aria-label="Tabel penyelesaian perilaku ujung">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Suku Utama</th>
                                                <th>Derajat</th>
                                                <th>Tanda Koef</th>
                                                <th>Perilaku Ujung</th>
                                                <th>Grafik</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>$x^4$</td>
                                                <td>4</td>
                                                <td>Positif</td>
                                                <td>kiri ↑, kanan ↑</td>
                                                <td><b>B</b></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>$-x^6$</td>
                                                <td>6</td>
                                                <td>Negatif</td>
                                                <td>kiri ↓, kanan ↓</td>
                                                <td><b>C</b></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>$2x^3$</td>
                                                <td>3</td>
                                                <td>Positif</td>
                                                <td>kiri ↓, kanan ↑</td>
                                                <td><b>A</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="note" style="margin-top:12px;">
                                    <b>Kesimpulan:</b> Derajat genap → kedua ujung sama arah. Derajat ganjil → ujung kiri
                                    dan kanan berlawanan arah.
                                    Tanda koefisien utama menentukan apakah ujung kanan naik atau turun.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-example">
            <div class="latihan-title-row">
                <div class="latihan-badge">LATIHAN</div>
            </div>

            {{-- 1. Analisis Fungsi Polinomial --}}
            <section class="latihan-section">
                <h3>1. Analisis Fungsi Polinomial</h3>
                <div class="latihan-rumus">Diberikan fungsi <b>p(x) = 7x³ − 3x² + 15</b></div>
                <p class="latihan-sub">Tentukan:</p>

                <div class="latihan-grid">
                    <div class="soal-label">a. Derajat fungsi polinomial tersebut</div>
                    <input type="text" id="a1" class="latihan-input" placeholder="Jawaban...">

                    <div class="soal-label">b. Jumlah sukunya</div>
                    <input type="text" id="a2" class="latihan-input" placeholder="Jawaban...">

                    <div class="soal-label">c. Suku utamanya</div>
                    <input type="text" id="a3" class="latihan-input" placeholder="Jawaban...">

                    <div class="soal-label">d. Koefisien utamanya</div>
                    <input type="text" id="a4" class="latihan-input" placeholder="Jawaban...">

                    <div class="soal-label">e. Perilaku ujung grafiknya</div>
                    <input type="text" id="a5" class="latihan-input" placeholder="Contoh: kiri turun kanan naik">
                </div>
            </section>

            {{-- 2. Grafik Fungsi Kuadrat --}}
            <section class="latihan-section">
                <h3>2. Grafik Fungsi Kuadrat</h3>
                <div class="latihan-rumus">Diberikan fungsi <b>f(x) = x² − 2x − 8</b></div>
                <p class="latihan-sub">Tentukan pula:</p>

                <div class="latihan-grid">
                    <div class="soal-label">a. Titik potong dengan sumbu-x</div>
                    <input type="text" id="b1" class="latihan-input" placeholder="Jawaban...">

                    <div class="soal-label">b. Titik potong dengan sumbu-y</div>
                    <input type="text" id="b2" class="latihan-input" placeholder="Jawaban...">

                    <div class="soal-label">c. Vertex / titik puncak</div>
                    <input type="text" id="b3" class="latihan-input" placeholder="Jawaban...">
                </div>
            </section>

            {{-- 3. Perilaku Ujung & Mencocokkan Grafik --}}
            <section class="latihan-section">
                <h3>3. Perilaku Ujung &amp; Mencocokkan Grafik</h3>
                <p class="latihan-sub">
                    Tentukan grafik yang sesuai untuk masing-masing fungsi berikut berdasarkan perilaku ujungnya.
                </p>

                <div class="grafik-box">
                    <div class="grafik-caption">Grafik A, B, C:</div>
                    <div class="grafik-row">
                        <div class="grafik-item">
                            <img src="{{ asset('img/A.png') }}" alt="Grafik A">
                            <div class="grafik-huruf">A</div>
                        </div>
                        <div class="grafik-item">
                            <img src="{{ asset('img/B.png') }}" alt="Grafik B">
                            <div class="grafik-huruf">B</div>
                        </div>
                        <div class="grafik-item">
                            <img src="{{ asset('img/C.png') }}" alt="Grafik C">
                            <div class="grafik-huruf">C</div>
                        </div>
                    </div>
                </div>

                <div class="match-table">
                    <div class="match-header fungsi-col">Fungsinya</div>
                    <div class="match-header jawaban-col">Jawaban</div>
                    <div class="match-header perilaku-col">Perilaku Ujung</div>
                    <div class="match-header cocok-col">Cocok</div>

                    <div class="fungsi-col"><b>1.</b> <i>f(x)</i> = 2x³ + 5x² − 1</div>
                    <div class="jawaban-col">
                        <input type="text" id="c1" class="latihan-input kecil" placeholder="A/B/C">
                    </div>
                    <div class="perilaku-col">
                        <input type="text" id="c1u" class="latihan-input" placeholder="Contoh: turun-naik">
                    </div>
                    <div class="cocok-col">
                        <input type="text" id="c1c" class="latihan-input kecil" placeholder="A/B/C">
                    </div>

                    <div class="fungsi-col"><b>2.</b> <i>g(x)</i> = 3x⁴ − 6x² + 2</div>
                    <div class="jawaban-col">
                        <input type="text" id="c2" class="latihan-input kecil" placeholder="A/B/C">
                    </div>
                    <div class="perilaku-col">
                        <input type="text" id="c2u" class="latihan-input" placeholder="Contoh: naik-naik">
                    </div>
                    <div class="cocok-col">
                        <input type="text" id="c2c" class="latihan-input kecil" placeholder="A/B/C">
                    </div>

                    <div class="fungsi-col"><b>3.</b> <i>h(x)</i> = −x⁴ + 2x² − 3</div>
                    <div class="jawaban-col">
                        <input type="text" id="c3" class="latihan-input kecil" placeholder="A/B/C">
                    </div>
                    <div class="perilaku-col">
                        <input type="text" id="c3u" class="latihan-input" placeholder="Contoh: turun-turun">
                    </div>
                    <div class="cocok-col">
                        <input type="text" id="c3c" class="latihan-input kecil" placeholder="A/B/C">
                    </div>
                </div>

                <div class="latihan-actions bawah">
                    <button type="button" class="latihan-btn" id="cekLatihanBtn">CEK JAWABAN</button>
                    <button type="button" class="latihan-btn reset" id="resetLatihanBtn">RESET</button>
                </div>

                <div id="hasilLatihan" class="hasil-latihan">
                    Isi jawaban terlebih dahulu, lalu klik <b>Cek Jawaban</b>.
                </div>
            </section>
        </div>
    </div>
    {{-- =========================
    SCRIPT EKSPLORASI
    ========================= --}}
    <script>
        (function () {
            const rerenderMath = (root) => {
                if (window.renderMathInElement) {
                    renderMathInElement(root || document.body, {
                        delimiters: [
                            { left: '$$', right: '$$', display: true },
                            { left: '$', right: '$', display: false }
                        ]
                    });
                }
            };

            // ==== Eksplorasi canvas ====
            const slider = document.getElementById('expX');
            const kpiX = document.getElementById('kpiX');
            const kpiFx = document.getElementById('kpiFx');
            const kpiTrend = document.getElementById('kpiTrend');
            const insightChip = document.getElementById('expInsightChip');
            const coordChip = document.getElementById('expCoordChip');

            const txtSub = document.getElementById('txtSub');
            const txtPoint = document.getElementById('txtPoint');
            const txtPos = document.getElementById('txtPos');
            const txtIdea = document.getElementById('txtIdea');
            const explainBox = document.getElementById('expExplain');

            // ==== Jawaban siswa ====
            const studentFx = document.getElementById('studentFx');
            const studentPos = document.getElementById('studentPos');
            const studentTrend = document.getElementById('studentTrend');
            const feedbackExplore = document.getElementById('feedbackExplore');
            const btnCheckExplore = document.getElementById('btnCheckExplore');
            const btnResetExplore = document.getElementById('btnResetExplore');
            const btnShowExplain = document.getElementById('btnShowExplain');

            const canvas = document.getElementById('expGraph');
            const ctx = canvas ? canvas.getContext('2d') : null;

            function fx(x) {
                return x * x - 2 * x - 3;
            }

            function getCorrectPosition(y) {
                if (y > 0) return 'atas';
                if (y < 0) return 'bawah';
                return 'sumbu';
            }

            function getCorrectTrend(x) {
                if (x < 1) return 'Turun';
                if (x > 1) return 'Naik';
                return 'Tetap';
            }

            function getPositionLabel(y) {
                if (y > 0) return 'di atas sumbu-x';
                if (y < 0) return 'di bawah sumbu-x';
                return 'tepat pada sumbu-x';
            }

            function resizeCanvas() {
                if (!canvas || !ctx) return;
                const dpr = window.devicePixelRatio || 1;
                const rect = canvas.getBoundingClientRect();
                canvas.width = Math.floor(rect.width * dpr);
                canvas.height = Math.floor(rect.height * dpr);
                ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
            }

            function worldToScreen(x, y, W, H, pad, xMin, xMax, yMin, yMax) {
                const sx = pad + (x - xMin) * (W - 2 * pad) / (xMax - xMin);
                const sy = (H - pad) - (y - yMin) * (H - 2 * pad) / (yMax - yMin);
                return { sx, sy };
            }

            function drawGraph(x0) {
                if (!canvas || !ctx) return;

                const rect = canvas.getBoundingClientRect();
                const W = rect.width;
                const H = rect.height;
                const pad = 28;

                const xMin = -6, xMax = 6;

                let minY = Infinity, maxY = -Infinity;
                for (let x = xMin; x <= xMax; x += 0.25) {
                    const y = fx(x);
                    minY = Math.min(minY, y);
                    maxY = Math.max(maxY, y);
                }
                const yMin = Math.floor(minY - 2);
                const yMax = Math.ceil(maxY + 2);

                ctx.clearRect(0, 0, W, H);
                ctx.fillStyle = 'rgba(243,247,255,.45)';
                ctx.fillRect(0, 0, W, H);

                ctx.lineWidth = 1;
                ctx.strokeStyle = 'rgba(0,0,0,.06)';
                for (let x = Math.ceil(xMin); x <= Math.floor(xMax); x += 1) {
                    const p1 = worldToScreen(x, yMin, W, H, pad, xMin, xMax, yMin, yMax);
                    const p2 = worldToScreen(x, yMax, W, H, pad, xMin, xMax, yMin, yMax);
                    ctx.beginPath();
                    ctx.moveTo(p1.sx, p1.sy);
                    ctx.lineTo(p2.sx, p2.sy);
                    ctx.stroke();
                }

                for (let y = yMin; y <= yMax; y += 2) {
                    const p1 = worldToScreen(xMin, y, W, H, pad, xMin, xMax, yMin, yMax);
                    const p2 = worldToScreen(xMax, y, W, H, pad, xMin, xMax, yMin, yMax);
                    ctx.beginPath();
                    ctx.moveTo(p1.sx, p1.sy);
                    ctx.lineTo(p2.sx, p2.sy);
                    ctx.stroke();
                }

                ctx.lineWidth = 2;
                ctx.strokeStyle = 'rgba(0,0,0,.28)';
                const oy = worldToScreen(xMin, 0, W, H, pad, xMin, xMax, yMin, yMax).sy;
                const ox = worldToScreen(0, yMin, W, H, pad, xMin, xMax, yMin, yMax).sx;

                if (0 >= yMin && 0 <= yMax) {
                    ctx.beginPath();
                    ctx.moveTo(pad, oy);
                    ctx.lineTo(W - pad, oy);
                    ctx.stroke();
                }

                if (0 >= xMin && 0 <= xMax) {
                    ctx.beginPath();
                    ctx.moveTo(ox, pad);
                    ctx.lineTo(ox, H - pad);
                    ctx.stroke();
                }

                ctx.lineWidth = 3;
                ctx.strokeStyle = 'rgba(43,108,176,.90)';
                ctx.beginPath();
                let started = false;
                const samples = 240;

                for (let i = 0; i <= samples; i++) {
                    const x = xMin + (xMax - xMin) * (i / samples);
                    const y = fx(x);
                    const p = worldToScreen(x, y, W, H, pad, xMin, xMax, yMin, yMax);
                    if (!started) {
                        ctx.moveTo(p.sx, p.sy);
                        started = true;
                    } else {
                        ctx.lineTo(p.sx, p.sy);
                    }
                }
                ctx.stroke();

                const y0 = fx(x0);
                const p0 = worldToScreen(x0, y0, W, H, pad, xMin, xMax, yMin, yMax);

                ctx.lineWidth = 2;
                ctx.strokeStyle = 'rgba(27,122,42,.18)';
                ctx.beginPath();
                ctx.moveTo(p0.sx, pad);
                ctx.lineTo(p0.sx, H - pad);
                ctx.stroke();

                ctx.beginPath();
                ctx.moveTo(pad, p0.sy);
                ctx.lineTo(W - pad, p0.sy);
                ctx.stroke();

                ctx.fillStyle = 'rgba(27,122,42,.95)';
                ctx.beginPath();
                ctx.arc(p0.sx, p0.sy, 6, 0, Math.PI * 2);
                ctx.fill();

                ctx.strokeStyle = 'rgba(255,255,255,.95)';
                ctx.lineWidth = 2;
                ctx.beginPath();
                ctx.arc(p0.sx, p0.sy, 9, 0, Math.PI * 2);
                ctx.stroke();
            }

            const SPECIAL = {
                vertex: { x: 1, y: -4 }
            };

            function setInsight(kind, text) {
                if (!insightChip) return;
                insightChip.classList.remove('ok', 'warn');
                insightChip.textContent = text;
                if (kind) {
                    insightChip.classList.add(kind === 'ok' ? 'ok' : 'warn');
                }
            }

            function updateExplanation(x, y, trend) {
                if (txtSub) {
                    txtSub.innerHTML = `Masukkan $x=${x}$ ke fungsi: $f(${x})=${x}^2-2(${x})-3=${y}$.`;
                }

                if (txtPoint) {
                    txtPoint.innerHTML = `Titik saat ini adalah $(${x},${y})$.`;
                }

                const posisi = (y > 0)
                    ? `Titik <b>di atas</b> sumbu-x (positif).`
                    : (y < 0)
                        ? `Titik <b>di bawah</b> sumbu-x (negatif).`
                        : `Titik tepat <b>di sumbu-x</b> (akar).`;

                const arah = (trend === 'Naik')
                    ? `Nilai $f(x)$ <b>naik</b>.`
                    : (trend === 'Turun')
                        ? `Nilai $f(x)$ <b>turun</b>.`
                        : `Nilai $f(x)$ <b>tetap</b>.`;

                if (txtPos) {
                    txtPos.innerHTML = `${posisi} ${arah}`;
                }

                const isVertex = (x === SPECIAL.vertex.x && y === SPECIAL.vertex.y);

                if (txtIdea) {
                    if (y === 0) {
                        txtIdea.innerHTML = `✅ Ini <b>titik potong sumbu-x</b> karena $f(${x})=0$.`;
                    } else if (isVertex) {
                        txtIdea.innerHTML = `⭐ Ini <b>titik puncak (minimum)</b> yaitu $(1,-4)$.`;
                    } else if (x < 1) {
                        txtIdea.innerHTML = `Mendekati $x=1$, nilai $f(x)$ cenderung <b>mengecil</b>.`;
                    } else {
                        txtIdea.innerHTML = `Lewat $x=1$, nilai $f(x)$ cenderung <b>membesar</b>.`;
                    }
                }

                if (y === 0) {
                    setInsight('ok', 'Insight: titik potong sumbu-x');
                } else if (isVertex) {
                    setInsight('ok', 'Insight: titik puncak');
                } else {
                    setInsight('warn', 'Insight: amati perubahan');
                }

                rerenderMath(explainBox);
            }

            function hideExplanation() {
                if (explainBox) {
                    explainBox.style.display = 'none';
                }
            }

            function showExplanation() {
                if (!slider || !explainBox) return;
                const x = parseInt(slider.value, 10);
                const y = fx(x);
                const trend = getCorrectTrend(x);

                explainBox.style.display = 'block';
                updateExplanation(x, y, trend);
            }

            function resetStudentAnswerState() {
                if (feedbackExplore) {
                    feedbackExplore.className = "feedback";
                    feedbackExplore.innerHTML = "Amati grafiknya, lalu isi jawabanmu.";
                }
                setInsight('', 'Insight: siap diamati');
            }

            function updateExplorerUI() {
                if (!slider) return;

                const x = parseInt(slider.value, 10);
                const y = fx(x);
                const trend = getCorrectTrend(x);

                if (kpiX) kpiX.textContent = x;
                if (kpiFx) kpiFx.textContent = y;
                if (kpiTrend) kpiTrend.textContent = trend;
                if (coordChip) coordChip.textContent = `Titik: (${x}, ${y})`;

                resizeCanvas();
                drawGraph(x);
            }

            btnCheckExplore?.addEventListener('click', function () {
                if (!slider || !feedbackExplore) return;

                const x = parseInt(slider.value, 10);
                const y = fx(x);
                const posisiBenar = getCorrectPosition(y);
                const trendBenar = getCorrectTrend(x);

                const belum = [];
                if (studentFx?.value === "") belum.push("nilai f(x)");
                if (!studentPos?.value) belum.push("posisi titik");
                if (!studentTrend?.value) belum.push("arah perubahan");

                if (belum.length) {
                    feedbackExplore.className = "feedback bad";
                    feedbackExplore.innerHTML = `⚠️ Lengkapi dulu: <b>${belum.join(", ")}</b>.`;
                    hideExplanation();
                    return;
                }

                const benarFx = Number(studentFx.value) === y;
                const benarPos = studentPos.value === posisiBenar;
                const benarTrend = studentTrend.value === trendBenar;

                if (benarFx && benarPos && benarTrend) {
                    feedbackExplore.className = "feedback ok";
                    feedbackExplore.innerHTML =
                        `✅ Bagus! Jawabanmu benar. Untuk <b>x=${x}</b>, diperoleh <b>f(x)=${y}</b>.`;
                } else {
                    const koreksi = [];
                    if (!benarFx) koreksi.push(`nilai fungsi yang benar adalah <b>${y}</b>`);
                    if (!benarPos) koreksi.push(`posisi titik yang benar adalah <b>${getPositionLabel(y)}</b>`);
                    if (!benarTrend) koreksi.push(`arah perubahan yang benar adalah <b>${trendBenar}</b>`);

                    feedbackExplore.className = "feedback bad";
                    feedbackExplore.innerHTML = `❌ Jawaban belum tepat. ${koreksi.join(", ")}.`;
                }

                showExplanation();
            });

            btnResetExplore?.addEventListener('click', function () {
                if (studentFx) studentFx.value = "";
                if (studentPos) studentPos.value = "";
                if (studentTrend) studentTrend.value = "";
                hideExplanation();
                resetStudentAnswerState();
                rerenderMath(document.body);
            });

            btnShowExplain?.addEventListener('click', function () {
                showExplanation();
            });

            if (slider && canvas && ctx) {
                window.addEventListener('resize', () => {
                    resizeCanvas();
                    updateExplorerUI();
                });

                slider.addEventListener('input', () => {
                    updateExplorerUI();
                    hideExplanation();
                    resetStudentAnswerState();
                });

                requestAnimationFrame(() => {
                    resizeCanvas();
                    updateExplorerUI();
                    hideExplanation();
                    resetStudentAnswerState();
                });
            }

            rerenderMath(document.body);
        })();
    </script>

    {{-- =========================
    ✅ SCRIPT CONTOH A/B/C
    - Tampilkan nomor yang salah
    - Jika semua benar -> tampil penyelesaian
    ========================= --}}
    <script>
        (function () {
            const ans = { 1: "B", 2: "C", 3: "A" };

            const el1 = document.getElementById("pick1");
            const el2 = document.getElementById("pick2");
            const el3 = document.getElementById("pick3");

            const btnCek = document.getElementById("btnCekContoh");
            const btnReset = document.getElementById("btnResetContoh");

            const fb = document.getElementById("feedbackContoh");
            const solve = document.getElementById("penyelesaianContoh");

            const rerender = (root) => {
                if (window.renderMathInElement) {
                    renderMathInElement(root || document.body, {
                        delimiters: [
                            { left: '$$', right: '$$', display: true },
                            { left: '$', right: '$', display: false }
                        ]
                    });
                }
            };

            function setFeedback(type, html) {
                fb.classList.remove("ok", "bad");
                if (type) fb.classList.add(type);
                fb.innerHTML = html;
            }

            function getPicked(i) {
                if (i === 1) return el1?.value || "";
                if (i === 2) return el2?.value || "";
                if (i === 3) return el3?.value || "";
                return "";
            }

            function setPick(i, val) {
                if (i === 1 && el1) el1.value = val;
                if (i === 2 && el2) el2.value = val;
                if (i === 3 && el3) el3.value = val;
            }

            btnCek?.addEventListener("click", function () {
                if (solve) solve.style.display = "none";

                const kosong = [];
                for (let i = 1; i <= 3; i++) {
                    if (!getPicked(i)) kosong.push(i);
                }
                if (kosong.length) {
                    setFeedback("bad", `⚠️ Nomor yang belum dipilih: <b>${kosong.join(", ")}</b>. Lengkapi dulu ya.`);
                    return;
                }

                const salah = [];
                for (let i = 1; i <= 3; i++) {
                    if (getPicked(i) !== ans[i]) salah.push(i);
                }

                if (salah.length === 0) {
                    setFeedback("ok", "✅ Jawaban kamu <b>benar semua</b>! Berikut penyelesaiannya 👇");
                    if (solve) {
                        solve.style.display = "block";
                        rerender(solve);
                    }
                } else {
                    setFeedback("bad", `❌ Masih ada yang salah di nomor: <b>${salah.join(", ")}</b>. Coba cek lagi perilaku ujungnya ya!`);
                }
            });

            btnReset?.addEventListener("click", function () {
                setPick(1, "");
                setPick(2, "");
                setPick(3, "");
                if (solve) solve.style.display = "none";
                setFeedback("", "Pilih jawaban untuk nomor 1–3, lalu klik <b>Cek Jawaban</b>.");
                const card = document.getElementById("contohInteraktifCard");
                rerender(card || document.body);
            });
        })();
    </script>

    <script>
        (function () {
            const canvas = document.getElementById('ciGraphCanvas');
            const ctx = canvas ? canvas.getContext('2d') : null;
            const range = document.getElementById('ciRangeX');
            const valX = document.getElementById('ciValX');
            const valFx = document.getElementById('ciValFx');
            const calcSub = document.getElementById('ciCalcSub');
            const activeText = document.getElementById('ciActivePointText');

            const chips = Array.from(document.querySelectorAll('.ci-chip'));
            const pointBtns = Array.from(document.querySelectorAll('.ci-point-btn'));

            let mode = 'nilai';
            let selectedX = 0;

            const specialPoints = [
                { x: -2, y: 5, label: '(-2, 5)', type: 'green' },
                { x: -1, y: 0, label: '(-1, 0)', type: 'orange' },
                { x: 0, y: -3, label: '(0, -3)', type: 'orange' },
                { x: 1, y: -4, label: '(1, -4)', type: 'orange' },
                { x: 2, y: -3, label: '(2, -3)', type: 'green' },
                { x: 3, y: 0, label: '(3, 0)', type: 'orange' },
                { x: 4, y: 5, label: '(4, 5)', type: 'green' }
            ];

            function fx(x) {
                return x * x - 2 * x - 3;
            }

            function setActiveChip(targetMode) {
                chips.forEach(chip => {
                    chip.classList.toggle('active', chip.dataset.ciMode === targetMode);
                });
            }

            function setActivePointButton(xVal) {
                pointBtns.forEach(btn => {
                    btn.classList.toggle('active', Number(btn.dataset.x) === xVal);
                });
            }

            function syncUI() {
                const y = fx(selectedX);

                if (range) range.value = selectedX;
                if (valX) valX.textContent = selectedX;
                if (valFx) valFx.textContent = y;
                if (activeText) activeText.textContent = `Titik aktif: (${selectedX}, ${y})`;
                if (calcSub) {
                    calcSub.textContent = `f(${selectedX}) = ${selectedX}² − 2(${selectedX}) − 3 = ${y}`;
                }

                setActivePointButton(selectedX);
                drawGraph();
            }

            function chooseByMode(newMode) {
                mode = newMode;
                setActiveChip(mode);

                if (mode === 'potongx') {
                    selectedX = -1;
                } else if (mode === 'potongy') {
                    selectedX = 0;
                } else if (mode === 'vertex') {
                    selectedX = 1;
                }
                syncUI();
            }

            function resizeCanvas() {
                if (!canvas || !ctx) return;
                const rect = canvas.getBoundingClientRect();
                const dpr = window.devicePixelRatio || 1;
                canvas.width = Math.floor(rect.width * dpr);
                canvas.height = Math.floor(rect.height * dpr);
                ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
            }

            function worldToScreen(x, y, W, H, pad, xMin, xMax, yMin, yMax) {
                const sx = pad + (x - xMin) * (W - 2 * pad) / (xMax - xMin);
                const sy = (H - pad) - (y - yMin) * (H - 2 * pad) / (yMax - yMin);
                return { x: sx, y: sy };
            }

            function drawGraph() {
                if (!canvas || !ctx) return;

                const rect = canvas.getBoundingClientRect();
                const W = rect.width;
                const H = rect.height;

                const pad = 30;
                const xMin = -3;
                const xMax = 5;
                const yMin = -5;
                const yMax = 6;

                ctx.clearRect(0, 0, W, H);
                ctx.fillStyle = '#ffffff';
                ctx.fillRect(0, 0, W, H);

                ctx.lineWidth = 1;
                ctx.strokeStyle = 'rgba(0,0,0,.06)';
                for (let x = xMin; x <= xMax; x++) {
                    const p1 = worldToScreen(x, yMin, W, H, pad, xMin, xMax, yMin, yMax);
                    const p2 = worldToScreen(x, yMax, W, H, pad, xMin, xMax, yMin, yMax);
                    ctx.beginPath();
                    ctx.moveTo(p1.x, p1.y);
                    ctx.lineTo(p2.x, p2.y);
                    ctx.stroke();
                }
                for (let y = yMin; y <= yMax; y++) {
                    const p1 = worldToScreen(xMin, y, W, H, pad, xMin, xMax, yMin, yMax);
                    const p2 = worldToScreen(xMax, y, W, H, pad, xMin, xMax, yMin, yMax);
                    ctx.beginPath();
                    ctx.moveTo(p1.x, p1.y);
                    ctx.lineTo(p2.x, p2.y);
                    ctx.stroke();
                }

                ctx.lineWidth = 2;
                ctx.strokeStyle = 'rgba(31,41,55,.35)';
                const xAxisY = worldToScreen(0, 0, W, H, pad, xMin, xMax, yMin, yMax).y;
                const yAxisX = worldToScreen(0, 0, W, H, pad, xMin, xMax, yMin, yMax).x;

                ctx.beginPath();
                ctx.moveTo(pad, xAxisY);
                ctx.lineTo(W - pad, xAxisY);
                ctx.stroke();

                ctx.beginPath();
                ctx.moveTo(yAxisX, pad);
                ctx.lineTo(yAxisX, H - pad);
                ctx.stroke();

                const vertexX = worldToScreen(1, 0, W, H, pad, xMin, xMax, yMin, yMax).x;
                ctx.save();
                ctx.setLineDash([8, 6]);
                ctx.strokeStyle = 'rgba(217,119,6,.7)';
                ctx.lineWidth = 2;
                ctx.beginPath();
                ctx.moveTo(vertexX, pad);
                ctx.lineTo(vertexX, H - pad);
                ctx.stroke();
                ctx.restore();

                ctx.lineWidth = 4;
                ctx.strokeStyle = '#2563eb';
                ctx.beginPath();
                let started = false;
                const steps = 300;

                for (let i = 0; i <= steps; i++) {
                    const x = xMin + (xMax - xMin) * (i / steps);
                    const y = fx(x);
                    const p = worldToScreen(x, y, W, H, pad, xMin, xMax, yMin, yMax);
                    if (!started) {
                        ctx.moveTo(p.x, p.y);
                        started = true;
                    } else {
                        ctx.lineTo(p.x, p.y);
                    }
                }
                ctx.stroke();

                const sy = fx(selectedX);
                const sp = worldToScreen(selectedX, sy, W, H, pad, xMin, xMax, yMin, yMax);

                ctx.save();
                ctx.setLineDash([6, 6]);
                ctx.strokeStyle = 'rgba(16,185,129,.35)';
                ctx.lineWidth = 1.5;
                ctx.beginPath();
                ctx.moveTo(sp.x, xAxisY);
                ctx.lineTo(sp.x, sp.y);
                ctx.stroke();
                ctx.restore();

                ctx.font = '12px "Times New Roman"';
                ctx.textBaseline = 'middle';

                specialPoints.forEach(pt => {
                    const p = worldToScreen(pt.x, pt.y, W, H, pad, xMin, xMax, yMin, yMax);
                    const isActive = pt.x === selectedX;

                    ctx.beginPath();
                    ctx.fillStyle = pt.type === 'orange' ? '#f97316' : '#22c55e';
                    ctx.arc(p.x, p.y, isActive ? 8 : 7, 0, Math.PI * 2);
                    ctx.fill();

                    if (isActive) {
                        ctx.lineWidth = 3;
                        ctx.strokeStyle = 'rgba(255,255,255,.95)';
                        ctx.beginPath();
                        ctx.arc(p.x, p.y, 11, 0, Math.PI * 2);
                        ctx.stroke();
                    }

                    ctx.fillStyle = '#374151';
                    let tx = p.x + 10;
                    let ty = p.y - 12;

                    if (pt.x === 1 && pt.y === -4) {
                        tx = p.x + 8;
                        ty = p.y + 16;
                    }
                    if (pt.x === 3 && pt.y === 0) {
                        tx = p.x + 8;
                        ty = p.y + 12;
                    }
                    if (pt.x === -1 && pt.y === 0) {
                        tx = p.x + 8;
                        ty = p.y - 14;
                    }

                    ctx.fillText(pt.label, tx, ty);
                });

                ctx.fillStyle = '#6b7280';
                ctx.font = '12px "Times New Roman"';
                for (let x = xMin; x <= xMax; x++) {
                    const p = worldToScreen(x, 0, W, H, pad, xMin, xMax, yMin, yMax);
                    ctx.fillText(String(x), p.x - 3, xAxisY + 18);
                }
            }

            function pickPointFromCanvas(evt) {
                if (!canvas) return;

                const rect = canvas.getBoundingClientRect();
                const mx = evt.clientX - rect.left;
                const my = evt.clientY - rect.top;

                const W = rect.width;
                const H = rect.height;
                const pad = 30;
                const xMin = -3;
                const xMax = 5;
                const yMin = -5;
                const yMax = 6;

                let found = null;
                let minDist = Infinity;

                specialPoints.forEach(pt => {
                    const p = worldToScreen(pt.x, pt.y, W, H, pad, xMin, xMax, yMin, yMax);
                    const d = Math.hypot(mx - p.x, my - p.y);
                    if (d < minDist) {
                        minDist = d;
                        found = pt;
                    }
                });

                if (found && minDist <= 22) {
                    selectedX = found.x;
                    if (selectedX === -1 || selectedX === 3) {
                        mode = 'potongx';
                    } else if (selectedX === 0) {
                        mode = 'potongy';
                    } else if (selectedX === 1) {
                        mode = 'vertex';
                    } else {
                        mode = 'nilai';
                    }
                    setActiveChip(mode);
                    syncUI();
                }
            }

            chips.forEach(chip => {
                chip.addEventListener('click', function () {
                    chooseByMode(this.dataset.ciMode);
                });
            });

            pointBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    selectedX = Number(this.dataset.x);
                    if (selectedX === -1 || selectedX === 3) {
                        mode = 'potongx';
                    } else if (selectedX === 0) {
                        mode = 'potongy';
                    } else if (selectedX === 1) {
                        mode = 'vertex';
                    } else {
                        mode = 'nilai';
                    }
                    setActiveChip(mode);
                    syncUI();
                });
            });

            range?.addEventListener('input', function () {
                selectedX = Number(this.value);
                mode = 'nilai';
                setActiveChip(mode);
                syncUI();
            });

            canvas?.addEventListener('click', pickPointFromCanvas);

            window.addEventListener('resize', function () {
                resizeCanvas();
                drawGraph();
            });

            if (canvas && ctx) {
                requestAnimationFrame(() => {
                    resizeCanvas();
                    syncUI();
                });
            }
        })();
    </script>

    <script>
        (function () {
            const jawabBenar = {
                a1: "3",
                a2: "3",
                a3: "7x3",
                a4: "7",
                a5: "kiri turun kanan naik",

                b1: "(-2,0) dan (4,0)",
                b2: "(0,-8)",
                b3: "(1,-9)",

                c1: "A",
                c1u: "turun-naik",
                c1c: "A",

                c2: "B",
                c2u: "naik-naik",
                c2c: "B",

                c3: "C",
                c3u: "turun-turun",
                c3c: "C"
            };

            const hasil = document.getElementById("hasilLatihan");
            const cekBtn = document.getElementById("cekLatihanBtn");
            const resetBtn = document.getElementById("resetLatihanBtn");

            function normal(v) {
                return (v || "")
                    .toString()
                    .toLowerCase()
                    .replace(/\s+/g, " ")
                    .replace(/\^/g, "")
                    .replace(/³/g, "3")
                    .replace(/−/g, "-")
                    .trim();
            }

            function cekKhusus(id, val) {
                const v = normal(val);

                if (id === "a3") {
                    return ["7x3", "7x^3", "7x³"].includes(v);
                }

                if (id === "a5") {
                    return [
                        "kiri turun kanan naik",
                        "turun naik",
                        "kiri turun, kanan naik"
                    ].includes(v);
                }

                if (id === "b1") {
                    return [
                        "(-2,0) dan (4,0)",
                        "(4,0) dan (-2,0)",
                        "x=-2 dan x=4",
                        "x=4 dan x=-2"
                    ].includes(v);
                }

                if (id === "b2") {
                    return ["(0,-8)", "0,-8"].includes(v);
                }

                if (id === "b3") {
                    return ["(1,-9)", "1,-9"].includes(v);
                }

                if (id === "c1u") return ["turun-naik", "turun naik"].includes(v);
                if (id === "c2u") return ["naik-naik", "naik naik"].includes(v);
                if (id === "c3u") return ["turun-turun", "turun turun"].includes(v);

                return normal(jawabBenar[id]) === v;
            }

            cekBtn?.addEventListener("click", function () {
                const ids = Object.keys(jawabBenar);
                const kosong = [];
                const salah = [];

                ids.forEach(id => {
                    const el = document.getElementById(id);
                    if (!el) return;

                    const value = el.value.trim();
                    if (!value) {
                        kosong.push(id);
                        return;
                    }

                    if (!cekKhusus(id, value)) {
                        salah.push(id);
                    }
                });

                hasil.className = "hasil-latihan";

                if (kosong.length) {
                    hasil.classList.add("bad");
                    hasil.innerHTML = `⚠️ Masih ada jawaban yang kosong. Lengkapi dulu semua bagian ya.`;
                    return;
                }

                if (salah.length === 0) {
                    hasil.classList.add("ok");
                    hasil.innerHTML = `✅ Bagus, semua jawaban benar.`;
                } else {
                    hasil.classList.add("bad");
                    hasil.innerHTML = `❌ Masih ada jawaban yang belum tepat pada: <b>${salah.join(", ")}</b>.`;
                }
            });

            resetBtn?.addEventListener("click", function () {
                Object.keys(jawabBenar).forEach(id => {
                    const el = document.getElementById(id);
                    if (el) el.value = "";
                });

                hasil.className = "hasil-latihan";
                hasil.innerHTML = `Isi jawaban terlebih dahulu, lalu klik <b>Cek Jawaban</b>.`;
            });
        })();
    </script>
    <script defer src="{{ asset('js/interaktif1c.js') }}"></script>
@endsection

@section('nav')
    <a href="{{ route('derajatsuatupolinomial') }}" class="btn-nav prev-btn">
        ← Previous
    </a>

    <a href="{{ route('kuisa') }}" class="btn-nav next-btn">
        Next →
    </a>
@endsection