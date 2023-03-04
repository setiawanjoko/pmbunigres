<?php

namespace App\Http\Controllers\Pembayaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function choosePaymentMethod(){
        $user = auth()->user();
        $costs = $user->biaya();

        if(is_null($user->pembayaranRegistrasi())) {
            $cost = $costs->biaya_registrasi;
        } else if(is_null($user->pembayaranDaftarUlang())) {
            $cost = $costs->total_daftar_ulang;
        }
        return response()->view('metode-pembayaran', compact('cost'));
    }

    public function showBNIInstruction(){
        $user = auth()->user();

        if(!$user->pembayaranRegistrasi()->status) {
            // TODO: isi instruksi BNI dengan data $user->pembayaranRegistrasi()
            $data = $user->pembayaranRegistrasi();
            return response()->view('instruksi-bni', compact('data'));
        }
        if(!$user->pembayaranDaftarUlang()->status) {
            // TODO: isi instruksi BNI dengan data $user->pembayaranDaftarUlang()
            $data = $user->pembayaranDaftarUlang();
            return response()->view('instruksi-bni', compact('data'));
        }
        // TODO: berarti sudah dibayar, atau masih kosong
    }

    public function showBrivaInstruction(){
        $user = auth()->user();

        if(!$user->pembayaranRegistrasi()->status) {
            // TODO: isi instruksi BNI dengan data $user->pembayaranRegistrasi()
            $data = $user->pembayaranRegistrasi();
            return response()->view('instruksi-briva', compact('data'));
        }
        if(!$user->pembayaranDaftarUlang()->status) {
            // TODO: isi instruksi BNI dengan data $user->pembayaranDaftarUlang()
            $data = $user->pembayaranDaftarUlang();
            return response()->view('instruksi-briva', compact('data'));
        }
        // TODO: berarti sudah dibayar, atau masih kosong
    }
}
