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
                'pagi' => true,
                'sore' => false,
                'malam' => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => 1,
                'kelas' => 'B',
                'pagi' => false,
                'sore' => true,
                'malam' => false,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];

        Kelas::insert($data);
    }
}
