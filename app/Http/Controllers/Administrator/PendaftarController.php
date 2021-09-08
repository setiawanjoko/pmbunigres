<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Exports\StudentExport;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PendaftarController extends Controller
{
    /**
     * Display a listing of the registrar.
     *
     * @param null $filter
     * @return Response
     */
    public function index($filter = null): Response
    {
        $data = User::with(['prodi'])->where('permission_id', 2)->get();

        if(!is_null($filter)){
            $data = User::with(['prodi'])->where([
                ['permission_id', 2],
                ['prodi_id', $filter]
            ])->get();
        }

        $dataProdi = Prodi::all();

        return response()->view('administrator.monitoring.pendaftar.index', compact('data',  'dataProdi'));
    }

    /**
     * Process a listing of the registrar on a selected major.
     *
     * @param Request $request
     * @return Response
     */
    public function filter(Request $request): Response
    {
        $data = $request->validate([
            'prodi' => 'required|exists:prodi,id'
        ]);

        return $this->index($data['prodi']);
    }

    /**
     * Store a newly created registrar account in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $this->validate($request, [
            'name' => 'required|string',
            'phone' => 'required',
            'email' => 'required|email',
            'phase' => 'required|exists:gelombang,id',
            'major' => 'required|exists:prodi,id',
            'graduate' => 'nullable',
            'class' => 'required|exists:jam_masuks,id',
            'class_id' => 'required|exists:kelas,id',
            'enrollment' => 'required|exists:jalur_masuk,id',
            'password' => 'required|confirmed'
        ]);

        try {
            $data = User::create([
                'permission_id' => 2,
                'prodi_id' => $validatedData['major'],
                'jalur_masuk_id' => $validatedData['enrollment'],
                'jam_masuk_id' => $validatedData['class'],
                'gelombang_id' => $validatedData['phase'],
                'kelas_id' => $validatedData['class_id'],
                'nama' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'no_telepon' => $validatedData['phone'],
                'lulusan_unigres' => $validatedData['graduate']
            ]);

            $response = ['status' => 'success', 'message' => 'Pendaftar berhasil ditambahkan'];
            return response()->redirectToRoute('administrator.monitoring.pendaftar.show', $data->id)->with($response);
        } catch (Exception $e){
            $response = ['status' => 'danger', 'message' => 'Gagal menambahkan pendaftar baru'];
            return response()->redirectToRoute('administrator.monitoring.pendaftar')->with($response);
        }
    }

    /**
     * Display the specified registrar.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        $data = User::find($id);

        return response()->view('administrator.monitoring.pendaftar.show', compact('data'));
    }

    /**
     * Remove the specified registrar account from storage.
     * Note: Registrar with paid initial payment will not be able to be deleted.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $data = User::find($id);

        $payment = $data->pembayaranRegistrasi();

        try {
            if (isset($payment)) {
                $response = [
                    'status' => 'warning',
                    'message' => 'Tidak dapat menghapus pendaftar yang telah melakukan pembayaran.'
                ];
            } else {
                $data->delete();

                $response = [
                    'status' => 'success',
                    'message' => 'Berhasil menghapus pendaftar.'
                ];
            }
        } catch (Exception $e) {
            $response = [
                'status' => 'danger',
                'message' => 'Gagal menghapus pendaftar.'
            ];
        }

        return response()->redirectToRoute('administrator.monitoring.pendaftar')->with($response);
    }

    /**
     * Export enrolled registrar to xlsx file
     *
     * @return BinaryFileResponse
     */
    public function exportExcel(): BinaryFileResponse
    {
        return Excel::download(new StudentExport(), 'export.xlsx');
    }

    /**
     * Export enrolled registrar to csv file
     *
     * @return BinaryFileResponse
     */
    public function exportCSV(): BinaryFileResponse
    {
        return Excel::download(new StudentExport(), 'export.csv');
    }
}
