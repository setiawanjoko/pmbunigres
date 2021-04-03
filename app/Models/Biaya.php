<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biaya extends Model
{
    use HasFactory;

    protected $table = 'biayas';

    protected $fillable = [
        'gelombang_id', 'jalur_masuk_id', 'kelas_id', 'biaya_registrasi',
        'dana_pengembangan', 'dana_kemahasiswaan', 'heregistrasi', 'spp_semester',
        'seragam','konversi','total_daftar_ulang'
    ];

    public function gelombang() {
        return $this->belongsTo(Gelombang::class, 'gelombang_id', 'id');
    }

    public function jalurMasuk(){
        return $this->belongsTo(JalurMasuk::class, 'jalur_masuk_id','id');
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class,'kelas_id','id');
    }
}
