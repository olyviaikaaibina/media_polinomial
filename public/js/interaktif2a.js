// interaktif2a.js
// =========================
// LATIHAN POLINOMIAL (p5.js) + KaTeX (EMBED READY)
// - Soal bersusun pakai KaTeX (stabil, margin rapi)
// - UI center dalam satu kolom
// - Locked: MUDAH -> SEDANG -> SUSAH
// - Aman di-embed ke Blade: parent ke #p5-latihan
// =========================

(() => {
  const LEVELS = [
    {
      title: "MUDAH",
      subtitle: "Linear (y)",
      accent: [86, 192, 108],
      soft: [242, 251, 244],
      a: "6y - 4",
      b: "3y + 10",
      canonical: "9y + 6",
    },
    {
      title: "SEDANG",
      subtitle: "Kuadrat (x^2)",
      accent: [91, 155, 213],
      soft: [245, 249, 255],
      a: "2x^2 + 3x - 5",
      b: "4x^2 - x + 1",
      canonical: "6x^2 + 2x - 4",
    },
    {
      title: "SUSAH",
      subtitle: "Kubik (x^3)",
      accent: [224, 112, 43],
      soft: [255, 246, 240],
      a: "7x^3 - 2x + 9",
      b: "5x^3 + 8x - 3",
      canonical: "12x^3 + 6x + 6",
    },
  ];

  // --- KaTeX loader (gunakan KaTeX yang sudah ada jika Blade sudah load)
  function loadKaTeX(done, fail) {
    if (window.katex && window.katex.renderToString) {
      done && done();
      return;
    }

    const cssId = "katex-css";
    const jsId = "katex-js";

    if (!document.getElementById(cssId)) {
      const link = document.createElement("link");
      link.id = cssId;
      link.rel = "stylesheet";
      link.href = "https://cdn.jsdelivr.net/npm/katex@0.16.10/dist/katex.min.css";
      link.crossOrigin = "anonymous";
      document.head.appendChild(link);
    }

    if (document.getElementById(jsId)) {
      // tunggu sampai tersedia
      const tick = setInterval(() => {
        if (window.katex && window.katex.renderToString) {
          clearInterval(tick);
          done && done();
        }
      }, 50);
      setTimeout(() => {
        clearInterval(tick);
        if (!(window.katex && window.katex.renderToString)) fail && fail();
      }, 4000);
      return;
    }

    const script = document.createElement("script");
    script.id = jsId;
    script.src = "https://cdn.jsdelivr.net/npm/katex@0.16.10/dist/katex.min.js";
    script.crossOrigin = "anonymous";
    script.onload = () => done && done();
    script.onerror = () => fail && fail();
    document.head.appendChild(script);
  }

  // --- util
  function escapeHtml(s) {
    return String(s)
      .replaceAll("&", "&amp;")
      .replaceAll("<", "&lt;")
      .replaceAll(">", "&gt;")
      .replaceAll('"', "&quot;")
      .replaceAll("'", "&#039;");
  }

  function detectVar(card) {
    return card.a.includes("y") || card.b.includes("y") ? "y" : "x";
  }

  function addCoef(map, pow, coef) {
    map.set(pow, (map.get(pow) || 0) + coef);
    if (map.get(pow) === 0) map.delete(pow);
  }

  // normalisasi supaya input user bisa dibandingkan dengan canonical
  function normalizePoly(raw, variable) {
    if (!raw) return "";
    let s = String(raw).toLowerCase();

    s = s.replace(/\s+/g, "");
    s = s.replace(/–|−/g, "-");
    s = s.replace(/×/g, "*");
    s = s.replace(/([a-z])(\d+)/g, "$1^$2"); // x2 -> x^2

    if (s.includes("=")) s = s.split("=").pop();

    const otherVar = variable === "x" ? "y" : "x";
    if (s.includes(otherVar)) return "";

    // biar parsing konsisten
    if (!s.startsWith("+") && !s.startsWith("-")) s = "+" + s;

    const terms = s.match(/[+\-][^+\-]+/g);
    if (!terms) return "";

    const map = new Map();

    for (const t of terms) {
      const sign = t[0] === "-" ? -1 : 1;
      const body = t.slice(1);

      if (!body.includes(variable)) {
        const num = parseInt(body, 10);
        if (Number.isNaN(num)) return "";
        addCoef(map, 0, sign * num);
        continue;
      }

      // bentuk: 3x^2, x^2, 4x, x
      const re = new RegExp(`^(\\d*)${variable}(\\^(\\d+))?$`);
      const m = body.match(re);
      if (!m) return "";

      const coefStr = m[1];
      const powStr = m[3];

      let coef = coefStr ? parseInt(coefStr, 10) : 1;
      if (Number.isNaN(coef)) return "";
      coef *= sign;

      let pow = powStr ? parseInt(powStr, 10) : 1;
      if (Number.isNaN(pow)) return "";

      addCoef(map, pow, coef);
    }

    const powers = Array.from(map.keys()).sort((a, b) => b - a);
    let out = "";
    for (const p of powers) {
      const c = map.get(p);
      if (!c) continue;

      const sign = c < 0 ? "-" : "+";
      const abs = Math.abs(c);

      let term = "";
      if (p === 0) term = String(abs);
      else if (p === 1) term = (abs === 1 ? "" : String(abs)) + variable;
      else term = (abs === 1 ? "" : String(abs)) + variable + "^" + p;

      if (!out) out = (c < 0 ? "-" : "") + term;
      else out += sign + term;
    }

    return out || "0";
  }

  function prettyPoly(canonicalWithSpaces) {
    let s = String(canonicalWithSpaces).replace(/\s+/g, "");
    s = s.replace(/\+/g, " + ").replace(/\-/g, " - ");
    s = s.replace(/^ \+ /, "");
    s = s.replace(/^ \- /, "-");
    return s.trim();
  }

  // "2x^2 + 3x - 5" -> "2x^{2}+3x-5"
  function polyToLatex(s) {
    let t = String(s).trim();
    t = t.replace(/–|−/g, "-");
    t = t.replace(/\s+/g, "");
    t = t.replace(/([a-z])(\d+)/g, "$1^$2"); // x2 -> x^2
    // ubah ^2 -> ^{2}
    t = t.replace(/\^(\d+)/g, "^{\$1}");
    return t;
  }

  // =========================
  // p5 Instance (embed safe)
  // =========================
  new p5((p) => {
    let hostEl;

    // state
    let cards = [];
    let active = -1;
    let katexReady = false;

    // DOM UI (p5 dom)
    let inp, btnCheck, btnReset, badge;
    let problemDiv, katexStatus;

    // layout cache
    let panelCache = null;

    function ensureHost() {
      hostEl = document.getElementById("p5-latihan");
      return !!hostEl;
    }

    function injectLocalCSS() {
      const id = "interaktif2a-style";
      if (document.getElementById(id)) return;

      const style = document.createElement("style");
      style.id = id;
      style.textContent = `
        #p5-latihan { position: relative; }
        #p5-latihan canvas { display:block; max-width:100%; height:auto; margin:0 auto; }
        #p5-latihan .p5ui { font-family:"Times New Roman", Times, serif; }
        #p5-latihan input {
          font-family:"Times New Roman", Times, serif;
          font-size:16px;
          padding:10px 12px;
          border-radius:12px;
          border:1px solid rgba(0,0,0,.20);
          outline:none;
          box-sizing:border-box;
        }
        #p5-latihan button{
          font-family:"Times New Roman", Times, serif;
          font-weight:900;
          font-size:16px;
          padding:10px 14px;
          border-radius:12px;
          border:1px solid rgba(0,0,0,.16);
          background:#fff;
          cursor:pointer;
          line-height:1;
        }
        #p5-latihan .badge{
          display:inline-flex;
          align-items:center;
          justify-content:center;
          font-family:"Times New Roman", Times, serif;
          font-weight:900;
          font-size:14px;
          padding:10px 12px;
          border-radius:12px;
          line-height:1;
          user-select:none;
          white-space:nowrap;
        }
        #p5-latihan .badge.ok { color:#0f5f22; background:rgba(27,122,42,.10); border:1px solid rgba(27,122,42,.18); }
        #p5-latihan .badge.no { color:#8c2b00; background:rgba(224,112,43,.10); border:1px solid rgba(224,112,43,.18); }
        #p5-latihan .badge.neutral { color:#111; background:transparent; border:1px solid transparent; }

        #p5-latihan .katex-wrap{
          position:absolute;
          display:flex;
          align-items:center;
          justify-content:center;
          text-align:center;
          user-select:none;
          pointer-events:none;
        }
        #p5-latihan .katex-status{
          position:absolute;
          font-family:"Times New Roman", Times, serif;
          font-weight:900;
          font-size:14px;
          color:rgba(0,0,0,.55);
          user-select:none;
          pointer-events:none;
        }
      `;
      document.head.appendChild(style);
    }

    // =========================
    // Locked logic
    // =========================
    function isUnlocked(i) {
      if (i === 0) return true;
      return cards[i - 1].solved === true;
    }

    function nextRequiredIndex() {
      for (let i = 0; i < cards.length; i++) {
        if (isUnlocked(i) && !cards[i].solved) return i;
      }
      return cards.length - 1;
    }

    // =========================
    // Layout
    // =========================
    function layoutCards() {
      const pad = 18;
      const gap = 14;
      const topY = 95;
      const cardH = 120;

      const wAvail = p.width - pad * 2 - gap * 2;
      const cardW = wAvail / 3;

      cards.forEach((c, idx) => {
        c.x = pad + idx * (cardW + gap);
        c.y = topY;
        c.w = cardW;
        c.h = cardH;
      });
    }

    function getPanelRect() {
      // panel tinggi tetap, tapi aman responsive
      return { x: 18, y: 230, w: p.width - 36, h: 310 };
    }

    function getColumn(panel) {
      const colW = Math.min(640, panel.w - 60);
      const colX = panel.x + (panel.w - colW) / 2;
      return { colX, colW };
    }

    // =========================
    // UI creation
    // =========================
    function styleBtn(b) {
      // sudah di CSS, tapi aman
      b.addClass("p5btn");
    }

    function clearBadge() {
      badge.html("");
      badge.removeClass("ok");
      badge.removeClass("no");
      badge.addClass("neutral");
    }

    function setBadge(ok, text) {
      badge.html(text || (ok ? "Benar ✅" : "Belum tepat ❌"));
      badge.removeClass("neutral");
      badge.removeClass("ok");
      badge.removeClass("no");
      badge.addClass(ok ? "ok" : "no");
    }

    function openLevel(card) {
      clearBadge();

      if (!isUnlocked(card.i)) {
        const idx = nextRequiredIndex();
        active = idx;
        card = cards[active];
        setBadge(false, `Kerjakan dulu: ${card.title}`);
      }

      if (card.solved) {
        inp.value(prettyPoly(card.canonical));
        inp.attribute("disabled", true);
        setBadge(true, "Benar ✅ (Terkunci)");
      } else {
        inp.removeAttribute("disabled");
        inp.value("");
      }

      renderProblem(card);
    }

    function checkAnswer() {
      if (active === -1) return;

      if (!isUnlocked(active)) {
        const idx = nextRequiredIndex();
        active = idx;
        openLevel(cards[active]);
        setBadge(false, `Kerjakan dulu: ${cards[idx].title}`);
        return;
      }

      const card = cards[active];
      if (card.solved) return;

      const v = detectVar(card);
      const user = normalizePoly(inp.value(), v);
      const expected = normalizePoly(card.canonical, v);

      const ok = user && user === expected;

      if (ok) {
        setBadge(true, "Benar ✅");
        inp.value(prettyPoly(card.canonical));
        inp.attribute("disabled", true);
        card.solved = true;

        if (active < cards.length - 1) {
          active++;
          openLevel(cards[active]);
          setBadge(true, `Berhasil! Sekarang: ${cards[active].title}`);
        } else {
          setBadge(true, "Semua selesai 🎉");
        }
      } else {
        setBadge(false, "Belum tepat ❌");
      }
    }

    function resetPanel() {
      if (active === -1) return;
      const card = cards[active];
      card.solved = false;
      inp.removeAttribute("disabled");
      inp.value("");
      clearBadge();
      renderProblem(card);
    }

    function positionUI() {
      if (active === -1) return;
      if (!panelCache) return;

      const panel = panelCache;
      const col = panel._col;

      const inputX = col.colX;
      const inputY = panel.y + 210;

      inp.position(inputX, inputY);
      inp.size(col.colW, 40);

      const btnY = inputY + 56;
      btnCheck.position(inputX, btnY);
      btnReset.position(inputX + 92, btnY);

      badge.position(inputX + 188, btnY);
    }

    function positionProblem() {
      if (active === -1) return;
      if (!panelCache) return;

      const panel = panelCache;
      const col = panel._col;

      const qBox = panel._qBox || {
        x: col.colX,
        y: panel.y + 78,
        w: col.colW,
        h: 96,
      };

      problemDiv.position(qBox.x + 12, qBox.y + 10);
      problemDiv.style("width", `${qBox.w - 24}px`);
      problemDiv.style("height", `${qBox.h - 20}px`);

      if (!katexReady) {
        katexStatus.position(qBox.x + 16, qBox.y + 14);
        katexStatus.show();
      } else {
        katexStatus.hide();
      }
    }

    function showPanelUI() {
      inp.show();
      btnCheck.show();
      btnReset.show();
      badge.show();
      problemDiv.show();
    }

    function hidePanelUI() {
      inp.hide();
      btnCheck.hide();
      btnReset.hide();
      badge.hide();
      problemDiv.hide();
      katexStatus.hide();
    }

    // =========================
    // KaTeX render
    // =========================
    function renderProblem(card) {
      if (!card) return;

      // fallback kalau KaTeX belum ready
      if (!katexReady || !(window.katex && window.katex.renderToString)) {
        problemDiv.html(
          `<div style="font-family:Times New Roman;font-weight:900;font-size:20px;line-height:1.2">
            ${escapeHtml(card.a)}<br/>+ ${escapeHtml(card.b)}
          </div>`
        );
        return;
      }

      const a = polyToLatex(card.a);
      const b = polyToLatex(card.b);

      const tex = String.raw`
\begin{array}{r r}
\phantom{+} & \displaystyle ${a} \\
+ & \displaystyle ${b} \\
\hline
\end{array}
      `.trim();

      try {
        problemDiv.html(
          window.katex.renderToString(tex, {
            displayMode: true,
            throwOnError: false,
            strict: "ignore",
          })
        );

        const d = problemDiv.elt.querySelector(".katex-display");
        if (d) d.style.margin = "0";

        const k = problemDiv.elt.querySelector(".katex");
        if (k) k.style.fontSize = "1.12em";
      } catch (e) {
        problemDiv.html(
          `<div style="font-family:Times New Roman;font-weight:900;font-size:20px;line-height:1.2">
            ${escapeHtml(card.a)}<br/>+ ${escapeHtml(card.b)}
          </div>`
        );
      }
    }

    // =========================
    // Drawing
    // =========================
    function drawHeader() {
      p.noStroke();
      p.fill(250, 250, 245);
      p.rect(0, 0, p.width, 78);

      p.fill(17);
      p.textStyle(p.BOLD);
      p.textSize(24);
      p.text("LATIHAN", 18, 36);

      p.textStyle(p.NORMAL);
      p.textSize(14);
      p.fill(70);
      p.text("Kerjakan berurutan: MUDAH → SEDANG → SUSAH. Isi jawaban lalu klik Cek.", 18, 58);

      p.stroke(0, 0, 0, 18);
      p.line(0, 78, p.width, 78);
    }

    function drawCards() {
      const mx = p.mouseX, my = p.mouseY;

      cards.forEach((c) => {
        const unlocked = isUnlocked(c.i);
        c.hover =
          unlocked &&
          mx >= c.x && mx <= c.x + c.w &&
          my >= c.y && my <= c.y + c.h;

        // shadow
        p.noStroke();
        p.fill(0, 0, 0, c.hover ? 25 : 14);
        p.rect(c.x + 3, c.y + 6, c.w, c.h, 18);

        // body
        p.fill(c.soft[0], c.soft[1], c.soft[2], unlocked ? 255 : 160);
        p.rect(c.x, c.y, c.w, c.h, 18);

        // border
        p.stroke(c.accent[0], c.accent[1], c.accent[2], unlocked ? (c.hover ? 220 : 140) : 70);
        p.strokeWeight(c.hover ? 3 : 2);
        p.noFill();
        p.rect(c.x, c.y, c.w, c.h, 18);

        // accent bar
        p.noStroke();
        p.fill(c.accent[0], c.accent[1], c.accent[2], unlocked ? 255 : 120);
        p.rect(c.x + 14, c.y + 14, 10, c.h - 28, 8);

        // text
        p.fill(20, unlocked ? 255 : 140);
        p.textStyle(p.BOLD);
        p.textSize(18);
        p.text(c.title, c.x + 34, c.y + 44);

        p.fill(70, unlocked ? 255 : 140);
        p.textStyle(p.NORMAL);
        p.textSize(14);
        p.text(c.subtitle, c.x + 34, c.y + 70);

        // status
        if (c.solved) {
          p.noStroke();
          p.fill(27, 122, 42, 18);
          p.rect(c.x + 34, c.y + 82, c.w - 50, 28, 12);

          p.fill(15, 95, 34);
          p.textStyle(p.BOLD);
          p.textSize(14);
          p.text("✓ Selesai", c.x + 50, c.y + 102);
        } else if (!unlocked) {
          p.noStroke();
          p.fill(0, 0, 0, 10);
          p.rect(c.x + 34, c.y + 82, c.w - 50, 28, 12);

          p.fill(40, 40, 40, 140);
          p.textStyle(p.BOLD);
          p.textSize(13);
          p.text("🔒 Terkunci", c.x + 50, c.y + 102);
        } else {
          p.fill(30, 30, 30, 150);
          p.textStyle(p.BOLD);
          p.textSize(13);
          p.text(c.hover ? "Klik untuk buka" : "", c.x + 34, c.y + 104);
        }
      });

      p.strokeWeight(1);
    }

    function drawEmptyPanel() {
      const panel = getPanelRect();

      p.noStroke();
      p.fill(0, 0, 0, 10);
      p.rect(panel.x + 2, panel.y + 4, panel.w, panel.h, 18);

      p.stroke(0, 0, 0, 22);
      p.strokeWeight(1.5);
      p.fill(255);
      p.rect(panel.x, panel.y, panel.w, panel.h, 18);

      p.noStroke();
      p.fill(35);
      p.textStyle(p.BOLD);
      p.textSize(18);
      p.text("Soal akan muncul di sini", panel.x + 18, panel.y + 42);

      p.fill(90);
      p.textStyle(p.NORMAL);
      p.textSize(15);
      p.text("Mulai dari level MUDAH dulu ya.", panel.x + 18, panel.y + 70);
    }

    function drawPanel(card) {
      const panel = getPanelRect();
      const col = getColumn(panel);

      // cache untuk positioning DOM
      panel._col = col;
      panel._qBox = {
        x: col.colX,
        y: panel.y + 78,
        w: col.colW,
        h: 96,
      };
      panelCache = panel;

      // shadow + body
      p.noStroke();
      p.fill(0, 0, 0, 12);
      p.rect(panel.x + 3, panel.y + 6, panel.w, panel.h, 18);

      p.stroke(card.accent[0], card.accent[1], card.accent[2], 110);
      p.strokeWeight(2);
      p.fill(255);
      p.rect(panel.x, panel.y, panel.w, panel.h, 18);

      // header bar
      p.noStroke();
      p.fill(card.accent[0], card.accent[1], card.accent[2], 22);
      p.rect(panel.x, panel.y, panel.w, 54, 18, 18, 0, 0);

      p.fill(20);
      p.textStyle(p.BOLD);
      p.textSize(18);
      p.text(`Soal ${card.title}`, panel.x + 18, panel.y + 34);

      p.fill(70);
      p.textStyle(p.NORMAL);
      p.textSize(14);
      p.text("Hitung hasil penjumlahan berikut:", panel.x + 18, panel.y + 52);

      // question box
      const q = panel._qBox;
      p.stroke(0, 0, 0, 28);
      p.strokeWeight(1.5);
      p.fill(255);
      p.rect(q.x, q.y, q.w, q.h, 14);

      // label jawaban
      p.noStroke();
      p.fill(60);
      p.textStyle(p.BOLD);
      p.textSize(14);
      p.text("Jawaban:", col.colX, panel.y + 190);
    }

    function resizeToHost() {
      if (!ensureHost()) return;

      const w = Math.max(320, Math.min(980, hostEl.clientWidth - 4));
      const h = 560;

      p.resizeCanvas(w, h);
      layoutCards();
    }

    // =========================
    // p5 lifecycle
    // =========================
    p.setup = () => {
      if (!ensureHost()) return;

      injectLocalCSS();

      // canvas parent ke container
      const c = p.createCanvas(980, 560);
      c.parent("p5-latihan");

      p.textFont("Times New Roman");
      p.rectMode(p.CORNER);

      cards = LEVELS.map((lv, i) => ({
        i,
        ...lv,
        x: 0,
        y: 0,
        w: 0,
        h: 0,
        hover: false,
        solved: false,
      }));

      layoutCards();

      // DOM input
      inp = p.createInput("");
      inp.hide();

      // buttons
      btnCheck = p.createButton("Cek");
      styleBtn(btnCheck);
      btnCheck.mousePressed(checkAnswer);
      btnCheck.hide();

      btnReset = p.createButton("Reset");
      styleBtn(btnReset);
      btnReset.mousePressed(resetPanel);
      btnReset.hide();

      // badge
      badge = p.createDiv("");
      badge.addClass("badge");
      badge.addClass("neutral");
      badge.hide();

      // KaTeX problem container
      problemDiv = p.createDiv("");
      problemDiv.addClass("katex-wrap");
      problemDiv.hide();

      katexStatus = p.createDiv("Memuat KaTeX...");
      katexStatus.addClass("katex-status");
      katexStatus.hide();

      // parent all DOM to container (penting untuk embed)
      inp.parent("p5-latihan");
      btnCheck.parent("p5-latihan");
      btnReset.parent("p5-latihan");
      badge.parent("p5-latihan");
      problemDiv.parent("p5-latihan");
      katexStatus.parent("p5-latihan");

      // enter = cek
      inp.elt.addEventListener("keydown", (e) => {
        if (e.key === "Enter") checkAnswer();
      });

      // KaTeX load
      loadKaTeX(
        () => {
          katexReady = true;
          katexStatus.hide();
          if (active !== -1) renderProblem(cards[active]);
        },
        () => {
          katexReady = false;
          katexStatus.html("Gagal memuat KaTeX 😥");
          katexStatus.show();
        }
      );

      // responsive
      resizeToHost();
      window.addEventListener("resize", resizeToHost);
    };

    p.draw = () => {
      p.background(255);

      drawHeader();
      drawCards();

      if (active === -1) {
        panelCache = null;
        drawEmptyPanel();
        hidePanelUI();
      } else {
        drawPanel(cards[active]);
        showPanelUI();
        positionUI();
        positionProblem();
      }
    };

    p.mousePressed = () => {
      for (let i = 0; i < cards.length; i++) {
        const c = cards[i];
        const inside =
          p.mouseX >= c.x && p.mouseX <= c.x + c.w &&
          p.mouseY >= c.y && p.mouseY <= c.y + c.h;

        if (!inside) continue;

        if (!isUnlocked(i)) {
          const idx = nextRequiredIndex();
          active = idx;
          openLevel(cards[active]);
          setBadge(false, `Kerjakan dulu: ${cards[idx].title}`);
          return;
        }

        active = i;
        openLevel(cards[active]);
        return;
      }
    };
  });
})();