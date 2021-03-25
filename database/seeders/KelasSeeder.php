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
            [
                'prodi_id' => 1,
                'kelas' => 'A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 1,
                'kelas' => 'B',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Manajemen
            [
                'prodi_id' => 2,
                'kelas' => 'A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Akuntansi
            [
                'prodi_id' => 3,
                'kelas' => 'A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Teknik Mesin
            [
                'prodi_id' => 4,
                'kelas' => 'A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 4,
                'kelas' => 'B',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Teknik Sipil
            [
                'prodi_id' => 5,
                'kelas' => 'A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 5,
                'kelas' => 'B',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Administrasi Pendidikan
            [
                'prodi_id' => 6,
                'kelas' => 'A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Sastra Inggris
            [
                'prodi_id' => 7,
                'kelas' => 'A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Ilmu Keperawatan
            [
                'prodi_id' => 8,
                'kelas' => 'A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 8,
                'kelas' => 'B',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Profesi NERS
            [
                'prodi_id' => 9,
                'kelas' => 'A',
                'lulusan_unigres' => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 9,
                'kelas' => 'B',
                'lulusan_unigres' => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 9,
                'kelas' => 'C',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Manajemen Pendidikan
            [
                'prodi_id' => 10,
                'kelas' => 'A',
                'lulusan_unigres' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
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
