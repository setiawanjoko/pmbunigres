<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JalurMasukKelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas_id', 'jalur_masuk_id', 'biaya_id', 'url'
    ];

    public function kelas(){
        return $this->BelongsTo(Kelas::class, 'kelas_id','id');
    }

    public function jalur_masuk(){
        return $this->belongsTo(JalurMasuk::class, 'jalur_masuk_id', 'id');
    }

    public function biaya(){
        return $this->belongsTo(Biaya::class,'biaya_id', 'id');
    }
}
