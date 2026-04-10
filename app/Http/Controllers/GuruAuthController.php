<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GuruAuthController extends Controller
{
    public function showRegister()
    {
        return view('guru.registrasiguru');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:gurus,email',
            'password' => 'required|min:8|confirmed',
        ]);

        Guru::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('halamanguru')
            ->with('success', 'Registrasi Guru Berhasil, Silahkan Lanjut Login!');
    }

    public function showLogin()
    {
        return view('guru.halamanguru');
    }

    // ======================
    // PROSES LOGIN
    // ======================
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 1️⃣ Cek apakah email guru terdaftar
        $guru = Guru::where('email', $request->email)->first();

        if (!$guru) {
            return back()->withErrors([
                'email' => 'Akun guru belum terdaftar.',
            ])->withInput();
        }

        // 2️⃣ Coba login (email ada, cek password)
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::guard('guru')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // login berhasil → dashboard guru
            return redirect()->route('dashboardguru');
        }

        // 3️⃣ Email ada tapi password salah
        return back()->withErrors([
            'password' => 'Password yang Anda masukkan salah.',
        ])->withInput();
    }


    // ======================
    // LOGOUT
    // ======================
    public function logout(Request $request)
    {
        Auth::guard('guru')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('guru.login');
    }
}
