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
            $table->string('no_pendaftaran')->unique();
            $table->string('nik')->unique();
            $table->string('nim')->nullable();
            $table->string('nama_depan');
            $table->string('nama_belakang')->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('agama', ['islam', 'kristen', 'katholik', 'hindu', 'budha', 'konghucu']);
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->string('alamat')->nullable(true);
            $table->string('no_telepon')->nullable(true);
            $table->string('asal_sekolah');
            $table->string('asal_jurusan');
            $table->year('tahun_lulus');
            $table->string('foto')->nullable(true);
            $table->enum('ukuran_almamater', ['S', 'M', 'L', 'XL', 'XXL']);
            $table->enum('informasi', ['sosial_media', 'teman_saudara', 'lainnya'])->default('sosial_media');
            $table->string('asal_informasi');
            $table->softDeletes();
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
