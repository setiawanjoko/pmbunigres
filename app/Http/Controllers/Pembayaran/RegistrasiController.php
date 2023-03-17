<?php

namespace App\Http\Controllers\Pembayaran;

use App\Helpers\BNIPayment;
use App\Http\Controllers\Controller;
use App\Mail\BNIInvoiceMail;
use App\Models\Biaya;
use App\Models\Biodata;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class RegistrasiController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = auth()->user();

            $pembayaran = $user->pembayaranRegistrasi();

            if( !is_null($pembayaran) && $pembayaran->type == 'briva') {
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
        $date = date('c', time() + 24 * 3600);



        try {
            $response = BNIPayment::createBNIInvoice([
                'trx_amount' => $biaya->biaya_registrasi,
                'customer_name' => $user->nama,
                'customer_email' => $user->email,
                'customer_phone' => $user->no_telepon,
                'datetime_expired' => $date
            ]);

            if($response['status'] != '000') return redirect()->route('metode-pembayaran');

            $data = Pembayaran::create([
                "user_id" => $user->id,
                "custCode" => $response['virtual_account'],
                "amount" => $biaya->biaya_registrasi,
                "keterangan" => "Pembayaran registrasi PMB UNIGRES",
                "expiredDate" => date('Y-m-d H:i:s', strtotime($date)),
                "kategori" => "registrasi",
                "type" => "bni",
                "add_info" => json_encode([
                    "trx_id" => $response['trx_id'],
                ])
            ]);

            Mail::to($user->email)->send(new BNIInvoiceMail($user, $data));

            return redirect()->route('payment.instruksi-bni');
        } catch (\Throwable $e) {
            dd($e);
        }
    }

    public function expired(){
        $user = auth()->user();
        $data = Pembayaran::where('user_id', $user->id)->where('kategori', 'registrasi')->where('status', '!=', 1)->first();

        if(is_null($data)) return response()->redirectToRoute('biodata.create');

        if(date('Y-m-d H:i:s',strtotime($data->expiredDate)) <= date('Y-m-d H:i:s')){
            $data->delete();
            return $this->makeBNIInvoice();
        }
    }

    public function choosePaymentMethod(){
        return response()->view('metode-pembayaran');
    }
}
