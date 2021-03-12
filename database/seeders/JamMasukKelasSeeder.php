<?php

namespace Database\Seeders;

use App\Models\JamMasuk;
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
        // ToDo: Modifikasi variable data sesuai dengan model JamMasukKelas
        $data = [
            [
                'kelas_id' => 1,//prodi1
                'jam_masuk' => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 1,//prodi1
                'jam_masuk' => 4,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 2,//prodi1
                'jam_masuk' => 3,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 3,//prodi2
                'jam_masuk' => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 3,//prodi2
                'jam_masuk' => 4,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 4,//prodi3
                'jam_masuk' => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 4,//prodi3
                'jam_masuk' => 4,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 5,//prodi4
                'jam_masuk' => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 5,//prodi4
                'jam_masuk' => 4,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],            
            [
                'kelas_id' => 6,//prodi4
                'jam_masuk' => 3,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 7,//prodi5
                'jam_masuk' => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 7,//prodi5
                'jam_masuk' => 4,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 8,//prodi5
                'jam_masuk' => 3,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 9,//prodi6
                'jam_masuk' => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 9,//prodi6
                'jam_masuk' => 4,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 10,//prodi7
                'jam_masuk' => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 10,//prodi7
                'jam_masuk' => 4,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 11,//prodi8
                'jam_masuk' => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 11,//prodi8
                'jam_masuk' => 4,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 12,//prodi8
                'jam_masuk' => 3,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 16,//prodi10
                'jam_masuk' => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 16,//prodi10
                'jam_masuk' => 4,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 17,//prodi10
                'jam_masuk' => 3,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];
        JamMasuk::insert($data);
    }
}
