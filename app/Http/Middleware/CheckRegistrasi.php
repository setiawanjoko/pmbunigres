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

        // TODO: jika sudah registrasi maka akan diarahkan ke pembayaran
        // TODO: jika pembayaran sudah ada maka akan diarahkan ke halaman biodata
        // TODO: jika pembayaran belum dibayarkan maka akan diarahkan ke halaman instruksi pembayaran

        $user = auth()->user();
        $registrationPayment = $user->pembayaranRegistrasi();

        if(is_null($registrationPayment)) {
            // TODO: jika tidak ada pembayaran yang terdaftar maka arahkan ke metode pembayaran
            return response()->redirectToRoute('choose-payment-method');
        }

        $paymentExpiredDate = Carbon::create($registrationPayment->expiredDate);
        $nowDateTime = Carbon::now();
        if($nowDateTime->greaterThanOrEqualTo($paymentExpiredDate)){
            // TODO: jika waktu pembayaran kadaluarsa maka buat pembayaran baru
        } else if(!$registrationPayment->status) {
            // TODO: jika status pembayaran masih belum dibayarkan maka tampilkan instruksi bayar
        }

        return $next($request);
    }
}
