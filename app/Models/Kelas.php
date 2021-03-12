<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'prodi_id', 'kelas', 'pagi', 'siang', 'sore', 'malam'
    ];

    public function prodi() {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id');
    }

    public function jalurMasuk() {
        return $this->hasMany(JalurMasuk::class, 'kelas_id', 'id');
    }

    public function pendaftar() {
        return $this->hasMany(User::class, 'kelas_id', 'id');
    }
}