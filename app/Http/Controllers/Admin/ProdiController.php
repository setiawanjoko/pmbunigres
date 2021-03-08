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
       $data = Prodi::all();
       $dataJenjang = Jenjang::all();
       $dataFakultas = Fakultas::all();

       return response()->view('admin.master.program-studi', compact('data','dataJenjang','dataFakultas'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'nama' => 'required|string',
            'jenjang_id' => 'integer',
            'fakultas_id' => 'integer',
            'k_prodi' => 'required|string'
        ]);

        try {
            Prodi::create([
                'nama' => $data['nama'],
                'jenjang_id' => $data['jenjang_id'],
                'fakultas_id' => $data['fakultas_id'],
                'kode_prodi' => $data['k_prodi']
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
