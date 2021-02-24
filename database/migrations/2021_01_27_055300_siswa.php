<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Siswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('Siswa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('NIK');
            $table->string('Nama',100);
            $table->string('Alamat', 100);
            $table->string('No_hp',100);
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
        Schema::dropIfExists('Siswa');
    }
}
