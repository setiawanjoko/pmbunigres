<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodi';

    protected $fillable = ['jenjang_id', 'fakultas_id', 'nama', 'kode_prodi_nim', 'kode_prodi_siakad', 'link_grup'];

    public function jenjang() {
         return $this->belongsTo(Jenjang::class, 'jenjang_id', 'id');
    }

    public function fakultas() {
        return $this->belongsTo(Fakultas::class, 'fakultas_id', 'id');
    }

    public function kelas() {
        return $this->hasMany(Kelas::class, 'prodi_id', 'id');
    }

    public function jamMasuk() {
        $id = $this->id;
        $data = JamMasuk::whereHas('kelas', function($query) use ($id){
            return $query->where('prodi_id', $id);
        })->get();

        return $data;
    }

    public function jalurMasuk() {
        $id = $this->id;
        $data = JalurMasuk::whereHas('kelas', function($query) use ($id){
            return $query->where('prodi_id', $id);
        })->get();

        return $data;
    }

    public function pendaftar() {
        return $this->hasMany(User::class, 'prodi_id', 'id');
    }
}
