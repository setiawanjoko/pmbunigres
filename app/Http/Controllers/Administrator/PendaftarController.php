<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use App\Models\Pembayaran;
use App\Models\Prodi;
use App\Models\ServerSetting;
use App\Models\User;
use App\Models\Wali;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Exports\StudentExport;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use MongoDB\Driver\Server;
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

        $payment = Pembayaran::where('user_id', $data->id)->delete();
        $bio = Biodata::where('user_id', $data->id)->first();

        try {
            if ($bio) {
                $wali = Wali::where('biodata_id', $bio->id)->first();
                if (isset($wali)) {
                    $wali->delete();
                }
                $bio->delete();
            }
            $data->delete();

            $response = [
                'status' => 'success',
                'message' => 'Berhasil menghapus pendaftar.'
            ];
        } catch (Exception $e) {
            $response = [
                'status' => 'danger',
                'message' => 'Gagal menghapus pendaftar.'
            ];
        }

        return response()->redirectToRoute('administrator.monitoring.pendaftar.index')->with($response);
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

    public function exportAPI()
    {
        $data = [];
        $raw = User::with(['prodi'])->where('permission_id', 2)->get()
            ->filter(function ($item) {
                return $item->progres === 'daftar ulang';
            });

        foreach ($raw as $row) {
            array_push($data, [
                'mhs_id' => $row->biodata->no_pendaftaran,
                'mhs_nim' => $row->biodata->nim,
                'mhs_password' => $row->password,
                'mhs_no_ktp' => $row->biodata->nik,
                'mhs_nama' => $row->nama,
                'mhs_prodi' => $row->prodi->kode_prodi_siakad,
                'mhs_jenjang' => $row->prodi->jenjang->id,
                'mhs_kelas' => Carbon::now()->year . substr($row->kelas->kelas, -1),
                'mhs_dosen_wali' => '-',
                'mhs_tempat_lahir' => $row->biodata->tempat_lahir,
                'mhs_tanggal_lahir' => $row->biodata->tanggal_lahir,
                'mhs_jenis_kelamin' => $row->biodata->jenis_kelamin,
                'mhs_agama' => $row->biodata->agama,
                'mhs_alamat' => $row->biodata->alamat,
                'mhs_no_telepon' => $row->biodata->no_telepon,
                'mhs_tahun_masuk' => Carbon::now()->year,
                'mhs_semester_awal_masuk' => Carbon::now()->year,
                'mhs_asal_sma' => $row->biodata->asal_sekolah,
                'mhs_nama_ayah' => (!is_null($row->ayah())) ? $row->ayah()->nama : '-',
                'mhs_pekerjaan_ayah' => (!is_null($row->ayah())) ? $row->ayah()->pekerjaan : '-',
                'mhs_nama_ibu' => (!is_null($row->ibu())) ? $row->ibu()->nama : '-',
                'mhs_pekerjaan_ibu' => (!is_null($row->ibu())) ? $row->ibu()->pekerjaan : '-',
                'mhs_nama_wali' => (!is_null($row->wali())) ? $row->wali()->nama : '-',
                'mhs_alamat_wali' => (!is_null($row->wali())) ? $row->wali()->alamat : '-',
                'mhs_no_telepon_wali' => (!is_null($row->wali())) ? $row->wali()->telepon : '-',
                'mhs_penerima_beasiswa' => 0,
                'mhs_gelombang' => 1,
                'mhs_tinggal_kelas' => 0,
                'mhs_status' => 1,
                'mhs_bypass_kkn' => 0,
                'mhs_foto' => 'nopic.png',
                'mhs_level' => 6,
                'mhs_aktif' => 1
            ]);
        }

        $accessToken = ServerSetting::where('key', 'access_token_siakad')->first();

        if($accessToken == null) $res = [
            'status' => 'danger',
            'message' => 'Access Token belum ada. Tambahkan Access Token pada Pengaturan SIAKAD.'
        ];

        if(is_null($data)) $res = [
            'status' => 'warning',
            'message' => 'Tidak ada data untuk diekspor.'
        ];

        if(isset($accessToken) && isset($data)){
            $failed = [];
            $success = [];
            foreach ($data as $row){
                $client = new Client(['base_uri' => 'http://siakad.unigres.ac.id/api/']);
                $response = $client->request('POST', 'mahasiswa', [
                    'form_params' => $row,
                    'headers' => [
                        'access-token' => $accessToken->value
                    ]
                ]);

                if($response->getStatusCode() < 200 && $response->getStatusCode() >= 300){
                    array_push($failed, $row);
                }

                if($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
                    array_push($success, $row);
                }
            }

            if(count($success) == 0) $res = [
                'status' => 'danger',
                'message' => 'Data gagal ditambahkan.'
            ];

            if(count($failed) == 0) $res = [
                'status' => 'success',
                'message' => 'Data berhasil ditambahkan.'
            ];

            if(count($success) > 0 && count($failed) > 0) $res = [
                'status' => 'warning',
                'message' => 'Data berhasil ditambahkan sebagian.'
            ];
        }

        return response()->redirectToRoute('administrator.monitoring.pendaftar.index')->with($res);
    }
}
