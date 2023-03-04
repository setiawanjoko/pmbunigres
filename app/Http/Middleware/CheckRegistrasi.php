<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class CheckRegistrasi
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
        $registrationPayment = $user->pembayaranRegistrasi();

        if(is_null($registrationPayment)) {
            return response()->redirectToRoute('choose-payment-method');
        }

        $paymentExpiredDate = Carbon::create($registrationPayment->expiredDate);
        $nowDateTime = Carbon::now();
        if($nowDateTime->greaterThanOrEqualTo($paymentExpiredDate)){
            // TODO: jika waktu pembayaran kadaluarsa maka buat pembayaran baru
        } else if(!$registrationPayment->status) {
            if($registrationPayment->type == 'bni'){
                return response()->redirectToRoute('instruksi-bni');
            }
            return response()->redirectToRoute('instruksi-briva');
        }

        return $next($request);
    }
}
