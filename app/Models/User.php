<?php

namespace App\Models;

use Carbon\Carbon;
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
        'permission_id',
        'prodi_id',
        'jalur_masuk_id',
        'jam_masuk_id',
        'gelombang_id',
        'nama',
        'email',
        'password',
        'no_telepon',
        'informasi',
        'tes_kesehatan',
        'lulusan_unigres',
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

    public function prodi() {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id');
    }

     public function gelombang() {
         return $this->belongsTo(Gelombang::class, 'gelombang_id', 'id');
     }

    public function permission() {
        return $this->belongsTo(Permission::class, 'permission_id', 'id');
    }

    public function jamMasuk() {
        return $this->belongsTo(JamMasuk::class, 'jam_masuk_id', 'id');
    }

    public function jalurMasuk() {
        return $this->belongsTo(JalurMasuk::class, 'jalur_masuk_id', 'id');
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

    public function moodleAccount() {
        return $this->hasOne(MoodleAccount::class, 'user_id', 'id');
    }

    public function berkas() {
        return $this->hasOne(Berkas::class, 'user_id', 'id');
    }

    public function biayaRegistrasi() {
        $jamMasuk = $this->jam_masuk_id;
        $jalurMasuk = $this->jalur_masuk_id;
        $gelombang = $this->gelombang_id;
        $kelas = Kelas::where([
            ['prodi_id', $this->prodi_id],
            ['lulusan_unigres', $this->lulusan_unigres]
        ])
            ->whereHas('jamMasuk', function ($query) use($jamMasuk){
                return $query->where('jam_masuks.id', $jamMasuk);
            })->first();

        return Biaya::where([
            ['kelas_id', $kelas->id],
            ['gelombang_id', $gelombang],
            ['kategori', 'registrasi']
        ])
            ->whereHas('jalurMasuk', function($query) use($jalurMasuk){
                return $query->where('jalur_masuk.id', $jalurMasuk);
            })->first();
    }

    public function biayaDaftarUlang() {
        $jamMasuk = $this->jam_masuk_id;
        $jalurMasuk = $this->jalur_masuk_id;
        $gelombang = $this->gelombang_id;
        $kelas = Kelas::where([
            ['prodi_id', $this->prodi_id],
            ['lulusan_unigres', $this->lulusan_unigres]
        ])
            ->whereHas('jamMasuk', function ($query) use($jamMasuk){
                return $query->where('jam_masuks.id', $jamMasuk);
            })->first();

        return Biaya::where([
            ['kelas_id', $kelas->id],
            ['gelombang_id', $gelombang],
            ['kategori', 'daftar_ulang']
        ])
            ->whereHas('jalurMasuk', function($query) use($jalurMasuk){
                return $query->where('jalur_masuk.id', $jalurMasuk);
            })->first();
    }

    public function pembayaran() {
        return $this->hasMany(Pembayaran::class, 'user_id', 'id');
    }

    public function pembayaranRegistrasi() {
        return Pembayaran::whereHas('pendaftar', function($query){
            return $query->where([
                ['user_id', $this->id],
                ['kategori', 'registrasi']
            ]);
        })->first();
    }

    public function pembayaranDaftarUlang() {
        return Pembayaran::whereHas('pendaftar', function($query){
            return $query->where([
                ['user_id', $this->id],
                ['kategori', 'daftar_ulang']
            ]);
        })->first();
    }

    public function pengumuman() {
        return $this->hasMany(Pengumuman::class, 'petugas_id', 'id');
    }
}
