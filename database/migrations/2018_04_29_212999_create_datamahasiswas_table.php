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
            $table->Integer('id')->autoIncrement();
            $table->unsignedBigInteger('nim')->unique();
            //$table->foreign('nim')->references('nim')->on('hasilbobot')->onDelete('cascade');
            //$table->foreign('nim')->references('nim')->on('nilai_mahasiswas')->onUpdate('cascade');
            $table->string('nama');
            $table->unsignedInteger('id_fakultas');
            $table->foreign('id_fakultas')->references('id')->on('datafakultas');
            $table->unsignedInteger('id_jurusan');
            $table->foreign('id_jurusan')->references('id')->on('datajurusans');
            $table->unsignedInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->SoftDeletes();
        });
        Schema::enableForeignKeyConstraints();
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
