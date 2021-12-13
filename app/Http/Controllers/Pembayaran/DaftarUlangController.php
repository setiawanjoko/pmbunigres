<?php

namespace App\Http\Controllers\Pembayaran;

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
            $response = json_encode(createBriva('daftar_ulang', $biaya, $user));

            if($response->status == 'success') return response()->view('instruksi-pembayaran', compact(['data'=>$response->data]));
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

    public function nomorSurat(){
        $tahun = Carbon::today()->year;
        $count = Pembayaran::where('kategori', 'daftar_ulang')->whereNotNull('no_surat')->whereYear('created_at', $tahun)->count();
        $seq = substr(str_repeat(0, 3) . ($count + 1), - 3);

        return $seq . '/PAN-PMB/' . $tahun;
    }

    public function generateCustCode(): string
    {
        $count = Pembayaran::whereDate('created_at', Carbon::today())->where('kategori', 'daftar_ulang')->count();
        $number = $count + 5001;
        $date = date_format(Carbon::today(), 'ymd');
        $seq = substr(str_repeat(0, 4).$number, - 4);

        return $date . $seq;
    }
}
