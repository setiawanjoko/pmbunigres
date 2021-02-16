<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodi';

    protected $fillable = ['jenjang_id', 'nama'];

    public function jenjang() {
         return $this->belongsTo(Jenjang::class, 'jenjang_id', 'id');
    }

    public function pendaftar() {
        return $this->hasMany(Biodata::class, 'prodi_id', 'id');
    }
}
