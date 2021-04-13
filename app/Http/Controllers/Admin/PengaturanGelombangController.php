<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\Gelombang;
use App\Models\JalurMasuk;
use App\Models\JamMasuk;
use App\Models\Jenjang;
use App\Models\Prodi;
use App\Models\Kelas;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengaturanGelombangController extends Controller
{
    public function index() {
        $dataGelombang = Gelombang::all();
        $dataJalur = JalurMasuk::all();
        $dataJam = JamMasuk::all();
        $dataJenjang = Jenjang::with('prodi')->get();
        $data = Biaya::with(['gelombang', 'jalurMasuk', 'kelas', 'kelas.prodi', 'kelas.jamMasuk'])->get();

        return response()->view('admin.pengaturan.pengaturan-gelombang', compact('data', 'dataGelombang', 'dataJalur', 'dataJam','dataJenjang'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'gelombang' => 'required|exists:gelombang,id',
            'prodi' => 'required|exists:prodi,id',
            'registrasi' => 'required|numeric',
            'daftar_ulang' => 'required|numeric'
        ]);

        try {
            Biaya::updateOrCreate(
                [
                    'gelombang_id' => $data['gelombang'],
                    'prodi_id' => $data['prodi'],
                    'jenis_biaya' => 'registrasi',
                ],[
                    'nominal' => $data['registrasi']
                ]
            );
            Biaya::updateOrCreate(
                [
                    'gelombang_id' => $data['gelombang'],
                    'prodi_id' => $data['prodi'],
                    'jenis_biaya' => 'daftar_ulang',
                ],[
                    'nominal' => $data['daftar_ulang']
                ]
            );

            return $this->index();
        } catch(Exception $e){
            dd($e->getMessage());
        }
    }

    public function sunting(){
        $dataProdi = Prodi::all();
        $dataGelombang = Gelombang::all();

        return response()->view('admin.pengaturan.biaya.edit', compact('dataProdi', 'dataGelombang'));
    }

    public function suntingSimpan(Request $request){
        $validatedData = $request->validate([
            'gelombang' => 'required|exists:gelombang,id',
            'prodi' => 'required|exists:prodi,id',
            'kelas' => 'required|exists:kelas,id',
            'jalur_masuk' => 'required|exists:jalur_masuk,id',
            'registrasi' => 'required|numeric',
            'daftarUlang' => 'required|numeric'
        ]);

        try {
            $registrasi = Biaya::where([
                ['gelombang_id', $validatedData['gelombang']],
                ['kelas_id', $validatedData['kelas']],
                ['jalur_masuk_id', $validatedData['jalur_masuk']],
                ['kategori', 'registrasi']
            ])->first();

            $registrasi->nominal = $validatedData['registrasi'];
            $registrasi->save();

            $daftarUlang = Biaya::where([
                ['gelombang_id', $validatedData['gelombang']],
                ['kelas_id', $validatedData['kelas']],
                ['jalur_masuk_id', $validatedData['jalur_masuk']],
                ['kategori', 'daftar_ulang']
            ])->first();

            $daftarUlang->nominal = $validatedData['daftarUlang'];
            $daftarUlang->save();

            return response()->redirectToRoute('admin.biaya.sunting');
        } catch(\Exception $e){
            dd($e->getMessage());
        }
    }
}
