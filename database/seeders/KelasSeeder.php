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
                'kelas' => 'A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null
            ],
            [ // #2
                'prodi_id' => 1,
                'kelas' => 'B',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null
            ],

            // Manajemen
            [ // #3
                'prodi_id' => 2,
                'kelas' => 'A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null
            ],

            // Akuntansi
            [ // #4
                'prodi_id' => 3,
                'kelas' => 'A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null
            ],

            // Teknik Mesin
            [ // #5
                'prodi_id' => 4,
                'kelas' => 'A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null
            ],
            [ // #6
                'prodi_id' => 4,
                'kelas' => 'B',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null
            ],

            // Teknik Sipil
            [ // #7
                'prodi_id' => 5,
                'kelas' => 'A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null
            ],
            [ // #8
                'prodi_id' => 5,
                'kelas' => 'B',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null
            ],

            // Administrasi Pendidikan
            [ // #9
                'prodi_id' => 6,
                'kelas' => 'A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null
            ],

            // Sastra Inggris
            [ // #10
                'prodi_id' => 7,
                'kelas' => 'A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null
            ],

            // Ilmu Keperawatan
            [ // #11
                'prodi_id' => 8,
                'kelas' => 'A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 1,
                'keterangan_tes_kesehatan' => 'No WA 085648570837 Ibu Umah'
            ],
            [ // #12
                'prodi_id' => 8,
                'kelas' => 'B',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null
            ],

            // Profesi NERS
            [ // #13
                'prodi_id' => 9,
                'kelas' => 'A',
                'lulusan_unigres' => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null
            ],
            [ // #14
                'prodi_id' => 9,
                'kelas' => 'B',
                'lulusan_unigres' => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null
            ],
            [ // #15
                'prodi_id' => 9,
                'kelas' => 'C',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null
            ],

            // Manajemen Pendidikan
            [ // #16
                'prodi_id' => 10,
                'kelas' => 'A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null
            ],
            [ // #17
                'prodi_id' => 10,
                'kelas' => 'B',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'tes_kesehatan' => 0,
                'keterangan_tes_kesehatan' => null
            ],
        ];

        Kelas::insert($data);
    }
}
