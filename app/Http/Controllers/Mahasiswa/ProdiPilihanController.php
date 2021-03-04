<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Jenjang;
use App\Models\ProdiPilihan;
use Illuminate\Http\Request;

class ProdiPilihanController extends Controller
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

    public function create() {
        $dataProdi = Jenjang::with('prodi')->get();
        $biodata = auth()->user()->biodata;
        $pilihanPertama = ProdiPilihan::where([
            ['biodata_id', $biodata->id],
            ['urutan', 1]
        ])->first();
        $pilihanKedua = ProdiPilihan::where([
            ['biodata_id', $biodata->id],
            ['urutan', 2]
        ])->first();

        return response()->view('mahasiswa.prodi-pilihan', compact('pilihanPertama', 'pilihanKedua', 'dataProdi'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'pilihan_satu' => 'required',
            'pilihan_dua' => 'required|different:pilihan_satu'
        ]);
        try {
            ProdiPilihan::updateOrCreate([
                'biodata_id' => auth()->user()->biodata->id,
                'urutan' => 1
            ],[
                'prodi_id' => $data['pilihan_satu'],
            ]);
            ProdiPilihan::updateOrCreate([
                'biodata_id' => auth()->user()->biodata->id,
                'urutan' => 2
            ],[
                'prodi_id' => $data['pilihan_dua'],
            ]);

            return response()->redirectToRoute('moodle');//->with(['status' => 'success', 'message' => 'Data keluarga berhasil disimpan.']);
            //return redirect()->back()->with(['status' => 'success', 'message' => 'Berhasil memilih program studi']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Gagal memilih program studi']);
        }
    }
}
