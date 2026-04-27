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
            border-radius: 28px;
            padding: 56px 26px 24px;
            margin-top: 42px;
            box-shadow: 0 8px 24px rgba(223, 125, 73, 0.10);
            overflow: visible;
            z-index: 1;
        }

        .custom-definisi::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.18), transparent 40%);
            pointer-events: none;
            border-radius: 28px;
        }

        .custom-label {
            position: absolute;
            top: -22px;
            left: 28px;
            background: #9bcc88;
            border: 2px solid #5ea34e;
            color: #233a1d;
            padding: 9px 30px;
            border-radius: 999px;
            font-weight: 800;
            font-size: 15px;
            line-height: 1;
            box-shadow: 0 6px 16px rgba(94, 163, 78, 0.18);
            z-index: 5;
            white-space: nowrap;
        }

        .definisi-title {
            font-size: 21px;
            font-weight: 800;
            color: #4f5b62;
            margin: 0 0 18px;
            position: relative;
            z-index: 2;
        }

        .definisi-rumus {
            background: #fff;
            border: 1.5px solid #f0d6c8;
            border-radius: 22px;
            padding: 18px 16px;
            margin-bottom: 18px;
            transition: transform 0.25s ease, box-shadow 0.25s ease, background 0.25s ease;
            cursor: pointer;
            position: relative;
            z-index: 2;
        }

        .definisi-rumus:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 24px rgba(0, 0, 0, 0.08);
            background: #fffdfa;
        }

        .definisi-rumus .rumus-box {
            margin: 0;
            border: none;
            background: transparent;
            padding: 10px;
        }

        .definisi-penjelasan {
            margin-top: 16px;
            background: #fffaf7;
            border: 1.5px solid #efc8b3;
            border-radius: 18px;
            padding: 16px 18px;
            color: #6a5550;
            line-height: 1.85;
            font-size: 15px;
            position: relative;
            z-index: 2;
        }

        .definisi-penjelasan b {
            color: #9a542c;
        }

        .definisi-highlight {
            margin-top: 14px;
            background: #fff3e8;
            border-left: 5px solid #df7d49;
            border-radius: 14px;
            padding: 12px 14px;
            color: #7b543d;
            font-size: 14px;
            line-height: 1.8;
            position: relative;
            z-index: 2;
        }

        .contoh-section {
            margin-top: 30px;
        }

        .contoh-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 120px;
            padding: 8px 18px;
            border-radius: 999px;
            background: var(--peach);
            border: 2px solid var(--peach-border);
            color: #5b2d22;
            font-size: 16px;
            font-weight: 800;
            letter-spacing: .3px;
            margin-bottom: 16px;
        }

        .contoh-card {
            background: #fff;
            border: 3px solid var(--green);
            border-radius: 25px;
            padding: 25px 25px 28px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, .03);
        }

        .contoh-title {
            font-size: 20px;
            font-weight: 800;
            color: #4a4a4a;
            margin-bottom: 16px;
        }

        .contoh-persamaan {
            text-align: center;
            margin: 8px 0 22px;
            font-size: 25px;
            color: #4e4e4e;
        }

        .contoh-text {
            font-size: 15px;
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
            margin-top: 28px;
        }

        .latihan-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 220px;
            padding: 8px 20px;
            border-radius: 999px;
            background: var(--gray-pill);
            color: #fff;
            font-size: 16px;
            font-weight: 800;
            letter-spacing: .4px;
            margin-bottom: 22px;
        }

        .latihan-card {
            background: #fff;
            border: 3px solid var(--blue);
            border-radius: 0;
            padding: 16px 14px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, .03);
            margin-bottom: 26px;
        }

        .latihan-card-title {
            font-size: 20px;
            font-weight: 800;
            color: #333;
            margin-bottom: 8px;
        }

        .latihan-persamaan {
            text-align: center;
            margin: 10px 0 14px;
            font-size: 20px;
            color: #333;
        }

        .latihan-item {
            background: #fbfdff;
            border: 1px solid #d9e8f2;
            border-radius: 14px;
            padding: 12px;
            margin-bottom: 16px;
        }

        .latihan-label {
            font-size: 15px;
            font-weight: 800;
            color: #333;
            margin-bottom: 6px;
        }

        .input-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        .input-jawaban {
            flex: 1 1 340px;
            min-width: 180px;
            border: 1.5px solid #d4dde5;
            background: #fff;
            color: #333;
            border-radius: 14px;
            padding: 8px 10px;
            font-size: 13px;
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
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 12px;
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

        .grafik-box {
            margin-top: 14px;
        }

        .grafik-board {
            position: relative;
            width: 100%;
            max-width: 760px;
            height: 430px;
            margin-top: 10px;
            border: 1.5px solid #cfe0ee;
            border-radius: 22px;
            background:
                repeating-linear-gradient(to right,
                    #edf3f8 0,
                    #edf3f8 1px,
                    transparent 1px,
                    transparent 58px),
                repeating-linear-gradient(to bottom,
                    #edf3f8 0,
                    #edf3f8 1px,
                    transparent 1px,
                    transparent 54px),
                #ffffff;
            overflow: hidden;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.5);
        }

        .grafik-label-top,
        .grafik-header-note {
            position: absolute;
            top: 14px;
            left: 16px;
            z-index: 6;
            font-size: 14px;
            color: #555;
            background: rgba(255, 255, 255, 0.93);
            padding: 6px 10px;
            border-radius: 10px;
            font-weight: 600;
        }

        .grafik-axis-x,
        .grafik-axis-y {
            position: absolute;
            background: #4b4b4b;
            z-index: 2;
        }

        .grafik-axis-x {
            left: 22px;
            right: 22px;
            top: 50%;
            height: 2px;
            transform: translateY(-50%);
        }

        .grafik-axis-y {
            top: 22px;
            bottom: 22px;
            left: 50%;
            width: 2px;
            transform: translateX(-50%);
        }

        .grafik-arrow-x,
        .grafik-arrow-y {
            position: absolute;
            width: 12px;
            height: 12px;
            border-top: 2px solid #4b4b4b;
            border-right: 2px solid #4b4b4b;
            z-index: 3;
        }

        .grafik-arrow-x {
            right: 23px;
            top: 50%;
            transform: translateY(-50%) rotate(45deg);
        }

        .grafik-arrow-y {
            left: 50%;
            top: 23px;
            transform: translateX(-50%) rotate(-45deg);
        }

        .grafik-tick-x,
        .grafik-tick-y {
            position: absolute;
            background: #4b4b4b;
            z-index: 3;
        }

        .grafik-tick-x {
            width: 2px;
            height: 12px;
            transform: translate(-50%, -50%);
        }

        .grafik-tick-y {
            width: 12px;
            height: 2px;
            transform: translate(-50%, -50%);
        }

        .grafik-number {
            position: absolute;
            z-index: 3;
            font-size: 12px;
            color: #666;
            user-select: none;
            line-height: 1;
            white-space: nowrap;
        }

        .grafik-number.x {
            transform: translateX(-50%);
            top: calc(50% + 14px);
        }

        .grafik-number.y {
            transform: translateY(-50%);
            left: calc(50% + 12px);
        }

        .grafik-click-point {
            position: absolute;
            width: 18px;
            height: 18px;
            border-radius: 999px;
            border: 2px solid #2d9cdb;
            background: #ffffff;
            z-index: 5;
            transform: translate(-50%, -50%);
            cursor: pointer;
            transition: transform 0.18s ease, background-color 0.18s ease, border-color 0.18s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }

        .grafik-click-point:hover {
            transform: translate(-50%, -50%) scale(1.08);
            background: #f4fbff;
        }

        .grafik-click-point.correct {
            background: #7fc46d;
            border-color: #4f9f40;
        }

        .grafik-click-point.wrong {
            background: #ef8f8a;
            border-color: #d25852;
        }

        .grafik-click-point.disabled {
            pointer-events: none;
        }

        .grafik-curve-layer {
            position: absolute;
            inset: 0;
            z-index: 4;
            pointer-events: none;
        }

        .grafik-feedback-mini {
            display: none;
            margin-top: 12px;
            border-radius: 14px;
            padding: 12px 14px;
            font-size: 14px;
            font-weight: 600;
            line-height: 1.7;
        }

        .grafik-feedback-mini.show {
            display: block;
        }

        .grafik-feedback-mini.success {
            background: #eef9ea;
            border: 1px solid #b9deb0;
            color: #2d6a31;
        }

        .grafik-feedback-mini.error {
            background: #fff1f0;
            border: 1px solid #f3b8b5;
            color: #b23b35;
        }

        .grafik-penjelasan {
            display: none;
            margin-top: 16px;
            background: #f4fbff;
            border: 1px solid #cfe2f2;
            border-radius: 16px;
            padding: 14px 16px;
            color: #43627d;
            line-height: 1.8;
        }

        .grafik-penjelasan.show {
            display: block;
        }

        .grafik-chip-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 12px;
        }

        .grafik-chip {
            background: #f7fbff;
            border: 1px solid #d7ebf8;
            color: #2d6996;
            border-radius: 999px;
            padding: 8px 12px;
            font-size: 13px;
            font-weight: 700;
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

            .custom-definisi {
                padding: 52px 16px 18px;
                border-radius: 22px;
                margin-top: 38px;
            }

            .custom-label {
                top: -18px;
                left: 18px;
                padding: 8px 22px;
                font-size: 13px;
            }

            .definisi-title {
                font-size: 18px;
                margin-top: 0;
            }

            .definisi-rumus {
                border-radius: 18px;
                padding: 14px 10px;
            }

            .definisi-penjelasan {
                font-size: 14px;
                padding: 14px;
            }

            .grafik-board {
                height: 360px;
            }

            .grafik-header-note,
            .grafik-label-top {
                font-size: 12px;
                padding: 5px 8px;
            }

            .grafik-click-point {
                width: 16px;
                height: 16px;
            }

            .grafik-number {
                font-size: 11px;
            }
        }
    </style>

    <style>
        .konsep-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
            margin-top: 22px;
            margin-bottom: 26px;
        }

        .konsep-card {
            background: linear-gradient(180deg, #fffdfb, #fff7f1);
            border: 2px solid #e7b08c;
            border-radius: 24px;
            padding: 18px 18px 16px;
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.04);
            cursor: pointer;
            transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
            overflow: hidden;
        }

        .konsep-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.08);
            border-color: #df7d49;
        }

        .konsep-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
        }

        .konsep-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 12px;
            border-radius: 999px;
            background: #9bcc88;
            border: 1.5px solid #5ea34e;
            color: #233a1d;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .3px;
            margin-bottom: 10px;
        }

        .konsep-title {
            font-size: 22px;
            font-weight: 800;
            line-height: 1.3;
            color: #4f5b62;
        }

        .konsep-arrow {
            width: 38px;
            height: 38px;
            flex: 0 0 38px;
            border-radius: 999px;
            background: #fff;
            border: 1.5px solid #ead0c1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #c86f3b;
            transition: transform 0.25s ease, background 0.25s ease;
        }

        .konsep-preview {
            margin-top: 14px;
            color: #76635a;
            line-height: 1.8;
            font-size: 15px;
        }

        .konsep-body {
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: max-height 0.45s ease, opacity 0.3s ease, margin-top 0.3s ease;
            margin-top: 0;
        }

        .konsep-card.active .konsep-body {
            max-height: 700px;
            opacity: 1;
            margin-top: 16px;
        }

        .konsep-card.active .konsep-arrow {
            transform: rotate(180deg);
            background: #fff8f3;
        }

        .konsep-card.active {
            border-color: #df7d49;
            box-shadow: 0 16px 30px rgba(223, 125, 73, 0.12);
        }

        .konsep-body p {
            margin: 10px 0;
            font-size: 16px;
            line-height: 1.85;
            color: #5d5d5d;
        }

        .konsep-highlight {
            margin-top: 10px;
            background: #fff3e8;
            border-left: 5px solid #df7d49;
            border-radius: 14px;
            padding: 12px 14px;
            color: #7b543d;
            font-size: 14px;
            line-height: 1.8;
        }

        .cara-box {
            background: #fff8ec;
            border: 1px solid #efd7a3;
            border-radius: 14px;
            padding: 12px 14px;
            color: #7a5a1f;
            line-height: 1.8;
            margin-bottom: 12px;
            font-size: 14px;
        }

        @media (max-width: 900px) {
            .konsep-grid {
                grid-template-columns: 1fr;
            }

            .konsep-title {
                font-size: 19px;
            }
        }

        .definisi-modern {
            position: relative;
            margin-top: 36px;
            padding: 32px 24px 24px;
            border-radius: 28px;
            background: linear-gradient(180deg, #fff7f2 0%, #ffe9de 100%);
            border: 2px solid #e59a72;
            box-shadow: 0 10px 28px rgba(223, 125, 73, 0.10);
            overflow: visible;
        }

        .definisi-badge {
            position: absolute;
            top: -16px;
            left: 24px;
            background: #8fcf7b;
            color: #1f3a1a;
            border: 2px solid #5ea34e;
            border-radius: 999px;
            padding: 8px 22px;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: .5px;
            box-shadow: 0 6px 16px rgba(94, 163, 78, 0.18);
        }

        .definisi-header {
            text-align: center;
            margin-bottom: 22px;
        }

        .definisi-header h3 {
            margin: 0 0 8px;
            font-size: 24px;
            font-weight: 800;
            color: #7a3f1f;
        }

        .definisi-header p {
            margin: 0;
            font-size: 16px;
            line-height: 1.7;
            color: #6b5a52;
        }

        .definisi-rumus-wrap {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 22px;
        }

        .definisi-rumus-card {
            background: #fffdfb;
            border: 1.5px solid #f0c9b1;
            border-radius: 22px;
            padding: 16px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.04);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .definisi-rumus-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 22px rgba(0, 0, 0, 0.07);
        }

        .rumus-label {
            text-align: center;
            font-size: 14px;
            font-weight: 800;
            color: #b45f32;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .definisi-rumus-card .rumus-box {
            margin: 0;
            background: #fff;
            border: 1px solid #f3ddd0;
        }

        .definisi-poin {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 20px;
        }

        .definisi-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            background: rgba(255, 255, 255, 0.75);
            border: 1px solid #f0ccb7;
            border-radius: 18px;
            padding: 14px 16px;
            color: #5f514b;
            line-height: 1.8;
            font-size: 15px;
        }

        .definisi-item .ikon {
            width: 30px;
            height: 30px;
            border-radius: 999px;
            background: #df7d49;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 800;
            flex: 0 0 30px;
            margin-top: 2px;
        }

        .definisi-kesimpulan {
            background: #fff3e8;
            border-left: 6px solid #df7d49;
            border-radius: 16px;
            padding: 14px 16px;
            color: #7b543d;
            font-size: 15px;
            line-height: 1.8;
        }

        @media (max-width: 768px) {
            .definisi-modern {
                padding: 28px 16px 18px;
                border-radius: 22px;
            }

            .definisi-badge {
                left: 16px;
                top: -14px;
                font-size: 12px;
                padding: 7px 18px;
            }

            .definisi-header h3 {
                font-size: 20px;
            }

            .definisi-rumus-wrap {
                grid-template-columns: 1fr;
            }

            .definisi-item {
                font-size: 14px;
                padding: 12px 14px;
            }
        }

        .info-card {
            border-radius: 22px;
            padding: 24px;
            margin-top: 20px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
        }

        /* CARD DEFINISI */
        .definisi-card {
            background: #fffaf4;
            border: 2px solid #e7b08c;
        }

        /* CARD STRATEGI */
        .strategi-card {
            background: #f4faff;
            border: 2px solid #9dc7e8;
        }

        /* BADGE */
        .info-badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 13px;
            margin-bottom: 10px;
            background: #9bcc88;
            border: 2px solid #5ea34e;
        }

        /* TITLE */
        .info-title {
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        /* GRID */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        /* MINI CARD */
        .info-mini-card {
            background: #fff;
            border-radius: 14px;
            padding: 14px;
        }

        /* LANGKAH */
        .langkah-cari-wrap {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .langkah-cari-card {
            background: #fff;
            border-radius: 14px;
            padding: 14px;
        }

        /* NOMOR */
        .langkah-cari-no {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #df7d49;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* CONTOH */
        .contoh-kecil-box {
            margin-top: 14px;
            background: #eef7ff;
            padding: 14px;
            border-radius: 14px;
        }

        /* TIP */
        .tip-box {
            margin-top: 10px;
            background: #eef9ea;
            padding: 10px;
            border-radius: 10px;
        }

        /* =========================
                                                                                   CARD TAMBAHAN MATERI
                                                                                ========================= */
        .info-card {
            position: relative;
            margin-top: 24px;
            padding: 24px 22px 22px;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 10px 26px rgba(0, 0, 0, 0.05);
        }

        .info-card::before {
            content: "";
            position: absolute;
            top: -42px;
            right: -42px;
            width: 150px;
            height: 150px;
            border-radius: 999px;
            opacity: .18;
            pointer-events: none;
        }

        .definisi-card {
            background: linear-gradient(180deg, #fffaf5 0%, #fff4ea 100%);
            border: 2px solid #ebb894;
        }

        .definisi-card::before {
            background: #f0b48f;
        }

        .strategi-card {
            background: linear-gradient(180deg, #f6fbff 0%, #eef8ff 100%);
            border: 2px solid #a9d0ec;
        }

        .strategi-card::before {
            background: #87c3eb;
        }

        .info-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 14px;
            position: relative;
            z-index: 2;
        }

        .info-icon {
            width: 54px;
            height: 54px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            background: rgba(255, 255, 255, 0.78);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.05);
            flex: 0 0 54px;
        }

        .info-badge {
            display: inline-block;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .9px;
            color: #7f5a47;
            background: rgba(255, 255, 255, .76);
            border: 1px solid rgba(0, 0, 0, .08);
            border-radius: 999px;
            padding: 5px 12px;
            margin-bottom: 8px;
        }

        .info-title {
            font-size: 26px;
            font-weight: 800;
            line-height: 1.25;
            color: #3c2d26;
            margin: 0;
        }

        .info-desc {
            font-size: 16px;
            line-height: 1.9;
            color: #5d5753;
            margin: 0 0 18px;
            position: relative;
            z-index: 2;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 18px;
            position: relative;
            z-index: 2;
        }

        .info-mini-card {
            background: rgba(255, 255, 255, .86);
            border: 1.5px solid rgba(0, 0, 0, .08);
            border-radius: 22px;
            padding: 16px;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .4);
        }

        .info-mini-title {
            font-size: 14px;
            font-weight: 800;
            color: #b06137;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .info-highlight {
            background: #fff8f1;
            border-left: 5px solid #df7d49;
            border-radius: 18px;
            padding: 14px 16px;
            color: #6c574d;
            line-height: 1.8;
            position: relative;
            z-index: 2;
        }

        /* =========================
                                                                                   LANGKAH CARI PEMBUAT NOL
                                                                                ========================= */
        .langkah-cari-wrap {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            margin-top: 10px;
            position: relative;
            z-index: 2;
        }

        .langkah-cari-card {
            background: rgba(255, 255, 255, .88);
            border-radius: 22px;
            padding: 18px 16px;
            border: 1.5px solid rgba(0, 0, 0, .08);
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.04);
            transition: transform .22s ease, box-shadow .22s ease;
        }

        .langkah-cari-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 22px rgba(0, 0, 0, 0.07);
        }

        .langkah-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .langkah-cari-no {
            width: 34px;
            height: 34px;
            border-radius: 999px;
            background: #df7d49;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            font-weight: 800;
            flex: 0 0 34px;
        }

        .langkah-cari-title {
            font-size: 18px;
            font-weight: 800;
            color: #355e9a;
            line-height: 1.3;
        }

        .langkah-cari-text {
            font-size: 14px;
            line-height: 1.8;
            color: #5e5e5e;
            margin-bottom: 12px;
        }

        .langkah-cari-tag {
            display: inline-block;
            background: #f5f8fb;
            border: 1px solid #dbe7ef;
            color: #58718a;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }

        /* =========================
                                                                                   CONTOH MINI + TIP
                                                                                ========================= */
        .contoh-mini {
            margin-top: 18px;
            background: rgba(255, 255, 255, .84);
            border: 1.5px solid #cae2f3;
            border-radius: 22px;
            padding: 18px;
            position: relative;
            z-index: 2;
        }

        .contoh-mini-title {
            font-size: 18px;
            font-weight: 800;
            color: #2d6996;
            margin-bottom: 12px;
        }

        .tip-box {
            margin-top: 14px;
            background: #eef9ea;
            border: 1px solid #b9deb0;
            color: #2d6a31;
            border-radius: 18px;
            padding: 14px 16px;
            font-size: 14px;
            line-height: 1.8;
            position: relative;
            z-index: 2;
        }

        /* =========================
                                                                                   RESPONSIVE
                                                                                ========================= */
        @media (max-width: 900px) {

            .info-grid,
            .langkah-cari-wrap {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .info-card {
                padding: 20px 16px 18px;
                border-radius: 22px;
            }

            .info-header {
                align-items: flex-start;
            }

            .info-icon {
                width: 46px;
                height: 46px;
                font-size: 22px;
                border-radius: 14px;
                flex: 0 0 46px;
            }

            .info-title {
                font-size: 21px;
            }

            .info-desc {
                font-size: 15px;
            }

            .info-mini-card,
            .langkah-cari-card,
            .contoh-mini {
                border-radius: 18px;
            }

            .langkah-cari-title {
                font-size: 17px;
            }

            .tip-box {
                border-radius: 14px;
                font-size: 13px;
            }
        }

        /* =========================
                                                                       STRATEGI INTERAKTIF
                                                                    ========================= */
        .clickable-card {
            cursor: pointer;
            user-select: none;
        }

        .clickable-card .langkah-header {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .langkah-cari-title-wrap {
            flex: 1;
        }

        .langkah-toggle-icon {
            width: 32px;
            height: 32px;
            flex: 0 0 32px;
            border-radius: 999px;
            background: #f3f8fc;
            border: 1px solid #dbe7ef;
            color: #58718a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 800;
            transition: transform .25s ease, background .25s ease;
        }

        .clickable-card.active .langkah-toggle-icon {
            transform: rotate(180deg);
            background: #eaf4fb;
        }

        .langkah-detail {
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: max-height .45s ease, opacity .3s ease, margin-top .3s ease;
            margin-top: 0;
        }

        .clickable-card.active .langkah-detail {
            max-height: 2000px;
            opacity: 1;
            margin-top: 16px;
        }

        .langkah-detail-title {
            font-size: 17px;
            font-weight: 800;
            color: #2d6996;
            margin-bottom: 10px;
        }

        .langkah-detail-text {
            font-size: 15px;
            color: #565656;
            line-height: 1.8;
            margin-bottom: 10px;
        }

        .langkah-step-box {
            background: #ffffff;
            border: 1px solid #dbe7ef;
            border-radius: 16px;
            padding: 14px 14px 10px;
            margin-bottom: 12px;
        }

        .langkah-step-title {
            font-size: 14px;
            font-weight: 800;
            color: #355e9a;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .hasil-akhir-box {
            background: #eef9ea;
            border: 1px solid #b9deb0;
            border-radius: 16px;
            padding: 14px 16px;
            color: #2d6a31;
            line-height: 1.8;
            margin-top: 10px;
        }

        .clickable-card.active {
            box-shadow: 0 14px 26px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .contoh-mini-title {
            font-size: 18px;
            font-weight: 800;
            color: #2d6996;
            margin-bottom: 12px;
        }

        /* =========================
                                                           METODE INTERAKTIF
                                                        ========================= */
        .metode-wrap {
            margin-top: 12px;
        }

        .metode-card {
            width: 100%;
            text-align: left;
            cursor: pointer;
            background: rgba(255, 255, 255, .88);
            appearance: none;
            -webkit-appearance: none;
            border: 1.5px solid rgba(0, 0, 0, .08);
        }

        .metode-card.active {
            border-color: #5fa8dc;
            box-shadow: 0 12px 22px rgba(45, 156, 219, 0.12);
            transform: translateY(-2px);
            background: #ffffff;
        }

        .metode-card .langkah-header {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .langkah-cari-title-wrap {
            flex: 1;
        }

        .metode-card .langkah-cari-text {
            margin-top: 6px;
            margin-bottom: 10px;
        }

        /* =========================
                                                           PANEL CONTOH BERSAMA
                                                        ========================= */
        .contoh-bersama-box {
            margin-top: 20px;
            background: rgba(255, 255, 255, .86);
            border: 1.5px solid #cae2f3;
            border-radius: 24px;
            padding: 20px 18px;
        }

        .contoh-bersama-head {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px 12px;
            margin-bottom: 14px;
        }

        .contoh-bersama-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 12px;
            border-radius: 999px;
            background: #eaf4fb;
            border: 1px solid #b9d8ee;
            color: #356b91;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .4px;
        }

        .contoh-bersama-title {
            font-size: 20px;
            font-weight: 800;
            color: #2d6996;
        }

        .contoh-panel {
            background: #f9fcff;
            border: 1px solid #d9e9f5;
            border-radius: 18px;
            padding: 16px;
        }

        .contoh-panel-text {
            font-size: 15px;
            color: #555;
            line-height: 1.8;
            margin-bottom: 10px;
        }

        .contoh-step-box {
            background: #fff;
            border: 1px solid #dbe7ef;
            border-radius: 16px;
            padding: 14px 14px 10px;
            margin-bottom: 12px;
        }

        .contoh-step-title {
            font-size: 14px;
            font-weight: 800;
            color: #355e9a;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .contoh-hasil-box {
            background: #eef9ea;
            border: 1px solid #b9deb0;
            border-radius: 16px;
            padding: 14px 16px;
            color: #2d6a31;
            line-height: 1.8;
            margin-top: 12px;
        }

        .faktor-flow-grid {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 16px;
            align-items: center;
        }

        .faktor-arrow-btn {
            border: none;
            background: #fff3e8;
            border: 2px solid #df7d49;
            color: #9a542c;
            border-radius: 999px;
            padding: 12px 16px;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            font-weight: 700;
            transition: .2s ease;
        }

        .faktor-arrow-btn:hover {
            transform: translateY(-2px);
            background: #ffe9db;
        }

        .arrow-icon {
            font-size: 24px;
            line-height: 1;
        }

        .arrow-text {
            font-size: 13px;
            white-space: nowrap;
        }

        .cara-faktor-box {
            margin-top: 18px;
            background: rgba(255, 255, 255, 0.75);
            border: 1.5px solid #efcfba;
            border-radius: 18px;
            padding: 16px 18px;
        }

        .cara-faktor-title {
            font-size: 16px;
            font-weight: 800;
            color: #9a542c;
            margin-bottom: 10px;
        }

        .cara-faktor-text {
            font-size: 15px;
            line-height: 1.8;
            color: #6b5a52;
            margin-bottom: 10px;
        }

        .cara-faktor-list {
            margin: 8px 0 12px 20px;
            color: #6b5a52;
            line-height: 1.8;
            font-size: 15px;
        }

        @media (max-width: 768px) {
            .faktor-flow-grid {
                grid-template-columns: 1fr;
            }

            .faktor-arrow-btn {
                flex-direction: row;
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .contoh-bersama-box {
                padding: 16px 14px;
                border-radius: 18px;
            }

            .contoh-bersama-title {
                font-size: 18px;
            }

            .contoh-panel {
                padding: 14px;
                border-radius: 16px;
            }
        }
    </style>

    <style>
        .latihan-item.locked {
            opacity: 0.55;
            pointer-events: none;
            filter: grayscale(0.12);
            user-select: none;
        }

        .latihan-item.locked .input-jawaban,
        .latihan-item.locked .btn-cek,
        .latihan-item.locked button {
            pointer-events: none;
            cursor: not-allowed;
        }

        .lock-note {
            display: none;
            margin-bottom: 12px;
            background: #fff8ec;
            border: 1px solid #efd7a3;
            color: #7a5a1f;
            border-radius: 12px;
            padding: 10px 12px;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.7;
        }

        .latihan-item.locked .lock-note {
            display: block;
        }
    </style>

    <style>
        .materi-lanjutan.hidden {
            display: none;
        }

        .materi-terkunci-note {
            margin-top: 16px;
            margin-bottom: 18px;
            background: #fff8ec;
            border: 1px solid #efd7a3;
            color: #7a5a1f;
            border-radius: 14px;
            padding: 14px 16px;
            font-size: 15px;
            line-height: 1.8;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .03);
        }

        @media (max-width: 768px) {
            .materi-terkunci-note {
                font-size: 14px;
                padding: 12px 14px;
                border-radius: 12px;
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
            Pada materi sebelumnya, kamu telah mempelajari Teorema Faktor, yaitu prinsip penting yang
            menghubungkan antara pembuat nol suatu fungsi polinomial dengan faktornya. Teorema tersebut
            menyatakan bahwa:
        </p>

        <div class="card card-eksplorasi">
            <div class="title-box blue">🧭 Eksplorasi</div>

            <div class="eksplorasi-text">
                Perhatikan fungsi polinomial berikut:
            </div>

            <div class="rumus-box">
                $$P(x)=x^2-5x+6$$
            </div>

            <div class="eksplorasi-text">
                Untuk menemukan <b>pembuat nol</b>, kita mencari nilai <b>$x$</b> yang membuat
                nilai fungsi menjadi <b>$0$</b>.
            </div>

            <div class="eksplorasi-highlight">
                Jika <b>$P(x)=0$</b>, maka nilai <b>$x$</b> tersebut disebut sebagai
                <b>pembuat nol</b> dari polinomial.
            </div>

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

                <div id="penjelasanEks1" class="eksplorasi-penjelasan" style="display:none;">
                    <b>Penjelasan:</b><br>
                    Persamaan dibuat nol:
                    $$x^2-5x+6=0$$

                    Faktorkan:
                    $$(x-2)(x-3)=0$$

                    Maka:
                    $$x-2=0 \Rightarrow x=2$$
                    $$x-3=0 \Rightarrow x=3$$

                    Jadi, pembuat nolnya adalah:
                    $$x=2 \text{ dan } x=3$$
                </div>
            </div>

            <div class="eksplorasi-question">
                <div class="eksplorasi-question-title">
                    2. Makna dari nilai $x=2$ dan $x=3$ adalah ...
                </div>

                <div class="opsi-row">
                    <button type="button" class="opsi-btn"
                        onclick="cekOpsiEksplorasi(this, true, 'fbEks2', 'penjelasanEks2')">
                        Nilai fungsi menjadi 0
                    </button>

                    <button type="button" class="opsi-btn"
                        onclick="cekOpsiEksplorasi(this, false, 'fbEks2', 'penjelasanEks2')">
                        Nilai fungsi selalu positif
                    </button>

                    <button type="button" class="opsi-btn"
                        onclick="cekOpsiEksplorasi(this, false, 'fbEks2', 'penjelasanEks2')">
                        Nilai fungsi tidak dapat dihitung
                    </button>
                </div>

                <div id="fbEks2" class="eksplorasi-feedback"></div>

                <div id="penjelasanEks2" class="eksplorasi-penjelasan" style="display:none;">
                    <b>Penjelasan:</b><br>
                    Karena $x=2$ dan $x=3$ membuat:
                    $$P(x)=0$$

                    maka keduanya disebut <b>pembuat nol</b> dari polinomial
                    $$P(x)=x^2-5x+6$$

                    Artinya, saat nilai $x$ diganti dengan 2 atau 3, hasil fungsi menjadi 0.
                </div>
            </div>

          
        </div>

        <div id="materiLanjutan" class="materi-lanjutan hidden">

            <div class="teorema-box">
                Jika $P(c)=0$, maka $(x-c)$ adalah faktor dari $P(x)$
            </div>

            <!-- DEFINISI FAKTOR -->
            <div class="info-card definisi-card">
                <div class="info-header">
                    <div>
                        <div class="info-title">Apa itu Faktor Polinomial?</div>
                    </div>
                </div>

                <p class="info-desc">
                    Faktor polinomial adalah bentuk aljabar yang jika dikalikan akan
                    menghasilkan polinomial semula.
                </p>

                <div class="info-grid faktor-flow-grid">
                    <div class="info-mini-card">
                        <div class="info-mini-title">Bentuk awal</div>
                        <div class="rumus-box">
                            $$x^2 - x - 2$$
                        </div>
                    </div>

                    <button type="button" class="faktor-arrow-btn" onclick="toggleCaraFaktor(this)">
                        <span class="arrow-icon">→</span>
                        <span class="arrow-text">Lihat cara</span>
                    </button>

                    <div class="info-mini-card">
                        <div class="info-mini-title">Bentuk faktor</div>
                        <div class="rumus-box">
                            $$(x-2)(x+1)$$
                        </div>
                    </div>
                </div>

                <div id="caraFaktorBox" class="cara-faktor-box" style="display: none;">
                    <div class="cara-faktor-title">Cara mendapatkan faktor</div>

                    <p class="cara-faktor-text">
                        Cari <b>dua bilangan</b> yang:
                    </p>

                    <ul class="cara-faktor-list">
                        <li>hasil kalinya = <b>$-2$</b></li>
                        <li>jumlahnya = <b>$-1$</b></li>
                    </ul>

                    <div class="rumus-box">
                        $$-2 \text{ dan } 1$$
                    </div>

                    <p class="cara-faktor-text">
                        Maka:
                    </p>

                    <div class="rumus-box">
                        $$x^2 - x - 2 = (x-2)(x+1)$$
                    </div>
                </div>
            </div>

            <div class="konsep-grid">
                <div class="konsep-card" onclick="toggleKonsep(this)">
                    <div class="konsep-head">
                        <div>
                            <div class="konsep-badge">KONSEP 1</div>
                            <div class="konsep-title">Pembuat Nol (Akar) Polinomial</div>
                        </div>
                        <div class="konsep-arrow">⌄</div>
                    </div>

                    <div class="konsep-preview">
                        Klik untuk melihat penjelasan tentang pembuat nol polinomial.
                    </div>

                    <div class="konsep-body">
                        <p>Pembuat nol suatu polinomial adalah nilai $x$ yang membuat nilai polinomial sama dengan nol.</p>

                        <div class="rumus-box">
                            $$P(x)=0$$
                        </div>

                        <p>
                            Jika suatu polinomial memiliki faktor $(x-a)$, maka saat $x=a$, nilai polinomial menjadi nol.
                            Karena itu, grafik akan memotong sumbu-$x$ di titik yang sesuai.
                        </p>

                        <div class="konsep-highlight">
                            <b>Intinya:</b> pembuat nol menunjukkan di mana grafik menyentuh atau memotong sumbu-$x$.
                        </div>
                    </div>
                </div>

                <div class="konsep-card" onclick="toggleKonsep(this)">
                    <div class="konsep-head">
                        <div>
                            <div class="konsep-badge">KONSEP 2</div>
                            <div class="konsep-title">Hubungan Faktor dengan Grafik</div>
                        </div>
                        <div class="konsep-arrow">⌄</div>
                    </div>

                    <div class="konsep-preview">
                        Klik untuk melihat hubungan antara faktor dan titik potong grafik.
                    </div>

                    <div class="konsep-body">
                        <p>Sifat hasil kali nol menyatakan bahwa:</p>

                        <div class="rumus-box">
                            $$A \cdot B = 0 \iff A = 0 \text{ atau } B = 0$$
                        </div>

                        <p>Jika polinomial ditulis dalam bentuk faktor:</p>

                        <div class="rumus-box">
                            $$P(x)=(x-a)(x-b)(x-c)$$
                        </div>

                        <p>maka titik potong grafik dengan sumbu-$x$ adalah:</p>

                        <div class="rumus-box">
                            $$(a,0), (b,0), (c,0)$$
                        </div>

                        <div class="konsep-highlight">
                            <b>Intinya:</b> setiap faktor linear memberi tahu letak titik potong grafik dengan sumbu-$x$.
                        </div>
                    </div>
                </div>
            </div>

            {{-- DEFINISI --}}
            <div class="definisi-modern">
                <div class="definisi-badge">DEFINISI</div>

                <div class="definisi-header">
                    <h3>Hubungan Faktor dengan Grafik</h3>
                    <p>
                        Bentuk faktor membantu kita langsung melihat titik potong grafik dengan sumbu-$x$.
                    </p>
                </div>

                <div class="definisi-rumus-wrap">
                    <div class="definisi-rumus-card">
                        <div class="rumus-label">Bentuk faktor</div>
                        <div class="rumus-box">
                            $$P(x)=(x-a)(x-b)(x-c)$$
                        </div>
                    </div>

                    <div class="definisi-rumus-card">
                        <div class="rumus-label">Titik potong sumbu-$x$</div>
                        <div class="rumus-box">
                            $$(a,0),\ (b,0),\ (c,0)$$
                        </div>
                    </div>
                </div>

                <div class="definisi-poin">
                    <div class="definisi-item">
                        <span class="ikon">1</span>
                        <div>
                            Jika ada faktor <b>$(x-a)$</b>, maka saat <b>$x=a$</b>, nilai fungsi sama dengan <b>0</b>.
                        </div>
                    </div>

                    <div class="definisi-item">
                        <span class="ikon">2</span>
                        <div>
                            Artinya grafik memotong sumbu-$x$ di titik <b>$(a,0)$</b>.
                        </div>
                    </div>

                    <div class="definisi-item">
                        <span class="ikon">3</span>
                        <div>
                            Hal yang sama berlaku untuk faktor <b>$(x-b)$</b> dan <b>$(x-c)$</b>.
                        </div>
                    </div>
                </div>

                <div class="definisi-kesimpulan">
                    <b>Intinya:</b> setiap faktor linear menunjukkan letak titik potong grafik dengan sumbu-$x$.
                </div>
            </div>

            <!-- CARA MENCARI PEMBUAT NOL -->
            <div class="info-card strategi-card">
                <div class="info-header">
                    <div>
                        <div class="info-title">Cara Mencari Pembuat Nol</div>
                    </div>
                </div>

                <p class="info-desc">
                    Pembuat nol adalah nilai $x$ yang membuat fungsi bernilai nol,
                    yaitu saat $P(x)=0$. Klik salah satu metode di bawah ini untuk
                    melihat contoh pengerjaannya.
                </p>

                <div class="langkah-cari-wrap metode-wrap">

                    <!-- METODE 1 -->
                    <button type="button" class="langkah-cari-card metode-card" onclick="showMetode('faktorisasi', this)">
                        <div class="langkah-header">
                            <div class="langkah-cari-no">1</div>
                            <div class="langkah-cari-title-wrap">
                                <div class="langkah-cari-title">Faktorisasi</div>
                                <div class="langkah-cari-text">
                                    Ubah polinomial ke bentuk faktor, lalu gunakan sifat hasil kali nol.
                                </div>
                                <div class="langkah-cari-tag">paling sering digunakan</div>
                            </div>
                        </div>
                    </button>

                    <!-- METODE 2 -->
                    <button type="button" class="langkah-cari-card metode-card" onclick="showMetode('substitusi', this)">
                        <div class="langkah-header">
                            <div class="langkah-cari-no">2</div>
                            <div class="langkah-cari-title-wrap">
                                <div class="langkah-cari-title">Substitusi</div>
                                <div class="langkah-cari-text">
                                    Coba nilai sederhana seperti $1$, $2$, atau $-1$ sampai hasilnya nol.
                                </div>
                                <div class="langkah-cari-tag">cara cepat</div>
                            </div>
                        </div>
                    </button>

                    <!-- METODE 3 -->
                    <button type="button" class="langkah-cari-card metode-card" onclick="showMetode('sintetik', this)">
                        <div class="langkah-header">
                            <div class="langkah-cari-no">3</div>
                            <div class="langkah-cari-title-wrap">
                                <div class="langkah-cari-title">Pembagian Sintetik</div>
                                <div class="langkah-cari-text">
                                    Digunakan untuk polinomial derajat tinggi agar lebih sistematis.
                                </div>
                                <div class="langkah-cari-tag">opsional</div>
                            </div>
                        </div>
                    </button>
                </div>

                <!-- PANEL CONTOH BERSAMA -->
                <div class="contoh-bersama-box" id="contohBersamaBox" style="display: none;">
                    <div class="contoh-bersama-head">
                        <div class="contoh-bersama-badge" id="metodeBadge"></div>
                        <div class="contoh-bersama-title" id="metodeTitle"></div>
                    </div>

                    <div id="metodeContent">
                        <!-- isi akan dimasukkan JS -->
                    </div>
                </div>
            </div>

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

            <div class="latihan-section">
                <div class="latihan-badge">MARI MENCOBA</div>

                <div class="latihan-card">
                    <div class="latihan-card-title">Diberikan fungsi polinomial berikut:</div>

                    <div class="latihan-persamaan">
                        $$f(x)=x^4-x^3-7x^2+x+6$$
                    </div>

                    <div class="latihan-item" id="mariItem1">
                        <div class="latihan-label">1. Pembuat nol</div>

                        <div class="cara-box">
                            <b>Cara mengerjakan:</b><br>
                            Cari nilai $x$ yang membuat fungsi bernilai nol. Kamu bisa mencoba
                            beberapa nilai $x$ yang mungkin sampai hasilnya $0$.
                        </div>

                        <div class="input-row">
                            <input id="m1" class="input-jawaban" placeholder="Masukkan semua pembuat nol">
                            <button class="btn-cek" onclick="cekMari(1)">Cek Jawaban</button>
                        </div>
                        <div id="fb1" class="feedback-box"></div>

                        <div id="step1" class="penjelasan-wrap">
                            <div class="langkah-step">
                                <div class="step-head">Penjelasan</div>
                                <p>
                                    Pembuat nol adalah nilai $x$ yang menyebabkan nilai fungsi sama dengan nol.
                                    Jadi, setiap nilai $x$ yang membuat $f(x)=0$ termasuk pembuat nol fungsi ini.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="latihan-item" id="mariItem2">
                        <div class="latihan-label">2. Pemfaktoran</div>

                        <div class="cara-box">
                            <b>Cara mengerjakan:</b><br>
                            Gunakan pembuat nol yang sudah ditemukan. Setiap pembuat nol
                            diubah menjadi faktor, lalu tulis dalam bentuk perkalian.
                        </div>

                        <div class="input-row">
                            <input id="m2" class="input-jawaban" placeholder="Masukkan bentuk pemfaktoran">
                            <button class="btn-cek" onclick="cekMari(2)">Cek Jawaban</button>
                        </div>
                        <div id="fb2" class="feedback-box"></div>

                        <div id="step2" class="penjelasan-wrap">
                            <div class="langkah-step">
                                <div class="step-head">Penjelasan</div>
                                <p>
                                    Jika suatu nilai $x=a$ merupakan pembuat nol, maka fungsi mempunyai faktor
                                    $(x-a)$. Karena itu, semua pembuat nol dapat diubah menjadi faktor-faktor linear.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="latihan-item" id="mariItem3">
                        <div class="latihan-label">3. Titik potong sumbu-x</div>

                        <div class="cara-box">
                            <b>Cara mengerjakan:</b><br>
                            Titik potong sumbu-$x$ berasal dari pembuat nol. Tulis setiap
                            nilai itu dalam bentuk titik $(x,0)$.
                        </div>

                        <div class="input-row">
                            <input id="m3" class="input-jawaban" placeholder="Masukkan titik potong sumbu-x">
                            <button class="btn-cek" onclick="cekMari(3)">Cek Jawaban</button>
                        </div>
                        <div id="fb3" class="feedback-box"></div>

                        <div id="step3" class="penjelasan-wrap">
                            <div class="langkah-step">
                                <div class="step-head">Penjelasan</div>
                                <p>
                                    Grafik memotong sumbu-$x$ saat nilai $y=0$. Karena pada sumbu-$x$ nilai
                                    ordinat selalu nol, maka pembuat nol langsung ditulis menjadi titik
                                    dengan bentuk $(x,0)$.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="latihan-item" id="mariItem4">
                        <div class="latihan-label">4. Titik potong sumbu-y</div>

                        <div class="cara-box">
                            <b>Cara mengerjakan:</b><br>
                            Ganti $x$ dengan 0 pada fungsi. Hasil yang diperoleh menjadi
                            titik potong sumbu-$y$.
                        </div>

                        <div class="input-row">
                            <input id="m4" class="input-jawaban" placeholder="Masukkan titik potong sumbu-y">
                            <button class="btn-cek" onclick="cekMari(4)">Cek Jawaban</button>
                        </div>
                        <div id="fb4" class="feedback-box"></div>

                        <div id="step4" class="penjelasan-wrap">
                            <div class="langkah-step">
                                <div class="step-head">Penjelasan</div>
                                <p>
                                    Titik potong sumbu-$y$ diperoleh saat $x=0$ karena semua titik pada sumbu-$y$
                                    memiliki absis nol. Jadi, cukup substitusikan $x=0$ ke fungsi, lalu tulis
                                    hasilnya sebagai titik koordinat.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="latihan-item" id="mariItem5">
                        <div class="latihan-label">5. Grafik</div>

                        <div class="cara-box">
                            <b>Cara mengerjakan:</b><br>
                            Gunakan titik potong sumbu-$x$ dan sumbu-$y$ yang sudah kamu
                            dapatkan. Setelah itu, pilih titik yang benar pada grafik.
                        </div>

                        <div class="grafik-box">
                            <div id="grafik-mc4" class="graph-placeholder" style="min-height:430px;">
                                Grafik akan aktif setelah nomor 1–4 benar semua.
                            </div>

                            <div id="grafikFeedback" class="grafik-feedback-mini"></div>

                            <div id="grafikPenjelasan" class="grafik-penjelasan">
                                <b>Penjelasan:</b><br>
                                Grafik fungsi dapat dibaca dari titik-titik pentingnya.
                                Titik potong sumbu-$x$ berasal dari pembuat nol, sedangkan
                                titik potong sumbu-$y$ didapat saat $x=0$. Setelah titik yang
                                benar ditemukan, kurva grafik akan terlihat sehingga hubungan
                                antara fungsi, faktor, dan grafik menjadi lebih jelas.

                                <div class="grafik-chip-row">
                                    <div class="grafik-chip">Cari pembuat nol</div>
                                    <div class="grafik-chip">Tentukan titik x</div>
                                    <div class="grafik-chip">Cari titik y</div>
                                    <div class="grafik-chip">Lihat grafik</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="latihan-section">
                <div class="latihan-badge">LATIHAN</div>

                <div class="latihan-card">
                    <div class="latihan-card-title">1. Faktorkan polinomial berikut secara lengkap:</div>

                    <div class="latihan-persamaan">
                        $$P(x)=x^3-4x^2-11x+30$$
                    </div>

                    <div class="latihan-item" id="soal1Itema">
                        <div class="latihan-label">a. Tentukan salah satu pembuat nol</div>
                        <div class="input-row">
                            <input type="text" id="soal1a" class="input-jawaban" placeholder="Contoh: 2 atau x=2">
                            <button type="button" class="btn-cek" onclick="cekSoal1('a')">Cek Jawaban</button>
                        </div>
                        <div id="feedbackSoal1a" class="feedback-box"></div>
                    </div>

                    <div class="latihan-item" id="soal1Itemb">
                        <div class="latihan-label">b. Tentukan semua pembuat nol</div>
                        <div class="input-row">
                            <input type="text" id="soal1b" class="input-jawaban" placeholder="Contoh: 2, 5, -3">
                            <button type="button" class="btn-cek" onclick="cekSoal1('b')">Cek Jawaban</button>
                        </div>
                        <div id="feedbackSoal1b" class="feedback-box"></div>
                    </div>

                    <div class="latihan-item" id="soal1Itemc">
                        <div class="latihan-label">c. Tentukan bentuk pemfaktoran lengkap</div>
                        <div class="input-row">
                            <input type="text" id="soal1c" class="input-jawaban" placeholder="Contoh: (x-2)(x-5)(x+3)">
                            <button type="button" class="btn-cek" onclick="cekSoal1('c')">Cek Jawaban</button>
                        </div>
                        <div id="feedbackSoal1c" class="feedback-box"></div>
                    </div>

                    <div id="penjelasanSoal1" class="penjelasan-wrap">
                        ...
                    </div>

                    <hr style="margin:40px 0;">

                    <div class="latihan-card-title">2. Diberikan fungsi polinomial berikut:</div>

                    <div class="latihan-persamaan">
                        $$f(x)=x^4-3x^3-8x^2+12x+16$$
                    </div>

                    <div class="latihan-item" id="soal3Itema">
                        <div class="latihan-label">a. Pembuat nol</div>
                        <div class="input-row">
                            <input type="text" id="soal3a" class="input-jawaban">
                            <button class="btn-cek" onclick="cekSoal3('a')">Cek Jawaban</button>
                        </div>
                        <div id="feedbackSoal3a" class="feedback-box"></div>
                    </div>

                    <div class="latihan-item" id="soal3Itemb">
                        <div class="latihan-label">b. Pemfaktoran</div>
                        <div class="input-row">
                            <input type="text" id="soal3b" class="input-jawaban">
                            <button class="btn-cek" onclick="cekSoal3('b')">Cek Jawaban</button>
                        </div>
                        <div id="feedbackSoal3b" class="feedback-box"></div>
                    </div>

                    <div class="latihan-item" id="soal3Itemc">
                        <div class="latihan-label">c. Titik potong sumbu-x</div>
                        <div class="input-row">
                            <input type="text" id="soal3c" class="input-jawaban">
                            <button class="btn-cek" onclick="cekSoal3('c')">Cek Jawaban</button>
                        </div>
                        <div id="feedbackSoal3c" class="feedback-box"></div>
                    </div>

                    <div class="latihan-item" id="soal3Itemd">
                        <div class="latihan-label">d. Titik potong sumbu-y</div>
                        <div class="input-row">
                            <input type="text" id="soal3d" class="input-jawaban">
                            <button class="btn-cek" onclick="cekSoal3('d')">Cek Jawaban</button>
                        </div>
                        <div id="feedbackSoal3d" class="feedback-box"></div>
                    </div>

                    <div id="penjelasanSoal3" class="penjelasan-wrap">
                        ...
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        let mariGrafikAktif = false;
        let grafikMc4Solved = false;
        let activeMetode = null;

        const eksplorasiProgress = {
            1: false,
            2: false
        };

        const progress = {
            mari: { 1: false, 2: false, 3: false, 4: false },
            soal1: { a: false, b: false, c: false },
            soal3: { a: false, b: false, c: false, d: false }
        };

        const grafikMc4Config = {
            roots: [-2, -1, 1, 3],
            xmin: -6,
            xmax: 6,
            ymin: -8,
            ymax: 8
        };

        const metodeMateriMap = {
            faktorisasi: {
                badge: 'Metode 1',
                title: 'Contoh Faktorisasi',
                html: `
                        <div class="contoh-panel">
                            <p class="contoh-panel-text">
                                Tentukan pembuat nol dari:
                            </p>

                            <div class="rumus-box">
                                $$x^2 - 5x + 6 = 0$$
                            </div>

                            <div class="contoh-step-box">
                                <div class="contoh-step-title">Langkah 1</div>
                                <p>Cari dua bilangan yang hasil kalinya $6$ dan jumlahnya $-5$.</p>
                                <div class="rumus-box">
                                    $$-2 \\text{ dan } -3$$
                                </div>
                            </div>

                            <div class="contoh-step-box">
                                <div class="contoh-step-title">Langkah 2</div>
                                <p>Faktorkan bentuk kuadratnya.</p>
                                <div class="rumus-box">
                                    $$(x-2)(x-3)=0$$
                                </div>
                            </div>

                            <div class="contoh-step-box">
                                <div class="contoh-step-title">Langkah 3</div>
                                <p>Gunakan sifat hasil kali nol.</p>
                                <div class="rumus-box">
                                    $$x-2=0 \\quad \\text{atau} \\quad x-3=0$$
                                </div>
                                <div class="rumus-box">
                                    $$x=2 \\quad \\text{atau} \\quad x=3$$
                                </div>
                            </div>

                            <div class="contoh-hasil-box">
                                <b>Jadi, pembuat nolnya adalah:</b>
                                <div class="rumus-box">
                                    $$x=2 \\text{ dan } x=3$$
                                </div>
                            </div>
                        </div>
                    `
            },

            substitusi: {
                badge: 'Metode 2',
                title: 'Contoh Substitusi',
                html: `
                        <div class="contoh-panel">
                            <p class="contoh-panel-text">
                                Tentukan pembuat nol dari:
                            </p>

                            <div class="rumus-box">
                                $$P(x)=x^2-5x+6$$
                            </div>

                            <div class="contoh-step-box">
                                <div class="contoh-step-title">Coba x = 1</div>
                                <div class="rumus-box">
                                    $$P(1)=1^2-5(1)+6=1-5+6=2$$
                                </div>
                                <p>Karena hasilnya bukan $0$, maka $x=1$ bukan pembuat nol.</p>
                            </div>

                            <div class="contoh-step-box">
                                <div class="contoh-step-title">Coba x = 2</div>
                                <div class="rumus-box">
                                    $$P(2)=2^2-5(2)+6=4-10+6=0$$
                                </div>
                                <p>Karena hasilnya $0$, maka $x=2$ adalah pembuat nol.</p>
                            </div>

                            <div class="contoh-step-box">
                                <div class="contoh-step-title">Coba x = 3</div>
                                <div class="rumus-box">
                                    $$P(3)=3^2-5(3)+6=9-15+6=0$$
                                </div>
                                <p>Karena hasilnya $0$, maka $x=3$ adalah pembuat nol.</p>
                            </div>

                            <div class="contoh-hasil-box">
                                <b>Jadi, pembuat nolnya adalah:</b>
                                <div class="rumus-box">
                                    $$x=2 \\text{ dan } x=3$$
                                </div>
                            </div>
                        </div>
                    `
            },

            sintetik: {
                badge: 'Metode 3',
                title: 'Contoh Pembagian Sintetik',
                html: `
                        <div class="contoh-panel">
                            <p class="contoh-panel-text">
                                Tentukan salah satu pembuat nol dari:
                            </p>

                            <div class="rumus-box">
                                $$P(x)=x^3-4x^2-11x+30$$
                            </div>

                            <div class="contoh-step-box">
                                <div class="contoh-step-title">Langkah 1</div>
                                <p>Coba salah satu faktor dari $30$, misalnya $x=2$.</p>
                            </div>

                            <div class="contoh-step-box">
                                <div class="contoh-step-title">Langkah 2</div>
                                <p>Gunakan pembagian sintetik dengan koefisien:</p>
                                <div class="rumus-box">
                                    $$1 \\quad -4 \\quad -11 \\quad 30$$
                                </div>
                                <div class="rumus-box">
                                    $$\\begin{array}{r|rrrr}
                                    2 & 1 & -4 & -11 & 30 \\\\
                                      &   & 2 & -4 & -30 \\\\
                                    \\hline
                                      & 1 & -2 & -15 & 0
                                    \\end{array}$$
                                </div>
                            </div>

                            <div class="contoh-step-box">
                                <div class="contoh-step-title">Langkah 3</div>
                                <p>Karena sisanya $0$, maka $x=2$ adalah pembuat nol.</p>
                                <div class="rumus-box">
                                    $$(x-2) \\text{ adalah faktor dari } P(x)$$
                                </div>
                            </div>

                            <div class="contoh-hasil-box">
                                <b>Kesimpulan:</b>
                                <div class="rumus-box">
                                    $$x=2$$
                                </div>
                            </div>
                        </div>
                    `
            }
        };

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
            return (text || '')
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
            if (!el) return;
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

        function cekProgressEksplorasi() {
            const semuaSudahDijawab = eksplorasiProgress[1] && eksplorasiProgress[2];
            const materiLanjutan = document.getElementById('materiLanjutan');
            const note = document.getElementById('materiTerkunciNote');

            if (materiLanjutan) {
                materiLanjutan.classList.toggle('hidden', !semuaSudahDijawab);
            }

            if (note) {
                note.style.display = semuaSudahDijawab ? 'none' : 'block';
            }

            renderMathSafe();
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
                feedback.innerHTML = '❌ Jawaban belum tepat.';
                penjelasan.classList.remove('show');
            }

            if (feedbackId === 'fbEks1') {
                eksplorasiProgress[1] = true;
            }

            if (feedbackId === 'fbEks2') {
                eksplorasiProgress[2] = true;
            }

            cekProgressEksplorasi();
            renderMathSafe();
        }

        function setLockedState(itemId, locked) {
            const el = document.getElementById(itemId);
            if (!el) return;
            el.classList.toggle('locked', locked);
        }

        function updateMariLocks() {
            setLockedState('mariItem1', false);
            setLockedState('mariItem2', !progress.mari[1]);
            setLockedState('mariItem3', !progress.mari[2]);
            setLockedState('mariItem4', !progress.mari[3]);
            setLockedState('mariItem5', !progress.mari[4]);

            if (progress.mari[1] && progress.mari[2] && progress.mari[3] && progress.mari[4]) {
                aktifkanGrafikMari();
            } else {
                nonaktifkanGrafikMari();
            }
        }

        function updateSoal1Locks() {
            setLockedState('soal1Itema', false);
            setLockedState('soal1Itemb', !progress.soal1.a);
            setLockedState('soal1Itemc', !progress.soal1.b);
        }

        function updateSoal3Locks() {
            setLockedState('soal3Itema', false);
            setLockedState('soal3Itemb', !progress.soal3.a);
            setLockedState('soal3Itemc', !progress.soal3.b);
            setLockedState('soal3Itemd', !progress.soal3.c);
        }

        function cekProgressSoal1() {
            const selesai = progress.soal1.a && progress.soal1.b && progress.soal1.c;
            const status = document.getElementById('statusSoal1');
            const penjelasan = document.getElementById('penjelasanSoal1');

            if (status) status.classList.toggle('show', selesai);
            if (penjelasan) penjelasan.classList.toggle('show', selesai);

            updateSoal1Locks();
            renderMathSafe();
        }

        function cekProgressSoal3() {
            const selesai = progress.soal3.a && progress.soal3.b && progress.soal3.c && progress.soal3.d;
            const status = document.getElementById('statusSoal3');
            const penjelasan = document.getElementById('penjelasanSoal3');

            if (status) status.classList.toggle('show', selesai);
            if (penjelasan) penjelasan.classList.toggle('show', selesai);

            updateSoal3Locks();
            renderMathSafe();
        }

        function norm(t) {
            return (t || '').toLowerCase().replace(/\s/g, '');
        }

        function extractCoordinatePairs(text) {
            const cleaned = normalizeText(text);
            const matches = cleaned.match(/\(-?\d+(?:\.\d+)?,-?\d+(?:\.\d+)?\)/g);
            return matches ? matches.map(item => item.replace(/\s/g, '')) : [];
        }

        function fxMc4(x) {
            return (x ** 4) - (x ** 3) - 7 * (x ** 2) + x + 6;
        }

        function xToPercent(x) {
            const { xmin, xmax } = grafikMc4Config;
            return ((x - xmin) / (xmax - xmin)) * 100;
        }

        function yToPercent(y) {
            const { ymin, ymax } = grafikMc4Config;
            return ((ymax - y) / (ymax - ymin)) * 100;
        }

        function buildTicksX() {
            let html = '';
            for (let x = grafikMc4Config.xmin + 1; x <= grafikMc4Config.xmax - 1; x++) {
                html += `<div class="grafik-tick-x" style="left:${xToPercent(x)}%; top:${yToPercent(0)}%;"></div>`;
            }
            return html;
        }

        function buildTicksY() {
            let html = '';
            for (let y = grafikMc4Config.ymin + 1; y <= grafikMc4Config.ymax - 1; y++) {
                html += `<div class="grafik-tick-y" style="left:${xToPercent(0)}%; top:${yToPercent(y)}%;"></div>`;
            }
            return html;
        }

        function buildLabelsX() {
            let html = '';
            for (let x = grafikMc4Config.xmin + 1; x <= grafikMc4Config.xmax - 1; x++) {
                html += `<div class="grafik-number x" style="left:${xToPercent(x)}%;">${x}</div>`;
            }
            return html;
        }

        function buildLabelsY() {
            let html = '';
            for (let y = grafikMc4Config.ymax - 1; y >= grafikMc4Config.ymin + 1; y--) {
                html += `<div class="grafik-number y" style="top:${yToPercent(y)}%;">${y}</div>`;
            }
            return html;
        }

        function buildClickablePoints() {
            let html = '';
            for (let x = grafikMc4Config.xmin + 1; x <= grafikMc4Config.xmax - 1; x++) {
                html += `
                        <button
                            type="button"
                            class="grafik-click-point"
                            data-x="${x}"
                            style="left:${xToPercent(x)}%; top:${yToPercent(0)}%;"
                            onclick="cekTitikGrafikMc4(this)"
                            aria-label="Titik x ${x}">
                        </button>
                    `;
            }
            return html;
        }

        function buildGrafikInteraktifMc4() {
            return `
                    <div class="grafik-board">
                        <div class="grafik-header-note">Klik semua titik potong sumbu-x (y = 0).</div>

                        <div class="grafik-axis-x" style="top:${yToPercent(0)}%;"></div>
                        <div class="grafik-axis-y" style="left:${xToPercent(0)}%;"></div>
                        <div class="grafik-arrow-x" style="top:${yToPercent(0)}%;"></div>
                        <div class="grafik-arrow-y" style="left:${xToPercent(0)}%;"></div>

                        ${buildTicksX()}
                        ${buildTicksY()}
                        ${buildLabelsX()}
                        ${buildLabelsY()}

                        <svg id="grafikCurveLayer" class="grafik-curve-layer" viewBox="0 0 100 100" preserveAspectRatio="none"></svg>

                        ${buildClickablePoints()}
                    </div>
                `;
        }

        function aktifkanGrafikMari() {
            const box = document.getElementById('grafik-mc4');
            const feedback = document.getElementById('grafikFeedback');
            const penjelasan = document.getElementById('grafikPenjelasan');

            if (!box || mariGrafikAktif) return;

            mariGrafikAktif = true;
            grafikMc4Solved = false;

            box.className = '';
            box.style.minHeight = 'unset';
            box.style.padding = '0';
            box.style.background = 'transparent';
            box.style.border = 'none';
            box.innerHTML = buildGrafikInteraktifMc4();

            if (feedback) {
                feedback.className = 'grafik-feedback-mini';
                feedback.innerHTML = '';
            }

            if (penjelasan) {
                penjelasan.classList.remove('show');
            }
        }

        function nonaktifkanGrafikMari() {
            const box = document.getElementById('grafik-mc4');
            const feedback = document.getElementById('grafikFeedback');
            const penjelasan = document.getElementById('grafikPenjelasan');

            mariGrafikAktif = false;
            grafikMc4Solved = false;

            if (box) {
                box.className = 'graph-placeholder';
                box.style.minHeight = '430px';
                box.style.padding = '20px';
                box.style.background = 'linear-gradient(180deg, #fcfefb, #f7fbf5)';
                box.style.border = '2px dashed #cfdcc8';
                box.style.borderRadius = '20px';
                box.innerHTML = 'Grafik akan aktif setelah nomor 1–4 benar semua.';
            }

            if (feedback) {
                feedback.className = 'grafik-feedback-mini';
                feedback.innerHTML = '';
            }

            if (penjelasan) {
                penjelasan.classList.remove('show');
            }
        }

        function cekTitikGrafikMc4(btn) {
            if (!btn || grafikMc4Solved) return;

            const x = Number(btn.dataset.x);
            const benar = grafikMc4Config.roots.includes(x);
            const feedback = document.getElementById('grafikFeedback');

            btn.classList.remove('correct', 'wrong');
            btn.classList.add(benar ? 'correct' : 'wrong');
            btn.classList.add('disabled');

            if (feedback) {
                feedback.className = 'grafik-feedback-mini show ' + (benar ? 'success' : 'error');
                feedback.innerHTML = benar
                    ? `✅ Benar. Titik <b>(${x}, 0)</b> adalah titik potong dengan sumbu-x.`
                    : `❌ Titik <b>(${x}, 0)</b> bukan titik potong dengan sumbu-x.`;
            }

            cekSemuaTitikGrafikMc4();
        }

        function cekSemuaTitikGrafikMc4() {
            const benarDipilih = Array.from(document.querySelectorAll('.grafik-click-point.correct'))
                .map(el => Number(el.dataset.x))
                .sort((a, b) => a - b);

            const target = [...grafikMc4Config.roots].sort((a, b) => a - b);

            if (JSON.stringify(benarDipilih) === JSON.stringify(target)) {
                grafikMc4Solved = true;

                document.querySelectorAll('.grafik-click-point').forEach(btn => {
                    btn.classList.add('disabled');
                });

                tampilkanKurvaMc4();

                const feedback = document.getElementById('grafikFeedback');
                const penjelasan = document.getElementById('grafikPenjelasan');

                if (feedback) {
                    feedback.className = 'grafik-feedback-mini show success';
                    feedback.innerHTML = '🎉 Semua titik potong sumbu-x sudah benar. Kurva grafik ditampilkan.';
                }

                if (penjelasan) {
                    penjelasan.classList.add('show');
                }

                renderMathSafe();
            }
        }

        function tampilkanKurvaMc4() {
            const svg = document.getElementById('grafikCurveLayer');
            if (!svg) return;

            let d = '';
            let drawing = false;

            for (let i = 0; i <= 500; i++) {
                const x = grafikMc4Config.xmin + (i / 500) * (grafikMc4Config.xmax - grafikMc4Config.xmin);
                const y = fxMc4(x);

                if (y < grafikMc4Config.ymin || y > grafikMc4Config.ymax) {
                    drawing = false;
                    continue;
                }

                const sx = xToPercent(x);
                const sy = yToPercent(y);

                if (!drawing) {
                    d += `M ${sx} ${sy} `;
                    drawing = true;
                } else {
                    d += `L ${sx} ${sy} `;
                }
            }

            const rootDots = grafikMc4Config.roots.map(x => {
                return `<circle cx="${xToPercent(x)}" cy="${yToPercent(0)}" r="1.15" fill="#4f9f40"></circle>`;
            }).join('');

            const yDot = `<circle cx="${xToPercent(0)}" cy="${yToPercent(6)}" r="1.15" fill="#f2994a"></circle>`;

            svg.innerHTML = `
                    <path
                        d="${d}"
                        fill="none"
                        stroke="#2d9cdb"
                        stroke-width="0.7"
                        vector-effect="non-scaling-stroke"
                        stroke-linecap="round"
                        stroke-linejoin="round">
                    </path>
                    ${rootDots}
                    ${yDot}
                `;
        }

        function cekMari(no) {
            if (no === 2 && !progress.mari[1]) return;
            if (no === 3 && !progress.mari[2]) return;
            if (no === 4 && !progress.mari[3]) return;

            let val = norm(document.getElementById('m' + no).value);
            let benar = false;

            if (no == 1) {
                const user = splitAndClean(document.getElementById('m1').value).map(item => item.replace(/^x=/, ''));
                const answer = ['-2', '-1', '1', '3'];
                benar = sameSet(user, answer);
            }

            if (no == 2) {
                benar =
                    val.includes('(x+2)') &&
                    val.includes('(x+1)') &&
                    val.includes('(x-1)') &&
                    val.includes('(x-3)');
            }

            if (no == 3) {
                const user = extractCoordinatePairs(document.getElementById('m3').value);
                const answer = ['(-2,0)', '(-1,0)', '(1,0)', '(3,0)'];
                benar = sameSet(user, answer);
            }

            if (no == 4) {
                const validAnswers = ['(0,6)', '0,6'].map(item => normalizeText(item));
                benar = validAnswers.includes(normalizeText(document.getElementById('m4').value));
            }

            const fb = document.getElementById('fb' + no);
            const step = document.getElementById('step' + no);

            if (benar) {
                progress.mari[no] = true;
                if (fb) {
                    fb.className = 'feedback-box show success';
                    fb.innerHTML = '✅ Benar!';
                }
                if (step) step.classList.add('show');
            } else {
                progress.mari[no] = false;
                if (fb) {
                    fb.className = 'feedback-box show error';
                    fb.innerHTML = '❌ Salah, coba lagi sampai benar';
                }
                if (step) step.classList.remove('show');

                for (let i = no + 1; i <= 4; i++) {
                    progress.mari[i] = false;

                    const nextStep = document.getElementById('step' + i);
                    const nextFb = document.getElementById('fb' + i);

                    if (nextStep) nextStep.classList.remove('show');
                    if (nextFb) {
                        nextFb.className = 'feedback-box';
                        nextFb.innerHTML = '';
                    }
                }
            }

            updateMariLocks();
            renderMathSafe();
        }

        function cekSoal1(bagian) {
            if (bagian === 'b' && !progress.soal1.a) return;
            if (bagian === 'c' && !progress.soal1.b) return;

            const input = document.getElementById('soal1' + bagian)?.value.trim();

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
                    progress.soal1.b = false;
                    progress.soal1.c = false;

                    const fbB = document.getElementById('feedbackSoal1b');
                    const fbC = document.getElementById('feedbackSoal1c');
                    if (fbB) { fbB.className = 'feedback-box'; fbB.innerHTML = ''; }
                    if (fbC) { fbC.className = 'feedback-box'; fbC.innerHTML = ''; }
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
                    progress.soal1.c = false;

                    const fbC = document.getElementById('feedbackSoal1c');
                    if (fbC) { fbC.className = 'feedback-box'; fbC.innerHTML = ''; }
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
            if (bagian === 'b' && !progress.soal3.a) return;
            if (bagian === 'c' && !progress.soal3.b) return;
            if (bagian === 'd' && !progress.soal3.c) return;

            const input = document.getElementById('soal3' + bagian)?.value.trim();

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
                    progress.soal3.b = false;
                    progress.soal3.c = false;
                    progress.soal3.d = false;

                    ['b', 'c', 'd'].forEach(key => {
                        const el = document.getElementById('feedbackSoal3' + key);
                        if (el) {
                            el.className = 'feedback-box';
                            el.innerHTML = '';
                        }
                    });
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
                    progress.soal3.c = false;
                    progress.soal3.d = false;

                    ['c', 'd'].forEach(key => {
                        const el = document.getElementById('feedbackSoal3' + key);
                        if (el) {
                            el.className = 'feedback-box';
                            el.innerHTML = '';
                        }
                    });
                }
            }

            if (bagian === 'c') {
                const user = extractCoordinatePairs(input);
                const answer = ['(4,0)', '(2,0)', '(-2,0)', '(-1,0)'];

                if (sameSet(user, answer)) {
                    showFeedback('feedbackSoal3c', 'success', 'Benar. Titik potong dengan sumbu-x sudah tepat.');
                    progress.soal3.c = true;
                } else {
                    showFeedback('feedbackSoal3c', 'error', 'Masih belum tepat. Titik potong sumbu-x berasal dari pembuat nol.');
                    progress.soal3.c = false;
                    progress.soal3.d = false;

                    const fbD = document.getElementById('feedbackSoal3d');
                    if (fbD) {
                        fbD.className = 'feedback-box';
                        fbD.innerHTML = '';
                    }
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

        function showMetode(key, btn) {
            const data = metodeMateriMap[key];
            if (!data) return;

            const panel = document.getElementById('contohBersamaBox');
            const badge = document.getElementById('metodeBadge');
            const title = document.getElementById('metodeTitle');
            const content = document.getElementById('metodeContent');

            if (!panel || !badge || !title || !content) return;

            if (activeMetode === key) {
                document.querySelectorAll('.metode-card').forEach(card => {
                    card.classList.remove('active');
                });

                panel.style.display = 'none';
                badge.innerHTML = '';
                title.innerHTML = '';
                content.innerHTML = '';
                activeMetode = null;
                return;
            }

            document.querySelectorAll('.metode-card').forEach(card => {
                card.classList.remove('active');
            });

            btn.classList.add('active');

            badge.innerHTML = data.badge;
            title.innerHTML = data.title;
            content.innerHTML = data.html;

            panel.style.display = 'block';
            activeMetode = key;

            renderMathSafe();
        }

        function toggleKonsep(card) {
            card.classList.toggle('active');
            renderMathSafe();
        }

        function toggleCaraFaktor(btn) {
            const box = document.getElementById('caraFaktorBox');
            if (!box) return;

            if (box.style.display === 'none' || box.style.display === '') {
                box.style.display = 'block';
                btn.querySelector('.arrow-text').textContent = 'Sembunyikan cara';
            } else {
                box.style.display = 'none';
                btn.querySelector('.arrow-text').textContent = 'Lihat cara';
            }

            renderMathSafe();
        }

        window.addEventListener('load', function () {
            setTimeout(() => {
                updateMariLocks();
                updateSoal1Locks();
                updateSoal3Locks();
                cekProgressEksplorasi();

                const panel = document.getElementById('contohBersamaBox');
                if (panel) {
                    panel.style.display = 'none';
                }

                document.querySelectorAll('.metode-card').forEach(card => {
                    card.classList.remove('active');
                });

                activeMetode = null;
                renderMathSafe();
            }, 300);
        });
    </script>


@endsection

@section('nav')
    <a href="{{ route('teoremafaktor') }}" class="btn-nav prev-btn">
        ← Previous
    </a>

    <a href="{{ route('quiz.show', 4) }}" class="btn-nav next-btn">
        Next →
    </a>
@endsection