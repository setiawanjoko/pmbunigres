<?php

namespace App\Http\Controllers\Pembayaran;

use App\Http\Controllers\Controller;
use App\Models\ServerSetting;
use Carbon\Carbon;
use MongoDB\Driver\Server;
use Symfony\Component\VarDumper\Server\DumpServer;

class SklController extends Controller
{
    public function printSKL(){
        //nama, no registrasi, prodi, gelombang
        $biodata = auth()->user()->biodata;
        $prodi = auth()->user()->prodi;
        $gelombang = auth()->user()->gelombang;
        $biaya = auth()->user()->biaya();
        Carbon::setLocale('id');
        $tanggal = Carbon::now()->format('d F Y');
        $pembayaran = auth()->user()->pembayaranDaftarUlang();
        $signature = ServerSetting::where('key', 'loa-signature')->first();

        return response()->view('print-sk', compact('biodata', 'prodi', 'gelombang', 'biaya', 'tanggal', 'pembayaran', 'signature'));
    }
}
