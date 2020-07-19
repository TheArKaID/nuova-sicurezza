<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveIdseniorColunmSeniorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('senior', function (Blueprint $table) {
            $table->dropColumn('idsenior');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('senior', function (Blueprint $table) {
            $table->integer('idsenior')->after('id');
        });
    }
}
