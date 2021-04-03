<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use App\Models\Jenjang;
use App\Models\Prodi;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    public function index() {
        $data = Fakultas::all();

        return view('admin.master.fakultas',compact('data'));
    }

    public function create() {

        return response()->view('admin.master.fakultas');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'fakultas' => 'required|string'
        ]);

        try {
            Fakultas::create([
                'fakultas' => $data['fakultas']
            ]);

            return response()->redirectToRoute('admin.fakultas.index');
        } catch(\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function edit($id){
        $data = Fakultas::all();
        $dataSelected = Fakultas::find($id);

        return view('admin.master.fakultas',compact('data', 'dataSelected'));
    }

    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'fakultas' => 'required|string'
        ]);

        try {
            $data = Fakultas::find($id);

            $data->fakultas = $validatedData['fakultas'];
            $data->save();

            return $this->index();
        } catch (\Exception $e){
            dd($e->getMessage());
        }
    }

    public function destroy($id)
    {
        // $count = Prodi::where('fakultas_id', $id)->whereHas('pendaftar')->count();
        $fakultas = fakultas::find($id);

        if($fakultas->prodi == null) {


            $fakultas->delete();

            return response()->redirectToRoute('admin.fakultas.index');
        } else {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Terdapat pendaftar pada jenjang ini.'
            ]);
        }
    }
}
