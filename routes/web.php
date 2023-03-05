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
use App\Http\Controllers\Administrator\DashboardController;
use App\Http\Controllers\Administrator\Keuangan\BiayaController as MasterBiayaController;
use App\Http\Controllers\Administrator\Keuangan\BrivaController;
use App\Http\Controllers\Administrator\Keuangan\PembayaranController;
use App\Http\Controllers\Administrator\Master\FakultasController as MasterFakultasController;
use App\Http\Controllers\Administrator\Master\GelombangController as MasterGelombangController;
use App\Http\Controllers\Administrator\Master\JalurMasukController;
use App\Http\Controllers\Administrator\Master\JenjangController as MasterJenjangController;
use App\Http\Controllers\Administrator\Master\KelasController as MasterKelasController;
use App\Http\Controllers\Administrator\Master\PengumumanController as MasterPengumumanController;
use App\Http\Controllers\Administrator\Master\ProgramStudiController as MasterProgramStudiController;
use App\Http\Controllers\Administrator\PendaftarController as AdminPendaftarController;
use App\Http\Controllers\Administrator\Pengaturan\SiakadController;
use App\Http\Controllers\Administrator\Pengaturan\TandatanganSKLController;
use App\Http\Controllers\Administrator\TesOnlineController;
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
use App\Http\Controllers\Pembayaran\PaymentController;
use App\Http\Controllers\Pembayaran\RegistrasiController;
use App\Models\ServerSetting;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Pembayaran\BNIPaymentController;
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
    Route::name('payment.')->group(function(){
        Route::get('/metode-pembayaran', [PaymentController::class, 'choosePaymentMethod'])->name('choose-payment-method');
        Route::get('/instruksi-pembayaran', [RegistrasiController::class, 'index'])->name('instruksi-bayar');
        Route::get('/instruksi-bni', [PaymentController::class, 'showBNIInstruction'])->name('instruksi-bni');
        Route::get('/instruksi-briva', [PaymentController::class, 'showBRIVAInstruction'])->name('instruksi-briva');
        Route::prefix('/registrasi')->name('registrasi')->group(function(){
            Route::get('/create-bni', [RegistrasiController::class, 'makeBNIInvoice'])->name('create-bni');
            Route::get('/expired', [RegistrasiController::class, 'expired'])->name('expiredPayment');
        });
        Route::prefix('/daftar-ulang')->name('daftar-ulang.')->group(function(){
            Route::get('/create-bni', [DaftarUlangController::class, 'makeDaftarUlangInvoice'])->name('create-bni');
            Route::get('/expired', [DaftarUlangController::class, 'expiredDaftarUlang'])->name('expiredPayment');
        });
    });
    Route::middleware(['payment.checkRegistration'])->group(function(){
        Route::middleware(['payment.checkHeregistration'])->group(function(){
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
            Route::get('/email/confirm/{id}', [MonitoringPendaftarController::class, 'emailConfirm'])->name('email.confirm');
            Route::get('/email/resent/{id}', function ($id){
               $data = User::find($id);
               $data->sendEmailVerificationNotification();

               return redirect()->back()->with(['status'=>'success', 'message'=>'Email berhasil dikirimkan.']);
            })->name('email.resent');


            Route::get('/index-dev', [MonitoringPendaftarController::class, 'indexDev'])->name('index-dev');
            Route::get('/tagihan/registrasi/{id}', [MonitoringPendaftarController::class, 'tagihanRegistrasi'])->name('tagihan.registrasi');
            Route::get('/tagihan/daftar-ulang/{id}', [MonitoringPendaftarController::class, 'tagihanDaftarUlang'])->name('tagihan.daftar-ulang');

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

Route::middleware(['auth'])->prefix('/administrator')->name('administrator.')->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::name('monitoring.')->group(function(){
        Route::prefix('/pendaftar')->name('pendaftar.')->middleware('can:monitor')->group(function(){
            Route::get('/', [AdminPendaftarController::class, 'index'])->name('index');
            Route::post('/filter', [AdminPendaftarController::class, 'filter'])->name('filter');
            Route::get('/{id}', [AdminPendaftarController::class, 'show'])->name('show');
            Route::post('/', [AdminPendaftarController::class, 'store'])->name('store');
            Route::delete('/{id}', [AdminPendaftarController::class, 'destroy'])->name('destroy');

            Route::prefix('/export')->name('export.')->group(function(){
                Route::get('/excel', [AdminPendaftarController::class, 'exportExcel'])->name('excel');
                Route::get('/csv', [AdminPendaftarController::class, 'exportCSV'])->name('csv');
                Route::get('/api', [AdminPendaftarController::class, 'exportAPI'])->name('api');
            });
        });

        Route::prefix('/tes-online')->name('tes-online.')->middleware('can:kesehatan')->group(function(){
            Route::get('/', [TesOnlineController::class, 'index'])->name('index');
            Route::post('/filter', [TesOnlineController::class, 'filter'])->name('filter');
            Route::get('/kesehatan/{id}/{action}', [TesOnlineController::class, 'medicalAction'])->name('medicalAction');
            Route::post('/akademik', [TesOnlineController::class, 'academicAction'])->name('academicAction');
        });
    });

    Route::name('master.')->middleware('can:admin')->group(function(){
        Route::resource('fakultas', MasterFakultasController::class)->only(['index', 'store', 'destroy']); // DONE
        Route::resource('gelombang', MasterGelombangController::class)->only(['index', 'store', 'destroy']); // DONE
        Route::resource('jenjang', MasterJenjangController::class)->only(['index', 'store', 'destroy']); // DONE
        Route::resource('kelas', MasterKelasController::class)->only(['index', 'store', 'show', 'destroy']); // DONE
        Route::resource('pengumuman', MasterPengumumanController::class)->only(['index', 'store', 'destroy']); // DONE
        Route::resource('prodi', MasterProgramStudiController::class)->only(['index', 'store', 'destroy']); // DONE
        Route::resource('jalur-masuk', JalurMasukController::class)->only(['index', 'store', 'destroy']); // DONE

        Route::prefix('/pengumuman')->name('pengumuman.brosur.')->group(function(){
            Route::post('/brosur', [MasterPengumumanController::class, 'brochureStore'])->name('store');
            Route::delete('/brosur/{id}', [MasterPengumumanController::class, 'brochureDestroy'])->name('destroy');
        });
    });

    Route::name('keuangan.')->middleware('can:keuangan')->group(function(){
        Route::resource('biaya', MasterBiayaController::class)->only(['index', 'store', 'destroy']);
        Route::prefix('/biaya')->name('biaya.')->group(function(){
            Route::post('/filter', [MasterBiayaController::class, 'filter'])->name('filter');
        });

        Route::resource('pembayaran', PembayaranController::class)->only(['index', 'destroy']);
        Route::prefix('/pembayaran')->name('pembayaran.')->group(function(){
            // Internal data manipulation
            Route::post('/filter', [PembayaranController::class, 'filter'])->name('filter');
            Route::post('/report', [PembayaranController::class, 'report'])->name('report');

            // BRIVA data manipulation (Local & BRI)
            Route::get('/check/{id}', [PembayaranController::class, 'check'])->name('check');
            Route::post('/confirm', [PembayaranController::class, 'confirm'])->name('confirm');
            Route::get('/renew/{id}', [PembayaranController::class, 'renew'])->name('renew');
            Route::get('/delete/{id}', [PembayaranController::class, 'delete'])->name('delete');
        });

        Route::group([
            'prefix' => '/briva',
            'as' => 'briva.'
        ], function(){
            Route::get('/', [BrivaController::class, 'index'])->name('index');
            Route::get('/{custCode}', [BrivaController::class, 'show'])->name('show');
            Route::get('/delete/{custCode}', [BrivaController::class, 'destroy'])->name('destroy');
        });
    });

    Route::name('pengaturan.')->middleware('can:admin')->group(function(){
        Route::resource('siakad', SiakadController::class)->only(['index', 'store']);
        Route::resource('skl', TandatanganSKLController::class)->only(['index', 'store', 'destroy']);
    });
});

Route::middleware(['auth', 'can:keuangan'])->prefix('/keuangan')->name('keuangan.')->group(function(){
    Route::get('/check-status', [CheckStatusController::class, 'index'])->name('check-status');
    Route::post('/check-status', [CheckStatusController::class, 'index'])->name('check-status.filter');
});


Route::get('/artisan', function (){
    Artisan::call('storage:link');
});

/**
 * TESTING ROUTE API BNI
 * bisa di hapus setelah selesai testing
 */
