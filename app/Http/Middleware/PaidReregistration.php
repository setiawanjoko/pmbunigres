<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PaidReregistration
{
    /*
     *
     * Please note that this middleware is deprecated.
     *
     * Author: Setiawan Joko Prakoso
     * Date modified: March 5, 2023
     *
     */

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // yang belum bayar daftar ulang tampilkan ke instruksi bayar
        $user = auth()->user();
        $pembayaran = $user->pembayaranDaftarUlang();
        $biodata = $user->biodata;

        if(!is_null($pembayaran) && !$pembayaran->status) {
            if(checkBrivaStatus($pembayaran)) {
                $pembayaran->status = true;
                $pembayaran->save();

            } else {
                return response()->redirectToRoute('daftar-ulang');
            }
        }
        if((!is_null($pembayaran) && $pembayaran->status) && (isset($biodata) && is_null($biodata->nim))) {
            $biodata->nim = generateNIM($user->prodi_id);
            $biodata->save();
        }
        return $next($request);
    }
}
