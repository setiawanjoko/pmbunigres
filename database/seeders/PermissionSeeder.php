<?php

namespace Database\Seeders;

use App\Models\Permission;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

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
            [
                'permission'    => 'admin',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'permission'    => 'camaba',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'permission'    => 'monitor',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'permission'    => 'keuangan',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'permission'    => 'kesehatan',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]
        ];

        Permission::insert($data);
    }
}
