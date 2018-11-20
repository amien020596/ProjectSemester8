<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaiMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_mahasiswas', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('nim')->unsigned();
            //$table->foreign('nim')->references('nim')->on('datamahasiswas')->onDelete('cascade');
            $table->unsignedInteger('id_kriteria');
            $table->foreign('id_kriteria')->references('id')->on('kriterias')->onDelete('cascade');
            $table->unsignedInteger('nilai');
            $table->unsignedInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('nilai_mahasiswas');
    }
}
