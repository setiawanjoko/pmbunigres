<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('permission_id')->default(2);
            $table->unsignedBigInteger('prodi_id')->nullable();
            $table->unsignedBigInteger('gelombang_id')->nullable();
            $table->string('nama');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('no_telepon')->nullable();
            $table->enum('informasi', ['sosial_media', 'teman_saudara', 'lainnya'])->nullable();
            $table->enum('jalur_masuk', ['reguler', 'transfer', 'pindahan', 'lanjutan'])->default('reguler');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
