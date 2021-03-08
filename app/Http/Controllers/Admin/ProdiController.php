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
            'kode_prodi' => 'string'
        ]);

        try {
            Jenjang::create([
                'nama' => $data['nama']
            ]);

            return response()->redirectToRoute('admin.jenjang.store');
        } catch(\Exception $e) {
            dd($e->getMessage());
        }
    }
}
