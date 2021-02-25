<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'permission_id',
        'no_telepon',
        'informasi'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function permission() {
        return $this->belongsTo(Permission::class, 'permission_id', 'id');
    }

    public function biodata() {
        return $this->hasOne(Biodata::class, 'user_id', 'id');
    }

    public function ayah() {
        return Wali::whereHas('biodata', function($query){
            return $query->where([
                ['biodata_id', $this->biodata->id],
                ['hubungan', 'ayah']
            ]);
        })->first();
    }

    public function ibu() {
        return Wali::whereHas('biodata', function($query){
            return $query->where([
                ['biodata_id', $this->biodata->id],
                ['hubungan', 'ibu']
            ]);
        })->first();
    }

    public function wali() {
        return Wali::whereHas('biodata', function($query){
            return $query->where([
                ['biodata_id', $this->biodata->id],
                ['hubungan', 'wali']
            ]);
        })->first();
    }

    public function prodiPilihan() {
        return $this->biodata->prodiPilihan;
    }
}
