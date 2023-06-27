<?php


use App\Http\Controllers\iamw;
use App\Http\Controllers\user;
use App\Http\Controllers\admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
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
Route::get("auth/login", [IndexController::class, "show_login"])->name("login"); // Dengan nama route
Route::post("auth/login", [IndexController::class, "login"]);
Route::get("auth/register", [IndexController::class, "show_register"])->name("signup"); // Dengan nama route
Route::post("auth/register", [IndexController::class, "register"]);
// Kota - Provinsi
Route::get('/kota/{id_prov?}', [kotaController::class, 'getKotaByProvinsi'])->name('kota');

/** User Controller */








/** Admin Controller */
Route::group(["middleware" => "auth"], function () {
    Route::get('admin/', [admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('admin/myprofile', [admin\DashboardController::class, 'profilku'])->name('edit.admin');
    Route::put('admin/myprofile/update', [admin\DashboardController::class, 'update'])->name('update.admin');
    Route::get('/test', function () {
        return view("admin.blank");
    });

    Route::get('verif', [admin\VerifController::class, 'index'])->name('verif');
    Route::get("verif/{mahasiswa}/acc", [admin\VerifController::class, "update_status"]);
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
    Route::get("auth/logout", [IndexController::class, "logout"])->name("signout"); // Dengan nama route 
});
