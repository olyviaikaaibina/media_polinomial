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
            margin-top: 30px;
        }

        .contoh-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 170px;
            padding: 14px 28px;
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
            padding: 28px 25px 25px;
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
            margin: 10px 0 24px;
            font-size: 25px;
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

        /* =========================
                               GRAFIK HTML CSS JS
                            ========================= */
        .grafik-board {
            position: relative;
            width: 100%;
            max-width: 720px;
            height: 420px;
            margin-top: 10px;
            border: 1.5px solid #d9e8f2;
            border-radius: 18px;
            background:
                repeating-linear-gradient(to right,
                    #eef3f7 0,
                    #eef3f7 1px,
                    transparent 1px,
                    transparent 52px),
                repeating-linear-gradient(to bottom,
                    #eef3f7 0,
                    #eef3f7 1px,
                    transparent 1px,
                    transparent 52px),
                #fff;
            overflow: hidden;
        }

        .grafik-label-top {
            position: absolute;
            top: 12px;
            left: 16px;
            font-size: 14px;
            color: #444;
            z-index: 3;
            background: rgba(255, 255, 255, 0.85);
            padding: 2px 6px;
            border-radius: 8px;
        }

        .grafik-axis-x,
        .grafik-axis-y {
            position: absolute;
            background: #444;
            z-index: 2;
        }

        .grafik-axis-x {
            height: 2px;
            left: 20px;
            right: 20px;
            top: 50%;
        }

        .grafik-axis-y {
            width: 2px;
            top: 20px;
            bottom: 20px;
            left: 50%;
        }

        .grafik-arrow-x,
        .grafik-arrow-y {
            position: absolute;
            width: 12px;
            height: 12px;
            border-top: 2px solid #444;
            border-right: 2px solid #444;
            z-index: 2;
        }

        .grafik-arrow-x {
            right: 21px;
            top: calc(50% - 6px);
            transform: rotate(45deg);
        }

        .grafik-arrow-y {
            left: calc(50% - 6px);
            top: 21px;
            transform: rotate(-45deg);
        }

        .grafik-tick-x,
        .grafik-tick-y {
            position: absolute;
            background: #444;
            z-index: 2;
        }

        .grafik-tick-x {
            width: 2px;
            height: 12px;
            top: calc(50% - 5px);
        }

        .grafik-tick-y {
            width: 12px;
            height: 2px;
            left: calc(50% - 5px);
        }

        .grafik-number {
            position: absolute;
            font-size: 12px;
            color: #555;
            z-index: 2;
            transform: translate(-50%, -50%);
        }

        .grafik-number.y {
            left: calc(50% - 18px);
        }

        .grafik-number.x {
            top: calc(50% + 16px);
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

            .grafik-board {
                height: 360px;
            }
        }

        /* =========================
                       GRAFIK INTERAKTIF MARI MENCOBA
                    ========================= */
        .grafik-box {
            margin-top: 14px;
        }

        .grafik-board {
            position: relative;
            width: 100%;
            max-width: 760px;
            height: 430px;
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
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .5);
        }

        .grafik-header-note {
            position: absolute;
            top: 14px;
            left: 16px;
            z-index: 4;
            font-size: 14px;
            color: #555;
            background: rgba(255, 255, 255, 0.92);
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
        }

        .grafik-axis-y {
            top: 22px;
            bottom: 22px;
            left: 50%;
            width: 2px;
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
            top: calc(50% - 6px);
            transform: rotate(45deg);
        }

        .grafik-arrow-y {
            left: calc(50% - 6px);
            top: 23px;
            transform: rotate(-45deg);
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
            top: calc(50% - 5px);
        }

        .grafik-tick-y {
            width: 12px;
            height: 2px;
            left: calc(50% - 5px);
        }

        .grafik-number {
            position: absolute;
            z-index: 3;
            font-size: 12px;
            color: #666;
            transform: translate(-50%, -50%);
            user-select: none;
        }

        .grafik-number.x {
            top: calc(50% + 17px);
        }

        .grafik-number.y {
            left: calc(50% - 18px);
        }

        .grafik-click-point {
            position: absolute;
            width: 18px;
            height: 18px;
            border-radius: 999px;
            border: 2px solid #2d9cdb;
            background: #fff;
            z-index: 5;
            transform: translate(-50%, -50%);
            top: 50%;
            cursor: pointer;
            transition: .18s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, .08);
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
            margin-top: 12px;
            display: none;
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
            .grafik-board {
                height: 360px;
            }

            .grafik-header-note {
                font-size: 12px;
                padding: 5px 8px;
            }
        }

        /* =========================
               GRAFIK INTERAKTIF MARI MENCOBA
            ========================= */
        .grafik-box {
            margin-top: 14px;
        }

        .grafik-board {
            position: relative;
            width: 100%;
            max-width: 760px;
            height: 430px;
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
            height: 2px;
            transform: translateY(-50%);
        }

        .grafik-axis-y {
            top: 22px;
            bottom: 22px;
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
            transform: translateY(-50%) rotate(45deg);
        }

        .grafik-arrow-y {
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
        }

        .grafik-number.y {
            transform: translateY(-50%);
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
            .grafik-board {
                height: 360px;
            }

            .grafik-header-note {
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

        /* =========================
       FIX BIAR BAGIAN INI KECIL
    ========================= */

        /* card utama */
        .latihan-card {
            padding: 16px 14px !important;
        }

        /* kotak tiap soal (INI YANG PALING NGARUH) */
        .latihan-item {
            padding: 12px 12px !important;
            border-radius: 14px;
        }

        /* judul soal */
        .latihan-label {
            font-size: 15px !important;
            margin-bottom: 6px;
        }

        /* rumus */
        .latihan-persamaan {
            font-size: 20px !important;
            margin-bottom: 14px;
        }

        /* input */
        .input-jawaban {
            font-size: 13px !important;
            padding: 8px 10px !important;
            min-width: 180px !important;
        }

        /* tombol */
        .btn-cek {
            font-size: 12px !important;
            padding: 7px 12px !important;
        }

        /* badge */
        .latihan-badge {
            font-size: 16px !important;
            padding: 8px 20px !important;
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
            pembuat nol suatu fungsi polinomial dengan faktornya. Teorema tersebut menyatakan bahwa:
        </p>

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

        <p>
            ini akan memperluas pemahaman tersebut dengan menghubungkan faktor polinomial dengan grafik fungsi polinomial,
            terutama pada titik potong grafik dengan sumbu-x.
        </p>

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
                    $$f(x)=x^4-x^3-7x^2+x+6$$
                </div>

                {{-- 1 --}}
                <div class="latihan-item">
                    <div class="latihan-label">1. Pembuat nol</div>
                    <div class="input-row">
                        <input id="m1" class="input-jawaban" placeholder="Contoh: -2,-1,1,3">
                        <button class="btn-cek" onclick="cekMari(1)">Cek Jawaban</button>
                    </div>
                    <div id="fb1" class="feedback-box"></div>

                    <div id="step1" class="penjelasan-wrap">
                        <div class="answer-box">
                            $$x=-2,\;-1,\;1,\;3$$
                        </div>
                        <div class="langkah-step">
                            <div class="step-head">Langkah</div>
                            <p>Uji faktor dari 6 hingga ditemukan nilai-nilai yang membuat $f(x)=0$.</p>
                        </div>
                    </div>
                </div>

                {{-- 2 --}}
                <div class="latihan-item">
                    <div class="latihan-label">2. Pemfaktoran</div>
                    <div class="input-row">
                        <input id="m2" class="input-jawaban" placeholder="(x+2)(x+1)(x-1)(x-3)">
                        <button class="btn-cek" onclick="cekMari(2)">Cek Jawaban</button>
                    </div>
                    <div id="fb2" class="feedback-box"></div>

                    <div id="step2" class="penjelasan-wrap">
                        <div class="answer-box">
                            $$f(x)=(x+2)(x+1)(x-1)(x-3)$$
                        </div>
                    </div>
                </div>

                {{-- 3 --}}
                <div class="latihan-item">
                    <div class="latihan-label">3. Titik potong sumbu-x</div>
                    <div class="input-row">
                        <input id="m3" class="input-jawaban" placeholder="(-2,0),(-1,0),(1,0),(3,0)">
                        <button class="btn-cek" onclick="cekMari(3)">Cek Jawaban</button>
                    </div>
                    <div id="fb3" class="feedback-box"></div>

                    <div id="step3" class="penjelasan-wrap">
                        <div class="answer-box">
                            $$(-2,0),(-1,0),(1,0),(3,0)$$
                        </div>
                    </div>
                </div>

                {{-- 4 --}}
                <div class="latihan-item">
                    <div class="latihan-label">4. Titik potong sumbu-y</div>
                    <div class="input-row">
                        <input id="m4" class="input-jawaban" placeholder="(0,6)">
                        <button class="btn-cek" onclick="cekMari(4)">Cek Jawaban</button>
                    </div>
                    <div id="fb4" class="feedback-box"></div>

                    <div id="step4" class="penjelasan-wrap">
                        <div class="answer-box">
                            $$(0,6)$$
                        </div>
                    </div>
                </div>

                <div class="latihan-item">
                    <div class="latihan-label">e. Grafik</div>

                    <div class="grafik-box">
                        <div id="grafik-mc4" class="graph-placeholder" style="min-height:430px;">
                            Grafik akan aktif setelah nomor 1–4 benar semua.
                        </div>

                        <div id="grafikFeedback" class="grafik-feedback-mini"></div>

                        <div id="grafikPenjelasan" class="grafik-penjelasan">
                            <b>Penjelasan:</b><br>
                            Karena
                            $$f(x)=x^4-x^3-7x^2+x+6=(x+2)(x+1)(x-1)(x-3),$$
                            maka pembuat nolnya adalah:
                            $$x=-2,\;-1,\;1,\;3$$

                            Artinya grafik memotong sumbu-$x$ di titik:
                            $$(-2,0),\;(-1,0),\;(1,0),\;(3,0)$$

                            Setelah semua titik potong sumbu-$x$ benar dipilih, kurva polinomial dapat digambar
                            sehingga terlihat hubungan antara <b>faktor</b>, <b>pembuat nol</b>, dan
                            <b>grafik fungsi</b>.

                            <div class="grafik-chip-row">
                                <div class="grafik-chip">Akar: -2</div>
                                <div class="grafik-chip">Akar: -1</div>
                                <div class="grafik-chip">Akar: 1</div>
                                <div class="grafik-chip">Akar: 3</div>
                                <div class="grafik-chip">Titik potong y: (0,6)</div>
                            </div>
                        </div>
                    </div>

                    <div class="small-note">
                        Klik titik pada sumbu-x. Jika benar akan berwarna hijau, jika salah akan berwarna merah.
                        Setelah semua titik benar ditemukan, kurva grafik akan muncul otomatis.
                    </div>
                </div>
                <div class="small-note">
                    Grafik ditampilkan kosong terlebih dahulu seperti bidang koordinat.
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

                {{-- SOAL 2 --}}
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

                <div id="statusSoal3" class="status-selesai">
                    Semua bagian pada soal 2 sudah selesai.
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

        const progress = {
            soal1: { a: false, b: false, c: false },
            soal3: { a: false, b: false, c: false, d: false }
        };

        const grafikMc4Config = {
            roots: [-2, -1, 1, 3],
            xmin: -6,
            xmax: 6,
            ymin: -4,
            ymax: 4
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
                        { left: '$', right: '$$', display: true },
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

        function cekProgressSoal1() {
            const selesai = progress.soal1.a && progress.soal1.b && progress.soal1.c;
            const status = document.getElementById('statusSoal1');
            const penjelasan = document.getElementById('penjelasanSoal1');

            if (status) status.classList.toggle('show', selesai);
            if (penjelasan) penjelasan.classList.toggle('show', selesai);

            renderMathSafe();
        }

        function cekProgressSoal3() {
            const selesai = progress.soal3.a && progress.soal3.b && progress.soal3.c && progress.soal3.d;
            const status = document.getElementById('statusSoal3');
            const penjelasan = document.getElementById('penjelasanSoal3');

            if (status) status.classList.toggle('show', selesai);
            if (penjelasan) penjelasan.classList.toggle('show', selesai);

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

        function semuaMariSudahBenar() {
            return (
                document.getElementById('step1')?.classList.contains('show') &&
                document.getElementById('step2')?.classList.contains('show') &&
                document.getElementById('step3')?.classList.contains('show') &&
                document.getElementById('step4')?.classList.contains('show')
            );
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
            for (let x = -5; x <= 5; x++) {
                html += `<div class="grafik-tick-x" style="left:${xToPercent(x)}%;"></div>`;
            }
            return html;
        }

        function buildTicksY() {
            let html = '';
            for (let y = -3; y <= 7; y++) {
                html += `<div class="grafik-tick-y" style="top:${yToPercent(y)}%;"></div>`;
            }
            return html;
        }

        function buildLabelsX() {
            let html = '';
            for (let x = -5; x <= 5; x++) {
                const extraClass = x === 0 ? ' origin' : '';
                html += `<div class="grafik-number x${extraClass}" style="left:${xToPercent(x)}%;">${x}</div>`;
            }
            return html;
        }

        function buildLabelsY() {
            let html = '';
            for (let y = 7; y >= -3; y--) {
                const extraClass = y === 0 ? ' origin' : '';
                html += `<div class="grafik-number y${extraClass}" style="top:${yToPercent(y)}%;">${y}</div>`;
            }
            return html;
        }

        function buildClickablePoints() {
            let html = '';
            for (let x = -5; x <= 5; x++) {
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

                            <div class="grafik-axis-x"></div>
                            <div class="grafik-axis-y"></div>
                            <div class="grafik-arrow-x"></div>
                            <div class="grafik-arrow-y"></div>

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
            const tools = document.getElementById('grafik-mc4-tools');
            const feedback = document.getElementById('grafikFeedback');
            const penjelasan = document.getElementById('grafikPenjelasan');

            if (!box) return;

            mariGrafikAktif = true;
            grafikMc4Solved = false;

            box.className = '';
            box.style.minHeight = 'unset';
            box.style.padding = '0';
            box.style.background = 'transparent';
            box.style.border = 'none';
            box.innerHTML = buildGrafikInteraktifMc4();

            if (tools) tools.style.display = 'flex';

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
            const tools = document.getElementById('grafik-mc4-tools');
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
                box.innerHTML = 'Grafik akan aktif setelah a–d benar semua.';
            }

            if (tools) tools.style.display = 'none';

            if (feedback) {
                feedback.className = 'grafik-feedback-mini';
                feedback.innerHTML = '';
            }

            if (penjelasan) {
                penjelasan.classList.remove('show');
            }
        }

        function resetGrafikMc4() {
            if (semuaMariSudahBenar()) {
                aktifkanGrafikMari();
            } else {
                nonaktifkanGrafikMari();
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
                if (fb) {
                    fb.className = 'feedback-box show success';
                    fb.innerHTML = '✅ Benar!';
                }
                if (step) step.classList.add('show');
            } else {
                if (fb) {
                    fb.className = 'feedback-box show error';
                    fb.innerHTML = '❌ Salah, coba lagi sampai benar';
                }
                if (step) step.classList.remove('show');
            }

            if (semuaMariSudahBenar()) {
                aktifkanGrafikMari();
            } else {
                nonaktifkanGrafikMari();
            }

            renderMathSafe();
        }

        function cekSoal1(bagian) {
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
                const user = extractCoordinatePairs(input);
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

        window.addEventListener('load', function () {
            setTimeout(() => {
                if (semuaMariSudahBenar()) {
                    aktifkanGrafikMari();
                } else {
                    nonaktifkanGrafikMari();
                }
                renderMathSafe();
            }, 300);
        });
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