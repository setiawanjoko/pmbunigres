<?php

use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Mahasiswa\BiodataController;
use App\Http\Controllers\Mahasiswa\KeluargaController;
use App\Http\Controllers\Mahasiswa\ProdiPilihanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('homepage');


//    Route::get('/register', [RegisterController::class, 'index'])->name('mahasiswa.register');
//    Route::post('/register', [RegisterController::class, 'store'])->name('mahasiswa.register.store');


Auth::routes(['verify'=>true]);
Route::get('/verify/failed', [VerificationController::class, 'warning'])->name('verification.failed');

Route::middleware(['auth', 'verify'])->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/biodata', [BiodataController::class, 'create'])->name('biodata.create');
    Route::post('/biodata', [BiodataController::class, 'store'])->name('biodata.store');
    Route::get('/keluarga', [KeluargaController::class, 'create'])->name('keluarga.create');
    Route::post('/keluarga', [KeluargaController::class, 'store'])->name('keluarga.store');
    Route::get('/prodi-pilihan', [ProdiPilihanController::class, 'create'])->name('prodi-pilihan.create');
    Route::post('/prodi-pilihan', [ProdiPilihanController::class, 'store'])->name('prodi-pilihan.store');
});
