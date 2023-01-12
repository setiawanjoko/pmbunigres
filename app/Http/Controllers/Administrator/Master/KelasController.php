<?php

namespace App\Http\Controllers\Administrator\Master;

use App\Http\Controllers\Controller;
use App\Models\JamMasuk;
use App\Models\JamMasukKelas;
use App\Models\Kelas;
use App\Models\Prodi;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Kelas::with(['prodi'])->orderBy('prodi_id')->get();
        $majors = Prodi::all();
        $schedules = JamMasuk::all();

        return response()->view('administrator.master.kelas', compact('data', 'majors', 'schedules'));
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
            'idClass' => 'nullable',
            'major' => 'required|exists:prodi,id',
            'class' => 'required',
            'graduate' => 'required|boolean',
            'registration' => 'required|boolean',
            'heregistration' => 'required|boolean',
            'medical_test' => 'required|boolean',
            'medical_note' => 'nullable|string',
            'schedules' => 'nullable|array'
        ]);

        try {
            $class = Kelas::updateOrCreate(
                [
                    'id' => $validatedData['idClass'],
                ],
                [
                    'prodi_id' => $validatedData['major'],
                    'kelas' => $validatedData['class'],
                    'lulusan_unigres' => $validatedData['graduate'],
                    'biaya_registrasi' => $validatedData['registration'],
                    'biaya_daftar_ulang' => $validatedData['heregistration'],
                    'tes_kesehatan' => $validatedData['medical_test'],
                    'keterangan_tes_kesehatan' => $validatedData['medical_note'],
                ]);

            foreach($validatedData['schedules'] as $schedule){
                JamMasukKelas::create([
                    'kelas_id' => $class->id,
                    'jam_masuk_id' => $schedule
                ]);
            }

            $res = [
                'status' => 'success',
                'message' => 'Data kelas berhasil dimasukkan'
            ];
        } catch (Exception $e){
            $res = [
                'status' => 'danger',
                'message' => 'Data kelas gagal dimasukkan'
            ];
        }

        return response()->redirectToRoute('administrator.master.kelas.index')->with($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $data = Kelas::find($id);

        if(is_null($data)) return response()->redirectToRoute('administrator.master.kelas.index')->with([
            'status' => 'danger',
            'message' => 'Data kelas tidak ditemukan'
        ]);

        if(!empty($data->camaba)) return response()->redirectToRoute('administrator.master.kelas.index')->with([
            'status' => 'danger',
            'message' => 'Tidak dapat menghapus kelas yang memiliki pendaftar'
        ]);

        try {
            $data->delete();

            $res = [
                'status' => 'success',
                'message' => 'Data kelas berhasil dihapus'
            ];
        } catch (Exception $e){
            $res = [
                'status' => 'danger',
                'message' => 'Data kelas gagal dihapus'
            ];
        }

        return response()->redirectToRoute('administrator.master.kelas.index')->with($res);
    }

    /**
     * Get properties of a requested class.
     *
     * @param int $id
     * @return Application|ResponseFactory|Response
     */
    public function getClassProperty(int $id){
        $data = Kelas::with(['jamMasukKelas'])->where('id', $id)->first();

        return response($data, 200);
    }
}
