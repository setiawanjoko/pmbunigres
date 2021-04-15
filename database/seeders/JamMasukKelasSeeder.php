<?php

namespace Database\Seeders;

use App\Models\JamMasukKelas;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class JamMasukKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ToDo: Tambahkan jam masuk untuk Profesi NERS
        $data = [
            // Ilmu Hukum A
            [ // #1
                'kelas_id' => 1,
                'jam_masuk_id' => 1, // pagi
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [ // #2
                'kelas_id' => 1,
                'jam_masuk_id' => 4, // malam
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Ilmu Hukum B
            [ // #3
                'kelas_id' => 2,
                'jam_masuk_id' => 3, // sore
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Manajemen
            [ // #4
                'kelas_id' => 3,
                'jam_masuk_id' => 1, // pagi
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [ // #5
                'kelas_id' => 3,
                'jam_masuk_id' => 4, // malam
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Akuntansi
            [ // #6
                'kelas_id' => 4,
                'jam_masuk_id' => 1, // pagi
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [ // #7
                'kelas_id' => 4,
                'jam_masuk_id' => 4, // malam
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Teknik Mesin A
            [ // #8
                'kelas_id' => 5,
                'jam_masuk_id' => 1, // pagi
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [ // #9
                'kelas_id' => 5,
                'jam_masuk_id' => 4, // malam
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Teknik Mesin B
            [ // #10
                'kelas_id' => 6,
                'jam_masuk_id' => 3, // sore
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Teknik Sipil A
            [ // #11
                'kelas_id' => 7,
                'jam_masuk_id' => 1, // pagi
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [ // #12
                'kelas_id' => 7,
                'jam_masuk_id' => 4, // malam
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Teknik Sipil B
            [ // #13
                'kelas_id' => 8,
                'jam_masuk_id' => 3, // sore
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Administrasi Pendidikan
            [ // #14
                'kelas_id' => 9,
                'jam_masuk_id' => 3, // pagi
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Sastra Inggris
            [ // #15
                'kelas_id' => 10,
                'jam_masuk_id' => 3, // pagi
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Ilmu Keperawatan A
            [ // #16
                'kelas_id' => 11,
                'jam_masuk_id' => 1, // pagi
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Ilmu Keperawatan B
            [ // #17
                'kelas_id' => 12,
                'jam_masuk_id' => 3, // sore
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // NERS
            [ // #18
                'kelas_id' => 13,
                'jam_masuk_id' => 1, // pagi A
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [ // #19
                'kelas_id' => 14,
                'jam_masuk_id' => 1, // pagi B
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [ // #20
                'kelas_id' => 15,
                'jam_masuk_id' => 1, // pagi C
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Manajemen Pendidikan A
            [ // #21
                'kelas_id' => 16,
                'jam_masuk_id' => 2, // siang
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Manajemen Pendidikan B
            [ // #22
                'kelas_id' => 17,
                'jam_masuk_id' => 5, // siang
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];
        JamMasukKelas::insert($data);
    }
}
