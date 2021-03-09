<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gelombang extends Model
{
    use HasFactory;

    protected $table = 'gelombang';

    protected $fillable = [
        'gelombang', 'tgl_mulai', 'tgl_selesai'
    ];

    protected $casts = [
        'tgl_mulai' => 'date',
        'tgl_selesai' => 'date'
    ];

    public function user() {
        return $this->hasMany(User::class, 'gelombang_id', 'id');
    }

    public function biaya() {
        return $this->hasMany(Biaya::class, 'gelombang_id', 'id');
    }
}
