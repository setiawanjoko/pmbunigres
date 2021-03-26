<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use HasFactory;

    protected $table = 'fakultas';

    protected $fillable = ['fakultas'];

<<<<<<< Updated upstream
    public function prodi() {
        return $this->hasMany(Prodi::class, 'fakultas_id', 'id');
    }

    public function getNamaAttribute() {
        return $this->fakultas;
=======
    public function prodi(){
        return $this->hasMany(Prodi::class,'fakultas_id','id');
>>>>>>> Stashed changes
    }
}
