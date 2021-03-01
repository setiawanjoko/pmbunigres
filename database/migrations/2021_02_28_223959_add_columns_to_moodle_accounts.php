<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToMoodleAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('moodle_accounts', function (Blueprint $table) {
            $table->string('moodle_user_id')->nullable(true);
            $table->string('moodle_firstname');
            $table->string('moodle_lastname');
            $table->string('moodle_email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('moodle_accounts', function (Blueprint $table) {
            $table->dropColumn(['moodle_user_id', 'moodle_firstname', 'moodle_lastname', 'moodle_email']);
        });
    }
}
