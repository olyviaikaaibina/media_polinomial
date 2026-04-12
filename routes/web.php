<?php

use App\Http\Controllers\GuruAuthController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizSiswaController;
use App\Http\Controllers\SiswaAuthController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

// ==================== HALAMAN UMUM ====================
Route::view('/', 'landingpage')->name('landingpage');
Route::view('/daftarmateri', 'daftarmateri')->name('daftarmateri');
Route::view('/petunjukpenggunaan', 'petunjukpenggunaan')->name('petunjukpenggunaan');
Route::view('/tentang', 'tentang')->name('tentang');

// ==================== SISWA AUTH ====================
Route::get('/registersiswa', [SiswaAuthController::class, 'showRegister'])->name('registersiswa');
Route::post('/registersiswa', [SiswaAuthController::class, 'register'])->name('registersiswa.store');

Route::get('/loginsiswa', [SiswaAuthController::class, 'showLogin'])->name('masuksiswa');
Route::post('/loginsiswa', [SiswaAuthController::class, 'login'])->name('masuksiswa.store');

Route::post('/logoutsiswa', [SiswaAuthController::class, 'logout'])->name('logoutsiswa');

// ==================== HALAMAN SISWA (LOGIN WAJIB) ====================
Route::middleware('auth:siswa')->group(function () {

    Route::view('/progressbelajar', 'siswa.progressbelajar')->name('progressbelajar');

    Route::view('/petakonsep', 'siswa.petakonsep')->name('petakonsep');
    Route::view('/pendahuluan', 'siswa.pendahuluan')->name('pendahuluan');

    Route::view('/pengertianpolinomial', 'siswa.pengertianpolinomial')->name('pengertianpolinomial');
    Route::view('/derajatsuatupolinomial', 'siswa.derajatsuatupolinomial')->name('derajatsuatupolinomial');
    Route::view('/fungsipolinomialdangrafiknya', 'siswa.fungsipolinomialdangrafiknya')->name('fungsipolinomialdangrafiknya');
    Route::view('/kuisa', 'siswa.kuisa')->name('kuisa');

    Route::view('/penjumlahanpolinomial', 'siswa.penjumlahanpolinomial')->name('penjumlahanpolinomial');
    Route::view('/penguranganpolinomial', 'siswa.penguranganpolinomial')->name('penguranganpolinomial');
    Route::view('/perkalianpolinomial', 'siswa.perkalianpolinomial')->name('perkalianpolinomial');
    Route::view('/kuisb', 'siswa.kuisb')->name('kuisb');

    Route::view('/pembagianbersusun', 'siswa.pembagianbersusun')->name('pembagianbersusun');
    Route::view('/metodehorner', 'siswa.metodehorner')->name('metodehorner');
    Route::view('/teoremasisa', 'siswa.teoremasisa')->name('teoremasisa');
    Route::view('/kuisc', 'siswa.kuisc')->name('kuisc');

    Route::view('/teoremafaktor', 'siswa.teoremafaktor')->name('teoremafaktor');
    Route::view('/faktordanpembuatnol', 'siswa.faktordanpembuatnol')->name('faktordanpembuatnol');
    Route::view('/kuisd', 'siswa.kuisd')->name('kuisd');

    Route::view('/identitaspolinomial', 'siswa.identitaspolinomial')->name('identitaspolinomial');
    Route::view('/kuise', 'siswa.kuise')->name('kuise');

    Route::get('/quiz/{id}', [QuizSiswaController::class, 'show'])->name('quiz.show');
    Route::post('/quiz/{id}/submit', [QuizSiswaController::class, 'submit'])->name('quiz.submit');
});

// ==================== GURU AUTH ====================
Route::get('/guru/register', [GuruAuthController::class, 'showRegister'])->name('guru.register');
Route::post('/guru/register', [GuruAuthController::class, 'register'])->name('guru.register.store');

Route::get('/guru/login', [GuruAuthController::class, 'showLogin'])->name('guru.login');
Route::post('/guru/login', [GuruAuthController::class, 'login'])->name('guru.login.store');

Route::get('/login', function () {
    return redirect()->route('guru.login');
})->name('login');

Route::post('/guru/logout', [GuruAuthController::class, 'logout'])->name('guru.logout');

// ==================== HALAMAN GURU (LOGIN WAJIB) ====================
Route::middleware('auth:guru')->group(function () {

    Route::view('/halamanguru', 'guru.halamanguru')->name('halamanguru');
    Route::view('/dashboardguru', 'guru.dashboardguru')->name('dashboardguru');

    Route::view('/rekapitulasinilai', 'guru.rekapitulasinilai')->name('rekapitulasinilai');
    Route::view('/aktivitassiswa', 'guru.aktivitassiswa')->name('aktivitassiswa');
    Route::view('/daftarmateriguru', 'guru.daftarmateriguru')->name('daftarmateriguru');

    // ==================== KUIS ====================
    Route::get('/daftarkuis', [QuizController::class, 'index'])->name('daftarkuis');
    Route::view('/kuis/{id}/edit', 'guru.kuisedit')->name('kuis.edit');
    Route::view('/kuis/{id}/soal', 'guru.soal')->name('soal');


    Route::get('/daftarkuis', [QuizController::class, 'index'])->name('daftarkuis');
    Route::put('/updatekuis/{id}', [QuizController::class, 'update'])->name('updatekuis');
    Route::get('/soal/{id}', [QuizController::class, 'soal'])->name('soal');

    // sementara untuk tombol update & hapus
    Route::put('/kuis/{id}', function ($id) {
        return redirect()->route('daftarkuis')->with('success', 'Kuis berhasil diperbarui.');
    })->name('kuis.update');

    Route::delete('/kuis/{id}', function ($id) {
        return redirect()->route('daftarkuis')->with('success', 'Kuis berhasil dihapus.');
    })->name('kuis.destroy');



    Route::get('/daftarsiswa', [SiswaController::class, 'index'])->name('daftarsiswa');

    Route::resource('siswa', SiswaController::class)->only([
        'store',
        'update',
        'destroy',
        'show'
    ]);

    Route::get('/siswa/export/pdf', [SiswaController::class, 'exportPdf'])->name('siswa.export.pdf');
    Route::get('/siswa/export/excel', [SiswaController::class, 'exportExcel'])->name('siswa.export.excel');
});