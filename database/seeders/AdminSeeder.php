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
        User::create([
            'permission_id'=>1,
            'nama'=>'admin',
            'email'=>'admin@localhost',
            'email_verified_at'=>Carbon::now(),
            'password'=>bcrypt('password')]);
    }
}
