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
            --accent: #2b6cb0;
            --accent-soft: #f3f7ff;
            --text: #222;
            --muted: #555;
            --line: rgba(0, 0, 0, .10);
            --outer-line: #EEDFCC;
            --shadow: 0 10px 28px rgba(0, 0, 0, .05);
            --ok: #0f5f22;
            --ok-soft: rgba(27, 122, 42, .08);
            --warn: #7a4a00;
            --warn-soft: rgba(217, 119, 6, .10);
            --danger: #8b1e1e;
            --danger-soft: rgba(214, 40, 40, .10);
        }

        .materi-wrap,
        .materi-wrap * {
            box-sizing: border-box;
        }

        .materi-wrap {
            width: min(100%, 980px);
            margin: 0 auto;
            padding: 20px 14px 40px;
            font-family: "Times New Roman", Times, serif;
            color: var(--text);
            line-height: 1.8;
        }

        .top-title {
            display: flex;
            align-items: baseline;
            gap: 12px;
            margin-bottom: 14px;
        }

        .top-title .label {
            font-size: clamp(22px, 4vw, 26px);
            font-weight: 800;
            color: #000;
        }

        .top-title .judul {
            font-size: clamp(24px, 5vw, 30px);
            font-weight: 900;
            color: var(--green);
            line-height: 1.25;
        }

        .lead-text,
        .materi-inline .inline-lead {
            font-size: clamp(16px, 2vw, 18px);
            text-align: justify;
            color: var(--muted);
            margin: 10px 0 22px;
        }

        .lead-text strong,
        .highlight,
        .card b,
        .materi-inline b {
            color: #000;
        }

        .highlight {
            font-weight: 800;
        }

        .card,
        .contoh-card,
        .ci-card {
            margin-bottom: 18px;
            border: 1px solid rgba(0, 0, 0, .06);
            border-radius: 16px;
            background: #fff;
            box-shadow: var(--shadow);
        }

        .card {
            padding: 20px 22px;
        }

        .card-explore {
            border-left: 6px solid var(--outer-line);
            background: linear-gradient(180deg, var(--accent-soft), #fff);
        }

        .card-example,
        .contoh-card {
            border-left: 6px solid var(--outer-line);
        }

        .title-box {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            font-size: 18px;
            font-weight: 900;
            color: var(--green);
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

        .rumus {
            width: fit-content;
            max-width: 100%;
            margin: 14px auto;
            padding: 14px 16px;
            overflow-x: auto;
            border: 1px solid var(--line);
            border-radius: 14px;
            background: #f7f9fc;
            text-align: center;
            font-size: clamp(16px, 2vw, 18px);
            font-weight: 800;
        }

        .note,
        .feedback,
        .hasil-latihan,
        .endbeh-note,
        .ci-calc-box,
        .poly-highlight-box {
            margin-top: 12px;
            padding: 12px 14px;
            border: 1px solid var(--line);
            border-radius: 14px;
            background: #fff;
            color: var(--muted);
            line-height: 1.7;
        }

        .small-note,
        .ci-footnote,
        .poly-showcase-sub,
        .latihan-sub,
        .grafik-caption {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.6;
        }

        .definisi-card {
            position: relative;
            margin: 0 0 18px;
            padding: 22px 20px 18px;
            border: 2px solid var(--outer-line);
            border-radius: 14px;
            background: #F4C7B5;
            box-shadow: 0 6px 18px rgba(0, 0, 0, .05);
        }

        .definisi-label {
            position: absolute;
            top: -18px;
            left: 18px;
            padding: 8px 26px;
            border: 2px solid #4FA24B;
            border-radius: 999px;
            background: #8FC17E;
            color: #000;
            font-size: 15px;
            font-weight: 900;
            letter-spacing: .5px;
        }

        .definisi-card p {
            margin: 6px 0 0;
            font-size: 16px;
            line-height: 1.7;
        }

        .mission,
        .endbeh-cell,
        .contoh-grid {
            display: grid;
            gap: 12px;
        }

        .mission-row,
        .ci-layout,
        .poly-body,
        .latihan-grid {
            display: grid;
            gap: 16px;
            align-items: start;
        }

        .mission-row {
            grid-template-columns: minmax(0, 1.25fr) minmax(280px, .75fr);
        }

        .panel,
        .ci-panel,
        .ci-graph-card,
        .grafik-box,
        .match-area,
        .contoh-box,
        .poly-info-card,
        .poly-explain-panel,
        .ci-mini-box,
        .grafik-card {
            border: 1px solid var(--line);
            border-radius: 16px;
            background: #fff;
        }

        .panel,
        .ci-panel,
        .ci-graph-card,
        .match-area,
        .grafik-box {
            padding: 14px;
        }

        .panel-title,
        .ci-graph-head,
        .poly-showcase-head,
        .ci-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .panel-title,
        .ci-graph-head {
            margin-bottom: 10px;
            color: #1f2937;
            font-weight: 900;
        }

        .chip,
        .mini-badge,
        .endbeh-tagrow,
        .endbeh-pill,
        .poly-pick-row,
        .ci-point-row,
        .btn-row,
        .latihan-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
        }

        .chip,
        .mini-badge,
        .endbeh-pill {
            width: fit-content;
            padding: 6px 10px;
            border: 1px solid rgba(0, 0, 0, .12);
            border-radius: 999px;
            background: #fff;
            color: var(--muted);
            font-size: 12px;
            font-weight: 900;
            line-height: 1;
            user-select: none;
        }

        .chip.ok,
        .feedback.ok,
        .hasil-latihan.ok,
        .endbeh-pill.green {
            border-color: rgba(27, 122, 42, .22);
            background: var(--ok-soft);
            color: var(--ok);
            font-weight: 900;
        }

        .chip.warn,
        .feedback.bad,
        .hasil-latihan.bad {
            border-color: rgba(217, 119, 6, .22);
            background: var(--warn-soft);
            color: var(--warn);
            font-weight: 900;
        }

        .endbeh-pill.blue {
            border-color: rgba(43, 108, 176, .18);
            background: rgba(43, 108, 176, .08);
            color: #1f4f86;
        }

        .range,
        .ci-range,
        .latihan-input,
        .pick {
            width: 100%;
            font-family: inherit;
        }

        .range,
        .ci-range {
            accent-color: var(--accent);
        }

        .kpi,
        .ci-mini-grid,
        .poly-info-grid,
        .grafik-row,
        .match-row,
        .match-table {
            display: grid;
            gap: 10px;
        }

        .kpi {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            margin-top: 8px;
        }

        .kpi .box,
        .ci-mini-box,
        .ci-calc-box {
            border: 1px solid var(--line);
            border-radius: 14px;
            background: rgba(243, 247, 255, .55);
            padding: 10px 12px;
        }

        .kpi .lbl,
        .mini-lbl,
        .poly-info-label {
            color: #6b7280;
            font-size: 13px;
            font-weight: 900;
            line-height: 1.2;
        }

        .kpi .val,
        .mini-val,
        .poly-info-value {
            margin-top: 3px;
            color: #111827;
            font-size: clamp(18px, 3vw, 26px);
            font-weight: 900;
            line-height: 1.2;
        }

        .canvas-wrap,
        .ci-canvas-wrap {
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 16px;
            background: #fff;
        }

        canvas#expGraph,
        #ciGraphCanvas {
            display: block;
            width: 100%;
        }

        canvas#expGraph {
            height: 260px;
        }

        #ciGraphCanvas {
            height: 100%;
        }

        .exp-explainbox {
            margin-top: 12px;
            padding: 12px;
            border: 1px solid rgba(0, 0, 0, .12);
            border-radius: 14px;
            background: rgba(255, 255, 255, .86);
            color: var(--muted);
        }

        .exp-explainbox .head {
            margin-bottom: 6px;
            color: #111;
            font-weight: 900;
        }

        .exp-explainbox .line {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            padding: 6px 0;
            border-top: 1px dashed rgba(0, 0, 0, .08);
        }

        .exp-explainbox .line:first-of-type {
            border-top: 0;
            padding-top: 2px;
        }

        .exp-explainbox .tag {
            flex: 0 0 auto;
            margin-top: 2px;
            padding: 4px 8px;
            border: 1px solid var(--line);
            border-radius: 999px;
            background: #fff;
            color: var(--muted);
            font-size: 12px;
            font-weight: 900;
            line-height: 1;
        }

        .exp-explainbox .txt {
            flex: 1 1 auto;
            min-width: 0;
            line-height: 1.6;
        }

        .pick,
        .latihan-input {
            padding: 10px 12px;
            border: 1px solid rgba(0, 0, 0, .18);
            border-radius: 12px;
            background: #fff;
            color: #111;
            font-size: 14px;
            font-weight: 700;
            outline: none;
        }

        .pick:focus,
        .latihan-input:focus {
            border-color: rgba(43, 108, 176, .5);
            box-shadow: 0 0 0 3px rgba(43, 108, 176, .12);
        }

        .btn-cek,
        .btn-reset,
        .latihan-btn,
        .poly-btn,
        .ci-point-btn {
            cursor: pointer;
            font-family: inherit;
            font-weight: 900;
            transition: transform .18s ease, box-shadow .18s ease, background .18s ease;
        }

        .btn-cek,
        .btn-reset,
        .latihan-btn {
            padding: 10px 14px;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, .10);
        }

        .btn-cek {
            border-color: rgba(43, 108, 176, .25);
            background: rgba(43, 108, 176, .12);
            color: #1f4f86;
        }

        .btn-reset,
        .latihan-btn {
            background: rgba(0, 0, 0, .04);
            color: #222;
        }

        .btn-cek:hover,
        .btn-reset:hover,
        .latihan-btn:hover,
        .poly-btn:hover,
        .ci-point-btn:hover {
            transform: translateY(-1px);
        }

        button:disabled,
        .latihan-input:disabled {
            cursor: not-allowed;
            opacity: .7;
        }

        #penyelesaianContoh {
            display: none;
            margin-top: 12px;
        }

        .materi-inline {
            margin: 10px 0 22px;
        }

        .materi-figure {
            display: flex;
            justify-content: center;
            margin: 14px 0 18px;
        }

        .materi-figure img,
        .grafik-card img,
        .grafik-item img,
        .img-toggle img {
            display: block;
            max-width: 100%;
            height: auto;
            border-radius: 12px;
        }

        .ci-mini-grid,
        .poly-info-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .match-row {
            grid-template-columns: minmax(0, 1.2fr) minmax(180px, .8fr);
            align-items: center;
            padding: 10px 0;
            border-top: 1px dashed rgba(0, 0, 0, .08);
        }

        .match-row:first-child {
            border-top: 0;
            padding-top: 4px;
        }

        .soal-label,
        .fx {
            color: #111;
            line-height: 1.6;
        }

        .ci-card {
            width: 100%;
            padding: 24px;
            background: #fffbe8;
        }

        .ci-shell {
            padding: 28px;
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .08);
        }

        .ci-pill,
        .contoh-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: fit-content;
            margin-bottom: 12px;
            border-radius: 999px;
            color: #111;
            font-weight: 900;
        }

        .ci-pill {
            padding: 8px 16px;
            background: #f3dfbd;
            font-size: 13px;
            letter-spacing: .5px;
        }

        .ci-head {
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .ci-head .title {
            font-size: clamp(20px, 3vw, 24px);
            color: #1f2937;
            font-weight: 900;
        }

        .ci-head .fx {
            font-size: clamp(17px, 2.5vw, 20px);
            color: #6f8d5c;
            font-weight: 900;
        }

        .ci-sub {
            margin: 0 0 24px;
            color: #5f6368;
            font-size: 16px;
            line-height: 1.6;
        }

        .ci-layout,
        .poly-body {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 24px;
        }

        .ci-panel,
        .ci-graph-card {
            padding: 22px;
            background: #f7f8fb;
        }

        .ci-calc-box,
        .ci-mini-box {
            background: #fff;
        }

        .ci-range-label,
        .ci-calc-title {
            margin-bottom: 10px;
            color: #1f2937;
            font-size: 16px;
            font-weight: 900;
        }

        .ci-canvas-wrap {
            height: 360px;
        }

        .ci-point-btn {
            padding: 9px 13px;
            border: 0;
            border-radius: 999px;
            background: #e4eadc;
            color: #374151;
            font-size: 14px;
        }

        .ci-point-btn.active {
            background: #8da06f;
            color: #fff;
        }

        .ci-dot-icon {
            display: inline-block;
            width: 14px;
            height: 14px;
            margin-right: 8px;
            border-radius: 50%;
            background: #f28abb;
            vertical-align: middle;
        }

        #ciActivePointText {
            color: #4b5563;
            font-size: 14px;
            font-weight: 700;
        }

        .endbeh-table-wrap,
        .solve-table-wrap {
            overflow-x: auto;
            margin-top: 14px;
            border: 2px solid var(--outer-line);
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 10px 22px rgba(0, 0, 0, .05);
        }

        table.endbeh,
        table.solve {
            width: 100%;
            min-width: 720px;
            border: 2px solid rgba(0, 0, 0, .14);
            border-collapse: collapse;
            font-size: 16px;
        }

        table.endbeh th,
        table.endbeh td,
        table.solve th,
        table.solve td {
            padding: 12px;
            border: 1px solid rgba(0, 0, 0, .14);
            vertical-align: top;
        }

        table.endbeh th,
        table.solve th {
            background: #8AD06E;
            color: #0d2d0f;
            text-align: center;
            font-weight: 900;
        }

        table.endbeh td,
        table.solve td {
            color: var(--muted);
        }

        table.endbeh tbody tr:nth-child(odd) td {
            background: rgba(243, 247, 255, .28);
        }

        table.endbeh td.col-n,
        table.solve td:first-child {
            text-align: center;
            vertical-align: middle;
            color: #1f1f1f;
            font-weight: 900;
            white-space: nowrap;
        }

        .endbeh-bullets,
        .poly-highlight-list {
            margin: 0;
            padding-left: 18px;
        }

        .endbeh-bullets li,
        .poly-highlight-list li {
            margin: 6px 0;
        }

        .img-toggle {
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, .14);
            border-radius: 14px;
            background: #fff;
        }

        .img-toggle summary {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 10px 12px;
            border-bottom: 1px solid var(--line);
            cursor: pointer;
            list-style: none;
            font-weight: 900;
            color: #1f1f1f;
        }

        .img-toggle summary::-webkit-details-marker {
            display: none;
        }

        .img-toggle .hint {
            padding: 4px 10px;
            border: 1px solid rgba(0, 0, 0, .12);
            border-radius: 999px;
            background: rgba(243, 247, 255, .6);
            color: #1f4f86;
            font-size: 12px;
            font-weight: 900;
            white-space: nowrap;
        }

        .img-toggle .imgbox {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px;
            background: #fff;
        }

        .contoh-card {
            padding: 20px 22px;
        }

        .contoh-pill {
            padding: 10px 26px;
            border: 2px solid #e07b57;
            background: linear-gradient(180deg, #ffb59d, #ffa78a);
            letter-spacing: .5px;
        }

        .contoh-box {
            padding: 16px;
            border: 2px solid #78d26b;
            border-radius: 12px;
        }

        .contoh-instruksi {
            margin: 0 0 12px;
            color: var(--muted);
            font-size: 17px;
            line-height: 1.7;
            text-align: justify;
        }

        .grafik-row {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .grafik-card {
            padding: 10px;
            text-align: center;
        }

        .grafik-label,
        .grafik-huruf {
            margin-top: 8px;
            color: #111;
            font-weight: 900;
            letter-spacing: .6px;
        }

        .latihan-title-row {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 14px;
        }

        .latihan-badge {
            padding: 10px 30px;
            border-radius: 8px;
            background: #6d6e73;
            color: #fff;
            font-size: 15px;
            font-weight: 900;
            letter-spacing: .3px;
        }

        .latihan-section {
            margin-top: 10px;
            padding-top: 4px;
        }

        .latihan-section+.latihan-section {
            margin-top: 16px;
            padding-top: 14px;
            border-top: 2px solid #d85a5a;
        }

        .latihan-section h3 {
            margin: 0 0 8px;
            color: #111;
            font-size: 18px;
            font-weight: 900;
        }

        .latihan-rumus {
            margin: 6px 0 8px;
            color: #111;
            font-size: 17px;
        }

        .latihan-grid {
            grid-template-columns: minmax(0, 1.35fr) minmax(220px, .9fr);
            gap: 8px 14px;
            align-items: center;
        }

        .latihan-input.kecil {
            max-width: 90px;
            text-align: center;
        }

        .match-table {
            grid-template-columns: minmax(170px, 1.3fr) minmax(90px, .7fr) minmax(160px, 1fr) minmax(80px, .6fr);
            align-items: stretch;
        }

        .match-header {
            padding: 10px 12px;
            border-radius: 10px;
            background: #f1f3f6;
            color: #111;
            font-size: 14px;
            font-weight: 900;
            text-align: center;
        }

        .latihan-match-mobile .match-item {
            min-width: 0;
            padding: 10px;
            border: 1px solid rgba(0, 0, 0, .10);
            border-radius: 12px;
            background: #fff;
            display: flex;
            align-items: center;
        }

        .latihan-match-mobile .fungsi-col {
            font-weight: 800;
            color: #111;
            line-height: 1.6;
        }

        .latihan-match-mobile .mobile-label {
            display: none;
        }

        .latihan-locked,
        .latihan-section.locked {
            opacity: .65;
        }

        .latihan-locked {
            pointer-events: none;
        }

        .latihan-section.unlocked {
            opacity: 1;
            pointer-events: auto;
        }

        .latihan-input.is-correct {
            border: 2px solid var(--ok) !important;
            background: var(--ok-soft) !important;
            color: var(--ok) !important;
        }

        .latihan-input.is-wrong {
            border: 2px solid #d62828 !important;
            background: var(--danger-soft) !important;
            color: var(--danger) !important;
        }

        .latihan-input.is-empty {
            border: 2px solid #d97706 !important;
            background: var(--warn-soft) !important;
            color: var(--warn) !important;
        }

        .poly-showcase {
            margin-top: 16px;
            padding: 18px;
            border: 2px solid #ecdcc8;
            border-radius: 22px;
            background: linear-gradient(180deg, #fffaf3, #fff);
            box-shadow: 0 14px 30px rgba(0, 0, 0, .05);
        }

        .poly-showcase-head {
            flex-wrap: wrap;
            margin-bottom: 14px;
        }

        .poly-showcase-title {
            color: #1f2937;
            font-size: 20px;
            font-weight: 900;
        }

        .poly-pick-row {
            margin: 16px 0 18px;
            gap: 12px;
        }

        .poly-btn {
            padding: 12px 18px;
            border: 1px solid rgba(0, 0, 0, .10);
            border-radius: 16px;
            background: linear-gradient(180deg, #fff, #f7f7f7);
            box-shadow: 0 8px 18px rgba(0, 0, 0, .05);
            color: #374151;
            font-size: 18px;
        }

        .poly-btn.active {
            border-color: rgba(217, 119, 6, .25);
            background: linear-gradient(180deg, #ffd9b8, #ffbf8d);
            box-shadow: 0 12px 24px rgba(217, 119, 6, .18);
            color: #1f2937;
        }

        .poly-main-card {
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 20px;
            background: #fff;
            box-shadow: 0 14px 28px rgba(0, 0, 0, .04);
        }

        .poly-top-banner {
            padding: 18px 20px;
            border-bottom: 1px solid rgba(0, 0, 0, .06);
            background: linear-gradient(135deg, #9ad97d, #74bf66);
            text-align: center;
        }

        .poly-rumus {
            margin: 0;
            color: #17301b;
            font-size: clamp(24px, 5vw, 30px);
            font-weight: 900;
        }

        .poly-body {
            padding: 20px;
            background: radial-gradient(circle at top right, rgba(255, 206, 164, .18), transparent 26%), linear-gradient(180deg, #fff, #fffdf9);
        }

        .poly-left,
        .poly-right {
            min-width: 0;
        }

        .poly-section-title {
            margin-bottom: 12px;
            color: #1f2937;
            font-size: 17px;
            font-weight: 900;
        }

        .poly-info-card {
            position: relative;
            overflow: hidden;
            padding: 14px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, .04);
        }

        .poly-info-card::before {
            content: "";
            position: absolute;
            inset: 0 auto 0 0;
            width: 6px;
        }

        .poly-info-card.deg::before {
            background: #6cbf72;
        }

        .poly-info-card.term::before {
            background: #5c9ded;
        }

        .poly-info-card.main::before {
            background: #f0a15d;
        }

        .poly-info-card.coef::before {
            background: #d47aa5;
        }

        .poly-info-label {
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .poly-info-value.small {
            font-size: 21px;
        }

        .poly-explain-panel {
            padding: 16px;
            border-color: rgba(240, 161, 93, .28);
            background: linear-gradient(180deg, #fff8ef, #fff);
            box-shadow: 0 10px 22px rgba(240, 161, 93, .08);
        }

        .poly-explain-head {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
            color: #8a4b16;
            font-weight: 900;
        }

        .poly-explain-text {
            color: #5b5563;
            font-size: 16px;
            line-height: 1.8;
            text-align: justify;
        }

        .poly-highlight-box {
            margin-top: 14px;
            padding: 14px;
            border-color: rgba(43, 108, 176, .16);
            background: linear-gradient(180deg, #f3f8ff, #fff);
        }

        .poly-highlight-head {
            margin-bottom: 8px;
            color: #1f4f86;
            font-weight: 900;
        }

        @media (max-width: 980px) {

            .mission-row,
            .ci-layout,
            .poly-body {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 860px) {

            .latihan-grid,
            .match-row {
                grid-template-columns: 1fr;
            }

            .latihan-match-mobile {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .latihan-match-mobile .match-header {
                display: none;
            }

            .latihan-match-mobile .match-item {
                display: block;
                padding: 12px;
            }

            .latihan-match-mobile .fungsi-col {
                margin-top: 12px;
                border-left: 5px solid #8AD06E;
                background: #f8fff6;
            }

            .latihan-match-mobile .fungsi-col:first-of-type {
                margin-top: 0;
            }

            .latihan-match-mobile .mobile-label {
                display: block;
                margin-bottom: 6px;
                color: #555;
                font-size: 13px;
                font-weight: 900;
            }

            .latihan-match-mobile .jawaban-col,
            .latihan-match-mobile .perilaku-col,
            .latihan-match-mobile .cocok-col {
                margin-left: 12px;
            }

            .latihan-input.kecil {
                max-width: 100%;
                text-align: left;
            }
        }

        @media (max-width: 760px) {

            .kpi,
            .ci-mini-grid,
            .poly-info-grid,
            .grafik-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .materi-wrap {
                padding: 16px 10px 32px;
            }

            .top-title {
                align-items: flex-start;
            }

            .card,
            .contoh-card,
            .ci-card,
            .ci-shell,
            .poly-showcase,
            .poly-body {
                padding: 16px;
            }

            .panel,
            .ci-panel,
            .ci-graph-card {
                padding: 14px;
            }

            .panel-title,
            .ci-graph-head,
            .ci-head {
                align-items: flex-start;
                flex-direction: column;
            }

            .chip,
            .mini-badge,
            .endbeh-pill {
                white-space: normal;
            }

            .ci-canvas-wrap {
                height: 300px;
            }

            .poly-btn {
                width: 100%;
                text-align: center;
            }
        }

        @media (max-width: 520px) {
            .latihan-match-mobile {
                gap: 10px;
            }

            .latihan-match-mobile .match-item {
                padding: 10px;
                border-radius: 10px;
            }

            .latihan-match-mobile .fungsi-col {
                margin-top: 14px;
                font-size: 15px;
            }

            .latihan-match-mobile .jawaban-col,
            .latihan-match-mobile .perilaku-col,
            .latihan-match-mobile .cocok-col {
                margin-left: 0;
            }

            .latihan-match-mobile .mobile-label {
                font-size: 12px;
            }

            .latihan-match-mobile .latihan-input {
                font-size: 14px;
                padding: 9px 10px;
            }
        }

        @media (max-width: 420px) {
            .top-title {
                gap: 8px;
            }

            .card,
            .contoh-card,
            .ci-card,
            .ci-shell,
            .poly-showcase,
            .contoh-box {
                padding: 14px;
            }

            .rumus {
                width: 100%;
            }
        }

        /* Hilangkan kotak feedback di bawah tombol Reset dan Lihat Pembahasan */
        #feedbackExplore {
            display: none !important;
        }

        /* ===== SHOWCASE POLINOMIAL SEDERHANA ===== */
        .poly-showcase {
            margin: 16px 0;
            padding: 18px;
            border-radius: 16px;
            background: #fff;
            border: 2px solid var(--outer-line);
            box-shadow: var(--shadow);
        }

        .poly-showcase-title {
            font-size: 20px;
            font-weight: 900;
            color: var(--green);
            margin-bottom: 4px;
        }

        .poly-showcase-sub {
            font-size: 15px;
            color: var(--muted);
            line-height: 1.6;
            margin-bottom: 14px;
        }

        .poly-pick-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 14px;
        }

        .poly-btn {
            padding: 9px 13px;
            border-radius: 999px;
            border: 1px solid rgba(0, 0, 0, .14);
            background: #fff;
            cursor: pointer;
            font-family: "Times New Roman", Times, serif;
            font-weight: 900;
            transition: .15s ease;
        }

        .poly-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(0, 0, 0, .08);
        }

        .poly-btn.active {
            background: rgba(27, 122, 42, .12);
            color: #0f5f22;
            border-color: rgba(27, 122, 42, .30);
        }

        .poly-main-card {
            padding: 16px;
            border-radius: 14px;
            background: #fbfdff;
            border: 1px solid rgba(0, 0, 0, .08);
        }

        .poly-rumus {
            text-align: center;
            font-size: 28px;
            font-weight: 900;
            margin-bottom: 14px;
            color: #1f1f1f;
        }

        .poly-info-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 10px;
            margin-bottom: 14px;
        }

        .poly-info-card {
            padding: 12px;
            border-radius: 12px;
            background: #fff;
            border: 1px solid rgba(0, 0, 0, .08);
            text-align: center;
        }

        .poly-info-label {
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 4px;
        }

        .poly-info-value {
            font-size: 22px;
            font-weight: 900;
            color: var(--green);
        }

        .poly-info-value.small {
            font-size: 16px;
        }

        .poly-explain-card {
            padding: 14px;
            border-radius: 12px;
            background: #fff;
            border-left: 5px solid var(--outer-line);
        }

        .poly-section-title {
            font-weight: 900;
            color: var(--green);
            margin-bottom: 6px;
        }

        .poly-explain-text {
            color: var(--muted);
            line-height: 1.7;
            text-align: justify;
        }

        /* ===== CARD PARAGRAF TERPISAH ===== */
        .graph-intro-card {
            margin: 16px 0;
            padding: 18px 20px;
            border-radius: 16px;
            background: #fff;
            border-left: 6px solid var(--outer-line);
            border: 1px solid rgba(0, 0, 0, .06);
            box-shadow: var(--shadow);
        }

        .graph-intro-card p {
            margin: 0;
            color: var(--muted);
            line-height: 1.8;
            text-align: justify;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 700px) {
            .poly-info-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .poly-rumus {
                font-size: 24px;
            }
        }

        @media (max-width: 480px) {
            .poly-info-grid {
                grid-template-columns: 1fr;
            }

            .poly-btn {
                width: 100%;
            }
        }

        /* ===== GRAFIK REAL POLINOMIAL ===== */
        .real-poly-graph {
            width: 100%;
            max-width: 390px;
            margin: 0 auto;
            border-radius: 12px;
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, .10);
            overflow: hidden;
            box-shadow: 0 8px 18px rgba(0, 0, 0, .05);
        }

        .real-poly-graph svg {
            display: block;
            width: 100%;
            height: auto;
        }

        .real-poly-graph .grid-line {
            stroke: rgba(0, 0, 0, .18);
            stroke-width: 1;
            stroke-dasharray: 4 4;
        }

        .real-poly-graph .axis {
            stroke: #111;
            stroke-width: 1.8;
        }

        .real-poly-graph .curve {
            fill: none;
            stroke: #0b57d0;
            stroke-width: 3;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .real-poly-graph .tick-text {
            font-size: 11px;
            fill: #222;
            font-family: "Times New Roman", Times, serif;
        }

        .real-poly-graph .axis-label {
            font-size: 18px;
            font-weight: 900;
            fill: #111;
            font-family: "Times New Roman", Times, serif;
        }

        .real-poly-graph .tracker-line {
            stroke: rgba(11, 87, 208, .35);
            stroke-width: 1.5;
            stroke-dasharray: 4 4;
            display: none;
        }

        .real-poly-graph .tracker-dot {
            fill: #0b57d0;
            stroke: #fff;
            stroke-width: 2;
            display: none;
        }

        .real-poly-graph .tracker-label {
            font-size: 11px;
            font-weight: 900;
            fill: #0f5f22;
            font-family: "Times New Roman", Times, serif;
            display: none;
        }

        .real-poly-caption {
            text-align: center;
            margin-top: 8px;
            line-height: 1.35;
        }

        .real-poly-caption .main {
            font-weight: 900;
            color: #111;
        }

        .real-poly-caption .sub {
            font-weight: 900;
            color: #0b57d0;
            font-size: 14px;
        }

        /* ===== GRAFIK INTERAKTIF DERAJAT 0 - 5 ===== */
        .degree-poly-board {
            width: 100%;
            max-width: 760px;
            margin: 16px auto;
            padding: 18px;
            border-radius: 18px;
            background: #fff;
            border: 2px solid var(--outer-line);
            box-shadow: var(--shadow);
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }

        .degree-poly-card {
            position: relative;
            min-width: 0;
            padding: 10px;
            border-radius: 14px;
            background: #fbfdff;
            border: 1px solid rgba(0, 0, 0, .08);
        }

        .degree-poly-title {
            width: fit-content;
            margin: 0 auto 8px;
            padding: 4px 10px;
            border-radius: 6px;
            background: #dbeaf1;
            color: #35515c;
            font-size: 14px;
            font-weight: 900;
            line-height: 1.2;
        }

        .degree-poly-graph {
            width: 100%;
            aspect-ratio: 1 / .82;
            border-radius: 10px;
            background: #fff;
            overflow: hidden;
        }

        .degree-poly-graph svg {
            display: block;
            width: 100%;
            height: 100%;
        }

        .degree-poly-graph .deg-grid {
            stroke: rgba(0, 0, 0, .08);
            stroke-width: 1;
        }

        .degree-poly-graph .deg-axis {
            stroke: rgba(0, 0, 0, .62);
            stroke-width: 1.5;
        }

        .degree-poly-graph .deg-curve {
            fill: none;
            stroke: #2f93e6;
            stroke-width: 3;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .degree-poly-graph .deg-axis-label {
            fill: #333;
            font-family: "Times New Roman", Times, serif;
            font-size: 13px;
            font-weight: 900;
        }

        .degree-poly-graph .deg-zero {
            fill: #666;
            font-family: "Times New Roman", Times, serif;
            font-size: 12px;
            font-weight: 900;
        }

        .degree-poly-graph .deg-dot {
            fill: #1b7a2a;
            stroke: #fff;
            stroke-width: 2;
            display: none;
        }

        .degree-poly-graph .deg-guide {
            stroke: rgba(27, 122, 42, .35);
            stroke-width: 1.2;
            stroke-dasharray: 4 4;
            display: none;
        }

        .degree-poly-graph .deg-label {
            fill: #0f5f22;
            font-size: 11px;
            font-weight: 900;
            font-family: "Times New Roman", Times, serif;
            display: none;
        }

        @media (max-width: 760px) {
            .degree-poly-board {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 480px) {
            .degree-poly-board {
                grid-template-columns: 1fr;
                padding: 14px;
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
                Perhatikan fungsi berikut:
            </p>

            <p class="note">
                <b>$$f(x)=x^2-2x-3$$</b>
            </p>

            <p>
                Geser nilai <b>$x$</b> pada kontrol nilai, lalu amati nilai
                <b>$f(x)$</b> yang dihasilkan, posisi titik pada grafik, dan arah perubahan grafik.
            </p>

            <div class="mission">
                <div class="mission-row">
                    <div class="panel">
                        <div class="panel-title">
                            <span>🕹️ Kontrol Nilai</span>
                            <span class="chip" id="expInsightChip">Insight: siap diamati</span>
                        </div>

                        <input class="range" id="expX" type="range" min="-6" max="6" step="1" value="0">

                        <div class="small-note">
                            Setiap perubahan $x$ akan menghasilkan nilai $f(x)$ yang berbeda.
                        </div>

                        <div class="kpi">
                            <div class="box">
                                <div class="lbl">Nilai x</div>
                                <div class="val" id="kpiX">0</div>
                            </div>
                            <div class="box">
                                <div class="lbl">Nilai f(x)</div>
                                <div class="val" id="kpiFx">—</div>
                            </div>
                            <div class="box">
                                <div class="lbl">Perubahan</div>
                                <div class="val" id="kpiTrend">—</div>
                            </div>
                        </div>

                        {{-- Soal --}}
                        <div class="exp-explainbox" id="expAnswerBox">
                            <div class="head">✍️ Jawaban</div>

                            <div class="line">
                                <span class="tag">1</span>
                                <div class="txt">
                                    Tentukan nilai <b>$f(x)$</b> untuk nilai $x$ saat ini.
                                    <br>
                                    <input type="number" id="studentFx" class="pick"
                                        style="max-width:180px; margin-top:8px;">
                                    <div id="statusFx" class="mini-badge" style="margin-top:8px;">Belum dijawab</div>
                                </div>
                            </div>

                            <div class="line">
                                <span class="tag">2</span>
                                <div class="txt">
                                    Posisi titik $(x,f(x))$ berada di ...
                                    <br>
                                    <select id="studentPos" class="pick" style="max-width:240px; margin-top:8px;">
                                        <option value="">Pilih jawaban…</option>
                                        <option value="atas">Di atas sumbu-x</option>
                                        <option value="bawah">Di bawah sumbu-x</option>
                                        <option value="sumbu">Tepat pada sumbu-x</option>
                                    </select>
                                    <div id="statusPos" class="mini-badge" style="margin-top:8px;">Belum dijawab</div>
                                </div>
                            </div>

                            <div class="line">
                                <span class="tag">3</span>
                                <div class="txt">
                                    Nilai fungsi saat ini sedang ...
                                    <br>
                                    <select id="studentTrend" class="pick" style="max-width:240px; margin-top:8px;">
                                        <option value="">Pilih jawaban…</option>
                                        <option value="Naik">Naik</option>
                                        <option value="Turun">Turun</option>
                                        <option value="Tetap">Tetap</option>
                                    </select>
                                    <div id="statusTrend" class="mini-badge" style="margin-top:8px;">Belum dijawab</div>
                                </div>
                            </div>

                            <div class="btn-row">
                                <button type="button" class="btn-reset" id="btnResetExplore">↺ Reset</button>
                                <button type="button" class="btn-reset" id="btnShowExplain" disabled>💡 Lihat
                                    Pembahasan</button>
                            </div>

                            <div class="feedback" id="feedbackExplore">
                                Amati grafiknya, lalu isi semua jawabanmu.
                            </div>
                        </div>

                        {{-- Pembahasan --}}
                        <div class="exp-explainbox" id="expExplain" style="display:none;">
                            <div class="head">💡 Pembahasan</div>

                            <div class="line">
                                <span class="tag">1</span>
                                <div class="txt" id="txtSub">
                                    Substitusikan nilai $x$ ke fungsi untuk mendapatkan $f(x)$.
                                </div>
                            </div>

                            <div class="line">
                                <span class="tag">2</span>
                                <div class="txt" id="txtPoint">
                                    Titik $(x,f(x))$ menunjukkan posisi pada grafik.
                                </div>
                            </div>

                            <div class="line">
                                <span class="tag">3</span>
                                <div class="txt" id="txtPos">
                                    Jika $f(x)$ positif → di atas sumbu-x, jika negatif → di bawah.
                                </div>
                            </div>

                            <div class="line">
                                <span class="tag">4</span>
                                <div class="txt" id="txtIdea">
                                    Perhatikan perubahan nilai untuk menentukan apakah fungsi naik atau turun.
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
                            Grafik menunjukkan hubungan antara nilai $x$ dan $f(x)$.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- =========================
        SEMUA MATERI LANJUTAN DISEMBUNYIKAN DULU
        ========================= --}}
        <div id="materiLanjutan" style="display:none;">
            {{-- =========================
            Materi lain
            ========================= --}}
            <div class="card card-example">
                <p>
                    Polinomial bukan hanya sekadar bentuk aljabar yang terdiri atas beberapa suku.
                    Polinomial juga dapat digunakan untuk membentuk suatu fungsi yang disebut fungsi polinomial.
                    Ketika sebuah polinomial diberi variabel bebas, misalnya variabel x, maka setiap nilai x yang dimasukkan
                    ke dalam polinomial tersebut akan menghasilkan suatu nilai fungsi.
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
            MATERI TAMBAHAN
            ========================= --}}
            <div class="card card-example">
                <p>
                    Sebelum mempelajari lebih jauh tentang sifat-sifat fungsi polinomial, perhatikan
                    beberapa contoh fungsi polinomial berikut. Setiap fungsi dianalisis berdasarkan
                    bentuknya, derajatnya, jumlah sukunya, serta suku utamanya. Tabel ini akan membantu
                    Anda memahami bagaimana struktur sebuah fungsi polinomial dibentuk.
                </p>

                <div class="poly-showcase">
                    <div class="poly-showcase-title">Contoh Struktur Fungsi Polinomial</div>
                    <div class="poly-showcase-sub">
                        Klik salah satu bentuk fungsi berikut untuk melihat derajat, jumlah suku,
                        suku utama, koefisien utama, dan penjelasannya.
                    </div>

                    <div class="poly-pick-row">
                        <button type="button" class="poly-btn active" data-i="0">9x²</button>
                        <button type="button" class="poly-btn" data-i="1">5x⁴ − 3x² + 8</button>
                        <button type="button" class="poly-btn" data-i="2">7x³ + x² − 4x + 2 − 6</button>
                    </div>

                    <div class="poly-main-card">
                        <div class="poly-rumus" id="polyFormula">9x²</div>

                        <div class="poly-info-grid">
                            <div class="poly-info-card">
                                <div class="poly-info-label">Derajat</div>
                                <div class="poly-info-value" id="deg">2</div>
                            </div>

                            <div class="poly-info-card">
                                <div class="poly-info-label">Jumlah Suku</div>
                                <div class="poly-info-value small" id="terms">1 suku</div>
                            </div>

                            <div class="poly-info-card">
                                <div class="poly-info-label">Suku Utama</div>
                                <div class="poly-info-value small" id="lead">9x²</div>
                            </div>

                            <div class="poly-info-card">
                                <div class="poly-info-label">Koefisien Utama</div>
                                <div class="poly-info-value" id="coef">9</div>
                            </div>
                        </div>

                        <div class="poly-explain-card">
                            <div class="poly-section-title">Penjelasan</div>
                            <div class="poly-explain-text" id="explain">
                                Hanya ada satu suku, yaitu 9x². Pangkat tertinggi adalah 2, sehingga derajatnya 2.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="graph-intro-card">
                    <p>
                        Untuk memahami bentuk suatu fungsi polinomial, salah satu cara yang paling
                        sederhana adalah dengan menggambar grafiknya. Grafik ini menunjukkan
                        bagaimana nilai fungsi berubah terhadap nilai variabel $x$. Proses menggambarnya
                        dapat dilakukan secara manual menggunakan langkah-langkah berikut.
                    </p>
                </div>
            </div>

            {{-- =========================
            CONTOH INTERAKTIF
            ========================= --}}
            <div class="ci-card">
                <div class="ci-shell">
                    <div class="ci-pill">CONTOH INTERAKTIF</div>

                    <div class="ci-head">
                        <div class="title">Gambarlah grafik fungsi</div>
                        <div class="fx">f(x) = x² − 2x − 3</div>
                    </div>

                    <p class="ci-sub">
                        Geser slider atau klik titik untuk melihat nilai fungsi dan informasi penting pada grafik.
                    </p>

                    <div class="ci-layout">
                        <div class="ci-panel">
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
                                    <div class="mini-lbl">f(x)</div>
                                    <div class="mini-val" id="ciValFx">-3</div>
                                </div>
                            </div>

                            <div class="ci-calc-title">Perhitungan cepat:</div>
                            <div class="ci-calc-box">
                                <div>f(x) = x² − 2x − 3</div>
                                <div id="ciCalcSub">f(0) = 0² − 2(0) − 3 = -3</div>
                            </div>

                            <div class="ci-calc-title">Informasi grafik:</div>
                            <div class="ci-calc-box">
                                <div id="ciInfoPotongX">Potong sumbu-x: -</div>
                                <div id="ciInfoPotongY">Potong sumbu-y: -</div>
                                <div id="ciInfoVertex">Vertex: -</div>
                            </div>

                            <div class="ci-calc-title">Klik salah satu titik:</div>
                            <div class="ci-point-row">
                                <button class="ci-point-btn">(-2, 5)</button>
                                <button class="ci-point-btn">(-1, 0)</button>
                                <button class="ci-point-btn active">(0, -3)</button>
                                <button class="ci-point-btn">(1, -4)</button>
                                <button class="ci-point-btn">(2, -3)</button>
                                <button class="ci-point-btn">(3, 0)</button>
                                <button class="ci-point-btn">(4, 5)</button>
                            </div>
                        </div>

                        <div class="ci-graph-card">
                            <div class="ci-graph-head">
                                <div>
                                    <span class="ci-dot-icon"></span>
                                    <span>Grafik (klik titik/label)</span>
                                </div>
                                <div id="ciActivePointText">
                                    Titik aktif: (0, -3)
                                </div>
                            </div>

                            <div class="ci-canvas-wrap">
                                <canvas id="ciGraphCanvas"></canvas>
                            </div>

                            <div class="ci-footnote">
                                Grafik berbentuk parabola membuka ke atas.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- =========================
            MATERI TAMBAHAN
            ========================= --}}
            <div class="materi-inline">
                <p class="inline-lead">
                    Yuk lihat bagaimana bentuk grafik berubah dari fungsi derajat 0 hingga derajat 5!
                    Mulai dari garis datar, garis miring, lengkungan parabola, hingga gelombang-gelombang unik yang
                    muncul pada derajat lebih tinggi.
                    Semua grafik ditampilkan berdampingan agar kamu bisa dengan mudah membandingkan bentuknya.
                </p>

                <div class="materi-figure">
                    <div class="degree-poly-board" id="degreePolyBoard">

                        <div class="degree-poly-card">
                            <div class="degree-poly-title">Derajat 0</div>
                            <div class="degree-poly-graph" data-degree="0" aria-label="Grafik fungsi polinomial derajat 0">
                            </div>
                        </div>

                        <div class="degree-poly-card">
                            <div class="degree-poly-title">Derajat 1</div>
                            <div class="degree-poly-graph" data-degree="1" aria-label="Grafik fungsi polinomial derajat 1">
                            </div>
                        </div>

                        <div class="degree-poly-card">
                            <div class="degree-poly-title">Derajat 2</div>
                            <div class="degree-poly-graph" data-degree="2" aria-label="Grafik fungsi polinomial derajat 2">
                            </div>
                        </div>

                        <div class="degree-poly-card">
                            <div class="degree-poly-title">Derajat 3</div>
                            <div class="degree-poly-graph" data-degree="3" aria-label="Grafik fungsi polinomial derajat 3">
                            </div>
                        </div>

                        <div class="degree-poly-card">
                            <div class="degree-poly-title">Derajat 4</div>
                            <div class="degree-poly-graph" data-degree="4" aria-label="Grafik fungsi polinomial derajat 4">
                            </div>
                        </div>

                        <div class="degree-poly-card">
                            <div class="degree-poly-title">Derajat 5</div>
                            <div class="degree-poly-graph" data-degree="5" aria-label="Grafik fungsi polinomial derajat 5">
                            </div>
                        </div>

                    </div> {{-- tutup .degree-poly-board --}}
                </div> {{-- tutup .materi-figure --}}

                <p class="inline-lead">
                    Salah satu ciri penting dari grafik fungsi polinomial adalah perilaku ujungnya, yaitu kecenderungan
                    grafik ketika nilai <b>x</b> bergerak menuju tak hingga atau menuju negatif tak hingga.
                    Perilaku ujung ini sepenuhnya ditentukan oleh suku utama dari polinom, karena suku tersebut memiliki
                    pengaruh paling besar dibandingkan suku-suku lainnya saat bernilai sangat besar.
                </p>
            </div> {{-- tutup .materi-inline --}}

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
                                            <span>📌 Lihat grafik interaktif</span>
                                            <span class="hint">Klik untuk buka</span>
                                        </summary>

                                        <div class="imgbox">
                                            <div class="real-poly-graph" data-graph="even-pos"
                                                aria-label="Grafik perilaku ujung: an lebih dari 0 dan n genap">
                                            </div>

                                            <div class="real-poly-caption">
                                                <div class="main">a<sub>n</sub> &gt; 0, n genap</div>
                                                <div class="sub">kedua ujung ke atas</div>
                                            </div>
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
                                            <span>📌 Lihat grafik interaktif</span>
                                            <span class="hint">Klik untuk buka</span>
                                        </summary>

                                        <div class="imgbox">
                                            <div class="real-poly-graph" data-graph="even-neg"
                                                aria-label="Grafik perilaku ujung: an kurang dari 0 dan n genap">
                                            </div>

                                            <div class="real-poly-caption">
                                                <div class="main">a<sub>n</sub> &lt; 0, n genap</div>
                                                <div class="sub">kedua ujung ke bawah</div>
                                            </div>
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
                                        <li>Grafik menuju <b>bawah</b> di ujung kiri dan <b>atas</b> di ujung kanan.
                                        </li>
                                        <li><b>Perilaku ujung:</b> (x→−∞, y→−∞) dan (x→+∞, y→+∞)</li>
                                    </ul>

                                    <details class="img-toggle">
                                        <summary>
                                            <span>📌 Lihat grafik interaktif</span>
                                            <span class="hint">Klik untuk buka</span>
                                        </summary>

                                        <div class="imgbox">
                                            <div class="real-poly-graph" data-graph="odd-pos"
                                                aria-label="Grafik perilaku ujung: an lebih dari 0 dan n ganjil">
                                            </div>

                                            <div class="real-poly-caption">
                                                <div class="main">a<sub>n</sub> &gt; 0, n ganjil</div>
                                                <div class="sub">ujung kiri ke bawah, ujung kanan ke atas</div>
                                            </div>
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
                                        <li>Grafik menuju <b>atas</b> di ujung kiri dan <b>bawah</b> di ujung kanan.
                                        </li>
                                        <li><b>Perilaku ujung:</b> (x→−∞, y→+∞) dan (x→+∞, y→−∞)</li>
                                    </ul>

                                    <details class="img-toggle">
                                        <summary>
                                            <span>📌 Lihat grafik interaktif</span>
                                            <span class="hint">Klik untuk buka</span>
                                        </summary>

                                        <div class="imgbox">
                                            <div class="real-poly-graph" data-graph="odd-neg"
                                                aria-label="Grafik perilaku ujung: an kurang dari 0 dan n ganjil">
                                            </div>

                                            <div class="real-poly-caption">
                                                <div class="main">a<sub>n</sub> &lt; 0, n ganjil</div>
                                                <div class="sub">ujung kiri ke atas, ujung kanan ke bawah</div>
                                            </div>
                                        </div>
                                    </details>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="endbeh-note">
                <b>Ingat:</b> Perilaku ujung ditentukan oleh <b>suku utama</b> (pangkat tertinggi) dan
                <b>koefisien utamanya</b>.
                Jadi, cukup lihat <b>n</b> (ganjil/genap) dan tanda <b>a<sub>n</sub></b> (positif/negatif)
                untuk menebak arah ujung grafik.
            </div>

            <p class="inline-lead">
                Dengan kata lain, meskipun sebuah polinom memiliki banyak suku, bentuk grafik pada bagian ujung kiri
                dan
                kanan sebenarnya mengikuti pola yang berasal dari pangkat tertinggi dan koefisien utamanya.
                Sifat inilah yang memungkinkan kita memperkirakan arah grafik tanpa harus menggambar seluruh kurva
                secara detail.
            </p>

            {{-- =========================
            CONTOH
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
                                    Untuk memasangkan fungsi polinomial dengan grafiknya, identifikasi
                                    <b>suku utama</b>,
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
                                    <b>Kesimpulan:</b> Derajat genap → kedua ujung sama arah.
                                    Derajat ganjil → ujung kiri dan kanan berlawanan arah.
                                    Tanda koefisien utama menentukan apakah ujung kanan naik atau turun.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      

        {{-- =========================
        LATIHAN
        ========================= --}}
        <div class="card card-example">
            <div class="latihan-title-row">
                <div class="latihan-badge">LATIHAN</div>
            </div>

            {{-- 1. Analisis Fungsi Polinomial --}}
            <section class="latihan-section" id="latihanSoal1">
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

                <div class="latihan-actions bawah">
                    <button type="button" class="latihan-btn" id="cekSoal1Btn">CEK JAWABAN NO. 1</button>
                </div>

                <div id="hasilSoal1" class="hasil-latihan">
                    Kerjakan soal nomor 1 lalu klik <b>Cek Jawaban No. 1</b>.
                </div>
            </section>

            {{-- 2. Grafik Fungsi Kuadrat --}}
            <section class="latihan-section latihan-locked" id="latihanSoal2">
                <h3>2. Grafik Fungsi Kuadrat</h3>
                <div class="latihan-rumus">Diberikan fungsi <b>f(x) = x² − 2x − 8</b></div>
                <p class="latihan-sub">Tentukan pula:</p>

                <div class="latihan-grid">
                    <div class="soal-label">a. Titik potong dengan sumbu-x</div>
                    <input type="text" id="b1" class="latihan-input" placeholder="Jawaban..." disabled>

                    <div class="soal-label">b. Titik potong dengan sumbu-y</div>
                    <input type="text" id="b2" class="latihan-input" placeholder="Jawaban..." disabled>

                    <div class="soal-label">c. Vertex / titik puncak</div>
                    <input type="text" id="b3" class="latihan-input" placeholder="Jawaban..." disabled>
                </div>

                <div class="latihan-actions bawah">
                    <button type="button" class="latihan-btn" id="cekSoal2Btn" disabled>CEK JAWABAN NO. 2</button>
                </div>

                <div id="hasilSoal2" class="hasil-latihan">
                    Soal nomor 2 akan terbuka jika nomor 1 sudah benar.
                </div>
            </section>

            {{-- 3. Perilaku Ujung & Mencocokkan Grafik --}}
            <section class="latihan-section latihan-locked" id="latihanSoal3">
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

                <div class="match-table latihan-match-mobile">
                    <div class="match-header fungsi-col">Fungsinya</div>
                    <div class="match-header jawaban-col">Jawaban</div>
                    <div class="match-header perilaku-col">Perilaku Ujung</div>
                    <div class="match-header cocok-col">Cocok</div>

                    <div class="match-item fungsi-col">
                        <div class="mobile-label">Fungsi</div>
                        <div><b>1.</b> <i>f(x)</i> = 2x³ + 5x² − 1</div>
                    </div>
                    <div class="match-item jawaban-col">
                        <label class="mobile-label" for="c1">Jawaban</label>
                        <input type="text" id="c1" class="latihan-input kecil" placeholder="A/B/C" disabled>
                    </div>
                    <div class="match-item perilaku-col">
                        <label class="mobile-label" for="c1u">Perilaku Ujung</label>
                        <input type="text" id="c1u" class="latihan-input" placeholder="Contoh: turun-naik" disabled>
                    </div>
                    <div class="match-item cocok-col">
                        <label class="mobile-label" for="c1c">Cocok</label>
                        <input type="text" id="c1c" class="latihan-input kecil" placeholder="A/B/C" disabled>
                    </div>

                    <div class="match-item fungsi-col">
                        <div class="mobile-label">Fungsi</div>
                        <div><b>2.</b> <i>g(x)</i> = 3x⁴ − 6x² + 2</div>
                    </div>
                    <div class="match-item jawaban-col">
                        <label class="mobile-label" for="c2">Jawaban</label>
                        <input type="text" id="c2" class="latihan-input kecil" placeholder="A/B/C" disabled>
                    </div>
                    <div class="match-item perilaku-col">
                        <label class="mobile-label" for="c2u">Perilaku Ujung</label>
                        <input type="text" id="c2u" class="latihan-input" placeholder="Contoh: naik-naik" disabled>
                    </div>
                    <div class="match-item cocok-col">
                        <label class="mobile-label" for="c2c">Cocok</label>
                        <input type="text" id="c2c" class="latihan-input kecil" placeholder="A/B/C" disabled>
                    </div>

                    <div class="match-item fungsi-col">
                        <div class="mobile-label">Fungsi</div>
                        <div><b>3.</b> <i>h(x)</i> = −x⁴ + 2x² − 3</div>
                    </div>
                    <div class="match-item jawaban-col">
                        <label class="mobile-label" for="c3">Jawaban</label>
                        <input type="text" id="c3" class="latihan-input kecil" placeholder="A/B/C" disabled>
                    </div>
                    <div class="match-item perilaku-col">
                        <label class="mobile-label" for="c3u">Perilaku Ujung</label>
                        <input type="text" id="c3u" class="latihan-input" placeholder="Contoh: turun-turun" disabled>
                    </div>
                    <div class="match-item cocok-col">
                        <label class="mobile-label" for="c3c">Cocok</label>
                        <input type="text" id="c3c" class="latihan-input kecil" placeholder="A/B/C" disabled>
                    </div>
                </div>

                <div class="latihan-actions bawah">
                    <button type="button" class="latihan-btn" id="cekSoal3Btn" disabled>CEK JAWABAN NO. 3</button>
                    <button type="button" class="latihan-btn reset" id="resetLatihanBtn">RESET SEMUA</button>
                </div>
            </section>
        </div>
    </div>
    </div>

    <!-- Save Progress -->
    <script>
        window.completeMateriUrl = "{{ route('materi.complete', $materi->id) }}";
    </script>

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

            const statusFx = document.getElementById('statusFx');
            const statusPos = document.getElementById('statusPos');
            const statusTrend = document.getElementById('statusTrend');

            const feedbackExplore = document.getElementById('feedbackExplore');
            const btnResetExplore = document.getElementById('btnResetExplore');
            const btnShowExplain = document.getElementById('btnShowExplain');

            const canvas = document.getElementById('expGraph');
            const ctx = canvas ? canvas.getContext('2d') : null;

            let exploreInfoUnlocked = false;

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

            function setMiniStatus(el, state, text) {
                if (!el) return;
                el.className = 'mini-badge';
                if (state === 'ok') el.classList.add('good');
                if (state === 'bad') el.classList.add('info');
                el.textContent = text;
            }

            function allAnswered() {
                return (
                    studentFx?.value !== '' &&
                    !!studentPos?.value &&
                    !!studentTrend?.value
                );
            }

            function updateKPIVisibility(x, y, trend) {
                if (kpiX) kpiX.textContent = x;

                if (exploreInfoUnlocked) {
                    if (kpiFx) kpiFx.textContent = y;
                    if (kpiTrend) kpiTrend.textContent = trend;
                } else {
                    if (kpiFx) kpiFx.textContent = '—';
                    if (kpiTrend) kpiTrend.textContent = '—';
                }
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
                if (!slider || !explainBox || !allAnswered()) return;
                const x = parseInt(slider.value, 10);
                const y = fx(x);
                const trend = getCorrectTrend(x);

                explainBox.style.display = 'block';
                updateExplanation(x, y, trend);
            }

            function validateExploreAnswers() {
                if (!slider || !feedbackExplore) return;

                const x = parseInt(slider.value, 10);
                const y = fx(x);
                const posisiBenar = getCorrectPosition(y);
                const trendBenar = getCorrectTrend(x);

                if (studentFx?.value === '') {
                    setMiniStatus(statusFx, '', 'Belum dijawab');
                } else if (Number(studentFx.value) === y) {
                    setMiniStatus(statusFx, 'ok', 'Benar');
                } else {
                    setMiniStatus(statusFx, 'bad', 'Salah');
                }

                if (!studentPos?.value) {
                    setMiniStatus(statusPos, '', 'Belum dijawab');
                } else if (studentPos.value === posisiBenar) {
                    setMiniStatus(statusPos, 'ok', 'Benar');
                } else {
                    setMiniStatus(statusPos, 'bad', 'Salah');
                }

                if (!studentTrend?.value) {
                    setMiniStatus(statusTrend, '', 'Belum dijawab');
                } else if (studentTrend.value === trendBenar) {
                    setMiniStatus(statusTrend, 'ok', 'Benar');
                } else {
                    setMiniStatus(statusTrend, 'bad', 'Salah');
                }

                if (allAnswered()) {
                    exploreInfoUnlocked = true;
                    updateKPIVisibility(x, y, trendBenar);

                    if (btnShowExplain) btnShowExplain.disabled = false;

                    feedbackExplore.className = 'feedback ok';
                    feedbackExplore.innerHTML =
                        `✅ Semua soal sudah terjawab. Status jawaban terdeteksi otomatis, dan pembahasan sekarang bisa dibuka.`;
                } else {
                    exploreInfoUnlocked = false;
                    updateKPIVisibility(x, y, trendBenar);

                    if (btnShowExplain) btnShowExplain.disabled = true;
                    feedbackExplore.className = 'feedback';
                    feedbackExplore.innerHTML = 'Semua jawaban sudah diisi.';
                    hideExplanation();
                }
            }

            function resetStudentAnswerState() {
                setMiniStatus(statusFx, '', 'Belum dijawab');
                setMiniStatus(statusPos, '', 'Belum dijawab');
                setMiniStatus(statusTrend, '', 'Belum dijawab');

                if (feedbackExplore) {
                    feedbackExplore.className = 'feedback';
                    feedbackExplore.innerHTML = 'Amati grafiknya, lalu isi jawabanmu.';
                }

                if (btnShowExplain) btnShowExplain.disabled = true;
                setInsight('', 'Insight: siap diamati');
            }

            function updateExplorerUI() {
                if (!slider) return;

                const x = parseInt(slider.value, 10);
                const y = fx(x);
                const trend = getCorrectTrend(x);

                updateKPIVisibility(x, y, trend);

                if (coordChip) coordChip.textContent = `Titik: (${x}, ${y})`;

                resizeCanvas();
                drawGraph(x);
            }

            studentFx?.addEventListener('input', validateExploreAnswers);
            studentPos?.addEventListener('change', validateExploreAnswers);
            studentTrend?.addEventListener('change', validateExploreAnswers);

            btnResetExplore?.addEventListener('click', function () {
                if (studentFx) studentFx.value = '';
                if (studentPos) studentPos.value = '';
                if (studentTrend) studentTrend.value = '';

                exploreInfoUnlocked = false;

                if (slider) {
                    const x = parseInt(slider.value, 10);
                    updateKPIVisibility(x, fx(x), getCorrectTrend(x));
                }

                hideExplanation();
                resetStudentAnswerState();
                rerenderMath(document.body);
            });

            btnShowExplain?.addEventListener('click', function () {
                if (allAnswered()) {
                    showExplanation();
                }
            });

            if (slider && canvas && ctx) {
                window.addEventListener('resize', () => {
                    resizeCanvas();
                    updateExplorerUI();
                });

                slider.addEventListener('input', () => {
                    exploreInfoUnlocked = false;
                    updateExplorerUI();
                    hideExplanation();

                    if (studentFx) studentFx.value = '';
                    if (studentPos) studentPos.value = '';
                    if (studentTrend) studentTrend.value = '';

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

            const infoPotongX = document.getElementById('ciInfoPotongX');
            const infoPotongY = document.getElementById('ciInfoPotongY');
            const infoVertex = document.getElementById('ciInfoVertex');
            const graphDescription = document.getElementById('ciGraphDescription');

            const pointBtns = Array.from(document.querySelectorAll('.ci-point-btn'));

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

            function setActivePointButton(xVal) {
                pointBtns.forEach(btn => {
                    btn.classList.toggle('active', Number(btn.dataset.x) === xVal);
                });
            }

            function updateInfoTambahan() {
                const y = fx(selectedX);

                const isPotongX = (y === 0);
                const isPotongY = (selectedX === 0);
                const isVertex = (selectedX === 1 && y === -4);

                if (infoPotongX) {
                    infoPotongX.className = 'ci-info-item';
                    if (isPotongX) infoPotongX.classList.add('match');

                    infoPotongX.innerHTML = isPotongX
                        ? `<b>Potong sumbu-x:</b> untuk x = ${selectedX}, diperoleh f(${selectedX}) = 0, jadi titiknya adalah <b>(${selectedX}, 0)</b>.`
                        : `<b>Potong sumbu-x:</b> untuk x = ${selectedX}, diperoleh f(${selectedX}) = ${y}, jadi <b>bukan</b> titik potong sumbu-x.`;
                }

                if (infoPotongY) {
                    infoPotongY.className = 'ci-info-item';
                    if (isPotongY) infoPotongY.classList.add('match');

                    infoPotongY.innerHTML = isPotongY
                        ? `<b>Potong sumbu-y:</b> karena x = 0, titiknya adalah <b>(0, ${y})</b>.`
                        : `<b>Potong sumbu-y:</b> titik potong sumbu-y hanya terjadi saat <b>x = 0</b>. Sekarang x = ${selectedX}.`;
                }

                if (infoVertex) {
                    infoVertex.className = 'ci-info-item';
                    if (isVertex) infoVertex.classList.add('match');

                    infoVertex.innerHTML = isVertex
                        ? `<b>Vertex:</b> untuk x = 1 diperoleh titik minimum <b>(1, -4)</b>.`
                        : `<b>Vertex:</b> vertex fungsi ini tetap di <b>(1, -4)</b>. Sekarang titik aktifnya adalah <b>(${selectedX}, ${y})</b>.`;
                }

                if (graphDescription) {
                    let posisiGrafik = '';
                    if (selectedX < 1) {
                        posisiGrafik = `Pada x = ${selectedX}, titik berada di bagian grafik yang <b>menurun</b>.`;
                    } else if (selectedX > 1) {
                        posisiGrafik = `Pada x = ${selectedX}, titik berada di bagian grafik yang <b>menaik</b>.`;
                    } else {
                        posisiGrafik = `Pada x = 1, titik berada tepat di <b>vertex</b>.`;
                    }

                    graphDescription.innerHTML = `
                                                                                                                                                                                                            Grafik berbentuk <b>parabola membuka ke atas</b>. 
                                                                                                                                                                                                            Dari kiri ke kanan, grafik <b>turun lalu naik</b>. 
                                                                                                                                                                                                            ${posisiGrafik}
                                                                                                                                                                                                            Perilaku ujungnya adalah <b>naik-naik</b>:
                                                                                                                                                                                                            saat x → -∞, y → +∞ dan saat x → +∞, y → +∞.
                                                                                                                                                                                                        `;
                }
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

                updateInfoTambahan();
                setActivePointButton(selectedX);
                drawGraph();
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
                    syncUI();
                }
            }

            pointBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    selectedX = Number(this.dataset.x);
                    syncUI();
                });
            });

            range?.addEventListener('input', function () {
                selectedX = Number(this.value);
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
            const SVG_NS = "http://www.w3.org/2000/svg";

            const graphConfigs = {
                "even-pos": {
                    xMin: -6,
                    xMax: 6,
                    yMin: -6,
                    yMax: 6,
                    f: x => 0.015 * (x + 4.5) * (x + 2) * (x - 1.5) * (x - 4) + 1.2
                },

                "even-neg": {
                    xMin: -6,
                    xMax: 6,
                    yMin: -6,
                    yMax: 6,
                    f: x => -0.015 * (x + 4.5) * (x + 2) * (x - 1.5) * (x - 4) - 1.2
                },

                "odd-pos": {
                    xMin: -6,
                    xMax: 6,
                    yMin: -6,
                    yMax: 6,
                    f: x => 0.06 * (x + 4) * x * (x - 4)
                },

                "odd-neg": {
                    xMin: -6,
                    xMax: 6,
                    yMin: -6,
                    yMax: 6,
                    f: x => -0.06 * (x + 4) * x * (x - 4)
                }
            };

            function svgEl(tag, attrs = {}) {
                const el = document.createElementNS(SVG_NS, tag);

                Object.entries(attrs).forEach(([key, value]) => {
                    el.setAttribute(key, value);
                });

                return el;
            }

            function drawGraph(host, type, index) {
                const cfg = graphConfigs[type];

                if (!cfg) return;

                const W = 420;
                const H = 285;

                const plotLeft = 34;
                const plotRight = 400;
                const plotTop = 16;
                const plotBottom = 250;

                const xMin = cfg.xMin;
                const xMax = cfg.xMax;
                const yMin = cfg.yMin;
                const yMax = cfg.yMax;

                const plotW = plotRight - plotLeft;
                const plotH = plotBottom - plotTop;

                const mapX = x => plotLeft + ((x - xMin) / (xMax - xMin)) * plotW;
                const mapY = y => plotBottom - ((y - yMin) / (yMax - yMin)) * plotH;

                const svg = svgEl("svg", {
                    viewBox: `0 0 ${W} ${H}`,
                    role: "img",
                    "aria-label": `Grafik perilaku ujung ${type}`
                });

                const defs = svgEl("defs");

                const markerId = `arrow-${index}-${type}`;
                const clipId = `clip-${index}-${type}`;

                const marker = svgEl("marker", {
                    id: markerId,
                    markerWidth: "8",
                    markerHeight: "8",
                    refX: "7",
                    refY: "4",
                    orient: "auto",
                    markerUnits: "strokeWidth"
                });

                marker.appendChild(svgEl("path", {
                    d: "M0,0 L8,4 L0,8 Z",
                    fill: "#111"
                }));

                const clip = svgEl("clipPath", {
                    id: clipId
                });

                clip.appendChild(svgEl("rect", {
                    x: plotLeft,
                    y: plotTop,
                    width: plotW,
                    height: plotH
                }));

                defs.appendChild(marker);
                defs.appendChild(clip);
                svg.appendChild(defs);

                svg.appendChild(svgEl("rect", {
                    x: 0,
                    y: 0,
                    width: W,
                    height: H,
                    fill: "#fff"
                }));

                // Garis grid dan angka x
                for (let x = -6; x <= 6; x += 2) {
                    const px = mapX(x);

                    svg.appendChild(svgEl("line", {
                        x1: px,
                        y1: plotTop,
                        x2: px,
                        y2: plotBottom,
                        class: "grid-line"
                    }));

                    const text = svgEl("text", {
                        x: px,
                        y: mapY(0) + 16,
                        "text-anchor": "middle",
                        class: "tick-text"
                    });

                    text.textContent = x;
                    svg.appendChild(text);
                }

                // Garis grid dan angka y
                for (let y = -6; y <= 6; y += 2) {
                    const py = mapY(y);

                    svg.appendChild(svgEl("line", {
                        x1: plotLeft,
                        y1: py,
                        x2: plotRight,
                        y2: py,
                        class: "grid-line"
                    }));

                    if (y !== 0) {
                        const text = svgEl("text", {
                            x: mapX(0) - 10,
                            y: py + 4,
                            "text-anchor": "end",
                            class: "tick-text"
                        });

                        text.textContent = y;
                        svg.appendChild(text);
                    }
                }

                // Sumbu x
                svg.appendChild(svgEl("line", {
                    x1: plotLeft - 10,
                    y1: mapY(0),
                    x2: plotRight + 14,
                    y2: mapY(0),
                    class: "axis",
                    "marker-end": `url(#${markerId})`
                }));

                // Sumbu y
                svg.appendChild(svgEl("line", {
                    x1: mapX(0),
                    y1: plotBottom + 8,
                    x2: mapX(0),
                    y2: plotTop - 10,
                    class: "axis",
                    "marker-end": `url(#${markerId})`
                }));

                const xLabel = svgEl("text", {
                    x: plotRight + 18,
                    y: mapY(0) + 5,
                    class: "axis-label"
                });

                xLabel.textContent = "x";
                svg.appendChild(xLabel);

                const yLabel = svgEl("text", {
                    x: mapX(0) + 7,
                    y: plotTop - 2,
                    class: "axis-label"
                });

                yLabel.textContent = "y";
                svg.appendChild(yLabel);

                // Membuat kurva
                let d = "";
                const steps = 320;

                for (let i = 0; i <= steps; i++) {
                    const x = xMin + (i / steps) * (xMax - xMin);
                    const y = cfg.f(x);

                    const px = mapX(x);
                    const py = mapY(y);

                    d += `${i === 0 ? "M" : "L"} ${px} ${py} `;
                }

                const curveGroup = svgEl("g", {
                    "clip-path": `url(#${clipId})`
                });

                curveGroup.appendChild(svgEl("path", {
                    d: d.trim(),
                    class: "curve"
                }));

                svg.appendChild(curveGroup);

                // Tracker interaktif
                const trackerLine = svgEl("line", {
                    class: "tracker-line"
                });

                const trackerDot = svgEl("circle", {
                    r: 5,
                    class: "tracker-dot"
                });

                const trackerLabel = svgEl("text", {
                    class: "tracker-label",
                    "text-anchor": "middle"
                });

                svg.appendChild(trackerLine);
                svg.appendChild(trackerDot);
                svg.appendChild(trackerLabel);

                function hideTracker() {
                    trackerLine.style.display = "none";
                    trackerDot.style.display = "none";
                    trackerLabel.style.display = "none";
                }

                function updateTracker(event) {
                    const rect = svg.getBoundingClientRect();
                    const sx = ((event.clientX - rect.left) / rect.width) * W;

                    if (sx < plotLeft || sx > plotRight) {
                        hideTracker();
                        return;
                    }

                    const x = xMin + ((sx - plotLeft) / plotW) * (xMax - xMin);
                    const y = cfg.f(x);

                    const px = mapX(x);
                    const py = mapY(y);

                    trackerLine.setAttribute("x1", px);
                    trackerLine.setAttribute("x2", px);
                    trackerLine.setAttribute("y1", plotTop);
                    trackerLine.setAttribute("y2", plotBottom);

                    trackerDot.setAttribute("cx", px);
                    trackerDot.setAttribute("cy", py);

                    trackerLabel.setAttribute("x", px);
                    trackerLabel.setAttribute("y", Math.max(plotTop + 14, Math.min(plotBottom - 10, py - 10)));
                    trackerLabel.textContent = `x=${x.toFixed(1)}, y=${y.toFixed(1)}`;

                    trackerLine.style.display = "block";
                    trackerDot.style.display = "block";
                    trackerLabel.style.display = "block";
                }

                svg.addEventListener("pointermove", updateTracker);
                svg.addEventListener("pointerleave", hideTracker);

                host.innerHTML = "";
                host.appendChild(svg);
            }

            document.querySelectorAll(".real-poly-graph").forEach((host, index) => {
                drawGraph(host, host.dataset.graph, index);
            });
        })();
    </script>

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

            const studentFx = document.getElementById('studentFx');
            const studentPos = document.getElementById('studentPos');
            const studentTrend = document.getElementById('studentTrend');

            const statusFx = document.getElementById('statusFx');
            const statusPos = document.getElementById('statusPos');
            const statusTrend = document.getElementById('statusTrend');

            const feedbackExplore = document.getElementById('feedbackExplore');
            const btnResetExplore = document.getElementById('btnResetExplore');
            const btnShowExplain = document.getElementById('btnShowExplain');

            const materiLanjutan = document.getElementById('materiLanjutan');
            const materiLockedInfo = document.getElementById('materiLockedInfo');

            const canvas = document.getElementById('expGraph');
            const ctx = canvas ? canvas.getContext('2d') : null;

            let exploreInfoUnlocked = false;

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

            function setMiniStatus(el, state, text) {
                if (!el) return;
                el.className = 'mini-badge';
                if (state === 'ok') el.classList.add('good');
                if (state === 'bad') el.classList.add('info');
                el.textContent = text;
            }

            function allAnswered() {
                return (
                    studentFx?.value !== '' &&
                    !!studentPos?.value &&
                    !!studentTrend?.value
                );
            }

            function lockMateri() {
                exploreInfoUnlocked = false;

                if (materiLanjutan) materiLanjutan.style.display = 'none';
                if (materiLockedInfo) {
                    materiLockedInfo.className = 'info-feedback';
                    materiLockedInfo.innerHTML = 'Selesaikan semua pertanyaan pada bagian eksplorasi terlebih dahulu agar materi berikutnya terbuka.';
                }

                if (btnShowExplain) btnShowExplain.disabled = true;
            }

            function unlockMateri() {
                exploreInfoUnlocked = true;

                if (materiLanjutan) materiLanjutan.style.display = 'block';
                if (materiLockedInfo) {
                    materiLockedInfo.className = 'info-feedback ok';
                    materiLockedInfo.innerHTML = '';
                }

                if (btnShowExplain) btnShowExplain.disabled = false;
            }

            function updateKPIVisibility(x, y, trend) {
                if (kpiX) kpiX.textContent = x;

                if (exploreInfoUnlocked) {
                    if (kpiFx) kpiFx.textContent = y;
                    if (kpiTrend) kpiTrend.textContent = trend;
                } else {
                    if (kpiFx) kpiFx.textContent = '—';
                    if (kpiTrend) kpiTrend.textContent = '—';
                }
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
                if (explainBox) explainBox.style.display = 'none';
            }

            function showExplanation() {
                if (!slider || !explainBox || !allAnswered()) return;
                const x = parseInt(slider.value, 10);
                const y = fx(x);
                const trend = getCorrectTrend(x);

                explainBox.style.display = 'block';
                updateExplanation(x, y, trend);
            }

            function validateExploreAnswers() {
                if (!slider || !feedbackExplore) return;

                const x = parseInt(slider.value, 10);
                const y = fx(x);
                const posisiBenar = getCorrectPosition(y);
                const trendBenar = getCorrectTrend(x);

                if (studentFx?.value === '') {
                    setMiniStatus(statusFx, '', 'Belum dijawab');
                } else if (Number(studentFx.value) === y) {
                    setMiniStatus(statusFx, 'ok', 'Benar');
                } else {
                    setMiniStatus(statusFx, 'bad', 'Salah');
                }

                if (!studentPos?.value) {
                    setMiniStatus(statusPos, '', 'Belum dijawab');
                } else if (studentPos.value === posisiBenar) {
                    setMiniStatus(statusPos, 'ok', 'Benar');
                } else {
                    setMiniStatus(statusPos, 'bad', 'Salah');
                }

                if (!studentTrend?.value) {
                    setMiniStatus(statusTrend, '', 'Belum dijawab');
                } else if (studentTrend.value === trendBenar) {
                    setMiniStatus(statusTrend, 'ok', 'Benar');
                } else {
                    setMiniStatus(statusTrend, 'bad', 'Salah');
                }

                if (allAnswered()) {
                    unlockMateri();
                    updateKPIVisibility(x, y, trendBenar);

                    feedbackExplore.className = 'feedback ok';
                    feedbackExplore.innerHTML =
                        ``;
                } else {
                    lockMateri();
                    updateKPIVisibility(x, y, trendBenar);

                    feedbackExplore.className = 'feedback';
                    feedbackExplore.innerHTML =
                        `Isi semua jawaban eksplorasi terlebih dahulu agar materi berikutnya terbuka.`;

                    hideExplanation();
                }
            }

            function resetStudentAnswerState() {
                setMiniStatus(statusFx, '', 'Belum dijawab');
                setMiniStatus(statusPos, '', 'Belum dijawab');
                setMiniStatus(statusTrend, '', 'Belum dijawab');

                if (feedbackExplore) {
                    feedbackExplore.className = 'feedback';
                    feedbackExplore.innerHTML = 'Amati grafiknya, lalu isi semua jawabanmu.';
                }

                setInsight('', 'Insight: siap diamati');
                lockMateri();
            }

            function updateExplorerUI() {
                if (!slider) return;

                const x = parseInt(slider.value, 10);
                const y = fx(x);
                const trend = getCorrectTrend(x);

                updateKPIVisibility(x, y, trend);

                if (coordChip) coordChip.textContent = `Titik: (${x}, ${y})`;

                resizeCanvas();
                drawGraph(x);
            }

            studentFx?.addEventListener('input', validateExploreAnswers);
            studentPos?.addEventListener('change', validateExploreAnswers);
            studentTrend?.addEventListener('change', validateExploreAnswers);

            btnResetExplore?.addEventListener('click', function () {
                if (studentFx) studentFx.value = '';
                if (studentPos) studentPos.value = '';
                if (studentTrend) studentTrend.value = '';

                hideExplanation();
                resetStudentAnswerState();

                if (slider) {
                    const x = parseInt(slider.value, 10);
                    updateKPIVisibility(x, fx(x), getCorrectTrend(x));
                }

                rerenderMath(document.body);
            });

            btnShowExplain?.addEventListener('click', function () {
                if (allAnswered()) {
                    showExplanation();
                }
            });

            if (slider && canvas && ctx) {
                window.addEventListener('resize', () => {
                    resizeCanvas();
                    updateExplorerUI();
                });

                slider.addEventListener('input', () => {
                    if (studentFx) studentFx.value = '';
                    if (studentPos) studentPos.value = '';
                    if (studentTrend) studentTrend.value = '';

                    hideExplanation();
                    resetStudentAnswerState();
                    updateExplorerUI();
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

    </script>

    <script>
        (function () {
            const SVG_NS = "http://www.w3.org/2000/svg";

            const graphData = {
                0: {
                    xMin: -4,
                    xMax: 4,
                    yMin: -3,
                    yMax: 3,
                    f: x => 1
                },
                1: {
                    xMin: -4,
                    xMax: 4,
                    yMin: -4,
                    yMax: 4,
                    f: x => 0.75 * x + 0.3
                },
                2: {
                    xMin: -4,
                    xMax: 4,
                    yMin: -3,
                    yMax: 5,
                    f: x => 0.45 * x * x - 1
                },
                3: {
                    xMin: -4,
                    xMax: 4,
                    yMin: -5,
                    yMax: 5,
                    f: x => 0.32 * (x + 2.2) * (x + 0.1) * (x - 1.7)
                },
                4: {
                    xMin: -4,
                    xMax: 4,
                    yMin: -4,
                    yMax: 5,
                    f: x => 0.18 * (x + 2.6) * (x + 1.1) * (x - 1.1) * (x - 2.6) + 2.2
                },
                5: {
                    xMin: -4,
                    xMax: 4,
                    yMin: -5,
                    yMax: 5,
                    f: x => 0.12 * (x + 2.8) * (x + 1.2) * x * (x - 1.2) * (x - 2.5)
                }
            };

            function makeSvgEl(tag, attrs = {}) {
                const el = document.createElementNS(SVG_NS, tag);

                Object.entries(attrs).forEach(([key, value]) => {
                    el.setAttribute(key, value);
                });

                return el;
            }

            function drawDegreeGraph(host, degree, index) {
                const cfg = graphData[degree];
                if (!cfg) return;

                const W = 260;
                const H = 210;

                const padLeft = 22;
                const padRight = 16;
                const padTop = 14;
                const padBottom = 20;

                const plotLeft = padLeft;
                const plotRight = W - padRight;
                const plotTop = padTop;
                const plotBottom = H - padBottom;

                const plotW = plotRight - plotLeft;
                const plotH = plotBottom - plotTop;

                const mapX = x => plotLeft + ((x - cfg.xMin) / (cfg.xMax - cfg.xMin)) * plotW;
                const mapY = y => plotBottom - ((y - cfg.yMin) / (cfg.yMax - cfg.yMin)) * plotH;

                const svg = makeSvgEl("svg", {
                    viewBox: `0 0 ${W} ${H}`,
                    role: "img",
                    "aria-label": `Grafik polinomial derajat ${degree}`
                });

                const defs = makeSvgEl("defs");

                const markerId = `deg-arrow-${degree}-${index}`;
                const clipId = `deg-clip-${degree}-${index}`;

                const marker = makeSvgEl("marker", {
                    id: markerId,
                    markerWidth: "7",
                    markerHeight: "7",
                    refX: "6",
                    refY: "3.5",
                    orient: "auto",
                    markerUnits: "strokeWidth"
                });

                marker.appendChild(makeSvgEl("path", {
                    d: "M0,0 L7,3.5 L0,7 Z",
                    fill: "rgba(0,0,0,.65)"
                }));

                const clip = makeSvgEl("clipPath", {
                    id: clipId
                });

                clip.appendChild(makeSvgEl("rect", {
                    x: plotLeft,
                    y: plotTop,
                    width: plotW,
                    height: plotH
                }));

                defs.appendChild(marker);
                defs.appendChild(clip);
                svg.appendChild(defs);

                svg.appendChild(makeSvgEl("rect", {
                    x: 0,
                    y: 0,
                    width: W,
                    height: H,
                    fill: "#fff"
                }));

                // Grid
                for (let x = Math.ceil(cfg.xMin); x <= Math.floor(cfg.xMax); x++) {
                    const px = mapX(x);

                    svg.appendChild(makeSvgEl("line", {
                        x1: px,
                        y1: plotTop,
                        x2: px,
                        y2: plotBottom,
                        class: "deg-grid"
                    }));
                }

                for (let y = Math.ceil(cfg.yMin); y <= Math.floor(cfg.yMax); y++) {
                    const py = mapY(y);

                    svg.appendChild(makeSvgEl("line", {
                        x1: plotLeft,
                        y1: py,
                        x2: plotRight,
                        y2: py,
                        class: "deg-grid"
                    }));
                }

                // Sumbu x
                svg.appendChild(makeSvgEl("line", {
                    x1: plotLeft,
                    y1: mapY(0),
                    x2: plotRight,
                    y2: mapY(0),
                    class: "deg-axis",
                    "marker-end": `url(#${markerId})`
                }));

                // Sumbu y
                svg.appendChild(makeSvgEl("line", {
                    x1: mapX(0),
                    y1: plotBottom,
                    x2: mapX(0),
                    y2: plotTop,
                    class: "deg-axis",
                    "marker-end": `url(#${markerId})`
                }));

                const xLabel = makeSvgEl("text", {
                    x: plotRight - 5,
                    y: mapY(0) - 6,
                    class: "deg-axis-label"
                });
                xLabel.textContent = "x";
                svg.appendChild(xLabel);

                const yLabel = makeSvgEl("text", {
                    x: mapX(0) + 5,
                    y: plotTop + 12,
                    class: "deg-axis-label"
                });
                yLabel.textContent = "y";
                svg.appendChild(yLabel);

                const zero = makeSvgEl("text", {
                    x: mapX(0) - 13,
                    y: mapY(0) + 14,
                    class: "deg-zero"
                });
                zero.textContent = "0";
                svg.appendChild(zero);

                // Kurva fungsi
                let d = "";
                const steps = 350;

                for (let i = 0; i <= steps; i++) {
                    const x = cfg.xMin + (i / steps) * (cfg.xMax - cfg.xMin);
                    const y = cfg.f(x);

                    const px = mapX(x);
                    const py = mapY(y);

                    d += `${i === 0 ? "M" : "L"} ${px} ${py} `;
                }

                const curveGroup = makeSvgEl("g", {
                    "clip-path": `url(#${clipId})`
                });

                curveGroup.appendChild(makeSvgEl("path", {
                    d: d.trim(),
                    class: "deg-curve"
                }));

                svg.appendChild(curveGroup);

                // Interaktif hover
                const guide = makeSvgEl("line", {
                    class: "deg-guide",
                    y1: plotTop,
                    y2: plotBottom
                });

                const dot = makeSvgEl("circle", {
                    r: 5,
                    class: "deg-dot"
                });

                const label = makeSvgEl("text", {
                    class: "deg-label",
                    "text-anchor": "middle"
                });

                svg.appendChild(guide);
                svg.appendChild(dot);
                svg.appendChild(label);

                function hideTracker() {
                    guide.style.display = "none";
                    dot.style.display = "none";
                    label.style.display = "none";
                }

                function updateTracker(event) {
                    const rect = svg.getBoundingClientRect();
                    const sx = ((event.clientX - rect.left) / rect.width) * W;

                    if (sx < plotLeft || sx > plotRight) {
                        hideTracker();
                        return;
                    }

                    const x = cfg.xMin + ((sx - plotLeft) / plotW) * (cfg.xMax - cfg.xMin);
                    const y = cfg.f(x);

                    const px = mapX(x);
                    const py = mapY(y);

                    if (py < plotTop || py > plotBottom) {
                        hideTracker();
                        return;
                    }

                    guide.setAttribute("x1", px);
                    guide.setAttribute("x2", px);

                    dot.setAttribute("cx", px);
                    dot.setAttribute("cy", py);

                    label.setAttribute("x", px);
                    label.setAttribute("y", Math.max(plotTop + 12, py - 10));
                    label.textContent = `(${x.toFixed(1)}, ${y.toFixed(1)})`;

                    guide.style.display = "block";
                    dot.style.display = "block";
                    label.style.display = "block";
                }

                svg.addEventListener("pointermove", updateTracker);
                svg.addEventListener("pointerleave", hideTracker);

                host.innerHTML = "";
                host.appendChild(svg);
            }

            document.querySelectorAll(".degree-poly-graph").forEach((host, index) => {
                drawDegreeGraph(host, host.dataset.degree, index);
            });
        })();
    </script>

    <script>
        (function () {
            const hasil1 = document.getElementById("hasilSoal1");
            const hasil2 = document.getElementById("hasilSoal2");
            const hasil3 = document.getElementById("hasilSoal3");

            const cekSoal1Btn = document.getElementById("cekSoal1Btn");
            const cekSoal2Btn = document.getElementById("cekSoal2Btn");
            const cekSoal3Btn = document.getElementById("cekSoal3Btn");
            const resetBtn = document.getElementById("resetLatihanBtn");

            const section2 = document.getElementById("latihanSoal2");
            const section3 = document.getElementById("latihanSoal3");

            const soal1Ids = ["a1", "a2", "a3", "a4", "a5"];
            const soal2Ids = ["b1", "b2", "b3"];
            const soal3Ids = ["c1", "c1u", "c1c", "c2", "c2u", "c2c", "c3", "c3u", "c3c"];

            function normal(v) {
                const superscriptMap = {
                    "⁰": "0",
                    "¹": "1",
                    "²": "2",
                    "³": "3",
                    "⁴": "4",
                    "⁵": "5",
                    "⁶": "6",
                    "⁷": "7",
                    "⁸": "8",
                    "⁹": "9"
                };

                return (v || "")
                    .toString()
                    .toLowerCase()
                    .trim()
                    .replace(/\s+/g, "")
                    .replace(/[()]/g, "")
                    .replace(/×/g, "x")
                    .replace(/–/g, "-")
                    .replace(/−/g, "-")
                    .replace(/\^/g, "")
                    .replace(/[⁰¹²³⁴⁵⁶⁷⁸⁹]/g, function (match) {
                        return superscriptMap[match] || match;
                    });
            }
            function cekKhusus(id, val) {
                const v = normal(val);

                if (id === "a1") return v === "3";
                if (id === "a2") return v === "3" || v === "3suku";
                if (id === "a3") return v.includes("7x3");
                if (id === "a4") return v === "7";
                if (id === "a5") return v.includes("kiri") && v.includes("turun") && v.includes("kanan") && v.includes("naik");

                if (id === "b1") {
                    return (
                        (v.includes("-2") && v.includes("4")) ||
                        v === "x=-2danx=4" ||
                        v === "x=4danx=-2"
                    );
                }

                if (id === "b2") {
                    return v === "0,-8" || (v.includes("0") && v.includes("-8"));
                }

                if (id === "b3") {
                    return v === "1,-9" || (v.includes("1") && v.includes("-9"));
                }

                if (id === "c1") return v === "a";
                if (id === "c1u") return v.includes("turun") && v.includes("naik");
                if (id === "c1c") return v === "a";

                if (id === "c2") return v === "b";
                if (id === "c2u") return v.includes("naik") && !v.includes("turun");
                if (id === "c2c") return v === "b";

                if (id === "c3") return v === "c";
                if (id === "c3u") return v.includes("turun") && !v.includes("naik");
                if (id === "c3c") return v === "c";

                return false;
            }

            function setHasil(el, type, html) {
                if (!el) return;
                el.className = "hasil-latihan";
                if (type) el.classList.add(type);
                el.innerHTML = html;
            }

            function setInputState(el, state) {
                if (!el) return;
                el.classList.remove("is-correct", "is-wrong", "is-empty");

                if (state === "correct") el.classList.add("is-correct");
                if (state === "wrong") el.classList.add("is-wrong");
                if (state === "empty") el.classList.add("is-empty");
            }

            function clearStates(ids) {
                ids.forEach(id => {
                    const el = document.getElementById(id);
                    if (el) el.classList.remove("is-correct", "is-wrong", "is-empty");
                });
            }

            function setDisabled(ids, state) {
                ids.forEach(id => {
                    const el = document.getElementById(id);
                    if (el) el.disabled = state;
                });
            }

            function lockSection(section, ids, btn, hasilEl, text) {
                if (section) {
                    section.classList.add("latihan-locked");
                    section.style.opacity = ".7";
                    section.style.pointerEvents = "none";
                }

                setDisabled(ids, true);
                if (btn) btn.disabled = true;
                if (hasilEl) setHasil(hasilEl, "", text);
                clearStates(ids);
            }

            function unlockSection(section, ids, btn, hasilEl, text) {
                if (section) {
                    section.classList.remove("latihan-locked");
                    section.style.opacity = "1";
                    section.style.pointerEvents = "auto";
                }

                setDisabled(ids, false);
                if (btn) btn.disabled = false;
                if (hasilEl) setHasil(hasilEl, "", text);
            }

            function cekGroup(ids) {
                const kosong = [];
                const salah = [];
                const benar = [];

                ids.forEach(id => {
                    const el = document.getElementById(id);
                    if (!el) return;

                    const value = (el.value || "").trim();

                    if (!value) {
                        kosong.push(id);
                        setInputState(el, "empty");
                        return;
                    }

                    if (cekKhusus(id, value)) {
                        benar.push(id);
                        setInputState(el, "correct");
                    } else {
                        salah.push(id);
                        setInputState(el, "wrong");
                    }
                });

                return { kosong, salah, benar };
            }

            cekSoal1Btn?.addEventListener("click", function () {
                const { kosong, salah } = cekGroup(soal1Ids);

                if (kosong.length) {
                    setHasil(hasil1, "bad", `⚠️ Nomor 1 belum lengkap. Yang kosong: <b>${kosong.join(", ")}</b>.`);
                    lockSection(section2, soal2Ids, cekSoal2Btn, hasil2, "Soal nomor 2 akan terbuka jika nomor 1 sudah benar.");
                    lockSection(section3, soal3Ids, cekSoal3Btn, hasil3, "Soal nomor 3 akan terbuka jika nomor 2 sudah benar.");
                    return;
                }

                if (salah.length) {
                    setHasil(hasil1, "bad", `❌ Nomor 1 masih salah pada bagian: <b>${salah.join(", ")}</b>.`);
                    lockSection(section2, soal2Ids, cekSoal2Btn, hasil2, "Soal nomor 2 masih terkunci karena nomor 1 belum benar.");
                    lockSection(section3, soal3Ids, cekSoal3Btn, hasil3, "Soal nomor 3 akan terbuka jika nomor 2 sudah benar.");
                    return;
                }

                setHasil(hasil1, "ok", "✅ Jawaban nomor 1 benar semua. Soal nomor 2 sudah terbuka.");
                unlockSection(section2, soal2Ids, cekSoal2Btn, hasil2, "Silakan kerjakan soal nomor 2 lalu klik <b>Cek Jawaban No. 2</b>.");
            });

            cekSoal2Btn?.addEventListener("click", function () {
                const { kosong, salah } = cekGroup(soal2Ids);

                if (kosong.length) {
                    setHasil(hasil2, "bad", `⚠️ Nomor 2 belum lengkap. Yang kosong: <b>${kosong.join(", ")}</b>.`);
                    lockSection(section3, soal3Ids, cekSoal3Btn, hasil3, "Soal nomor 3 masih terkunci karena nomor 2 belum benar.");
                    return;
                }

                if (salah.length) {
                    setHasil(hasil2, "bad", `❌ Nomor 2 masih salah pada bagian: <b>${salah.join(", ")}</b>.`);
                    lockSection(section3, soal3Ids, cekSoal3Btn, hasil3, "Soal nomor 3 masih terkunci karena nomor 2 belum benar.");
                    return;
                }

                setHasil(hasil2, "ok", "✅ Jawaban nomor 2 benar semua. Soal nomor 3 sudah terbuka.");
                unlockSection(section3, soal3Ids, cekSoal3Btn, hasil3, "Silakan kerjakan soal nomor 3 lalu klik <b>Cek Jawaban No. 3</b>.");
            });

            cekSoal3Btn?.addEventListener("click", async function () {
                const { kosong, salah } = cekGroup(soal3Ids);

                if (kosong.length) {
                    setHasil(
                        hasil3,
                        "bad",
                        `⚠️ Nomor 3 belum lengkap. Yang kosong: <b>${kosong.join(", ")}</b>.`
                    );
                    return;
                }

                if (salah.length) {
                    setHasil(
                        hasil3,
                        "bad",
                        `❌ Nomor 3 masih salah pada bagian: <b>${salah.join(", ")}</b>.`
                    );
                    return;
                }

                setHasil(
                    hasil3,
                    "ok",
                    "✅ Semua jawaban nomor 3 benar. Latihan selesai. Menyimpan progress..."
                );

                const berhasilSimpan = await saveProgressMateri();

                if (berhasilSimpan) {
                    bukaQuizButton();

                    setHasil(
                        hasil3,
                        "ok",
                        "✅ Semua jawaban nomor 3 benar. Progress berhasil disimpan. Kuis sudah terbuka."
                    );
                } else {
                    setHasil(
                        hasil3,
                        "bad",
                        "✅ Jawaban benar, tetapi progress gagal disimpan. Silakan refresh halaman atau coba lagi."
                    );
                }
            });

            resetBtn?.addEventListener("click", function () {
                [...soal1Ids, ...soal2Ids, ...soal3Ids].forEach(id => {
                    const el = document.getElementById(id);
                    if (el) {
                        el.value = "";
                        el.classList.remove("is-correct", "is-wrong", "is-empty");
                    }
                });

                setHasil(
                    hasil1,
                    "",
                    "Kerjakan soal nomor 1 lalu klik <b>Cek Jawaban No. 1</b>."
                );

                lockSection(
                    section2,
                    soal2Ids,
                    cekSoal2Btn,
                    hasil2,
                    "Soal nomor 2 akan terbuka jika nomor 1 sudah benar."
                );

                lockSection(
                    section3,
                    soal3Ids,
                    cekSoal3Btn,
                    hasil3,
                    "Soal nomor 3 akan terbuka jika nomor 2 sudah benar."
                );
            });

            lockSection(
                section2,
                soal2Ids,
                cekSoal2Btn,
                hasil2,
                "Soal nomor 2 akan terbuka jika nomor 1 sudah benar."
            );

            lockSection(
                section3,
                soal3Ids,
                cekSoal3Btn,
                hasil3,
                "Soal nomor 3 akan terbuka jika nomor 2 sudah benar."
            );

            setHasil(
                hasil1,
                "",
                "Kerjakan soal nomor 1 lalu klik <b>Cek Jawaban No. 1</b>."
            );
        })();
    </script>

    <script>
        const data = [
            {
                f: "9x²",
                deg: "2",
                terms: "1 suku",
                lead: "9x²",
                coef: "9",
                explain: "Hanya ada satu suku, yaitu 9x². Pangkat tertinggi pada variabel x adalah 2, sehingga derajat fungsi ini adalah 2. Karena hanya memiliki satu suku, maka suku utamanya juga langsung 9x², dan koefisien utamanya adalah 9.",
                tips: [
                    "Fungsi ini hanya terdiri dari satu suku.",
                    "Pangkat tertinggi langsung menentukan derajat.",
                    "Koefisien utama diambil dari suku berpangkat tertinggi."
                ]
            },
            {
                f: "5x⁴ − 3x² + 8",
                deg: "4",
                terms: "3 suku",
                lead: "5x⁴",
                coef: "5",
                explain: "Fungsi ini memiliki tiga suku, yaitu 5x⁴, −3x², dan 8. Pangkat tertinggi adalah 4 pada suku 5x⁴, sehingga derajat fungsi adalah 4. Suku utama adalah 5x⁴, dan koefisien utamanya adalah 5.",
                tips: [
                    "Jumlah suku dihitung dari banyaknya bagian yang dipisahkan tanda + atau −.",
                    "Suku utama selalu suku dengan pangkat terbesar.",
                    "Konstanta 8 tidak memengaruhi derajat karena tidak mengandung variabel."
                ]
            },
            {
                f: "7x³ + x² − 4x + 2 − 6",
                deg: "3",
                terms: "5 suku",
                lead: "7x³",
                coef: "7",
                explain: "Fungsi ini memiliki lima suku: 7x³, x², −4x, 2, dan −6. Pangkat tertinggi muncul pada suku 7x³, yaitu 3. Oleh karena itu, derajat fungsi adalah 3, suku utamanya 7x³, dan koefisien utamanya 7.",
                tips: [
                    "Meskipun ada banyak suku, derajat tetap ditentukan oleh pangkat terbesar.",
                    "Suku konstanta seperti 2 dan −6 memiliki derajat 0.",
                    "Koefisien utama selalu melekat pada suku utama."
                ]
            }
        ];

        const btns = document.querySelectorAll(".poly-btn");

        const polyFormula = document.getElementById("polyFormula");
        const deg = document.getElementById("deg");
        const terms = document.getElementById("terms");
        const lead = document.getElementById("lead");
        const coef = document.getElementById("coef");
        const explain = document.getElementById("explain");
        const polyTips = document.getElementById("polyTips");

        function show(i) {
            const d = data[i];

            polyFormula.textContent = d.f;
            deg.textContent = d.deg;
            terms.textContent = d.terms;
            lead.textContent = d.lead;
            coef.textContent = d.coef;
            explain.textContent = d.explain;

            if (polyTips) {
                polyTips.innerHTML = d.tips.map(item => `<li>${item}</li>`).join("");
            }

            btns.forEach((btn, index) => {
                btn.classList.toggle("active", index === Number(i));
            });
        }

        btns.forEach((btn) => {
            btn.addEventListener("click", () => {
                show(btn.dataset.i);
            });
        });

        show(0);
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const canvas = document.getElementById("ciGraphCanvas");
            const ctx = canvas.getContext("2d");

            const range = document.getElementById("ciRangeX");
            const valX = document.getElementById("ciValX");
            const valFx = document.getElementById("ciValFx");
            const calcSub = document.getElementById("ciCalcSub");
            const activeText = document.getElementById("ciActivePointText");

            const buttons = document.querySelectorAll(".ci-point-btn");

            function f(x) {
                return x * x - 2 * x - 3;
            }

            function resizeCanvas() {
                const box = canvas.parentElement;
                canvas.width = box.clientWidth;
                canvas.height = box.clientHeight;
            }

            function mapX(x) {
                const minX = -3, maxX = 5;
                return ((x - minX) / (maxX - minX)) * canvas.width;
            }

            function mapY(y) {
                const minY = -6, maxY = 7;
                return canvas.height - ((y - minY) / (maxY - minY)) * canvas.height;
            }

            function drawGrid() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);

                ctx.strokeStyle = "#e5e7eb";
                ctx.lineWidth = 1;

                for (let x = -3; x <= 5; x++) {
                    ctx.beginPath();
                    ctx.moveTo(mapX(x), 0);
                    ctx.lineTo(mapX(x), canvas.height);
                    ctx.stroke();
                }

                for (let y = -6; y <= 7; y++) {
                    ctx.beginPath();
                    ctx.moveTo(0, mapY(y));
                    ctx.lineTo(canvas.width, mapY(y));
                    ctx.stroke();
                }

                // sumbu
                ctx.strokeStyle = "#111";
                ctx.lineWidth = 2;

                ctx.beginPath();
                ctx.moveTo(mapX(-3), mapY(0));
                ctx.lineTo(mapX(5), mapY(0));
                ctx.stroke();

                ctx.beginPath();
                ctx.moveTo(mapX(0), mapY(-6));
                ctx.lineTo(mapX(0), mapY(7));
                ctx.stroke();
            }

            function drawParabola() {
                ctx.beginPath();

                for (let px = 0; px <= canvas.width; px++) {
                    const x = -3 + (px / canvas.width) * 8;
                    const y = f(x);
                    const py = mapY(y);

                    if (px === 0) ctx.moveTo(px, py);
                    else ctx.lineTo(px, py);
                }

                ctx.strokeStyle = "#ec6fae";
                ctx.lineWidth = 4;
                ctx.stroke();
            }

            function drawPoint(x, active = false) {
                const y = f(x);
                const px = mapX(x);
                const py = mapY(y);

                ctx.beginPath();
                ctx.arc(px, py, active ? 7 : 5, 0, Math.PI * 2);
                ctx.fillStyle = active ? "#2563eb" : "#f28abb";
                ctx.fill();

                ctx.fillStyle = "#111";
                ctx.font = "12px Arial";
                ctx.fillText(`(${x}, ${y})`, px + 8, py - 8);
            }

            function updateUI(x) {
                const y = f(x);

                valX.textContent = x;
                valFx.textContent = y;
                calcSub.textContent = `f(${x}) = ${x}² − 2(${x}) − 3 = ${y}`;
                activeText.textContent = `Titik aktif: (${x}, ${y})`;

                buttons.forEach(btn => {
                    btn.classList.toggle("active", Number(btn.innerText.split(",")[0].replace("(", "")) === x);
                });
            }

            function drawAll(x) {
                resizeCanvas();
                drawGrid();
                drawParabola();

                [-2, -1, 0, 1, 2, 3, 4].forEach(px => {
                    drawPoint(px, px === x);
                });

                updateUI(x);
            }

            // slider
            range.addEventListener("input", function () {
                drawAll(Number(this.value));
            });

            // tombol titik
            buttons.forEach(btn => {
                btn.addEventListener("click", function () {
                    const x = Number(this.innerText.split(",")[0].replace("(", ""));
                    range.value = x;
                    drawAll(x);
                });
            });

            // resize
            window.addEventListener("resize", function () {
                drawAll(Number(range.value));
            });

            // INIT
            drawAll(Number(range.value));

        });
    </script>

    <script defer src="{{ asset('js/interaktif1c.js') }}"></script>
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