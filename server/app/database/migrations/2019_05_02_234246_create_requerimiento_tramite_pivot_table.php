<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class App\ extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requerimiento_tramite', function (Blueprint $table) {
            $table->integer('requerimiento_id')->unsigned()->index();
            $table->foreign('requerimiento_id')->references('id')->on('requerimientos')->onDelete('cascade');
            $table->integer('tramite_id')->unsigned()->index();
            $table->foreign('tramite_id')->references('id')->on('tramites')->onDelete('cascade');
            $table->primary(['requerimiento_id', 'tramite_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('requerimiento_tramite');
    }
}
