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
            margin-top: 20px;
            background: linear-gradient(180deg, #fffdf9 0%, #f9f5ef 100%);
            border: 1.5px solid #d8cbb9;
            border-radius: 22px;
            padding: 18px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.04);
        }

        .konsep-menu {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 18px;
        }

        .konsep-btn {
            border: 1.5px solid #ccbca8;
            background: #f4efe8;
            color: #4b4138;
            border-radius: 16px;
            padding: 14px 18px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 700;
            font-family: Georgia, 'Times New Roman', serif;
            transition: all 0.3s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
        }

        .konsep-btn:hover {
            background: #edf6ea;
            color: #2f7d32;
            border-color: #8dbb8f;
            transform: translateY(-2px);
        }

        .konsep-btn.active {
            background: linear-gradient(135deg, #2f7d32 0%, #3d9441 100%);
            color: #ffffff;
            border-color: #2f7d32;
            box-shadow: 0 8px 18px rgba(47, 125, 50, 0.18);
        }

        .konsep-content {
            position: relative;
        }

        .konsep-box {
            display: none;
            background: #fffdfa;
            border: 2px solid #8dbb8f;
            border-radius: 20px;
            padding: 22px 22px 20px 22px;
            font-size: 15.8px;
            line-height: 1.85;
            color: #4b4138;
            animation: fadeSlide 0.3s ease;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.04);
        }

        .konsep-box.show {
            display: block;
        }

        .konsep-box h3 {
            font-size: 17px;
            margin: 0 0 14px 0;
            color: #2f7d32;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .konsep-box p {
            margin: 0 0 14px 0;
        }

        .konsep-box ul {
            margin: 8px 0 0 20px;
            padding-left: 10px;
        }

        .konsep-box ul li {
            margin-bottom: 10px;
        }

        .rumus {
            margin: 18px auto 12px auto;
            background: #eef7ea;
            border: 1.5px solid #b7d7b9;
            border-radius: 16px;
            padding: 14px 18px;
            text-align: center;
            font-size: 20px;
            color: #1f5c24;
            font-weight: 700;
            width: fit-content;
            min-width: 280px;
            max-width: 100%;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.8);
        }

        .konsep-box strong {
            color: #2b5f2d;
        }

        .konsep-box em {
            font-style: normal !important;
            font-weight: 600;
        }

        .konsep-box p[style*="text-align:center"] {
            margin-top: 8px;
            font-size: 16px;
            font-weight: 600;
            color: #4b4138;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .konsep-container {
                padding: 14px;
                border-radius: 18px;
            }

            .konsep-menu {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .konsep-btn {
                width: 100%;
                font-size: 15px;
                padding: 12px 14px;
            }

            .konsep-box {
                padding: 16px;
                font-size: 14.8px;
                line-height: 1.75;
                border-radius: 16px;
            }

            .konsep-box h3 {
                font-size: 16px;
            }

            .rumus {
                width: 100%;
                min-width: 0;
                font-size: 17px;
                line-height: 1.7;
                overflow-x: auto;
                white-space: nowrap;
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

        /* =========================
                                                                                                                                       RESPONSIVE GLOBAL
                                                                                                                                       HP - TABLET - LAPTOP
                                                                                                                                    ========================= */

        * {
            box-sizing: border-box;
        }

        .materi-content {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
        }

        /* Supaya gambar/tabel/input tidak keluar layar */
        table,
        input,
        button {
            max-width: 100%;
        }

        .eksplorasi-table-wrap,
        .tabel-interaktif-wrapper,
        .horner-card,
        .horner-card-latihan {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* =========================
                                                                                                                                       LAPTOP / DESKTOP
                                                                                                                                       min-width: 1025px
                                                                                                                                    ========================= */

        @media (min-width: 1025px) {
            .materi-content {
                padding: 16px 24px;
            }

            .judul-materi {
                font-size: 24px;
            }

            .paragraf-materi,
            .teks-biasa,
            .contoh-text,
            .sifat-text,
            .keterangan-luar {
                font-size: 16px;
            }

            .latihan-card-modern,
            .contoh-wrapper,
            .pembuktian-card,
            .sifat-wrapper,
            .definisi-wrapper {
                padding-left: 28px;
                padding-right: 28px;
            }
        }

        /* =========================
                                                                                                                                       TABLET
                                                                                                                                       769px - 1024px
                                                                                                                                    ========================= */

        @media (min-width: 769px) and (max-width: 1024px) {
            .materi-content {
                padding: 14px 18px;
            }

            .judul-materi {
                font-size: 22px;
            }

            .paragraf-materi,
            .eksplorasi-text,
            .teks-biasa,
            .contoh-text,
            .sifat-text,
            .keterangan-luar,
            .daftar-langkah li {
                font-size: 15.5px;
                line-height: 1.85;
            }

            .konsep-menu {
                flex-wrap: wrap;
            }

            .konsep-btn {
                flex: 1 1 48%;
            }

            .latihan-header {
                padding-right: 0;
            }

            .pilihan-jawaban-wrap,
            .pilihan-jawaban-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
            }

            .opsi-btn {
                width: 100%;
            }

            .latihan-input-fancy-wrap {
                display: grid;
                grid-template-columns: 120px 1fr auto;
                align-items: center;
            }

            .tabel-interaktif {
                min-width: 680px;
            }

            .horner-figure {
                min-width: 720px;
            }
        }

        /* =========================
                                                                                                                                       HP / MOBILE
                                                                                                                                       max-width: 768px
                                                                                                                                    ========================= */

        @media (max-width: 768px) {
            .materi-content {
                padding: 10px 10px 0 10px;
            }

            .judul-materi {
                font-size: 20px;
                line-height: 1.4;
            }

            .paragraf-materi,
            .eksplorasi-text,
            .teks-biasa,
            .contoh-text,
            .sifat-text,
            .keterangan-luar,
            .daftar-langkah li,
            .latihan-card-subtitle {
                font-size: 14.5px;
                line-height: 1.75;
                text-align: left;
            }

            .eksplorasi-box,
            .eksplorasi-step-card,
            .latihan-step-card,
            .latihan-step-card-modern,
            .sifat-wrapper,
            .pembuktian-card,
            .contoh-wrapper,
            .latihan-card-modern,
            .penjelasan-akhir-box,
            .definisi-wrapper {
                border-radius: 16px;
                padding-left: 14px;
                padding-right: 14px;
            }

            .eksplorasi-box {
                padding: 14px;
            }

            .label-definisi,
            .label-sifat,
            .label-pembuktian,
            .label-contoh {
                left: 14px;
                font-size: 13px;
                padding: 8px 18px;
            }

            .latihan-badge {
                position: static;
                display: inline-block;
                margin-bottom: 12px;
                font-size: 13px;
                padding: 9px 18px;
            }

            .latihan-header {
                padding-right: 0;
            }

            .latihan-card-title {
                font-size: 19px;
            }

            .rumus-tengah,
            .langkah-rumus,
            .rumus-soal,
            .eksplorasi-rumus,
            .rumus-penjelasan,
            .mini-rumus-box {
                font-size: 15px;
                line-height: 1.8;
                overflow-x: auto;
                white-space: nowrap;
                padding-bottom: 4px;
            }

            .hitung-box {
                padding: 12px;
                overflow-x: auto;
            }

            .hitung-line {
                font-size: 14px;
                line-height: 1.8;
                white-space: nowrap;
            }

            .konsep-menu {
                display: block;
            }

            .konsep-btn {
                width: 100%;
                margin-bottom: 8px;
            }

            .eksplorasi-input-block,
            .latihan-input-wrap,
            .latihan-input-fancy-wrap {
                display: block;
            }

            .eksplorasi-label,
            .input-label-mini {
                display: block;
                width: 100%;
                margin-bottom: 8px;
            }

            .latihan-input,
            .latihan-input-fancy,
            .eksplorasi-mini-input,
            .cek-btn-fancy {
                width: 100%;
                min-width: 0;
            }

            .latihan-input-fancy {
                margin: 8px 0 10px 0;
            }

            .pilihan-jawaban-wrap,
            .pilihan-jawaban-grid {
                display: block;
            }

            .opsi-btn,
            .langkah-click-btn {
                width: 100%;
                display: block;
                text-align: left;
                margin: 8px 0;
            }

            .eksplorasi-table {
                min-width: 520px;
            }

            .tabel-interaktif {
                min-width: 620px;
            }

            .tabel-interaktif th,
            .tabel-interaktif td,
            .eksplorasi-table th,
            .eksplorasi-table td {
                font-size: 13.5px;
                padding: 10px 8px;
            }

            .btn-pembagi {
                font-size: 14px;
            }

            .horner-card {
                align-items: flex-start;
            }

            .horner-table {
                min-width: 520px;
            }

            .horner-cell-btn {
                min-width: 46px;
                height: 40px;
                font-size: 13.5px;
                padding: 0 6px;
            }

            .horner-c {
                min-width: 36px;
                width: 36px;
            }

            .horner-figure {
                min-width: 640px;
            }

            .horner-box,
            .horner-input {
                width: 58px;
                min-width: 58px;
                height: 48px;
                font-size: 15px;
            }

            .horner-row {
                gap: 10px;
            }

            .horner-plus-mark {
                width: 34px;
                min-width: 34px;
                font-size: 30px;
            }

            .horner-left-side {
                width: 50px;
                min-width: 50px;
            }

            .horner-left-c {
                font-size: 17px;
            }

            .penjelasan-pembagi-box,
            .horner-info,
            .latihan-penjelasan,
            .eksplorasi-status-box {
                font-size: 14px;
                line-height: 1.7;
            }
        }

        /* =========================
                                                                                                                                       HP KECIL
                                                                                                                                       max-width: 480px
                                                                                                                                    ========================= */

        @media (max-width: 480px) {
            .materi-content {
                padding: 8px 6px 0 6px;
            }

            .judul-materi {
                font-size: 18px;
            }

            .paragraf-materi,
            .eksplorasi-text,
            .teks-biasa,
            .contoh-text,
            .sifat-text,
            .keterangan-luar,
            .latihan-card-subtitle {
                font-size: 14px;
                line-height: 1.7;
            }

            .eksplorasi-box,
            .eksplorasi-step-card,
            .latihan-step-card,
            .latihan-step-card-modern,
            .sifat-wrapper,
            .pembuktian-card,
            .contoh-wrapper,
            .latihan-card-modern,
            .penjelasan-akhir-box,
            .definisi-wrapper {
                padding-left: 12px;
                padding-right: 12px;
            }

            .latihan-card-title {
                font-size: 18px;
            }

            .judul-eksplorasi,
            .eksplorasi-step-title,
            .latihan-step-title,
            .latihan-step-modern-title,
            .latihan-item-title {
                font-size: 15px;
            }

            .rumus-tengah,
            .langkah-rumus,
            .rumus-soal,
            .eksplorasi-rumus,
            .mini-rumus-box {
                font-size: 14px;
            }

            .hitung-line {
                font-size: 13.5px;
            }

            .opsi-btn,
            .cek-btn-fancy,
            .latihan-input,
            .latihan-input-fancy,
            .eksplorasi-mini-input {
                font-size: 14px;
                padding: 10px 12px;
            }

            .tabel-interaktif {
                min-width: 560px;
            }

            .eksplorasi-table {
                min-width: 480px;
            }

            .horner-table {
                min-width: 480px;
            }

            .horner-figure {
                min-width: 590px;
            }

            .horner-box,
            .horner-input {
                width: 52px;
                min-width: 52px;
                height: 44px;
                font-size: 14px;
            }

            .horner-row {
                gap: 8px;
            }
        }

        /* =========================
                                                                                                                                   RESPONSIVE KHUSUS TABEL HORNER
                                                                                                                                ========================= */

        .horner-card,
        .horner-card-latihan {
            width: 100%;
            max-width: 100%;
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
        }

        /* Tabel Horner contoh */
        .horner-table {
            width: max-content;
            min-width: 560px;
            border-collapse: collapse;
            margin: 0 auto;
        }

        /* Supaya isi tabel tidak gepeng */
        .horner-table td {
            white-space: nowrap;
        }

        /* Tombol angka Horner */
        .horner-cell-btn {
            min-width: 54px;
            height: 42px;
            font-size: 14.5px;
        }

        /* Tabel Horner latihan yang pakai div */
        .horner-figure {
            width: max-content;
            min-width: 760px;
        }

        /* Laptop */
        @media (min-width: 1025px) {

            .horner-card,
            .horner-card-latihan {
                justify-content: center;
            }

            .horner-table {
                min-width: 560px;
            }

            .horner-figure {
                min-width: 760px;
            }
        }

        /* Tablet */
        @media (max-width: 1024px) {

            .horner-card,
            .horner-card-latihan {
                align-items: flex-start;
            }

            .horner-table {
                min-width: 540px;
            }

            .horner-figure {
                min-width: 700px;
            }

            .horner-cell-btn {
                min-width: 48px;
                height: 40px;
                font-size: 14px;
            }

            .horner-box,
            .horner-input {
                width: 64px;
                min-width: 64px;
                height: 48px;
                font-size: 15px;
            }

            .horner-row {
                gap: 10px;
            }
        }

        /* HP */
        @media (max-width: 768px) {

            .horner-card,
            .horner-card-latihan {
                padding: 14px 12px;
                border-radius: 14px;
            }

            .horner-title {
                font-size: 14px;
                position: sticky;
                left: 0;
                background: #fbfbfb;
                z-index: 2;
                padding-bottom: 6px;
            }

            .horner-table {
                min-width: 500px;
                margin: 0;
            }

            .horner-table td {
                padding: 6px;
            }

            .horner-cell-btn {
                min-width: 44px;
                height: 38px;
                font-size: 13px;
                border-radius: 10px;
            }

            .horner-c {
                width: 34px;
                min-width: 34px;
                font-size: 14px;
                padding-right: 6px;
            }

            .horner-plus-cell {
                width: 28px;
                min-width: 28px;
                font-size: 22px;
            }

            .horner-empty {
                min-width: 44px;
                height: 38px;
            }

            .horner-info {
                position: sticky;
                left: 0;
                width: calc(100vw - 56px);
                min-width: 260px;
                font-size: 14px;
                line-height: 1.7;
            }

            .horner-figure {
                min-width: 620px;
            }

            .horner-left-side {
                width: 46px;
                min-width: 46px;
            }

            .horner-left-c {
                font-size: 16px;
            }

            .horner-box,
            .horner-input {
                width: 52px;
                min-width: 52px;
                height: 42px;
                font-size: 14px;
                border-radius: 12px;
            }

            .horner-row {
                gap: 8px;
            }

            .horner-plus-mark {
                width: 30px;
                min-width: 30px;
                font-size: 28px;
                margin-left: 2px;
            }
        }

        /* HP kecil */
        @media (max-width: 480px) {

            .horner-card,
            .horner-card-latihan {
                padding: 12px 10px;
            }

            .horner-table {
                min-width: 460px;
            }

            .horner-cell-btn {
                min-width: 40px;
                height: 36px;
                font-size: 12.5px;
                padding: 0 5px;
            }

            .horner-c {
                width: 30px;
                min-width: 30px;
            }

            .horner-plus-cell {
                width: 24px;
                min-width: 24px;
                font-size: 20px;
            }

            .horner-empty {
                min-width: 40px;
                height: 36px;
            }

            .horner-info {
                width: calc(100vw - 48px);
                font-size: 13.5px;
            }

            .horner-figure {
                min-width: 560px;
            }

            .horner-left-side {
                width: 42px;
                min-width: 42px;
            }

            .horner-box,
            .horner-input {
                width: 48px;
                min-width: 48px;
                height: 40px;
                font-size: 13.5px;
            }

            .horner-row {
                gap: 6px;
            }

            .horner-plus-mark {
                width: 26px;
                min-width: 26px;
                font-size: 24px;
            }
        }

        /* SUPAYA RUMUS TIDAK MIRING */
        .materi-content em,
        .materi-content i {
            font-style: normal !important;
        }

        .cek-eksplorasi-wrap {
            text-align: left;
            margin-top: 18px;
        }

        .latihan-input.input-benar,
        .eksplorasi-mini-input.input-benar {
            border-color: #53a653 !important;
            background: #eef8ea !important;
        }

        .latihan-input.input-salah,
        .eksplorasi-mini-input.input-salah {
            border-color: #d96b5f !important;
            background: #fff1ef !important;
        }

        .angka-nol {
            font-family: Arial, sans-serif;
            font-weight: 700;
        }

        .proses-horner-box {
            margin-top: 18px;
            background: #fffaf4;
            border: 1.5px solid #e4d8ca;
            border-radius: 18px;
            padding: 18px 18px;
        }

        .proses-horner-list {
            margin-top: 12px;
        }

        .proses-horner-item {
            background: #f8f3eb;
            border-left: 5px solid #e18a2d;
            border-radius: 12px;
            padding: 12px 14px;
            margin-bottom: 10px;
            font-size: 15.5px;
            line-height: 1.85;
            color: #4b4138;
            text-align: justify;
        }

        .proses-horner-item span {
            display: inline-block;
            margin-top: 4px;
            color: #1f5c24;
        }

        @media (max-width: 768px) {
            .proses-horner-box {
                padding: 14px 14px;
                border-radius: 16px;
            }

            .proses-horner-item {
                font-size: 14px;
                line-height: 1.75;
                padding: 11px 12px;
            }
        }

        .hint-btn {
            border: none;
            background: #e18a2d;
            color: #fff;
            border-radius: 12px;
            padding: 9px 16px;
            font-size: 14px;
            font-family: Georgia, 'Times New Roman', serif;
            font-weight: 700;
            cursor: pointer;
            margin: 8px 0 10px 0;
            transition: 0.25s ease;
        }

        .hint-btn:hover {
            background: #c87420;
        }

        .hint-box {
            display: none;
            margin: 8px 0 12px 0;
            background: #fff7ed;
            border-left: 5px solid #e18a2d;
            border-radius: 14px;
            padding: 12px 15px;
            font-size: 15px;
            line-height: 1.8;
            color: #4b4138;
            text-align: justify;
        }

        .hint-box.show {
            display: block;
            animation: fadeSlide 0.25s ease;
        }

        @media (max-width: 768px) {
            .hint-btn {
                width: 100%;
                text-align: center;
                font-size: 14px;
            }

            .hint-box {
                font-size: 14px;
                line-height: 1.7;
            }
        }

        .petunjuk-latihan-box {
            margin: 14px 0 20px 0;
            padding: 16px 18px;
            background: #f8fff5;
            border-left: 6px solid #8dbb8f;
            border-radius: 16px;
            color: #4b4138;
            font-size: 15.5px;
            line-height: 1.85;
        }

        .petunjuk-latihan-box p {
            margin: 0 0 8px 0;
            text-align: justify;
        }

        .petunjuk-latihan-box p:last-child {
            margin-bottom: 0;
        }

        .petunjuk-latihan-box strong {
            color: #2f7d32;
            font-weight: 700;
        }

        @media (max-width: 768px) {
            .petunjuk-latihan-box {
                font-size: 14.2px;
                line-height: 1.75;
                padding: 14px 15px;
                border-radius: 14px;
            }

            .petunjuk-latihan-box p {
                text-align: left;
            }
        }

        .persamaan-satu-baris {
            display: inline-block;
            max-width: 100%;
            white-space: nowrap;
            overflow-x: auto;
            vertical-align: middle;
        }

        .langkah-rumus {
            white-space: nowrap;
            overflow-x: auto;
        }

        .latihan-input.benar {
            border: 2px solid #16a34a !important;
            background-color: #f0fdf4 !important;
            color: #166534;
        }

        .latihan-input.salah {
            border: 2px solid #dc2626 !important;
            background-color: #fef2f2 !important;
            color: #991b1b;
        }

        .latihan-penjelasan.benar {
            margin-top: 8px;
            color: #166534;
            font-weight: 600;
        }

        .latihan-penjelasan.salah {
            margin-top: 8px;
            color: #dc2626;
            font-weight: 600;
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
                Perhatikan bentuk polinomial berikut:
            </p>

            <div class="eksplorasi-rumus">
                <em>P(x) = x<sup>2</sup> − 2x + 3</em>
            </div>

            <p class="eksplorasi-text">
                Untuk memahami hubungan antara nilai polinomial dan sisa pembagian,
                lakukan aktivitas berikut.
            </p>

            <!-- Aktivitas 1 -->
            <div class="eksplorasi-step-card" id="eksplorasiCard1">
                <div class="eksplorasi-step-title">Aktivitas 1 — Menghitung Nilai</div>

                <p class="eksplorasi-text">
                    Substitusikan nilai <em>x</em> ke dalam polinomial.
                </p>

                <div class="eksplorasi-input-block">
                    <label class="eksplorasi-label"><em>P(1)</em> = </label>
                    <input type="text" id="eksplorasiP1" class="latihan-input" placeholder="Jawaban kamu">
                </div>

                <div class="eksplorasi-input-block">
                    <label class="eksplorasi-label"><em>P(3)</em> = </label>
                    <input type="text" id="eksplorasiP3" class="latihan-input" placeholder="Jawaban kamu">
                </div>

                <div id="eksplorasiFeedback1" class="latihan-feedback"></div>
                <div id="eksplorasiPenjelasan1" class="latihan-penjelasan"></div>
            </div>

            <!-- Aktivitas 2 -->
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
                    Gunakan hasil dari Aktivitas 1 untuk memperkirakan sisa pembagian.
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
                                <td><em>(x − 1)</em></td>
                                <td><em>P(1)</em></td>
                                <td>
                                    <input type="text" id="dugaanSisa1" class="eksplorasi-mini-input" placeholder="Isi">
                                </td>
                            </tr>
                            <tr>
                                <td><em>(x − 3)</em></td>
                                <td><em>P(3)</em></td>
                                <td>
                                    <input type="text" id="dugaanSisa2" class="eksplorasi-mini-input" placeholder="Isi">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div id="eksplorasiFeedback2" class="latihan-feedback"></div>
                <div id="eksplorasiPenjelasan2" class="latihan-penjelasan"></div>
            </div>

            <!-- Tombol Cek Semua Eksplorasi -->
            <div class="cek-eksplorasi-wrap">
                <button type="button" class="cek-btn-fancy" onclick="cekSemuaEksplorasi()">
                    Cek Semua
                </button>
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
                        Jika <em>P(c) = <span class="angka-nol">0</span></em>, maka <em>(x − c)</em> adalah faktor dari
                        <em>P(x)</em>.
                    </li>
                    <li>
                        Jika <em>P(c) ≠ <span class="angka-nol">0</span></em>, maka nilai tersebut adalah sisa pembagiannya.
                    </li>
                </ol>

                <p class="sifat-text" style="margin-top:12px;">
                    Pernyataan “jika <em>P(c) = <span class="angka-nol">0</span></em>, maka <em>(x − c)</em> adalah faktor
                    dari <em>P(x)</em>”
                    disebut <strong>Teorema Faktor</strong>.
                </p>
            </div>

            <div class="pembuktian-card">
                <div class="label-pembuktian">BENTUK</div>

                <p class="judul-bagian-card">Pembagian polinomial memiliki bentuk:</p>

                <div class="rumus-tengah">
                    <em>P(x) = (x − c)Q(x) + R</em>
                </div>

                <p class="teks-biasa">
                    Karena pembagi <em>(x − c)</em> adalah derajat 1, maka sisanya selalu berupa konstanta,
                    yaitu <em>R</em>.
                </p>

                <p class="subjudul-bukti">Substitusi <em>x = c</em>:</p>

                <!-- Tombol awal -->
                <div class="langkah-click-wrap">
                    <button type="button" id="btnLangkah1" class="langkah-click-btn" onclick="bukaLangkahSubstitusi(1)">
                        Langkah 1
                    </button>

                    <button type="button" class="langkah-click-btn" onclick="cekSemuaLangkahSubstitusi()">
                        Cek Semua
                    </button>
                </div>

                <!-- LANGKAH 1 -->
                <div id="hasilLangkah1" class="langkah-hasil">
                    <div class="langkah-rumus">
                        <em>P(c) = (c − c)Q(c) + R</em>
                    </div>

                    <p class="langkah-penjelasan">
                        Pada langkah pertama, kita hanya mengganti setiap nilai
                        <em>x</em> dengan <em>c</em> pada persamaan umum
                        <span class="persamaan-satu-baris">
                            <em>P(x) = (x − c)Q(x) + R</em>
                        </span>.
                        Setelah disubstitusikan, diperoleh
                        <span class="persamaan-satu-baris">
                            <em>P(c) = (c − c)Q(c) + R</em>
                        </span>.
                        Persamaan ini belum disederhanakan, sehingga prosesnya dilanjutkan pada Langkah 2.
                    </p>

                    <div class="langkah-click-wrap">
                        <button type="button" id="btnLangkah2" class="langkah-click-btn locked"
                            onclick="bukaLangkahSubstitusi(2)">
                            Langkah 2
                        </button>
                    </div>
                </div>

                <!-- LANGKAH 2 -->
                <div id="hasilLangkah2" class="langkah-hasil">
                    <div class="langkah-rumus">
                        <em>P(c) = <span class="angka-nol">0</span> + R</em>
                    </div>

                    <p class="langkah-penjelasan">
                        Karena
                        <span class="persamaan-satu-baris">
                            <em>c − c = <span class="angka-nol">0</span></em>
                        </span>,
                        maka bagian
                        <span class="persamaan-satu-baris">
                            <em>(c − c)Q(c)</em>
                        </span>
                        menjadi
                        <span class="persamaan-satu-baris">
                            <em><span class="angka-nol">0</span> · Q(c)</em>
                        </span>.
                        Akibatnya, persamaan berubah menjadi
                        <span class="persamaan-satu-baris">
                            <em>P(c) = <span class="angka-nol">0</span> + R</em>
                        </span>.
                    </p>

                    <div class="langkah-click-wrap">
                        <button type="button" id="btnLangkah3" class="langkah-click-btn locked"
                            onclick="bukaLangkahSubstitusi(3)">
                            Langkah 3
                        </button>
                    </div>
                </div>

                <!-- LANGKAH 3 -->
                <div id="hasilLangkah3" class="langkah-hasil">
                    <div class="langkah-rumus">
                        <strong><em>P(c) = R</em></strong>
                    </div>

                    <p class="langkah-penjelasan">
                        Karena
                        <span class="persamaan-satu-baris">
                            <em><span class="angka-nol">0</span> + R = R</em>
                        </span>,
                        maka diperoleh bahwa nilai polinomial pada
                        <span class="persamaan-satu-baris">
                            <em>x = c</em>
                        </span>
                        sama dengan sisanya.
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

                    <!-- Proses sebelum Tabel Horner -->
                    <div class="proses-horner-box">
                        <div class="judul-penyelesaian">Proses Metode Horner:</div>

                        <p class="contoh-text">
                            Polinomial yang diberikan adalah:
                        </p>

                        <div class="hitung-box">
                            <div class="hitung-line">
                                <em>P(x) = 5x<sup>5</sup> − 8x<sup>3</sup> + 4x<sup>2</sup> − x + 10</em>
                            </div>
                        </div>

                        <p class="contoh-text">
                            Karena suku <em>x<sup>4</sup></em> tidak ada, maka koefisiennya ditulis sebagai
                            <strong>0</strong>. Jadi koefisien lengkapnya adalah:
                        </p>

                        <div class="hitung-box">
                            <div class="hitung-line">
                                <strong>5, 0, −8, 4, −1, 10</strong>
                            </div>
                        </div>

                        <p class="contoh-text">
                            Karena pembaginya <em>x − 3</em>, maka nilai yang digunakan pada metode Horner adalah
                            <strong>c = 3</strong>.
                        </p>

                        <div class="proses-horner-list">
                            <div class="proses-horner-item">
                                <strong>1.</strong> Turunkan koefisien pertama, yaitu <strong>5</strong>.
                            </div>

                            <div class="proses-horner-item">
                                <strong>2.</strong> Kalikan <strong>3 × 5 = 15</strong>, lalu jumlahkan dengan koefisien
                                berikutnya:
                                <br>
                                <span><strong>0 + 15 = 15</strong></span>
                            </div>

                            <div class="proses-horner-item">
                                <strong>3.</strong> Kalikan <strong>3 × 15 = 45</strong>, lalu jumlahkan:
                                <br>
                                <span><strong>−8 + 45 = 37</strong></span>
                            </div>

                            <div class="proses-horner-item">
                                <strong>4.</strong> Kalikan <strong>3 × 37 = 111</strong>, lalu jumlahkan:
                                <br>
                                <span><strong>4 + 111 = 115</strong></span>
                            </div>

                            <div class="proses-horner-item">
                                <strong>5.</strong> Kalikan <strong>3 × 115 = 345</strong>, lalu jumlahkan:
                                <br>
                                <span><strong>−1 + 345 = 344</strong></span>
                            </div>

                            <div class="proses-horner-item">
                                <strong>6.</strong> Kalikan <strong>3 × 344 = 1032</strong>, lalu jumlahkan:
                                <br>
                                <span><strong>10 + 1032 = 1042</strong></span>
                            </div>
                        </div>

                        <p class="contoh-text" style="margin-top:12px;">
                            Angka terakhir, yaitu <strong>1042</strong>, merupakan sisa pembagian. Jadi, sisa pembagian
                            <em>P(x)</em> oleh <em>x − 3</em> adalah <strong>1042</strong>.
                        </p>
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

            <div class="tabel-interaktif-wrapper">

                <p class="catatan-bawah">
                    Untuk lebih memahami bagaimana Teorema Sisa bekerja dalam berbagai bentuk pembagi,
                    perhatikan tabel berikut. Klik pada bagian <em>pembagi</em> untuk melihat penjelasannya.
                </p>
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
                    Kerjakan soal berikut langkah demi langkah. Jika bingung, klik tombol <strong>Hint</strong> pada
                    setiap langkah, lalu cek jawabanmu di akhir.
                </p>

                <div class="petunjuk-latihan-box">
                    <p>
                        <strong>Petunjuk pengerjaan:</strong>
                        Untuk menulis pangkat, ketik angka setelah variabel, misalnya
                        <strong>x2</strong> untuk x² dan <strong>x3</strong> untuk x³.
                    </p>
                </div>

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

                        <button type="button" class="hint-btn" onclick="toggleHint('hintStep1')">
                            Hint
                        </button>

                        <div id="hintStep1" class="hint-box">
                            Perhatikan bentuk umum pembagi, yaitu <em>(x − c)</em>. Bandingkan <em>(x − 3)</em>
                            dengan <em>(x − c)</em>. Nilai yang menggantikan <em>c</em> adalah angka setelah tanda
                            minus.
                        </div>

                        <div class="latihan-input-wrap">
                            <input type="text" id="jawabStep1" class="latihan-input" placeholder="Jawaban kamu">
                        </div>

                        <div id="penjelasanStep1" class="latihan-penjelasan"></div>
                    </div>

                    <!-- STEP 2 -->
                    <div class="latihan-step-card">
                        <div class="latihan-step-title">Langkah 2 — Bentuk substitusi</div>

                        <p class="contoh-text">
                            Karena sudah dapat nilai c, maka hitunglah bentuk substitusi untuk mencari sisa pembagian.

                        <button type="button" class="hint-btn" onclick="toggleHint('hintStep2')">
                            Hint
                        </button>

                        <div id="hintStep2" class="hint-box">
                            Menurut Teorema Sisa, jika pembagi berbentuk <em>(x − c)</em>, maka sisa pembagian
                            dicari dengan menghitung <em>P(c)</em>. Karena <em>c = 3</em>, bentuk yang dihitung adalah
                            <em>P(3)</em>.
                        </div>

                        <div class="latihan-input-wrap">
                            <input type="text" id="jawabStep2" class="latihan-input" placeholder="Jawaban kamu">
                        </div>

                        <div id="penjelasanStep2" class="latihan-penjelasan"></div>
                    </div>

                    <!-- STEP 3 -->
                    <div class="latihan-step-card">
                        <div class="latihan-step-title">Langkah 3 — Hitung P(3)</div>

                        <p class="contoh-text">
                            Substitusikan <em>x = 3</em> ke dalam <em>P(x) = x<sup>3</sup> − 4x + 8</em>.
                        </p>

                        <button type="button" class="hint-btn" onclick="toggleHint('hintStep3')">
                            Hint
                        </button>

                        <div id="hintStep3" class="hint-box">
                            Ganti setiap <em>x</em> dengan <strong>3</strong>.
                            <br>
                            Bentuknya menjadi:
                            <br>
                            <em>P(3) = 3<sup>3</sup> − 4(3) + 8</em>
                        </div>

                        <div class="latihan-input-wrap">
                            <input type="text" id="jawabStep3" class="latihan-input" placeholder="Jawaban kamu">
                        </div>

                        <div id="penjelasanStep3" class="latihan-penjelasan"></div>
                    </div>

                    <!-- STEP 4 -->
                    <div class="latihan-step-card">
                        <div class="latihan-step-title">Langkah 4 — Sisa pembagian</div>

                        <p class="contoh-text">
                            Tentukan sisa pembagian berdasarkan hasil perhitungan <em>P(3)</em>.
                        </p>

                        <button type="button" class="hint-btn" onclick="toggleHint('hintStep4')">
                            Hint
                        </button>

                        <div id="hintStep4" class="hint-box">
                            Pada Teorema Sisa, sisa pembagian oleh <em>(x − c)</em> sama dengan <em>P(c)</em>.
                            Karena pembaginya <em>(x − 3)</em>, maka sisanya sama dengan hasil dari <em>P(3)</em>.
                        </div>

                        <div class="latihan-input-wrap">
                            <input type="text" id="jawabStep4" class="latihan-input" placeholder="Jawaban kamu">
                        </div>

                        <div id="penjelasanStep4" class="latihan-penjelasan"></div>
                    </div>

                    <!-- CEK -->
                    <div style="text-align:left; margin-top:20px;">
                        <button type="button" class="cek-btn-fancy" onclick="cekSemuaStep()">
                            Cek Jawaban
                        </button>
                    </div>

                    <div id="feedbackAkhir" class="latihan-feedback" style="text-align:left;"></div>
                </div>
            </div>

            <div class="latihan-card-modern">
                <div class="latihan-badge">LATIHAN</div>

                <div class="petunjuk-latihan-box">
                    <p>
                        <strong>Petunjuk pengerjaan:</strong>
                        Kerjakan latihan secara berurutan. Pilih atau isi jawaban sesuai langkah yang tersedia.
                        Soal 2 akan terbuka setelah Soal 1 dijawab dengan benar.
                    </p>

                    <p>
                        Pada bagian isian, tuliskan jawaban secara singkat. Untuk menulis pangkat, ketik angka setelah
                        variabel,
                        misalnya <strong>x2</strong> untuk x² dan <strong>x3</strong> untuk x³.
                        Pada tabel Horner, lengkapi semua kotak kosong terlebih dahulu, lalu klik tombol
                        <strong>Periksa Tabel</strong>. Kuis akan terbuka setelah seluruh latihan selesai dengan benar.
                    </p>
                </div>
                <div class="latihan-item" id="soal1Item">
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

                    <div class="latihan-step-card-modern" id="soal1Step2">
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

                    <div class="latihan-step-card-modern" id="soal1Step3">
                        <div class="latihan-step-modern-title">Langkah 3 — Kesimpulan sisa pembagian</div>
                        <p class="contoh-text">
                            Karena sisa pembagian oleh <em>(x − 3)</em> adalah <em>P(3)</em>,
                            maka sisa pembagiannya adalah ...
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
                            <div class="hitung-line">
                                <em>P(3) = 6(3<sup>3</sup>) − 5(3<sup>2</sup>) + 2(3) − 20</em>
                            </div>
                            <div class="hitung-line"><em>= 6(27) − 5(9) + 6 − 20</em></div>
                            <div class="hitung-line"><em>= 162 − 45 + 6 − 20</em></div>
                            <div class="hitung-line"><strong><em>= 103</em></strong></div>
                        </div>

                        <p class="catatan-bawah">
                            Jadi, sisa pembagian polinomial tersebut adalah <strong>103</strong>.
                        </p>
                    </div>
                </div>

                <div class="latihan-item locked-step" id="soal2Item">
                    <div class="latihan-item-title">Soal 2 — Metode Horner</div>
                    <p class="latihan-card-subtitle">
                        Soal ini terbuka setelah Soal 1 dijawab dengan benar.
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

                    <div class="latihan-step-card-modern" id="soal2Step2">
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

                    <div class="latihan-step-card-modern" id="soal2Step3">
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
                            Angka terakhir pada tabel Horner adalah <strong>1</strong>, sehingga sisa pembagian
                            polinomial
                            tersebut adalah
                            <strong>1</strong>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.completeMateriUrl = "{{ route('materi.complete', $materi->id) }}";
    </script>
    <script>
        let langkahTerbuka = 0;
        let materiEksplorasiSudahTerbuka = false;



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
        let soal1Step1Benar = false;
        let soal1Step2Benar = false;
        let soal1Step3Benar = false;

        let soal2Step1Benar = false;
        let soal2Step2Benar = false;
        let soal2Step3Benar = false;

        function normalisasiInput(text) {
            return (text || '')
                .toString()
                .trim()
                .toLowerCase()
                .replace(/\s+/g, '')
                .replace(/−/g, '-');
        }

        function normalizeAnswer(text) {
            return normalisasiInput(text);
        }

        function normalisasiPangkat(text) {
            return normalisasiInput(text)
                .replace(/³/g, '^3')
                .replace(/²/g, '^2')
                .replace(/¹/g, '^1')
                .replace(/<sup>3<\/sup>/g, '^3')
                .replace(/<sup>2<\/sup>/g, '^2')
                .replace(/<sup>1<\/sup>/g, '^1');
        }

        function jawabanMengandungHasil(text, hasil) {
            const j = normalisasiPangkat(text);
            const h = normalisasiInput(hasil);

            return (
                j === h ||
                j.endsWith('=' + h) ||
                j.includes('=' + h)
            );
        }

        function jawabanStep3Benar(text) {
            const j = normalisasiPangkat(text);

            return (
                jawabanMengandungHasil(text, '23') ||
                j === '3^3-4(3)+8' ||
                j === 'p(3)=3^3-4(3)+8' ||
                j === '3^3-12+8' ||
                j === '27-12+8'
            );
        }

        function jawabanSoal1Step2Benar(text) {
            const j = normalisasiPangkat(text);

            return (
                jawabanMengandungHasil(text, '103') ||
                j === '6(3^3)-5(3^2)+2(3)-20' ||
                j === 'p(3)=6(3^3)-5(3^2)+2(3)-20' ||
                j === '6(27)-5(9)+6-20' ||
                j === '162-45+6-20'
            );
        }

        let eksplorasiSudahDicek = false;

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

            if (!wrapper) return;

            if (eksplorasiSudahDicek && semuaEksplorasiTerisi()) {
                if (statusBox) {
                    statusBox.classList.add('complete');
                    statusBox.innerHTML = `
                                                                                            Semua soal eksplorasi sudah dijawab. Materi lanjutan telah terbuka.
                                                                                            <br>
                                                                                            Jika masih ada jawaban yang salah, perhatikan penjelasan untuk memahami jawabannya.
                                                                                        `;
                }

                if (notice) {
                    notice.style.display = 'none';
                }

                wrapper.classList.add('show');
                materiEksplorasiSudahTerbuka = true;
            } else {
                if (statusBox) {
                    statusBox.classList.remove('complete');
                    statusBox.innerHTML = `
                                                                                            Isi semua jawaban pada Aktivitas 1 dan Aktivitas 2, lalu klik
                                                                                            <strong>Cek Semua Eksplorasi</strong>. Materi lanjutan akan terbuka setelah semua soal terjawab.
                                                                                        `;
                }

                if (notice) {
                    notice.style.display = 'block';
                }

                wrapper.classList.remove('show');
                materiEksplorasiSudahTerbuka = false;
            }
        }

        function tandaiInputEksplorasi(id, benar) {
            const input = document.getElementById(id);
            if (!input) return;

            input.classList.remove('input-benar', 'input-salah');
            input.classList.add(benar ? 'input-benar' : 'input-salah');
        }

        function tampilkanFeedbackEksplorasi(feedbackId, penjelasanId, benar, pesan, penjelasan) {
            const feedback = document.getElementById(feedbackId);
            const penjelasanBox = document.getElementById(penjelasanId);

            if (!feedback || !penjelasanBox) return;

            feedback.className = benar ? 'latihan-feedback benar' : 'latihan-feedback salah';
            feedback.innerHTML = pesan;

            penjelasanBox.innerHTML = penjelasan;
            penjelasanBox.classList.add('show');
        }

        function cekSemuaEksplorasi() {
            eksplorasiSudahDicek = true;

            const p1 = normalisasiInput(document.getElementById('eksplorasiP1')?.value);
            const p3 = normalisasiInput(document.getElementById('eksplorasiP3')?.value);
            const sisa1 = normalisasiInput(document.getElementById('dugaanSisa1')?.value);
            const sisa2 = normalisasiInput(document.getElementById('dugaanSisa2')?.value);

            const statusBox = document.getElementById('statusEksplorasi');

            if (!semuaEksplorasiTerisi()) {
                if (statusBox) {
                    statusBox.classList.remove('complete');
                    statusBox.innerHTML = `
                                                                                            Masih ada jawaban yang kosong. Semua soal eksplorasi harus dijawab terlebih dahulu
                                                                                            sebelum materi lanjutan terbuka.
                                                                                        `;
                }

                bukaMateriLanjutanJikaSiap();
                return;
            }

            const p1Benar = p1 === '2';
            const p3Benar = p3 === '6';
            const sisa1Benar = sisa1 === '2';
            const sisa2Benar = sisa2 === '6';

            tandaiInputEksplorasi('eksplorasiP1', p1Benar);
            tandaiInputEksplorasi('eksplorasiP3', p3Benar);
            tandaiInputEksplorasi('dugaanSisa1', sisa1Benar);
            tandaiInputEksplorasi('dugaanSisa2', sisa2Benar);

            if (p1Benar && p3Benar) {
                tampilkanFeedbackEksplorasi(
                    'eksplorasiFeedback1',
                    'eksplorasiPenjelasan1',
                    true,
                    'Jawaban Aktivitas 1 benar. Nilai P(1) dan P(3) sudah tepat.',
                    `
                                                                                            Untuk polinomial <em>P(x) = x<sup>2</sup> − 2x + 3</em>:
                                                                                            <br><br>
                                                                                            <strong>P(1)</strong> = 1<sup>2</sup> − 2(1) + 3 = 1 − 2 + 3 = <strong>2</strong>
                                                                                            <br>
                                                                                            <strong>P(3)</strong> = 3<sup>2</sup> − 2(3) + 3 = 9 − 6 + 3 = <strong>6</strong>
                                                                                            <br><br>
                                                                                            Jadi, <strong>P(1) = 2</strong> dan <strong>P(3) = 6</strong>.
                                                                                        `
                );
            } else {
                tampilkanFeedbackEksplorasi(
                    'eksplorasiFeedback1',
                    'eksplorasiPenjelasan1',
                    false,
                    'Masih ada jawaban yang salah pada Aktivitas 1. Perhatikan penjelasan berikut.',
                    `
                                                                                            Untuk polinomial <em>P(x) = x<sup>2</sup> − 2x + 3</em>:
                                                                                            <br><br>
                                                                                            <strong>P(1)</strong> = 1<sup>2</sup> − 2(1) + 3 = 1 − 2 + 3 = <strong>2</strong>
                                                                                            <br>
                                                                                            <strong>P(3)</strong> = 3<sup>2</sup> − 2(3) + 3 = 9 − 6 + 3 = <strong>6</strong>
                                                                                            <br><br>
                                                                                            Jadi, jawaban yang benar adalah <strong>P(1) = 2</strong> dan <strong>P(3) = 6</strong>.
                                                                                        `
                );
            }

            if (sisa1Benar && sisa2Benar) {
                tampilkanFeedbackEksplorasi(
                    'eksplorasiFeedback2',
                    'eksplorasiPenjelasan2',
                    true,
                    'Jawaban Aktivitas 2 benar. Dugaan sisamu sudah tepat.',
                    `
                                                                                            Dari Aktivitas 1 diperoleh:
                                                                                            <br><br>
                                                                                            <strong>P(1) = 2</strong> dan <strong>P(3) = 6</strong>.
                                                                                            <br><br>
                                                                                            Maka:
                                                                                            <ul class="eksplorasi-list">
                                                                                                <li>Jika <em>P(x)</em> dibagi dengan <em>(x − 1)</em>, dugaan sisanya adalah <strong>2</strong>.</li>
                                                                                                <li>Jika <em>P(x)</em> dibagi dengan <em>(x − 3)</em>, dugaan sisanya adalah <strong>6</strong>.</li>
                                                                                            </ul>
                                                                                        `
                );
            } else {
                tampilkanFeedbackEksplorasi(
                    'eksplorasiFeedback2',
                    'eksplorasiPenjelasan2',
                    false,
                    'Masih ada jawaban yang salah pada Aktivitas 2. Perhatikan penjelasan berikut.',
                    `
                                                                                            Gunakan hasil dari Aktivitas 1:
                                                                                            <br><br>
                                                                                            <strong>P(1) = 2</strong> dan <strong>P(3) = 6</strong>.
                                                                                            <br><br>
                                                                                            Maka:
                                                                                            <ul class="eksplorasi-list">
                                                                                                <li>Untuk pembagi <em>(x − 1)</em>, dugaan sisa = <strong>2</strong>.</li>
                                                                                                <li>Untuk pembagi <em>(x − 3)</em>, dugaan sisa = <strong>6</strong>.</li>
                                                                                            </ul>
                                                                                        `
                );
            }

            bukaMateriLanjutanJikaSiap();
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
            const hasil = document.getElementById('hasilLangkah' + langkah);

            if (!tombol || !hasil) return;
            if (tombol.classList.contains('locked')) return;

            hasil.classList.add('show');
            tombol.classList.add('active');

            if (langkah > langkahTerbuka) {
                langkahTerbuka = langkah;
            }

            const nextButton = document.getElementById('btnLangkah' + (langkah + 1));

            if (nextButton) {
                nextButton.classList.remove('locked');
            }
        }

        function cekSemuaLangkahSubstitusi() {
            for (let i = 1; i <= 3; i++) {
                const hasil = document.getElementById('hasilLangkah' + i);
                const tombol = document.getElementById('btnLangkah' + i);

                if (hasil) {
                    hasil.classList.add('show');
                }

                if (tombol) {
                    tombol.classList.remove('locked');
                    tombol.classList.add('active');
                }
            }

            langkahTerbuka = 3;
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

        // LATIHAN SOAL

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

            if (jawabanStep3Benar(input.value)) {
                tampilkanBenar(
                    'feedbackStep3',
                    'penjelasanStep3',
                    'Perhitunganmu benar.',
                    'Nilai <em>P(3)</em> dihitung sebagai <em>3<sup>3</sup> − 4(3) + 8 = 27 − 12 + 8 = 23</em>. Jadi hasil substitusi polinomial pada <em>x = 3</em> adalah <strong>23</strong>.'
                );
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

            if (jawabanMengandungHasil(input.value, '23')) {
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

        function setFeedback(feedbackId, penjelasanId, isBenar, feedbackText, penjelasanText = '') {
            const feedback = document.getElementById(feedbackId);
            const penjelasan = document.getElementById(penjelasanId);

            if (!feedback || !penjelasan) return;

            if (isBenar) {
                feedback.className = 'latihan-feedback benar';
                feedback.innerHTML = feedbackText;

                penjelasan.innerHTML = penjelasanText;
                penjelasan.classList.add('show');
            } else {
                feedback.className = 'latihan-feedback salah';
                feedback.innerHTML = 'Jawaban masih salah. Coba periksa kembali langkahmu.';

                penjelasan.innerHTML = 'Perhatikan kembali konsep pada langkah ini, lalu coba pilih atau isi jawaban lagi.';
                penjelasan.classList.add('show');
            }
        }

        function tandaiPilihan(button, benar) {
            const parent = button?.parentElement;
            if (!parent) return;

            const allBtns = parent.querySelectorAll('.opsi-btn');

            allBtns.forEach(btn => {
                btn.classList.remove('active-benar', 'active-salah', 'opsi-benar', 'opsi-salah');
            });

            button.classList.add(benar ? 'active-benar' : 'active-salah');
        }

        function bukaSoal2JikaSoal1Benar() {
            const finalBox = document.getElementById('soal1FinalBox');
            const soal2 = document.getElementById('soal2Item');

            if (soal1Step1Benar && soal1Step2Benar && soal1Step3Benar) {
                if (finalBox) {
                    finalBox.style.display = 'block';
                }

                if (soal2) {
                    soal2.classList.remove('locked-step');
                    soal2.classList.add('unlocked-step');

                    soal2.style.pointerEvents = 'auto';
                    soal2.style.opacity = '1';
                    soal2.style.filter = 'none';

                    soal2.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            } else {
                if (finalBox) {
                    finalBox.style.display = 'none';
                }

                if (soal2) {
                    soal2.classList.add('locked-step');
                    soal2.classList.remove('unlocked-step');
                }
            }
        }

        function cekPilihanSoal1Step1(button, value) {
            if (value === '3') {
                soal1Step1Benar = true;
                tandaiPilihan(button, true);

                setFeedback(
                    'soal1Feedback1',
                    'soal1Penjelasan1',
                    true,
                    'Jawaban benar. Nilai c tepat.',
                    'Pembagi <em>(x − 3)</em> sesuai dengan bentuk umum <em>(x − c)</em>, sehingga diperoleh <strong>c = 3</strong>.'
                );
            } else {
                soal1Step1Benar = false;
                tandaiPilihan(button, false);

                setFeedback(
                    'soal1Feedback1',
                    'soal1Penjelasan1',
                    false,
                    'Jawaban masih salah. Berikut jawaban yang benar.',
                    'Gunakan bentuk umum <em>(x − c)</em>. Dari pembagi <em>(x − 3)</em>, terlihat bahwa nilai <strong>c = 3</strong>. Jadi jawaban yang benar adalah <strong>3</strong>.'
                );
            }

            bukaSoal2JikaSoal1Benar();
        }

        function cekSoal1Step2() {
            const input = document.getElementById('jawabSoal1Step2');
            if (!input) return;

            const jawab = normalisasiInput(input.value);

            if (jawabanSoal1Step2Benar(input.value)) {
                soal1Step2Benar = true;

                input.classList.remove('input-salah');
                input.classList.add('input-benar');

                setFeedback(
                    'soal1Feedback2',
                    'soal1Penjelasan2',
                    true,
                    'Jawaban benar. Nilai P(3) tepat.',
                    'Perhitungannya:<br><br><em>P(3) = 6(3<sup>3</sup>) − 5(3<sup>2</sup>) + 2(3) − 20</em><br><em>= 6(27) − 5(9) + 6 − 20</em><br><em>= 162 − 45 + 6 − 20</em><br><strong>= 103</strong><br><br>Jadi, <strong>P(3) = 103</strong>.'
                );
            } else {
                soal1Step2Benar = false;

                input.classList.remove('input-benar');
                input.classList.add('input-salah');

                setFeedback(
                    'soal1Feedback2',
                    'soal1Penjelasan2',
                    false,
                    'Jawaban masih salah. Berikut jawaban yang benar.',
                    'Hitung bertahap:<br><br><em>P(3) = 6(3<sup>3</sup>) − 5(3<sup>2</sup>) + 2(3) − 20</em><br><em>= 6(27) − 5(9) + 6 − 20</em><br><em>= 162 − 45 + 6 − 20</em><br><strong>= 103</strong><br><br>Jadi jawaban yang benar adalah <strong>103</strong>.'
                );
            }

            bukaSoal2JikaSoal1Benar();
        }

        function cekPilihanSoal1Step3(button, value) {
            if (value === '103') {
                soal1Step3Benar = true;
                tandaiPilihan(button, true);

                setFeedback(
                    'soal1Feedback3',
                    'soal1Penjelasan3',
                    true,
                    'Jawaban benar. Sisa pembagian tepat.',
                    'Karena sisa pembagian oleh <em>(x − 3)</em> adalah <strong>P(3)</strong>, dan tadi didapat <strong>P(3) = 103</strong>, maka sisa pembagiannya adalah <strong>103</strong>.'
                );
            } else {
                soal1Step3Benar = false;
                tandaiPilihan(button, false);

                setFeedback(
                    'soal1Feedback3',
                    'soal1Penjelasan3',
                    false,
                    'Jawaban masih salah. Berikut jawaban yang benar.',
                    'Menurut Teorema Sisa, pembagian oleh <em>(x − 3)</em> memiliki sisa sebesar <strong>P(3)</strong>. Karena <strong>P(3) = 103</strong>, maka jawaban yang benar adalah <strong>103</strong>.'
                );
            }

            bukaSoal2JikaSoal1Benar();
        }

        function cekPilihanSoal2Step1(button, value) {
            if (value === '1') {
                soal2Step1Benar = true;
                tandaiPilihan(button, true);

                setFeedback(
                    'soal2Feedback1',
                    'soal2Penjelasan1',
                    true,
                    'Jawaban benar. Nilai c tepat.',
                    'Pembagi <em>(x − 1)</em> berarti sesuai bentuk <em>(x − c)</em>, sehingga diperoleh <strong>c = 1</strong>.'
                );
            } else {
                soal2Step1Benar = false;
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
                soal2Step2Benar = true;
                tandaiPilihan(button, true);

                setFeedback(
                    'soal2Feedback2',
                    'soal2Penjelasan2',
                    true,
                    'Jawaban benar. Koefisien lengkap sudah tepat.',
                    'Karena ada suku yang hilang yaitu <em>x<sup>5</sup></em>, <em>x<sup>3</sup></em>, dan <em>x<sup>2</sup></em>, maka koefisien lengkap harus ditulis <strong>2, 0, -3, 0, 0, 7, -5</strong>.'
                );
            } else {
                soal2Step2Benar = false;
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

        async function cekHornerSoal2() {
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

                const nilai = normalisasiInput(input.value);

                if (nilai === jawaban[id]) {
                    input.classList.remove('input-salah');
                    input.classList.add('input-benar');
                    input.style.borderColor = '#53a653';
                    input.style.backgroundColor = '#eef8ea';
                } else {
                    input.classList.remove('input-benar');
                    input.classList.add('input-salah');
                    input.style.borderColor = '#d96b5f';
                    input.style.backgroundColor = '#fff1ef';
                    benarSemua = false;
                }
            }

            const feedback = document.getElementById('feedbackHorner2');
            const finalBox = document.getElementById('soal2FinalBox');

            if (!feedback) return;

            soal2Step3Benar = benarSemua;

            if (!soal2Step1Benar || !soal2Step2Benar) {
                feedback.className = 'latihan-feedback salah';
                feedback.innerHTML = 'Langkah 1 dan Langkah 2 Soal 2 harus dijawab benar terlebih dahulu sebelum Kuis terbuka.';

                if (finalBox) {
                    finalBox.style.display = 'none';
                }

                return;
            }

            if (benarSemua) {
                feedback.className = 'latihan-feedback benar';
                feedback.innerHTML = 'Jawaban benar. Tabel Horner sudah lengkap dan tepat. Progress sedang disimpan...';

                if (finalBox) {
                    finalBox.style.display = 'block';
                }

                if (progressSudahDisimpan) {
                    bukaQuizButton();

                    feedback.innerHTML = 'Jawaban benar. Progress sudah tersimpan. Kuis sudah terbuka.';
                    return;
                }

                progressSudahDisimpan = true;

                const berhasilSimpan = await saveProgressMateri();

                if (berhasilSimpan) {
                    bukaQuizButton();

                    feedback.innerHTML = '✅ Jawaban benar. Tabel Horner sudah lengkap dan tepat. Sisa pembagiannya adalah <strong>1</strong>. Progress berhasil disimpan. Kuis sudah terbuka.';
                    feedback.className = 'latihan-feedback benar';
                } else {
                    progressSudahDisimpan = false;

                    feedback.innerHTML = '✅ Jawaban benar, tetapi progress gagal disimpan. Silakan klik cek lagi.';
                    feedback.className = 'latihan-feedback salah';
                }
            }

            else {
                feedback.className = 'latihan-feedback salah';
                feedback.innerHTML = 'Masih ada isian yang salah. Periksa kembali tabel Horner.';

                if (finalBox) {
                    finalBox.style.display = 'none';
                }
            }
        }

        function toggleHint(id) {
            const hint = document.getElementById(id);
            if (!hint) return;

            hint.classList.toggle('show');
        }

        function cekSemuaStep() {
            const s1 = normalisasiInput(document.getElementById('jawabStep1')?.value);
            const s2 = normalisasiInput(document.getElementById('jawabStep2')?.value);
            const s3 = normalisasiInput(document.getElementById('jawabStep3')?.value);
            const s4 = normalisasiInput(document.getElementById('jawabStep4')?.value);

            const feedback = document.getElementById('feedbackAkhir');
            if (!feedback) return;

            const benar =
                s1 === '3' &&
                (s2 === 'p(3)' || s2 === 'p3') &&
                jawabanStep3Benar(document.getElementById('jawabStep3')?.value) &&
                jawabanMengandungHasil(document.getElementById('jawabStep4')?.value, '23');

            if (benar) {
                feedback.className = 'latihan-feedback benar';
                feedback.innerHTML = 'Semua jawaban benar! 🎉';
                showPenjelasan();
            } else {
                feedback.className = 'latihan-feedback salah';
                feedback.innerHTML = 'Masih ada jawaban yang salah. Coba lagi ya 👀';
            }
        }

        function showPenjelasan() {
            setPenjelasan(
                'penjelasanStep1',
                'Pembagi (x − 3) dibandingkan dengan (x − c), sehingga diperoleh <strong>c = 3</strong>.'
            );

            setPenjelasan(
                'penjelasanStep2',
                'Menurut Teorema Sisa, sisa pembagian dihitung dengan <strong>P(c)</strong>. Karena c = 3, maka menjadi <strong>P(3)</strong>.'
            );

            setPenjelasan(
                'penjelasanStep3',
                'P(3) = 3³ − 4(3) + 8 = 27 − 12 + 8 = <strong>23</strong>.'
            );

            setPenjelasan(
                'penjelasanStep4',
                'Sisa pembagian = P(3) = <strong>23</strong>.'
            );
        }

        function setPenjelasan(id, isi) {
            const el = document.getElementById(id);
            if (el) {
                el.innerHTML = isi;
                el.classList.add('show');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            bukaMateriLanjutanJikaSiap();

            const soal2 = document.getElementById('soal2Item');

            if (soal2) {
                soal2.classList.add('locked-step');
                soal2.classList.remove('unlocked-step');
            }

            bukaSoal2JikaSoal1Benar();
        });
    </script>

    <script>
        function toggleHint(id) {
            const hint = document.getElementById(id);
            if (!hint) return;

            hint.style.display = hint.style.display === 'block' ? 'none' : 'block';
        }

        function normalisasiJawaban(value) {
            return (value || '')
                .toLowerCase()
                .trim()
                .replace(/\s+/g, '')
                .replace(/\^/g, '')
                .replace(/³/g, '3')
                .replace(/²/g, '2')
                .replace(/×/g, '*')
                .replace(/−/g, '-');
        }

        function setStatusInput(inputId, penjelasanId, benar, pesan) {
            const input = document.getElementById(inputId);
            const penjelasan = document.getElementById(penjelasanId);

            if (!input || !penjelasan) return;

            input.classList.remove('benar', 'salah');
            penjelasan.classList.remove('benar', 'salah');

            if (benar) {
                input.classList.add('benar');
                penjelasan.classList.add('benar');
                penjelasan.innerHTML = pesan;
            } else {
                input.classList.add('salah');
                penjelasan.classList.add('salah');
                penjelasan.innerHTML = pesan;
            }
        }

        function cekSemuaStep() {
            const feedbackAkhir = document.getElementById('feedbackAkhir');

            const jawab1 = normalisasiJawaban(document.getElementById('jawabStep1')?.value);
            const jawab2 = normalisasiJawaban(document.getElementById('jawabStep2')?.value);
            const jawab3 = normalisasiJawaban(document.getElementById('jawabStep3')?.value);
            const jawab4 = normalisasiJawaban(document.getElementById('jawabStep4')?.value);

            let semuaBenar = true;

            // STEP 1
            const benar1 = jawab1 === '3' || jawab1 === 'c=3';

            if (benar1) {
                setStatusInput(
                    'jawabStep1',
                    'penjelasanStep1',
                    true,
                    'Benar. Karena pembaginya berbentuk <em>(x − 3)</em>, maka nilai <strong>c = 3</strong>.'
                );
            } else {
                semuaBenar = false;
                setStatusInput(
                    'jawabStep1',
                    'penjelasanStep1',
                    false,
                    'Masih salah. Bandingkan pembagi <em>(x − 3)</em> dengan bentuk umum <em>(x − c)</em>. Nilai <strong>c</strong> adalah angka setelah tanda minus.'
                );
            }

            // STEP 2
            const benar2 =
                jawab2 === 'p(3)' ||
                jawab2 === 'p3' ||
                jawab2 === 'p(3)=3';

            if (benar2) {
                setStatusInput(
                    'jawabStep2',
                    'penjelasanStep2',
                    true,
                    'Benar. Menurut Teorema Sisa, jika pembaginya <em>(x − c)</em>, maka yang dihitung adalah <strong>P(c)</strong>. Karena <strong>c = 3</strong>, maka dihitung <strong>P(3)</strong>.'
                );
            } else {
                semuaBenar = false;
                setStatusInput(
                    'jawabStep2',
                    'penjelasanStep2',
                    false,
                    'Masih salah. Karena nilai <strong>c = 3</strong>, maka bentuk substitusi yang harus dihitung adalah <strong>P(3)</strong>.'
                );
            }

            // STEP 3
            const benar3 =
                jawab3 === '23' ||
                jawab3 === 'p(3)=23' ||
                jawab3 === '3^3-4(3)+8=23' ||
                jawab3 === '33-4(3)+8=23' ||
                jawab3 === '27-12+8=23';

            if (benar3) {
                setStatusInput(
                    'jawabStep3',
                    'penjelasanStep3',
                    true,
                    'Benar. <em>P(3) = 3³ − 4(3) + 8 = 27 − 12 + 8 = 23</em>.'
                );
            } else {
                semuaBenar = false;
                setStatusInput(
                    'jawabStep3',
                    'penjelasanStep3',
                    false,
                    'Masih salah. Substitusikan <strong>x = 3</strong> ke fungsi: <em>P(3) = 3³ − 4(3) + 8</em>. Hasil akhirnya adalah <strong>23</strong>.'
                );
            }

            // STEP 4
            const benar4 =
                jawab4 === '23' ||
                jawab4 === 'sisa23' ||
                jawab4 === 'sisa=23' ||
                jawab4 === 'sisanya23' ||
                jawab4 === 'sisanya=23';

            if (benar4) {
                setStatusInput(
                    'jawabStep4',
                    'penjelasanStep4',
                    true,
                    'Benar. Berdasarkan Teorema Sisa, sisa pembagian oleh <em>(x − 3)</em> adalah <strong>P(3) = 23</strong>.'
                );
            } else {
                semuaBenar = false;
                setStatusInput(
                    'jawabStep4',
                    'penjelasanStep4',
                    false,
                    'Masih salah. Sisa pembagian sama dengan hasil <strong>P(3)</strong>. Karena <strong>P(3) = 23</strong>, maka sisanya adalah <strong>23</strong>.'
                );
            }

            if (!feedbackAkhir) return;

            feedbackAkhir.classList.remove('berhasil', 'gagal');

            if (semuaBenar) {
                feedbackAkhir.classList.add('berhasil');
                feedbackAkhir.innerHTML = 'Semua jawaban benar. Kamu sudah memahami penerapan Teorema Sisa pada pembagi <em>(x − 3)</em>.';
            } else {
                feedbackAkhir.classList.add('gagal');
                feedbackAkhir.innerHTML = 'Masih ada jawaban yang belum tepat. Perhatikan bagian yang berwarna merah, lalu perbaiki jawabanmu.';
            }
        }
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