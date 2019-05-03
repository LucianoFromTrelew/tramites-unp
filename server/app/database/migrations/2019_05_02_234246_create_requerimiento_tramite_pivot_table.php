<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequerimientoTramitePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requerimiento_tramite', function (Blueprint $table) {
            $table->unsignedBigInteger('requerimiento_id')->index();
            $table->unsignedBigInteger('tramite_id')->index();
            $table->foreign('requerimiento_id')->references('id')->on('requerimientos')->onDelete('cascade');
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
