<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Biodata extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'biodata';

    protected $fillable = [
        'user_id', 'no_pendaftaran', 'nik', 'nama_depan', 'nama_belakang', 'tempat_lahir', 'tanggal_lahir', 'agama', 'jenis_kelamin', 'alamat', 'no_telepon', 'jalur_masuk', 'asal_sekolah', 'asal_jurusan', 'tahun_lulurs', 'foto'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function wali() {
        return $this->hasMany(Wali::class, 'biodata_id', 'id');
    }
}
