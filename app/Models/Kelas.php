<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'prodi_id', 'kelas', 'lulusan_unigres', 'tes_kesehatan', 'keterangan_tes_kesehatan', 'biaya_registrasi', 'biaya_daftar_ulang'
    ];

    public function prodi() {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id');
    }

    public function biaya(){
        return $this->hasMany(Biaya::class,'kelas_id','id');
    }

    public function jamMasukKelas(){
        return $this->hasMany(JamMasukKelas::class, 'kelas_id', 'id');
    }

    public function jamMasuk(){
        return $this->belongsToMany(JamMasuk::class, 'jam_masuk_kelas', 'kelas_id', 'jam_masuk_id');
    }

    public function jalurMasuk(){
        return $this->belongsToMany(JalurMasuk::class, 'biayas', 'kelas_id', 'jalur_masuk_id');
    }

    public function camaba(){
        return $this->hasMany(User::class, 'kelas_id', 'id');
    }
}
