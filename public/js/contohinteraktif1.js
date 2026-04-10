/* =======================================================
   contohinteraktif1.js (p5.js) — FIX SLIDER + FIX HITTEST SAAT SCALE
   Masalah klik tidak kena karena wrapper di-scale pakai CSS transform.
   Solusi: konversi mouse/touch koordinat dengan membagi currentScale.
======================================================= */

let sliderX;
let tabs = ["Nilai", "Potong x", "Potong y", "Vertex"];
let activeTab = "Nilai";

const world = { xMin: -3, xMax: 5 };
const baseXs = [-2, -1, 0, 1, 2, 3, 4];

const specialPts = [
  { x: -1, y: 0, kind: "xcut" },
  { x: 3, y: 0, kind: "xcut" },
  { x: 0, y: -3, kind: "ycut" },
  { x: 1, y: -4, kind: "vertex" }
];

let selected = { x: 0, y: 0 };
let chips = [];
let specialChips = [];
let graphHitPts = [];
let tabHit = [];

// ---------- Layout (fixed design size) ----------
const CANVAS_W = 800;
const CANVAS_H = 610;

const outerPad = 16;

const inner = {
  x: outerPad + 10,
  y: outerPad + 10,
  w: CANVAS_W - (outerPad + 10) * 2,
  h: CANVAS_H - (outerPad + 10) * 2
};

const header = { pillW: 160, pillH: 34 };

const content = {
  x: inner.x + 18,
  y: inner.y + 98,
  w: inner.w - 36,
  h: inner.h - 98 - 72
};

const leftPanel = { x: content.x, y: content.y, w: 360, h: 420 };

const rightPanel = {
  x: content.x + leftPanel.w + 18,
  y: content.y,
  w: content.w - leftPanel.w - 18,
  h: 280
};

const tipsBox = {
  x: content.x,
  y: content.y + leftPanel.h + 18,
  w: content.w,
  h: 46
};

// posisi slider di layout internal (IMPORTANT)
const SLIDER_LEFT = leftPanel.x + 24;
const SLIDER_TOP = leftPanel.y + 138;
const SLIDER_W = leftPanel.w - 48;

// ---------- Colors ----------
const C = {
  pageBg: "#f7f4ef",
  cardBg: "#ffffff",
  shadow: "rgba(15,23,42,0.08)",

  greenBorder: "#69b07b",
  panelBorder: "rgba(15,23,42,0.10)",

  pillBg: "#ffb08a",
  pillBorder: "#e08f6d",

  text: "#0f172a",
  muted: "#6b7280",

  panelBg: "#f8fafc",
  tabBg: "#ffffff",
  tabActiveBg: "rgba(59,130,246,0.12)",
  tabBorder: "rgba(15,23,42,0.12)",

  chipBorder: "rgba(15,23,42,0.18)",
  chipSpecialBorder: "rgba(217,119,6,0.55)",
  chipSpecialBg: "rgba(217,119,6,0.10)",
  chipSelectedBg: "rgba(217,119,6,0.18)",

  graphHeaderBg: "#f3f4f6",
  grid: "rgba(15,23,42,0.07)",
  axis: "rgba(15,23,42,0.35)",

  curve: "rgba(37,99,235,0.95)",
  pointGreen: "rgba(34,197,94,0.90)",
  pointOrange: "rgba(234,88,12,0.95)",
  symmetry: "rgba(234,88,12,0.55)"
};

// ---------- Math ----------
function f(x) {
  return x * x - 2 * x - 3;
}

// ---------- Responsive wrapper objects ----------
let hostEl;     // div #p5ContohInteraktif1
let wrapDiv;    // wrapper internal fixed size (scaled)
let canvasEl;   // p5 canvas

// skala saat ini (untuk konversi hit-test)
let currentScale = 1;

function setup() {
  // host
  hostEl = document.getElementById("p5ContohInteraktif1");
  if (!hostEl) {
    // fallback: tetap jalan tapi gak ter-embed
    createCanvas(CANVAS_W, CANVAS_H);
    textFont("system-ui");
    selected.x = 0;
    selected.y = f(0);
    buildChips();
    return;
  }

  // bikin wrapper (fixed size) -> nanti kita scale
  wrapDiv = createDiv("");
  wrapDiv.id("p5ci1-wrap");
  wrapDiv.parent("p5ContohInteraktif1");
  wrapDiv.style("position", "relative");
  wrapDiv.style("width", CANVAS_W + "px");
  wrapDiv.style("height", CANVAS_H + "px");
  wrapDiv.style("transform-origin", "top left");

  // canvas parent ke wrapper
  canvasEl = createCanvas(CANVAS_W, CANVAS_H);
  canvasEl.parent(wrapDiv);

  // pastikan canvas tidak punya margin bawaan (kadang bikin offset)
  canvasEl.elt.style.display = "block";

  textFont("system-ui");

  selected.x = 0;
  selected.y = f(0);

  buildChips();

  // slider parent ke wrapper (Bukan host!)
  sliderX = createSlider(-2, 4, selected.x, 1);
  sliderX.parent(wrapDiv);

  // jangan pakai .position() (relatif halaman) — pakai absolute di wrapper
  sliderX.elt.style.position = "absolute";
  sliderX.elt.style.left = SLIDER_LEFT + "px";
  sliderX.elt.style.top = SLIDER_TOP + "px";
  sliderX.elt.style.width = SLIDER_W + "px";
  sliderX.elt.style.zIndex = "10";

  sliderX.input(() => {
    if (activeTab !== "Nilai") return;
    const xx = sliderX.value();
    setSelected(xx, f(xx), false);
  });

  injectSliderCSS();

  // scale pertama kali
  applyScale();
}

function draw() {
  background(C.pageBg);

  drawOuterCard();
  drawHeaderText();

  drawLeftPanel();
  drawRightPanel();
  drawTips();

  // slider hanya muncul di tab Nilai
  if (activeTab === "Nilai") sliderX.show();
  else sliderX.hide();
}

// IMPORTANT: saat window resize -> scale ulang
function windowResized() {
  applyScale();
}

// scale wrapper mengikuti lebar host agar slider & canvas tetap rapih
function applyScale() {
  if (!hostEl || !wrapDiv) return;

  // host width (pakai padding container kalau ada)
  const hostW = hostEl.clientWidth || CANVAS_W;

  // scale maksimal 1 (jangan dibesarkan melebihi design)
  const s = Math.min(hostW / CANVAS_W, 1);
  currentScale = s;

  // scale wrapper (canvas+slider ikut)
  wrapDiv.elt.style.transform = `scale(${s})`;

  // supaya layout halaman “ngikut” tinggi hasil scale
  hostEl.style.height = (CANVAS_H * s) + "px";
  hostEl.style.overflow = "hidden";
}

// ---------- Pointer helper (FIX: hit-test saat scale) ----------
function getPointerDesignXY() {
  // mouseX/mouseY itu koordinat tampilan (setelah CSS scale).
  // Kita balik ke koordinat desain (800x610) dengan membagi currentScale.
  const s = currentScale || 1;
  return { x: mouseX / s, y: mouseY / s };
}

// ---------- UI: Outer card ----------
function drawOuterCard() {
  noStroke();
  fill(C.shadow);
  roundedRect(outerPad + 2, outerPad + 4, CANVAS_W - outerPad * 2, CANVAS_H - outerPad * 2, 18);

  noStroke();
  fill(C.cardBg);
  roundedRect(outerPad, outerPad, CANVAS_W - outerPad * 2, CANVAS_H - outerPad * 2, 18);

  noFill();
  stroke(C.greenBorder);
  strokeWeight(1.4);
  roundedRect(inner.x, inner.y, inner.w, inner.h, 14);
  strokeWeight(1);
}

function drawHeaderText() {
  const pillX = inner.x + 18;
  const pillY = inner.y + 14;

  stroke(C.pillBorder);
  fill(C.pillBg);
  roundedRect(pillX, pillY, header.pillW, header.pillH, 999);

  noStroke();
  fill("#111827");
  textStyle(BOLD);
  textSize(12);
  textAlign(LEFT, CENTER);
  text("CONTOH INTERAKTIF", pillX + 16, pillY + header.pillH / 2);

  textAlign(LEFT, BASELINE);
  fill(C.text);
  textStyle(BOLD);
  textSize(15);
  text("Gambarlah grafik fungsi", inner.x + 18, inner.y + 70);

  textStyle(NORMAL);
  textSize(15);
  text("f(x) = x² − 2x − 3", inner.x + 220, inner.y + 70);

  fill(C.muted);
  textSize(12.5);
  text("Klik chip titik atau geser slider untuk melihat koordinatnya dan posisinya pada grafik.",
       inner.x + 18, inner.y + 92);
}

// ---------- Left panel ----------
function drawLeftPanel() {
  stroke(C.panelBorder);
  fill(C.panelBg);
  roundedRect(leftPanel.x, leftPanel.y, leftPanel.w, leftPanel.h, 12);

  drawSparkle(leftPanel.x + 18, leftPanel.y + 20, 10, "#22c55e");
  noStroke();
  fill(C.text);
  textStyle(BOLD);
  textSize(12.5);
  text("Pilih Bagian yang", leftPanel.x + 34, leftPanel.y + 22);
  text("Dilihat", leftPanel.x + 34, leftPanel.y + 42);

  drawTabs();

  const cx = leftPanel.x + 18;
  const cy = leftPanel.y + 88;

  if (activeTab === "Nilai") drawTabNilai(cx, cy);
  else if (activeTab === "Potong x") drawTabXCut(cx, cy);
  else if (activeTab === "Potong y") drawTabYCut(cx, cy);
  else drawTabVertex(cx, cy);
}

function drawTabs() {
  tabHit = [];
  const startX = leftPanel.x + 150;
  const topY = leftPanel.y + 14;

  let x = startX;
  x = drawTabButton("Nilai", x, topY);
  x += 8;
  x = drawTabButton("Potong x", x, topY);
  x += 8;
  x = drawTabButton("Potong y", x, topY);

  drawTabButton("Vertex", startX, topY + 34);
}

function drawTabButton(label, x, y) {
  textSize(11);
  textStyle(BOLD);
  const w = textWidth(label) + 22;
  const h = 26;

  stroke(C.tabBorder);
  fill(activeTab === label ? C.tabActiveBg : C.tabBg);
  roundedRect(x, y, w, h, 999);

  noStroke();
  fill(C.text);
  textAlign(LEFT, CENTER);
  text(label, x + 11, y + h / 2 + 0.5);

  tabHit.push({ label, x, y, w, h });
  return x + w;
}

// ---- Tab: Nilai
function drawTabNilai(x, y) {
  fill(C.text);
  textStyle(BOLD);
  textSize(12.5);
  text("Geser untuk memilih x", x, y);

  stroke("rgba(15,23,42,0.10)");
  strokeWeight(1);
  line(x, y + 34, x + leftPanel.w - 36, y + 34);

  drawKPI(x, y + 52, "x", selected.x, "F(X)", selected.y);

  noStroke();
  fill(C.text);
  textStyle(BOLD);
  textSize(12);
  text("Perhitungan cepat:", x, y + 148);

  stroke("rgba(15,23,42,0.10)");
  fill("#ffffff");
  roundedRect(x, y + 160, leftPanel.w - 36, 44, 12);

  noStroke();
  fill(C.text);
  textStyle(ITALIC);
  textSize(13);
  text("f(x) = x² − 2x − 3", x + 16, y + 188);

  textStyle(NORMAL);
  fill(C.text);
  textSize(12);
  const xx = selected.x;
  const yy = selected.y;
  text(`f(${xx}) = ${xx}² − 2(${xx}) − 3 = ${yy}`, x, y + 226);

  fill(C.text);
  textStyle(BOLD);
  textSize(12);
  text("Klik salah satu titik:", x, y + 260);

  drawChips(chips, x, y + 274, leftPanel.w - 36);
}

// ---- Tab: Potong x
function drawTabXCut(x, y) {
  fill(C.text);
  textStyle(BOLD);
  textSize(12.5);
  text("Titik potong sumbu-x", x, y);

  const cardW = leftPanel.w - 36 - 44;
  const cardH = 64;
  const cardX = x + 22;
  const cardY = y + 34;

  stroke("rgba(15,23,42,0.10)");
  fill("#ffffff");
  roundedRect(cardX, cardY, cardW, cardH, 12);

  noStroke();
  fill(C.text);
  textStyle(ITALIC);
  textSize(12.5);
  text("x² − 2x − 3 = 0 ⇒ (x − 3)(x + 1) = 0", cardX + 16, cardY + 38);

  fill(C.text);
  textStyle(BOLD);
  textSize(12);
  text("Jadi titik potong sumbu-x:  (−1, 0)  dan  (3, 0).", x, y + 128);

  drawChips(specialChips.filter(c => c.group === "xcut"), x, y + 144, leftPanel.w - 36);
}

// ---- Tab: Potong y
function drawTabYCut(x, y) {
  fill(C.text);
  textStyle(BOLD);
  textSize(12.5);
  text("Titik potong sumbu-y", x, y);

  const cardW = leftPanel.w - 36 - 110;
  const cardH = 54;
  const cardX = x + 55;
  const cardY = y + 38;

  stroke("rgba(15,23,42,0.10)");
  fill("#ffffff");
  roundedRect(cardX, cardY, cardW, cardH, 12);

  noStroke();
  fill(C.text);
  textStyle(ITALIC);
  textSize(12.5);
  text("x = 0  ⇒  f(0) = −3", cardX + 18, cardY + 33);

  fill(C.text);
  textStyle(BOLD);
  textSize(12);
  text("Jadi titik potong sumbu-y:  (0, −3).", x, y + 120);

  drawChips(specialChips.filter(c => c.group === "ycut"), x, y + 136, leftPanel.w - 36);
}

// ---- Tab: Vertex
function drawTabVertex(x, y) {
  fill(C.text);
  textStyle(BOLD);
  textSize(12.5);
  text("Titik puncak (vertex) & sumbu simetri", x, y);

  const cardW = leftPanel.w - 36 - 90;
  const cardH = 64;
  const cardX = x + 45;
  const cardY = y + 38;

  stroke("rgba(15,23,42,0.10)");
  fill("#ffffff");
  roundedRect(cardX, cardY, cardW, cardH, 12);

  noStroke();
  fill(C.text);
  textStyle(ITALIC);
  textSize(12.5);
  text("f(x) = x² − 2x − 3  =  (x − 1)² − 4", cardX + 16, cardY + 38);

  fill(C.text);
  textStyle(BOLD);
  textSize(12);
  text("Vertex: (1, −4),  sumbu simetri: x = 1.", x, y + 128);

  drawChips(specialChips.filter(c => c.group === "vertex"), x, y + 144, leftPanel.w - 36);
}

function drawKPI(x, y, l1, v1, l2, v2) {
  const boxW = (leftPanel.w - 36 - 12) / 2;
  const boxH = 56;

  stroke("rgba(15,23,42,0.10)");
  fill("#ffffff");
  roundedRect(x, y, boxW, boxH, 12);
  roundedRect(x + boxW + 12, y, boxW, boxH, 12);

  noStroke();
  fill(C.muted);
  textStyle(BOLD);
  textSize(10.5);
  text(l1, x + 12, y + 18);
  text(l2, x + boxW + 24, y + 18);

  fill(C.text);
  textSize(16);
  textStyle(BOLD);
  text(v1, x + 12, y + 44);
  text(v2, x + boxW + 24, y + 44);
}

function drawChips(list, x, y, maxW) {
  let bx = x;
  let by = y;
  const gap = 8;
  const h = 28;

  textSize(11.5);
  textStyle(BOLD);
  textAlign(LEFT, CENTER);

  for (let c of list) {
    const w = textWidth(c.label) + 22;

    if (bx + w > x + maxW) {
      bx = x;
      by += h + 8;
    }

    const isSelected = (selected.x === c.x && selected.y === c.y);

    if (c.special) {
      stroke(C.chipSpecialBorder);
      fill(isSelected ? C.chipSelectedBg : C.chipSpecialBg);
    } else {
      stroke(C.chipBorder);
      fill("#ffffff");
    }

    roundedRect(bx, by, w, h, 999);

    noStroke();
    fill(C.text);
    text(c.label, bx + 11, by + h / 2 + 0.5);

    c.rx = bx; c.ry = by; c.rw = w; c.rh = h;

    bx += w + gap;
  }

  textAlign(LEFT, BASELINE);
}

// ---------- Right panel (graph) ----------
function drawRightPanel() {
  stroke(C.panelBorder);
  fill("#ffffff");
  roundedRect(rightPanel.x, rightPanel.y, rightPanel.w, rightPanel.h, 12);

  noStroke();
  fill(C.graphHeaderBg);
  roundedRect(rightPanel.x, rightPanel.y, rightPanel.w, 36, 12);
  fill(C.graphHeaderBg);
  rect(rightPanel.x, rightPanel.y + 18, rightPanel.w, 18);

  drawPinkIcon(rightPanel.x + 14, rightPanel.y + 18);

  fill(C.text);
  textStyle(BOLD);
  textSize(12);
  textAlign(LEFT, CENTER);
  text("Grafik (klik titik/label)", rightPanel.x + 34, rightPanel.y + 18);

  fill("#475569");
  textStyle(BOLD);
  textAlign(RIGHT, CENTER);
  text(`Titik aktif: (${selected.x}, ${selected.y})`, rightPanel.x + rightPanel.w - 14, rightPanel.y + 18);

  const px = rightPanel.x + 26;
  const py = rightPanel.y + 52;
  const pw = rightPanel.w - 52;
  const ph = rightPanel.h - 74;

  stroke("rgba(15,23,42,0.10)");
  fill("#ffffff");
  roundedRect(px, py, pw, ph, 10);

  const mx = px + 26;
  const my = py + 16;
  const mw = pw - 44;
  const mh = ph - 38;

  let yMin = 1e9, yMax = -1e9;
  for (let i = 0; i <= 260; i++) {
    const xx = lerp(world.xMin, world.xMax, i / 260);
    const yy = f(xx);
    yMin = min(yMin, yy);
    yMax = max(yMax, yy);
  }
  const padY = (yMax - yMin) * 0.14 + 1;
  yMin -= padY;
  yMax += padY;

  const sx = (x) => mx + (x - world.xMin) * mw / (world.xMax - world.xMin);
  const sy = (y) => my + (yMax - y) * mh / (yMax - yMin);

  stroke(C.grid);
  strokeWeight(1);
  for (let gx = -3; gx <= 5; gx++) {
    const X = sx(gx);
    line(X, my, X, my + mh);
  }
  for (let i = 0; i <= 6; i++) {
    const yy = lerp(yMin, yMax, i / 6);
    const Y = sy(yy);
    line(mx, Y, mx + mw, Y);
  }

  stroke(C.axis);
  strokeWeight(1.8);
  if (0 >= yMin && 0 <= yMax) line(mx, sy(0), mx + mw, sy(0));
  if (0 >= world.xMin && 0 <= world.xMax) line(sx(0), my, sx(0), my + mh);

  drawDashedLine(sx(1), my, sx(1), my + mh, 6);

  noFill();
  stroke(C.curve);
  strokeWeight(2.8);
  beginShape();
  for (let i = 0; i <= 320; i++) {
    const xx = lerp(world.xMin, world.xMax, i / 320);
    vertex(sx(xx), sy(f(xx)));
  }
  endShape();

  noStroke();
  fill("rgba(15,23,42,0.55)");
  textStyle(BOLD);
  textSize(10);
  textAlign(CENTER, TOP);
  for (let gx = -3; gx <= 5; gx++) {
    text(gx, sx(gx), my + mh + 8);
  }

  buildGraphHitPoints(sx, sy);

  textAlign(LEFT, BASELINE);
  fill("rgba(107,114,128,0.95)");
  textStyle(NORMAL);
  textSize(10.5);
  text("Klik titik pada grafik untuk memilih.", rightPanel.x + 14, rightPanel.y + rightPanel.h - 10);

  textAlign(LEFT, BASELINE);
}

function buildGraphHitPoints(sx, sy) {
  graphHitPts = [];

  for (const xx of baseXs) {
    const yy = f(xx);
    const X = sx(xx);
    const Y = sy(yy);

    const isSpecial = specialPts.some(p => p.x === xx && p.y === yy);
    const isSelected = (selected.x === xx && selected.y === yy);

    noStroke();
    fill(isSpecial ? C.pointOrange : C.pointGreen);
    const r = isSelected ? 7.5 : 6;
    circle(X, Y, r * 2);

    noFill();
    stroke("rgba(255,255,255,0.95)");
    strokeWeight(2);
    circle(X, Y, r * 2 + 5);

    noStroke();
    fill("rgba(15,23,42,0.78)");
    textStyle(BOLD);
    textSize(10);
    textAlign(LEFT, CENTER);

    let dx = 10;
    let dy = (xx === 0 || xx === 1) ? 16 : -12;
    if (xx === 3) dy = 16;

    text(`(${xx}, ${yy})`, X + dx, Y + dy);

    graphHitPts.push({ x: xx, y: yy, sx: X, sy: Y, r: 12 });
  }

  textAlign(LEFT, BASELINE);
  strokeWeight(1);
}

// ---------- Interactions (FIX: gunakan pointer desain) ----------
function mousePressed() {
  const p = getPointerDesignXY();
  if (hitTabs(p.x, p.y)) return;
  if (hitChips(p.x, p.y)) return;
  if (hitGraphPoints(p.x, p.y)) return;
}

// dukungan mobile: tap
function touchStarted() {
  // biar p5 gak scroll halaman saat tap di canvas
  const handled = (mousePressed(), true);
  return handled;
}

function hitTabs(px, py) {
  for (const t of tabHit) {
    if (px >= t.x && px <= t.x + t.w && py >= t.y && py <= t.y + t.h) {
      activeTab = t.label;
      if (activeTab === "Nilai") sliderX.value(constrain(selected.x, -2, 4));
      return true;
    }
  }
  return false;
}

function hitChips(px, py) {
  for (const c of chips) {
    if (hitRect(c, px, py)) {
      setSelected(c.x, c.y, true);
      return true;
    }
  }
  for (const c of specialChips) {
    if (hitRect(c, px, py)) {
      activeTab = "Nilai";
      setSelected(c.x, c.y, true);
      sliderX.value(constrain(c.x, -2, 4));
      return true;
    }
  }
  return false;
}

function hitGraphPoints(px, py) {
  for (const p of graphHitPts) {
    // px/py sudah koordinat desain, sama dengan p.sx/p.sy
    if (dist(px, py, p.sx, p.sy) <= p.r) {
      setSelected(p.x, p.y, true);
      if (p.x >= -2 && p.x <= 4) sliderX.value(p.x);
      return true;
    }
  }
  return false;
}

function hitRect(c, px, py) {
  if (c.rx == null) return false;
  return px >= c.rx && px <= c.rx + c.rw && py >= c.ry && py <= c.ry + c.rh;
}

function setSelected(x, y, syncSliderIfNilai) {
  selected.x = x;
  selected.y = y;
  if (syncSliderIfNilai && activeTab === "Nilai") {
    sliderX.value(constrain(x, -2, 4));
  }
}

// ---------- Data builders ----------
function buildChips() {
  chips = baseXs.map(xx => {
    const yy = f(xx);
    const isSpecial = specialPts.some(p => p.x === xx && p.y === yy);
    return { x: xx, y: yy, label: `(${xx}, ${yy})`, special: isSpecial };
  });

  specialChips = [
    { x: -1, y: 0, label: "(−1, 0)", special: true, group: "xcut" },
    { x: 3, y: 0, label: "(3, 0)", special: true, group: "xcut" },
    { x: 0, y: -3, label: "(0, −3)", special: true, group: "ycut" },
    { x: 1, y: -4, label: "(1, −4)", special: true, group: "vertex" }
  ];
}

// ---------- Tips box (yang kamu panggil tapi belum ada di snippet) ----------
function drawTips() {}
  // kalau kamu sudah punya versi sendiri, boleh ganti.

function roundedRect(x, y, w, h, r) {
  rect(x, y, w, h, r);
}

function drawDashedLine(x1, y1, x2, y2, dash) {
  stroke(C.symmetry);
  strokeWeight(2);
  const total = dist(x1, y1, x2, y2);
  const steps = floor(total / dash);
  for (let i = 0; i < steps; i += 2) {
    const t1 = i / steps;
    const t2 = (i + 1) / steps;
    line(lerp(x1, x2, t1), lerp(y1, y2, t1), lerp(x1, x2, t2), lerp(y1, y2, t2));
  }
  strokeWeight(1);
}

function drawSparkle(cx, cy, s, col) {
  push();
  translate(cx, cy);
  noStroke();
  fill(col);
  beginShape();
  vertex(0, -s);
  vertex(s * 0.35, -s * 0.35);
  vertex(s, 0);
  vertex(s * 0.35, s * 0.35);
  vertex(0, s);
  vertex(-s * 0.35, s * 0.35);
  vertex(-s, 0);
  vertex(-s * 0.35, -s * 0.35);
  endShape(CLOSE);
  pop();
}

function drawPinkIcon(x, y) {
  push();
  translate(x, y);
  noStroke();
  fill("rgba(236,72,153,0.18)");
  roundedRect(-8, -8, 16, 16, 4);
  stroke("rgba(236,72,153,0.65)");
  strokeWeight(1.6);
  noFill();
  beginShape();
  vertex(-5, 2);
  vertex(-2, -2);
  vertex(1, 1);
  vertex(5, -4);
  endShape();
  pop();
}

function injectSliderCSS() {
  // inject sekali saja
  if (document.getElementById("p5-ci1-slider-style")) return;

  const style = document.createElement("style");
  style.id = "p5-ci1-slider-style";

  // CSS dibatasi ke wrapper ini biar gak ganggu slider lain di halaman
  style.textContent = `
    #p5ContohInteraktif1 #p5ci1-wrap input[type=range]{
      -webkit-appearance:none;
      appearance:none;
      height:6px;
      border-radius:999px;
      background: rgba(15,23,42,0.22);
      outline:none;
      margin:0;
      padding:0;
    }
    #p5ContohInteraktif1 #p5ci1-wrap input[type=range]::-webkit-slider-runnable-track{
      height:6px;
      border-radius:999px;
      background: rgba(15,23,42,0.22);
    }
    #p5ContohInteraktif1 #p5ci1-wrap input[type=range]::-webkit-slider-thumb{
      -webkit-appearance:none;
      width:14px;
      height:14px;
      border-radius:50%;
      background:#2563eb;
      border: 2px solid rgba(37,99,235,0.35);
      box-shadow: 0 2px 6px rgba(15,23,42,0.15);
      cursor:pointer;
      margin-top:-4px; /* center thumb on track */
    }
    #p5ContohInteraktif1 #p5ci1-wrap input[type=range]::-moz-range-track{
      height:6px;
      border-radius:999px;
      background: rgba(15,23,42,0.22);
    }
    #p5ContohInteraktif1 #p5ci1-wrap input[type=range]::-moz-range-thumb{
      width:14px;
      height:14px;
      border-radius:50%;
      background:#2563eb;
      border: 2px solid rgba(37,99,235,0.35);
      box-shadow: 0 2px 6px rgba(15,23,42,0.15);
      cursor:pointer;
    }
  `;
  document.head.appendChild(style);
}