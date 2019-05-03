<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion');
            $table->timestamps();
            $table->unsignedBigInteger('tramite_id');
            $table->unsignedBigInteger('metodo_id');

            $table->foreign('tramite_id')
                ->references('id')
                ->on('tramites')
                ->onDelete('cascade');
            $table->foreign('metodo_id')
                ->references('id')
                ->on('metodos')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasos');
    }
}
