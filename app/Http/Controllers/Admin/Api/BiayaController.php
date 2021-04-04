<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\JalurMasuk;
use App\Models\Kelas;
use Illuminate\Http\Request;

class BiayaController extends Controller
{
    public function getKelas($prodi){
        $response = Kelas::where('prodi_id', $prodi)->get();

        return response()->json($response);
    }

    public function getJalurMasuk($kelas){
        $response = JalurMasuk::whereHas('biaya', function($query) use($kelas){
            return $query->where('kelas_id', $kelas);
        })->get();

        return response()->json($response);
    }

    public function getBiaya($gelombang, $kelas, $jalurMasuk){
        $response = Biaya::where([
            ['gelombang_id', $gelombang],
            ['kelas_id', $kelas],
            ['jalur_masuk_id', $jalurMasuk]
        ])->get();

        return response()->json($response);
    }
}
