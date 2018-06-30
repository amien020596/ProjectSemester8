<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatamahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datamahasiswas', function (Blueprint $table) {
            $table->bigInteger('nim',20)->unsigned();
            $table->string('nama');
            $table->unsignedInteger('id_fakultas');
            $table->foreign('id_fakultas')->references('id')->on('datafakultas');
            $table->unsignedInteger('id_jurusan');
            $table->foreign('id_jurusan')->references('id')->on('datajurusans');
            $table->unsignedInteger('id_user');
            $table->timestamps();
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datamahasiswas');
    }
}
