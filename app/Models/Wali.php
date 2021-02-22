<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wali extends Model
{
    use HasFactory;

    protected $table = 'wali';

    protected $fillable = [
        'biodata_id', 'hubungan', 'nama', 'status', 'pekerjaan', 'telepon', 'alamat', 'gaji'
    ];

    public function biodata() {
        return $this->belongsTo(Biodata::class, 'biodata_id', 'id');
    }
}
