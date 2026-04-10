@extends('layout.navbar')

@section('title', 'Registrasi Siswa')

@section('content')

<style>
    .register-wrapper {
        min-height: calc(100vh - 140px);
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px 10px;
    }

    .register-flex {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 50px;
        flex-wrap: wrap;
        max-width: 1200px;
        width: 100%;
    }

    .register-img {
        max-width: 420px;
        width: 100%;
    }

    .register-card {
        background-color: #D0DDD0;
        border-radius: 20px;
        padding: 40px 40px 36px;
        width: 550px;
        max-width: 90%;
        box-shadow: 0 24px 50px rgba(15, 23, 42, 0.16);
        border: 1px solid rgba(148, 163, 184, 0.25);
    }

    .register-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 12px;
    }

    .register-label {
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 4px;
        color: #4b5563;
        display: block;
    }

    .register-input {
        width: 100%;
        height: 42px;
        padding: 8px 12px;
        border-radius: 8px;
        border: 1px solid #d1d5db;
        margin-bottom: 14px;
        outline: none;
        background: #fff;
    }

    .password-wrapper {
        display: flex;
        align-items: center;
        width: 100%;
        margin-bottom: 14px;
    }

    .password-wrapper input {
        width: 100%;
        height: 42px;
        padding: 8px 12px;
        border: 1px solid #d1d5db;
        border-right: none;
        border-radius: 8px 0 0 8px;
        outline: none;
        background: #fff;
    }

    .password-eye {
        width: 45px;
        height: 42px;
        border: 1px solid #d1d5db;
        border-left: none;
        border-radius: 0 8px 8px 0;
        background: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        padding: 0;
    }

    .password-eye svg {
        width: 20px;
        height: 20px;
        opacity: 0.85;
    }

    .register-btn {
        background-color: #A0937D;
        color: white;
        border: none;
        padding: 8px 26px;
        border-radius: 999px;
        float: right;
        margin-top: 10px;
        cursor: pointer;
    }

    .register-btn:hover {
        background-color: #8A7E6A;
    }

    .register-bottom {
        font-size: 0.9rem;
        text-align: center;
        margin-top: 18px;
        clear: both;
    }

    .register-bottom a {
        color: #16a34a;
        font-weight: 600;
        text-decoration: none;
    }

    .alert-danger {
        background: #fee2e2;
        color: #991b1b;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 15px;
        border: 1px solid #fecaca;
    }

    input[type="password"]::-ms-reveal,
    input[type="password"]::-ms-clear {
        display: none !important;
    }

    input[type="password"]::-webkit-textfield-decoration-container {
        display: none !important;
    }

    input[type="password"] {
        appearance: none !important;
    }
</style>

<div class="register-wrapper">
    <div class="register-flex">

        <img src="{{ asset('img/7.png') }}" class="register-img" alt="Ilustrasi Register">

        <div class="register-card">
            <h1 class="register-title">Daftar Siswa</h1>

            @if ($errors->any())
                <div class="alert-danger">
                    <ul style="margin: 0; padding-left: 18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('registersiswa.store') }}">
                @csrf

                <label class="register-label">Nama Lengkap</label>
                <input
                    type="text"
                    name="nama"
                    class="register-input"
                    placeholder="Masukkan nama lengkap"
                    value="{{ old('nama') }}"
                    required
                >

                <label class="register-label">Email</label>
                <input
                    type="email"
                    name="email"
                    class="register-input"
                    placeholder="Masukkan email"
                    value="{{ old('email') }}"
                    required
                >

                <label class="register-label">NIS</label>
                <input
                    type="text"
                    name="nis"
                    class="register-input"
                    placeholder="Masukkan NIS"
                    value="{{ old('nis') }}"
                    required
                >

                <label class="register-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="register-input" style="height: 46px;" required>
                    <option value="" disabled {{ old('jenis_kelamin') ? '' : 'selected' }}>Pilih jenis kelamin</option>
                    <option value="Laki-Laki" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>

                <label class="register-label">Kelas</label>
                <select name="kelas" class="register-input" style="height: 46px;" required>
                    <option value="" disabled {{ old('kelas') ? '' : 'selected' }}>Pilih kelas</option>
                    <option value="XI1" {{ old('kelas') == 'XI1' ? 'selected' : '' }}>XI1</option>
                    <option value="XI2" {{ old('kelas') == 'XI2' ? 'selected' : '' }}>XI2</option>
                    <option value="XI3" {{ old('kelas') == 'XI3' ? 'selected' : '' }}>XI3</option>
                </select>

                <label class="register-label">Password</label>
                <div class="password-wrapper">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Minimal 8 karakter"
                        required
                    >
                    <button type="button" class="password-eye" onclick="togglePass('password', this)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </button>
                </div>

                <label class="register-label">Konfirmasi Password</label>
                <div class="password-wrapper">
                    <input
                        type="password"
                        id="password_confirm"
                        name="password_confirmation"
                        placeholder="Ketik ulang password Anda"
                        required
                    >
                    <button type="button" class="password-eye" onclick="togglePass('password_confirm', this)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </button>
                </div>

                <button class="register-btn" type="submit">Daftar</button>

                <div class="register-bottom">
                    Sudah punya akun?
                    <a href="{{ route('masuksiswa') }}">Masuk di sini</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function togglePass(id, el) {
    const input = document.getElementById(id);

    if (input.type === "password") {
        input.type = "text";
        el.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13.875 18.825c-.6.355-1.248.675-1.875.675-6 0-9.75-7.5-9.75-7.5a21.39 21.39 0 013.36-4.35M9.53 9.53a3 3 0 014.24 4.24" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 3l18 18" />
            </svg>
        `;
    } else {
        input.type = "password";
        el.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                <circle cx="12" cy="12" r="3" />
            </svg>
        `;
    }
}
</script>

@endsection