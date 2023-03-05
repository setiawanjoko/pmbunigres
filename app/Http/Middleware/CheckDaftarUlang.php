<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class CheckDaftarUlang
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
        $user = auth()->user();
        $heregistrationPayment = $user->pembayaranDaftarUlang();
        $bio = $user->biodata;

        if(is_null($heregistrationPayment) || $heregistrationPayment->status) {
            if(!is_null($heregistrationPayment) && $heregistrationPayment->status && (isset($bio) && is_null($bio->nim))){
                $bio->nim = generateNIM($user->prodi_id);
                $bio->save();
            }
            return $next($request);
        }

        $paymentExpiredDate = Carbon::create($heregistrationPayment->expiredDate);
        $nowDateTime = Carbon::now();
        if($nowDateTime->greaterThanOrEqualTo($paymentExpiredDate)){
            return response()->redirectToRoute('payment.daftar-ulang.expired');
        } else if(!$heregistrationPayment->status) {
            if($heregistrationPayment->type == 'bni'){
                return response()->redirectToRoute('payment.instruksi-bni');
            }
            return response()->redirectToRoute('payment.instruksi-briva');
        }
    }
}
