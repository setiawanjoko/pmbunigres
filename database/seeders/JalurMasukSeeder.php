<?php

namespace Database\Seeders;

use App\Models\JalurMasuk;
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
                'jalur_masuk' => 'reguler',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jalur_masuk' => 'transfer',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jalur_masuk' => 'pindahan',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jalur_masuk' => 'lanjutan',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];

        JalurMasuk::insert($data);
    }
}
