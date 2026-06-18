<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/contrib/auto-render.min.js" onload="renderMathInElement(document.body, {
        delimiters: [
            {left: '$$', right: '$$', display: true},
            {left: '$', right: '$', display: false}
        ]
    });"></script>

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

            --warning: #e7b94d;
            --warning-soft: #fff6d8;

            --shadow: 0 8px 20px rgba(92, 108, 71, 0.08);
        }

        body {
            font-family: 'Quicksand', sans-serif;
            background: var(--bg-main);
            color: var(--text-main);
            overflow: hidden;
        }

        .quiz-page {
            height: 100vh;
            padding: 10px;
            background: linear-gradient(to bottom, #f9f9f4 0%, #f3f2e8 100%);
            overflow: hidden;
        }

        .quiz-wrapper {
            max-width: 1220px;
            height: calc(100vh - 20px);
            margin: 0 auto;
            padding: 14px;
            background: #f8f8f2;
            border: 1px solid #ecebdd;
            border-radius: 22px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .quiz-topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            margin-bottom: 10px;
            flex-shrink: 0;
        }

        .quiz-title-area h1 {
            font-size: 18px;
            font-weight: 800;
            color: var(--primary-text);
            margin-bottom: 2px;
            line-height: 1.3;
        }

        .quiz-desc {
            font-size: 12.5px;
            line-height: 1.45;
            font-weight: 600;
            color: var(--text-soft);
        }

        .timer-box {
            min-width: 92px;
            padding: 6px 14px;
            border-radius: 999px;
            border: 2px solid var(--primary);
            background: #fbfcf7;
            color: var(--primary-text);
            text-align: center;
            box-shadow: var(--shadow);
            flex-shrink: 0;
        }

        #timer {
            font-size: 22px;
            font-weight: 800;
            letter-spacing: 0.4px;
            line-height: 1.2;
        }

        #quizForm {
            flex: 1;
            min-height: 0;
        }

        .quiz-content {
            height: 100%;
            min-height: 0;
            display: grid;
            grid-template-columns: minmax(0, 1fr) 260px;
            gap: 14px;
            overflow: hidden;
        }

        .question-panel {
            min-height: 0;
            padding: 12px;
            background: var(--card);
            border: 1.5px solid var(--line);
            border-radius: 22px;
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .question-slide {
            display: none;
            flex: 1;
            min-height: 0;
        }

        .question-slide.active {
            display: flex;
            flex-direction: column;
        }

        .question-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
            flex-shrink: 0;
        }

        .question-meta-left {
            display: flex;
            align-items: center;
            gap: 9px;
            flex-wrap: wrap;
        }

        .question-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 7px 15px;
            border-radius: 999px;
            background: var(--primary);
            color: #ffffff;
            font-size: 12.5px;
            font-weight: 800;
            white-space: nowrap;
        }

        .question-total {
            font-size: 12.5px;
            font-weight: 700;
            color: var(--text-soft);
            white-space: nowrap;
        }

        .doubt-btn {
            padding: 7px 15px;
            border-radius: 999px;
            border: 1.5px solid #e5c56a;
            background: #fff8dc;
            color: #8a6a0a;
            font-family: inherit;
            font-size: 12.5px;
            font-weight: 800;
            cursor: pointer;
            transition: 0.2s ease;
            white-space: nowrap;
        }

        .doubt-btn:hover {
            background: #fff2bd;
        }

        .doubt-btn.active {
            background: var(--warning);
            border-color: var(--warning);
            color: #ffffff;
        }

        .question-card {
            flex: 1;
            min-height: 0;
            overflow-y: auto;
            padding-right: 4px;
        }

        .question-card::-webkit-scrollbar {
            width: 5px;
        }

        .question-card::-webkit-scrollbar-thumb {
            background: #c8d1b8;
            border-radius: 999px;
        }

        .question-text {
            margin-bottom: 9px;
            font-size: 15.5px;
            line-height: 1.45;
            font-weight: 800;
            color: var(--text-main);
        }

        .question-image {
            margin: 6px 0 9px;
            text-align: center;
        }

        .question-image img {
            max-width: 100%;
            max-height: 140px;
            object-fit: contain;
            border-radius: 14px;
            border: 1px solid var(--line-soft);
        }

        .options {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .option-item {
            display: block;
            background: #ffffff;
            border: 1.5px solid var(--line);
            border-radius: 15px;
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
            min-height: 44px;
            padding: 8px 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .option-label {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: #edf1e4;
            border: 1.5px solid #cad3bb;
            color: #6d7a58;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 800;
            flex-shrink: 0;
        }

        .option-text {
            font-size: 14px;
            line-height: 1.35;
            font-weight: 600;
            color: var(--text-main);
        }

        .option-item.selected .option-label {
            background: var(--primary);
            border-color: var(--primary);
            color: #ffffff;
        }

        .quiz-nav {
            margin-top: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .nav-btn {
            border: none;
            background: var(--primary);
            color: #ffffff;
            padding: 8px 18px;
            border-radius: 999px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .nav-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        .nav-btn:disabled {
            background: #d4dac8;
            cursor: not-allowed;
            transform: none;
        }

        .side-panel {
            min-height: 0;
            padding: 13px;
            background: var(--card);
            border: 1.5px solid var(--line);
            border-radius: 22px;
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .side-title {
            font-size: 16px;
            font-weight: 800;
            color: var(--primary-text);
            text-align: center;
            margin-bottom: 4px;
        }

        .side-desc {
            margin-bottom: 10px;
            font-size: 12px;
            line-height: 1.45;
            font-weight: 600;
            color: var(--text-soft);
            text-align: center;
        }

        .number-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 7px;
            margin-bottom: 10px;
        }

        .number-btn {
            width: 100%;
            height: 34px;
            border: 1.5px solid var(--line);
            background: #ffffff;
            border-radius: 11px;
            color: var(--text-soft);
            font-family: inherit;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .number-btn:hover {
            background: var(--hover);
            border-color: var(--primary);
        }

        .number-btn.active {
            background: var(--active);
            border-color: var(--primary-dark);
            color: var(--primary-text);
        }

        .number-btn.answered {
            background: var(--answered);
            border-color: var(--answered);
            color: #ffffff;
        }

        .number-btn.doubt {
            background: var(--warning-soft);
            border-color: var(--warning);
            color: #8a6a0a;
        }

        .number-btn.answered.doubt {
            background: var(--warning);
            border-color: var(--warning);
            color: #ffffff;
        }

        .number-btn.active.doubt {
            box-shadow: 0 0 0 3px rgba(231, 185, 77, 0.22);
        }

        .legend {
            display: grid;
            grid-template-columns: 1fr;
            gap: 6px;
            padding: 9px;
            border-radius: 14px;
            background: #fbfcf6;
            border: 1px solid var(--line-soft);
            margin-bottom: 10px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 11.5px;
            font-weight: 700;
            color: var(--text-soft);
        }

        .legend-color {
            width: 13px;
            height: 13px;
            border-radius: 5px;
            border: 1px solid var(--line);
            flex-shrink: 0;
        }

        .legend-current {
            background: var(--active);
        }

        .legend-answered {
            background: var(--answered);
            border-color: var(--answered);
        }

        .legend-doubt {
            background: var(--warning);
            border-color: var(--warning);
        }

        .submit-area {
            margin-top: auto;
            padding-top: 9px;
            border-top: 1px solid var(--line-soft);
        }

        .submit-info {
            min-height: 34px;
            margin-bottom: 8px;
            padding: 8px 9px;
            border-radius: 13px;
            background: #f8f5ea;
            color: #746849;
            font-size: 11.8px;
            line-height: 1.4;
            font-weight: 700;
            text-align: center;
        }

        .submit-btn {
            width: 100%;
            border: none;
            background: var(--primary-dark);
            color: #ffffff;
            padding: 10px 14px;
            border-radius: 999px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .submit-btn:hover:not(:disabled) {
            background: #6e7c56;
            transform: translateY(-1px);
        }

        .submit-btn:disabled {
            background: #cfd6c2;
            color: #f7f7f1;
            cursor: not-allowed;
            transform: none;
        }

        .katex {
            font-size: 1em !important;
        }

        .katex-display {
            margin: 0 !important;
        }

        @media (max-width: 992px) {
            body {
                overflow: auto;
            }

            .quiz-page {
                height: auto;
                min-height: 100vh;
                overflow: visible;
            }

            .quiz-wrapper {
                height: auto;
                overflow: visible;
            }

            .quiz-content {
                grid-template-columns: 1fr;
                overflow: visible;
            }

            .question-panel,
            .side-panel,
            .question-card {
                overflow: visible;
            }

            .side-panel {
                order: -1;
            }

            .number-grid {
                grid-template-columns: repeat(10, 1fr);
            }
        }

        @media (max-width: 576px) {
            .quiz-page {
                padding: 8px;
            }

            .quiz-wrapper {
                padding: 12px;
            }

            .quiz-topbar {
                align-items: flex-start;
            }

            .quiz-title-area h1 {
                font-size: 17px;
            }

            .quiz-desc {
                font-size: 12px;
            }

            .timer-box {
                min-width: 86px;
                padding: 6px 10px;
            }

            #timer {
                font-size: 20px;
            }

            .question-panel,
            .side-panel {
                padding: 11px;
            }

            .question-text {
                font-size: 15px;
            }

            .option-content {
                min-height: 42px;
                padding: 8px 10px;
            }

            .option-text {
                font-size: 13.5px;
            }

            .option-label {
                width: 25px;
                height: 25px;
                font-size: 12.5px;
            }

            .number-grid {
                grid-template-columns: repeat(5, 1fr);
            }

            .nav-btn {
                padding: 8px 15px;
                font-size: 12.5px;
            }
        }
    </style>
</head>

<body>
    @php
        $judulQuiz = strtolower($quiz->title ?? '');
        $tipeQuiz = strtolower($quiz->type ?? $quiz->jenis ?? $quiz->tipe ?? '');

        $isEvaluasi = str_contains($judulQuiz, 'evaluasi') || str_contains($tipeQuiz, 'evaluasi');

        $durasiMenit = $isEvaluasi ? 30 : 20;
    @endphp

    <form id="quizForm" method="POST" action="{{ route('quiz.submit', $quiz->id) }}"
        data-duration="{{ $durasiMenit * 60 }}">
        @csrf

        @if(isset($attempt))
            <input type="hidden" name="attempt_id" value="{{ $attempt->id }}">
        @endif

        <input type="hidden" name="time_spent" id="timeSpent" value="0">

        <div class="quiz-page">
            <div class="quiz-wrapper">

                <div class="quiz-topbar">
                    <div class="quiz-title-area">
                        <h1>{{ $quiz->title ?? 'Kuis Siswa' }}</h1>
                    </div>

                    <div id="timer">
                        {{ str_pad($durasiMenit, 2, '0', STR_PAD_LEFT) }}:00
                    </div>
                </div>

                <div class="quiz-content">

                    <div class="question-panel">
                        @foreach ($quiz->questions as $index => $question)
                            @php
                                $questionText = $question->question_text ?? $question->pertanyaan ?? $question->soal ?? '';
                                $questionImage = $question->image ?? $question->gambar ?? null;
                            @endphp

                            <div class="question-slide {{ $index == 0 ? 'active' : '' }}" data-index="{{ $index }}"
                                data-question-id="{{ $question->id }}">

                                <div class="question-meta">
                                    <div class="question-meta-left">
                                        <span class="question-badge">Soal {{ $index + 1 }}</span>
                                        <span class="question-total">
                                            dari {{ $quiz->questions->count() }} soal
                                        </span>
                                    </div>

                                    <button type="button" class="doubt-btn" data-index="{{ $index }}">
                                        Ragu-ragu
                                    </button>
                                </div>

                                <div class="question-card">
                                    <div class="question-text">
                                        {!! $questionText !!}
                                    </div>

                                    @if (!empty($questionImage))
                                        <div class="question-image">
                                            <img src="{{ asset('storage/' . $questionImage) }}" alt="Gambar Soal">
                                        </div>
                                    @endif

                                    <div class="options">
                                        @foreach ($question->options as $optionIndex => $option)
                                            @php
                                                $optionText = $option->option_text ?? $option->teks_opsi ?? $option->text ?? $option->option ?? '';
                                                $optionLabel = ['A', 'B', 'C', 'D', 'E'][$optionIndex] ?? $optionIndex + 1;
                                            @endphp

                                            <label class="option-item">
                                                <input type="radio" name="jawaban[{{ $question->id }}]"
                                                    value="{{ $option->id }}" data-index="{{ $index }}" {{ old('jawaban.' . $question->id) == $option->id ? 'checked' : '' }}>

                                                <div class="option-content">
                                                    <span class="option-label">{{ $optionLabel }}</span>
                                                    <span class="option-text">{!! $optionText !!}</span>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="quiz-nav">
                            <button type="button" class="nav-btn" id="prevBtn">
                                ← Sebelumnya
                            </button>

                            <button type="button" class="nav-btn" id="nextBtn">
                                Berikutnya →
                            </button>
                        </div>
                    </div>

                    <div class="side-panel">
                        <div class="side-title">Nomor Soal</div>
                        <div class="side-desc">
                            Hijau berarti sudah dijawab. Kuning berarti masih ragu-ragu.
                        </div>

                        <div class="number-grid">
                            @foreach ($quiz->questions as $index => $question)
                                <button type="button" class="number-btn {{ $index == 0 ? 'active' : '' }}"
                                    data-index="{{ $index }}">
                                    {{ $index + 1 }}
                                </button>
                            @endforeach
                        </div>

                        <div class="legend">
                            <div class="legend-item">
                                <span class="legend-color legend-current"></span>
                                Belum dijawab
                            </div>

                            <div class="legend-item">
                                <span class="legend-color legend-answered"></span>
                                Sudah dijawab
                            </div>

                            <div class="legend-item">
                                <span class="legend-color legend-doubt"></span>
                                Ragu-ragu
                            </div>
                        </div>

                        <div class="submit-area">
                            <div class="submit-info" id="submitInfo">
                                Jawab semua soal untuk mengaktifkan tombol kumpulkan.
                            </div>

                            <button type="submit" class="submit-btn" id="submitBtn" disabled>
                                Kumpulkan Jawaban
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const totalQuestions = Number('{{ $quiz->questions->count() }}');
            const quizDuration = Number('{{ $durasiMenit }}');

            const slides = document.querySelectorAll('.question-slide');
            const numberButtons = document.querySelectorAll('.number-btn');
            const radioInputs = document.querySelectorAll('input[type="radio"]');
            const optionItems = document.querySelectorAll('.option-item');
            const doubtButtons = document.querySelectorAll('.doubt-btn');

            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const submitBtn = document.getElementById('submitBtn');
            const submitInfo = document.getElementById('submitInfo');
            const quizForm = document.getElementById('quizForm');
            const timeSpentInput = document.getElementById('timeSpent');

            let currentIndex = 0;
            let doubtStatus = Array(totalQuestions).fill(false);

            function isAnswered(index) {
                return document.querySelector('input[type="radio"][data-index="' + index + '"]:checked') !== null;
            }

            function getAnsweredCount() {
                let count = 0;

                for (let i = 0; i < totalQuestions; i++) {
                    if (isAnswered(i)) {
                        count++;
                    }
                }

                return count;
            }

            function getDoubtCount() {
                let count = 0;

                for (let i = 0; i < doubtStatus.length; i++) {
                    if (doubtStatus[i] === true) {
                        count++;
                    }
                }

                return count;
            }

            function updateOptionStyle() {
                optionItems.forEach(function (item) {
                    const input = item.querySelector('input[type="radio"]');

                    if (input && input.checked) {
                        item.classList.add('selected');
                    } else {
                        item.classList.remove('selected');
                    }
                });
            }

            function updateNumberStatus() {
                numberButtons.forEach(function (btn) {
                    const index = Number(btn.dataset.index);

                    btn.classList.remove('active', 'answered', 'doubt');

                    if (index === currentIndex) {
                        btn.classList.add('active');
                    }

                    if (isAnswered(index)) {
                        btn.classList.add('answered');
                    }

                    if (doubtStatus[index] === true) {
                        btn.classList.add('doubt');
                    }
                });
            }

            function updateDoubtButtonStatus() {
                doubtButtons.forEach(function (btn) {
                    const index = Number(btn.dataset.index);

                    if (doubtStatus[index] === true) {
                        btn.classList.add('active');
                        btn.innerText = 'Batalkan Ragu-ragu';
                    } else {
                        btn.classList.remove('active');
                        btn.innerText = 'Ragu-ragu';
                    }
                });
            }

            function updateSubmitState() {
                const answered = getAnsweredCount();
                const doubtCount = getDoubtCount();

                if (answered < totalQuestions) {
                    submitBtn.disabled = true;
                    submitInfo.innerText = 'Masih ada ' + (totalQuestions - answered) + ' soal yang belum dijawab.';
                    return;
                }

                if (doubtCount > 0) {
                    submitBtn.disabled = true;
                    submitInfo.innerText = 'Masih ada ' + doubtCount + ' nomor yang ditandai ragu-ragu. Batalkan terlebih dahulu sebelum mengumpulkan.';
                    return;
                }

                submitBtn.disabled = false;
                submitInfo.innerText = 'Semua soal sudah dijawab dan tidak ada nomor ragu-ragu. Jawaban siap dikumpulkan.';
            }

            function showQuestion(index) {
                if (index < 0 || index >= totalQuestions) {
                    return;
                }

                currentIndex = index;

                slides.forEach(function (slide) {
                    slide.classList.remove('active');
                });

                const activeSlide = document.querySelector('.question-slide[data-index="' + index + '"]');

                if (activeSlide) {
                    activeSlide.classList.add('active');
                }

                if (prevBtn) {
                    prevBtn.disabled = currentIndex === 0;
                }

                if (nextBtn) {
                    nextBtn.disabled = currentIndex === totalQuestions - 1;
                }

                updateOptionStyle();
                updateNumberStatus();
                updateDoubtButtonStatus();
                updateSubmitState();
            }

            numberButtons.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    const index = Number(this.dataset.index);
                    showQuestion(index);
                });
            });

            if (prevBtn) {
                prevBtn.addEventListener('click', function () {
                    showQuestion(currentIndex - 1);
                });
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', function () {
                    showQuestion(currentIndex + 1);
                });
            }

            radioInputs.forEach(function (input) {
                input.addEventListener('change', function () {
                    updateOptionStyle();
                    updateNumberStatus();
                    updateSubmitState();
                });
            });

            doubtButtons.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    const index = Number(this.dataset.index);

                    doubtStatus[index] = !doubtStatus[index];

                    updateDoubtButtonStatus();
                    updateNumberStatus();
                    updateSubmitState();
                });
            });

            if (quizForm) {
                quizForm.addEventListener('submit', function (e) {
                    if (timeSpentInput) {
                        const usedSeconds = initialSeconds - totalSeconds;
                        timeSpentInput.value = usedSeconds > 0 ? usedSeconds : 0;
                    }

                    const answered = answeredCount();
                    const doubtCount = doubtStatus.filter(Boolean).length;

                    if (answered < totalQuestions || doubtCount > 0) {
                        e.preventDefault();

                        if (answered < totalQuestions) {
                            alert('Masih ada soal yang belum dijawab.');
                            return;
                        }

                        if (doubtCount > 0) {
                            alert('Masih ada nomor yang ditandai ragu-ragu. Batalkan ragu-ragu terlebih dahulu.');
                        }
                    }
                });
            }

            function startTimer(durationInMinutes) {
                let time = durationInMinutes * 60;
                const timerElement = document.getElementById('timer');

                if (!timerElement) {
                    return;
                }

                const interval = setInterval(function () {
                    const minutes = Math.floor(time / 60);
                    const seconds = time % 60;

                    timerElement.textContent =
                        String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');

                    if (time <= 0) {
                        clearInterval(interval);

                        if (submitBtn) {
                            submitBtn.disabled = false;
                        }

                        if (quizForm) {
                            quizForm.submit();
                        }
                    }

                    time--;
                }, 1000);
            }

            showQuestion(0);
            startTimer(quizDuration);
        });
    </script>
</body>

</html>