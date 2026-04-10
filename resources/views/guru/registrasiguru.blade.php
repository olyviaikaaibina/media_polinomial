{{-- resources/views/registrasiguru.blade.php --}}
@extends('layout.navbar')

@section('title', 'Registrasi Guru')

@section('content')

    <style>
        .guru-register-page {
            background-color: #FDFDE8 !important;
            /* SAMAKAN DENGAN SEMUA HALAMAN */
            min-height: calc(100vh - 160px);
            padding: 40px 10px 70px;
            display: flex;
            align-items: center;
        }

        .guru-register-container {
            max-width: 1180px;
            margin: 0 auto;
            width: 100%;
        }

        .guru-register-card {
            background-color: #D0DDD0;
            border-radius: 20px;
            padding: 32px 32px 28px;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.12);
            border: 1px solid rgba(148, 163, 184, 0.25);
            width: 100%;
            max-width: 520px;
        }

        .guru-register-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
            text-align: center;
        }

        .guru-register-subtitle {
            font-size: 0.85rem;
            color: #4b5563;
            margin-bottom: 18px;
            text-align: center;
        }

        .guru-label {
            font-size: 0.85rem;
            font-weight: 500;
            color: #4b5563;
            margin-bottom: 4px;
        }

        .form-control.guru-input {
            background-color: #ffffff;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            height: 42px;
            padding: 8px 12px;
            font-size: 0.9rem;
        }

        .form-control.guru-input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.25);
        }

        .input-group-text.guru-eye {
            background-color: #ffffff;
            border: 1px solid #d1d5db;
            border-left: none;
            border-radius: 0 8px 8px 0;
            cursor: pointer;
            padding: 0 10px;
        }

        .guru-eye-icon {
            line-height: 1;
            display: flex;
            align-items: center;
        }

        .guru-register-btn {
            background-color: #A0937D;
            border: none;
            color: #ffffff;
            padding: 8px 26px;
            border-radius: 999px;
            font-weight: 500;
            transition: 0.15s;
            font-size: 0.9rem;
        }

        .guru-register-btn:hover {
            background-color: #8A7E6A;
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(160, 147, 125, 0.35);
        }

        /* ⛔ Hilangkan icon mata bawaan browser biar tidak dobel */
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none !important;
        }

        input[type="password"]::-webkit-textfield-decoration-container {
            display: none !important;
        }
    </style>

    <div class="guru-register-page">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row align-items-center g-4">

                {{-- Kiri: ilustrasi --}}
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('img/3.png') }}" alt="Ilustrasi Registrasi" style="max-width: 70%; height: auto;">
                </div>

                {{-- Kanan: form registrasi --}}
                <div class="col-lg-6 d-flex justify-content-center">
                    <div class="guru-register-card">

                        <h1 class="guru-register-title">Daftar</h1>
                        <p class="guru-register-subtitle">
                            Daftarkan Akun Anda untuk Mengakses Dashboard Guru Polimathica!
                        </p>

                        <form action="{{ route('guru.register.store') }}" method="POST">
                            @csrf

                            {{-- Nama --}}
                            <div class="mb-3">
                                <label class="guru-label">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control guru-input"
                                    placeholder="Masukkan nama lengkap Anda">
                            </div>

                            {{-- Email --}}
                            <div class="mb-3">
                                <label class="guru-label">Email</label>
                                <input type="email" name="email" class="form-control guru-input"
                                    placeholder="Masukkan email aktif Anda">
                            </div>

                            {{-- Password --}}
                            <div class="mb-3">
                                <label class="guru-label">Password</label>
                                <div class="input-group">
                                    <input type="password" id="password" name="password" class="form-control guru-input"
                                        placeholder="Minimal 8 karakter">

                                    <span class="input-group-text guru-eye" id="togglePasswordReg">
                                        <span class="guru-eye-icon">
                                            <svg id="eyeIconReg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                stroke="#6b7280" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            {{-- Konfirmasi Password --}}
                            <div class="mb-3">
                                <label class="guru-label">Konfirmasi Password</label>
                                <div class="input-group">
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control guru-input" placeholder="Ketik ulang password Anda">

                                    <span class="input-group-text guru-eye" id="togglePasswordConfirm">
                                        <span class="guru-eye-icon">
                                            <svg id="eyeIconConfirm" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                stroke="#6b7280" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            {{-- Tombol daftar --}}
                            <div class="mt-3 text-end">
                                <button type="submit" class="guru-register-btn">Daftar</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const pwd = document.getElementById('password');
            const pwd2 = document.getElementById('password_confirmation');

            const t1 = document.getElementById('togglePasswordReg');
            const t2 = document.getElementById('togglePasswordConfirm');

            const eye1 = document.getElementById('eyeIconReg');
            const eye2 = document.getElementById('eyeIconConfirm');

            // fungsi helper untuk ganti tipe + icon
            function toggleField(field, eyeSvg) {
                const isPassword = field.type === 'password';
                field.type = isPassword ? 'text' : 'password';

                eyeSvg.innerHTML = isPassword
                    ? `<path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a21.81 21.81 0 0 1 5.06-6.06M9.9 4.24A10.94 10.94 0 0 1 12 4c7 0 11 8 11 8a21.81 21.81 0 0 1-2.41 3.6M1 1l22 22"></path>`
                    : `<path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"></path><circle cx="12" cy="12" r="3"></circle>`;
            }

            t1.addEventListener('click', () => toggleField(pwd, eye1));
            t2.addEventListener('click', () => toggleField(pwd2, eye2));
        });
    </script>

@endsection