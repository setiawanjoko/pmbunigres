<?php

namespace Database\Seeders;

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
        $data = [
            [
                'prodi_id' => '1',
                'kelas' => 'A',
                'pagi' => true,
                'malam' => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'prodi_id' => '1',
                'kelas' => 'B',
                'sore' => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];
    }
}
