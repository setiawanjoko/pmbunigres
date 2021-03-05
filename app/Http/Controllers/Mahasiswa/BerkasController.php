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
            $ijazah = $request->file('ijazah');
            $ijazahname = date('Ymdhis') . "_" . $ijazah->getClientOriginalName();
            $request->file('ijazah')->storeAs('public/', $ijazahname);

            $ktp = $request->file('ktp');
            $ktpname = date('Ymdhis') . "_" . $ktp->getClientOriginalName();
            $request->file('ktp')->storeAs('public/', $ktpname);

            $skhun = $request->file('skhun');
            $skhunname = date('Ymdhis') . "_" . $skhun->getClientOriginalName();
            $request->file('skhun')->storeAs('public/', $skhunname);

            $kartu_keluarga = $request->file('kartu_keluarga');
            $kartu_keluarganame = date('Ymdhis') . "_" . $kartu_keluarga->getClientOriginalName();
            $request->file('kartu_keluarga')->storeAs('public/', $kartu_keluarganame);

        try {
            Berkas::updateOrCreate(
                ['user_id' => auth()->id], [
                    'ijazah' => $ijazahname,
                    'ktp' => $ktpname,
                    'skhun' => $skhunname,
                    'kartu_keluarga' => $kartu_keluarganame,
                ]);

            return response()->redirectToRoute('Berkas.create');
        } catch (\Exception $e) {
            if(Storage::exists('public/' . $ijazahname)) Storage::delete('public/' . $ijazahname);
            if(Storage::exists('public/' . $ktpname)) Storage::delete('public/' . $ktpname);
            if(Storage::exists('public/' . $skhunname)) Storage::delete('public/' . $skhunname);
            if(Storage::exists('public/' . $kartu_keluarganame)) Storage::delete('public/' . $kartu_keluarganame);
            return redirect()->back()->with(['status' => 'danger', 'message' => $e->getMessage()]);
        }
    }
}
