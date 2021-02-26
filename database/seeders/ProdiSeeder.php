<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'jenjang_id' => 3,
                'fakultas_id' => 1,
                'kode_prodi' => '01',
                'nama' => 'Ilmu Hukum',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jenjang_id' => 3,
                'fakultas_id' => 2,
                'kode_prodi' => '02',
                'nama' => 'Manajemen',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jenjang_id' => 3,
                'fakultas_id' => 2,
                'kode_prodi' => '03',
                'nama' => 'Akuntansi',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jenjang_id' => 3,
                'fakultas_id' => 3,
                'kode_prodi' => '04',
                'nama' => 'Teknik Mesin',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jenjang_id' => 3,
                'fakultas_id' => 3,
                'kode_prodi' => '05',
                'nama' => 'Teknik Sipil',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jenjang_id' => 3,
                'fakultas_id' => 4,
                'kode_prodi' => '06',
                'nama' => 'Administrasi Pendidikan',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jenjang_id' => 3,
                'fakultas_id' => 5,
                'kode_prodi' => '07',
                'nama' => 'Sastra Inggris',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jenjang_id' => 3,
                'fakultas_id' => 6,
                'kode_prodi' => '08',
                'nama' => 'Ilmu Keperawatan',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jenjang_id' => 3,
                'fakultas_id' => 6,
                'kode_prodi' => '09',
                'nama' => 'Profesi Ners',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jenjang_id' => 4,
                'fakultas_id' => null,
                'kode_prodi' => '10',
                'nama' => 'Manajemen Pendidikan',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]
        ];

        Prodi::insert($data);
    }
}
