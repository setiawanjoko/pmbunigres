<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Gelombang;
use Carbon\Carbon;

class RegisController extends Controller
{
    public function get_prodi(){
        $data = DB::select('SELECT p.id,p.nama AS prodi,j.nama AS jenjang,f.fakultas, IF((SELECT COUNT(k.lulusan_unigres) FROM kelas k WHERE k.prodi_id = p.id AND k.lulusan_unigres = 1) > 0,1,0) AS lulusan_unigres
                            FROM prodi p
                            LEFT OUTER JOIN jenjang j ON p.jenjang_id = j.id
                            LEFT OUTER JOIN fakultas f ON p.fakultas_id = f.id
                            ORDER BY p.id');
        return $data;
    }

    public function get_jam_masuk($id, $lulusan_unigres){
        $data = DB::select('SELECT k.id,j.jam_masuk_id,m.jam_masuk,k.kelas,k.prodi_id,p.nama
                            FROM jam_masuk_kelas j
                            LEFT OUTER JOIN kelas k ON j.kelas_id = k.id
                            LEFT OUTER JOIN jam_masuks m ON j.jam_masuk_id = m.id
                            LEFT OUTER JOIN prodi p ON k.prodi_id = p.id
                            where p.id = ? and k.lulusan_unigres = ?', [$id,$lulusan_unigres]);
        return $data;
    }

    public function get_jalur_masuk($id){
        $gelombang = $gelombang = Gelombang::where([
            ['tgl_mulai', '<=', Carbon::today()],
            ['tgl_selesai', '>=', Carbon::today()]
        ])->first();

        $data = (!is_null($gelombang)) ? DB::select('SELECT b.gelombang_id,b.kelas_id,b.id,b.jalur_masuk_id,j.jalur_masuk
                            FROM biayas b
                            LEFT OUTER JOIN jalur_masuk j ON b.jalur_masuk_id = j.id
                            WHERE b.kelas_id = ? and b.gelombang_id = ?', [$id,$gelombang->id]) : null;
        return $data;
    }
}
