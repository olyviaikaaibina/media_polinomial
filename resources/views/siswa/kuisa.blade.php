@extends('layout.halamanmateri')

@section('content')
    <style>
        :root {
            --primary: #AAB99A;
            --primary-dark: #8c9b7c;
            --primary-deep: #748564;
            --primary-soft: #f5f8f1;
            --primary-soft-2: #eef3e7;
            --border: #cfd8c3;
            --text: #2f3a2b;
            --muted: #6f7b67;
            --white: #ffffff;
            --danger: #dc6b6b;
            --success: #5f8b56;
            --shadow: 0 14px 35px rgba(170, 185, 154, 0.16);
            --radius-xl: 28px;
            --radius-lg: 20px;
            --radius-md: 16px;
            --radius-sm: 12px;
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
            letter-spacing: 0.2px;
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
            font-size: 1.5rem;
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
            font-size: 1.08rem;
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
                font-size: 1.15rem;
                line-height: 1.7;
            }

            .option-text {
                font-size: 0.98rem;
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
                <h2>Kuis Bab A</h2>
                <p>Jawablah semua pertanyaan dengan teliti sebelum waktu habis.</p>
            </div>
            <div class="quiz-timer" id="quizTimer">30:00</div>
        </div>

        <div class="quiz-layout" id="quizLayout">
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
                    Pilih nomor soal untuk berpindah.<br>
                    Kotak berwarna menunjukkan soal yang sedang aktif atau sudah dijawab.
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
                    question: 'Berapakah derajat dari polinomial <strong>P(x) = 8x<sup>5</sup> - 3x<sup>3</sup> + 7x - 9</strong>?',
                    options: ['1', '3', '5', '7', '9'],
                    answer: 2
                },
                {
                    question: 'Yang termasuk monomial adalah ...',
                    options: ['3x<sup>2</sup> - 7y', '9x<sup>3</sup>', '5x + 8', '-7 + x', '4x<sup>2</sup> - 4'],
                    answer: 1
                },
                {
                    question: 'Berapa jumlah suku pada polinomial <strong>Q(x, y) = 4x<sup>3</sup>y<sup>2</sup> - 6xy + 2y<sup>4</sup> + 7</strong>?',
                    options: ['1', '2', '3', '4', '5'],
                    answer: 3
                },
                {
                    question: 'Suku utama dari fungsi <strong>f(x) = 3x<sup>7</sup> - 5x<sup>4</sup> + x</strong> adalah ...',
                    options: ['x', '-5x<sup>4</sup>', '3x<sup>7</sup>', '3', '-5'],
                    answer: 2
                },
                {
                    question: 'Perilaku ujung grafik fungsi <strong>g(x) = -2x<sup>8</sup> + 4x<sup>3</sup> - 1</strong> adalah ...',
                    options: ['kiri naik, kanan naik', 'kiri turun, kanan naik', 'kiri naik, kanan turun', 'kiri turun, kanan turun'],
                    answer: 3
                },
                {
                    question: 'Pernyataan yang benar dari fungsi <strong>h(x) = 5x<sup>6</sup> - 2x<sup>2</sup> + 1</strong> adalah ...',
                    options: [
                        'Derajat = 2, suku utama = 5x<sup>2</sup>',
                        'Derajat = 6, koefisien utama negatif',
                        'Derajat = 6, perilaku ujung kiri ↑, kanan ↑',
                        'Derajat = 5, perilaku ujung kiri ↑, kanan ↓',
                        'Tidak memiliki suku utama'
                    ],
                    answer: 2
                },
                {
                    question: 'Diketahui sebuah grafik polinomial memiliki perilaku ujung kiri turun dan ujung kanan naik. Fungsi berikut yang sesuai adalah ...',
                    options: [
                        '2x<sup>4</sup> - 3x<sup>2</sup> + 1',
                        '-x<sup>6</sup> + 2x<sup>2</sup> - 1',
                        'x<sup>3</sup> - 4x + 2',
                        '-3x<sup>8</sup> + x',
                        '5x<sup>10</sup> - 2x<sup>3</sup>'
                    ],
                    answer: 2
                },
                {
                    question: 'Sebuah grafik menunjukkan parabola terbuka ke bawah dan memotong sumbu-y di titik <strong>(0, 5)</strong>. Fungsi yang mungkin adalah ...',
                    options: ['x<sup>2</sup> + 5', '-x<sup>2</sup> + 5', '2x<sup>2</sup> - 5', '-3x<sup>2</sup> - 5', '5x - 1'],
                    answer: 1
                },
                {
                    question: 'Fungsi polinomial derajat 4 yang benar adalah ...',
                    options: [
                        '2x<sup>4</sup> - x + 7',
                        '1 / x<sup>4</sup> + 3x',
                        '7x<sup>1/2</sup> + 1',
                        '5x<sup>3</sup> + x<sup>-1</sup>',
                        '√x + 4'
                    ],
                    answer: 0
                },
                {
                    question: 'Sebuah grafik polinomial memiliki ciri: ujung kiri naik, ujung kanan naik, dan terdapat dua titik belok. Fungsi yang sesuai adalah ...',
                    options: [
                        '3x<sup>3</sup> - x',
                        '-2x<sup>6</sup> + x<sup>2</sup>',
                        'x<sup>4</sup> - 3x<sup>2</sup> + 1',
                        '2x<sup>5</sup> - x',
                        '-x<sup>2</sup> + 4'
                    ],
                    answer: 2
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
                    if (userAnswers[index] === question.answer) {
                        score++;
                    }
                });
                return score;
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

                quizMainCard.style.display = 'none';
                quizSideCard.style.display = 'none';
                quizResultCard.classList.add('show');

                resultScore.textContent = `${score}/${totalQuestions}`;

                if (score === totalQuestions) {
                    resultMessage.textContent = 'Hebat sekali, semua jawabanmu benar.';
                } else if (score >= 8) {
                    resultMessage.textContent = 'Bagus, pemahamanmu sudah sangat baik.';
                } else if (score >= 6) {
                    resultMessage.textContent = 'Cukup baik, tetap semangat berlatih.';
                } else {
                    resultMessage.textContent = 'Ayo latihan lagi supaya hasilnya lebih maksimal.';
                }

                reviewList.innerHTML = '';

                questions.forEach((question, index) => {
                    const userAnswerIndex = userAnswers[index];
                    const correctAnswerIndex = question.answer;
                    const isCorrect = userAnswerIndex === correctAnswerIndex;

                    const reviewItem = document.createElement('div');
                    reviewItem.className = 'review-item';

                    reviewItem.innerHTML = `
                        <div class="review-question">Soal ${index + 1}: ${stripHtml(question.question)}</div>
                        <div class="review-answer">
                            Jawaban kamu:
                            <span class="${isCorrect ? 'review-correct' : 'review-wrong'}">
                                ${userAnswerIndex !== null ? `${letters[userAnswerIndex]}. ${stripHtml(question.options[userAnswerIndex])}` : 'Belum dijawab'}
                            </span>
                        </div>
                        <div class="review-answer">
                            Jawaban benar:
                            <span class="review-correct">
                                ${letters[correctAnswerIndex]}. ${stripHtml(question.options[correctAnswerIndex])}
                            </span>
                        </div>
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
    <a href="{{ route('fungsipolinomialdangrafiknya') }}" class="btn-nav prev-btn">
        ← Previous
    </a>

    <a href="{{ route('penjumlahanpolinomial') }}" class="btn-nav next-btn">
        Next →
    </a>
@endsection