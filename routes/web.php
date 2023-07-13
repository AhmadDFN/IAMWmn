<?php


use App\Http\Controllers\iamw;
use App\Http\Controllers\mahasiswa;
use App\Http\Controllers\admin;
use Illuminate\Support\Facades\Route;
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
Route::get('admin/send-email/{mahasiswa}', [admin\VerifController::class, 'test_email'])->name('testemail');
Route::get('admin/send-email/{mahasiswa}/{token}/{nim}', [admin\VerifController::class, 'send_email'])->name('sendemail');
Route::get("verif/email/{mahasiswa}/acc", [admin\VerifController::class, "email_update"]);
// Kota - Provinsi
Route::get('/test', function () {
    return view("admin.verif.email");
});
Route::get('/kota/{id_prov?}', [kotaController::class, 'getKotaByProvinsi'])->name('kota');

Route::group(["middleware" => "auth"], function () {
    /** User Controller */
    Route::get('home/', [mahasiswa\DashboardController::class, 'index'])->name('dashboard');
    Route::get('home/myprofile', [mahasiswa\DashboardController::class, 'profilku'])->name('edit.mahasiswa');
    Route::put('home/myprofile/update', [mahasiswa\DashboardController::class, 'update'])->name('update.mahasiswa');
    Route::resource('home/mahasiswa', mahasiswa\MahasiswaController::class)->except([
        'create', 'show'
    ]);;
    Route::resource('home/perusahaan', mahasiswa\PerusahaanController::class)->except([
        'create', 'store', 'update', 'destroy'
    ]);
    Route::resource('home/jenisloker', mahasiswa\JenisLokerController::class)->except([
        'create', 'store', 'update', 'destroy'
    ]);
    Route::resource('home/loker', mahasiswa\LokerController::class)->except([
        'create', 'store', 'update', 'destroy'
    ]);
    Route::get('home/lokerku', [mahasiswa\LokerController::class, 'lokerku']);
    Route::get("home/loker/{loker}/submit", [mahasiswa\LokerController::class, "lamarkerja"]);
    Route::resource('home/lamar', mahasiswa\LamarController::class);





    Route::group(["middleware" => "roleAdmin"], function () {
        /** Admin Controller */
        Route::get('admin/', [admin\DashboardController::class, 'index'])->name('dashboard');
        Route::get('admin/myprofile', [admin\DashboardController::class, 'profilku'])->name('edit.admin');
        Route::put('admin/myprofile/update', [admin\DashboardController::class, 'update'])->name('update.admin');

        Route::get('verif', [admin\VerifController::class, 'index'])->name('verif');
        Route::get("verif/{mahasiswa}/acc", [admin\VerifController::class, "update_status"]);
        Route::resource('mahasiswa', admin\MahasiswaController::class);
        Route::resource('perusahaan', admin\PerusahaanController::class);
        Route::get("mahasiswa/{mahasiswa}/berkas/acc", [admin\BerkasController::class, "BerkasNew"])->name('berkas_acc');
        Route::resource('mahasiswa/{mahasiswa}/berkas', admin\BerkasController::class);
        Route::resource('jenisloker', admin\JenisLokerController::class);
        Route::resource('jurusan', admin\JurusanController::class);
        Route::resource('loker', admin\LokerController::class);
        Route::get('lamar/histori', [admin\LamarController::class, 'histori']);
        Route::resource('lamar', admin\LamarController::class);
        Route::resource('user', admin\UserController::class);
    });

    // Logout
    Route::get("auth/logout", [IndexController::class, "logout"])->name("signout"); // Dengan nama route 
});
