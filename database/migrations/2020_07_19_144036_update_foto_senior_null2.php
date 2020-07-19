<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFotoSeniorNull2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('senior', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('jeniskelamin');
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
            $table->dropColumn('foto');
        });
    }
}
