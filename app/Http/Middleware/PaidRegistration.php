<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaidRegistration
{
    /*
     *
     * Please note that this middleware is deprecated.
     *
     * Author: Setiawan Joko Prakoso
     * Date modified: March 5, 2023
     *
     * */

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
            if(!$user->kelas->biaya_registrasi && bypassPembayaran($user->id, false)) {
                return response()->redirectToRoute('biodata.create');
            }
            return response()->redirectToRoute('instruksi-bayar');
        } else if(!$pembayaran->status) {
            if(checkBrivaStatus($pembayaran)) {
                $pembayaran->status = true;
                $pembayaran->save();
            } else {
                return response()->redirectToRoute('instruksi-bayar');
            }
        }

        return $next($request);
    }
}
