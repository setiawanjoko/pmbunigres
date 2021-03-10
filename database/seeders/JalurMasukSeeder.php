<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class JalurMasukSeeder extends Seeder
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
                'kelas_id' => 1,
                'reguler' => true,
                'transfer' => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 1,
                'pindahan' => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];
    }
}
