<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNamaBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nama_barang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_barang',100);
            $table->string('nama_barang', 100);
            $table->integer('stock');
            $table->text('deskrispi');
            $table->varchar('image');
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
        Schema::dropIfExists('nama__barang');
    }
}

