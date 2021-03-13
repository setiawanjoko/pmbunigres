<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'jam_masuk'
    ];

    public function jamMasukKelas(){
        return $this->hasMany(JamMasukKelas::class, 'jam_masuk_id', 'id');
    }

    public function kelas(){
        return $this->belongsToMany(Kelas::class, 'jam_masuk_kelas', 'jam_masuk_id', 'kelas_id');
    }
}
