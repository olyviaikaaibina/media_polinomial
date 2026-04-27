@extends('layout.halamanmateri')

@section('content')
    {{-- =========================
    KaTeX
    ========================== --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/contrib/auto-render.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            renderMathInElement(document.body, {
                delimiters: [
                    { left: "$$", right: "$$", display: true },
                    { left: "\\(", right: "\\)", display: false },
                    { left: "\\[", right: "\\]", display: true }
                ],
                throwOnError: false
            });

            function normalize(str) {
                return (str || "")
                    .toLowerCase()
                    .replace(/\s+/g, '')
                    .replace(/\*/g, '')
                    .replace(/−/g, '-')
                    .trim();
            }

            function getSelectedValue(name) {
                const checked = document.querySelector('input[name="' + name + '"]:checked');
                return checked ? normalize(checked.value) : '';
            }

            function toggleHint(id, btn) {
                const el = document.getElementById(id);
                if (!el) return;

                const isOpen = el.classList.contains('show');
                el.classList.toggle('show');

                if (btn) {
                    btn.textContent = isOpen ? 'Lihat Petunjuk Menjawab' : 'Sembunyikan Petunjuk';
                }
            }

            window.toggleHint = toggleHint;

            function markInputState(el, isCorrect) {
                if (!el) return;
                el.classList.remove('input-correct', 'input-wrong');

                if (isCorrect === true) {
                    el.classList.add('input-correct');
                } else if (isCorrect === false) {
                    el.classList.add('input-wrong');
                }
            }

            function showAutoFeedback(feedbackEl, isCorrect) {
                if (!feedbackEl) return;
                feedbackEl.textContent = isCorrect ? 'Benar' : 'Salah';
                feedbackEl.className = isCorrect ? 'feedback ok show' : 'feedback no show';
            }

            function showTextFeedback(id, isCorrect, text) {
                const el = document.getElementById(id);
                if (!el) return;
                el.textContent = text;
                el.className = isCorrect ? 'feedback ok show' : 'feedback no show';
            }

            function clearFeedback(feedbackEl) {
                if (!feedbackEl) return;
                feedbackEl.textContent = '';
                feedbackEl.className = 'feedback';
            }

            function hideElement(id) {
                const el = document.getElementById(id);
                if (el) el.style.display = 'none';
            }

            function showElement(id) {
                const el = document.getElementById(id);
                if (el) el.style.display = 'block';
            }

            function rerenderMath() {
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body, {
                        delimiters: [
                            { left: "$$", right: "$$", display: true },
                            { left: "\\(", right: "\\)", display: false },
                            { left: "\\[", right: "\\]", display: true }
                        ],
                        throwOnError: false
                    });
                }
            }

            const materiSetelahEksplorasi = document.getElementById('materiSetelahEksplorasi');

            function hideMateriSetelahEksplorasi() {
                if (materiSetelahEksplorasi) {
                    materiSetelahEksplorasi.style.display = 'none';
                }
            }

            function showMateriSetelahEksplorasi() {
                if (materiSetelahEksplorasi) {
                    materiSetelahEksplorasi.style.display = 'block';
                }
            }

            hideMateriSetelahEksplorasi();

            // =========================
            // CONTOH 1
            // =========================
            function showStep(stepNumber) {
                showElement('stepExplain' + stepNumber);
            }

            function hideStep(stepNumber) {
                hideElement('stepExplain' + stepNumber);
            }

            function showFinalExplanation() {
                const s1 = document.getElementById('step1Status')?.value === 'true';
                const s2 = document.getElementById('step2Status')?.value === 'true';
                const s3 = document.getElementById('step3Status')?.value === 'true';
                const s4 = document.getElementById('step4Status')?.value === 'true';

                const finalBox = document.getElementById('finalExplanation');
                if (finalBox) {
                    finalBox.style.display = (s1 && s2 && s3 && s4) ? 'block' : 'none';
                }
            }

            function cekLangkah1Auto() {
                const inputEl = document.getElementById('jawabLangkah1');
                const feedback = document.getElementById('feedback1');
                if (!inputEl) return;

                const input = normalize(inputEl.value);

                if (!input) {
                    clearFeedback(feedback);
                    markInputState(inputEl, null);
                    document.getElementById('step1Status').value = 'false';
                    hideStep(1);
                    showFinalExplanation();
                    return;
                }

                const isCorrect = input === '0';

                showAutoFeedback(feedback, isCorrect);
                markInputState(inputEl, isCorrect);
                document.getElementById('step1Status').value = isCorrect ? 'true' : 'false';

                if (isCorrect) showStep(1);
                else hideStep(1);

                showFinalExplanation();
            }

            function cekLangkah2Auto() {
                const inputEl = document.getElementById('jawabLangkah2');
                const feedback = document.getElementById('feedback2');
                if (!inputEl) return;

                const input = normalize(inputEl.value);
                const valid = ['x-1', '(x-1)'].map(normalize);

                if (!input) {
                    clearFeedback(feedback);
                    markInputState(inputEl, null);
                    document.getElementById('step2Status').value = 'false';
                    hideStep(2);
                    showFinalExplanation();
                    return;
                }

                const isCorrect = valid.includes(input);

                showAutoFeedback(feedback, isCorrect);
                markInputState(inputEl, isCorrect);
                document.getElementById('step2Status').value = isCorrect ? 'true' : 'false';

                if (isCorrect) showStep(2);
                else hideStep(2);

                showFinalExplanation();
            }

            function cekLangkah3Auto() {
                const top1 = document.getElementById('hornerTop1');
                const top2 = document.getElementById('hornerTop2');
                const top3 = document.getElementById('hornerTop3');

                const bottom1 = document.getElementById('hornerBottom1');
                const bottom2 = document.getElementById('hornerBottom2');
                const bottom3 = document.getElementById('hornerBottom3');
                const bottom4 = document.getElementById('hornerBottom4');

                const feedback = document.getElementById('feedback3');

                if (!top1 || !top2 || !top3 || !bottom1 || !bottom2 || !bottom3 || !bottom4) return;

                const a = normalize(top1.value);
                const b = normalize(top2.value);
                const c = normalize(top3.value);
                const d = normalize(bottom1.value);
                const e = normalize(bottom2.value);
                const f = normalize(bottom3.value);
                const g = normalize(bottom4.value);

                if (!(a || b || c || d || e || f || g)) {
                    clearFeedback(feedback);
                    [top1, top2, top3, bottom1, bottom2, bottom3, bottom4].forEach(el => markInputState(el, null));
                    document.getElementById('step3Status').value = 'false';
                    hideStep(3);
                    showFinalExplanation();
                    return;
                }

                const correctA = a === '1';
                const correctB = b === '-3';
                const correctC = c === '-4';
                const correctD = d === '1';
                const correctE = e === '-3';
                const correctF = f === '-4';
                const correctG = g === '0';

                const isCorrect = correctA && correctB && correctC && correctD && correctE && correctF && correctG;

                markInputState(top1, a ? correctA : null);
                markInputState(top2, b ? correctB : null);
                markInputState(top3, c ? correctC : null);
                markInputState(bottom1, d ? correctD : null);
                markInputState(bottom2, e ? correctE : null);
                markInputState(bottom3, f ? correctF : null);
                markInputState(bottom4, g ? correctG : null);

                showAutoFeedback(feedback, isCorrect);
                document.getElementById('step3Status').value = isCorrect ? 'true' : 'false';

                if (isCorrect) showStep(3);
                else hideStep(3);

                showFinalExplanation();
            }

            function cekLangkah4Auto() {
                const inputEl = document.getElementById('jawabLangkah4');
                const feedback = document.getElementById('feedback4');
                if (!inputEl) return;

                const input = normalize(inputEl.value);
                const valid = [
                    '(x-4)(x+1)',
                    '(x+1)(x-4)'
                ].map(normalize);

                if (!input) {
                    clearFeedback(feedback);
                    markInputState(inputEl, null);
                    document.getElementById('step4Status').value = 'false';
                    hideStep(4);
                    showFinalExplanation();
                    return;
                }

                const isCorrect = valid.includes(input);

                showAutoFeedback(feedback, isCorrect);
                markInputState(inputEl, isCorrect);
                document.getElementById('step4Status').value = isCorrect ? 'true' : 'false';

                if (isCorrect) showStep(4);
                else hideStep(4);

                showFinalExplanation();
            }

            window.cekLangkah1 = cekLangkah1Auto;
            window.cekLangkah2 = cekLangkah2Auto;
            window.cekLangkah3 = cekLangkah3Auto;
            window.cekLangkah4 = cekLangkah4Auto;

            [
                { id: 'jawabLangkah1', fn: cekLangkah1Auto },
                { id: 'jawabLangkah2', fn: cekLangkah2Auto },
                { id: 'hornerTop1', fn: cekLangkah3Auto },
                { id: 'hornerTop2', fn: cekLangkah3Auto },
                { id: 'hornerTop3', fn: cekLangkah3Auto },
                { id: 'hornerBottom1', fn: cekLangkah3Auto },
                { id: 'hornerBottom2', fn: cekLangkah3Auto },
                { id: 'hornerBottom3', fn: cekLangkah3Auto },
                { id: 'hornerBottom4', fn: cekLangkah3Auto },
                { id: 'jawabLangkah4', fn: cekLangkah4Auto }
            ].forEach(item => {
                const el = document.getElementById(item.id);
                if (!el) return;
                el.addEventListener('input', item.fn);
                el.addEventListener('change', item.fn);
            });

            // =========================
            // CONTOH 2
            // =========================
            function showRasionalStep(stepNumber) {
                showElement('rasionalExplain' + stepNumber);
            }

            function hideRasionalStep(stepNumber) {
                hideElement('rasionalExplain' + stepNumber);
            }

            function showRasionalFinalExplanation() {
                const s1 = document.getElementById('rasionalStep1Status')?.value === 'true';
                const s2 = document.getElementById('rasionalStep2Status')?.value === 'true';
                const s3 = document.getElementById('rasionalStep3Status')?.value === 'true';
                const s4 = document.getElementById('rasionalStep4Status')?.value === 'true';
                const s5 = document.getElementById('rasionalStep5Status')?.value === 'true';

                const finalBox = document.getElementById('rasionalFinalExplanation');
                if (finalBox) {
                    finalBox.style.display = (s1 && s2 && s3 && s4 && s5) ? 'block' : 'none';
                }
            }

            function cekRasionalLangkah1Auto() {
                const inputEl = document.getElementById('jawabRasional1');
                const feedback = document.getElementById('rasionalFeedback1');
                if (!inputEl) return;

                const input = normalize(inputEl.value);
                const valid = [
                    '±1,±2,±4',
                    '+-1,+-2,+-4',
                    '1,2,4,-1,-2,-4',
                    '-1,-2,-4,1,2,4'
                ].map(normalize);

                if (!input) {
                    clearFeedback(feedback);
                    markInputState(inputEl, null);
                    document.getElementById('rasionalStep1Status').value = 'false';
                    hideRasionalStep(1);
                    showRasionalFinalExplanation();
                    return;
                }

                const isCorrect = valid.includes(input);

                showAutoFeedback(feedback, isCorrect);
                markInputState(inputEl, isCorrect);
                document.getElementById('rasionalStep1Status').value = isCorrect ? 'true' : 'false';

                if (isCorrect) showRasionalStep(1);
                else hideRasionalStep(1);

                showRasionalFinalExplanation();
            }

            function cekRasionalLangkah2Auto() {
                const inputEl = document.getElementById('jawabRasional2');
                const feedback = document.getElementById('rasionalFeedback2');
                if (!inputEl) return;

                const input = normalize(inputEl.value);

                if (!input) {
                    clearFeedback(feedback);
                    markInputState(inputEl, null);
                    document.getElementById('rasionalStep2Status').value = 'false';
                    hideRasionalStep(2);
                    showRasionalFinalExplanation();
                    return;
                }

                const isCorrect = input === '1';

                showAutoFeedback(feedback, isCorrect);
                markInputState(inputEl, isCorrect);
                document.getElementById('rasionalStep2Status').value = isCorrect ? 'true' : 'false';

                if (isCorrect) showRasionalStep(2);
                else hideRasionalStep(2);

                showRasionalFinalExplanation();
            }

            function cekRasionalLangkah3Auto() {
                const inputEl = document.getElementById('jawabRasional3');
                const feedback = document.getElementById('rasionalFeedback3');
                if (!inputEl) return;

                const input = normalize(inputEl.value);
                const valid = ['x-1', '(x-1)'].map(normalize);

                if (!input) {
                    clearFeedback(feedback);
                    markInputState(inputEl, null);
                    document.getElementById('rasionalStep3Status').value = 'false';
                    hideRasionalStep(3);
                    showRasionalFinalExplanation();
                    return;
                }

                const isCorrect = valid.includes(input);

                showAutoFeedback(feedback, isCorrect);
                markInputState(inputEl, isCorrect);
                document.getElementById('rasionalStep3Status').value = isCorrect ? 'true' : 'false';

                if (isCorrect) showRasionalStep(3);
                else hideRasionalStep(3);

                showRasionalFinalExplanation();
            }

            function cekRasionalLangkah4Auto() {
                const top1 = document.getElementById('rasionalHornerTop1');
                const top2 = document.getElementById('rasionalHornerTop2');
                const top3 = document.getElementById('rasionalHornerTop3');

                const bottom1 = document.getElementById('rasionalHornerBottom1');
                const bottom2 = document.getElementById('rasionalHornerBottom2');
                const bottom3 = document.getElementById('rasionalHornerBottom3');
                const bottom4 = document.getElementById('rasionalHornerBottom4');

                const feedback = document.getElementById('rasionalFeedback4');

                if (!top1 || !top2 || !top3 || !bottom1 || !bottom2 || !bottom3 || !bottom4) return;

                const a = normalize(top1.value);
                const b = normalize(top2.value);
                const c = normalize(top3.value);
                const d = normalize(bottom1.value);
                const e = normalize(bottom2.value);
                const f = normalize(bottom3.value);
                const g = normalize(bottom4.value);

                if (!(a || b || c || d || e || f || g)) {
                    clearFeedback(feedback);
                    [top1, top2, top3, bottom1, bottom2, bottom3, bottom4].forEach(el => markInputState(el, null));
                    document.getElementById('rasionalStep4Status').value = 'false';
                    hideRasionalStep(4);
                    showRasionalFinalExplanation();
                    return;
                }

                const correctA = a === '1';
                const correctB = b === '-3';
                const correctC = c === '-4';
                const correctD = d === '1';
                const correctE = e === '-3';
                const correctF = f === '-4';
                const correctG = g === '0';

                const isCorrect = correctA && correctB && correctC && correctD && correctE && correctF && correctG;

                markInputState(top1, a ? correctA : null);
                markInputState(top2, b ? correctB : null);
                markInputState(top3, c ? correctC : null);
                markInputState(bottom1, d ? correctD : null);
                markInputState(bottom2, e ? correctE : null);
                markInputState(bottom3, f ? correctF : null);
                markInputState(bottom4, g ? correctG : null);

                showAutoFeedback(feedback, isCorrect);
                document.getElementById('rasionalStep4Status').value = isCorrect ? 'true' : 'false';

                if (isCorrect) showRasionalStep(4);
                else hideRasionalStep(4);

                showRasionalFinalExplanation();
            }

            function cekRasionalLangkah5Auto() {
                const inputEl = document.getElementById('jawabRasional5');
                const feedback = document.getElementById('rasionalFeedback5');
                if (!inputEl) return;

                const input = normalize(inputEl.value);
                const valid = [
                    '(x-1)(x-4)(x+1)',
                    '(x-1)(x+1)(x-4)',
                    '(x-4)(x-1)(x+1)',
                    '(x-4)(x+1)(x-1)',
                    '(x+1)(x-1)(x-4)',
                    '(x+1)(x-4)(x-1)'
                ].map(normalize);

                if (!input) {
                    clearFeedback(feedback);
                    markInputState(inputEl, null);
                    document.getElementById('rasionalStep5Status').value = 'false';
                    hideRasionalStep(5);
                    showRasionalFinalExplanation();
                    return;
                }

                const isCorrect = valid.includes(input);

                showAutoFeedback(feedback, isCorrect);
                markInputState(inputEl, isCorrect);
                document.getElementById('rasionalStep5Status').value = isCorrect ? 'true' : 'false';

                if (isCorrect) showRasionalStep(5);
                else hideRasionalStep(5);

                showRasionalFinalExplanation();
            }

            window.cekRasionalLangkah1 = cekRasionalLangkah1Auto;
            window.cekRasionalLangkah2 = cekRasionalLangkah2Auto;
            window.cekRasionalLangkah3 = cekRasionalLangkah3Auto;
            window.cekRasionalLangkah4 = cekRasionalLangkah4Auto;
            window.cekRasionalLangkah5 = cekRasionalLangkah5Auto;

            [
                { id: 'jawabRasional1', fn: cekRasionalLangkah1Auto },
                { id: 'jawabRasional2', fn: cekRasionalLangkah2Auto },
                { id: 'jawabRasional3', fn: cekRasionalLangkah3Auto },
                { id: 'rasionalHornerTop1', fn: cekRasionalLangkah4Auto },
                { id: 'rasionalHornerTop2', fn: cekRasionalLangkah4Auto },
                { id: 'rasionalHornerTop3', fn: cekRasionalLangkah4Auto },
                { id: 'rasionalHornerBottom1', fn: cekRasionalLangkah4Auto },
                { id: 'rasionalHornerBottom2', fn: cekRasionalLangkah4Auto },
                { id: 'rasionalHornerBottom3', fn: cekRasionalLangkah4Auto },
                { id: 'rasionalHornerBottom4', fn: cekRasionalLangkah4Auto },
                { id: 'jawabRasional5', fn: cekRasionalLangkah5Auto }
            ].forEach(item => {
                const el = document.getElementById(item.id);
                if (!el) return;
                el.addEventListener('input', item.fn);
                el.addEventListener('change', item.fn);
            });

            // =========================
            // LATIHAN CEK PER SOAL
            // =========================
            function setLatihan1Status(value) {
                const el = document.getElementById('latihan1Status');
                if (el) el.value = value ? 'true' : 'false';
            }

            function setLatihan2Status(value) {
                const el = document.getElementById('latihan2Status');
                if (el) el.value = value ? 'true' : 'false';
            }

            function kunciLatihan2() {
                const area = document.getElementById('latihan2Area');
                const pesan = document.getElementById('latihan2LockMessage');

                if (area) area.classList.add('latihan-terkunci');
                if (pesan) pesan.style.display = 'block';

                document.querySelectorAll('#latihan2Area input, #latihan2Area button').forEach(function (el) {
                    el.disabled = true;
                });
            }

            function bukaLatihan2() {
                const area = document.getElementById('latihan2Area');
                const pesan = document.getElementById('latihan2LockMessage');

                if (area) area.classList.remove('latihan-terkunci');
                if (pesan) pesan.style.display = 'none';

                document.querySelectorAll('#latihan2Area input, #latihan2Area button').forEach(function (el) {
                    el.disabled = false;
                });
            }

            function cekLatihan1() {
                let semuaBenar = true;

                const opsi1 = getSelectedValue('latihan1opsi1');
                const benar1 = opsi1 === normalize('pengelompokan');

                showAutoFeedback(document.getElementById('latihan1Feedback1'), benar1);
                if (benar1) showElement('latihan1Explain1');
                else hideElement('latihan1Explain1');
                semuaBenar = semuaBenar && benar1;

                const input2El = document.getElementById('jawabLatihan1Langkah2');
                const jawab2 = normalize(input2El?.value);
                const benar2 = [
                    'x^2(x+2)-9(x+2)',
                    '(x^2)(x+2)-9(x+2)',
                    'x2(x+2)-9(x+2)',
                    '(x²)(x+2)-9(x+2)'
                ].map(normalize).includes(jawab2);

                markInputState(input2El, jawab2 ? benar2 : null);
                showAutoFeedback(document.getElementById('latihan1Feedback2'), benar2);
                if (benar2) showElement('latihan1Explain2');
                else hideElement('latihan1Explain2');
                semuaBenar = semuaBenar && benar2;

                const opsi3 = getSelectedValue('latihan1opsi3');
                const benar3 = opsi3 === normalize('x+2');

                showAutoFeedback(document.getElementById('latihan1Feedback3'), benar3);
                if (benar3) showElement('latihan1Explain3');
                else hideElement('latihan1Explain3');
                semuaBenar = semuaBenar && benar3;

                const input4El = document.getElementById('jawabLatihan1Langkah4');
                const jawab4 = normalize(input4El?.value);
                const benar4 = [
                    '(x+2)(x-3)(x+3)',
                    '(x+2)(x+3)(x-3)',
                    '(x-3)(x+2)(x+3)',
                    '(x-3)(x+3)(x+2)',
                    '(x+3)(x+2)(x-3)',
                    '(x+3)(x-3)(x+2)'
                ].map(normalize).includes(jawab4);

                markInputState(input4El, jawab4 ? benar4 : null);
                showAutoFeedback(document.getElementById('latihan1Feedback4'), benar4);
                if (benar4) showElement('latihan1Explain4');
                else hideElement('latihan1Explain4');
                semuaBenar = semuaBenar && benar4;

                setLatihan1Status(semuaBenar);

                if (semuaBenar) {
                    showTextFeedback(
                        'latihan1FeedbackFinal',
                        true,
                        'Semua jawaban Soal 1 benar. Soal 2 sudah bisa dikerjakan.'
                    );
                    showElement('latihan1FinalExplanation');
                    bukaLatihan2();
                } else {
                    showTextFeedback(
                        'latihan1FeedbackFinal',
                        false,
                        'Masih ada jawaban Soal 1 yang belum tepat. Perbaiki dulu sebelum mengerjakan Soal 2.'
                    );
                    hideElement('latihan1FinalExplanation');
                    kunciLatihan2();
                }

                rerenderMath();
            }

            function cekLatihan2() {
                const latihan1Benar = document.getElementById('latihan1Status')?.value === 'true';

                if (!latihan1Benar) {
                    showTextFeedback(
                        'latihan2FeedbackFinal',
                        false,
                        'Soal 2 belum bisa dicek. Benarkan Soal 1 terlebih dahulu.'
                    );
                    kunciLatihan2();
                    return;
                }

                let semuaBenar = true;

                const opsi1 = getSelectedValue('latihan2opsi1');
                const benar1 = opsi1 === normalize('±1,±2,±3,±6,±1/2,±3/2');

                showAutoFeedback(document.getElementById('latihan2Feedback1'), benar1);
                if (benar1) showElement('latihan2Explain1');
                else hideElement('latihan2Explain1');
                semuaBenar = semuaBenar && benar1;

                const input2El = document.getElementById('jawabLatihan2Langkah2');
                const jawab2 = normalize(input2El?.value);
                const benar2 = jawab2 === '-2';

                markInputState(input2El, jawab2 ? benar2 : null);
                showAutoFeedback(document.getElementById('latihan2Feedback2'), benar2);
                if (benar2) showElement('latihan2Explain2');
                else hideElement('latihan2Explain2');
                semuaBenar = semuaBenar && benar2;

                const opsi3 = getSelectedValue('latihan2opsi3');
                const benar3 = opsi3 === normalize('x+2');

                showAutoFeedback(document.getElementById('latihan2Feedback3'), benar3);
                if (benar3) showElement('latihan2Explain3');
                else hideElement('latihan2Explain3');
                semuaBenar = semuaBenar && benar3;

                const h1El = document.getElementById('latihan2Horner1');
                const h2El = document.getElementById('latihan2Horner2');
                const h3El = document.getElementById('latihan2Horner3');
                const h4El = document.getElementById('latihan2Horner4');

                const h1 = normalize(h1El?.value);
                const h2 = normalize(h2El?.value);
                const h3 = normalize(h3El?.value);
                const h4 = normalize(h4El?.value);

                const benarH1 = h1 === '-4';
                const benarH2 = h2 === '14';
                const benarH3 = h3 === '-6';
                const benarH4 = h4 === '0';

                const benar4 = benarH1 && benarH2 && benarH3 && benarH4;

                markInputState(h1El, h1 ? benarH1 : null);
                markInputState(h2El, h2 ? benarH2 : null);
                markInputState(h3El, h3 ? benarH3 : null);
                markInputState(h4El, h4 ? benarH4 : null);

                showAutoFeedback(document.getElementById('latihan2Feedback4'), benar4);
                if (benar4) showElement('latihan2Explain4');
                else hideElement('latihan2Explain4');
                semuaBenar = semuaBenar && benar4;

                const input5El = document.getElementById('jawabLatihan2Langkah5');
                const jawab5 = normalize(input5El?.value);
                const benar5 = [
                    '(x+2)(2x-1)(x-3)',
                    '(x+2)(x-3)(2x-1)',
                    '(2x-1)(x+2)(x-3)',
                    '(2x-1)(x-3)(x+2)',
                    '(x-3)(x+2)(2x-1)',
                    '(x-3)(2x-1)(x+2)'
                ].map(normalize).includes(jawab5);

                markInputState(input5El, jawab5 ? benar5 : null);
                showAutoFeedback(document.getElementById('latihan2Feedback5'), benar5);
                if (benar5) showElement('latihan2Explain5');
                else hideElement('latihan2Explain5');
                semuaBenar = semuaBenar && benar5;

                setLatihan2Status(semuaBenar);

                if (semuaBenar) {
                    showTextFeedback(
                        'latihan2FeedbackFinal',
                        true,
                        'Semua jawaban Soal 2 benar.'
                    );
                    showElement('latihan2FinalExplanation');
                } else {
                    showTextFeedback(
                        'latihan2FeedbackFinal',
                        false,
                        'Masih ada jawaban Soal 2 yang belum tepat. Periksa kembali bagian yang diberi tanda.'
                    );
                    hideElement('latihan2FinalExplanation');
                }

                rerenderMath();
            }

            window.cekLatihan1 = cekLatihan1;
            window.cekLatihan2 = cekLatihan2;

            kunciLatihan2();

            // =========================
            // EKSPLORASI DRAG & DROP
            // =========================
            let draggedItem = null;
            let attemptedDrops = 0;

            const dropZones = document.querySelectorAll('.drop-zone');
            const totalDropZones = dropZones.length;
            const finalBoxEks = document.getElementById('eksplorasiFinal');

            const dropToStatusMap = {
                'g1': 'statusEks1',
                'g2': 'statusEks2'
            };

            function getBankByGroup(group) {
                return group === 'g1'
                    ? document.getElementById('answerBank1')
                    : document.getElementById('answerBank2');
            }

            function showStatus(group, isCorrect, customText = '') {
                const el = document.getElementById(dropToStatusMap[group]);
                if (!el) return;

                if (customText) {
                    el.textContent = customText;
                } else {
                    el.textContent = isCorrect ? 'Benar' : 'Salah';
                }

                el.className = isCorrect ? 'status-box show success' : 'status-box show error';
            }

            function clearStatus(group) {
                const el = document.getElementById(dropToStatusMap[group]);
                if (!el) return;
                el.textContent = '';
                el.className = 'status-box';
            }

            function hideExplanation(id) {
                const el = document.getElementById(id);
                if (el) el.classList.remove('show');
            }

            function showExplanation(id) {
                const el = document.getElementById(id);
                if (el) {
                    el.classList.add('show');

                    const title = el.querySelector('h5');
                    if (title) {
                        if (id === 'explainGabungan') {
                            title.innerHTML = 'Penjelasan';
                        } else if (id === 'explainMakna') {
                            title.innerHTML = 'Penjelasan Makna';
                        }
                    }
                }
            }

            function isZoneAnswered(zoneId) {
                const zone = document.getElementById(zoneId);
                if (!zone) return false;
                return !!zone.querySelector('.drag-item');
            }

            function updatePertanyaan1Explanation() {
                const p1Terjawab = isZoneAnswered('drop-p1');
                const p2Terjawab = isZoneAnswered('drop-p2');

                if (p1Terjawab && p2Terjawab) {
                    showExplanation('explainGabungan');
                } else {
                    hideExplanation('explainGabungan');
                }
            }

            function updatePertanyaan2Explanation() {
                const maknaTerjawab = isZoneAnswered('drop-makna');

                if (maknaTerjawab) {
                    showExplanation('explainMakna');
                } else {
                    hideExplanation('explainMakna');
                }
            }

            function updateEksplorasiExplanations() {
                updatePertanyaan1Explanation();
                updatePertanyaan2Explanation();
            }

            function checkEksplorasiSelesai() {
                if (attemptedDrops >= totalDropZones && totalDropZones > 0) {
                    if (finalBoxEks) finalBoxEks.classList.add('show');
                    showMateriSetelahEksplorasi();
                } else {
                    if (finalBoxEks) finalBoxEks.classList.remove('show');
                    hideMateriSetelahEksplorasi();
                }
            }

            function markAttempt(dropZone) {
                if (!dropZone.dataset.attempted) {
                    dropZone.dataset.attempted = 'true';
                    attemptedDrops++;
                }
                checkEksplorasiSelesai();
            }

            function moveItemToBank(item, group) {
                if (!item) return;
                const bank = getBankByGroup(group);
                if (bank) {
                    item.classList.remove('dragging', 'locked');
                    item.setAttribute('draggable', 'true');
                    bank.appendChild(item);
                }
            }

            function clearZoneState(zone) {
                if (!zone) return;
                zone.classList.remove('filled', 'correct', 'wrong', 'hovered');
                delete zone.dataset.solved;
            }

            function setDropState(dropZone, item, isCorrect) {
                dropZone.classList.remove('correct', 'wrong', 'filled');
                item.classList.remove('locked');

                if (isCorrect) {
                    dropZone.classList.add('filled', 'correct');
                    item.classList.add('locked');
                    item.setAttribute('draggable', 'false');
                    dropZone.dataset.solved = 'true';
                } else {
                    dropZone.classList.add('filled', 'wrong');
                    item.setAttribute('draggable', 'true');
                    delete dropZone.dataset.solved;
                }
            }

            function evaluateDropZone(dropZone) {
                const item = dropZone.querySelector('.drag-item');
                if (!item) return;

                const droppedValue = (item.dataset.value || '').toLowerCase().trim();
                const correctAnswer = (dropZone.dataset.answer || '').toLowerCase().trim();
                const group = dropZone.dataset.group;

                const isCorrect = droppedValue === correctAnswer;

                setDropState(dropZone, item, isCorrect);
                markAttempt(dropZone);

                if (isCorrect) {
                    showStatus(group, true, 'Benar');
                } else {
                    showStatus(group, false, 'Salah.');
                }

                updateEksplorasiExplanations();
            }

            function setupDragItems() {
                document.querySelectorAll('.drag-item').forEach(item => {
                    item.addEventListener('dragstart', function () {
                        if (this.classList.contains('locked')) return;

                        draggedItem = this;
                        this.classList.add('dragging');

                        const parent = this.parentElement;
                        if (parent && parent.classList.contains('drop-zone')) {
                            this.dataset.fromZone = parent.id;
                        } else {
                            this.dataset.fromZone = '';
                        }
                    });

                    item.addEventListener('dragend', function () {
                        this.classList.remove('dragging');
                    });
                });
            }

            function setupDropZones() {
                document.querySelectorAll('.drop-zone').forEach(zone => {
                    zone.addEventListener('dragover', function (e) {
                        e.preventDefault();
                        if (this.dataset.solved === 'true') return;
                        this.classList.add('hovered');
                    });

                    zone.addEventListener('dragleave', function () {
                        this.classList.remove('hovered');
                    });

                    zone.addEventListener('drop', function (e) {
                        e.preventDefault();
                        this.classList.remove('hovered');

                        if (!draggedItem) return;
                        if (this.dataset.solved === 'true') return;

                        const group = this.dataset.group;
                        clearStatus(group);

                        const existingItem = this.querySelector('.drag-item');

                        if (existingItem && existingItem !== draggedItem) {
                            moveItemToBank(existingItem, group);
                        }

                        const fromZoneId = draggedItem.dataset.fromZone;
                        if (fromZoneId) {
                            const fromZone = document.getElementById(fromZoneId);
                            if (fromZone && fromZone !== this) {
                                fromZone.innerHTML = '';
                                clearZoneState(fromZone);
                            }
                        }

                        this.innerHTML = '';
                        this.appendChild(draggedItem);

                        evaluateDropZone(this);
                        draggedItem = null;
                    });
                });
            }

            function setupBanks() {
                document.querySelectorAll('.drag-bank').forEach(bank => {
                    bank.addEventListener('dragover', function (e) {
                        e.preventDefault();
                    });

                    bank.addEventListener('drop', function (e) {
                        e.preventDefault();
                        if (!draggedItem) return;
                        if (draggedItem.classList.contains('locked')) return;

                        const fromZoneId = draggedItem.dataset.fromZone;
                        if (fromZoneId) {
                            const fromZone = document.getElementById(fromZoneId);
                            if (fromZone) {
                                fromZone.innerHTML = '';
                                clearZoneState(fromZone);
                            }
                        }

                        draggedItem.classList.remove('dragging');
                        this.appendChild(draggedItem);
                        draggedItem = null;

                        updateEksplorasiExplanations();
                    });
                });
            }

            window.resetEksplorasi = function () {
                attemptedDrops = 0;

                document.querySelectorAll('.drop-zone').forEach(zone => {
                    zone.innerHTML = '';
                    zone.classList.remove('filled', 'correct', 'wrong', 'hovered');
                    delete zone.dataset.solved;
                    delete zone.dataset.attempted;
                });

                document.querySelectorAll('.explanation-box').forEach(box => {
                    box.classList.remove('show');
                    const title = box.querySelector('h5');
                    if (title) {
                        if (box.id === 'explainGabungan') {
                            title.innerHTML = 'Penjelasan';
                        } else if (box.id === 'explainMakna') {
                            title.innerHTML = 'Penjelasan Makna';
                        }
                    }
                });

                document.querySelectorAll('.status-box').forEach(box => {
                    box.textContent = '';
                    box.className = 'status-box';
                });

                if (finalBoxEks) finalBoxEks.classList.remove('show');
                hideMateriSetelahEksplorasi();

                const bank1 = document.getElementById('answerBank1');
                const bank2 = document.getElementById('answerBank2');

                if (bank1) {
                    bank1.innerHTML = `
                        <div class="drag-item" draggable="true" data-value="0">0</div>
                        <div class="drag-item" draggable="true" data-value="-6">-6</div>
                        <div class="drag-item" draggable="true" data-value="1">1</div>
                        <div class="drag-item" draggable="true" data-value="4">4</div>
                    `;
                }

                if (bank2) {
                    bank2.innerHTML = `
                        <div class="drag-item" draggable="true" data-value="kain habis terjual">Kain habis terjual</div>
                        <div class="drag-item" draggable="true" data-value="masih ada 1 kain tersisa">Masih ada 1 kain tersisa</div>
                        <div class="drag-item" draggable="true" data-value="produksi bertambah">Produksi bertambah</div>
                        <div class="drag-item" draggable="true" data-value="tidak ada perubahan">Tidak ada perubahan</div>
                    `;
                }

                setupDragItems();
                setupBanks();

                rerenderMath();
                updateEksplorasiExplanations();
                checkEksplorasiSelesai();
            };

            setupDragItems();
            setupDropZones();
            setupBanks();
            updateEksplorasiExplanations();
            checkEksplorasiSelesai();
        });
    </script>


    <style>
        :root {
            --green: #1b7a2a;
            --orange: #e0702b;
            --text: #222;
            --muted: #555;
            --blue: #5b9bd5;
            --blue-soft: #f5f9ff;
            --def-bg: #e7ab97;
            --def-border: #de8d68;
            --def-pill: #8fcd76;
            --def-pill-border: #6ea85b;
            --latihan-border: #2498d3;
            --latihan-head: #8b8b8b;
            --success: #1f8a4c;
            --danger: #d64545;
            --card-shadow: 0 12px 30px rgba(0, 0, 0, .08);
            --radius-lg: 22px;
            --radius-md: 16px;
            --radius-sm: 12px;
        }

        .materi-wrap {
            max-width: 1000px;
            margin: 0 auto;
            font-family: "Times New Roman", Times, serif;
            line-height: 1.8;
            padding: 20px 14px 40px;
        }

        .top-title {
            display: flex;
            flex-direction: row;
            align-items: baseline;
            gap: 14px;
            margin-bottom: 18px;
        }

        .top-title .label {
            font-size: 34px;
            font-weight: 700;
            line-height: 1;
            color: #3f372f;
            margin: 0;
            flex-shrink: 0;
        }

        .top-title .judul {
            font-size: 34px;
            font-weight: 800;
            line-height: 1.1;
            color: #1b7a2a;
            margin: 0;
        }

        .card {
            border-radius: 16px;
            padding: 20px 22px;
            background: #fff;
            margin-bottom: 20px;
            box-shadow: 0 10px 28px rgba(0, 0, 0, .05);
        }

        .tujuan-card {
            position: relative;
            background: #f5ede6;
            border-radius: 24px;
            padding: 24px 28px 24px 34px;
            border: 1px solid #cfc6be;
            overflow: hidden;
        }

        .tujuan-card::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 14px;
            background: #d86f2d;
            border-top-left-radius: 24px;
            border-bottom-left-radius: 24px;
        }

        .tujuan-card::after {
            content: "";
            position: absolute;
            left: 8px;
            top: 10px;
            bottom: 10px;
            width: 8px;
            background: #f5ede6;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
        }

        .tujuan-header .title {
            font-size: 24px;
            font-weight: 800;
            color: #1f7a34;
            margin-bottom: 10px;
        }

        .tujuan-card ol {
            margin: 0;
            padding-left: 24px;
            color: #5a5a5a;
            font-size: 18px;
        }

        .tujuan-card li {
            margin-top: 6px;
            line-height: 1.6;
        }

        .section-title {
            font-size: 28px;
            font-weight: 800;
            margin: 30px 0 12px;
        }

        .section-title .nomor {
            color: #000;
            margin-right: 6px;
        }

        .section-title .judul-section {
            color: var(--green);
        }

        /* CARD UTAMA - FULL FLAT */
        /* =========================
                                                               CARD EKSPLORASI (VERSI DIPERBAIKI & LEBIH KECIL)
                                                               ========================= */
        .card-eksplorasi {
            position: relative;
            overflow: hidden;
            background: #eaf3ff !important;
            background-image: none !important;
            border: 1px solid #cfe3ff;
            border-left: 3px solid #5b9bd5;
            border-radius: 10px;
            padding: 10px;
            box-shadow: none !important;
        }

        /* MATIKAN EFEK TAMBAHAN */
        .card-eksplorasi::before,
        .card-eksplorasi::after {
            display: none !important;
            content: none !important;
        }

        /* HAPUS GRADASI DALAM */
        .card-eksplorasi * {
            background-image: none !important;
        }

        /* ISI DALAM */
        .eksplorasi-story,
        .explore-grid,
        .mini-card {
            background: transparent !important;
        }

        /* teks umum dalam eksplorasi */
        .card-eksplorasi p,
        .card-eksplorasi li {
            font-size: 12px;
            line-height: 1.4;
            margin-bottom: 6px;
        }

        /* judul eksplorasi */
        .eksplorasi-bar {
            margin-bottom: 10px;
            gap: 6px;
        }

        .eksplorasi-bar h3 {
            font-size: 14px;
        }

        /* grid pertanyaan 1 & 2 */
        .explore-grid {
            gap: 8px;
            margin-top: 10px;
            grid-template-columns: 1fr 1fr;
            align-items: start;
        }

        /* MINI CARD */
        .mini-card {
            padding: 4px !important;
        }

        .mini-card h4 {
            font-size: 9px;
            margin-bottom: 4px;
        }

        .mini-card p {
            font-size: 11px;
            margin-bottom: 6px;
            line-height: 1.35;
        }

        /* box rumus */
        .rumus-box {
            padding: 6px;
            margin: 6px 0;
            border-radius: 8px;
        }

        .rumus-box .rumus-label {
            font-size: 9px;
            padding: 2px 6px;
            margin-bottom: 3px;
        }

        .rumus-box .rumus-besar {
            font-size: 12px;
        }

        /* Label bank */
        .bank-label {
            font-size: 10px;
            padding: 3px 8px;
            margin-bottom: 6px;
        }

        /* Drag item */
        .drag-item {
            padding: 2px 5px;
            font-size: 11px;
            border-radius: 8px;
            font-weight: 600;
        }

        /* Bank lebih rapat */
        .drag-bank {
            gap: 4px;
        }

        /* catatan kecil */
        .small-note {
            font-size: 10px;
            margin-top: 4px;
        }

        /* Drop area */
        .drop-list {
            gap: 8px;
        }

        .drop-row {
            grid-template-columns: 52px 1fr;
            gap: 6px;
            align-items: center;
        }

        .drop-label {
            font-size: 11px;
            padding: 4px;
            border-radius: 6px;
        }

        .drop-zone {
            min-height: 23px;
            padding: 2px 4px;
            border-radius: 8px;
        }

        /* Placeholder */
        .drop-zone::after {
            font-size: 9px;
        }

        /* Penjelasan */
        .explanation-box {
            margin-top: 6px;
            padding: 8px 10px;
            border-radius: 8px;
        }

        .explanation-box h5 {
            font-size: 11px;
            margin-bottom: 4px;
        }

        .explanation-box p {
            font-size: 10px;
            line-height: 1.35;
            margin-bottom: 4px;
        }

        /* Status box */
        .status-box {
            font-size: 10px;
            padding: 6px 8px;
            margin-top: 6px;
            border-radius: 8px;
        }

        p,
        li {
            color: var(--muted);
            font-size: 18px;
        }

        .highlight {
            font-weight: 700;
            color: #000;
        }

        .definisi-modern {
            position: relative;
            background: var(--def-bg);
            border: 1.5px solid var(--def-border);
            border-radius: 16px;
            padding: 20px 18px 14px;
            margin-top: 10px;
        }

        .definisi-pill {
            position: absolute;
            top: -20px;
            left: 20px;
            background: var(--def-pill);
            color: #3b6a31;
            font-size: 15px;
            font-weight: 800;
            letter-spacing: .2px;
            padding: 6px 18px;
            border-radius: 14px;
            border: 1.5px solid var(--def-pill-border);
            box-shadow: 0 4px 10px rgba(0, 0, 0, .08);
        }

        .definisi-modern p,
        .definisi-modern li {
            font-size: 15px;
            line-height: 1.6;
        }

        .definisi-modern .rumus-besar {
            font-size: 20px;
            margin: 10px 0;
        }

        .definisi-modern ul {
            margin: 10px 0 0 22px;
            padding: 0;
        }

        .definisi-modern li {
            margin-bottom: 4px;
        }

        .sifat-box {
            position: relative;
            background: #ffffff;
            border: 2px solid #5aa05a;
            border-radius: 18px;
            padding: 20px 20px 16px;
            margin-top: 20px;
        }

        .sifat-label {
            position: absolute;
            top: -14px;
            left: 20px;
            background: #e3a07b;
            color: #4a2c1f;
            font-weight: 700;
            font-size: 13px;
            padding: 6px 18px;
            border-radius: 12px 20px 20px 12px;
            border: 1.5px solid #cf7444;
        }

        .sifat-box p,
        .sifat-box li {
            font-size: 16px;
            line-height: 1.7;
            color: #5a4a42;
        }

        .sifat-box .katex-display {
            margin: 8px 0;
            font-size: 1em;
        }

        /* =========================
                                           FIX POSISI BADGE CONTOH
                                           ========================= */

        /* hapus efek naik */
        .contoh-wrap {
            margin-top: 38px !important;
            position: relative;
        }

        /* badge CONTOH diturunkan dan dibuat stabil */
        .contoh-pill {
            display: inline-block;
            background: #e7ab97;
            color: #5a2d18;
            font-weight: 800;
            font-size: 16px;
            padding: 10px 34px;
            border-radius: 999px;
            border: 1.5px solid #d98a63;
            margin: 0 0 22px 0 !important;
            position: relative;
            top: 0 !important;
            left: 0 !important;
            transform: none !important;
            z-index: 3;
        }

        /* box contoh diberi jarak dari badge */
        .contoh-area {
            margin-top: 8px;
            border: 2px solid #79bf6a;
            border-radius: 22px;
            background: #f6f8f3;
            padding: 30px 24px 28px;
        }

        /* kalau ada contoh rasional, samakan juga */
        .contoh-rasional-wrap {
            margin-top: 38px !important;
            position: relative;
        }

        .contoh-rasional-pill {
            display: inline-block;
            min-width: 110px;
            text-align: center;
            background: #eda98d;
            color: #472819;
            font-size: 18px;
            font-weight: 800;
            padding: 10px 30px;
            border-radius: 999px;
            border: 1.5px solid #dd7d54;
            margin: 0 0 22px 0 !important;
            position: relative;
            top: 0 !important;
            left: 0 !important;
            transform: none !important;
            z-index: 3;
        }

        .contoh-rasional-box {
            margin-top: 8px;
            border: 2px solid #79bf6a;
            border-radius: 22px;
            background: #f6f8f3;
            padding: 30px 24px 28px;
        }


        .contoh-rasional-wrap,
        .latihan-wrap {
            margin-top: 28px;
        }

        .contoh-pill,
        .contoh-rasional-pill {
            display: inline-block;
            background: #e7ab97;
            color: #5a2d18;
            font-weight: 800;
            font-size: 16px;
            padding: 8px 28px;
            border-radius: 999px;
            border: 1.5px solid #d98a63;
            margin-bottom: 18px;
        }

        .contoh-rasional-pill {
            min-width: 110px;
            text-align: center;
            background: #eda98d;
            color: #472819;
            font-size: 18px;
            border: 1.5px solid #dd7d54;
            margin-left: 2px;
        }

        .contoh-area,
        .contoh-rasional-box {
            border: 2px solid #79bf6a;
            border-radius: 22px;
            background: #f6f8f3;
            padding: 24px 24px 28px;
        }

        .contoh-rasional-box p,
        .contoh-rasional-box li {
            font-size: 13px;
            line-height: 1.8;
            color: #222;
        }

        .diket-plain {
            margin-bottom: 24px;
        }

        .diket-plain .judul-kecil {
            font-size: 18px;
            font-weight: 700;
            color: #4d4d4d;
            margin-bottom: 16px;
        }

        .soal-rumus {
            text-align: center;
            font-size: 20px;
            margin: 8px 0 18px;
            color: #555;
        }

        .langkah-card {
            background: #fff;
            border: 1.5px solid #d8e7d2;
            border-radius: 16px;
            padding: 18px 18px 16px;
            margin-top: 18px;
        }

        .langkah-title {
            font-size: 17px;
            font-weight: 800;
            color: #1b7a2a;
            margin-bottom: 8px;
        }

        .langkah-sub {
            font-size: 16px;
            color: #666;
            margin-bottom: 12px;
        }

        .input-jawaban {
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #cfcfcf;
            border-radius: 10px;
            padding: 10px 12px;
            font-size: 15px;
            font-family: inherit;
            margin-top: 8px;
        }

        .btn-cek {
            margin-top: 12px;
            background: #1b7a2a;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px 18px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
        }

        .btn-cek:hover {
            opacity: .95;
        }

        .feedback {
            margin-top: 10px;
            font-size: 14px;
            font-weight: 700;
        }

        .feedback.ok {
            color: #1b7a2a;
        }

        .feedback.no {
            color: #c0392b;
        }

        .penjelasan-step {
            display: none;
            margin-top: 14px;
            background: #f3fbf1;
            border-left: 5px solid #79bf6a;
            border-radius: 10px;
            padding: 12px 14px;
        }

        .penjelasan-step p,
        .penjelasan-step li {
            font-size: 16px;
            margin: 0;
            color: #4d5a4c;
        }

        .final-explanation {
            display: none;
            margin-top: 22px;
            background: #fff8f4;
            border: 2px solid #ebb48d;
            border-radius: 16px;
            padding: 18px;
        }

        .final-explanation h4 {
            margin-top: 0;
            margin-bottom: 10px;
            color: #9b4d16;
            font-size: 22px;
        }

        .final-result {
            text-align: center;
            font-size: 24px;
            margin-top: 10px;
        }

        .horner-caption {
            text-align: center;
            font-size: 16px;
            color: #555;
            margin-bottom: 8px;
        }

        .horner-wrap {
            overflow-x: auto;
            margin-top: 12px;
            margin-bottom: 10px;
        }

        .horner-table {
            margin: 0 auto;
            border-collapse: collapse;
            font-size: 22px;
            color: #222;
            font-family: "Times New Roman", Times, serif;
        }

        .horner-table td {
            width: 72px;
            height: 56px;
            text-align: center;
            vertical-align: middle;
            box-sizing: border-box;
        }

        .horner-table .left-number {
            width: 52px;
            font-weight: 700;
        }

        .horner-top {
            border-top: 3px solid #333;
        }

        .horner-left {
            border-left: 3px solid #333;
        }

        .horner-bottom {
            border-bottom: 3px solid #333;
        }

        .horner-sisa {
            border-left: 3px solid #333;
            border-top: 3px solid #333;
            border-bottom: 3px solid #333;
        }

        .horner-box {
            width: 42px;
            height: 34px;
            border: 1.8px solid #b0b0b0;
            border-radius: 7px;
            text-align: center;
            font-size: 18px;
            font-family: inherit;
            outline: none;
            background: #fff;
            color: #222;
        }

        .horner-box:focus {
            border-color: #1b7a2a;
            box-shadow: 0 0 0 2px rgba(27, 122, 42, 0.12);
        }

        .latihan-header {
            display: inline-block;
            min-width: 220px;
            text-align: center;
            background: var(--latihan-head);
            color: #fff;
            font-weight: 700;
            font-size: 18px;
            letter-spacing: .5px;
            padding: 10px 32px;
            border-radius: 10px;
            margin-bottom: 14px;
        }

        .latihan-box {
            border: 3px solid var(--latihan-border);
            background: #fff;
            padding: 18px 18px 20px;
        }

        .latihan-box>ol {
            margin: 0;
            padding-left: 26px;
        }

        .latihan-box>ol>li {
            color: #222;
            margin-bottom: 28px;
        }

        .latihan-soal-text {
            font-size: 17px;
            color: #222;
            line-height: 1.6;
        }

        .latihan-soal-rumus {
            text-align: center;
            font-size: 25px;
            color: #333;
            margin: 10px 0 16px;
        }

        .opsi-wrap {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
            margin-top: 10px;
        }

        .opsi-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            border: 1.5px solid #d7d7d7;
            background: #fafafa;
            border-radius: 12px;
            padding: 12px 14px;
            cursor: pointer;
        }

        .opsi-item input {
            margin-top: 5px;
            transform: scale(1.1);
        }

        .opsi-item span {
            font-size: 16px;
            color: #333;
            line-height: 1.6;
        }

        .mini-note {
            font-size: 15px;
            color: #666;
            margin-top: 4px;
        }

        /* =========================
                                                                                                                                                                                                                                           DRAG & DROP EKSPLORASI
                                                                                                                                                                                                                                        ========================== */
        /* =========================
                                                                                                                                                                                                                               CARD EKSPLORASI (FINAL)
                                                                                                                                                                                                                            ========================== */

        /* card utama */
        .card-eksplorasi {
            background: linear-gradient(180deg, var(--blue-soft), #7e9fff);
            border-left: 6px solid var(--blue);
        }

        /* hilangkan ornamen lama */
        .card-eksplorasi::before,
        .card-eksplorasi::after {
            content: none !important;
            display: none !important;
        }

        /* =========================
                                                                                                                                                                                                                               JUDUL EKSPLORASI
                                                                                                                                                                                                                            ========================== */

        .eksplorasi-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 26px;
        }

        .eksplorasi-bar h3 {
            margin: 0;
            font-size: 22px;
            font-weight: 700;
            color: #2f5597;
            font-family: "Times New Roman", Times, serif;
            line-height: 1.2;
        }

        /* icon kecil */
        .eksplorasi-icon-mini {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: #f4c542;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            line-height: 1;
            flex-shrink: 0;
        }

        /* =========================
                                                                                                                                                                                                                               MATIKAN HEADER LAMA
                                                                                                                                                                                                                            ========================== */

        .eksplorasi-header,
        .eksplorasi-icon,
        .eksplorasi-title-wrap,
        .eksplorasi-title-wrap h3,
        .eksplorasi-title-wrap p {
            display: none !important;
        }

        /* =========================
                                                                                                                                                                                                                               ISI TEKS
                                                                                                                                                                                                                            ========================== */

        .card-eksplorasi p,
        .card-eksplorasi li {
            font-size: 18px;
            line-height: 1.9;
            color: #5a5a5a;
        }

        /* =========================
                                                                                                                                                                                                                               AREA STORY (TANPA KOTAK)
                                                                                                                                                                                                                            ========================== */

        .eksplorasi-story {
            position: relative;
            z-index: 1;
            background: transparent;
            border: none;
            border-radius: 0;
            padding: 0;
            margin: 0;
            box-shadow: none;
        }

        .eksplorasi-story p {
            margin: 0 0 18px;
            font-size: 18px;
            line-height: 1.9;
            color: #444;
        }

        .eksplorasi-story ul {
            margin: 8px 0 18px 24px;
            padding: 0;
        }

        .eksplorasi-story li {
            margin-bottom: 6px;
            font-size: 17px;
            line-height: 1.8;
            color: #444;
        }

        /* =========================
                                                                                                                                                                                                                               RUMUS BOX (SEPERTI GAMBAR)
                                                                                                                                                                                                                            ========================== */

        .rumus-box {
            background: #f7f7f7;
            border: 1px dashed #bfc9d8;
            border-radius: 18px;
            padding: 22px 18px;
            text-align: center;
            margin: 20px 0;
        }

        /* label kecil di atas rumus */
        .rumus-box .rumus-label {
            display: inline-block;
            background: #dce6f5;
            color: #2f5597;
            font-size: 12px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 999px;
            margin-bottom: 10px;
        }

        /* ukuran rumus */
        .rumus-box .rumus-besar {
            font-size: 20px;
        }

        /* =========================
                                                                                                                                                                                                                               RESPONSIVE (BIAR AMAN)
                                                                                                                                                                                                                            ========================== */

        @media (max-width: 768px) {
            .card-eksplorasi {
                padding: 24px 20px;
            }

            .eksplorasi-bar h3 {
                font-size: 20px;
            }

            .card-eksplorasi p {
                font-size: 16px;
            }
        }

        .rumus-box {
            background: linear-gradient(180deg, #f7fbff, #ffffff);
            border: 1px dashed #aac9ee;
            border-radius: 18px;
            padding: 16px;
            text-align: center;
            margin: 14px 0;
        }

        .rumus-box .rumus-label {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 999px;
            background: #e9f3ff;
            color: #2e6cab;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .2px;
            margin-bottom: 8px;
        }

        .explore-grid {
            display: grid;
            grid-template-columns: 1.15fr .85fr;
            gap: 20px;
            margin-top: 18px;
        }

        .mini-card {
            background: transparent;
            border: none;
            box-shadow: none;
            padding: 0;
        }

        .mini-card h4 {
            margin: 0 0 8px;
            font-size: 22px;
            color: #1e5f96;
        }

        .mini-card p {
            margin: 0 0 14px;
            color: var(--muted);
            font-size: 16px;
        }

        .bank-label {
            display: inline-block;
            margin-bottom: 12px;
            padding: 6px 14px;
            border-radius: 999px;
            background: #fff3ea;
            color: #b85b16;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: .2px;
        }

        .drag-bank {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .drag-item {
            user-select: none;
            -webkit-user-drag: element;
            padding: 12px 18px;
            border-radius: 14px;
            background: linear-gradient(180deg, #ffffff, #f5f9ff);
            border: 2px solid #cfe2fb;
            color: #244e78;
            font-size: 18px;
            font-weight: 700;
            cursor: grab;
            transition: .2s ease;
            box-shadow: 0 6px 14px rgba(75, 143, 216, .10);
        }

        .drag-item:hover {
            transform: translateY(-2px);
        }

        .drag-item.dragging {
            opacity: .55;
            transform: scale(.96);
            cursor: grabbing;
        }

        .drag-item.locked {
            cursor: default;
            opacity: .92;
            border-color: #9fd3ad;
            background: linear-gradient(180deg, #f7fff9, #eefaf1);
            color: #1f7a34;
        }

        .drop-list {
            display: grid;
            gap: 14px;
        }

        .drop-row {
            display: grid;
            grid-template-columns: 120px 1fr;
            gap: 12px;
            align-items: center;
        }

        .drop-label {
            font-size: 20px;
            font-weight: 700;
            color: #2f3b4f;
            text-align: center;
            background: #f7f9fc;
            border-radius: 12px;
            padding: 10px 8px;
            border: 1px solid #e7edf6;
        }

        .drop-zone {
            min-height: 62px;
            border: 2px dashed #b9cce3;
            border-radius: 16px;
            background: #fbfdff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8px;
            transition: .2s ease;
            position: relative;
        }

        .drop-zone::after {
            content: attr(data-placeholder);
            color: #91a0b5;
            font-size: 15px;
            font-style: italic;
        }

        .drop-zone.filled::after {
            content: "";
        }

        .drop-zone.hovered {
            border-color: var(--blue);
            background: #f1f8ff;
            transform: scale(1.01);
        }

        .drop-zone.correct {
            border-color: #76c38a;
            background: #f2fbf4;
        }

        .drop-zone.wrong {
            border-color: #e59a9a;
            background: #fff5f5;
        }

        .status-box {
            margin-top: 14px;
            border-radius: 14px;
            padding: 12px 14px;
            font-size: 15px;
            display: none;
        }

        .status-box.show {
            display: block;
        }

        .status-box.success {
            background: #eefaf1;
            border: 1px solid #bfe4c8;
            color: #216d3d;
        }

        .status-box.error {
            background: #fff3f3;
            border: 1px solid #efc2c2;
            color: #ad3030;
        }

        .paragraf-pengantar {
            font-size: 15px;
            line-height: 1.7;
            margin-bottom: 20px;
            text-align: justify;
        }

        .definisi-modern {
            margin-top: 20px;
        }

        .explanation-box {
            display: none;
            margin-top: 14px;
            background: linear-gradient(180deg, #f6fff8, #ffffff);
            border-left: 6px solid #67b87d;
            border-radius: 14px;
            padding: 14px 16px;
        }

        .explanation-box.show {
            display: block;
            animation: fadeIn .35s ease;
        }

        .explanation-box h5 {
            margin: 0 0 8px;
            font-size: 18px;
            color: #1f7a34;
        }

        .explanation-box p {
            margin: 0 0 6px;
            font-size: 16px;
            color: #334;
        }

        .progress-wrap {
            margin-top: 18px;
            background: #f5f9ff;
            border: 1px solid #deebfb;
            border-radius: 16px;
            padding: 14px;
        }

        .progress-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
        }

        .progress-top span {
            font-size: 15px;
            color: #476483;
            font-weight: 700;
        }

        .progress-bar {
            height: 12px;
            border-radius: 999px;
            background: #dfeaf8;
            overflow: hidden;
        }

        .progress-fill {
            width: 0%;
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(90deg, #4b8fd8, #79b0ed);
            transition: width .3s ease;
        }

        .eksplorasi-final {
            display: none;
            margin-top: 20px;
            background: linear-gradient(180deg, #fffaf5, #ffffff);
            border: 2px solid #f0c7a6;
            border-radius: 18px;
            padding: 18px;
        }

        .eksplorasi-final.show {
            display: block;
            animation: fadeIn .35s ease;
        }

        .eksplorasi-final h4 {
            margin: 0 0 10px;
            color: #a85a1d;
            font-size: 22px;
        }

        .eksplorasi-final p {
            margin: 0 0 8px;
            font-size: 17px;
            color: #444;
        }

        .btn-reset {
            margin-top: 16px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #1f7a34, #2fa44c);
            color: #fff;
            padding: 11px 18px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 8px 18px rgba(31, 122, 52, .18);
        }

        .btn-reset:hover {
            opacity: .95;
        }

        .small-note {
            margin-top: 8px;
            color: #7b8797;
            font-size: 14px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 860px) {
            .explore-grid {
                grid-template-columns: 1fr;
            }

            .drop-row {
                grid-template-columns: 1fr;
            }

            .drop-label {
                text-align: left;
            }

            .top-title {
                flex-direction: column;
                gap: 6px;
            }

            .top-title .label,
            .top-title .judul {
                font-size: 28px;
            }
        }

        .cara-menjawab-box {
            margin: 10px 0 14px 0;
            background: #f8fdf6;
            border-left: 5px solid #79bf6a;
            border-radius: 12px;
            padding: 12px 14px;
        }

        .cara-menjawab-title {
            font-size: 15px;
            font-weight: 700;
            color: #1b7a2a;
            margin-bottom: 6px;
        }

        .cara-menjawab-box p,
        .cara-menjawab-list li {
            font-size: 15px;
            line-height: 1.7;
            color: #4d5a4c;
        }

        .cara-menjawab-list {
            margin: 6px 0 6px 20px;
            padding: 0;
        }

        .cara-menjawab-rumus {
            text-align: center;
            margin: 8px 0;
            font-size: 18px;
        }

        /* =========================
                                                                                                                       SIFAT - VERSI FIX
                                                                                                                       ========================= */

        /* BOX MODERN */
        .sifat-box.modern {
            position: relative;
            margin-top: 32px;
            padding: 36px 24px 22px;
            /* ruang atas untuk badge */
            border-radius: 24px;
            background: linear-gradient(180deg, #f9fcf8, #f2f8f1);
            border: 2px solid #69a96b;
            box-shadow: 0 10px 24px rgba(55, 104, 58, 0.08);
            overflow: visible;
            /* FIX: jangan hidden */
        }

        /* ORNAMEN BACKGROUND */
        .sifat-box.modern::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at top right, rgba(106, 168, 110, 0.12), transparent 28%),
                radial-gradient(circle at bottom left, rgba(224, 112, 43, 0.10), transparent 24%);
            pointer-events: none;
            z-index: 0;
        }

        /* BADGE SIFAT */
        .sifat-badge {
            position: absolute;
            top: 10px;
            /* FIX: jangan negatif */
            left: 20px;
            background: linear-gradient(135deg, #e7a07d, #d97d4f);
            color: #fff;
            font-weight: 800;
            font-size: 13px;
            letter-spacing: 0.5px;
            padding: 8px 18px;
            border-radius: 999px;
            border: 2px solid #c96d40;
            box-shadow: 0 6px 14px rgba(201, 109, 64, 0.22);
            z-index: 10;
            line-height: 1;
            display: inline-block;
        }

        /* HEADER */
        .sifat-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 18px;
            position: relative;
            z-index: 1;
        }

        .sifat-icon {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: linear-gradient(135deg, #79bf6a, #4f9b53);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: 0 8px 16px rgba(79, 155, 83, 0.20);
            flex-shrink: 0;
        }

        .sifat-header h3 {
            margin: 0;
            font-size: 24px;
            color: #256b2d;
            font-weight: 800;
            line-height: 1.2;
        }

        .sifat-header p {
            margin: 4px 0 0;
            font-size: 15px;
            color: #5f6d5f;
            line-height: 1.6;
        }

        /* RUMUS */
        .sifat-rumus {
            position: relative;
            z-index: 1;
            background: #fff;
            border-radius: 18px;
            padding: 16px 14px;
            text-align: center;
            border: 1.5px solid #d7e9d4;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.5);
        }

        .sifat-rumus.utama {
            margin-bottom: 18px;
            font-size: 1.08em;
        }

        /* SUBTITLE */
        .sifat-subtitle {
            position: relative;
            z-index: 1;
            font-size: 17px;
            font-weight: 700;
            color: #476047;
            margin-bottom: 12px;
        }

        /* GRID */
        .sifat-grid {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 18px;
        }

        .sifat-item {
            background: rgba(255, 255, 255, 0.85);
            border: 1.5px solid #dbe9d8;
            border-radius: 18px;
            padding: 16px;
        }

        .sifat-item-label {
            font-size: 15px;
            font-weight: 700;
            color: #5a4a42;
            margin-bottom: 10px;
        }

        .sifat-rumus.kecil {
            background: #f8fbf7;
            border: 1px dashed #bdd4ba;
            padding: 12px 10px;
            border-radius: 14px;
        }

        /* HIGHLIGHT */
        .sifat-highlight {
            position: relative;
            z-index: 1;
            text-align: center;
            background: linear-gradient(135deg, #fff5ee, #fffaf7);
            border: 1.5px solid #efc2a6;
            border-radius: 18px;
            padding: 14px 12px;
            color: #8f4c22;
            font-weight: 700;
        }

        /* KATEX */
        .sifat-box.modern .katex-display {
            margin: 0;
        }

        /* =========================
                                                                                                                       SIFAT - VERSI SIMPLE
                                                                                                                       ========================= */

        .sifat-box {
            position: relative;
            background: #f8faf7;
            border: 2px solid #5aa05a;
            border-radius: 20px;
            padding: 20px 22px 18px;
            margin-top: 30px;
            overflow: visible !important;
        }

        .sifat-label {
            display: inline-block;
            margin-bottom: 12px;
            background: linear-gradient(180deg, #e8a47f, #d98a5e);
            color: #fff;
            font-weight: 800;
            font-size: 15px;
            padding: 8px 20px;
            border-radius: 999px;
            border: 1.5px solid #c96f42;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.10);
            line-height: 1;
        }

        .sifat-box p,
        .sifat-box li {
            font-size: 16px;
            line-height: 1.7;
            color: #5a4a42;
        }

        .sifat-box .katex-display {
            margin: 10px 0;
            font-size: 1em;
        }

        /* =========================
                                                                                                                       RESPONSIVE
                                                                                                                       ========================= */

        @media (max-width: 768px) {
            .sifat-grid {
                grid-template-columns: 1fr;
            }

            .sifat-header {
                align-items: flex-start;
            }

            .sifat-header h3 {
                font-size: 21px;
            }

            .sifat-box.modern {
                padding: 42px 18px 18px;
            }

            .sifat-badge {
                top: 10px;
                left: 16px;
                font-size: 12px;
                padding: 7px 16px;
            }

            .sifat-box {
                padding: 18px 16px 16px;
            }

            .sifat-label {
                font-size: 14px;
                padding: 7px 16px;
            }
        }

        @media (max-width: 768px) {
            .sifat-grid {
                grid-template-columns: 1fr;
            }

            .sifat-header {
                align-items: flex-start;
            }

            .sifat-header h3 {
                font-size: 21px;
            }
        }

        .btn-petunjuk {
            margin-top: 10px;
            margin-bottom: 12px;
            background: #fff7ef;
            color: #9b4d16;
            border: 1.5px solid #e6b086;
            border-radius: 10px;
            padding: 9px 16px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            transition: .2s ease;
        }

        .btn-petunjuk:hover {
            background: #fff1e4;
        }

        .cara-menjawab-box {
            display: none;
            margin: 10px 0 14px 0;
            background: #f8fdf6;
            border-left: 5px solid #79bf6a;
            border-radius: 12px;
            padding: 12px 14px;
        }

        .cara-menjawab-box.show {
            display: block;
            animation: fadeIn .25s ease;
        }

        .feedback {
            margin-top: 10px;
            font-size: 14px;
            font-weight: 700;
            display: none;
        }

        .feedback.show {
            display: block;
        }

        .feedback.ok {
            color: #1b7a2a;
        }

        .feedback.no {
            color: #c0392b;
        }

        .input-jawaban.input-correct,
        .horner-box.input-correct {
            border: 2px solid #2e9b50 !important;
            background: #f1fff5;
            color: #1f6e38;
        }

        .input-jawaban.input-wrong,
        .horner-box.input-wrong {
            border: 2px solid #d64545 !important;
            background: #fff5f5;
            color: #9f1f1f;
        }

        .btn-petunjuk {
            margin-top: 8px;
            margin-bottom: 12px;
            background: #fff7ef;
            color: #9b4d16;
            border: 1.5px solid #e0a67f;
            border-radius: 10px;
            padding: 9px 16px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
        }

        .btn-petunjuk:hover {
            background: #fff1e7;
        }

        .feedback {
            display: none;
            margin-top: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
        }

        .feedback.show {
            display: block;
        }

        .feedback.ok {
            background: #eefaf1;
            border: 1px solid #bfe4c8;
            color: #216d3d;
        }

        .feedback.no {
            background: #fff3f3;
            border: 1px solid #efc2c2;
            color: #ad3030;
        }

        .latihan-wrap.modern {
            margin-top: 34px;
        }

        .latihan-headbar {
            margin-bottom: 16px;
        }

        .latihan-badge {
            display: inline-block;
            background: linear-gradient(135deg, #7f8c8d, #9aa3a4);
            color: #fff;
            font-weight: 800;
            font-size: 16px;
            letter-spacing: .4px;
            padding: 10px 24px;
            border-radius: 999px;
            margin-bottom: 10px;
        }

        .latihan-intro {
            margin: 0;
            color: #666;
            font-size: 15px;
        }

        .latihan-panel {
            background: #ffffff;
            border: 2px solid #2498d3;
            border-radius: 24px;
            padding: 24px;
            box-shadow: 0 10px 24px rgba(0, 0, 0, .05);
        }

        .latihan-list {
            margin: 0;
            padding-left: 22px;
        }

        .latihan-item {
            margin-bottom: 34px;
            color: #222;
        }

        .latihan-item:last-child {
            margin-bottom: 0;
        }

        .latihan-question-card {
            background: #f8fbff;
            border: 1px solid #d7ebf8;
            border-radius: 18px;
            padding: 18px 18px 14px;
            margin-bottom: 18px;
        }

        .step-group {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .step-item {
            background: #fff;
            border: 1px solid #e9eef3;
            border-radius: 18px;
            padding: 18px 18px 16px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, .03);
        }

        .step-header {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .step-number {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #1b7a2a;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 15px;
            flex-shrink: 0;
        }

        .step-heading {
            flex: 1;
        }

        .step-title {
            font-size: 17px;
            font-weight: 800;
            color: #1b7a2a;
            margin-bottom: 4px;
        }

        .step-sub {
            font-size: 15px;
            color: #666;
            line-height: 1.6;
        }

        .step-body {
            padding-left: 46px;
        }

        .step-explain {
            display: none;
            margin-top: 14px;
            background: #f4fbf4;
            border-left: 5px solid #79bf6a;
            border-radius: 12px;
            padding: 12px 14px;
        }

        .step-explain p,
        .step-explain li {
            font-size: 15px;
            color: #4d5a4c;
            margin: 0;
            line-height: 1.7;
        }

        @media (max-width: 768px) {
            .latihan-panel {
                padding: 16px;
            }

            .step-body {
                padding-left: 0;
            }

            .step-header {
                flex-direction: row;
            }
        }

        /* =========================
       LOCK AREA (SOAL 2)
    ========================= */
        .latihan-terkunci {
            position: relative;
            pointer-events: none;
            user-select: none;
            opacity: 0.5;
            filter: blur(2px);
            transition: 0.3s ease;
        }

        /* overlay tulisan */
        .latihan-terkunci::after {
            content: "Selesaikan Soal 1 terlebih dahulu";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);

            background: rgba(255, 255, 255, 0.9);
            padding: 10px 18px;
            border-radius: 10px;

            font-weight: 600;
            color: #b91c1c;
            font-size: 14px;

            pointer-events: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>

    <div class="materi-wrap">

        {{-- JUDUL --}}
        <div class="top-title">
            <div class="label">D.</div>
            <div class="judul">Faktor dan Pembuat Nol Polinomial</div>
        </div>

        {{-- TUJUAN --}}
        <div class="card tujuan-card">
            <div class="tujuan-header">
                <h3 class="title">Tujuan Pembelajaran</h3>
            </div>
            <ol>
                <li>
                    Melakukan pemfaktoran polinomial dan menentukan pembuat nol
                    (baik real maupun kompleks).
                </li>
            </ol>
        </div>

        {{-- SECTION --}}
        <div class="section-title">
            <span class="nomor">1.</span>
            <span class="judul-section">Teorema Faktor</span>
        </div>

        <div class="card card-eksplorasi">
            <div class="eksplorasi-bar">
                <div class="eksplorasi-icon-mini">🧭</div>
                <h3>Eksplorasi</h3>
            </div>


            <div class="eksplorasi-story">
                <p>
                    Perhatikan fungsi polinomial berikut:
                </p>

                <div class="rumus-box">
                    <div class="rumus-besar">
                        \[
                        P(x)=x^3-4x^2-x+4
                        \]
                    </div>
                </div>

                <p>
                    Untuk memahami bagaimana nilai polinomial bekerja, substitusikan nilai \(x\) ke dalam fungsi.
                </p>
            </div>


            <div class="explore-grid">

                <!-- PERTANYAAN 1 -->
                <div class="mini-card">
                    <h4>Pertanyaan 1</h4>
                    <p>Hitung nilai fungsi berikut, lalu cocokkan dengan hasil yang benar.</p>

                    <div class="bank-label">Seret pilihan jawaban</div>
                    <div class="drag-bank" id="answerBank1">
                        <div class="drag-item" draggable="true" data-value="0">0</div>
                        <div class="drag-item" draggable="true" data-value="-6">-6</div>
                        <div class="drag-item" draggable="true" data-value="1">1</div>
                        <div class="drag-item" draggable="true" data-value="4">4</div>
                    </div>

                    <div class="small-note">Petunjuk: substitusikan \(x\) ke fungsi \(P(x)\).</div>

                    <div class="drop-list" style="margin-top:16px;">
                        <div class="drop-row">
                            <div class="drop-label">\(P(1)\)</div>
                            <div class="drop-zone" data-placeholder="Drop jawaban di sini" data-answer="0" data-group="g1"
                                id="drop-p1"></div>
                        </div>

                        <div class="drop-row">
                            <div class="drop-label">\(P(2)\)</div>
                            <div class="drop-zone" data-placeholder="Drop jawaban di sini" data-answer="-6" data-group="g1"
                                id="drop-p2"></div>
                        </div>
                    </div>

                    <div id="statusEks1" class="status-box"></div>

                    <div id="explainGabungan" class="explanation-box">
                        <h5>Penjelasan</h5>

                        <p>
                            Untuk mengetahui banyak kain yang tersisa, kita substitusikan nilai \(x\) ke dalam fungsi
                            \(P(x)\).
                        </p>

                        <p><strong>1. Saat \(x=1\):</strong></p>
                        <p>
                            \[
                            P(1)=1^3-4(1)^2-1+4=0
                            \]
                        </p>
                        <p>
                            Artinya, pada hari ke-1 tidak ada kain yang tersisa (kain habis terjual).
                        </p>

                        <p><strong>2. Saat \(x=2\):</strong></p>
                        <p>
                            \[
                            P(2)=2^3-4(2)^2-2+4=8-16-2+4=-6
                            \]
                        </p>
                        <p>
                            Nilai negatif menunjukkan bahwa model matematika tidak lagi sesuai dengan kondisi nyata,
                            tetapi perhitungan secara aljabar tetap benar.
                        </p>
                    </div>
                </div>

                <!-- PERTANYAAN 2 -->
                <div class="mini-card">
                    <h4>Pertanyaan 2</h4>
                    <p>Perhatikan hasil berikut, lalu seret makna yang paling tepat.</p>

                    <div class="rumus-box">
                        <div class="rumus-label">HASIL</div>
                        <div class="rumus-besar">
                            \[
                            P(1)=0
                            \]
                        </div>
                    </div>

                    <div class="bank-label">Seret makna hasil</div>

                    <div class="drag-bank" id="answerBank2" style="flex-direction:column;">
                        <div class="drag-item" draggable="true" data-value="sisa pembagian adalah 0">
                            Sisa pembagian adalah 0
                        </div>

                        <div class="drag-item" draggable="true" data-value="sisa pembagian adalah 1">
                            Sisa pembagian adalah 1
                        </div>

                        <div class="drag-item" draggable="true" data-value="pembagi bernilai 0">
                            Pembagi bernilai 0
                        </div>

                        <div class="drag-item" draggable="true" data-value="tidak berkaitan dengan pembagian">
                            Tidak berkaitan dengan pembagian
                        </div>
                    </div>

                    <div class="drop-list" style="margin-top:16px;">
                        <div class="drop-row">
                            <div class="drop-label">Makna</div>
                            <div class="drop-zone" data-placeholder="Drop jawaban makna di sini"
                                data-answer="sisa pembagian adalah 0" data-group="g2" id="drop-makna">
                            </div>
                        </div>
                    </div>

                    <div id="statusEks2" class="status-box"></div>

                    <div id="explainMakna" class="explanation-box" style="display:none;">
                        <h5>Penjelasan Makna</h5>

                        <p>Dari hasil sebelumnya diperoleh:</p>

                        \[
                        P(1)=0
                        \]

                        <p>Dalam pembagian polinomial berlaku:</p>

                        \[
                        P(x)=(x-1)Q(x)+sisa
                        \]

                        <p>Jika \(x=1\), maka:</p>

                        \[
                        P(1)=(1-1)Q(1)+sisa
                        \]

                        \[
                        P(1)=0+sisa
                        \]

                        \[
                        P(1)=sisa
                        \]

                        <p>
                            Karena \(P(1)=0\), maka sisa pembagian oleh \((x-1)\)
                            adalah <strong>0</strong>.
                        </p>

                        <p>
                            Artinya, \((x-1)\) merupakan faktor dari polinomial tersebut.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div id="materiSetelahEksplorasi">

            <!-- PARAGRAF PENGANTAR -->
            <p class="paragraf-pengantar">
                Sebelumnya kamu telah mempelajari <span class="highlight">Teorema Sisa</span>,
                yang menyatakan bahwa sisa pembagian polinomial <em>P(x)</em> oleh bentuk linear
                <em>(x − c)</em> adalah <em>P(c)</em>. Teorema ini menjadi dasar bagi konsep yang
                sangat penting dalam pemfaktoran polinomial, yaitu
                <strong>Teorema Faktor</strong>. Melalui teorema ini, kita dapat menentukan
                apakah suatu bentuk linear merupakan faktor dari polinomial tanpa melakukan pembagian panjang.
            </p>

            <!-- CARD DEFINISI -->
            <div class="definisi-modern">
                <div class="definisi-pill">DEFINISI</div>

                <p>
                    <strong>Teorema Faktor</strong> memberikan cara cepat untuk mengetahui apakah
                    suatu bentuk linear merupakan faktor dari suatu polinomial.
                </p>

                <p>Jika suatu polinomial \( P(x) \) memenuhi:</p>

                <div class="rumus-besar">
                    \[
                    P(c) = 0
                    \]
                </div>

                <p>maka dapat disimpulkan bahwa:</p>

                <div class="rumus-besar">
                    \[
                    (x - c)\ \text{adalah faktor dari}\ P(x)
                    \]
                </div>

                <p>Artinya:</p>

                <ul>
                    <li>\( P(x) \) dapat dibagi oleh \( (x - c) \) tanpa sisa</li>
                    <li>Nilai \( c \) disebut <strong>pembuat nol (akar)</strong></li>
                    <li>\( (x - c) \) muncul dalam bentuk faktorisasi polinomial</li>
                </ul>

                <p><strong>Sebaliknya,</strong></p>

                <p>jika \( (x - c) \) adalah faktor dari \( P(x) \), maka:</p>

                <div class="rumus-besar">
                    \[
                    P(c) = 0
                    \]
                </div>
            </div>

            <div class="sifat-box">
                <div class="sifat-label-wrap">
                    <div class="sifat-label">SIFAT</div>
                </div>

                \[
                P(c)=0 \iff (x-c)\ \text{merupakan faktor dari}\ P(x)
                \]

                <p>Dengan kata lain:</p>

                \[
                P(c)=0 \Rightarrow (x-c)\ \text{membagi}\ P(x)\ \text{tanpa sisa}
                \]

                \[
                (x-c)\ \text{faktor dari}\ P(x) \Rightarrow P(c)=0
                \]

                \[
                \text{Pembuat nol} \Longleftrightarrow \text{faktor linear}
                \]
            </div>

            {{-- CONTOH PERTAMA --}}
            <div class="contoh-wrap">
                <div class="contoh-pill">CONTOH</div>

                <div class="contoh-area">
                    <div class="diket-plain">
                        <div class="judul-kecil">Diketahui suatu polinomial</div>

                        <div class="soal-rumus">
                            \[
                            P(x)=x^3-4x^2-x+4
                            \]
                        </div>

                        <p>
                            Guru memperhatikan bahwa jumlah semua koefisien polinomial tersebut sama dengan 0.
                            Oleh karena itu, ia menduga bahwa \(x-1\) merupakan salah satu faktor \(P(x)\).
                            Buktikan dugaan tersebut dan gunakan hasilnya untuk memfaktorkan \(P(x)\) secara
                            lengkap.
                        </p>
                    </div>

                    <input type="hidden" id="step1Status" value="false">
                    <input type="hidden" id="step2Status" value="false">
                    <input type="hidden" id="step3Status" value="false">
                    <input type="hidden" id="step4Status" value="false">

                    <!-- LANGKAH 1 -->
                    <div class="langkah-card">
                        <div class="langkah-title">Langkah 1</div>
                        <div class="langkah-sub">Hitung nilai \(P(1)\).</div>

                        <button type="button" class="btn-petunjuk" onclick="toggleHint('hintLangkah1', this)">
                            Lihat Petunjuk Menjawab
                        </button>

                        <div class="cara-menjawab-box" id="hintLangkah1">
                            <div class="cara-menjawab-title">Cara menjawab:</div>
                            <p>
                                Untuk mencari nilai \(P(1)\), gantikan setiap \(x\) pada polinomial dengan \(1\).
                            </p>
                            <p>
                                Setelah itu, hitung nilai setiap suku, lalu jumlahkan semuanya.
                            </p>
                        </div>

                        <label>Masukkan nilai \(P(1)\):</label>
                        <input type="text" id="jawabLangkah1" class="input-jawaban" placeholder="Contoh: 0">
                        <div id="feedback1" class="feedback"></div>

                        <div id="stepExplain1" class="penjelasan-step">
                            <p>Substitusikan \(x=1\) ke dalam polinomial:</p>
                            <p style="margin-top:8px;">
                                \[
                                P(1)=1^3-4(1)^2-1+4=1-4-1+4=0
                                \]
                            </p>
                            <p>Jadi, benar bahwa \(P(1)=0\).</p>
                        </div>
                    </div>

                    <!-- LANGKAH 2 -->
                    <div class="langkah-card">
                        <div class="langkah-title">Langkah 2</div>
                        <div class="langkah-sub">Gunakan Teorema Faktor.</div>

                        <button type="button" class="btn-petunjuk" onclick="toggleHint('hintLangkah2', this)">
                            Lihat Petunjuk Menjawab
                        </button>

                        <div class="cara-menjawab-box" id="hintLangkah2">
                            <div class="cara-menjawab-title">Cara menjawab:</div>
                            <p>
                                Perhatikan hasil pada langkah sebelumnya.
                                Jika nilai tersebut memenuhi syarat Teorema Faktor, maka tentukan bentuk faktor
                                linearnya.
                            </p>
                        </div>

                        <label>Jika \(P(1)=0\), maka faktor linearnya adalah:</label>
                        <input type="text" id="jawabLangkah2" class="input-jawaban" placeholder="Contoh: x-1">
                        <div id="feedback2" class="feedback"></div>

                        <div id="stepExplain2" class="penjelasan-step">
                            <p>Menurut Teorema Faktor, jika \(P(c)=0\), maka \((x-c)\) adalah faktor dari \(P(x)\).</p>
                            <p style="margin-top:8px;">
                                Karena \(P(1)=0\), maka:
                            </p>
                            <p style="margin-top:8px;">
                                \[
                                x-1 \text{ adalah faktor dari } P(x)
                                \]
                            </p>
                        </div>
                    </div>

                    <!-- LANGKAH 3 GABUNGAN -->
                    <div class="langkah-card">
                        <div class="langkah-title">Langkah 3</div>
                        <div class="langkah-sub">
                            Lengkapi tabel Horner berikut.
                        </div>

                        <button type="button" class="btn-petunjuk" onclick="toggleHint('hintLangkah3', this)">
                            Lihat Petunjuk Menjawab
                        </button>

                        <div class="cara-menjawab-box" id="hintLangkah3">
                            <div class="cara-menjawab-title">Cara menjawab:</div>
                            <p>
                                Gunakan metode Horner dengan angka \(1\).
                                Turunkan angka pertama, lalu kalikan dengan \(1\),
                                kemudian jumlahkan dengan koefisien berikutnya secara bertahap.
                            </p>
                            <p>
                                Baris kedua diisi dari hasil kali bertahap, sedangkan baris bawah diisi dari hasil
                                penjumlahan vertikal setiap kolom.
                            </p>
                        </div>

                        <div class="horner-caption">
                            Isi baris kedua dan baris bawah pada satu tabel Horner.
                        </div>

                        <div class="horner-wrap">
                            <table class="horner-table">
                                <tr>
                                    <td class="left-number">1</td>
                                    <td class="horner-top horner-left">1</td>
                                    <td class="horner-top">-4</td>
                                    <td class="horner-top">-1</td>
                                    <td class="horner-top">4</td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td class="horner-left"></td>
                                    <td>
                                        <input type="text" id="hornerTop1" class="horner-box">
                                    </td>
                                    <td>
                                        <input type="text" id="hornerTop2" class="horner-box">
                                    </td>
                                    <td>
                                        <input type="text" id="hornerTop3" class="horner-box">
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td class="horner-bottom">
                                        <input type="text" id="hornerBottom1" class="horner-box">
                                    </td>
                                    <td class="horner-bottom">
                                        <input type="text" id="hornerBottom2" class="horner-box">
                                    </td>
                                    <td class="horner-bottom">
                                        <input type="text" id="hornerBottom3" class="horner-box">
                                    </td>
                                    <td class="horner-sisa">
                                        <input type="text" id="hornerBottom4" class="horner-box">
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div id="feedback3" class="feedback"></div>

                        <div id="stepExplain3" class="penjelasan-step">
                            <p>
                                Pada metode Horner, angka pada baris kedua diperoleh dari hasil kali bertahap dengan \(1\).
                            </p>
                            <p style="margin-top:8px;">
                                Baris keduanya adalah:
                            </p>
                            <p style="margin-top:8px;">
                                \[
                                1,\ -3,\ -4
                                \]
                            </p>
                            <p>
                                Baris bawah hasil Horner adalah:
                            </p>
                            <p style="margin-top:8px;">
                                \[
                                1,\ -3,\ -4
                                \]
                            </p>
                            <p>dan sisanya:</p>
                            <p style="margin-top:8px;">
                                \[
                                0
                                \]
                            </p>
                            <p>
                                Jadi hasil baginya adalah:
                            </p>
                            <p style="margin-top:8px;">
                                \[
                                x^2-3x-4
                                \]
                            </p>
                        </div>
                    </div>

                    <!-- LANGKAH 4 -->
                    <div class="langkah-card">
                        <div class="langkah-title">Langkah 4</div>
                        <div class="langkah-sub">
                            Faktorkan hasil bagi \(x^2-3x-4\).
                        </div>

                        <button type="button" class="btn-petunjuk" onclick="toggleHint('hintLangkah4', this)">
                            Lihat Petunjuk Menjawab
                        </button>

                        <div class="cara-menjawab-box" id="hintLangkah4">
                            <div class="cara-menjawab-title">Cara menjawab:</div>
                            <p>
                                Faktorkan bentuk kuadrat yang diperoleh.
                                Carilah dua bilangan yang jika dikalikan menghasilkan konstanta,
                                dan jika dijumlahkan menghasilkan koefisien tengah.
                            </p>
                        </div>

                        <label>Tuliskan faktornya:</label>
                        <input type="text" id="jawabLangkah4" class="input-jawaban" placeholder="Contoh: (x-4)(x+1)">
                        <div id="feedback4" class="feedback"></div>

                        <div id="stepExplain4" class="penjelasan-step">
                            <p>
                                Cari dua bilangan yang hasil kalinya \(-4\) dan jumlahnya \(-3\), yaitu \(-4\) dan \(1\).
                            </p>
                            <p style="margin-top:8px;">
                                \[
                                x^2-3x-4=(x-4)(x+1)
                                \]
                            </p>
                        </div>
                    </div>

                    <!-- PENJELASAN AKHIR -->
                    <div id="finalExplanation" class="final-explanation">
                        <h4>Penjelasan Lengkap</h4>

                        <p>Kita telah memperoleh:</p>

                        <p style="margin-top:8px;">
                            \[
                            P(1)=0
                            \]
                        </p>

                        <p>
                            Karena \(P(1)=0\), maka berdasarkan Teorema Faktor, \(x-1\) adalah faktor dari \(P(x)\).
                        </p>

                        <p>
                            Dengan metode Horner, diperoleh hasil bagi:
                        </p>

                        <p style="margin-top:8px;">
                            \[
                            x^2-3x-4
                            \]
                        </p>

                        <p>
                            Kemudian hasil bagi tersebut difaktorkan menjadi:
                        </p>

                        <p style="margin-top:8px;">
                            \[
                            x^2-3x-4=(x-4)(x+1)
                            \]
                        </p>

                        <p>Jadi, faktorisasi lengkapnya adalah:</p>

                        <div class="final-result">
                            \[
                            P(x)=(x-1)(x-4)(x+1)
                            \]
                        </div>
                    </div>
                </div>
            </div>

            <p>
                Selain menggunakan petunjuk khusus seperti pada contoh pertama, soal yang sama juga dapat
                diselesaikan
                dengan cara yang lebih sistematis, yaitu menggunakan
                <span class="highlight">Pembuat Nol Rasional</span>.
            </p>

            <p>
                Dengan cara ini, kita mencari dulu semua kandidat akar rasional yang mungkin, lalu menguji salah
                satunya.
                Setelah itu, langkah selanjutnya tetap dapat dilanjutkan dengan Teorema Faktor dan metode Horner.
            </p>

            {{-- SIFAT 2 --}}
            <div class="sifat-box">
                <div class="sifat-label">SIFAT</div>

                <p>Misalkan polinomial</p>

                \[
                P(x)=a_nx^n+a_{n-1}x^{n-1}+\cdots+a_1x+a_0
                \]

                <p>
                    memiliki koefisien dan konstanta yang semuanya bilangan bulat dengan
                </p>

                \[
                a_n \ne 0 \text{ dan } a_0 \ne 0
                \]

                <p>
                    Jika polinomial \(P(x)\) tersebut memiliki pembuat nol rasional
                </p>

                \[
                \frac{p}{q},
                \]

                <p>
                    maka \(p\) merupakan faktor dari \(a_0\) dan \(q\) merupakan faktor dari \(a_n\).
                </p>
            </div>

            {{-- CONTOH KEDUA --}}
            <div class="contoh-rasional-wrap">
                <div class="contoh-rasional-pill">CONTOH</div>

                <div class="contoh-rasional-box">
                    <div class="diket-plain">
                        <div class="judul-kecil">Faktorkan polinomial secara lengkap</div>

                        <div class="soal-rumus">
                            \[
                            P(x)=x^3-4x^2-x+4
                            \]
                        </div>

                        <p>
                            Gunakan konsep <span class="highlight">Pembuat Nol Rasional</span>,
                            lalu tentukan salah satu akar polinomial, gunakan metode Horner,
                            dan faktorkan sampai bentuk paling sederhana.
                        </p>
                    </div>

                    <input type="hidden" id="rasionalStep1Status" value="false">
                    <input type="hidden" id="rasionalStep2Status" value="false">
                    <input type="hidden" id="rasionalStep3Status" value="false">
                    <input type="hidden" id="rasionalStep4Status" value="false">
                    <input type="hidden" id="rasionalStep5Status" value="false">

                    <!-- LANGKAH 1 -->
                    <div class="langkah-card">
                        <div class="langkah-title">Langkah 1</div>
                        <div class="langkah-sub">
                            Tentukan kandidat pembuat nol rasional dari polinomial.
                        </div>

                        <button type="button" class="btn-petunjuk" onclick="toggleHint('hintRasional1', this)">
                            Lihat Petunjuk Menjawab
                        </button>

                        <div class="cara-menjawab-box" id="hintRasional1">
                            <div class="cara-menjawab-title">Cara menjawab:</div>
                            <p>
                                Perhatikan suku konstanta dan koefisien tertinggi dari polinomial,
                                tentukan faktor-faktor dari keduanya, lalu bentuk semua kemungkinan
                                akar rasional sesuai aturan pembuat nol rasional.
                            </p>
                        </div>

                        <label>Tuliskan kandidat pembuat nol rasional:</label>
                        <input type="text" id="jawabRasional1" class="input-jawaban" placeholder="Contoh: ±1, ±2, ±4">

                        <div id="rasionalFeedback1" class="feedback"></div>

                        <div id="rasionalExplain1" class="penjelasan-step">
                            <p>
                                Karena konstanta \(a_0=4\), faktor-faktornya adalah \(\pm1,\pm2,\pm4\).
                            </p>
                            <p>
                                Karena koefisien utama \(a_3=1\), faktor-faktornya adalah \(\pm1\).
                            </p>
                            <p style="margin-top:8px;">
                                Jadi kandidat pembuat nol rasionalnya:
                            </p>
                            <p style="margin-top:8px;">
                                \[
                                \pm1,\ \pm2,\ \pm4
                                \]
                            </p>
                        </div>
                    </div>

                    <!-- LANGKAH 2 -->
                    <div class="langkah-card">
                        <div class="langkah-title">Langkah 2</div>
                        <div class="langkah-sub">
                            Coba salah satu kandidat akar. Nilai yang membuat \(P(x)=0\) adalah?
                        </div>

                        <button type="button" class="btn-petunjuk" onclick="toggleHint('hintRasional2', this)">
                            Lihat Petunjuk Menjawab
                        </button>

                        <div class="cara-menjawab-box" id="hintRasional2">
                            <div class="cara-menjawab-title">Cara menjawab:</div>
                            <p>
                                Uji satu per satu kandidat yang sudah diperoleh dengan mensubstitusikannya ke dalam
                                polinomial, lalu pilih nilai yang membuat hasil polinomial sama dengan nol.
                            </p>
                        </div>

                        <label>Masukkan salah satu pembuat nol:</label>
                        <input type="text" id="jawabRasional2" class="input-jawaban" placeholder="Contoh: 1">

                        <div id="rasionalFeedback2" class="feedback"></div>

                        <div id="rasionalExplain2" class="penjelasan-step">
                            <p>Substitusikan \(x=1\):</p>
                            <p style="margin-top:8px;">
                                \[
                                P(1)=1^3-4(1)^2-1+4=1-4-1+4=0
                                \]
                            </p>
                            <p>Jadi, \(1\) adalah salah satu pembuat nol polinomial.</p>
                        </div>
                    </div>

                    <!-- LANGKAH 3 -->
                    <div class="langkah-card">
                        <div class="langkah-title">Langkah 3</div>
                        <div class="langkah-sub">
                            Gunakan Teorema Faktor.
                        </div>

                        <button type="button" class="btn-petunjuk" onclick="toggleHint('hintRasional3', this)">
                            Lihat Petunjuk Menjawab
                        </button>

                        <div class="cara-menjawab-box" id="hintRasional3">
                            <div class="cara-menjawab-title">Cara menjawab:</div>
                            <p>
                                Gunakan pembuat nol yang sudah ditemukan pada langkah sebelumnya,
                                lalu tentukan bentuk faktor linear yang bersesuaian berdasarkan Teorema Faktor.
                            </p>
                        </div>

                        <label>Jika \(P(1)=0\), maka faktor linearnya adalah:</label>
                        <input type="text" id="jawabRasional3" class="input-jawaban" placeholder="Contoh: x-1">

                        <div id="rasionalFeedback3" class="feedback"></div>

                        <div id="rasionalExplain3" class="penjelasan-step">
                            <p>
                                Karena \(P(1)=0\), maka menurut Teorema Faktor:
                            </p>
                            <p style="margin-top:8px;">
                                \[
                                (x-1) \text{ adalah faktor dari } P(x)
                                \]
                            </p>
                        </div>
                    </div>

                    <!-- LANGKAH 4 GABUNGAN -->
                    <div class="langkah-card">
                        <div class="langkah-title">Langkah 4</div>
                        <div class="langkah-sub">
                            Lengkapi tabel Horner untuk pembagian dengan \(x-1\).
                        </div>

                        <button type="button" class="btn-petunjuk" onclick="toggleHint('hintRasional4', this)">
                            Lihat Petunjuk Menjawab
                        </button>

                        <div class="cara-menjawab-box" id="hintRasional4">
                            <div class="cara-menjawab-title">Cara menjawab:</div>
                            <p>
                                Gunakan nilai pembagi Horner yaitu \(1\). Turunkan koefisien pertama,
                                kalikan dengan angka di kiri, lalu jumlahkan secara vertikal.
                            </p>
                            <p>
                                Baris kedua diisi dari hasil kali bertahap, sedangkan baris bawah diisi dari hasil
                                penjumlahan setiap kolom.
                            </p>
                        </div>

                        <div class="horner-caption">
                            Isi baris kedua, baris bawah, dan sisa pembagian pada satu tabel.
                        </div>

                        <div class="horner-wrap">
                            <table class="horner-table">
                                <tr>
                                    <td class="left-number">1</td>
                                    <td class="horner-top horner-left">1</td>
                                    <td class="horner-top">-4</td>
                                    <td class="horner-top">-1</td>
                                    <td class="horner-top">4</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="horner-left"></td>
                                    <td>
                                        <input type="text" id="rasionalHornerTop1" class="horner-box">
                                    </td>
                                    <td>
                                        <input type="text" id="rasionalHornerTop2" class="horner-box">
                                    </td>
                                    <td>
                                        <input type="text" id="rasionalHornerTop3" class="horner-box">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="horner-bottom">
                                        <input type="text" id="rasionalHornerBottom1" class="horner-box">
                                    </td>
                                    <td class="horner-bottom">
                                        <input type="text" id="rasionalHornerBottom2" class="horner-box">
                                    </td>
                                    <td class="horner-bottom">
                                        <input type="text" id="rasionalHornerBottom3" class="horner-box">
                                    </td>
                                    <td class="horner-sisa">
                                        <input type="text" id="rasionalHornerBottom4" class="horner-box">
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div id="rasionalFeedback4" class="feedback"></div>

                        <div id="rasionalExplain4" class="penjelasan-step">
                            <p>
                                Pada metode Horner, angka pada baris kedua diperoleh dari hasil kali bertahap dengan \(1\).
                            </p>
                            <p style="margin-top:8px;">
                                Baris keduanya adalah:
                            </p>
                            <p style="margin-top:8px;">
                                \[
                                1,\ -3,\ -4
                                \]
                            </p>
                            <p>Baris bawah hasil Horner adalah:</p>
                            <p style="margin-top:8px;">
                                \[
                                1,\ -3,\ -4
                                \]
                            </p>
                            <p>dan sisanya:</p>
                            <p style="margin-top:8px;">
                                \[
                                0
                                \]
                            </p>
                            <p>
                                Jadi hasil baginya adalah:
                            </p>
                            <p style="margin-top:8px;">
                                \[
                                x^2-3x-4
                                \]
                            </p>
                        </div>
                    </div>

                    <!-- LANGKAH 5 -->
                    <div class="langkah-card">
                        <div class="langkah-title">Langkah 5</div>
                        <div class="langkah-sub">
                            Faktorkan polinomial secara lengkap.
                        </div>

                        <button type="button" class="btn-petunjuk" onclick="toggleHint('hintRasional5', this)">
                            Lihat Petunjuk Menjawab
                        </button>

                        <div class="cara-menjawab-box" id="hintRasional5">
                            <div class="cara-menjawab-title">Cara menjawab:</div>
                            <p>
                                Gabungkan faktor linear yang sudah diperoleh dengan hasil bagi dari metode Horner,
                                lalu faktorkan lagi bentuk kuadratnya sampai diperoleh bentuk paling sederhana.
                            </p>
                        </div>

                        <label>Tuliskan faktorisasi lengkap:</label>
                        <input type="text" id="jawabRasional5" class="input-jawaban" placeholder="Contoh: (x-1)(x-4)(x+1)">

                        <div id="rasionalFeedback5" class="feedback"></div>

                        <div id="rasionalExplain5" class="penjelasan-step">
                            <p>
                                Karena
                            </p>
                            <p style="margin-top:8px;">
                                \[
                                x^2-3x-4=(x-4)(x+1)
                                \]
                            </p>
                            <p>
                                maka faktorisasi lengkap polinomial adalah:
                            </p>
                            <p style="margin-top:8px;">
                                \[
                                P(x)=(x-1)(x-4)(x+1)
                                \]
                            </p>
                        </div>
                    </div>

                    <div id="rasionalFinalExplanation" class="final-explanation">
                        <h4>Penjelasan Lengkap</h4>

                        <p>
                            Dari Teorema Pembuat Nol Rasional, kandidat akar rasional diperoleh dari faktor-faktor
                            4, yaitu:
                        </p>

                        <p style="margin-top:8px;">
                            \[
                            \pm1,\ \pm2,\ \pm4
                            \]
                        </p>

                        <p>
                            Setelah dicoba, diperoleh:
                        </p>

                        <p style="margin-top:8px;">
                            \[
                            P(1)=0
                            \]
                        </p>

                        <p>
                            Maka \((x-1)\) adalah faktor dari \(P(x)\). Dengan metode Horner, hasil baginya:
                        </p>

                        <p style="margin-top:8px;">
                            \[
                            x^2-3x-4
                            \]
                        </p>

                        <p>
                            Lalu kita faktorkan lagi:
                        </p>

                        <p style="margin-top:8px;">
                            \[
                            x^2-3x-4=(x-4)(x+1)
                            \]
                        </p>

                        <p>Jadi, faktorisasi lengkapnya adalah:</p>

                        <div class="final-result">
                            \[
                            P(x)=(x-1)(x-4)(x+1)
                            \]
                        </div>
                    </div>
                </div>
            </div>

            {{-- LATIHAN --}}
            <div class="latihan-wrap">
                <div class="latihan-header">LATIHAN</div>

                <div class="latihan-box">
                    <ol>
                        <li>
                            <div class="latihan-soal-text">
                                Faktorkan polinomial berikut secara lengkap:
                            </div>

                            <div class="latihan-soal-rumus">
                                \[
                                P(x)=x^3+2x^2-9x-18
                                \]
                            </div>

                            <input type="hidden" id="latihan1Status" value="false">

                            <!-- LANGKAH 1 -->
                            <div class="langkah-card">
                                <div class="langkah-title">Langkah 1</div>
                                <div class="langkah-sub">
                                    Metode yang paling sesuai untuk memulai faktorisasi polinomial ini adalah:
                                </div>

                                <div class="opsi-wrap">
                                    <label class="opsi-item">
                                        <input type="radio" name="latihan1opsi1" value="teorema faktor">
                                        <span>Teorema Faktor langsung</span>
                                    </label>
                                    <label class="opsi-item">
                                        <input type="radio" name="latihan1opsi1" value="pengelompokan">
                                        <span>Metode pengelompokan</span>
                                    </label>
                                    <label class="opsi-item">
                                        <input type="radio" name="latihan1opsi1" value="rumus abc">
                                        <span>Rumus kuadrat/ABC</span>
                                    </label>
                                </div>

                                <div id="latihan1Feedback1" class="feedback"></div>

                                <div id="latihan1Explain1" class="penjelasan-step">
                                    <p>
                                        Polinomial ini cocok dikelompokkan menjadi dua pasangan suku:
                                    </p>
                                    <p style="margin-top:8px;">
                                        \[
                                        (x^3+2x^2)+(-9x-18)
                                        \]
                                    </p>
                                </div>
                            </div>

                            <!-- LANGKAH 2 -->
                            <div class="langkah-card">
                                <div class="langkah-title">Langkah 2</div>
                                <div class="langkah-sub">
                                    Tuliskan hasil pengelompokannya setelah masing-masing kelompok difaktorkan.
                                </div>

                                <label>Masukkan bentuk hasil pengelompokan:</label>
                                <input type="text" id="jawabLatihan1Langkah2" class="input-jawaban"
                                    placeholder="Contoh: x^2(x+2)-9(x+2)">

                                <div id="latihan1Feedback2" class="feedback"></div>

                                <div id="latihan1Explain2" class="penjelasan-step">
                                    <p>
                                        Dari
                                    </p>
                                    <p style="margin-top:8px;">
                                        \[
                                        (x^3+2x^2)+(-9x-18)
                                        \]
                                    </p>
                                    <p>diperoleh</p>
                                    <p style="margin-top:8px;">
                                        \[
                                        x^2(x+2)-9(x+2)
                                        \]
                                    </p>
                                </div>
                            </div>

                            <!-- LANGKAH 3 -->
                            <div class="langkah-card">
                                <div class="langkah-title">Langkah 3</div>
                                <div class="langkah-sub">
                                    Faktor persekutuan dari dua kelompok tersebut adalah:
                                </div>

                                <div class="opsi-wrap">
                                    <label class="opsi-item">
                                        <input type="radio" name="latihan1opsi3" value="x-2">
                                        <span>\(x-2\)</span>
                                    </label>
                                    <label class="opsi-item">
                                        <input type="radio" name="latihan1opsi3" value="x+2">
                                        <span>\(x+2\)</span>
                                    </label>
                                    <label class="opsi-item">
                                        <input type="radio" name="latihan1opsi3" value="x^2-9">
                                        <span>\(x^2-9\)</span>
                                    </label>
                                </div>

                                <div id="latihan1Feedback3" class="feedback"></div>

                                <div id="latihan1Explain3" class="penjelasan-step">
                                    <p>
                                        Karena kedua kelompok sama-sama memuat \((x+2)\), maka:
                                    </p>
                                    <p style="margin-top:8px;">
                                        \[
                                        x^2(x+2)-9(x+2)=(x+2)(x^2-9)
                                        \]
                                    </p>
                                </div>
                            </div>

                            <!-- LANGKAH 4 -->
                            <div class="langkah-card">
                                <div class="langkah-title">Langkah 4</div>
                                <div class="langkah-sub">
                                    Faktorkan polinomial hingga bentuk paling sederhana.
                                </div>

                                <label>Tuliskan faktorisasi lengkap:</label>
                                <input type="text" id="jawabLatihan1Langkah4" class="input-jawaban"
                                    placeholder="Contoh: (x+2)(x-3)(x+3)">

                                <div id="latihan1Feedback4" class="feedback"></div>

                                <div id="latihan1Explain4" class="penjelasan-step">
                                    <p>
                                        Karena
                                    </p>
                                    <p style="margin-top:8px;">
                                        \[
                                        x^2-9=(x-3)(x+3)
                                        \]
                                    </p>
                                    <p>maka:</p>
                                    <p style="margin-top:8px;">
                                        \[
                                        P(x)=(x+2)(x-3)(x+3)
                                        \]
                                    </p>
                                </div>
                            </div>

                            <button type="button" class="btn-cek" onclick="cekLatihan1()">
                                Cek Jawaban Soal 1
                            </button>

                            <div id="latihan1FeedbackFinal" class="feedback"></div>

                            <div id="latihan1FinalExplanation" class="final-explanation">
                                <h4>Pembahasan Soal 1</h4>

                                <p>Polinomial difaktorkan dengan metode pengelompokan:</p>

                                <p style="margin-top:8px;">
                                    \[
                                    x^3+2x^2-9x-18=(x^3+2x^2)+(-9x-18)
                                    \]
                                </p>

                                <p style="margin-top:8px;">
                                    \[
                                    =x^2(x+2)-9(x+2)
                                    \]
                                </p>

                                <p style="margin-top:8px;">
                                    \[
                                    =(x+2)(x^2-9)
                                    \]
                                </p>

                                <p style="margin-top:8px;">
                                    \[
                                    =(x+2)(x-3)(x+3)
                                    \]
                                </p>

                                <div class="final-result">
                                    \[
                                    P(x)=(x+2)(x-3)(x+3)
                                    \]
                                </div>
                            </div>
                        </li>

                        <li>
                            <div id="latihan2LockMessage" class="feedback salah" style="display:block;">
                                Selesaikan dan benarkan Soal 1 terlebih dahulu sebelum mengerjakan Soal 2.
                            </div>

                            <div id="latihan2Area" class="latihan-terkunci">
                                <div class="latihan-soal-text">
                                    Gunakan Sifat Pembuat Nol Rasional untuk menentukan pembuat nol dari polinomial berikut,
                                    lalu faktorkan polinomial tersebut hingga bentuk paling sederhana:
                                </div>

                                <div class="latihan-soal-rumus">
                                    \[
                                    P(x)=2x^3-3x^2-11x+6
                                    \]
                                </div>

                                <input type="hidden" id="latihan2Status" value="false">

                                <!-- LANGKAH 1 -->
                                <div class="langkah-card">
                                    <div class="langkah-title">Langkah 1</div>
                                    <div class="langkah-sub">
                                        Pilih himpunan kandidat pembuat nol rasional yang benar.
                                    </div>

                                    <div class="opsi-wrap">
                                        <label class="opsi-item">
                                            <input type="radio" name="latihan2opsi1" value="±1,±2,±3,±6">
                                            <span>\(\pm1,\pm2,\pm3,\pm6\)</span>
                                        </label>
                                        <label class="opsi-item">
                                            <input type="radio" name="latihan2opsi1" value="±1,±2,±3,±6,±1/2,±3/2">
                                            <span>\(\pm1,\pm2,\pm3,\pm6,\pm\frac{1}{2},\pm\frac{3}{2}\)</span>
                                        </label>
                                        <label class="opsi-item">
                                            <input type="radio" name="latihan2opsi1" value="±1/2,±3/2">
                                            <span>\(\pm\frac{1}{2},\pm\frac{3}{2}\)</span>
                                        </label>
                                    </div>

                                    <div id="latihan2Feedback1" class="feedback"></div>

                                    <div id="latihan2Explain1" class="penjelasan-step">
                                        <p>
                                            Faktor konstanta \(6\) adalah \(\pm1,\pm2,\pm3,\pm6\), sedangkan faktor
                                            koefisien utama \(2\) adalah \(\pm1,\pm2\).
                                        </p>
                                        <p style="margin-top:8px;">
                                            Maka kandidat pembuat nol rasional:
                                            \[
                                            \pm1,\pm2,\pm3,\pm6,\pm\frac{1}{2},\pm\frac{3}{2}
                                            \]
                                        </p>
                                    </div>
                                </div>

                                <!-- LANGKAH 2 -->
                                <div class="langkah-card">
                                    <div class="langkah-title">Langkah 2</div>
                                    <div class="langkah-sub">
                                        Salah satu pembuat nol polinomial adalah:
                                    </div>

                                    <label>Masukkan salah satu pembuat nol:</label>
                                    <input type="text" id="jawabLatihan2Langkah2" class="input-jawaban"
                                        placeholder="Contoh: -2">

                                    <div id="latihan2Feedback2" class="feedback"></div>

                                    <div id="latihan2Explain2" class="penjelasan-step">
                                        <p>Jika dicoba \(x=-2\), maka:</p>
                                        <p style="margin-top:8px;">
                                            \[
                                            P(-2)=2(-2)^3-3(-2)^2-11(-2)+6=-16-12+22+6=0
                                            \]
                                        </p>
                                        <p>Jadi, \(-2\) adalah salah satu pembuat nol.</p>
                                    </div>
                                </div>

                                <!-- LANGKAH 3 -->
                                <div class="langkah-card">
                                    <div class="langkah-title">Langkah 3</div>
                                    <div class="langkah-sub">
                                        Jika pembuat nolnya \(-2\), maka faktor linearnya adalah:
                                    </div>

                                    <div class="opsi-wrap">
                                        <label class="opsi-item">
                                            <input type="radio" name="latihan2opsi3" value="x-2">
                                            <span>\(x-2\)</span>
                                        </label>
                                        <label class="opsi-item">
                                            <input type="radio" name="latihan2opsi3" value="x+2">
                                            <span>\(x+2\)</span>
                                        </label>
                                        <label class="opsi-item">
                                            <input type="radio" name="latihan2opsi3" value="2x+2">
                                            <span>\(2x+2\)</span>
                                        </label>
                                    </div>

                                    <div id="latihan2Feedback3" class="feedback"></div>

                                    <div id="latihan2Explain3" class="penjelasan-step">
                                        <p>
                                            Jika \(c=-2\) adalah pembuat nol, maka faktor linearnya:
                                        </p>
                                        <p style="margin-top:8px;">
                                            \[
                                            x-c=x-(-2)=x+2
                                            \]
                                        </p>
                                    </div>
                                </div>

                                <!-- LANGKAH 4 -->
                                <div class="langkah-card">
                                    <div class="langkah-title">Langkah 4</div>
                                    <div class="langkah-sub">
                                        Lengkapi baris Horner untuk pembagian dengan \(x+2\).
                                    </div>

                                    <div class="mini-note">
                                        Isikan baris kedua, hasil bawah, dan sisa pembagian.
                                    </div>

                                    <div class="horner-wrap">
                                        <table class="horner-table">
                                            <tr>
                                                <td class="left-number">-2</td>
                                                <td class="horner-top horner-left">2</td>
                                                <td class="horner-top">-3</td>
                                                <td class="horner-top">-11</td>
                                                <td class="horner-top">6</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td class="horner-left"></td>
                                                <td class="horner-bottom">
                                                    <input type="text" id="latihan2Horner1" class="horner-box">
                                                </td>
                                                <td class="horner-bottom">
                                                    <input type="text" id="latihan2Horner2" class="horner-box">
                                                </td>
                                                <td class="horner-bottom">
                                                    <input type="text" id="latihan2Horner3" class="horner-box">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td class="horner-bottom">2</td>
                                                <td class="horner-bottom">-7</td>
                                                <td class="horner-bottom">3</td>
                                                <td class="horner-sisa">
                                                    <input type="text" id="latihan2Horner4" class="horner-box">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div id="latihan2Feedback4" class="feedback"></div>

                                    <div id="latihan2Explain4" class="penjelasan-step">
                                        <p>
                                            Dengan Horner untuk pembagi \(x+2\), diperoleh hasil bagi:
                                        </p>
                                        <p style="margin-top:8px;">
                                            \[
                                            2x^2-7x+3
                                            \]
                                        </p>
                                        <p>dan sisa:</p>
                                        <p style="margin-top:8px;">
                                            \[
                                            0
                                            \]
                                        </p>
                                    </div>
                                </div>

                                <!-- LANGKAH 5 -->
                                <div class="langkah-card">
                                    <div class="langkah-title">Langkah 5</div>
                                    <div class="langkah-sub">
                                        Faktorkan polinomial secara lengkap.
                                    </div>

                                    <label>Tuliskan faktorisasi lengkap:</label>
                                    <input type="text" id="jawabLatihan2Langkah5" class="input-jawaban"
                                        placeholder="Contoh: (x+2)(2x-1)(x-3)">

                                    <div id="latihan2Feedback5" class="feedback"></div>

                                    <div id="latihan2Explain5" class="penjelasan-step">
                                        <p>
                                            Karena
                                        </p>
                                        <p style="margin-top:8px;">
                                            \[
                                            2x^2-7x+3=(2x-1)(x-3)
                                            \]
                                        </p>
                                        <p>maka:</p>
                                        <p style="margin-top:8px;">
                                            \[
                                            P(x)=(x+2)(2x-1)(x-3)
                                            \]
                                        </p>
                                    </div>
                                </div>

                                <button type="button" class="btn-cek" onclick="cekLatihan2()">
                                    Cek Jawaban Soal 2
                                </button>

                                <div id="latihan2FeedbackFinal" class="feedback"></div>

                                <div id="latihan2FinalExplanation" class="final-explanation">
                                    <h4>Pembahasan Soal 2</h4>

                                    <p>Dari Sifat Pembuat Nol Rasional, kandidat pembuat nol adalah:</p>

                                    <p style="margin-top:8px;">
                                        \[
                                        \pm1,\pm2,\pm3,\pm6,\pm\frac{1}{2},\pm\frac{3}{2}
                                        \]
                                    </p>

                                    <p>Setelah dicoba, diperoleh:</p>

                                    <p style="margin-top:8px;">
                                        \[
                                        P(-2)=0
                                        \]
                                    </p>

                                    <p>
                                        Maka \((x+2)\) adalah faktor dari \(P(x)\). Dengan Horner diperoleh:
                                    </p>

                                    <p style="margin-top:8px;">
                                        \[
                                        2x^2-7x+3
                                        \]
                                    </p>

                                    <p>Lalu difaktorkan lagi menjadi:</p>

                                    <p style="margin-top:8px;">
                                        \[
                                        2x^2-7x+3=(2x-1)(x-3)
                                        \]
                                    </p>

                                    <div class="final-result">
                                        \[
                                        P(x)=(x+2)(2x-1)(x-3)
                                        \]
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('nav')
    <a href="{{ route('kuisc') }}" class="btn-nav prev-btn">← Previous</a>
    <a href="{{ route('faktordanpembuatnol') }}" class="btn-nav next-btn">Next →</a>
@endsection