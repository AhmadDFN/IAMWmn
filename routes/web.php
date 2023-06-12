<?php

use App\Http\Controllers\kotaController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PerusahaanController;
use App\Models\Mahasiswa;
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

Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('perusahaan', PerusahaanController::class);
Route::get('/kota/{id_prov?}', [kotaController::class, 'getKotaByProvinsi'])->name('kota');

// Route::get('mahasiswa/form', [MahasiswaController::class, "create"]);

// Route::controller(MahasiswaController::class)->group(function () {
//     Route::get("mahasiswa", "index");
//     Route::get("mahasiswa/form/{id_mahasiswa?}", "create");
//     Route::post("mahasiswa/delete/{id_mahasiswa}", "destroy");
//     Route::post("mahasiswa/save", "store");
// });
