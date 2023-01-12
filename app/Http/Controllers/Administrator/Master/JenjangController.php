<?php

namespace App\Http\Controllers\Administrator\Master;

use App\Http\Controllers\Controller;
use App\Models\Jenjang;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JenjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Jenjang::all();

        return response()->view('administrator.master.jenjang', compact('data'));
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
            'level' => 'required|string',
        ]);

        try {
            Jenjang::updateOrCreate(
                [
                    'id' => $validatedData['id'],
                ],
                [
                    'nama' => $validatedData['level'],
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

        return response()->redirectToRoute('administrator.master.jenjang.index')->with($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $data = Jenjang::find($id);

        if(is_null($data)) return response()->redirectToRoute('administrator.master.jenjang.index')->with([
            'status' => 'danger',
            'message' => 'Data jenjang tidak ditemukan'
        ]);

        if(!is_null($data->prodi)) return response()->redirectToRoute('administrator.master.jenjang.index')->with([
            'status' => 'danger',
            'message' => 'Tidak dapat menghapus jenjang yang memiliki program studi'
        ]);

        try {
            $data->delete();

            $res = [
                'status' => 'success',
                'message' => 'Data jenjang berhasil dihapus'
            ];
        } catch (Exception $e){
            $res = [
                'status' => 'danger',
                'message' => 'Data jenjang gagal dihapus'
            ];
        }

        return response()->redirectToRoute('administrator.master.jenjang.index')->with($res);
    }
}
