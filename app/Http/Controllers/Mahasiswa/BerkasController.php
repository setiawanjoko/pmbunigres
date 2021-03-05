<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Berkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BerkasController extends Controller
{
    public function create()
    {
        $user = auth()->user();
        $data = $user->berkas;

        return response()->view('mahasiswa.berkas', compact('data'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ijazah' => 'file|nullable|max:250|mimes:png,jpg,jpeg,pdf',
            'ktp' => 'file|nullable|max:250|mimes:png,jpg,jpeg,pdf',
            'skhun' => 'file|nullable|max:250|mimes:png,jpg,jpeg,pdf',
            'kartu_keluarga' => 'file|nullable|max:250|mimes:png,jpg,jpeg,pdf'
        ]);

        $berkas = auth()->user()->berkas;

        $ijazah = $request->file('ijazah');
        if (!is_null($ijazah)){
            $ijazahname = date('Ymdhis') . "_" . $ijazah->getClientOriginalName();
            $request->file('ijazah')->storeAs('public/', $ijazahname);
        } else {
            $ijazahname = $berkas->ijazah;
        }

        $ktp = $request->file('ktp');
        if (!is_null($ktp)){
            $ktpname = date('Ymdhis') . "_" . $ktp->getClientOriginalName();
            $request->file('ktp')->storeAs('public/', $ktpname);
        } else {
            $ktpname = $berkas->ktp;
        }

        $skhun = $request->file('skhun');
        if (!is_null($skhun)){
            $skhunname = date('Ymdhis') . "_" . $skhun->getClientOriginalName();
            $request->file('skhun')->storeAs('public/', $skhunname);
        } else {
            $skhunname = $berkas->skhun;
        }

        $kartu_keluarga = $request->file('kartu_keluarga');
        if (!is_null($kartu_keluarga)){
            $kartu_keluarganame = date('Ymdhis') . "_" . $kartu_keluarga->getClientOriginalName();
            $request->file('kartu_keluarga')->storeAs('public/', $kartu_keluarganame);
        } else {
            $kartu_keluarganame = $berkas->kartu_keluarga;
        }

        try {
            Berkas::updateOrCreate(
                ['user_id' => auth()->user()->id], [
                    'ijazah' => $ijazahname,
                    'ktp' => $ktpname,
                    'skhun' => $skhunname,
                    'kartu_keluarga' => $kartu_keluarganame,
                ]);

            return response()->redirectToRoute('berkas.create');
        } catch (\Exception $e) {
            if(Storage::exists('public/' . $ijazahname)) Storage::delete('public/' . $ijazahname);
            if(Storage::exists('public/' . $ktpname)) Storage::delete('public/' . $ktpname);
            if(Storage::exists('public/' . $skhunname)) Storage::delete('public/' . $skhunname);
            if(Storage::exists('public/' . $kartu_keluarganame)) Storage::delete('public/' . $kartu_keluarganame);
            return redirect()->back()->with(['status' => 'danger', 'message' => $e->getMessage()]);
        }
    }
}
