<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RTController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\LoginHistoryController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\ResponseController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SuratController;

// Basic Auth Routes
Auth::routes();

// Redirect root
Route::get('/', function () {
    return Auth::check() ? redirect('/home') : redirect('/login');
});

// Home route
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Admin routes (tanpa middleware)
Route::group(['prefix' => 'admin'], function () {
    Route::get('/dashboard', [HomeAdminController::class, 'index']);
    Route::get('/profile', [AdminProfileController::class, 'index']);
    Route::get('/response', [ResponseController::class, 'index']);
});

Route::get('/permohonan/status', [PermohonanController::class, 'status'])->name('permohonan.status');
Route::get('/permohonan/status/cek', [PermohonanController::class, 'cekStatus'])->name('cek.status');
Route::post('/permohonan/cek-status', [PermohonanController::class, 'cekStatus']);

// Route untuk API
Route::prefix('api')->group(function () {
    Route::get('/permohonan/cek-status/{nomor_surat}', [PermohonanController::class, 'cekStatus']);
});

// Route untuk halaman status (public)

// Halaman login sebagai halaman utama

// Route untuk guest/tamu
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Route untuk admin (hapus middleware admin, gunakan auth saja)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Home & Dashboard
    Route::get('/admin/home', [HomeAdminController::class, 'index'])->name('admin.home');
    Route::get('/', [HomeAdminController::class, 'index'])->name('admin.home');
    Route::get('/dashboard', [HomeAdminController::class, 'index'])->name('admin.dashboard');
    
    // RT routes
    Route::get('/rts', [RTController::class, 'index'])->name('rts.index');
    Route::get('/rts/create', [RTController::class, 'create'])->name('rts.create');
    Route::post('/rts', [RTController::class, 'store'])->name('rts.store');
    
    // Response routes
    Route::get('/response', [ResponseController::class, 'index'])->name('admin.response.index');
    Route::get('/response/{id}', [ResponseController::class, 'show'])->name('admin.response.show');
    Route::post('/response/{id}/approve', [ResponseController::class, 'approve'])->name('admin.response.approve');
    Route::post('/response/{id}/reject', [ResponseController::class, 'reject'])->name('admin.response.reject');
    Route::put('/response/{id}', [ResponseController::class, 'update'])->name('admin.response.update');
    
    // Profile routes
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('admin.profile');
    Route::post('/profile/update', [AdminProfileController::class, 'update'])->name('admin.profile.update'); // Pastikan ini POST
    Route::post('/profile/update-foto', [AdminProfileController::class, 'updateFoto'])->name('admin.profile.updateFoto');
    
    // Login history
    Route::get('/login-history', [LoginHistoryController::class, 'index'])->name('login.history');
});

// Route untuk user yang sudah login
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/store', [ProfileController::class, 'store'])->name('profile.store');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/update-foto', [ProfileController::class, 'updateFoto'])->name('profile.updateFoto');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    
    // Permohonan routes
    Route::get('/permohonan', [PermohonanController::class, 'index'])->name('permohonan.index');
    Route::get('/permohonan/create', [PermohonanController::class, 'create'])->name('permohonan.create');
    Route::post('/permohonan', [PermohonanController::class, 'store'])->name('permohonan.store');
    Route::get('/permohonan/{permohonan}', [PermohonanController::class, 'show'])->name('permohonan.show');
    Route::get('/riwayat', [PermohonanController::class, 'riwayat'])->name('permohonan.riwayat');
    Route::post('/permohonan/store', [App\Http\Controllers\PermohonanController::class, 'store'])->name('permohonan.store');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/permohonan/{id}/cetak', [PermohonanController::class, 'cetakSurat'])->name('permohonan.cetak');
});

// Route untuk logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/test-view', function() {
    return view('permohonan.status');
});

// Tambahkan route baru ini di ATAS semua middleware group
Route::get('/status-permohonan', function() {
    return view('permohonan.status');
})->name('permohonan.status');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Route::get('/surat/cetak/{id}', [SuratController::class, 'cetak'])->name('surat.cetak');

// Landing page route
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');


