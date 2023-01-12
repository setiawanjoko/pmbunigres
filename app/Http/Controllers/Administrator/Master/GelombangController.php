<?php

namespace App\Http\Controllers\Administrator\Master;

use App\Http\Controllers\Controller;
use App\Models\Gelombang;
use http\Env\Response;
use Illuminate\Http\Request;

class GelombangController extends Controller
{
    public function index(){
        $data = Gelombang::all();

        return response()->view('administrator.master.gelombang', compact('data'));
    }

    public function store(Request $request){
        $validatedData = $this->validate($request, [
            'id' => 'nullable',
            'phase' => 'required|string',
            'startDate' => 'required|date',
            'endDate' => 'required|date'
        ]);

        try {
            Gelombang::updateOrCreate(
            [
                'id' => $validatedData['id'],
            ],
            [
                'gelombang' => $validatedData['phase'],
                'tgl_mulai' => $validatedData['startDate'],
                'tgl_selesai' => $validatedData['endDate']
            ]);

            $res = [
                'status' => 'success',
                'message' => 'Data gelombang berhasil dimasukkan'
            ];
        } catch (\Exception $e){
            $res = [
                'status' => 'danger',
                'message' => 'Data gelombang gagal dimasukkan'
            ];
        }

        return response()->redirectToRoute('administrator.master.gelombang.index')->with($res);
    }

    public function destroy($id){
        $data = Gelombang::find($id);

        if(is_null($data)) return response()->redirectToRoute('administrator.master.gelombang.index')->with([
            'status' => 'danger',
            'message' => 'Data gelombang tidak ditemukan'
        ]);

        if(!is_null($data->user)) return response()->redirectToRoute('administrator.master.gelombang.index')->with([
            'status' => 'danger',
            'message' => 'Tidak dapat menghapus gelombang yang memiliki pendaftar'
        ]);

        try {
            $data->delete();

            $res = [
                'status' => 'success',
                'message' => 'Data gelombang berhasil dihapus'
            ];
        } catch (\Exception $e){
            $res = [
                'status' => 'danger',
                'message' => 'Data gelombang gagal dihapus'
            ];
        }

        return response()->redirectToRoute('administrator.master.gelombang.index')->with($res);
    }

    public function getGelombang(){
        $data = Gelombang::all();

        return response($data, 200);
    }

    public function getGelombangProperty($id){
        $data = Gelombang::findOrFail($id);

        return response($data, 200);
    }
}
