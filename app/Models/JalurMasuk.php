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

    public function biaya(){
        return $this->hasMany(Biaya::class, 'jalur_masuk_id', 'id');
    }

    public function kelas(){
        return $this->belongsToMany(Kelas::class, 'biayas', 'jalur_masuk_id', 'kelas_id');
    }
}
