<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['permission' => 'admin'],
            ['permission' => 'camaba'],
            ['permission' => 'monitor']
        ];

        foreach ($data as $row) {
            DB::table('permissions')->insert($row);
        }
    }
}
