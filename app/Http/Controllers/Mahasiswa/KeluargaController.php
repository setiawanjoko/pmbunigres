<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wali;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KeluargaController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $biodata = auth()->user();
            $biodata = $biodata->biodata;
            if(empty($biodata) || is_null($biodata)) {
                return response()->redirectToRoute('biodata.create');
            } else {
                return $next($request);
            }
        });
    }

    public function create(): Response
    {
        $user = auth()->user();
        $dataAyah = $user->ayah();
        $dataIbu = $user->ibu();
        $dataWali = $user->wali();

        return response()->view('mahasiswa.keluarga', compact('dataAyah', 'dataIbu', 'dataWali'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama_ayah' => 'required|string',
            'status_ayah' => 'required|in:hidup,meninggal,cerai',
            'pekerjaan_ayah' => 'required|string',
            'gaji_ayah' => 'required|numeric',
            'no_telepon_ayah' => 'string|nullable',
            'alamat_ayah' => 'string',
            'nama_ibu' => 'required|string',
            'status_ibu' => 'required|in:hidup,meninggal,cerai',
            'pekerjaan_ibu' => 'required|string',
            'gaji_ibu' => 'required|numeric',
            'no_telepon_ibu' => 'string|nullable',
            'alamat_ibu' => 'string',
            'nama_wali' => 'string|nullable',
            'status_wali' => 'in:hidup,meninggal,cerai|nullable',
            'pekerjaan_wali' => 'string|nullable',
            'gaji_wali' => 'numeric|nullable',
            'no_telepon_wali' => 'string|nullable',
            'alamat_wali' => 'string|nullable',
        ]);
        try {
            $user = auth()->user();
            $biodata = $user->biodata;

            // Ayah is mandatory
            Wali::updateOrCreate([
                'hubungan' => 'ayah',
                'biodata_id' => $biodata->id
            ],[
                'nama' => $data['nama_ayah'],
                'status' => $data['status_ayah'],
                'pekerjaan' => $data['pekerjaan_ayah'],
                'telepon' => $data['no_telepon_ayah'],
                'alamat' => $data['alamat_ayah'],
                'gaji' => $data['gaji_ayah']
            ]);
            // Ibu is mandatory
            Wali::updateOrCreate([
                'hubungan' => 'ibu',
                'biodata_id' => $biodata->id
            ],[
                'nama' => $data['nama_ibu'],
                'status' => $data['status_ibu'],
                'pekerjaan' => $data['pekerjaan_ibu'],
                'telepon' => $data['no_telepon_ibu'],
                'alamat' => $data['alamat_ibu'],
                'gaji' => $data['gaji_ibu']
            ]);
            // Wali is optional
            if(!empty($data['nama_wali'])) {
                Wali::updateOrCreate([
                    'hubungan' => 'wali',
                    'biodata_id' => $biodata->id
                ],[
                    'nama' => $data['nama_wali'],
                    'status' => $data['status_wali'],
                    'pekerjaan' => $data['pekerjaan_wali'],
                    'telepon' => $data['no_telepon_wali'],
                    'alamat' => $data['alamat_wali'],
                    'gaji' => $data['gaji_wali']
                ]);
            }
            //return response()->redirectToRoute('prodi-pilihan.create');
            return response()->redirectToRoute('berkas.create')->with(['status' => 'success', 'message' => 'Data keluarga berhasil disimpan.']);
        } catch(Exception $e) {
            return redirect()->back()->with(['status' => 'danger', 'message' => $e->getMessage()]);
        }
    }
}
