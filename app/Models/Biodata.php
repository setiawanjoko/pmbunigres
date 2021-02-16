<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $table = 'biodata';

    protected $fillable = [
        'user_id', 'prodi_id', 'no_pendaftaran', 'nik', 'nama', 'tempat_lahir', 'tanggal_lahir', 'agama', 'jenis_kelamin', 'alamat', 'jalur_masuk', 'asal_sekolah', 'asal_jurusan', 'foto', 'status'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function prodi() {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id');
    }

    public function wali() {
        return $this->hasMany(Wali::class, 'biodata_id', 'id');
    }
}
