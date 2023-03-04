<?php

namespace App\Http\Controllers\Pembayaran;

use App\Helpers\BNIPayment;
use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\Biodata;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegistrasiController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = auth()->user();

            $pembayaran = $user->pembayaranRegistrasi();

            if( !is_null($pembayaran)) {
                if(checkBrivaStatus($pembayaran)) {
                    $pembayaran->status = true;
                    $pembayaran->save();

                    return response()->redirectToRoute('biodata.create');
                }
            }
            if(!$user->kelas->biaya_registrasi && bypassPembayaran($user->id, false)) {
                return response()->redirectToRoute('biodata.create');
            }

            return $next($request);
        });
    }

    public function index() {
        $user = auth()->user();

        $data = Pembayaran::where([
            ['user_id', $user->id],
            ['kategori', 'registrasi']
        ])->first();
        if(is_null($data)) {
            $biaya = $user->biaya();
            $response = json_decode(json_encode(createBriva('registrasi', $biaya, $user)));
            $data = $response->data;

            if($response->status == 'success') return response()->view('instruksi-pembayaran', compact('data'));
            else abort(500);
        } else return response()->view('instruksi-pembayaran', compact('data'));
    }

    public function makeBNIInvoice(){
        $user = auth()->user();
        $biaya = $user->biaya();

        $response = BNIPayment::createBNIInvoice([
            'trx_amount' => $biaya,
            'costumer_name' => $user->nama,
            'customer_email' => $user->email,
            'customer_phone' => $user->no_telepon,
            'datetime_expired' => date('c', time() + 24 * 3600)
        ]);

        try {
            Pembayaran::create([
                "user_id" => $user->id,
                "custCode" => $response['virtual_account'],
                "amount" => $biaya,
                "keterangan" => "Pembayaran registrasi PMB UNIGRES",
                "expiredDate" => date('c', time() + 24 * 3600),
                "kategori" => "registrasi",
                "add_info" => [
                    "trx_id" => $response['trx_id'],
                ]
            ]);
        } catch (\Throwable $e) {
            //
        }
    }

    public function choosePaymentMethod(){
        return response()->view('metode-pembayaran');
    }
}
