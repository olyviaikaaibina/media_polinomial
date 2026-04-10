// =====================================================
// MARI MENCOBA (FINAL - PANEL KIRI DOM, DIAGRAM KANAN CANVAS)
// g(x) = x^2 + 4x + 1
// Fix:
// - Input rapi (tidak keluar garis / tidak melebar)
// - Scroll input aman (tidak hilang / tidak kepotong)
// - Tombol Reset tidak terpotong
// =====================================================

(function () {
  const HOST_ID = "p5MariMencoba1";

  new p5((p) => {
    // ======================
    // Konstanta / Grafik
    // ======================
    const H = 640;
    const LEFT_W = 340;

    let W = 980;          // total host width (dibaca dari DOM)
    let RIGHT_W = 640;    // lebar canvas (kanan)

    let scaleFactor = 42;
    const xMin = -8, xMax = 8;
    const yMin = -10, yMax = 10;

    const FUNC_STR = "g(x) = x² + 4x + 1";

    // ====== Jawaban benar ======
    const tol = 0.05;
    const xr1 = -2 - Math.sqrt(3);
    const xr2 = -2 + Math.sqrt(3);

    const ans = {
      x1: { x: xr1, y: 0 },
      x2: { x: xr2, y: 0 },
      yint: { x: 0, y: 1 },
      vtx: { x: -2, y: -3 },
    };

    // ======================
    // State
    // ======================
    let placedPoints = [];
    let showCurve = false;

    // ======================
    // DOM refs
    // ======================
    let dom = {
      host: null,
      wrap: null,
      left: null,
      right: null,

      scrollBox: null,

      // inputs
      x1x: null, x2x: null,
      yix: null, yiy: null,
      vx: null, vy: null,

      // buttons
      plotBtn: null, checkBtn: null, resetBtn: null,

      // status
      statusBox: null,
      statusText: null,
    };

    // ======================
    // Setup
    // ======================
    p.setup = () => {
      p.textFont("Inter, Arial");

      dom.host = document.getElementById(HOST_ID);
      if (!dom.host) return;

      dom.host.style.position = "relative";
      dom.host.style.width = "100%";

      buildLayout();
      measureSize();

      const c = p.createCanvas(RIGHT_W, H);
      c.parent(dom.right);

      buildLeftUI();

      setStatus(
        "Isi semua jawaban.\nKurva disembunyikan dulu.\nKlik “Plot ke Diagram” untuk menampilkan kurva & titik.",
        "info"
      );

      // ✅ pastikan layout sudah settle
      requestAnimationFrame(() => updateLeftHeights());
      setTimeout(() => updateLeftHeights(), 50);
    };

    p.windowResized = () => {
      if (!dom.host) return;
      const oldRightW = RIGHT_W;
      measureSize();
      if (RIGHT_W !== oldRightW) p.resizeCanvas(RIGHT_W, H);
      updateLeftHeights();
    };

    function buildLayout() {
      dom.wrap = document.createElement("div");
      dom.wrap.style.display = "flex";
      dom.wrap.style.alignItems = "stretch";
      dom.wrap.style.gap = "0px";
      dom.wrap.style.width = "100%";
      dom.wrap.style.maxWidth = "980px";
      dom.wrap.style.margin = "0 auto";
      dom.wrap.style.background = "transparent";

      // left panel
      dom.left = document.createElement("div");
      dom.left.style.width = LEFT_W + "px";
      dom.left.style.minWidth = LEFT_W + "px";
      dom.left.style.height = H + "px";
      dom.left.style.boxSizing = "border-box";
      dom.left.style.padding = "20px 22px";
      dom.left.style.background = "#fcfcfc";
      dom.left.style.borderRadius = "18px 0 0 18px";
      dom.left.style.border = "1px solid #eaeaea";
      dom.left.style.borderRight = "none";
      dom.left.style.overflow = "hidden";

      // ✅ FIX: flex column supaya footer (tombol+status) tidak kepotong
      dom.left.style.display = "flex";
      dom.left.style.flexDirection = "column";
      dom.left.style.minHeight = "0";

      // right panel
      dom.right = document.createElement("div");
      dom.right.style.flex = "1";
      dom.right.style.height = H + "px";
      dom.right.style.position = "relative";
      dom.right.style.background = "#f7f7f7";
      dom.right.style.borderRadius = "0 18px 18px 0";
      dom.right.style.border = "1px solid #eaeaea";
      dom.right.style.boxSizing = "border-box";
      dom.right.style.overflow = "hidden";

      dom.wrap.appendChild(dom.left);
      dom.wrap.appendChild(dom.right);

      dom.host.innerHTML = "";
      dom.host.appendChild(dom.wrap);
    }

    function measureSize() {
      const rect = dom.host.getBoundingClientRect();
      W = Math.min(980, Math.max(720, Math.floor(rect.width)));
      dom.wrap.style.maxWidth = W + "px";

      RIGHT_W = Math.max(360, W - LEFT_W);
      scaleFactor = Math.max(34, Math.min(44, Math.floor(RIGHT_W / 14)));
    }

    // ======================
    // Draw (KANAN SAJA)
    // ======================
    p.draw = () => {
      p.background(247);
      drawGraphArea();
    };

    function drawGraphArea() {
      const frameX = 26, frameY = 26;
      const frameW = RIGHT_W - 52;
      const frameH = H - 52;

      p.noStroke();
      p.fill(247);
      p.rect(0, 0, RIGHT_W, H);

      p.stroke(228);
      p.strokeWeight(1);
      p.fill(255);
      p.rect(frameX, frameY, frameW, frameH, 18);

      p.noStroke();
      p.fill(70);
      p.textAlign(p.LEFT, p.TOP);
      p.textSize(13);
      p.textStyle(p.BOLD);
      p.text("Diagram Koordinat", frameX + 18, frameY + 14);
      p.textStyle(p.NORMAL);

      p.fill(130);
      p.textSize(11);
      const sub = showCurve ? "Kurva & titik ditampilkan" : "Kurva disembunyikan sampai kamu plot";
      p.text(sub, frameX + 18, frameY + 34);

      const gx = frameX + frameW / 2;
      const gy = frameY + frameH / 2 + 18;

      p.push();
      p.translate(gx, gy);

      const ctx = p.drawingContext;
      ctx.save();

      const left = -frameW / 2;
      const right = frameW / 2;
      const top = -frameH / 2 - 18;
      const bottom = frameH / 2 - 18;

      const pad = 14;
      ctx.beginPath();
      ctx.rect(left + pad, top + pad, (right - left) - 2 * pad, (bottom - top) - 2 * pad);
      ctx.clip();

      drawGrid(frameW, frameH);
      drawAxes(frameW, frameH);

      if (showCurve) {
        drawFunctionCurve();
        drawPlacedPoints();
      }

      ctx.restore();
      p.pop();
    }

    function drawGrid(frameW, frameH) {
      const w = frameW / 2;
      const h = frameH / 2;

      p.stroke(240);
      p.strokeWeight(1);
      for (let x = -w; x <= w; x += scaleFactor) p.line(x, -h, x, h);
      for (let y = -h; y <= h; y += scaleFactor) p.line(-w, y, w, y);

      p.noStroke();
      p.fill(150);
      p.textSize(11);

      p.textAlign(p.CENTER, p.TOP);
      for (let i = xMin; i <= xMax; i++) p.text(i, i * scaleFactor, 8);

      p.textAlign(p.LEFT, p.CENTER);
      for (let j = yMin; j <= yMax; j++) {
        if (j === 0) continue;
        p.text(j, 8, -j * scaleFactor);
      }
    }

    function drawAxes(frameW, frameH) {
      const w = frameW / 2 - 16;
      const h = frameH / 2 - 16;

      p.stroke(55);
      p.strokeWeight(2);
      p.line(-w, 0, w, 0);
      p.line(0, -h, 0, h);

      p.strokeWeight(2);
      p.line(w - 12, -6, w, 0);
      p.line(w - 12, 6, w, 0);
      p.line(-6, -(h - 12), 0, -h);
      p.line(6, -(h - 12), 0, -h);

      p.noStroke();
      p.fill(60);
      p.textSize(13);
      p.textAlign(p.RIGHT, p.TOP);
      p.text("x", w - 10, 8);
      p.textAlign(p.LEFT, p.BOTTOM);
      p.text("y", 10, -h + 22);
    }

    function drawFunctionCurve() {
      p.stroke(0, 140, 220);
      p.strokeWeight(3);
      p.noFill();

      p.beginShape();
      const step = 0.04;
      for (let realX = xMin; realX <= xMax; realX += step) {
        const y = g(realX);
        p.vertex(realX * scaleFactor, -y * scaleFactor);
      }
      p.endShape();
    }

    function drawPlacedPoints() {
      for (const pt of placedPoints) drawPoint(pt);
    }

    function drawPoint(pt) {
      const px = pt.x * scaleFactor;
      const py = -pt.y * scaleFactor;

      p.noStroke();
      p.fill(0, 0, 0, 25);
      p.ellipse(px + 2, py + 2, 14, 14);

      if (pt.kind === "vtx") p.fill(255, 90, 90);
      else if (pt.kind === "yint") p.fill(255, 170, 70);
      else p.fill(125, 105, 255);

      p.ellipse(px, py, 14, 14);

      p.fill(35);
      p.textSize(12);
      p.textAlign(p.LEFT, p.BOTTOM);
      p.text(pt.label, px + 10, py - 8);
    }

    function g(x) {
      return x * x + 4 * x + 1;
    }

    // ======================
    // LEFT UI (DOM)
    // ======================
    function buildLeftUI() {
      dom.left.innerHTML = "";

      // header
      const header = el("div", dom.left);
      header.style.background = "#282828";
      header.style.borderRadius = "18px";
      header.style.padding = "14px 12px";
      header.style.textAlign = "center";
      header.style.color = "white";
      header.style.fontWeight = "900";
      header.style.fontSize = "20px";
      header.textContent = "MARI MENCOBA";

      const sub = el("div", dom.left);
      sub.style.marginTop = "6px";
      sub.style.textAlign = "center";
      sub.style.color = "#777";
      sub.style.fontSize = "12px";
      sub.textContent = "Latihan grafik fungsi kuadrat";

      // function card
      const card = el("div", dom.left);
      card.style.marginTop = "16px";
      card.style.background = "white";
      card.style.border = "1px solid #ececec";
      card.style.borderRadius = "16px";
      card.style.padding = "14px";
      card.style.boxShadow = "0 8px 18px rgba(0,0,0,0.04)";

      const t1 = el("div", card);
      t1.style.fontSize = "13px";
      t1.style.color = "#333";
      t1.style.fontWeight = "700";
      t1.textContent = "Gambarlah grafik fungsi:";

      const fx = el("div", card);
      fx.style.marginTop = "6px";
      fx.style.fontSize = "18px";
      fx.style.color = "rgb(0,120,210)";
      fx.style.fontWeight = "900";
      fx.textContent = FUNC_STR;

      const t2 = el("div", card);
      t2.style.marginTop = "10px";
      t2.style.fontSize = "12px";
      t2.style.color = "#444";
      t2.style.whiteSpace = "pre-line";
      t2.textContent =
        "Tentukan:\n• Titik potong sumbu-x (2 titik)\n• Titik potong sumbu-y\n• Vertex";

      const t3 = el("div", card);
      t3.style.marginTop = "10px";
      t3.style.fontSize = "11px";
      t3.style.color = "#777";
      t3.textContent = "Setelah lengkap, klik “Plot ke Diagram”.";

      // tip
      const tip = el("div", dom.left);
      tip.style.marginTop = "12px";
      tip.style.paddingTop = "10px";
      tip.style.borderTop = "1px solid #eee";
      tip.style.fontSize = "11px";
      tip.style.color = "#777";
      tip.textContent = "Tip: x-intercept selalu y = 0.";

      // scroll area input
      const scroll = el("div", dom.left);
      dom.scrollBox = scroll;

      scroll.style.marginTop = "14px";
      scroll.style.background = "transparent";
      scroll.style.overflow = "auto";
      scroll.style.paddingRight = "6px";
      scroll.style.display = "flex";
      scroll.style.flexDirection = "column";
      scroll.style.gap = "10px";

      // ✅ inti: flex child bisa scroll
      scroll.style.flex = "1";
      scroll.style.minHeight = "120px"; // fallback agar tidak 0

      scroll.dataset.role = "scrollBox";

      // input cards
      const c1 = makeCard(scroll, "1) Titik potong sumbu-x (2 titik)", "Isi x1 & x2. y otomatis 0.");
      const r1 = pairRow(c1, "Titik 1", "x1", "0", true);
      const r2 = pairRow(c1, "Titik 2", "x2", "0", true);
      dom.x1x = r1.ix; dom.x2x = r2.ix;

      const c2 = makeCard(scroll, "2) Titik potong sumbu-y", "Biasanya x = 0.");
      const ry = pairRow(c2, "Y-intercept", "0", "y", false);
      dom.yix = ry.ix; dom.yiy = ry.iy;

      const c3 = makeCard(scroll, "3) Vertex", "Titik puncak parabola.");
      const rv = pairRow(c3, "Vertex", "x", "y", false);
      dom.vx = rv.ix; dom.vy = rv.iy;

      // action row
      const actionRow = el("div", dom.left);
      actionRow.style.marginTop = "10px";
      actionRow.style.display = "grid";
      actionRow.style.gridTemplateColumns = "1.2fr 1fr";
      actionRow.style.gap = "10px";
      actionRow.style.flexShrink = "0";

      dom.plotBtn = makeBtn(actionRow, "Plot ke Diagram", "primary", onPlot);
      dom.checkBtn = makeBtn(actionRow, "Cek", "ghost", onCheck);

      dom.resetBtn = makeBtn(dom.left, "Reset", "danger", onReset);
      dom.resetBtn.style.marginTop = "8px";
      dom.resetBtn.style.width = "100%";
      dom.resetBtn.style.flexShrink = "0";

      // status
      dom.statusBox = el("div", dom.left);
      dom.statusBox.style.marginTop = "10px";
      dom.statusBox.style.borderRadius = "16px";
      dom.statusBox.style.padding = "10px 12px";
      dom.statusBox.style.border = "1px solid #ececec";
      dom.statusBox.style.background = "#f2f2f2";
      dom.statusBox.style.boxShadow = "0 8px 18px rgba(0,0,0,0.03)";
      dom.statusBox.style.flexShrink = "0";

      dom.statusText = el("div", dom.statusBox);
      dom.statusText.style.fontSize = "12px";
      dom.statusText.style.color = "#222";
      dom.statusText.style.whiteSpace = "pre-line";
      dom.statusText.style.fontWeight = "700";

      updateLeftHeights();
    }

    // ✅ fallback: kalau flex hitungannya “ngaco”, kita paksa maxHeight scroll
    function updateLeftHeights() {
      if (!dom.left || !dom.scrollBox) return;

      const leftRect = dom.left.getBoundingClientRect();
      const scrollRect = dom.scrollBox.getBoundingClientRect();

      const topInside = scrollRect.top - leftRect.top;

      // total tinggi elemen setelah scroll (actionRow, reset, status)
      let afterH = 0;
      let found = false;
      for (const child of Array.from(dom.left.children)) {
        if (child === dom.scrollBox) {
          found = true;
          continue;
        }
        if (found) afterH += child.getBoundingClientRect().height;
      }

      const padBottom = 14;
      const available = H - topInside - afterH - padBottom;

      const finalH = Math.max(140, Math.floor(available));
      dom.scrollBox.style.maxHeight = finalH + "px";
    }

    function makeCard(parent, title, desc) {
      const c = el("div", parent);
      c.style.background = "#fff";
      c.style.border = "1px solid #ececec";
      c.style.borderRadius = "16px";
      c.style.padding = "12px";
      c.style.boxShadow = "0 8px 18px rgba(0,0,0,0.04)";
      c.style.display = "flex";
      c.style.flexDirection = "column";
      c.style.gap = "8px";
      c.style.minWidth = "0";

      const t = el("div", c);
      t.style.fontWeight = "900";
      t.style.fontSize = "13px";
      t.style.color = "#222";
      t.textContent = title;

      if (desc) {
        const d = el("div", c);
        d.style.fontSize = "11px";
        d.style.color = "#666";
        d.style.marginTop = "-2px";
        d.textContent = desc;
      }
      return c;
    }

    function pairRow(parent, tag, phx, phy, lockY) {
      const row = el("div", parent);
      row.style.display = "grid";
      row.style.gridTemplateColumns = "1fr 1fr";
      row.style.gap = "10px";
      row.style.alignItems = "start";
      row.style.minWidth = "0";

      const mk = (label, placeholder, locked, defaultVal) => {
        const wrap = el("div", row);
        wrap.style.display = "flex";
        wrap.style.flexDirection = "column";
        wrap.style.gap = "5px";

        // ✅ FIX penting: grid child boleh mengecil → tidak keluar garis
        wrap.style.minWidth = "0";

        const l = el("div", wrap);
        l.style.fontSize = "11px";
        l.style.color = "#555";
        l.style.fontWeight = "800";
        l.textContent = label;

        const inp = el("input", wrap);
        inp.value = defaultVal || "";
        inp.placeholder = placeholder;
        inp.style.height = "34px";
        inp.style.padding = "0 10px";
        inp.style.border = "1px solid #e2e2e2";
        inp.style.borderRadius = "12px";
        inp.style.fontSize = "14px";
        inp.style.outline = "none";
        inp.style.background = locked ? "#f3f3f3" : "#fbfbfb";
        inp.style.boxSizing = "border-box";

        // ✅ FIX: pastikan input tidak melebar
        inp.style.width = "100%";
        inp.style.minWidth = "0";

        if (locked) {
          inp.disabled = true;
          inp.style.color = "#333";
        }

        // kalau user ketik, update height (status bisa berubah)
        inp.addEventListener("input", () => updateLeftHeights());

        return inp;
      };

      const ix = mk(`${tag} x`, phx, false, "");
      const iy = mk(`${tag} y`, phy, !!lockY, lockY ? "0" : "");
      return { ix, iy };
    }

    function makeBtn(parent, label, variant, onClick) {
      const b = el("button", parent);
      b.textContent = label;
      b.style.height = "38px";
      b.style.borderRadius = "14px";
      b.style.border = "none";
      b.style.fontSize = "14px";
      b.style.fontWeight = "900";
      b.style.cursor = "pointer";
      b.style.width = "100%";

      if (variant === "primary") {
        b.style.background = "linear-gradient(135deg, #1e88e5, #1666c5)";
        b.style.color = "white";
        b.style.boxShadow = "0 10px 18px rgba(30,136,229,0.22)";
      } else if (variant === "ghost") {
        b.style.background = "#f3f3f3";
        b.style.color = "#222";
        b.style.border = "1px solid #e5e5e5";
      } else {
        b.style.background = "#ffe6e6";
        b.style.color = "#7a1d1d";
        b.style.border = "1px solid #ffc4c4";
      }

      b.addEventListener("click", (e) => {
        e.preventDefault();
        onClick();
        updateLeftHeights();
      });

      return b;
    }

    function el(tag, parent) {
      const node = document.createElement(tag);
      parent.appendChild(node);
      return node;
    }

    // ======================
    // Status
    // ======================
    function setStatus(msg, type = "info") {
      if (!dom.statusText || !dom.statusBox) return;
      dom.statusText.textContent = msg;

      if (type === "ok") dom.statusBox.style.background = "#dcffdc";
      else if (type === "bad") dom.statusBox.style.background = "#ffe1e1";
      else dom.statusBox.style.background = "#f2f2f2";

      updateLeftHeights();
    }

    // ======================
    // Actions
    // ======================
    function onPlot() {
      const data = readAll();
      if (!data.ok) {
        setStatus(data.msg, "bad");
        return;
      }

      showCurve = true;
      placedPoints = [
        pt(data.x1.x, data.x1.y, "xint"),
        pt(data.x2.x, data.x2.y, "xint"),
        pt(data.yint.x, data.yint.y, "yint"),
        pt(data.vtx.x, data.vtx.y, "vtx"),
      ];

      setStatus("Titik diplot ✅\nKlik “Cek” untuk memeriksa.", "info");
    }

    function onCheck() {
      const data = readAll();
      if (!data.ok) {
        setStatus(data.msg, "bad");
        return;
      }

      const xOK =
        (close(data.x1.x, ans.x1.x, tol) && close(data.x2.x, ans.x2.x, tol)) ||
        (close(data.x1.x, ans.x2.x, tol) && close(data.x2.x, ans.x1.x, tol));

      const yOK = close(data.yint.x, ans.yint.x, tol) && close(data.yint.y, ans.yint.y, tol);
      const vOK = close(data.vtx.x, ans.vtx.x, tol) && close(data.vtx.y, ans.vtx.y, tol);

      const parts = [
        xOK ? "✅ Titik potong sumbu-x benar" : "❌ Titik potong sumbu-x belum tepat",
        yOK ? "✅ Titik potong sumbu-y benar" : "❌ Titik potong sumbu-y belum tepat",
        vOK ? "✅ Vertex benar" : "❌ Vertex belum tepat",
      ];

      if (xOK && yOK && vOK) setStatus("Mantap! Semua benar 🎉\n" + parts.join("\n"), "ok");
      else setStatus("Coba cek lagi 🙂\n" + parts.join("\n"), "bad");
    }

    function onReset() {
      placedPoints = [];
      showCurve = false;

      dom.x1x.value = "";
      dom.x2x.value = "";
      dom.yix.value = "";
      dom.yiy.value = "";
      dom.vx.value = "";
      dom.vy.value = "";

      setStatus("Reset selesai. Kurva disembunyikan lagi 🙂", "info");
    }

    // ======================
    // Util
    // ======================
    function pt(x, y, kind) {
      return { x, y, kind, label: `(${fmt(x)}, ${fmt(y)})` };
    }

    function readAll() {
      const pX1 = readPoint(dom.x1x.value, "0");
      const pX2 = readPoint(dom.x2x.value, "0");
      const pY = readPoint(dom.yix.value, dom.yiy.value);
      const pV = readPoint(dom.vx.value, dom.vy.value);

      if (!pX1 || !pX2 || !pY || !pV) {
        return { ok: false, msg: "Masih ada input kosong/invalid.\nIsi angka ya (boleh desimal)." };
      }
      return { ok: true, x1: pX1, x2: pX2, yint: pY, vtx: pV };
    }

    function readPoint(xs, ys) {
      if (xs === "" || ys === "") return null;
      const x = parseFloat(String(xs).replace(",", "."));
      const y = parseFloat(String(ys).replace(",", "."));
      if (Number.isNaN(x) || Number.isNaN(y)) return null;
      return { x, y };
    }

    function close(a, b, t) {
      return Math.abs(a - b) <= t;
    }

    function fmt(n) {
      let s = Number(n).toFixed(3);
      return s.replace(/\.?0+$/, "");
    }
  }, HOST_ID);
})();