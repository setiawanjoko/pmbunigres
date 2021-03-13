<?php

namespace Database\Seeders;

use App\Models\Biaya;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BiayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            //registrasi
            //1
            [
                'gelombang_id' => 1,
                'kategori' => 'registrasi',
                'nominal' => 200000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            //2
            [
                'gelombang_id' => 1,
                'kategori' => 'registrasi',
                'nominal' => 200000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //3
            [
                'gelombang_id' => 2,
                'kategori' => 'registrasi',
                'nominal' => 200000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            //4
            [
                'gelombang_id' => 2,
                'kategori' => 'registrasi',
                'nominal' => 200000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //5
            [
                'gelombang_id' => 3,
                'kategori' => 'registrasi',
                'nominal' => 200000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            //6
            [
                'gelombang_id' => 3,
                'kategori' => 'registrasi',
                'nominal' => 200000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],            
            
            //daftar_ulang
            //7
            [
                'gelombang_id' => 1,
                'kategori' => 'daftar_ulang',
                'nominal' => 4070000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //8
            [
                'gelombang_id' => 1,
                'kategori' => 'daftar_ulang',
                'nominal' => 4120000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //9
            [
                'gelombang_id' => 1,
                'kategori' => 'daftar_ulang',
                'nominal' => 5825000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //10
            [
                'gelombang_id' => 1,
                'kategori' => 'daftar_ulang',
                'nominal' => 4525000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //11
            [
                'gelombang_id' => 1,
                'kategori' => 'daftar_ulang',
                'nominal' => 2500000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //12
            [
                'gelombang_id' => 1,
                'kategori' => 'daftar_ulang',
                'nominal' => 3600000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //13
            [
                'gelombang_id' => 1,
                'kategori' => 'daftar_ulang',
                'nominal' => 4600000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //14
            [
                'gelombang_id' => 1,
                'kategori' => 'daftar_ulang',
                'nominal' => 3750000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //15
            [
                'gelombang_id' => 1,
                'kategori' => 'daftar_ulang',
                'nominal' => 5070000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //16
            [
                'gelombang_id' => 1,
                'kategori' => 'daftar_ulang',
                'nominal' => 5120000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //17
            [
                'gelombang_id' => 1,
                'kategori' => 'daftar_ulang',
                'nominal' => 6825000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //18
            [
                'gelombang_id' => 1,
                'kategori' => 'daftar_ulang',
                'nominal' => 5525000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 

            //19
            [
                'gelombang_id' => 2,
                'kategori' => 'daftar_ulang',
                'nominal' => 4125000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //20
            [
                'gelombang_id' => 2,
                'kategori' => 'daftar_ulang',
                'nominal' => 4175000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //21
            [
                'gelombang_id' => 2,
                'kategori' => 'daftar_ulang',
                'nominal' => 5800000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //22
            [
                'gelombang_id' => 2,
                'kategori' => 'daftar_ulang',
                'nominal' => 4500000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //23
            [
                'gelombang_id' => 2,
                'kategori' => 'daftar_ulang',
                'nominal' => 2500000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //24
            [
                'gelombang_id' => 2,
                'kategori' => 'daftar_ulang',
                'nominal' => 3600000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //25
            [
                'gelombang_id' => 2,
                'kategori' => 'daftar_ulang',
                'nominal' => 4600000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //26
            [
                'gelombang_id' => 2,
                'kategori' => 'daftar_ulang',
                'nominal' => 3750000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //27
            [
                'gelombang_id' => 2,
                'kategori' => 'daftar_ulang',
                'nominal' => 5125000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //28
            [
                'gelombang_id' => 2,
                'kategori' => 'daftar_ulang',
                'nominal' => 5175000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //29
            [
                'gelombang_id' => 2,
                'kategori' => 'daftar_ulang',
                'nominal' => 6800000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //30
            [
                'gelombang_id' => 2,
                'kategori' => 'daftar_ulang',
                'nominal' => 5500000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],

            //31
            [
                'gelombang_id' => 3,
                'kategori' => 'daftar_ulang',
                'nominal' => 4300000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            //32
            [
                'gelombang_id' => 3,
                'kategori' => 'daftar_ulang',
                'nominal' => 4350000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //33
            [
                'gelombang_id' => 3,
                'kategori' => 'daftar_ulang',
                'nominal' => 5925000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //34
            [
                'gelombang_id' => 3,
                'kategori' => 'daftar_ulang',
                'nominal' => 4625000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //35
            [
                'gelombang_id' => 3,
                'kategori' => 'daftar_ulang',
                'nominal' => 2500000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //36
            [
                'gelombang_id' => 3,
                'kategori' => 'daftar_ulang',
                'nominal' => 3600000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //37
            [
                'gelombang_id' => 3,
                'kategori' => 'daftar_ulang',
                'nominal' => 4600000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //38
            [
                'gelombang_id' => 3,
                'kategori' => 'daftar_ulang',
                'nominal' => 3750000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //39
            [
                'gelombang_id' => 3,
                'kategori' => 'daftar_ulang',
                'nominal' => 5300000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //40
            [
                'gelombang_id' => 3,
                'kategori' => 'daftar_ulang',
                'nominal' => 5350000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //41
            [
                'gelombang_id' => 3,
                'kategori' => 'daftar_ulang',
                'nominal' => 6925000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
            //42
            [
                'gelombang_id' => 3,
                'kategori' => 'daftar_ulang',
                'nominal' => 5625000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ], 
        ];

        Biaya::insert($data);
    }
}
