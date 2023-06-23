<?php


use App\Http\Controllers\iamw;
use App\Http\Controllers\user;
use App\Http\Controllers\admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\kotaController;


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
Route::get('/', [iamw\ViewController::class, 'index'])->name("home");

// Auth
Route::get("auth/login", [AuthController::class, "login"])->name("login"); // Dengan nama route
Route::post("auth/login", [AuthController::class, "cek_login"]);
Route::get("auth/register", [AuthController::class, "registrasi"])->name("signup"); // Dengan nama route
Route::post("auth/register", [AuthController::class, "save_registrasi"]);

/** User Controller */
Route::get('/kota/{id_prov?}', [kotaController::class, 'getKotaByProvinsi'])->name('kota');








/** Admin Controller */
Route::group(["middleware" => "auth"], function () {
    Route::get('dashboard', [admin\DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/test', [textCTRL::class, 'run']);

    Route::get('verif', [admin\VerifController::class, 'index'])->name('verif');
    Route::get("verif/{mahasiswa}/{status}", [admin\VerifController::class, "update_status"]);
    Route::resource('mahasiswa', admin\MahasiswaController::class);
    Route::resource('perusahaan', admin\PerusahaanController::class);
    // Route::resource('berkas', BerkasController::class);
    Route::resource('mahasiswa/{mahasiswa}/berkas', admin\BerkasController::class);
    Route::resource('jenisloker', admin\JenisLokerController::class);
    Route::resource('jurusan', admin\JurusanController::class);
    Route::resource('loker', admin\LokerController::class);
    Route::resource('lamar', admin\LamarController::class);
    Route::resource('user', admin\UserController::class);

    // Logout
    Route::get("auth/logout", [AuthController::class, "logout"])->name("signout"); // Dengan nama route 
});
