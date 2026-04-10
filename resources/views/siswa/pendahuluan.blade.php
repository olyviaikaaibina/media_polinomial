@extends('layout.halamanmateri')

@section('content')
    <div class="container-fluid px-0">

        <!-- Header -->
        <div class="mb-4">
            <h2 class="mb-1 text-center"
                style="font-family:'Playfair Display', serif; font-weight:900; letter-spacing:1px; color:#2f5d3a;">
                PENDAHULUAN
            </h2>
            <p class="text-center mb-0" style="color:#6b6b6b;">
                Menjelajah Dunia Polinomial yang Seru
            </p>
        </div>

        <!-- Hero Card -->
        <div class="card border-0 mb-4"
            style="border-radius:18px; overflow:hidden; box-shadow: 0 14px 34px rgba(0,0,0,0.10);">
            <div class="card-body p-3 p-md-4"
                style="background: linear-gradient(135deg, rgba(143,159,118,0.18), rgba(243,224,197,0.35));">

                <div class="row g-4 align-items-start">

                    <!-- LEFT PANEL -->
                    <div class="col-12 col-lg-6">
                        <div class="p-3 p-md-4"
                            style="background: rgba(255,255,255,0.90); border:1px solid rgba(79,74,63,0.10); border-radius:16px;">

                            <div class="d-flex align-items-center gap-2 mb-3">
                                <span
                                    style="height:32px;width:32px;border-radius:10px;background:#8F9F76;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:900;">★</span>
                                <h5 class="mb-0" style="font-weight:900; color:#4F4A3F;">
                                    Menjelajah Dunia Polinomial
                                </h5>
                            </div>

                            <p style="color:#4F4A3F; line-height:1.8;" class="mb-2">
                                Pernahkah kalian melihat <b>bola</b> yang dilempar ke atas lalu jatuh kembali?
                                Atau memperhatikan grafik <b>nilai ujian</b> yang naik turun setiap semester?
                            </p>

                            <div class="p-3 my-3"
                                style="border-radius:14px; background:#FFFDE6; border:1px solid rgba(79,74,63,0.12);">
                                <b style="color:#2f5d3a;">
                                    ✨ Pola-pola seperti itu dapat dijelaskan menggunakan fungsi polinomial.
                                </b>
                            </div>

                            <p style="color:#4F4A3F; line-height:1.8;" class="mb-0">
                                Dalam bab ini, kalian akan memahami pengertian polinomial dan fungsi polinomial,
                                menganalisis bentuk serta sifat-sifatnya, dan menerapkannya dalam berbagai
                                permasalahan matematika.
                            </p>

                            <!-- Buttons -->
                            <div class="d-flex flex-wrap gap-2 mt-3">
                                <button class="btn btn-sm" type="button" onclick="showRightPanel('contoh')"
                                    style="background:#8F9F76; color:#fff; border-radius:999px; padding:9px 14px; font-weight:700;">
                                    ✅ Contoh
                                </button>

                                <button class="btn btn-sm" type="button" onclick="showRightPanel('bukan')"
                                    style="background:#AAB99A; color:#fff; border-radius:999px; padding:9px 14px; font-weight:700;">
                                    ❌ Bukan
                                </button>

                                <button class="btn btn-sm" type="button" onclick="resetRightPanel()"
                                    style="background:#2f5d3a; color:#fff; border-radius:999px; padding:9px 14px; font-weight:700;">
                                    ↩ Kembali
                                </button>
                            </div>

                        </div>
                    </div>

                    <!-- RIGHT PANEL -->
                    <div class="col-12 col-lg-6">
                        <div id="rightPanel" class="p-3 p-md-4"
                            style="background: rgba(255,255,255,0.90); border:1px solid rgba(79,74,63,0.10); border-radius:16px;">

                            <!-- Default content = p5 embed -->
                            <div id="rightImageWrap">
                                <div class="position-relative">
                                    <div id="p5Pendahuluan" style="
                        width:100%;
                        aspect-ratio:16/9;
                        min-height:260px;
                        border-radius:16px;
                        border:1px solid rgba(79,74,63,0.12);
                        background:#fff;
                        overflow:hidden;
                      ">
                                    </div>
                                </div>
                            </div>

                            <!-- Explanation content -->
                            <div id="rightExplainWrap" style="display:none;">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <span id="rpIcon" style="height:34px;width:34px;border-radius:12px;background:#8F9F76;color:#fff;
                      display:flex;align-items:center;justify-content:center;font-weight:900;">i</span>
                                    <h5 id="rpTitle" class="mb-0" style="font-weight:900; color:#4F4A3F;">Judul</h5>
                                </div>

                                <div id="rpText" style="color:#4F4A3F; line-height:1.85; background:#FFFDE6;
                    border:1px solid rgba(79,74,63,0.12); border-radius:14px; padding:14px; overflow:hidden;">
                                </div>

                                <div class="small mt-2" style="color:#6b6b6b;">
                                    Klik tombol <b>↩ Kembali</b> untuk menampilkan interaktif lagi.
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- ✅ KaTeX -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/contrib/auto-render.min.js"></script>

    <!-- ✅ p5 -->
    <script src="https://cdn.jsdelivr.net/npm/p5@1.9.0/lib/p5.min.js"></script>
    <script src="{{ asset('js/pendahuluan.js') }}"></script>

    <script>
        // Render KaTeX untuk seluruh halaman pertama kali
        document.addEventListener("DOMContentLoaded", function () {
            if (window.renderMathInElement) {
                renderMathInElement(document.body, {
                    delimiters: [
                        { left: "$$", right: "$$", display: true },
                        { left: "\\(", right: "\\)", display: false }
                    ]
                });
            }
        });

        // Helper: render KaTeX khusus area panel kanan setelah innerHTML berubah
        function renderKatexIn(node) {
            if (!node || !window.renderMathInElement) return;
            renderMathInElement(node, {
                delimiters: [
                    { left: "$$", right: "$$", display: true },
                    { left: "\\(", right: "\\)", display: false }
                ]
            });
        }

        function showRightPanel(type) {
            const imgWrap = document.getElementById('rightImageWrap');
            const expWrap = document.getElementById('rightExplainWrap');
            const title = document.getElementById('rpTitle');
            const text = document.getElementById('rpText');
            const icon = document.getElementById('rpIcon');
            const p5Wrap = document.getElementById('p5Pendahuluan');

            imgWrap.style.display = 'none';
            expWrap.style.display = 'block';
            if (p5Wrap) p5Wrap.style.display = 'none';

            if (type === 'contoh') {
                icon.style.background = '#8F9F76';
                icon.textContent = '✓';
                title.textContent = 'Contoh Polinomial';

                text.innerHTML = `
            <div style="font-weight:900; margin-bottom:8px; color:#2f5d3a;">
              Termasuk polinomial karena:
            </div>

            <div style="width:100%; overflow-x:auto; padding-bottom:6px;">
              <div style="min-width:max-content; font-weight:800;">
                $$P(x)=2x^3-5x+7$$
              </div>
            </div>

            <ul style="margin:0; padding-left:1.1rem;">
              <li>Pangkat variabel bilangan bulat tak negatif: \\(3\\) dan \\(1\\).</li>
              <li>Tidak ada variabel di penyebut.</li>
              <li>Tersusun dari penjumlahan/pengurangan suku.</li>
            </ul>

            <div class="mt-2" style="color:#6b6b6b; font-size:0.92rem;">
              Catatan: konstanta \\(7\\) juga bagian dari polinomial.
            </div>
          `;
            } else {
                icon.style.background = '#AAB99A';
                icon.textContent = '✕';
                title.textContent = 'Bukan Polinomial';

                text.innerHTML = `
            <div style="font-weight:900; margin-bottom:8px; color:#2f5d3a;">
              Bukan polinomial karena:
            </div>

            <div style="width:100%; overflow-x:auto; padding-bottom:6px;">
              <div style="min-width:max-content; font-weight:800;">
                $$\\frac{2}{x}+1$$
              </div>
            </div>

            <ul style="margin:0; padding-left:1.1rem;">
              <li>Ada variabel di <b>penyebut</b>.</li>
              <li>Bisa ditulis \\(\\frac{2}{x}=2x^{-1}\\) → pangkat negatif (tidak boleh).</li>
            </ul>

            <div class="mt-3" style="font-weight:900; color:#4F4A3F;">Contoh lain:</div>
            <div style="width:100%; overflow-x:auto; padding-bottom:6px;">
              <div style="min-width:max-content; font-weight:800;">
                $$\\sqrt{x}+2\\;(\\sqrt{x}=x^{\\tfrac{1}{2}})$$
              </div>
            </div>
            <div class="small" style="color:#6b6b6b;">
              Karena pangkatnya pecahan \\(\\tfrac{1}{2}\\), maka bukan polinomial.
            </div>
          `;
            }

            // ✅ render KaTeX setelah konten diganti
            renderKatexIn(expWrap);
        }

        function resetRightPanel() {
            document.getElementById('rightExplainWrap').style.display = 'none';
            document.getElementById('rightImageWrap').style.display = 'block';

            const p5Wrap = document.getElementById('p5Pendahuluan');
            if (p5Wrap) p5Wrap.style.display = 'block';
        }
    </script>
@endsection

@section('nav')
    <a href="{{ route('petakonsep') }}" class="btn-nav">← Previous</a>
    <a href="{{ route('pengertianpolinomial') }}" class="btn-nav">Next →</a>
@endsection