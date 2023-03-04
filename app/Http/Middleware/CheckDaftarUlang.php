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

        // TODO: jika sudah klik daftar ulang maka akan diarahkan ke pembayaran
        // TODO: jika pembayaran sudah ada maka akan diarahkan ke halaman NIM
        // TODO: jika pembayaran belum dibayarkan maka akan diarahkan ke halaman instruksi pembayaran

        $user = auth()->user();
        $heregistrationPayment = $user->pembayaranDaftarUlang();
        $bio = $user->biodata;

        $paymentExpiredDate = Carbon::create($heregistrationPayment->expiredDate);
        $nowDateTime = Carbon::now();
        if($nowDateTime->greaterThanOrEqualTo($paymentExpiredDate)){
            // TODO: jika waktu pembayaran kadaluarsa maka buat pembayaran baru
        } else if(!$heregistrationPayment->status) {
            if($heregistrationPayment->type == 'bni'){
                return response()->redirectToRoute('instruksi-bni');
            }
            return response()->redirectToRoute('instruksi-briva');
        }

        if((!is_null($heregistrationPayment) && $heregistrationPayment->status) && (isset($bio) && is_null($bio->nim))) {
            $bio->nim = generateNIM($user->prodi_id);
            $bio->save();
        }

        return $next($request);
    }
}
