<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prodi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenjang_id');
            $table->unsignedBigInteger('fakultas_id')->nullable(true);
            $table->string('kode_prodi_nim');
            $table->string('kode_prodi_siakad');
            $table->string('nama');
            $table->string('link_grup')->nullable(true);
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
        Schema::dropIfExists('prodi');
    }
}
