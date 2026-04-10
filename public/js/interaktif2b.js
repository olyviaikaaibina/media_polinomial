/**
 * interaktif2b.js — LATIHAN Pengurangan Polinomial (Embedded p5.js)
 * - Instance mode (aman, tidak bentrok dengan p5 lain)
 * - Render di dalam div: #p5-latihan-2b
 * - Tema warna: #AAB99A
 * - Cek/Reset per soal + Cek Semua/Reset Semua
 * - Confetti saat benar, shake saat salah
 */

(function () {
  const HOST_ID = "p5-latihan-2b";
  const THEME = {
    main: "#AAB99A",
    mainRGB: [170, 185, 154],
    soft: "rgba(170,185,154,0.18)",
    soft2: "rgba(170,185,154,0.10)",
    text: "rgba(0,0,0,0.82)",
    muted: "rgba(0,0,0,0.62)",
    border: "rgba(0,0,0,0.10)",
  };

  const problems = [
    { id: "1a", label: "1a", expr: "(9x^2 - 4x + 7) - (2x^2 + 3x - 5)", answer: "7x^2-7x+12" },
    { id: "1b", label: "1b", expr: "(5y^3 + y - 8) - (2y^3 - 4y + 1)", answer: "3y^3+5y-9" },
    { id: "2a", label: "2a", expr: "P(x)=4x^2 - 3x + 5,  Q(x)=x^2 + x - 2  →  P(x) - Q(x)", answer: "3x^2-4x+7" },
    { id: "2b", label: "2b", expr: "P(x)=4x^2 - 3x + 5,  Q(x)=x^2 + x - 2  →  Q(x) - P(x)", answer: "-3x^2+4x-7" },
  ];

  // ---- Guard: kalau host tidak ada, skip
  if (!document.getElementById(HOST_ID)) return;

  new p5((p) => {
    let hostEl;
    let w = 920;
    let h = 640;

    // visuals
    let blobs = [];
    let sparkles = [];
    let confettis = [];

    // ui refs
    const ui = {
      wrap: null,
      canvasWrap: null,
      card: null,
      rows: [],
      scoreText: null,
      btnAllCheck: null,
      btnAllReset: null,
    };

    p.setup = () => {
      hostEl = document.getElementById(HOST_ID);
      hostEl.style.position = "relative";

      // wrapper
      ui.wrap = p.createDiv("").parent(HOST_ID);
      ui.wrap.style("position", "relative");
      ui.wrap.style("width", "100%");
      ui.wrap.style("min-height", "720px");

      // canvas wrapper
      ui.canvasWrap = p.createDiv("").parent(ui.wrap);
      ui.canvasWrap.style("position", "absolute");
      ui.canvasWrap.style("inset", "0");
      ui.canvasWrap.style("z-index", "0");

      // canvas
      computeSize();
      const c = p.createCanvas(w, h);
      c.parent(ui.canvasWrap);
      c.elt.style.width = "100%";
      c.elt.style.height = "100%";
      c.elt.style.display = "block";

      setupBlobs();
      setupSparkles();

      // card UI
      buildUI();

      // responsive
      window.addEventListener("resize", () => {
        computeSize();
        p.resizeCanvas(w, h);
        setupBlobs();
        setupSparkles();
      });
    };

    p.draw = () => {
      drawBackground();
      drawFrame();
      updateConfetti();
      drawConfetti();
    };

    function computeSize() {
      const rect = hostEl.getBoundingClientRect();
      w = Math.max(320, Math.min(980, rect.width));
      // tinggi host pakai CSS min-height; canvas kita ikutin (lebih kecil biar ada ruang scroll DOM)
      h = Math.max(520, Math.min(720, rect.height || 720));
    }

    function buildUI() {
      ui.card = p.createDiv("").parent(ui.wrap);
      ui.card.style("position", "relative");
      ui.card.style("z-index", "1");
      ui.card.style("margin", "14px");
      ui.card.style("border-radius", "18px");
      ui.card.style("border", `1px solid ${THEME.border}`);
      ui.card.style("background", "rgba(255,255,255,0.90)");
      ui.card.style("backdrop-filter", "blur(6px)");
      ui.card.style("box-shadow", "0 18px 52px rgba(0,0,0,0.10)");
      ui.card.style("overflow", "hidden");

      // header
      const header = p.createDiv("").parent(ui.card);
      header.style(
        "background",
        `linear-gradient(135deg, ${THEME.main}, rgba(170,185,154,0.72))`
      );
      header.style("padding", "16px 16px");
      header.style("color", "white");

      const topRow = p.createDiv("").parent(header);
      topRow.style("display", "flex");
      topRow.style("align-items", "center");
      topRow.style("justify-content", "space-between");
      topRow.style("gap", "10px");
      topRow.style("flex-wrap", "wrap");

      const left = p.createDiv("").parent(topRow);
      left.style("display", "flex");
      left.style("align-items", "center");
      left.style("gap", "12px");

      const icon = p.createDiv("🧩").parent(left);
      icon.style("width", "42px");
      icon.style("height", "42px");
      icon.style("border-radius", "16px");
      icon.style("display", "grid");
      icon.style("place-items", "center");
      icon.style("background", "rgba(255,255,255,0.22)");
      icon.style("border", "1px solid rgba(255,255,255,0.32)");
      icon.style("box-shadow", "0 10px 22px rgba(0,0,0,0.10)");
      icon.style("font-size", "18px");

      const titleWrap = p.createDiv("").parent(left);
      const title = p.createDiv("LATIHAN — Pengurangan Polinomial").parent(titleWrap);
      title.style("font-weight", "900");
      title.style("letter-spacing", ".8px");
      title.style("font-size", "18px");
      const sub = p.createDiv('Format jawaban: <b>7x^2-7x+12</b> (tanpa spasi).').parent(titleWrap);
      sub.style("opacity", ".92");
      sub.style("font-weight", "700");

      const badge = p.createDiv("").parent(topRow);
      badge.style("padding", "9px 12px");
      badge.style("border-radius", "999px");
      badge.style("background", "rgba(255,255,255,0.22)");
      badge.style("border", "1px solid rgba(255,255,255,0.30)");
      badge.style("font-weight", "900");
      badge.style("display", "flex");
      badge.style("align-items", "center");
      badge.style("gap", "8px");
      badge.html("⭐ <span id='p5score'>Skor: 0/" + problems.length + "</span>");
      ui.scoreText = badge.elt.querySelector("#p5score");

      // body
      const body = p.createDiv("").parent(ui.card);
      body.style("padding", "14px 14px 16px");

      ui.rows = problems.map((prob) => makeRow(body, prob));

      // action bar
      const action = p.createDiv("").parent(body);
      action.style("margin-top", "12px");
      action.style("padding-top", "12px");
      action.style("border-top", "1px dashed rgba(0,0,0,0.18)");
      action.style("display", "flex");
      action.style("gap", "10px");
      action.style("flex-wrap", "wrap");
      action.style("align-items", "center");

      ui.btnAllCheck = makeBtn("✅ Cek Semua", "primary").parent(action);
      ui.btnAllReset = makeBtn("🔄 Reset Semua", "ghost").parent(action);

      ui.btnAllCheck.mousePressed(checkAll);
      ui.btnAllReset.mousePressed(resetAll);

      updateScore();
    }

    function makeRow(parent, prob) {
      const wrap = p.createDiv("").parent(parent);
      wrap.style("border", `1px solid ${THEME.border}`);
      wrap.style("border-left", `8px solid ${THEME.main}`);
      wrap.style("border-radius", "16px");
      wrap.style("padding", "12px 12px 12px");
      wrap.style("margin", "12px 0");
      wrap.style("background", `linear-gradient(180deg, ${THEME.soft}, rgba(255,255,255,0.70))`);
      wrap.style("box-shadow", "0 14px 30px rgba(0,0,0,0.04)");

      const head = p.createDiv("").parent(wrap);
      head.style("display", "flex");
      head.style("align-items", "center");
      head.style("justify-content", "space-between");
      head.style("gap", "10px");
      head.style("flex-wrap", "wrap");

      const left = p.createDiv("").parent(head);
      left.style("font-weight", "900");
      left.style("color", THEME.text);
      left.html(`
        <span style="
          display:inline-flex; align-items:center; justify-content:center;
          width:38px; height:38px; border-radius:14px;
          background: rgba(255,255,255,0.70);
          border:1px solid rgba(0,0,0,0.10);
          margin-right:10px;
        ">${prob.label}</span>
        Tentukan hasil dari:
      `);

      const tag = p.createDiv("🎯 Kerjakan").parent(head);
      tag.style("padding", "7px 10px");
      tag.style("border-radius", "999px");
      tag.style("background", THEME.soft2);
      tag.style("border", "1px solid rgba(0,0,0,0.10)");
      tag.style("font-weight", "900");
      tag.style("color", THEME.muted);

      const expr = p.createDiv("").parent(wrap);
      expr.style("margin-top", "10px");
      expr.style("padding", "12px 12px");
      expr.style("border-radius", "14px");
      expr.style("background", "rgba(255,255,255,0.88)");
      expr.style("border", "1px solid rgba(0,0,0,0.10)");
      expr.style("box-shadow", "0 10px 20px rgba(0,0,0,0.03)");
      expr.style("overflow-x", "auto");
      expr.style("font-weight", "900");
      expr.style("font-size", "18px");
      expr.style("color", THEME.text);
      expr.html(prettyExpr(prob.expr));

      const row = p.createDiv("").parent(wrap);
      row.style("display", "flex");
      row.style("gap", "10px");
      row.style("flex-wrap", "wrap");
      row.style("align-items", "center");
      row.style("margin-top", "12px");

      const input = p.createInput("").parent(row);
      input.attribute("placeholder", "Jawaban kamu...");
      input.style("width", "min(640px, 100%)");
      input.style("padding", "12px 14px");
      input.style("border-radius", "14px");
      input.style("border", "1px solid rgba(0,0,0,0.18)");
      input.style("font-size", "16px");
      input.style("outline", "none");
      input.style("font-family", "Georgia");
      input.style("background", "rgba(255,255,255,0.92)");
      input.style("box-shadow", "0 10px 16px rgba(0,0,0,0.04)");

      const btnCheck = makeBtn("Cek", "primary").parent(row);
      const btnReset = makeBtn("Reset", "ghost").parent(row);

      const fb = p.createDiv("").parent(wrap);
      fb.style("margin-top", "10px");
      fb.style("font-weight", "900");
      fb.style("padding", "10px 12px");
      fb.style("border-radius", "14px");
      fb.style("border", "1px solid transparent");
      fb.hide();

      btnCheck.mousePressed(() => {
        const ok = checkOne(prob, input, fb, wrap);
        if (ok) {
          input.value(prob.answer);
          input.attribute("disabled", true);
          spawnConfetti(26);
        }
        updateScore();
      });

      btnReset.mousePressed(() => {
        input.removeAttribute("disabled");
        input.value("");
        fb.hide();
        fb.html("");
        updateScore();
      });

      input.elt.addEventListener("keydown", (e) => {
        if (e.key === "Enter") {
          e.preventDefault();
          btnCheck.elt.click();
        }
      });

      return { wrap, input, fb, prob };
    }

    function makeBtn(label, type) {
      const b = p.createButton(label);
      b.style("padding", "11px 16px");
      b.style("border-radius", "14px");
      b.style("cursor", "pointer");
      b.style("font-weight", "900");
      b.style("font-family", "Georgia");
      b.style("border", "1px solid rgba(0,0,0,0.14)");
      b.style("transition", "0.12s ease");
      b.style("box-shadow", "0 10px 16px rgba(0,0,0,0.04)");

      b.mouseOver(() => b.style("transform", "translateY(-1px)"));
      b.mouseOut(() => b.style("transform", "translateY(0px)"));

      if (type === "primary") {
        b.style("background", "linear-gradient(135deg, rgba(170,185,154,0.22), rgba(170,185,154,0.10))");
        b.style("color", THEME.text);
        b.style("border", "1px solid rgba(170,185,154,0.55)");
      } else {
        b.style("background", "rgba(255,255,255,0.92)");
        b.style("color", THEME.muted);
      }
      return b;
    }

    // ---------- checking ----------
    function checkOne(prob, input, fb, wrap) {
      const user = normalizePoly(input.value());
      const ans = normalizePoly(prob.answer);

      if (!user) {
        showFB(fb, false, "⚠️ Isi jawaban dulu ya.");
        shake(wrap);
        return false;
      }

      const ok = user === ans;
      if (ok) {
        showFB(fb, true, "✅ Benar! Mantap 🔥");
        pulse(wrap);
      } else {
        showFB(fb, false, "❌ Belum tepat. Coba periksa lagi (balik tanda & gabungkan suku sejenis).");
        shake(wrap);
      }
      return ok;
    }

    function checkAll() {
      let any = false;
      ui.rows.forEach((r) => {
        const ok = checkOne(r.prob, r.input, r.fb, r.wrap);
        if (ok) {
          r.input.value(r.prob.answer);
          r.input.attribute("disabled", true);
          any = true;
        }
      });
      if (any) spawnConfetti(40);
      updateScore();
    }

    function resetAll() {
      ui.rows.forEach((r) => {
        r.input.removeAttribute("disabled");
        r.input.value("");
        r.fb.hide();
        r.fb.html("");
      });
      updateScore();
    }

    function updateScore() {
      const total = ui.rows.length;
      const correct = ui.rows.filter((r) => {
        const locked = r.input.elt.disabled;
        const ok = normalizePoly(r.input.value()) === normalizePoly(r.prob.answer);
        return locked && ok;
      }).length;

      if (ui.scoreText) ui.scoreText.textContent = `Skor: ${correct}/${total}`;
    }

    // ---------- normalization ----------
    function normalizePoly(raw) {
      let s = (raw || "")
        .toLowerCase()
        .trim()
        .replace(/\s+/g, "")
        .replace(/×/g, "x")
        .replace(/–/g, "-")
        .replace(/−/g, "-")
        .replace(/\+\-/g, "-");

      if (!s) return "";

      s = s.replace(/x3/g, "x^3").replace(/x2/g, "x^2");
      s = s.replace(/y3/g, "y^3").replace(/y2/g, "y^2");

      s = s.replace(/x\^1/g, "x").replace(/y\^1/g, "y");
      s = s.replace(/(^|[+\-])1x/g, "$1x");
      s = s.replace(/(^|[+\-])1y/g, "$1y");

      s = s.replace(/\+\+/g, "+").replace(/\-\-/g, "+");
      return s;
    }

    function prettyExpr(s) {
      return (s || "").replace(/\^2/g, "²").replace(/\^3/g, "³");
    }

    function showFB(fb, ok, msg) {
      fb.show();
      fb.html(msg);
      if (ok) {
        fb.style("color", "rgb(15,95,34)");
        fb.style("background", "rgba(27,122,42,0.10)");
        fb.style("border", "1px solid rgba(27,122,42,0.18)");
      } else {
        fb.style("color", "rgb(140,43,0)");
        fb.style("background", "rgba(224,112,43,0.10)");
        fb.style("border", "1px solid rgba(224,112,43,0.18)");
      }
    }

    // ---------- DOM micro animations ----------
    function shake(elDiv) {
      const el = elDiv.elt;
      const seq = [0, -6, 6, -5, 5, -3, 3, 0];
      let i = 0;
      const t = setInterval(() => {
        const x = seq[i++];
        el.style.transform = `translate(${x}px, 0px)`;
        if (i >= seq.length) {
          clearInterval(t);
          el.style.transform = "translate(0px, 0px)";
        }
      }, 35);
    }

    function pulse(elDiv) {
      const el = elDiv.elt;
      const old = el.style.boxShadow;
      el.style.boxShadow = "0 18px 46px rgba(170,185,154,0.28)";
      setTimeout(() => (el.style.boxShadow = old || "0 14px 30px rgba(0,0,0,0.04)"), 220);
    }

    // ---------- background visuals ----------
    function setupBlobs() {
      blobs = [];
      for (let i = 0; i < 9; i++) {
        blobs.push({
          x: p.random(0, w),
          y: p.random(0, h),
          r: p.random(120, 260),
          vx: p.random(-0.30, 0.30),
          vy: p.random(-0.30, 0.30),
          a: p.random(14, 26),
          kind: i % 2 === 0 ? "theme" : "gray",
        });
      }
    }

    function setupSparkles() {
      sparkles = [];
      for (let i = 0; i < 120; i++) {
        sparkles.push({
          x: p.random(0, w),
          y: p.random(0, h),
          r: p.random(1.2, 2.6),
          a: p.random(10, 20),
          tw: p.random(0.01, 0.03),
        });
      }
    }

    function drawBackground() {
      p.background(248, 250, 252);

      p.noStroke();
      for (let i = 0; i < 12; i++) {
        const t = i / 11;
        p.fill(245, 248, 244, 16);
        p.rect(0, t * h, w, h / 12);
      }

      blobs.forEach((b) => {
        b.x += b.vx;
        b.y += b.vy;

        if (b.x < -260) b.x = w + 260;
        if (b.x > w + 260) b.x = -260;
        if (b.y < -260) b.y = h + 260;
        if (b.y > h + 260) b.y = -260;

        if (b.kind === "theme") p.fill(THEME.mainRGB[0], THEME.mainRGB[1], THEME.mainRGB[2], b.a);
        else p.fill(0, 0, 0, 10);

        p.ellipse(b.x, b.y, b.r, b.r * 0.72);
      });

      sparkles.forEach((s) => {
        s.a += Math.sin(p.frameCount * s.tw) * 0.6;
        p.fill(0, 0, 0, s.a);
        p.circle(s.x, s.y, s.r);
      });
    }

    function drawFrame() {
      p.noFill();
      p.stroke(0, 0, 0, 18);
      p.strokeWeight(2);
      p.rect(10, 10, w - 20, h - 20, 18);

      p.noStroke();
      p.fill(0, 0, 0, 90);
      p.textSize(13);
      p.textStyle(p.BOLD);
      p.text("Latihan Interaktif • Pengurangan Polinomial", 22, 34);
    }

    // ---------- confetti ----------
    function spawnConfetti(n) {
      for (let i = 0; i < n; i++) {
        confettis.push({
          x: p.random(w * 0.20, w * 0.80),
          y: p.random(-60, -10),
          vx: p.random(-1.2, 1.2),
          vy: p.random(2.4, 5.0),
          r: p.random(4, 8),
          rot: p.random(p.TWO_PI),
          vr: p.random(-0.2, 0.2),
          kind: p.random(["theme", "peach", "gray"]),
          life: Math.floor(p.random(70, 120)),
        });
      }
    }

    function updateConfetti() {
      for (let i = confettis.length - 1; i >= 0; i--) {
        const c = confettis[i];
        c.x += c.vx;
        c.y += c.vy;
        c.vy *= 0.99;
        c.rot += c.vr;
        c.life -= 1;
        if (c.y > h + 60 || c.life <= 0) confettis.splice(i, 1);
      }
    }

    function drawConfetti() {
      p.noStroke();
      confettis.forEach((c) => {
        p.push();
        p.translate(c.x, c.y);
        p.rotate(c.rot);
        if (c.kind === "theme") p.fill(THEME.mainRGB[0], THEME.mainRGB[1], THEME.mainRGB[2], 200);
        else if (c.kind === "peach") p.fill(241, 169, 138, 190);
        else p.fill(0, 0, 0, 70);
        p.rectMode(p.CENTER);
        p.rect(0, 0, c.r * 1.6, c.r, 3);
        p.pop();
      });
    }
  }, HOST_ID);
})();