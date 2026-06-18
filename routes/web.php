<?php

use App\Http\Controllers\GuruAuthController;
use App\Http\Controllers\GuruDashboardController;
use App\Http\Controllers\ProgressSiswaController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\ProgressBelajarController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizQuestionController;
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

// ==================== SISWA AUTH ====================
Route::get('/loginsiswa', [SiswaAuthController::class, 'showLogin'])->name('masuksiswa');
Route::post('/loginsiswa', [SiswaAuthController::class, 'login'])->name('masuksiswa.store');

// route login default untuk siswa
Route::get('/login', function () {
    return redirect()->route('masuksiswa');
})->name('login');

Route::post('/logoutsiswa', [SiswaAuthController::class, 'logout'])->name('logoutsiswa');

// ==================== HALAMAN SISWA (LOGIN WAJIB) ====================
Route::middleware('auth:siswa')->group(function () {

    Route::view('/progressbelajar', 'siswa.progressbelajar')->name('progressbelajar');

    Route::view('/petakonsep', 'siswa.petakonsep')->name('petakonsep');
    Route::view('/pendahuluan', 'siswa.pendahuluan')->name('pendahuluan');

    // Progress Materi Siswa
    Route::get('/progressbelajar', [ProgressBelajarController::class, 'index'])->name('progressbelajar');

    // Route::view('/pengertianpolinomial', 'siswa.pengertianpolinomial')->name('pengertianpolinomial');
    // Route::view('/derajatsuatupolinomial', 'siswa.derajatsuatupolinomial')->name('derajatsuatupolinomial');
    // Route::view('/fungsipolinomialdangrafiknya', 'siswa.fungsipolinomialdangrafiknya')->name('fungsipolinomialdangrafiknya');
    // Route::view('/kuisa', 'siswa.kuisa')->name('kuisa');

    // Route::view('/penjumlahanpolinomial', 'siswa.penjumlahanpolinomial')->name('penjumlahanpolinomial');
    // Route::view('/penguranganpolinomial', 'siswa.penguranganpolinomial')->name('penguranganpolinomial');
    // Route::view('/perkalianpolinomial', 'siswa.perkalianpolinomial')->name('perkalianpolinomial');
    // Route::view('/kuisb', 'siswa.kuisb')->name('kuisb');

    // Route::view('/pembagianbersusun', 'siswa.pembagianbersusun')->name('pembagianbersusun');
    // Route::view('/metodehorner', 'siswa.metodehorner')->name('metodehorner');
    // Route::view('/teoremasisa', 'siswa.teoremasisa')->name('teoremasisa');
    // Route::view('/kuisc', 'siswa.kuisc')->name('kuisc');

    // Route::view('/teoremafaktor', 'siswa.teoremafaktor')->name('teoremafaktor');
    // Route::view('/faktordanpembuatnol', 'siswa.faktordanpembuatnol')->name('faktordanpembuatnol');
    // Route::view('/kuisd', 'siswa.kuisd')->name('kuisd');

    // Route::view('/identitaspolinomial', 'siswa.identitaspolinomial')->name('identitaspolinomial');
    // Route::view('/kuise', 'siswa.kuise')->name('kuise');


    Route::get('/materi/{slug}', [MateriController::class, 'show'])->name('materi.show');
    Route::post('/materi/{id}/selesai', [MateriController::class, 'complete'])->name('materi.complete');

    // Kuis Siswa
    Route::get('/quiz/{id}/petunjuk', [QuizSiswaController::class, 'petunjuk'])
        ->name('quiz.petunjuk');

    Route::get('/quiz/{id}/kerjakan', [QuizSiswaController::class, 'show'])
        ->name('quiz.show');

    Route::post('/quiz/{id}/submit', [QuizSiswaController::class, 'submit'])
        ->name('quiz.submit');

    // Kalau masih ada link lama /quiz/1, /quiz/2, dst,
// otomatis diarahkan ke halaman petunjuk
    Route::get('/quiz/{id}', function ($id) {
        return redirect()->route('quiz.petunjuk', ['id' => $id]);
    });
});

Route::post('/logout', [SiswaAuthController::class, 'logout'])->name('logout');

// Progress Materi Siswa
Route::post('/materi/{id}/selesai', [MateriController::class, 'complete'])->name('materi.complete');

// ==================== GURU AUTH ====================
Route::get('/guru/register', [GuruAuthController::class, 'showRegister'])->name('guru.register');
Route::post('/guru/register', [GuruAuthController::class, 'register'])->name('guru.register.store');

Route::get('/halamanguru', function () {
    return redirect()->route('guru.login');
})->name('halamanguru');

Route::get('/guru/login', [GuruAuthController::class, 'showLogin'])->name('guru.login');
Route::post('/guru/login', [GuruAuthController::class, 'login'])->name('guru.login.store');


Route::post('/guru/logout', [GuruAuthController::class, 'logout'])->name('guru.logout');

// ==================== HALAMAN GURU (LOGIN WAJIB) ====================
Route::middleware('auth:guru')->group(function () {

    Route::get('/dashboardguru', [GuruDashboardController::class, 'index'])->name('dashboardguru');

    Route::get('/rekapitulasinilai', [QuizController::class, 'rekapitulasiNilai'])
        ->name('rekapitulasinilai');


    Route::get('/rekapnilai/export/pdf', [QuizController::class, 'exportRekapPdf'])
        ->name('rekapnilai.export.pdf');

    Route::get('/rekapnilai/export/excel', [QuizController::class, 'exportRekapExcel'])
        ->name('rekapnilai.export.excel');

    Route::get('/aktivitassiswa', [ProgressSiswaController::class, 'index'])
        ->name('aktivitassiswa');
    // ==================== KUIS ====================
    Route::get('/daftarkuis', [QuizController::class, 'index'])->name('daftarkuis');
    Route::view('/kuis/{id}/edit', 'guru.kuisedit')->name('kuis.edit');

    Route::get('/daftarkuis', [QuizController::class, 'index'])->name('daftarkuis');
    Route::put('/updatekuis/{id}', [QuizController::class, 'update'])->name('updatekuis');

    // sementara untuk tombol update & hapus
    Route::put('/kuis/{id}', function ($id) {
        return redirect()->route('daftarkuis')->with('success', 'Kuis berhasil diperbarui.');
    })->name('kuis.update');

    Route::delete('/kuis/{id}', function ($id) {
        return redirect()->route('daftarkuis')->with('success', 'Kuis berhasil dihapus.');
    })->name('kuis.destroy');

    // Soal Kuis
    Route::get('/kuis/{quiz}/soal', [QuizQuestionController::class, 'index'])->name('kuis.soal');
    Route::post('/kuis/{quiz}/soal', [QuizQuestionController::class, 'store'])->name('kuis.soal.store');

    Route::get('/soal/{question}', [QuizQuestionController::class, 'show'])->name('kuis.soal.show');
    Route::put('/soal/{question}', [QuizQuestionController::class, 'update'])->name('kuis.soal.update');
    Route::delete('/soal/{question}', [QuizQuestionController::class, 'destroy'])->name('kuis.soal.destroy');


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