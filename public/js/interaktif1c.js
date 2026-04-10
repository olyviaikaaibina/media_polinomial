// public/js/latihan1.js
// FULL + BUTTONS + CHECK/RESET + EXPLANATIONS
// - Soal nomor 3 PASTI muncul 3 baris (a,b,c)
// - Tiap baris ada 2 kotak: Perilaku ujung + Grafik (A/B/C)
// - Layout Soal 3 dibuat AMAN (tidak overflow / tidak keluar garis) dengan clamp lebar kolom
// - Input overlay selalu sync dengan canvas
// - Tambahan: Tombol CEK JAWABAN & RESET + penjelasan kalau salah

(function () {
  function mountLatihan() {
    const host = document.getElementById("p5Latihan1");
    if (!host) return;

    host.innerHTML = "";
    host.style.position = "relative";

    // ====== Answer key + helpers ======

    // Kalau urutan grafik di gambar kamu berbeda, ganti mapping ini.
    // Default (umum):
    // A: kedua ujung naik (up-up)
    // B: kedua ujung turun (down-down)
    // C: kiri turun kanan naik (down-up)
    const GRAPH_MAP = {
      UP_UP: ["A"],
      DOWN_DOWN: ["B"],
      DOWN_UP: ["C"],
      UP_DOWN: [], // jarang dipakai untuk soal ini, disiapkan saja
    };

    function norm(s) {
      return String(s || "")
        .trim()
        .toLowerCase()
        .replace(/\s+/g, " ");
    }

    function isEmpty(s) {
      return norm(s) === "";
    }

    // cek apakah jawaban mengandung dua nilai akar (order bebas)
    function matchRoots(input, a, b) {
      const t = norm(input)
        .replace(/,/g, " ")
        .replace(/;/g, " ")
        .replace(/=/g, " ")
        .replace(/x/g, " ")
        .replace(/\(/g, " ")
        .replace(/\)/g, " ");
      const parts = t.split(" ").filter(Boolean);

      const want1 = String(a);
      const want2 = String(b);

      const has1 = parts.includes(want1);
      const has2 = parts.includes(want2);
      return has1 && has2;
    }

    function containsAny(input, arr) {
      const t = norm(input);
      return arr.some((x) => t.includes(norm(x)));
    }

    // perilaku ujung: kita terima banyak gaya penulisan (fleksibel)
    function matchEndBehavior(input, kind) {
      const t = norm(input);

      const patterns = {
        UP_UP: [
          "kiri naik kanan naik",
          "kedua ujung naik",
          "x→-∞ f(x)→∞",
          "x→-inf f(x)→inf",
          "x->-inf f(x)->inf",
          "x→∞ f(x)→∞",
          "x->inf f(x)->inf",
          "atas-atas",
          "naik-naik",
        ],
        DOWN_DOWN: [
          "kiri turun kanan turun",
          "kedua ujung turun",
          "x→-∞ f(x)→-∞",
          "x→-inf f(x)→-inf",
          "x->-inf f(x)->-inf",
          "x→∞ f(x)→-∞",
          "x->inf f(x)->-inf",
          "bawah-bawah",
          "turun-turun",
        ],
        DOWN_UP: [
          "kiri turun kanan naik",
          "x→-∞ f(x)→-∞",
          "x→-inf f(x)→-inf",
          "x->-inf f(x)->-inf",
          "x→∞ f(x)→∞",
          "x->inf f(x)->inf",
          "bawah-atas",
          "turun-naik",
        ],
        UP_DOWN: [
          "kiri naik kanan turun",
          "x→-∞ f(x)→∞",
          "x→-inf f(x)→inf",
          "x->-inf f(x)->inf",
          "x→∞ f(x)→-∞",
          "x->inf f(x)->-inf",
          "atas-bawah",
          "naik-turun",
        ],
      };

      // karena beberapa pola butuh 2 kondisi (kiri & kanan),
      // kita anggap benar jika:
      // - menyebut frasa "kiri ... kanan ..."
      // - atau mengandung kedua limit yang relevan
      const p = patterns[kind] || [];
      if (containsAny(t, p)) return true;

      // fallback: cari kata kunci naik/turun + kiri/kanan
      const hasKiri = t.includes("kiri");
      const hasKanan = t.includes("kanan");
      const hasNaik = t.includes("naik") || t.includes("atas") || t.includes("inf");
      const hasTurun = t.includes("turun") || t.includes("bawah") || t.includes("-inf");

      if (hasKiri && hasKanan) {
        if (kind === "UP_UP" && hasNaik && !hasTurun) return true;
        if (kind === "DOWN_DOWN" && hasTurun && !hasNaik) return true;
        if (kind === "DOWN_UP" && hasNaik && hasTurun) {
          // butuh arah, tidak cukup
          // jadi jangan auto-true
          return false;
        }
      }
      return false;
    }

    // untuk grafik A/B/C
    function matchGraphChoice(input, kind) {
      const t = norm(input).replace(/\./g, "").toUpperCase();
      const ch = t.trim();
      const allowed = GRAPH_MAP[kind] || [];
      return allowed.includes(ch);
    }

    // ====== UI feedback manager (border + note) ======
    function applyInputState(el, ok) {
      el.style.border = ok ? "2px solid #1F8B24" : "2px solid #C00000";
      el.style.background = ok ? "rgba(235, 255, 240, 0.95)" : "rgba(255,235,235,0.95)";
    }
    function clearInputState(el) {
      el.style.border = "1.4px solid #000";
      el.style.background = "rgba(255,255,255,0.95)";
    }

    // ====== p5 sketch ======
    const sketch = (p) => {
      // ----- constants -----
      const A4_RATIO = 1.414;
      const PAD = 28;
      const BORDER_W = 3;
      const SAFE_INSET = 18;
      const INNER_INSET = 12;
      const FOOTER_RESERVED = 36;

      // theme
      const BLUE = "#4DA3FF";
      const RED = "#C00000";
      const SOFT_BG = "#F4F7FF";
      const MUTED = "#6F6F6F";

      // ----- runtime -----
      let cw = 820;
      let ch = Math.round(cw * A4_RATIO);
      let grafikImg = null;

      let overlay = null;
      let controls = null; // tombol cek/reset
      let inputs = []; // {id, el, rect}
      let notes = {}; // id -> noteDiv

      function calcSize() {
        const maxW = 940;
        const w = Math.min(maxW, (host.clientWidth || maxW) - 16);
        cw = Math.max(380, w);
        ch = Math.round(cw * A4_RATIO);
      }

      function ensureOverlay() {
        if (overlay) return overlay;
        overlay = document.createElement("div");
        overlay.style.position = "absolute";
        overlay.style.left = "0";
        overlay.style.top = "0";
        overlay.style.zIndex = "10";
        overlay.style.width = cw + "px";
        overlay.style.height = ch + "px";
        overlay.style.pointerEvents = "none";
        host.appendChild(overlay);
        return overlay;
      }

      function ensureControls() {
        if (controls) return controls;

        // container tombol (absolute di atas canvas)
        controls = document.createElement("div");
        controls.style.position = "absolute";
        controls.style.right = "14px";
        controls.style.top = "14px";
        controls.style.zIndex = "30";
        controls.style.display = "flex";
        controls.style.gap = "10px";
        controls.style.pointerEvents = "auto";

        const btnCheck = document.createElement("button");
        btnCheck.textContent = "CEK JAWABAN";
        btnCheck.style.padding = "10px 12px";
        btnCheck.style.borderRadius = "10px";
        btnCheck.style.border = "2px solid #000";
        btnCheck.style.cursor = "pointer";
        btnCheck.style.fontFamily = "Times New Roman, serif";
        btnCheck.style.fontSize = "14px";
        btnCheck.style.fontWeight = "700";
        btnCheck.style.background = "#ffffff";

        const btnReset = document.createElement("button");
        btnReset.textContent = "RESET";
        btnReset.style.padding = "10px 12px";
        btnReset.style.borderRadius = "10px";
        btnReset.style.border = "2px solid #000";
        btnReset.style.cursor = "pointer";
        btnReset.style.fontFamily = "Times New Roman, serif";
        btnReset.style.fontSize = "14px";
        btnReset.style.fontWeight = "700";
        btnReset.style.background = "#ffffff";

        btnCheck.addEventListener("click", () => checkAnswers());
        btnReset.addEventListener("click", () => resetAll());

        controls.appendChild(btnCheck);
        controls.appendChild(btnReset);
        host.appendChild(controls);
        return controls;
      }

      function clearOverlayInputs() {
        for (const it of inputs) {
          if (it.el && it.el.parentNode) it.el.parentNode.removeChild(it.el);
        }
        inputs = [];
      }

      function clearNotes() {
        Object.keys(notes).forEach((k) => {
          const n = notes[k];
          if (n && n.parentNode) n.parentNode.removeChild(n);
        });
        notes = {};
      }

      function createNote(id, rect, html, ok) {
        ensureOverlay();

        // remove old
        if (notes[id] && notes[id].parentNode) notes[id].parentNode.removeChild(notes[id]);

        const div = document.createElement("div");
        div.setAttribute("data-note-id", id);
        div.style.position = "absolute";
        div.style.left = rect.x + "px";
        div.style.top = rect.y + rect.h + 4 + "px";
        div.style.width = Math.max(160, rect.w) + "px";
        div.style.boxSizing = "border-box";
        div.style.padding = "8px 10px";
        div.style.borderRadius = "10px";
        div.style.border = ok ? "1.6px solid #1F8B24" : "1.6px solid #C00000";
        div.style.background = ok ? "rgba(235,255,240,0.98)" : "rgba(255,235,235,0.98)";
        div.style.fontFamily = "Times New Roman, serif";
        div.style.fontSize = "12.5px";
        div.style.lineHeight = "1.25";
        div.style.pointerEvents = "auto";
        div.innerHTML = html;

        overlay.appendChild(div);
        notes[id] = div;
      }

      function createInput({ id, rect, placeholder }) {
        ensureOverlay();
        const el = document.createElement("input");
        el.type = "text";
        el.setAttribute("data-id", id);
        el.placeholder = placeholder || "";
        el.autocomplete = "off";
        el.spellcheck = false;

        el.style.position = "absolute";
        el.style.left = rect.x + "px";
        el.style.top = rect.y + "px";
        el.style.width = rect.w + "px";
        el.style.height = rect.h + "px";
        el.style.boxSizing = "border-box";
        el.style.border = "1.4px solid #000";
        el.style.borderRadius = "6px";
        el.style.background = "rgba(255,255,255,0.95)";
        el.style.padding = "6px 10px";
        el.style.fontFamily = "Times New Roman, serif";
        el.style.fontSize = "14px";
        el.style.lineHeight = "1.25";
        el.style.outline = "none";
        el.style.pointerEvents = "auto";

        overlay.appendChild(el);
        inputs.push({ id, el, rect });
      }

      function syncOverlay() {
        if (!overlay) return;
        overlay.style.width = p.width + "px";
        overlay.style.height = p.height + "px";

        // controls tetap di host, tapi biar aman kita pastikan ada
        ensureControls();

        for (const it of inputs) {
          const r = it.rect;
          it.el.style.left = r.x + "px";
          it.el.style.top = r.y + "px";
          it.el.style.width = r.w + "px";
          it.el.style.height = r.h + "px";

          // sync note position if exists
          if (notes[it.id]) {
            notes[it.id].style.left = r.x + "px";
            notes[it.id].style.top = r.y + r.h + 4 + "px";
            notes[it.id].style.width = Math.max(160, r.w) + "px";
          }
        }
      }

      // ====== CHECK / RESET LOGIC ======

      function getInputById(id) {
        return inputs.find((x) => x.id === id) || null;
      }

      function explainLeadingTerm(polyLeadingTerm, parity, sign) {
        // parity: "genap"/"ganjil", sign: "+" / "-"
        if (parity === "genap" && sign === "+") {
          return `Suku dominan: <b>${polyLeadingTerm}</b> (derajat genap, koefisien positif) ⇒ saat x→±∞, f(x)→+∞ (ujung <b>naik-naik</b>).`;
        }
        if (parity === "genap" && sign === "-") {
          return `Suku dominan: <b>${polyLeadingTerm}</b> (derajat genap, koefisien negatif) ⇒ saat x→±∞, f(x)→−∞ (ujung <b>turun-turun</b>).`;
        }
        if (parity === "ganjil" && sign === "+") {
          return `Suku dominan: <b>${polyLeadingTerm}</b> (derajat ganjil, koefisien positif) ⇒ kiri turun (x→−∞, f(x)→−∞) dan kanan naik (x→+∞, f(x)→+∞).`;
        }
        return `Suku dominan: <b>${polyLeadingTerm}</b> (derajat ganjil, koefisien negatif) ⇒ kiri naik (x→−∞, f(x)→+∞) dan kanan turun (x→+∞, f(x)→−∞).`;
      }

      function checkAnswers() {
        clearNotes();

        let correct = 0;
        let total = 0;

        // helper to evaluate one field
        function evalField(id, ok, htmlExplainIfWrong, htmlExplainIfOk) {
          const it = getInputById(id);
          if (!it) return;

          total += 1;

          if (ok) {
            correct += 1;
            applyInputState(it.el, true);
            // optional: show small success note only if user filled something
            if (!isEmpty(it.el.value)) {
              createNote(
                id,
                it.rect,
                htmlExplainIfOk || `<b>Benar.</b>`,
                true
              );
            }
          } else {
            applyInputState(it.el, false);
            createNote(
              id,
              it.rect,
              htmlExplainIfWrong || `<b>Masih salah.</b>`,
              false
            );
          }
        }

        // ========== Soal 1 ==========
        // p(x) = 7x^5 − 3x^2 + 9
        {
          const vA = norm(getInputById("p1a")?.el.value);
          const vB = norm(getInputById("p1b")?.el.value);
          const vC = norm(getInputById("p1c")?.el.value);
          const vD = norm(getInputById("p1d")?.el.value);
          const vE = getInputById("p1e")?.el.value || "";

          evalField(
            "p1a",
            vA === "5" || vA.includes("5"),
            `Derajat ditentukan dari pangkat tertinggi. Di sini pangkat tertinggi adalah 5 pada <b>7x⁵</b>, jadi derajat = <b>5</b>.`,
            `<b>Benar.</b> Derajat = 5 (pangkat tertinggi 5).`
          );

          evalField(
            "p1b",
            vB === "3" || vB.includes("3") || vB.includes("tiga"),
            `Jumlah suku = banyaknya term yang dipisah +/−: <b>7x⁵</b>, <b>−3x²</b>, <b>+9</b> ⇒ total <b>3</b> suku.`,
            `<b>Benar.</b> Ada 3 suku.`
          );

          evalField(
            "p1c",
            vC.includes("7x") && (vC.includes("x5") || vC.includes("x⁵") || vC.includes("x^5") || vC.includes("x 5")),
            `Suku utama adalah suku dengan derajat tertinggi, yaitu <b>7x⁵</b>.`,
            `<b>Benar.</b> Suku utama: 7x⁵.`
          );

          evalField(
            "p1d",
            vD === "7" || vD.includes("7"),
            `Koefisien utama adalah koefisien dari suku utama <b>7x⁵</b> ⇒ koefisien utama = <b>7</b>.`,
            `<b>Benar.</b> Koefisien utama = 7.`
          );

          // end behavior: odd degree, positive leading -> DOWN_UP
          evalField(
            "p1e",
            matchEndBehavior(vE, "DOWN_UP"),
            explainLeadingTerm("7x⁵", "ganjil", "+") +
              `<br/><b>Jawaban yang diterima:</b> "kiri turun kanan naik" atau limit setara.`,
            `<b>Benar.</b> Kiri turun, kanan naik.`
          );
        }

        // ========== Soal 2 ==========
        // f(x)=x^2+2x−8
        {
          const vA = getInputById("p2a")?.el.value || "";
          const vB = norm(getInputById("p2b")?.el.value);
          const vC = norm(getInputById("p2c")?.el.value);

          // x-intercepts: x=2 and x=-4
          evalField(
            "p2a",
            matchRoots(vA, 2, -4) || matchRoots(vA, -4, 2),
            `Titik potong sumbu-x didapat dari f(x)=0: x²+2x−8=0 ⇒ (x+4)(x−2)=0 ⇒ x=<b>−4</b> dan x=<b>2</b>.
             <br/>Jadi titiknya: <b>(−4,0)</b> dan <b>(2,0)</b>.`,
            `<b>Benar.</b> Akar: −4 dan 2 ⇒ titik potong: (−4,0) & (2,0).`
          );

          // y-intercept: f(0)=-8
          evalField(
            "p2b",
            vB.includes("-8") || vB.includes("−8") || vB.includes("(0,-8)") || vB.includes("(0, -8)"),
            `Titik potong sumbu-y: masukkan x=0 ⇒ f(0)=−8 ⇒ titiknya <b>(0,−8)</b>.`,
            `<b>Benar.</b> (0,−8).`
          );

          // vertex: x=-1, y=-9
          const vertexOk =
            (vC.includes("-1") || vC.includes("−1")) &&
            (vC.includes("-9") || vC.includes("−9"));

          evalField(
            "p2c",
            vertexOk,
            `Vertex: x = −b/(2a) = −2/(2·1) = <b>−1</b>.
             <br/>y = f(−1)= (−1)² + 2(−1) − 8 = 1 − 2 − 8 = <b>−9</b>.
             <br/>Jadi vertex: <b>(−1,−9)</b>.`,
            `<b>Benar.</b> Vertex (−1,−9).`
          );
        }

        // ========== Soal 3 ==========
        // a) f(x)=−2x⁸ + 5x³ − 1 => DOWN_DOWN (even, negative)
        // b) g(x)=3x⁴ − 6x² + 2 => UP_UP (even, positive)
        // c) h(x)=x⁷ + 4x² + 3 => DOWN_UP (odd, positive)
        {
          const ua = getInputById("p3a_ujung")?.el.value || "";
          const ga = getInputById("p3a_graf")?.el.value || "";

          evalField(
            "p3a_ujung",
            matchEndBehavior(ua, "DOWN_DOWN"),
            explainLeadingTerm("−2x⁸", "genap", "-"),
            `<b>Benar.</b> Ujung turun-turun.`
          );
          evalField(
            "p3a_graf",
            matchGraphChoice(ga, "DOWN_DOWN"),
            `Karena ujung <b>turun-turun</b> (genap, koef. negatif), pilih grafik yang menunjukkan kedua ujung turun.
             <br/><b>Mapping saat ini:</b> DOWN_DOWN ⇒ ${GRAPH_MAP.DOWN_DOWN.join(", ") || "(belum diset)"}.
             <br/>Jika gambar kamu beda, ubah <b>GRAPH_MAP</b> di atas.`,
            `<b>Benar.</b> Cocok untuk turun-turun.`
          );

          const ub = getInputById("p3b_ujung")?.el.value || "";
          const gb = getInputById("p3b_graf")?.el.value || "";

          evalField(
            "p3b_ujung",
            matchEndBehavior(ub, "UP_UP"),
            explainLeadingTerm("3x⁴", "genap", "+"),
            `<b>Benar.</b> Ujung naik-naik.`
          );
          evalField(
            "p3b_graf",
            matchGraphChoice(gb, "UP_UP"),
            `Karena ujung <b>naik-naik</b> (genap, koef. positif), pilih grafik yang menunjukkan kedua ujung naik.
             <br/><b>Mapping saat ini:</b> UP_UP ⇒ ${GRAPH_MAP.UP_UP.join(", ") || "(belum diset)"}.
             <br/>Jika gambar kamu beda, ubah <b>GRAPH_MAP</b> di atas.`,
            `<b>Benar.</b> Cocok untuk naik-naik.`
          );

          const uc = getInputById("p3c_ujung")?.el.value || "";
          const gc = getInputById("p3c_graf")?.el.value || "";

          evalField(
            "p3c_ujung",
            matchEndBehavior(uc, "DOWN_UP"),
            explainLeadingTerm("x⁷", "ganjil", "+"),
            `<b>Benar.</b> Kiri turun, kanan naik.`
          );
          evalField(
            "p3c_graf",
            matchGraphChoice(gc, "DOWN_UP"),
            `Karena ujung <b>kiri turun - kanan naik</b> (ganjil, koef. positif), pilih grafik yang menunjukkan kiri turun dan kanan naik.
             <br/><b>Mapping saat ini:</b> DOWN_UP ⇒ ${GRAPH_MAP.DOWN_UP.join(", ") || "(belum diset)"}.
             <br/>Jika gambar kamu beda, ubah <b>GRAPH_MAP</b> di atas.`,
            `<b>Benar.</b> Cocok untuk kiri turun kanan naik.`
          );
        }

        // ringkasan
        const msg =
          `Skor: ${correct} / ${total}\n` +
          (correct === total
            ? "Mantap! Semua jawaban benar."
            : "Masih ada yang salah. Lihat penjelasan merah di bawah input.");

        // optional: tampilkan alert kecil (nggak wajib)
        // tapi enak untuk ringkasan cepat
        window.alert(msg);
      }

      function resetAll() {
        clearNotes();
        for (const it of inputs) {
          it.el.value = "";
          clearInputState(it.el);
        }
      }

      // ----- p5 lifecycle -----
      p.preload = () => {
        grafikImg = p.loadImage(
          "/img/grafik.png",
          () => {},
          () => {
            grafikImg = null;
          }
        );
      };

      p.setup = () => {
        calcSize();
        const cnv = p.createCanvas(cw, ch);
        cnv.parent(host);

        ensureOverlay();
        ensureControls();

        p.pixelDensity(2);
        p.textFont("Times New Roman");
        p.noLoop();
        p.redraw();
      };

      p.windowResized = () => {
        calcSize();
        p.resizeCanvas(cw, ch);
        if (overlay) {
          overlay.style.width = cw + "px";
          overlay.style.height = ch + "px";
        }
        clearOverlayInputs();
        clearNotes();
        p.redraw();
      };

      // ----- draw helpers -----
      function cardBorder(x, y, w, h) {
        p.noStroke();
        p.fill(SOFT_BG);
        p.rect(x, y, w, h, 10);

        p.stroke(BLUE);
        p.strokeWeight(BORDER_W);
        p.noFill();
        p.rect(x, y, w, h, 10);
        p.noStroke();
      }

      function pill(title, x, y) {
        p.noStroke();
        p.fill(MUTED);
        p.rect(x, y, 220, 44, 12);

        p.fill(255);
        p.textStyle(p.BOLD);
        p.textSize(20);
        p.textAlign(p.CENTER, p.CENTER);
        p.text(title, x + 110, y + 22);
        p.textAlign(p.LEFT, p.BASELINE);
      }

      function wrapped(text, x, y, maxW, leading = 20) {
        p.textLeading(leading);
        const words = String(text).split(" ");
        let line = "";
        let yy = y;

        for (let i = 0; i < words.length; i++) {
          const test = line ? line + " " + words[i] : words[i];
          if (p.textWidth(test) > maxW && line) {
            p.text(line, x, yy);
            line = words[i];
            yy += leading;
          } else {
            line = test;
          }
        }
        if (line) p.text(line, x, yy);
        return yy + leading;
      }

      function heading(num, title, x, y, maxW) {
        p.fill(0);
        p.textStyle(p.BOLD);
        p.textSize(18);
        const y2 = wrapped(`${num}. ${title}`, x, y, maxW, 22);

        p.stroke("#C00000");
        p.strokeWeight(2);
        p.line(x, y + 10, x + Math.min(maxW, 760), y + 10);
        p.noStroke();
        return y2;
      }

      function label(txt, x, y, size = 14, bold = false) {
        p.noStroke();
        p.fill(0);
        p.textStyle(bold ? p.BOLD : p.NORMAL);
        p.textSize(size);
        p.text(txt, x, y);
      }

      function drawImageBox(img, x, y, w, h) {
        p.stroke(0);
        p.strokeWeight(1.1);
        p.fill(255);
        p.rect(x, y, w, h, 8);

        p.noStroke();
        p.fill(60);
        p.textStyle(p.BOLD);
        p.textSize(12);
        p.text("Grafik A, B, C", x + 10, y + 18);

        if (!img) {
          p.fill(120);
          p.textStyle(p.ITALIC);
          p.textSize(12);
          p.text("grafik.png tidak ditemukan", x + 10, y + 38);
          p.textStyle(p.NORMAL);
          return;
        }

        const pad = 10;
        const headerPad = 18;
        const innerX = x + pad;
        const innerY = y + pad + headerPad;
        const innerW = w - pad * 2;
        const innerH = h - pad * 2 - headerPad;

        const scale = Math.min(innerW / img.width, innerH / img.height);
        const dw = img.width * scale;
        const dh = img.height * scale;

        const dx = innerX + (innerW - dw) / 2;
        const dy = innerY + (innerH - dh) / 2;
        p.image(img, dx, dy, dw, dh);
      }

      function lineGrey(x1, y1, x2, y2) {
        p.stroke("#D0D0D0");
        p.strokeWeight(1);
        p.line(x1, y1, x2, y2);
        p.noStroke();
      }

      // ----- draw -----
      p.draw = () => {
        p.background(255);
        clearOverlayInputs();
        clearNotes();
        ensureOverlay();
        ensureControls();

        const x0 = PAD;
        const y0 = PAD;
        const W = p.width - 2 * PAD;
        const H = p.height - 2 * PAD;

        cardBorder(x0, y0, W, H);

        const safeX = x0 + SAFE_INSET;
        const safeY = y0 + SAFE_INSET;
        const safeW = W - SAFE_INSET * 2;
        const safeH = H - SAFE_INSET * 2;

        const contentBottom = safeY + safeH;
        const bottomLimit = contentBottom - FOOTER_RESERVED;

        pill("LATIHAN", safeX, safeY);

        const cx = safeX + INNER_INSET;
        let cy = safeY + 72;
        const innerW = safeW - INNER_INSET * 2;

        // ---------------------------
        // Soal 1
        // ---------------------------
        cy = heading(1, "Analisis Fungsi Polinomial", cx, cy, innerW);
        cy += 8;

        label("Diberikan fungsi", cx, cy, 14, false);
        p.textStyle(p.ITALIC);
        p.textSize(18);
        p.fill(0);
        p.text("p(x) = 7x⁵ − 3x² + 9.", cx + 240, cy);
        cy += 30;

        label("Tentukan:", cx, cy, 14, true);
        cy += 18;

        const leftW1 = Math.floor(innerW * 0.6);
        const rightW1 = innerW - leftW1 - 16;
        const leftX1 = cx;
        const rightX1 = cx + leftW1 + 16;

        const rows1 = [
          { k: "a.", t: "Derajat fungsi polinomial tersebut", id: "p1a" },
          { k: "b.", t: "Jumlah sukunya", id: "p1b" },
          { k: "c.", t: "Suku utamanya", id: "p1c" },
          { k: "d.", t: "Koefisien utamanya", id: "p1d" },
        ];

        for (const r of rows1) {
          p.textStyle(p.NORMAL);
          p.textSize(14);
          p.fill(0);

          p.text(r.k, leftX1, cy);
          const yAfter = wrapped(r.t, leftX1 + 28, cy, leftW1 - 28, 18);

          createInput({
            id: r.id,
            rect: { x: rightX1, y: cy - 10, w: rightW1, h: 32 },
            placeholder: "Jawaban...",
          });

          cy = Math.max(yAfter + 10, cy + 34);
        }

        // e
        p.text("e.", leftX1, cy);
        wrapped("Perilaku ujung grafiknya", leftX1 + 28, cy, leftW1 - 28, 18);
        createInput({
          id: "p1e",
          rect: { x: rightX1, y: cy - 10, w: rightW1, h: 32 },
          placeholder: "Contoh: kiri turun kanan naik",
        });
        cy += 44;

        // ---------------------------
        // Soal 2
        // ---------------------------
        cy += 6;
        cy = heading(2, "Grafik Fungsi Kuadrat", cx, cy, innerW);
        cy += 8;

        label("Diberikan fungsi", cx, cy, 14, false);
        p.textStyle(p.ITALIC);
        p.textSize(18);
        p.fill(0);
        p.text("f(x) = x² + 2x − 8.", cx + 240, cy);
        cy += 30;

        label("Tentukan pula:", cx, cy, 14, true);
        cy += 18;

        const rows2 = [
          { k: "a.", t: "Titik potong dengan sumbu-x", id: "p2a" },
          { k: "b.", t: "Titik potong dengan sumbu-y", id: "p2b" },
          { k: "c.", t: "Vertex (titik puncak)", id: "p2c" },
        ];

        for (const r of rows2) {
          p.textStyle(p.NORMAL);
          p.textSize(14);
          p.fill(0);

          p.text(r.k, leftX1, cy);
          const yAfter = wrapped(r.t, leftX1 + 28, cy, leftW1 - 28, 18);

          createInput({
            id: r.id,
            rect: { x: rightX1, y: cy - 10, w: rightW1, h: 32 },
            placeholder: "Jawaban...",
          });

          cy = Math.max(yAfter + 10, cy + 34);
        }

        // ---------------------------
        // Soal 3 (PASTI 3 BARIS + AMAN TIDAK OVERFLOW)
        // ---------------------------
        cy += 8;
        cy = heading(3, "Perilaku Ujung & Mencocokkan Grafik", cx, cy, innerW);
        cy += 2;

        p.textStyle(p.NORMAL);
        p.textSize(12);
        p.fill(0);
        cy = wrapped(
          "Tentukan perilaku ujung dari masing-masing fungsi berikut, lalu pilih grafik yang cocok (A, B, atau C).",
          cx,
          cy,
          innerW,
          16
        );

        // kebutuhan tinggi
        const listTitleH = 22;
        const miniHeaderH = 26;
        const rowH = 52;
        const afterRowsGap = 6;

        // layout kolom
        const leftW3 = Math.floor(innerW * 0.52);
        const gap3 = 14;
        const rightW3 = innerW - leftW3 - gap3;
        const leftX3 = cx;
        const rightX3 = cx + leftW3 + gap3;

        // ---- width guard ----
        let labelW = 110;

        // grafW responsif + clamp
        let grafW = Math.round(rightW3 * 0.22);
        grafW = Math.max(60, Math.min(90, grafW));

        const gapInputs = 12;
        const minUjungW = 120;

        // ujungW dihitung agar muat
        let ujungW = rightW3 - labelW - grafW - gapInputs;

        if (ujungW < minUjungW) {
          labelW = 90;
          ujungW = rightW3 - labelW - grafW - gapInputs;
        }
        if (ujungW < minUjungW) {
          grafW = 60;
          ujungW = rightW3 - labelW - grafW - gapInputs;
        }
        if (ujungW < minUjungW) {
          ujungW = minUjungW;
          grafW = Math.max(52, rightW3 - labelW - gapInputs - ujungW);
        }

        const grafX = rightX3 + labelW + ujungW + gapInputs;

        // tentukan tinggi gambar dinamis
        const spaceAvail = bottomLimit - cy;
        const minImgH = 110;
        const maxImgH = 190;

        const neededWithoutImg =
          listTitleH + miniHeaderH + rowH * 3 + afterRowsGap;

        let imgH = Math.min(
          maxImgH,
          Math.max(minImgH, spaceAvail - neededWithoutImg - 10)
        );
        imgH = Math.max(90, Math.min(imgH, maxImgH));

        // gambar
        const imgY = cy + 8;
        drawImageBox(grafikImg, cx, imgY, innerW, imgH);
        cy = imgY + imgH + 12;

        // "Fungsinya:"
        label("Fungsinya:", cx, cy, 14, true);
        cy += 16;

        // mini header kolom jawaban
        p.fill(0);
        p.textStyle(p.BOLD);
        p.textSize(12);
        p.text("Jawaban:", rightX3, cy + 10);
        p.textStyle(p.NORMAL);
        p.textSize(11);
        p.fill(70);
        p.text("Perilaku ujung", rightX3 + labelW, cy + 10);
        p.text("Grafik", grafX, cy + 10);
        cy += 16;
        lineGrey(cx, cy, cx + innerW, cy);
        cy += 10;

        const list = [
          {
            k: "a.",
            expr: "f(x) = −2x⁸ + 5x³ − 1",
            idU: "p3a_ujung",
            idG: "p3a_graf",
          },
          {
            k: "b.",
            expr: "g(x) = 3x⁴ − 6x² + 2",
            idU: "p3b_ujung",
            idG: "p3b_graf",
          },
          {
            k: "c.",
            expr: "h(x) = x⁷ + 4x² + 3",
            idU: "p3c_ujung",
            idG: "p3c_graf",
          },
        ];

        for (let i = 0; i < list.length; i++) {
          const rowTop = cy;

          p.fill(0);
          p.textStyle(p.NORMAL);
          p.textSize(14);
          p.text(list[i].k, leftX3, rowTop + 18);

          p.textStyle(p.ITALIC);
          p.textSize(14);
          wrapped(list[i].expr, leftX3 + 28, rowTop + 18, leftW3 - 28, 18);

          p.textStyle(p.NORMAL);
          p.textSize(12);
          p.fill(0);
          p.text("Perilaku:", rightX3, rowTop + 20);

          createInput({
            id: list[i].idU,
            rect: {
              x: rightX3 + labelW,
              y: rowTop + 6,
              w: ujungW,
              h: 32,
            },
            placeholder: "Contoh: turun-turun / kiri turun kanan naik",
          });

          p.fill(0);
          p.text("Grafik:", rightX3, rowTop + 48);

          createInput({
            id: list[i].idG,
            rect: {
              x: grafX,
              y: rowTop + 6,
              w: grafW,
              h: 32,
            },
            placeholder: "A/B/C",
          });

          cy += rowH;
          lineGrey(cx, cy, cx + innerW, cy);
          cy += 6;
        }

        syncOverlay();
      };
    };

    if (typeof window.p5 === "undefined") {
      console.error("p5.js belum termuat. Pastikan p5.js di-include sebelum latihan1.js");
      return;
    }

    new p5(sketch);
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", mountLatihan);
  } else {
    mountLatihan();
  }
})();