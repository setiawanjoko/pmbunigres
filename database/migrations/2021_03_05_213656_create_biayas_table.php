<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiayasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biayas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gelombang_id');
            $table->unsignedBigInteger('jalur_masuk_id');
            $table->unsignedBigInteger('kelas_id');
            $table->double('biaya_registrasi')->default(0);
            $table->double('dana_pengembangan')->default(0);
            $table->double('dana_kemahasiswaan')->default(0);
            $table->double('heregistrasi')->default(0);
            $table->double('spp_semester')->default(0);
            $table->double('seragam')->default(0);
            $table->double('konversi')->default(0);
            $table->double('total_daftar_ulang')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biayas');
    }
}
