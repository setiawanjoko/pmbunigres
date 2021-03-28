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
        $data = DB::select("SELECT k.id,p.nama,k.kelas,m.jam_masuk,g.gelombang,jm.jalur_masuk,
            (SELECT bb.nominal FROM biayas bb WHERE bb.kelas_id = k.id and bb.gelombang_id = b.gelombang_id AND bb.jalur_masuk_id = b.jalur_masuk_id AND bb.kategori = 'registrasi' ) AS registrasi,
            (SELECT bb.nominal FROM biayas bb WHERE bb.kelas_id = k.id and bb.gelombang_id = b.gelombang_id AND bb.jalur_masuk_id = b.jalur_masuk_id AND bb.kategori = 'daftar_ulang' ) AS daftar_ulang
            FROM kelas k
            RIGHT OUTER JOIN jam_masuk_kelas jmk ON k.id = jmk.kelas_id
            RIGHT OUTER JOIN jam_masuks m ON jmk.jam_masuk_id = m.id
            LEFT OUTER JOIN prodi p ON k.prodi_id = p.id
            inner JOIN biayas b ON k.id = b.kelas_id
            inner JOIN gelombang g ON b.gelombang_id = g.id
            RIGHT OUTER JOIN jalur_masuk jm ON b.jalur_masuk_id = jm.id
            WHERE b.kategori = 'registrasi'
            ORDER BY p.id,k.id,b.gelombang_id,b.jalur_masuk_id,m.id");

        return response()->view('admin.master.pengaturan-gelombang', compact('data', 'dataGelombang', 'dataJalur', 'dataJam','dataJenjang'));
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
}
