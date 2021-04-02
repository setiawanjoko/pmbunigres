<?php

use App\Http\Controllers\Admin\GelombangController;
use App\Http\Controllers\Admin\JenjangController;
use App\Http\Controllers\Admin\FakultasController;
use App\Http\Controllers\Admin\PendaftarController;
use App\Http\Controllers\Admin\PengaturanGelombangController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\ProdiController;
use App\Http\Controllers\Admin\TesKesehatanController as AdminTesKesehatanController;
use App\Http\Controllers\Admin\TesTPAController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Keuangan\CheckStatusController;
use App\Http\Controllers\Mahasiswa\BiodataController;
use App\Http\Controllers\Mahasiswa\KeluargaController;
use App\Http\Controllers\Mahasiswa\LinkTesTPAController;
use App\Http\Controllers\Mahasiswa\MoodleAccountController;
use App\Http\Controllers\Mahasiswa\BerkasController;
use App\Http\Controllers\Mahasiswa\TesKesehatanController;
use App\Http\Controllers\Pembayaran\DaftarUlangController;
use App\Http\Controllers\Pembayaran\RegistrasiController;
use App\Http\Controllers\RegisNersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PengumumanPageController;

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
Route::get('/', [LandingPageController::class, 'index'])->name('homepage');
Route::get('pengumuman', [PengumumanPageController::class, 'index'])->name('pengumuman');

Route::get('kontak', function () {
    return view('contact');
})->name('kontak');

Route::get('getprodi', [RegisterController::class, 'get_prodi']);
Route::get('getjalurmasuk/{id}', [RegisterController::class, 'get_jalur_masuk']);
Route::get('getjammasuk/{id}/{lulusan_unigres}', [RegisterController::class, 'get_jam_masuk']);

Auth::routes(['verify'=>true]);
Route::get('/verify/failed', [VerificationController::class, 'warning'])->name('verification.failed');

Route::middleware(['auth', 'verify', 'can:camaba'])->group(function(){
    Route::get('/instruksi-pembayaran', [RegistrasiController::class, 'index'])->name('instruksi-bayar');
    Route::middleware(['paid.registration'])->group(function(){
        Route::middleware(['paid.reregistration'])->group(function(){
            Route::get('/home', [HomeController::class, 'index'])->name('home');
            Route::get('/biodata', [BiodataController::class, 'create'])->name('biodata.create');
            Route::post('/biodata', [BiodataController::class, 'store'])->name('biodata.store');
            Route::get('/keluarga', [KeluargaController::class, 'create'])->name('keluarga.create');
            Route::post('/keluarga', [KeluargaController::class, 'store'])->name('keluarga.store');
            Route::get('/berkas', [BerkasController::class, 'create'])->name('berkas.create');
            Route::post('/berkas', [BerkasController::class, 'store'])->name('berkas.store');
            Route::get('/informasi-tpa', [MoodleAccountController::class, 'index'])->name('moodle');
            Route::get('/tes-kesehatan', [TesKesehatanController::class, 'index'])->name('tes-kesehatan');
        });
        Route::get('/daftar-ulang', [DaftarUlangController::class, 'index'])->name('daftar-ulang');
    });
});

Route::middleware(['auth', 'can:admin'])->prefix('/admin')->name('admin.')->group(function(){
    Route::resource('/gelombang', GelombangController::class)->only(['index', 'create', 'store','destroy']);
    Route::resource('/fakultas', FakultasController::class)->only(['index', 'create', 'store','destroy']);
    Route::resource('/jenjang', JenjangController::class)->only(['index', 'create', 'store','destroy']);
    Route::resource('/prodi', ProdiController::class)->only(['index', 'create', 'store','destroy']);
    Route::resource('/pengumuman', PengumumanController::class)->only(['index','create','store','destroy']);
    Route::resource('/tes-kesehatan', AdminTesKesehatanController::class)->only(['index', 'store', 'edit']);
    Route::resource('/tes-tpa', TesTPAController::class)->only(['index', 'store']);
    Route::resource('/pendaftar', PendaftarController::class)->only(['index']);

    Route::resource('/pengaturan-gelombang', PengaturanGelombangController::class)->only(['index', 'store', 'destroy']);
    Route::get('/biaya/sunting', [PengaturanGelombangController::class, 'sunting'])->name('biaya.sunting');
    Route::post('/biaya/sunting', [PengaturanGelombangController::class, 'suntingSimpan'])->name('biaya.sunting.update');
});

Route::middleware(['auth', 'can:keuangan'])->prefix('/keuangan')->name('keuangan.')->group(function(){
    Route::get('/check-status', [CheckStatusController::class, 'index'])->name('check-status');
    Route::post('/check-status', [CheckStatusController::class, 'index'])->name('check-status.filter');
});
