<?php

namespace Database\Seeders;

use App\Models\Biaya;
use App\Models\Gelombang;
use App\Models\JalurMasuk;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // ToDo: Tambahkan semua class seeder ke fungsi di bawah ini
        $this->call([
            PermissionSeeder::class,
            JenjangSeeder::class,
            FakultasSeeder::class,
            ProdiSeeder::class,
            GelombangSeeder::class,
            BiayaSeeder::class,
            AdminSeeder::class,
            KelasSeeder::class,
            JalurMasukSeeder::class,
            JamMasukSeeder::class,
            JamMasukKelasSeeder::class,
            JalurMasukKelasSeeder::class
        ]);
    }
}
