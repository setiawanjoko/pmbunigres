<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdiPilihan extends Model
{
    use HasFactory;

    protected $table = 'prodi_pilihan';

    protected $fillable = ['biodata_id', 'prodi_id', 'urutan'];

    public function biodata(): BelongsTo
    {
        return $this->belongsTo(Biodata::class, 'biodata_id', 'id');
    }

    public function prodi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id');
    }
}
