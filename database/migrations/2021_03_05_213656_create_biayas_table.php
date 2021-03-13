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
            $table->enum('kategori', ['registrasi', 'daftar_ulang']);
            $table->double('nominal')->default(0);
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
