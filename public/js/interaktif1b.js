/* =========================================================
   Mari Mencoba: Derajat Suatu Polinomial — RAPI RESPONSIVE
   - Tidak memakai canvas, jadi tinggi otomatis dan tidak kepotong
   - Tidak keluar dari card/container
   - Drag & drop untuk HP, tablet, dan laptop
   - Bisa juga klik angka lalu klik kotak jawaban
   - Jika semua benar, muncul pembahasan semua soal
========================================================= */

(function () {
  "use strict";

  const HOST_ID = "p5-interaktif-1b";

  const questions = [
    {
      text: "Derajat dari (4x<sup>5</sup>)",
      answer: 5,
      explanation:
        "4x<sup>5</sup> memiliki variabel x dengan pangkat 5, sehingga derajatnya adalah 5.",
    },
    {
      text: "Derajat dari (x<sup>2</sup>y<sup>7</sup>)",
      answer: 9,
      explanation:
        "x<sup>2</sup>y<sup>7</sup> memiliki pangkat 2 pada x dan 7 pada y. Jadi derajatnya 2 + 7 = 9.",
    },
    {
      text: "Derajat dari (0.12x)",
      answer: 1,
      explanation:
        "0.12x sama dengan 0.12x<sup>1</sup>. Pangkat variabel x adalah 1, sehingga derajatnya 1.",
    },
    {
      text: "Derajat dari (2.17x<sup>3</sup>yz<sup>3</sup>)",
      answer: 7,
      explanation:
        "2.17x<sup>3</sup>yz<sup>3</sup> sama dengan 2.17x<sup>3</sup>y<sup>1</sup>z<sup>3</sup>. Jadi derajatnya 3 + 1 + 3 = 7.",
    },
    {
      text: "Derajat dari 6a<sup>2</sup>b<sup>4</sup>",
      answer: 6,
      explanation:
        "6a<sup>2</sup>b<sup>4</sup> memiliki pangkat 2 pada a dan 4 pada b. Jadi derajatnya 2 + 4 = 6.",
    },
  ];

  const answerTokens = [5, 9, 1, 7, 6];

  let selectedToken = null;
  let dragState = null;

  const css = `
    #${HOST_ID},
    #${HOST_ID} * {
      box-sizing: border-box;
    }

    #${HOST_ID} {
      width: 100%;
      max-width: 100%;
      min-width: 0;
      overflow-x: hidden;
      font-family: "Poppins", Arial, sans-serif;
      color: #223322;
    }

    #${HOST_ID} .mm-wrapper {
      width: 100%;
      max-width: 100%;
      min-width: 0;
      overflow: hidden;
      background: #e8f5e9;
      border: 2px solid #efdcc4;
      border-radius: 18px;
      padding: 14px;
      box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.75);
    }

    #${HOST_ID} .mm-head {
      text-align: center;
      margin-bottom: 10px;
    }

    #${HOST_ID} .mm-head h3 {
      margin: 0 0 4px;
      font-size: clamp(20px, 2.4vw, 30px);
      line-height: 1.2;
      font-weight: 700;
      color: #243524;
    }

    #${HOST_ID} .mm-head p {
      margin: 0;
      font-size: clamp(13px, 1.4vw, 16px);
      line-height: 1.45;
      color: #6b7f6b;
    }

    #${HOST_ID} .mm-instruction {
      width: 100%;
      max-width: 100%;
      background: #fffdf5;
      border: 2px solid #c7d9c7;
      border-radius: 16px;
      padding: 10px 14px;
      margin: 10px 0 12px;
      box-shadow: 0 4px 0 rgba(43, 75, 43, 0.08);
    }

    #${HOST_ID} .mm-instruction-title {
      margin: 0 0 5px;
      font-weight: 700;
      font-size: clamp(13px, 1.5vw, 15px);
      color: #223322;
    }

    #${HOST_ID} .mm-instruction ol {
      margin: 0;
      padding-left: 20px;
      color: #6b7f6b;
      font-size: clamp(12px, 1.35vw, 14px);
      line-height: 1.45;
    }

    #${HOST_ID} .mm-layout {
      width: 100%;
      max-width: 100%;
      min-width: 0;
      display: grid;
      grid-template-columns: minmax(0, 1fr) minmax(165px, 210px);
      gap: 12px;
      align-items: stretch;
    }

    #${HOST_ID} .mm-questions {
      min-width: 0;
      display: grid;
      gap: 9px;
    }

    #${HOST_ID} .mm-question-card {
      min-width: 0;
      width: 100%;
      display: grid;
      grid-template-columns: minmax(0, 1fr) minmax(92px, 112px);
      gap: 10px;
      align-items: center;
      background: #fbfffb;
      border: 2px solid #a9bda9;
      border-radius: 15px;
      padding: 9px 10px;
      min-height: 58px;
      box-shadow: 3px 4px 0 rgba(43, 75, 43, 0.12);
      transition: background 0.18s ease, border-color 0.18s ease;
    }

    #${HOST_ID} .mm-question-card.is-correct {
      background: #e8f8ed;
      border-color: #28a745;
    }

    #${HOST_ID} .mm-question-card.is-wrong {
      background: #ffebeb;
      border-color: #e53e3e;
    }

    #${HOST_ID} .mm-question-text {
      min-width: 0;
      display: flex;
      align-items: center;
      gap: 7px;
      flex-wrap: wrap;
      color: #263826;
      font-size: clamp(13px, 1.45vw, 16px);
      line-height: 1.35;
      overflow-wrap: anywhere;
      word-break: normal;
    }

    #${HOST_ID} .mm-number {
      font-weight: 700;
      flex: 0 0 auto;
    }

    #${HOST_ID} .mm-arrow,
    #${HOST_ID} .mm-equal {
      flex: 0 0 auto;
    }

    #${HOST_ID} sup {
      line-height: 0;
      font-size: 0.72em;
    }

    #${HOST_ID} .mm-answer-slot {
      width: 100%;
      min-width: 0;
      min-height: 42px;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 2px dashed #a9bda9;
      border-radius: 12px;
      background: #ffffff;
      color: #6b7f6b;
      font-size: 13px;
      font-weight: 600;
      text-align: center;
      padding: 4px;
      overflow: hidden;
      transition: background 0.18s ease, border-color 0.18s ease;
    }

    #${HOST_ID} .mm-answer-slot:empty::before {
      content: "Seret angka";
      font-weight: 600;
      color: #6b7f6b;
      opacity: 0.9;
      white-space: nowrap;
    }

    #${HOST_ID} .mm-answer-slot:hover {
      background: #f8fff8;
      border-color: #7f987f;
    }

    #${HOST_ID} .mm-pool {
      min-width: 0;
      width: 100%;
      background: #fbfffb;
      border: 2px solid #a9bda9;
      border-radius: 15px;
      padding: 10px;
      box-shadow: 3px 4px 0 rgba(43, 75, 43, 0.12);
      display: flex;
      flex-direction: column;
      align-items: stretch;
      justify-content: flex-start;
    }

    #${HOST_ID} .mm-pool-title {
      text-align: center;
      margin: 0 0 10px;
      color: #6b7f6b;
      font-size: clamp(13px, 1.4vw, 15px);
      font-weight: 600;
    }

    #${HOST_ID} .mm-answer-grid {
      width: 100%;
      min-width: 0;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-content: flex-start;
      gap: 9px;
    }

    #${HOST_ID} .mm-pool-help {
      margin-top: 10px;
      text-align: center;
      font-size: 11px;
      line-height: 1.35;
      color: #738573;
    }

    #${HOST_ID} .mm-answer-token {
      width: 58px;
      height: 40px;
      min-width: 58px;
      border: 2px solid #a7a7a7;
      border-radius: 12px;
      background: #ffffff;
      color: #223322;
      font-size: 18px;
      font-weight: 700;
      font-family: inherit;
      cursor: grab;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      line-height: 1;
      padding: 0;
      box-shadow: 2px 3px 0 rgba(0, 0, 0, 0.14);
      touch-action: none;
      user-select: none;
      -webkit-user-select: none;
    }

    #${HOST_ID} .mm-answer-token:active {
      cursor: grabbing;
    }

    #${HOST_ID} .mm-answer-token.is-selected {
      outline: 3px solid #2e7d32;
      outline-offset: 3px;
      border-color: #2e7d32;
      background: #eef9ef;
    }

    #${HOST_ID} .mm-answer-token.is-dragging {
      opacity: 0.96;
      cursor: grabbing;
      transform: scale(1.03);
      box-shadow: 0 10px 22px rgba(0, 0, 0, 0.22);
    }

    #${HOST_ID} .mm-action-row {
      display: flex;
      justify-content: center;
      gap: 10px;
      flex-wrap: wrap;
      margin-top: 12px;
    }

    #${HOST_ID} .mm-btn {
      border: none;
      border-radius: 12px;
      padding: 9px 14px;
      min-width: 145px;
      font-family: inherit;
      font-size: 14px;
      font-weight: 700;
      cursor: pointer;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.13);
      transition: transform 0.12s ease, box-shadow 0.12s ease;
    }

    #${HOST_ID} .mm-btn:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.14);
    }

    #${HOST_ID} .mm-btn-check {
      background: #2e7d32;
      color: #ffffff;
    }

    #${HOST_ID} .mm-btn-reset {
      background: #f2c15f;
      color: #1f241f;
    }

    #${HOST_ID} .mm-result {
      width: 100%;
      max-width: 100%;
      margin-top: 12px;
      border-radius: 15px;
      padding: 12px 14px;
      overflow: hidden;
      line-height: 1.45;
      font-size: clamp(12px, 1.35vw, 14px);
    }

    #${HOST_ID} .mm-result[hidden] {
      display: none !important;
    }

    #${HOST_ID} .mm-result.is-success {
      background: #e8f8ed;
      border: 2px solid #28a745;
      color: #223322;
    }

    #${HOST_ID} .mm-result.is-warning {
      background: #ffebeb;
      border: 2px solid #e53e3e;
      color: #5b2424;
      text-align: center;
    }

    #${HOST_ID} .mm-result-title {
      margin: 0 0 8px;
      font-size: clamp(14px, 1.55vw, 16px);
      font-weight: 800;
      text-align: center;
    }

    #${HOST_ID} .mm-score {
      margin: 0 0 8px;
      text-align: center;
      font-weight: 700;
    }

    #${HOST_ID} .mm-discussion {
      margin: 8px 0 0;
      padding-left: 20px;
    }

    #${HOST_ID} .mm-discussion li {
      margin-bottom: 6px;
      overflow-wrap: anywhere;
    }

    @media (max-width: 760px) {
      #${HOST_ID} .mm-wrapper {
        padding: 12px;
        border-radius: 16px;
      }

      #${HOST_ID} .mm-layout {
        grid-template-columns: 1fr;
      }

      #${HOST_ID} .mm-pool {
        order: -1;
      }

      #${HOST_ID} .mm-pool-help {
        display: none;
      }

      #${HOST_ID} .mm-question-card {
        grid-template-columns: minmax(0, 1fr) minmax(88px, 100px);
        min-height: 56px;
        padding: 8px;
      }

      #${HOST_ID} .mm-answer-token {
        width: 54px;
        min-width: 54px;
        height: 38px;
        font-size: 17px;
      }
    }

    @media (max-width: 480px) {
      #${HOST_ID} .mm-wrapper {
        padding: 10px;
      }

      #${HOST_ID} .mm-instruction {
        padding: 9px 11px;
      }

      #${HOST_ID} .mm-question-card {
        grid-template-columns: 1fr;
        gap: 7px;
      }

      #${HOST_ID} .mm-answer-slot {
        min-height: 38px;
      }

      #${HOST_ID} .mm-btn {
        width: calc(50% - 5px);
        min-width: 0;
        padding: 9px 8px;
        font-size: 13px;
      }
    }
  `;

  function injectStyle() {
    const styleId = `${HOST_ID}-style`;

    if (document.getElementById(styleId)) return;

    const style = document.createElement("style");
    style.id = styleId;
    style.textContent = css;
    document.head.appendChild(style);
  }

  function shuffleArray(arr) {
    const a = [...arr];

    for (let i = a.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [a[i], a[j]] = [a[j], a[i]];
    }

    return a;
  }

  function buildHTML() {
    const questionHTML = questions
      .map(
        (q, index) => `
          <div class="mm-question-card" data-question-index="${index}">
            <div class="mm-question-text">
              <span class="mm-number">${index + 1}.</span>
              <span>${q.text}</span>
              <span class="mm-arrow">→</span>
              <span class="mm-equal">Derajat =</span>
            </div>
            <div class="mm-answer-slot" data-drop-slot="true" data-index="${index}" aria-label="Kotak jawaban nomor ${index + 1}"></div>
          </div>
        `
      )
      .join("");

    return `
      <div class="mm-wrapper">
        <div class="mm-head">
          <h3>Mari Mencoba: Derajat Suatu Polinomial</h3>
          <p>Seret angka derajat ke kotak jawaban yang sesuai, lalu klik <b>Periksa Jawaban</b>.</p>
        </div>

        <div class="mm-instruction">
          <p class="mm-instruction-title">Petunjuk pengerjaan:</p>
          <ol>
            <li>Baca setiap bentuk polinomial dengan teliti.</li>
            <li>Tentukan derajat dengan menjumlahkan pangkat variabel dalam satu suku.</li>
            <li>Seret angka jawaban ke kotak yang sesuai. Kamu juga bisa klik angka, lalu klik kotaknya.</li>
          </ol>
        </div>

        <div class="mm-layout">
          <div class="mm-questions">
            ${questionHTML}
          </div>

          <aside class="mm-pool" aria-label="Panel angka jawaban">
            <div class="mm-pool-title">Angka jawaban:</div>
            <div class="mm-answer-grid" data-answer-pool="true"></div>
            <div class="mm-pool-help">Bisa diseret atau klik angka lalu klik kotak.</div>
          </aside>
        </div>

        <div class="mm-action-row">
          <button type="button" class="mm-btn mm-btn-check" data-check="true">Periksa Jawaban</button>
          <button type="button" class="mm-btn mm-btn-reset" data-reset="true">Reset</button>
        </div>

        <div class="mm-result" data-result="true" hidden></div>
      </div>
    `;
  }

  function init() {
    const host = document.getElementById(HOST_ID);

    if (!host) return;
    if (host.dataset.derajatPolinomialReady === "1") return;

    host.dataset.derajatPolinomialReady = "1";
    host.style.width = "100%";
    host.style.maxWidth = "100%";
    host.style.minWidth = "0";
    host.style.overflowX = "hidden";

    injectStyle();
    host.innerHTML = buildHTML();

    const pool = host.querySelector("[data-answer-pool]");
    const resultBox = host.querySelector("[data-result]");

    renderTokens(pool);

    host.addEventListener("pointerdown", function (event) {
      const token = event.target.closest(".mm-answer-token");

      if (!token || !host.contains(token)) return;
      if (event.button !== undefined && event.button !== 0) return;

      event.preventDefault();
      startPointerDrag(event, token, pool, resultBox, host);
    });

    host.addEventListener("click", function (event) {
      const clickedToken = event.target.closest(".mm-answer-token");
      if (clickedToken) return;

      const slot = event.target.closest(".mm-answer-slot");
      const poolArea = event.target.closest(".mm-pool");

      if (selectedToken && slot) {
        placeTokenInSlot(selectedToken, slot, pool, resultBox, host);
        clearSelectedToken();
        return;
      }

      if (selectedToken && poolArea) {
        pool.appendChild(selectedToken);
        clearSelectedToken();
        clearCheckedState(resultBox, host);
      }
    });

    host.querySelector("[data-check]").addEventListener("click", function () {
      checkAnswers(resultBox, host);
    });

    host.querySelector("[data-reset]").addEventListener("click", function () {
      clearSelectedToken();
      resetAll(pool, resultBox, host);
    });
  }

  function renderTokens(pool) {
    pool.innerHTML = "";

    shuffleArray(answerTokens).forEach((value) => {
      const token = document.createElement("button");
      token.type = "button";
      token.className = "mm-answer-token";
      token.dataset.value = String(value);
      token.textContent = String(value);
      token.setAttribute("aria-label", `Angka jawaban ${value}`);
      pool.appendChild(token);
    });
  }

  function startPointerDrag(event, token, pool, resultBox, host) {
    const rect = token.getBoundingClientRect();

    dragState = {
      token,
      pool,
      resultBox,
      host,
      originParent: token.parentNode,
      originNext: token.nextSibling,
      startX: event.clientX,
      startY: event.clientY,
      offsetX: event.clientX - rect.left,
      offsetY: event.clientY - rect.top,
      width: rect.width,
      height: rect.height,
      dragging: false,
    };

    document.addEventListener("pointermove", handlePointerMove, { passive: false });
    document.addEventListener("pointerup", handlePointerUp, { passive: false });
    document.addEventListener("pointercancel", handlePointerCancel, { passive: false });
  }

  function handlePointerMove(event) {
    if (!dragState) return;

    const distanceX = Math.abs(event.clientX - dragState.startX);
    const distanceY = Math.abs(event.clientY - dragState.startY);

    if (!dragState.dragging && distanceX + distanceY > 5) {
      beginDrag(event);
    }

    if (dragState.dragging) {
      event.preventDefault();
      moveDraggedToken(event);
    }
  }

  function beginDrag(event) {
    const token = dragState.token;
    const rect = token.getBoundingClientRect();

    clearSelectedToken();
    clearCheckedState(dragState.resultBox, dragState.host);

    dragState.offsetX = event.clientX - rect.left;
    dragState.offsetY = event.clientY - rect.top;
    dragState.width = rect.width;
    dragState.height = rect.height;
    dragState.dragging = true;

    token.classList.add("is-dragging");
    token.style.position = "fixed";
    token.style.left = `${rect.left}px`;
    token.style.top = `${rect.top}px`;
    token.style.width = `${rect.width}px`;
    token.style.height = `${rect.height}px`;
    token.style.zIndex = "99999";
    token.style.pointerEvents = "none";

    document.body.appendChild(token);
    moveDraggedToken(event);
  }

  function moveDraggedToken(event) {
    const token = dragState.token;
    const left = event.clientX - dragState.offsetX;
    const top = event.clientY - dragState.offsetY;

    token.style.left = `${left}px`;
    token.style.top = `${top}px`;
  }

  function handlePointerUp(event) {
    if (!dragState) return;

    if (dragState.dragging) {
      event.preventDefault();
      finishDrag(event);
    } else {
      toggleSelectedToken(dragState.token);
    }

    cleanupPointerListeners();
  }

  function handlePointerCancel() {
    if (!dragState) return;

    if (dragState.dragging) {
      restoreTokenToOrigin(dragState.token, dragState);
      cleanupTokenStyle(dragState.token);
    }

    cleanupPointerListeners();
  }

  function finishDrag(event) {
    const token = dragState.token;
    const elementBelow = document.elementFromPoint(event.clientX, event.clientY);
    const slot = elementBelow ? elementBelow.closest(".mm-answer-slot") : null;
    const poolTarget = elementBelow ? elementBelow.closest(".mm-pool") : null;

    cleanupTokenStyle(token);

    if (slot && dragState.host.contains(slot)) {
      placeTokenInSlot(token, slot, dragState.pool, dragState.resultBox, dragState.host);
    } else if (poolTarget && dragState.host.contains(poolTarget)) {
      dragState.pool.appendChild(token);
      clearCheckedState(dragState.resultBox, dragState.host);
    } else {
      restoreTokenToOrigin(token, dragState);
    }
  }

  function cleanupPointerListeners() {
    document.removeEventListener("pointermove", handlePointerMove);
    document.removeEventListener("pointerup", handlePointerUp);
    document.removeEventListener("pointercancel", handlePointerCancel);
    dragState = null;
  }

  function cleanupTokenStyle(token) {
    token.classList.remove("is-dragging");
    token.style.position = "";
    token.style.left = "";
    token.style.top = "";
    token.style.width = "";
    token.style.height = "";
    token.style.zIndex = "";
    token.style.pointerEvents = "";
    token.style.transform = "";
  }

  function restoreTokenToOrigin(token, state) {
    const originParent = state.originParent;
    const originNext = state.originNext;

    if (originParent && document.contains(originParent)) {
      if (originNext && originNext.parentNode === originParent) {
        originParent.insertBefore(token, originNext);
      } else {
        originParent.appendChild(token);
      }
    } else {
      state.pool.appendChild(token);
    }
  }

  function toggleSelectedToken(token) {
    if (selectedToken && selectedToken !== token) {
      selectedToken.classList.remove("is-selected");
    }

    if (selectedToken === token) {
      token.classList.remove("is-selected");
      selectedToken = null;
      return;
    }

    selectedToken = token;
    selectedToken.classList.add("is-selected");
  }

  function clearSelectedToken() {
    if (selectedToken) {
      selectedToken.classList.remove("is-selected");
      selectedToken = null;
    }
  }

  function placeTokenInSlot(token, slot, pool, resultBox, host) {
    const existingToken = slot.querySelector(".mm-answer-token");

    if (existingToken && existingToken !== token) {
      pool.appendChild(existingToken);
      existingToken.classList.remove("is-selected");
    }

    slot.appendChild(token);
    token.classList.remove("is-selected");
    clearCheckedState(resultBox, host);
  }

  function clearCheckedState(resultBox, host) {
    host.querySelectorAll(".mm-question-card").forEach((card) => {
      card.classList.remove("is-correct", "is-wrong");
    });

    resultBox.hidden = true;
    resultBox.className = "mm-result";
    resultBox.innerHTML = "";
  }

  function checkAnswers(resultBox, host) {
    let score = 0;
    const cards = host.querySelectorAll(".mm-question-card");

    cards.forEach((card, index) => {
      const slot = card.querySelector(".mm-answer-slot");
      const token = slot.querySelector(".mm-answer-token");
      const isCorrect = token && Number(token.dataset.value) === questions[index].answer;

      card.classList.remove("is-correct", "is-wrong");

      if (isCorrect) {
        score += 1;
        card.classList.add("is-correct");
      } else {
        card.classList.add("is-wrong");
      }
    });

    resultBox.hidden = false;

    if (score === questions.length) {
      const explanationItems = questions
        .map((q) => `<li>${q.explanation}</li>`)
        .join("");

      resultBox.className = "mm-result is-success";
      resultBox.innerHTML = `
        <p class="mm-result-title">Semua jawaban benar!</p>
        <p class="mm-score">Skor: ${score} / ${questions.length}</p>
        <p class="mm-result-title">Pembahasan semua soal:</p>
        <ol class="mm-discussion">${explanationItems}</ol>
      `;
    } else {
      resultBox.className = "mm-result is-warning";
      resultBox.innerHTML = `
        <p class="mm-result-title">Masih ada jawaban yang belum tepat atau belum diisi.</p>
        <p class="mm-score">Skor: ${score} / ${questions.length}</p>
        <p style="margin:0;">Perbaiki kotak yang berwarna merah, lalu klik <b>Periksa Jawaban</b> lagi.</p>
      `;
    }
  }

  function resetAll(pool, resultBox, host) {
    host.querySelectorAll(".mm-answer-slot").forEach((slot) => {
      slot.innerHTML = "";
    });

    renderTokens(pool);
    clearCheckedState(resultBox, host);
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();