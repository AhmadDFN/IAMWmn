<?php

use App\Http\Controllers\BerkasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisLokerController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\kotaController;
use App\Http\Controllers\LamarController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\UserController;
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


// Route::group(["middleware" => "auth"], function () {
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('perusahaan', PerusahaanController::class);
// Route::resource('berkas', BerkasController::class);
Route::resource('mahasiswa/{mahasiswa}/berkas', BerkasController::class);
Route::resource('jenisloker', JenisLokerController::class);
Route::resource('jurusan', JurusanController::class);
Route::resource('loker', LokerController::class);
Route::resource('lamar', LamarController::class);
Route::resource('user', UserController::class);
Route::get('/kota/{id_prov?}', [kotaController::class, 'getKotaByProvinsi'])->name('kota');
// });

// Auth
// Route::get("auth/login", [AuthCtrl::class, "login"])->name("login"); // Dengan nama route
// Route::post("auth/login", [AuthCtrl::class, "cek_login"]);
// Route::get("auth/registrasi", [AuthCtrl::class, "registrasi"])->name("signup"); // Dengan nama route
// Route::post("auth/registrasi", [AuthCtrl::class, "save_registrasi"]);
