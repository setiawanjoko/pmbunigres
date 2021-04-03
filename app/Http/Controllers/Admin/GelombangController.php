<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gelombang;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class GelombangController extends Controller
{
    public function index() {
        $data =  Gelombang::all();

        return view('admin.pengaturan.gelombang',compact('data'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'gelombang' => 'required|string',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date'
        ]);

        try {
            Gelombang::create([
                'gelombang' => $data['gelombang'],
                'tgl_mulai' => $data['tgl_mulai'],
                'tgl_selesai' => $data['tgl_selesai']
            ]);

            return response()->redirectToRoute('admin.gelombang.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function edit($id){
        $data =  Gelombang::all();
        $dataSelected = Gelombang::find($id);

        return view('admin.pengaturan.gelombang',compact('data', 'dataSelected'));
    }

    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'gelombang' => 'required|string',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date'
        ]);

        try {
            $data = Gelombang::find($id);

            $data->gelombang = $validatedData['gelombang'];
            $data->tgl_mulai = $validatedData['tgl_mulai'];
            $data->tgl_selesai = $validatedData['tgl_selesai'];
            $data->save();

            return response()->redirectToRoute('admin.gelombang.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function destroy($id)
    {
        // $count = Prodi::where('fakultas_id', $id)->whereHas('pendaftar')->count();
        $data = Gelombang::find($id);

        if($data->biaya == null) {
            $data->delete();
            return response()->redirectToRoute('admin.gelombang.index');
        } else {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Terdapat data biaya pada gelombang ini.'
            ]);
        }
    }
}
