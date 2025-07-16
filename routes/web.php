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

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DataController;

Route::get('/data/create', [DataController::class,'create'])->name('data.create');
Route::post('/data', [DataController::class,'store'])->name('data.store');
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

Route::get('/dashboard-pasien', function () {
    return view('dashboard-pasien');
})->name('dashboard.pasien');

use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
