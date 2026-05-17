/* =========================================================
   Mari Mencoba: Derajat Suatu Polinomial — p5.js RESPONSIVE
   FIX:
   - Desktop/tablet besar: soal kiri, angka jawaban kanan
   - HP/tablet kecil: soal di atas, angka jawaban di bawah
   - Canvas ikut lebar parent
   - Tinggi canvas dihitung otomatis sesuai isi
   - Tombol tidak keluar dari host
   - Drag & drop tetap jalan
========================================================= */

(function () {
  const HOST_ID = "p5-interaktif-1b";

  const questions = [
    { text: "Derajat dari ( 4x⁵ )", answer: 5 },
    { text: "Derajat dari ( x²y⁷ )", answer: 9 },
    { text: "Derajat dari ( 0.12x¹ )", answer: 1 },
    { text: "Derajat dari ( 2.17x³y¹z³ )", answer: 7 },
    { text: "Derajat dari 6a²b⁴", answer: 6 },
  ];

  const BG = [232, 245, 233];
  const PANEL = [250, 255, 250];
  const TEXT = [34, 51, 34];
  const MUTED = [110, 129, 110];
  const BORDER = [168, 188, 168];
  const OK = [40, 167, 69];
  const ERR = [229, 62, 62];

  const sketch = (p) => {
    let tokens = [];
    let zones = [];
    let checkBtn;
    let resetBtn;
    let checked = false;
    let score = 0;
    let hostEl = null;

    let isMobile = false;

    let paddingX = 20;
    let startY = 92;
    let gap = 68;
    let zoneH = 56;
    let zoneW = 0;
    let zoneX = 0;

    let tokenPanelX = 0;
    let tokenPanelY = 0;
    let tokenPanelW = 0;
    let tokenPanelH = 0;

    let btnY = 0;

    const getHostWidth = () => {
      hostEl = hostEl || document.getElementById(HOST_ID);

      if (!hostEl) return 360;

      const rectW = hostEl.getBoundingClientRect().width;
      const clientW = hostEl.clientWidth;

      return Math.max(280, Math.floor(rectW || clientW || 360));
    };

    class Token {
      constructor(value, x, y) {
        this.value = value;
        this.x = x;
        this.y = y;
        this.w = 72;
        this.h = 44;
        this.dragging = false;
        this.offsetX = 0;
        this.offsetY = 0;

        this.zone = null;
        this.lastZone = null;
        this.home = p.createVector(x, y);
      }

      draw() {
        p.noStroke();
        p.fill(0, 0, 0, 35);
        p.rect(this.x + 2, this.y + 3, this.w, this.h, 10);

        p.stroke(160);
        p.strokeWeight(1.5);
        p.fill(255);
        p.rect(this.x, this.y, this.w, this.h, 10);

        p.noStroke();
        p.fill(TEXT);
        p.textAlign(p.CENTER, p.CENTER);
        p.textSize(isMobile ? 16 : 18);
        p.text(this.value, this.x + this.w / 2, this.y + this.h / 2);
      }

      contains(mx, my) {
        return (
          mx > this.x &&
          mx < this.x + this.w &&
          my > this.y &&
          my < this.y + this.h
        );
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
        if (!this.dragging) return;

        this.dragging = false;

        let bestZ = null;
        let bestArea = 0;

        for (let z of zones) {
          const overlap = overlapArea(
            this.x,
            this.y,
            this.w,
            this.h,
            z.x,
            z.y,
            z.w,
            z.h
          );

          if (overlap > bestArea) {
            bestArea = overlap;
            bestZ = z;
          }
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
        this.x = x;
        this.y = y;
        this.w = w;
        this.h = h;
        this.token = null;
      }

      draw() {
        p.noStroke();
        p.fill(0, 0, 0, 30);
        p.rect(this.x + 3, this.y + 4, this.w, this.h, 14);

        let bcol = BORDER;
        let bweight = 2;

        if (checked) {
          if (this.token && parseInt(this.token.value, 10) === parseInt(this.answer, 10)) {
            bcol = OK;
            bweight = 3;
          } else {
            bcol = ERR;
            bweight = 3;
          }
        }

        p.stroke(bcol);
        p.strokeWeight(bweight);
        p.fill(PANEL);
        p.rect(this.x, this.y, this.w, this.h, 14);

        p.noStroke();
        p.fill(TEXT);
        p.textAlign(p.LEFT, p.CENTER);
        p.textSize(isMobile ? 13 : 16);

        const answerText = this.token ? String(this.token.value) : "Seret angka";
        const answerSpace = isMobile ? 86 : 120;
        const labelMaxW = this.w - answerSpace - 24;

        drawSingleLineText(this.label, this.x + 12, this.y + this.h / 2, labelMaxW);

        p.textAlign(p.RIGHT, p.CENTER);
        p.fill(this.token ? TEXT : MUTED);
        p.textSize(isMobile ? 13 : 15);
        p.text(answerText, this.x + this.w - 12, this.y + this.h / 2);
      }
    }

    const buildLayout = () => {
      hostEl = document.getElementById(HOST_ID);
      const w = getHostWidth();

      isMobile = w < 650;
      paddingX = isMobile ? 12 : 24;
      startY = isMobile ? 86 : 96;
      zoneH = isMobile ? 58 : 56;
      gap = isMobile ? 66 : 70;

      if (!p._renderer) {
        const c = p.createCanvas(w, 600);
        c.parent(HOST_ID);
      } else {
        p.resizeCanvas(w, p.height);
      }

      if (hostEl) {
        hostEl.style.position = "relative";
        hostEl.style.width = "100%";
        hostEl.style.maxWidth = "100%";
        hostEl.style.overflow = "hidden";
        hostEl.style.boxSizing = "border-box";
      }

      zones = [];

      if (isMobile) {
        zoneX = paddingX;
        zoneW = w - paddingX * 2;

        for (let i = 0; i < questions.length; i++) {
          zones.push(
            new Zone(
              `${i + 1}. ${questions[i].text} → Derajat =`,
              questions[i].answer,
              zoneX,
              startY + i * gap,
              zoneW,
              zoneH
            )
          );
        }

        const zonesBottom = zones[zones.length - 1].y + zoneH;

        tokenPanelX = paddingX;
        tokenPanelY = zonesBottom + 22;
        tokenPanelW = w - paddingX * 2;
        tokenPanelH = 130;
      } else {
        const sideGap = 18;

        tokenPanelW = Math.min(240, Math.max(190, w * 0.24));
        zoneX = paddingX;
        zoneW = w - paddingX * 2 - tokenPanelW - sideGap;

        zoneW = Math.max(360, zoneW);

        for (let i = 0; i < questions.length; i++) {
          zones.push(
            new Zone(
              `${i + 1}. ${questions[i].text}   →  Derajat =`,
              questions[i].answer,
              zoneX,
              startY + i * gap,
              zoneW,
              zoneH
            )
          );
        }

        tokenPanelX = zoneX + zoneW + sideGap;
        tokenPanelY = startY;
        tokenPanelH = zones[zones.length - 1].y + zoneH - startY;
      }

      const contentBottom = Math.max(
        zones[zones.length - 1].y + zoneH,
        tokenPanelY + tokenPanelH
      );

      const scoreSpace = checked ? 42 : 12;
      const buttonSpace = 74;
      const neededH = Math.ceil(contentBottom + scoreSpace + buttonSpace);

      p.resizeCanvas(w, neededH);

      if (hostEl) {
        hostEl.style.height = neededH + "px";
      }

      relayoutTokens();
      setupButtons();
    };

    const relayoutTokens = () => {
      const tokenValues = [5, 9, 1, 7, 6];

      if (tokens.length === 0) {
        shuffleArray(tokenValues);
        tokens = tokenValues.map((v) => new Token(v, 0, 0));
      }

      const tokenW = isMobile ? 60 : 72;
      const tokenH = isMobile ? 40 : 44;
      const gapT = isMobile ? 10 : 16;

      tokens.forEach((t) => {
        t.w = tokenW;
        t.h = tokenH;
      });

      let cols;

      if (isMobile) {
        cols = Math.min(tokens.length, Math.max(2, Math.floor((tokenPanelW - 24 + gapT) / (tokenW + gapT))));
      } else {
        const availableH = Math.max(1, tokenPanelH - 54);
        const rowsByHeight = Math.max(1, Math.floor((availableH + gapT) / (tokenH + gapT)));
        cols = Math.ceil(tokens.length / rowsByHeight);
        cols = Math.min(2, Math.max(1, cols));
      }

      const rows = Math.ceil(tokens.length / cols);
      const gridW = cols * tokenW + (cols - 1) * gapT;
      const gridH = rows * tokenH + (rows - 1) * gapT;

      const baseX = tokenPanelX + (tokenPanelW - gridW) / 2;
      const baseY = isMobile
        ? tokenPanelY + 48 + (tokenPanelH - 58 - gridH) / 2
        : tokenPanelY + 48 + (tokenPanelH - 54 - gridH) / 2;

      tokens.forEach((t, i) => {
        const c = i % cols;
        const r = Math.floor(i / cols);
        const x = baseX + c * (tokenW + gapT);
        const y = baseY + r * (tokenH + gapT);

        t.home.set(x, y);

        if (!t.dragging && !t.zone) {
          t.x = x;
          t.y = y;
        }
      });

      zones.forEach((z) => {
        if (z.token) {
          snapToZone(z.token, z);
        }
      });
    };

    const setupButtons = () => {
      if (!checkBtn) {
        checkBtn = p.createButton("Periksa Jawaban");
        resetBtn = p.createButton("Reset");

        [checkBtn, resetBtn].forEach((btn) => {
          btn.parent(HOST_ID);
          btn.style("position", "absolute");
          btn.style("z-index", "5");
          btn.style("box-sizing", "border-box");
        });

        styleBtn(checkBtn, "#2e7d32", "#ffffff");
        styleBtn(resetBtn, "#f59e0b", "#1b1b1b");

        checkBtn.mousePressed(checkAnswers);
        resetBtn.mousePressed(resetAll);
      }

      const w = p.width;

      if (isMobile) {
        const btnW = Math.max(120, (w - paddingX * 2 - 10) / 2);
        const gapBtn = 10;
        const left0 = paddingX;
        btnY = p.height - 58;

        setBtnSize(checkBtn, btnW, 14);
        setBtnSize(resetBtn, btnW, 14);

        checkBtn.position(left0, btnY);
        resetBtn.position(left0 + btnW + gapBtn, btnY);
      } else {
        const btnW = 160;
        const gapBtn = 12;
        const totalBtn = btnW * 2 + gapBtn;
        const left0 = (w - totalBtn) / 2;
        btnY = p.height - 54;

        setBtnSize(checkBtn, btnW, 15);
        setBtnSize(resetBtn, btnW, 15);

        checkBtn.position(left0, btnY);
        resetBtn.position(left0 + btnW + gapBtn, btnY);
      }
    };

    p.setup = () => {
      hostEl = document.getElementById(HOST_ID);
      buildLayout();

      setTimeout(() => {
        buildLayout();
      }, 100);
    };

    p.windowResized = () => {
      buildLayout();
    };

    p.draw = () => {
      p.background(BG);

      p.noStroke();
      p.fill(TEXT);
      p.textAlign(p.CENTER, p.TOP);
      p.textSize(isMobile ? 18 : 26);

      const title = isMobile
        ? "Mari Mencoba"
        : "🌿 Mari Mencoba: Derajat Suatu Polinomial";

      p.text(title, p.width / 2, isMobile ? 14 : 18);

      p.fill(MUTED);
      p.textSize(isMobile ? 12 : 15);

      const subtitle = isMobile
        ? "Seret angka ke kotak jawaban."
        : "Seret angka derajat ke kotak jawaban tiap soal, lalu klik Periksa.";

      p.text(subtitle, p.width / 2, isMobile ? 43 : 52);

      drawTokenPanel();

      zones.forEach((z) => z.draw());

      const idle = tokens.filter((t) => !t.dragging);
      const dragging = tokens.filter((t) => t.dragging);

      idle.forEach((t) => t.draw());
      dragging.forEach((t) => t.draw());

      if (checked) {
        p.fill(TEXT);
        p.textAlign(p.CENTER, p.CENTER);
        p.textSize(isMobile ? 15 : 18);
        p.text(`Skor: ${score} / ${zones.length}`, p.width / 2, p.height - 86);

        if (score === zones.length) {
          confetti();
        }
      }
    };

    p.mousePressed = () => {
      if (p.mouseY > p.height - 75) return;

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
      tokens.forEach((t) => t.drag(p.mouseX, p.mouseY));
    };

    p.mouseReleased = () => {
      tokens.forEach((t) => t.endDrag());
    };

    p.touchStarted = () => {
      p.mousePressed();
      return false;
    };

    p.touchMoved = () => {
      p.mouseDragged();
      return false;
    };

    p.touchEnded = () => {
      p.mouseReleased();
      return false;
    };

    const checkAnswers = () => {
      checked = true;
      score = 0;

      zones.forEach((z) => {
        if (z.token && parseInt(z.token.value, 10) === parseInt(z.answer, 10)) {
          score++;
        }
      });

      buildLayout();
    };

    const resetAll = () => {
      checked = false;
      score = 0;

      zones.forEach((z) => {
        z.token = null;
      });

      tokens.forEach((t) => {
        t.zone = null;
        t.lastZone = null;
        t.x = t.home.x;
        t.y = t.home.y;
      });

      buildLayout();
    };

    const setBtnSize = (btn, w, fontSize) => {
      btn.style("width", w + "px");
      btn.style("text-align", "center");
      btn.style("font-size", fontSize + "px");
      btn.style("white-space", "nowrap");
    };

    const styleBtn = (btn, bg, fg) => {
      btn.style("background", bg);
      btn.style("color", fg);
      btn.style("border", "none");
      btn.style("border-radius", "12px");
      btn.style("padding", "10px 12px");
      btn.style("font-weight", "700");
      btn.style("cursor", "pointer");
      btn.style("box-shadow", "0 4px 10px rgba(0,0,0,0.12)");
      btn.style("font-family", "Times New Roman, Times, serif");
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

      p.noStroke();
      p.fill(0, 0, 0, 20);
      p.rect(x + 3, y + 4, w, h, 16);

      p.stroke(BORDER);
      p.strokeWeight(2);
      p.fill(PANEL);
      p.rect(x, y, w, h, 16);

      p.noStroke();
      p.fill(MUTED);
      p.textAlign(p.CENTER, p.CENTER);
      p.textSize(isMobile ? 13 : 15);
      p.text("Angka jawaban:", x + w / 2, y + 24);
    };

    const drawSingleLineText = (txt, x, y, maxW) => {
      let out = txt;

      while (p.textWidth(out) > maxW && out.length > 4) {
        out = out.slice(0, -2);
      }

      if (out !== txt) {
        out = out.slice(0, -3) + "...";
      }

      p.text(out, x, y);
    };

    const confetti = () => {
      for (let i = 0; i < 24; i++) {
        const x = p.random(p.width * 0.15, p.width * 0.85);
        const y = p.random(12, 90);

        p.noStroke();
        p.fill(
          40 + p.random(0, 100),
          160 + p.random(0, 60),
          80 + p.random(0, 70),
          200
        );
        p.circle(x, y, p.random(3, 6));
      }
    };
  };

  const init = () => {
    const host = document.getElementById(HOST_ID);

    if (!host) return;

    if (host.dataset.p5Loaded === "1") return;

    host.dataset.p5Loaded = "1";
    new p5(sketch, HOST_ID);
  };

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();