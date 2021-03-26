<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\Gelombang;
use App\Models\JalurMasuk;
use App\Models\JamMasuk;
use App\Models\Jenjang;
use App\Models\Prodi;
use Illuminate\Http\Request;

class PengaturanGelombangController extends Controller
{
    public function index($id = null) {
        $dataGelombang = Gelombang::all();
        $dataJalur = JalurMasuk::all();
        $dataJam = JamMasuk::all();
        $dataJenjang = Jenjang::with('prodi')->get();
        return response()->view('admin.master.pengaturan-gelombang', compact('dataGelombang', 'dataJalur', 'dataJam','dataJenjang'));
    
    }

    public function store(Request $request) {
        $data = $request->validate([
            'gelombang' => 'required|exists:gelombang,id',
            'prodi' => 'required|exists:prodi,id',
            'registrasi' => 'required|numeric',
            'daftar_ulang' => 'required|numeric'
        ]);

        try {
            Biaya::updateOrCreate(
                [
                    'gelombang_id' => $data['gelombang'],
                    'prodi_id' => $data['prodi'],
                    'jenis_biaya' => 'registrasi',
                ],[
                    'nominal' => $data['registrasi']
                ]
            );
            Biaya::updateOrCreate(
                [
                    'gelombang_id' => $data['gelombang'],
                    'prodi_id' => $data['prodi'],
                    'jenis_biaya' => 'daftar_ulang',
                ],[
                    'nominal' => $data['daftar_ulang']
                ]
            );

            return $this->index();
        } catch(\Exception $e){
            dd($e->getMessage());
        }
    }

    public function biayaFilter(Request $request) {
        $data = $request->validate([
            'prodi' => 'required|exists:prodi,id',
            'gelombang' => 'required|exists:gelombang,id',
        ]);
        $prodiId = $data['prodi'];
        $gelombangId = $data['gelombang'];

        try{
            $data = Prodi::with(['kelas' => function($query) use($prodiId, $gelombangId){
                return $query->where([
                    ['prodi_id', $prodiId]
                ])->with(['jalurMasuk' => function($query) use($gelombangId){
                    return $query->with(['biaya' => function($query) use($gelombangId){
                        return $query->where('gelombang_id', $gelombangId);
                    }])->wherePivot('gelombang_id', $gelombangId)->distinct('id');
                }]);
            }])->where('id', $prodiId)->first();

            dd($data);
        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }
}
