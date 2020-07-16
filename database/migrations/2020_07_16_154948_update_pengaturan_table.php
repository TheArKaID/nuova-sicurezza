<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePengaturanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengaturan', function (Blueprint $table) {
            $table->dropColumn('tahunaktif');
            $table->integer('idtahunaktif')->after('ponsus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengaturan', function (Blueprint $table) {
            $table->dropColumn('idtahunaktif')->after('ponsus');
            $table->string('tahunaktif');
        });
    }
}
