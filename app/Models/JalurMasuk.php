<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JalurMasuk extends Model
{
    use HasFactory;

    protected $table = 'jalur_masuk';

    protected $fillable = [
        'jalur_masuk'
    ];

    public function kelas() {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function jalurMasukKelas(){
        return $this->hasMany(JalurMasukKelas::class, 'jalur_masuk_id', 'id');
    }
}
