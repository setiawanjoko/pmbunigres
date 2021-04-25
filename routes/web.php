<?php

use App\Http\Controllers\Admin\GelombangController;
use App\Http\Controllers\Admin\JenjangController;
use App\Http\Controllers\Admin\FakultasController;
use App\Http\Controllers\Admin\KeuanganController;
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
use App\Http\Controllers\Mahasiswa\MoodleAccountController;
use App\Http\Controllers\Mahasiswa\BerkasController;
use App\Http\Controllers\Mahasiswa\TesAkademikController;
use App\Http\Controllers\Mahasiswa\TesKesehatanController;
use App\Http\Controllers\Monitoring\PendaftarController as MonitoringPendaftarController;
use App\Http\Controllers\Pembayaran\DaftarUlangController;
use App\Http\Controllers\Pembayaran\RegistrasiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PengumumanPageController;
use App\Http\Controllers\Pembayaran\SklController;

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

            Route::name('tes-online.')->group(function(){
                Route::get('/tes-akademik', [TesAkademikController::class, 'index'])->name('akademik');
                Route::get('/tes-kesehatan', [TesKesehatanController::class, 'index'])->name('kesehatan');
            });
        });
        Route::get('/daftar-ulang', [DaftarUlangController::class, 'index'])->name('daftar-ulang');
        Route::get('/print-sk', [SklController::class, 'printSKL'])->name('print-sk');
    });
});

Route::prefix('/admin')->name('admin.')->group(function(){
    Route::middleware(['can:monitor'])->name('monitoring.')->prefix('/monitoring')->group(function(){
        Route::name('pendaftar.')->prefix('/pendaftar')->group(function(){
            Route::get('/', [MonitoringPendaftarController::class, 'index'])->name('index');
            Route::post('/', [MonitoringPendaftarController::class, 'filter'])->name('filter');
            Route::get('/biodata/{id}', [MonitoringPendaftarController::class, 'biodata'])->name('biodata.index');
            Route::get('/keluarga/{id}', [MonitoringPendaftarController::class, 'keluarga'])->name('keluarga.index');
            Route::get('/berkas/{id}', [MonitoringPendaftarController::class, 'berkas'])->name('berkas.index');

            Route::middleware(['can:admin'])->group(function(){
                Route::get('/biodata/{id}/edit', [MonitoringPendaftarController::class, 'editBiodata'])->name('biodata.edit');
                Route::put('/biodata/{id}', [MonitoringPendaftarController::class, 'updateBiodata'])->name('biodata.update');
                Route::get('/keluarga/{id}/edit', [MonitoringPendaftarController::class, 'editKeluarga'])->name('keluarga.edit');
                Route::put('/keluarga/{id}', [MonitoringPendaftarController::class, 'updateKeluarga'])->name('keluarga.update');
                Route::get('/berkas/{id}/edit', [MonitoringPendaftarController::class, 'editBerkas'])->name('berkas.edit');
                Route::put('/berkas/{id}', [MonitoringPendaftarController::class, 'updateBerkas'])->name('berkas.update');
            });
        });
    });
    Route::middleware(['can:kesehatan'])->name('tes-kesehatan.')->group(function(){
        Route::get('/tes-kesehatan', [AdminTesKesehatanController::class, 'index'])->name('index');
        Route::get('/tes-kesehatan/edit/{id}/{aksi}', [AdminTesKesehatanController::class, 'edit'])->name('edit');
    });
    Route::middleware(['can:admin'])->group(function(){
        Route::resource('/gelombang', GelombangController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
        Route::resource('/fakultas', FakultasController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
        Route::resource('/jenjang', JenjangController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
        Route::resource('/prodi', ProdiController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
        Route::resource('/pengumuman', PengumumanController::class)->only(['index','create','store','destroy']);
        Route::resource('/tes-tpa', TesTPAController::class)->only(['index', 'store']);

        Route::resource('/pengaturan-gelombang', PengaturanGelombangController::class)->only(['index', 'store', 'destroy']);
        Route::get('/biaya/sunting', [PengaturanGelombangController::class, 'sunting'])->name('biaya.sunting');
        Route::post('/biaya/sunting', [PengaturanGelombangController::class, 'suntingSimpan'])->name('biaya.sunting.update');
    });
    Route::middleware(['can:keuangan'])->group(function () {
        Route::resource('/pengaturan-gelombang', PengaturanGelombangController::class)->only(['index', 'store', 'destroy']);
        Route::get('/biaya/sunting', [PengaturanGelombangController::class, 'sunting'])->name('biaya.sunting');
        Route::post('/biaya/sunting', [PengaturanGelombangController::class, 'suntingSimpan'])->name('biaya.sunting.update');
        Route::name('keuangan.')->group(function(){
            Route::prefix('/briva')->name('briva-search.')->group(function(){
                Route::get('/', [KeuanganController::class, 'brivaSearchIndex'])->name('index');
                Route::post('/', [KeuanganController::class, 'brivaSearchShow'])->name('show');
                Route::put('/', [KeuanganController::class, 'brivaConfirm'])->name('confirm');
            });
            Route::prefix('/pembayaran')->name('pembayaran.')->group(function(){
                Route::get('/', [KeuanganController::class, 'pembayaranIndex'])->name('index');
                Route::post('/', [KeuanganController::class, 'pembayaranFilter'])->name('filter');
                Route::get('/refresh', [KeuanganController::class, 'getLatestBrivaStatus'])->name('refresh');
            });
        });
    });
});

Route::middleware(['auth', 'can:keuangan'])->prefix('/keuangan')->name('keuangan.')->group(function(){
    Route::get('/check-status', [CheckStatusController::class, 'index'])->name('check-status');
    Route::post('/check-status', [CheckStatusController::class, 'index'])->name('check-status.filter');
});
