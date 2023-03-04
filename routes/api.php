<?php

use App\Http\Controllers\Admin\Api\BiayaController;
use App\Http\Controllers\Admin\Api\RegisController;
use App\Http\Controllers\Administrator\Keuangan\BiayaController as MasterBiayaController;
use App\Http\Controllers\Administrator\Keuangan\PembayaranController;
use App\Http\Controllers\Administrator\Master\GelombangController;
use App\Http\Controllers\Administrator\Master\JalurMasukController;
use App\Http\Controllers\Administrator\Master\KelasController;
use App\Http\Controllers\Administrator\Master\ProgramStudiController;
use App\Http\Controllers\Api\BNIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('biaya')->group(function(){
    Route::get('/getKelas/byProdi/{prodi}', [BiayaController::class, 'getKelas'])->name('getKelasByProdi');
    Route::get('/getJalurMasuk/byKelas/{kelas}', [BiayaController::class, 'getJalurMasuk'])->name('getJalurMasukByKelas');
    Route::get('/getBiaya/byGelombang/{gelombang}/byKelas/{kelas}/byJalurMasuk/{jalurMasuk}', [BiayaController::class, 'getBiaya'])->name('getBiayaByGelombangByKelasByJalurMasuk');
});

Route::post('/test/payment', [\App\Http\Controllers\Pembayaran\TestControllerPayment::class, 'index']);

Route::post('/test/update-payment', [\App\Http\Controllers\Pembayaran\TestControllerPayment::class, 'updateTransaction']);

Route::name('regis.')->group(function () {
    Route::get('/getgelombang', [RegisController::class, 'get_gelombang'])->name('getGelombang');
    Route::get('/getprodi', [RegisController::class, 'get_prodi'])->name('getProdi');
    Route::get('/getjalurmasuk/{id}', [RegisController::class, 'get_jalur_masuk']);
    Route::get('/getjammasuk/{id}/{lulusan_unigres}', [RegisController::class, 'get_jam_masuk']);

    Route::get('/getenrollmentmethod/{phaseId}/{classId}', [RegisController::class, 'getJalurMasuk'])->name('getEnrollmentMethod');
});

/*
 *
 * [GET] /api/prodi
 *
 * */
Route::get('/prodi', [ProgramStudiController::class, 'getProdi']);

/*
 *
 * [GET] /api/prodi/{id}/kelas
 * Retrieve classes of selected major
 *
 * */
Route::get('/prodi/{id}/kelas', [ProgramStudiController::class, 'getProdiClass']);

/*
 *
 * [GET] /api/kelas/{id}
 * Retrieve selected class properties
 *
 * */
Route::get('/kelas/{id}', [KelasController::class, 'getClassProperty']);

/*
 *
 * [GET] /api/gelombang
 * Retrieve all ennrollment period
 *
 * */
Route::get('/gelombang', [GelombangController::class, 'getGelombang']);

/*
 *
 * [GET] /api/gelombang/{id}
 * Retrieve selected ennrollment period
 *
 * */
Route::get('/gelombang/{id}', [GelombangController::class, 'getGelombangProperty']);

/*
 *
 * [GET] /api/jalurmasuk
 * Retrieve all ennrollment method
 *
 * */
Route::get('/jalurmasuk', [JalurMasukController::class, 'getJalurMasuk']);

/*
 *
 * [GET] /api/jalurmasuk/{id}
 * Retrieve selected ennrollment method
 *
 * */
Route::get('/jalurmasuk/{id}', [JalurMasukController::class, 'getJalurMasukProperty']);

/*
 *
 * [GET] /api/biaya
 * Retrieve all costs
 *
 * */
Route::get('/biaya', [MasterBiayaController::class, 'getBiaya']);

/*
 *
 * [GET] /api/biaya/{id}
 * Retrieve selected cost
 *
 * */
Route::get('/biaya/{id}', [MasterBiayaController::class, 'getBiayaProperty']);

/*
 *
 * [GET] /api/pembayaran/{id}
 * Retrieve selected payment
 *
 * */
Route::get('/pembayaran/{id}', [PembayaranController::class, 'getPembayaranProperty']);

/**
 *
 * [POST] /api/payment/bni/callback
 * callback payment
 */
Route::post('payment/bni/callback', [BNIController::class, 'testCallback']);
