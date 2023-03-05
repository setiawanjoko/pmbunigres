<?php

namespace App\Helpers;

use App\Models\Biodata;
use App\Models\Prodi;
use Illuminate\Support\Carbon;

/**
 * A helper class to accomodate heregistration
 */
class DaftarUlangHelper
{
    /**
     * Generate NIM based on year and major
     *
     * @param int $prodi
     * @return string
     */
    public static function generateNIM(int $prodi): string
    {
        $count = Biodata::whereHas('user', function ($query) use($prodi){
            $query->whereHas('pembayaran', function($que) use($prodi){
                return $que->where([
                    ['kategori', 'daftar_ulang'],
                    ['status', 1]
                ]);
            })->where('prodi_id', $prodi);
        })->count();

        $prodi = Prodi::find($prodi);

        $date = Carbon::today()->year;
        return $date . $prodi->kode_prodi_nim . substr(str_repeat(0, 4).$count, - 4);
    }

    /**
     * Check whether NIM is available or taken. Return true when taken and false if available.
     *
     * @param string $nim
     * @return bool
     */
    public static function checkNIM(string $nim): bool
    {
        $data = Biodata::where('nim', $nim)->first();

        return !is_null($data);
    }
}
