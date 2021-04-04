<?php

use App\Http\Controllers\Admin\Api\BiayaController;
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
