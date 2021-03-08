<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\Gelombang;
use App\Models\Jenjang;
use App\Models\Prodi;
use Illuminate\Http\Request;

class PengaturanGelombangController extends Controller
{
    public function index($id = null) {
        $data = Biaya::with(['gelombang', 'prodi'])->get();
        $dataGelombang = Gelombang::all();
        $dataProdi = Jenjang::with('prodi')->get();
        if(!is_null($id)) {
            $dataBiaya = Biaya::find();
        } else $dataBiaya = null;
        return response()->view('admin.master.pengaturan-gelombang', compact('data', 'dataGelombang', 'dataProdi', 'dataBiaya'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'gelombang' => 'required|exist:gelombang,id',
            'prodi' => 'required|exist:prodi,id',
            'registrasi' => 'required|numeric',
            'daftar_ulang' => 'required|numeric'
        ]);

        try {
            Biaya::updateOrCreate([
                [
                    'gelombang_id' => $data['gelombang'],
                    'prodi_id' => $data['prodi']
                ],[
                    'jenis_biaya' => 'registrasi',
                    'nominal' => $data['registrasi']
                ]
            ]);
            Biaya::updateOrCreate([
                [
                    'gelombang_id' => $data['gelombang'],
                    'prodi_id' => $data['prodi']
                ],[
                    'jenis_biaya' => 'daftar_ulang',
                    'nominal' => $data['daftar_ulang']
                ]
            ]);

            return $this->index();
        } catch(\Exception $e){
            abort(500);
        }
    }
}