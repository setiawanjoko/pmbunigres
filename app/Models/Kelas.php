<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'prodi_id', 'kelas', 'lulusan_unigres'
    ];

    public function prodi() {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id');
    }

    public function jalurMasukKelas(){
        return $this->hasMany(JalurMasukKelas::class,'kelas_id','id');
    }

    public function jamMasukKelas(){
        return $this->hasMany(JamMasukKelas::class, 'kelas_id', 'id');
    }

    public function jamMasuk(){
        return $this->belongsToMany(JamMasuk::class, 'jam_masuk_kelas', 'kelas_id', 'jam_masuk_id');
    }

    public function jalurMasuk(){
        return $this->belongsToMany(JalurMasuk::class, 'jalur_masuk_kelas', 'kelas_id', 'jalur_masuk_id');
    }
}
