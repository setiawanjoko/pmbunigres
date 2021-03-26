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
}
