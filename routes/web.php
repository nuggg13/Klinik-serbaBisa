<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

use App\Http\Controllers\DataController;

Route::get('/data/create', [DataController::class, 'create'])->name('data.create');
Route::post('/data', [DataController::class, 'store'])->name('data.store');
Route::get('/data', [DataController::class, 'index'])->name('data.index');
Route::get('/data/{nomor}/edit', [DataController::class, 'edit'])->name('data.edit');
Route::put('/data/{nomor}', [DataController::class, 'update'])->name('data.update');
Route::delete('/data/{nomor}', [DataController::class, 'destroy'])->name('data.destroy');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/dashboard-pasien', [HomeController::class, 'dashboardPasien'])->name('dashboard.pasien');

use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\ReservasiController;

Route::get('/reservasi', [ReservasiController::class, 'create']);
Route::post('/reservasi', [ReservasiController::class, 'store']);

Route::post('/reservasi', [ReservasiController::class, 'store'])->name('reservasi.store');

use App\Http\Controllers\AdminController;

// Login admin
Route::get('/login-admin', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');

// Logout admin
Route::get('/logout-admin', [AdminController::class, 'logout'])->name('admin.logout');

// Dashboard admin
Route::get('/dashboard-admin', [AdminController::class, 'dashboard'])->middleware('admin')->name('admin.dashboard');

Route::post('/admin/pasien/store', [AdminController::class, 'storePasien'])->name('admin.pasien.store');
Route::delete('/admin/pasien/{id}', [AdminController::class, 'deletePasien'])->name('admin.pasien.delete');
Route::get('/admin/pasien/{id}/edit', [AdminController::class, 'editPasien'])->name('admin.pasien.edit');
Route::put('/admin/pasien/{id}', [AdminController::class, 'updatePasien'])->name('admin.pasien.update');

// Admin CRUD routes
Route::get('/admin/admin/{id}/edit', [AdminController::class, 'editAdmin'])->name('admin.admin.edit');
Route::post('/admin/admin', [AdminController::class, 'storeAdmin'])->name('admin.admin.store');
Route::put('/admin/admin/{id}', [AdminController::class, 'updateAdmin'])->name('admin.admin.update');
Route::delete('/admin/admin/{id}', [AdminController::class, 'destroyAdmin'])->name('admin.admin.destroy');

// Jadwal Dokter routes
Route::post('/admin/jadwal', [AdminController::class, 'storeJadwal'])->name('admin.jadwal.store');
Route::get('/admin/jadwal/{id}/edit', [AdminController::class, 'editJadwal']);
Route::put('/admin/jadwal/{id}', [AdminController::class, 'updateJadwal']);
Route::delete('/admin/jadwal/{id}', [AdminController::class, 'destroyJadwal']);