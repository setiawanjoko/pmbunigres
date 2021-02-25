<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdiPilihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prodi_pilihan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('biodata_id');
            $table->unsignedBigInteger('prodi_id');
            $table->tinyInteger('urutan');
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
        Schema::dropIfExists('prodi_pilihan');
    }
}
