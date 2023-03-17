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

    public function checker(Request $request) {
        $pembayaran = Pembayaran::where('custCode', $request->bniva)->first();

        if (is_null($pembayaran)){
            return redirect()->route('administrator.keuangan.check.bniva')->with([
                "status" => "danger",
                "message" => "Virtual account tidak terdaftar di PMB Unigres"
            ]);
        } else {
            $addInfo = json_decode($pembayaran->add_info);
            $response = BNIPayment::inquiryBilling($addInfo->trx_id);

            if($response['va_status'] === "2"){
                $pembayaran->status = 1;
                $pembayaran->update();
            }

            return view('administrator.keuangan.check-bniva', compact('response'));
        }
    }
}
