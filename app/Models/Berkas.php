<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'ijazah','ktp','skhun','kartu_keluarga'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
