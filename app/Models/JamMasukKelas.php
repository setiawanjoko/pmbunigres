<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamMasukKelas extends Model
{
    use HasFactory;

    protected $table = 'jam_masuk_kelas';

    protected $fillable = [
        'kelas_id', 'jam_masuk_id'
    ];

    public function jamMasuk(){
        return  $this->belongsTo(JamMasuk::class, 'jam_masuk_id', 'id');
    }

    public function kelas(){
        return  $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
}
