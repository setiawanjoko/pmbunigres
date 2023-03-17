<?php

namespace App\Http\Controllers\Api;

use App\Helpers\BniEnc;
use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BNIController extends Controller
{
    public function callback()
    {
        // FROM BNI
        $client_id = config()->get('unigrespayment.bni.client_id');
        $secret_key = config()->get('unigrespayment.bni.client_secret');


        // URL utk simulasi pembayaran: http://dev.bni-ecollection.com/


        $data = file_get_contents('php://input');

        $data_json = json_decode($data, true);

        if (!$data_json) {
            // handling orang iseng
            echo '{"status":"999","message":"Jangan dibuat mainan ya!"}';
        } else {
            if ($data_json['client_id'] === $client_id) {
                $data_asli = BniEnc::decrypt(
                    $data_json['data'],
                    $client_id,
                    $secret_key
                );

                if (!$data_asli) {
                    // handling jika waktu server salah/tdk sesuai atau secret key salah
                    echo '{"status":"999","message":"waktu server tidak sesuai NTP atau secret key salah."}';
                } else {
                    // insert data asli ke db
                    /* $data_asli = array(
                            'trx_id' => '', // silakan gunakan parameter berikut sebagai acuan nomor tagihan
                            'virtual_account' => '',
                            'customer_name' => '',
                            'trx_amount' => '',
                            'payment_amount' => '',
                            'cumulative_payment_amount' => '',
                            'payment_ntb' => '',
                            'datetime_payment' => '',
                            'datetime_payment_iso8601' => '',
                        ); */
                    echo '{"status":"000"}';
                    exit;
                }
            }
        }
    }

    public function testCallback (Request $request) {
        $response = BniEnc::decrypt($request['data'], $request['client_id'], config()->get('unigrespayment.bni.client_secret'));
        Log::info('CALLBACK REQUEST DETECTED', [
            'API' => 'callback',
            'request-body' => $request,
            'decrypted-response' => $response
        ]);
        $pembayaran = Pembayaran::where('custCode', $response['virtual_account'])->first();


        $add_info = json_decode($pembayaran->add_info);
        $add_info->payment_amount = $response['payment_amount'];
        $add_info->cumulative_payment_amount = $response['cumulative_payment_amount'];
        $add_info->payment_ntb = $response['cumulative_payment_amount'];
        $add_info->datetime_payment = $response['cumulative_payment_amount'];
        $add_info->datetime_payment_iso8601 = $response['datetime_payment_iso8601'];

        try {
            $pembayaran->update([
                "status" => 1,
                "add_info" => json_encode($add_info)
            ]);

            return response()->json([
                "status" => "000"
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                "status" => "009"
            ], 422);
        }
    }
}
