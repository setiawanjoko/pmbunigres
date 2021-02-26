<?php

namespace Database\Seeders;

use App\Models\Jenjang;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class JenjangSeeder extends Seeder
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
                'nama'          => 'D3',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'nama'          => 'D4',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'nama'          => 'S1',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'nama'          => 'S2',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];

        Jenjang::insert($data);
    }
}
