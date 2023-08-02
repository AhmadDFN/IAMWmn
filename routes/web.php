<?php


use App\Http\Controllers\iamw;
use App\Http\Controllers\mahasiswa;
use App\Http\Controllers\perusahaan;
use App\Http\Controllers\admin;
use App\Http\Controllers\admin\LamarController;
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
Route::get("verif/email/{mahasiswa}/acc/{token}", [admin\VerifController::class, "email_update"]);
// Kota - Provinsi
Route::get('/test', function () {
    return view("admin.verif.verif");
});
Route::get('/kota/{id_prov?}', [kotaController::class, 'getKotaByProvinsi'])->name('kota');

Route::group(["middleware" => "auth"], function () {

    Route::group(["middleware" => "roleMahasiswa"], function () {
        /** Mahasiswa Controller */
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
    });

    Route::group(["middleware" => "rolePerusahaan"], function () {
        /** Perusahaan Controller */
        Route::get('perusahaan/dashboard', [perusahaan\DashboardController::class, 'index'])->name('dashboard');
        Route::get('perusahaan/myprofile', [perusahaan\DashboardController::class, 'profilku'])->name('edit.perusahaan');
        Route::put('perusahaan/myprofile/update', [perusahaan\DashboardController::class, 'update'])->name('update.perusahaan');
        Route::get('perusahaan/myprofile', [perusahaan\DashboardController::class, 'profilku'])->name('edit.perusahaan');
        Route::put('perusahaan/myprofile/update', [perusahaan\DashboardController::class, 'update'])->name('update.perusahaan');

        Route::get('perusahaan/lamar', [perusahaan\LamarController::class, 'indexPerusahaan']);
        Route::get("perusahaan/lamar/{lamar}/status/{lamar_status}", [perusahaan\LamarController::class, "update_status"]);
        Route::get("perusahaan/lamar/{loker}/detail/{status?}", [perusahaan\LamarController::class, "detail_lowonganPerusahaan"]);
        Route::get("perusahaan/mahasiswa/{mahasiswa}/berkas/tampil", [perusahaan\LamarController::class, "pemberkasan"]);
        Route::resource('perusahaan/loker', perusahaan\LokerController::class);
    });

    Route::group(["middleware" => "roleAdmin"], function () {
        /** Admin Controller */
        Route::get('admin/', [admin\DashboardController::class, 'index'])->name('dashboard');
        Route::get('admin/myprofile', [admin\DashboardController::class, 'profilku'])->name('edit.admin');
        Route::put('admin/myprofile/update', [admin\DashboardController::class, 'update'])->name('update.admin');

        Route::get('verif', [admin\VerifController::class, 'index'])->name('verif');
        Route::get("verif/{mahasiswa}/acc", [admin\VerifController::class, "update_status"]);
        Route::get("mahasiswa/{mahasiswa}/berkas/tampil", [admin\MahasiswaController::class, "pemberkasan"]);
        Route::resource('mahasiswa', admin\MahasiswaController::class);
        Route::resource('perusahaan', admin\PerusahaanController::class);
        Route::get("mahasiswa/{mahasiswa}/berkas/acc", [admin\BerkasController::class, "BerkasNew"])->name('berkas_acc');
        Route::resource('mahasiswa/{mahasiswa}/berkas', admin\BerkasController::class);
        Route::resource('jenisloker', admin\JenisLokerController::class);
        Route::resource('jurusan', admin\JurusanController::class);
        Route::resource('loker', admin\LokerController::class);
        Route::get("lamar/update/{id_loker}/{status}", [admin\LamarController::class, "update_all"]);
        Route::get("lamar/{loker}/detail", [admin\LamarController::class, "detail_lowongan"]);
        Route::get("lamar/{loker}/detail/accept", [admin\LamarController::class, "detail_lowongan_accept"]);
        Route::get("lamar/{loker}/detail/denied", [admin\LamarController::class, "detail_lowongan_denied"]);
        Route::get("lamar/{lamar}/status/{lamar_status}", [admin\LamarController::class, "update_status"]);
        Route::get('lamar/histori', [admin\LamarController::class, 'histori']);
        Route::get('lamar/perusahaan', [admin\LamarController::class, 'indexPerusahaan']);
        Route::get("lamar/{loker}/detail/perusahaan/{status?}", [admin\LamarController::class, "detail_lowonganPerusahaan"]);
        Route::resource('lamar', admin\LamarController::class);
        Route::resource('user', admin\UserController::class);
    });

    // Logout
    Route::get("auth/logout", [IndexController::class, "logout"])->name("signout"); // Dengan nama route 
});
