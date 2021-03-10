<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodi';

    protected $fillable = ['jenjang_id', 'fakultas_id', 'nama', 'kode_prodi_nim', 'kode_prodi_siakad', 'pagi', 'siang', 'sore', 'malam'];

    public function jenjang() {
         return $this->belongsTo(Jenjang::class, 'jenjang_id', 'id');
    }

    public function fakultas() {
        return $this->belongsTo(Fakultas::class, 'fakultas_id', 'id');
    }

    public function kelas() {
        return $this->hasMany(Kelas::class, 'prodi_id', 'id');
    }
}
