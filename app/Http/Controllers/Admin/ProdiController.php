<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use App\Models\Jenjang;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index() {
       $data = Prodi::with(['jenjang', 'fakultas'])->get();
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
