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
                'kelas_id' => 1,
                'reguler' => true,
                'transfer' => true,
                'pindahan' => false,
                'lanjutan' => false,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'kelas_id' => 1,
                'reguler' => false,
                'transfer' => false,
                'pindahan' => true,
                'lanjutan' => false,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];

        JalurMasuk::insert($data);
    }
}
