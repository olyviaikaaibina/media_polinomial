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

            function showStep(stepNumber) {
                const el = document.getElementById('stepExplain' + stepNumber);
                if (el) el.style.display = 'block';
            }

            function showFinalExplanation() {
                const s1 = document.getElementById('step1Status').value === 'true';
                const s2 = document.getElementById('step2Status').value === 'true';
                const s3 = document.getElementById('step3Status').value === 'true';
                const s4 = document.getElementById('step4Status').value === 'true';
                const s5 = document.getElementById('step5Status').value === 'true';

                const finalBox = document.getElementById('finalExplanation');
                if (s1 && s2 && s3 && s4 && s5) {
                    finalBox.style.display = 'block';
                }
            }

            window.cekLangkah1 = function () {
                const input = normalize(document.getElementById('jawabLangkah1').value);
                const feedback = document.getElementById('feedback1');

                if (input === '0') {
                    feedback.textContent = 'Benar. Nilai P(1) = 0.';
                    feedback.className = 'feedback ok';
                    document.getElementById('step1Status').value = 'true';
                    showStep(1);
                } else {
                    feedback.textContent = 'Belum tepat. Hitung 1^3 - 4(1)^2 - 1 + 4.';
                    feedback.className = 'feedback no';
                }

                showFinalExplanation();
            }

            window.cekLangkah2 = function () {
                const input = normalize(document.getElementById('jawabLangkah2').value);
                const feedback = document.getElementById('feedback2');

                const valid = ['x-1', '(x-1)'];

                if (valid.includes(input)) {
                    feedback.textContent = 'Benar. Karena P(1)=0, maka x - 1 adalah faktor.';
                    feedback.className = 'feedback ok';
                    document.getElementById('step2Status').value = 'true';
                    showStep(2);
                } else {
                    feedback.textContent = 'Belum tepat. Gunakan Teorema Faktor.';
                    feedback.className = 'feedback no';
                }

                showFinalExplanation();
            }

            window.cekLangkah3 = function () {
                const a = normalize(document.getElementById('hornerTop1').value);
                const b = normalize(document.getElementById('hornerTop2').value);
                const c = normalize(document.getElementById('hornerTop3').value);

                const feedback = document.getElementById('feedback3');

                if (a === '1' && b === '-3' && c === '-4') {
                    feedback.textContent = 'Benar. Baris kedua Horner sudah tepat.';
                    feedback.className = 'feedback ok';
                    document.getElementById('step3Status').value = 'true';
                    showStep(3);
                } else {
                    feedback.textContent = 'Masih belum tepat. Isi hasil perkalian bertahap pada metode Horner.';
                    feedback.className = 'feedback no';
                }

                showFinalExplanation();
            }

            window.cekLangkah4 = function () {
                const a = normalize(document.getElementById('hornerBottom1').value);
                const b = normalize(document.getElementById('hornerBottom2').value);
                const c = normalize(document.getElementById('hornerBottom3').value);
                const d = normalize(document.getElementById('hornerBottom4').value);

                const feedback = document.getElementById('feedback4');

                if (a === '1' && b === '-3' && c === '-4' && d === '0') {
                    feedback.textContent = 'Benar. Baris hasil bawah Horner dan sisa sudah tepat.';
                    feedback.className = 'feedback ok';
                    document.getElementById('step4Status').value = 'true';
                    showStep(4);
                } else {
                    feedback.textContent = 'Belum tepat. Coba hitung penjumlahan tiap kolom pada baris bawah.';
                    feedback.className = 'feedback no';
                }

                showFinalExplanation();
            }

            window.cekLangkah5 = function () {
                const input = normalize(document.getElementById('jawabLangkah5').value);
                const feedback = document.getElementById('feedback5');

                const valid = [
                    '(x-4)(x+1)',
                    '(x+1)(x-4)'
                ];

                if (valid.includes(input)) {
                    feedback.textContent = 'Benar. Faktorisasi kuadratnya tepat.';
                    feedback.className = 'feedback ok';
                    document.getElementById('step5Status').value = 'true';
                    showStep(5);
                } else {
                    feedback.textContent = 'Belum tepat. Cari dua bilangan yang hasil kalinya -4 dan jumlahnya -3.';
                    feedback.className = 'feedback no';
                }

                showFinalExplanation();
            }

            // =========================
            // CONTOH KEDUA - 6 LANGKAH
            // =========================
            function showRasionalStep(stepNumber) {
                const el = document.getElementById('rasionalExplain' + stepNumber);
                if (el) el.style.display = 'block';
            }

            function showRasionalFinalExplanation() {
                const s1 = document.getElementById('rasionalStep1Status').value === 'true';
                const s2 = document.getElementById('rasionalStep2Status').value === 'true';
                const s3 = document.getElementById('rasionalStep3Status').value === 'true';
                const s4 = document.getElementById('rasionalStep4Status').value === 'true';
                const s5 = document.getElementById('rasionalStep5Status').value === 'true';
                const s6 = document.getElementById('rasionalStep6Status').value === 'true';

                const finalBox = document.getElementById('rasionalFinalExplanation');
                if (s1 && s2 && s3 && s4 && s5 && s6) {
                    finalBox.style.display = 'block';
                }
            }

            window.cekRasionalLangkah1 = function () {
                const input = normalize(document.getElementById('jawabRasional1').value);
                const feedback = document.getElementById('rasionalFeedback1');

                const valid = [
                    '±1,±2,±4',
                    '+-1,+-2,+-4',
                    '1,2,4,-1,-2,-4',
                    '-1,-2,-4,1,2,4'
                ];

                if (valid.includes(input)) {
                    feedback.textContent = 'Benar. Kandidat pembuat nol rasionalnya adalah ±1, ±2, ±4.';
                    feedback.className = 'feedback ok';
                    document.getElementById('rasionalStep1Status').value = 'true';
                    showRasionalStep(1);
                } else {
                    feedback.textContent = 'Belum tepat. Karena konstanta 4, kandidatnya berasal dari faktor-faktor 4.';
                    feedback.className = 'feedback no';
                }

                showRasionalFinalExplanation();
            }

            window.cekRasionalLangkah2 = function () {
                const input = normalize(document.getElementById('jawabRasional2').value);
                const feedback = document.getElementById('rasionalFeedback2');

                if (input === '1') {
                    feedback.textContent = 'Benar. P(1)=0, jadi 1 adalah pembuat nol.';
                    feedback.className = 'feedback ok';
                    document.getElementById('rasionalStep2Status').value = 'true';
                    showRasionalStep(2);
                } else {
                    feedback.textContent = 'Belum tepat. Coba substitusi x = 1 ke P(x).';
                    feedback.className = 'feedback no';
                }

                showRasionalFinalExplanation();
            }

            window.cekRasionalLangkah3 = function () {
                const input = normalize(document.getElementById('jawabRasional3').value);
                const feedback = document.getElementById('rasionalFeedback3');

                const valid = ['x-1', '(x-1)'];

                if (valid.includes(input)) {
                    feedback.textContent = 'Benar. Karena P(1)=0, maka (x-1) adalah faktor.';
                    feedback.className = 'feedback ok';
                    document.getElementById('rasionalStep3Status').value = 'true';
                    showRasionalStep(3);
                } else {
                    feedback.textContent = 'Belum tepat. Gunakan Teorema Faktor.';
                    feedback.className = 'feedback no';
                }

                showRasionalFinalExplanation();
            }

            window.cekRasionalLangkah4 = function () {
                const a = normalize(document.getElementById('rasionalHornerTop1').value);
                const b = normalize(document.getElementById('rasionalHornerTop2').value);
                const c = normalize(document.getElementById('rasionalHornerTop3').value);

                const feedback = document.getElementById('rasionalFeedback4');

                if (a === '1' && b === '-3' && c === '-4') {
                    feedback.textContent = 'Benar. Baris kedua Horner sudah tepat.';
                    feedback.className = 'feedback ok';
                    document.getElementById('rasionalStep4Status').value = 'true';
                    showRasionalStep(4);
                } else {
                    feedback.textContent = 'Belum tepat. Isi hasil perkalian bertahap pada baris kedua Horner.';
                    feedback.className = 'feedback no';
                }

                showRasionalFinalExplanation();
            }

            window.cekRasionalLangkah5 = function () {
                const a = normalize(document.getElementById('rasionalHornerBottom1').value);
                const b = normalize(document.getElementById('rasionalHornerBottom2').value);
                const c = normalize(document.getElementById('rasionalHornerBottom3').value);
                const d = normalize(document.getElementById('rasionalHornerBottom4').value);

                const feedback = document.getElementById('rasionalFeedback5');

                if (a === '1' && b === '-3' && c === '-4' && d === '0') {
                    feedback.textContent = 'Benar. Baris hasil bawah Horner dan sisa sudah tepat.';
                    feedback.className = 'feedback ok';
                    document.getElementById('rasionalStep5Status').value = 'true';
                    showRasionalStep(5);
                } else {
                    feedback.textContent = 'Belum tepat. Coba hitung penjumlahan tiap kolom pada baris bawah.';
                    feedback.className = 'feedback no';
                }

                showRasionalFinalExplanation();
            }

            window.cekRasionalLangkah6 = function () {
                const input = normalize(document.getElementById('jawabRasional6').value);
                const feedback = document.getElementById('rasionalFeedback6');

                const valid = [
                    '(x-1)(x-4)(x+1)',
                    '(x-1)(x+1)(x-4)',
                    '(x-4)(x-1)(x+1)',
                    '(x-4)(x+1)(x-1)',
                    '(x+1)(x-1)(x-4)',
                    '(x+1)(x-4)(x-1)'
                ];

                if (valid.includes(input)) {
                    feedback.textContent = 'Benar. Faktorisasi lengkapnya tepat.';
                    feedback.className = 'feedback ok';
                    document.getElementById('rasionalStep6Status').value = 'true';
                    showRasionalStep(6);
                } else {
                    feedback.textContent = 'Belum tepat. Faktorkan dulu x² - 3x - 4 menjadi (x-4)(x+1).';
                    feedback.className = 'feedback no';
                }

                showRasionalFinalExplanation();
            }

            // =========================
            // LATIHAN 1
            // =========================
            function showLatihan1Step(stepNumber) {
                const el = document.getElementById('latihan1Explain' + stepNumber);
                if (el) el.style.display = 'block';
            }

            function showLatihan1Final() {
                const s1 = document.getElementById('latihan1Step1Status').value === 'true';
                const s2 = document.getElementById('latihan1Step2Status').value === 'true';
                const s3 = document.getElementById('latihan1Step3Status').value === 'true';
                const s4 = document.getElementById('latihan1Step4Status').value === 'true';

                const finalBox = document.getElementById('latihan1FinalExplanation');
                if (s1 && s2 && s3 && s4) {
                    finalBox.style.display = 'block';
                }
            }

            window.cekLatihan1Langkah1 = function () {
                const input = getSelectedValue('latihan1opsi1');
                const feedback = document.getElementById('latihan1Feedback1');

                if (input === 'pengelompokan') {
                    feedback.textContent = 'Benar. Polinomial ini cocok difaktorkan dengan pengelompokan.';
                    feedback.className = 'feedback ok';
                    document.getElementById('latihan1Step1Status').value = 'true';
                    showLatihan1Step(1);
                } else {
                    feedback.textContent = 'Belum tepat. Perhatikan bahwa suku-sukunya dapat dikelompokkan menjadi dua pasangan.';
                    feedback.className = 'feedback no';
                }

                showLatihan1Final();
            }

            window.cekLatihan1Langkah2 = function () {
                const input = normalize(document.getElementById('jawabLatihan1Langkah2').value);
                const feedback = document.getElementById('latihan1Feedback2');

                const valid = [
                    'x^2(x+2)-9(x+2)',
                    '(x^2)(x+2)-9(x+2)',
                    'x²(x+2)-9(x+2)',
                    '(x²)(x+2)-9(x+2)'
                ].map(normalize);

                if (valid.includes(input)) {
                    feedback.textContent = 'Benar. Bentuk pengelompokannya sudah tepat.';
                    feedback.className = 'feedback ok';
                    document.getElementById('latihan1Step2Status').value = 'true';
                    showLatihan1Step(2);
                } else {
                    feedback.textContent = 'Belum tepat. Kelompokkan menjadi (x³ + 2x²) dan (-9x - 18).';
                    feedback.className = 'feedback no';
                }

                showLatihan1Final();
            }

            window.cekLatihan1Langkah3 = function () {
                const input = getSelectedValue('latihan1opsi3');
                const feedback = document.getElementById('latihan1Feedback3');

                if (input === 'x+2') {
                    feedback.textContent = 'Benar. Faktor persekutuannya adalah (x + 2).';
                    feedback.className = 'feedback ok';
                    document.getElementById('latihan1Step3Status').value = 'true';
                    showLatihan1Step(3);
                } else {
                    feedback.textContent = 'Belum tepat. Ambil faktor persekutuan dari dua kelompok yang sudah terbentuk.';
                    feedback.className = 'feedback no';
                }

                showLatihan1Final();
            }

            window.cekLatihan1Langkah4 = function () {
                const input = normalize(document.getElementById('jawabLatihan1Langkah4').value);
                const feedback = document.getElementById('latihan1Feedback4');

                const valid = [
                    '(x+2)(x^2-9)',
                    '(x^2-9)(x+2)',
                    '(x+2)(x-3)(x+3)',
                    '(x+2)(x+3)(x-3)',
                    '(x-3)(x+2)(x+3)',
                    '(x+3)(x+2)(x-3)'
                ].map(normalize);

                if (valid.includes(input)) {
                    feedback.textContent = 'Benar. Faktorisasi lengkapnya tepat.';
                    feedback.className = 'feedback ok';
                    document.getElementById('latihan1Step4Status').value = 'true';
                    showLatihan1Step(4);
                } else {
                    feedback.textContent = 'Belum tepat. Setelah diperoleh (x + 2)(x² - 9), lanjutkan dengan selisih kuadrat.';
                    feedback.className = 'feedback no';
                }

                showLatihan1Final();
            }

            // =========================
            // LATIHAN 2
            // =========================
            function showLatihan2Step(stepNumber) {
                const el = document.getElementById('latihan2Explain' + stepNumber);
                if (el) el.style.display = 'block';
            }

            function showLatihan2Final() {
                const s1 = document.getElementById('latihan2Step1Status').value === 'true';
                const s2 = document.getElementById('latihan2Step2Status').value === 'true';
                const s3 = document.getElementById('latihan2Step3Status').value === 'true';
                const s4 = document.getElementById('latihan2Step4Status').value === 'true';
                const s5 = document.getElementById('latihan2Step5Status').value === 'true';

                const finalBox = document.getElementById('latihan2FinalExplanation');
                if (s1 && s2 && s3 && s4 && s5) {
                    finalBox.style.display = 'block';
                }
            }

            window.cekLatihan2Langkah1 = function () {
                const input = getSelectedValue('latihan2opsi1');
                const feedback = document.getElementById('latihan2Feedback1');

                if (input === '±1,±2,±3,±6,±1/2,±3/2') {
                    feedback.textContent = 'Benar. Itulah kandidat pembuat nol rasionalnya.';
                    feedback.className = 'feedback ok';
                    document.getElementById('latihan2Step1Status').value = 'true';
                    showLatihan2Step(1);
                } else {
                    feedback.textContent = 'Belum tepat. Gunakan faktor konstanta 6 dibagi faktor koefisien utama 2.';
                    feedback.className = 'feedback no';
                }

                showLatihan2Final();
            }

            window.cekLatihan2Langkah2 = function () {
                const input = normalize(document.getElementById('jawabLatihan2Langkah2').value);
                const feedback = document.getElementById('latihan2Feedback2');

                if (input === '-2') {
                    feedback.textContent = 'Benar. P(-2)=0, jadi -2 adalah salah satu pembuat nol.';
                    feedback.className = 'feedback ok';
                    document.getElementById('latihan2Step2Status').value = 'true';
                    showLatihan2Step(2);
                } else {
                    feedback.textContent = 'Belum tepat. Coba substitusi beberapa kandidat sederhana, misalnya ±1, ±2.';
                    feedback.className = 'feedback no';
                }

                showLatihan2Final();
            }

            window.cekLatihan2Langkah3 = function () {
                const input = getSelectedValue('latihan2opsi3');
                const feedback = document.getElementById('latihan2Feedback3');

                if (input === 'x+2') {
                    feedback.textContent = 'Benar. Karena akar yang diperoleh adalah -2, maka faktor linearnya (x + 2).';
                    feedback.className = 'feedback ok';
                    document.getElementById('latihan2Step3Status').value = 'true';
                    showLatihan2Step(3);
                } else {
                    feedback.textContent = 'Belum tepat. Jika c = -2 pembuat nol, maka faktornya adalah x - ( -2 ).';
                    feedback.className = 'feedback no';
                }

                showLatihan2Final();
            }

            window.cekLatihan2Langkah4 = function () {
                const a = normalize(document.getElementById('latihan2Horner1').value);
                const b = normalize(document.getElementById('latihan2Horner2').value);
                const c = normalize(document.getElementById('latihan2Horner3').value);
                const d = normalize(document.getElementById('latihan2Horner4').value);

                const feedback = document.getElementById('latihan2Feedback4');

                if (a === '2' && b === '-7' && c === '3' && d === '0') {
                    feedback.textContent = 'Benar. Hasil bawah Horner sudah tepat.';
                    feedback.className = 'feedback ok';
                    document.getElementById('latihan2Step4Status').value = 'true';
                    showLatihan2Step(4);
                } else {
                    feedback.textContent = 'Belum tepat. Hasil bawah Horner harus memberi koefisien hasil bagi dan sisa 0.';
                    feedback.className = 'feedback no';
                }

                showLatihan2Final();
            }

            window.cekLatihan2Langkah5 = function () {
                const input = normalize(document.getElementById('jawabLatihan2Langkah5').value);
                const feedback = document.getElementById('latihan2Feedback5');

                const valid = [
                    '(x+2)(2x-1)(x-3)',
                    '(x+2)(x-3)(2x-1)',
                    '(2x-1)(x+2)(x-3)',
                    '(2x-1)(x-3)(x+2)',
                    '(x-3)(x+2)(2x-1)',
                    '(x-3)(2x-1)(x+2)'
                ].map(normalize);

                if (valid.includes(input)) {
                    feedback.textContent = 'Benar. Faktorisasi lengkapnya tepat.';
                    feedback.className = 'feedback ok';
                    document.getElementById('latihan2Step5Status').value = 'true';
                    showLatihan2Step(5);
                } else {
                    feedback.textContent = 'Belum tepat. Setelah Horner diperoleh 2x² - 7x + 3, lalu faktorkan lagi.';
                    feedback.className = 'feedback no';
                }

                showLatihan2Final();
            }

            // =========================
            // EKSPLORASI DRAG & DROP
            // =========================
            let draggedItem = null;
            let solvedCount = 0;
            const totalAnswers = 3;

            const progressFill = document.getElementById('progressFill');
            const progressText = document.getElementById('progressText');
            const finalBoxEks = document.getElementById('eksplorasiFinal');

            const dropToExplanationMap = {
                'drop-p1': 'explainP1',
                'drop-p2': 'explainP2',
                'drop-makna': 'explainMakna'
            };

            const dropToStatusMap = {
                'g1': 'statusEks1',
                'g2': 'statusEks2'
            };

            function updateProgress() {
                const percent = (solvedCount / totalAnswers) * 100;
                if (progressFill) progressFill.style.width = percent + '%';
                if (progressText) progressText.textContent = solvedCount + ' / ' + totalAnswers + ' jawaban benar';

                if (finalBoxEks) {
                    if (solvedCount === totalAnswers) {
                        finalBoxEks.classList.add('show');
                    } else {
                        finalBoxEks.classList.remove('show');
                    }
                }
            }

            function showStatus(group, message, type) {
                const el = document.getElementById(dropToStatusMap[group]);
                if (!el) return;
                el.textContent = message;
                el.className = 'status-box show ' + type;
            }

            function clearStatus(group) {
                const el = document.getElementById(dropToStatusMap[group]);
                if (!el) return;
                el.textContent = '';
                el.className = 'status-box';
            }

            function lockCorrectDrop(dropZone, item) {
                dropZone.innerHTML = '';
                dropZone.appendChild(item);
                dropZone.classList.add('filled', 'correct');
                dropZone.classList.remove('wrong', 'hovered');

                item.classList.add('locked');
                item.setAttribute('draggable', 'false');

                if (!dropZone.dataset.solved) {
                    dropZone.dataset.solved = 'true';
                    solvedCount++;
                    updateProgress();
                }

                const explainId = dropToExplanationMap[dropZone.id];
                if (explainId) {
                    const explainEl = document.getElementById(explainId);
                    if (explainEl) explainEl.classList.add('show');
                }
            }

            function resetWrongDrop(dropZone, item) {
                dropZone.classList.add('wrong');
                setTimeout(() => {
                    dropZone.classList.remove('wrong', 'filled');
                    dropZone.innerHTML = '';
                }, 250);

                const group = dropZone.dataset.group;
                showStatus(group, 'Belum tepat. Coba hitung kembali nilai fungsi atau pahami arti hasilnya.', 'error');

                const bank = group === 'g1'
                    ? document.getElementById('answerBank1')
                    : document.getElementById('answerBank2');

                setTimeout(() => {
                    if (bank) bank.appendChild(item);
                    item.classList.remove('dragging');
                }, 260);
            }

            function setupDragItems() {
                document.querySelectorAll('.drag-item').forEach(item => {
                    item.addEventListener('dragstart', function () {
                        if (this.classList.contains('locked')) return;
                        draggedItem = this;
                        this.classList.add('dragging');
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

                        if (!draggedItem || this.dataset.solved === 'true') return;

                        const droppedValue = (draggedItem.dataset.value || '').toLowerCase().trim();
                        const correctAnswer = (this.dataset.answer || '').toLowerCase().trim();
                        const group = this.dataset.group;

                        clearStatus(group);

                        if (droppedValue === correctAnswer) {
                            lockCorrectDrop(this, draggedItem);

                            if (group === 'g1') {
                                const p1Done = document.getElementById('drop-p1').dataset.solved === 'true';
                                const p2Done = document.getElementById('drop-p2').dataset.solved === 'true';

                                if (p1Done && p2Done) {
                                    showStatus(group, 'Bagus. Semua nilai fungsi pada Eksplorasi 1 sudah benar.', 'success');
                                } else {
                                    showStatus(group, 'Benar. Lanjutkan ke kotak berikutnya.', 'success');
                                }
                            } else {
                                showStatus(group, 'Tepat sekali. Makna hasil fungsi sudah benar.', 'success');
                            }
                        } else {
                            resetWrongDrop(this, draggedItem);
                        }

                        draggedItem = null;
                    });
                });
            }

            window.resetEksplorasi = function () {
                solvedCount = 0;
                updateProgress();

                document.querySelectorAll('.drop-zone').forEach(zone => {
                    zone.innerHTML = '';
                    zone.classList.remove('filled', 'correct', 'wrong', 'hovered');
                    delete zone.dataset.solved;
                });

                document.querySelectorAll('.explanation-box').forEach(box => {
                    box.classList.remove('show');
                });

                document.querySelectorAll('.status-box').forEach(box => {
                    box.textContent = '';
                    box.className = 'status-box';
                });

                if (finalBoxEks) finalBoxEks.classList.remove('show');

                const bank1 = document.getElementById('answerBank1');
                const bank2 = document.getElementById('answerBank2');

                if (bank1) {
                    bank1.innerHTML = `
                                                                            <div class="drag-item" draggable="true" data-value="1">1</div>
                                                                            <div class="drag-item" draggable="true" data-value="3">3</div>
                                                                            <div class="drag-item" draggable="true" data-value="2">2</div>
                                                                            <div class="drag-item" draggable="true" data-value="4">4</div>
                                                                        `;
                }

                if (bank2) {
                    bank2.innerHTML = `
                                                                            <div class="drag-item" draggable="true" data-value="masih ada 1 kain tersisa">Masih ada 1 kain tersisa</div>
                                                                            <div class="drag-item" draggable="true" data-value="kain habis terjual">Kain habis terjual</div>
                                                                            <div class="drag-item" draggable="true" data-value="produksi bertambah">Produksi bertambah</div>
                                                                            <div class="drag-item" draggable="true" data-value="tidak ada perubahan">Tidak ada perubahan</div>
                                                                        `;
                }

                setupDragItems();
            };

            setupDragItems();
            setupDropZones();
            updateProgress();
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
        .card-eksplorasi {
            position: relative;
            overflow: hidden;
            background: #eaf3ff !important;
            /* FULL SOFT BLUE */
            background-image: none !important;
            border: 1px solid #cfe3ff;
            border-left: 6px solid #5b9bd5;
            border-radius: 20px;
            padding: 28px;
            box-shadow: none !important;
            /* hilangkan efek depth berlebihan */
        }

        /* MATIKAN SEMUA EFEK TAMBAHAN */
        .card-eksplorasi::before,
        .card-eksplorasi::after {
            display: none !important;
            content: none !important;
        }

        /* HAPUS SEMUA GRADASI DI DALAM CARD */
        .card-eksplorasi * {
            background-image: none !important;
        }

        /* PAKSA BACKGROUND DALAM JADI TRANSPARAN */
        .eksplorasi-story,
        .explore-grid,
        .mini-card {
            background: transparent !important;
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

        .contoh-wrap,
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
                    Di Banjarmasin, kain <strong>sasirangan</strong> merupakan salah satu produk khas daerah yang banyak
                    dibuat oleh para pengrajin.
                    Setiap hari, seorang pengrajin mencatat jumlah kain yang masih tersisa setelah sebagian terjual.
                </p>

                <div class="rumus-box">
                    <div class="rumus-besar">
                        \[
                        P(x)=x^3-2x^2+x+1
                        \]
                    </div>
                </div>

                <p>dengan:</p>
                <ul>
                    <li>\(x\) menyatakan hari ke-\(x\),</li>
                    <li>\(P(x)\) menyatakan banyak kain yang masih tersisa.</li>
                </ul>

                <p>
                    Melalui model ini, kita dapat mengetahui banyak kain yang tersisa pada hari tertentu dengan cara
                    mensubstitusikan nilai \(x\) ke dalam fungsi.
                </p>
            </div>

            <div class="explore-grid">
                {{-- EKSPLORASI 1 --}}
                <div class="mini-card">
                    <h4>Eksplorasi 1</h4>
                    <p>Hitung nilai fungsi berikut, lalu cocokkan dengan hasil yang benar.</p>

                    <div class="bank-label">Seret pilihan jawaban</div>
                    <div class="drag-bank" id="answerBank1">
                        <div class="drag-item" draggable="true" data-value="1">1</div>
                        <div class="drag-item" draggable="true" data-value="3">3</div>
                        <div class="drag-item" draggable="true" data-value="2">2</div>
                        <div class="drag-item" draggable="true" data-value="4">4</div>
                    </div>

                    <div class="small-note">Petunjuk: substitusikan \(x\) ke fungsi \(P(x)\).</div>

                    <div class="drop-list" style="margin-top:16px;">
                        <div class="drop-row">
                            <div class="drop-label">\(P(1)\)</div>
                            <div class="drop-zone" data-placeholder="Drop jawaban di sini" data-answer="1" data-group="g1"
                                id="drop-p1"></div>
                        </div>

                        <div class="drop-row">
                            <div class="drop-label">\(P(2)\)</div>
                            <div class="drop-zone" data-placeholder="Drop jawaban di sini" data-answer="3" data-group="g1"
                                id="drop-p2"></div>
                        </div>
                    </div>

                    <div id="statusEks1" class="status-box"></div>

                    <div id="explainP1" class="explanation-box">
                        <h5>✅ Penjelasan \(P(1)\)</h5>
                        <p>Substitusikan \(x=1\) ke fungsi:</p>
                        <p>
                            \[
                            P(1)=1^3-2(1)^2+1+1=1-2+1+1=1
                            \]
                        </p>
                        <p>
                            Jadi, pada hari ke-1 kain yang masih tersisa adalah <strong>1 kain</strong>.
                        </p>
                    </div>

                    <div id="explainP2" class="explanation-box">
                        <h5>✅ Penjelasan \(P(2)\)</h5>
                        <p>Substitusikan \(x=2\) ke fungsi:</p>
                        <p>
                            \[
                            P(2)=2^3-2(2)^2+2+1=8-8+2+1=3
                            \]
                        </p>
                        <p>
                            Jadi, pada hari ke-2 kain yang masih tersisa adalah <strong>3 kain</strong>.
                        </p>
                    </div>
                </div>

                {{-- EKSPLORASI 2 --}}
                <div class="mini-card">
                    <h4>Eksplorasi 2</h4>
                    <p>Perhatikan hasil berikut, lalu seret makna yang paling tepat.</p>

                    <div class="rumus-box" style="margin-top:0;">
                        <div class="rumus-label">HASIL</div>
                        <div class="rumus-besar">
                            \[
                            P(1)=1
                            \]
                        </div>
                    </div>

                    <div class="bank-label">Seret makna hasil</div>
                    <div class="drag-bank" id="answerBank2" style="flex-direction:column;">
                        <div class="drag-item" draggable="true" data-value="masih ada 1 kain tersisa">Masih ada 1 kain
                            tersisa</div>
                        <div class="drag-item" draggable="true" data-value="kain habis terjual">Kain habis terjual</div>
                        <div class="drag-item" draggable="true" data-value="produksi bertambah">Produksi bertambah</div>
                        <div class="drag-item" draggable="true" data-value="tidak ada perubahan">Tidak ada perubahan</div>
                    </div>

                    <div class="drop-list" style="margin-top:16px;">
                        <div class="drop-row">
                            <div class="drop-label">Makna</div>
                            <div class="drop-zone" data-placeholder="Drop jawaban makna di sini"
                                data-answer="masih ada 1 kain tersisa" data-group="g2" id="drop-makna"></div>
                        </div>
                    </div>

                    <div id="statusEks2" class="status-box"></div>

                    <div id="explainMakna" class="explanation-box">
                        <h5>✅ Penjelasan Makna Hasil</h5>
                        <p>
                            Nilai \(P(1)=1\) berarti saat \(x=1\) atau <strong>hari ke-1</strong>, banyak kain yang
                            masih tersisa adalah <strong>1 kain</strong>.
                        </p>
                        <p>
                            Jadi, jawaban yang tepat adalah <strong>“Masih ada 1 kain tersisa”</strong>.
                        </p>
                    </div>
                </div>
            </div>

            <div id="eksplorasiFinal" class="eksplorasi-final">
                <h4>🎉 Semua Eksplorasi Selesai</h4>
                <p>
                    Dari kegiatan drag and drop ini, kita belajar bahwa nilai fungsi diperoleh dengan
                    <strong>mensubstitusikan nilai \(x\)</strong> ke dalam fungsi.
                </p>
                <p>
                    Untuk fungsi
                    \[
                    P(x)=x^3-2x^2+x+1
                    \]
                    diperoleh:
                </p>
                <p>
                    \[
                    P(1)=1 \quad \text{dan} \quad P(2)=3
                    \]
                </p>
                <p>
                    Artinya, pada hari ke-1 masih tersisa <strong>1 kain</strong>, sedangkan pada hari ke-2 masih
                    tersisa <strong>3 kain</strong>.
                </p>
            </div>
        </div>

        {{-- PARAGRAF --}}
        <div></div>
    </div>
    <p>
        Sebelumnya kamu telah mempelajari <span class="highlight">Teorema Sisa</span>, yang
        menyatakan bahwa sisa pembagian polinomial \( P(x) \) oleh bentuk linear
        \( (x-c) \) adalah \( P(c) \). Teorema ini menjadi dasar bagi konsep yang sangat
        penting dalam pemfaktoran polinomial, yaitu
        <span class="highlight">Teorema Faktor</span>. Melalui teorema ini, kita dapat
        menentukan apakah suatu bentuk linear merupakan faktor dari polinomial tanpa
        melakukan pembagian panjang.
    </p>

    <div class="definisi-modern">
        <div class="definisi-pill">DEFINISI</div>

        <p>
            <strong>Teorema Faktor</strong> memberikan cara cepat untuk mengetahui apakah suatu bentuk linear
            merupakan
            faktor dari suatu polinomial.
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

    {{-- SIFAT 1 --}}
    <div class="sifat-box">
        <div class="sifat-label">SIFAT</div>

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
                    Buktikan dugaan tersebut dan gunakan hasilnya untuk memfaktorkan \(P(x)\) secara lengkap.
                </p>
            </div>

            <input type="hidden" id="step1Status" value="false">
            <input type="hidden" id="step2Status" value="false">
            <input type="hidden" id="step3Status" value="false">
            <input type="hidden" id="step4Status" value="false">
            <input type="hidden" id="step5Status" value="false">

            <div class="langkah-card">
                <div class="langkah-title">Langkah 1</div>
                <div class="langkah-sub">Hitung nilai \(P(1)\).</div>

                <label>Masukkan nilai \(P(1)\):</label>
                <input type="text" id="jawabLangkah1" class="input-jawaban" placeholder="Contoh: 0">

                <button class="btn-cek" onclick="cekLangkah1()">Cek Jawaban</button>
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

            <div class="langkah-card">
                <div class="langkah-title">Langkah 2</div>
                <div class="langkah-sub">Gunakan Teorema Faktor.</div>

                <label>Jika \(P(1)=0\), maka faktor linearnya adalah:</label>
                <input type="text" id="jawabLangkah2" class="input-jawaban" placeholder="Contoh: x-1">

                <button class="btn-cek" onclick="cekLangkah2()">Cek Jawaban</button>
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

            <div class="langkah-card">
                <div class="langkah-title">Langkah 3</div>
                <div class="langkah-sub">
                    Lengkapi baris kedua pada tabel Horner.
                </div>

                <div class="horner-caption">
                    Isi kotak kosong. Baris pertama saja yang sudah diberikan.
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
                            <td><input type="text" id="hornerTop1" class="horner-box"></td>
                            <td><input type="text" id="hornerTop2" class="horner-box"></td>
                            <td><input type="text" id="hornerTop3" class="horner-box"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="horner-bottom"></td>
                            <td class="horner-bottom"> </td>
                            <td class="horner-bottom"> </td>
                            <td class="horner-bottom"> </td>
                        </tr>
                    </table>
                </div>

                <button class="btn-cek" onclick="cekLangkah3()">Cek Jawaban</button>
                <div id="feedback3" class="feedback"></div>

                <div id="stepExplain3" class="penjelasan-step">
                    <p>
                        Pada metode Horner, angka pada baris kedua diperoleh dari hasil kali bertahap dengan \(1\).
                    </p>
                    <p style="margin-top:8px;">
                        Jadi baris keduanya adalah:
                    </p>
                    <p style="margin-top:8px;">
                        \[
                        1,\ -3,\ -4
                        \]
                    </p>
                </div>
            </div>

            <div class="langkah-card">
                <div class="langkah-title">Langkah 4</div>
                <div class="langkah-sub">
                    Lengkapi baris hasil bawah Horner.
                </div>

                <div class="horner-caption">
                    Isi hasil bawah dan sisa pembagian.
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
                            <td>1</td>
                            <td>-3</td>
                            <td>-4</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="horner-bottom"><input type="text" id="hornerBottom1" class="horner-box"></td>
                            <td class="horner-bottom"><input type="text" id="hornerBottom2" class="horner-box"></td>
                            <td class="horner-bottom"><input type="text" id="hornerBottom3" class="horner-box"></td>
                            <td class="horner-sisa"><input type="text" id="hornerBottom4" class="horner-box"></td>
                        </tr>
                    </table>
                </div>

                <button class="btn-cek" onclick="cekLangkah4()">Cek Jawaban</button>
                <div id="feedback4" class="feedback"></div>

                <div id="stepExplain4" class="penjelasan-step">
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

            <div class="langkah-card">
                <div class="langkah-title">Langkah 5</div>
                <div class="langkah-sub">
                    Faktorkan hasil bagi \(x^2-3x-4\).
                </div>

                <label>Tuliskan faktornya:</label>
                <input type="text" id="jawabLangkah5" class="input-jawaban" placeholder="Contoh: (x-4)(x+1)">

                <button class="btn-cek" onclick="cekLangkah5()">Cek Jawaban</button>
                <div id="feedback5" class="feedback"></div>

                <div id="stepExplain5" class="penjelasan-step">
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
        Selain menggunakan petunjuk khusus seperti pada contoh pertama, soal yang sama juga dapat diselesaikan
        dengan cara yang lebih sistematis, yaitu menggunakan
        <span class="highlight">Pembuat Nol Rasional</span>.
    </p>

    <p>
        Dengan cara ini, kita mencari dulu semua kandidat akar rasional yang mungkin, lalu menguji salah satunya.
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
            <input type="hidden" id="rasionalStep6Status" value="false">

            <div class="langkah-card">
                <div class="langkah-title">Langkah 1</div>
                <div class="langkah-sub">
                    Tentukan kandidat pembuat nol rasional dari polinomial.
                </div>

                <label>Tuliskan kandidat pembuat nol rasional:</label>
                <input type="text" id="jawabRasional1" class="input-jawaban" placeholder="Contoh: ±1, ±2, ±4">

                <button class="btn-cek" onclick="cekRasionalLangkah1()">Cek Jawaban</button>
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

            <div class="langkah-card">
                <div class="langkah-title">Langkah 2</div>
                <div class="langkah-sub">
                    Coba salah satu kandidat akar. Nilai yang membuat \(P(x)=0\) adalah?
                </div>

                <label>Masukkan salah satu pembuat nol:</label>
                <input type="text" id="jawabRasional2" class="input-jawaban" placeholder="Contoh: 1">

                <button class="btn-cek" onclick="cekRasionalLangkah2()">Cek Jawaban</button>
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

            <div class="langkah-card">
                <div class="langkah-title">Langkah 3</div>
                <div class="langkah-sub">
                    Gunakan Teorema Faktor.
                </div>

                <label>Jika \(P(1)=0\), maka faktor linearnya adalah:</label>
                <input type="text" id="jawabRasional3" class="input-jawaban" placeholder="Contoh: x-1">

                <button class="btn-cek" onclick="cekRasionalLangkah3()">Cek Jawaban</button>
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

            <div class="langkah-card">
                <div class="langkah-title">Langkah 4</div>
                <div class="langkah-sub">
                    Lengkapi baris kedua pada tabel Horner untuk pembagian dengan \(x-1\).
                </div>

                <div class="horner-caption">
                    Isi dulu baris kedua Horner.
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
                            <td><input type="text" id="rasionalHornerTop1" class="horner-box"></td>
                            <td><input type="text" id="rasionalHornerTop2" class="horner-box"></td>
                            <td><input type="text" id="rasionalHornerTop3" class="horner-box"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="horner-bottom"></td>
                            <td class="horner-bottom"> </td>
                            <td class="horner-bottom"> </td>
                            <td class="horner-bottom"> </td>
                        </tr>
                    </table>
                </div>

                <button class="btn-cek" onclick="cekRasionalLangkah4()">Cek Jawaban</button>
                <div id="rasionalFeedback4" class="feedback"></div>

                <div id="rasionalExplain4" class="penjelasan-step">
                    <p>
                        Pada metode Horner, angka pada baris kedua diperoleh dari hasil kali bertahap dengan \(1\).
                    </p>
                    <p style="margin-top:8px;">
                        Jadi baris keduanya adalah:
                    </p>
                    <p style="margin-top:8px;">
                        \[
                        1,\ -3,\ -4
                        \]
                    </p>
                </div>
            </div>

            <div class="langkah-card">
                <div class="langkah-title">Langkah 5</div>
                <div class="langkah-sub">
                    Lengkapi baris terakhir Horner.
                </div>

                <div class="horner-caption">
                    Isi baris hasil bawah dan sisa pembagian.
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
                            <td>1</td>
                            <td>-3</td>
                            <td>-4</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="horner-bottom"><input type="text" id="rasionalHornerBottom1" class="horner-box">
                            </td>
                            <td class="horner-bottom"><input type="text" id="rasionalHornerBottom2" class="horner-box">
                            </td>
                            <td class="horner-bottom"><input type="text" id="rasionalHornerBottom3" class="horner-box">
                            </td>
                            <td class="horner-sisa"><input type="text" id="rasionalHornerBottom4" class="horner-box">
                            </td>
                        </tr>
                    </table>
                </div>

                <button class="btn-cek" onclick="cekRasionalLangkah5()">Cek Jawaban</button>
                <div id="rasionalFeedback5" class="feedback"></div>

                <div id="rasionalExplain5" class="penjelasan-step">
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

            <div class="langkah-card">
                <div class="langkah-title">Langkah 6</div>
                <div class="langkah-sub">
                    Faktorkan polinomial secara lengkap.
                </div>

                <label>Tuliskan faktorisasi lengkap:</label>
                <input type="text" id="jawabRasional6" class="input-jawaban" placeholder="Contoh: (x-1)(x-4)(x+1)">

                <button class="btn-cek" onclick="cekRasionalLangkah6()">Cek Jawaban</button>
                <div id="rasionalFeedback6" class="feedback"></div>

                <div id="rasionalExplain6" class="penjelasan-step">
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
                    Dari Teorema Pembuat Nol Rasional, kandidat akar rasional diperoleh dari faktor-faktor 4, yaitu:
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

                    <input type="hidden" id="latihan1Step1Status" value="false">
                    <input type="hidden" id="latihan1Step2Status" value="false">
                    <input type="hidden" id="latihan1Step3Status" value="false">
                    <input type="hidden" id="latihan1Step4Status" value="false">

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

                        <button class="btn-cek" onclick="cekLatihan1Langkah1()">Cek Jawaban</button>
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

                    <div class="langkah-card">
                        <div class="langkah-title">Langkah 2</div>
                        <div class="langkah-sub">
                            Tuliskan hasil pengelompokannya setelah masing-masing kelompok difaktorkan.
                        </div>

                        <label>Masukkan bentuk hasil pengelompokan:</label>
                        <input type="text" id="jawabLatihan1Langkah2" class="input-jawaban"
                            placeholder="Contoh: x^2(x+2)-9(x+2)">

                        <button class="btn-cek" onclick="cekLatihan1Langkah2()">Cek Jawaban</button>
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

                        <button class="btn-cek" onclick="cekLatihan1Langkah3()">Cek Jawaban</button>
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

                    <div class="langkah-card">
                        <div class="langkah-title">Langkah 4</div>
                        <div class="langkah-sub">
                            Faktorkan polinomial hingga bentuk paling sederhana.
                        </div>

                        <label>Tuliskan faktorisasi lengkap:</label>
                        <input type="text" id="jawabLatihan1Langkah4" class="input-jawaban"
                            placeholder="Contoh: (x+2)(x-3)(x+3)">

                        <button class="btn-cek" onclick="cekLatihan1Langkah4()">Cek Jawaban</button>
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
                    <div class="latihan-soal-text">
                        Gunakan Sifat Pembuat Nol Rasional untuk menentukan pembuat nol dari polinomial berikut,
                        lalu faktorkan polinomial tersebut hingga bentuk paling sederhana:
                    </div>

                    <div class="latihan-soal-rumus">
                        \[
                        P(x)=2x^3-3x^2-11x+6
                        \]
                    </div>

                    <input type="hidden" id="latihan2Step1Status" value="false">
                    <input type="hidden" id="latihan2Step2Status" value="false">
                    <input type="hidden" id="latihan2Step3Status" value="false">
                    <input type="hidden" id="latihan2Step4Status" value="false">
                    <input type="hidden" id="latihan2Step5Status" value="false">

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

                        <button class="btn-cek" onclick="cekLatihan2Langkah1()">Cek Jawaban</button>
                        <div id="latihan2Feedback1" class="feedback"></div>

                        <div id="latihan2Explain1" class="penjelasan-step">
                            <p>
                                Faktor konstanta \(6\) adalah \(\pm1,\pm2,\pm3,\pm6\), sedangkan faktor koefisien
                                utama
                                \(2\) adalah \(\pm1,\pm2\).
                            </p>
                            <p style="margin-top:8px;">
                                Maka kandidat pembuat nol rasional:
                                \[
                                \pm1,\pm2,\pm3,\pm6,\pm\frac{1}{2},\pm\frac{3}{2}
                                \]
                            </p>
                        </div>
                    </div>

                    <div class="langkah-card">
                        <div class="langkah-title">Langkah 2</div>
                        <div class="langkah-sub">
                            Salah satu pembuat nol polinomial adalah:
                        </div>

                        <label>Masukkan salah satu pembuat nol:</label>
                        <input type="text" id="jawabLatihan2Langkah2" class="input-jawaban" placeholder="Contoh: -2">

                        <button class="btn-cek" onclick="cekLatihan2Langkah2()">Cek Jawaban</button>
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

                        <button class="btn-cek" onclick="cekLatihan2Langkah3()">Cek Jawaban</button>
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

                    <div class="langkah-card">
                        <div class="langkah-title">Langkah 4</div>
                        <div class="langkah-sub">
                            Lengkapi baris hasil bawah Horner untuk pembagian dengan \(x+2\).
                        </div>

                        <div class="mini-note">
                            Isikan hasil bawah dan sisa pembagian.
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
                                    <td class="horner-bottom"><input type="text" id="latihan2Horner1" class="horner-box">
                                    </td>
                                    <td class="horner-bottom"><input type="text" id="latihan2Horner2" class="horner-box">
                                    </td>
                                    <td class="horner-bottom"><input type="text" id="latihan2Horner3" class="horner-box">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="horner-bottom">2</td>
                                    <td class="horner-bottom">-7</td>
                                    <td class="horner-bottom">3</td>
                                    <td class="horner-sisa"><input type="text" id="latihan2Horner4" class="horner-box">
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <button class="btn-cek" onclick="cekLatihan2Langkah4()">Cek Jawaban</button>
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

                    <div class="langkah-card">
                        <div class="langkah-title">Langkah 5</div>
                        <div class="langkah-sub">
                            Faktorkan polinomial secara lengkap.
                        </div>

                        <label>Tuliskan faktorisasi lengkap:</label>
                        <input type="text" id="jawabLatihan2Langkah5" class="input-jawaban"
                            placeholder="Contoh: (x+2)(2x-1)(x-3)">

                        <button class="btn-cek" onclick="cekLatihan2Langkah5()">Cek Jawaban</button>
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
                </li>
            </ol>
        </div>
    </div>

@endsection

@section('nav')
    <a href="{{ route('kuisc') }}" class="btn-nav prev-btn">← Previous</a>
    <a href="{{ route('faktordanpembuatnol') }}" class="btn-nav next-btn">Next →</a>
@endsection