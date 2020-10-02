<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeJeniskelaminTypeFromResident extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resident', function (Blueprint $table) {
            $table->dropColumn('jeniskelamin');
        });
        Schema::table('resident', function (Blueprint $table) {
            $table->tinyInteger('jeniskelamin')->after('nim');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resident', function (Blueprint $table) {
            $table->dropColumn('jeniskelamin');
        });
        Schema::table('resident', function (Blueprint $table) {
            $table->string('jeniskelamin')->after('nim');
        });
    }
}
