<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wali', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('biodata_id');
            $table->enum('hubungan', ['ayah', 'ibu', 'wali']);
            $table->string('nama');
            $table->enum('status', ['hidup', 'meninggal', 'cerai'])->default('hidup');
            $table->string('pekerjaan');
            $table->string('telepon')->nullable(true);
            $table->string('alamat')->nullable(true);
            $table->double('gaji')->default(0);
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
        Schema::dropIfExists('wali');
    }
}
