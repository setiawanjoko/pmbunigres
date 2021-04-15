<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Berkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BerkasController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(empty(auth()->user()->biodata)) {
                return response()->redirectToRoute('biodata.create');
            }else if(empty(auth()->user()->ayah())) {
                return response()->redirectToRoute('keluarga.create');
            } else {
                return $next($request);
            }
        });
    }

    public function create()
    {
        $user = auth()->user();
        $data = $user->berkas;

        return response()->view('mahasiswa.berkas', compact('data'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ijazah' => 'file|nullable|max:500|mimes:png,jpg,jpeg,pdf',
            'ktp' => 'file|nullable|max:500|mimes:png,jpg,jpeg,pdf',
            'skhun' => 'file|nullable|max:500|mimes:png,jpg,jpeg,pdf',
            'kartu_keluarga' => 'file|nullable|max:500|mimes:png,jpg,jpeg,pdf'
        ]);

        $user = auth()->user();
        $berkas = $user->berkas;
        $custCode = $user->pembayaranRegistrasi()->custCode;

        $ijazah = $request->file('ijazah');
        if (!is_null($ijazah)){
            $ijazahname = $custCode . "_ijazah." . $ijazah->extension();
            $request->file('ijazah')->storeAs('public/', $ijazahname);
        } else if(!is_null($berkas)){
            $ijazahname = $berkas->ijazah;
        } else $ijazahname = null;

        $ktp = $request->file('ktp');
        if (!is_null($ktp)){
            $ktpname = $custCode . "_ktp." . $ktp->extension();
            $request->file('ktp')->storeAs('public/', $ktpname);
        } else if(!is_null($berkas)){
            $ktpname = $berkas->ktp;
        } else $ktpname = null;

        $skhun = $request->file('skhun');
        if (!is_null($skhun)){
            $skhunname = $custCode . "_skhun." . $skhun->extension();
            $request->file('skhun')->storeAs('public/', $skhunname);
        } else if(!is_null($berkas)){
            $skhunname = $berkas->skhun;
        } else $skhunname = null;

        $kartu_keluarga = $request->file('kartu_keluarga');
        if (!is_null($kartu_keluarga)){
            $kartu_keluarganame = $custCode . "_kartu_keluarga." . $kartu_keluarga->extension();
            $request->file('kartu_keluarga')->storeAs('public/', $kartu_keluarganame);
        } else if(!is_null($berkas)){
            $kartu_keluarganame = $berkas->kartu_keluarga;
        } else $kartu_keluarganame = null;

        try {
            if(!is_null($ijazahname) || !is_null($ktpname) || !is_null($skhunname) || !is_null($kartu_keluarganame)) {
                Berkas::updateOrCreate(
                    ['user_id' => auth()->user()->id], [
                    'ijazah' => $ijazahname,
                    'ktp' => $ktpname,
                    'skhun' => $skhunname,
                    'kartu_keluarga' => $kartu_keluarganame,
                ]);
            }

            return response()->redirectToRoute('tes-online.akademik');
        } catch (\Exception $e) {
            if(Storage::exists('public/' . $ijazahname)) Storage::delete('public/' . $ijazahname);
            if(Storage::exists('public/' . $ktpname)) Storage::delete('public/' . $ktpname);
            if(Storage::exists('public/' . $skhunname)) Storage::delete('public/' . $skhunname);
            if(Storage::exists('public/' . $kartu_keluarganame)) Storage::delete('public/' . $kartu_keluarganame);
            return redirect()->back()->with(['status' => 'danger', 'message' => $e->getMessage()]);
        }
    }
}
