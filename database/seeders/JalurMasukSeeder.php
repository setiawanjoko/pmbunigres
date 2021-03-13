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
        // ToDo: Modifikasi variable data sesuai dengan model terbaru
        $data = [
            [
                'jalur_masuk' => 'Reguler',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jalur_masuk' => 'Tranfer',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jalur_masuk' => 'Pindahan',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'jalur_masuk' => 'Lanjutan',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];

        JalurMasuk::insert($data);
    }
}
