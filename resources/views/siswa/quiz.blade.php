<!DOCTYPE html>
<html lang="id">

<head>
    <!-- KaTeX -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css">

    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/contrib/auto-render.min.js" onload="renderMathInElement(document.body, {
        delimiters: [
            {left: '$$', right: '$$', display: true},
            {left: '$', right: '$', display: false}
        ]
    });">
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $quiz->title ?? 'Kuis Siswa' }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg-main: #f7f7f1;
            --bg-soft: #f3f2e8;
            --card: #ffffff;
            --line: #d8dec8;
            --line-soft: #e6ead9;

            --primary: #aab88d;
            --primary-dark: #7f8d65;
            --primary-text: #5f6d49;

            --text-main: #2d3426;
            --text-soft: #74806a;

            --answered: #aab88d;
            --active: #dfe7cf;
            --hover: #f6f8ef;

            --danger: #c77b7b;
            --shadow: 0 10px 25px rgba(92, 108, 71, 0.08);

            --radius-xl: 24px;
            --radius-lg: 18px;
            --radius-md: 14px;
            --radius-sm: 10px;
        }

        body {
            font-family: 'Quicksand', sans-serif;
            background: var(--bg-main);
            color: var(--text-main);
        }

        .quiz-page {
            min-height: 100vh;
            padding: 22px;
            background: linear-gradient(to bottom, #f9f9f4 0%, #f3f2e8 100%);
        }

        .quiz-wrapper {
            max-width: 1220px;
            margin: 0 auto;
            background: #f8f8f2;
            border: 1px solid #ecebdd;
            border-radius: 22px;
            padding: 28px;
        }

        .quiz-topbar {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }

        .quiz-title-area h1 {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary-text);
            margin-bottom: 4px;
        }

        .quiz-desc {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-soft);
        }

        .timer-box {
            min-width: 98px;
            padding: 10px 18px;
            border-radius: 999px;
            border: 2px solid var(--primary);
            background: #fbfcf7;
            color: var(--primary-text);
            text-align: center;
            box-shadow: var(--shadow);
        }

        .timer-box span {
            display: none;
        }

        #timer {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .quiz-content {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 280px;
            gap: 18px;
            align-items: start;
        }

        .question-panel {
            background: var(--card);
            border: 1.5px solid var(--line);
            border-radius: var(--radius-xl);
            padding: 18px;
            box-shadow: var(--shadow);
        }

        .question-slide {
            display: none;
        }

        .question-slide.active {
            display: block;
        }

        .question-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
        }

        .question-meta span:first-child {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--primary);
            color: white;
            font-size: 13px;
            font-weight: 700;
            padding: 9px 18px;
            border-radius: 999px;
        }

        .question-meta span:last-child {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-soft);
        }

        .question-card {
            background: transparent;
        }

        .question-text {
            font-size: 20px;
            line-height: 1.6;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 16px;
        }

        .question-image {
            margin-bottom: 16px;
        }

        .question-image img {
            max-width: 100%;
            border-radius: 16px;
            border: 1px solid var(--line-soft);
        }

        .options {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .option-item {
            display: block;
            border: 1.5px solid var(--line);
            border-radius: 16px;
            background: #fff;
            cursor: pointer;
            transition: 0.2s ease;
            overflow: hidden;
        }

        .option-item:hover {
            border-color: var(--primary);
            background: var(--hover);
        }

        .option-item.selected {
            border-color: var(--primary-dark);
            background: #fbfcf6;
        }

        .option-item input {
            display: none;
        }

        .option-content {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 14px;
        }

        .option-label {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #edf1e4;
            border: 1.5px solid #cad3bb;
            color: #6d7a58;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }

        .option-item.selected .option-label {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .option-text {
            font-size: 16px;
            font-weight: 700;
            color: #33412b;
        }

        .question-actions {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-top: 22px;
            flex-wrap: wrap;
        }

        .nav-btn,
        .submit-btn {
            border: none;
            border-radius: 14px;
            padding: 12px 18px;
            font-family: 'Quicksand', sans-serif;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .nav-btn {
            background: #edf1e4;
            color: #536248;
            border: 1px solid #d8deca;
        }

        .nav-btn:hover {
            background: #e4ead8;
        }

        .nav-btn.primary {
            background: var(--primary);
            color: white;
            border: 1px solid var(--primary);
        }

        .nav-btn.primary:hover {
            background: var(--primary-dark);
        }

        .submit-section {
            margin-top: 14px;
        }

        .submit-btn {
            width: 100%;
            background: var(--primary);
            color: white;
            padding: 14px 20px;
            border-radius: 16px;
        }

        .submit-btn:hover {
            background: var(--primary-dark);
        }

        .navigator-panel {
            position: sticky;
            top: 20px;
        }

        .navigator-card {
            background: var(--card);
            border: 1.5px solid var(--line);
            border-radius: var(--radius-xl);
            padding: 18px;
            box-shadow: var(--shadow);
        }

        .navigator-card h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 6px;
            color: var(--text-main);
        }

        .navigator-card p {
            font-size: 13px;
            line-height: 1.6;
            color: var(--text-soft);
            margin-bottom: 14px;
        }

        .numbers {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .num {
            height: 42px;
            border-radius: 12px;
            border: 1.5px solid #d7ddca;
            background: white;
            color: #34412b;
            font-family: 'Quicksand', sans-serif;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .num:hover {
            border-color: var(--primary);
            transform: translateY(-1px);
        }

        .num.active {
            background: var(--active);
            border-color: var(--primary-dark);
            color: #2d3826;
        }

        .num.answered {
            background: var(--answered);
            border-color: var(--answered);
            color: white;
        }

        .num.active.answered {
            box-shadow: inset 0 0 0 2px #6f7d58;
        }

        .legend {
            margin-top: 16px;
            padding: 14px;
            border-radius: 16px;
            border: 1.5px dashed #cfd8bb;
            background: #fcfdf8;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 600;
            color: #617050;
            margin-bottom: 8px;
        }

        .legend-item:last-child {
            margin-bottom: 0;
        }

        .legend-dot {
            width: 18px;
            height: 18px;
            border-radius: 6px;
            border: 1.5px solid #cfd6c0;
            flex-shrink: 0;
        }

        .active-dot {
            background: var(--active);
            border-color: var(--primary-dark);
        }

        .answered-dot {
            background: var(--answered);
            border-color: var(--answered);
        }

        .unanswered-dot {
            background: white;
            border-color: #cfd6c0;
        }

        .empty-question {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-soft);
            font-weight: 700;
        }

        @media (max-width: 1024px) {
            .quiz-content {
                grid-template-columns: 1fr;
            }

            .navigator-panel {
                position: static;
            }
        }

        @media (max-width: 640px) {
            .quiz-page {
                padding: 12px;
            }

            .quiz-wrapper {
                padding: 14px;
            }

            .question-panel,
            .navigator-card {
                padding: 14px;
            }

            .question-text {
                font-size: 17px;
            }

            #timer {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>
    <div class="quiz-page">
        <div class="quiz-wrapper">
            <div class="quiz-topbar">
                <div class="quiz-title-area">
                    <h1>{{ $quiz->title ?? 'Kuis' }}</h1>
                    <p class="quiz-desc">
                        Kerjakan semua soal dengan teliti sebelum waktu habis.
                    </p>
                </div>

                <div class="timer-box">
                    <span>Waktu</span>
                    <div id="timer">
                        {{ str_pad(($quiz->duration_minutes ?? 30), 2, '0', STR_PAD_LEFT) }}:00
                    </div>
                </div>
            </div>

            <form action="{{ route('quiz.submit', $quiz->id) }}" method="POST" id="quizForm">
                @csrf

                @if(isset($attempt))
                    <input type="hidden" name="attempt_id" value="{{ $attempt->id }}">
                @endif

                <div class="quiz-content">
                    <div class="question-panel">
                        @forelse ($quiz->questions as $index => $question)
                            <div class="question-slide {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}">
                                <div class="question-meta">
                                    <span>Soal {{ $question->question_order ?? ($index + 1) }}</span>
                                    <span>{{ $index + 1 }} / {{ $quiz->questions->count() }}</span>
                                </div>

                                <div class="question-card">
                                    <div class="question-text">
                                        {!! $question->question_text !!}
                                    </div>

                                    @if(!empty($question->question_image))
                                        <div class="question-image">
                                            <img src="{{ asset('storage/' . $question->question_image) }}" alt="Gambar soal">
                                        </div>
                                    @endif

                                    <div class="options">
                                        @foreach ($question->options as $option)
                                            <label class="option-item">
                                                <input type="radio" name="jawaban[{{ $question->id }}]"
                                                    value="{{ $option->id }}">
                                                <div class="option-content">
                                                    <span class="option-label">{{ $option->option_label ?? '?' }}</span>
                                                    <span class="option-text">{!! $option->option_text !!}</span>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="empty-question">
                                Belum ada soal untuk kuis ini.
                            </div>
                        @endforelse

                        @if ($quiz->questions->count())
                            <div class="question-actions">
                                <button type="button" class="nav-btn" id="prevBtn">← Sebelumnya</button>
                                <button type="button" class="nav-btn primary" id="nextBtn">Berikutnya →</button>
                            </div>

                            <div class="submit-section" id="submitSection" style="display: none;">
                                <button type="submit" class="submit-btn">
                                    Kumpulkan Jawaban
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="navigator-panel">
                        <div class="navigator-card">
                            <h3>Nomor Soal</h3>
                            <p>Pilih nomor soal untuk berpindah.</p>

                            <div class="numbers">
                                @foreach ($quiz->questions as $index => $item)
                                    <button type="button" class="num {{ $index === 0 ? 'active' : '' }}"
                                        data-index="{{ $index }}">
                                        {{ $item->question_order ?? ($index + 1) }}
                                    </button>
                                @endforeach
                            </div>

                            <div class="legend">
                                <div class="legend-item">
                                    <span class="legend-dot active-dot"></span>
                                    <span>Sedang dibuka</span>
                                </div>
                                <div class="legend-item">
                                    <span class="legend-dot answered-dot"></span>
                                    <span>Sudah dijawab</span>
                                </div>
                                <div class="legend-item">
                                    <span class="legend-dot unanswered-dot"></span>
                                    <span>Belum dijawab</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slides = document.querySelectorAll('.question-slide');
            const navButtons = document.querySelectorAll('.num');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const submitSection = document.getElementById('submitSection');
            const quizForm = document.getElementById('quizForm');
            const timerElement = document.getElementById('timer');

            let currentIndex = 0;
            let totalSeconds = quizForm ? Number(quizForm.dataset.duration || 1800) : 1800;
            let interval = null;

            function updateAnsweredStatus() {
                slides.forEach(function (slide, index) {
                    const checked = slide.querySelector('input[type="radio"]:checked');

                    if (navButtons[index]) {
                        navButtons[index].classList.remove('answered');

                        if (checked) {
                            navButtons[index].classList.add('answered');
                        }
                    }
                });

                document.querySelectorAll('.option-item').forEach(function (item) {
                    item.classList.remove('selected');
                });

                document.querySelectorAll('input[type="radio"]:checked').forEach(function (input) {
                    const wrapper = input.closest('.option-item');
                    if (wrapper) {
                        wrapper.classList.add('selected');
                    }
                });

                if (navButtons[currentIndex]) {
                    navButtons[currentIndex].classList.add('active');
                }
            }

            function showSlide(index) {
                slides.forEach(function (slide) {
                    slide.classList.remove('active');
                });

                navButtons.forEach(function (btn) {
                    btn.classList.remove('active');
                });

                if (slides[index]) {
                    slides[index].classList.add('active');

                    if (navButtons[index]) {
                        navButtons[index].classList.add('active');
                    }

                    currentIndex = index;
                }

                if (prevBtn) {
                    prevBtn.style.visibility = currentIndex === 0 ? 'hidden' : 'visible';
                }

                if (nextBtn) {
                    nextBtn.style.display = currentIndex === slides.length - 1 ? 'none' : 'inline-flex';
                }

                if (submitSection) {
                    submitSection.style.display = currentIndex === slides.length - 1 ? 'block' : 'none';
                }

                updateAnsweredStatus();
            }

            function updateTimer() {
                const minutes = String(Math.floor(totalSeconds / 60)).padStart(2, '0');
                const seconds = String(totalSeconds % 60).padStart(2, '0');

                if (timerElement) {
                    timerElement.textContent = minutes + ':' + seconds;
                }

                if (totalSeconds <= 0) {
                    if (interval) {
                        clearInterval(interval);
                    }

                    alert('Waktu habis. Jawaban akan dikumpulkan otomatis.');

                    if (quizForm) {
                        quizForm.submit();
                    }
                    return;
                }

                if (totalSeconds <= 300 && timerElement && timerElement.parentElement) {
                    timerElement.parentElement.style.borderColor = '#c77b7b';
                    timerElement.parentElement.style.color = '#b86464';
                }

                totalSeconds--;
            }

            if (prevBtn) {
                prevBtn.addEventListener('click', function () {
                    if (currentIndex > 0) {
                        showSlide(currentIndex - 1);
                    }
                });
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', function () {
                    if (currentIndex < slides.length - 1) {
                        showSlide(currentIndex + 1);
                    }
                });
            }

            navButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    const index = parseInt(this.dataset.index, 10);
                    if (!isNaN(index)) {
                        showSlide(index);
                    }
                });
            });

            document.querySelectorAll('input[type="radio"]').forEach(function (input) {
                input.addEventListener('change', function () {
                    updateAnsweredStatus();
                });
            });

            if (slides.length > 0) {
                showSlide(0);
                updateTimer();
                interval = setInterval(updateTimer, 1000);
            }
        });
    </script>
</body>

</html>