<?php

namespace App\Http\Controllers\Pembayaran;

use App\Helpers\BNIPayment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestControllerPayment extends Controller
{
    public function index(Request $request) {
        dd(BNIPayment::createBNIInvoice([
            'trx_amount' => $request->trx_amount,
            'costumer_name' => $request->customer_name
        ]));
    }

    public function updateTransaction(Request $request)
    {
        dd(BNIPayment::updateTransaction([
            'trx_id' => $request->trx_id,
            'trx_amount' => $request->trx_amount,
            'customer_name' => $request->customer_name
        ]));
    }

    public function inquiryBilling(Request $request) {
        dd(BNIPayment::inquiryBilling($request->trx_id));
    }
}
