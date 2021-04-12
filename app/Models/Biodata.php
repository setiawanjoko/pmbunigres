<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Biodata extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'biodata';

    protected $fillable = [
        'user_id', 'no_pendaftaran', 'nik', 'nama_depan', 'nama_belakang', 'tempat_lahir', 'tanggal_lahir', 'agama', 'jenis_kelamin', 'alamat', 'no_telepon', 'jalur_masuk', 'asal_sekolah', 'asal_jurusan', 'tahun_lulus', 'foto', 'ukuran_almamater', 'informasi', 'asal_informasi'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function wali(): HasMany
    {
        return $this->hasMany(Wali::class, 'biodata_id', 'id');
    }
}
