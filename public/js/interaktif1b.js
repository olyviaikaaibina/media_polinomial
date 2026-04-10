/* =========================================================
   Mari Mencoba: Derajat Suatu Polinomial — p5.js (FIXED + LOCK POSITION)
   ✅ Canvas & tombol nempel ke div host (#p5-interaktif-1b)
   ✅ Responsive: ukuran ikut card, tidak keluar/berantakan
   ✅ Drag & drop: snap ke kotak, swap jika kotak sudah terisi
   ✅ NEW: Jika token sudah pernah masuk kotak, saat dilepas di luar TIDAK balik ke posisi awal,
          tapi kembali ke kotak terakhirnya (lastZone)
   ✅ UPDATE: Hilangkan tombol Acak Token
   ✅ UPDATE: Panel angka jawaban pindah ke samping kanan
   ✅ UPDATE: Hilangkan jarak kosong bawah (canvas fit content)
========================================================= */

(function () {
  const HOST_ID = "p5-interaktif-1b";

  // ---------- Data Soal ----------
  const questions = [
    { text: "Derajat dari ( 4x⁵ )", answer: 5 },
    { text: "Derajat dari ( x²y⁷ )", answer: 9 },
    { text: "Derajat dari ( 0.12x¹ )", answer: 1 },
    { text: "Derajat dari ( 2.17x³y¹z³ )", answer: 7 },
    { text: "Derajat dari 6a²b⁴", answer: 6 },
  ];

  // ---------- Theme ----------
  const BG = [232, 245, 233];      // #E8F5E9
  const PANEL = [250, 255, 250];
  const TEXT = [34, 51, 34];
  const MUTED = [110, 129, 110];
  const BORDER = [168, 188, 168];
  const OK = [40, 167, 69];
  const ERR = [229, 62, 62];

  // ---------- p5 Instance Mode ----------
  const sketch = (p) => {
    let tokens = [], zones = [];
    let checkBtn, resetBtn; // ✅ tanpa Acak Token
    let checked = false, score = 0;

    // Layout vars (dinamis)
    let paddingX = 24;
    let startY = 90;
    let gap = 70;
    let zoneH = 56;
    let zoneW = 0;
    let zoneX = 0;

    let tokenPanelX = 0, tokenPanelY = 0, tokenPanelW = 0, tokenPanelH = 0; // panel samping
    let hostEl = null;

    // ---------- Helper: ukur host ----------
    const getHostSize = () => {
      hostEl = hostEl || document.getElementById(HOST_ID);
      const w = hostEl ? hostEl.clientWidth : 980;
      // ✅ jangan pakai host height supaya tidak ada ruang kosong bawah
      const h = 760; // placeholder, height final dihitung di buildLayout
      return { w, h };
    };

    // ---------- Kelas ----------
    class Token {
      constructor(value, x, y) {
        this.value = value;
        this.x = x; this.y = y;
        this.w = 72; this.h = 44;
        this.dragging = false;
        this.offsetX = 0; this.offsetY = 0;

        this.zone = null;
        this.lastZone = null;
        this.home = p.createVector(x, y);
      }

      draw() {
        p.noStroke(); p.fill(0, 0, 0, 35);
        p.rect(this.x + 2, this.y + 3, this.w, this.h, 10);

        p.stroke(160); p.strokeWeight(1.5);
        p.fill(255);
        p.rect(this.x, this.y, this.w, this.h, 10);

        p.noStroke(); p.fill(TEXT);
        p.textAlign(p.CENTER, p.CENTER); p.textSize(18);
        p.text(this.value, this.x + this.w / 2, this.y + this.h / 2);
      }

      contains(mx, my) {
        return mx > this.x && mx < this.x + this.w && my > this.y && my < this.y + this.h;
      }

      startDrag(mx, my) {
        this.dragging = true;
        this.offsetX = mx - this.x;
        this.offsetY = my - this.y;

        if (this.zone) {
          this.zone.token = null;
          this.zone = null;
        }
      }

      drag(mx, my) {
        if (!this.dragging) return;
        this.x = mx - this.offsetX;
        this.y = my - this.offsetY;
      }

      endDrag() {
        this.dragging = false;

        let bestZ = null, bestArea = 0;
        for (let z of zones) {
          const overlap = overlapArea(this.x, this.y, this.w, this.h, z.x, z.y, z.w, z.h);
          if (overlap > bestArea) { bestArea = overlap; bestZ = z; }
        }

        if (bestZ && bestArea > 10) {
          if (!bestZ.token) {
            snapToZone(this, bestZ);
          } else {
            const other = bestZ.token;
            snapToZone(this, bestZ);

            other.zone = null;
            other.lastZone = null;
            other.x = other.home.x;
            other.y = other.home.y;
          }
        } else {
          if (this.lastZone) {
            snapToZone(this, this.lastZone);
          } else {
            this.x = this.home.x;
            this.y = this.home.y;
          }
        }
      }
    }

    class Zone {
      constructor(label, answer, x, y, w, h) {
        this.label = label;
        this.answer = answer;
        this.x = x; this.y = y; this.w = w; this.h = h;
        this.token = null;
      }

      draw() {
        p.noStroke(); p.fill(0, 0, 0, 30);
        p.rect(this.x + 3, this.y + 4, this.w, this.h, 14);

        let bcol = BORDER, bweight = 2;
        if (checked) {
          if (this.token && parseInt(this.token.value) === parseInt(this.answer)) {
            bcol = OK; bweight = 3;
          } else {
            bcol = ERR; bweight = 3;
          }
        }

        p.stroke(bcol); p.strokeWeight(bweight);
        p.fill(PANEL);
        p.rect(this.x, this.y, this.w, this.h, 14);

        p.noStroke(); p.fill(TEXT);
        p.textAlign(p.LEFT, p.CENTER);
        p.textSize(16);
        p.text(this.label, this.x + 14, this.y + this.h / 2);

        p.textAlign(p.RIGHT, p.CENTER);
        p.fill(this.token ? TEXT : MUTED);
        p.text(this.token ? this.token.value : "Seret angka →", this.x + this.w - 12, this.y + this.h / 2);
      }
    }

    // ---------- Build / rebuild layout ----------
    const buildLayout = () => {
      const { w } = getHostSize();

      // canvas init
      if (!p._renderer) {
        const c = p.createCanvas(w, 760);
        c.parent(HOST_ID);
      } else {
        p.resizeCanvas(w, p.height);
      }

      const sideGap = 18;
      tokenPanelW = Math.min(240, Math.max(200, w * 0.22));
      zoneX = paddingX;
      zoneW = (w - paddingX * 2) - tokenPanelW - sideGap;

      startY = 96;
      gap = Math.max(62, Math.min(74, p.height * 0.09));
      zoneH = 56;

      zones = [];
      for (let i = 0; i < questions.length; i++) {
        zones.push(new Zone(
          `${i + 1}. ${questions[i].text}   →  Derajat =`,
          questions[i].answer,
          zoneX,
          startY + i * gap,
          zoneW,
          zoneH
        ));
      }

      tokenPanelX = zoneX + zoneW + sideGap;
      tokenPanelY = startY;
      tokenPanelH = (startY + (questions.length - 1) * gap + zoneH) - startY;

      // ✅ FIT HEIGHT: hilangkan ruang kosong bawah
      const contentBottom = Math.max(
        zones[zones.length - 1].y + zoneH,
        tokenPanelY + tokenPanelH
      );
      const neededH = Math.ceil(contentBottom + 140); // ruang skor + tombol
      if (hostEl) hostEl.style.height = neededH + "px";
      p.resizeCanvas(w, neededH);

      // init / relayout tokens
      const tokenValues = [5, 9, 1, 7, 6];
      if (tokens.length === 0) {
        shuffleArray(tokenValues);
        tokens = [];

        const tokenW = 72, tokenH = 44;
        const gapT = 16;

        const availH = Math.max(1, tokenPanelH - 54);
        let rows = Math.max(1, Math.floor((availH + gapT) / (tokenH + gapT)));
        let cols = Math.ceil(tokenValues.length / rows);
        cols = Math.min(2, Math.max(1, cols));

        rows = Math.ceil(tokenValues.length / cols);

        const gridW = cols * tokenW + (cols - 1) * gapT;
        const gridH = rows * tokenH + (rows - 1) * gapT;

        const baseX = tokenPanelX + (tokenPanelW - gridW) / 2;
        const baseY = tokenPanelY + 48 + (availH - gridH) / 2;

        for (let i = 0; i < tokenValues.length; i++) {
          const c = i % cols;
          const r = Math.floor(i / cols);
          const x = baseX + c * (tokenW + gapT);
          const y = baseY + r * (tokenH + gapT);
          tokens.push(new Token(tokenValues[i], x, y));
        }
      } else {
        const tokenW = 72, tokenH = 44;
        const gapT = 16;

        const availH = Math.max(1, tokenPanelH - 54);
        let rows = Math.max(1, Math.floor((availH + gapT) / (tokenH + gapT)));
        let cols = Math.ceil(tokens.length / rows);
        cols = Math.min(2, Math.max(1, cols));

        rows = Math.ceil(tokens.length / cols);

        const gridW = cols * tokenW + (cols - 1) * gapT;
        const gridH = rows * tokenH + (rows - 1) * gapT;

        const baseX = tokenPanelX + (tokenPanelW - gridW) / 2;
        const baseY = tokenPanelY + 48 + (availH - gridH) / 2;

        tokens.forEach((t, i) => {
          const c = i % cols;
          const r = Math.floor(i / cols);
          const x = baseX + c * (tokenW + gapT);
          const y = baseY + r * (tokenH + gapT);

          if (!t.dragging && !t.zone) {
            t.x = x;
            t.y = y;
          }
          t.home.set(x, y);
        });

        zones.forEach(z => {
          if (z.token) snapToZone(z.token, z);
        });
      }

      // buttons (DOM)
      if (!checkBtn) {
        checkBtn = p.createButton("Periksa Jawaban");
        resetBtn = p.createButton("Reset");

        [checkBtn, resetBtn].forEach(btn => {
          btn.parent(HOST_ID);
          btn.style("position", "absolute");
          btn.style("bottom", "14px");
          btn.style("z-index", "5");
        });

        styleBtn(checkBtn, "#2e7d32", "#ffffff");
        styleBtn(resetBtn, "#f59e0b", "#1b1b1b");

        checkBtn.mousePressed(checkAnswers);
        resetBtn.mousePressed(resetAll);

        if (hostEl) hostEl.style.position = "relative";
      }

      const btnW = 160;
      const gapBtn = 12;
      const totalBtn = btnW * 2 + gapBtn;
      const left0 = (w - totalBtn) / 2;

      setBtnSize(checkBtn, btnW);
      setBtnSize(resetBtn, btnW);

      // ✅ pakai p.height (height terbaru) biar tombol selalu pas
      checkBtn.position(left0, p.height - 54);
      resetBtn.position(left0 + btnW + gapBtn, p.height - 54);
    };

    // ---------- p5 lifecycle ----------
    p.setup = () => {
      hostEl = document.getElementById(HOST_ID);
      buildLayout();
    };

    p.windowResized = () => {
      buildLayout();
    };

    p.draw = () => {
      p.background(BG);

      p.noStroke(); p.fill(TEXT);
      p.textAlign(p.CENTER, p.TOP);
      p.textSize(26);
      p.text("🌿 Mari Mencoba: Derajat Suatu Polinomial", p.width / 2, 18);

      p.fill(MUTED);
      p.textSize(15);
      p.text("Seret angka derajat ke kotak jawaban tiap soal, lalu klik Periksa.", p.width / 2, 52);

      drawTokenPanel();

      zones.forEach(z => z.draw());

      const dragging = tokens.filter(t => t.dragging);
      const idle = tokens.filter(t => !t.dragging);
      idle.forEach(t => t.draw());
      dragging.forEach(t => t.draw());

      if (checked) {
        p.fill(TEXT);
        p.textAlign(p.CENTER, p.CENTER);
        p.textSize(18);
        p.text(`Skor: ${score} / ${zones.length}`, p.width / 2, p.height - 86);
        if (score === zones.length) confetti();
      }
    };

    // ---------- Mouse interaction ----------
    p.mousePressed = () => {
      if (p.mouseY > p.height - 80) return;

      for (let i = tokens.length - 1; i >= 0; i--) {
        if (tokens[i].contains(p.mouseX, p.mouseY)) {
          tokens[i].startDrag(p.mouseX, p.mouseY);
          const t = tokens.splice(i, 1)[0];
          tokens.push(t);
          break;
        }
      }
    };

    p.mouseDragged = () => {
      tokens.forEach(t => t.drag(p.mouseX, p.mouseY));
    };

    p.mouseReleased = () => {
      tokens.forEach(t => t.endDrag());
    };

    // ---------- Actions ----------
    const checkAnswers = () => {
      checked = true; score = 0;
      zones.forEach(z => {
        if (z.token && parseInt(z.token.value) === parseInt(z.answer)) score++;
      });
    };

    const resetAll = () => {
      checked = false; score = 0;
      zones.forEach(z => z.token = null);
      tokens.forEach(t => {
        t.zone = null;
        t.lastZone = null;
        t.x = t.home.x;
        t.y = t.home.y;
      });
    };

    // ---------- Utils ----------
    const setBtnSize = (btn, w) => {
      btn.style("width", w + "px");
      btn.style("text-align", "center");
    };

    const styleBtn = (btn, bg, fg) => {
      btn.style("background", bg);
      btn.style("color", fg);
      btn.style("border", "none");
      btn.style("border-radius", "12px");
      btn.style("padding", "10px 14px");
      btn.style("font-weight", "700");
      btn.style("cursor", "pointer");
      btn.style("box-shadow", "0 4px 10px rgba(0,0,0,0.12)");
      btn.style("font-family", "Times New Roman");
    };

    const overlapArea = (x1, y1, w1, h1, x2, y2, w2, h2) => {
      const xo = Math.max(0, Math.min(x1 + w1, x2 + w2) - Math.max(x1, x2));
      const yo = Math.max(0, Math.min(y1 + h1, y2 + h2) - Math.max(y1, y2));
      return xo * yo;
    };

    const snapToZone = (token, zone) => {
      token.x = zone.x + zone.w - token.w - 12;
      token.y = zone.y + (zone.h - token.h) / 2;

      token.zone = zone;
      token.lastZone = zone;
      zone.token = token;
    };

    const shuffleArray = (a) => {
      for (let i = a.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [a[i], a[j]] = [a[j], a[i]];
      }
    };

    const drawTokenPanel = () => {
      const x = tokenPanelX;
      const y = tokenPanelY;
      const w = tokenPanelW;
      const h = tokenPanelH;

      p.noStroke(); p.fill(0, 0, 0, 20);
      p.rect(x + 3, y + 4, w, h, 16);

      p.stroke(BORDER); p.strokeWeight(2);
      p.fill(PANEL);
      p.rect(x, y, w, h, 16);

      p.noStroke(); p.fill(MUTED);
      p.textAlign(p.CENTER, p.CENTER);
      p.textSize(15);
      p.text("Angka jawaban:", x + w / 2, y + 22);
    };

    const confetti = () => {
      for (let i = 0; i < 24; i++) {
        const x = p.random(p.width * 0.15, p.width * 0.85);
        const y = p.random(12, 90);
        p.noStroke();
        p.fill(40 + p.random(0, 100), 160 + p.random(0, 60), 80 + p.random(0, 70), 200);
        p.circle(x, y, p.random(3, 6));
      }
    };
  };

  new p5(sketch, HOST_ID);
})();