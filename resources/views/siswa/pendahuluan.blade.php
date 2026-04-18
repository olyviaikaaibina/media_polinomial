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

        .klik-info {
            margin-top: 12px;
            font-size: 14px;
            color: #707070;
        }

        .penjelasan-box {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transform: translateY(-10px);
            transition: all 0.5s ease;
        }

        .penjelasan-box.show {
            max-height: 1200px;
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
            grid-template-columns: repeat(3, 1fr);
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

        .opsi-grid-dua {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
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

        .konteks-box {
            margin: 28px 0 10px;
            padding: 26px 22px;
            border-radius: 26px;
            background: linear-gradient(135deg, #f8fff7 0%, #eef8ff 100%);
            border: 1px solid #dbe8d8;
            box-shadow: 0 14px 30px rgba(0, 0, 0, 0.06);
        }

        .konteks-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 999px;
            background: #aebf98;
            color: #fff;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 0.5px;
            margin-bottom: 16px;
        }

        .konteks-title {
            font-size: 24px;
            font-weight: 800;
            color: #2d3a2f;
            margin-bottom: 12px;
            line-height: 1.5;
        }

        .konteks-desc {
            font-size: 15px;
            line-height: 1.9;
            color: #3a3a3a;
            text-align: justify;
            margin-bottom: 22px;
        }

        .lahan-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 24px;
        }

        .lahan-card {
            background: #fff;
            border-radius: 22px;
            padding: 22px 18px;
            text-align: center;
            box-shadow: 0 10px 22px rgba(0, 0, 0, 0.05);
            transition: all 0.35s ease;
            position: relative;
            overflow: hidden;
        }

        .lahan-card:hover {
            transform: translateY(-6px) scale(1.02);
        }

        .lahan-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
        }

        .lahan-card.sawah::before {
            background: linear-gradient(90deg, #7cb342, #aed581);
        }

        .lahan-card.kebun::before {
            background: linear-gradient(90deg, #ffb300, #ffd54f);
        }

        .lahan-card.kolam::before {
            background: linear-gradient(90deg, #42a5f5, #90caf9);
        }

        .lahan-icon {
            font-size: 34px;
            margin-bottom: 10px;
        }

        .lahan-name {
            font-size: 18px;
            font-weight: 800;
            color: #2d3a2f;
            margin-bottom: 8px;
        }

        .lahan-form {
            font-size: 30px;
            font-weight: 800;
            color: #22313f;
            margin-bottom: 8px;
        }

        .lahan-info {
            font-size: 14px;
            line-height: 1.7;
            color: #5a5a5a;
        }

        .total-luas-box {
            margin-top: 6px;
            padding: 24px 20px;
            border-radius: 24px;
            background: linear-gradient(135deg, #ffffff 0%, #f6fbff 100%);
            border: 2px dashed #b7cde8;
            text-align: center;
        }

        .total-label {
            font-size: 16px;
            font-weight: 700;
            color: #5a6a72;
            margin-bottom: 12px;
        }

        .total-rumus {
            font-size: 34px;
            font-weight: 800;
            color: #2e4053;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .total-hasil {
            display: inline-block;
            margin-top: 6px;
            padding: 12px 22px;
            border-radius: 18px;
            background: linear-gradient(135deg, #e8f5e9 0%, #f1f8ff 100%);
            border: 1px solid #cfe3d3;
            font-size: 28px;
            font-weight: 800;
            color: #22603a;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.04);
        }

        .total-note {
            margin-top: 14px;
            font-size: 14px;
            color: #666;
            line-height: 1.8;
        }

        .highlight-text {
            color: #1f6f43;
            font-weight: 800;
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

            .unsur-grid,
            .opsi-grid,
            .opsi-grid-dua,
            .isian-wrap,
            .lahan-grid {
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

            .konteks-title {
                font-size: 20px;
            }

            .total-rumus {
                font-size: 24px;
            }

            .total-hasil {
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

    <div class="materi-container">
        <div class="materi-title">APERSEPSI</div>

        <p class="materi-text">
            Kalimantan Selatan dikenal sebagai daerah lahan basah yang dimanfaatkan untuk berbagai
            kegiatan seperti sawah rawa, kebun sayur, dan kolam ikan.
        </p>

        <div class="gambar-box">
            <img src="{{ asset('img/15.png') }}" alt="Gambar sawah, kebun, dan kolam ikan">
        </div>

        <p class="materi-text">
            Setiap jenis lahan memiliki luas yang berbeda dan dapat dinyatakan dalam bentuk matematika
            menggunakan simbol atau variabel. Misalnya, luas suatu lahan dapat dinyatakan dalam bentuk
            2x, 3x², atau bilangan tetap.
        </p>

        <p class="materi-text">
            Bentuk-bentuk tersebut merupakan bagian dari bentuk aljabar yang telah dipelajari sebelumnya.
            Dalam bentuk aljabar, terdapat beberapa unsur penting seperti suku, variabel, koefisien,
            dan konstanta.
        </p>

        <div class="rumus-section">
            <div class="rumus-title">Klik rumus berikut untuk melihat unsur-unsurnya</div>

            <div id="rumusTrigger" class="rumus-trigger">
                x<sup>2</sup> - 4x + 1
            </div>

            <div id="penjelasanBox" class="penjelasan-box">
                <div class="penjelasan-wrapper">
                    <div class="penjelasan-heading">
                        Unsur-unsur pada bentuk aljabar <strong>x<sup>2</sup> - 4x + 1</strong>
                    </div>

                    <div class="unsur-grid">
                        <div class="unsur-card var-card">
                            <div class="unsur-line var-line"></div>
                            <div class="unsur-bubble var-bubble">x<sup>2</sup></div>
                            <div class="unsur-name var-name">Variabel</div>
                            <div class="unsur-desc">
                                Huruf yang mewakili nilai yang dapat berubah, yaitu <strong>x</strong>.
                            </div>
                        </div>

                        <div class="unsur-card koef-card">
                            <div class="unsur-line koef-line"></div>
                            <div class="unsur-bubble koef-bubble">-4</div>
                            <div class="unsur-name koef-name">Koefisien</div>
                            <div class="unsur-desc">
                                Bilangan yang mengalikan variabel pada suku <strong>-4x</strong>.
                            </div>
                        </div>

                        <div class="unsur-card konst-card">
                            <div class="unsur-line konst-line"></div>
                            <div class="unsur-bubble konst-bubble">1</div>
                            <div class="unsur-name konst-name">Konstanta</div>
                            <div class="unsur-desc">
                                Bilangan tetap yang tidak mengandung variabel.
                            </div>
                        </div>
                    </div>

                    <div class="detail-box">
                        <div class="detail-item">
                            <div class="detail-icon icon-var"></div>
                            <div class="detail-text">
                                <strong>Variabel</strong> adalah simbol dalam bentuk aljabar yang nilainya dapat berubah.
                                Pada rumus ini, variabelnya adalah <strong>x</strong>.
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-icon icon-koef"></div>
                            <div class="detail-text">
                                <strong>Koefisien</strong> adalah angka yang berada di depan variabel.
                                Pada suku <strong>-4x</strong>, koefisiennya adalah <strong>-4</strong>.
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-icon icon-konst"></div>
                            <div class="detail-text">
                                <strong>Konstanta</strong> adalah bilangan yang berdiri sendiri tanpa variabel,
                                yaitu <strong>1</strong>.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="latihan-section">
            <div class="question-card" id="questionCard1" data-question="1">
                <div class="question-head">
                    <div class="question-number">1</div>
                    <div class="question-text">Apa yang dimaksud dengan suku, variabel, dan koefisien?</div>
                </div>

                <div class="question-sub">Seret jawaban yang tepat ke kotak yang sesuai.</div>

                <div class="drag-words" id="dragWords">
                    <div class="drag-item" draggable="true" data-answer="suku">
                        Bagian-bagian yang dipisahkan oleh tanda + atau -
                    </div>
                    <div class="drag-item" draggable="true" data-answer="variabel">
                        Simbol atau huruf yang nilainya dapat berubah
                    </div>
                    <div class="drag-item" draggable="true" data-answer="koefisien">
                        Bilangan yang mengalikan variabel
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
                    <div class="question-text">Berapa banyak suku yang terdapat pada bentuk -4x + 1 dan x² − 4x + 1?</div>
                </div>

                <div class="question-sub">Isi jumlah suku dengan benar.</div>

                <div class="isian-wrap">
                    <div class="isian-group">
                        <label class="isian-label">Jumlah suku pada <strong>-4x + 1</strong></label>
                        <input type="text" id="jawab2a" class="isian-input" placeholder="Masukkan jawaban">
                    </div>

                    <div class="isian-group">
                        <label class="isian-label">Jumlah suku pada <strong>x² − 4x + 1</strong></label>
                        <input type="text" id="jawab2b" class="isian-input" placeholder="Masukkan jawaban">
                    </div>
                </div>

                <div id="feedback2" class="feedback"></div>
            </div>

            <div class="question-card" id="questionCard3" data-question="3">
                <div class="question-head">
                    <div class="question-number">3</div>
                    <div class="question-text">Apa perbedaan antara bentuk 4x, x², dan 3x³?</div>
                </div>

                <div class="question-sub">Klik salah satu kotak jawaban yang paling tepat.</div>

                <div class="opsi-grid" id="opsiSoal3">
                    <div class="opsi-card" data-benar="false" data-choice-question="3">
                        <div class="opsi-rumus">4x, x², 3x³</div>
                        <div class="opsi-desc">
                            Ketiganya sama karena semuanya hanya memiliki angka.
                        </div>
                    </div>

                    <div class="opsi-card" data-benar="true" data-choice-question="3">
                        <div class="opsi-rumus">4x, x², 3x³</div>
                        <div class="opsi-desc">
                            Perbedaannya terletak pada pangkat variabel: 4x berpangkat 1, x² berpangkat 2, dan 3x³
                            berpangkat 3.
                        </div>
                    </div>

                    <div class="opsi-card" data-benar="false" data-choice-question="3">
                        <div class="opsi-rumus">4x, x², 3x³</div>
                        <div class="opsi-desc">
                            Ketiganya merupakan konstanta karena semuanya adalah bilangan tetap.
                        </div>
                    </div>
                </div>

                <div id="feedback3" class="feedback"></div>
            </div>
        </div>

        <div class="konteks-box">
            <div class="konteks-badge">KONTEKS NYATA</div>

            <div class="konteks-title">
                Luas lahan petani dapat dinyatakan dalam bentuk aljabar
            </div>

            <div class="konteks-desc">
                Seorang petani di lahan basah mengelola beberapa jenis lahan. Luas sawah dinyatakan
                dalam bentuk <strong>2x</strong>, luas kebun dinyatakan dalam bentuk <strong>3x<sup>2</sup></strong>,
                dan luas kolam ikan dinyatakan dengan bilangan tetap <strong>5</strong>. Untuk mengetahui
                <span class="highlight-text">total luas seluruh lahannya</span>, semua bentuk tersebut dijumlahkan.
            </div>

            <div class="lahan-grid">
                <div class="lahan-card sawah">
                    <div class="lahan-icon">🌾</div>
                    <div class="lahan-name">Sawah Rawa</div>
                    <div class="lahan-form">2x</div>
                    <div class="lahan-info">
                        Menyatakan luas lahan sawah yang bergantung pada nilai <strong>x</strong>.
                    </div>
                </div>

                <div class="lahan-card kebun">
                    <div class="lahan-icon">🥬</div>
                    <div class="lahan-name">Kebun Sayur</div>
                    <div class="lahan-form">3x<sup>2</sup></div>
                    <div class="lahan-info">
                        Menyatakan luas kebun dengan variabel berpangkat dua.
                    </div>
                </div>

                <div class="lahan-card kolam">
                    <div class="lahan-icon">🐟</div>
                    <div class="lahan-name">Kolam Ikan</div>
                    <div class="lahan-form">5</div>
                    <div class="lahan-info">
                        Menyatakan luas tetap karena tidak mengandung variabel.
                    </div>
                </div>
            </div>

            <div class="total-luas-box">
                <div class="total-label">Total luas lahan diperoleh dengan menjumlahkan semua bentuk:</div>
                <div class="total-rumus">
                    2x + 3x<sup>2</sup> + 5
                </div>
                <div class="total-hasil">
                    = 3x<sup>2</sup> + 2x + 5
                </div>
                <div class="total-note">
                    Bentuk <strong>3x<sup>2</sup> + 2x + 5</strong> merupakan bentuk aljabar yang
                    <strong>disusun dari variabel berpangkat tertinggi ke terendah</strong>,
                    yaitu dimulai dari <strong>x<sup>2</sup></strong>, kemudian <strong>x</strong>,
                    dan terakhir <strong>konstanta</strong>.
                </div>
            </div>
        </div>

        <div class="latihan-section">
            <div class="question-card" id="questionCard4" data-question="4">
                <div class="question-head">
                    <div class="question-number">4</div>
                    <div class="question-text">
                        Perhatikan hasil penjumlahan luas lahan: <br>
                        <strong>3x² + 2x + 5</strong>
                    </div>
                </div>

                <div class="question-sub">
                    1. Sebutkan suku-suku yang terdapat pada bentuk tersebut!
                </div>

                <div class="isian-group">
                    <input type="text" id="jawab4a" class="isian-input" placeholder="Contoh: 3x², 2x, 5">
                </div>

                <div class="question-sub" style="margin-top:16px;">
                    2. Banyak suku pada bentuk tersebut adalah
                    <input type="text" id="jawab4b"
                        style="width:80px; text-align:center; margin:0 6px; display:inline-block;" class="isian-input"> suku
                </div>

                <div class="question-sub" style="margin-top:18px;">
                    3. Bentuk tersebut termasuk ke dalam bentuk aljabar atau bukan?
                </div>

                <div class="opsi-grid-dua" id="opsiSoal4">
                    <div class="opsi-card" data-benar="true" data-choice-question="4">
                        <div class="opsi-desc">
                            Termasuk bentuk aljabar
                        </div>
                    </div>

                    <div class="opsi-card" data-benar="false" data-choice-question="4">
                        <div class="opsi-desc">
                            Bukan bentuk aljabar
                        </div>
                    </div>
                </div>

                <div id="feedback4" class="feedback"></div>
            </div>
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
                    3: null,
                    4: null
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
                    if (question === '4') cekSoal4();
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
                            '<span class="explain">Penjelasan: bentuk <strong>-4x + 1</strong> memiliki 2 suku, yaitu <strong>-4x</strong> dan <strong>1</strong>. Bentuk <strong>x² - 4x + 1</strong> memiliki 3 suku, yaitu <strong>x²</strong>, <strong>-4x</strong>, dan <strong>1</strong>.</span>'
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
                            'Benar. Perbedaan utamanya terletak pada pangkat variabel.' +
                            '<span class="explain">Penjelasan: pada <strong>4x</strong> pangkat variabel x adalah 1, pada <strong>x²</strong> pangkatnya 2, dan pada <strong>3x³</strong> pangkatnya 3. Jadi perbedaannya terletak pada derajat/pangkat variabel.</span>'
                        );
                    } else {
                        paksaTampilFeedback(
                            'feedback3',
                            'error',
                            'Jawaban itu belum tepat. Coba perhatikan pangkat pada masing-masing bentuk.'
                        );
                    }
                }

                function cekSoal4() {
                    const a = document.getElementById('jawab4a');
                    const b = document.getElementById('jawab4b');
                    const pilihan = selectedChoices[4];
                    if (!a || !b) return;

                    const valA = normalizeText(a.value);
                    const valB = normalizeText(b.value);

                    const kosongA = valA === '';
                    const kosongB = valB === '';
                    const belumPilih = !pilihan;

                    a.classList.remove('correct', 'wrong');
                    b.classList.remove('correct', 'wrong');

                    document.querySelectorAll('#opsiSoal4 .opsi-card').forEach(card => {
                        card.classList.remove('correct', 'wrong');
                    });

                    if (kosongA && kosongB && belumPilih) {
                        resetFeedback('feedback4');
                        return;
                    }

                    const ada3x2 = valA.includes('3x^2') || valA.includes('3x2');
                    const ada2x = valA.includes('2x');
                    const ada5 = valA.includes('5');

                    const benarA = ada3x2 && ada2x && ada5;
                    const benarB = (valB === '3' || valB === 'tiga');
                    const benarPilihan = pilihan ? pilihan.getAttribute('data-benar') === 'true' : false;

                    if (!kosongA) a.classList.add(benarA ? 'correct' : 'wrong');
                    if (!kosongB) b.classList.add(benarB ? 'correct' : 'wrong');

                    if (pilihan) {
                        pilihan.classList.add(benarPilihan ? 'correct' : 'wrong');
                    }

                    if (!kosongA && !kosongB && pilihan && benarA && benarB && benarPilihan) {
                        paksaTampilFeedback(
                            'feedback4',
                            'success',
                            'Bagus. Semua jawaban pada soal 4 sudah benar.' +
                            '<span class="explain">Penjelasan: bentuk <strong>3x² + 2x + 5</strong> memiliki tiga suku yaitu <strong>3x²</strong>, <strong>2x</strong>, dan <strong>5</strong>. Karena memuat variabel dan konstanta, bentuk ini termasuk <strong>bentuk aljabar</strong>.</span>'
                        );
                    } else {
                        paksaTampilFeedback(
                            'feedback4',
                            'error',
                            'Masih ada jawaban soal 4 yang belum tepat.'
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
                const jawab4a = document.getElementById('jawab4a');
                const jawab4b = document.getElementById('jawab4b');

                if (jawab2a) jawab2a.addEventListener('input', cekSoal2);
                if (jawab2b) jawab2b.addEventListener('input', cekSoal2);
                if (jawab4a) jawab4a.addEventListener('input', cekSoal4);
                if (jawab4b) jawab4b.addEventListener('input', cekSoal4);

                initDragDrop();
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initMateriInteraktif);
            } else {
                initMateriInteraktif();
            }
        })();
    </script>
@endsection

@section('nav')
    <a href="{{ route('petakonsep') }}" class="btn-nav">← Previous</a>
    <a href="{{ route('pengertianpolinomial') }}" class="btn-nav">Next →</a>
@endsection