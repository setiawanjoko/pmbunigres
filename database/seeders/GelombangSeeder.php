<?php

namespace Database\Seeders;

use App\Models\Gelombang;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class GelombangSeeder extends Seeder
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
                'gelombang'     => 'Gelombang 1',
                'tgl_mulai'    => Carbon::createFromDate(2021,03,1),
                'tgl_selesai'    => Carbon::createFromDate(2021,03,7),
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'gelombang'     => 'Gelombang 2',
                'tgl_mulai'    => Carbon::createFromDate(2021,03,8),
                'tgl_selesai'    => Carbon::createFromDate(2021,03,14),
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'gelombang'     => 'Gelombang 3',
                'tgl_mulai'    => Carbon::createFromDate(2021,03,15),
                'tgl_selesai'    => Carbon::createFromDate(2021,03,21),
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];

        Gelombang::insert($data);
    }
}
