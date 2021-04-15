<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ToDo: Modifikasi variable data sesuai dengan kebutuhan model Kelas
        $data = [
            // Ilmu Hukum
            [ // #1
                'prodi_id' => 1,
                'kelas' => 'Kelas A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null,
                'biaya_registrasi' => 1,
                'biaya_daftar_ulang' => 1
            ],
            [ // #2
                'prodi_id' => 1,
                'kelas' => 'Kelas B',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null,
                'biaya_registrasi' => 1,
                'biaya_daftar_ulang' => 1
            ],

            // Manajemen
            [ // #3
                'prodi_id' => 2,
                'kelas' => 'Kelas A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null,
                'biaya_registrasi' => 1,
                'biaya_daftar_ulang' => 1
            ],

            // Akuntansi
            [ // #4
                'prodi_id' => 3,
                'kelas' => 'Kelas A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null,
                'biaya_registrasi' => 1,
                'biaya_daftar_ulang' => 1
            ],

            // Teknik Mesin
            [ // #5
                'prodi_id' => 4,
                'kelas' => 'Kelas A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null,
                'biaya_registrasi' => 1,
                'biaya_daftar_ulang' => 1
            ],
            [ // #6
                'prodi_id' => 4,
                'kelas' => 'Kelas B',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null,
                'biaya_registrasi' => 1,
                'biaya_daftar_ulang' => 1
            ],

            // Teknik Sipil
            [ // #7
                'prodi_id' => 5,
                'kelas' => 'Kelas A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null,
                'biaya_registrasi' => 1,
                'biaya_daftar_ulang' => 1
            ],
            [ // #8
                'prodi_id' => 5,
                'kelas' => 'Kelas B',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null,
                'biaya_registrasi' => 1,
                'biaya_daftar_ulang' => 1
            ],

            // Administrasi Pendidikan
            [ // #9
                'prodi_id' => 6,
                'kelas' => 'Kelas A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null,
                'biaya_registrasi' => 1,
                'biaya_daftar_ulang' => 1
            ],

            // Sastra Inggris
            [ // #10
                'prodi_id' => 7,
                'kelas' => 'Kelas A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null,
                'biaya_registrasi' => 1,
                'biaya_daftar_ulang' => 1
            ],

            // Ilmu Keperawatan
            [ // #11
                'prodi_id' => 8,
                'kelas' => 'Kelas A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 1,
                'keterangan_tes_kesehatan' => 'No WA 085648570837 Ibu Umah',
                'biaya_registrasi' => 1,
                'biaya_daftar_ulang' => 1
            ],
            [ // #12
                'prodi_id' => 8,
                'kelas' => 'Kelas B',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null,
                'biaya_registrasi' => 1,
                'biaya_daftar_ulang' => 1
            ],

            // Profesi NERS
            [ // #13
                'prodi_id' => 9,
                'kelas' => 'Programs A (Reguler)',
                'lulusan_unigres' => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null,
                'biaya_registrasi' => 1,
                'biaya_daftar_ulang' => 1
            ],
            [ // #14
                'prodi_id' => 9,
                'kelas' => 'Programs B (Non Reguler)',
                'lulusan_unigres' => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null,
                'biaya_registrasi' => 1,
                'biaya_daftar_ulang' => 1
            ],
            [ // #15
                'prodi_id' => 9,
                'kelas' => 'Programs C',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null,
                'biaya_registrasi' => 1,
                'biaya_daftar_ulang' => 1
            ],

            // Manajemen Pendidikan
            [ // #16
                'prodi_id' => 10,
                'kelas' => 'Kelas A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null,
                'biaya_registrasi' => 1,
                'biaya_daftar_ulang' => 1
            ],
            [ // #17
                'prodi_id' => 10,
                'kelas' => 'Kelas B',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null,
                'biaya_registrasi' => 0,
                'biaya_daftar_ulang' => 0
            ],
        ];

        Kelas::insert($data);
    }
}
