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
            [
                'kelas_id' => 1,
                'jam_masuk_id' => 1, // pagi
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 1,
                'jam_masuk_id' => 4, // malam
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Ilmu Hukum B
            [
                'kelas_id' => 2,
                'jam_masuk_id' => 3, // sore
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Manajemen
            [
                'kelas_id' => 3,
                'jam_masuk_id' => 1, // pagi
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 3,
                'jam_masuk_id' => 4, // malam
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Akuntansi
            [
                'kelas_id' => 4,
                'jam_masuk_id' => 1, // pagi
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 4,
                'jam_masuk_id' => 4, // malam
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Teknik Mesin A
            [
                'kelas_id' => 5,
                'jam_masuk_id' => 1, // pagi
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 5,
                'jam_masuk_id' => 4, // malam
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Teknik Mesin B
            [
                'kelas_id' => 6,
                'jam_masuk_id' => 3, // sore
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Teknik Sipil A
            [
                'kelas_id' => 7,
                'jam_masuk_id' => 1, // pagi
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 7,
                'jam_masuk_id' => 4, // malam
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Teknik Sipil B
            [
                'kelas_id' => 8,
                'jam_masuk_id' => 3, // sore
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Administrasi Pendidikan
            [
                'kelas_id' => 9,
                'jam_masuk_id' => 1, // pagi
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 9,
                'jam_masuk_id' => 4, // malam
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Sastra Inggris
            [
                'kelas_id' => 10,
                'jam_masuk_id' => 1, // pagi
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 10,
                'jam_masuk_id' => 4, // malam
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Ilmu Keperawatan A
            [
                'kelas_id' => 11,
                'jam_masuk_id' => 1, // pagi
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 11,
                'jam_masuk_id' => 4, // malam
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Ilmu Keperawatan B
            [
                'kelas_id' => 12,
                'jam_masuk_id' => 3, // sore
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Manajemen Pendidikan A
            [
                'kelas_id' => 16,
                'jam_masuk_id' => 2, // siang
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            // Manajemen Pendidikan B
            [
                'kelas_id' => 17,
                'jam_masuk_id' => 2, // siang
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];
        JamMasukKelas::insert($data);
    }
}
