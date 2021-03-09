<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';

    protected $fillable = [
        'petugas_id', 'judul', 'deskripsi'
    ];

    public function petugas() {
        return $this->belongsTo(User::class, 'petugas_id', 'id');
    }
}
