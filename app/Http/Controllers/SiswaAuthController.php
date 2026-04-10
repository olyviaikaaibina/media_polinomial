<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SiswaAuthController extends Controller
{
    public function showRegister()
    {
        return view('siswa.registersiswa');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:siswa,email',
            'nis' => 'required|string|max:20',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'kelas' => 'required|in:XI1,XI2,XI3',
            'password' => 'required|min:8|confirmed',
        ], [
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = Siswa::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'nis' => $request->nis,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kelas' => $request->kelas,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('masuksiswa')->with('success', 'Registrasi berhasil, silahkan login!');
    }

    public function showLogin()
    {
        return view('siswa.masuksiswa');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('petakonsep')->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('siswa.login');
    }
}