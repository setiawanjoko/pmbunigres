<?php

namespace App\Http\Controllers\Administrator\Master;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Fakultas::all();

        return response()->view('administrator.master.fakultas', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $this->validate($request, [
            'id' => 'nullable',
            'faculty' => 'required|string',
        ]);

        try {
            Fakultas::updateOrCreate(
                [
                    'id' => $validatedData['id'],
                ],
                [
                    'fakultas' => $validatedData['faculty'],
                ]);

            $res = [
                'status' => 'success',
                'message' => 'Data fakultas berhasil dimasukkan'
            ];
        } catch (Exception $e){
            $res = [
                'status' => 'danger',
                'message' => 'Data fakultas gagal dimasukkan'
            ];
        }

        return response()->redirectToRoute('administrator.master.fakultas.index')->with($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $data = Fakultas::find($id);

        if(is_null($data)) return response()->redirectToRoute('administrator.master.fakultas.index')->with([
            'status' => 'danger',
            'message' => 'Data fakultas tidak ditemukan'
        ]);

        if(!is_null($data->prodi)) return response()->redirectToRoute('administrator.master.fakultas.index')->with([
            'status' => 'danger',
            'message' => 'Tidak dapat menghapus fakultas yang memiliki program studi'
        ]);

        try {
            $data->delete();

            $res = [
                'status' => 'success',
                'message' => 'Data fakultas berhasil dihapus'
            ];
        } catch (Exception $e){
            $res = [
                'status' => 'danger',
                'message' => 'Data fakultas gagal dihapus'
            ];
        }

        return response()->redirectToRoute('administrator.master.fakultas.index')->with($res);
    }
}
