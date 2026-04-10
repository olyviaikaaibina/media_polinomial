@extends('layout.navbar')

@section('title', 'Halaman Siswa - Login')

@section('content')

    <style>
        /* ====== AREA LOGIN ====== */
        .login-wrapper {
            min-height: calc(100vh - 160px);
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #FDFDE8 !important;
            padding: 40px 10px;
        }

        .login-flex {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 50px;
            flex-wrap: wrap;
            max-width: 1250px;
            width: 100%;
        }

        /* ====== GAMBAR ====== */
        .login-illustration {
            max-width: 420px;
            width: 100%;
            height: auto;
        }

        /* ====== CARD ====== */
        .guru-login-card {
            background-color: #D0DDD0;
            border-radius: 24px;
            padding: 32px 32px 28px;
            box-shadow: 0 24px 50px rgba(15, 23, 42, 0.16);
            border: 1px solid rgba(148, 163, 184, 0.25);
            width: 100%;
            max-width: 420px;
        }

        .guru-login-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 16px;
        }

        .guru-label {
            font-size: 0.9rem;
            font-weight: 500;
            color: #4b5563;
            margin-bottom: 4px;
            display: block;
        }

        .guru-input {
            width: 100%;
            border-radius: 8px;
            border: 1px solid #b8c2b8;
            height: 42px;
            padding: 8px 12px;
            margin-bottom: 14px;
            font-size: 0.9rem;
            background-color: #F6F9F6;
            color: #111827;
        }

        /* ====== PASSWORD GROUP ====== */
        .password-group {
            position: relative;
            margin-bottom: 14px;
        }

        .password-group .guru-input {
            margin-bottom: 0;
            padding-right: 46px;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            padding: 0;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-toggle svg {
            width: 20px;
            height: 20px;
            stroke: #4b5563;
        }

        .guru-login-btn {
            background-color: #A0937D;
            border: none;
            color: #fff;
            padding: 8px 24px;
            border-radius: 999px;
            cursor: pointer;
            float: right;
            font-size: 0.9rem;
            margin-top: 8px;
            transition: 0.2s ease;
        }

        .guru-login-btn:hover {
            background-color: #8A7E6A;
        }

        .guru-bottom-text {
            margin-top: 16px;
            text-align: center;
            font-size: 0.9rem;
        }

        .guru-bottom-text a {
            color: #16a34a;
            font-weight: 600;
            text-decoration: none;
        }

        .guru-bottom-text a:hover {
            text-decoration: underline;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .login-flex {
                flex-direction: column;
            }
        }

        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }
    </style>

    <div class="login-wrapper">
        <div class="login-flex">

            {{-- Gambar Kiri --}}
            <img src="{{ asset('img/7.png') }}" class="login-illustration" alt="Ilustrasi Login Siswa">

            {{-- Card Login --}}
            <div class="guru-login-card">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <h1 class="guru-login-title">Login Siswa</h1>

                <form action="{{ route('masuksiswa.store') }}" method="POST">
                    @csrf

                    {{-- Email --}}
                    <label class="guru-label">Email</label>
                    <input type="email" class="guru-input" name="email" placeholder="Masukkan email Anda">

                    {{-- Password --}}
                    <label class="guru-label">Password</label>
                    <div class="password-group">
                        <input type="password" id="password" name="password" class="guru-input"
                            placeholder="Masukkan password Anda">

                        <button type="button" class="password-toggle" id="togglePassword">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                        </button>
                    </div>

                    <button type="submit" class="guru-login-btn">Masuk</button>

                    <div class="guru-bottom-text">
                        Belum punya akun? <a href="{{ route('registersiswa') }}">Daftar sekarang</a>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const pwd = document.getElementById('password');
            const isHidden = pwd.type === "password";
            pwd.type = isHidden ? "text" : "password";
        });
    </script>

@endsection