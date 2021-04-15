<?php

namespace Database\Seeders;

use App\Models\JamMasuk;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class JamMasukSeeder extends Seeder
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
                'jam_masuk' => 'pagi',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jam_masuk' => 'siang',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jam_masuk' => 'sore',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jam_masuk' => 'malam',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jam_masuk' => 'siang',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];
        JamMasuk::insert($data);
    }
}
