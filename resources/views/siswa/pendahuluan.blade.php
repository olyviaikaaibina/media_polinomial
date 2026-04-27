@extends('layout.halamanmateri')

@section('content')
    <style>
        .materi-container {
            width: 100%;
            max-width: 100%;
            margin: 0;
            padding: 10px 0 30px;
            overflow: visible !important;
            position: relative;
            z-index: 1;
        }

        .materi-title {
            text-align: center;
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 18px;
            color: #1e1e1e;
            letter-spacing: 1px;
        }

        .materi-text {
            font-size: 15px;
            line-height: 1.9;
            text-align: justify;
            color: #2c2c2c;
            margin-bottom: 16px;
        }

        .gambar-box {
            text-align: center;
            margin: 22px 0 26px;
        }

        .gambar-box img {
            width: 100%;
            max-width: 700px;
            border-radius: 16px;
            animation: gambarGerak 4s ease-in-out infinite;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08);
        }

        @keyframes gambarGerak {
            0% {
                transform: translateY(0px) scale(1);
            }

            50% {
                transform: translateY(-6px) scale(1.02);
            }

            100% {
                transform: translateY(0px) scale(1);
            }
        }

        .intro-wrap {
            margin-bottom: 26px;
        }

        .konsep-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
            margin-bottom: 18px;
        }

        .konsep-card {
            border-radius: 24px;
            padding: 22px 20px;
            background: #fff;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.05);
            border: 1px solid #e8edf4;
        }

        .konsep-card.eksponen {
            background: linear-gradient(135deg, #fffdf6 0%, #fff8e9 100%);
            border: 1px solid #f2dfb4;
        }

        .konsep-card.aljabar {
            background: linear-gradient(135deg, #f8fcff 0%, #eef6ff 100%);
            border: 1px solid #d8e7fb;
        }

        .konsep-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 12px;
        }

        .badge-eksponen {
            background: #e0a11d;
        }

        .badge-aljabar {
            background: #4b86d1;
        }

        .konsep-title {
            font-size: 21px;
            font-weight: 800;
            color: #2c2c2c;
            margin-bottom: 10px;
        }

        .konsep-desc {
            font-size: 14px;
            line-height: 1.8;
            color: #414141;
        }

        .mini-rumus {
            margin-top: 12px;
            padding: 12px 14px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px dashed #d7d7d7;
            text-align: center;
            font-size: 22px;
            font-weight: 800;
            color: #2d3f54;
        }

        .ingat-box {
            margin-bottom: 16px;
            border-radius: 24px;
            padding: 18px 18px 16px;
            background: linear-gradient(180deg, #ffffff 0%, #fbfcff 100%);
            border: 1px solid #e6ecf3;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.04);
        }

        .ingat-title {
            font-size: 17px;
            font-weight: 800;
            color: #334250;
            margin-bottom: 14px;
            text-align: center;
        }

        .ingat-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }

        .ingat-card {
            background: #fff;
            border: 1px solid #e3e8ef;
            border-radius: 18px;
            padding: 14px 10px;
            text-align: center;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.03);
        }

        .ingat-rumus {
            font-size: 18px;
            font-weight: 800;
            color: #29405a;
            margin-bottom: 6px;
            line-height: 1.5;
        }

        .ingat-ket {
            font-size: 12px;
            line-height: 1.6;
            color: #66717b;
        }

        .rumus-section {
            margin-top: 28px;
            text-align: center;
        }

        .rumus-title {
            font-size: 17px;
            font-weight: 700;
            color: #55624f;
            margin-bottom: 12px;
        }

        .rumus-trigger {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 18px 34px;
            border-radius: 22px;
            cursor: pointer;
            font-size: 42px;
            font-weight: 800;
            color: #413c32;
            background: linear-gradient(135deg, #ffffff 0%, #f5fbff 100%);
            border: 2px solid #bdd7ff;
            box-shadow: 0 10px 25px rgba(92, 147, 255, 0.18);
            transition: all 0.35s ease;
        }

        .rumus-trigger:hover {
            transform: translateY(-4px) scale(1.02);
        }

        .rumus-trigger.active {
            border-color: #7db0ff;
            background: linear-gradient(135deg, #fafdff 0%, #edf6ff 100%);
        }

        .penjelasan-box {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transform: translateY(-10px);
            transition: all 0.5s ease;
        }

        .penjelasan-box.show {
            max-height: 2200px;
            opacity: 1;
            transform: translateY(0);
            margin-top: 24px;
        }

        .penjelasan-wrapper {
            background: linear-gradient(180deg, #ffffff 0%, #fbfcff 100%);
            border: 1px solid #e4ecf7;
            border-radius: 24px;
            padding: 28px 22px 22px;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.06);
        }

        .penjelasan-heading {
            text-align: center;
            font-size: 18px;
            font-weight: 800;
            color: #425146;
            margin-bottom: 24px;
        }

        .unsur-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 24px;
        }

        .unsur-card {
            background: #fff;
            border-radius: 20px;
            padding: 20px 14px 18px;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .unsur-card:hover {
            transform: translateY(-6px);
        }

        .unsur-line {
            width: 3px;
            height: 28px;
            border-radius: 10px;
            margin: 0 auto 12px;
        }

        .unsur-bubble {
            width: 108px;
            height: 78px;
            border-radius: 999px;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            font-weight: 800;
            background: #fff;
        }

        .unsur-name {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .unsur-desc {
            font-size: 14px;
            line-height: 1.7;
            color: #444;
        }

        .var-card {
            border-top: 5px solid #f2a31b;
            background: linear-gradient(180deg, #fffdfa 0%, #fff8ea 100%);
        }

        .var-line {
            background: #f2a31b;
        }

        .var-bubble {
            border: 3px solid #f2a31b;
            color: #222;
        }

        .var-name {
            color: #d58900;
        }

        .suku-card {
            border-top: 5px solid #6d8f6b;
            background: linear-gradient(180deg, #fafffa 0%, #eef7ef 100%);
        }

        .suku-line {
            background: #6d8f6b;
        }

        .suku-bubble {
            border: 3px solid #6d8f6b;
            color: #222;
        }

        .suku-name {
            color: #557154;
        }

        .koef-card {
            border-top: 5px solid #255b97;
            background: linear-gradient(180deg, #fbfdff 0%, #eef5ff 100%);
        }

        .koef-line {
            background: #255b97;
        }

        .koef-bubble {
            border: 3px solid #255b97;
            color: #222;
        }

        .koef-name {
            color: #255b97;
        }

        .konst-card {
            border-top: 5px solid #ef563d;
            background: linear-gradient(180deg, #fffdfd 0%, #fff2ef 100%);
        }

        .konst-line {
            background: #ef563d;
        }

        .konst-bubble {
            border: 3px solid #ef563d;
            color: #222;
        }

        .konst-name {
            color: #ef563d;
        }

        .detail-box {
            background: linear-gradient(180deg, #f8fbff 0%, #f4f8fc 100%);
            border: 1px solid #e1ebf5;
            border-radius: 18px;
            padding: 18px 18px 10px;
        }

        .detail-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 14px;
        }

        .detail-icon {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            margin-top: 5px;
            flex-shrink: 0;
        }

        .detail-text {
            font-size: 14px;
            line-height: 1.8;
            color: #2d2d2d;
            text-align: justify;
        }

        .icon-var {
            background: #f2a31b;
        }

        .icon-suku {
            background: #6d8f6b;
        }

        .icon-koef {
            background: #255b97;
        }

        .icon-konst {
            background: #ef563d;
        }

        .latihan-section {
            margin-top: 34px;
            width: 100%;
            overflow: visible !important;
            position: relative !important;
            z-index: 5 !important;
        }

        .question-card {
            width: 100%;
            background: linear-gradient(180deg, #ffffff 0%, #fcfcff 100%);
            border: 1px solid #e5e8ef;
            border-radius: 28px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.05);
            overflow: visible !important;
            position: relative !important;
            z-index: 6 !important;
        }

        .question-head {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 18px;
        }

        .question-number {
            width: 48px;
            height: 48px;
            min-width: 48px;
            border-radius: 50%;
            background: #aebf98;
            color: #fff;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .question-text {
            font-size: 18px;
            font-weight: 800;
            color: #253127;
            line-height: 1.5;
            margin-top: 6px;
        }

        .question-sub {
            font-size: 15px;
            color: #6b6b6b;
            margin-bottom: 18px;
        }

        .drag-words {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 20px;
            width: 100%;
            min-height: 50px;
            padding: 6px 0;
        }

        .drag-item {
            padding: 10px 16px;
            border-radius: 18px;
            background: #f9f0d8;
            border: 2px solid #e7b83d;
            cursor: grab;
            font-weight: 700;
            font-size: 15px;
            color: #7b5d08;
            user-select: none;
            -webkit-user-select: none;
            line-height: 1.5;
            transition: 0.2s;
            touch-action: manipulation;
        }

        .drag-item:active {
            cursor: grabbing;
        }

        .drag-item.selected-item {
            background: #fff3c4 !important;
            border-color: #c88f00 !important;
            box-shadow: 0 0 0 3px rgba(200, 143, 0, 0.15);
        }

        .drag-item.dragging {
            opacity: 0.7;
            transform: scale(1.03);
        }

        .drop-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
            width: 100%;
        }

        .drop-row {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 16px;
            align-items: center;
        }

        .drop-label {
            font-weight: 800;
            color: #2f3a30;
            background: #f3f7ed;
            border-radius: 14px;
            padding: 14px 16px;
            text-align: center;
            font-size: 16px;
        }

        .drop-zone {
            min-height: 60px;
            border: 2px dashed #b7c6d9;
            border-radius: 16px;
            background: #f8fbff;
            padding: 10px 12px;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            color: #7b8794;
            font-size: 14px;
            transition: 0.3s;
            gap: 8px;
            cursor: pointer;
        }

        .drop-zone.hovered {
            background: #eef6ff;
            border-color: #6ca7ff;
        }

        .drop-zone.correct {
            border-style: solid;
            border-color: #4caf50;
            background: #eef9ef;
            color: #1f6b24;
            font-weight: 700;
        }

        .drop-zone.wrong {
            border-style: solid;
            border-color: #f44336;
            background: #fff1f0;
            color: #a62b22;
            font-weight: 700;
        }

        .drop-zone.active-target {
            border-color: #6ca7ff !important;
            background: #eef6ff !important;
        }

        .placeholder {
            color: #7b8794;
            font-size: 14px;
        }

        .isian-wrap {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-top: 10px;
        }

        .isian-group {
            background: #f8faf7;
            border: 1px solid #e4eadf;
            border-radius: 16px;
            padding: 14px;
        }

        .isian-label {
            display: block;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #324034;
        }

        .isian-input {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #d9e3d1;
            border-radius: 12px;
            font-size: 15px;
            outline: none;
            transition: 0.3s;
        }

        .isian-input:focus {
            border-color: #9fb48d;
        }

        .isian-input.correct {
            border-color: #4caf50;
            background: #eef9ef;
        }

        .isian-input.wrong {
            border-color: #f44336;
            background: #fff1f0;
        }

        .opsi-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-top: 12px;
        }

        .opsi-card {
            border-radius: 18px;
            padding: 18px 16px;
            border: 2px solid #d8e0ea;
            background: #fff;
            cursor: pointer;
            transition: 0.3s;
            text-align: center;
            min-height: 120px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .opsi-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.06);
        }

        .opsi-card.selected {
            border-color: #6ca7ff;
            background: #eef6ff;
        }

        .opsi-rumus {
            font-size: 30px;
            font-weight: 800;
            color: #27322b;
            margin-bottom: 10px;
        }

        .opsi-desc {
            font-size: 14px;
            color: #5c646b;
            line-height: 1.6;
        }

        .opsi-card.correct {
            border-color: #4caf50;
            background: #eef9ef;
        }

        .opsi-card.wrong {
            border-color: #f44336;
            background: #fff1f0;
        }

        .feedback {
            margin-top: 14px;
            font-size: 14px;
            font-weight: 700;
            padding: 12px 14px;
            border-radius: 12px;
            display: none;
            line-height: 1.7;
        }

        .feedback.success {
            display: block !important;
            background: #eef9ef;
            color: #226829;
            border: 1px solid #b7dfbb;
        }

        .feedback.error {
            display: block !important;
            background: #fff1f0;
            color: #a62b22;
            border: 1px solid #f0c0bb;
        }

        .feedback.info {
            display: block !important;
            background: #eef6ff;
            color: #24527a;
            border: 1px solid #c6dcf5;
        }

        .feedback .explain {
            display: block;
            margin-top: 8px;
            font-weight: 500;
        }

        .alur-box {
            margin-top: 24px;
            background: linear-gradient(180deg, #ffffff 0%, #fcfcf8 100%);
            border: 1px solid #e6e4d8;
            border-radius: 28px;
            padding: 28px 26px;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.05);
        }

        .alur-header {
            text-align: center;
            margin-bottom: 26px;
        }

        .alur-title {
            font-size: 26px;
            font-weight: 800;
            color: #2f3a30;
            margin-bottom: 8px;
        }

        .alur-desc {
            font-size: 15px;
            color: #5f675d;
            line-height: 1.8;
            margin: 0;
        }

        .alur-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 26px;
        }

        .alur-card {
            position: relative;
            background: #fff;
            border: 1px solid #e7e6dc;
            border-radius: 22px;
            padding: 22px 18px 18px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
        }

        .alur-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 22px rgba(0, 0, 0, 0.07);
        }

        .alur-step {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #aebf98;
            color: #fff;
            font-size: 18px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
        }

        .alur-card-title {
            font-size: 20px;
            font-weight: 800;
            color: #2f3a30;
            margin-bottom: 10px;
        }

        .alur-card-text {
            font-size: 15px;
            line-height: 1.9;
            color: #3b3b3b;
            text-align: left;
            min-height: 120px;
        }

        .alur-rumus {
            margin-top: 14px;
            text-align: center;
            font-size: 28px;
            font-weight: 800;
            color: #2e4053;
            background: #f8faf7;
            border: 1px dashed #cfd8c4;
            border-radius: 16px;
            padding: 14px 10px;
        }

        .hasil-box {
            background: linear-gradient(135deg, #f8fbf5 0%, #f2f7ee 100%);
            border: 1px solid #dfe7d7;
            border-radius: 24px;
            padding: 24px 20px;
            text-align: center;
        }

        .hasil-label {
            font-size: 16px;
            font-weight: 700;
            color: #60705f;
            margin-bottom: 10px;
        }

        .hasil-rumus {
            font-size: 38px;
            font-weight: 800;
            color: #2f3a30;
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .hasil-text {
            font-size: 15px;
            line-height: 1.8;
            color: #4d554b;
            max-width: 760px;
            margin: 0 auto;
        }

        @media (max-width: 992px) {

            .konsep-grid,
            .alur-grid,
            .ingat-grid,
            .unsur-grid,
            .opsi-grid,
            .isian-wrap {
                grid-template-columns: 1fr 1fr;
            }

            .alur-card-text {
                min-height: auto;
            }

            .hasil-rumus {
                font-size: 30px;
            }
        }

        @media (max-width: 768px) {
            .materi-title {
                font-size: 24px;
            }

            .materi-text {
                font-size: 14px;
            }

            .rumus-trigger {
                font-size: 30px;
                padding: 15px 22px;
                border-radius: 18px;
            }

            .konsep-grid,
            .ingat-grid,
            .unsur-grid,
            .opsi-grid,
            .isian-wrap,
            .alur-grid {
                grid-template-columns: 1fr;
            }

            .drop-row {
                grid-template-columns: 1fr;
            }

            .question-text {
                font-size: 17px;
            }

            .question-card {
                padding: 18px;
            }

            .drag-item {
                width: 100%;
                font-size: 15px;
            }

            .hasil-rumus {
                font-size: 22px;
            }
        }

        #questionCard1 {
            padding: 16px;
            border-radius: 22px;
        }

        #questionCard1 .question-head {
            gap: 12px;
            margin-bottom: 14px;
        }

        #questionCard1 .question-number {
            width: 38px;
            height: 38px;
            min-width: 38px;
            font-size: 17px;
        }

        #questionCard1 .question-text {
            font-size: 16px;
            line-height: 1.4;
            margin-top: 2px;
        }

        #questionCard1 .question-sub {
            font-size: 13px;
            margin-bottom: 14px;
        }

        #questionCard1 .drag-words {
            gap: 8px;
            margin-bottom: 14px;
        }

        #questionCard1 .drag-item {
            padding: 8px 12px;
            font-size: 13px;
            border-radius: 14px;
        }

        #questionCard1 .drop-grid {
            gap: 12px;
        }

        #questionCard1 .drop-row {
            grid-template-columns: 150px 1fr;
            gap: 12px;
        }

        #questionCard1 .drop-label {
            font-size: 14px;
            padding: 10px 12px;
            border-radius: 12px;
        }

        #questionCard1 .drop-zone {
            min-height: 48px;
            padding: 8px 10px;
            font-size: 13px;
            border-radius: 12px;
        }

        #questionCard1 .placeholder {
            font-size: 13px;
        }

        #questionCard1 .feedback {
            font-size: 13px;
            padding: 10px 12px;
            border-radius: 10px;
        }
    </style>

    <style>
        .intro-wrap {
            margin-bottom: 28px;
        }

        .konsep-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
            margin-bottom: 18px;
        }

        .konsep-card {
            position: relative;
            overflow: hidden;
            border-radius: 26px;
            padding: 24px 22px 22px;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.05);
            border: 1px solid #e7ecf2;
            transition: all 0.3s ease;
        }

        .konsep-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 30px rgba(0, 0, 0, 0.08);
        }

        .konsep-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 7px;
        }

        .konsep-card.eksponen {
            background: linear-gradient(135deg, #fffdf5 0%, #fff7df 100%);
        }

        .konsep-card.eksponen::before {
            background: linear-gradient(90deg, #f0b429, #ffd56a);
        }

        .konsep-card.aljabar {
            background: linear-gradient(135deg, #f7fbff 0%, #edf5ff 100%);
        }

        .konsep-card.aljabar::before {
            background: linear-gradient(90deg, #5d8fd6, #8eb6f2);
        }

        .konsep-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 12px;
            letter-spacing: 0.4px;
        }

        .badge-eksponen {
            background: #d89b17;
        }

        .badge-aljabar {
            background: #4e84cf;
        }

        .konsep-title {
            font-size: 22px;
            font-weight: 800;
            color: #24313f;
            margin-bottom: 10px;
        }

        .konsep-desc {
            font-size: 14px;
            line-height: 1.85;
            color: #424242;
        }

        .mini-rumus {
            margin-top: 14px;
            padding: 13px 16px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.88);
            border: 1px dashed #d2d9e2;
            text-align: center;
            font-size: 23px;
            font-weight: 800;
            color: #2e4155;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.5);
        }

        .ringkasan-box {
            margin-bottom: 16px;
            border-radius: 26px;
            padding: 20px 18px 18px;
            background: linear-gradient(180deg, #ffffff 0%, #fbfcff 100%);
            border: 1px solid #e5ebf3;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.04);
        }

        .ringkasan-header {
            text-align: center;
            margin-bottom: 14px;
        }

        .ringkasan-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 999px;
            background: #aebf98;
            color: #fff;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.4px;
            margin-bottom: 10px;
        }

        .ringkasan-title {
            font-size: 20px;
            font-weight: 800;
            color: #2f3a30;
            margin-bottom: 4px;
        }

        .ringkasan-subtitle {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.7;
        }

        .ingat-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
        }

        .ingat-card {
            position: relative;
            overflow: hidden;
            background: #fff;
            border: 1px solid #e4e9f0;
            border-radius: 20px;
            padding: 16px 12px 14px;
            text-align: center;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }

        .ingat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 22px rgba(0, 0, 0, 0.07);
        }

        .ingat-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
        }

        .eksponen-card::before {
            background: linear-gradient(90deg, #f0b429, #ffd56a);
        }

        .aljabar-card::before {
            background: linear-gradient(90deg, #5d8fd6, #8eb6f2);
        }

        .ingat-icon {
            font-size: 20px;
            margin-bottom: 8px;
        }

        .ingat-rumus {
            font-size: 20px;
            font-weight: 800;
            color: #29405a;
            margin-bottom: 6px;
            line-height: 1.5;
        }

        .ingat-ket {
            font-size: 12.5px;
            line-height: 1.65;
            color: #66717b;
        }

        .note-mini {
            margin-top: 12px;
            font-size: 13px;
            color: #5f6770;
            text-align: center;
            line-height: 1.7;
        }

        @media (max-width: 992px) {

            .konsep-grid,
            .ingat-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {

            .konsep-grid,
            .ingat-grid {
                grid-template-columns: 1fr;
            }

            .konsep-title {
                font-size: 20px;
            }

            .mini-rumus {
                font-size: 20px;
            }
        }

        .transisi-box {
            margin: 26px 0 20px;
            padding: 18px 20px;
            border-radius: 20px;
            background: linear-gradient(135deg, #f7faf6 0%, #eef4ea 100%);
            border: 1px solid #dce7d3;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.04);
        }

        .transisi-content {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .transisi-icon {
            font-size: 28px;
        }

        .transisi-title {
            font-size: 16px;
            font-weight: 800;
            color: #2f3a30;
            margin-bottom: 3px;
        }

        .transisi-desc {
            font-size: 13px;
            color: #5f6b5c;
            line-height: 1.6;
        }

        .klik-card {
            height: 330px;
            overflow: hidden;
            cursor: pointer;
        }

        .alur-preview {
            font-size: 15px;
            line-height: 1.8;
            color: #5f675d;
            margin-top: 12px;
        }

        .alur-detail {
            max-height: 0;
            opacity: 0;
            overflow-y: auto;
            transition: all 0.4s ease;
            padding-right: 6px;
        }

        .klik-card.active .alur-detail {
            max-height: 210px;
            opacity: 1;
            margin-top: 14px;
        }

        .klik-card.active .alur-preview {
            display: none;
        }

        .klik-card .alur-rumus {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 10px;
        }

        .hasil-menarik {
            position: relative;
            overflow: hidden;
            padding: 30px 24px;
        }

        .hasil-menarik::before {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            background: rgba(174, 191, 152, 0.16);
            border-radius: 50%;
            top: -70px;
            left: -60px;
        }

        .hasil-menarik::after {
            content: "";
            position: absolute;
            width: 160px;
            height: 160px;
            background: rgba(240, 180, 41, 0.13);
            border-radius: 50%;
            bottom: -70px;
            right: -50px;
        }

        .hasil-badge {
            position: relative;
            z-index: 1;
            display: inline-block;
            padding: 7px 16px;
            border-radius: 999px;
            background: #aebf98;
            color: #fff;
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .hasil-menarik .hasil-label,
        .hasil-menarik .hasil-rumus,
        .hasil-komponen,
        .hasil-kalimat {
            position: relative;
            z-index: 1;
        }

        .hasil-menarik .hasil-rumus {
            font-size: 46px;
            margin: 10px 0 22px;
        }

        .hasil-komponen {
            display: flex;
            justify-content: center;
            align-items: stretch;
            gap: 12px;
            margin: 20px auto;
            flex-wrap: wrap;
        }

        .komponen-card {
            width: 180px;
            background: #ffffff;
            border: 1px solid #dfe7d7;
            border-radius: 20px;
            padding: 16px 12px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.04);
            transition: 0.3s ease;
        }

        .komponen-card:hover {
            transform: translateY(-4px);
        }

        .komponen-icon {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .komponen-title {
            font-size: 14px;
            font-weight: 700;
            color: #5b6658;
            margin-bottom: 6px;
        }

        .komponen-rumus {
            font-size: 26px;
            font-weight: 800;
            color: #2f3a30;
        }

        .komponen-plus {
            display: flex;
            align-items: center;
            font-size: 28px;
            font-weight: 800;
            color: #8ca178;
        }

        .hasil-kalimat {
            margin-top: 18px;
            font-size: 17px;
            line-height: 1.8;
            color: #4d554b;
        }

        @media (max-width: 768px) {
            .hasil-menarik .hasil-rumus {
                font-size: 32px;
            }

            .komponen-card {
                width: 100%;
            }

            .komponen-plus {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <div class="materi-container">
        <div class="materi-title">APERSEPSI</div>

        <!-- PENGANTAR EKSPONEN DAN ALJABAR -->
        <div class="intro-wrap">
            <div class="konsep-grid">
                <div class="konsep-card eksponen">
                    <div class="konsep-title">Eksponen</div>
                    <div class="konsep-desc">
                        Eksponen adalah bentuk singkat dari <strong>perkalian berulang</strong> pada bilangan yang sama.
                        Jadi, <strong>x²</strong> berarti <strong>x × x</strong>.
                        <div class="mini-rumus">x × x = x<sup>2</sup></div>
                    </div>
                </div>

                <div class="konsep-card aljabar">
                    <div class="konsep-title">Aljabar</div>
                    <div class="konsep-desc">
                        Aljabar adalah bentuk matematika yang memuat <strong>angka</strong>,
                        <strong>huruf/variabel</strong>, dan <strong>operasi hitung</strong>.
                        Variabel dipakai untuk menyatakan nilai yang belum diketahui.
                        <div class="mini-rumus">2x + 5</div>
                    </div>
                </div>
            </div>

            <!-- SIFAT EKSPONEN -->
            <div class="ringkasan-box">
                <div class="ringkasan-header">
                    <div class="ringkasan-title">Sifat-Sifat Eksponen</div>
                    <div class="ringkasan-subtitle">
                        Sifat ini membantu menyederhanakan bentuk berpangkat dengan cepat.
                    </div>
                </div>

                <div class="ingat-grid">
                    <div class="ingat-card eksponen-card">
                        <div class="ingat-icon">✦</div>
                        <div class="ingat-rumus">a<sup>m</sup> × a<sup>n</sup></div>
                        <div class="ingat-ket">= a<sup>m+n</sup><br>Pangkat dijumlahkan</div>
                    </div>

                    <div class="ingat-card eksponen-card">
                        <div class="ingat-icon">✦</div>
                        <div class="ingat-rumus">a<sup>m</sup> : a<sup>n</sup></div>
                        <div class="ingat-ket">= a<sup>m-n</sup><br>dengan a ≠ 0</div>
                    </div>

                    <div class="ingat-card eksponen-card">
                        <div class="ingat-icon">✦</div>
                        <div class="ingat-rumus">(a<sup>m</sup>)<sup>n</sup></div>
                        <div class="ingat-ket">= a<sup>mn</sup><br>Pangkat dikalikan</div>
                    </div>

                    <div class="ingat-card eksponen-card">
                        <div class="ingat-icon">✦</div>
                        <div class="ingat-rumus">a<sup>0</sup></div>
                        <div class="ingat-ket">= 1<br>untuk a ≠ 0</div>
                    </div>
                </div>

                <div class="note-mini">
                    Contoh yang akan muncul pada apersepsi ini adalah <strong>x × x = x²</strong>.
                </div>
            </div>

            <!-- SIFAT ALJABAR -->
            <div class="ringkasan-box">
                <div class="ringkasan-header">
                    <div class="ringkasan-title">Konsep Dasar Aljabar</div>
                    <div class="ringkasan-subtitle">
                        Bagian ini menjadi pengingat singkat sebelum masuk ke bentuk aljabar pada cerita.
                    </div>
                </div>

                <div class="ingat-grid">
                    <div class="ingat-card aljabar-card">
                        <div class="ingat-icon">◆</div>
                        <div class="ingat-rumus">Suku sejenis</div>
                        <div class="ingat-ket">dapat dijumlahkan atau dikurangkan</div>
                    </div>

                    <div class="ingat-card aljabar-card">
                        <div class="ingat-icon">◆</div>
                        <div class="ingat-rumus">ax + bx</div>
                        <div class="ingat-ket">= (a+b)x</div>
                    </div>

                    <div class="ingat-card aljabar-card">
                        <div class="ingat-icon">◆</div>
                        <div class="ingat-rumus">ab</div>
                        <div class="ingat-ket">berarti a × b</div>
                    </div>

                    <div class="ingat-card aljabar-card">
                        <div class="ingat-icon">◆</div>
                        <div class="ingat-rumus">Konstanta</div>
                        <div class="ingat-ket">bilangan yang tidak memuat variabel</div>
                    </div>
                </div>

                <div class="note-mini">
                    Dalam bentuk <strong>3x² + 2x + 5</strong>, sukunya adalah <strong>3x²</strong>, <strong>2x</strong>,
                    dan <strong>5</strong>.
                </div>
            </div>
        </div>

        <!-- TRANSISI KE CERITA -->
        <div class="transisi-box">
            <div class="transisi-content">
                <div class="transisi-text">
                    <div class="transisi-title">Sekarang kita lihat dalam kehidupan sehari-hari</div>
                </div>
            </div>
        </div>

        <!-- CERITA -->
        <p class="materi-text">
            Seorang pedagang buah menyimpan buahnya di dalam beberapa kardus.
            Banyak buah dalam satu kardus dinyatakan dengan <strong>x</strong>.
        </p>

        <div class="gambar-box">
            <img src="{{ asset('img/kardusbuah.png') }}" alt="Gambar kardus buah">
        </div>

        <!-- MENYUSUN BENTUK ALJABAR -->
        <div class="alur-box">
            <div class="alur-header">
                <h3 class="alur-title">Menyusun bentuk aljabar dari cerita kardus buah</h3>
                <p class="alur-desc">
                    Klik setiap langkah untuk melihat penjelasannya.
                </p>
            </div>

            <div class="alur-grid">

                <!-- LANGKAH 1 -->
                <div class="alur-card klik-card">
                    <div class="alur-step">1</div>
                    <div class="alur-card-title">Susunan Kardus</div>

                    <div class="alur-preview">
                        Klik untuk melihat mengapa susunan kardus menjadi <strong>3x<sup>2</sup></strong>.
                    </div>

                    <div class="alur-detail">
                        <div class="alur-card-text">
                            Perhatikan <strong>1 susunan kardus</strong>.
                            Susunan ini berbentuk persegi.
                            Terdapat <strong>x baris</strong> dan setiap baris berisi <strong>x buah</strong>.
                        </div>

                        <div class="alur-rumus">
                            x × x = x<sup>2</sup>
                        </div>

                        <div class="alur-card-text">
                            Artinya, <strong>1 susunan = x<sup>2</sup> buah</strong>.
                            Karena ada <strong>3 susunan</strong>, maka:
                        </div>

                        <div class="alur-rumus">
                            3 × x<sup>2</sup> = 3x<sup>2</sup>
                        </div>

                        <div class="alur-card-text">
                            Jadi, buah dari semua susunan adalah <strong>3x<sup>2</sup></strong>.
                        </div>
                    </div>
                </div>

                <!-- LANGKAH 2 -->
                <div class="alur-card klik-card">
                    <div class="alur-step">2</div>
                    <div class="alur-card-title">Kardus Tambahan</div>

                    <div class="alur-preview">
                        Klik untuk melihat mengapa kardus tambahan menjadi <strong>2x</strong>.
                    </div>

                    <div class="alur-detail">
                        <div class="alur-card-text">
                            Selain itu, ada <strong>2 kardus tambahan</strong>.
                            Setiap kardus berisi <strong>x buah</strong>.
                        </div>

                        <div class="alur-rumus">
                            2 × x = 2x
                        </div>

                        <div class="alur-card-text">
                            Jadi, tambahan buahnya adalah <strong>2x</strong>.
                        </div>
                    </div>
                </div>

                <!-- LANGKAH 3 -->
                <div class="alur-card klik-card">
                    <div class="alur-step">3</div>
                    <div class="alur-card-title">Buah Lepas</div>

                    <div class="alur-preview">
                        Klik untuk melihat mengapa buah lepas ditulis sebagai <strong>5</strong>.
                    </div>

                    <div class="alur-detail">
                        <div class="alur-card-text">
                            Di luar kardus, terdapat <strong>5 buah lepas</strong>.
                            Buah ini tidak menggunakan variabel, sehingga langsung ditulis sebagai:
                        </div>

                        <div class="alur-rumus">
                            5
                        </div>
                    </div>
                </div>

            </div>

            <!-- HASIL -->
            <div class="hasil-box hasil-menarik">
                <div class="hasil-badge">Kesimpulan</div>

                <div class="hasil-label">Sekarang kita jumlahkan semua bagian cerita</div>

                <div class="hasil-rumus">
                    3x<sup>2</sup> + 2x + 5
                </div>

                <div class="hasil-komponen">
                    <div class="komponen-card">
                        <div class="komponen-icon">📦</div>
                        <div class="komponen-title">Susunan Kardus</div>
                        <div class="komponen-rumus">3x<sup>2</sup></div>
                    </div>

                    <div class="komponen-plus">+</div>

                    <div class="komponen-card">
                        <div class="komponen-icon">➕</div>
                        <div class="komponen-title">Kardus Tambahan</div>
                        <div class="komponen-rumus">2x</div>
                    </div>

                    <div class="komponen-plus">+</div>

                    <div class="komponen-card">
                        <div class="komponen-icon">🍎</div>
                        <div class="komponen-title">Buah Lepas</div>
                        <div class="komponen-rumus">5</div>
                    </div>
                </div>

                <div class="hasil-kalimat">
                    Jadi, bentuk aljabarnya adalah
                    <strong>3x<sup>2</sup> + 2x + 5</strong>.
                </div>
            </div>
        </div>
    </div>

    <!-- UNSUR-UNSUR ALJABAR -->
    <div class="rumus-section">
        <div class="rumus-title">Klik untuk melihat unsur-unsurnya</div>

        <div id="rumusTrigger" class="rumus-trigger">
            3x<sup>2</sup> + 2x + 5
        </div>

        <div id="penjelasanBox" class="penjelasan-box">
            <div class="penjelasan-wrapper">
                <div class="penjelasan-heading">
                    Unsur-unsur pada bentuk aljabar <strong>3x<sup>2</sup> + 2x + 5</strong>
                </div>

                <div class="unsur-grid">
                    <div class="unsur-card suku-card">
                        <div class="unsur-line suku-line"></div>
                        <div class="unsur-bubble suku-bubble">3</div>
                        <div class="unsur-name suku-name">Banyak Suku</div>
                        <div class="unsur-desc">
                            Banyak suku menunjukkan jumlah bagian pada bentuk aljabar yang dipisahkan oleh
                            tanda tambah atau tanda kurang.
                        </div>
                    </div>

                    <div class="unsur-card var-card">
                        <div class="unsur-line var-line"></div>
                        <div class="unsur-bubble var-bubble">x</div>
                        <div class="unsur-name var-name">Variabel</div>
                        <div class="unsur-desc">
                            Variabel merupakan suatu lambang pengganti pada suatu bilangan yang belum
                            diketahui nilainya dengan jelas.
                        </div>
                    </div>

                    <div class="unsur-card koef-card">
                        <div class="unsur-line koef-line"></div>
                        <div class="unsur-bubble koef-bubble">3 &amp; 2</div>
                        <div class="unsur-name koef-name">Koefisien</div>
                        <div class="unsur-desc">
                            Koefisien merupakan bilangan yang memuat atau mengalikan variabel dalam suatu
                            suku pada bentuk aljabar.
                        </div>
                    </div>

                    <div class="unsur-card konst-card">
                        <div class="unsur-line konst-line"></div>
                        <div class="unsur-bubble konst-bubble">5</div>
                        <div class="unsur-name konst-name">Konstanta</div>
                        <div class="unsur-desc">
                            Konstanta adalah suku dalam bentuk aljabar yang berupa bilangan dan tidak
                            memuat variabel.
                        </div>
                    </div>
                </div>

                <div class="detail-box">
                    <div class="detail-item">
                        <div class="detail-icon icon-var"></div>
                        <div class="detail-text">
                            <strong>Variabel</strong> merupakan suatu lambang pengganti pada suatu bilangan
                            yang belum diketahui nilainya dengan jelas. Variabel disebut juga sebagai
                            <strong>peubah</strong> dan biasanya dilambangkan dengan huruf kecil seperti
                            <strong>a, b, c, ..., z</strong>. Pada bentuk aljabar
                            <strong>3x<sup>2</sup> + 2x + 5</strong>, variabelnya adalah <strong>x</strong>.
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-icon icon-suku"></div>
                        <div class="detail-text">
                            <strong>Suku</strong> merupakan bagian dari bentuk aljabar yang terdiri dari
                            variabel beserta koefisiennya atau berupa konstanta, yang dipisahkan oleh
                            operasi jumlah atau selisih. Pada bentuk ini, sukunya adalah
                            <strong>3x<sup>2</sup></strong>, <strong>2x</strong>, dan <strong>5</strong>.
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-icon icon-koef"></div>
                        <div class="detail-text">
                            <strong>Koefisien</strong> merupakan bilangan yang memuat atau mengalikan
                            variabel dalam suatu suku pada bentuk aljabar. Pada bentuk ini, koefisien
                            <strong>3</strong> terdapat pada <strong>3x<sup>2</sup></strong>, sedangkan
                            koefisien <strong>2</strong> terdapat pada <strong>2x</strong>.
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-icon icon-konst"></div>
                        <div class="detail-text">
                            <strong>Konstanta</strong> adalah suku dalam bentuk aljabar yang berupa
                            bilangan dan tidak memuat variabel. Pada bentuk ini, konstantanya adalah
                            <strong>5</strong>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SOAL ALJABAR -->
    <div class="latihan-section">
        <div class="question-card" id="questionCard1" data-question="1">
            <div class="question-head">
                <div class="question-number">1</div>
                <div class="question-text">Pasangkan istilah dengan pengertiannya yang tepat.</div>
            </div>

            <div class="question-sub">Seret jawaban yang tepat ke kotak yang sesuai.</div>

            <div class="drag-words" id="dragWords">
                <div class="drag-item" draggable="true" data-answer="koefisien">
                    Bilangan yang memuat variabel dari sebuah suku pada bentuk aljabar
                </div>
                <div class="drag-item" draggable="true" data-answer="suku">
                    Variabel sekaligus koefisiennya atau konstanta pada bentuk aljabar yang dipisahkan oleh operasi
                    jumlah atau selisih
                </div>
                <div class="drag-item" draggable="true" data-answer="variabel">
                    Lambang pengganti pada suatu bilangan yang belum diketahui nilainya dengan jelas
                </div>
            </div>

            <div class="drop-grid">
                <div class="drop-row">
                    <div class="drop-label">Suku</div>
                    <div class="drop-zone" data-match="suku">
                        <span class="placeholder">Letakkan jawaban di sini</span>
                    </div>
                </div>

                <div class="drop-row">
                    <div class="drop-label">Variabel</div>
                    <div class="drop-zone" data-match="variabel">
                        <span class="placeholder">Letakkan jawaban di sini</span>
                    </div>
                </div>

                <div class="drop-row">
                    <div class="drop-label">Koefisien</div>
                    <div class="drop-zone" data-match="koefisien">
                        <span class="placeholder">Letakkan jawaban di sini</span>
                    </div>
                </div>
            </div>

            <div id="feedback1" class="feedback"></div>
        </div>

        <div class="question-card" id="questionCard2" data-question="2">
            <div class="question-head">
                <div class="question-number">2</div>
                <div class="question-text">
                    Berapa banyak suku yang terdapat pada bentuk <strong>2x + 5</strong> dan
                    <strong>3x² + 2x + 5</strong>?
                </div>
            </div>

            <div class="question-sub">Isi jumlah suku dengan benar.</div>

            <div class="isian-wrap">
                <div class="isian-group">
                    <label class="isian-label">Jumlah suku pada <strong>2x + 5</strong></label>
                    <input type="text" id="jawab2a" class="isian-input" placeholder="Masukkan jawaban">
                </div>

                <div class="isian-group">
                    <label class="isian-label">Jumlah suku pada <strong>3x² + 2x + 5</strong></label>
                    <input type="text" id="jawab2b" class="isian-input" placeholder="Masukkan jawaban">
                </div>
            </div>

            <div id="feedback2" class="feedback"></div>
        </div>

        <div class="question-card" id="questionCard3" data-question="3">
            <div class="question-head">
                <div class="question-number">3</div>
                <div class="question-text">Apa makna dari bentuk <strong>x²</strong> pada cerita kardus buah?</div>
            </div>

            <div class="question-sub">Klik salah satu kotak jawaban yang paling tepat.</div>

            <div class="opsi-grid" id="opsiSoal3">
                <div class="opsi-card" data-benar="false" data-choice-question="3">
                    <div class="opsi-rumus">x²</div>
                    <div class="opsi-desc">
                        Banyak buah lepas yang tidak dimasukkan ke dalam kardus.
                    </div>
                </div>

                <div class="opsi-card" data-benar="true" data-choice-question="3">
                    <div class="opsi-rumus">x²</div>
                    <div class="opsi-desc">
                        Banyak buah dalam satu susunan persegi, karena terdapat x baris dan x kolom sehingga
                        menjadi x × x.
                    </div>
                </div>

                <div class="opsi-card" data-benar="false" data-choice-question="3">
                    <div class="opsi-rumus">x²</div>
                    <div class="opsi-desc">
                        Banyak kardus tambahan di luar susunan utama.
                    </div>
                </div>
            </div>

            <div id="feedback3" class="feedback"></div>
        </div>
    </div>

    <script>
        (function () {
            let initialized = false;

            function initMateriInteraktif() {
                if (initialized) return;
                initialized = true;

                let draggedItem = null;
                let selectedDragItem = null;

                const selectedChoices = {
                    3: null
                };

                function paksaTampilFeedback(id, tipe, pesan) {
                    const el = document.getElementById(id);
                    if (!el) return;
                    el.className = 'feedback ' + tipe;
                    el.style.display = 'block';
                    el.innerHTML = pesan;
                }

                function resetFeedback(id) {
                    const el = document.getElementById(id);
                    if (!el) return;
                    el.className = 'feedback';
                    el.style.display = 'none';
                    el.innerHTML = '';
                }

                function createPlaceholder() {
                    const span = document.createElement('span');
                    span.className = 'placeholder';
                    span.innerText = 'Letakkan jawaban di sini';
                    return span;
                }

                function clearSelectedDragItem() {
                    document.querySelectorAll('#questionCard1 .drag-item').forEach(item => {
                        item.classList.remove('selected-item');
                    });

                    document.querySelectorAll('#questionCard1 .drop-zone').forEach(zone => {
                        zone.classList.remove('active-target');
                    });

                    selectedDragItem = null;
                }

                function removeItemFromCurrentPlace(item) {
                    if (!item) return;

                    const parentZone = item.closest('.drop-zone');
                    if (parentZone) {
                        item.remove();
                        if (!parentZone.querySelector('.drag-item')) {
                            parentZone.appendChild(createPlaceholder());
                        }
                        return;
                    }

                    const bank = document.getElementById('dragWords');
                    if (bank && bank.contains(item)) {
                        item.remove();
                    }
                }

                function moveItemToZone(item, zone) {
                    const bank = document.getElementById('dragWords');
                    if (!item || !zone) return;

                    const oldItem = zone.querySelector('.drag-item');
                    if (oldItem && oldItem !== item && bank) {
                        oldItem.remove();
                        bank.appendChild(oldItem);
                    }

                    removeItemFromCurrentPlace(item);

                    const ph = zone.querySelector('.placeholder');
                    if (ph) ph.remove();

                    zone.appendChild(item);
                    clearSelectedDragItem();
                    cekSoal1();
                }

                function moveItemToBank(item) {
                    const bank = document.getElementById('dragWords');
                    if (!item || !bank) return;

                    removeItemFromCurrentPlace(item);
                    bank.appendChild(item);
                    clearSelectedDragItem();
                    cekSoal1();
                }

                function initDragDrop() {
                    const dragItems = document.querySelectorAll('#questionCard1 .drag-item');
                    const dropZones = document.querySelectorAll('#questionCard1 .drop-zone');
                    const bank = document.getElementById('dragWords');

                    dragItems.forEach(item => {
                        item.setAttribute('draggable', 'true');

                        item.addEventListener('dragstart', function (e) {
                            draggedItem = this;
                            this.classList.add('dragging', 'selected-item');

                            if (e.dataTransfer) {
                                e.dataTransfer.effectAllowed = 'move';
                                e.dataTransfer.setData('text/plain', this.getAttribute('data-answer') || '');
                            }
                        });

                        item.addEventListener('dragend', function () {
                            this.classList.remove('dragging', 'selected-item');
                            draggedItem = null;

                            document.querySelectorAll('#questionCard1 .drop-zone').forEach(zone => {
                                zone.classList.remove('hovered');
                            });
                        });

                        item.addEventListener('click', function (e) {
                            e.preventDefault();
                            e.stopPropagation();

                            const alreadySelected = this.classList.contains('selected-item');
                            clearSelectedDragItem();

                            if (!alreadySelected) {
                                this.classList.add('selected-item');
                                selectedDragItem = this;

                                document.querySelectorAll('#questionCard1 .drop-zone').forEach(zone => {
                                    zone.classList.add('active-target');
                                });
                            }
                        });
                    });

                    dropZones.forEach(zone => {
                        zone.addEventListener('dragover', function (e) {
                            e.preventDefault();
                            this.classList.add('hovered');
                        });

                        zone.addEventListener('dragleave', function () {
                            this.classList.remove('hovered');
                        });

                        zone.addEventListener('drop', function (e) {
                            e.preventDefault();
                            this.classList.remove('hovered');

                            if (!draggedItem) return;
                            moveItemToZone(draggedItem, this);
                        });

                        zone.addEventListener('click', function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                            if (!selectedDragItem) return;
                            moveItemToZone(selectedDragItem, this);
                        });
                    });

                    if (bank) {
                        bank.addEventListener('dragover', function (e) {
                            e.preventDefault();
                        });

                        bank.addEventListener('drop', function (e) {
                            e.preventDefault();
                            if (!draggedItem) return;
                            moveItemToBank(draggedItem);
                        });

                        bank.addEventListener('click', function (e) {
                            if (!selectedDragItem) return;
                            const clickedDragItem = e.target.closest('.drag-item');
                            if (clickedDragItem) return;
                            moveItemToBank(selectedDragItem);
                        });
                    }
                }

                function handleChoiceSelection(el) {
                    const question = el.getAttribute('data-choice-question');
                    if (!question) return;

                    document.querySelectorAll('[data-choice-question="' + question + '"]').forEach(card => {
                        card.classList.remove('selected', 'correct', 'wrong');
                    });

                    el.classList.add('selected');
                    selectedChoices[question] = el;

                    if (question === '3') cekSoal3();
                }

                window.togglePenjelasan = function () {
                    const box = document.getElementById('penjelasanBox');
                    const trigger = document.getElementById('rumusTrigger');

                    if (box) box.classList.toggle('show');
                    if (trigger) trigger.classList.toggle('active');
                };

                const rumusTrigger = document.getElementById('rumusTrigger');
                if (rumusTrigger) {
                    rumusTrigger.addEventListener('click', function (e) {
                        e.preventDefault();
                        window.togglePenjelasan();
                    });
                }

                function normalizeText(value) {
                    return (value || '')
                        .toLowerCase()
                        .trim()
                        .replace(/\s+/g, '')
                        .replace(/−/g, '-')
                        .replace(/²/g, '^2')
                        .replace(/³/g, '^3');
                }

                function cekSoal1() {
                    const zones = document.querySelectorAll('#questionCard1 .drop-zone');
                    let benar = 0;
                    let terisi = 0;

                    zones.forEach(zone => {
                        zone.classList.remove('correct', 'wrong');

                        const item = zone.querySelector('.drag-item');
                        const match = zone.getAttribute('data-match');

                        if (!item) return;

                        terisi++;
                        const answer = item.getAttribute('data-answer');

                        if (answer === match) {
                            zone.classList.add('correct');
                            benar++;
                        } else {
                            zone.classList.add('wrong');
                        }
                    });

                    if (terisi === 0) {
                        resetFeedback('feedback1');
                        return;
                    }

                    if (terisi < 3) {
                        paksaTampilFeedback(
                            'feedback1',
                            'info',
                            'Lanjutkan mengisi semua kotak jawaban.'
                        );
                        return;
                    }

                    if (benar === 3) {
                        paksaTampilFeedback(
                            'feedback1',
                            'success',
                            'Hebat. Semua jawaban pada soal 1 sudah benar.' +
                            '<span class="explain">Penjelasan: suku adalah bagian bentuk aljabar yang dipisahkan tanda + atau -, variabel adalah huruf/simbol yang nilainya dapat berubah, sedangkan koefisien adalah bilangan yang mengalikan variabel.</span>'
                        );
                    } else {
                        paksaTampilFeedback(
                            'feedback1',
                            'error',
                            'Masih ada jawaban soal 1 yang belum tepat.'
                        );
                    }
                }

                function cekSoal2() {
                    const a = document.getElementById('jawab2a');
                    const b = document.getElementById('jawab2b');
                    if (!a || !b) return;

                    const valA = normalizeText(a.value);
                    const valB = normalizeText(b.value);

                    const kosongA = valA === '';
                    const kosongB = valB === '';

                    a.classList.remove('correct', 'wrong');
                    b.classList.remove('correct', 'wrong');

                    if (kosongA && kosongB) {
                        resetFeedback('feedback2');
                        return;
                    }

                    const benarA = (valA === '2' || valA === 'dua');
                    const benarB = (valB === '3' || valB === 'tiga');

                    if (!kosongA) a.classList.add(benarA ? 'correct' : 'wrong');
                    if (!kosongB) b.classList.add(benarB ? 'correct' : 'wrong');

                    if (!kosongA && !kosongB && benarA && benarB) {
                        paksaTampilFeedback(
                            'feedback2',
                            'success',
                            'Bagus. Jumlah suku pada kedua bentuk sudah benar.' +
                            '<span class="explain">Penjelasan: bentuk <strong>2x + 5</strong> memiliki 2 suku, yaitu <strong>2x</strong> dan <strong>5</strong>. Bentuk <strong>3x² + 2x + 5</strong> memiliki 3 suku, yaitu <strong>3x²</strong>, <strong>2x</strong>, dan <strong>5</strong>.</span>'
                        );
                    } else if (!kosongA || !kosongB) {
                        paksaTampilFeedback(
                            'feedback2',
                            'error',
                            'Masih ada jawaban yang belum tepat. Ingat, suku dipisahkan oleh tanda tambah atau kurang.'
                        );
                    }
                }

                function cekSoal3() {
                    const pilihan = selectedChoices[3];

                    document.querySelectorAll('#opsiSoal3 .opsi-card').forEach(card => {
                        card.classList.remove('correct', 'wrong');
                    });

                    if (!pilihan) {
                        resetFeedback('feedback3');
                        return;
                    }

                    const benar = pilihan.getAttribute('data-benar') === 'true';
                    pilihan.classList.add(benar ? 'correct' : 'wrong');

                    if (benar) {
                        paksaTampilFeedback(
                            'feedback3',
                            'success',
                            'Benar. x² menyatakan banyak buah dalam satu susunan persegi.' +
                            '<span class="explain">Penjelasan: satu susunan terdiri dari <strong>x baris</strong> dan <strong>x kolom</strong>, sehingga banyak buahnya adalah <strong>x × x = x²</strong>.</span>'
                        );
                    } else {
                        paksaTampilFeedback(
                            'feedback3',
                            'error',
                            'Jawaban itu belum tepat. Coba ingat kembali bahwa x² berasal dari x × x.'
                        );
                    }
                }

                document.querySelectorAll('[data-choice-question]').forEach(card => {
                    card.addEventListener('click', function (e) {
                        e.preventDefault();
                        handleChoiceSelection(this);
                    });
                });

                const jawab2a = document.getElementById('jawab2a');
                const jawab2b = document.getElementById('jawab2b');

                if (jawab2a) jawab2a.addEventListener('input', cekSoal2);
                if (jawab2b) jawab2b.addEventListener('input', cekSoal2);

                initDragDrop();
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initMateriInteraktif);
            } else {
                initMateriInteraktif();
            }
        })();
        document.querySelectorAll('.klik-card').forEach(card => {
            card.addEventListener('click', function () {
                this.classList.toggle('active');
            });
        });
    </script>
@endsection

@section('nav')
    <a href="{{ route('petakonsep') }}" class="btn-nav">← Previous</a>
    <a href="{{ route('pengertianpolinomial') }}" class="btn-nav">Next →</a>
@endsection