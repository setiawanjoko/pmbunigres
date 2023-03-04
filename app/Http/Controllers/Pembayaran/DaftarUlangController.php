<?php

namespace App\Http\Controllers\Pembayaran;

use App\Helpers\BNIPayment;
use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DaftarUlangController extends Controller
{
    public function __construct()
    {
        // todo: cek nilai tes kesehatan jika ada
        $this->middleware(function ($request, $next) {
            $user = auth()->user();
            if(!is_null($user->moodleAccount->nilai_tpa)) {

                $pembayaran = $user->pembayaranDaftarUlang();

                if( !is_null($pembayaran)) {
                    if(checkBrivaStatus($pembayaran)) {
                        $pembayaran->status = true;
                        $pembayaran->save();

                        return response()->redirectToRoute('home');
                    }
                }
                if(!$user->kelas->biaya_daftar_ulang && bypassPembayaran($user->id, true)) {
                    return response()->redirectToRoute('home');
                }

                return $next($request);
            } else {
                return response()->redirectToRoute('tes-online.akademik');
            }
        });
    }

    public function index(){
        $user = auth()->user();

        $data = Pembayaran::where([
            ['user_id', $user->id],
            ['kategori', 'daftar_ulang']
        ])->first();
        if(is_null($data)) {
            $biaya = $user->biaya();
            $response = json_decode(json_encode(createBriva('daftar_ulang', $biaya, $user)));
            $data = $response->data;

            if($response->status == 'success') return response()->view('instruksi-pembayaran', compact('data'));
            else back()->with($response);
        } else {
            return response()->view('instruksi-pembayaran', compact('data'));
        }
    }

    public function printSKL(){
        //nama, no registrasi, prodi, gelombang
        $biodata = auth()->user()->biodata;
        $prodi = auth()->user()->prodi;
        $gelombang = auth()->user()->gelombang;
        $biaya = auth()->user()->biayaDaftarUlang();
        Carbon::setLocale('id');
        $tanggal = Carbon::now()->format('d F Y');
        $pembayaran = auth()->user()->pembayaranDaftarUlang();

        return response()->view('print-sk', compact('biodata', 'prodi', 'gelombang', 'biaya', 'tanggal', 'pembayaran'));
    }

    public function makeDaftarUlangInvoice()
    {
        $user = auth()->user();
        $biaya = $user->biaya();
        $date = date('c', time() + 24 * 3600);

        $response = BNIPayment::createBNIInvoice([
            'trx_amount' => $biaya->biaya_total_daftar_ulang,
            'customer_name' => $user->nama,
            'customer_email' => $user->email,
            'customer_phone' => $user->no_telepon,
            'datetime_expired' => $date
        ]);

        try {
            Pembayaran::create([
                "user_id" => $user->id,
                "custCode" => $response['virtual_account'],
                "amount" => $biaya->biaya_total_daftar_ulang,
                "keterangan" => "Pembayaran daftar ulang PMB UNIGRES",
                "expiredDate" => date('Y-m-d H:i:s', strtotime($date)),
                "kategori" => "daftar_ulang",
                "type" => "bni",
                "add_info" => json_encode([
                    "trx_id" => $response['trx_id'],
                ])
            ]);

            return redirect()->route('instruksi-bni');
        } catch (\Throwable $e) {
            dd($e);
        }
    }

    public function expiredDaftarUlang ()
    {
        $user = auth()->user();
        $data = Pembayaran::where('user_id', $user->id)->where('kategori', 'daftar_ulang')->where('status', '!=', 1)->first();

        if(date('Y-m-d H:i:s',strtotime($data->expiredDate)) <= date('Y-m-d H:i:s')){
            $data->delete();
            return $this->makeBNIInvoice();
        }
    }
}
