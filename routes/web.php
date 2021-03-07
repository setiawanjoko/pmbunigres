<?php

use App\Http\Controllers\Admin\GelombangController;
use App\Http\Controllers\Admin\JenjangController;
use App\Http\Controllers\Admin\PendaftarController;
use App\Http\Controllers\Admin\PengaturanGelombangController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\ProdiController;
use App\Http\Controllers\Admin\TesTPAController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Mahasiswa\BiodataController;
use App\Http\Controllers\Mahasiswa\KeluargaController;
use App\Http\Controllers\Mahasiswa\LinkTesTPAController;
use App\Http\Controllers\Mahasiswa\MoodleAccountController;
use App\Http\Controllers\Mahasiswa\BerkasController;
use App\Http\Controllers\Pembayaran\RegistrasiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('pengumuman', function () {
    return view('pengumuman');
})->name('pengumuman');

//    Route::get('/register', [RegisterController::class, 'index'])->name('mahasiswa.register');
//    Route::post('/register', [RegisterController::class, 'store'])->name('mahasiswa.register.store');


Auth::routes(['verify'=>true]);
Route::get('/verify/failed', [VerificationController::class, 'warning'])->name('verification.failed');

Route::middleware(['auth', 'verify'])->group(function(){
    Route::get('/instruksi-pembayaran', [RegistrasiController::class, 'index'])->name('instruksi-bayar');
    Route::middleware(['paid.registration'])->group(function(){
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::get('/biodata', [BiodataController::class, 'create'])->name('biodata.create');
        Route::post('/biodata', [BiodataController::class, 'store'])->name('biodata.store');
        Route::get('/keluarga', [KeluargaController::class, 'create'])->name('keluarga.create');
        Route::post('/keluarga', [KeluargaController::class, 'store'])->name('keluarga.store');
        Route::get('/berkas', [BerkasController::class, 'create'])->name('berkas.create');
        Route::post('/berkas', [BerkasController::class, 'store'])->name('berkas.store');
//        Route::get('/prodi-pilihan', [ProdiPilihanController::class, 'create'])->name('prodi-pilihan.create');
//        Route::post('/prodi-pilihan', [ProdiPilihanController::class, 'store'])->name('prodi-pilihan.store');
        Route::get('/informasi-tpa', [MoodleAccountController::class, 'index'])->name('moodle');
        Route::get('/nilai/{id}', [MoodleAccountController::class, 'checkNilai']);
        Route::get('/link-tes', [LinkTesTPAController::class, 'index'])->name('link-tes.index');
        Route::post('/link-tes', [LinkTesTPAController::class, 'store'])->name('link-tes.store');
    });
});

Route::middleware(['auth', 'can:admin'])->prefix('/admin')->name('admin.')->group(function(){
    Route::resource('/gelombang', GelombangController::class)->only(['index', 'create', 'store','destroy']);
    Route::resource('/jenjang', JenjangController::class)->only(['index', 'create', 'store','destroy']);
    Route::resource('/prodi', ProdiController::class)->only(['index', 'create', 'store']);
    Route::resource('/pengaturan-gelombang', PengaturanGelombangController::class)->only(['index', 'create', 'store']);
    Route::resource('/pengumuman', PengumumanController::class)->only(['index', 'create', 'store']);
    Route::resource('/tes-tpa', TesTPAController::class)->only(['index', 'store']);
    Route::resource('/pendaftar', PendaftarController::class)->only(['index']);
});
