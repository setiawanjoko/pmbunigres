<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';

    protected $fillable = [
        'petugas_id', 'judul', 'deskripsi', 'file_url'
    ];

    protected $appends = ['publish', 'is_new'];

    public function petugas() {
        return $this->belongsTo(User::class, 'petugas_id', 'id');
    }

    public function getPublishAttribute(){
        $string = $this->petugas->nama . ' | ' . date($this->attributes['created_at']);

        return $string;
    }

    public function getIsNewAttribute(){
        $now = Carbon::now();
        $create = $this->attributes['created_at'];

        return $now->diffInDays($create) < 4;
    }
}
