<?php

namespace Database\Seeders;

use App\Models\JalurMasukKelas;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class JalurMasukKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ToDo: Modifikasi variable data sesuai dengan model JalurMasukKelas
        // 'kelas_id', 'jalur_masuk_id', 'biaya_id', 'url'
        $data = [
            [
                'kelas_id' => 1,
                'jalur_masuk_id' => 1,
                'biaya_id' => 1,
                'url' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kelas_id' => 1,
                'jalur_masuk_id' => 1,
                'biaya_id' => 1,
                'url' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        JalurMasukKelas::insert($data);
    }
}
