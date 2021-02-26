<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FakultasSeeder extends Seeder
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
                'fakultas' => 'Fakultas Hukum',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'fakultas' => 'Fakultas Ekonomi',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'fakultas' => 'Fakultas Teknik',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'fakultas' => 'Fakultas Keguruan dan Ilmu Pendidikan',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'fakultas' => 'Fakultas Sastra',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'fakultas' => 'Fakultas Ilmu Kesehatan',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]
        ];

        Fakultas::insert($data);
    }
}
