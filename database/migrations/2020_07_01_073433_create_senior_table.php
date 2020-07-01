<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeniorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('senior', function (Blueprint $table) {
            $table->id();
            $table->integer('idsenior');
            $table->integer('idusroh');
            $table->integer('idkamar');
            $table->integer('idtahun');
            $table->string('nama');
            $table->string('nim');
            $table->string('jeniskelamin');
            $table->string('foto');
            $table->string('username');
            $table->string('password');
            $table->string('passcode');
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
        Schema::dropIfExists('senior');
    }
}
