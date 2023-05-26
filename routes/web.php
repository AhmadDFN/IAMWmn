<?php

use App\Http\Controllers\MahasiswaController;
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
Route::controller(MahasiswaController::class)->group(function () {
    Route::get("mahasiswa", "index");
    Route::get("mahasiswa/form/{id_mahasiswa?}", "create");
    Route::get("mahasiswa/delete/{id_mahasiswa}", "destroy");
    Route::post("mahasiswa/save", "store");
});
