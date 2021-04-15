<?php

namespace App\Http\Controllers\Pembayaran;

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
            $token = getToken();
            $timestamp = gmdate("Y-m-d\TH:i:s.000\Z");

            $path = '/v1/briva/';
            $verb = 'POST';
            $custCode = $this->generateCustCode();
            $expDate = Carbon::tomorrow()->format('Y-m-d H:i:s');

            $data = [
                'institutionCode' => env('BRIVA_INSTITUTION_CODE'),
                'brivaNo' => env('BRIVA_NO'),
                'custCode' => $custCode,
                'nama' => auth()->user()->nama,
                'amount' => $biaya->biaya_registrasi,
                'keterangan' => 'Pendaftaran PMB Unigres',
                'expiredDate' => $expDate
            ];
            $payload = json_encode($data);

            $signature = generateSignature($path, $verb, $token, $timestamp, $payload);
            //             dd($signature);
            $url = env('BRIVA_APP_URL') . $path;

            $res = Http::withHeaders([
                'BRI-Signature' => $signature,
                'BRI-Timestamp' => $timestamp,
                'Content-Type' => 'application/json'
            ])->withToken($token)->post($url, $data);
            $response = json_decode($res->body());
            //dd($response);
            if ($response->status && $response->responseDescription == 'Success') {
                try {
                    $data = Pembayaran::create([
                        'user_id' => auth()->user()->id,
                        'custCode' => $custCode,
                        'amount' => $biaya->biaya_registrasi,
                        'keterangan' => 'Pendaftaran PMB Unigres',
                        'expiredDate' => $expDate,
                        'status' => false,
                        'kategori' => 'registrasi'
                    ]);

                    return response()->view('instruksi-pembayaran', compact('data'));
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            } else {
                if (!is_null($response->data)) {
                    $data = Pembayaran::updateOrCreate(
                        ['user_id' => auth()->user()->id], [
                        'custCode' => $response->data->custCode,
                        'amount' => $response->data->amount,
                        'keterangan' => 'Pendaftaran PMB Unigres',
                        'expiredDate' => $response->data->expiredDate,
                        'status' => false,
                        'kategori' => 'registrasi'
                    ]);
                    return response()->view('instruksi-pembayaran', compact('data'));
                } else {
                    abort(500);
                }

            }
        } else return response()->view('instruksi-pembayaran', compact('data'));

        // cek apakah sudah ada data pembayaran
//        if(!is_null($data)) {
//            // cek apakah pembayaran sudah expired
//            if($data->expiredDate < Carbon::now() && !$data->status) {
//                // todo: kalau expired hapus briva yang ada di server
//                $path = '/v1/briva/';
//                $verb = 'DELETE';
//
//                $data = [
//                    'institutionCode' => env('BRIVA_INSTITUTION_CODE') ,
//                    'brivaNo' => env('BRIVA_NO'),
//                    'custCode' => $data->custCode
//                ];
//                $payload = json_encode($data);
//
//                $signature = generateSignature($path, $verb, $token, $timestamp, $payload);
//                $url = env('BRIVA_APP_URL') . $path;
//                $res = Http::withHeaders([
//                    'BRI-Signature' => $signature,
//                    'BRI-Timestamp' => $timestamp,
//                ])->withToken($token)->delete($url, $data);
//
//                $response = json_decode($res->body());
//
//                if($response->status && $response->responseDescription == 'Success') {
//                    // todo: route instruksi pembayaran
//                    return response()->redirectToRoute('instruksi-pembayaran');
//                }
//            }
//        } else {
//
//        }

    }

    public function generateCustCode(): string
    {
        $count = Pembayaran::whereDate('created_at', Carbon::today())->where('kategori', 'registrasi')->count();
        $number = $count + 1;
        $date = date_format(Carbon::today(), 'ymd');
        $seq = substr(str_repeat(0, 4).$number, - 4);

        return $date . $seq;
    }
}
