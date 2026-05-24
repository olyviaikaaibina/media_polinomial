/* =========================================================
   Mari Mencoba: Derajat Suatu Polinomial — p5.js RESPONSIVE
   FIX FINAL:
   - Jawaban benar:
     1 = 5
     2 = 9
     3 = 1
     4 = 7
     5 = 6
   - Benar = hijau
   - Salah/kosong = merah
   - Angka jawaban diacak di panel jawaban
   - Bisa drag & drop di HP, tablet, laptop/PC
   - Scroll halaman HP tetap bisa saat sentuh area kosong
   - FIX: hasil/skor diletakkan di bawah kotak no. 5 dan di atas tombol
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

  const answerTokens = [5, 9, 1, 7, 6];

  const BG = [232, 245, 233];
  const PANEL = [250, 255, 250];
  const TEXT = [34, 51, 34];
  const MUTED = [110, 129, 110];
  const BORDER = [168, 188, 168];

  const OK = [40, 167, 69];
  const OK_SOFT = [232, 248, 237];

  const ERR = [229, 62, 62];
  const ERR_SOFT = [255, 235, 235];

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
    let gap = 80;
    let zoneH = 70;
    let zoneW = 0;
    let zoneX = 0;

    let tokenPanelX = 0;
    let tokenPanelY = 0;
    let tokenPanelW = 0;
    let tokenPanelH = 0;

    let resultY = 0;
    let btnYFinal = 0;

    let touchBound = false;

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

        this.zoneIndex = null;
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
        p.text(String(this.value), this.x + this.w / 2, this.y + this.h / 2);
      }

      contains(mx, my) {
        return (
          mx >= this.x &&
          mx <= this.x + this.w &&
          my >= this.y &&
          my <= this.y + this.h
        );
      }

      startDrag(mx, my) {
        checked = false;
        score = 0;

        this.dragging = true;
        this.offsetX = mx - this.x;
        this.offsetY = my - this.y;

        if (this.zoneIndex !== null && zones[this.zoneIndex]) {
          zones[this.zoneIndex].token = null;
        }

        this.zoneIndex = null;
      }

      drag(mx, my) {
        if (!this.dragging) return;

        this.x = mx - this.offsetX;
        this.y = my - this.offsetY;

        this.x = p.constrain(this.x, 0, p.width - this.w);
        this.y = p.constrain(this.y, 0, p.height - this.h - 70);
      }

      endDrag() {
        if (!this.dragging) return;

        this.dragging = false;

        let bestZone = null;
        let bestArea = 0;

        zones.forEach((z) => {
          const area = overlapArea(
            this.x,
            this.y,
            this.w,
            this.h,
            z.x,
            z.y,
            z.w,
            z.h
          );

          if (area > bestArea) {
            bestArea = area;
            bestZone = z;
          }
        });

        if (bestZone && bestArea > 10) {
          if (bestZone.token && bestZone.token !== this) {
            const oldToken = bestZone.token;
            oldToken.zoneIndex = null;
            returnToHome(oldToken);
          }

          snapToZone(this, bestZone);
        } else {
          returnToHome(this);
        }
      }
    }

    class Zone {
      constructor(index, label, answer, x, y, w, h) {
        this.index = index;
        this.label = label;
        this.answer = answer;
        this.x = x;
        this.y = y;
        this.w = w;
        this.h = h;
        this.token = null;
      }

      isCorrect() {
        if (!this.token) return false;
        return parseInt(this.token.value, 10) === parseInt(this.answer, 10);
      }

      draw() {
        const correct = this.isCorrect();

        p.noStroke();
        p.fill(0, 0, 0, 30);
        p.rect(this.x + 3, this.y + 4, this.w, this.h, 14);

        let borderColor = BORDER;
        let fillColor = PANEL;
        let borderWeight = 2;

        if (checked) {
          if (correct) {
            borderColor = OK;
            fillColor = OK_SOFT;
            borderWeight = 4;
          } else {
            borderColor = ERR;
            fillColor = ERR_SOFT;
            borderWeight = 4;
          }
        }

        p.stroke(borderColor);
        p.strokeWeight(borderWeight);
        p.fill(fillColor);
        p.rect(this.x, this.y, this.w, this.h, 14);

        const answerText = this.token ? String(this.token.value) : "Seret angka";
        const answerSpace = isMobile ? 98 : 135;
        const labelMaxW = this.w - answerSpace - 30;

        p.noStroke();
        p.fill(TEXT);
        p.textAlign(p.LEFT, p.CENTER);
        p.textSize(isMobile ? 12.5 : 15);

        drawWrappedText(
          this.label,
          this.x + 12,
          this.y + this.h / 2,
          labelMaxW,
          isMobile ? 16 : 18,
          2
        );

        p.textAlign(p.RIGHT, p.CENTER);

        if (checked) {
          p.fill(correct ? OK : ERR);
        } else {
          p.fill(this.token ? TEXT : MUTED);
        }

        p.textSize(isMobile ? 13 : 15);
        p.text(answerText, this.x + this.w - 12, this.y + this.h / 2);

        if (checked) {
          p.textSize(isMobile ? 17 : 19);
          p.text(correct ? "✓" : "×", this.x + this.w - 12, this.y + 18);
        }
      }
    }

    const buildLayout = () => {
      hostEl = document.getElementById(HOST_ID);
      const w = getHostWidth();

      isMobile = w < 650;

      paddingX = isMobile ? 12 : 24;
      startY = isMobile ? 86 : 96;

      zoneH = isMobile ? 78 : 70;
      gap = isMobile ? 88 : 82;

      if (!p._renderer) {
        const c = p.createCanvas(w, 600);
        c.parent(HOST_ID);
      } else {
        p.resizeCanvas(w, p.height);
      }

      setupCanvasTouch();

      if (hostEl) {
        hostEl.style.position = "relative";
        hostEl.style.width = "100%";
        hostEl.style.maxWidth = "100%";
        hostEl.style.overflow = "hidden";
        hostEl.style.boxSizing = "border-box";
        hostEl.style.touchAction = "pan-y";
        hostEl.style.userSelect = "none";
        hostEl.style.webkitUserSelect = "none";
      }

      zones = [];

      if (isMobile) {
        zoneX = paddingX;
        zoneW = w - paddingX * 2;

        for (let i = 0; i < questions.length; i++) {
          zones.push(
            new Zone(
              i,
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
        tokenPanelH = 132;
      } else {
        const sideGap = 18;

        tokenPanelW = Math.min(240, Math.max(190, w * 0.24));
        zoneX = paddingX;
        zoneW = w - paddingX * 2 - tokenPanelW - sideGap;
        zoneW = Math.max(360, zoneW);

        for (let i = 0; i < questions.length; i++) {
          zones.push(
            new Zone(
              i,
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

      const zonesBottom = zones[zones.length - 1].y + zoneH;
      const contentBottom = Math.max(zonesBottom, tokenPanelY + tokenPanelH);

      /*
        HASIL DIBUAT AREA SENDIRI:
        posisinya di bawah kotak terakhir/token panel,
        dan tombol berada di bawah hasil.
      */
      resultY = contentBottom + 34;

      const resultAreaH = checked ? 70 : 18;
      const buttonGap = 18;
      btnYFinal = contentBottom + resultAreaH + buttonGap;

      const neededH = Math.ceil(btnYFinal + 58);

      p.resizeCanvas(w, neededH);

      if (hostEl) {
        hostEl.style.height = neededH + "px";
      }

      relayoutTokens();
      restoreTokenZones();
      setupButtons();
    };

    const setupCanvasTouch = () => {
      if (!p.canvas) return;

      const canvasEl = p.canvas;

      canvasEl.style.width = "100%";
      canvasEl.style.height = "auto";
      canvasEl.style.display = "block";
      canvasEl.style.touchAction = "pan-y";
      canvasEl.style.userSelect = "none";
      canvasEl.style.webkitUserSelect = "none";

      if (touchBound) return;
      touchBound = true;

      canvasEl.addEventListener(
        "touchstart",
        function (e) {
          const touch = e.touches && e.touches[0];
          if (!touch) return;

          const pos = getTouchPos(touch);

          if (pos.y > btnYFinal - 8) return;

          for (let i = tokens.length - 1; i >= 0; i--) {
            if (tokens[i].contains(pos.x, pos.y)) {
              e.preventDefault();

              tokens[i].startDrag(pos.x, pos.y);

              const t = tokens.splice(i, 1)[0];
              tokens.push(t);

              return;
            }
          }
        },
        { passive: false }
      );

      canvasEl.addEventListener(
        "touchmove",
        function (e) {
          const activeToken = tokens.find((t) => t.dragging);

          if (!activeToken) return;

          const touch = e.touches && e.touches[0];
          if (!touch) return;

          e.preventDefault();

          const pos = getTouchPos(touch);
          activeToken.drag(pos.x, pos.y);
        },
        { passive: false }
      );

      canvasEl.addEventListener(
        "touchend",
        function (e) {
          const activeToken = tokens.find((t) => t.dragging);

          if (!activeToken) return;

          e.preventDefault();
          activeToken.endDrag();
        },
        { passive: false }
      );

      canvasEl.addEventListener(
        "touchcancel",
        function (e) {
          const activeToken = tokens.find((t) => t.dragging);

          if (!activeToken) return;

          e.preventDefault();
          activeToken.endDrag();
        },
        { passive: false }
      );
    };

    const getTouchPos = (touch) => {
      const rect = p.canvas.getBoundingClientRect();
      const scaleX = p.width / rect.width;
      const scaleY = p.height / rect.height;

      return {
        x: (touch.clientX - rect.left) * scaleX,
        y: (touch.clientY - rect.top) * scaleY,
      };
    };

    const relayoutTokens = () => {
      if (tokens.length === 0) {
        const shuffled = shuffleArray([...answerTokens]);
        tokens = shuffled.map((v) => new Token(v, 0, 0));
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
        cols = Math.min(
          tokens.length,
          Math.max(2, Math.floor((tokenPanelW - 24 + gapT) / (tokenW + gapT)))
        );
      } else {
        const availableH = Math.max(1, tokenPanelH - 54);
        const rowsByHeight = Math.max(
          1,
          Math.floor((availableH + gapT) / (tokenH + gapT))
        );

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

        if (!t.dragging && t.zoneIndex === null) {
          t.x = x;
          t.y = y;
        }
      });
    };

    const restoreTokenZones = () => {
      zones.forEach((z) => {
        z.token = null;
      });

      tokens.forEach((t) => {
        if (t.zoneIndex !== null && zones[t.zoneIndex]) {
          snapToZone(t, zones[t.zoneIndex]);
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

        setBtnSize(checkBtn, btnW, 14);
        setBtnSize(resetBtn, btnW, 14);

        checkBtn.position(left0, btnYFinal);
        resetBtn.position(left0 + btnW + gapBtn, btnYFinal);
      } else {
        const btnW = 160;
        const gapBtn = 12;
        const totalBtn = btnW * 2 + gapBtn;
        const left0 = (w - totalBtn) / 2;

        setBtnSize(checkBtn, btnW, 15);
        setBtnSize(resetBtn, btnW, 15);

        checkBtn.position(left0, btnYFinal);
        resetBtn.position(left0 + btnW + gapBtn, btnYFinal);
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

      const idleTokens = tokens.filter((t) => !t.dragging);
      const draggingTokens = tokens.filter((t) => t.dragging);

      idleTokens.forEach((t) => t.draw());
      draggingTokens.forEach((t) => t.draw());

      drawResultArea();
    };

    const drawResultArea = () => {
      if (!checked) return;

      p.noStroke();
      p.textAlign(p.CENTER, p.CENTER);

      if (score === zones.length) {
        p.fill(OK);
        p.textSize(isMobile ? 14 : 17);
        p.text("Semua jawaban benar!", p.width / 2, resultY);
      }

      p.fill(TEXT);
      p.textSize(isMobile ? 15 : 18);
      p.text(`Skor: ${score} / ${zones.length}`, p.width / 2, resultY + 28);

      if (score === zones.length) {
        confetti();
      }
    };

    p.mousePressed = () => {
      if (p.mouseY > btnYFinal - 8) return;

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
      tokens.forEach((t) => {
        if (t.dragging) {
          t.drag(p.mouseX, p.mouseY);
        }
      });
    };

    p.mouseReleased = () => {
      tokens.forEach((t) => {
        if (t.dragging) {
          t.endDrag();
        }
      });
    };

    const checkAnswers = () => {
      checked = true;
      score = 0;

      zones.forEach((z) => {
        if (z.isCorrect()) {
          score++;
        }
      });

      /*
        Rebuild layout setelah checked=true supaya area hasil muncul
        di bawah kotak no.5 dan tombol turun ke bawah.
      */
      buildLayout();
    };

    const resetAll = () => {
      checked = false;
      score = 0;

      zones.forEach((z) => {
        z.token = null;
      });

      const shuffled = shuffleArray([...answerTokens]);

      tokens = shuffled.map((v) => new Token(v, 0, 0));

      buildLayout();
    };

    const returnToHome = (token) => {
      token.zoneIndex = null;
      token.x = token.home.x;
      token.y = token.home.y;
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

      token.zoneIndex = zone.index;
      zone.token = token;
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

    const drawWrappedText = (txt, x, centerY, maxW, lineH, maxLines) => {
      const words = txt.split(" ");
      const lines = [];
      let line = "";

      for (let i = 0; i < words.length; i++) {
        const testLine = line ? line + " " + words[i] : words[i];

        if (p.textWidth(testLine) <= maxW) {
          line = testLine;
        } else {
          if (line) lines.push(line);
          line = words[i];
        }
      }

      if (line) lines.push(line);

      const finalLines = lines.slice(0, maxLines);

      if (lines.length > maxLines) {
        let last = finalLines[maxLines - 1];

        while (p.textWidth(last + "...") > maxW && last.length > 3) {
          last = last.slice(0, -1);
        }

        finalLines[maxLines - 1] = last + "...";
      }

      const totalH = finalLines.length * lineH;
      const startTextY = centerY - totalH / 2 + lineH / 2;

      finalLines.forEach((ln, idx) => {
        p.text(ln, x, startTextY + idx * lineH);
      });
    };

    const shuffleArray = (arr) => {
      const a = [...arr];

      for (let i = a.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [a[i], a[j]] = [a[j], a[i]];
      }

      return a;
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