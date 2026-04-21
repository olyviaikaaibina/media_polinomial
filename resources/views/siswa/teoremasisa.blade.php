@extends('layout.halamanmateri')

@section('content')
    <style>
        .materi-content {
            padding: 10px 8px 0 8px;
            font-family: Georgia, 'Times New Roman', serif;
            color: #4b4138;
        }

        .judul-materi {
            font-size: 22px;
            font-weight: 700;
            color: #2f7d32;
            margin-bottom: 14px;
        }

        .judul-materi .nomor {
            color: #2f2f2f;
            margin-right: 6px;
        }

        .paragraf-materi {
            font-size: 15.5px;
            line-height: 1.9;
            margin-bottom: 16px;
            text-align: justify;
        }

        .eksplorasi-box {
            background: #f4ede6;
            border-left: 5px solid #e18a2d;
            border-radius: 14px;
            padding: 14px 18px;
            margin-top: 14px;
            min-height: 90px;
        }

        .judul-eksplorasi {
            font-size: 15.5px;
            font-weight: 700;
            color: #2f7d32;
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
        }

        .eksplorasi-text {
            font-size: 15.5px;
            line-height: 1.9;
            margin: 10px 0;
            text-align: justify;
            color: #4b4138;
        }

        .eksplorasi-rumus {
            text-align: center;
            font-size: 18px;
            line-height: 2;
            color: #1f5c24;
            font-weight: 700;
            margin: 10px 0 14px 0;
        }

        .eksplorasi-step-card {
            margin-top: 18px;
            background: #fffaf4;
            border: 1px solid #dccfbe;
            border-radius: 16px;
            padding: 18px 16px;
            transition: 0.25s ease;
        }

        .eksplorasi-step-title {
            font-size: 15.8px;
            font-weight: 700;
            color: #2f7d32;
            margin-bottom: 10px;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .eksplorasi-input-block {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin: 12px 0;
        }

        .eksplorasi-label {
            min-width: 70px;
            font-size: 15.5px;
            font-weight: 700;
            color: #2f7d32;
        }

        .eksplorasi-list {
            margin: 8px 0 12px 20px;
            padding-left: 10px;
            font-size: 15.5px;
            line-height: 1.9;
            color: #4b4138;
        }

        .eksplorasi-table-wrap {
            overflow-x: auto;
            margin-top: 12px;
        }

        .eksplorasi-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            min-width: 540px;
        }

        .eksplorasi-table th,
        .eksplorasi-table td {
            border: 1px solid #cdbfae;
            padding: 12px 10px;
            text-align: center;
            font-size: 15px;
        }

        .eksplorasi-table th {
            background: #dcefd7;
            color: #1f5c24;
            font-weight: 700;
        }

        .eksplorasi-table td {
            background: #fff;
        }

        .eksplorasi-mini-input {
            width: 90px;
            padding: 8px 10px;
            border-radius: 10px;
            border: 1px solid #cdbfae;
            text-align: center;
            font-size: 15px;
            font-family: Georgia, 'Times New Roman', serif;
            outline: none;
        }

        .eksplorasi-mini-input:focus {
            border-color: #8dbb8f;
            box-shadow: 0 0 0 3px rgba(141, 187, 143, 0.15);
        }

        .eksplorasi-status-box {
            margin-top: 16px;
            background: #fff7ed;
            border: 1px dashed #d8b48c;
            border-radius: 14px;
            padding: 14px 16px;
            font-size: 15px;
            line-height: 1.8;
        }

        .eksplorasi-status-box.complete {
            background: #eef8ea;
            border: 1px solid #8dbb8f;
            color: #1f5c24;
            font-weight: 700;
        }

        .materi-terkunci {
            margin-top: 24px;
            background: #f8f3eb;
            border: 2px dashed #ccbca8;
            border-radius: 18px;
            padding: 18px 16px;
            color: #6b5f56;
            font-size: 15.5px;
            line-height: 1.9;
        }

        .materi-lanjutan-wrapper {
            display: none;
            animation: fadeSlide 0.35s ease;
        }

        .materi-lanjutan-wrapper.show {
            display: block;
        }

        @media (max-width: 768px) {
            .eksplorasi-input-block {
                display: block;
            }

            .eksplorasi-label {
                display: block;
                margin-bottom: 8px;
            }

            .eksplorasi-mini-input {
                width: 100%;
            }
        }

        .definisi-wrapper {
            position: relative;
            margin-top: 22px;
            background: #e6bfb0;
            border: 2px solid #d98a66;
            border-radius: 22px;
            padding: 32px 22px 18px 22px;
        }

        .label-definisi {
            position: absolute;
            top: -18px;
            left: 22px;
            background: #9ccc7c;
            color: #2d5a2d;
            font-size: 14.5px;
            font-weight: 700;
            padding: 10px 30px;
            border-radius: 999px;
            border: 1px solid #6fae4a;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .definisi-text {
            font-size: 15.5px;
            line-height: 1.9;
            margin: 0;
        }

        .keterangan-luar {
            font-size: 15.5px;
            line-height: 1.9;
            margin-top: 10px;
        }

        .sifat-wrapper {
            position: relative;
            margin-top: 28px;
            background: #ffffff;
            border: 2px solid #53a653;
            border-radius: 18px;
            padding: 34px 22px 20px 22px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
        }

        .label-sifat {
            position: absolute;
            top: -16px;
            left: 22px;
            background: #f3b291;
            color: #4b2f20;
            font-size: 14.5px;
            font-weight: 700;
            padding: 8px 28px;
            border-radius: 10px 28px 28px 10px;
            border: 1px solid #de7d47;
        }

        .sifat-text {
            font-size: 15.5px;
            line-height: 1.9;
            margin: 0 0 10px 0;
        }

        .sifat-list {
            font-size: 15.5px;
            line-height: 1.9;
            margin: 10px 0 0 0;
            padding-left: 28px;
        }

        .sifat-list li {
            margin-bottom: 8px;
        }

        .langkah-penggunaan {
            margin-top: 26px;
        }

        .judul-langkah {
            font-size: 16.5px;
            font-weight: 700;
            color: #2f7d32;
            margin-bottom: 14px;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .daftar-langkah {
            margin: 0;
            padding-left: 32px;
        }

        .daftar-langkah li {
            font-size: 15.5px;
            line-height: 2;
            margin-bottom: 4px;
        }

        .pembuktian-card {
            position: relative;
            margin-top: 24px;
            background: #ffffff;
            border: 2px solid #8dbb8f;
            border-radius: 22px;
            padding: 34px 28px 22px 28px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
        }

        .label-pembuktian {
            position: absolute;
            top: -18px;
            left: 26px;
            background: #d7dfcf;
            color: #2f7d32;
            font-size: 14.5px;
            font-weight: 700;
            padding: 10px 28px;
            border-radius: 999px;
            border: 1px solid #9bb894;
        }

        .judul-bagian-card {
            font-size: 15.8px;
            line-height: 1.9;
            margin: 0 0 10px 0;
            color: #2f7d32;
            font-weight: 700;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .rumus-tengah {
            text-align: center;
            font-size: 17px;
            line-height: 2;
            color: #2d5a2d;
            margin: 10px 0 16px 0;
        }

        .teks-biasa {
            font-size: 15.5px;
            line-height: 1.9;
            margin-bottom: 16px;
            text-align: justify;
        }

        .subjudul-bukti {
            font-size: 15.8px;
            line-height: 1.9;
            margin-top: 14px;
            margin-bottom: 8px;
            color: #2f7d32;
            font-weight: 700;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .langkah-click-wrap {
            margin: 12px 0 10px 0;
        }

        .langkah-click-btn {
            display: inline-block;
            border: 1px solid #cdbfae;
            background: #f7f1e6;
            color: #4b4138;
            border-radius: 12px;
            padding: 10px 18px;
            margin: 6px 10px 6px 0;
            font-size: 14.8px;
            font-family: Georgia, 'Times New Roman', serif;
            font-weight: 700;
            cursor: pointer;
            transition: 0.25s ease;
        }

        .langkah-click-btn:hover {
            background: #eee4d5;
        }

        .langkah-click-btn.active {
            background: #dce8d3;
            color: #2f7d32;
            border-color: #9bb894;
        }

        .langkah-click-btn.locked {
            background: #ece7de;
            color: #9a9086;
            cursor: not-allowed;
            opacity: 0.85;
        }

        .langkah-hasil {
            display: none;
            margin-top: 16px;
            animation: fadeSlide 0.3s ease;
        }

        .langkah-hasil.show {
            display: block;
        }

        .langkah-rumus {
            text-align: center;
            font-size: 17px;
            line-height: 2;
            color: #2d5a2d;
            margin-bottom: 10px;
        }

        .langkah-penjelasan {
            font-size: 15.5px;
            line-height: 1.9;
            text-align: justify;
            margin-bottom: 12px;
        }

        .kesimpulan-bukti {
            font-size: 15.8px;
            line-height: 1.9;
            color: #2f7d32;
            font-weight: 700;
            margin-top: 14px;
        }

        .contoh-wrapper {
            position: relative;
            margin-top: 38px;
            background: #ffffff;
            border: 2px solid #53a653;
            border-radius: 20px;
            padding: 34px 22px 22px 22px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .label-contoh {
            position: absolute;
            top: -18px;
            left: 22px;
            background: linear-gradient(180deg, #efc0ab 0%, #efab89 100%);
            color: #2c1f17;
            font-size: 14.5px;
            font-weight: 700;
            padding: 10px 24px;
            min-width: 110px;
            text-align: center;
            border-radius: 999px;
            border: 1px solid #de7d47;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
        }

        .contoh-text {
            font-size: 15.5px;
            line-height: 1.9;
            margin-bottom: 10px;
            text-align: justify;
        }

        .rumus-soal {
            text-align: center;
            font-size: 18px;
            line-height: 2;
            margin: 10px 0 14px 0;
            color: #1f3d1f;
            font-weight: 700;
        }

        .bagian-penyelesaian {
            margin-top: 16px;
            font-size: 15.5px;
            line-height: 1.9;
        }

        .judul-penyelesaian {
            font-weight: 700;
            color: #2f7d32;
            text-decoration: underline;
            text-underline-offset: 3px;
            margin-bottom: 8px;
        }

        .hitung-box {
            background: #faf8f4;
            border: 1px solid #e4d8ca;
            border-radius: 14px;
            padding: 14px 16px;
            margin: 12px 0 18px 0;
        }

        .hitung-line {
            font-size: 15.5px;
            line-height: 2;
            text-align: center;
            color: #3f342b;
        }

        .horner-card {
            background: #fbfbfb;
            border: 1px solid #dadada;
            border-radius: 16px;
            padding: 16px;
            margin-top: 12px;
            overflow-x: auto;
        }

        .horner-title {
            font-size: 15px;
            font-weight: 700;
            color: #2f7d32;
            margin-bottom: 12px;
        }

        .horner-table {
            border-collapse: collapse;
            align-items: center;
        }

        .horner-table td {
            text-align: center;
            vertical-align: middle;
        }

        .horner-c {
            width: 42px;
            min-width: 42px;
            font-weight: 700;
            color: #3d332c;
            border-right: 2px solid #666;
            padding-right: 10px;
        }

        .horner-cell-btn {
            min-width: 56px;
            height: 44px;
            border: 1px solid #cfcfcf;
            border-radius: 12px;
            background: #ffffff;
            color: #3a312b;
            font-size: 15px;
            font-family: Georgia, 'Times New Roman', serif;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.25s ease;
            padding: 0 8px;
        }

        .horner-cell-btn:hover {
            background: #eef7ea;
            border-color: #8dbb8f;
            color: #2f7d32;
            transform: translateY(-1px);
        }

        .horner-cell-btn.active {
            background: #dcefd7;
            border-color: #53a653;
            color: #1f5c24;
        }

        .horner-empty {
            min-width: 56px;
            height: 44px;
        }

        .horner-plus {
            font-size: 22px;
            font-weight: 700;
            color: #666;
            padding-left: 4px;
        }

        .horner-info {
            margin-top: 16px;
            background: #f4ede6;
            border-left: 5px solid #e18a2d;
            border-radius: 14px;
            padding: 14px 16px;
            min-height: 78px;
            font-size: 15px;
            line-height: 1.8;
        }

        .sisa-box {
            margin-top: 18px;
            text-align: center;
            font-size: 19px;
            font-weight: 700;
            color: #1f1f1f;
        }

        .catatan-bawah {
            margin-top: 18px;
            font-size: 15.5px;
            line-height: 1.9;
            text-align: justify;
            color: #4b4138;
        }

        .tabel-interaktif-wrapper {
            margin-top: 24px;
            background: #ffffff;
            border: 2px solid #8dbb8f;
            border-radius: 18px;
            padding: 18px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
            overflow-x: auto;
        }

        .tabel-interaktif {
            width: 100%;
            min-width: 760px;
            border-collapse: collapse;
        }

        .tabel-interaktif th,
        .tabel-interaktif td {
            border: 1px solid #333;
            padding: 14px 12px;
            text-align: center;
            font-size: 15px;
        }

        .tabel-interaktif th {
            background: #8fd071;
            color: #173417;
            font-size: 17px;
            font-weight: 700;
        }

        .tabel-interaktif td {
            background: #f5f5f5;
            color: #1e4020;
        }

        .btn-pembagi {
            border: none;
            background: transparent;
            color: #1e4020;
            font-size: 17px;
            font-family: Georgia, 'Times New Roman', serif;
            cursor: pointer;
            font-weight: 700;
            transition: 0.2s ease;
        }

        .btn-pembagi:hover {
            color: #2f7d32;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .btn-pembagi.active {
            color: #2f7d32;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .baris-aktif td {
            background: #edf7e7;
        }

        .penjelasan-pembagi-box {
            margin-top: 18px;
            background: #f4ede6;
            border-left: 5px solid #e18a2d;
            border-radius: 14px;
            padding: 16px 18px;
            font-size: 15.5px;
            line-height: 1.9;
            color: #4b4138;
            animation: fadeSlide 0.3s ease;
        }

        .penjelasan-pembagi-title {
            font-weight: 700;
            color: #2f7d32;
            margin-bottom: 8px;
            font-size: 16px;
        }

        .rumus-penjelasan {
            text-align: center;
            font-size: 18px;
            color: #1f5c24;
            font-weight: 700;
            margin: 10px 0;
        }

        .latihan-step-card {
            margin-top: 18px;
            background: #faf8f4;
            border: 1px solid #dccfbe;
            border-radius: 16px;
            padding: 18px 16px;
            transition: 0.25s ease;
        }

        .latihan-step-card.locked-step {
            opacity: 0.6;
            pointer-events: none;
            background: #f1eee9;
        }

        .latihan-step-title {
            font-size: 15.8px;
            font-weight: 700;
            color: #2f7d32;
            margin-bottom: 10px;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .latihan-input-wrap {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 10px;
            align-items: center;
        }

        .latihan-input {
            min-width: 220px;
            padding: 10px 14px;
            border-radius: 12px;
            border: 1px solid #cdbfae;
            font-size: 15px;
            font-family: Georgia, 'Times New Roman', serif;
            color: #3f342b;
            outline: none;
        }

        .latihan-input:focus {
            border-color: #8dbb8f;
            box-shadow: 0 0 0 3px rgba(141, 187, 143, 0.15);
        }

        .latihan-feedback {
            margin-top: 12px;
            font-size: 15px;
            line-height: 1.8;
            font-weight: 700;
        }

        .latihan-feedback.benar {
            color: #1f5c24;
        }

        .latihan-feedback.salah {
            color: #b03a2e;
        }

        .latihan-penjelasan {
            display: none;
            margin-top: 12px;
            background: #f4ede6;
            border-left: 5px solid #e18a2d;
            border-radius: 14px;
            padding: 14px 16px;
            font-size: 15.5px;
            line-height: 1.9;
            color: #4b4138;
        }

        .latihan-penjelasan.show {
            display: block;
        }

        .penjelasan-akhir-box {
            margin-top: 24px;
            background: #ffffff;
            border: 2px solid #8dbb8f;
            border-radius: 18px;
            padding: 20px 18px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
        }

        .latihan-interaktif-section {
            border-top: none !important;
            margin-top: 34px;
        }

        .latihan-card-modern {
            position: relative;
            margin-top: 28px;
            background: linear-gradient(180deg, #fffdf9 0%, #f9f4ec 100%);
            border: 2px solid #d9c9b3;
            border-radius: 24px;
            padding: 26px 20px 22px 20px;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .latihan-card-modern::before {
            display: none;
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            height: 6px;
            width: 100%;
            background: #8dbb8f;
            border-radius: 26px 26px 0 0;
        }

        .latihan-badge {
            position: absolute;
            top: -18px;
            left: 20px;
            background: linear-gradient(180deg, #e6a077 0%, #d88a5f 100%);
            color: #4b2f20;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 12px 26px;
            border-radius: 20px;
            border: 1px solid #c9784f;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
        }

        .latihan-header {
            margin-bottom: 14px;
            padding-right: 90px;
        }

        .latihan-card-modern {
            position: relative;
            margin-top: 40px;
            background: #fdfaf5;
            border: 2px solid #8dbb8f;
            border-radius: 26px;
            padding: 30px 20px 24px 20px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
            overflow: visible;
        }

        .latihan-card-title {
            font-size: 22px;
            color: #2f7d32;
            margin: 0 0 6px 0;
            font-weight: 700;
        }

        .latihan-card-subtitle {
            font-size: 15.5px;
            line-height: 1.8;
            color: #4b4138;
            margin: 0;
        }

        .latihan-step-card-modern {
            margin-top: 18px;
            background: #fff;
            border: 1px solid #e6d8c6;
            border-radius: 18px;
            padding: 18px 16px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
        }

        .latihan-step-modern-title {
            font-size: 16px;
            font-weight: 700;
            color: #2f7d32;
            margin-bottom: 8px;
        }

        .locked-step {
            opacity: 0.55;
            pointer-events: none;
            filter: grayscale(0.1);
        }

        .pilihan-jawaban-wrap,
        .pilihan-jawaban-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 12px;
        }

        .opsi-btn {
            border: 1px solid #ccbca8;
            background: #fffaf2;
            color: #4b4138;
            border-radius: 14px;
            padding: 12px 16px;
            font-size: 15px;
            font-family: Georgia, 'Times New Roman', serif;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .opsi-btn:hover {
            background: #eef7ea;
            border-color: #8dbb8f;
            color: #2f7d32;
            transform: translateY(-2px);
        }

        .opsi-btn.active-benar {
            background: #dcefd7;
            border-color: #53a653;
            color: #1f5c24;
        }

        .opsi-btn.active-salah {
            background: #f8d7d3;
            border-color: #d96b5f;
            color: #a23328;
        }

        .latihan-input-fancy-wrap {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
            margin-top: 14px;
            background: #f8f3eb;
            border: 1px solid #e3d6c7;
            border-radius: 16px;
            padding: 12px;
        }

        .input-label-mini {
            font-size: 14px;
            font-weight: 700;
            color: #2f7d32;
            min-width: 90px;
        }

        .latihan-input-fancy {
            flex: 1;
            min-width: 180px;
            padding: 11px 14px;
            border-radius: 12px;
            border: 1px solid #cabba8;
            font-size: 15px;
            font-family: Georgia, 'Times New Roman', serif;
            outline: none;
        }

        .latihan-input-fancy:focus {
            border-color: #8dbb8f;
            box-shadow: 0 0 0 3px rgba(141, 187, 143, 0.14);
        }

        .cek-btn-fancy {
            border: none;
            background: #2f7d32;
            color: #fff;
            border-radius: 12px;
            padding: 11px 18px;
            font-size: 14px;
            font-family: Georgia, 'Times New Roman', serif;
            font-weight: 700;
            cursor: pointer;
            transition: 0.25s ease;
        }

        .cek-btn-fancy:hover {
            background: #256628;
        }

        .mini-rumus-box {
            margin-top: 10px;
            background: #f4ede6;
            border-left: 5px solid #e18a2d;
            border-radius: 14px;
            padding: 12px 16px;
            text-align: center;
            font-size: 17px;
            color: #2d5a2d;
            line-height: 1.8;
        }

        .latihan-item {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px dashed #d8c7b3;
        }

        .latihan-item:first-of-type {
            margin-top: 12px;
            padding-top: 0;
            border-top: none;
        }

        .latihan-item-title {
            font-size: 18px;
            font-weight: 700;
            color: #2f7d32;
            margin-bottom: 8px;
        }

        @media (max-width: 768px) {
            .latihan-header {
                padding-right: 0;
            }

            .latihan-badge {
                position: static;
                display: inline-block;
                margin-bottom: 12px;
            }

            .opsi-btn {
                width: 100%;
                text-align: left;
            }

            .latihan-input-fancy-wrap {
                display: block;
            }

            .latihan-input-fancy {
                width: 100%;
                margin: 8px 0 10px 0;
            }

            .cek-btn-fancy {
                width: 100%;
            }
        }

        @keyframes fadeSlide {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {

            .rumus-tengah,
            .langkah-rumus,
            .rumus-soal {
                font-size: 15.5px;
            }

            .langkah-click-btn {
                display: block;
                width: 100%;
                margin-right: 0;
            }

            .pembuktian-card,
            .contoh-wrapper {
                padding: 34px 18px 18px 18px;
            }

            .horner-cell-btn {
                min-width: 48px;
                font-size: 14px;
            }

            .tabel-interaktif th,
            .tabel-interaktif td {
                font-size: 14px;
                padding: 12px 10px;
            }

            .btn-pembagi {
                font-size: 15px;
            }
        }

        .konsep-container {
            margin-top: 12px;
        }

        .konsep-menu {
            display: flex;
            gap: 6px;
            margin-bottom: 10px;
        }

        .konsep-btn {
            flex: 1;
            padding: 8px 10px;
            border-radius: 10px;
            border: 1px solid #cdbfae;
            background: #f4ede6;
            cursor: pointer;
            font-size: 13.5px;
            font-weight: 700;
            transition: 0.25s;
        }

        .konsep-btn:hover {
            background: #e8f3e6;
            color: #2f7d32;
        }

        .konsep-btn.active {
            background: #2f7d32;
            color: white;
        }

        .konsep-box {
            display: none;
            background: #fffaf4;
            border: 1.5px solid #8dbb8f;
            border-radius: 14px;
            padding: 14px;
            font-size: 14px;
            line-height: 1.7;
            animation: fadeSlide 0.3s ease;
        }

        .konsep-box.show {
            display: block;
        }

        .konsep-box h3 {
            font-size: 14.5px;
            margin-bottom: 6px;
        }

        .konsep-box ul {
            margin: 6px 0 0 18px;
        }

        .rumus {
            text-align: center;
            font-size: 15px;
            color: #1f5c24;
            font-weight: 700;
            margin: 8px 0;
        }

        @keyframes fadeSlide {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <style>
        .horner-card {
            background: #fbfbfb;
            border: 1px solid #dadada;
            border-radius: 16px;
            padding: 16px;
            margin-top: 12px;
            overflow-x: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .horner-title {
            font-size: 15px;
            font-weight: 700;
            color: #2f7d32;
            margin-bottom: 12px;
            width: 100%;
            text-align: left;
        }

        .horner-table {
            border-collapse: collapse;
            margin: 0 auto;
        }

        .horner-table td {
            text-align: center;
            vertical-align: middle;
            position: relative;
            padding: 8px;
        }

        .horner-c {
            width: 42px;
            min-width: 42px;
            font-weight: 700;
            color: #3d332c;
            border-right: 2px solid #666;
            padding-right: 10px;
        }

        .horner-cell-btn {
            min-width: 56px;
            height: 44px;
            border: 1px solid #cfcfcf;
            border-radius: 12px;
            background: #ffffff;
            color: #3a312b;
            font-size: 15px;
            font-family: Georgia, 'Times New Roman', serif;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.25s ease;
            padding: 0 8px;
        }

        .horner-cell-btn:hover {
            background: #eef7ea;
            border-color: #8dbb8f;
            color: #2f7d32;
            transform: translateY(-1px);
        }

        .horner-cell-btn.active {
            background: #dcefd7;
            border-color: #53a653;
            color: #1f5c24;
        }

        .horner-empty {
            min-width: 56px;
            height: 44px;
        }

        .horner-divider td:not(.horner-c):not(.horner-plus-cell) {
            border-top: 2px solid #666;
            padding-top: 14px;
        }

        .horner-plus-cell {
            width: 34px;
            min-width: 34px;
            font-size: 28px;
            font-weight: 700;
            color: #666;
            vertical-align: middle;
        }

        .horner-info {
            margin-top: 16px;
            background: #f4ede6;
            border-left: 5px solid #e18a2d;
            border-radius: 14px;
            padding: 14px 16px;
            min-height: 78px;
            font-size: 15px;
            line-height: 1.8;
            width: 100%;
            box-sizing: border-box;
        }

        .horner-card-latihan {
            background: #fbfbfb;
            border: 1px solid #dadada;
            border-radius: 16px;
            padding: 18px 20px;
            margin-top: 12px;
            overflow-x: auto;
        }

        .horner-figure {
            display: flex;
            align-items: stretch;
            justify-content: center;
            gap: 0;
            margin-top: 10px;
            min-width: 760px;
        }

        .horner-left-side {
            width: 70px;
            min-width: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-right: 3px solid #777;
            position: relative;
        }

        .horner-left-c {
            font-size: 20px;
            font-weight: 700;
            color: #4b4138;
        }

        .horner-right-side {
            position: relative;
            padding-left: 12px;
        }

        .horner-row {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .horner-row-top {
            margin-bottom: 18px;
        }

        .horner-row-middle {
            margin-bottom: 16px;
        }

        .horner-row-bottom {
            margin-top: 16px;
        }

        .horner-horizontal-line {
            height: 3px;
            background: #777;
            margin: 0 0 0 0;
            width: calc(100% - 46px);
        }

        .horner-box {
            width: 78px;
            min-width: 78px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .horner-box-label {
            font-size: 18px;
            font-weight: 700;
            color: #4b4138;
            border: 1.5px solid #d5cec4;
            border-radius: 18px;
            background: #fffdf9;
        }

        .horner-box-empty {
            background: transparent;
            border: none;
        }

        .horner-plus-mark {
            width: 46px;
            min-width: 46px;
            font-size: 42px;
            font-weight: 700;
            color: #666;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 6px;
            align-self: center;
        }

        .horner-input {
            width: 78px;
            height: 56px;
            border: 1.5px solid #d5cec4;
            border-radius: 18px;
            text-align: center;
            font-size: 18px;
            font-family: Georgia, 'Times New Roman', serif;
            color: #4b4138;
            background: #fffdf9;
            outline: none;
            box-sizing: border-box;
        }

        .horner-input:focus {
            border-color: #8dbb8f;
            box-shadow: 0 0 0 3px rgba(141, 187, 143, 0.14);
        }

        @media (max-width: 768px) {
            .horner-figure {
                min-width: 650px;
            }

            .horner-box,
            .horner-input {
                width: 64px;
                min-width: 64px;
                height: 50px;
                font-size: 16px;
            }

            .horner-plus-mark {
                width: 38px;
                min-width: 38px;
                font-size: 34px;
            }

            .horner-left-side {
                width: 56px;
                min-width: 56px;
            }
        }
    </style>

    <div class="materi-content">
        <h2 class="judul-materi">
            <span class="nomor">3.</span> Teorema Sisa
        </h2>

        <p class="paragraf-materi">
            Dalam pembagian bilangan bulat, kita sering mendapatkan hasil berupa hasil bagi dan sisa.
            Konsep serupa juga terjadi pada polinomial. Namun, karena polinomial bisa memiliki derajat tinggi,
            proses pembagian bersusun bisa menjadi panjang dan menghabiskan waktu.
        </p>

        <div class="eksplorasi-box">
            <h3 class="judul-eksplorasi">🧭 Eksplorasi</h3>

            <p class="eksplorasi-text">
                Di Banjarmasin, klotok (perahu mesin) sering digunakan sebagai sarana transportasi di sungai.
                Seorang pengemudi klotok mencoba memperkirakan biaya tambahan yang dikeluarkan setiap hari
                berdasarkan banyaknya perjalanan yang ia lakukan.
            </p>

            <p class="eksplorasi-text">
                Biaya tersebut dinyatakan dalam bentuk polinomial berikut:
            </p>

            <div class="eksplorasi-rumus">
                <em>P(x) = x<sup>2</sup> − 2x + 3</em>
            </div>

            <p class="eksplorasi-text">
                Untuk memahami hubungan nilai polinomial dengan sisa pembagian, kerjakan aktivitas berikut.
            </p>

            <div class="eksplorasi-step-card" id="eksplorasiCard1">
                <div class="eksplorasi-step-title">Aktivitas 1 — Menghitung Nilai</div>

                <p class="eksplorasi-text">
                    Hitung nilai berikut dengan teliti.
                </p>

                <div class="eksplorasi-input-block">
                    <label class="eksplorasi-label"><em>P(1)</em> = </label>
                    <input type="text" id="eksplorasiP1" class="latihan-input" placeholder="Masukkan hasil P(1)">
                </div>

                <div class="eksplorasi-input-block">
                    <label class="eksplorasi-label"><em>P(3)</em> = </label>
                    <input type="text" id="eksplorasiP3" class="latihan-input" placeholder="Masukkan hasil P(3)">
                </div>

                <div id="eksplorasiFeedback1" class="latihan-feedback"></div>
                <div id="eksplorasiPenjelasan1" class="latihan-penjelasan"></div>
            </div>

            <div class="eksplorasi-step-card" id="eksplorasiCard2">
                <div class="eksplorasi-step-title">Aktivitas 2 — Menghubungkan dengan Pembagian</div>

                <p class="eksplorasi-text">
                    Perhatikan pembagian berikut:
                </p>

                <ul class="eksplorasi-list">
                    <li><em>P(x) ÷ (x − 1)</em></li>
                    <li><em>P(x) ÷ (x − 3)</em></li>
                </ul>

                <p class="eksplorasi-text">
                    Tanpa melakukan pembagian panjang, isi dugaan sisa pada tabel berikut dengan memakai hasil dari
                    Aktivitas 1.
                </p>

                <div class="eksplorasi-table-wrap">
                    <table class="eksplorasi-table">
                        <thead>
                            <tr>
                                <th>Pembagi</th>
                                <th>Nilai yang dihitung</th>
                                <th>Dugaan sisa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>(x − 1)</td>
                                <td>P(1)</td>
                                <td><input type="text" id="dugaanSisa1" class="eksplorasi-mini-input" placeholder="Isi">
                                </td>
                            </tr>
                            <tr>
                                <td>(x − 3)</td>
                                <td>P(3)</td>
                                <td><input type="text" id="dugaanSisa2" class="eksplorasi-mini-input" placeholder="Isi">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div id="eksplorasiFeedback2" class="latihan-feedback"></div>
                <div id="eksplorasiPenjelasan2" class="latihan-penjelasan"></div>
            </div>
        </div>

        <div id="materiLanjutanWrapper" class="materi-lanjutan-wrapper">
            <p class="paragraf-materi">
                Untuk menyederhanakan proses tersebut, kita menggunakan Teorema Sisa, yaitu teknik yang memungkinkan
                kita menentukan sisa pembagian polinomial hanya dengan melakukan substitusi sederhana, tanpa perlu
                membagi secara manual. Teorema Sisa juga merupakan dasar bagi Teorema Faktor, pemfaktoran polinomial,
                dan penentuan akar polinomial. Dengan memahami teorema ini, Anda dapat menyelesaikan berbagai masalah
                polinomial dengan lebih cepat dan efisien.
            </p>

            <div class="konsep-container">
                <div class="konsep-menu">
                    <button onclick="showKonsep('syarat')" class="konsep-btn active">📌 Syarat Berlaku</button>
                    <button onclick="showKonsep('definisi')" class="konsep-btn">📘 Definisi</button>
                </div>

                <div class="konsep-content">
                    <div id="syarat" class="konsep-box show">
                        <h3>📌 Syarat Berlaku</h3>

                        <p>
                            Teorema Sisa digunakan untuk menentukan sisa pembagian oleh pembagi linear
                            <em>(x − c)</em>.
                        </p>

                        <p><strong>Secara umum:</strong></p>
                        <ul>
                            <li>Jika pembagi derajat 1 → sisa berupa konstanta → bisa pakai <strong>P(c)</strong></li>
                            <li>Jika pembagi derajat > 1 → sisa berupa polinomial → tidak bisa langsung pakai
                                <strong>P(c)</strong>
                            </li>
                        </ul>
                    </div>

                    <div id="definisi" class="konsep-box">
                        <h3>📘 Definisi</h3>

                        <p>
                            Untuk setiap polinomial <em>P(x)</em>, jika dibagi oleh <em>(x − c)</em>, maka:
                        </p>

                        <div class="rumus">
                            <em>P(x) = (x − c)Q(x) + R</em>
                        </div>

                        <p style="text-align:center;">
                            dengan <strong>R = P(c)</strong>
                        </p>
                    </div>
                </div>
            </div>

            <p class="keterangan-luar">
                Dengan kata lain, untuk mengetahui sisa pembagian <em>P(x)</em> oleh <em>(x − c)</em>, cukup hitung
                nilai polinomial pada <em>x = c</em>.
            </p>

            <div class="sifat-wrapper">
                <div class="label-sifat">SIFAT</div>

                <p class="sifat-text">
                    Apabila suatu polinomial <em>P(x)</em> dibagi oleh bentuk linear <em>(x − c)</em>, maka sisa
                    pembagiannya dapat ditentukan dengan menghitung nilai <em>P(c)</em>.
                </p>

                <p class="sifat-text">
                    Sifat ini menghasilkan dua konsekuensi penting:
                </p>

                <ol class="sifat-list">
                    <li>
                        Jika <em>P(c) = 0</em>, maka <em>(x − c)</em> adalah faktor dari <em>P(x)</em>.
                    </li>
                    <li>
                        Jika <em>P(c) ≠ 0</em>, maka nilai tersebut adalah sisa pembagiannya.
                    </li>
                </ol>

                <p class="sifat-text" style="margin-top:12px;">
                    Pernyataan “jika <em>P(c) = 0</em>, maka <em>(x − c)</em> adalah faktor dari <em>P(x)</em>”
                    disebut <strong>Teorema Faktor</strong>.
                </p>
            </div>

            <div class="pembuktian-card">
                <div class="label-pembuktian">BENTUK</div>

                <p class="judul-bagian-card">Pembagian polinomial memiliki bentuk:</p>

                <div class="rumus-tengah">
                    <em>P(x) = (x - c)Q(x) + R</em>
                </div>

                <p class="teks-biasa">
                    Karena pembagi <em>(x - c)</em> adalah derajat 1, maka sisanya selalu berupa konstanta,
                    yaitu <em>R</em>.
                </p>

                <p class="subjudul-bukti">Substitusi <em>x = c</em>:</p>

                <div class="langkah-click-wrap">
                    <button type="button" id="btnLangkah1" class="langkah-click-btn" onclick="bukaLangkahSubstitusi(1)">
                        Langkah 1
                    </button>

                    <button type="button" id="btnLangkah2" class="langkah-click-btn locked"
                        onclick="bukaLangkahSubstitusi(2)">
                        Langkah 2
                    </button>

                    <button type="button" id="btnLangkah3" class="langkah-click-btn locked"
                        onclick="bukaLangkahSubstitusi(3)">
                        Langkah 3
                    </button>
                </div>

                <div id="hasilLangkah1" class="langkah-hasil">
                    <div class="langkah-rumus">
                        <em>P(c) = (c - c)Q(c) + R</em>
                    </div>
                    <p class="langkah-penjelasan">
                        Pada langkah ini, nilai <em>x</em> diganti dengan <em>c</em> pada bentuk
                        <em>P(x) = (x - c)Q(x) + R</em>. Karena itu diperoleh
                        <em>P(c) = (c - c)Q(c) + R</em>.
                    </p>
                </div>

                <div id="hasilLangkah2" class="langkah-hasil">
                    <div class="langkah-rumus">
                        <em>P(c) = 0 + R</em>
                    </div>
                    <p class="langkah-penjelasan">
                        Karena <em>c - c = 0</em>, maka bagian <em>(c - c)Q(c)</em> menjadi
                        <em>0 \cdot Q(c)</em>, sehingga tersisa <em>0 + R</em>.
                    </p>
                </div>

                <div id="hasilLangkah3" class="langkah-hasil">
                    <div class="langkah-rumus">
                        <strong><em>P(c) = R</em></strong>
                    </div>
                    <p class="langkah-penjelasan">
                        Karena <em>0 + R = R</em>, maka diperoleh bahwa nilai polinomial pada
                        <em>x = c</em> sama dengan sisanya.
                    </p>
                </div>

                <p class="kesimpulan-bukti">
                    Inilah bukti bahwa sisa pembagian = <em>P(c)</em>.
                </p>
            </div>

            <div class="contoh-wrapper">
                <div class="label-contoh">CONTOH</div>

                <p class="contoh-text">
                    Tentukan hasil bagi dan sisanya jika
                </p>

                <div class="rumus-soal">
                    <em>P(x) = 5x<sup>5</sup> − 8x<sup>3</sup> + 4x<sup>2</sup> − x + 10</em>
                </div>

                <p class="contoh-text">
                    dibagi dengan <em>x − 3</em>. Dengan menggunakan Teorema Sisa, tentukan nilai <em>P(3)</em>.
                </p>

                <div class="bagian-penyelesaian">
                    <div class="judul-penyelesaian">Penyelesaian:</div>

                    <p class="contoh-text">
                        <strong>Pembagi:</strong> <em>(x − 3)</em> → <strong>c = 3</strong>
                    </p>

                    <div class="hitung-box">
                        <div class="hitung-line">
                            <em>P(3) = 5(3<sup>5</sup>) − 8(3<sup>3</sup>) + 4(3<sup>2</sup>) − 3 + 10</em>
                        </div>
                        <div class="hitung-line">
                            <em>= 5(243) − 8(27) + 4(9) − 3 + 10</em>
                        </div>
                        <div class="hitung-line">
                            <em>= 1215 − 216 + 36 − 3 + 10 = 1042</em>
                        </div>
                    </div>

                    <div class="horner-card">
                        <div class="horner-title">Tabel Horner Interaktif</div>

                        <table class="horner-table">
                            <tr>
                                <td rowspan="3" class="horner-c">3</td>

                                <td>
                                    <button type="button" class="horner-cell-btn"
                                        onclick="showHornerInfo(this, 'Koefisien pertama adalah 5. Nilai ini langsung diturunkan ke baris hasil bawah karena pada metode Horner, koefisien pertama selalu dibawa turun.')">5</button>
                                </td>
                                <td>
                                    <button type="button" class="horner-cell-btn"
                                        onclick="showHornerInfo(this, 'Koefisien kedua adalah 0 karena suku x⁴ tidak ada pada polinomial. Jadi koefisien tetap harus ditulis lengkap: 5, 0, -8, 4, -1, 10.')">0</button>
                                </td>
                                <td>
                                    <button type="button" class="horner-cell-btn"
                                        onclick="showHornerInfo(this, 'Koefisien ketiga adalah -8, berasal dari suku -8x³.')">-8</button>
                                </td>
                                <td>
                                    <button type="button" class="horner-cell-btn"
                                        onclick="showHornerInfo(this, 'Koefisien keempat adalah 4, berasal dari suku 4x².')">4</button>
                                </td>
                                <td>
                                    <button type="button" class="horner-cell-btn"
                                        onclick="showHornerInfo(this, 'Koefisien kelima adalah -1, berasal dari suku -x.')">-1</button>
                                </td>
                                <td>
                                    <button type="button" class="horner-cell-btn"
                                        onclick="showHornerInfo(this, 'Koefisien terakhir adalah 10, yaitu konstanta.')">10</button>
                                </td>

                                <td rowspan="2" class="horner-plus-cell">+</td>
                            </tr>

                            <tr>
                                <td class="horner-empty"></td>
                                <td>
                                    <button type="button" class="horner-cell-btn"
                                        onclick="showHornerInfo(this, 'Nilai 15 diperoleh dari 3 × 5.')">15</button>
                                </td>
                                <td>
                                    <button type="button" class="horner-cell-btn"
                                        onclick="showHornerInfo(this, 'Nilai 45 diperoleh dari 3 × 15.')">45</button>
                                </td>
                                <td>
                                    <button type="button" class="horner-cell-btn"
                                        onclick="showHornerInfo(this, 'Nilai 111 diperoleh dari 3 × 37.')">111</button>
                                </td>
                                <td>
                                    <button type="button" class="horner-cell-btn"
                                        onclick="showHornerInfo(this, 'Nilai 345 diperoleh dari 3 × 115.')">345</button>
                                </td>
                                <td>
                                    <button type="button" class="horner-cell-btn"
                                        onclick="showHornerInfo(this, 'Nilai 1032 diperoleh dari 3 × 344.')">1032</button>
                                </td>
                            </tr>

                            <tr class="horner-divider">
                                <td>
                                    <button type="button" class="horner-cell-btn"
                                        onclick="showHornerInfo(this, 'Angka 5 langsung diturunkan dari koefisien pertama.')">5</button>
                                </td>
                                <td>
                                    <button type="button" class="horner-cell-btn"
                                        onclick="showHornerInfo(this, 'Angka 15 diperoleh dari 0 + 15.')">15</button>
                                </td>
                                <td>
                                    <button type="button" class="horner-cell-btn"
                                        onclick="showHornerInfo(this, 'Angka 37 diperoleh dari -8 + 45 = 37.')">37</button>
                                </td>
                                <td>
                                    <button type="button" class="horner-cell-btn"
                                        onclick="showHornerInfo(this, 'Angka 115 diperoleh dari 4 + 111 = 115.')">115</button>
                                </td>
                                <td>
                                    <button type="button" class="horner-cell-btn"
                                        onclick="showHornerInfo(this, 'Angka 344 diperoleh dari -1 + 345 = 344.')">344</button>
                                </td>
                                <td>
                                    <button type="button" class="horner-cell-btn"
                                        onclick="showHornerInfo(this, 'Angka 1042 diperoleh dari 10 + 1032 = 1042. Ini adalah sisa pembagian dan sama dengan P(3).')">1042</button>
                                </td>
                            </tr>
                        </table>

                        <div id="hornerInfoBox" class="horner-info">
                            Klik salah satu angka pada tabel Horner untuk melihat penjelasannya.
                        </div>
                    </div>

                    <div class="sisa-box">
                        Sisa = 1042
                    </div>
                </div>
            </div>

            <p class="catatan-bawah">
                Untuk lebih memahami bagaimana Teorema Sisa bekerja dalam berbagai bentuk pembagi,
                perhatikan tabel berikut. Klik pada bagian <em>pembagi</em> untuk melihat penjelasannya.
            </p>

            <div class="tabel-interaktif-wrapper">
                <table class="tabel-interaktif">
                    <thead>
                        <tr>
                            <th>Pembagi</th>
                            <th>Nilai c</th>
                            <th>Substitusi</th>
                            <th>Sisa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="rowPembagi1">
                            <td>
                                <button type="button" class="btn-pembagi" onclick="showPembagiExplanation(1, this)">
                                    (x − 2)
                                </button>
                            </td>
                            <td>2</td>
                            <td>P(2)</td>
                            <td>P(2)</td>
                        </tr>
                        <tr id="rowPembagi2">
                            <td>
                                <button type="button" class="btn-pembagi" onclick="showPembagiExplanation(2, this)">
                                    (x + 3)
                                </button>
                            </td>
                            <td>−3</td>
                            <td>P(−3)</td>
                            <td>P(−3)</td>
                        </tr>
                        <tr id="rowPembagi3">
                            <td>
                                <button type="button" class="btn-pembagi" onclick="showPembagiExplanation(3, this)">
                                    (x − 0)
                                </button>
                            </td>
                            <td>0</td>
                            <td>P(0)</td>
                            <td>Konstanta terakhir</td>
                        </tr>
                    </tbody>
                </table>

                <div id="penjelasanPembagiBox" class="penjelasan-pembagi-box">
                    <div class="penjelasan-pembagi-title">Penjelasan</div>
                    Klik salah satu bagian <strong>Pembagi</strong> pada tabel untuk melihat penjelasannya.
                </div>
            </div>

            <div class="contoh-wrapper" id="mariMencobaSection">
                <div class="label-contoh">MARI MENCOBA</div>

                <p class="contoh-text">
                    Kerjakan soal berikut langkah demi langkah, lalu cek jawabanmu di akhir.
                </p>

                <div class="rumus-soal">
                    <em>P(x) = x<sup>3</sup> − 4x + 8</em>, pembagi <em>(x − 3)</em>
                </div>

                <div class="bagian-penyelesaian">

                    <!-- STEP 1 -->
                    <div class="latihan-step-card">
                        <div class="latihan-step-title">Langkah 1 — Menentukan nilai c</div>
                        <p class="contoh-text">
                            Jika pembaginya <em>(x − 3)</em>, maka nilai <strong>c</strong> adalah ...
                        </p>

                        <div class="latihan-input-wrap">
                            <input type="text" id="jawabStep1" class="latihan-input">
                        </div>

                        <div id="penjelasanStep1" class="latihan-penjelasan"></div>
                    </div>

                    <!-- STEP 2 -->
                    <div class="latihan-step-card">
                        <div class="latihan-step-title">Langkah 2 — Bentuk substitusi</div>
                        <p class="contoh-text">
                            Karena <strong>c = 3</strong>, maka dihitung ...
                        </p>

                        <div class="latihan-input-wrap">
                            <input type="text" id="jawabStep2" class="latihan-input">
                        </div>

                        <div id="penjelasanStep2" class="latihan-penjelasan"></div>
                    </div>

                    <!-- STEP 3 -->
                    <div class="latihan-step-card">
                        <div class="latihan-step-title">Langkah 3 — Hitung P(3)</div>

                        <div class="latihan-input-wrap">
                            <input type="text" id="jawabStep3" class="latihan-input">
                        </div>

                        <div id="penjelasanStep3" class="latihan-penjelasan"></div>
                    </div>

                    <!-- STEP 4 -->
                    <div class="latihan-step-card">
                        <div class="latihan-step-title">Langkah 4 — Sisa pembagian</div>

                        <div class="latihan-input-wrap">
                            <input type="text" id="jawabStep4" class="latihan-input">
                        </div>

                        <div id="penjelasanStep4" class="latihan-penjelasan"></div>
                    </div>

                    <!-- CEK -->
                    <div style="text-align:center; margin-top:20px;">
                        <button class="cek-btn-fancy" onclick="cekSemuaStep()">Cek Jawaban</button>
                    </div>

                    <div id="feedbackAkhir" class="latihan-feedback" style="text-align:center;"></div>
                </div>
            </div>

            <div class="latihan-card-modern">
                <div class="latihan-badge">LATIHAN</div>

                <div class="latihan-header">
                    <h3 class="latihan-card-title">Latihan Soal</h3>
                    <p class="latihan-card-subtitle">
                        Kerjakan dua soal berikut dalam satu card latihan interaktif.
                    </p>
                </div>

                <div class="latihan-item">
                    <div class="latihan-item-title">Soal 1 — Teorema Sisa</div>
                    <p class="latihan-card-subtitle">
                        Tentukan sisa pembagian berikut menggunakan Teorema Sisa.
                    </p>

                    <div class="rumus-soal">
                        <em>6x<sup>3</sup> − 5x<sup>2</sup> + 2x − 20</em>
                        <br>
                        <span style="font-size:16px;">dibagi oleh <em>(x − 3)</em></span>
                    </div>

                    <div class="latihan-step-card-modern" id="soal1Step1">
                        <div class="latihan-step-modern-title">Langkah 1 — Tentukan nilai c</div>
                        <p class="contoh-text">
                            Pembagi <em>(x − 3)</em> memiliki nilai <strong>c</strong> = ...
                        </p>

                        <div class="pilihan-jawaban-wrap">
                            <button type="button" class="opsi-btn" onclick="cekPilihanSoal1Step1(this, '2')">2</button>
                            <button type="button" class="opsi-btn" onclick="cekPilihanSoal1Step1(this, '3')">3</button>
                            <button type="button" class="opsi-btn" onclick="cekPilihanSoal1Step1(this, '-3')">-3</button>
                        </div>

                        <div id="soal1Feedback1" class="latihan-feedback"></div>
                        <div id="soal1Penjelasan1" class="latihan-penjelasan"></div>
                    </div>

                    <div class="latihan-step-card-modern locked-step" id="soal1Step2">
                        <div class="latihan-step-modern-title">Langkah 2 — Hitung nilai P(3)</div>
                        <p class="contoh-text">
                            Karena <strong>c = 3</strong>, hitung nilai berikut:
                        </p>

                        <div class="mini-rumus-box">
                            <em>P(3) = 6(3<sup>3</sup>) − 5(3<sup>2</sup>) + 2(3) − 20</em>
                        </div>

                        <div class="latihan-input-fancy-wrap">
                            <span class="input-label-mini">Jawabanmu</span>
                            <input type="text" id="jawabSoal1Step2" class="latihan-input-fancy"
                                placeholder="Masukkan nilai P(3)">
                            <button type="button" class="cek-btn-fancy" onclick="cekSoal1Step2()">Cek</button>
                        </div>

                        <div id="soal1Feedback2" class="latihan-feedback"></div>
                        <div id="soal1Penjelasan2" class="latihan-penjelasan"></div>
                    </div>

                    <div class="latihan-step-card-modern locked-step" id="soal1Step3">
                        <div class="latihan-step-modern-title">Langkah 3 — Kesimpulan sisa pembagian</div>
                        <p class="contoh-text">
                            Karena sisa pembagian oleh <em>(x − 3)</em> adalah <em>P(3)</em>, maka sisa pembagiannya adalah
                            ...
                        </p>

                        <div class="pilihan-jawaban-wrap">
                            <button type="button" class="opsi-btn" onclick="cekPilihanSoal1Step3(this, '83')">83</button>
                            <button type="button" class="opsi-btn" onclick="cekPilihanSoal1Step3(this, '103')">103</button>
                            <button type="button" class="opsi-btn" onclick="cekPilihanSoal1Step3(this, '123')">123</button>
                        </div>

                        <div id="soal1Feedback3" class="latihan-feedback"></div>
                        <div id="soal1Penjelasan3" class="latihan-penjelasan"></div>
                    </div>

                    <div id="soal1FinalBox" class="penjelasan-akhir-box" style="display:none;">
                        <div class="judul-penyelesaian">Penjelasan Lengkap Soal 1</div>
                        <p class="contoh-text">
                            Pembagi adalah <em>(x − 3)</em>, sehingga <strong>c = 3</strong>.
                            Menurut Teorema Sisa, sisa pembagian sama dengan <strong>P(3)</strong>.
                        </p>

                        <div class="hitung-box">
                            <div class="hitung-line"><em>P(3) = 6(3<sup>3</sup>) − 5(3<sup>2</sup>) + 2(3) − 20</em></div>
                            <div class="hitung-line"><em>= 6(27) − 5(9) + 6 − 20</em></div>
                            <div class="hitung-line"><em>= 162 − 45 + 6 − 20</em></div>
                            <div class="hitung-line"><strong><em>= 103</em></strong></div>
                        </div>

                        <p class="catatan-bawah">
                            Jadi, sisa pembagian polinomial tersebut adalah <strong>103</strong>.
                        </p>
                    </div>
                </div>

                <div class="latihan-item">
                    <div class="latihan-item-title">Soal 2 — Metode Horner</div>
                    <p class="latihan-card-subtitle">
                        Gunakan Metode Horner untuk menentukan sisa pembagian berikut.
                    </p>

                    <div class="rumus-soal">
                        <em>P(x) = 2x<sup>6</sup> − 3x<sup>4</sup> + 7x − 5</em>
                        <br>
                        <span style="font-size:16px;">dibagi oleh <em>(x − 1)</em></span>
                    </div>

                    <div class="latihan-step-card-modern" id="soal2Step1">
                        <div class="latihan-step-modern-title">Langkah 1 — Tentukan nilai c</div>
                        <p class="contoh-text">
                            Jika pembaginya <em>(x − 1)</em>, maka nilai <strong>c</strong> adalah ...
                        </p>

                        <div class="pilihan-jawaban-wrap">
                            <button type="button" class="opsi-btn" onclick="cekPilihanSoal2Step1(this, '1')">1</button>
                            <button type="button" class="opsi-btn" onclick="cekPilihanSoal2Step1(this, '-1')">-1</button>
                            <button type="button" class="opsi-btn" onclick="cekPilihanSoal2Step1(this, '0')">0</button>
                        </div>

                        <div id="soal2Feedback1" class="latihan-feedback"></div>
                        <div id="soal2Penjelasan1" class="latihan-penjelasan"></div>
                    </div>

                    <div class="latihan-step-card-modern locked-step" id="soal2Step2">
                        <div class="latihan-step-modern-title">Langkah 2 — Lengkapi koefisien polinomial</div>
                        <p class="contoh-text">
                            Karena ada suku yang hilang, koefisien lengkap dari
                            <em>2x<sup>6</sup> − 3x<sup>4</sup> + 7x − 5</em> adalah ...
                        </p>

                        <div class="pilihan-jawaban-grid">
                            <button type="button" class="opsi-btn" onclick="cekPilihanSoal2Step2(this, 'benar')">
                                2, 0, -3, 0, 0, 7, -5
                            </button>
                            <button type="button" class="opsi-btn" onclick="cekPilihanSoal2Step2(this, 'salah1')">
                                2, -3, 0, 0, 7, -5
                            </button>
                            <button type="button" class="opsi-btn" onclick="cekPilihanSoal2Step2(this, 'salah2')">
                                2, 0, -3, 0, 7, -5
                            </button>
                        </div>

                        <div id="soal2Feedback2" class="latihan-feedback"></div>
                        <div id="soal2Penjelasan2" class="latihan-penjelasan"></div>
                    </div>

                    <div class="latihan-step-card-modern locked-step" id="soal2Step3">
                        <div class="latihan-step-modern-title">Langkah 3 — Lengkapi Tabel Horner</div>
                        <p class="contoh-text">
                            Lengkapi tabel Horner berikut untuk menentukan sisa pembagian oleh <em>(x − 1)</em>.
                        </p>

                        <div class="horner-card horner-card-latihan">
                            <div class="horner-title">Tabel Horner (c = 1)</div>

                            <div class="horner-figure">
                                <div class="horner-left-side">
                                    <div class="horner-left-c">1</div>
                                </div>

                                <div class="horner-right-side">
                                    <div class="horner-row horner-row-top">
                                        <div class="horner-box horner-box-label">2</div>
                                        <div class="horner-box horner-box-label">0</div>
                                        <div class="horner-box horner-box-label">-3</div>
                                        <div class="horner-box horner-box-label">0</div>
                                        <div class="horner-box horner-box-label">0</div>
                                        <div class="horner-box horner-box-label">7</div>
                                        <div class="horner-box horner-box-label">-5</div>
                                    </div>

                                    <div class="horner-row horner-row-middle">
                                        <div class="horner-box horner-box-empty"></div>

                                        <div class="horner-box"><input type="text" id="h1" class="horner-input"></div>
                                        <div class="horner-box"><input type="text" id="h2" class="horner-input"></div>
                                        <div class="horner-box"><input type="text" id="h3" class="horner-input"></div>
                                        <div class="horner-box"><input type="text" id="h4" class="horner-input"></div>
                                        <div class="horner-box"><input type="text" id="h5" class="horner-input"></div>
                                        <div class="horner-box"><input type="text" id="h6" class="horner-input"></div>

                                        <div class="horner-plus-mark">+</div>
                                    </div>

                                    <div class="horner-horizontal-line"></div>

                                    <div class="horner-row horner-row-bottom">
                                        <div class="horner-box horner-box-label">2</div>

                                        <div class="horner-box"><input type="text" id="h7" class="horner-input"></div>
                                        <div class="horner-box"><input type="text" id="h8" class="horner-input"></div>
                                        <div class="horner-box"><input type="text" id="h9" class="horner-input"></div>
                                        <div class="horner-box"><input type="text" id="h10" class="horner-input"></div>
                                        <div class="horner-box"><input type="text" id="h11" class="horner-input"></div>
                                        <div class="horner-box"><input type="text" id="h12" class="horner-input"></div>
                                    </div>
                                </div>
                            </div>

                            <div style="text-align:center; margin-top:12px;">
                                <button type="button" class="cek-btn-fancy" onclick="cekHornerSoal2()">Periksa
                                    Tabel</button>
                            </div>

                            <div id="feedbackHorner2" class="latihan-feedback" style="text-align:center;"></div>
                        </div>
                    </div>

                    <div id="soal2FinalBox" class="penjelasan-akhir-box" style="display:none;">
                        <div class="judul-penyelesaian">Penjelasan Lengkap Soal 2</div>
                        <p class="contoh-text">
                            Pembagi <em>(x − 1)</em> memberi <strong>c = 1</strong>.
                            Pada metode Horner, koefisien polinomial harus ditulis lengkap, termasuk suku yang hilang.
                        </p>

                        <p class="contoh-text">
                            Maka koefisien lengkapnya adalah:
                            <strong>2, 0, -3, 0, 0, 7, -5</strong>
                        </p>

                        <div class="hitung-box">
                            <div class="hitung-line"><em>Baris atas: 2, 0, -3, 0, 0, 7, -5</em></div>
                            <div class="hitung-line"><em>Baris tengah: 2, 2, -1, -1, -1, 6</em></div>
                            <div class="hitung-line"><em>Baris bawah: 2, 2, -1, -1, -1, 6, 1</em></div>
                        </div>

                        <p class="contoh-text">
                            Angka terakhir pada tabel Horner adalah <strong>1</strong>, sehingga sisa pembagian polinomial
                            tersebut
                            adalah
                            <strong>1</strong>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let langkahTerbuka = 0;
        let materiEksplorasiSudahTerbuka = false;

        function normalisasiInput(text) {
            return (text || '')
                .toString()
                .trim()
                .toLowerCase()
                .replace(/\s+/g, '')
                .replace(/−/g, '-');
        }

        function normalizeAnswer(text) {
            return (text || '')
                .toString()
                .trim()
                .toLowerCase()
                .replace(/\s+/g, '')
                .replace(/−/g, '-');
        }

        function semuaEksplorasiTerisi() {
            const p1 = normalisasiInput(document.getElementById('eksplorasiP1')?.value);
            const p3 = normalisasiInput(document.getElementById('eksplorasiP3')?.value);
            const s1 = normalisasiInput(document.getElementById('dugaanSisa1')?.value);
            const s2 = normalisasiInput(document.getElementById('dugaanSisa2')?.value);

            return p1 !== '' && p3 !== '' && s1 !== '' && s2 !== '';
        }

        function bukaMateriLanjutanJikaSiap() {
            const statusBox = document.getElementById('statusEksplorasi');
            const notice = document.getElementById('materiTerkunciNotice');
            const wrapper = document.getElementById('materiLanjutanWrapper');

            if (!statusBox || !notice || !wrapper) return;

            if (semuaEksplorasiTerisi()) {
                statusBox.classList.add('complete');
                statusBox.innerHTML = 'Semua soal eksplorasi sudah terisi. Materi lanjutan telah dibuka kembali.';

                notice.style.display = 'none';
                wrapper.classList.add('show');
                materiEksplorasiSudahTerbuka = true;
            } else {
                statusBox.classList.remove('complete');
                statusBox.innerHTML = 'Isi semua jawaban pada Aktivitas 1 dan Aktivitas 2 terlebih dahulu. Setelah semua terisi, materi selanjutnya akan terbuka otomatis.';

                notice.style.display = 'block';
                wrapper.classList.remove('show');
                materiEksplorasiSudahTerbuka = false;
            }
        }

        function cekEksplorasi1Otomatis() {
            const inputP1 = document.getElementById('eksplorasiP1');
            const inputP3 = document.getElementById('eksplorasiP3');
            const feedback = document.getElementById('eksplorasiFeedback1');
            const penjelasan = document.getElementById('eksplorasiPenjelasan1');

            if (!inputP1 || !inputP3 || !feedback || !penjelasan) return;

            const p1 = normalisasiInput(inputP1.value);
            const p3 = normalisasiInput(inputP3.value);

            if (p1 === '' || p3 === '') {
                feedback.className = 'latihan-feedback';
                feedback.innerHTML = '';
                penjelasan.classList.remove('show');
                penjelasan.innerHTML = '';
                bukaMateriLanjutanJikaSiap();
                return;
            }

            if (p1 === '2' && p3 === '6') {
                feedback.className = 'latihan-feedback benar';
                feedback.innerHTML = 'Jawaban terdeteksi benar. Nilai yang kamu hitung sudah tepat.';

                penjelasan.innerHTML = `
                                        Untuk polinomial <em>P(x) = x<sup>2</sup> − 2x + 3</em>:
                                        <br><br>
                                        <strong>P(1)</strong> = 1<sup>2</sup> − 2(1) + 3 = 1 − 2 + 3 = <strong>2</strong>
                                        <br>
                                        <strong>P(3)</strong> = 3<sup>2</sup> − 2(3) + 3 = 9 − 6 + 3 = <strong>6</strong>
                                        <br><br>
                                        Jadi, hasil perhitungan pada Aktivitas 1 adalah <strong>P(1) = 2</strong> dan <strong>P(3) = 6</strong>.
                                    `;
                penjelasan.classList.add('show');
            } else {
                feedback.className = 'latihan-feedback salah';
                feedback.innerHTML = 'Jawaban terdeteksi masih salah. Berikut jawaban yang benar.';

                penjelasan.innerHTML = `
                                        Untuk polinomial <em>P(x) = x<sup>2</sup> − 2x + 3</em>:
                                        <br><br>
                                        <strong>P(1)</strong> = 1<sup>2</sup> − 2(1) + 3 = 1 − 2 + 3 = <strong>2</strong>
                                        <br>
                                        <strong>P(3)</strong> = 3<sup>2</sup> − 2(3) + 3 = 9 − 6 + 3 = <strong>6</strong>
                                        <br><br>
                                        Jadi jawaban yang benar adalah <strong>P(1) = 2</strong> dan <strong>P(3) = 6</strong>.
                                    `;
                penjelasan.classList.add('show');
            }

            bukaMateriLanjutanJikaSiap();
        }

        function cekEksplorasi2Otomatis() {
            const inputS1 = document.getElementById('dugaanSisa1');
            const inputS2 = document.getElementById('dugaanSisa2');
            const feedback = document.getElementById('eksplorasiFeedback2');
            const penjelasan = document.getElementById('eksplorasiPenjelasan2');

            if (!inputS1 || !inputS2 || !feedback || !penjelasan) return;

            const sisa1 = normalisasiInput(inputS1.value);
            const sisa2 = normalisasiInput(inputS2.value);

            if (sisa1 === '' || sisa2 === '') {
                feedback.className = 'latihan-feedback';
                feedback.innerHTML = '';
                penjelasan.classList.remove('show');
                penjelasan.innerHTML = '';
                bukaMateriLanjutanJikaSiap();
                return;
            }

            if (sisa1 === '2' && sisa2 === '6') {
                feedback.className = 'latihan-feedback benar';
                feedback.innerHTML = 'Jawaban terdeteksi benar. Dugaan sisamu sudah tepat.';

                penjelasan.innerHTML = `
                                        Dari Aktivitas 1 diperoleh:
                                        <br><br>
                                        <strong>P(1) = 2</strong> dan <strong>P(3) = 6</strong>.
                                        <br><br>
                                        Maka:
                                        <ul class="eksplorasi-list">
                                            <li>Jika <em>P(x)</em> dibagi dengan <em>(x − 1)</em>, dugaan sisanya adalah <strong>2</strong>.</li>
                                            <li>Jika <em>P(x)</em> dibagi dengan <em>(x − 3)</em>, dugaan sisanya adalah <strong>6</strong>.</li>
                                        </ul>
                                        Jadi jawaban yang benar adalah:
                                        <br>
                                        <strong>(x − 1) → 2</strong> dan <strong>(x − 3) → 6</strong>.
                                    `;
                penjelasan.classList.add('show');
            } else {
                feedback.className = 'latihan-feedback salah';
                feedback.innerHTML = 'Jawaban terdeteksi masih salah. Berikut jawaban yang benar.';

                penjelasan.innerHTML = `
                                        Gunakan hasil Aktivitas 1:
                                        <br><br>
                                        <strong>P(1) = 2</strong> dan <strong>P(3) = 6</strong>.
                                        <br><br>
                                        Maka jawaban yang benar adalah:
                                        <ul class="eksplorasi-list">
                                            <li>Untuk pembagi <em>(x − 1)</em>, dugaan sisa = <strong>2</strong></li>
                                            <li>Untuk pembagi <em>(x − 3)</em>, dugaan sisa = <strong>6</strong></li>
                                        </ul>
                                    `;
                penjelasan.classList.add('show');
            }

            bukaMateriLanjutanJikaSiap();
        }

        function pasangAutoCheckEksplorasi() {
            const idsAktivitas1 = ['eksplorasiP1', 'eksplorasiP3'];
            const idsAktivitas2 = ['dugaanSisa1', 'dugaanSisa2'];

            idsAktivitas1.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('input', cekEksplorasi1Otomatis);
                    el.addEventListener('blur', cekEksplorasi1Otomatis);
                }
            });

            idsAktivitas2.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('input', cekEksplorasi2Otomatis);
                    el.addEventListener('blur', cekEksplorasi2Otomatis);
                }
            });
        }

        function showKonsep(id) {
            const boxes = document.querySelectorAll('.konsep-box');
            const buttons = document.querySelectorAll('.konsep-btn');

            boxes.forEach(box => box.classList.remove('show'));
            buttons.forEach(btn => btn.classList.remove('active'));

            const activeBox = document.getElementById(id);
            if (activeBox) activeBox.classList.add('show');

            if (id === 'syarat' && buttons[0]) {
                buttons[0].classList.add('active');
            } else if (buttons[1]) {
                buttons[1].classList.add('active');
            }
        }

        function bukaLangkahSubstitusi(langkah) {
            if (langkah > langkahTerbuka + 1) return;

            const tombol = document.getElementById('btnLangkah' + langkah);
            if (!tombol || tombol.classList.contains('locked')) return;

            const hasil = document.getElementById('hasilLangkah' + langkah);
            if (!hasil) return;

            if (!hasil.classList.contains('show')) {
                hasil.classList.add('show');
                tombol.classList.add('active');

                if (langkah > langkahTerbuka) {
                    langkahTerbuka = langkah;
                }

                const nextLangkah = langkah + 1;
                const nextButton = document.getElementById('btnLangkah' + nextLangkah);

                if (nextButton) {
                    nextButton.classList.remove('locked');
                }
            }
        }

        function showHornerInfo(button, text) {
            const allButtons = document.querySelectorAll('.horner-cell-btn');
            allButtons.forEach(btn => btn.classList.remove('active'));

            if (button) button.classList.add('active');

            const infoBox = document.getElementById('hornerInfoBox');
            if (infoBox) infoBox.innerHTML = text;
        }

        function showPembagiExplanation(id, button) {
            const allRows = document.querySelectorAll('.tabel-interaktif tbody tr');
            const allButtons = document.querySelectorAll('.btn-pembagi');
            const box = document.getElementById('penjelasanPembagiBox');
            const activeRow = document.getElementById('rowPembagi' + id);

            allRows.forEach(row => row.classList.remove('baris-aktif'));
            allButtons.forEach(btn => btn.classList.remove('active'));

            if (button) button.classList.add('active');
            if (activeRow) activeRow.classList.add('baris-aktif');
            if (!box) return;

            if (id === 1) {
                box.innerHTML = `
                                        <div class="penjelasan-pembagi-title">Penjelasan untuk pembagi (x − 2)</div>
                                        Bentuk pembagi <strong>(x − 2)</strong> sudah langsung sesuai dengan bentuk umum
                                        <em>(x − c)</em>, sehingga diperoleh <strong>c = 2</strong>.
                                        <div class="rumus-penjelasan">Sisa = P(2)</div>
                                        Artinya, untuk mencari sisa pembagian polinomial oleh <em>(x − 2)</em>,
                                        cukup substitusikan <em>x = 2</em> ke dalam polinomial.
                                    `;
            } else if (id === 2) {
                box.innerHTML = `
                                        <div class="penjelasan-pembagi-title">Penjelasan untuk pembagi (x + 3)</div>
                                        Bentuk <strong>(x + 3)</strong> perlu ditulis ulang menjadi
                                        <em>(x − (−3))</em>, sehingga diperoleh <strong>c = −3</strong>.
                                        <div class="rumus-penjelasan">Sisa = P(−3)</div>
                                        Jadi, walaupun pada pembagi terlihat tanda <strong>plus</strong>, nilai yang
                                        disubstitusikan ke polinomial justru <strong>−3</strong>.
                                    `;
            } else if (id === 3) {
                box.innerHTML = `
                                        <div class="penjelasan-pembagi-title">Penjelasan untuk pembagi (x − 0)</div>
                                        Pada pembagi <strong>(x − 0)</strong>, nilai <strong>c = 0</strong>.
                                        Maka sisanya diperoleh dari
                                        <div class="rumus-penjelasan">Sisa = P(0)</div>
                                        Ketika <em>x = 0</em>, semua suku yang memuat <em>x</em> akan bernilai nol,
                                        sehingga yang tersisa hanyalah <strong>konstanta terakhir</strong> dari polinomial.
                                    `;
            }
        }

        function bukaStep(stepNumber) {
            const step = document.getElementById('stepCard' + stepNumber);
            if (step) {
                step.classList.remove('locked-step');
            }
        }

        function tampilkanBenar(feedbackId, penjelasanId, pesanFeedback, isiPenjelasan) {
            const feedback = document.getElementById(feedbackId);
            const penjelasan = document.getElementById(penjelasanId);

            if (!feedback || !penjelasan) return;

            feedback.className = 'latihan-feedback benar';
            feedback.innerHTML = 'Jawaban benar. ' + pesanFeedback;

            penjelasan.innerHTML = isiPenjelasan;
            penjelasan.classList.add('show');
        }

        function tampilkanSalah(feedbackId, penjelasanId, pesanFeedback, isiPenjelasan) {
            const feedback = document.getElementById(feedbackId);
            const penjelasan = document.getElementById(penjelasanId);

            if (!feedback || !penjelasan) return;

            feedback.className = 'latihan-feedback salah';
            feedback.innerHTML = pesanFeedback;

            penjelasan.innerHTML = isiPenjelasan;
            penjelasan.classList.add('show');
        }

        function cekStep1() {
            const input = document.getElementById('jawabStep1');
            if (!input) return;

            const jawaban = normalisasiInput(input.value);

            if (jawaban === '3') {
                tampilkanBenar(
                    'feedbackStep1',
                    'penjelasanStep1',
                    'Nilai c sudah tepat.',
                    'Pembagi <em>(x − 3)</em> dibandingkan dengan bentuk umum <em>(x − c)</em>. Dari sini terlihat bahwa <strong>c = 3</strong>. Jadi, langkah pertama adalah mengenali nilai yang ada setelah tanda minus pada pembagi.'
                );
                bukaStep(2);
            } else {
                tampilkanSalah(
                    'feedbackStep1',
                    'penjelasanStep1',
                    'Jawaban masih salah. Berikut jawaban yang benar.',
                    'Pembagi <em>(x − 3)</em> dibandingkan dengan bentuk umum <em>(x − c)</em>, sehingga diperoleh <strong>c = 3</strong>. Jadi jawaban yang benar adalah <strong>3</strong>.'
                );
            }
        }

        function cekStep2() {
            const input = document.getElementById('jawabStep2');
            if (!input) return;

            const jawaban = normalisasiInput(input.value);

            if (jawaban === 'p(3)' || jawaban === 'p3') {
                tampilkanBenar(
                    'feedbackStep2',
                    'penjelasanStep2',
                    'Bentuk substitusi sudah benar.',
                    'Karena <strong>c = 3</strong>, maka menurut Teorema Sisa kita harus menghitung <strong>P(3)</strong>. Artinya, setiap <em>x</em> pada polinomial diganti dengan <em>3</em>.'
                );
                bukaStep(3);
            } else {
                tampilkanSalah(
                    'feedbackStep2',
                    'penjelasanStep2',
                    'Jawaban masih salah. Berikut jawaban yang benar.',
                    'Gunakan bentuk umum Teorema Sisa: jika pembagi <em>(x − c)</em>, maka sisa dicari dengan <strong>P(c)</strong>. Karena pembaginya <em>(x − 3)</em>, maka jawaban yang benar adalah <strong>P(3)</strong>.'
                );
            }
        }

        function cekStep3() {
            const input = document.getElementById('jawabStep3');
            if (!input) return;

            const jawaban = normalisasiInput(input.value);

            if (jawaban === '23') {
                tampilkanBenar(
                    'feedbackStep3',
                    'penjelasanStep3',
                    'Perhitunganmu benar.',
                    'Nilai <em>P(3)</em> dihitung sebagai <em>3<sup>3</sup> − 4(3) + 8 = 27 − 12 + 8 = 23</em>. Jadi hasil substitusi polinomial pada <em>x = 3</em> adalah <strong>23</strong>.'
                );
                bukaStep(4);
            } else {
                tampilkanSalah(
                    'feedbackStep3',
                    'penjelasanStep3',
                    'Jawaban masih salah. Berikut jawaban yang benar.',
                    'Perhitungannya adalah:<br><br><em>P(3) = 3<sup>3</sup> − 4(3) + 8 = 27 − 12 + 8 = 23</em><br><br>Jadi jawaban yang benar adalah <strong>23</strong>.'
                );
            }
        }

        function cekStep4() {
            const input = document.getElementById('jawabStep4');
            if (!input) return;

            const jawaban = normalisasiInput(input.value);

            if (jawaban === '23') {
                tampilkanBenar(
                    'feedbackStep4',
                    'penjelasanStep4',
                    'Kesimpulanmu benar.',
                    'Karena Teorema Sisa menyatakan bahwa sisa pembagian oleh <em>(x − c)</em> adalah <em>P(c)</em>, dan tadi diperoleh <strong>P(3) = 23</strong>, maka <strong>sisa pembagiannya adalah 23</strong>.'
                );

                const akhir = document.getElementById('penjelasanLengkapAkhir');
                if (akhir) akhir.style.display = 'block';
            } else {
                tampilkanSalah(
                    'feedbackStep4',
                    'penjelasanStep4',
                    'Jawaban masih salah. Berikut jawaban yang benar.',
                    'Menurut Teorema Sisa, sisa pembagian oleh <em>(x − c)</em> adalah <strong>P(c)</strong>. Karena pada soal ini <strong>c = 3</strong> dan <strong>P(3) = 23</strong>, maka jawaban yang benar adalah <strong>23</strong>.'
                );
            }
        }

        function unlockCardStep(id) {
            const el = document.getElementById(id);
            if (el) {
                el.classList.remove('locked-step');
            }
        }

        function setFeedback(feedbackId, penjelasanId, isBenar, feedbackText, penjelasanText = '') {
            const feedback = document.getElementById(feedbackId);
            const penjelasan = document.getElementById(penjelasanId);

            if (!feedback || !penjelasan) return;

            feedback.className = isBenar ? 'latihan-feedback benar' : 'latihan-feedback salah';
            feedback.innerHTML = feedbackText;

            penjelasan.innerHTML = penjelasanText;
            penjelasan.classList.add('show');
        }

        function tandaiPilihan(button, benar) {
            const parent = button?.parentElement;
            if (!parent) return;

            const allBtns = parent.querySelectorAll('.opsi-btn');
            allBtns.forEach(btn => btn.classList.remove('active-benar', 'active-salah'));

            button.classList.add(benar ? 'active-benar' : 'active-salah');
        }

        function cekPilihanSoal1Step1(button, value) {
            if (value === '3') {
                tandaiPilihan(button, true);
                setFeedback(
                    'soal1Feedback1',
                    'soal1Penjelasan1',
                    true,
                    'Jawaban benar. Nilai c tepat.',
                    'Pembagi <em>(x − 3)</em> sesuai dengan bentuk umum <em>(x − c)</em>, sehingga diperoleh <strong>c = 3</strong>.'
                );
                unlockCardStep('soal1Step2');
            } else {
                tandaiPilihan(button, false);
                setFeedback(
                    'soal1Feedback1',
                    'soal1Penjelasan1',
                    false,
                    'Jawaban masih salah. Berikut jawaban yang benar.',
                    'Gunakan bentuk umum <em>(x − c)</em>. Dari pembagi <em>(x − 3)</em>, terlihat bahwa nilai <strong>c = 3</strong>. Jadi jawaban yang benar adalah <strong>3</strong>.'
                );
            }
        }

        function cekSoal1Step2() {
            const input = document.getElementById('jawabSoal1Step2');
            if (!input) return;

            const jawab = normalizeAnswer(input.value);

            if (jawab === '103') {
                setFeedback(
                    'soal1Feedback2',
                    'soal1Penjelasan2',
                    true,
                    'Jawaban benar. Nilai P(3) tepat.',
                    'Perhitungannya: <em>6(27) - 5(9) + 2(3) - 20 = 162 - 45 + 6 - 20 = 103</em>. Jadi <strong>P(3) = 103</strong>.'
                );
                unlockCardStep('soal1Step3');
            } else {
                setFeedback(
                    'soal1Feedback2',
                    'soal1Penjelasan2',
                    false,
                    'Jawaban masih salah. Berikut jawaban yang benar.',
                    'Hitung bertahap:<br><br><em>P(3) = 6(3<sup>3</sup>) − 5(3<sup>2</sup>) + 2(3) − 20</em><br><em>= 6(27) − 5(9) + 6 − 20</em><br><em>= 162 − 45 + 6 − 20 = 103</em><br><br>Jadi jawaban yang benar adalah <strong>103</strong>.'
                );
            }
        }

        function cekPilihanSoal1Step3(button, value) {
            if (value === '103') {
                tandaiPilihan(button, true);
                setFeedback(
                    'soal1Feedback3',
                    'soal1Penjelasan3',
                    true,
                    'Jawaban benar. Sisa pembagian tepat.',
                    'Karena sisa pembagian oleh <em>(x − 3)</em> adalah <strong>P(3)</strong>, dan tadi didapat <strong>P(3) = 103</strong>, maka sisanya adalah <strong>103</strong>.'
                );

                const finalBox = document.getElementById('soal1FinalBox');
                if (finalBox) finalBox.style.display = 'block';
            } else {
                tandaiPilihan(button, false);
                setFeedback(
                    'soal1Feedback3',
                    'soal1Penjelasan3',
                    false,
                    'Jawaban masih salah. Berikut jawaban yang benar.',
                    'Menurut Teorema Sisa, pembagian oleh <em>(x − 3)</em> memiliki sisa sebesar <strong>P(3)</strong>. Karena <strong>P(3) = 103</strong>, maka jawaban yang benar adalah <strong>103</strong>.'
                );
            }
        }

        function cekPilihanSoal2Step1(button, value) {
            if (value === '1') {
                tandaiPilihan(button, true);
                setFeedback(
                    'soal2Feedback1',
                    'soal2Penjelasan1',
                    true,
                    'Jawaban benar. Nilai c tepat.',
                    'Pembagi <em>(x − 1)</em> berarti sesuai bentuk <em>(x − c)</em>, sehingga <strong>c = 1</strong>.'
                );
                unlockCardStep('soal2Step2');
            } else {
                tandaiPilihan(button, false);
                setFeedback(
                    'soal2Feedback1',
                    'soal2Penjelasan1',
                    false,
                    'Jawaban masih salah. Berikut jawaban yang benar.',
                    'Gunakan bentuk umum <em>(x − c)</em>. Dari pembagi <em>(x − 1)</em>, terlihat bahwa nilai <strong>c = 1</strong>. Jadi jawaban yang benar adalah <strong>1</strong>.'
                );
            }
        }

        function cekPilihanSoal2Step2(button, value) {
            if (value === 'benar') {
                tandaiPilihan(button, true);
                setFeedback(
                    'soal2Feedback2',
                    'soal2Penjelasan2',
                    true,
                    'Jawaban benar. Koefisien lengkap sudah tepat.',
                    'Karena ada suku yang hilang yaitu <em>x<sup>5</sup></em>, <em>x<sup>3</sup></em>, dan <em>x<sup>2</sup></em>, maka koefisien lengkap harus ditulis <strong>2, 0, -3, 0, 0, 7, -5</strong>.'
                );
                unlockCardStep('soal2Step3');
            } else {
                tandaiPilihan(button, false);
                setFeedback(
                    'soal2Feedback2',
                    'soal2Penjelasan2',
                    false,
                    'Jawaban masih salah. Berikut jawaban yang benar.',
                    'Karena polinomial <em>2x<sup>6</sup> − 3x<sup>4</sup> + 7x − 5</em> memiliki suku yang hilang, koefisien lengkapnya harus ditulis berurutan sebagai <strong>2, 0, -3, 0, 0, 7, -5</strong>.'
                );
            }
        }

        function cekHornerSoal2() {
            const jawaban = {
                h1: '2',
                h2: '2',
                h3: '-1',
                h4: '-1',
                h5: '-1',
                h6: '6',
                h7: '2',
                h8: '-1',
                h9: '-1',
                h10: '-1',
                h11: '6',
                h12: '1'
            };

            let benarSemua = true;

            for (let id in jawaban) {
                const input = document.getElementById(id);
                if (!input) continue;

                const nilai = input.value.trim().replace(/−/g, '-');

                if (nilai === jawaban[id]) {
                    input.style.borderColor = '#53a653';
                    input.style.backgroundColor = '#eef8ea';
                } else {
                    input.style.borderColor = '#d96b5f';
                    input.style.backgroundColor = '#fff1ef';
                    benarSemua = false;
                }
            }

            const feedback = document.getElementById('feedbackHorner2');
            const finalBox = document.getElementById('soal2FinalBox');

            if (!feedback) return;

            if (benarSemua) {
                feedback.className = 'latihan-feedback benar';
                feedback.innerHTML = 'Jawaban benar. Tabel Horner sudah lengkap dan tepat.';
                if (finalBox) finalBox.style.display = 'block';
            } else {
                feedback.className = 'latihan-feedback salah';
                feedback.innerHTML = 'Masih ada isian yang salah. Berikut jawaban yang benar: baris tengah = 2, 2, -1, -1, -1, 6 dan baris bawah = 2, -1, -1, -1, 6, 1.';
                if (finalBox) finalBox.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            pasangAutoCheckEksplorasi();
            cekEksplorasi1Otomatis();
            cekEksplorasi2Otomatis();
            bukaMateriLanjutanJikaSiap();
        });
    </script>

    <script>
        function bukaMateriLanjutanJikaSiap() {
            const statusBox = document.getElementById('statusEksplorasi');
            const notice = document.getElementById('materiTerkunciNotice');
            const wrapper = document.getElementById('materiLanjutanWrapper');

            if (!wrapper) return;

            if (semuaEksplorasiTerisi()) {
                if (statusBox) {
                    statusBox.classList.add('complete');
                    statusBox.innerHTML = 'Semua soal eksplorasi sudah terisi. Materi lanjutan telah dibuka kembali.';
                }

                if (notice) {
                    notice.style.display = 'none';
                }

                wrapper.classList.add('show');
                materiEksplorasiSudahTerbuka = true;
            } else {
                if (statusBox) {
                    statusBox.classList.remove('complete');
                    statusBox.innerHTML = 'Isi semua jawaban pada Aktivitas 1 dan Aktivitas 2 terlebih dahulu. Setelah semua terisi, materi selanjutnya akan terbuka otomatis.';
                }

                if (notice) {
                    notice.style.display = 'block';
                }

                wrapper.classList.remove('show');
                materiEksplorasiSudahTerbuka = false;
            }
        }

        function cekSemuaStep() {
            const s1 = normalisasiInput(document.getElementById('jawabStep1').value);
            const s2 = normalisasiInput(document.getElementById('jawabStep2').value);
            const s3 = normalisasiInput(document.getElementById('jawabStep3').value);
            const s4 = normalisasiInput(document.getElementById('jawabStep4').value);

            const feedback = document.getElementById('feedbackAkhir');

            const benar =
                s1 === '3' &&
                (s2 === 'p(3)' || s2 === 'p3') &&
                s3 === '23' &&
                s4 === '23';

            if (benar) {
                feedback.className = 'latihan-feedback benar';
                feedback.innerHTML = 'Semua jawaban benar! 🎉';

                // tampilkan penjelasan per langkah
                showPenjelasan();

            } else {
                feedback.className = 'latihan-feedback salah';
                feedback.innerHTML = 'Masih ada jawaban yang salah. Coba lagi ya 👀';
            }
        }

        function showPenjelasan() {

            setPenjelasan('penjelasanStep1',
                'Pembagi (x − 3) dibandingkan dengan (x − c), sehingga diperoleh <strong>c = 3</strong>.');

            setPenjelasan('penjelasanStep2',
                'Menurut Teorema Sisa, sisa pembagian dihitung dengan <strong>P(c)</strong>. Karena c = 3, maka menjadi <strong>P(3)</strong>.');

            setPenjelasan('penjelasanStep3',
                'P(3) = 3³ − 4(3) + 8 = 27 − 12 + 8 = <strong>23</strong>.');

            setPenjelasan('penjelasanStep4',
                'Sisa pembagian = P(3) = <strong>23</strong>.');
        }

        function setPenjelasan(id, isi) {
            const el = document.getElementById(id);
            if (el) {
                el.innerHTML = isi;
                el.classList.add('show');
            }
        }
    </script>
@endsection

@section('nav')
    <a href="{{ route('metodehorner') }}" class="btn-nav prev-btn">
        ← Previous
    </a>

    <a href="{{ route('kuisc') }}" class="btn-nav next-btn">
        Next →
    </a>
@endsection