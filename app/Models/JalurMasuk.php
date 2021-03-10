<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JalurMasuk extends Model
{
    use HasFactory;

    protected $table = 'jalur_masuk';

    protected $fillable = [
        'kelas_id', 'reguler', 'transfer', 'pindahan', 'lanjutan'
    ];

    public function kelas() {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
}
