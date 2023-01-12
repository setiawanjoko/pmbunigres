<?php

namespace App\Http\Controllers\Administrator\Master;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use App\Models\Jenjang;
use App\Models\Kelas;
use App\Models\Prodi;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProgramStudiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Prodi::all();
        $levels = Jenjang::all();
        $faculties = Fakultas::all();

        return response()->view('administrator.master.program-studi', compact('data', 'levels', 'faculties'));
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
            'level_id' => 'required|exists:jenjang,id',
            'faculty_id' => 'exists:fakultas,id',
            'name' => 'required|string',
            'student_id_code' => 'required|string',
            'system_code' => 'required|string'
        ]);

        try {
            Prodi::updateOrCreate(
                [
                    'id' => $validatedData['id'],
                ],
                [
                    'jenjang_id' => $validatedData['level_id'],
                    'fakultas_id' => $validatedData['faculty_id'],
                    'nama' => $validatedData['name'],
                    'kode_prodi_nim' => $validatedData['student_id_code'],
                    'kode_prodi_siakad' => $validatedData['system_code']
                ]);

            $res = [
                'status' => 'success',
                'message' => 'Data program studi berhasil dimasukkan'
            ];
        } catch (Exception $e){
            $res = [
                'status' => 'danger',
                'message' => 'Data program studi gagal dimasukkan'
            ];
        }

        return response()->redirectToRoute('administrator.master.prodi.index')->with($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $data = Prodi::find($id);

        if(is_null($data)) return response()->redirectToRoute('administrator.master.prodi.index')->with([
            'status' => 'danger',
            'message' => 'Data program studi tidak ditemukan'
        ]);

        if(!is_null($data->pendaftar)) return response()->redirectToRoute('administrator.master.prodi.index')->with([
            'status' => 'danger',
            'message' => 'Tidak dapat menghapus program studi yang memiliki pendaftar'
        ]);

        try {
            $data->delete();

            $res = [
                'status' => 'success',
                'message' => 'Data program studi berhasil dihapus'
            ];
        } catch (Exception $e){
            $res = [
                'status' => 'danger',
                'message' => 'Data program studi gagal dihapus'
            ];
        }

        return response()->redirectToRoute('administrator.master.prodi.index')->with($res);
    }

    public function getProdi(){
        $data = Prodi::all();

        return response($data, 200);
    }

    public function getProdiClass($id){
        $data = Kelas::where('prodi_id', $id)->get();

        return response($data, 200);
    }
}
