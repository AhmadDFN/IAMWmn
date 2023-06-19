<?php

use App\Http\Controllers\textCTRL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\kotaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LamarController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\iamw;
use App\Http\Controllers\JenisLokerController;
use App\Http\Controllers\PerusahaanController;

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


// Route::view('/', 'welcome');
Route::get('/', [iamw\ViewController::class, 'index']);
Route::group(["middleware" => "auth"], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/test', [textCTRL::class, 'run']);

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

    // Logout
    Route::get("auth/logout", [AuthController::class, "logout"])->name("signout"); // Dengan nama route 
});

// Auth
Route::get("auth/login", [AuthController::class, "login"])->name("login"); // Dengan nama route
Route::post("auth/login", [AuthController::class, "cek_login"]);
Route::get("auth/register", [AuthController::class, "registrasi"])->name("signup"); // Dengan nama route
Route::post("auth/register", [AuthController::class, "save_registrasi"]);
