// public/js/interaktif1b1.js
// UI latihan sesuai contoh gambar (4 panel warna, rapi dalam #p5-interaktif-1b1)
// Tidak memakai p5 agar tidak bentrok dengan interaktif1b.js

(function () {
  const host = document.getElementById("p5-interaktif-1b1");
  if (!host) return;

  // ------- helper -------
  const el = (tag, cls, html) => {
    const n = document.createElement(tag);
    if (cls) n.className = cls;
    if (html !== undefined) n.innerHTML = html;
    return n;
  };

  const setStyles = (node, styles) => {
    Object.entries(styles).forEach(([k, v]) => (node.style[k] = v));
    return node;
  };

  const mark = (input, ok) => {
    input.style.borderColor = ok ? "rgba(27,122,42,.55)" : "rgba(220,53,69,.55)";
    input.style.background = ok ? "rgba(27,122,42,.06)" : "rgba(220,53,69,.06)";
  };

  const resetMark = (input) => {
    input.style.borderColor = "rgba(0,0,0,.18)";
    input.style.background = "#fff";
  };

  // ------- base host cleanup + frame -------
  host.innerHTML = "";
  host.style.position = "relative";
  host.style.overflow = "hidden";

  const frame = el("div");
  setStyles(frame, {
    position: "absolute",
    inset: "0",
    overflow: "auto",
    padding: "18px",
    boxSizing: "border-box",
    background: "#eaf3ff",
  });
  host.appendChild(frame);

  const wrap = el("div");
  setStyles(wrap, {
    maxWidth: "760px",
    margin: "0 auto",
    display: "grid",
    gap: "14px",
  });
  frame.appendChild(wrap);

  // ------- header card -------
  const header = el("div");
  setStyles(header, {
    background: "#fff",
    borderRadius: "14px",
    padding: "14px 16px",
    border: "1px solid rgba(0,0,0,.10)",
    boxShadow: "0 10px 22px rgba(0,0,0,.05)",
  });

  header.appendChild(
    el("div", "", `Latihan Interaktif — "Ayo Telusuri Derajatnya!"`)
  );
  header.firstChild.style.fontWeight = "900";
  header.firstChild.style.fontSize = "18px";
  header.firstChild.style.color = "#1e3a8a";

  const headerSub = el(
    "div",
    "",
    "Isi jawaban pada setiap bagian, lalu klik tombol Cek Jawaban."
  );
  setStyles(headerSub, { marginTop: "4px", color: "#555" });
  header.appendChild(headerSub);

  wrap.appendChild(header);

  // ------- common card style -------
  function card(bg) {
    const c = el("div");
    setStyles(c, {
      background: bg,
      borderRadius: "16px",
      padding: "14px 16px",
      border: "1px solid rgba(0,0,0,.10)",
      boxShadow: "0 10px 22px rgba(0,0,0,.05)",
    });
    return c;
  }

  function title(text) {
    const t = el("div", "", text);
    setStyles(t, { fontWeight: "900", color: "#1e3a8a", marginBottom: "8px" });
    return t;
  }

  function rowLine() {
    const r = el("div");
    setStyles(r, {
      display: "grid",
      gridTemplateColumns: "1fr auto",
      gap: "10px",
      alignItems: "center",
      marginTop: "10px",
    });
    return r;
  }

  // baris fleksibel: teks + input di kanan (lebih cocok untuk soal no 3)
  function rowFlex() {
    const r = el("div");
    setStyles(r, {
      display: "flex",
      gap: "12px",
      alignItems: "center",
      justifyContent: "space-between",
      flexWrap: "wrap",
      marginTop: "10px",
    });
    return r;
  }

  function selectBase() {
    const s = document.createElement("select");
    setStyles(s, {
      fontFamily: '"Times New Roman", Times, serif',
      fontSize: "15px",
      padding: "6px 10px",
      borderRadius: "8px",
      border: "1px solid rgba(0,0,0,.18)",
      background: "#fff",
      outline: "none",
      minWidth: "74px",
    });
    return s;
  }

  function inputBase(width = 90) {
    const i = document.createElement("input");
    i.type = "text";
    setStyles(i, {
      fontFamily: '"Times New Roman", Times, serif',
      fontSize: "15px",
      padding: "6px 10px",
      borderRadius: "8px",
      border: "1px solid rgba(0,0,0,.18)",
      background: "#fff",
      outline: "none",
      width: `${width}px`,
      boxSizing: "border-box",
    });
    return i;
  }

  // helper untuk teks formula agar rapi (no wrap + font lebih stabil)
  function formulaLineHTML(html) {
    const d = el("div", "", html);
    setStyles(d, {
      color: "#111",
      marginBottom: "6px",
      lineHeight: "1.4",
      fontWeight: "700",
      whiteSpace: "nowrap",
      overflowX: "auto",
      paddingBottom: "2px",
    });
    return d;
  }

  function subtleText(html) {
    const d = el("div", "", html);
    setStyles(d, { color: "#333", marginBottom: "10px" });
    return d;
  }

  // =========================================================
  // 1) Tebak cepat (True/False)  [kuning]
  // =========================================================
  const c1 = card("#fff3c6");
  c1.appendChild(title("1. Tebak Cepat (True or False)"));

  const r1a = rowLine();
  r1a.appendChild(el("div", "", "a. Bentuk $9x^4y^2$ memiliki derajat 6."));
  const s1a = selectBase();
  ["Pilih", "Benar", "Salah"].forEach((x) => {
    const o = el("option", "", x);
    o.value = x;
    s1a.appendChild(o);
  });
  r1a.appendChild(s1a);

  const r1b = rowLine();
  r1b.appendChild(el("div", "", "b. Suku $-7$ selalu memiliki derajat 0."));
  const s1b = selectBase();
  ["Pilih", "Benar", "Salah"].forEach((x) => {
    const o = el("option", "", x);
    o.value = x;
    s1b.appendChild(o);
  });
  r1b.appendChild(s1b);

  c1.appendChild(r1a);
  c1.appendChild(r1b);
  wrap.appendChild(c1);

  // =========================================================
  // 2) Pilih pemenangnya (Suku paling kuat) [biru]
  //    ✅ rumus dirapikan supaya tidak berantakan
  // =========================================================
  const c2 = card("#d9ecff");
  c2.appendChild(title("2. Pilih Pemenangnya! (Suku Paling Kuat)"));

  // ✅ formula rapi (nowrap + scroll kalau layar sempit)
  c2.appendChild(
    formulaLineHTML(
      `Perhatikan polinomial:&nbsp; <span style="font-weight:900;">$T(x)=3x^5-2x^3+10x$</span>`
    )
  );

  c2.appendChild(
    subtleText("Suku dengan pangkat tertinggi memimpin saat $x$ besar.")
  );

  const r2a = rowLine();
  r2a.appendChild(el("div", "", "<b>Suku paling kuat:</b>"));
  const s2 = selectBase();
  ["Pilih suku", "3x^5", "-2x^3", "10x"].forEach((x) => {
    const o = el("option", "", x);
    o.value = x;
    s2.appendChild(o);
  });
  setStyles(s2, { minWidth: "110px" });
  r2a.appendChild(s2);

  const r2b = rowLine();
  r2b.appendChild(el("div", "", "<b>Derajat polinomial:</b>"));
  const i2 = inputBase(90);
  r2b.appendChild(i2);

  c2.appendChild(r2a);
  c2.appendChild(r2b);
  wrap.appendChild(c2);

  // =========================================================
  // 3) Isi Kotak Misteri (Menjumlah Pangkat) [pink]
  //    ✅ hilangkan "3+1+2=" -> input langsung di samping soal
  // =========================================================
  const c3 = card("#ffd9df");
  c3.appendChild(title("3. Isi Kotak Misteri (Menjumlah Pangkat)"));

  const r3wrap = rowFlex();
  const t3a = el("div", "", "Tentukan derajat monomial: &nbsp; <b>$4a^3 b\\, c^2$</b>");
  setStyles(t3a, { color: "#111", flex: "1 1 420px", minWidth: "260px" });
  r3wrap.appendChild(t3a);

  const i3 = inputBase(110);
  i3.placeholder = "";
  setStyles(i3, { flex: "0 0 auto" });
  r3wrap.appendChild(i3);

  c3.appendChild(r3wrap);
  wrap.appendChild(c3);

  // =========================================================
  // 4) Detektif Polinomial [hijau]
  // =========================================================
  const c4 = card("#e6f6d9");
  c4.appendChild(title("4. Detektif Polinomial (Sebutkan Alasannya!)"));

  const t4a = el("div", "", "G(x,y) = <b>$5x^2y^3$ − $xy$ + 4</b>");
  setStyles(t4a, { color: "#111", marginBottom: "10px" });
  c4.appendChild(t4a);

  const r4a = rowLine();
  r4a.appendChild(el("div", "", "a.&nbsp; <b>Derajat tertinggi:</b>"));
  const i4a = inputBase(120);
  r4a.appendChild(i4a);

  const r4b = rowLine();
  r4b.appendChild(el("div", "", "b.&nbsp; <b>Derajat polinomial G(x,y):</b>"));
  const i4b = inputBase(120);
  r4b.appendChild(i4b);

  c4.appendChild(r4a);
  c4.appendChild(r4b);

  // tombol cek jawaban (kanan bawah)
  const btnRow = el("div");
  setStyles(btnRow, {
    display: "flex",
    justifyContent: "flex-end",
    marginTop: "12px",
  });

  const btn = el("button", "", "Cek Jawaban");
  setStyles(btn, {
    padding: "9px 14px",
    borderRadius: "10px",
    border: "0",
    background: "#2b6cb0",
    color: "#fff",
    fontWeight: "900",
    cursor: "pointer",
    boxShadow: "0 10px 22px rgba(0,0,0,.12)",
  });
  btnRow.appendChild(btn);
  c4.appendChild(btnRow);

  // feedback
  const feedback = el("div");
  setStyles(feedback, {
    marginTop: "10px",
    fontWeight: "900",
    color: "#1b7a2a",
  });
  c4.appendChild(feedback);

  wrap.appendChild(c4);

  // ------- check answers -------
  function check() {
    feedback.textContent = "";
    feedback.style.color = "#1b7a2a";

    // reset marks
    [s1a, s1b, s2, i2, i3, i4a, i4b].forEach(resetMark);

    let ok = true;
    const notes = [];

    // 1a: 9x^4 y^2 derajat 4+2=6 => Benar
    const ans1a = s1a.value === "Benar";
    mark(s1a, ans1a);
    if (!ans1a) { ok = false; notes.push("Bagian 1a salah."); }

    // 1b: -7 derajat 0 => Benar
    const ans1b = s1b.value === "Benar";
    mark(s1b, ans1b);
    if (!ans1b) { ok = false; notes.push("Bagian 1b salah."); }

    // 2: suku paling kuat = 3x^5
    const ans2a = s2.value === "3x^5";
    mark(s2, ans2a);
    if (!ans2a) { ok = false; notes.push("Bagian 2 (suku paling kuat) salah."); }

    // 2: derajat polinomial = 5
    const ans2b = String(i2.value).trim() === "5";
    mark(i2, ans2b);
    if (!ans2b) { ok = false; notes.push("Bagian 2 (derajat polinomial) salah."); }

    // 3: 4a^3 b c^2 derajat 3+1+2=6
    const ans3 = String(i3.value).trim() === "6";
    mark(i3, ans3);
    if (!ans3) { ok = false; notes.push("Bagian 3 salah."); }

    // 4a: derajat tertinggi = 5 (dari 5x^2y^3)
    const ans4a = String(i4a.value).trim() === "5";
    mark(i4a, ans4a);
    if (!ans4a) { ok = false; notes.push("Bagian 4a salah."); }

    // 4b: derajat polinomial = 5
    const ans4b = String(i4b.value).trim() === "5";
    mark(i4b, ans4b);
    if (!ans4b) { ok = false; notes.push("Bagian 4b salah."); }

    if (ok) {
      feedback.textContent = "✅ Semua jawaban benar! Mantap 🎉";
      feedback.style.color = "#1b7a2a";
    } else {
      feedback.innerHTML = `❌ Masih ada yang salah:<br>${notes.map(n => "• " + n).join("<br>")}`;
      feedback.style.color = "#7a2b2b";
    }

    // re-render KaTeX jika auto-render tersedia (biar $...$ jadi rapi)
    try {
      if (window.renderMathInElement) {
        window.renderMathInElement(frame, {
          delimiters: [
            { left: "$$", right: "$$", display: true },
            { left: "$", right: "$", display: false },
          ],
        });
      }
    } catch (e) {}
  }

  btn.addEventListener("click", check);

  // render KaTeX pertama kali (kalau ada)
  try {
    if (window.renderMathInElement) {
      window.renderMathInElement(frame, {
        delimiters: [
          { left: "$$", right: "$$", display: true },
          { left: "$", right: "$", display: false },
        ],
      });
    }
  } catch (e) {}
})();