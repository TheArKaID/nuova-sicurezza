<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJeniskelaminToTengko extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tengko', function (Blueprint $table) {
            $table->tinyInteger('jeniskelamin')->after('poin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tengko', function (Blueprint $table) {
            $table->dropColumn('jeniskelamin');
        });
    }
}
