<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use App\Models\Jenjang;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdiController extends Controller
{
    public function index() {
       $data = DB::select('SELECT p.id,CONCAT(\'Kode SIAKAD : \',p.kode_prodi_siakad,\' Kode NIM : \',p.kode_prodi_nim) AS kode,p.nama AS prodi,j.nama AS jenjang,IF(f.fakultas is NULL, \'-\',f.fakultas) AS fakultas, IF((SELECT COUNT(k.lulusan_unigres) FROM kelas k WHERE k.prodi_id = p.id AND k.lulusan_unigres = 1) > 0,1,0) AS lulusan_unigres
                            FROM prodi p
                            LEFT OUTER JOIN jenjang j ON p.jenjang_id = j.id
                            LEFT OUTER JOIN fakultas f ON p.fakultas_id = f.id
                            ORDER BY p.id');
       $dataJenjang = Jenjang::all();
       $dataFakultas = Fakultas::all();

       return response()->view('admin.master.program-studi', compact('data','dataJenjang','dataFakultas'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'nama' => 'required|string',
            'jenjang_id' => 'integer',
            'fakultas_id' => 'integer',
            'k_prodi' => 'required|string',
            's_prodi' => 'required|string',
            'pagi' => 'required',
            'siang' => 'required',
            'sore' => 'required',
            'malam' => 'required',
        ]);

        try {
            Prodi::create([
                'nama' => $data['nama'],
                'jenjang_id' => $data['jenjang_id'],
                'fakultas_id' => $data['fakultas_id'],
                'kode_prodi_nim' => $data['k_prodi'],
                'kode_prodi_siakad' => $data['s_prodi'],
                'pagi' => $data['pagi'],
                'siang' => $data['siang'],
                'sore' => $data['sore'],
                'malam' => $data['malam'],
            ]);

            return response()->redirectToRoute('admin.prodi.store');
        } catch(\Exception $e) {
            dd($e->getMessage());
        }
    }
    public function destroy($id)
    {
        $prodi = Prodi::find($id);

        if($prodi->pendaftar == null) {


            $prodi->delete();

            return response()->redirectToRoute('admin.prodi.index');
        } else {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Terdapat pendaftar pada jenjang ini.'
            ]);
        }
    }
}
