<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
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
                'permission_id'=>1,
                'nama'=>'Admin',
                'email'=>'admin@localhost',
                'email_verified_at'=>Carbon::now(),
                'password'=>bcrypt('password')
            ],
            [
                'permission_id'=>3,
                'nama'=>'Monitor',
                'email'=>'monitor@localhost',
                'email_verified_at'=>Carbon::now(),
                'password'=>bcrypt('password')
            ],
            [
                'permission_id'=>4,
                'nama'=>'Keuangan',
                'email'=>'keuangan@localhost',
                'email_verified_at'=>Carbon::now(),
                'password'=>bcrypt('password')
            ],
            [
                'permission_id'=>5,
                'nama'=>'Kesehatan',
                'email'=>'kesehatan@localhost',
                'email_verified_at'=>Carbon::now(),
                'password'=>bcrypt('password')
            ]
        ];

        User::insert($data);
    }
}
