<?php

namespace App\Http\Controllers\Administrator\Master;

use App\Http\Controllers\Controller;
use App\Models\JalurMasuk;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function PHPUnit\Framework\throwException;

class JalurMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $data = JalurMasuk::all();

        return response()->view('administrator.master.jalur-masuk', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $input = $request->validate([
            'id' => 'nullable|exists:jalur_masuk,id',
            'enrollmentMethod' => 'required|string'
        ]);

        try {
            $data = JalurMasuk::updateOrCreate([
                'id' => $input['id']
            ],[
                'jalur_masuk' => $input['enrollmentMethod']
            ]);

            if($data instanceof JalurMasuk) $res = [
                'status' => 'success',
                'message' => 'Data berhasil disimpan'
            ];
            else $res = [
                'status' => 'danger',
                'message' => 'Gagal menyimpan data'
            ];
        } catch(Exception $e){
            $res = [
                'status' => 'danger',
                'message' => 'Gagal menyimpan data. ERR_CODE: ' . $e->getMessage()
            ];
        }

        return response()->redirectToRoute('administrator.master.jalur-masuk.index')->with($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(int $id): RedirectResponse
    {
        $data = JalurMasuk::with(['biaya'])->findOrFail($id);

        if($data->biaya->count() > 0) $res = [
            'status' => 'danger',
            'message' => 'Tidak dapat menghapus jalur masuk yang masih terdaftar pada tabel biaya'
        ];
        else {
            if ($data->delete()) $res = [
                'status' => 'success',
                'message' => 'Data berhasil dihapus'
            ];
            else $res = [
                'status' => 'danger',
                'message' => 'Data gagal dihapus'
            ];
        }

        return response()->redirectToRoute('administrator.master.jalur-masuk.index')->with($res);
    }

    public function getJalurMasuk(){
        $data = JalurMasuk::all();

        return response()->json($data, 200);
    }

    public function getJalurMasukProperty($id){
        $data = JalurMasuk::findOrFail($id);

        return response()->json($data, 200);
    }
}
