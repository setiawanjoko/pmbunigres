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
            [
                'prodi_id' => 1,
                'kelas' => 'A',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 1,
                'kelas' => 'B',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 2,
                'kelas' => 'A',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 3,
                'kelas' => 'A',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 4,
                'kelas' => 'A',
                'kelas' => 'pagi',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 4,
                'kelas' => 'B',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 5,
                'kelas' => 'A',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 5,
                'kelas' => 'B',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],            
            [
                'prodi_id' => 6,
                'kelas' => 'A',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 7,
                'kelas' => 'A',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 8,
                'kelas' => 'A',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 8,
                'kelas' => 'B',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 9,
                'kelas' => '1',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 9,
                'kelas' => '2',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 9,
                'kelas' => '3',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 10,
                'kelas' => 'A',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 10,
                'kelas' => 'B',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];

        Kelas::insert($data);
    }
}
