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
        // ToDo: modifikasi variable data sesuai dengan kebutuhan model Prodi
        $data = [
            [
                'jenjang_id' => 1,
                'fakultas_id' => 1,
                'kode_prodi_nim' => '01',
                'kode_prodi_siakad' => '74201',
                'nama' => 'Ilmu Hukum',
                'tes_kesehatan' => null,
                'keterangan_tes_kesehatan' => null,
                'link_grup' => null,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jenjang_id' => 1,
                'fakultas_id' => 2,
                'kode_prodi_nim' => '02',
                'kode_prodi_siakad' => '61201',
                'nama' => 'Manajemen',
                'tes_kesehatan' => null,
                'keterangan_tes_kesehatan' => null,
                'link_grup' => null,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jenjang_id' => 1,
                'fakultas_id' => 2,
                'kode_prodi_nim' => '03',
                'kode_prodi_siakad' => '62201',
                'nama' => 'Akuntansi',
                'tes_kesehatan' => null,
                'keterangan_tes_kesehatan' => null,
                'link_grup' => null,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jenjang_id' => 1,
                'fakultas_id' => 3,
                'kode_prodi_nim' => '04',
                'kode_prodi_siakad' => '21201',
                'nama' => 'Teknik Mesin',
                'tes_kesehatan' => null,
                'keterangan_tes_kesehatan' => null,
                'link_grup' => null,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jenjang_id' => 1,
                'fakultas_id' => 3,
                'kode_prodi_nim' => '05',
                'kode_prodi_siakad' => '22201',
                'nama' => 'Teknik Sipil',
                'tes_kesehatan' => null,
                'keterangan_tes_kesehatan' => null,
                'link_grup' => null,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jenjang_id' => 1,
                'fakultas_id' => 4,
                'kode_prodi_nim' => '06',
                'kode_prodi_siakad' => '86204',
                'nama' => 'Administrasi Pendidikan',
                'tes_kesehatan' => null,
                'keterangan_tes_kesehatan' => null,
                'link_grup' => null,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jenjang_id' => 1,
                'fakultas_id' => 5,
                'kode_prodi_nim' => '07',
                'kode_prodi_siakad' => '79202',
                'nama' => 'Sastra Inggris',
                'tes_kesehatan' => null,
                'keterangan_tes_kesehatan' => null,
                'link_grup' => null,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jenjang_id' => 1,
                'fakultas_id' => 6,
                'kode_prodi_nim' => '08',
                'kode_prodi_siakad' => '14201',
                'nama' => 'Ilmu Keperawatan',
                'tes_kesehatan' => null,
                'keterangan_tes_kesehatan' => null,
                'link_grup' => null,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jenjang_id' => 3,
                'fakultas_id' => 6,
                'kode_prodi_nim' => '09',
                'kode_prodi_siakad' => '14901',
                'nama' => 'Ners',
                'tes_kesehatan' => null,
                'keterangan_tes_kesehatan' => null,
                'link_grup' => null,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jenjang_id' => 2,
                'fakultas_id' => null,
                'kode_prodi_nim' => '10',
                'kode_prodi_siakad' => '86104',
                'nama' => 'Manajemen Pendidikan',
                'tes_kesehatan' => null,
                'keterangan_tes_kesehatan' => null,
                'link_grup' => null,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]
        ];

        Prodi::insert($data);
    }
}
