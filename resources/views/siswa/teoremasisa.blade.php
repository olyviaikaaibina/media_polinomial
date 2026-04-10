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
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
        box-shadow: 0 4px 10px rgba(0,0,0,0.04);
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

    /* SATU CARD GABUNGAN */
    .pembuktian-card {
        position: relative;
        margin-top: 24px;
        background: #ffffff;
        border: 2px solid #8dbb8f;
        border-radius: 22px;
        padding: 34px 28px 22px 28px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.04);
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
        .langkah-rumus {
            font-size: 15.5px;
        }

        .langkah-click-btn {
            display: block;
            width: 100%;
            margin-right: 0;
        }

        .pembuktian-card {
            padding: 34px 18px 18px 18px;
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
    </div>

    <p class="paragraf-materi">
        Untuk menyederhanakan proses tersebut, kita menggunakan Teorema Sisa, yaitu teknik yang memungkinkan
        kita menentukan sisa pembagian polinomial hanya dengan melakukan substitusi sederhana, tanpa perlu
        membagi secara manual. Teorema Sisa juga merupakan dasar bagi Teorema Faktor, pemfaktoran polinomial,
        dan penentuan akar polinomial. Dengan memahami teorema ini, Anda dapat menyelesaikan berbagai masalah
        polinomial dengan lebih cepat dan efisien.
    </p>

    <div class="definisi-wrapper">
        <div class="label-definisi">DEFINISI</div>

        <p class="definisi-text">
            Jika polinomial <em>P(x)</em> dibagi oleh bentuk linear <em>(x − c)</em>, maka sisa pembagiannya
            adalah nilai <em>P(c)</em>.
        </p>
    </div>

    <p class="keterangan-luar">
        Dengan kata lain, untuk mengetahui sisa pembagian <em>P(x)</em> oleh <em>(x − c)</em>, cukup hitung
        polinomial pada <em>x = c</em>.
    </p>

    <div class="sifat-wrapper">
        <div class="label-sifat">SIFAT</div>

        <p class="sifat-text">
            Apabila suatu polinomial <em>P(x)</em> dibagi oleh bentuk linear <em>x − c</em>, maka sisa
            pembagiannya dapat ditentukan dengan menghitung nilai <em>P(c)</em>.
        </p>

        <p class="sifat-text">
            Sifat penting ini menghasilkan dua konsekuensi dasar:
        </p>

        <ol class="sifat-list">
            <li>
                Jika <em>P(c) = 0</em>, maka pembagian tidak memiliki sisa sehingga
                <em>(x − c)</em> adalah faktor dari <em>P(x)</em>.
            </li>
            <li>
                Jika <em>P(c) ≠ 0</em>, maka nilai tersebut adalah sisa pembagiannya.
            </li>
        </ol>
    </div>

    <div class="langkah-penggunaan">
        <h3 class="judul-langkah">Langkah-Langkah Menggunakan Teorema Sisa</h3>
        <ol class="daftar-langkah">
            <li>Tentukan nilai <em>c</em> dari pembagi <em>(x − c)</em>.</li>
            <li>Substitusikan <em>x = c</em> ke dalam polinomial.</li>
            <li>Hitung hasilnya dengan benar.</li>
            <li>Nilai tersebut adalah sisa pembagian.</li>
        </ol>
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

            <button type="button" id="btnLangkah2" class="langkah-click-btn locked" onclick="bukaLangkahSubstitusi(2)">
                Langkah 2
            </button>

            <button type="button" id="btnLangkah3" class="langkah-click-btn locked" onclick="bukaLangkahSubstitusi(3)">
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
</div>

<script>
    let langkahTerbuka = 0;

    function bukaLangkahSubstitusi(langkah) {
        if (langkah > langkahTerbuka + 1) {
            return;
        }

        const tombol = document.getElementById('btnLangkah' + langkah);
        if (tombol.classList.contains('locked')) {
            return;
        }

        const hasil = document.getElementById('hasilLangkah' + langkah);

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