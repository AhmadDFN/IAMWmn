<?php


use App\Http\Controllers\admin;
use App\Http\Controllers\user;
use App\Http\Controllers\iamw;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


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

// Auth
Route::get("auth/login", [AuthController::class, "login"])->name("login"); // Dengan nama route
Route::post("auth/login", [AuthController::class, "cek_login"]);
Route::get("auth/register", [AuthController::class, "registrasi"])->name("signup"); // Dengan nama route
Route::post("auth/register", [AuthController::class, "save_registrasi"]);

/** User Controller */








/** Admin Controller */
Route::group(["middleware" => "auth"], function () {
    Route::get('dashboard', [admin\DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/test', [textCTRL::class, 'run']);

    Route::resource('mahasiswa', admin\MahasiswaController::class);
    Route::resource('perusahaan', admin\PerusahaanController::class);
    // Route::resource('berkas', BerkasController::class);
    Route::resource('mahasiswa/{mahasiswa}/berkas', admin\BerkasController::class);
    Route::resource('jenisloker', admin\JenisLokerController::class);
    Route::resource('jurusan', admin\JurusanController::class);
    Route::resource('loker', admin\LokerController::class);
    Route::resource('lamar', admin\LamarController::class);
    Route::resource('user', admin\UserController::class);
    Route::get('/kota/{id_prov?}', [admin\kotaController::class, 'getKotaByProvinsi'])->name('kota');

    // Logout
    Route::get("auth/logout", [AuthController::class, "logout"])->name("signout"); // Dengan nama route 
});
