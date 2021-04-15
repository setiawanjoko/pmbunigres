<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'user_id',
        'custCode',
        'amount',
        'keterangan',
        'expiredDate',
        'status',
        'kategori',
        'no_surat'
    ];

    protected $casts = [
        'expiredData' => 'datetime',
    ];

    public function pendaftar() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
