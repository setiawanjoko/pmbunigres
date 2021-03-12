<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biaya extends Model
{
    use HasFactory;

    protected $fillable = [
        'gelombang_id', 'jalur_masuk_id', 'jenis_biaya', 'nominal'
    ];

    public function gelombang() {
        return $this->belongsTo(Gelombang::class, 'gelombang_id', 'id');
    }

    public function jalurMasukKelas(){
        return $this->hasMany(JalurMasukKelas::class, 'biaya_id', 'id');
    } 
}
