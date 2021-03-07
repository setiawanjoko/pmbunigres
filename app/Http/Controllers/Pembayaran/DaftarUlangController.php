<?php

namespace App\Http\Controllers\Pembayaran;

use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DaftarUlangController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = auth()->user();
            if(!is_null($user->moodleAccount->nilai_tpa)) {
                $pembayaran = $user->pembayaranDaftarUlang();

                if (!is_null($pembayaran)) {
                    if (checkBrivaStatus($pembayaran)) {
                        $pembayaran->status = true;
                        $pembayaran->save();

                        return response()->redirectToRoute('biodata.create');
                    }
                }

                return $next($request);
            }

            return response()->redirectToRoute('moodle');
        });
    }

    public function index(){
        $user = auth()->user();

        $data = Pembayaran::where([
            ['user_id', $user->id],
            ['kategori', 'daftar_ulang']
        ])->first();
        if(is_null($data)) {
            $token = getToken();
            $timestamp = gmdate("Y-m-d\TH:i:s.000\Z");

            $path = '/v1/briva/';
            $verb = 'POST';
            $custCode = $this->generateCustCode();
            $expDate = Carbon::tomorrow()->format('Y-m-d H:i:s');

            $biaya = Biaya::where([
                ['prodi_id', $user->prodi_id],
                ['gelombang_id', $user->gelombang()->id],
                ['jenis_biaya', 'daftar_ulang']
            ])->first();

            $data = [
                'institutionCode' => env('BRIVA_INSTITUTION_CODE'),
                'brivaNo' => env('BRIVA_NO'),
                'custCode' => $custCode,
                'nama' => auth()->user()->nama,
                'amount' => $biaya->nominal,
                'keterangan' => 'Daftar Ulang PMB Unigres',
                'expiredDate' => $expDate
            ];
            $payload = json_encode($data);

            $signature = generateSignature($path, $verb, $token, $timestamp, $payload);
            $url = env('BRIVA_APP_URL') . $path;

            $res = Http::withHeaders([
                'BRI-Signature' => $signature,
                'BRI-Timestamp' => $timestamp,
                'Content-Type' => 'application/json'
            ])->withToken($token)->post($url, $data);
            $response = json_decode($res->body());

            if ($response->status && $response->responseDescription == 'Success') {
                try {
                    $data = Pembayaran::create([
                        'user_id' => auth()->user()->id,
                        'custCode' => $custCode,
                        'amount' => $biaya->nominal,
                        'keterangan' => 'Daftar Ulang PMB Unigres',
                        'expiredDate' => $expDate,
                        'status' => false,
                        'kategori' => 'daftar_ulang'
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
                        'keterangan' => 'Daftar Ulang PMB Unigres',
                        'expiredDate' => $response->data->expiredDate,
                        'status' => false,
                        'kategori' => 'daftar_ulang'
                    ]);
                    return response()->view('instruksi-pembayaran', compact('data'));
                } else {
                    abort(500);
                }

            }
        } else return response()->view('instruksi-pembayaran', compact('data'));
    }

    public function generateCustCode(): string
    {
        $count = Pembayaran::whereDate('created_at', Carbon::today())->count();
        $number = $count + 5001;
        $date = date_format(Carbon::today(), 'ymd');
        $seq = substr(str_repeat(0, 4).$number, - 4);

        return $date . $seq;
    }
}
