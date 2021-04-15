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
            $table->unsignedBigInteger('jalur_masuk_id')->nullable();
            $table->unsignedBigInteger('jam_masuk_id')->nullable();
            $table->unsignedBigInteger('gelombang_id')->nullable();
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->string('nama');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('no_telepon')->nullable();
            $table->boolean('tes_kesehatan')->default(false);
            $table->timestamp('tes_kesehatan_at')->nullable()->default(null);
            $table->boolean('lulusan_unigres')->default(false);
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
