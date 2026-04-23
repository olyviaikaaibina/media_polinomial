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


        .game-mission-card {
            position: relative;
            overflow: visible;
            border-radius: 30px;
            padding: 0;
            border: 1px solid rgba(47, 143, 70, .14);
            background:
                radial-gradient(circle at top left, rgba(93, 157, 213, .16), transparent 30%),
                radial-gradient(circle at top right, rgba(47, 143, 70, .12), transparent 28%),
                linear-gradient(145deg, #f8fbff 0%, #f7fff6 52%, #fffdf8 100%);
            box-shadow: 0 18px 42px rgba(0, 0, 0, .08);
        }

        /* ================= HEADER ================= */
        .game-header {
            padding: 26px 24px 10px;
            text-align: center;
        }

        .game-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 18px;
            border-radius: 999px;
            background: linear-gradient(135deg, #24458f, #3f68c5);
            color: #fff;
            font-weight: 900;
            letter-spacing: .4px;
            margin-bottom: 14px;
            box-shadow: 0 10px 24px rgba(36, 69, 143, .22);
            font-size: 15px;
        }

        .game-title {
            margin: 0;
            font-size: 34px;
            font-weight: 900;
            color: #1b7a2a;
            line-height: 1.2;
        }

        .game-subtitle {
            margin: 12px auto 0;
            max-width: 760px;
            font-size: 17px;
            color: #52606d;
            text-align: center;
            line-height: 1.8;
        }

        /* ================= MAIN LAYOUT ================= */
        .game-scene {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
            gap: 20px;
            padding: 20px 24px 28px;
            align-items: start;
        }

        .game-scene-left {
            position: relative;
            min-height: auto;
        }

        /* ================= STORY ================= */
        .game-story-box {
            position: relative;
            z-index: 2;
            border-radius: 26px;
            padding: 24px;
            background: rgba(255, 255, 255, .84);
            border: 1px solid rgba(0, 0, 0, .07);
            backdrop-filter: blur(4px);
            box-shadow: 0 14px 30px rgba(0, 0, 0, .06);
            overflow: visible;
        }

        .game-story-title {
            font-size: 18px;
            font-weight: 900;
            color: #24458f;
            margin-bottom: 12px;
        }

        .game-story-box p {
            margin: 10px 0;
            font-size: 16px;
            color: #4b5563;
            text-align: justify;
            line-height: 1.85;
        }

        .game-story-note {
            font-style: italic;
            color: #667085;
        }

        .game-formula-main {
            margin: 16px 0;
            padding: 18px;
            border-radius: 18px;
            background: linear-gradient(180deg, #eef5ff, #ffffff);
            border: 1px solid rgba(36, 69, 143, .14);
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .55);
            overflow-x: auto;
            overflow-y: visible;
        }

        /* ================= GAME PANEL ================= */
        .game-panel {
            border-radius: 26px;
            padding: 22px;
            background: linear-gradient(180deg, #dfeaff 0%, #f3f8ff 100%);
            border: 1px solid rgba(91, 155, 213, .24);
            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, .7),
                0 14px 28px rgba(61, 104, 171, .10);
            overflow: visible;
        }

        .game-stage-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
            flex-wrap: wrap;
        }

        .stage-dot {
            width: 18px;
            height: 18px;
            border-radius: 999px;
            background: #c8d2df;
            border: 2px solid #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, .08);
            transition: .25s ease;
            flex: 0 0 auto;
        }

        .stage-dot.active {
            background: #2f8f46;
            transform: scale(1.12);
            box-shadow: 0 0 0 8px rgba(47, 143, 70, .10);
        }

        .stage-dot.done {
            background: #24458f;
        }

        .stage-line {
            width: 48px;
            height: 4px;
            border-radius: 999px;
            background: rgba(36, 69, 143, .15);
            margin: 0 8px;
            flex: 0 0 auto;
        }

        .game-stage-name {
            text-align: center;
            font-size: 20px;
            font-weight: 900;
            color: #1e3a8a;
            line-height: 1.5;
            margin-bottom: 14px;
        }

        .game-dialogue {
            margin: 14px 0 18px;
            padding: 14px 16px;
            border-radius: 16px;
            background: rgba(255, 255, 255, .76);
            border: 1px solid rgba(0, 0, 0, .07);
            color: #374151;
            font-weight: 700;
            line-height: 1.8;
        }

        .game-question-box {
            border-radius: 18px;
            padding: 18px;
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, .07);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, .65);
            margin-bottom: 16px;
        }

        .game-question-math {
            font-size: 18px;
            overflow-x: auto;
            overflow-y: visible;
            min-height: 40px;
        }

        .game-answer-box {
            margin-bottom: 14px;
        }

        .game-input-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 900;
            color: #24458f;
        }

        .game-input {
            width: 100%;
            max-width: 100%;
            padding: 16px 18px;
            border-radius: 18px;
            border: 1px solid rgba(0, 0, 0, .12);
            background: #fff;
            font-family: "Times New Roman", Times, serif;
            font-size: 17px;
            outline: none;
            transition: .18s ease;
            box-sizing: border-box;
        }

        .game-input:focus {
            border-color: #5b9bd5;
            box-shadow: 0 0 0 5px rgba(91, 155, 213, .14);
        }

        .game-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 16px;
        }

        .game-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 16px;
            padding: 14px 20px;
            font-family: "Times New Roman", Times, serif;
            font-size: 17px;
            font-weight: 900;
            cursor: pointer;
            transition: .16s ease;
        }

        .game-btn:hover {
            transform: translateY(-1px);
        }

        .game-btn.primary {
            background: linear-gradient(135deg, #1b7a2a, #329847);
            color: #fff;
            box-shadow: 0 12px 22px rgba(27, 122, 42, .20);
        }

        .game-btn.secondary {
            background: #fff;
            color: #344054;
            border: 1px solid rgba(0, 0, 0, .10);
        }

        .game-feedback {
            display: none;
            margin-bottom: 14px;
            padding: 14px 16px;
            border-radius: 16px;
            font-weight: 800;
            line-height: 1.7;
        }

        .game-feedback.show {
            display: block;
        }

        .game-feedback.ok {
            background: rgba(27, 122, 42, .10);
            color: #14532d;
            border: 1px solid rgba(27, 122, 42, .22);
        }

        .game-feedback.no {
            background: rgba(224, 112, 43, .10);
            color: #9a3412;
            border: 1px solid rgba(224, 112, 43, .20);
        }

        .game-hint-box {
            border-radius: 16px;
            padding: 14px 16px;
            background: rgba(255, 255, 255, .72);
            border: 1px dashed rgba(36, 69, 143, .24);
        }

        .game-hint-title {
            font-weight: 900;
            color: #1e3a8a;
            margin-bottom: 6px;
        }

        .game-hint-text {
            color: #4b5563;
            line-height: 1.75;
        }

        .game-panel.shake {
            animation: gameShake .35s ease;
        }

        @keyframes gameShake {

            0%,
            100% {
                transform: translateX(0);
            }

            20% {
                transform: translateX(-6px);
            }

            40% {
                transform: translateX(6px);
            }

            60% {
                transform: translateX(-4px);
            }

            80% {
                transform: translateX(4px);
            }
        }

        /* ================= VICTORY ================= */
        .game-victory {
            display: none;
            margin: 20px 24px 24px;
            padding: 26px 20px 30px;
            border-radius: 30px;
            background:
                radial-gradient(circle at top center, rgba(255, 244, 170, .22), transparent 28%),
                linear-gradient(180deg, #f4fff5 0%, #fbfffc 55%, #f6fbff 100%);
            border: 1px solid rgba(47, 143, 70, .18);
            overflow: hidden;
            position: relative;
            box-shadow:
                0 18px 40px rgba(47, 143, 70, .08),
                inset 0 1px 0 rgba(255, 255, 255, .7);
        }

        .game-victory.show {
            display: block;
            animation: victoryFadeIn .5s ease;
        }

        .victory-scene {
            position: relative;
            height: 320px;
            border-radius: 24px;
            margin-bottom: 20px;
            overflow: hidden;
            background: linear-gradient(180deg, #edf8ef 0%, #f7fcf8 100%);
            border: 1px solid rgba(47, 143, 70, .08);
        }

        .victory-bg-glow {
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at center, rgba(255, 239, 161, .55), transparent 38%);
            opacity: .8;
            animation: glowPulse 2s ease-in-out infinite alternate;
        }

        .spark {
            position: absolute;
            color: #f2c94c;
            font-size: 24px;
            opacity: .85;
            animation: sparkleFloat 2.8s ease-in-out infinite;
        }

        .s1 {
            top: 52px;
            left: 22%;
            animation-delay: 0s;
        }

        .s2 {
            top: 90px;
            right: 22%;
            animation-delay: .4s;
        }

        .s3 {
            top: 150px;
            left: 30%;
            animation-delay: .8s;
        }

        .s4 {
            top: 132px;
            right: 27%;
            animation-delay: 1.2s;
        }

        .s5 {
            top: 44px;
            right: 38%;
            animation-delay: 1.6s;
        }

        .gate-stage {
            position: absolute;
            left: 50%;
            top: 50%;
            width: 500px;
            height: 240px;
            transform: translate(-50%, -48%);
        }

        .gate-pillar {
            position: absolute;
            bottom: 0;
            width: 42px;
            height: 200px;
            border-radius: 12px;
            background: linear-gradient(180deg, #b88452 0%, #946037 45%, #744624 100%);
            box-shadow:
                inset 0 0 0 2px rgba(255, 255, 255, .12),
                0 6px 16px rgba(0, 0, 0, .12);
        }

        .pillar-left {
            left: 82px;
        }

        .pillar-right {
            right: 82px;
        }

        .gate-light-core {
            position: absolute;
            left: 50%;
            bottom: 18px;
            transform: translateX(-50%);
            width: 118px;
            height: 190px;
            border-radius: 18px;
            background: linear-gradient(180deg,
                    rgba(255, 255, 255, .96) 0%,
                    rgba(255, 245, 190, .95) 34%,
                    rgba(255, 221, 122, .70) 100%);
            filter: blur(2px);
            box-shadow:
                0 0 22px rgba(255, 226, 132, .95),
                0 0 60px rgba(255, 226, 132, .42);
            animation: lightShine 1.8s ease-in-out infinite alternate;
        }

        .gate-light-floor {
            position: absolute;
            left: 50%;
            bottom: -2px;
            transform: translateX(-50%);
            width: 260px;
            height: 90px;
            background: linear-gradient(180deg, rgba(255, 235, 160, .65) 0%, rgba(255, 235, 160, .08) 100%);
            clip-path: polygon(38% 0%, 62% 0%, 100% 100%, 0% 100%);
            filter: blur(1px);
        }

        .gate-door {
            position: absolute;
            bottom: 12px;
            width: 116px;
            height: 182px;
            border-radius: 20px 20px 10px 10px;
            background: linear-gradient(180deg, #875228 0%, #6f411d 55%, #572f13 100%);
            border: 5px solid #4b250d;
            box-shadow:
                inset 0 0 0 2px rgba(255, 255, 255, .08),
                0 8px 20px rgba(0, 0, 0, .16);
            z-index: 3;
        }

        .gate-inner-panel {
            position: absolute;
            inset: 14px;
            border: 2px solid rgba(255, 233, 181, .18);
            border-radius: 12px;
        }

        .gate-left {
            left: 110px;
            transform-origin: left center;
        }

        .gate-right {
            right: 110px;
            transform-origin: right center;
        }

        .game-victory.show .gate-left {
            animation: openGateLeft 1.1s ease forwards;
        }

        .game-victory.show .gate-right {
            animation: openGateRight 1.1s ease forwards;
        }

        .victory-trophy {
            position: absolute;
            left: 50%;
            top: 58%;
            transform: translate(-50%, -50%) scale(.2);
            font-size: 58px;
            opacity: 0;
            z-index: 5;
        }

        .game-victory.show .victory-trophy {
            animation: trophyRise .8s ease forwards;
            animation-delay: 1s;
        }

        .victory-content {
            max-width: 820px;
            margin: 0 auto;
            text-align: center;
            opacity: 0;
            transform: translateY(18px);
        }

        .game-victory.show .victory-content {
            animation: contentReveal .7s ease forwards;
            animation-delay: 1.55s;
        }

        .victory-title {
            font-size: 32px;
            font-weight: 900;
            color: #1b7a2a;
            line-height: 1.3;
            margin-bottom: 10px;
        }

        .victory-text {
            font-size: 17px;
            color: #55606d;
            line-height: 1.8;
            margin-bottom: 18px;
        }

        .victory-answer-card {
            max-width: 760px;
            margin: 0 auto;
            padding: 18px 18px 16px;
            border-radius: 22px;
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, .08);
            box-shadow:
                0 10px 22px rgba(0, 0, 0, .05),
                inset 0 1px 0 rgba(255, 255, 255, .7);
        }

        .victory-answer-label {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 16px;
            border-radius: 999px;
            background: linear-gradient(135deg, #1b7a2a, #329847);
            color: #fff;
            font-weight: 900;
            font-size: 14px;
            margin-bottom: 14px;
        }

        .victory-formula {
            overflow-x: auto;
            font-size: 20px;
        }

        /* ================= ANIMATIONS ================= */
        @keyframes openGateLeft {
            0% {
                transform: perspective(900px) rotateY(0deg);
            }

            100% {
                transform: perspective(900px) rotateY(-78deg) translateX(-8px);
            }
        }

        @keyframes openGateRight {
            0% {
                transform: perspective(900px) rotateY(0deg);
            }

            100% {
                transform: perspective(900px) rotateY(78deg) translateX(8px);
            }
        }

        @keyframes trophyRise {
            0% {
                opacity: 0;
                transform: translate(-50%, -10%) scale(.2);
            }

            55% {
                opacity: 1;
                transform: translate(-50%, -78%) scale(1.18);
            }

            100% {
                opacity: 1;
                transform: translate(-50%, -70%) scale(1);
            }
        }

        @keyframes contentReveal {
            0% {
                opacity: 0;
                transform: translateY(18px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes glowPulse {
            0% {
                opacity: .6;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes lightShine {
            0% {
                filter: blur(2px);
                box-shadow:
                    0 0 18px rgba(255, 226, 132, .75),
                    0 0 46px rgba(255, 226, 132, .28);
            }

            100% {
                filter: blur(3px);
                box-shadow:
                    0 0 28px rgba(255, 226, 132, .95),
                    0 0 70px rgba(255, 226, 132, .46);
            }
        }

        @keyframes sparkleFloat {
            0% {
                transform: translateY(0) scale(1);
                opacity: .45;
            }

            50% {
                transform: translateY(-10px) scale(1.08);
                opacity: 1;
            }

            100% {
                transform: translateY(0) scale(1);
                opacity: .45;
            }
        }

        @keyframes victoryFadeIn {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 1200px) {
            .game-scene {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 900px) {
            .victory-scene {
                height: 280px;
            }

            .gate-stage {
                width: 360px;
                height: 210px;
            }

            .gate-pillar {
                width: 34px;
                height: 176px;
            }

            .pillar-left {
                left: 58px;
            }

            .pillar-right {
                right: 58px;
            }

            .gate-door {
                width: 92px;
                height: 162px;
            }

            .gate-left {
                left: 72px;
            }

            .gate-right {
                right: 72px;
            }

            .gate-light-core {
                width: 92px;
                height: 168px;
            }

            .victory-title {
                font-size: 28px;
            }
        }

        @media (max-width: 768px) {
            .game-header {
                padding: 20px 16px 8px;
            }

            .game-scene {
                padding: 16px;
                gap: 16px;
            }

            .game-title {
                font-size: 26px;
                line-height: 1.25;
            }

            .game-subtitle {
                font-size: 15px;
            }

            .game-story-box,
            .game-panel {
                padding: 18px;
                border-radius: 20px;
            }

            .game-stage-name {
                font-size: 18px;
            }

            .game-input {
                font-size: 16px;
                padding: 14px 16px;
            }

            .game-btn {
                width: 100%;
            }

            .game-actions {
                flex-direction: column;
            }

            .game-victory {
                margin: 16px;
                padding: 22px 14px 24px;
            }

            .victory-scene {
                height: 250px;
            }

            .gate-stage {
                width: 290px;
                height: 180px;
            }

            .gate-pillar {
                width: 28px;
                height: 150px;
            }

            .pillar-left {
                left: 42px;
            }

            .pillar-right {
                right: 42px;
            }

            .gate-door {
                width: 72px;
                height: 136px;
                bottom: 10px;
            }

            .gate-left {
                left: 54px;
            }

            .gate-right {
                right: 54px;
            }

            .gate-light-core {
                width: 72px;
                height: 142px;
            }

            .gate-light-floor {
                width: 190px;
                height: 70px;
            }

            .victory-trophy {
                font-size: 46px;
            }

            .victory-title {
                font-size: 22px;
            }

            .victory-text {
                font-size: 15px;
            }

            .victory-formula {
                font-size: 17px;
            }

            .stage-line {
                width: 32px;
                margin: 0 6px;
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
                        <div class="quiz-q">
                            Jika $x=1$ (hari kerja ke-1), berapa nilai $T(1)$?
                        </div>
                        <input class="quiz-input" type="text" placeholder="Isi jawaban" />
                        <div class="quiz-actions">
                            <span class="quiz-feedback"></span>
                        </div>
                    </li>

                    <li class="quiz-item" data-answer="-3">
                        <div class="quiz-q">
                            Jika $x=1$ (hari kerja ke-1), berapa nilai $U(1)$?
                        </div>
                        <input class="quiz-input" type="text" placeholder="Isi jawaban" />
                        <div class="quiz-actions">
                            <span class="quiz-feedback"></span>
                        </div>
                    </li>

                    <li class="quiz-item" data-answer="2x^3-3x^2+6x+11">
                        <div class="quiz-q">
                            Tentukan bentuk pengurangan polinomial berikut:
                            <div style="margin-top:8px;">
                                $$(5x^3-2x^2+4x+6)-(3x^3+x^2-2x-5)$$
                            </div>
                        </div>
                        <input class="quiz-input" type="text" placeholder="Isi jawaban" />
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

        <div id="materi-lanjutan" style="display:none;">
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

                    <p class="step-help">
                        Petunjuk: tanda $+$ di dalam kurung menjadi $-$, dan tanda $-$ di dalam kurung menjadi $+$.
                    </p>

                    <div class="interaktif-wrap" data-answer="5x^3-2x^2+4x+6-3x^3-x^2+2x+5">
                        <div class="interaktif-title">Tulis bentuk setelah kurung dibuka</div>
                        <input type="text" class="interaktif-input" placeholder="Contoh penulisan: 5x^3-2x^2+..." />
                        <div class="interaktif-actions">
                            <button type="button" class="interaktif-check">Cek</button>
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


                    <p class="step-help">
                        Petunjuk: gunakan tanda kurung untuk menunjukkan kelompok suku sejenis.
                    </p>

                    <div class="interaktif-wrap" data-answer="(5x^3-3x^3)+(-2x^2-x^2)+(4x+2x)+(6+5)">
                        <div class="interaktif-title">Tulis bentuk yang sudah dikelompokkan</div>
                        <input type="text" class="interaktif-input" placeholder="Contoh: ( ... ) + ( ... ) + ..." />
                        <div class="interaktif-actions">
                            <button type="button" class="interaktif-check">Cek</button>

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


                    <p class="step-help">
                        Petunjuk: tulis hasil akhir dalam bentuk polinomial yang sudah sederhana dan terurut.
                    </p>

                    <div class="interaktif-wrap" data-answer="2x^3-3x^2+6x+11">
                        <div class="interaktif-title">Tulis hasil akhir</div>
                        <input type="text" class="interaktif-input" placeholder="Tulis hasil polinomial akhirnya" />
                        <div class="interaktif-actions">
                            <button type="button" class="interaktif-check">Cek</button>

                            <span class="interaktif-feedback"></span>
                        </div>
                    </div>
                </div>

                <div class="global-actions">

                    <span id="interaktif-summary" class="interaktif-summary"></span>
                </div>


            </div>

            <div class="card game-mission-card" id="game-mode">

                <!-- ================= HEADER ================= -->
                <div class="game-header">
                    <h2 class="game-title">Misi Membuka Gerbang Polinomial</h2>
                    <p class="game-subtitle">
                        Selesaikan setiap tahap untuk membuka gerbang.
                    </p>
                </div>

                <!-- ================= MAIN ================= -->
                <div class="game-scene">

                    <!-- ===== KIRI (CERITA) ===== -->
                    <div class="game-scene-left">
                        <div class="game-story-box">

                            <div class="game-story-title">Misi</div>

                            <p>
                                Di depanmu terdapat <b>Gerbang Polinomial</b>.
                                Gerbang ini hanya akan terbuka jika kamu berhasil
                                menyederhanakan bentuk berikut:
                            </p>

                            <div class="game-formula-main">
                                $$
                                (5x^3 - 2x^2 + 4x + 6) - (3x^3 + x^2 - 2x - 5)
                                $$
                            </div>

                            <p class="game-story-note">
                                Gunakan strategi: buka kurung → kelompokkan → sederhanakan.
                            </p>

                        </div>
                    </div>

                    <!-- ===== KANAN (GAME) ===== -->
                    <div class="game-panel">

                        <!-- progress -->
                        <div class="game-stage-indicator">
                            <span class="stage-dot active" id="dot-1"></span>
                            <span class="stage-line"></span>
                            <span class="stage-dot" id="dot-2"></span>
                            <span class="stage-line"></span>
                            <span class="stage-dot" id="dot-3"></span>
                        </div>

                        <div class="game-stage-name" id="game-stage-name">
                            Gerbang 1 — Buka Kurung
                        </div>

                        <!-- dialog -->
                        <div class="game-dialogue" id="game-dialogue">
                            Ubah tanda pada semua suku di dalam kurung kedua.
                        </div>

                        <!-- soal -->
                        <div class="game-question-box">
                            <div class="game-question-math" id="game-question-math"></div>
                        </div>

                        <!-- input -->
                        <div class="game-answer-box">
                            <label class="game-input-label">Jawabanmu</label>
                            <input type="text" id="game-answer" class="game-input">
                        </div>

                        <!-- tombol -->
                        <div class="game-actions">
                            <button id="game-submit" class="game-btn primary">
                                Buka Gerbang
                            </button>
                            <button id="game-reset" class="game-btn secondary">
                                Ulangi
                            </button>
                        </div>

                        <!-- feedback -->
                        <div id="game-feedback" class="game-feedback"></div>

                        <!-- hint -->
                        <div class="game-hint-box">
                            <div class="game-hint-title">Petunjuk</div>
                            <div id="game-hint-text" class="game-hint-text"></div>
                        </div>

                    </div>
                </div>

                <!-- ================= VICTORY ================= -->
                <div class="game-victory" id="game-victory">

                    <!-- SCENE -->
                    <div class="victory-scene">

                        <!-- glow -->
                        <div class="victory-bg-glow"></div>

                        <!-- sparkle -->
                        <div class="sparkles">
                            <span class="spark s1">✦</span>
                            <span class="spark s2">✧</span>
                            <span class="spark s3">✦</span>
                            <span class="spark s4">✧</span>
                            <span class="spark s5">✦</span>
                        </div>

                        <!-- GERBANG -->
                        <div class="gate-stage">

                            <!-- tiang -->
                            <div class="gate-pillar pillar-left"></div>
                            <div class="gate-pillar pillar-right"></div>

                            <!-- cahaya -->
                            <div class="gate-light-core"></div>
                            <div class="gate-light-floor"></div>

                            <!-- pintu kiri -->
                            <div class="gate-door gate-left">
                                <div class="gate-inner-panel"></div>
                            </div>

                            <!-- pintu kanan -->
                            <div class="gate-door gate-right">
                                <div class="gate-inner-panel"></div>
                            </div>

                        </div>

                        <!-- TROPHY -->
                        <div class="victory-trophy">
                            🏆
                        </div>

                    </div>

                    <!-- TEXT -->
                    <div class="victory-content">

                        <div class="victory-title">
                            Gerbang Polinomial Berhasil Dibuka!
                        </div>

                        <div class="victory-text">
                            Hebat! Kamu sudah menyelesaikan tantangan pengurangan polinomial dengan benar.
                        </div>

                        <div class="victory-answer-card">

                            <div class="victory-answer-label">
                                Hasil Akhir
                            </div>

                            <div class="victory-formula">
                                $$
                                (5x^3 - 2x^2 + 4x + 6) - (3x^3 + x^2 - 2x - 5)
                                = 2x^3 - 3x^2 + 6x + 11
                                $$
                            </div>

                        </div>

                    </div>

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
                            <input type="text" class="latihan-input" placeholder="">
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
                            <input type="text" class="latihan-input" placeholder="">
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
                            <input type="text" class="latihan-input" placeholder="">
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
                            <input type="text" class="latihan-input" placeholder="">
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
                            <input type="text" class="latihan-input" placeholder="">
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
                            <input type="text" class="latihan-input" placeholder="">
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

            const setFb = (el, ok, okText = "Benar", noText = "Salah") => {
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
                const materiLanjutan = document.getElementById("materi-lanjutan");

                const checkItem = (item) => {
                    const input = item.querySelector(".quiz-input");
                    const fb = item.querySelector(".quiz-feedback");
                    const userRaw = input ? input.value : "";
                    const user = normalizePoly(userRaw);
                    const ans = normalizePoly(item.getAttribute("data-answer") || "");

                    if (!userRaw.trim()) {
                        clearFb(fb);
                        return null;
                    }

                    const ok = user === ans;
                    setFb(fb, ok, "Benar", "Salah");
                    return ok;
                };

                const updateEksplorasiState = () => {
                    let terisi = 0;
                    let benar = 0;

                    items.forEach(item => {
                        const input = item.querySelector(".quiz-input");
                        const result = checkItem(item);

                        if (input && input.value.trim() !== "") {
                            terisi++;
                        }

                        if (result === true) {
                            benar++;
                        }
                    });

                    const total = items.length;

                    if (summary) {
                        summary.textContent = `Terisi ${terisi}/${total} • Benar ${benar}/${total}`;
                    }

                    const semuaTerisi = terisi === total;

                    if (finalMsg) {
                        if (semuaTerisi) finalMsg.classList.add("ok");
                        else finalMsg.classList.remove("ok");
                    }

                    if (materiLanjutan) {
                        materiLanjutan.style.display = semuaTerisi ? "block" : "none";
                    }
                };

                items.forEach(item => {
                    const input = item.querySelector(".quiz-input");

                    input?.addEventListener("input", () => {
                        updateEksplorasiState();
                    });

                    input?.addEventListener("keydown", (e) => {
                        if (e.key === "Enter") {
                            e.preventDefault();
                            updateEksplorasiState();
                        }
                    });

                    input?.addEventListener("blur", () => {
                        updateEksplorasiState();
                    });
                });

                updateEksplorasiState();
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

        const gameStages = [
            {
                name: "Gerbang 1 — Buka Kurung",
                prompt: `
                $$
                (5x^3 - 2x^2 + 4x + 6) - (3x^3 + x^2 - 2x - 5)
                $$
            `,
                dialogue: "Ubah tanda pada semua suku di dalam kurung kedua, lalu tulis bentuk setelah kurung dibuka.",
                hint: "Karena ada tanda minus di depan kurung kedua, semua tanda di dalam kurung kedua harus berubah.",
                answers: [
                    "5x^3-2x^2+4x+6-3x^3-x^2+2x+5",
                    "5x3-2x2+4x+6-3x3-x2+2x+5",
                    "(5x^3-2x^2+4x+6)+(-3x^3-x^2+2x+5)",
                    "(5x3-2x2+4x+6)+(-3x3-x2+2x+5)"
                ],
                success: "✨ Hebat! Tanda-tandanya sudah kamu ubah dengan benar. Gerbang pertama mulai terbuka..."
            },
            {
                name: "Gerbang 2 — Kelompokkan Suku Sejenis",
                prompt: `
                $$
                5x^3 - 2x^2 + 4x + 6 - 3x^3 - x^2 + 2x + 5
                $$
            `,
                dialogue: "Sekarang kelompokkan suku-suku sejenis agar lebih mudah disederhanakan.",
                hint: "Gabungkan suku dengan variabel dan pangkat yang sama: suku x^3, suku x^2, suku x, dan konstanta.",
                answers: [
                    "(5x^3-3x^3)+(-2x^2-x^2)+(4x+2x)+(6+5)",
                    "(5x3-3x3)+(-2x2-x2)+(4x+2x)+(6+5)"
                ],
                success: "🔓 Bagus! Suku-suku sejenis sudah berhasil dikelompokkan. Tinggal satu gerbang lagi."
            },
            {
                name: "Gerbang 3 — Sederhanakan",
                prompt: `
                $$
                (5x^3 - 3x^3) + (-2x^2 - x^2) + (4x + 2x) + (6 + 5)
                $$
            `,
                dialogue: "Hitung setiap kelompok, lalu tulis hasil akhir dalam bentuk polinomial yang sederhana dan terurut.",
                hint: "Kurangkan atau jumlahkan koefisien pada tiap kelompok, lalu tulis hasil akhirnya secara rapi.",
                answers: [
                    "2x^3-3x^2+6x+11",
                    "2x3-3x2+6x+11",
                    "2x³-3x²+6x+11"
                ],
                success: "🎉 Luar biasa! Kamu berhasil menyederhanakan pengurangan polinomial dengan benar."
            }
        ];

        (function () {
            const gameMode = document.getElementById("game-mode");
            if (!gameMode) return;

            const gameScene = gameMode.querySelector(".game-scene");
            const stageName = document.getElementById("game-stage-name");
            const dialogue = document.getElementById("game-dialogue");
            const questionMath = document.getElementById("game-question-math");
            const hintText = document.getElementById("game-hint-text");
            const answerInput = document.getElementById("game-answer");
            const submitBtn = document.getElementById("game-submit");
            const resetBtn = document.getElementById("game-reset");
            const feedback = document.getElementById("game-feedback");
            const victory = document.getElementById("game-victory");
            const panel = gameMode.querySelector(".game-panel");

            const dots = [
                document.getElementById("dot-1"),
                document.getElementById("dot-2"),
                document.getElementById("dot-3")
            ];

            let currentStage = 0;

            function normalizeGame(s) {
                return (s || "")
                    .toLowerCase()
                    .trim()
                    .replace(/\s+/g, "")
                    .replace(/×/g, "x")
                    .replace(/–|−/g, "-")
                    .replace(/²/g, "^2")
                    .replace(/³/g, "^3")
                    .replace(/\*\*/g, "^")
                    .replace(/([a-z])\((\-?\d+)\)/g, "$1^$2")
                    .replace(/([a-z])(\d+)/g, (match, varName, power, offset, full) => {
                        const prev = full[offset - 1] || "";
                        if (prev === "^") return match;
                        return `${varName}^${power}`;
                    })
                    .replace(/\+\-/g, "-")
                    .replace(/\-\+/g, "-")
                    .replace(/\-\-/g, "+")
                    .replace(/\+\+/g, "+")
                    .replace(/\^1(?!\d)/g, "")
                    .replace(/(^|[+\-(])1x/g, "$1x")
                    .replace(/(^|[+\-(])-1x/g, "$1-x");
            }

            function setGameFeedback(type, text) {
                if (!feedback) return;
                feedback.className = "game-feedback show " + type;
                feedback.textContent = text;
            }

            function clearGameFeedback() {
                if (!feedback) return;
                feedback.className = "game-feedback";
                feedback.textContent = "";
            }

            function updateDots() {
                dots.forEach((dot, index) => {
                    if (!dot) return;
                    dot.classList.remove("active", "done");
                    if (index < currentStage) {
                        dot.classList.add("done");
                    } else if (index === currentStage) {
                        dot.classList.add("active");
                    }
                });
            }

            function renderMathSafe() {
                if (typeof renderMathInElement === "function") {
                    renderMathInElement(gameMode, {
                        delimiters: [
                            { left: "$$", right: "$$", display: true },
                            { left: "$", right: "$", display: false }
                        ],
                        throwOnError: false
                    });
                }
            }

            function wrongEffect() {
                if (!panel) return;
                panel.classList.remove("shake");
                void panel.offsetWidth;
                panel.classList.add("shake");
            }

            function loadStage() {
                const stage = gameStages[currentStage];
                if (!stage) return;

                if (gameScene) gameScene.style.display = "grid";
                if (victory) victory.classList.remove("show");

                if (stageName) stageName.textContent = stage.name;
                if (dialogue) dialogue.textContent = stage.dialogue;
                if (questionMath) questionMath.innerHTML = stage.prompt;
                if (hintText) hintText.textContent = stage.hint;

                if (answerInput) {
                    answerInput.value = "";
                    answerInput.style.display = "block";
                    answerInput.placeholder =
                        currentStage === 0
                            ? "Tulis bentuk setelah kurung dibuka"
                            : currentStage === 1
                                ? "Tulis bentuk yang sudah dikelompokkan"
                                : "Tulis hasil akhir polinomial";
                }

                if (submitBtn) submitBtn.style.display = "inline-flex";

                clearGameFeedback();
                updateDots();
                renderMathSafe();
            }

            function showVictory() {
                if (gameScene) gameScene.style.display = "none";
                if (victory) {
                    victory.classList.remove("show");
                    void victory.offsetWidth;
                    victory.classList.add("show");
                }
                renderMathSafe();
            }

            function checkAnswer() {
                const user = normalizeGame(answerInput ? answerInput.value : "");
                const validAnswers = gameStages[currentStage].answers.map(a => normalizeGame(a));

                if (!user) {
                    setGameFeedback("no", "Isi jawabanmu terlebih dahulu agar gerbang bisa diproses.");
                    wrongEffect();
                    return;
                }

                if (validAnswers.includes(user)) {
                    setGameFeedback("ok", gameStages[currentStage].success);

                    if (dots[currentStage]) {
                        dots[currentStage].classList.remove("active");
                        dots[currentStage].classList.add("done");
                    }

                    setTimeout(() => {
                        currentStage++;

                        if (currentStage < gameStages.length) {
                            loadStage();
                        } else {
                            clearGameFeedback();
                            showVictory();
                        }
                    }, 900);
                } else {
                    setGameFeedback("no", "Gerbang belum terbuka. Periksa lagi tanda, pengelompokan, atau hasil perhitungannya.");
                    wrongEffect();
                }
            }

            function resetGame() {
                currentStage = 0;

                dots.forEach(dot => {
                    if (!dot) return;
                    dot.classList.remove("active", "done");
                });

                if (dots[0]) dots[0].classList.add("active");

                if (victory) victory.classList.remove("show");
                if (gameScene) gameScene.style.display = "grid";

                if (answerInput) {
                    answerInput.style.display = "block";
                    answerInput.value = "";
                }

                if (submitBtn) submitBtn.style.display = "inline-flex";

                clearGameFeedback();
                loadStage();
            }

            submitBtn?.addEventListener("click", checkAnswer);
            resetBtn?.addEventListener("click", resetGame);

            answerInput?.addEventListener("keydown", (e) => {
                if (e.key === "Enter") {
                    e.preventDefault();
                    checkAnswer();
                }
            });

            loadStage();
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