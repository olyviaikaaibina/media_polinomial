@extends('layout.halamanmateri')

@section('content')
    <style>
        :root {
            --primary: #AAB99A;
            --primary-dark: #8d9c7d;
            --primary-deep: #738363;
            --primary-soft: #f4f7f0;
            --primary-soft-2: #edf2e7;
            --border: #d3dbc9;
            --text: #2f392c;
            --muted: #6b7566;
            --white: #ffffff;
            --danger: #d96b6b;
            --success: #5f8a55;
            --warning: #d4a017;
            --shadow: 0 14px 35px rgba(170, 185, 154, 0.16);
            --radius-xl: 28px;
            --radius-lg: 20px;
            --radius-md: 16px;
        }

        .quiz-wrapper {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            padding: 18px 0 10px;
        }

        .quiz-topbar {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .quiz-title-group h2 {
            margin: 0;
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary-deep);
        }

        .quiz-title-group p {
            margin: 6px 0 0;
            color: var(--muted);
            font-size: 1rem;
            font-weight: 500;
        }

        .quiz-timer {
            min-width: 122px;
            height: 70px;
            border-radius: 999px;
            border: 3px solid var(--primary);
            background: linear-gradient(180deg, #ffffff 0%, #f9fbf6 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-deep);
            font-size: 1.55rem;
            font-weight: 800;
            box-shadow: var(--shadow);
            padding: 0 18px;
        }

        .quiz-layout {
            display: grid;
            grid-template-columns: minmax(0, 1.8fr) 260px;
            gap: 22px;
            align-items: start;
        }

        .quiz-main-card,
        .quiz-side-card,
        .quiz-result-card {
            background: var(--white);
            border: 2px solid var(--border);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow);
        }

        .quiz-main-card {
            padding: 24px 24px 20px;
            min-height: 620px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .quiz-main-card::before {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(170, 185, 154, 0.18) 0%, rgba(170, 185, 154, 0) 70%);
            pointer-events: none;
        }

        .quiz-main-card::after {
            content: '';
            position: absolute;
            bottom: -90px;
            left: -90px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(170, 185, 154, 0.12) 0%, rgba(170, 185, 154, 0) 75%);
            pointer-events: none;
        }

        .quiz-question-area {
            position: relative;
            z-index: 1;
        }

        .question-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 18px;
            min-width: 96px;
            border-radius: 999px;
            background: var(--primary);
            color: #ffffff;
            font-weight: 700;
            font-size: 0.98rem;
            box-shadow: 0 8px 18px rgba(170, 185, 154, 0.22);
            margin-bottom: 18px;
        }

        .question-text {
            color: var(--text);
            font-size: 1.42rem;
            line-height: 1.75;
            font-weight: 700;
            margin-bottom: 24px;
        }

        .question-text strong {
            color: var(--primary-deep);
            font-weight: 800;
        }

        .options-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .option-item {
            position: relative;
        }

        .option-item input[type="radio"] {
            display: none;
        }

        .option-label {
            display: flex;
            align-items: center;
            gap: 14px;
            width: 100%;
            padding: 16px 18px;
            border: 2px solid #d8dfd0;
            border-radius: 18px;
            background: #fff;
            cursor: pointer;
            transition: all 0.22s ease;
            position: relative;
            overflow: hidden;
        }

        .option-label::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(170, 185, 154, 0.08), rgba(170, 185, 154, 0));
            opacity: 0;
            transition: 0.22s ease;
        }

        .option-label:hover {
            transform: translateY(-1px);
            border-color: var(--primary);
            box-shadow: 0 10px 20px rgba(170, 185, 154, 0.14);
        }

        .option-label:hover::before {
            opacity: 1;
        }

        .option-badge {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--primary-soft-2);
            color: var(--primary-deep);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1rem;
            flex-shrink: 0;
            border: 2px solid #d8dfd0;
            position: relative;
            z-index: 1;
        }

        .option-text {
            color: var(--text);
            font-size: 1.05rem;
            font-weight: 600;
            line-height: 1.6;
            position: relative;
            z-index: 1;
        }

        .option-item input[type="radio"]:checked + .option-label {
            background: var(--primary-soft);
            border-color: var(--primary-dark);
            box-shadow: 0 12px 22px rgba(170, 185, 154, 0.18);
        }

        .option-item input[type="radio"]:checked + .option-label::before {
            opacity: 1;
        }

        .option-item input[type="radio"]:checked + .option-label .option-badge {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            color: #fff;
        }

        .quiz-footer {
            position: relative;
            z-index: 1;
            margin-top: 26px;
            padding-top: 16px;
            border-top: 1px solid #eef1ea;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .quiz-progress {
            color: var(--muted);
            font-size: 0.98rem;
            font-weight: 700;
        }

        .quiz-buttons {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quiz-btn {
            min-width: 54px;
            height: 54px;
            border-radius: 14px;
            border: 2px solid var(--primary);
            background: #fff;
            color: var(--primary-deep);
            font-size: 1.15rem;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .quiz-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 16px rgba(170, 185, 154, 0.14);
        }

        .quiz-btn-primary {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        .quiz-btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .quiz-side-card {
            padding: 18px 16px 20px;
            min-height: 620px;
        }

        .quiz-side-card h3 {
            margin: 4px 0 18px;
            text-align: center;
            color: var(--text);
            font-size: 1.4rem;
            font-weight: 800;
        }

        .question-number-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }

        .question-number-btn {
            height: 52px;
            border-radius: 14px;
            border: 2px solid var(--border);
            background: #fff;
            color: var(--text);
            font-weight: 800;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .question-number-btn:hover {
            border-color: var(--primary);
            background: var(--primary-soft);
        }

        .question-number-btn.answered {
            background: #f3f7ee;
            border-color: var(--primary);
            color: var(--primary-deep);
        }

        .question-number-btn.active {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
            box-shadow: 0 8px 18px rgba(170, 185, 154, 0.22);
        }

        .question-number-btn.active.answered {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            color: #fff;
        }

        .side-info {
            margin-top: 18px;
            padding: 14px;
            border-radius: 16px;
            background: var(--primary-soft);
            border: 1px dashed var(--primary);
            color: var(--muted);
            font-size: 0.94rem;
            line-height: 1.7;
        }

        .quiz-result-card {
            display: none;
            margin-top: 24px;
            padding: 28px;
        }

        .quiz-result-card.show {
            display: block;
        }

        .result-top {
            text-align: center;
            margin-bottom: 26px;
        }

        .result-top h3 {
            margin: 0 0 10px;
            color: var(--primary-deep);
            font-size: 2rem;
            font-weight: 800;
        }

        .result-score {
            font-size: 3rem;
            font-weight: 900;
            color: var(--primary-dark);
            margin-bottom: 8px;
        }

        .result-message {
            color: var(--muted);
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 18px;
        }

        .review-list {
            display: grid;
            gap: 14px;
        }

        .review-item {
            padding: 16px 18px;
            border: 1px solid #e4eadc;
            border-radius: 18px;
            background: #fcfdfb;
        }

        .review-item .review-question {
            color: var(--text);
            font-weight: 700;
            line-height: 1.6;
            margin-bottom: 8px;
        }

        .review-item .review-answer {
            color: var(--muted);
            line-height: 1.7;
            font-weight: 500;
        }

        .review-correct {
            color: var(--success);
            font-weight: 800;
        }

        .review-wrong {
            color: var(--danger);
            font-weight: 800;
        }

        .review-pending {
            color: var(--warning);
            font-weight: 800;
        }

        @media (max-width: 992px) {
            .quiz-layout {
                grid-template-columns: 1fr;
            }

            .quiz-side-card {
                min-height: auto;
            }

            .question-number-grid {
                grid-template-columns: repeat(5, 1fr);
            }

            .quiz-main-card {
                min-height: auto;
            }
        }

        @media (max-width: 640px) {
            .quiz-title-group h2 {
                font-size: 1.55rem;
            }

            .question-text {
                font-size: 1.12rem;
                line-height: 1.7;
            }

            .option-text {
                font-size: 0.96rem;
            }

            .question-number-grid {
                grid-template-columns: repeat(4, 1fr);
            }

            .quiz-footer {
                flex-direction: column;
                align-items: stretch;
            }

            .quiz-buttons {
                justify-content: space-between;
            }

            .quiz-timer {
                min-width: 108px;
                height: 60px;
                font-size: 1.25rem;
            }
        }
    </style>

    <div class="quiz-wrapper">
        <div class="quiz-topbar">
            <div class="quiz-title-group">
                <h2>Kuis Bab B</h2>
                <p>Kerjakan semua soal berikut dengan teliti sebelum waktu habis.</p>
            </div>
            <div class="quiz-timer" id="quizTimer">30:00</div>
        </div>

        <div class="quiz-layout">
            <div class="quiz-main-card" id="quizMainCard">
                <div class="quiz-question-area">
                    <div class="question-pill" id="questionPill">Soal 1</div>
                    <div class="question-text" id="questionText"></div>
                    <div class="options-list" id="optionsList"></div>
                </div>

                <div class="quiz-footer">
                    <div class="quiz-progress" id="quizProgress">Soal 1 dari 10</div>
                    <div class="quiz-buttons">
                        <button type="button" class="quiz-btn" id="prevBtn">‹</button>
                        <button type="button" class="quiz-btn quiz-btn-primary" id="nextBtn">›</button>
                    </div>
                </div>
            </div>

            <div class="quiz-side-card" id="quizSideCard">
                <h3>Nomor Soal</h3>
                <div class="question-number-grid" id="questionNumberGrid"></div>
                <div class="side-info">
                    Klik nomor soal untuk berpindah.<br>
                    Kotak hijau menunjukkan soal aktif atau yang sudah dijawab.
                </div>
            </div>
        </div>

        <div class="quiz-result-card" id="quizResultCard">
            <div class="result-top">
                <h3>Hasil Kuis</h3>
                <div class="result-score" id="resultScore">0/10</div>
                <div class="result-message" id="resultMessage"></div>
                <button type="button" class="quiz-btn quiz-btn-primary" id="retryBtn" style="min-width: 170px; padding: 0 18px;">
                    Ulangi Kuis
                </button>
            </div>

            <div class="review-list" id="reviewList"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const questions = [
                {
                    question: 'Pasangan suku berikut yang merupakan <strong>suku sejenis</strong> adalah ...',
                    options: [
                        '3x<sup>2</sup> dan 3x',
                        '5x dan 7y',
                        '4x<sup>3</sup> dan 4x<sup>2</sup>',
                        '2x dan 9x',
                        '6y<sup>2</sup> dan 6xy'
                    ],
                    answer: 3
                },
                {
                    question: 'Koefisien suku <strong>x<sup>2</sup></strong> pada polinomial <strong>(2x<sup>2</sup> + 3x − 1)</strong> adalah ...',
                    options: ['1', '2', '3', '4', '-2'],
                    answer: 1
                },
                {
                    question: 'Hasil dari <strong>(4x<sup>2</sup> + 2x − 5) + (3x<sup>2</sup> − x + 1)</strong> adalah ...',
                    options: [
                        '7x<sup>2</sup> + x − 4',
                        '4x<sup>2</sup> + x + 6',
                        'x<sup>2</sup> + 3x − 4',
                        '7x<sup>2</sup> − 3x + 4',
                        '3x<sup>2</sup> + x + 1'
                    ],
                    answer: 0
                },
                {
                    question: 'Hasil dari <strong>(6x − 4) − (2x + 7)</strong> adalah ...',
                    options: [
                        '4x + 3',
                        '8x − 11',
                        '4x − 11',
                        '6x − 11',
                        '2x − 4'
                    ],
                    answer: 2
                },
                {
                    question: 'Hasil dari <strong>(7x<sup>2</sup> − 3x + 1) − (4x<sup>2</sup> + 5x − 2)</strong> adalah ...',
                    options: [
                        '3x<sup>2</sup> + 2x − 3',
                        '3x<sup>2</sup> − 8x + 3',
                        '11x<sup>2</sup> − 8x + 3',
                        '3x<sup>2</sup> + 8x − 3',
                        '11x<sup>2</sup> + 8x − 2'
                    ],
                    answer: 1
                },
                {
                    question: 'Hasil dari perkalian <strong>(2x − 3)(x + 4)</strong> adalah ...',
                    options: [
                        '2x<sup>2</sup> + 5x − 12',
                        '2x<sup>2</sup> + 8x − 3',
                        '2x<sup>2</sup> + 5x + 12',
                        '2x<sup>2</sup> + 13x − 12',
                        '2x<sup>2</sup> − 8x − 3'
                    ],
                    answer: 0
                },
                {
                    question: 'Pada operasi <strong>(3x<sup>2</sup> − x + 4) − (x<sup>2</sup> + 5x − 6)</strong>, suku yang menghasilkan nilai paling negatif setelah dikurangkan adalah ...',
                    options: [
                        '3x<sup>2</sup> − x<sup>2</sup>',
                        '−x − 5x',
                        '4 − (−6)',
                        'Semua suku bernilai sama',
                        'Tidak ada suku negatif'
                    ],
                    answer: 1
                },
                {
                    question: 'Dari operasi perkalian <strong>(x + 5)(x − 2)</strong>, pernyataan yang benar adalah ...',
                    options: [
                        'Hasilnya memiliki empat suku',
                        'Tidak ada suku konstanta',
                        'Suku x berasal dari dua operasi penjumlahan',
                        'Suku −10 berasal dari 5 × (−2)',
                        'Suku x<sup>2</sup> berasal dari 5 × (−2)'
                    ],
                    answer: 3
                },
                {
                    question: 'Pernyataan berikut yang benar mengenai penjumlahan <strong>(2x<sup>2</sup> − 4x + 3) + (x<sup>2</sup> + 7x − 5)</strong> adalah ...',
                    options: [
                        'Koefisien x meningkat menjadi 5',
                        'Suku konstanta menjadi negatif',
                        'Hasil akhirnya berderajat 3',
                        'Koefisien x<sup>2</sup> menjadi 3',
                        'Koefisien x menjadi positif'
                    ],
                    answer: 3
                },
                {
                    question: 'Diketahui polinomial <strong>P(x) = 2x<sup>3</sup> + 7x<sup>2</sup> − 11x − 6</strong>. Pasangan polinomial yang jika dikalikan dapat menghasilkan <strong>P(x)</strong> adalah ...',
                    options: [
                        '(2x − 3)(x<sup>2</sup> + 2x + 2)',
                        '(2x + 1)(x<sup>2</sup> + 3x − 6)',
                        '(x − 2)(2x<sup>2</sup> + 9x + 3)',
                        '(2x + 3)(x<sup>2</sup> + x − 2)',
                        '(x + 1)(2x<sup>2</sup> + 5x − 6)'
                    ],
                    answer: null
                }
            ];

            const letters = ['A', 'B', 'C', 'D', 'E'];
            const totalQuestions = questions.length;
            const initialTime = 30 * 60;

            let currentQuestion = 0;
            let userAnswers = new Array(totalQuestions).fill(null);
            let timeLeft = initialTime;
            let timerInterval = null;
            let isFinished = false;

            const questionPill = document.getElementById('questionPill');
            const questionText = document.getElementById('questionText');
            const optionsList = document.getElementById('optionsList');
            const quizProgress = document.getElementById('quizProgress');
            const questionNumberGrid = document.getElementById('questionNumberGrid');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const quizTimer = document.getElementById('quizTimer');
            const quizMainCard = document.getElementById('quizMainCard');
            const quizSideCard = document.getElementById('quizSideCard');
            const quizResultCard = document.getElementById('quizResultCard');
            const resultScore = document.getElementById('resultScore');
            const resultMessage = document.getElementById('resultMessage');
            const reviewList = document.getElementById('reviewList');
            const retryBtn = document.getElementById('retryBtn');

            function renderQuestion() {
                const questionData = questions[currentQuestion];

                questionPill.textContent = `Soal ${currentQuestion + 1}`;
                questionText.innerHTML = questionData.question;
                quizProgress.textContent = `Soal ${currentQuestion + 1} dari ${totalQuestions}`;

                optionsList.innerHTML = '';

                questionData.options.forEach((option, index) => {
                    const item = document.createElement('div');
                    item.className = 'option-item';

                    const checked = userAnswers[currentQuestion] === index ? 'checked' : '';

                    item.innerHTML = `
                        <input type="radio" name="quiz_option" id="option_${index}" value="${index}" ${checked}>
                        <label class="option-label" for="option_${index}">
                            <span class="option-badge">${letters[index]}</span>
                            <span class="option-text">${option}</span>
                        </label>
                    `;

                    optionsList.appendChild(item);
                });

                document.querySelectorAll('input[name="quiz_option"]').forEach((input) => {
                    input.addEventListener('change', function () {
                        userAnswers[currentQuestion] = Number(this.value);
                        renderQuestionNumbers();
                    });
                });

                prevBtn.style.visibility = currentQuestion === 0 ? 'hidden' : 'visible';

                if (currentQuestion === totalQuestions - 1) {
                    nextBtn.textContent = '✓';
                    nextBtn.title = 'Selesai';
                } else {
                    nextBtn.textContent = '›';
                    nextBtn.title = 'Soal berikutnya';
                }
            }

            function renderQuestionNumbers() {
                questionNumberGrid.innerHTML = '';

                questions.forEach((_, index) => {
                    const button = document.createElement('button');
                    button.type = 'button';
                    button.className = 'question-number-btn';
                    button.textContent = index + 1;

                    if (userAnswers[index] !== null) {
                        button.classList.add('answered');
                    }

                    if (index === currentQuestion) {
                        button.classList.add('active');
                    }

                    button.addEventListener('click', function () {
                        currentQuestion = index;
                        renderQuestion();
                        renderQuestionNumbers();
                    });

                    questionNumberGrid.appendChild(button);
                });
            }

            function updateTimer() {
                const minutes = String(Math.floor(timeLeft / 60)).padStart(2, '0');
                const seconds = String(timeLeft % 60).padStart(2, '0');
                quizTimer.textContent = `${minutes}:${seconds}`;

                if (timeLeft <= 300) {
                    quizTimer.style.borderColor = '#d9a4a4';
                    quizTimer.style.color = '#b85d5d';
                } else {
                    quizTimer.style.borderColor = 'var(--primary)';
                    quizTimer.style.color = 'var(--primary-deep)';
                }

                if (timeLeft <= 0) {
                    finishQuiz();
                    return;
                }

                timeLeft--;
            }

            function calculateScore() {
                let score = 0;
                questions.forEach((question, index) => {
                    if (question.answer !== null && userAnswers[index] === question.answer) {
                        score++;
                    }
                });
                return score;
            }

            function countScoredQuestions() {
                return questions.filter(q => q.answer !== null).length;
            }

            function stripHtml(html) {
                const temp = document.createElement('div');
                temp.innerHTML = html;
                return temp.textContent || temp.innerText || '';
            }

            function finishQuiz() {
                if (isFinished) return;

                isFinished = true;
                clearInterval(timerInterval);

                const score = calculateScore();
                const scoredQuestions = countScoredQuestions();

                quizMainCard.style.display = 'none';
                quizSideCard.style.display = 'none';
                quizResultCard.classList.add('show');

                resultScore.textContent = `${score}/${scoredQuestions}`;

                if (score === scoredQuestions) {
                    resultMessage.textContent = 'Hebat sekali, semua soal yang memiliki kunci terjawab benar.';
                } else if (score >= 7) {
                    resultMessage.textContent = 'Bagus, pemahamanmu sudah sangat baik.';
                } else if (score >= 5) {
                    resultMessage.textContent = 'Cukup baik, tetap semangat berlatih.';
                } else {
                    resultMessage.textContent = 'Ayo latihan lagi supaya hasilnya lebih maksimal.';
                }

                reviewList.innerHTML = '';

                questions.forEach((question, index) => {
                    const userAnswerIndex = userAnswers[index];
                    const correctAnswerIndex = question.answer;
                    let answerStatusHtml = '';
                    let correctAnswerHtml = '';

                    if (correctAnswerIndex === null) {
                        answerStatusHtml = `
                            <div class="review-answer">
                                Jawaban kamu:
                                <span class="review-pending">
                                    ${userAnswerIndex !== null ? `${letters[userAnswerIndex]}. ${stripHtml(question.options[userAnswerIndex])}` : 'Belum dijawab'}
                                </span>
                            </div>
                        `;
                        correctAnswerHtml = `
                            <div class="review-answer">
                                Kunci jawaban:
                                <span class="review-pending">Perlu dicek manual (opsi pada gambar tidak konsisten)</span>
                            </div>
                        `;
                    } else {
                        const isCorrect = userAnswerIndex === correctAnswerIndex;

                        answerStatusHtml = `
                            <div class="review-answer">
                                Jawaban kamu:
                                <span class="${isCorrect ? 'review-correct' : 'review-wrong'}">
                                    ${userAnswerIndex !== null ? `${letters[userAnswerIndex]}. ${stripHtml(question.options[userAnswerIndex])}` : 'Belum dijawab'}
                                </span>
                            </div>
                        `;

                        correctAnswerHtml = `
                            <div class="review-answer">
                                Jawaban benar:
                                <span class="review-correct">
                                    ${letters[correctAnswerIndex]}. ${stripHtml(question.options[correctAnswerIndex])}
                                </span>
                            </div>
                        `;
                    }

                    const reviewItem = document.createElement('div');
                    reviewItem.className = 'review-item';
                    reviewItem.innerHTML = `
                        <div class="review-question">Soal ${index + 1}: ${stripHtml(question.question)}</div>
                        ${answerStatusHtml}
                        ${correctAnswerHtml}
                    `;

                    reviewList.appendChild(reviewItem);
                });
            }

            function resetQuiz() {
                currentQuestion = 0;
                userAnswers = new Array(totalQuestions).fill(null);
                timeLeft = initialTime;
                isFinished = false;

                quizMainCard.style.display = 'flex';
                quizSideCard.style.display = 'block';
                quizResultCard.classList.remove('show');

                renderQuestion();
                renderQuestionNumbers();
                updateTimer();

                clearInterval(timerInterval);
                timerInterval = setInterval(updateTimer, 1000);
            }

            prevBtn.addEventListener('click', function () {
                if (currentQuestion > 0) {
                    currentQuestion--;
                    renderQuestion();
                    renderQuestionNumbers();
                }
            });

            nextBtn.addEventListener('click', function () {
                if (currentQuestion < totalQuestions - 1) {
                    currentQuestion++;
                    renderQuestion();
                    renderQuestionNumbers();
                } else {
                    finishQuiz();
                }
            });

            retryBtn.addEventListener('click', function () {
                resetQuiz();
            });

            renderQuestion();
            renderQuestionNumbers();
            updateTimer();
            timerInterval = setInterval(updateTimer, 1000);
        });
    </script>
@endsection

@section('nav')
    <a href="{{ route('perkalianpolinomial') }}" class="btn-nav prev-btn">
        ← Previous
    </a>

    <a href="{{ route('pembagianbersusun') }}" class="btn-nav next-btn">
        Next →
    </a>
@endsection