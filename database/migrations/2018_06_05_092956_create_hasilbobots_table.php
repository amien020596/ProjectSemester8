<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHasilbobotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasilbobots', function (Blueprint $table) {
            //$table->bigInteger('nim',20)->unsigned();
            //$table->foreign('nim')->references('nim')->on('datamahasiswas')->onDelete('cascade');
            $table->Integer('id')->autoIncrement();
            //$table->primary('id');
            $table->unsignedBigInteger('nim');
            $table->foreign('nim')->references('nim')->on('datamahasiswas')->onDelete('cascade');
            $table->decimal('nilai',8, 4);
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
        Schema::dropIfExists('hasilbobots');
    }
}
