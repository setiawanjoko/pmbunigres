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
            ],
            [ // #2
                'prodi_id' => 1,
                'kelas' => 'B',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Manajemen
            [ // #3
                'prodi_id' => 2,
                'kelas' => 'A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Akuntansi
            [ // #4
                'prodi_id' => 3,
                'kelas' => 'A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Teknik Mesin
            [ // #5
                'prodi_id' => 4,
                'kelas' => 'A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [ // #6
                'prodi_id' => 4,
                'kelas' => 'B',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Teknik Sipil
            [ // #7
                'prodi_id' => 5,
                'kelas' => 'A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [ // #8
                'prodi_id' => 5,
                'kelas' => 'B',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Administrasi Pendidikan
            [ // #9
                'prodi_id' => 6,
                'kelas' => 'A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Sastra Inggris
            [ // #10
                'prodi_id' => 7,
                'kelas' => 'A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Ilmu Keperawatan
            [ // #11
                'prodi_id' => 8,
                'kelas' => 'A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [ // #12
                'prodi_id' => 8,
                'kelas' => 'B',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Profesi NERS
            [ // #13
                'prodi_id' => 9,
                'kelas' => 'A',
                'lulusan_unigres' => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [ // #14
                'prodi_id' => 9,
                'kelas' => 'B',
                'lulusan_unigres' => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [ // #15
                'prodi_id' => 9,
                'kelas' => 'C',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Manajemen Pendidikan
            [ // #16
                'prodi_id' => 10,
                'kelas' => 'A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [ // #17
                'prodi_id' => 10,
                'kelas' => 'B',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];

        Kelas::insert($data);
    }
}
