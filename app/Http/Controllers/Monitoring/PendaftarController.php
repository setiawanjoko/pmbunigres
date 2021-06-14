<?php

namespace App\Http\Controllers\Monitoring;

use App\Http\Controllers\Controller;
use App\Models\Berkas;
use App\Models\Biodata;
use App\Models\Prodi;
use App\Models\User;
use App\Models\Wali;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PendaftarController extends Controller
{
    public function index($filter = null): Response
    {
        if(is_null($filter)){
            $data = User::with(['prodi'])->where('permission_id', 2)->get();
        } else {
            $data = User::with(['prodi'])->where([
                ['permission_id', 2],
                ['prodi_id', $filter]
            ])->get();
        }
        $pendaftarHariIni = User::with(['prodi'])->where('permission_id', 2)->whereDate('created_at', Carbon::today()->toDateString())->count();
        $tesOnline = User::with(['prodi'])->where('permission_id', 2)->get()
            ->filter(function($item) {
                return $item->progres === 'tes online';
            })->count();
        $daftarUlang = User::with(['prodi'])->where('permission_id', 2)->get()
            ->filter(function($item) {
                return $item->progres === 'daftar ulang';
            })->count();
        $dataProdi = Prodi::all();

        return response()->view('admin.data.monitoring.index', compact('data', 'pendaftarHariIni', 'tesOnline', 'daftarUlang', 'dataProdi'));
    }

    public function filter(Request $request){
        $data = $request->validate([
            'prodi' => 'required|exists:prodi,id'
        ]);

        return $this->index($data['prodi']);
    }

    public function emailConfirm($id){
        $data = User::find($id);

        if(!is_null($data)) {
            $data->email_verified_at = Carbon::now();
            $data->save();

            return redirect()->back()->with(['status'=>'success', 'message'=>'Email berhasil dikonfirmasi.']);
        }

        return redirect()->back()->with(['status'=>'danger', 'message'=>'Email gagal dikonfirmasi.']);
    }

    public function biodata($id): Response
    {
        $data = Biodata::where('user_id', $id)->first();

        if(is_null($data)) return $this->index();
        return response()->view('admin.data.monitoring.biodata', compact('data'));
    }

    public function editBiodata($id): Response
    {
        $data = Biodata::where('user_id', $id)->first();

        if(is_null($data)) return $this->index();
        return response()->view('admin.data.monitoring.edit-biodata', compact('data'));
    }

    public function updateBiodata(Request $request, $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'nama_depan' => 'required|string',
            'nama_belakang' => 'string', // nama belakang dibuat tidak wajib diisi untuk memberikan opsi bagi yang hanya memiliki 1 kata pada namanya
            'nik' => [
                'required',
                'numeric',
                'digits:16',
                Rule::unique('biodata', 'nik')->ignore($id, 'user_id')
            ],
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date', // apakah ada batasan usia
            'agama' => 'required|in:islam,kristen,katholik,budha,hindu,konghucu',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'ukuran_almamater' => 'required|in:S,M,L,XL,XXL',
            'alamat' => 'required|string',
            'no_telepon' => 'numeric|unique:biodata,no_telepon,' . $id . ',user_id', // no telepon dibuat tidak wajib diisi untuk memberikan opsi bagi yang tidak memiliki telepon
            'asal_sekolah' => 'required|string',
            'asal_jurusan' => 'required|string',
            'tahun_lulus' => 'required', // tanyakan batasan yang bisa daftar lulusan berapa tahun sebelum pembukaan dibuka?
            'foto' => 'required_without:current_foto|file|max:250|mimes:png,jpg,jpeg', // maks ukuran dalam KB
            'current_foto' => 'present'
        ]);

        try {
            $berkas = $request->file('foto');
            $user = User::find($id);
            $custCode = $user->pembayaranRegistrasi()->custCode;
            if(!is_null($berkas)) {
                $berkasName = $custCode . "_" . $berkas->getClientOriginalName();

                $request->file('foto')->storeAs('public/', $berkasName);
            } else {
                $berkasName = $validatedData['current_foto'];
            }

            Biodata::updateOrCreate(
                ['user_id' => $id], [
                'nik' => $validatedData['nik'],
                'nama_depan' => $validatedData['nama_depan'],
                'nama_belakang' => $validatedData['nama_belakang'],
                'tempat_lahir' => $validatedData['tempat_lahir'],
                'tanggal_lahir' => $validatedData['tanggal_lahir'],
                'agama' => $validatedData['agama'],
                'jenis_kelamin' => $validatedData['jenis_kelamin'],
                'alamat' => $validatedData['alamat'],
                'no_telepon' => $validatedData['no_telepon'],
                'asal_sekolah' => $validatedData['asal_sekolah'],
                'asal_jurusan' => $validatedData['asal_jurusan'],
                'tahun_lulus' => $validatedData['tahun_lulus'],
                'ukuran_almamater' => $validatedData['ukuran_almamater'],
                'foto' => $berkasName,
            ]);

            return response()->redirectToRoute('admin.monitoring.pendaftar.biodata.index', $id)->with(['status' => 'success', 'message' => 'Data biodata berhasil disimpan.']);
        }catch(Exception $e) {
            if(Storage::exists('public/' . $berkasName)) Storage::delete('public/' . $berkasName);
            return response()->redirectToRoute('admin.monitoring.pendaftar.biodata.index', $id)->with(['status' => 'danger', 'message' => $e->getMessage()]);
        }
    }

    public function keluarga($id){
        $user = User::find($id);
        $dataAyah = $user->ayah();
        $dataIbu = $user->ibu();
        $dataWali = $user->wali();

        return response()->view('admin.data.monitoring.keluarga', compact('dataAyah', 'dataIbu', 'dataWali'));
    }

    public function editKeluarga($id){
        $user = User::find($id);
        $dataAyah = $user->ayah();
        $dataIbu = $user->ibu();
        $dataWali = $user->wali();

        return response()->view('admin.data.monitoring.edit-keluarga', compact('dataAyah', 'dataIbu', 'dataWali'));
    }

    public function updateKeluarga(Request $request, $id){
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
        $user = User::find($id);

        try {
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

            return response()->redirectToRoute('admin.monitoring.pendaftar.keluarga.index', $user->id)->with(['status' => 'success', 'message' => 'Data keluarga berhasil disimpan.']);
        } catch(Exception $e) {
            return response()->redirectToRoute('admin.monitoring.pendaftar.keluarga.index', $user->id)->with(['status' => 'danger', 'message' => 'Data gagal disimpan.']);
        }
    }

    public function berkas($id){
        $user = User::find($id);

        if(!is_null($user)) {
            $data = $user->berkas;
            return response()->view('admin.data.monitoring.berkas', compact('data', 'user'));
        } else {
            $data = null;
            return response()->view('admin.data.monitoring.berkas', compact('data', 'user'));
        }
    }

    public function editBerkas($id){
        $user = User::find($id);

        if(!is_null($user)) {
            $data = $user->berkas;
            return response()->view('admin.data.monitoring.edit-berkas', compact('data', 'user'));
        } else {
            $data = null;
            return response()->view('admin.data.monitoring.edit-berkas', compact('data', 'user'))->with([
                'status' => 'danger',
                'message' => 'Pendaftar belum mengunggah berkas.'
            ]);
        }
    }

    public function updateBerkas(Request $request, $id){
        $data = $request->validate([
            'ijazah' => 'file|nullable|max:500|mimes:png,jpg,jpeg,pdf',
            'ktp' => 'file|nullable|max:500|mimes:png,jpg,jpeg,pdf',
            'skhun' => 'file|nullable|max:500|mimes:png,jpg,jpeg,pdf',
            'kartu_keluarga' => 'file|nullable|max:500|mimes:png,jpg,jpeg,pdf'
        ]);

        $user = User::find($id);
        $berkas = $user->berkas;
        $custCode = $user->pembayaranRegistrasi()->custCode;

        $ijazah = $request->file('ijazah');
        if (!is_null($ijazah)){
            $ijazahname = $custCode . "_ijazah." . $ijazah->extension();
            $request->file('ijazah')->storeAs('public/', $ijazahname);
        } else if(!is_null($berkas)){
            $ijazahname = $berkas->ijazah;
        } else $ijazahname = null;

        $ktp = $request->file('ktp');
        if (!is_null($ktp)){
            $ktpname = $custCode . "_ktp." . $ktp->extension();
            $request->file('ktp')->storeAs('public/', $ktpname);
        } else if(!is_null($berkas)){
            $ktpname = $berkas->ktp;
        } else $ktpname = null;

        $skhun = $request->file('skhun');
        if (!is_null($skhun)){
            $skhunname = $custCode . "_skhun." . $skhun->extension();
            $request->file('skhun')->storeAs('public/', $skhunname);
        } else if(!is_null($berkas)){
            $skhunname = $berkas->skhun;
        } else $skhunname = null;

        $kartu_keluarga = $request->file('kartu_keluarga');
        if (!is_null($kartu_keluarga)){
            $kartu_keluarganame = $custCode . "_kartu_keluarga." . $kartu_keluarga->extension();
            $request->file('kartu_keluarga')->storeAs('public/', $kartu_keluarganame);
        } else if(!is_null($berkas)){
            $kartu_keluarganame = $berkas->kartu_keluarga;
        } else $kartu_keluarganame = null;

        try {
            if(!is_null($ijazahname) || !is_null($ktpname) || !is_null($skhunname) || !is_null($kartu_keluarganame)) {
                Berkas::updateOrCreate(
                    ['user_id' => $user->id], [
                    'ijazah' => $ijazahname,
                    'ktp' => $ktpname,
                    'skhun' => $skhunname,
                    'kartu_keluarga' => $kartu_keluarganame,
                ]);
            }

            return response()->redirectToRoute('admin.monitoring.pendaftar.berkas.index')->with(['status' => 'success', 'message' => 'Berkas berhasil disimpan.']);
        } catch (\Exception $e) {
            if(Storage::exists('public/' . $ijazahname)) Storage::delete('public/' . $ijazahname);
            if(Storage::exists('public/' . $ktpname)) Storage::delete('public/' . $ktpname);
            if(Storage::exists('public/' . $skhunname)) Storage::delete('public/' . $skhunname);
            if(Storage::exists('public/' . $kartu_keluarganame)) Storage::delete('public/' . $kartu_keluarganame);
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Berkas gagal disimpan.']);
        }
    }
}
