<?php

namespace App\Http\Controllers\Administrator\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\Kelas;
use App\Models\Prodi;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BiayaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($data = []): Response
    {
        $majors = Prodi::all();

        return response()->view('administrator.keuangan.biaya', compact('data', 'majors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'idCost' => 'nullable|numeric',
            'phase' => 'required_if:idCost,null|numeric|exists:gelombang,id',
            'major' => 'required_if:idCost,null|numeric|exists:prodi,id',
            'class' => 'required_if:idCost,null|numeric|exists:kelas,id',
            'enrollmentMethod' => 'required_if:idCost,null|numeric|exists:jalur_masuk,id',
            'registration' => 'required|numeric|min:0',
            'development' => 'required|numeric|min:0',
            'studentActivity' => 'required|numeric|min:0',
            'heregistrasi' => 'required|numeric|min:0',
            'firstTuition' => 'required|numeric|min:0',
            'uniform' => 'required|numeric|min:0',
            'conversion' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0'
        ]);

        try {
            // Prepare temporary array to save form data according to model attributes
            $data = [
                'gelombang_id' => $validatedData['phase'] ?? null,
                'jalur_masuk_id' => $validatedData['enrollmentMethod'] ?? null,
                'kelas_id' => $validatedData['class'] ?? null,
                'biaya_registrasi' => $validatedData['registration'] ?? 0,
                'dana_pengembangan' => $validatedData['development'] ?? 0,
                'dana_kemahasiswaan' => $validatedData['studentActivity'] ?? 0,
                'heregistrasi' => $validatedData['heregistrasi'] ?? 0,
                'spp_semester' => $validatedData['firstTuition'] ?? 0,
                'seragam' => $validatedData['uniform'] ?? 0,
                'konversi' => $validatedData['conversion'] ?? 0,
                'total_daftar_ulang' => $validatedData['total'] ?? 0,
            ];

            // Filter temporary array leaving behind null values
            $data = array_filter($data, function($v){
                return !is_null($v);
            });

            Biaya::updateOrCreate([
                'id' => $validatedData['idCost']
            ], $data);

            $res = [
                'status' => 'success',
                'message' => 'Data biaya berhasil dimasukkan'
            ];
        } catch(Exception $e){
            $res = [
                'status' => 'danger',
                'message' => 'Data biaya gagal dimasukkan. ERR_CODE: ' . $e->getMessage()
            ];
        }

        return response()->redirectToRoute('administrator.keuangan.biaya.index')->with($res);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $data = Biaya::findOrFail($id);

        $user = User::where([
            'kelas_id' => $data->kelas_id,
            'jalur_masuk_id' => $data->jalur_masuk_id
        ])->get();

        if($user->count() > 0) $res = [
            'status' => 'danger',
            'message' => 'Tidak dapat menghapus biaya yang masih memiliki pendaftar pada gelombang, kelas, dan jalur masuk yang berelasi.'
        ];
        else{
            try {
                $data->delete();

                $res = [
                    'status' => 'success',
                    'message' => 'Berhasil menghapus data'
                ];
            } catch (\Exception $e) {
                $res = [
                    'status' => 'danger',
                    'message' => 'Data gagal dihapus. ERR_CODE: ' . $e->getMessage()
                ];
            }
        }

        return response()->redirectToRoute('administrator.keuangan.biaya.index')->with($res);
    }

    public function filter(Request $request){
        $validatedData = $this->validate($request, [
            'class' => 'required|exists:kelas,id',
        ]);

        try {
//            $data = Kelas::with(['biaya', 'jamMasuk'])->where('id', $validatedData['class'])->first();

            $classId = $validatedData['class'];
            $data = Kelas::with([
                'gelombang' => function($query){
                    return $query->distinct('id');
                },
                'gelombang.biaya' => function($query) use($classId){
                    return $query->where('kelas_id', $classId)->orderBy('jalur_masuk_id');
                },
                'gelombang.biaya.jalurMasuk',
                'gelombang.biaya.kelas',
                'jamMasuk',
                'jalurMasuk' => function($query){
                    return $query->distinct('id');
                }
            ])
                ->where('id', $classId)
                ->first();

            return $this->index($data);
        } catch(Exception $e){
            $res = [
                'status' => 'danger',
                'message' => 'Gagal mendapatkan data. ERR_CODE: ' . $e->getMessage()
            ];

            return response()->redirectToRoute('administrator.keuangan.biaya.index')->with($res);
        }
    }
}
