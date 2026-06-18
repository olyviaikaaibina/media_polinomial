@extends('layout.halamanmateri')

@section('content')
    <style>
        * {
            box-sizing: border-box;
        }

        .materi-wrapper {
            width: 100%;
            max-width: 920px;
            margin: 0 auto;
            padding: 12px 16px 28px;
            font-family: "Georgia", "Times New Roman", serif;
            color: #4a4038;
            overflow-x: visible;
        }

        .judul-bagian {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 16px;
            color: #2f7d32;
        }

        .judul-bagian .nomor {
            color: #444;
            margin-right: 6px;
        }

        .paragraf {
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 16px;
        }

        .eksplorasi-box {
            background: #f3ece5;
            border-left: 4px solid #e8892e;
            border-radius: 12px;
            padding: 16px 18px 20px;
            margin-bottom: 22px;
        }

        .eksplorasi-title {
            font-size: 17px;
            font-weight: 700;
            color: #2f7d32;
            margin-bottom: 12px;
        }

        .eksplorasi-text {
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 12px;
        }

        .rumus {
            text-align: center;
            font-size: 20px;
            font-style: normal;
            font-weight: normal;
            margin: 12px 0;
        }

        .question-box,
        .hasil-box {
            background: #fff;
            border-radius: 8px;
            padding: 12px 14px;
            margin: 14px 0;
            border: 1px solid #eee6df;
        }

        .question-label {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .question-value {
            text-align: center;
            font-size: 20px;
            font-style: normal;
            font-weight: normal;
        }

        .input-line {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 10px 0;
            flex-wrap: wrap;
            font-size: 15px;
        }

        .math-input {
            width: 60px;
            height: 34px;
            border: 2px solid #e4933c;
            border-radius: 6px;
            background: #fff;
            font-size: 15px;
            text-align: center;
            outline: none;
        }

        .math-input.long {
            width: 75px;
        }

        .hasil-box {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 6px;
            font-size: 15px;
            font-weight: 700;
        }

        .btn-cek {
            margin-top: 8px;
            padding: 8px 16px;
            background: #2f7d32;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-cek:hover {
            background: #27692a;
        }

        .keterangan-bawah {
            margin-top: 12px;
            font-size: 14px;
            line-height: 1.8;
        }

        .feedback-jawaban {
            margin-top: 12px;
            font-size: 14px;
            font-weight: 700;
        }

        .feedback-benar {
            color: #2f7d32;
        }

        .feedback-salah {
            color: #c62828;
        }

        .penjelasan-box {
            display: none;
            margin-top: 14px;
            background: #fff;
            border-radius: 8px;
            padding: 14px;
            border-left: 4px solid #2f7d32;
            border: 1px solid #eee6df;
        }

        .penjelasan-title {
            font-size: 15px;
            font-weight: 700;
            color: #2f7d32;
            margin-bottom: 10px;
        }

        .penjelasan-steps {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .step-item {
            background: #f8f8f8;
            border-radius: 6px;
            padding: 8px 10px;
            font-size: 14px;
            line-height: 1.7;
            border: 1px solid #ece7e2;
        }

        .step-label {
            font-weight: 700;
            color: #2f7d32;
            margin-right: 4px;
        }

        .input-benar {
            border-color: #2f7d32 !important;
            background: #e8f5e9;
        }

        .input-salah {
            border-color: #c62828 !important;
            background: #ffebee;
        }

        .info-box {
            position: relative;
            border-radius: 16px;
            padding: 20px 22px;
            margin-bottom: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        }

        .info-box.green {
            background: #edf5ec;
            border: 1.5px solid #d5ead1;
            border-left: 4px solid #64be63;
        }

        .info-box.blue {
            background: #eef3fb;
            border: 1.5px solid #dbe7f8;
            border-left: 4px solid #6aa2f0;
        }

        .info-box.orange {
            background: #f2cfc2;
            border: 1.5px solid #e2a285;
            margin-bottom: 36px;
        }

        .section-heading {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .green .section-heading {
            color: #2f7d32;
        }

        .blue .section-heading {
            color: #2f6db1;
        }

        .heading-icon {
            width: 12px;
            height: 12px;
            border-radius: 2px;
            display: inline-block;
        }

        .green .heading-icon {
            background: #7cd67a;
        }

        .blue .heading-icon {
            background: #7dc3ff;
        }

        .orange-label {
            position: absolute;
            top: -14px;
            left: 18px;
            background: #95cf7f;
            color: #355b27;
            font-size: 14px;
            font-weight: 700;
            padding: 7px 18px;
            border-radius: 14px;
            border: 1px solid #79b867;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
            letter-spacing: 0.3px;
        }

        .info-text {
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 10px;
        }

        .horner-flow {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
            margin-top: 12px;
        }

        .flow-step {
            min-width: 120px;
            text-align: center;
            background: linear-gradient(to bottom, #c8e8b5, #a8d68f);
            border: 1px solid #89bf70;
            color: #4f6536;
            font-size: 14px;
            font-weight: 700;
            padding: 12px 18px;
            border-radius: 14px;
            box-shadow: 0 2px 6px rgba(83, 140, 68, 0.15);
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .flow-step:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(83, 140, 68, 0.22);
        }

        .flow-step.active {
            background: linear-gradient(to bottom, #8fce75, #69b854);
            color: #fff;
            border-color: #5ca84b;
            transform: translateY(-2px) scale(1.03);
        }

        .flow-arrow {
            font-size: 26px;
            color: #5a9b61;
            line-height: 1;
            font-weight: 700;
        }

        .horner-list-box {
            margin-top: 18px;
            background: #ffffff;
            border: 1px solid #dfe8de;
            border-radius: 16px;
            padding: 18px 22px;
        }

        .horner-list-title {
            font-size: 17px;
            font-weight: 700;
            color: #2f7d32;
            margin-bottom: 12px;
        }

        .horner-steps-list {
            margin: 0;
            padding-left: 28px;
        }

        .horner-steps-list li {
            font-size: 15px;
            line-height: 1.9;
            margin-bottom: 8px;
            padding: 6px 10px;
            border-radius: 10px;
            transition: all 0.25s ease;
        }

        .horner-steps-list li.active-step {
            background: #dff2d9;
            color: #2f7d32;
            font-weight: 700;
            box-shadow: inset 0 0 0 1px #b7deb0;
        }

        .teorema-list {
            margin: 8px 0 0 18px;
            padding: 0;
        }

        .teorema-list li {
            margin-bottom: 12px;
            line-height: 1.8;
            font-size: 15px;
        }

        .teorema-list strong {
            color: #3c5f98;
        }

        .definisi-rumus {
            text-align: center;
            font-size: 24px;
            font-style: normal;
            font-weight: normal;
            margin: 18px 0;
            color: #5a4339;
        }

        .definisi-list {
            margin: 0 0 10px 18px;
            padding: 0;
        }

        .definisi-list li {
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 6px;
        }

        .contoh-premium-card,
        .contoh-horner-card {
            position: relative;
            margin-top: 18px;
            margin-bottom: 20px;
            border-radius: 22px;
            box-shadow: 0 8px 24px rgba(73, 109, 64, 0.08);
        }

        .contoh-premium-card {
            margin: 18px 0 30px;
            padding: 28px 24px 24px;
            background: linear-gradient(180deg, #f7fcf4 0%, #eef8ea 100%);
            border: 1.5px solid #cfe7c7;
            border-left: 6px solid #63b95d;
            border-radius: 24px;
            box-shadow: 0 10px 28px rgba(73, 109, 64, 0.08);
        }

        .contoh-horner-card {
            padding: 22px 22px 18px;
            background: linear-gradient(180deg, #f4faf1 0%, #eef7ea 100%);
            border: 1.5px solid #b9ddb0;
            border-left: 5px solid #63b95d;
        }

        .contoh-premium-badge,
        .contoh-badge,
        .latihan-badge {
            position: absolute;
            top: -16px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.4px;
            padding: 10px 18px;
            border-radius: 16px;
            box-shadow: 0 4px 10px rgba(86, 140, 67, 0.18);
        }

        .contoh-premium-badge {
            left: 24px;
            background: linear-gradient(180deg, #95cf7f 0%, #79bf63 100%);
            color: #355b27;
            border: 1px solid #6faf59;
        }

        .contoh-badge {
            left: 22px;
            background: linear-gradient(180deg, #9ad17f 0%, #83c36a 100%);
            color: #355b27;
            border: 1px solid #75b85d;
        }

        .contoh-header,
        .contoh-premium-header {
            margin-bottom: 14px;
            padding-top: 6px;
        }

        .contoh-subtitle,
        .contoh-premium-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            color: #2f7d32;
            margin-bottom: 10px;
        }

        .contoh-subtitle {
            font-size: 18px;
        }

        .contoh-premium-title {
            font-size: 20px;
        }

        .contoh-subtitle::before,
        .contoh-premium-title::before {
            content: "";
            width: 14px;
            height: 14px;
            border-radius: 4px;
            background: #7fcf6c;
            flex-shrink: 0;
        }

        .contoh-rumus {
            font-size: 17px;
            line-height: 1.8;
            color: #4f4a43;
            margin-bottom: 4px;
        }

        .contoh-premium-rumus {
            font-size: 18px;
            line-height: 1.8;
            color: #4f4a43;
            font-weight: 700;
        }

        .langkah-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-top: 16px;
        }

        .langkah-mini-card {
            background: #fff;
            border: 1px solid #e6ede2;
            border-radius: 16px;
            padding: 16px 14px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.03);
            transition: transform 0.28s ease, box-shadow 0.28s ease, border-color 0.28s ease, background 0.28s ease;
            cursor: pointer;
        }

        .langkah-mini-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 24px rgba(47, 125, 50, 0.12);
            border-color: #9ed08d;
            background: #f8fdf6;
        }

        .langkah-mini-card:active {
            transform: translateY(-3px) scale(0.99);
        }

        .langkah-mini-judul {
            font-size: 15px;
            font-weight: 700;
            color: #4a4038;
            margin-bottom: 10px;
            transition: color 0.28s ease;
        }

        .langkah-mini-card:hover .langkah-mini-judul {
            color: #2f7d32;
        }

        .langkah-mini-isi {
            font-size: 14px;
            line-height: 1.8;
            color: #645d56;
            transition: color 0.28s ease;
        }

        .langkah-mini-card:hover .langkah-mini-isi {
            color: #4f4a43;
        }

        .langkah-card {
            background: #ffffff;
            border: 1px solid #e2eadf;
            border-radius: 16px;
            padding: 18px 18px 16px;
            margin-top: 14px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.03);
            transition: all 0.2s ease;
        }

        .langkah-card:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.05);
        }

        .langkah-judul {
            font-size: 16px;
            font-weight: 700;
            color: #4a4038;
            margin-bottom: 14px;
        }

        .langkah-deskripsi {
            font-size: 14px;
            line-height: 1.8;
            color: #6a625b;
            margin-bottom: 12px;
        }

        .input-row,
        .input-group-inline {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 10px;
            font-size: 15px;
            line-height: 1.8;
            width: 100%;
        }

        .kecil-input {
            width: 72px;
            height: 42px;
            border: 2px solid #e49a45;
            border-radius: 10px;
            background: #fff;
            font-size: 16px;
            text-align: center;
            outline: none;
            transition: 0.2s ease;
        }

        .kecil-input:focus {
            border-color: #63b95d;
            box-shadow: 0 0 0 3px rgba(99, 185, 93, 0.12);
        }

        .btn-langkah {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 148px;
            height: 44px;
            padding: 0 18px;
            background: linear-gradient(180deg, #2f8a37 0%, #2b7a31 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(47, 125, 50, 0.18);
            transition: 0.2s ease;
        }

        .btn-langkah:hover {
            transform: translateY(-1px);
            background: linear-gradient(180deg, #34963d 0%, #2f7d32 100%);
        }

        .feedback-step {
            margin-top: 8px;
            font-size: 14px;
            font-weight: 700;
        }

        .feedback-step.feedback-benar {
            color: #2f7d32;
        }

        .feedback-step.feedback-salah {
            color: #c62828;
        }

        .penjelasan-step {
            display: none;
            margin-top: 12px;
            background: #f7fcf5;
            border: 1px solid #d8ead2;
            border-left: 4px solid #63b95d;
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 14px;
            line-height: 1.8;
            color: #4f4a43;
        }

        .penjelasan-step strong {
            color: #2f7d32;
        }

        .step-locked {
            opacity: 0.58;
            pointer-events: none;
            filter: grayscale(0.08);
        }

        .step-locked .langkah-judul {
            color: #8b847d;
        }

        .step-active {
            border-color: #cfe7c7;
            box-shadow: 0 0 0 3px rgba(99, 185, 93, 0.08);
        }

        /* =========================
                                                                                                                                                                                                       HORNER INTERAKTIF
                                                                                                                                                                                                    ========================= */

        .horner-premium-wrap {
            margin-top: 18px;
            background: #ffffff;
            border: 1px solid #dfe8de;
            border-radius: 18px;
            padding: 20px 18px 16px;
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
        }

        .horner-premium-title {
            font-size: 17px;
            font-weight: 700;
            color: #2f7d32;
            margin-bottom: 14px;
        }

        .horner-premium-subtitle {
            font-size: 14px;
            line-height: 1.8;
            color: #6a625b;
            margin-bottom: 16px;
        }

        .horner-board {
            width: max-content;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 60px repeat(4, 76px);
            grid-template-rows: repeat(3, 62px);
            align-items: center;
            justify-items: center;
            position: relative;
            transform: none !important;
        }

        .horner-k-box {
            grid-column: 1 / 2;
            grid-row: 1 / 4;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: linear-gradient(180deg, #dff1d8 0%, #cfe9c6 100%);
            border: 1px solid #b5d8ab;
            font-size: 22px;
            font-weight: 700;
            color: #355b27;
        }

        .horner-cell {
            width: 66px;
            height: 46px;
            border-radius: 12px;
            border: 1px solid #dfe5dc;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            font-weight: 700;
            color: #5a5148;
        }

        .horner-cell.top {
            background: #fbfbfb;
        }

        .horner-cell.bottom {
            background: #f8fcf6;
        }

        .horner-click {
            cursor: pointer;
            transition: all 0.18s ease;
        }

        .horner-click:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(47, 125, 50, 0.12);
            border-color: #9ed08d;
        }

        .horner-click.active {
            background: #e8f6e4;
            border-color: #63b95d;
            color: #2f7d32;
            box-shadow: 0 0 0 3px rgba(99, 185, 93, 0.12);
        }

        .horner-empty-cell {
            width: 66px;
            height: 46px;
        }

        .horner-line-horizontal-top {
            position: absolute;
            left: 56px;
            right: 0;
            top: 58px;
            height: 3px;
            background: #6d6a66;
            border-radius: 2px;
        }

        .horner-line-horizontal-bottom {
            position: absolute;
            left: 56px;
            right: 0;
            top: 120px;
            height: 3px;
            background: #6d6a66;
            border-radius: 2px;
        }

        .horner-line-vertical {
            position: absolute;
            left: 56px;
            top: 16px;
            width: 3px;
            height: 108px;
            background: #6d6a66;
            border-radius: 2px;
        }

        .horner-keterangan-box {
            margin-top: 18px;
            background: #f7fcf5;
            border: 1px solid #d8ead2;
            border-left: 4px solid #63b95d;
            border-radius: 14px;
            padding: 14px 16px;
            min-height: 88px;
        }

        .horner-keterangan-title {
            font-size: 15px;
            font-weight: 700;
            color: #2f7d32;
            margin-bottom: 8px;
        }

        .horner-keterangan-text {
            font-size: 14px;
            line-height: 1.8;
            color: #544d46;
        }

        .hasil-ringkas-box {
            margin-top: 16px;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .hasil-chip {
            background: #fff;
            border: 1px solid #e5ebe2;
            border-radius: 14px;
            padding: 14px 16px;
        }

        .hasil-chip-label {
            font-size: 13px;
            font-weight: 700;
            color: #6d665f;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .hasil-chip-value {
            font-size: 17px;
            font-weight: 700;
            color: #2f7d32;
            line-height: 1.7;
        }

        /* =========================
                                                                                                                                                                                                       HORNER MARI MENCOBA
                                                                                                                                                                                                    ========================= */

        .horner-table-wrap {
            margin: 14px 0 16px;
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
            padding-bottom: 10px;
        }

        .horner-table {
            position: relative;
            width: max-content;
            margin: 0 auto;
            padding-left: 42px;
            transform: none !important;
        }

        .horner-k {
            position: absolute;
            top: 14px;
            left: 0;
            width: 24px;
            text-align: center;
            font-size: 18px;
            color: #5a5148;
        }

        .horner-top-row,
        .horner-mid-row,
        .horner-bottom-row {
            display: grid;
            grid-template-columns: repeat(4, 58px);
            column-gap: 14px;
            align-items: center;
            justify-content: start;
            margin-left: 28px;
        }

        .horner-top-row {
            position: relative;
            padding: 8px 0 12px;
            border-bottom: 3px solid #6d6a66;
        }

        .horner-top-row::before {
            content: "";
            position: absolute;
            left: -16px;
            top: -6px;
            width: 3px;
            height: 52px;
            background: #6d6a66;
        }

        .horner-top-row span,
        .horner-bottom-row span {
            width: 58px;
            text-align: center;
            font-size: 18px;
            color: #5a5148;
        }

        .horner-mid-row {
            position: relative;
            margin-top: 10px;
        }

        .horner-bottom-row {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 3px solid #6d6a66;
        }

        .horner-cell-input,
        .horner-empty {
            width: 58px;
            height: 42px;
        }

        .horner-cell-input {
            border: 2px solid #d9d9d9;
            border-radius: 8px;
            text-align: center;
            font-size: 16px;
            background: #fff;
            outline: none;
        }

        .horner-plus {
            position: absolute;
            right: -18px;
            bottom: 2px;
            font-size: 28px;
            color: #7a746d;
        }

        .horner-bold {
            font-weight: 700;
        }

        /* =========================
                                                                                                                                                                                                       LATIHAN
                                                                                                                                                                                                    ========================= */

        .latihan-card {
            position: relative;
            margin-top: 26px;
            margin-bottom: 20px;
            padding: 26px 22px 20px;
            background: #f9faf8;
            border: 2px solid #9bd084;
            border-radius: 22px;
            box-shadow: 0 8px 24px rgba(73, 109, 64, 0.06);
        }

        .latihan-badge {
            left: 22px;
            background: linear-gradient(180deg, #efb08b 0%, #e49a74 100%);
            color: #5f3a24;
            border: 1px solid #d68a64;
            box-shadow: 0 4px 10px rgba(171, 108, 73, 0.18);
        }

        .latihan-item {
            background: #fff;
            border: 1px solid #e7e4df;
            border-radius: 14px;
            padding: 16px 14px;
            margin-top: 16px;
        }

        .latihan-soal-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #4a4038;
        }

        .latihan-rumus {
            text-align: center;
            font-size: 28px;
            margin: 10px 0 16px;
            color: #5a5148;
        }

        .latihan-box {
            background: #fafafa;
            border: 1px solid #e7e4df;
            border-radius: 12px;
            padding: 14px 12px;
            margin-bottom: 12px;
        }

        .latihan-box-title {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #506348;
        }

        .pilihan-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .pilihan-btn {
            padding: 10px 16px;
            border: 2px solid #e0a163;
            border-radius: 10px;
            background: #fff;
            color: #5a5148;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .pilihan-btn:hover {
            background: #fff6ef;
        }

        .pilihan-btn.selected {
            background: #fff1e4;
            border-color: #d97f28;
            outline: 3px solid #8aa376;
        }

        .pilihan-btn.correct {
            background: #e8f7e7;
            border-color: #4caf50;
            color: #2f7d32;
        }

        .pilihan-btn.wrong {
            background: #fdeaea;
            border-color: #d9534f;
            color: #b62f2a;
        }

        .latihan-feedback {
            margin-top: 12px;
            font-size: 14px;
            font-weight: 700;
        }

        .latihan-feedback.success {
            color: #2e7d32;
            font-weight: bold;
        }

        .latihan-feedback.error {
            color: #c62828;
            font-weight: bold;
        }

        .latihan-penjelasan {
            display: none;
            margin-top: 14px;
            background: #f7fcf5;
            border: 1px solid #d8ead2;
            border-left: 4px solid #63b95d;
            border-radius: 12px;
            padding: 14px;
            font-size: 14px;
            line-height: 1.8;
        }

        .latihan-hidden {
            display: none;
        }

        .latihan-final-note {
            display: none;
            margin-top: 18px;
            padding: 14px 16px;
            border-radius: 12px;
            background: #eef8ec;
            border: 1px solid #cfe7c7;
            color: #2f7d32;
            font-size: 14px;
            line-height: 1.8;
            font-weight: 700;
        }

        .soal-terkunci {
            opacity: 0.4;
            filter: grayscale(40%);
            pointer-events: none;
            user-select: none;
        }

        .soal-terkunci input {
            background: #eee;
        }

        /* =========================
                                                                                                                                                                                                       HORNER LATIHAN
                                                                                                                                                                                                    ========================= */

        .latihan-horner-wrap {
            margin: 18px 0 10px;
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
            padding-bottom: 10px;
        }

        .latihan-horner {
            position: relative;
            width: max-content;
            margin: 0 auto;
            padding-left: 52px;
            transform: none !important;
        }

        .latihan-horner-k {
            position: absolute;
            top: 18px;
            left: 8px;
            width: 34px;
            text-align: center;
            font-size: 26px;
            font-weight: 700;
            color: #5a5148;
        }

        .latihan-horner-top,
        .latihan-horner-mid,
        .latihan-horner-bottom {
            display: grid;
            grid-template-columns: repeat(4, 74px);
            column-gap: 18px;
            align-items: center;
            justify-content: start;
            margin-left: 82px;
        }

        .latihan-horner-top {
            position: relative;
            padding: 18px 0;
            border-bottom: 4px solid #6d6a66;
        }

        .latihan-horner-top::before {
            content: "";
            position: absolute;
            left: -22px;
            top: -6px;
            width: 4px;
            height: 78px;
            background: #6d6a66;
        }

        .latihan-horner-top span,
        .latihan-horner-bottom span {
            width: 74px;
            text-align: center;
            font-size: 26px;
            color: #5a5148;
        }

        .latihan-horner-mid {
            position: relative;
            margin-top: 14px;
        }

        .latihan-horner-bottom {
            margin-top: 14px;
            padding-top: 14px;
            border-top: 4px solid #6d6a66;
        }

        .latihan-horner-input,
        .latihan-horner-empty {
            width: 74px;
            height: 56px;
        }

        .latihan-horner-input {
            border: 3px solid #d8d8d8;
            border-radius: 14px;
            background: #fff;
            text-align: center;
            font-size: 22px;
            outline: none;
            transition: 0.2s ease;
        }

        .latihan-horner-plus {
            position: absolute;
            right: -30px;
            bottom: 6px;
            font-size: 40px;
            color: #7a746d;
        }

        .latihan-horner-bold {
            font-weight: 700;
        }

        .hasil-qx-responsive {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 8px;
            font-size: 15px;
            line-height: 1.8;
        }

        .latihan-hasil-input {
            width: 58px;
            height: 38px;
            border: 2px solid #e49a45;
            border-radius: 10px;
            background: #fff;
            font-size: 15px;
            text-align: center;
            outline: none;
        }

        /* =========================
                                                                                                                                                                                                       ANIMASI
                                                                                                                                                                                                    ========================= */

        .horner-animate {
            transition: all 0.5s ease;
        }

        .move-down {
            transform: translateY(40px);
        }

        .fade-in {
            opacity: 0;
            transform: translateY(10px);
            animation: fadeInUp 0.5s forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* =========================
                                                                                                                                                                                                       RESPONSIVE TABLET
                                                                                                                                                                                                    ========================= */

        @media (max-width: 900px) {
            .materi-wrapper {
                max-width: 100%;
                padding-left: 14px;
                padding-right: 14px;
            }

            .horner-board,
            .horner-table,
            .latihan-horner {
                margin-left: 0;
                margin-right: 0;
            }
        }

        /* =========================
                                                                                                                                                                                                       RESPONSIVE HP
                                                                                                                                                                                                    ========================= */

        @media (max-width: 768px) {
            .materi-wrapper {
                padding: 10px 10px 24px;
            }

            .judul-bagian {
                font-size: 20px;
                line-height: 1.4;
            }

            .paragraf,
            .eksplorasi-text,
            .info-text,
            .teorema-list li,
            .definisi-list li {
                font-size: 14px;
                line-height: 1.75;
            }

            .eksplorasi-box,
            .info-box,
            .contoh-premium-card,
            .contoh-horner-card,
            .latihan-card,
            .latihan-item,
            .latihan-box {
                padding-left: 12px;
                padding-right: 12px;
                border-radius: 16px;
            }

            .rumus,
            .question-value {
                font-size: 21px;
            }

            .definisi-rumus {
                font-size: 28px;
            }

            .latihan-rumus {
                font-size: 20px;
                line-height: 1.5;
            }

            .contoh-premium-title,
            .contoh-subtitle {
                font-size: 17px;
            }

            .contoh-premium-rumus,
            .contoh-rumus {
                font-size: 15px;
            }

            .input-line,
            .hasil-box {
                align-items: flex-start;
                gap: 8px;
                font-size: 14px;
            }

            .math-input {
                width: 58px;
                height: 34px;
                font-size: 14px;
            }

            .math-input.long {
                width: 72px;
            }

            .flow-arrow {
                display: none;
            }

            .horner-flow {
                display: grid;
                grid-template-columns: 1fr;
                gap: 8px;
            }

            .flow-step {
                width: 100%;
                min-width: unset;
            }

            .horner-list-box {
                padding: 14px;
            }

            .horner-steps-list {
                padding-left: 20px;
            }

            .horner-steps-list li {
                font-size: 14px;
                padding: 6px 8px;
            }

            .langkah-grid,
            .hasil-ringkas-box {
                grid-template-columns: 1fr;
            }

            .langkah-mini-card {
                padding: 14px 12px;
            }

            .langkah-mini-card:hover {
                transform: none;
            }

            .kecil-input {
                width: 62px;
                height: 38px;
                font-size: 14px;
            }

            .btn-langkah,
            .btn-cek {
                width: 100%;
                min-width: unset;
                height: 42px;
                font-size: 14px;
            }

            .pilihan-wrap {
                display: grid;
                grid-template-columns: 1fr;
                gap: 8px;
            }

            .pilihan-btn {
                width: 100%;
                text-align: center;
                font-size: 14px;
                padding: 10px 12px;
            }

            .horner-premium-wrap::after,
            .horner-table-wrap::after,
            .latihan-horner-wrap::after {

                display: block;
                margin-top: 8px;
                font-size: 12px;
                color: #777;
                text-align: center;
            }

            .horner-board {
                grid-template-columns: 46px repeat(4, 58px);
                grid-template-rows: repeat(3, 48px);
                min-width: 300px;
            }

            .horner-k-box {
                width: 38px;
                height: 38px;
                font-size: 15px;
                border-radius: 10px;
            }

            .horner-cell,
            .horner-empty-cell {
                width: 50px;
                height: 34px;
                font-size: 14px;
                border-radius: 9px;
            }

            .horner-line-horizontal-top {
                left: 43px;
                top: 45px;
                height: 2px;
            }

            .horner-line-horizontal-bottom {
                left: 43px;
                top: 93px;
                height: 2px;
            }

            .horner-line-vertical {
                left: 43px;
                top: 12px;
                width: 2px;
                height: 84px;
            }

            .horner-table {
                min-width: 330px;
                padding-left: 26px;
            }

            .horner-k {
                top: 10px;
                left: 0;
                width: 20px;
                font-size: 14px;
            }

            .horner-top-row,
            .horner-mid-row,
            .horner-bottom-row {
                grid-template-columns: repeat(4, 44px);
                column-gap: 8px;
                margin-left: 20px;
            }

            .horner-top-row span,
            .horner-bottom-row span,
            .horner-cell-input,
            .horner-empty {
                width: 44px;
            }

            .horner-cell-input {
                height: 34px;
                font-size: 13px;
                border-radius: 7px;
            }

            .horner-top-row {
                padding: 6px 0 10px;
                border-bottom-width: 2px;
            }

            .horner-bottom-row {
                padding-top: 8px;
                border-top-width: 2px;
            }

            .horner-top-row::before {
                left: -12px;
                width: 2px;
                height: 44px;
            }

            .horner-plus {
                right: -13px;
                bottom: 2px;
                font-size: 22px;
            }

            .latihan-horner {
                min-width: 350px;
                padding-left: 28px;
            }

            .latihan-horner-k {
                top: 12px;
                left: 0;
                width: 24px;
                font-size: 17px;
            }

            .latihan-horner-top,
            .latihan-horner-mid,
            .latihan-horner-bottom {
                grid-template-columns: repeat(4, 46px);
                column-gap: 8px;
                margin-left: 34px;
            }

            .latihan-horner-top span,
            .latihan-horner-bottom span,
            .latihan-horner-mid input,
            .latihan-horner-bottom input,
            .latihan-horner-empty {
                width: 46px;
            }

            .latihan-horner-input {
                height: 36px;
                font-size: 14px;
                border-radius: 8px;
                padding: 0;
            }

            .latihan-horner-top span,
            .latihan-horner-bottom span {
                font-size: 16px;
            }

            .latihan-horner-top {
                padding: 10px 0;
                border-bottom-width: 2px;
            }

            .latihan-horner-bottom {
                margin-top: 10px;
                padding-top: 10px;
                border-top-width: 2px;
            }

            .latihan-horner-mid {
                margin-top: 10px;
            }

            .latihan-horner-top::before {
                left: -12px;
                top: -2px;
                width: 2px;
                height: 48px;
            }

            .latihan-horner-plus {
                right: -18px;
                bottom: 4px;
                font-size: 24px;
            }
        }

        /* =========================
                                                                                                                                                                                                       RESPONSIVE HP KECIL
                                                                                                                                                                                                    ========================= */

        @media (max-width: 480px) {
            .materi-wrapper {
                padding-left: 8px;
                padding-right: 8px;
            }

            .judul-bagian {
                font-size: 18px;
            }

            .rumus,
            .question-value {
                font-size: 19px;
            }

            .definisi-rumus {
                font-size: 24px;
            }

            .latihan-rumus {
                font-size: 18px;
            }

            .section-heading {
                font-size: 14px;
                align-items: flex-start;
            }

            .orange-label,
            .contoh-badge,
            .contoh-premium-badge,
            .latihan-badge {
                left: 12px;
                font-size: 11px;
                padding: 7px 12px;
            }

            .contoh-premium-card,
            .contoh-horner-card,
            .latihan-card {
                padding-top: 24px;
            }

            .math-input {
                width: 54px;
            }

            .kecil-input {
                width: 58px;
            }

            .input-row span,
            .input-group-inline span {
                font-size: 14px;
            }

            .penjelasan-box,
            .penjelasan-step,
            .latihan-penjelasan {
                font-size: 13px;
            }

            .horner-board {
                grid-template-columns: 40px repeat(4, 50px);
                grid-template-rows: repeat(3, 44px);
                min-width: 260px;
            }

            .horner-k-box {
                width: 34px;
                height: 34px;
                font-size: 13px;
            }

            .horner-cell,
            .horner-empty-cell {
                width: 42px;
                height: 30px;
                font-size: 12px;
            }

            .horner-line-horizontal-top {
                left: 38px;
                top: 41px;
            }

            .horner-line-horizontal-bottom {
                left: 38px;
                top: 85px;
            }

            .horner-line-vertical {
                left: 38px;
                height: 76px;
            }

            .horner-table {
                min-width: 300px;
                padding-left: 22px;
            }

            .horner-top-row,
            .horner-mid-row,
            .horner-bottom-row {
                grid-template-columns: repeat(4, 38px);
                column-gap: 7px;
                margin-left: 18px;
            }

            .horner-top-row span,
            .horner-bottom-row span,
            .horner-cell-input,
            .horner-empty {
                width: 38px;
                font-size: 13px;
            }

            .horner-cell-input {
                height: 32px;
                font-size: 12px;
            }

            .latihan-horner {
                min-width: 310px;
                padding-left: 24px;
            }

            .latihan-horner-top,
            .latihan-horner-mid,
            .latihan-horner-bottom {
                grid-template-columns: repeat(4, 39px);
                column-gap: 7px;
                margin-left: 30px;
            }

            .latihan-horner-top span,
            .latihan-horner-bottom span,
            .latihan-horner-mid input,
            .latihan-horner-bottom input {
                width: 39px;
            }

            .latihan-horner-input {
                height: 32px;
                font-size: 12px;
            }

            .latihan-horner-top span,
            .latihan-horner-bottom span {
                font-size: 13px;
            }

            .latihan-horner-k {
                font-size: 14px;
            }

            .latihan-hasil-input {
                width: 48px;
                height: 34px;
                font-size: 13px;
            }

            .hasil-qx-responsive {
                font-size: 14px;
                gap: 6px;
            }
        }

        /* =========================
                                                                                                                                                                                           HASIL AKHIR LATIHAN RAPI
                                                                                                                                                                                        ========================= */

        .hasil-akhir-wrap {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 8px;
        }

        .hasil-row {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 6px;
            font-size: 15px;
            line-height: 1.6;
            color: #5a5148;
        }

        .hasil-label {
            min-width: 46px;
            font-weight: 400;
            color: #8a8279;
        }

        .latihan-hasil-input {
            border: 2px solid #d9d9d9;
            border-radius: 6px;
            background: #fff;
            text-align: center;
            outline: none;
            font-size: 14px;
            color: #4a4038;
            padding: 0 4px;
            box-sizing: border-box;
        }

        .latihan-hasil-input.kecil {
            width: 44px;
            height: 30px;
        }

        .latihan-hasil-input.sedang {
            width: 82px;
            height: 30px;
        }

        .qx-row {
            row-gap: 6px;
        }

        @media (max-width: 768px) {
            .hasil-row {
                font-size: 14px;
                gap: 5px;
            }

            .hasil-label {
                min-width: 42px;
            }

            .latihan-hasil-input.kecil {
                width: 40px;
                height: 28px;
                font-size: 13px;
            }

            .latihan-hasil-input.sedang {
                width: 72px;
                height: 28px;
                font-size: 13px;
            }
        }

        @media (max-width: 480px) {
            .hasil-akhir-wrap {
                gap: 8px;
            }

            .hasil-row {
                font-size: 13px;
                gap: 4px;
            }

            .hasil-label {
                min-width: 38px;
            }

            .latihan-hasil-input.kecil {
                width: 36px;
                height: 26px;
                font-size: 12px;
                border-radius: 5px;
            }

            .latihan-hasil-input.sedang {
                width: 64px;
                height: 26px;
                font-size: 12px;
                border-radius: 5px;
            }
        }

        /* =========================
                                                                                                                       TABEL HORNER SEPERTI GAMBAR + TANDA PLUS
                                                                                                                    ========================= */

        #card-step-6 .horner-table-wrap {
            width: 100%;
            overflow-x: auto;
            padding: 14px 4px 18px;
            -webkit-overflow-scrolling: touch;
        }

        #card-step-6 .horner-board {
            --cell-w: 88px;
            --cell-h: 58px;
            --k-w: 68px;
            --col-gap: 14px;
            --row-gap: 12px;
            --line-x: 81px;
            --line-y-1: 64px;
            --line-y-2: 134px;

            position: relative;
            display: grid;
            grid-template-columns: var(--k-w) repeat(4, var(--cell-w));
            grid-template-rows: repeat(3, var(--cell-h));
            column-gap: var(--col-gap);
            row-gap: var(--row-gap);
            width: max-content;
            margin: 0 auto;

            /* kanan dilebarkan untuk tempat tanda + */
            padding: 0 48px 0 6px;
        }

        #card-step-6 .horner-line {
            position: absolute;
            background: #6d6a66;
            border-radius: 999px;
            z-index: 1;
        }

        #card-step-6 .horner-line-v {
            left: var(--line-x);
            top: 10px;
            width: 4px;
            height: 132px;
        }

        #card-step-6 .horner-line-top {
            left: var(--line-x);
            right: 48px;
            top: var(--line-y-1);
            height: 4px;
        }

        #card-step-6 .horner-line-bottom {
            left: var(--line-x);
            right: 48px;
            top: var(--line-y-2);
            height: 4px;
        }

        #card-step-6 .horner-cell,
        #card-step-6 .horner-k-badge {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            box-sizing: border-box;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 27px;
            font-weight: 800;
            color: #575048;
        }

        #card-step-6 .horner-cell {
            width: var(--cell-w);
            height: var(--cell-h);
            border-radius: 16px;
            border: 1px solid #dfe6dc;
            background: #fbfdfb;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
        }

        #card-step-6 .horner-bottom {
            background: #fbfff9;
        }

        #card-step-6 .horner-k-badge {
            grid-column: 1;
            grid-row: 2;
            width: var(--k-w);
            height: 68px;
            border-radius: 18px;
            border: 1px solid #a9d39f;
            background: #d9efd2;
            color: #2f7838;
            font-size: 29px;
        }

        #card-step-6 .horner-input {
            padding: 0;
            text-align: center;
            outline: none;
            appearance: none;
            -webkit-appearance: none;
        }

        #card-step-6 .horner-input:focus {
            border-color: #67ba68;
            background: #e8f6e3;
            color: #247b34;
            box-shadow: 0 0 0 4px rgba(83, 184, 91, 0.16);
        }

        #card-step-6 .horner-input.is-correct,
        #card-step-6 .horner-cell.is-green {
            border-color: #67ba68;
            background: #e8f6e3;
            color: #247b34;
            box-shadow: 0 0 0 4px rgba(83, 184, 91, 0.16);
        }

        /* Tanda + di ujung kanan garis bawah */
        #card-step-6 .horner-plus-sign {
            position: absolute;
            z-index: 4;

            right: 9px;
            top: calc(var(--line-y-2) - 15px);

            width: 30px;
            height: 30px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-family: Georgia, "Times New Roman", serif;
            font-size: 30px;
            font-weight: 900;
            color: #575048;
        }

        /* Posisi baris */
        #card-step-6 .row-top {
            grid-row: 1;
        }

        #card-step-6 .row-mid {
            grid-row: 2;
        }

        #card-step-6 .row-bottom {
            grid-row: 3;
        }

        /* Posisi kolom angka */
        #card-step-6 .col-1 {
            grid-column: 2;
        }

        #card-step-6 .col-2 {
            grid-column: 3;
        }

        #card-step-6 .col-3 {
            grid-column: 4;
        }

        #card-step-6 .col-4 {
            grid-column: 5;
        }

        /* Responsive HP */
        @media (max-width: 520px) {
            #card-step-6 .horner-board {
                --cell-w: 78px;
                --cell-h: 54px;
                --k-w: 62px;
                --col-gap: 12px;
                --row-gap: 10px;
                --line-x: 74px;
                --line-y-1: 59px;
                --line-y-2: 123px;

                padding: 0 44px 0 6px;
            }

            #card-step-6 .horner-line-top {
                right: 44px;
            }

            #card-step-6 .horner-line-bottom {
                right: 44px;
            }

            #card-step-6 .horner-cell {
                font-size: 24px;
            }

            #card-step-6 .horner-k-badge {
                height: 62px;
                font-size: 26px;
            }

            #card-step-6 .horner-line-v {
                height: 122px;
            }

            #card-step-6 .horner-plus-sign {
                right: 8px;
                top: calc(var(--line-y-2) - 14px);
                font-size: 27px;
            }
        }



        /* =========================
                                                                                                                               TABEL HORNER LATIHAN SOAL 2
                                                                                                                            ========================= */

        #latihanSoal2 .latihan-horner-wrap {
            width: 100%;
            overflow-x: auto;
            padding: 14px 4px 18px;
            -webkit-overflow-scrolling: touch;
        }

        #latihanSoal2 .latihan-horner-board {
            --cell-w: 88px;
            --cell-h: 58px;
            --k-w: 68px;
            --col-gap: 14px;
            --row-gap: 12px;
            --line-x: 81px;
            --line-y-1: 64px;
            --line-y-2: 134px;

            position: relative;
            display: grid;
            grid-template-columns: var(--k-w) repeat(4, var(--cell-w));
            grid-template-rows: repeat(3, var(--cell-h));
            column-gap: var(--col-gap);
            row-gap: var(--row-gap);

            width: max-content;
            margin: 0 auto;

            /* kanan dibuat lebih lebar untuk tempat tanda + */
            padding: 0 48px 0 6px;
        }

        /* Garis tabel */
        #latihanSoal2 .latihan-line {
            position: absolute;
            background: #6d6a66;
            border-radius: 999px;
            z-index: 1;
        }

        #latihanSoal2 .latihan-line-v {
            left: var(--line-x);
            top: 10px;
            width: 4px;
            height: 132px;
        }

        #latihanSoal2 .latihan-line-top {
            left: var(--line-x);
            right: 48px;
            top: var(--line-y-1);
            height: 4px;
        }

        #latihanSoal2 .latihan-line-bottom {
            left: var(--line-x);
            right: 48px;
            top: var(--line-y-2);
            height: 4px;
        }

        /* Kotak angka */
        #latihanSoal2 .latihan-horner-cell,
        #latihanSoal2 .latihan-k-badge {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            box-sizing: border-box;

            font-family: Georgia, "Times New Roman", serif;
            font-size: 27px;
            font-weight: 800;
            color: #575048;
        }

        #latihanSoal2 .latihan-horner-cell {
            width: var(--cell-w);
            height: var(--cell-h);
            border-radius: 16px;
            border: 1px solid #dfe6dc;
            background: #fbfdfb;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
        }

        #latihanSoal2 .latihan-bottom {
            background: #fbfff9;
        }

        /* Kotak nilai k */
        #latihanSoal2 .latihan-k-badge {
            grid-column: 1;
            grid-row: 2;

            width: var(--k-w);
            height: 68px;
            border-radius: 18px;
            border: 1px solid #a9d39f;
            background: #d9efd2;
            color: #2f7838;
            font-size: 29px;
        }

        /* Input tabel */
        #latihanSoal2 .latihan-horner-input {
            padding: 0;
            text-align: center;
            outline: none;
            appearance: none;
            -webkit-appearance: none;
        }

        #latihanSoal2 .latihan-horner-input:focus {
            border-color: #67ba68;
            background: #e8f6e3;
            color: #247b34;
            box-shadow: 0 0 0 4px rgba(83, 184, 91, 0.16);
        }

        #latihanSoal2 .latihan-horner-input:disabled {
            opacity: 1;
            cursor: not-allowed;
        }

        /* Tanda + di ujung kanan garis bawah */
        #latihanSoal2 .latihan-plus-sign {
            position: absolute;
            z-index: 4;

            right: 9px;
            top: calc(var(--line-y-2) - 15px);

            width: 30px;
            height: 30px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-family: Georgia, "Times New Roman", serif;
            font-size: 30px;
            font-weight: 900;
            color: #575048;
        }

        /* Posisi baris */
        #latihanSoal2 .latihan-horner-board .row-top {
            grid-row: 1;
        }

        #latihanSoal2 .latihan-horner-board .row-mid {
            grid-row: 2;
        }

        #latihanSoal2 .latihan-horner-board .row-bottom {
            grid-row: 3;
        }

        /* Posisi kolom */
        #latihanSoal2 .latihan-horner-board .col-1 {
            grid-column: 2;
        }

        #latihanSoal2 .latihan-horner-board .col-2 {
            grid-column: 3;
        }

        #latihanSoal2 .latihan-horner-board .col-3 {
            grid-column: 4;
        }

        #latihanSoal2 .latihan-horner-board .col-4 {
            grid-column: 5;
        }

        /* Responsive HP */
        @media (max-width: 520px) {
            #latihanSoal2 .latihan-horner-board {
                --cell-w: 78px;
                --cell-h: 54px;
                --k-w: 62px;
                --col-gap: 12px;
                --row-gap: 10px;
                --line-x: 74px;
                --line-y-1: 59px;
                --line-y-2: 123px;

                padding: 0 44px 0 6px;
            }

            #latihanSoal2 .latihan-line-top {
                right: 44px;
            }

            #latihanSoal2 .latihan-line-bottom {
                right: 44px;
            }

            #latihanSoal2 .latihan-horner-cell {
                font-size: 24px;
            }

            #latihanSoal2 .latihan-k-badge {
                height: 62px;
                font-size: 26px;
            }

            #latihanSoal2 .latihan-line-v {
                height: 122px;
            }

            #latihanSoal2 .latihan-plus-sign {
                right: 8px;
                top: calc(var(--line-y-2) - 14px);
                font-size: 27px;
            }
        }

        /* Tanda + di tabel Horner contoh */
        .contoh-premium-card .horner-board-animasi {
            padding-right: 34px;
        }

        .contoh-premium-card .horner-board-animasi .horner-line-horizontal-top,
        .contoh-premium-card .horner-board-animasi .horner-line-horizontal-bottom {
            right: 34px;
        }

        .contoh-premium-card .horner-premium-plus {
            position: absolute;
            right: 0;
            top: 104px;
            z-index: 10;

            font-size: 28px;
            font-weight: 900;
            color: #575048;
            line-height: 1;
        }

        .horner-proses-card {
            margin: 14px 0 20px;
            background: #ffffff;
            border: 1.5px solid #dcebd7;
            border-radius: 18px;
            padding: 18px 18px 16px;
            box-shadow: 0 4px 14px rgba(47, 125, 50, 0.06);
        }

        .horner-proses-title {
            font-size: 17px;
            font-weight: 700;
            color: #2f7d32;
            margin-bottom: 8px;
        }

        .horner-proses-subtitle {
            font-size: 14px;
            line-height: 1.8;
            color: #5f5a54;
            margin-bottom: 14px;
            text-align: justify;
        }

        .proses-info-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 16px;
        }

        .proses-info-item {
            background: #f7fcf5;
            border: 1px solid #d8ead2;
            border-radius: 14px;
            padding: 12px 14px;
            font-size: 14px;
            line-height: 1.7;
            text-align: justify;
        }

        .proses-info-label {
            font-weight: 700;
            color: #2f7d32;
            margin-bottom: 4px;
        }

        .proses-alur {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .proses-row {
            display: grid;
            grid-template-columns: 38px 1fr;
            gap: 12px;
            align-items: flex-start;
            background: #fbfbfb;
            border: 1px solid #e7e4df;
            border-radius: 14px;
            padding: 12px 14px;
        }

        .proses-no {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #dff2d9;
            color: #2f7d32;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .proses-judul {
            font-size: 14px;
            font-weight: 700;
            color: #4a4038;
            margin-bottom: 6px;
        }

        .proses-rumus {
            display: inline-block;
            background: #eef8ec;
            border: 1px solid #cfe7c7;
            border-radius: 10px;
            padding: 6px 12px;
            color: #2f7d32;
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .proses-keterangan {
            font-size: 14px;
            line-height: 1.8;
            color: #5f5a54;
            text-align: justify;
        }

        .proses-kesimpulan {
            margin-top: 14px;
            background: #f3f7ff;
            border: 1px solid #d5e2ff;
            border-left: 4px solid #6aa2f0;
            border-radius: 14px;
            padding: 13px 15px;
            font-size: 14px;
            line-height: 1.8;
            color: #4f4a43;
            text-align: justify;
        }

        @media (max-width: 768px) {
            .proses-info-grid {
                grid-template-columns: 1fr;
            }

            .horner-proses-card {
                padding: 15px 13px;
            }

            .proses-row {
                grid-template-columns: 32px 1fr;
                gap: 10px;
                padding: 11px 12px;
            }

            .proses-no {
                width: 28px;
                height: 28px;
                font-size: 13px;
            }

            .proses-rumus,
            .proses-keterangan,
            .proses-info-item,
            .proses-kesimpulan {
                font-size: 13px;
            }
        }

        .aksi-langkah {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 12px;
        }

        .btn-hint {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 110px;
            height: 44px;
            padding: 0 18px;
            background: linear-gradient(180deg, #f6b45b 0%, #e89a34 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(232, 154, 52, 0.18);
            transition: 0.2s ease;
        }

        .btn-hint:hover {
            transform: translateY(-1px);
            background: linear-gradient(180deg, #f8bf6f 0%, #e4932a 100%);
        }

        .hint-step {
            display: none;
            margin-top: 12px;
            background: #fff8ed;
            border: 1px solid #f0d3a8;
            border-left: 4px solid #e89a34;
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 14px;
            line-height: 1.8;
            color: #5f4a32;
            text-align: justify;
        }

        .hint-step strong {
            color: #b76516;
        }

        @media (max-width: 768px) {
            .aksi-langkah {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-hint,
            .btn-langkah {
                width: 100%;
            }

            .hint-step {
                font-size: 13px;
            }
        }

        .petunjuk-latihan-box {
            margin: 8px 0 18px;
            padding: 16px 18px;
            background: #f3f8ef;
            border: 1.5px solid #cfe3c5;
            border-left: 5px solid #8db36f;
            border-radius: 16px;
            color: #374151;
            font-size: 15px;
            line-height: 1.8;
            text-align: justify;
        }

        .petunjuk-latihan-box b {
            color: #2f7d32;
            font-weight: 800;
        }

        @media (max-width: 768px) {
            .petunjuk-latihan-box {
                padding: 14px 14px;
                font-size: 14px;
                line-height: 1.75;
                border-radius: 14px;
            }
        }

        .soal-pol-awal-box {
            margin: 12px 0 16px;
            padding: 14px 16px;
            background: #fbfbfb;
            border: 1px solid #e7e4df;
            border-radius: 12px;
            font-size: 15px;
            line-height: 1.8;
            color: #4a4038;
            text-align: left;
        }

        .soal-pol-awal-box p {
            margin: 0 0 8px 0;
            text-align: justify;
        }

        .soal-pol-awal-box p:last-child {
            margin-bottom: 0;
        }

        .soal-pol-awal-box .math-line {
            display: block;
            margin: 8px 0;
            padding: 8px 10px;
            background: #f3f8ef;
            border-radius: 10px;
            text-align: center;
            font-size: 17px;
            font-weight: 700;
            color: #2f7d32;
            white-space: nowrap;
            overflow-x: auto;
        }

        @media (max-width: 768px) {
            .soal-pol-awal-box {
                font-size: 14px;
                line-height: 1.75;
                padding: 12px 13px;
            }

            .soal-pol-awal-box .math-line {
                font-size: 15px;
            }
        }

        .cek-semua-wrap {
            margin-top: 14px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        @media (max-width: 768px) {
            .cek-semua-wrap .btn-cek {
                width: 100%;
            }
        }
    </style>

    <div class="materi-wrapper">
        <div class="judul-bagian">
            <span class="nomor">2.</span>Metode Horner
        </div>

        <div class="paragraf">
            Pada pembagian polinomial, metode bersusun merupakan cara yang umum digunakan.
            Namun untuk pembagian polinomial oleh bentuk <em>(x − k)</em> terdapat cara lain
            yang lebih cepat dan efisien, yaitu Metode Horner. Metode ini menyederhanakan proses pembagian hanya menjadi
            operasi perkalian dan penjumlahan, sehingga sangat praktis digunakan untuk mencari hasil bagi dan sisa
            pembagian.
        </div>

        <div class="eksplorasi-box">
            <div class="eksplorasi-title">🧭 Eksplorasi</div>

            <div class="eksplorasi-text">
                Perhatikan fungsi polinomial berikut:
            </div>

            <div class="rumus">
                P(x) = 2x³ − 3x² + x + 5
            </div>

            <div class="eksplorasi-text">
                Kita akan menentukan nilai polinomial tersebut saat <em>x = 2</em>.
                Coba lengkapi langkah-langkah perhitungannya.
            </div>

            <div class="question-box">
                <div class="question-label">Pertanyaan:</div>
                <div class="question-value">P(2) = ?</div>
            </div>

            <div class="input-line">
                2 × (2³) =
                <input type="text" id="a1" class="math-input">
            </div>

            <div class="input-line">
                3 × (2²) =
                <input type="text" id="a2" class="math-input">
            </div>

            <div class="input-line">
                <input type="text" id="a3" class="math-input">
                -
                <input type="text" id="a4" class="math-input">
                + 2 + 5 =
                <input type="text" id="a5" class="math-input long">
            </div>

            <div class="hasil-box">
                Hasil akhir: P(2) =
                <input type="text" id="hasilAkhir" class="math-input">
            </div>

            <div class="cek-semua-wrap">
                <button type="button" class="btn-cek" onclick="cekEksplorasiManual()">
                    Cek Semua
                </button>
            </div>

            <div id="feedbackJawaban" class="feedback-jawaban"></div>

            <div id="penjelasanBox" class="penjelasan-box" style="text-align:center;">
                <div class="penjelasan-title">Hasil Akhir</div>

                <div class="info-text" style="margin:0; line-height:2;">
                    Substitusi x = 2:
                    <br>

                    <strong>
                        P(2) = 2(2³) − 3(2²) + 2 + 5
                    </strong>
                    <br>

                    <strong>
                        = 16 − 12 + 2 + 5
                    </strong>
                    <br>

                    <strong style="font-size:18px;">
                        = 11
                    </strong>
                </div>
            </div>
        </div>

        <div id="materiLanjutan" style="display: none;">
            <div class="info-box green">
                <div class="section-heading">
                    <span class="heading-icon"></span>
                    Langkah Dasar Metode Horner
                </div>

                <div class="info-text">
                    Klik tombol langkah berikut, lalu lihat penjelasan dan bagian langkah yang disorot di bawah.
                </div>

                <div class="horner-flow">
                    <button type="button" class="flow-step active" onclick="showHornerStep(0)">Turunkan</button>
                    <div class="flow-arrow">→</div>
                    <button type="button" class="flow-step" onclick="showHornerStep(1)">Kalikan</button>
                    <div class="flow-arrow">→</div>
                    <button type="button" class="flow-step" onclick="showHornerStep(2)">Jumlahkan</button>
                </div>

                <div class="horner-list-box">
                    <div class="horner-list-title">Langkah-Langkah Metode Horner</div>

                    <ol class="horner-steps-list" id="hornerStepsList">
                        <li data-step="0">Tulis koefisien polinomial dari pangkat tertinggi ke pangkat terendah.</li>
                        <li data-step="0">Tentukan nilai <em>k</em> dari pembagi <em>(x − k)</em>.</li>
                        <li data-step="0">Turunkan koefisien pertama.</li>
                        <li data-step="1">Kalikan dengan <em>k</em>, lalu jumlahkan dengan koefisien berikutnya.</li>
                        <li data-step="2">Ulangi sampai selesai.</li>
                        <li data-step="2">Angka terakhir adalah sisa, angka sebelumnya adalah koefisien hasil bagi.</li>
                    </ol>
                </div>
            </div>

            <div class="info-box blue">
                <div class="section-heading">
                    <span class="heading-icon"></span>
                    Keterkaitan dengan Teorema
                </div>

                <div class="info-text">
                    Metode Horner sangat berkaitan dengan dua teorema penting dalam polinomial, yaitu:
                </div>

                <ul class="teorema-list">
                    <li>
                        <strong>Teorema Sisa</strong><br>
                        Sisa pembagian <em>P(x)</em> oleh <em>(x − k)</em> adalah <em>P(k)</em>.
                    </li>
                    <li>
                        <strong>Teorema Faktor</strong><br>
                        Jika <em>P(k) = 0</em>, maka <em>(x − k)</em> merupakan faktor dari <em>P(x)</em>.
                    </li>
                </ul>
            </div>

            <div class="info-box orange">
                <div class="orange-label">DEFINISI</div>

                <div class="info-text" style="margin-top: 6px;">
                    Metode Horner adalah algoritma yang digunakan untuk membagi polinomial oleh bentuk linear:
                </div>

                <div class="definisi-rumus">(x − k)</div>

                <ul class="definisi-list">
                    <li><strong><em>x</em></strong> = variabel dalam polinomial</li>
                    <li><strong><em>k</em></strong> = bilangan dari pembagi <em>(x − k)</em></li>
                </ul>

                <div class="info-text" style="margin-bottom: 0;">
                    Artinya, polinomial dibagi oleh faktor derajat satu.
                </div>
            </div>

            <div class="contoh-premium-card">
                <div class="contoh-premium-badge">CONTOH</div>

                <div class="contoh-premium-header">
                    <div class="contoh-premium-title">Mari Pelajari Satu Contoh dengan Teliti</div>
                    <div class="contoh-premium-rumus">(2x³ − x² + 3x − 18) ÷ (x − 2)</div>
                </div>

                <div class="horner-premium-wrap">
                    <div class="horner-proses-card">
                        <div class="horner-proses-subtitle">
                            Sebelum mengisi tabel Horner, tentukan dahulu nilai <strong>k</strong> dan koefisien
                            polinomialnya.
                            Setelah itu, lakukan pola <strong>turunkan → kalikan → jumlahkan</strong> sampai semua koefisien
                            selesai dihitung.
                        </div>

                        <div class="proses-info-grid">
                            <div class="proses-info-item">
                                <div class="proses-info-label">Nilai k</div>
                                Pembagi yang digunakan adalah <strong>(x − 2)</strong>. Karena bentuk umumnya adalah
                                <strong>(x − k)</strong>, maka nilai <strong>k = 2</strong>.
                            </div>

                            <div class="proses-info-item">
                                <div class="proses-info-label">Koefisien polinomial</div>
                                Dari polinomial <strong>2x³ − x² + 3x − 18</strong>, koefisien yang ditulis berurutan adalah
                                <strong>2, -1, 3, -18</strong>.
                            </div>
                        </div>

                        <div class="proses-alur">
                            <div class="proses-row">
                                <div class="proses-no">1</div>
                                <div>
                                    <div class="proses-judul">Turunkan koefisien pertama</div>
                                    <div class="proses-rumus">2 turun menjadi 2</div>
                                    <div class="proses-keterangan">
                                        Angka pertama pada baris koefisien adalah <strong>2</strong>. Pada metode Horner,
                                        angka pertama ini langsung diturunkan ke baris bawah tanpa dihitung terlebih dahulu.
                                    </div>
                                </div>
                            </div>

                            <div class="proses-row">
                                <div class="proses-no">2</div>
                                <div>
                                    <div class="proses-judul">Kalikan dengan nilai k</div>
                                    <div class="proses-rumus">2 × 2 = 4</div>
                                    <div class="proses-keterangan">
                                        Angka <strong>2</strong> yang sudah diturunkan dikalikan dengan nilai
                                        <strong>k = 2</strong>. Hasilnya adalah <strong>4</strong> dan diletakkan pada baris
                                        tengah.
                                    </div>
                                </div>
                            </div>

                            <div class="proses-row">
                                <div class="proses-no">3</div>
                                <div>
                                    <div class="proses-judul">Jumlahkan dengan koefisien berikutnya</div>
                                    <div class="proses-rumus">-1 + 4 = 3</div>
                                    <div class="proses-keterangan">
                                        Koefisien berikutnya adalah <strong>-1</strong>. Jumlahkan koefisien tersebut dengan
                                        hasil perkalian
                                        sebelumnya, yaitu <strong>4</strong>. Hasilnya adalah <strong>3</strong> dan ditulis
                                        pada baris bawah.
                                    </div>
                                </div>
                            </div>

                            <div class="proses-row">
                                <div class="proses-no">4</div>
                                <div>
                                    <div class="proses-judul">Kalikan hasil baris bawah dengan k</div>
                                    <div class="proses-rumus">3 × 2 = 6</div>
                                    <div class="proses-keterangan">
                                        Angka <strong>3</strong> dari baris bawah dikalikan lagi dengan nilai
                                        <strong>k = 2</strong>. Hasil perkaliannya adalah <strong>6</strong>.
                                    </div>
                                </div>
                            </div>

                            <div class="proses-row">
                                <div class="proses-no">5</div>
                                <div>
                                    <div class="proses-judul">Jumlahkan dengan koefisien berikutnya</div>
                                    <div class="proses-rumus">3 + 6 = 9</div>
                                    <div class="proses-keterangan">
                                        Koefisien berikutnya adalah <strong>3</strong>. Jumlahkan dengan hasil perkalian
                                        <strong>6</strong>, sehingga diperoleh <strong>9</strong>.
                                    </div>
                                </div>
                            </div>

                            <div class="proses-row">
                                <div class="proses-no">6</div>
                                <div>
                                    <div class="proses-judul">Kalikan kembali dengan k</div>
                                    <div class="proses-rumus">9 × 2 = 18</div>
                                    <div class="proses-keterangan">
                                        Angka <strong>9</strong> dari baris bawah dikalikan dengan nilai
                                        <strong>k = 2</strong>. Hasilnya adalah <strong>18</strong> dan ditulis pada baris
                                        tengah.
                                    </div>
                                </div>
                            </div>

                            <div class="proses-row">
                                <div class="proses-no">7</div>
                                <div>
                                    <div class="proses-judul">Jumlahkan dengan konstanta terakhir</div>
                                    <div class="proses-rumus">-18 + 18 = 0</div>
                                    <div class="proses-keterangan">
                                        Konstanta terakhir adalah <strong>-18</strong>. Setelah dijumlahkan dengan
                                        <strong>18</strong>, hasilnya adalah <strong>0</strong>. Angka terakhir ini menjadi
                                        <strong>sisa pembagian</strong>.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="proses-kesimpulan">
                            Dari proses tersebut, baris bawah tabel Horner adalah <strong>2, 3, 9, 0</strong>.
                            Angka <strong>2, 3, 9</strong> menjadi koefisien hasil bagi, sedangkan angka terakhir
                            <strong>0</strong> menjadi sisa pembagian.
                        </div>
                    </div>

                    <div class="horner-premium-title">Tabel Horner Interaktif</div>
                    <div class="horner-premium-subtitle">
                        Klik angka pada tabel berikut untuk melihat penjelasan asal angka tersebut.
                    </div>

                    <div class="horner-board horner-board-animasi">
                        <div class="horner-line-vertical"></div>
                        <div class="horner-line-horizontal-top"></div>
                        <div class="horner-line-horizontal-bottom"></div>

                        <!-- Tanda tambah di ujung kanan garis bawah -->
                        <div class="horner-premium-plus">+</div>

                        <!-- Nilai k -->
                        <div class="horner-k-box horner-click"
                            onclick="showHornerInfo(this, 'Nilai <strong>k = 2</strong> karena pembaginya berbentuk <strong>(x − 2)</strong>. Pada metode Horner, angka dari pembagi inilah yang dipakai untuk proses perkalian berulang.')">
                            2
                        </div>

                        <!-- Baris atas: koefisien -->
                        <div id="atas1" class="horner-cell top horner-click horner-anim-item"
                            style="grid-column:2; grid-row:1;"
                            onclick="showHornerInfo(this, 'Angka <strong>2</strong> adalah koefisien dari <strong>2x³</strong>. Ini adalah koefisien pertama dari polinomial.')">
                            2
                        </div>

                        <div id="atas2" class="horner-cell top horner-click horner-anim-item"
                            style="grid-column:3; grid-row:1;"
                            onclick="showHornerInfo(this, 'Angka <strong>-1</strong> adalah koefisien dari <strong>-x²</strong>. Jadi koefisien keduanya adalah <strong>-1</strong>.')">
                            -1
                        </div>

                        <div id="atas3" class="horner-cell top horner-click horner-anim-item"
                            style="grid-column:4; grid-row:1;"
                            onclick="showHornerInfo(this, 'Angka <strong>3</strong> adalah koefisien dari <strong>3x</strong>. Ini menjadi koefisien ketiga pada tabel Horner.')">
                            3
                        </div>

                        <div id="atas4" class="horner-cell top horner-click horner-anim-item"
                            style="grid-column:5; grid-row:1;"
                            onclick="showHornerInfo(this, 'Angka <strong>-18</strong> adalah konstanta dari polinomial. Nilai ini ditulis sebagai koefisien terakhir.')">
                            -18
                        </div>

                        <!-- Sel kosong di baris tengah kolom pertama -->
                        <div class="horner-empty-cell" style="grid-column:2; grid-row:2;"></div>

                        <!-- Baris tengah: hasil perkalian -->
                        <div id="tengah1"
                            class="horner-cell horner-click horner-anim-item horner-hidden-awal horner-pop-target"
                            style="grid-column:3; grid-row:2;"
                            onclick="showHornerInfo(this, 'Angka <strong>4</strong> diperoleh dari <strong>2 × 2</strong>, yaitu hasil mengalikan nilai yang diturunkan (<strong>2</strong>) dengan nilai <strong>k = 2</strong>.')">
                            4
                        </div>

                        <div id="tengah2"
                            class="horner-cell horner-click horner-anim-item horner-hidden-awal horner-pop-target"
                            style="grid-column:4; grid-row:2;"
                            onclick="showHornerInfo(this, 'Angka <strong>6</strong> diperoleh dari <strong>3 × 2</strong>. Nilai <strong>3</strong> berasal dari hasil penjumlahan sebelumnya, lalu dikalikan dengan <strong>k = 2</strong>.')">
                            6
                        </div>

                        <div id="tengah3"
                            class="horner-cell horner-click horner-anim-item horner-hidden-awal horner-pop-target"
                            style="grid-column:5; grid-row:2;"
                            onclick="showHornerInfo(this, 'Angka <strong>18</strong> diperoleh dari <strong>9 × 2</strong>. Nilai <strong>9</strong> berasal dari hasil penjumlahan sebelumnya, lalu dikalikan dengan <strong>k = 2</strong>.')">
                            18
                        </div>

                        <!-- Baris bawah: hasil penjumlahan -->
                        <div id="bawah1" class="horner-cell bottom horner-click horner-anim-item"
                            style="grid-column:2; grid-row:3;"
                            onclick="showHornerInfo(this, 'Angka <strong>2</strong> di baris bawah diperoleh dengan cara <strong>langsung menurunkan koefisien pertama</strong> dari baris atas.')">
                            2
                        </div>

                        <div id="bawah2"
                            class="horner-cell bottom horner-click horner-anim-item horner-hidden-awal horner-pop-target"
                            style="grid-column:3; grid-row:3;"
                            onclick="showHornerInfo(this, 'Angka <strong>3</strong> diperoleh dari <strong>-1 + 4</strong>. Koefisien kedua dijumlahkan dengan hasil perkalian sebelumnya.')">
                            3
                        </div>

                        <div id="bawah3"
                            class="horner-cell bottom horner-click horner-anim-item horner-hidden-awal horner-pop-target"
                            style="grid-column:4; grid-row:3;"
                            onclick="showHornerInfo(this, 'Angka <strong>9</strong> diperoleh dari <strong>3 + 6</strong>. Koefisien berikutnya dijumlahkan dengan hasil perkalian sebelumnya.')">
                            9
                        </div>

                        <div id="bawah4"
                            class="horner-cell bottom horner-click horner-anim-item horner-hidden-awal horner-pop-target"
                            style="grid-column:5; grid-row:3;"
                            onclick="showHornerInfo(this, 'Angka <strong>0</strong> diperoleh dari <strong>-18 + 18</strong>. Ini adalah angka terakhir pada baris bawah, sehingga menjadi <strong>sisa pembagian</strong>.')">
                            0
                        </div>
                    </div>

                    <div class="horner-keterangan-box" id="hornerInfoBox">
                        <div class="horner-keterangan-title">Penjelasan Angka</div>
                        <div class="horner-keterangan-text" id="hornerInfoText">
                            Klik salah satu angka pada tabel Horner untuk melihat penjelasannya.
                        </div>
                    </div>

                    <div class="hasil-ringkas-box">
                        <div class="hasil-chip">
                            <div class="hasil-chip-label">Hasil Bagi</div>
                            <div class="hasil-chip-value">Q(x) = 2x² + 3x + 9</div>
                        </div>

                        <div class="hasil-chip">
                            <div class="hasil-chip-label">Sisa</div>
                            <div class="hasil-chip-value">0</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contoh-horner-card">
                <div class="contoh-badge">Mari Mencoba</div>

                <div class="contoh-header">
                    <div class="contoh-subtitle">Gunakan Metode Horner</div>
                    <div class="contoh-rumus">(3x³ + 5x² − 2x + 1) ÷ (x − 1)</div>
                </div>

                <div class="langkah-card step-active" id="card-step-1">
                    <div class="langkah-judul">1. Isi nilai k</div>

                    <div class="langkah-deskripsi">
                        Perhatikan bentuk pembagi <strong>(x − k)</strong>. Nilai yang berada setelah tanda minus itulah
                        yang menjadi nilai <em>k</em>.
                    </div>

                    <div class="input-group-inline">
                        <span>k =</span>
                        <input type="text" id="k" class="kecil-input">
                    </div>

                    <div class="aksi-langkah">
                        <button type="button" class="btn-hint" onclick="showHintStep('hint1')">Hint</button>
                        <button type="button" class="btn-langkah" onclick="cekStep1()">Cek Langkah 1</button>
                    </div>

                    <div id="hint1" class="hint-step">
                        <strong>Petunjuk:</strong> Lihat bentuk pembaginya. Jika pembagi berbentuk
                        <strong>(x − k)</strong>, maka angka setelah tanda minus adalah nilai <strong>k</strong>.
                    </div>

                    <div id="fb1" class="feedback-step"></div>

                    <div id="penjelasan1" class="penjelasan-step">
                        Karena pembaginya adalah <strong>(x − 1)</strong>, maka nilai <strong>k = 1</strong>.
                    </div>
                </div>

                <div class="langkah-card" id="card-step-2">
                    <div class="langkah-judul">2. Isi koefisien polinomial</div>

                    <div class="langkah-deskripsi">
                        Ambil hanya angka koefisien dari polinomial <strong>3x³ + 5x² − 2x + 1</strong> secara berurutan
                        dari pangkat tertinggi ke terendah.
                    </div>

                    <div class="input-group-inline">
                        <input id="c1" class="kecil-input">
                        <input id="c2" class="kecil-input">
                        <input id="c3" class="kecil-input">
                        <input id="c4" class="kecil-input">
                    </div>

                    <div class="aksi-langkah">
                        <button type="button" class="btn-hint" onclick="showHintStep('hint2')">Hint</button>
                        <button type="button" class="btn-langkah" onclick="cekStep2()">Cek Langkah 2</button>
                    </div>

                    <div id="hint2" class="hint-step">
                        <strong>Petunjuk:</strong> Tulis angka yang menempel pada setiap suku.
                        Urutannya dimulai dari suku berpangkat tertinggi, yaitu <strong>x³</strong>, lalu
                        <strong>x²</strong>, lalu <strong>x</strong>, dan terakhir konstanta.
                        Perhatikan tanda positif dan negatifnya.
                    </div>

                    <div id="fb2" class="feedback-step"></div>

                    <div id="penjelasan2" class="penjelasan-step">
                        Koefisiennya adalah <strong>3, 5, -2, 1</strong>.
                    </div>
                </div>

                <div class="langkah-card" id="card-step-3">
                    <div class="langkah-judul">3. Turunkan koefisien pertama</div>

                    <div class="langkah-deskripsi">
                        Dalam metode Horner, koefisien pertama langsung diturunkan ke baris bawah tanpa dihitung terlebih
                        dahulu.
                    </div>

                    <div class="input-group-inline">
                        <span>Angka yang diturunkan =</span>
                        <input id="t1" class="kecil-input">
                    </div>

                    <div class="aksi-langkah">
                        <button type="button" class="btn-hint" onclick="showHintStep('hint3')">Hint</button>
                        <button type="button" class="btn-langkah" onclick="cekStep3()">Cek Langkah 3</button>
                    </div>

                    <div id="hint3" class="hint-step">
                        <strong>Petunjuk:</strong> Pada metode Horner, angka pertama dari daftar koefisien
                        tidak dikalikan atau dijumlahkan dulu. Angka itu langsung diturunkan.
                    </div>

                    <div id="fb3" class="feedback-step"></div>

                    <div id="penjelasan3" class="penjelasan-step">
                        Koefisien pertama adalah <strong>3</strong>, jadi langsung diturunkan menjadi
                        <strong>3</strong>.
                    </div>
                </div>

                <div class="langkah-card" id="card-step-4">
                    <div class="langkah-judul">4. Kalikan dengan k, lalu jumlahkan</div>

                    <div class="langkah-deskripsi">
                        Gunakan angka yang sudah diturunkan pada langkah sebelumnya. Kalikan angka itu dengan nilai
                        <em>k</em>, lalu jumlahkan hasilnya dengan koefisien berikutnya.
                    </div>

                    <div class="input-row">
                        <span>3 × 1 =</span>
                        <input id="s41" class="kecil-input">
                    </div>

                    <div class="input-row">
                        <span>5 + hasil di atas =</span>
                        <input id="s42" class="kecil-input">
                    </div>

                    <div class="aksi-langkah">
                        <button type="button" class="btn-hint" onclick="showHintStep('hint4')">Hint</button>
                        <button type="button" class="btn-langkah" onclick="cekStep4()">Cek Langkah 4</button>
                    </div>

                    <div id="hint4" class="hint-step">
                        <strong>Petunjuk:</strong> Kalikan angka yang sudah diturunkan dengan nilai <strong>k</strong>.
                        Setelah itu, hasil perkalian dijumlahkan dengan koefisien berikutnya, yaitu <strong>5</strong>.
                    </div>

                    <div id="fb4" class="feedback-step"></div>

                    <div id="penjelasan4" class="penjelasan-step">
                        Hasil perkalian <strong>3 × 1 = 3</strong>, lalu <strong>5 + 3 = 8</strong>.
                    </div>
                </div>

                <div class="langkah-card" id="card-step-5">
                    <div class="langkah-judul">5. Ulangi proses yang sama</div>

                    <div class="langkah-deskripsi">
                        Lanjutkan pola yang sama: hasil penjumlahan sebelumnya dikalikan dengan <em>k</em>, lalu dijumlahkan
                        dengan koefisien berikutnya sampai semua koefisien habis.
                    </div>

                    <div class="input-row">
                        <span>8 × 1 =</span>
                        <input id="s51" class="kecil-input">
                    </div>

                    <div class="input-row">
                        <span>-2 + hasil di atas =</span>
                        <input id="s52" class="kecil-input">
                    </div>

                    <div class="input-row">
                        <span>6 × 1 =</span>
                        <input id="s53" class="kecil-input">
                    </div>

                    <div class="input-row">
                        <span>1 + hasil di atas =</span>
                        <input id="s54" class="kecil-input">
                    </div>

                    <div class="aksi-langkah">
                        <button type="button" class="btn-hint" onclick="showHintStep('hint5')">Hint</button>
                        <button type="button" class="btn-langkah" onclick="cekStep5()">Cek Langkah 5</button>
                    </div>

                    <div id="hint5" class="hint-step">
                        <strong>Petunjuk:</strong> Gunakan pola yang sama. Hasil penjumlahan sebelumnya dikalikan dengan
                        <strong>k</strong>, lalu hasilnya dijumlahkan dengan koefisien berikutnya.
                        Karena <strong>k = 1</strong>, setiap angka yang dikalikan dengan 1 hasilnya tetap sama.
                    </div>

                    <div id="fb5" class="feedback-step"></div>

                    <div id="penjelasan5" class="penjelasan-step">
                        Didapat <strong>8 × 1 = 8</strong>, lalu <strong>-2 + 8 = 6</strong>, kemudian
                        <strong>6 × 1 = 6</strong>, dan terakhir <strong>1 + 6 = 7</strong>.
                    </div>
                </div>

                <div class="langkah-card" id="card-step-6">
                    <div class="langkah-judul">6. Lengkapi tabel Horner</div>

                    <div class="langkah-deskripsi">
                        Pindahkan hasil-hasil yang sudah didapat ke dalam tabel Horner. Baris tengah diisi hasil perkalian,
                        sedangkan baris bawah diisi hasil penjumlahan.
                    </div>

                    <div class="horner-table-wrap">
                        <div class="horner-board">
                            <div class="horner-line horner-line-v"></div>
                            <div class="horner-line horner-line-top"></div>
                            <div class="horner-line horner-line-bottom"></div>

                            <div class="horner-k-badge">1</div>

                            <div class="horner-cell row-top col-1">3</div>
                            <div class="horner-cell row-top col-2">5</div>
                            <div class="horner-cell row-top col-3">-2</div>
                            <div class="horner-cell row-top col-4">1</div>

                            <input id="t61" class="horner-cell horner-input row-mid col-2" type="text">
                            <input id="t62" class="horner-cell horner-input row-mid col-3" type="text">
                            <input id="t63" class="horner-cell horner-input row-mid col-4" type="text">

                            <div class="horner-plus-sign">+</div>

                            <div class="horner-cell horner-bottom row-bottom col-1">3</div>
                            <input id="t64" class="horner-cell horner-input horner-bottom row-bottom col-2" type="text">
                            <input id="t65" class="horner-cell horner-input horner-bottom row-bottom col-3" type="text">
                            <input id="t66" class="horner-cell horner-input horner-bottom row-bottom col-4" type="text">
                        </div>
                    </div>

                    <div class="aksi-langkah">
                        <button type="button" class="btn-hint" onclick="showHintStep('hint6')">Hint</button>
                        <button type="button" class="btn-langkah" onclick="cekStep6()">Cek Langkah 6</button>
                    </div>

                    <div id="hint6" class="hint-step">
                        <strong>Petunjuk:</strong> Baris tengah berisi hasil perkalian dengan <strong>k</strong>.
                        Baris bawah berisi hasil penjumlahan antara koefisien di baris atas dan hasil perkalian di baris
                        tengah.
                        Ingat, angka pertama pada baris bawah sudah diturunkan, yaitu <strong>3</strong>.
                    </div>

                    <div id="fb6" class="feedback-step"></div>

                    <div id="penjelasan6" class="penjelasan-step">
                        Baris tengah diisi hasil perkalian berturut-turut, yaitu <strong>3, 8, 6</strong>.
                        <br>
                        Baris bawah diisi hasil penjumlahan, yaitu <strong>8, 6, 7</strong>.
                    </div>
                </div>

                <div class="langkah-card" id="card-step-7">
                    <div class="langkah-judul">7. Tentukan hasil bagi dan sisa</div>

                    <div class="langkah-deskripsi">
                        Perhatikan baris terakhir tabel Horner. Semua angka sebelum angka terakhir menjadi koefisien hasil
                        bagi,
                        sedangkan angka paling akhir adalah sisa pembagian.
                    </div>

                    <div class="input-row">
                        <span>Koefisien hasil bagi:</span>
                        <input id="h1" class="kecil-input">
                        <input id="h2" class="kecil-input">
                        <input id="h3" class="kecil-input">
                    </div>

                    <div class="input-row">
                        <span>Sisa =</span>
                        <input id="sisa" class="kecil-input">
                    </div>

                    <div class="input-row">
                        <span>Q(x) =</span>
                        <input id="qx1" class="kecil-input">
                        <span>x² +</span>
                        <input id="qx2" class="kecil-input">
                        <span>x +</span>
                        <input id="qx3" class="kecil-input">
                    </div>

                    <div class="aksi-langkah">
                        <button type="button" class="btn-hint" onclick="showHintStep('hint7')">Hint</button>
                        <button type="button" class="btn-langkah" onclick="cekStep7()">Cek Langkah 7</button>
                    </div>

                    <div id="hint7" class="hint-step">
                        <strong>Petunjuk:</strong> Lihat baris bawah tabel Horner. Angka terakhir adalah sisa.
                        Angka-angka sebelum sisa menjadi koefisien hasil bagi. Karena polinomial awal berderajat 3,
                        hasil baginya berderajat 2.
                    </div>

                    <div id="fb7" class="feedback-step"></div>

                    <div id="penjelasan7" class="penjelasan-step">
                        Koefisien hasil bagi adalah <strong>3, 8, 6</strong> sehingga
                        <strong>Q(x) = 3x² + 8x + 6</strong>, dan sisanya adalah <strong>7</strong>.
                    </div>
                </div>
            </div>

            <div class="latihan-card">
                <div class="latihan-badge">LATIHAN</div>

                <div class="petunjuk-latihan-box">
                    <b>Petunjuk pengerjaan:</b>
                    Lengkapi setiap bagian latihan dengan jawaban yang tepat. Gunakan metode Horner sesuai langkah yang
                    tersedia.
                </div>

                <!-- ================= SOAL 1 ================= -->
                <div class="latihan-item" id="latihanSoal1">
                    <div class="latihan-soal-title">1. Menentukan Polinomial Awal</div>

                    <div class="soal-pol-awal-box">
                        <p>
                            Diketahui suatu polinomial <strong>P(x)</strong> dibagi oleh
                            <strong>(x − 2)</strong> menghasilkan hasil bagi:
                        </p>

                        <span class="math-line">
                            Q(x) = 4x² + 11x + 17
                        </span>

                        <p>
                            dan sisa <strong>36</strong>. Tentukan polinomial awal
                            <strong>P(x)</strong>.
                        </p>
                    </div>

                    <div class="latihan-box">
                        <div class="latihan-box-title">1. Nilai k dari pembagi (x − 2) adalah ...</div>
                        <div class="pilihan-wrap" data-group="s1k">
                            <button type="button" class="pilihan-btn" onclick="selectOption('s1k', this, '-2')">-2</button>
                            <button type="button" class="pilihan-btn" onclick="selectOption('s1k', this, '2')">2</button>
                            <button type="button" class="pilihan-btn" onclick="selectOption('s1k', this, '1')">1</button>
                        </div>
                    </div>
                    <div class="latihan-box">
                        <div class="latihan-box-title">2. Bentuk hubungan pembagian yang benar adalah ...</div>
                        <div class="pilihan-wrap" data-group="s1koef">
                            <button type="button" class="pilihan-btn"
                                onclick="selectOption('s1koef', this, 'bentuk-benar')">
                                P(x) = (x − 2)(4x² + 11x + 17) + 36
                            </button>

                            <button type="button" class="pilihan-btn"
                                onclick="selectOption('s1koef', this, 'bentuk-salah1')">
                                P(x) = (x + 2)(4x² + 11x + 17) + 36
                            </button>

                            <button type="button" class="pilihan-btn"
                                onclick="selectOption('s1koef', this, 'bentuk-salah2')">
                                P(x) = (x − 2)(4x² + 11x + 17) − 36
                            </button>
                        </div>
                    </div>

                    <div class="latihan-box">
                        <div class="latihan-box-title">3. Hasil dari (x − 2)(4x² + 11x + 17) adalah ...</div>
                        <div class="pilihan-wrap" data-group="s1turun">
                            <button type="button" class="pilihan-btn" onclick="selectOption('s1turun', this, 'kali-benar')">
                                4x³ + 3x² − 5x − 34
                            </button>

                            <button type="button" class="pilihan-btn"
                                onclick="selectOption('s1turun', this, 'kali-salah1')">
                                4x³ + 13x² + 39x + 34
                            </button>

                            <button type="button" class="pilihan-btn"
                                onclick="selectOption('s1turun', this, 'kali-salah2')">
                                4x³ + 3x² − 5x + 34
                            </button>
                        </div>
                    </div>

                    <div class="latihan-box">
                        <div class="latihan-box-title">4. Setelah ditambah sisa 36, diperoleh ...</div>
                        <div class="pilihan-wrap" data-group="s1proses">
                            <button type="button" class="pilihan-btn"
                                onclick="selectOption('s1proses', this, 'tambah-benar')">
                                4x³ + 3x² − 5x + 2
                            </button>

                            <button type="button" class="pilihan-btn"
                                onclick="selectOption('s1proses', this, 'tambah-salah1')">
                                4x³ + 3x² − 5x − 70
                            </button>

                            <button type="button" class="pilihan-btn"
                                onclick="selectOption('s1proses', this, 'tambah-salah2')">
                                4x³ + 3x² − 5x + 36
                            </button>
                        </div>
                    </div>

                    <div class="latihan-box">
                        <div class="latihan-box-title">5. Jadi, polinomial awal P(x) adalah ...</div>
                        <div class="pilihan-wrap" data-group="s1hasil">
                            <button type="button" class="pilihan-btn" onclick="selectOption('s1hasil', this, 'p-benar')">
                                P(x) = 4x³ + 3x² − 5x + 2
                            </button>

                            <button type="button" class="pilihan-btn" onclick="selectOption('s1hasil', this, 'p-salah1')">
                                P(x) = 4x³ + 3x² − 5x − 34
                            </button>

                            <button type="button" class="pilihan-btn" onclick="selectOption('s1hasil', this, 'p-salah2')">
                                P(x) = 4x³ + 11x² + 17x + 36
                            </button>
                        </div>
                    </div>

                    <div style="margin-top: 14px; text-align: center;">
                        <button class="btn-langkah" onclick="cekLatihan1()">Cek Jawaban No. 1</button>
                    </div>

                    <div id="latihanFeedback1" class="latihan-feedback"></div>

                    <div id="latihanPenjelasan1" class="latihan-penjelasan">
                        <strong>Penjelasan Soal 1:</strong><br>
                        Karena pembagi adalah <strong>(x − 2)</strong>, maka nilai <strong>k = 2</strong>.<br>
                        Hubungan antara polinomial, pembagi, hasil bagi, dan sisa adalah:
                        <br>
                        <strong>P(x) = (x − 2)(4x² + 11x + 17) + 36</strong>.<br><br>

                        Hitung perkaliannya:
                        <br>
                        <strong>(x − 2)(4x² + 11x + 17) = 4x³ + 3x² − 5x − 34</strong>.<br><br>

                        Kemudian tambahkan sisanya:
                        <br>
                        <strong>P(x) = 4x³ + 3x² − 5x − 34 + 36</strong>
                        <br>
                        <strong>P(x) = 4x³ + 3x² − 5x + 2</strong>.
                    </div>
                </div>

                <!-- ================= SOAL 2 ================= -->
                <div class="latihan-item soal-terkunci" id="latihanSoal2">
                    <div class="latihan-soal-title">
                        2. Lengkapi tabel Horner berikut untuk menentukan hasil bagi dan sisa:
                    </div>
                    <div class="latihan-rumus">(2x³ − x² + 4x − 8) ÷ (x − 2)</div>

                    <div class="latihan-box">
                        <div class="latihan-box-title">
                            Isi kotak-kotak pada tabel Horner berikut.
                        </div>

                        <div class="latihan-horner-wrap">
                            <div class="latihan-horner-board">
                                <div class="latihan-line latihan-line-v"></div>
                                <div class="latihan-line latihan-line-top"></div>
                                <div class="latihan-line latihan-line-bottom"></div>

                                <!-- Nilai k -->
                                <div class="latihan-k-badge">2</div>

                                <!-- Baris 1: koefisien -->
                                <div class="latihan-horner-cell row-top col-1">2</div>
                                <div class="latihan-horner-cell row-top col-2">-1</div>
                                <div class="latihan-horner-cell row-top col-3">4</div>
                                <div class="latihan-horner-cell row-top col-4">-8</div>

                                <!-- Baris 2: hasil perkalian -->
                                <input id="s2m1" class="latihan-horner-cell latihan-horner-input row-mid col-2" disabled>
                                <input id="s2m2" class="latihan-horner-cell latihan-horner-input row-mid col-3" disabled>
                                <input id="s2m3" class="latihan-horner-cell latihan-horner-input row-mid col-4" disabled>

                                <!-- Tanda plus sebelum baris ketiga -->
                                <div class="latihan-plus-sign">+</div>

                                <!-- Baris 3: hasil penjumlahan -->
                                <div class="latihan-horner-cell latihan-bottom row-bottom col-1">2</div>
                                <input id="s2b1"
                                    class="latihan-horner-cell latihan-horner-input latihan-bottom row-bottom col-2"
                                    disabled>
                                <input id="s2b2"
                                    class="latihan-horner-cell latihan-horner-input latihan-bottom row-bottom col-3"
                                    disabled>
                                <input id="s2b3"
                                    class="latihan-horner-cell latihan-horner-input latihan-bottom row-bottom col-4"
                                    disabled>
                            </div>
                        </div>
                    </div>

                    <div class="latihan-box">
                        <div class="latihan-box-title">Hasil akhir</div>

                        <div class="hasil-akhir-wrap">
                            <div class="hasil-row qx-row">
                                <span class="hasil-label">Q(x) =</span>

                                <input id="s2q1" class="latihan-hasil-input kecil" disabled>
                                <span>x² +</span>

                                <input id="s2q2" class="latihan-hasil-input kecil" disabled>
                                <span>x +</span>

                                <input id="s2q3" class="latihan-hasil-input kecil" disabled>
                            </div>

                            <div class="hasil-row sisa-row">
                                <span class="hasil-label">Sisa =</span>
                                <input id="s2sisa" class="latihan-hasil-input sedang" disabled>
                            </div>
                        </div>
                    </div>
                    <!-- tombol cek no 2 -->
                    <div style="margin-top: 14px; text-align: center;">
                        <button class="btn-langkah" id="btnCekLatihan2" onclick="cekLatihan2()" disabled>
                            Cek Jawaban No. 2
                        </button>
                    </div>

                    <div id="latihanFeedback2" class="latihan-feedback">
                        Jawab soal nomor 1 dengan benar terlebih dahulu.
                    </div>

                    <div id="latihanPenjelasan2" class="latihan-penjelasan">
                        <strong>Penjelasan Soal 2:</strong><br>
                        Q(x) = 2x² + 3x + 10, sisa = 12
                    </div>
                </div>

                <div id="latihanFinalNote" class="latihan-final-note">
                    Bagus! Kedua soal sudah benar.
                </div>
            </div>
        </div>
    </div>

    <script>
        window.completeMateriUrl = "{{ route('materi.complete', $materi->id) }}";
    </script>
    <script>
        let jawabanBenar = false;
        let eksplorasiSelesai = false;
        let soal1Benar = false;

        const latihanJawaban = {
            s1k: '',
            s1koef: '',
            s1turun: '',
            s1proses: '',
            s1hasil: ''
        };

        function normalisasiJawaban(value) {
            return String(value || '')
                .toLowerCase()
                .replace(/\s+/g, '')
                .replace(/−/g, '-')
                .replace(/–/g, '-')
                .replace(/—/g, '-')
                .replace(/\^2/g, '²')
                .replace(/x2/g, 'x²')
                .replace(/x\*2/g, 'x²')
                .replace(/kuadrat/g, '²')
                .replace(/q\(x\)=/g, '')
                .replace(/qx=/g, '')
                .replace(/sisa=/g, 'sisa')
                .replace(/,/g, '')
                .replace(/\./g, '');
        }

        function cocokSalahSatu(value, daftarJawabanBenar) {
            const v = normalisasiJawaban(value);
            return daftarJawabanBenar.some(jawaban => normalisasiJawaban(jawaban) === v);
        }

        function setStatusInput(input, isCorrect) {
            if (!input) return;

            input.classList.remove('input-benar', 'input-salah');

            if (input.value.trim() !== '') {
                input.classList.add(isCorrect ? 'input-benar' : 'input-salah');
            }
        }

        function semuaInputEksplorasiTerisi() {
            const ids = ['a1', 'a2', 'a3', 'a4', 'a5', 'hasilAkhir'];
            return ids.every(id => {
                const el = document.getElementById(id);
                return el && el.value.trim() !== '';
            });
        }

        function tampilkanMateriLanjutan() {
            const materi = document.getElementById('materiLanjutan');
            const infoTerkunci = document.getElementById('infoMateriTerkunci');

            if (materi) materi.style.display = 'block';
            if (infoTerkunci) infoTerkunci.style.display = 'none';
        }

        function ambilInputEksplorasi() {
            return {
                a1: document.getElementById('a1'),
                a2: document.getElementById('a2'),
                a3: document.getElementById('a3'),
                a4: document.getElementById('a4'),
                a5: document.getElementById('a5'),
                hasilAkhir: document.getElementById('hasilAkhir')
            };
        }

        function hapusStatusEksplorasi() {
            const inputs = ambilInputEksplorasi();

            Object.values(inputs).forEach(input => {
                if (!input) return;
                input.classList.remove('input-benar', 'input-salah');
            });
        }

        function cekEksplorasiManual() {
            const { a1, a2, a3, a4, a5, hasilAkhir } = ambilInputEksplorasi();
            const feedback = document.getElementById('feedbackJawaban');
            const penjelasanBox = document.getElementById('penjelasanBox');

            if (!a1 || !a2 || !a3 || !a4 || !a5 || !hasilAkhir || !feedback || !penjelasanBox) {
                return false;
            }

            hapusStatusEksplorasi();

            const daftarInput = [a1, a2, a3, a4, a5, hasilAkhir];
            const semuaTerisi = daftarInput.every(input => input.value.trim() !== '');

            if (!semuaTerisi) {
                daftarInput.forEach(input => {
                    if (input.value.trim() === '') {
                        input.classList.add('input-salah');
                    }
                });

                feedback.textContent = 'Lengkapi semua kolom terlebih dahulu, lalu klik Cek Semua.';
                feedback.className = 'feedback-jawaban feedback-salah';
                penjelasanBox.style.display = 'none';

                tutupMateriLanjutan();

                return false;
            }

            const hasilCek = [
                { input: a1, benar: cocokSalahSatu(a1.value, ['16']) },
                { input: a2, benar: cocokSalahSatu(a2.value, ['12']) },
                { input: a3, benar: cocokSalahSatu(a3.value, ['16']) },
                { input: a4, benar: cocokSalahSatu(a4.value, ['12']) },
                { input: a5, benar: cocokSalahSatu(a5.value, ['11']) },
                { input: hasilAkhir, benar: cocokSalahSatu(hasilAkhir.value, ['11']) }
            ];

            let semuaBenar = true;

            hasilCek.forEach(item => {
                setStatusInput(item.input, item.benar);

                if (!item.benar) {
                    semuaBenar = false;
                }
            });

            jawabanBenar = semuaBenar;

            penjelasanBox.style.display = 'block';

            feedback.textContent = '';
            feedback.className = 'feedback-jawaban';

            if (!eksplorasiSelesai) {
                eksplorasiSelesai = true;
                tampilkanMateriLanjutan();
            }

            return true;
        }

        function tutupMateriLanjutan() {
            const materi = document.getElementById('materiLanjutan');
            const penjelasanBox = document.getElementById('penjelasanBox');

            if (materi) {
                materi.style.display = 'none';
            }

            if (penjelasanBox) {
                penjelasanBox.style.display = 'none';
            }

            eksplorasiSelesai = false;
            jawabanBenar = false;
        }

        function pasangManualEksplorasi() {
            const ids = ['a1', 'a2', 'a3', 'a4', 'a5', 'hasilAkhir'];

            ids.forEach(id => {
                const el = document.getElementById(id);
                if (!el) return;

                el.addEventListener('input', function () {
                    el.classList.remove('input-benar', 'input-salah');

                    const feedback = document.getElementById('feedbackJawaban');

                    if (feedback) {
                        feedback.textContent = '';
                        feedback.className = 'feedback-jawaban';
                    }

                    const semuaMasihTerisi = ids.every(inputId => {
                        const input = document.getElementById(inputId);
                        return input && input.value.trim() !== '';
                    });

                    if (!semuaMasihTerisi) {
                        tutupMateriLanjutan();

                        ids.forEach(inputId => {
                            const input = document.getElementById(inputId);

                            if (input) {
                                input.classList.remove('input-benar', 'input-salah');
                            }
                        });
                    }
                });
            });
        }

        const hornerSteps = [
            {
                title: 'Langkah 1: Turunkan',
                content: 'Tulis dulu koefisien polinomial dari pangkat tertinggi ke terendah, lalu tentukan nilai k dari pembagi (x − k). Setelah siap, koefisien pertama langsung diturunkan ke baris bawah sebagai nilai awal.'
            },
            {
                title: 'Langkah 2: Kalikan',
                content: 'Nilai yang sudah diturunkan kemudian dikalikan dengan k. Hasil perkalian itu ditulis di bawah koefisien berikutnya sebelum dilakukan penjumlahan.'
            },
            {
                title: 'Langkah 3: Jumlahkan',
                content: 'Jumlahkan hasil perkalian dengan koefisien berikutnya. Ulangi proses kalikan dan jumlahkan sampai selesai. Angka terakhir menjadi sisa, sedangkan angka sebelumnya menjadi koefisien hasil bagi.'
            }
        ];

        let currentHornerStep = 0;

        function showHornerStep(index) {
            currentHornerStep = index;

            const buttons = document.querySelectorAll('.flow-step');
            buttons.forEach((btn, i) => {
                btn.classList.toggle('active', i === index);
            });

            const listItems = document.querySelectorAll('#hornerStepsList li');
            listItems.forEach((item) => {
                const stepIndex = parseInt(item.getAttribute('data-step'));
                item.classList.toggle('active-step', stepIndex === index);
            });
        }

        function bukaStep(stepNumber) {
            const current = document.getElementById(`card-step-${stepNumber}`);
            if (current) {
                current.classList.remove('step-locked');
                current.classList.add('step-active');
            }
        }

        function kunciStepLama(stepNumber) {
            const current = document.getElementById(`card-step-${stepNumber}`);
            if (current) {
                current.classList.remove('step-active');
            }
        }

        function tampilBenar(feedbackId, penjelasanId, pesan) {
            const feedback = document.getElementById(feedbackId);
            const penjelasan = document.getElementById(penjelasanId);

            if (feedback) {
                feedback.textContent = pesan;
                feedback.className = 'feedback-step feedback-benar';
            }

            if (penjelasan) {
                penjelasan.style.display = 'block';
            }
        }

        function tampilSalah(feedbackId, penjelasanId, pesan) {
            const feedback = document.getElementById(feedbackId);
            const penjelasan = document.getElementById(penjelasanId);

            if (feedback) {
                feedback.textContent = pesan;
                feedback.className = 'feedback-step feedback-salah';
            }

            if (penjelasan) {
                penjelasan.style.display = 'none';
            }
        }

        function showHintStep(id) {
            const hint = document.getElementById(id);
            if (!hint) return;

            if (hint.style.display === 'block') {
                hint.style.display = 'none';
            } else {
                hint.style.display = 'block';
            }
        }

        function cekStep1() {
            const v = document.getElementById('k')?.value.trim();

            if (v === '1') {
                tampilBenar('fb1', 'penjelasan1', 'Benar, nilai k sudah tepat.');
            } else {
                tampilSalah('fb1', 'penjelasan1', 'Masih salah. Perhatikan bentuk (x − k).');
            }
        }

        function cekStep2() {
            const c1 = document.getElementById('c1')?.value.trim();
            const c2 = document.getElementById('c2')?.value.trim();
            const c3 = document.getElementById('c3')?.value.trim();
            const c4 = document.getElementById('c4')?.value.trim();

            if (c1 === '3' && c2 === '5' && c3 === '-2' && c4 === '1') {
                tampilBenar('fb2', 'penjelasan2', 'Benar, koefisien ditulis dengan urut.');
            } else {
                tampilSalah('fb2', 'penjelasan2', 'Masih ada koefisien yang belum tepat.');
            }
        }

        function cekStep3() {
            const v = document.getElementById('t1')?.value.trim();

            if (v === '3') {
                tampilBenar('fb3', 'penjelasan3', 'Benar, koefisien pertama langsung diturunkan.');
            } else {
                tampilSalah('fb3', 'penjelasan3', 'Masih salah. Coba lihat koefisien pertama.');
            }
        }

        function cekStep4() {
            const a = document.getElementById('s41')?.value.trim();
            const b = document.getElementById('s42')?.value.trim();

            if (a === '3' && b === '8') {
                tampilBenar('fb4', 'penjelasan4', 'Benar, hasil perkalian dan penjumlahan sudah tepat.');
            } else {
                tampilSalah('fb4', 'penjelasan4', 'Periksa lagi hasil kali dan hasil jumlahnya.');
            }
        }

        function cekStep5() {
            const a = document.getElementById('s51')?.value.trim();
            const b = document.getElementById('s52')?.value.trim();
            const c = document.getElementById('s53')?.value.trim();
            const d = document.getElementById('s54')?.value.trim();

            if (a === '8' && b === '6' && c === '6' && d === '7') {
                tampilBenar('fb5', 'penjelasan5', 'Benar, proses Horner sudah selesai.');
            } else {
                tampilSalah('fb5', 'penjelasan5', 'Masih ada hasil yang belum tepat. Coba ulangi prosesnya.');
            }
        }

        function cekStep6() {
            const t61 = document.getElementById('t61')?.value.trim();
            const t62 = document.getElementById('t62')?.value.trim();
            const t63 = document.getElementById('t63')?.value.trim();
            const t64 = document.getElementById('t64')?.value.trim();
            const t65 = document.getElementById('t65')?.value.trim();
            const t66 = document.getElementById('t66')?.value.trim();

            if (
                t61 === '3' &&
                t62 === '8' &&
                t63 === '6' &&
                t64 === '8' &&
                t65 === '6' &&
                t66 === '7'
            ) {
                tampilBenar('fb6', 'penjelasan6', 'Benar, tabel Horner sudah lengkap.');
            } else {
                tampilSalah('fb6', 'penjelasan6', 'Masih ada isian tabel yang belum tepat.');
            }
        }

        function cekStep7() {
            const h1 = document.getElementById('h1')?.value.trim();
            const h2 = document.getElementById('h2')?.value.trim();
            const h3 = document.getElementById('h3')?.value.trim();
            const sisa = document.getElementById('sisa')?.value.trim();
            const qx1 = document.getElementById('qx1')?.value.trim();
            const qx2 = document.getElementById('qx2')?.value.trim();
            const qx3 = document.getElementById('qx3')?.value.trim();

            if (
                h1 === '3' &&
                h2 === '8' &&
                h3 === '6' &&
                sisa === '7' &&
                cocokSalahSatu(qx1, ['3', '3x²', '3x^2', '3x2']) &&
                cocokSalahSatu(qx2, ['8', '8x']) &&
                qx3 === '6'
            ) {
                tampilBenar('fb7', 'penjelasan7', 'Hebat, hasil bagi dan sisa sudah benar.');
            } else {
                tampilSalah('fb7', 'penjelasan7', 'Coba cek lagi koefisien hasil bagi, bentuk Q(x), dan sisanya.');
            }
        }

        function selectOption(group, btn, value) {
            latihanJawaban[group] = value;

            const wrapper = document.querySelector(`[data-group="${group}"]`);
            if (!wrapper) return;

            wrapper.querySelectorAll('.pilihan-btn').forEach(item => {
                item.classList.remove('selected', 'wrong', 'correct');
            });

            btn.classList.add('selected');
        }

        function resetPilihanState(group) {
            const wrapper = document.querySelector(`[data-group="${group}"]`);
            if (!wrapper) return;

            wrapper.querySelectorAll('.pilihan-btn').forEach(btn => {
                btn.classList.remove('correct', 'wrong', 'selected');
            });

            latihanJawaban[group] = '';
        }

        function resetWarnaSaja(group) {
            const wrapper = document.querySelector(`[data-group="${group}"]`);
            if (!wrapper) return;

            wrapper.querySelectorAll('.pilihan-btn').forEach(btn => {
                btn.classList.remove('correct', 'wrong');
            });
        }

        function tandaiSemuaBenar(group, jawabanBenarValue) {
            const wrapper = document.querySelector(`[data-group="${group}"]`);
            if (!wrapper) return;

            wrapper.querySelectorAll('.pilihan-btn').forEach(btn => {
                btn.classList.remove('correct', 'wrong');

                const onclickText = btn.getAttribute('onclick') || '';
                const isCorrectButton = onclickText.includes(`'${jawabanBenarValue}'`);

                if (isCorrectButton) {
                    btn.classList.add('correct');
                }
            });
        }

        function tandaiYangDipilihSalah(group, jawabanBenarValue) {
            const wrapper = document.querySelector(`[data-group="${group}"]`);
            if (!wrapper) return;

            wrapper.querySelectorAll('.pilihan-btn').forEach(btn => {
                btn.classList.remove('correct', 'wrong');

                const onclickText = btn.getAttribute('onclick') || '';
                const isCorrectButton = onclickText.includes(`'${jawabanBenarValue}'`);
                const isSelected = btn.classList.contains('selected');

                if (isSelected && !isCorrectButton) {
                    btn.classList.add('wrong');
                }
            });
        }

        function bukaSoal2() {
            soal1Benar = true;

            const soal2 = document.getElementById('latihanSoal2');
            if (soal2) soal2.classList.remove('soal-terkunci');

            document.querySelectorAll('#latihanSoal2 input').forEach(input => {
                input.disabled = false;
            });

            const btn2 = document.getElementById('btnCekLatihan2');
            if (btn2) btn2.disabled = false;

            const feedback2 = document.getElementById('latihanFeedback2');
            if (feedback2) {
                feedback2.innerHTML = 'Soal nomor 2 sudah terbuka. Silakan kerjakan.';
                feedback2.className = 'latihan-feedback success';
            }
        }

        function kunciSoal2() {
            soal1Benar = false;

            const soal2 = document.getElementById('latihanSoal2');
            if (soal2) soal2.classList.add('soal-terkunci');

            document.querySelectorAll('#latihanSoal2 input').forEach(input => {
                input.disabled = true;
            });

            const btn2 = document.getElementById('btnCekLatihan2');
            if (btn2) btn2.disabled = true;

            const feedback2 = document.getElementById('latihanFeedback2');
            if (feedback2) {
                feedback2.innerHTML = 'Jawab soal nomor 1 dengan benar terlebih dahulu.';
                feedback2.className = 'latihan-feedback error';
            }
        }

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

        let progressSudahDisimpan = false;

        function cekLatihan1() {
            resetWarnaSaja('s1k');
            resetWarnaSaja('s1koef');
            resetWarnaSaja('s1turun');
            resetWarnaSaja('s1proses');
            resetWarnaSaja('s1hasil');

            const benar =
                latihanJawaban.s1k === '2' &&
                latihanJawaban.s1koef === 'bentuk-benar' &&
                latihanJawaban.s1turun === 'kali-benar' &&
                latihanJawaban.s1proses === 'tambah-benar' &&
                latihanJawaban.s1hasil === 'p-benar';

            const feedback = document.getElementById('latihanFeedback1');
            const penjelasan = document.getElementById('latihanPenjelasan1');

            if (!feedback || !penjelasan) return false;

            if (benar) {
                tandaiSemuaBenar('s1k', '2');
                tandaiSemuaBenar('s1koef', 'bentuk-benar');
                tandaiSemuaBenar('s1turun', 'kali-benar');
                tandaiSemuaBenar('s1proses', 'tambah-benar');
                tandaiSemuaBenar('s1hasil', 'p-benar');

                feedback.innerHTML = 'Benar. Soal nomor 1 sudah selesai. Soal nomor 2 sekarang terbuka.';
                feedback.className = 'latihan-feedback success';
                penjelasan.style.display = 'block';

                bukaSoal2();
                return true;
            }

            tandaiYangDipilihSalah('s1k', '2');
            tandaiYangDipilihSalah('s1koef', 'bentuk-benar');
            tandaiYangDipilihSalah('s1turun', 'kali-benar');
            tandaiYangDipilihSalah('s1proses', 'tambah-benar');
            tandaiYangDipilihSalah('s1hasil', 'p-benar');

            feedback.innerHTML = 'Masih ada pilihan yang salah pada soal nomor 1.';
            feedback.className = 'latihan-feedback error';
            penjelasan.style.display = 'none';

            kunciSoal2();
            return false;
        }
        function cekRealtimeLatihan2() {
            if (!soal1Benar) return;

            const data = [
                { id: 's2m1', benar: ['4'] },
                { id: 's2m2', benar: ['6'] },
                { id: 's2m3', benar: ['20'] },
                { id: 's2b1', benar: ['3'] },
                { id: 's2b2', benar: ['10'] },
                { id: 's2b3', benar: ['12'] },
                { id: 's2q1', benar: ['2', '2x²', '2x^2', '2x2'] },
                { id: 's2q2', benar: ['3', '3x'] },
                { id: 's2q3', benar: ['10'] },
                { id: 's2sisa', benar: ['12', 'sisa12', 'sisa=12'] }
            ];

            data.forEach(item => {
                const input = document.getElementById(item.id);
                if (!input) return;

                const value = input.value.trim();
                input.classList.remove('input-benar', 'input-salah');

                if (value !== '') {
                    input.classList.add(cocokSalahSatu(value, item.benar) ? 'input-benar' : 'input-salah');
                }
            });
        }

        async function cekLatihan2() {
            const feedback = document.getElementById('latihanFeedback2');
            const penjelasan = document.getElementById('latihanPenjelasan2');
            const finalNote = document.getElementById('latihanFinalNote');

            if (!soal1Benar) {
                if (feedback) {
                    feedback.innerHTML = 'Jawab soal nomor 1 dengan benar terlebih dahulu.';
                    feedback.className = 'latihan-feedback error';
                }

                if (penjelasan) penjelasan.style.display = 'none';
                if (finalNote) finalNote.style.display = 'none';

                kunciSoal2();
                return false;
            }

            const data = [
                { id: 's2m1', benar: ['4'] },
                { id: 's2m2', benar: ['6'] },
                { id: 's2m3', benar: ['20'] },
                { id: 's2b1', benar: ['3'] },
                { id: 's2b2', benar: ['10'] },
                { id: 's2b3', benar: ['12'] },
                { id: 's2q1', benar: ['2', '2x²', '2x^2', '2x2'] },
                { id: 's2q2', benar: ['3', '3x'] },
                { id: 's2q3', benar: ['10'] },
                { id: 's2sisa', benar: ['12', 'sisa12', 'sisa=12'] }
            ];

            let semuaBenar = true;

            data.forEach(item => {
                const input = document.getElementById(item.id);

                if (!input) {
                    semuaBenar = false;
                    return;
                }

                const benar = cocokSalahSatu(input.value.trim(), item.benar);
                setStatusInput(input, benar);

                if (!benar) semuaBenar = false;
            });

            if (!feedback || !penjelasan) return false;

            if (semuaBenar) {
                feedback.innerHTML = 'Benar. Soal nomor 2 sudah selesai.';
                feedback.className = 'latihan-feedback success';
                penjelasan.style.display = 'block';

                if (finalNote) {
                    finalNote.style.display = 'block';
                    finalNote.innerHTML = 'Bagus! Kedua soal sudah benar. Progress sedang disimpan...';
                    finalNote.className = 'latihan-feedback success';
                }

                if (progressSudahDisimpan) {
                    bukaNextButton();

                    if (finalNote) {
                        finalNote.style.display = 'block';
                        finalNote.innerHTML = '✅ Progress sudah tersimpan. Tombol Next sudah terbuka.';
                        finalNote.className = 'latihan-feedback success';
                    }

                    return true;
                }

                progressSudahDisimpan = true;

                const berhasilSimpan = await saveProgressMateri();

                if (berhasilSimpan) {
                    bukaNextButton();

                    if (finalNote) {
                        finalNote.style.display = 'block';
                        finalNote.innerHTML = '✅ Bagus! Kedua soal sudah benar. Progress berhasil disimpan. Tombol Next sudah terbuka.';
                        finalNote.className = 'latihan-feedback success';
                    }
                } else {
                    progressSudahDisimpan = false;

                    if (finalNote) {
                        finalNote.style.display = 'block';
                        finalNote.innerHTML = '✅ Jawaban benar, tetapi progress gagal disimpan. Silakan klik Cek Jawaban No. 2 lagi.';
                        finalNote.className = 'latihan-feedback error';
                    }
                }

                return true;
            }

            feedback.innerHTML = 'Masih ada isian yang salah pada soal nomor 2.';
            feedback.className = 'latihan-feedback error';
            penjelasan.style.display = 'none';

            if (finalNote) finalNote.style.display = 'none';

            return false;
        }

        async function cekSemuaLatihan() {
            const benar1 = cekLatihan1();

            const finalNote = document.getElementById('latihanFinalNote');
            if (finalNote) finalNote.style.display = 'none';

            if (!benar1) return false;

            const benar2 = await cekLatihan2();

            if (benar1 && benar2) {
                return true;
            }

            if (finalNote) {
                finalNote.style.display = 'none';
            }

            return false;
        }

        function cekInputKosong(el) {
            if (!el) return;

            el.value = '';
            el.classList.remove('input-benar', 'input-salah');
        }

        function ulangiLatihan1() {
            progressSudahDisimpan = false;

            resetPilihanState('s1k');
            resetPilihanState('s1koef');
            resetPilihanState('s1turun');
            resetPilihanState('s1proses');
            resetPilihanState('s1hasil');

            const feedback = document.getElementById('latihanFeedback1');
            const penjelasan = document.getElementById('latihanPenjelasan1');
            const finalNote = document.getElementById('latihanFinalNote');

            if (feedback) feedback.innerHTML = '';
            if (penjelasan) penjelasan.style.display = 'none';
            if (finalNote) finalNote.style.display = 'none';

            ulangiLatihan2();
            kunciSoal2();
        }

        function ulangiLatihan2() {
            progressSudahDisimpan = false;

            const ids = [
                's2m1',
                's2m2',
                's2m3',
                's2b1',
                's2b2',
                's2b3',
                's2q1',
                's2q2',
                's2q3',
                's2sisa'
            ];

            ids.forEach(id => {
                cekInputKosong(document.getElementById(id));
            });

            const feedback = document.getElementById('latihanFeedback2');
            const penjelasan = document.getElementById('latihanPenjelasan2');
            const finalNote = document.getElementById('latihanFinalNote');

            if (feedback) {
                feedback.innerHTML = soal1Benar ? '' : 'Jawab soal nomor 1 dengan benar terlebih dahulu.';
            }

            if (penjelasan) penjelasan.style.display = 'none';
            if (finalNote) finalNote.style.display = 'none';

            if (!soal1Benar) kunciSoal2();
        }

        function showHornerInfo(el, text) {
            const allCells = document.querySelectorAll('.horner-click');
            allCells.forEach(item => item.classList.remove('active'));

            if (el) {
                el.classList.add('active');
            }

            const infoText = document.getElementById('hornerInfoText');

            if (infoText) {
                infoText.innerHTML = text;
            }
        }

        function animasiHorner() {
            setTimeout(() => {
                const el = document.getElementById('top1');
                if (el) el.classList.add('move-down');
            }, 200);

            setTimeout(() => {
                const el = document.getElementById('top2');
                if (el) el.classList.add('move-down');
            }, 400);

            setTimeout(() => {
                const el = document.getElementById('top3');
                if (el) el.classList.add('move-down');
            }, 600);

            setTimeout(() => {
                const el = document.getElementById('top4');
                if (el) el.classList.add('move-down');
            }, 800);

            setTimeout(() => {
                const el = document.getElementById('bot2');
                if (el) el.classList.add('fade-in');
            }, 1200);

            setTimeout(() => {
                const el = document.getElementById('bot3');
                if (el) el.classList.add('fade-in');
            }, 1500);
        }

        document.addEventListener('DOMContentLoaded', function () {
            showHornerStep(0);
            pasangManualEksplorasi();

            const penjelasan1 = document.getElementById('latihanPenjelasan1');
            const penjelasan2 = document.getElementById('latihanPenjelasan2');
            const finalNote = document.getElementById('latihanFinalNote');

            if (penjelasan1) penjelasan1.style.display = 'none';
            if (penjelasan2) penjelasan2.style.display = 'none';
            if (finalNote) finalNote.style.display = 'none';

            kunciSoal2();

            const latihan2Ids = [
                's2m1',
                's2m2',
                's2m3',
                's2b1',
                's2b2',
                's2b3',
                's2q1',
                's2q2',
                's2q3',
                's2sisa'
            ];

            latihan2Ids.forEach(id => {
                const el = document.getElementById(id);
                if (!el) return;

                el.addEventListener('input', cekRealtimeLatihan2);
                el.addEventListener('blur', cekRealtimeLatihan2);
            });
        });
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