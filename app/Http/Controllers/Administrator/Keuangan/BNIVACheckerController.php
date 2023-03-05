<?php

namespace App\Http\Controllers\Administrator\Keuangan;

use App\Helpers\BNIPayment;
use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class BNIVACheckerController extends Controller
{
    public function index() {
        return view('administrator.keuangan.check-bniva');
    }

    public function checker($bniava) {
        $pembayaran = Pembayaran::where('custCode', $bniava)->first();

        $addInfo = json_decode($pembayaran->add_info);
        $response = BNIPayment::inquiryBilling($addInfo->trx_id);

        return redirect()->route('administrator.keuangan.checkva')->with($response);
    }
}
