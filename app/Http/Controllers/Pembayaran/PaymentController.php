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
            $category = 'registrasi';
        } else if(is_null($user->pembayaranDaftarUlang())) {
            $cost = $costs->total_daftar_ulang;
            $category = 'daftar-ulang';
        }
        return response()->view('metode-pembayaran', compact('cost', 'category'));
    }

    public function showBNIInstruction(){
        $user = auth()->user();

        if(is_null($user->pembayaranRegistrasi()) && is_null($user->pembayaranDaftarUlang())) {
            return response()->redirectToRoute('biodata.create');
        }
        if(!$user->pembayaranRegistrasi()->status) {
            $data = $user->pembayaranRegistrasi();
            return response()->view('instruksi-bni', compact('data'));
        }
        if(!$user->pembayaranDaftarUlang()->status) {
            $data = $user->pembayaranDaftarUlang();
            return response()->view('instruksi-bni', compact('data'));
        }

        return response()->redirectToRoute('biodata.create');
    }

    public function showBrivaInstruction(){
        $user = auth()->user();

        if(is_null($user->pembayaranRegistrasi()) && is_null($user->pembayaranDaftarUlang())) {
            return response()->redirectToRoute('biodata.create');
        }
        if(!$user->pembayaranRegistrasi()->status) {
            $data = $user->pembayaranRegistrasi();
            return response()->view('instruksi-briva', compact('data'));
        }
        if(!$user->pembayaranDaftarUlang()->status) {
            $data = $user->pembayaranDaftarUlang();
            return response()->view('instruksi-briva', compact('data'));
        }

        return response()->redirectToRoute('biodata.create');
    }
}
