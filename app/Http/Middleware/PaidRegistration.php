<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaidRegistration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // yang belum bayar tampilkan ke instruksi bayar
        $user = auth()->user();
        $pembayaran = $user->pembayaranRegistrasi();

        if(is_null($pembayaran) ) {
            return response()->redirectToRoute('instruksi-bayar');
        } else if(!$pembayaran->status) {
            if($this->checkBrivaStatus($pembayaran)) {
                $pembayaran->status = true;
                $pembayaran->save();
            } else {
                return response()->redirectToRoute('instruksi-bayar');
            }
        }

        return $next($request);
    }

    public function checkBrivaStatus($pembayaran) {
        $token = getToken();
        $timestamp = gmdate("Y-m-d\TH:i:s.000\Z");
        $path = '/v1/briva/status/' . env('BRIVA_INSTITUTION_CODE') . '/' . env('BRIVA_NO') . "/$pembayaran->custCode";
        $verb = 'GET';

        $signature = generateSignature($path, $verb, $token, $timestamp, null);
        $url = env('BRIVA_APP_URL') . $path;
        $res = Http::withHeaders([
            'BRI-Signature' => $signature,
            'BRI-Timestamp' => $timestamp,
        ])->withToken($token)->get($url);

        $response = json_decode($res->body());

        if(!$pembayaran->status && $response->data->statusBayar == 'Y') {
            return true;
        } else {
            return false;
        }
    }
}
