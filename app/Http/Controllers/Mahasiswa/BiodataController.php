<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use App\Models\Gelombang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BiodataController extends Controller
{
    public function create() {
        $user = auth()->user();
        $data = $user->biodata;

        return response()->view('mahasiswa.biodata', compact('data'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'nama_depan' => 'required|string',
            'nama_belakang' => 'string', // nama belakang dibuat tidak wajib diisi untuk memberikan opsi bagi yang hanya memiliki 1 kata pada namanya
            'nik' => [
                'required',
                'numeric',
                'digits:16',
                Rule::unique('biodata', 'nik')->ignore(auth()->id(), 'user_id')
            ],
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date', // apakah ada batasan usia
            'agama' => 'required|in:islam,kristen,katholik,budha,hindu,konghucu',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'alamat' => 'required|string',
            'no_telepon' => 'numeric|unique:biodata,no_telepon,' . auth()->id() . ',user_id', // no telepon dibuat tidak wajib diisi untuk memberikan opsi bagi yang tidak memiliki telepon
            'asal_sekolah' => 'required|string',
            'asal_jurusan' => 'required|string',
            'tahun_lulus' => 'required', // tanyakan batasan yang bisa daftar lulusan berapa tahun sebelum pembukaan dibuka?
            'foto' => 'file|max:250|mimes:png,jpg,jpeg' // maks ukuran dalam KB
        ]);
        try {
            $berkas = $request->file('foto');
            $berkasName = date('Ymdhis') . "_" . $berkas->getClientOriginalName();

            $request->file('foto')->storeAs('public/', $berkasName);

            // Create a function to generate registration number
            $registrationNumber = $this->generateRegistrationNumber();

            // Create a function to get jalur masuk
            $jalurMasuk = $this->getJalurMasuk();

            Biodata::updateOrCreate(
                ['user_id' => auth()->id()], [
                'no_pendaftaran' => $registrationNumber,
                'nik' => $data['nik'],
                'nama_depan' => $data['nama_depan'],
                'nama_belakang' => $data['nama_belakang'],
                'tempat_lahir' => $data['tempat_lahir'],
                'tanggal_lahir' => $data['tanggal_lahir'],
                'agama' => $data['agama'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'alamat' => $data['alamat'],
                'no_telepon' => $data['no_telepon'],
                'jalur_masuk' => $jalurMasuk,
                'asal_sekolah' => $data['asal_sekolah'],
                'asal_jurusan' => $data['asal_jurusan'],
                'tahun_lulus' => $data['tahun_lulus'],
                'foto' => $berkasName,
            ]);

            return response()->redirectToRoute('keluarga.create');
        }catch(\Exception $e) {
            if(Storage::exists('public/' . $berkasName)) Storage::delete('public/' . $berkasName);
            return redirect()->back()->with(['status' => 'danger', 'message' => $e->getMessage()]);
        }
    }

    public function generateRegistrationNumber(): string
    {
        $count = Biodata::whereDate('created_at', Carbon::today())->count();
        $number = $count + 1;
        $date = date_format(Carbon::today(), 'ymd');
        $seq = substr(str_repeat(0, 4).$number, - 4);

        return $date . $seq;
    }

    public function getJalurMasuk() {
        $today = Carbon::today();
        $data = Gelombang::where([
            ['tgl_mulai', '<=', $today],
            ['tgl_selesai', '>=', $today]
        ])->first();

        return $data->jalur_masuk;
    }
}
