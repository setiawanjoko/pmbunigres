<?php

namespace Database\Seeders;

use App\Models\Biaya;
use App\Models\Prodi;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BiayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$data = [
            [
                'prodi_id' => 1,
                'gelombang_id' => 1,
                'jenis_biaya' => 'registrasi',
                'nominal' => 200000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 2,
                'gelombang_id' => 1,
                'jenis_biaya' => 'registrasi',
                'nominal' => 200000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 3,
                'gelombang_id' => 1,
                'jenis_biaya' => 'registrasi',
                'nominal' => 200000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 4,
                'gelombang_id' => 1,
                'jenis_biaya' => 'registrasi',
                'nominal' => 200000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 5,
                'gelombang_id' => 1,
                'jenis_biaya' => 'registrasi',
                'nominal' => 200000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 6,
                'gelombang_id' => 1,
                'jenis_biaya' => 'registrasi',
                'nominal' => 200000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 7,
                'gelombang_id' => 1,
                'jenis_biaya' => 'registrasi',
                'nominal' => 200000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 8,
                'gelombang_id' => 1,
                'jenis_biaya' => 'registrasi',
                'nominal' => 200000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 9,
                'gelombang_id' => 1,
                'jenis_biaya' => 'registrasi',
                'nominal' => 200000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 10,
                'gelombang_id' => 1,
                'jenis_biaya' => 'registrasi',
                'nominal' => 200000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 1,
                'gelombang_id' => 1,
                'jenis_biaya' => 'daftar_ulang',
                'nominal' => 5000000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 2,
                'gelombang_id' => 1,
                'jenis_biaya' => 'daftar_ulang',
                'nominal' => 5000000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 3,
                'gelombang_id' => 1,
                'jenis_biaya' => 'daftar_ulang',
                'nominal' => 5000000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 4,
                'gelombang_id' => 1,
                'jenis_biaya' => 'daftar_ulang',
                'nominal' => 5000000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 5,
                'gelombang_id' => 1,
                'jenis_biaya' => 'daftar_ulang',
                'nominal' => 5000000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 6,
                'gelombang_id' => 1,
                'jenis_biaya' => 'daftar_ulang',
                'nominal' => 5000000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 7,
                'gelombang_id' => 1,
                'jenis_biaya' => 'daftar_ulang',
                'nominal' => 5000000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 8,
                'gelombang_id' => 1,
                'jenis_biaya' => 'daftar_ulang',
                'nominal' => 5000000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 9,
                'gelombang_id' => 1,
                'jenis_biaya' => 'daftar_ulang',
                'nominal' => 5000000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 10,
                'gelombang_id' => 1,
                'jenis_biaya' => 'daftar_ulang',
                'nominal' => 5000000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]
        ];*/

        $data = [
            [
                'jalur_masuk_id' => 1,
                'gelombang_id' => 1,
                'jenis_biaya' => 'registrasi',
                'nominal' => 200000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jalur_masuk_id' => 2,
                'gelombang_id' => 1,
                'jenis_biaya' => 'registrasi',
                'nominal' => 200000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jalur_masuk_id' => 1,
                'gelombang_id' => 1,
                'jenis_biaya' => 'daftar_ulang',
                'nominal' => 5000000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jalur_masuk_id' => 2,
                'gelombang_id' => 1,
                'jenis_biaya' => 'daftar_ulang',
                'nominal' => 5000000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];

        Biaya::insert($data);
    }
}
