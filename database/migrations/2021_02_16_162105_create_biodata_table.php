<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiodataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biodata', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('prodi_id')->nullable(true);
            $table->string('no_pendaftaran')->unique();
            $table->string('nik')->unique();
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('agama');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->string('alamat')->nullable(true);
            $table->enum('jalur_masuk', ['reguler', 'transfer', 'pindahan', 'lanjutan'])->default('reguler');
            $table->string('asal_sekolah');
            $table->string('asal_jurusan');
            $table->string('foto')->nullable(true);
            $table->boolean('status');
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
        Schema::dropIfExists('biodata');
    }
}
