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
            //'gelombang_id', 'jalur_masuk_id', 'kelas_id', 'kategori', 'nominal'

            //registrasi
            [
                'gelombang_id' => 1,
                'jalur_masuk_id' => 1,
                'kategori' => 'registrasi',
                'nominal' => 200000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'gelombang_id' => 2,
                'kategori' => 'registrasi',
                'nominal' => 200000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'gelombang_id' => 3,
                'kategori' => 'registrasi',
                'nominal' => 200000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],       
            
            // //daftar_ulang
            // [
            //     'gelombang_id' => 1,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 4070000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // [
            //     'gelombang_id' => 1,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 4120000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // [
            //     'gelombang_id' => 1,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 5825000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // [
            //     'gelombang_id' => 1,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 4525000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // [
            //     'gelombang_id' => 1,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 2500000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // [
            //     'gelombang_id' => 1,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 3600000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // [
            //     'gelombang_id' => 1,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 4600000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // [
            //     'gelombang_id' => 1,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 3750000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // [
            //     'gelombang_id' => 1,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 5070000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // [
            //     'gelombang_id' => 1,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 5120000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // [
            //     'gelombang_id' => 1,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 6825000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // [
            //     'gelombang_id' => 1,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 5525000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 

            // //gel2
            // [
            //     'gelombang_id' => 2,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 4245000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // [
            //     'gelombang_id' => 2,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 4295000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // [
            //     'gelombang_id' => 2,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 5950000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // [
            //     'gelombang_id' => 2,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 4650000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // [
            //     'gelombang_id' => 2,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 2500000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // [
            //     'gelombang_id' => 2,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 3600000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // //25
            // [
            //     'gelombang_id' => 2,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 4600000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // //26
            // [
            //     'gelombang_id' => 2,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 3750000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // //27
            // [
            //     'gelombang_id' => 2,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 5245000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // //28
            // [
            //     'gelombang_id' => 2,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 5295000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // //29
            // [
            //     'gelombang_id' => 2,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 6950000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // //30
            // [
            //     'gelombang_id' => 2,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 5650000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ],

            // //gel3
            // //31
            // [
            //     'gelombang_id' => 3,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 4420000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ],
            // //32
            // [
            //     'gelombang_id' => 3,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 4470000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // //33
            // [
            //     'gelombang_id' => 3,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 6075000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // //34
            // [
            //     'gelombang_id' => 3,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 4775000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // //35
            // [
            //     'gelombang_id' => 3,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 2500000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // //36
            // [
            //     'gelombang_id' => 3,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 3600000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // //37
            // [
            //     'gelombang_id' => 3,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 4600000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // //38
            // [
            //     'gelombang_id' => 3,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 3750000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // //39
            // [
            //     'gelombang_id' => 3,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 5420000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // //40
            // [
            //     'gelombang_id' => 3,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 5470000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // //41
            // [
            //     'gelombang_id' => 3,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 7075000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
            // //42
            // [
            //     'gelombang_id' => 3,
            //     'kategori' => 'daftar_ulang',
            //     'nominal' => 5775000,
            //     'created_at'    => Carbon::now(),
            //     'updated_at'    => Carbon::now(),
            // ], 
        ];

        //Biaya::insert($data);
    }
}
