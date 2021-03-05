<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gelombang extends Model
{
    use HasFactory;

    protected $table = 'gelombang';

    protected $fillable = [
        'gelombang', 'tgl_mulai', 'tgl_selesai', 'jalur_masuk'
    ];

    protected $casts = [
        'tgl_mulai' => 'date',
        'tgl_selesai' => 'date'
    ];

    public function user() {
        $data = User::where([
            ['email_verified_at', '>=', $this->tgl_mulai],
            ['email_verified_at', '<=', $this->tgl_selesai]
        ])->get();

        return $data;
    }

    public function biaya() {
        return $this->hasMany(Biaya::class, 'gelombang_id', 'id');
    }
}
