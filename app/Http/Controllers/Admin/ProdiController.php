<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use App\Models\Jenjang;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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
        ]);

        try {
            Prodi::create([
                'nama' => $data['nama'],
                'jenjang_id' => $data['jenjang_id'],
                'fakultas_id' => $data['fakultas_id'],
                'kode_prodi_nim' => $data['k_prodi'],
                'kode_prodi_siakad' => $data['s_prodi'],
            ]);

            return response()->redirectToRoute('admin.prodi.store');
        } catch(\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function edit($id){
        $dataSelected = Prodi::find($id);
        $data = DB::select('SELECT p.id,CONCAT(\'Kode SIAKAD : \',p.kode_prodi_siakad,\' Kode NIM : \',p.kode_prodi_nim) AS kode,p.nama AS prodi,j.nama AS jenjang,IF(f.fakultas is NULL, \'-\',f.fakultas) AS fakultas, IF((SELECT COUNT(k.lulusan_unigres) FROM kelas k WHERE k.prodi_id = p.id AND k.lulusan_unigres = 1) > 0,1,0) AS lulusan_unigres
                            FROM prodi p
                            LEFT OUTER JOIN jenjang j ON p.jenjang_id = j.id
                            LEFT OUTER JOIN fakultas f ON p.fakultas_id = f.id
                            ORDER BY p.id');
        $dataJenjang = Jenjang::all();
        $dataFakultas = Fakultas::all();

        return response()->view('admin.master.program-studi', compact('data','dataJenjang','dataFakultas', 'dataSelected'));
    }

    public function update(Request $request, $id){
        $validatedData = $request->validate([
            's_prodi' => ['required',Rule::unique('prodi', 'kode_prodi_siakad')->ignore($id, 'id')],
            'k_prodi' => ['required',Rule::unique('prodi', 'kode_prodi_nim')->ignore($id, 'id')],
            'nama' => 'required',
            'jenjang_id' => 'required|exists:jenjang,id',
            'fakultas_id' => 'nullable|exists:fakultas,id'
        ]);

        try {
            $data = Prodi::find($id);

            $data->nama = $validatedData['nama'];
            $data->kode_prodi_siakad = $validatedData['s_prodi'];
            $data->kode_prodi_nim = $validatedData['k_prodi'];
            $data->jenjang_id = $validatedData['jenjang_id'];
            $data->fakultas_id = $validatedData['fakultas_id'];
            $data->save();

            return response()->redirectToRoute('admin.prodi.index');
        }catch (\Exception $e){
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
