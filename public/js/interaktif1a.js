/* ===========================================================
   KUIS POLINOMIAL vs BUKAN POLINOMIAL – FEEDBACK DI BAWAH SOAL
   - canvas di belakang (tidak menangkap klik)
   - feedback selalu berada DI BAWAH tiap soal (bukan di samping)
   - app TIDAK absolute
   - SEMUA masuk ke div: #p5-interaktif-1a
=========================================================== */

let app, q1Card, q2Card;
let r1, r2, fb1, fb2;
let cnv;

function setup() {
    // ✅ canvas dibuat & ditempel ke div latihan
    const host = document.getElementById("p5-interaktif-1a");
    cnv = createCanvas(host.clientWidth, 720);
    cnv.parent("p5-interaktif-1a");

    // ✅ canvas jadi background & tidak ganggu klik
    cnv.style("position", "absolute");
    cnv.style("left", "0");
    cnv.style("top", "0");
    cnv.style("z-index", "0");
    cnv.style("pointer-events", "none");

    injectCSS();
    buildUI();
}

function draw() {
    drawBackground();
}

/* ---------------- BACKGROUND CANVAS ---------------- */

function drawBackground() {
    let c1 = color(240, 248, 255);
    let c2 = color(214, 232, 250);
    for (let y = 0; y < height; y++) {
        stroke(lerpColor(c1, c2, y / height));
        line(0, y, width, y);
    }

    noStroke();
    fill(255, 255, 255, 70);
    circle(70, 80, 110);
    circle(width - 80, 120, 140);
    circle(width - 120, height - 90, 170);
    circle(140, height - 80, 130);
}

/* ---------------- UI DOM ---------------- */

function buildUI() {
    app = createDiv();
    app.addClass("app");
    app.parent("p5-interaktif-1a"); // ✅ masuk ke wadah latihan
    app.size(width, height);

    const header = createDiv();
    header.addClass("header");
    header.parent(app);

    createDiv("Polinomial vs Bukan Polinomial").addClass("title").parent(header);
    createDiv("Pilih jawaban lalu klik Cek Jawaban. Gunakan Reset untuk mengulang.").addClass("subtitle").parent(header);

    const panel = createDiv();
    panel.addClass("panel");
    panel.parent(app);

    // ===== SOAL 1 =====
    q1Card = createDiv().addClass("qcard idle");
    q1Card.parent(panel);
    makeBadge(q1Card, "1");

    const q1Content = createDiv().addClass("qcontent");
    q1Content.parent(q1Card);

    const q1Text = createDiv().addClass("qtext");
    q1Text.html(`
    <div class="qprompt">Tentukan apakah bentuk berikut polinomial:</div>
    <div class="qexpr">4x³ − 2x + 5</div>
  `);
    q1Text.parent(q1Content);

    const q1Row = createDiv().addClass("qrow");
    q1Row.parent(q1Content);

    r1 = createRadio();
    r1.attribute("name", "q1");   // ✅ tambah ini
    r1.option("Polinomial");
    r1.option("Bukan Polinomial");
    setRadioGroupName(r1, "q1");
    r1.addClass("radio");
    r1.parent(q1Row);

    fb1 = createDiv("");
    fb1.addClass("fb");
    fb1.parent(q1Content);

    // Divider
    createDiv().addClass("divider").parent(panel);

    // ===== SOAL 2 =====
    q2Card = createDiv().addClass("qcard idle");
    q2Card.parent(panel);
    makeBadge(q2Card, "2");

    function setRadioGroupName(radioObj, groupName) {
        const inputs = radioObj.elt.querySelectorAll('input[type="radio"]');
        inputs.forEach((inp) => (inp.name = groupName));
    }

    const q2Content = createDiv().addClass("qcontent");
    q2Content.parent(q2Card);

    const q2Text = createDiv().addClass("qtext");
    q2Text.html(`
    <div class="qprompt">Tentukan apakah bentuk berikut polinomial:</div>
    <div class="qexpr">1/y + 2y</div>`);
    q2Text.parent(q2Content);

    const q2Row = createDiv().addClass("qrow");
    q2Row.parent(q2Content);

    r2 = createRadio();
    r2.attribute("name", "q2");
    r2.option("Polinomial");
    r2.option("Bukan Polinomial");
    setRadioGroupName(r2, "q2");
    r2.addClass("radio");
    r2.parent(q2Row);

    fb2 = createDiv("");
    fb2.addClass("fb");
    fb2.parent(q2Content);

    // Buttons
    const actions = createDiv().addClass("actions");
    actions.parent(panel);

    const btnRow = createDiv().addClass("btnrow");
    btnRow.parent(actions);

    const reset = createButton("Reset");
    reset.addClass("btn btnGhost");
    reset.parent(btnRow);
    reset.mousePressed(resetQuiz);

    const check = createButton("Cek Jawaban");
    check.addClass("btn btnPrimary");
    check.parent(btnRow);
    check.mousePressed(checkAnswers);
}

function makeBadge(parentDiv, text) {
    const badgeWrap = createDiv().addClass("badgeWrap");
    badgeWrap.parent(parentDiv);

    createDiv(text).addClass("badge").parent(badgeWrap);
}

/* ---------------- LOGIC ---------------- */

function checkAnswers() {
    const ans1 = r1.value();
    const ans2 = r2.value();

    // SOAL 1 (benar: Polinomial)
    if (!ans1) {
        setState(q1Card, fb1, "warn", "Pilih salah satu jawaban dulu.");
    } else if (ans1 === "Polinomial") {
        setState(q1Card, fb1, "correct", "✔ Benar.");
    } else {
        setState(
            q1Card,
            fb1,
            "wrong",
            "✘ Salah. Penjelasan: Ini polinomial karena pangkat variabel bilangan bulat tak negatif (3 dan 1) dan tidak ada variabel di penyebut/akar."
        );
    }

    // SOAL 2 (benar: Bukan Polinomial)
    if (!ans2) {
        setState(q2Card, fb2, "warn", "Pilih salah satu jawaban dulu.");
    } else if (ans2 === "Bukan Polinomial") {
        setState(q2Card, fb2, "correct", "✔ Benar.");
    } else {
        setState(
            q2Card,
            fb2,
            "wrong",
            "✘ Salah. Penjelasan: Ini bukan polinomial karena 1/y = y⁻¹ (pangkat negatif), artinya variabel ada di penyebut."
        );
    }
}

function resetQuiz() {
    r1.value("");
    r2.value("");
    fb1.html("");
    fb2.html("");
    setCardState(q1Card, "idle");
    setCardState(q2Card, "idle");
}

function setState(card, fb, state, msg) {
    setCardState(card, state);
    fb.html(msg);

    fb.removeClass("ok");
    fb.removeClass("bad");
    fb.removeClass("warn");

    if (state === "correct") fb.addClass("ok");
    else if (state === "wrong") fb.addClass("bad");
    else fb.addClass("warn");
}

function setCardState(cardDiv, state) {
    cardDiv.removeClass("idle");
    cardDiv.removeClass("correct");
    cardDiv.removeClass("wrong");
    cardDiv.removeClass("warn");
    cardDiv.addClass(state);
}

/* ---------------- CSS ---------------- */

function injectCSS() {
    const css = `
    /* ✅ app tidak absolute */
 .app{
  position: relative;
  width: 100%;              /* ✅ jangan fixed */
  max-width: 100%;
  height: 100%;
  display:flex;
  flex-direction:column;
  gap:14px;
  padding:18px;
  box-sizing:border-box;
  font-family: Arial, sans-serif;
  z-index: 1;
}

    .header{
      background: rgba(20, 60, 90, 0.78);
      color:#fff;
      border-radius:18px;
      padding:16px 22px;
      box-shadow: 0 12px 24px rgba(0,0,0,.12);
    }
    .title{ font-size:26px; font-weight:800; margin-bottom:6px; }
    .subtitle{ opacity:.95; font-size:14px; font-weight:600; }

    .panel{
      flex:1;
      background: rgba(255,255,255,0.92);
      border-radius:18px;
      padding:18px;
      box-shadow: 0 14px 26px rgba(0,0,0,.10);
      display:flex;
      flex-direction:column;
      gap:16px;
      box-sizing:border-box;
        overflow: visible; 
    }

    .qcard{
      background:#fff;
      border-radius:16px;
      border:2px solid #d7e2ec;
      padding:16px 16px 16px 12px;
      display:flex;
      gap:14px;
      align-items:flex-start;
      box-shadow: 0 10px 18px rgba(0,0,0,.06);
      box-sizing:border-box;
    }
    .qcard.idle{ border-color:#d7e2ec; }
    .qcard.correct{ border-color:#2a9d8f; }
    .qcard.wrong{ border-color:#e63946; }
    .qcard.warn{ border-color:#f4a261; }

    .badgeWrap{ width:54px; display:flex; justify-content:center; flex:0 0 auto; }
    .badge{
      width:36px; height:36px;
      border-radius:999px;
      display:flex;
      align-items:center;
      justify-content:center;
      background:#6f93b6;
      color:#fff;
      font-weight:900;
      user-select:none;
    }

    .qcontent{
      flex:1;
      min-width:0;
      display:flex;
      flex-direction:column;
      gap:10px;
    }

    .qtext{ min-width:0; }
    .qprompt{ font-weight:800; color:#1f2d3d; font-size:16px; margin-bottom:6px; }
    .qexpr{ font-size:20px; font-weight:800; color:#0b2b40; }

    .qrow{
      display:flex;
      align-items:flex-start;
      flex-wrap:wrap;
      gap:18px;
    }

    .radio{
      display:flex;
      gap:18px;
      align-items:center;
      flex-wrap:wrap;
      font-size:14px;
      font-weight:700;
      color:#1f2d3d;
    }
    .radio label{ display:flex; gap:8px; align-items:center; cursor:pointer; }
    .radio input{ width:16px; height:16px; cursor:pointer; }

    .fb{
      width:100%;
      box-sizing:border-box;
      font-size:13px;
      font-weight:800;
      padding:10px 12px;
      border-radius:12px;
      background:#f3f6f9;
      color:#2b3a48;
      line-height:1.45;
      white-space:normal;
      overflow-wrap:anywhere;
    }
    .fb:empty{ display:none; }
    .fb.ok{ background: rgba(42,157,143,.10); color:#1b7f73; }
    .fb.bad{ background: rgba(230,57,70,.10); color:#b41f2a; }
    .fb.warn{ background: rgba(244,162,97,.14); color:#b5651d; }

    .divider{ height:1px; background:#e6eef6; margin:2px 6px; }

    .actions{ margin-top:auto; display:flex; justify-content:flex-end; padding-top:6px; }
    .btnrow{ display:flex; gap:12px; }

    .btn{
      border:none;
      border-radius:14px;
      padding:10px 18px;
      font-weight:900;
      cursor:pointer;
      box-shadow: 0 10px 18px rgba(0,0,0,.08);
    }
    .btnGhost{ background:#fff; color:#264653; border:2px solid #cfe3f3; }
    .btnPrimary{ background: linear-gradient(90deg,#2a9d8f,#219ebc); color:#fff; }
  `;
    createElement("style", css).parent(document.head);
}
